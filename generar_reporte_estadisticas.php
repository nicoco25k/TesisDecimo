<?php
require_once('tcpdf/tcpdf.php');
include_once("bd/Conexion.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

// ─── Constantes de diseño (misma paleta que reporte de mascotas) ──────────────
define('C_PRIMARIO',   [15,  40,  80]);
define('C_SECUNDARIO', [30,  80, 160]);
define('C_ACENTO',     [255, 180,  0]);
define('C_FONDO',      [240, 245, 255]);
define('C_TEXTO',      [35,  35,  45]);
define('C_BLANCO',     [255, 255, 255]);
define('LOGO_PATH',    'files/img/asa.jpg');
define('LOGO_PATH2',   'files/img/report.jpg');

// ─── Colores para gráficas de barras ─────────────────────────────────────────
$PALETA = [
    [55,  138, 221],  // azul
    [29,  158, 117],  // verde
    [226,  75,  74],  // rojo
    [239, 159,  39],  // naranja
    [127, 119, 221],  // violeta
    [212,  83, 126],  // rosa
    [99,  153,  26],  // verde oliva
];

// ─── Clase PDF ────────────────────────────────────────────────────────────────
class MYPDF extends TCPDF
{
    public function Header()
    {
        $this->SetFillColor(...C_PRIMARIO);
        $this->Rect(0, 0, 210, 24, 'F');

        $this->SetFillColor(...C_ACENTO);
        $this->Rect(0, 24, 210, 1.5, 'F');

        if (file_exists(LOGO_PATH2)) {
            $this->Image(LOGO_PATH2, 6, 2, 20, 20, '', '', '', false, 300);
        }

        $this->SetTextColor(...C_BLANCO);
        $this->SetFont('helvetica', 'B', 12);
        $this->SetXY(30, 5);
        $this->Cell(100, 7, 'ASOPATICAS', 0, 0, 'L');

        $this->SetFont('helvetica', '', 8);
        $this->SetXY(30, 13);
        $this->Cell(100, 5, 'Asociación Protectora De Animales Paticas', 0, 0, 'L');

        $this->SetFont('helvetica', 'I', 8);
        $this->SetTextColor(200, 215, 255);
        $this->SetXY(110, 9);
        $this->Cell(90, 6, 'Reporte de Estadísticas y Dashboard', 0, 0, 'R');

        $this->SetTextColor(...C_TEXTO);
    }

    public function Footer()
    {
        $this->SetDrawColor(...C_ACENTO);
        $this->SetLineWidth(0.6);
        $this->Line(15, 282, 195, 282);

        if (file_exists(LOGO_PATH)) {
            $this->Image(LOGO_PATH, 15, 284, 8, 8, '', '', '', false, 300);
        }

        $this->SetFont('helvetica', 'I', 7.5);
        $this->SetTextColor(120, 120, 140);
        $this->SetXY(26, 284);
        $this->Cell(0, 4, 'ASOPATICAS  •  ' . date('d/m/Y'), 0, 1, 'L');

        $this->SetXY(0, 284);
        $this->Cell(
            195,
            8,
            'Página ' . $this->getAliasNumPage() . ' / ' . $this->getAliasNbPages(),
            0,
            0,
            'R'
        );
    }
}

// ─── Funciones auxiliares de dibujo ──────────────────────────────────────────

/**
 * Dibuja una barra horizontal proporcional al valor máximo.
 * Retorna la Y final después de dibujar la fila.
 */
function drawBarRow(MYPDF $pdf, $x, $y, $totalW, $label, $value, $maxValue, $color, $rowH = 8, $barMaxW = 90)
{
    // Fondo de fila
    $pdf->SetFillColor(248, 250, 255);
    $pdf->Rect($x, $y, $totalW, $rowH, 'F');

    // Separador horizontal tenue
    $pdf->SetDrawColor(220, 228, 245);
    $pdf->SetLineWidth(0.2);
    $pdf->Line($x, $y + $rowH, $x + $totalW, $y + $rowH);

    // Etiqueta
    $pdf->SetFont('helvetica', '', 9);
    $pdf->SetTextColor(...C_TEXTO);
    $pdf->SetXY($x + 2, $y + 1.5);
    $pdf->Cell($totalW - $barMaxW - 18, $rowH - 3, $label, 0, 0, 'L');

    // Barra
    $barW = $maxValue > 0 ? ($value / $maxValue) * $barMaxW : 0;
    $barX = $x + $totalW - $barMaxW - 14;
    $barY = $y + 1.8;
    $barH = $rowH - 3.6;

    // Fondo gris de la barra
    $pdf->SetFillColor(220, 228, 245);
    $pdf->RoundedRect($barX, $barY, $barMaxW, $barH, 1.5, '1111', 'F');

    // Barra coloreada
    if ($barW > 0) {
        $pdf->SetFillColor(...$color);
        $pdf->RoundedRect($barX, $barY, $barW, $barH, 1.5, '1111', 'F');
    }

    // Valor numérico
    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->SetTextColor(...C_PRIMARIO);
    $pdf->SetXY($barX + $barMaxW + 2, $y + 1.5);
    $pdf->Cell(12, $rowH - 3, $value, 0, 0, 'R');

    return $y + $rowH;
}

/**
 * Encabezado de sección reutilizable.
 */
function sectionHeader(MYPDF $pdf, $y, $titulo, $subtitulo = '')
{
    $pdf->SetFillColor(...C_PRIMARIO);
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->SetXY(15, $y);
    $pdf->Cell(180, 9, '  ' . $titulo, 0, 1, 'L', true);

    $pdf->SetFillColor(...C_ACENTO);
    $pdf->Rect(15, $y + 9, 180, 0.8, 'F');

    if ($subtitulo) {
        $pdf->SetFont('helvetica', 'I', 8);
        $pdf->SetTextColor(100, 120, 160);
        $pdf->SetXY(15, $y + 11);
        $pdf->Cell(180, 5, $subtitulo, 0, 1, 'L');
        return $y + 17;
    }
    return $y + 11;
}

// ─── Consultas ────────────────────────────────────────────────────────────────

$totalMascotas = $dbh->query(
    "SELECT COUNT(*) FROM tabla_mascotas WHERE id_estado_adopcion_mascota = '1'"
)->fetchColumn();

$totalSolicitudes = $dbh->query(
    "SELECT COUNT(*) FROM bot_solicitud_adopcion WHERE id_estado_adopcion = '1'"
)->fetchColumn();

$totalAdoptadas = $dbh->query(
    "SELECT COUNT(*) FROM bot_solicitud_adopcion WHERE id_estado_adopcion = 3"
)->fetchColumn();

$viabilidadPromedio = $dbh->query(
    "SELECT ROUND(AVG(CAST(porcentaje_viabilidad AS UNSIGNED)), 1)
     FROM bot_solicitud_adopcion"
)->fetchColumn();

$mascotasPorEspecie = $dbh->query("
    SELECT nombre_especie, COUNT(*) as total
    FROM tabla_mascotas tm
    JOIN mascota_especie m4 ON tm.id_especie_mascota = m4.id_especie_mascota
    GROUP BY nombre_especie
    ORDER BY total DESC
")->fetchAll(PDO::FETCH_ASSOC);

$solicitudesPorEstado = $dbh->query("
    SELECT nombre_estado_adopcion, COUNT(*) as total
    FROM bot_solicitud_adopcion bs
    JOIN bot_estado_adopcion be ON bs.id_estado_adopcion = be.id_estado_adopcion
    GROUP BY nombre_estado_adopcion
    ORDER BY total DESC
")->fetchAll(PDO::FETCH_ASSOC);

$viabilidadRangos = $dbh->query("
    SELECT 
        CASE 
            WHEN CAST(porcentaje_viabilidad AS UNSIGNED) BETWEEN 0  AND 40  THEN 'Baja (0–40%)'
            WHEN CAST(porcentaje_viabilidad AS UNSIGNED) BETWEEN 41 AND 60  THEN 'Media (41–60%)'
            WHEN CAST(porcentaje_viabilidad AS UNSIGNED) BETWEEN 61 AND 80  THEN 'Alta (61–80%)'
            ELSE 'Muy alta (81–100%)'
        END as rango,
        COUNT(*) as total
    FROM bot_solicitud_adopcion
    GROUP BY rango
    ORDER BY MIN(CAST(porcentaje_viabilidad AS UNSIGNED))
")->fetchAll(PDO::FETCH_ASSOC);

$solicitudesRecibidas = $dbh->query("
    SELECT DATE_FORMAT(fecha_registro,  '%b %Y') as mes,
           DATE_FORMAT(fecha_registro,  '%Y-%m') as mes_orden,
           COUNT(*) as total
    FROM bot_solicitud_adopcion
    GROUP BY mes_orden, mes
    ORDER BY mes_orden
")->fetchAll(PDO::FETCH_ASSOC);

$solicitudesResueltas = $dbh->query("
    SELECT DATE_FORMAT(fecha_resolucion, '%b %Y') as mes,
           DATE_FORMAT(fecha_resolucion, '%Y-%m') as mes_orden,
           COUNT(*) as total
    FROM bot_solicitud_adopcion
    WHERE fecha_resolucion IS NOT NULL
    GROUP BY mes_orden, mes
    ORDER BY mes_orden
")->fetchAll(PDO::FETCH_ASSOC);

// ─── Instancia PDF ────────────────────────────────────────────────────────────
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('Sistema de Adopción ASOPATICAS');
$pdf->SetAuthor('ASOPATICAS');
$pdf->SetTitle('Reporte de Estadísticas y Dashboard');
$pdf->SetMargins(15, 30, 15);
$pdf->SetAutoPageBreak(true, 22);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// ═══════════════════════════════════════════════════════════════════════════════
// PORTADA
// ═══════════════════════════════════════════════════════════════════════════════
$pdf->AddPage();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->SetFillColor(...C_PRIMARIO);
$pdf->Rect(0, 0, 210, 297, 'F');

$pdf->SetFillColor(...C_ACENTO);
$pdf->Rect(0, 135, 210, 3, 'F');
$pdf->Rect(0, 145, 210, 0.8, 'F');

$pdf->SetFillColor(...C_SECUNDARIO);
$pdf->Rect(0, 148, 210, 50, 'F');

if (file_exists(LOGO_PATH2)) {
    $pdf->Image(LOGO_PATH2, 80, 35, 52, 52, '', '', '', false, 300);
} else {
    $pdf->SetFillColor(...C_SECUNDARIO);
    $pdf->Ellipse(105, 61, 26, 26, 0, 0, 360, 'F');
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 18);
    $pdf->SetXY(80, 52);
    $pdf->Cell(52, 18, 'ASP', 0, 0, 'C');
}

$pdf->SetTextColor(...C_BLANCO);
$pdf->SetFont('helvetica', 'B', 30);
$pdf->SetXY(0, 96);
$pdf->Cell(210, 14, 'ASOPATICAS', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 12);
$pdf->SetXY(0, 112);
$pdf->SetTextColor(180, 205, 255);
$pdf->Cell(210, 7, 'Asociación Protectora De Animales Paticas', 0, 1, 'C');

$pdf->SetDrawColor(255, 255, 255);
$pdf->SetLineWidth(0.4);
$pdf->Line(70, 128, 140, 128);

$pdf->SetTextColor(...C_BLANCO);
$pdf->SetFont('helvetica', 'B', 17);
$pdf->SetXY(25, 152);
$pdf->Cell(160, 10, 'REPORTE DE ESTADÍSTICAS Y DASHBOARD', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(210, 230, 255);
$pdf->SetXY(25, 163);
$pdf->Cell(160, 7, 'Resumen ejecutivo de adopciones y solicitudes', 0, 1, 'C');

$pdf->SetFillColor(...C_ACENTO);
$pdf->RoundedRect(72, 212, 66, 10, 3, '1111', 'F');
$pdf->SetTextColor(30, 30, 30);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY(72, 214);
$pdf->Cell(66, 6, 'Generado el ' . date('d/m/Y'), 0, 0, 'C');

$pdf->SetTextColor(100, 130, 180);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->SetXY(0, 278);
$pdf->Cell(210, 6, 'Documento de uso interno — ASOPATICAS', 0, 1, 'C');

$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// ═══════════════════════════════════════════════════════════════════════════════
// PÁGINA 1 — KPIs + Mascotas por especie + Solicitudes por estado
// ═══════════════════════════════════════════════════════════════════════════════
$pdf->AddPage();
$y = 33;

// ── KPI Cards ─────────────────────────────────────────────────────────────────
$kpis = [
    ['Mascotas en adopción',     $totalMascotas,      [55, 138, 221]],
    ['Solicitudes activas',      $totalSolicitudes,   [29, 158, 117]],
    ['Adopciones completadas',   $totalAdoptadas,     [226,  75,  74]],
    ['Viabilidad promedio',      $viabilidadPromedio . '%', [239, 159,  39]],
];

$kpiW = 42;
$kpiH = 22;
$kpiGap = 2;
$kpiStartX = 15;

foreach ($kpis as $i => $kpi) {
    $kx = $kpiStartX + $i * ($kpiW + $kpiGap);

    // Sombra
    $pdf->SetFillColor(210, 220, 240);
    $pdf->RoundedRect($kx + 1, $y + 1, $kpiW, $kpiH, 3, '1111', 'F');

    // Fondo blanco
    $pdf->SetFillColor(...C_BLANCO);
    $pdf->SetDrawColor(...$kpi[2]);
    $pdf->SetLineWidth(0.5);
    $pdf->RoundedRect($kx, $y, $kpiW, $kpiH, 3, '1111', 'DF');

    // Barra de color en la parte superior
    $pdf->SetFillColor(...$kpi[2]);
    $pdf->RoundedRect($kx, $y, $kpiW, 3.5, 3, '1100', 'F');
    $pdf->Rect($kx, $y + 1.5, $kpiW, 2, 'F');

    // Etiqueta
    $pdf->SetFont('helvetica', '', 7.5);
    $pdf->SetTextColor(100, 110, 130);
    $pdf->SetXY($kx + 1, $y + 5);
    $pdf->MultiCell($kpiW - 2, 4, $kpi[0], 0, 'C', false, 1);

    // Valor
    $pdf->SetFont('helvetica', 'B', 16);
    $pdf->SetTextColor(...$kpi[2]);
    $pdf->SetXY($kx + 1, $y + 12);
    $pdf->Cell($kpiW - 2, 8, $kpi[1], 0, 0, 'C');
}

$y += $kpiH + 8;

// ── Mascotas por especie ───────────────────────────────────────────────────────
$y = sectionHeader($pdf, $y, 'Mascotas registradas en total por especie', 'Cantidad de animales agrupados por tipo');

$maxEspecie = !empty($mascotasPorEspecie) ? max(array_column($mascotasPorEspecie, 'total')) : 1;
foreach ($mascotasPorEspecie as $i => $row) {
    $color = $PALETA[$i % count($PALETA)];
    $y = drawBarRow($pdf, 15, $y, 180, $row['nombre_especie'], (int)$row['total'], $maxEspecie, $color);
}

// Borde exterior
$pdf->SetDrawColor(...C_SECUNDARIO);
$pdf->SetLineWidth(0.4);
$totalEspecieH = count($mascotasPorEspecie) * 8;
// (el borde lo dan las líneas internas de drawBarRow)

$y += 8;

// ── Solicitudes por estado ─────────────────────────────────────────────────────
$y = sectionHeader($pdf, $y, 'Solicitudes de adopción por estado', 'Distribución actual de todas las solicitudes');

$maxEstado = !empty($solicitudesPorEstado) ? max(array_column($solicitudesPorEstado, 'total')) : 1;
$totalSolicAll = array_sum(array_column($solicitudesPorEstado, 'total'));

foreach ($solicitudesPorEstado as $i => $row) {
    $color = $PALETA[$i % count($PALETA)];
    $pct   = $totalSolicAll > 0 ? round(($row['total'] / $totalSolicAll) * 100, 1) : 0;
    $label = $row['nombre_estado_adopcion'] . '  (' . $pct . '%)';
    $y = drawBarRow($pdf, 15, $y, 180, $label, (int)$row['total'], $maxEstado, $color);
}

$y += 8;

// ── Nota descriptiva ──────────────────────────────────────────────────────────
$pdf->SetFillColor(248, 250, 255);
$pdf->SetDrawColor(200, 215, 240);
$pdf->SetLineWidth(0.3);
$pdf->RoundedRect(15, $y, 180, 14, 2, '1111', 'DF');

$pdf->SetFont('helvetica', 'I', 8);
$pdf->SetTextColor(100, 115, 145);
$pdf->SetXY(18, $y + 3);
$pdf->MultiCell(
    174,
    4.5,
    'Un alto porcentaje de solicitudes "en proceso" puede indicar casos pendientes de gestión. ' .
        'Se recomienda revisar solicitudes con más de 30 días sin resolución.',
    0,
    'L'
);

// ═══════════════════════════════════════════════════════════════════════════════
// PÁGINA 2 — Viabilidad + Histórico mensual recibidas + resueltas
// ═══════════════════════════════════════════════════════════════════════════════
$pdf->AddPage();
$y = 33;

// ── Viabilidad por rangos ──────────────────────────────────────────────────────
$y = sectionHeader($pdf, $y, 'Viabilidad de adoptantes por rango', 'Clasificación según el puntaje calculado por el sistema');

$coloresViabilidad = [
    [226,  75,  74],   // Baja    — rojo
    [239, 159,  39],   // Media   — naranja
    [55,  138, 221],   // Alta    — azul
    [29,  158, 117],   // Muy alta — verde
];

$maxViab = !empty($viabilidadRangos) ? max(array_column($viabilidadRangos, 'total')) : 1;
$totalViab = array_sum(array_column($viabilidadRangos, 'total'));

foreach ($viabilidadRangos as $i => $row) {
    $color = $coloresViabilidad[$i % 4];
    $pct   = $totalViab > 0 ? round(($row['total'] / $totalViab) * 100, 1) : 0;
    $label = $row['rango'] . '  (' . $pct . '%)';
    $y = drawBarRow($pdf, 15, $y, 180, $label, (int)$row['total'], $maxViab, $color, 9);
}

// Nota interpretativa
$y += 5;
$pdf->SetFillColor(240, 255, 248);
$pdf->SetDrawColor(29, 158, 117);
$pdf->SetLineWidth(0.3);
$pdf->RoundedRect(15, $y, 180, 14, 2, '1111', 'DF');
$pdf->SetFont('helvetica', 'I', 8);
$pdf->SetTextColor(30, 100, 70);
$pdf->SetXY(18, $y + 3);
$pdf->MultiCell(
    174,
    4.5,
    'Entre más solicitantes en "Alta" o "Muy alta", mejor es el perfil general de los adoptantes. ' .
        'Los rangos bajos pueden requerir revisión adicional antes de aprobar la solicitud.',
    0,
    'L'
);

$y += 20;

// ── Histórico mensual: Recibidas ───────────────────────────────────────────────
$y = sectionHeader($pdf, $y, 'Solicitudes recibidas por mes', 'Histórico completo de solicitudes ingresadas al sistema');

if (!empty($solicitudesRecibidas)) {
    $maxRecib = max(array_column($solicitudesRecibidas, 'total'));
    foreach ($solicitudesRecibidas as $i => $row) {
        $y = drawBarRow(
            $pdf,
            15,
            $y,
            180,
            $row['mes'],
            (int)$row['total'],
            $maxRecib,
            [55, 138, 221],
            8,
            100
        );
    }
}

$y += 8;

// ── Histórico mensual: Resueltas ───────────────────────────────────────────────
$y = sectionHeader($pdf, $y, 'Solicitudes resueltas por mes', 'Solicitudes atendidas (aprobadas o rechazadas) por mes');

if (!empty($solicitudesResueltas)) {
    $maxResuel = max(array_column($solicitudesResueltas, 'total'));
    foreach ($solicitudesResueltas as $i => $row) {
        $y = drawBarRow(
            $pdf,
            15,
            $y,
            180,
            $row['mes'],
            (int)$row['total'],
            $maxResuel,
            [29, 158, 117],
            8,
            100
        );
    }
}

$y += 8;

// ── Nota comparativa ─────────────────────────────────────────────────────────
$pdf->SetFillColor(255, 248, 235);
$pdf->SetDrawColor(239, 159, 39);
$pdf->SetLineWidth(0.3);
$pdf->RoundedRect(15, $y, 180, 14, 2, '1111', 'DF');
$pdf->SetFont('helvetica', 'I', 8);
$pdf->SetTextColor(120, 80, 20);
$pdf->SetXY(18, $y + 3);
$pdf->MultiCell(
    174,
    4.5,
    'Si las solicitudes resueltas son consistentemente menores a las recibidas, existe un acumulado sin gestionar. ' .
        'Se recomienda comparar ambas métricas para evaluar la capacidad de respuesta del equipo.',
    0,
    'L'
);

// ═══════════════════════════════════════════════════════════════════════════════
// DESCARGAR
// ═══════════════════════════════════════════════════════════════════════════════
$pdf->Output('reporte_estadisticas_asopaticas.pdf', 'D');
