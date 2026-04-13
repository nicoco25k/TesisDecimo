<?php
require_once('tcpdf/tcpdf.php');
include_once("bd/Conexion.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

// ─── Constantes de diseño (paleta azul oscuro — igual que mascotas) ───────────
define('C_PRIMARIO',   [15,  40,  80]);   // Azul marino institucional
define('C_SECUNDARIO', [30,  80, 160]);   // Azul medio
define('C_ACENTO',     [255, 180,   0]);  // Dorado/amarillo para detalles
define('C_FONDO',      [240, 245, 255]);  // Fondo azul muy suave
define('C_TEXTO',      [35,  35,  45]);   // Casi negro
define('C_BLANCO',     [255, 255, 255]);
define('LOGO_PATH',    'files/img/asa.jpg');
define('LOGO_PATH2',   'files/img/report.jpg');

// ─── Clase PDF ────────────────────────────────────────────────────────────────
class MYPDF extends TCPDF
{
    public function Header()
    {
        // Barra superior azul marino
        $this->SetFillColor(...C_PRIMARIO);
        $this->Rect(0, 0, 210, 24, 'F');

        // Franja dorada inferior de la barra
        $this->SetFillColor(...C_ACENTO);
        $this->Rect(0, 24, 210, 1.5, 'F');

        // Logo
        if (file_exists(LOGO_PATH2)) {
            $this->Image(LOGO_PATH2, 6, 2, 20, 20, '', '', '', false, 300);
        }

        // Nombre organización
        $this->SetTextColor(...C_BLANCO);
        $this->SetFont('helvetica', 'B', 12);
        $this->SetXY(30, 5);
        $this->Cell(100, 7, 'ASOPATICAS', 0, 0, 'L');

        // Subtítulo
        $this->SetFont('helvetica', '', 8);
        $this->SetXY(30, 13);
        $this->Cell(100, 5, 'Asociación Protectora De Animales Paticas', 0, 0, 'L');

        // Nombre del reporte (derecha)
        $this->SetFont('helvetica', 'I', 8);
        $this->SetTextColor(200, 215, 255);
        $this->SetXY(110, 9);
        $this->Cell(90, 6, 'Reporte de Usuarios Registrados', 0, 0, 'R');

        $this->SetTextColor(...C_TEXTO);
    }

    public function Footer()
    {
        // Línea dorada
        $this->SetDrawColor(...C_ACENTO);
        $this->SetLineWidth(0.6);
        $this->Line(15, 282, 195, 282);

        // Logo pequeño
        if (file_exists(LOGO_PATH)) {
            $this->Image(LOGO_PATH, 15, 284, 8, 8, '', '', '', false, 300);
        }

        // Texto footer
        $this->SetFont('helvetica', 'I', 7.5);
        $this->SetTextColor(120, 120, 140);
        $this->SetXY(26, 284);
        $this->Cell(0, 4, 'ASOPATICAS  •  ' . date('d/m/Y'), 0, 1, 'L');

        // Número de página
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
$pdf->SetTitle('Reporte de Usuarios Registrados');
$pdf->SetMargins(15, 30, 15);
$pdf->SetAutoPageBreak(true, 22);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// ─── PORTADA ──────────────────────────────────────────────────────────────────
$pdf->AddPage();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Fondo azul marino completo
$pdf->SetFillColor(...C_PRIMARIO);
$pdf->Rect(0, 0, 210, 297, 'F');

// Bandas decorativas doradas
$pdf->SetFillColor(...C_ACENTO);
$pdf->Rect(0, 135, 210, 3, 'F');
$pdf->Rect(0, 145, 210, 0.8, 'F');

// Bloque de título (azul medio)
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
$pdf->Cell(160, 10, 'REPORTE DE USUARIOS REGISTRADOS', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(210, 230, 255);
$pdf->SetXY(25, 163);
$pdf->Cell(160, 7, 'Información detallada del personal y voluntarios del sistema', 0, 1, 'C');

// Badge dorado con fecha
$pdf->SetFillColor(...C_ACENTO);
$pdf->RoundedRect(72, 212, 66, 10, 3, '1111', 'F');
$pdf->SetTextColor(30, 30, 30);
$pdf->SetFont('helvetica', 'B', 9);
$pdf->SetXY(72, 214);
$pdf->Cell(66, 6, 'Generado el ' . date('d/m/Y'), 0, 0, 'C');

// Pie de portada
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
        tu.id_usuarios,
        tu.nombre_usuario,
        tu.apellido_usuario,
        tu.nickname_usuario,
        td.nombre_documento,
        tu.numero_documento_usuario,
        tu.correo_usuario,
        tu.telefono_usuario,
        te.nombre_estado,
        tu.fecha_creacion,
        tr.nombre_rol
    FROM tabla_usuarios tu
    JOIN tabla_roles tr          ON tu.id_rol              = tr.id_rol
    JOIN tabla_documetno td      ON tu.id_tipo_documento   = td.id_tipo_documento
    JOIN tabla_estado_usuario te ON tu.id_estado_usuario   = te.id_estado_usuario
    WHERE tr.id_rol = 1
    ORDER BY tu.id_usuarios ASC
";

$usuarios = $dbh->query($sql);
if (!$usuarios) {
    die("Error en la consulta SQL: " . $dbh->errorInfo()[2]);
}

$contador = 0;

// ─── Página por usuario ───────────────────────────────────────────────────────
foreach ($usuarios as $row) {
    $contador++;
    $pdf->AddPage();

    $startY = 32;

    // ── Badge de estado (esquina superior derecha) ──────────────────────────
    $estado   = $row['nombre_estado'];
    $activo   = (stripos($estado, 'activ') !== false);

    $pdf->SetFillColor(...($activo ? [20, 140, 80] : [100, 110, 130]));
    $pdf->RoundedRect(155, $startY, 42, 8, 2.5, '1111', 'F');
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->SetXY(155, $startY + 1.5);
    $pdf->Cell(42, 5, mb_strtoupper($estado, 'UTF-8'), 0, 0, 'C');

    // ── Barra de título de la ficha ─────────────────────────────────────────
    $pdf->SetFillColor(...C_PRIMARIO);
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->SetXY(15, $startY);
    $pdf->Cell(
        136,
        9,
        '  Usuario #' . str_pad($contador, 3, '0', STR_PAD_LEFT)
            . '  —  ' . strtoupper(htmlspecialchars($row['nombre_usuario'] . ' ' . $row['apellido_usuario'])),
        0,
        1,
        'L',
        true
    );

    $startY += 12;

    // ── Avatar / iniciales (reemplaza la foto) ──────────────────────────────
    $avatarX = 15;
    $avatarY = $startY;
    $avatarW = 40;
    $avatarH = 40;

    // Fondo de avatar degradado simulado
    $pdf->SetFillColor(...C_SECUNDARIO);
    $pdf->RoundedRect($avatarX, $avatarY, $avatarW, $avatarH, 4, '1111', 'F');

    // Inicial del nombre
    $inicial = mb_strtoupper(mb_substr($row['nombre_usuario'], 0, 1, 'UTF-8'), 'UTF-8');
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 22);
    $pdf->SetXY($avatarX, $avatarY + 11);
    $pdf->Cell($avatarW, 18, $inicial, 0, 0, 'C');

    // ID debajo del avatar
    $pdf->SetFillColor(...C_ACENTO);
    $pdf->RoundedRect($avatarX + 4, $avatarY + $avatarH + 2, $avatarW - 8, 7, 2, '1111', 'F');
    $pdf->SetTextColor(30, 30, 30);
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->SetXY($avatarX + 4, $avatarY + $avatarH + 3);
    $pdf->Cell($avatarW - 8, 5, 'ID: ' . $row['id_usuarios'], 0, 0, 'C');

    // ── Tabla de datos a la derecha del avatar ──────────────────────────────
    $datosX = $avatarX + $avatarW + 6;   // ~61mm
    $datosW = 195 - $datosX;              // hasta margen derecho
    $datosY = $startY;
    $filaH  = 7.5;

    $campos = [
        ['Nombre completo',    $row['nombre_usuario'] . ' ' . $row['apellido_usuario']],
        ['Nickname / Usuario', $row['nickname_usuario']],
        ['Tipo de documento',  $row['nombre_documento']],
        ['N.º de documento',   $row['numero_documento_usuario']],
        ['Correo electrónico', $row['correo_usuario']],
        ['Teléfono',           $row['telefono_usuario']],
        ['Rol en el sistema',  $row['nombre_rol']],
    ];

    foreach ($campos as $i => [$etiqueta, $valor]) {
        $y = $datosY + ($i * $filaH);

        // Fondo alterno
        $pdf->SetFillColor(...($i % 2 === 0 ? C_FONDO : C_BLANCO));
        $pdf->Rect($datosX, $y, $datosW, $filaH, 'F');

        // Etiqueta
        $pdf->SetFont('helvetica', 'B', 8.5);
        $pdf->SetTextColor(...C_PRIMARIO);
        $pdf->SetXY($datosX + 2, $y + 1.8);
        $pdf->Cell(42, 4.5, $etiqueta . ':', 0, 0, 'L');

        // Valor
        $pdf->SetFont('helvetica', '', 8.5);
        $pdf->SetTextColor(...C_TEXTO);
        $pdf->SetXY($datosX + 45, $y + 1.8);
        $pdf->Cell($datosW - 47, 4.5, htmlspecialchars($valor), 0, 0, 'L');
    }

    // Borde exterior de la tabla
    $pdf->SetDrawColor(...C_SECUNDARIO);
    $pdf->SetLineWidth(0.5);
    $pdf->RoundedRect($datosX, $datosY, $datosW, count($campos) * $filaH, 2, '1111', 'D');

    // ── Sección inferior: Fecha de registro ─────────────────────────────────
    $infoY = $avatarY + $avatarH + 16;

    // Encabezado sección
    $pdf->SetFillColor(...C_SECUNDARIO);
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(15, $infoY);
    $pdf->Cell(180, 8, '  Información de Registro', 0, 1, 'L', true);

    // Franja dorada decorativa
    $pdf->SetFillColor(...C_ACENTO);
    $pdf->Rect(15, $infoY + 8, 180, 0.8, 'F');

    $infoY += 11;

    // Caja de información de registro con 2 columnas
    $colW = 88;

    // Columna izquierda — Fecha de registro
    $pdf->SetFillColor(...C_FONDO);
    $pdf->SetDrawColor(...C_SECUNDARIO);
    $pdf->SetLineWidth(0.4);
    $pdf->RoundedRect(15, $infoY, $colW, 14, 2, '1111', 'FD');

    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->SetTextColor(...C_PRIMARIO);
    $pdf->SetXY(18, $infoY + 2.5);
    $pdf->Cell(40, 5, 'Fecha de registro:', 0, 0, 'L');

    $pdf->SetFont('helvetica', '', 9);
    $pdf->SetTextColor(...C_TEXTO);
    $pdf->SetXY(18, $infoY + 8);

    // Formatear fecha
    $fechaRaw  = $row['fecha_creacion'];
    $fechaObj  = DateTime::createFromFormat('Y-m-d H:i:s', $fechaRaw);
    $fechaFmt  = $fechaObj ? $fechaObj->format('d/m/Y  H:i') : htmlspecialchars($fechaRaw);

    $pdf->Cell($colW - 6, 5, $fechaFmt, 0, 0, 'L');

    // Columna derecha — Estado de cuenta
    $col2X = 15 + $colW + 4;
    $pdf->SetFillColor(...C_FONDO);
    $pdf->RoundedRect($col2X, $infoY, $colW, 14, 2, '1111', 'FD');

    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->SetTextColor(...C_PRIMARIO);
    $pdf->SetXY($col2X + 3, $infoY + 2.5);
    $pdf->Cell(40, 5, 'Estado de la cuenta:', 0, 0, 'L');

    // Badge de color según estado
    $estadoColor = $activo ? [20, 140, 80] : [180, 50, 50];
    $pdf->SetFillColor(...$estadoColor);
    $pdf->RoundedRect($col2X + 3, $infoY + 8, 36, 5, 1.5, '1111', 'F');
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 7.5);
    $pdf->SetXY($col2X + 3, $infoY + 9);
    $pdf->Cell(36, 3.5, mb_strtoupper($estado, 'UTF-8'), 0, 0, 'C');

    $pdf->SetTextColor(...C_TEXTO);
}

// ─── Si no hay usuarios ───────────────────────────────────────────────────────
if ($contador === 0) {
    $pdf->AddPage();
    $pdf->SetFont('helvetica', 'I', 12);
    $pdf->SetTextColor(150, 150, 160);
    $pdf->SetXY(15, 80);
    $pdf->Cell(180, 10, 'No se encontraron usuarios registrados.', 0, 1, 'C');
}

// ─── Descargar ────────────────────────────────────────────────────────────────
$pdf->Output('reporte_usuarios_asopaticas.pdf', 'D');
