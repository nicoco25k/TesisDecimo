<?php
require_once('tcpdf/tcpdf.php');
include_once("bd/Conexion.php");



ini_set('display_errors', 1);
error_reporting(E_ALL);

// ─── Constantes de diseño (paleta azul oscuro) ───────────────────────────────
define('C_PRIMARIO',    [15,  40,  80]);   // Azul marino institucional
define('C_SECUNDARIO',  [30,  80, 160]);   // Azul medio
define('C_ACENTO',      [255, 180,  0]);   // Dorado/amarillo para detalles
define('C_FONDO',       [240, 245, 255]);  // Fondo azul muy suave
define('C_TEXTO',       [35,  35,  45]);   // Casi negro
define('C_BLANCO',      [255, 255, 255]);
define('LOGO_PATH',     'files/img/asa.jpg'); // ← ajusta tu ruta real
define('LOGO_PATH2',     'files/img/report.jpg'); // ← ajusta tu ruta real

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

        // ── Logo ASOPATICAS ──────────────────────────────────────────────────
        if (file_exists(LOGO_PATH)) {
            $this->Image(
                LOGO_PATH2,
                6,      // X
                2,      // Y
                20,     // ancho (mm)
                20,     // alto (mm)
                '',
                '',
                '',
                false,
                300,
                '',
                false,
                false,
                0
            );
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

        // Texto derecha: nombre del reporte
        $this->SetFont('helvetica', 'I', 8);
        $this->SetTextColor(200, 215, 255);
        $this->SetXY(110, 9);
        $this->Cell(90, 6, 'Reporte de Mascotas Disponibles', 0, 0, 'R');

        $this->SetTextColor(...C_TEXTO);
    }

    public function Footer()
    {
        // Línea dorada
        $this->SetDrawColor(...C_ACENTO);
        $this->SetLineWidth(0.6);
        $this->Line(15, 282, 195, 282);

        // Logo pequeño en footer
        if (file_exists(LOGO_PATH)) {
            $this->Image(LOGO_PATH, 15, 284, 8, 8, '', '', '', false, 300);
        }

        // Texto footer
        $this->SetFont('helvetica', 'I', 7.5);
        $this->SetTextColor(120, 120, 140);
        $this->SetXY(26, 284);
        $this->Cell(0, 4, 'ASOPATICAS  •  ' . date('d/m/Y'), 0, 1, 'L');

        // Número de página alineado a la derecha
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
$pdf->SetTitle('Reporte de Mascotas Disponibles');
$pdf->SetMargins(15, 30, 15);
$pdf->SetAutoPageBreak(true, 22);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// ─── PORTADA ─────────────────────────────────────────────────────────────────
$pdf->AddPage();
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// Fondo azul marino completo
$pdf->SetFillColor(...C_PRIMARIO);
$pdf->Rect(0, 0, 210, 297, 'F');

// Banda decorativa dorada
$pdf->SetFillColor(...C_ACENTO);
$pdf->Rect(0, 135, 210, 3, 'F');
$pdf->Rect(0, 145, 210, 0.8, 'F');

// Franja azul medio para el bloque del título
$pdf->SetFillColor(...C_SECUNDARIO);
$pdf->Rect(0, 148, 210, 50, 'F');

// ── Logo grande centrado ──────────────────────────────────────────────────────
if (file_exists(LOGO_PATH2)) {
    $pdf->Image(LOGO_PATH2, 80, 35, 52, 52, '', '', '', false, 300);
} else {
    // Placeholder circular si no hay logo
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

// Línea decorativa blanca corta
$pdf->SetDrawColor(255, 255, 255);
$pdf->SetLineWidth(0.4);
$pdf->Line(70, 128, 140, 128);

// Título del reporte (sobre la banda azul medio)
$pdf->SetTextColor(...C_BLANCO);
$pdf->SetFont('helvetica', 'B', 17);
$pdf->SetXY(25, 152);
$pdf->Cell(160, 10, 'REPORTE DE MASCOTAS DISPONIBLES', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 10);
$pdf->SetTextColor(210, 230, 255);
$pdf->SetXY(25, 163);
$pdf->Cell(160, 7, 'Información detallada para proceso de adopción', 0, 1, 'C');

// Fecha de generación con badge dorado
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
        id_mascotas,
        nombre_mascota, 
        nombre_especie, 
        nombre_sexo, 
        nombre_edad,  
        nombre_desparasitacion,   
        nombre_raza, 
        nombre_esterilizacion, 
        nombre_vacuna, 
        ruta_img_mascota, 
        caracteristicas_de_comportamiento_mascota,
        nombre_estado_adopcion
    FROM tabla_mascotas tm
    JOIN mascota_desparasitacion m2 
        ON tm.id_estado_desparasitacion_mascota = m2.id_estado_desparasitacion_mascota
    JOIN mascota_edad m3 
        ON tm.id_edad_mascota = m3.id_edad_mascota
    JOIN mascota_especie m4 
        ON tm.id_especie_mascota = m4.id_especie_mascota
    JOIN mascota_esterilizacion m5 
        ON tm.id_estado_esterilizacion_mascota = m5.id_estado_esterilizacion_mascota
    JOIN mascota_raza m9 
        ON tm.id_razas_mascota = m9.id_razas_mascota
    JOIN mascota_sexo m10 
        ON tm.id_sexo_mascota = m10.id_sexo_mascota
    JOIN mascota_vacuna m12 
        ON tm.id_estado_vacuna_mascota = m12.id_estado_vacuna_mascota
    JOIN mascota_estado_adopcion m13
        ON tm.id_estado_adopcion_mascota = m13.id_estado_adopcion_mascota
    ORDER BY 
    CASE WHEN nombre_estado_adopcion = 'En Adopcion' THEN 0 ELSE 1 END ASC,
    id_mascotas DESC

";

$mascotas = $dbh->query($sql);
if (!$mascotas) {
    die("Error en la consulta SQL: " . $dbh->errorInfo()[2]);
}

// ─── Página por mascota ───────────────────────────────────────────────────────
foreach ($mascotas as $row) {
    $pdf->AddPage();

    $startY = 32;

    // ── Badge estado de adopción (esquina superior derecha) ─────────────────
    $estado     = $row['nombre_estado_adopcion'];
    $esAdoptado = (stripos($estado, 'adopt') !== false && stripos($estado, 'en') === false);

    if ($esAdoptado) {
        // Gris azulado → adoptado
        $pdf->SetFillColor(100, 110, 130);
    } else {
        // Verde azulado → disponible
        $pdf->SetFillColor(20, 140, 80);
    }
    $pdf->RoundedRect(155, $startY, 42, 8, 2.5, '1111', 'F');
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 8);
    $pdf->SetXY(155, $startY + 1.5);
    $pdf->Cell(42, 5, mb_strtoupper($estado, 'UTF-8'), 0, 0, 'C');

    // ── Barra título de ficha ───────────────────────────────────────────────
    $pdf->SetFillColor(...C_PRIMARIO);
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 12);
    $pdf->SetXY(15, $startY);
    $pdf->Cell(136, 9, '  Ficha: ' . strtoupper(htmlspecialchars($row['nombre_mascota'])), 0, 1, 'L', true);

    $startY += 12;

    // ── Foto izquierda ──────────────────────────────────────────────────────
    $fotoX = 15;
    $fotoY = $startY;
    $fotoW = 56;
    $fotoH = 56;

    $hayFoto = !empty($row['ruta_img_mascota']) && file_exists($row['ruta_img_mascota']);

    if ($hayFoto) {
        // Sombra simulada
        $pdf->SetFillColor(200, 210, 230);
        $pdf->RoundedRect($fotoX + 1.5, $fotoY + 1.5, $fotoW, $fotoH, 2.5, '1111', 'F');
        // Marco azul
        $pdf->SetDrawColor(...C_SECUNDARIO);
        $pdf->SetLineWidth(0.8);
        $pdf->RoundedRect($fotoX, $fotoY, $fotoW, $fotoH, 2.5, '1111', 'D');
        $pdf->Image(
            $row['ruta_img_mascota'],
            $fotoX + 0.5,
            $fotoY + 0.5,
            $fotoW - 1,
            $fotoH - 1,
            '',
            '',
            '',
            true,
            150,
            '',
            false,
            false,
            0,
            true
        );
    } else {
        $pdf->SetFillColor(...C_FONDO);
        $pdf->SetDrawColor(...C_SECUNDARIO);
        $pdf->SetLineWidth(0.6);
        $pdf->RoundedRect($fotoX, $fotoY, $fotoW, $fotoH, 2.5, '1111', 'DF');
        $pdf->SetTextColor(160, 170, 190);
        $pdf->SetFont('helvetica', 'I', 9);
        $pdf->SetXY($fotoX, $fotoY + 24);
        $pdf->Cell($fotoW, 8, 'Sin imagen disponible', 0, 0, 'C');
    }

    // ── Tabla de datos derecha ──────────────────────────────────────────────
    $datosX = $fotoX + $fotoW + 5;   // 76mm
    $datosW = 195 - $datosX;          // ~119mm hasta margen
    $datosY = $startY;
    $filaH  = 7.5;

    $campos = [
        ['Especie',         $row['nombre_especie']],
        ['Raza',            $row['nombre_raza']],
        ['Sexo',            $row['nombre_sexo']],
        ['Edad',            $row['nombre_edad']],
        ['Desparasitación', $row['nombre_desparasitacion']],
        ['Esterilización',  $row['nombre_esterilizacion']],
        ['Vacunación',      $row['nombre_vacuna']],
    ];

    foreach ($campos as $i => [$etiqueta, $valor]) {
        $y = $datosY + ($i * $filaH);

        // Fondo alterno
        if ($i % 2 === 0) {
            $pdf->SetFillColor(...C_FONDO);
        } else {
            $pdf->SetFillColor(...C_BLANCO);
        }
        $pdf->Rect($datosX, $y, $datosW, $filaH, 'F');

        // Etiqueta
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetTextColor(...C_PRIMARIO);
        $pdf->SetXY($datosX + 2, $y + 1.5);
        $pdf->Cell(36, 5, $etiqueta . ':', 0, 0, 'L');

        // Valor
        $pdf->SetFont('helvetica', '', 9);
        $pdf->SetTextColor(...C_TEXTO);
        $pdf->SetXY($datosX + 39, $y + 1.5);
        $pdf->Cell($datosW - 41, 5, htmlspecialchars($valor), 0, 0, 'L');
    }

    // Borde exterior de la tabla
    $pdf->SetDrawColor(...C_SECUNDARIO);
    $pdf->SetLineWidth(0.5);
    $pdf->RoundedRect($datosX, $datosY, $datosW, count($campos) * $filaH, 2, '1111', 'D');

    // ── Sección comportamiento ──────────────────────────────────────────────
    $comportY = $fotoY + $fotoH + 6;

    // Encabezado sección
    $pdf->SetFillColor(...C_SECUNDARIO);
    $pdf->SetTextColor(...C_BLANCO);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(15, $comportY);
    $pdf->Cell(180, 8, '  Características de Comportamiento', 0, 1, 'L', true);

    // Franja dorada decorativa bajo el encabezado
    $pdf->SetFillColor(...C_ACENTO);
    $pdf->Rect(15, $comportY + 8, 180, 0.8, 'F');

    $comportY += 10;

    // Caja con fondo suave para el texto
    $pdf->SetFillColor(...C_FONDO);
    $pdf->SetDrawColor(...C_SECUNDARIO);
    $pdf->SetLineWidth(0.4);

    $texto = htmlspecialchars($row['caracteristicas_de_comportamiento_mascota']);
    $pdf->writeHTMLCell(
        180,
        0,
        15,
        $comportY,
        '<span style="font-size:10px; color:#23233d; line-height:1.7;">' . $texto . '</span>',
        ['LRTB' => ['width' => 0.5, 'color' => [30, 80, 160]]],
        1,
        true,
        true,
        'J',
        true
    );
}

// ─── Descargar ────────────────────────────────────────────────────────────────
$pdf->Output('reporte_mascotas_asopaticas.pdf', 'D');
