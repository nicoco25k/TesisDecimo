<?php
require_once('tcpdf/tcpdf.php');
include_once("bd/Conexion.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

// ─── Constantes de diseño (paleta azul oscuro) ────────────────────────────────
define('C_PRIMARIO',   [15,  40,  80]);
define('C_SECUNDARIO', [30,  80, 160]);
define('C_ACENTO',     [255, 180,   0]);
define('C_FONDO',      [240, 245, 255]);
define('C_TEXTO',      [35,  35,  45]);
define('C_BLANCO',     [255, 255, 255]);
define('LOGO_PATH',    'files/img/asa.jpg');
define('LOGO_PATH2',   'files/img/report.jpg');

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
        $this->Cell(90, 6, 'Reporte de Mensajes de Usuarios', 0, 0, 'R');

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

// ─── Instancia ────────────────────────────────────────────────────────────────
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('Sistema de Adopción ASOPATICAS');
$pdf->SetAuthor('ASOPATICAS');
$pdf->SetTitle('Reporte de Mensajes de Usuarios');
$pdf->SetMargins(15, 30, 15);
$pdf->SetAutoPageBreak(true, 22);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// ─── PORTADA ──────────────────────────────────────────────────────────────────
$pdf->AddPage();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Fondo azul marino
$pdf->SetFillColor(...C_PRIMARIO);
$pdf->Rect(0, 0, 210, 297, 'F');

// Bandas doradas
$pdf->SetFillColor(...C_ACENTO);
$pdf->Rect(0, 135, 210, 3, 'F');
$pdf->Rect(0, 145, 210, 0.8, 'F');

// Bloque azul medio
$pdf->SetFillColor(...C_SECUNDARIO);
$pdf->Rect(0, 148, 210, 50, 'F');

// Logo grande centrado
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

// Nombre organización
$pdf->SetTextColor(...C_BLANCO);
$pdf->SetFont('helvetica', 'B', 30);
$pdf->SetXY(0, 96);
$pdf->Cell(210, 14, 'ASOPATICAS', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 12);
$pdf->SetXY(0, 112);
$pdf->SetTextColor(180, 205, 255);
$pdf->Cell(210, 7, 'Asociación Protectora De Animales Paticas', 0, 1, 'C');

// Línea decorativa
$pdf->SetDrawColor(255, 255, 255);
$pdf->SetLineWidth(0.4);
$pdf->Line(70, 128, 140, 128);

// Título del reporte
$pdf->SetTextColor(...C_BLANCO);
$pdf->SetFont('helvetica', 'B', 17);
$pdf->SetXY(25, 152);
$pdf->Cell(160, 10, 'REPORTE DE MENSAJES DE USUARIOS', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(210, 230, 255);
$pdf->SetXY(25, 163);
$pdf->Cell(160, 7, 'Registro de comunicaciones recibidas a través del sistema', 0, 1, 'C');

// Badge fecha
$pdf->SetFillColor(...C_ACENTO);
$pdf->RoundedRect(72, 212, 66, 10, 3, '1111', 'F');
$pdf->SetTextColor(30, 30, 30);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY(72, 214);
$pdf->Cell(66, 6, 'Generado el ' . date('d/m/Y'), 0, 0, 'C');

// Pie portada
$pdf->SetTextColor(100, 130, 180);
$pdf->SetFont('helvetica', 'I', 8);
$pdf->SetXY(0, 278);
$pdf->Cell(210, 6, 'Documento de uso interno — ASOPATICAS', 0, 1, 'C');

// Reactivar header/footer
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// ─── Consulta ─────────────────────────────────────────────────────────────────
$sql = "
    SELECT
        nombre_usuario_mensaje,
        telefono_usuario_mensaje,
        correo_usuario_mensaje,
        mensaje,
        fecha_registro
    FROM tabla_de_mensajes
    ORDER BY fecha_registro DESC
";

$mensajes = $dbh->query($sql);
if (!$mensajes) {
    die("Error en la consulta SQL: " . $dbh->errorInfo()[2]);
}

$todos = $mensajes->fetchAll(PDO::FETCH_ASSOC);
$total = count($todos);

// ─── Página resumen con tabla general ─────────────────────────────────────────
$pdf->AddPage();

$resumenY = 32;

// Encabezado de sección resumen
$pdf->SetFillColor(...C_PRIMARIO);
$pdf->SetTextColor(...C_BLANCO);
$pdf->SetFont('helvetica', 'B', 11);
$pdf->SetXY(15, $resumenY);
$pdf->Cell(180, 9, '  Resumen General de Mensajes Recibidos', 0, 1, 'L', true);

$pdf->SetFillColor(...C_ACENTO);
$pdf->Rect(15, $resumenY + 9, 180, 0.8, 'F');

$resumenY += 12;

// Contador total — badge
$pdf->SetFillColor(...C_SECUNDARIO);
$pdf->RoundedRect(15, $resumenY, 86, 16, 3, '1111', 'F');
$pdf->SetTextColor(...C_BLANCO);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY(15, $resumenY + 2);
$pdf->Cell(86, 5, 'Total de mensajes registrados', 0, 1, 'C');
$pdf->SetFont('helvetica', 'B', 16);
$pdf->SetXY(15, $resumenY + 7);
$pdf->Cell(86, 7, $total, 0, 0, 'C');

// Fecha del reporte — badge
$pdf->SetFillColor(...C_FONDO);
$pdf->SetDrawColor(...C_SECUNDARIO);
$pdf->SetLineWidth(0.4);
$pdf->RoundedRect(108, $resumenY, 87, 16, 3, '1111', 'FD');
$pdf->SetTextColor(...C_PRIMARIO);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY(108, $resumenY + 2);
$pdf->Cell(87, 5, 'Fecha de generación', 0, 1, 'C');
$pdf->SetFont('helvetica', '', 11);
$pdf->SetTextColor(...C_TEXTO);
$pdf->SetXY(108, $resumenY + 8);
$pdf->Cell(87, 6, date('d/m/Y  H:i'), 0, 0, 'C');

$resumenY += 22;

// ── Tabla resumen compacta ─────────────────────────────────────────────────────
$colWidths = [38, 32, 52, 58]; // Nombre | Teléfono | Correo | Fecha
$headers   = ['Nombre', 'Teléfono', 'Correo electrónico', 'Fecha recibido'];

// Cabecera de la tabla
$pdf->SetFillColor(...C_SECUNDARIO);
$pdf->SetTextColor(...C_BLANCO);
$pdf->SetFont('helvetica', 'B', 8.5);
$pdf->SetXY(15, $resumenY);
foreach ($headers as $k => $h) {
    $pdf->Cell($colWidths[$k], 8, $h, 0, 0, 'C', true);
}
$pdf->Ln();

$resumenY += 8;
$filaH = 7;

foreach ($todos as $i => $row) {
    // Salto de página si es necesario
    if ($pdf->GetY() > 260) {
        $pdf->AddPage();
        // Redibujar cabecera de tabla
        $pdf->SetFillColor(...C_SECUNDARIO);
        $pdf->SetTextColor(...C_BLANCO);
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetXY(15, 32);
        foreach ($headers as $k => $h) {
            $pdf->Cell($colWidths[$k], 8, $h, 0, 0, 'C', true);
        }
        $pdf->Ln();
    }

    // Fondo alterno
    $pdf->SetFillColor(...($i % 2 === 0 ? C_FONDO : C_BLANCO));
    $pdf->SetTextColor(...C_TEXTO);
    $pdf->SetFont('helvetica', '', 8);

    $y = $pdf->GetY();
    $pdf->SetXY(15, $y);

    $nombre   = mb_strimwidth(htmlspecialchars($row['nombre_usuario_mensaje']),   0, 22, '…', 'UTF-8');
    $telefono = mb_strimwidth(htmlspecialchars($row['telefono_usuario_mensaje']), 0, 16, '…', 'UTF-8');
    $correo   = mb_strimwidth(htmlspecialchars($row['correo_usuario_mensaje']),   0, 30, '…', 'UTF-8');

    // Formatear fecha
    $fechaObj = DateTime::createFromFormat('Y-m-d H:i:s', $row['fecha_registro']);
    $fechaFmt = $fechaObj ? $fechaObj->format('d/m/Y  H:i') : htmlspecialchars($row['fecha_registro']);

    $pdf->Cell($colWidths[0], $filaH, $nombre,   0, 0, 'L', true);
    $pdf->Cell($colWidths[1], $filaH, $telefono, 0, 0, 'C', true);
    $pdf->Cell($colWidths[2], $filaH, $correo,   0, 0, 'L', true);
    $pdf->Cell($colWidths[3], $filaH, $fechaFmt, 0, 0, 'C', true);
    $pdf->Ln();
}

// Borde exterior tabla resumen
$pdf->SetDrawColor(...C_SECUNDARIO);
$pdf->SetLineWidth(0.5);
$tableH = (count($todos) * $filaH) + 8;
$pdf->Rect(15, $resumenY - 8, 180, $tableH > 228 ? 228 : $tableH, 'D');

// ─── Página por mensaje ───────────────────────────────────────────────────────
$contador = 0;

foreach ($todos as $row) {
    $contador++;
    $pdf->AddPage();

    $startY = 32;

    // ── Barra título de ficha ───────────────────────────────────────────────
    $pdf->SetFillColor(...C_PRIMARIO);
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 11);
    $pdf->SetXY(15, $startY);
    $pdf->Cell(
        180,
        9,
        '  Mensaje #' . str_pad($contador, 3, '0', STR_PAD_LEFT)
            . '  —  ' . strtoupper(htmlspecialchars($row['nombre_usuario_mensaje'])),
        0,
        1,
        'L',
        true
    );

    $startY += 12;

    // ── Icono / inicial del remitente ───────────────────────────────────────
    $iconX = 15;
    $iconY = $startY;
    $iconW = 36;
    $iconH = 36;

    $pdf->SetFillColor(...C_SECUNDARIO);
    $pdf->RoundedRect($iconX, $iconY, $iconW, $iconH, 4, '1111', 'F');

    $inicial = mb_strtoupper(mb_substr($row['nombre_usuario_mensaje'], 0, 1, 'UTF-8'), 'UTF-8');
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 20);
    $pdf->SetXY($iconX, $iconY + 9);
    $pdf->Cell($iconW, 18, $inicial, 0, 0, 'C');

    // Badge número bajo el ícono
    $pdf->SetFillColor(...C_ACENTO);
    $pdf->RoundedRect($iconX + 2, $iconY + $iconH + 2, $iconW - 4, 6, 1.5, '1111', 'F');
    $pdf->SetTextColor(30, 30, 30);
    $pdf->SetFont('helvetica', 'B', 7.5);
    $pdf->SetXY($iconX + 2, $iconY + $iconH + 3);
    $pdf->Cell($iconW - 4, 4, 'MSG #' . str_pad($contador, 3, '0', STR_PAD_LEFT), 0, 0, 'C');

    // ── Datos del remitente (derecha del ícono) ─────────────────────────────
    $datosX = $iconX + $iconW + 6;
    $datosW = 195 - $datosX;
    $datosY = $startY;
    $filaH  = 7.5;

    $fechaObj = DateTime::createFromFormat('Y-m-d H:i:s', $row['fecha_registro']);
    $fechaFmt = $fechaObj ? $fechaObj->format('d/m/Y  H:i') : htmlspecialchars($row['fecha_registro']);

    $campos = [
        ['Nombre',           $row['nombre_usuario_mensaje']],
        ['Teléfono',         $row['telefono_usuario_mensaje']],
        ['Correo',           $row['correo_usuario_mensaje']],
        ['Fecha recibido',   $fechaFmt],
    ];

    foreach ($campos as $i => [$etiqueta, $valor]) {
        $y = $datosY + ($i * $filaH);

        $pdf->SetFillColor(...($i % 2 === 0 ? C_FONDO : C_BLANCO));
        $pdf->Rect($datosX, $y, $datosW, $filaH, 'F');

        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetTextColor(...C_PRIMARIO);
        $pdf->SetXY($datosX + 2, $y + 1.8);
        $pdf->Cell(36, 4.5, $etiqueta . ':', 0, 0, 'L');

        $pdf->SetFont('helvetica', '', 9);
        $pdf->SetTextColor(...C_TEXTO);
        $pdf->SetXY($datosX + 39, $y + 1.8);
        $pdf->Cell($datosW - 41, 4.5, htmlspecialchars($valor), 0, 0, 'L');
    }

    // Borde tabla de datos
    $pdf->SetDrawColor(...C_SECUNDARIO);
    $pdf->SetLineWidth(0.5);
    $pdf->RoundedRect($datosX, $datosY, $datosW, count($campos) * $filaH, 2, '1111', 'D');

    // ── Sección contenido del mensaje ───────────────────────────────────────
    $mensajeY = $iconY + $iconH + 14;

    $pdf->SetFillColor(...C_SECUNDARIO);
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(15, $mensajeY);
    $pdf->Cell(180, 8, '  Contenido del Mensaje', 0, 1, 'L', true);

    $pdf->SetFillColor(...C_ACENTO);
    $pdf->Rect(15, $mensajeY + 8, 180, 0.8, 'F');

    $mensajeY += 10;

    // Caja del mensaje
    $texto = htmlspecialchars($row['mensaje']);
    $pdf->writeHTMLCell(
        180,
        0,
        15,
        $mensajeY,
        '<span style="font-size:10px; color:#23233d; line-height:1.8;">' . $texto . '</span>',
        ['LRTB' => ['width' => 0.5, 'color' => [30, 80, 160]]],
        1,
        true,
        true,
        'J',
        true
    );
}

// ─── Sin mensajes ─────────────────────────────────────────────────────────────
if ($contador === 0) {
    $pdf->AddPage();
    $pdf->SetFont('helvetica', 'I', 12);
    $pdf->SetTextColor(150, 150, 160);
    $pdf->SetXY(15, 80);
    $pdf->Cell(180, 10, 'No se encontraron mensajes registrados.', 0, 1, 'C');
}

// ─── Descargar ────────────────────────────────────────────────────────────────
$pdf->Output('reporte_mensajes_asopaticas.pdf', 'D');
