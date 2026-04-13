<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>
<?php include_once("bd/Conexion.php"); ?>

<?php

// ===================== KPIs =====================

// Total usuarios
$totalUsuarios = $dbh->query("SELECT COUNT(*) FROM tabla_usuarios")->fetchColumn();

// Total mensajes
$totalMensajes = $dbh->query("SELECT COUNT(*) FROM tabla_de_mensajes")->fetchColumn();

// Usuarios activos
$usuariosActivos = $dbh->query("
    SELECT COUNT(*) FROM tabla_usuarios 
    WHERE id_estado_usuario = 1
")->fetchColumn();

// Usuarios registrados este mes
$usuariosMesActual = $dbh->query("
    SELECT COUNT(*) FROM tabla_usuarios 
    WHERE MONTH(fecha_creacion) = MONTH(CURRENT_DATE())
    AND YEAR(fecha_creacion) = YEAR(CURRENT_DATE())
")->fetchColumn();


// ===================== GRÁFICAS =====================

// Usuarios por mes
$usuariosPorMes = $dbh->query("
    SELECT DATE_FORMAT(fecha_creacion, '%b %Y') as mes,
           DATE_FORMAT(fecha_creacion, '%Y-%m') as mes_orden,
           COUNT(*) as total
    FROM tabla_usuarios
    GROUP BY mes_orden, mes
    ORDER BY mes_orden
")->fetchAll(PDO::FETCH_ASSOC);

// Mensajes por mes
$mensajesPorMes = $dbh->query("
    SELECT DATE_FORMAT(fecha_registro, '%b %Y') as mes,
           DATE_FORMAT(fecha_registro, '%Y-%m') as mes_orden,
           COUNT(*) as total
    FROM tabla_de_mensajes
    GROUP BY mes_orden, mes
    ORDER BY mes_orden
")->fetchAll(PDO::FETCH_ASSOC);

// Preparar datos
$usuariosMeses = array_column($usuariosPorMes, 'mes');
$usuariosData  = array_column($usuariosPorMes, 'total');

$mensajesMeses = array_column($mensajesPorMes, 'mes');
$mensajesData  = array_column($mensajesPorMes, 'total');

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
    }
</style>

<div class="container-fluid py-4">

    <h2 class="text-center text-muted mb-4"><b>DASHBOARD GENERAL</b></h2>

    <!-- ===================== KPIs ===================== -->
    <div class="row g-3 mb-4">

        <div class="col-6 col-md-3">
            <div class="card text-center p-3">
                <p class="text-muted mb-1" style="font-size:13px;">Usuarios registrados</p>
                <h3 class="mb-0"><?= $totalUsuarios ?></h3>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card text-center p-3">
                <p class="text-muted mb-1" style="font-size:13px;">Mensajes recibidos</p>
                <h3 class="mb-0"><?= $totalMensajes ?></h3>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card text-center p-3">
                <p class="text-muted mb-1" style="font-size:13px;">Usuarios activos</p>
                <h3 class="mb-0"><?= $usuariosActivos ?></h3>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card text-center p-3">
                <p class="text-muted mb-1" style="font-size:13px;">Registros este mes</p>
                <h3 class="mb-0"><?= $usuariosMesActual ?></h3>
            </div>
        </div>

    </div>

    <!-- ===================== GRÁFICAS ===================== -->
    <div class="row g-3">

        <!-- Usuarios -->
        <div class="col-md-6">
            <div class="card p-3">
                <p class="fw-bold mb-1">Usuarios registrados por mes</p>
                <div style="height:250px;">
                    <canvas id="chartUsuarios"></canvas>
                </div>
                <div class="chart-desc">
                    Muestra el crecimiento mensual de usuarios en la plataforma.
                </div>
            </div>
        </div>

        <!-- Mensajes -->
        <div class="col-md-6">
            <div class="card p-3">
                <p class="fw-bold mb-1">Mensajes enviados por mes</p>
                <div style="height:250px;">
                    <canvas id="chartMensajes"></canvas>
                </div>
                <div class="chart-desc">
                    Indica el nivel de interacción de los usuarios.
                </div>
            </div>
        </div>

    </div>

    <div class="card mt-2 shadow-sm" style="border-radius:10px;">
        <div class="card-body d-flex gap-2 justify-content-center">
            <a class="btn btn-success" href="inicio_admin.php">
                <i class="fa fa-arrow-left me-1"></i> Regresar
            </a>
            <button class="btn btn-primary" onclick="generarReporte_estats()">
                <i class="fa fa-file-alt me-1"></i> Generar Reporte
            </button>
        </div>
    </div>

</div>

<!-- LIBRERÍAS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script src="files/js/custom_menu.js"></script>

<script>
    function generarReporte_estats() {
        window.location.href = "generar_reporte_estadisticas_usu_msj.php";
    }

    // ===================== DATOS =====================
    const usuariosMeses = <?= json_encode($usuariosMeses) ?>;
    const usuariosData = <?= json_encode($usuariosData) ?>;

    const mensajesMeses = <?= json_encode($mensajesMeses) ?>;
    const mensajesData = <?= json_encode($mensajesData) ?>;


    // ===================== GRÁFICA USUARIOS =====================
    new Chart(document.getElementById('chartUsuarios'), {
        type: 'line',
        data: {
            labels: usuariosMeses,
            datasets: [{
                data: usuariosData,
                borderColor: '#7F77DD',
                backgroundColor: 'rgba(127,119,221,0.1)',
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
                    beginAtZero: true
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


    // ===================== GRÁFICA MENSAJES =====================
    new Chart(document.getElementById('chartMensajes'), {
        type: 'bar',
        data: {
            labels: mensajesMeses,
            datasets: [{
                data: mensajesData,
                backgroundColor: '#378ADD',
                borderRadius: 6
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
                    beginAtZero: true
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
</script>

</body>

</html>