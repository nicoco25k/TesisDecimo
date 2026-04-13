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

// ─── Paleta de colores para barras ───────────────────────────────────────────
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
        $this->Cell(90, 6, 'Reporte de Usuarios y Mensajes', 0, 0, 'R');

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

function drawBarRow(MYPDF $pdf, $x, $y, $totalW, $label, $value, $maxValue, $color, $rowH = 8, $barMaxW = 90)
{
    $pdf->SetFillColor(248, 250, 255);
    $pdf->Rect($x, $y, $totalW, $rowH, 'F');

    $pdf->SetDrawColor(220, 228, 245);
    $pdf->SetLineWidth(0.2);
    $pdf->Line($x, $y + $rowH, $x + $totalW, $y + $rowH);

    $pdf->SetFont('helvetica', '', 9);
    $pdf->SetTextColor(...C_TEXTO);
    $pdf->SetXY($x + 2, $y + 1.5);
    $pdf->Cell($totalW - $barMaxW - 18, $rowH - 3, $label, 0, 0, 'L');

    $barW = $maxValue > 0 ? ($value / $maxValue) * $barMaxW : 0;
    $barX = $x + $totalW - $barMaxW - 14;
    $barY = $y + 1.8;
    $barH = $rowH - 3.6;

    $pdf->SetFillColor(220, 228, 245);
    $pdf->RoundedRect($barX, $barY, $barMaxW, $barH, 1.5, '1111', 'F');

    if ($barW > 0) {
        $pdf->SetFillColor(...$color);
        $pdf->RoundedRect($barX, $barY, $barW, $barH, 1.5, '1111', 'F');
    }

    $pdf->SetFont('helvetica', 'B', 9);
    $pdf->SetTextColor(...C_PRIMARIO);
    $pdf->SetXY($barX + $barMaxW + 2, $y + 1.5);
    $pdf->Cell(12, $rowH - 3, $value, 0, 0, 'R');

    return $y + $rowH;
}

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

// KPIs
$totalUsuarios = $dbh->query(
    "SELECT COUNT(*) FROM tabla_usuarios"
)->fetchColumn();

$totalMensajes = $dbh->query(
    "SELECT COUNT(*) FROM tabla_de_mensajes"
)->fetchColumn();

$usuariosActivos = $dbh->query(
    "SELECT COUNT(*) FROM tabla_usuarios WHERE id_estado_usuario = 1"
)->fetchColumn();

$usuariosMesActual = $dbh->query("
    SELECT COUNT(*) FROM tabla_usuarios
    WHERE MONTH(fecha_creacion) = MONTH(CURRENT_DATE())
    AND YEAR(fecha_creacion) = YEAR(CURRENT_DATE())
")->fetchColumn();

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

// Usuarios por estado
$usuariosPorEstado = $dbh->query("
    SELECT 
        CASE id_estado_usuario 
            WHEN 1 THEN 'Activo'
            WHEN 2 THEN 'Inactivo'
            ELSE 'Otro'
        END as estado,
        COUNT(*) as total
    FROM tabla_usuarios
    GROUP BY id_estado_usuario
    ORDER BY total DESC
")->fetchAll(PDO::FETCH_ASSOC);

// Top 5 usuarios con más mensajes (basado en nombre_usuario_mensaje)
$topUsuariosMensajes = $dbh->query("
    SELECT nombre_usuario_mensaje as nombre_usuario, COUNT(*) as total
    FROM tabla_de_mensajes
    GROUP BY nombre_usuario_mensaje
    ORDER BY total DESC
    LIMIT 5
")->fetchAll(PDO::FETCH_ASSOC);

// Promedio de mensajes por usuario (total mensajes / total usuarios)
$promMensajesUsuario = $dbh->query("
    SELECT ROUND(
        (SELECT COUNT(*) FROM tabla_de_mensajes) / 
        NULLIF((SELECT COUNT(*) FROM tabla_usuarios), 0)
    , 1)
")->fetchColumn();

// ─── Instancia PDF ────────────────────────────────────────────────────────────
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('Sistema ASOPATICAS');
$pdf->SetAuthor('ASOPATICAS');
$pdf->SetTitle('Reporte de Estadísticas de Usuarios y Mensajes');
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
$pdf->Cell(160, 10, 'REPORTE DE USUARIOS Y MENSAJES', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(210, 230, 255);
$pdf->SetXY(25, 163);
$pdf->Cell(160, 7, 'Estadísticas de actividad e interacción de la plataforma', 0, 1, 'C');

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
// PÁGINA 1 — KPIs + Usuarios por mes + Mensajes por mes
// ═══════════════════════════════════════════════════════════════════════════════
$pdf->AddPage();
$y = 33;

// ── KPI Cards ─────────────────────────────────────────────────────────────────
$kpis = [
    ['Usuarios registrados',   $totalUsuarios,              [55, 138, 221]],
    ['Mensajes recibidos',     $totalMensajes,              [29, 158, 117]],
    ['Usuarios activos',       $usuariosActivos,            [226,  75,  74]],
    ['Registros este mes',     $usuariosMesActual,          [239, 159,  39]],
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

    // Barra de color superior
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

// ── Usuarios registrados por mes ──────────────────────────────────────────────
$y = sectionHeader($pdf, $y, 'Usuarios registrados por mes', 'Crecimiento mensual de la base de usuarios en la plataforma');

if (!empty($usuariosPorMes)) {
    $maxUsu = max(array_column($usuariosPorMes, 'total'));
    foreach ($usuariosPorMes as $i => $row) {
        $color = $PALETA[$i % count($PALETA)];
        $y = drawBarRow($pdf, 15, $y, 180, $row['mes'], (int)$row['total'], $maxUsu, [127, 119, 221], 8, 100);
    }
}

$y += 8;

// ── Mensajes enviados por mes ─────────────────────────────────────────────────
$y = sectionHeader($pdf, $y, 'Mensajes recibidos por mes', 'Nivel de interacción mensual de los usuarios en la plataforma');

if (!empty($mensajesPorMes)) {
    $maxMsj = max(array_column($mensajesPorMes, 'total'));
    foreach ($mensajesPorMes as $i => $row) {
        $y = drawBarRow($pdf, 15, $y, 180, $row['mes'], (int)$row['total'], $maxMsj, [55, 138, 221], 8, 100);
    }
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
    'Un aumento sostenido en mensajes mensuales indica mayor participación de los usuarios. ' .
        'Se recomienda comparar con los registros del período anterior para evaluar tendencias de crecimiento.',
    0,
    'L'
);

// ═══════════════════════════════════════════════════════════════════════════════
// PÁGINA 2 — Usuarios por estado + Top usuarios + Promedio mensajes
// ═══════════════════════════════════════════════════════════════════════════════
$pdf->AddPage();
$y = 33;

// ── Usuarios por estado ───────────────────────────────────────────────────────
$y = sectionHeader($pdf, $y, 'Usuarios por estado', 'Distribución de usuarios activos e inactivos en el sistema');

$coloresEstado = [
    [29,  158, 117],   // Activo   — verde
    [226,  75,  74],   // Inactivo — rojo
    [239, 159,  39],   // Otro     — naranja
];

$maxEstado  = !empty($usuariosPorEstado) ? max(array_column($usuariosPorEstado, 'total')) : 1;
$totalEstado = array_sum(array_column($usuariosPorEstado, 'total'));

foreach ($usuariosPorEstado as $i => $row) {
    $color = $coloresEstado[$i % count($coloresEstado)];
    $pct   = $totalEstado > 0 ? round(($row['total'] / $totalEstado) * 100, 1) : 0;
    $label = $row['estado'] . '  (' . $pct . '%)';
    $y = drawBarRow($pdf, 15, $y, 180, $label, (int)$row['total'], $maxEstado, $color, 9);
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
    'Un alto porcentaje de usuarios activos refleja buena retención en la plataforma. ' .
        'Los usuarios inactivos pueden ser contactados para incentivar su reactivación.',
    0,
    'L'
);

$y += 20;

// ── Top 5 usuarios con más mensajes ──────────────────────────────────────────
$y = sectionHeader($pdf, $y, 'Top 5 usuarios con más mensajes', 'Usuarios con mayor nivel de interacción en la plataforma');

if (!empty($topUsuariosMensajes)) {
    $maxTop = max(array_column($topUsuariosMensajes, 'total'));
    foreach ($topUsuariosMensajes as $i => $row) {
        $color = $PALETA[$i % count($PALETA)];
        $y = drawBarRow($pdf, 15, $y, 180, $row['nombre_usuario'], (int)$row['total'], $maxTop, $color, 9, 100);
    }
}

$y += 8;

// ── Indicador: promedio de mensajes por usuario ───────────────────────────────
$pdf->SetFillColor(240, 245, 255);
$pdf->SetDrawColor(...C_SECUNDARIO);
$pdf->SetLineWidth(0.4);
$pdf->RoundedRect(15, $y, 180, 22, 3, '1111', 'DF');

$pdf->SetFillColor(...C_SECUNDARIO);
$pdf->RoundedRect(15, $y, 6, 22, 3, '1000', 'F');
$pdf->Rect(18, $y, 3, 22, 'F');

$pdf->SetFont('helvetica', 'B', 10);
$pdf->SetTextColor(...C_PRIMARIO);
$pdf->SetXY(24, $y + 4);
$pdf->Cell(100, 6, 'Promedio de mensajes por usuario', 0, 1, 'L');

$pdf->SetFont('helvetica', 'B', 20);
$pdf->SetTextColor(...C_SECUNDARIO);
$pdf->SetXY(24, $y + 10);
$pdf->Cell(50, 9, $promMensajesUsuario . ' msg', 0, 0, 'L');

$pdf->SetFont('helvetica', 'I', 8);
$pdf->SetTextColor(100, 115, 145);
$pdf->SetXY(80, $y + 12);
$pdf->Cell(110, 6, 'Calculado sobre el total de mensajes y usuarios registrados', 0, 0, 'L');

$y += 30;

// ── Nota comparativa final ────────────────────────────────────────────────────
$pdf->SetFillColor(255, 248, 235);
$pdf->SetDrawColor(239, 159, 39);
$pdf->SetLineWidth(0.3);
$pdf->RoundedRect(15, $y, 180, 18, 2, '1111', 'DF');
$pdf->SetFont('helvetica', 'I', 8);
$pdf->SetTextColor(120, 80, 20);
$pdf->SetXY(18, $y + 4);
$pdf->MultiCell(
    174,
    4.5,
    'Si el promedio de mensajes por usuario es bajo, puede indicar falta de engagement o que la mayoría de usuarios ' .
        'accede de forma pasiva. Se recomienda revisar los usuarios con cero mensajes para detectar cuentas inactivas o sin uso real.',
    0,
    'L'
);

// ═══════════════════════════════════════════════════════════════════════════════
// DESCARGAR
// ═══════════════════════════════════════════════════════════════════════════════
$pdf->Output('reporte_usuarios_mensajes_asopaticas.pdf', 'D');
