<?php
require_once('tcpdf/tcpdf.php');
include_once("bd/Conexion.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

// ─── Constantes de diseño ─────────────────────────────────────────────────────
define('C_PRIMARIO',   [15,  40,  80]);
define('C_SECUNDARIO', [30,  80, 160]);
define('C_ACENTO',     [255, 180,  0]);
define('C_FONDO',      [240, 245, 255]);
define('C_TEXTO',      [35,  35,  45]);
define('C_BLANCO',     [255, 255, 255]);
define('C_VERDE',      [29,  158, 117]);   // color distintivo de "aprobado"
define('LOGO_PATH',    'files/img/asa.jpg');
define('LOGO_PATH2',   'files/img/report.jpg');

// ─── Clase PDF ────────────────────────────────────────────────────────────────
class MYPDF extends TCPDF
{
    public function Header()
    {
        $this->SetFillColor(...C_PRIMARIO);
        $this->Rect(0, 0, 210, 24, 'F');

        // Franja verde (distintivo de aprobadas en lugar del dorado)
        $this->SetFillColor(...C_VERDE);
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
        $this->SetTextColor(200, 255, 230);
        $this->SetXY(110, 9);
        $this->Cell(90, 6, 'Reporte de Adopciones Aprobadas', 0, 0, 'R');

        $this->SetTextColor(...C_TEXTO);
    }

    public function Footer()
    {
        $this->SetDrawColor(...C_VERDE);
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

// ─── Instancia ────────────────────────────────────────────────────────────────
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('Sistema de Adopción ASOPATICAS');
$pdf->SetAuthor('ASOPATICAS');
$pdf->SetTitle('Reporte de Adopciones Aprobadas');
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

// Fondo azul marino
$pdf->SetFillColor(...C_PRIMARIO);
$pdf->Rect(0, 0, 210, 297, 'F');

// Bandas decorativas — verde para distinguir de los otros reportes
$pdf->SetFillColor(...C_VERDE);
$pdf->Rect(0, 135, 210, 3, 'F');
$pdf->Rect(0, 145, 210, 0.8, 'F');

$pdf->SetFillColor(20, 110, 80);   // verde oscuro para el bloque título
$pdf->Rect(0, 148, 210, 50, 'F');

// Logo
if (file_exists(LOGO_PATH2)) {
    $pdf->Image(LOGO_PATH2, 80, 35, 52, 52, '', '', '', false, 300);
} else {
    $pdf->SetFillColor(20, 110, 80);
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
$pdf->SetTextColor(180, 240, 210);
$pdf->Cell(210, 7, 'Asociación Protectora De Animales Paticas', 0, 1, 'C');

$pdf->SetDrawColor(255, 255, 255);
$pdf->SetLineWidth(0.4);
$pdf->Line(70, 128, 140, 128);

$pdf->SetTextColor(...C_BLANCO);
$pdf->SetFont('helvetica', 'B', 17);
$pdf->SetXY(25, 152);
$pdf->Cell(160, 10, 'REPORTE DE ADOPCIONES APROBADAS', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(200, 255, 230);
$pdf->SetXY(25, 163);
$pdf->Cell(160, 7, 'Registro completo de solicitudes confirmadas y adoptantes', 0, 1, 'C');

// Badge fecha — verde
$pdf->SetFillColor(...C_VERDE);
$pdf->RoundedRect(72, 212, 66, 10, 3, '1111', 'F');
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY(72, 214);
$pdf->Cell(66, 6, 'Generado el ' . date('d/m/Y'), 0, 0, 'C');

$pdf->SetTextColor(100, 130, 180);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->SetXY(0, 278);
$pdf->Cell(210, 6, 'Documento de uso interno — ASOPATICAS', 0, 1, 'C');

$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// ─── Consulta — solo aprobadas (id_estado_adopcion = 3) ──────────────────────
$sql = "SELECT * FROM bot_solicitud_adopcion WHERE id_estado_adopcion = 3 ORDER BY fecha_resolucion DESC";
$solicitudes = $dbh->query($sql);

if (!$solicitudes) {
    die("Error en la consulta SQL: " . $dbh->errorInfo()[2]);
}

// ─── Preguntas del formulario ─────────────────────────────────────────────────
$preguntasLabel = [
    'pregunta_1'  => '¿Qué tipo de vivienda tienes?',
    'pregunta_2'  => '¿Tienes jardín o espacio al aire libre?',
    'pregunta_3'  => '¿Tienes vecinos que se opongan a tener mascotas?',
    'pregunta_4'  => '¿Hay niños en tu hogar?',
    'pregunta_5'  => '¿Alguien en tu familia tiene alergias a los animales?',
    'pregunta_6'  => '¿Hay otros animales en casa?',
    'pregunta_7'  => '¿Trabajas actualmente?',
    'pregunta_8'  => '¿Cuántas horas al día estarías en casa?',
    'pregunta_9'  => '¿Qué esperas de la convivencia con una mascota?',
    'pregunta_10' => '¿Cuáles son los gastos que consideras al tener una mascota?',
    'pregunta_11' => '¿Por qué quieres adoptar una mascota?',
    'pregunta_12' => '¿Qué harías si la mascota muestra problemas de comportamiento?',
];

// ─── Helper: color badge de viabilidad ───────────────────────────────────────
function viabilidadColor(int $pct): array
{
    if ($pct >= 81) return [29, 158, 117];
    if ($pct >= 61) return [55, 138, 221];
    if ($pct >= 41) return [239, 159,  39];
    return [226,  75,  74];
}

// ─── Página por solicitud aprobada ────────────────────────────────────────────
$contador = 0;
foreach ($solicitudes as $row) {
    $contador++;
    $pdf->AddPage();

    $startY = 32;
    $pct    = (int)$row['porcentaje_viabilidad'];
    $vColor = viabilidadColor($pct);

    // ── Barra título con número y mascota ────────────────────────────────────
    $pdf->SetFillColor(...C_PRIMARIO);
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->SetXY(15, $startY);
    $pdf->Cell(
        144,
        9,
        '  Adopción #' . $contador . '  —  ' . strtoupper(htmlspecialchars($row['nombre_mascota'])),
        0,
        0,
        'L',
        true
    );

    // Badge "APROBADA" — verde fijo (no semafórico, estado siempre aprobado)
    $pdf->SetFillColor(...C_VERDE);
    $pdf->RoundedRect(160, $startY, 36, 9, 2.5, '1111', 'F');
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->SetXY(160, $startY + 2);
    $pdf->Cell(36, 5, 'APROBADA', 0, 0, 'C');

    $startY += 12;

    // ── Tarjeta adoptante (izquierda) ─────────────────────────────────────────
    $bloqueW = 86;
    $bloqueH = 58;   // un poco más alto para incluir fecha resolución

    $pdf->SetFillColor(210, 220, 240);
    $pdf->RoundedRect(16, $startY + 1, $bloqueW, $bloqueH, 3, '1111', 'F');

    $pdf->SetFillColor(...C_BLANCO);
    $pdf->SetDrawColor(...C_VERDE);
    $pdf->SetLineWidth(0.5);
    $pdf->RoundedRect(15, $startY, $bloqueW, $bloqueH, 3, '1111', 'DF');

    // Franja verde superior
    $pdf->SetFillColor(...C_VERDE);
    $pdf->RoundedRect(15, $startY, $bloqueW, 4, 3, '1100', 'F');
    $pdf->Rect(15, $startY + 2, $bloqueW, 2, 'F');

    // Círculo con inicial
    $pdf->SetFillColor(...C_FONDO);
    $pdf->Circle(15 + $bloqueW / 2, $startY + 15, 8, 0, 360, 'F');
    $pdf->SetFont('helvetica', 'B', 14);
    $pdf->SetTextColor(...C_VERDE);
    $pdf->SetXY(15, $startY + 10);
    $pdf->Cell(
        $bloqueW,
        9,
        strtoupper(mb_substr($row['usuario_nombre'], 0, 1, 'UTF-8')),
        0,
        0,
        'C'
    );

    // Nombre
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetTextColor(...C_PRIMARIO);
    $pdf->SetXY(15, $startY + 25);
    $pdf->Cell($bloqueW, 6, htmlspecialchars($row['usuario_nombre']), 0, 0, 'C');

    // Correo
    $pdf->SetFont('helvetica', '', 8);
    $pdf->SetTextColor(80, 100, 130);
    $pdf->SetXY(15, $startY + 31);
    $pdf->Cell($bloqueW, 5, htmlspecialchars($row['usuario_correo']), 0, 0, 'C');

    // Teléfono
    $pdf->SetFont('helvetica', '', 8.5);
    $pdf->SetTextColor(...C_TEXTO);
    $pdf->SetXY(15, $startY + 37);
    $pdf->Cell($bloqueW, 5, 'Tel: ' . htmlspecialchars($row['usuario_numero']), 0, 0, 'C');

    // Dirección
    $pdf->SetFont('helvetica', '', 8);
    $pdf->SetTextColor(80, 100, 130);
    $pdf->SetXY(18, $startY + 43);
    $pdf->MultiCell($bloqueW - 6, 4, 'Dir: ' . htmlspecialchars($row['usuario_direccion']), 0, 'C');

    // ── Tabla de datos derecha ────────────────────────────────────────────────
    $datosX = 15 + $bloqueW + 5;
    $datosW = 180 - $bloqueW - 5;
    $datosY = $startY;
    $filaH  = 7.5;

    $campos = [
        ['Mascota adoptada',   htmlspecialchars($row['nombre_mascota'])],
        ['Fecha solicitud',    htmlspecialchars($row['fecha_registro'])],
        ['Fecha aprobación',   !empty($row['fecha_resolucion'])
            ? htmlspecialchars($row['fecha_resolucion'])
            : '—'],
        ['Viabilidad',         $pct . '%'],
    ];

    foreach ($campos as $i => [$etiqueta, $valor]) {
        $fy = $datosY + ($i * $filaH);

        // Fondo alterno; fila "Fecha aprobación" con tinte verde suave
        if ($etiqueta === 'Fecha aprobación') {
            $pdf->SetFillColor(230, 250, 242);
        } else {
            $pdf->SetFillColor($i % 2 === 0 ? 240 : 255, $i % 2 === 0 ? 245 : 255, 255);
        }
        $pdf->Rect($datosX, $fy, $datosW, $filaH, 'F');

        // Etiqueta
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetTextColor(...C_PRIMARIO);
        $pdf->SetXY($datosX + 2, $fy + 1.5);
        $pdf->Cell(34, 5, $etiqueta . ':', 0, 0, 'L');

        // Valor con color especial para viabilidad y fecha aprobación
        if ($etiqueta === 'Viabilidad') {
            $pdf->SetTextColor(...$vColor);
            $pdf->SetFont('helvetica', 'B', 9);
        } elseif ($etiqueta === 'Fecha aprobación') {
            $pdf->SetTextColor(...C_VERDE);
            $pdf->SetFont('helvetica', 'B', 9);
        } else {
            $pdf->SetTextColor(...C_TEXTO);
            $pdf->SetFont('helvetica', '', 9);
        }
        $pdf->SetXY($datosX + 37, $fy + 1.5);
        $pdf->Cell($datosW - 39, 5, $valor, 0, 0, 'L');
    }

    // Borde exterior tabla
    $pdf->SetDrawColor(...C_VERDE);
    $pdf->SetLineWidth(0.5);
    $pdf->RoundedRect($datosX, $datosY, $datosW, count($campos) * $filaH, 2, '1111', 'D');

    // ── Sección viabilidad — barra visual debajo de la tabla ─────────────────
    $barSectionY = $datosY + count($campos) * $filaH + 3;

    $pdf->SetFillColor(...C_FONDO);
    $pdf->SetDrawColor(200, 230, 215);
    $pdf->SetLineWidth(0.3);
    $pdf->RoundedRect($datosX, $barSectionY, $datosW, 10, 2, '1111', 'DF');

    // Etiqueta
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->SetTextColor(...C_PRIMARIO);
    $pdf->SetXY($datosX + 2, $barSectionY + 1.5);
    $pdf->Cell(20, 5, 'Viabilidad:', 0, 0, 'L');

    // Barra proporcional
    $barMaxW = $datosW - 38;
    $barFill = max(0, min($pct, 100)) / 100 * $barMaxW;
    $barX    = $datosX + 24;
    $barY    = $barSectionY + 2.5;
    $barH    = 5;

    $pdf->SetFillColor(210, 230, 215);
    $pdf->RoundedRect($barX, $barY, $barMaxW, $barH, 2, '1111', 'F');

    $pdf->SetFillColor(...$vColor);
    if ($barFill > 0) {
        $pdf->RoundedRect($barX, $barY, $barFill, $barH, 2, '1111', 'F');
    }

    // Porcentaje sobre la barra
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->SetTextColor(...$vColor);
    $pdf->SetXY($barX + $barMaxW + 2, $barSectionY + 1.5);
    $pdf->Cell(12, 5, $pct . '%', 0, 0, 'L');

    // ── Sección: Preguntas evaluativas ────────────────────────────────────────
    $pregY = $startY + $bloqueH + 6;

    $pdf->SetFillColor(...C_SECUNDARIO);
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(15, $pregY);
    $pdf->Cell(180, 8, '  Preguntas Evaluativas del Formulario de Adopción', 0, 1, 'L', true);

    $pdf->SetFillColor(...C_VERDE);
    $pdf->Rect(15, $pregY + 8, 180, 0.8, 'F');

    $pregY += 10;

    // Dos columnas
    $colW   = 87;
    $colGap = 6;
    $col1X  = 15;
    $col2X  = $col1X + $colW + $colGap;
    $qH     = 14;
    $col1Y  = $pregY;
    $col2Y  = $pregY;
    $qCount = 0;

    foreach ($preguntasLabel as $campo => $label) {
        $respuesta = isset($row[$campo]) && $row[$campo] !== ''
            ? htmlspecialchars($row[$campo])
            : '—';

        $isCol1 = ($qCount % 2 === 0);
        $cx = $isCol1 ? $col1X : $col2X;
        $cy = $isCol1 ? $col1Y : $col2Y;

        // Tarjeta pregunta
        $pdf->SetFillColor(...C_FONDO);
        $pdf->SetDrawColor(190, 225, 210);
        $pdf->SetLineWidth(0.3);
        $pdf->RoundedRect($cx, $cy, $colW, $qH, 2, '1111', 'DF');

        // Badge número — verde
        $pdf->SetFillColor(...C_VERDE);
        $pdf->Circle($cx + 5, $cy + 4, 3.5, 0, 360, 'F');
        $pdf->SetFont('helvetica', 'B', 7);
        $pdf->SetTextColor(...C_BLANCO);
        $pdf->SetXY($cx + 2, $cy + 1.2);
        $pdf->Cell(7, 5.5, $qCount + 1, 0, 0, 'C');

        // Etiqueta
        $pdf->SetFont('helvetica', 'B', 7.5);
        $pdf->SetTextColor(...C_PRIMARIO);
        $pdf->SetXY($cx + 10, $cy + 1);
        $pdf->MultiCell($colW - 12, 3.5, $label, 0, 'L');

        // Respuesta
        $pdf->SetFont('helvetica', '', 8);
        $pdf->SetTextColor(...C_TEXTO);
        $pdf->SetXY($cx + 10, $cy + 7.5);
        $pdf->MultiCell($colW - 12, 3.8, $respuesta, 0, 'L');

        if ($isCol1) {
            $col1Y += $qH + 2;
        } else {
            $col2Y += $qH + 2;
        }
        $qCount++;
    }
}

// ─── Sin registros ────────────────────────────────────────────────────────────
if ($contador === 0) {
    $pdf->AddPage();
    $pdf->SetFont('helvetica', 'I', 13);
    $pdf->SetTextColor(150, 160, 180);
    $pdf->SetXY(15, 80);
    $pdf->Cell(180, 10, 'No hay adopciones aprobadas registradas en este momento.', 0, 0, 'C');
}

// ─── Descargar ────────────────────────────────────────────────────────────────
$pdf->Output('reporte_adopciones_aprobadas.pdf', 'D');
