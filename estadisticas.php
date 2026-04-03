<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>
<?php include_once("bd/Conexion.php"); ?>

<?php

// Total mascotas
$totalMascotas = $dbh->query("SELECT COUNT(*) FROM tabla_mascotas WHERE id_estado_adopcion_mascota ='1'")->fetchColumn();

// Mascotas por especie
$mascotasPorEspecie = $dbh->query("
    SELECT nombre_especie, COUNT(*) as total
    FROM tabla_mascotas tm
    JOIN mascota_especie m4 ON tm.id_especie_mascota = m4.id_especie_mascota
    GROUP BY nombre_especie
")->fetchAll(PDO::FETCH_ASSOC);

// Total solicitudes
$totalSolicitudes = $dbh->query("SELECT COUNT(*) FROM bot_solicitud_adopcion WHERE id_estado_adopcion = '1' ")->fetchColumn();

// Solicitudes por estado
$solicitudesPorEstado = $dbh->query("
    SELECT nombre_estado_adopcion, COUNT(*) as total
    FROM bot_solicitud_adopcion bs
    JOIN bot_estado_adopcion be ON bs.id_estado_adopcion = be.id_estado_adopcion
    GROUP BY nombre_estado_adopcion
")->fetchAll(PDO::FETCH_ASSOC);

// Viabilidad por rangos
$viabilidadRangos = $dbh->query("
    SELECT 
        CASE 
            WHEN CAST(porcentaje_viabilidad AS UNSIGNED) BETWEEN 0 AND 40 THEN 'Baja (0-40%)'
            WHEN CAST(porcentaje_viabilidad AS UNSIGNED) BETWEEN 41 AND 60 THEN 'Media (41-60%)'
            WHEN CAST(porcentaje_viabilidad AS UNSIGNED) BETWEEN 61 AND 80 THEN 'Alta (61-80%)'
            ELSE 'Muy alta (81-100%)'
        END as rango,
        COUNT(*) as total
    FROM bot_solicitud_adopcion
    GROUP BY rango
    ORDER BY MIN(CAST(porcentaje_viabilidad AS UNSIGNED))
")->fetchAll(PDO::FETCH_ASSOC);

// Solicitudes recibidas por mes (todos)
$solicitudesRecibidas = $dbh->query("
    SELECT DATE_FORMAT(fecha_registro, '%b %Y') as mes,
           DATE_FORMAT(fecha_registro, '%Y-%m') as mes_orden,
           COUNT(*) as total
    FROM bot_solicitud_adopcion
    GROUP BY mes_orden, mes
    ORDER BY mes_orden
")->fetchAll(PDO::FETCH_ASSOC);

// Solicitudes resueltas por mes (todos)
$solicitudesResueltas = $dbh->query("
    SELECT DATE_FORMAT(fecha_resolucion, '%b %Y') as mes,
           DATE_FORMAT(fecha_resolucion, '%Y-%m') as mes_orden,
           COUNT(*) as total
    FROM bot_solicitud_adopcion
    WHERE fecha_resolucion IS NOT NULL
    GROUP BY mes_orden, mes
    ORDER BY mes_orden
")->fetchAll(PDO::FETCH_ASSOC);

// Solicitudes recibidas último año
$recibUltimoAnio = $dbh->query("
    SELECT DATE_FORMAT(fecha_registro, '%b %Y') as mes,
           DATE_FORMAT(fecha_registro, '%Y-%m') as mes_orden,
           COUNT(*) as total
    FROM bot_solicitud_adopcion
    WHERE fecha_registro >= DATE_SUB(NOW(), INTERVAL 1 YEAR)
    GROUP BY mes_orden, mes
    ORDER BY mes_orden
")->fetchAll(PDO::FETCH_ASSOC);

// Solicitudes resueltas último año
$resueltUltimoAnio = $dbh->query("
    SELECT DATE_FORMAT(fecha_resolucion, '%b %Y') as mes,
           DATE_FORMAT(fecha_resolucion, '%Y-%m') as mes_orden,
           COUNT(*) as total
    FROM bot_solicitud_adopcion
    WHERE fecha_resolucion IS NOT NULL
      AND fecha_resolucion >= DATE_SUB(NOW(), INTERVAL 1 YEAR)
    GROUP BY mes_orden, mes
    ORDER BY mes_orden
")->fetchAll(PDO::FETCH_ASSOC);

// Viabilidad promedio
$viabilidadPromedio = $dbh->query("
    SELECT ROUND(AVG(CAST(porcentaje_viabilidad AS UNSIGNED)), 1)
    FROM bot_solicitud_adopcion
")->fetchColumn();

// Adopciones completadas
$totalAdoptadas = $dbh->query("
    SELECT COUNT(*) FROM bot_solicitud_adopcion WHERE id_estado_adopcion = 3
")->fetchColumn();

// ── Preparar datos para JS ─────────────────────────────────────────────────
$especiesLabels = array_column($mascotasPorEspecie, 'nombre_especie');
$especiesData   = array_column($mascotasPorEspecie, 'total');

$solicEstadoLabels = array_column($solicitudesPorEstado, 'nombre_estado_adopcion');
$solicEstadoData   = array_column($solicitudesPorEstado, 'total');

$viabilidadLabels = array_column($viabilidadRangos, 'rango');
$viabilidadData   = array_column($viabilidadRangos, 'total');

// Todos — meses combinados
$mesesRecibidas = array_column($solicitudesRecibidas, 'total', 'mes');
$mesesResueltas = array_column($solicitudesResueltas, 'total', 'mes');
$todosLosMeses  = array_unique(array_merge(
    array_column($solicitudesRecibidas, 'mes'),
    array_column($solicitudesResueltas, 'mes')
));
$dataRecibidas = [];
$dataResueltas = [];
foreach ($todosLosMeses as $mes) {
    $dataRecibidas[] = $mesesRecibidas[$mes] ?? 0;
    $dataResueltas[] = $mesesResueltas[$mes] ?? 0;
}

// Último año — meses combinados
$mesesRecibUltimo   = array_column($recibUltimoAnio,   'total', 'mes');
$mesesResueltUltimo = array_column($resueltUltimoAnio, 'total', 'mes');
$mesesUltimoAnio    = array_unique(array_merge(
    array_column($recibUltimoAnio,   'mes'),
    array_column($resueltUltimoAnio, 'mes')
));
$dataRecibUltimo   = [];
$dataResueltUltimo = [];
foreach ($mesesUltimoAnio as $mes) {
    $dataRecibUltimo[]   = $mesesRecibUltimo[$mes]   ?? 0;
    $dataResueltUltimo[] = $mesesResueltUltimo[$mes] ?? 0;
}
?>

<style>
    .chart-desc {
        font-size: 12px;
        color: #6c757d;
        background-color: #f8f9fa;
        border-left: 3px solid #dee2e6;
        padding: 8px 12px;
        margin-top: 12px;
        border-radius: 0 4px 4px 0;
        line-height: 1.5;
    }

    .chart-desc i {
        color: #378ADD;
        margin-right: 4px;
    }
</style>

<div class="container-fluid py-4">

    <h2 class="text-center text-muted mb-3"><b>ESTADÍSTICAS Y DASHBOARD</b></h2>

    <!-- Filtro por período -->
    <div class="d-flex justify-content-center gap-2 mb-4 flex-wrap">
        <button class="btn btn-secondary btn-sm filtro-anio active" data-anio="todos">Todos</button>
        <button class="btn btn-outline-secondary btn-sm filtro-anio" data-anio="ultimo">Último año</button>
    </div>

    <!-- KPIs -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card text-center p-3">
                <p class="text-muted mb-1" style="font-size:13px;">Total mascotas en adopción</p>
                <h3 class="mb-0"><?= $totalMascotas ?></h3>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-center p-3">
                <p class="text-muted mb-1" style="font-size:13px;">Total solicitudes de adopción</p>
                <h3 class="mb-0"><?= $totalSolicitudes ?></h3>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-center p-3">
                <p class="text-muted mb-1" style="font-size:13px;">Adopciones completadas</p>
                <h3 class="mb-0"><?= $totalAdoptadas ?></h3>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card text-center p-3">
                <p class="text-muted mb-1" style="font-size:13px;">Viabilidad promedio</p>
                <h3 class="mb-0"><?= $viabilidadPromedio ?>%</h3>
            </div>
        </div>
    </div>

    <!-- Gráficas fila 1 -->
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <div class="card p-3">
                <p class="fw-bold mb-1">Solicitudes recibidas por mes</p>
                <p class="text-muted" style="font-size:12px;">histórico mensual</p>
                <div style="position:relative; height:250px;">
                    <canvas id="chartRecibidas"></canvas>
                </div>
                <div class="chart-desc">
                    <i class="fa fa-info-circle"></i>
                    Muestra cuántas solicitudes de adopción ingresaron cada mes. Los picos indican meses de alta demanda; las caídas pueden reflejar temporadas bajas o falta de difusión. Úsala para identificar los meses más activos y planificar campañas.
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <p class="fw-bold mb-1">Solicitudes resueltas por mes</p>
                <p class="text-muted" style="font-size:12px;">histórico mensual</p>
                <div style="position:relative; height:250px;">
                    <canvas id="chartResueltas"></canvas>
                </div>
                <div class="chart-desc">
                    <i class="fa fa-info-circle"></i>
                    Indica cuántas solicitudes fueron atendidas (aprobadas o rechazadas) cada mes. Si esta línea está muy por debajo de la de recibidas, hay solicitudes acumuladas sin resolver. Compárala con la gráfica anterior para medir la capacidad de respuesta.
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficas fila 2 -->
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="card p-3">
                <p class="fw-bold mb-1">Solicitudes por estado</p>
                <p class="text-muted" style="font-size:12px;">distribución actual</p>
                <div style="position:relative; height:280px;">
                    <canvas id="chartSolicEstado"></canvas>
                </div>
                <div class="chart-desc">
                    <i class="fa fa-info-circle"></i>
                    Muestra en qué estado se encuentra el total de solicitudes: en proceso, completadas o rechazadas. El porcentaje dentro de cada segmento indica su proporción. Un alto porcentaje "en proceso" puede significar que hay solicitudes pendientes de gestionar.
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card p-3">
                <p class="fw-bold mb-1">Viabilidad de adoptantes</p>
                <p class="text-muted" style="font-size:12px;">agrupada por rangos</p>
                <div style="position:relative; height:280px;">
                    <canvas id="chartViabilidad"></canvas>
                </div>
                <div class="chart-desc">
                    <i class="fa fa-info-circle"></i>
                    Clasifica a los solicitantes según el puntaje de viabilidad calculado por el sistema. Entre más solicitantes en los rangos "Alta" o "Muy alta", mejor es el perfil general de los adoptantes. Los rangos bajos indican perfiles que pueden requerir revisión adicional antes de aprobar.
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-2 shadow-sm" style="border-radius:10px;">
        <div class="card-body d-flex gap-2 justify-content-center">
            <a class="btn btn-success" href="inicio_admin.php">
                <i class="fa fa-arrow-left me-1"></i> Regresar
            </a>
            <button class="btn btn-primary" onclick="generarReporte()">
                <i class="fa fa-file-alt me-1"></i> Generar Reporte
            </button>
        </div>
    </div>

</div>

</section>

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.2.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script src="files/js/estadisticas_solicitudes.js"></script>
<script src="files/js/custom_menu.js"></script>

<script>
    const colores = ['#378ADD', '#1D9E75', '#E24B4A', '#EF9F27', '#7F77DD', '#D4537E', '#63991A'];

    // Datos todos
    const todosLosMeses = <?= json_encode(array_values($todosLosMeses)) ?>;
    const dataRecibidas = <?= json_encode($dataRecibidas) ?>;
    const dataResueltas = <?= json_encode($dataResueltas) ?>;

    // Datos último año
    const mesesUltimoAnio = <?= json_encode(array_values($mesesUltimoAnio)) ?>;
    const dataRecibUltimo = <?= json_encode($dataRecibUltimo) ?>;
    const dataResueltUltimo = <?= json_encode($dataResueltUltimo) ?>;

    // Gráfica solicitudes por estado — con porcentajes dentro de la torta
    new Chart(document.getElementById('chartSolicEstado'), {
        type: 'doughnut',
        data: {
            labels: <?= json_encode($solicEstadoLabels) ?>,
            datasets: [{
                data: <?= json_encode($solicEstadoData) ?>,
                backgroundColor: colores,
                borderWidth: 2,
                borderColor: '#fff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 16,
                        font: {
                            size: 12
                        }
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const pct = ((context.parsed / total) * 100).toFixed(1);
                            return ` ${context.label}: ${context.parsed} (${pct}%)`;
                        }
                    }
                },
                datalabels: {
                    color: '#fff',
                    font: {
                        weight: 'bold',
                        size: 13
                    },
                    formatter: function(value, context) {
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const pct = ((value / total) * 100).toFixed(1);
                        return pct >= 5 ? pct + '%' : '';
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // Gráfica viabilidad
    new Chart(document.getElementById('chartViabilidad'), {
        type: 'bar',
        data: {
            labels: <?= json_encode($viabilidadLabels) ?>,
            datasets: [{
                data: <?= json_encode($viabilidadData) ?>,
                backgroundColor: ['#E24B4A', '#EF9F27', '#378ADD', '#1D9E75'],
                borderRadius: 5,
                borderWidth: 0
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    display: false
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                },
                y: {
                    grid: {
                        display: false
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // Gráfica recibidas (filtrable)
    const chartRecibidas = new Chart(document.getElementById('chartRecibidas'), {
        type: 'line',
        data: {
            labels: todosLosMeses,
            datasets: [{
                label: 'Recibidas',
                data: dataRecibidas,
                borderColor: '#378ADD',
                backgroundColor: 'rgba(55,138,221,0.08)',
                fill: true,
                tension: 0.4,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // Gráfica resueltas (filtrable)
    const chartResueltas = new Chart(document.getElementById('chartResueltas'), {
        type: 'line',
        data: {
            labels: todosLosMeses,
            datasets: [{
                label: 'Resueltas',
                data: dataResueltas,
                borderColor: '#1D9E75',
                backgroundColor: 'rgba(29,158,117,0.08)',
                fill: true,
                tension: 0.4,
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                datalabels: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            }
        },
        plugins: [ChartDataLabels]
    });

    // Lógica de filtro
    document.querySelectorAll('.filtro-anio').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filtro-anio').forEach(b => {
                b.classList.remove('active', 'btn-secondary');
                b.classList.add('btn-outline-secondary');
            });
            this.classList.add('active', 'btn-secondary');
            this.classList.remove('btn-outline-secondary');

            const opcion = this.dataset.anio;
            let labels, recibidas, resueltas;

            if (opcion === 'todos') {
                labels = todosLosMeses;
                recibidas = dataRecibidas;
                resueltas = dataResueltas;
            } else {
                labels = mesesUltimoAnio;
                recibidas = dataRecibUltimo;
                resueltas = dataResueltUltimo;
            }

            chartRecibidas.data.labels = labels;
            chartRecibidas.data.datasets[0].data = recibidas;
            chartRecibidas.update();

            chartResueltas.data.labels = labels;
            chartResueltas.data.datasets[0].data = resueltas;
            chartResueltas.update();
        });
    });
</script>

</body>

</html>