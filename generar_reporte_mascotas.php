<?php
require_once('tcpdf/tcpdf.php');
include_once("bd/Conexion.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

// ─── Constantes de diseño ────────────────────────────────────────────────────
define('COLOR_PRIMARIO',   [44,  85,  48]);   // Verde oscuro institucional
define('COLOR_SECUNDARIO', [76, 153,  0]);    // Verde claro
define('COLOR_ACENTO',     [255, 140,  0]);   // Naranja para detalles
define('COLOR_FONDO',      [245, 250, 245]);  // Fondo suave
define('COLOR_TEXTO',      [50,  50,  50]);   // Gris oscuro legible
define('LOGO_PATH',        'assets/logo_asopaticas.png'); // ← ajusta tu ruta real

// ─── Clase PDF personalizada ─────────────────────────────────────────────────
class MYPDF extends TCPDF
{
    public function Header()
    {
        // Barra superior con color primario
        $this->SetFillColor(...COLOR_PRIMARIO);
        $this->Rect(0, 0, 210, 22, 'F');

        // Logo (si existe)
        if (file_exists(LOGO_PATH)) {
            $this->Image(LOGO_PATH, 8, 3, 16, 16, '', '', '', false, 300, '', false, false, 0);
        }

        // Título en la barra
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('helvetica', 'B', 11);
        $this->SetXY(28, 6);
        $this->Cell(0, 10, 'ASOPATICAS — Mascotas Registradas en la platforma', 0, 0, 'L');

        // Línea decorativa naranja bajo la barra
        $this->SetDrawColor(...COLOR_ACENTO);
        $this->SetLineWidth(0.8);
        $this->Line(0, 22, 210, 22);

        // Restaurar color de texto
        $this->SetTextColor(...COLOR_TEXTO);
        $this->SetLineWidth(0.2);
    }

    public function Footer()
    {
        $this->SetY(-14);
        $this->SetDrawColor(...COLOR_SECUNDARIO);
        $this->SetLineWidth(0.5);
        $this->Line(15, $this->GetY(), 195, $this->GetY());

        $this->SetFont('helvetica', 'I', 8);
        $this->SetTextColor(130, 130, 130);
        $this->Cell(
            0,
            8,
            'ASOPATICAS  •  Reporte generado el ' . date('d/m/Y') .
                '  •  Página ' . $this->getAliasNumPage() . ' de ' . $this->getAliasNbPages(),
            0,
            0,
            'C'
        );
    }
}

// ─── Instancia del PDF ────────────────────────────────────────────────────────
$pdf = new MYPDF('P', 'mm', 'A4', true, 'UTF-8', false);
$pdf->SetCreator('Sistema de Adopción ASOPATICAS');
$pdf->SetAuthor('ASOPATICAS');
$pdf->SetTitle('Reporte de Mascotas Disponibles');
$pdf->SetSubject('Mascotas en adopción');
$pdf->SetMargins(15, 28, 15);
$pdf->SetAutoPageBreak(true, 20);
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// ─── PORTADA ─────────────────────────────────────────────────────────────────
$pdf->AddPage();
$pdf->setPrintHeader(false); // Sin encabezado en portada
$pdf->setPrintFooter(false);

// Fondo de portada
$pdf->SetFillColor(...COLOR_PRIMARIO);
$pdf->Rect(0, 0, 210, 297, 'F');

// Banda decorativa naranja
$pdf->SetFillColor(...COLOR_ACENTO);
$pdf->Rect(0, 120, 210, 4, 'F');
$pdf->Rect(0, 130, 210, 1, 'F');

// Logo grande centrado
if (file_exists(LOGO_PATH)) {
    $pdf->Image(LOGO_PATH, 80, 40, 50, 50, '', '', '', false, 300);
}

// Nombre de la organización
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 28);
$pdf->SetXY(0, 100);
$pdf->Cell(210, 14, 'ASOPATICAS', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 13);
$pdf->SetXY(0, 116);
$pdf->Cell(210, 8, 'Asociación de Protección Animal', 0, 1, 'C');

// Título del reporte
$pdf->SetFillColor(...COLOR_ACENTO);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('helvetica', 'B', 18);
$pdf->SetXY(30, 140);
$pdf->Cell(150, 14, 'REPORTE DE MASCOTAS', 0, 1, 'C', true);

$pdf->SetFont('helvetica', '', 12);
$pdf->SetXY(30, 156);
$pdf->Cell(150, 10, 'Disponibles para Adopción', 0, 1, 'C');

// Fecha
$pdf->SetFont('helvetica', 'I', 10);
$pdf->SetTextColor(200, 230, 200);
$pdf->SetXY(0, 200);
$pdf->Cell(210, 8, 'Generado el ' . date('d \d\e F \d\e Y'), 0, 1, 'C');

// Pie de portada
$pdf->SetTextColor(150, 200, 150);
$pdf->SetFont('helvetica', '', 9);
$pdf->SetXY(0, 275);
$pdf->Cell(210, 6, 'Documento confidencial — Solo para uso interno', 0, 1, 'C');

// Reactivar header/footer para las demás páginas
$pdf->setPrintHeader(true);
$pdf->setPrintFooter(true);

// ─── Consulta ─────────────────────────────────────────────────────────────────
$sql = "SELECT 
            tm.id_mascotas,
            tm.nombre_mascota,
            m4.nombre_especie,
            m9.nombre_raza,
            m10.nombre_sexo,
            m3.nombre_edad,
            m2.nombre_desparasitacion,
            m5.nombre_esterilizacion,
            m12.nombre_vacuna,
            tm.ruta_img_mascota,
            tm.caracteristicas_de_comportamiento_mascota
        FROM tabla_mascotas tm
        JOIN mascota_desparasitacion m2 ON tm.id_estado_desparasitacion_mascota = m2.id_estado_desparasitacion_mascota
        JOIN mascota_edad          m3 ON tm.id_edad_mascota                    = m3.id_edad_mascota
        JOIN mascota_especie        m4 ON tm.id_especie_mascota                 = m4.id_especie_mascota
        JOIN mascota_esterilizacion m5 ON tm.id_estado_esterilizacion_mascota  = m5.id_estado_esterilizacion_mascota
        JOIN mascota_raza           m9 ON tm.id_razas_mascota                  = m9.id_razas_mascota
        JOIN mascota_sexo           m10 ON tm.id_sexo_mascota                  = m10.id_sexo_mascota
        JOIN mascota_vacuna         m12 ON tm.id_estado_vacuna_mascota         = m12.id_estado_vacuna_mascota";

$mascotas = $dbh->query($sql);
if (!$mascotas) {
    die("Error en la consulta SQL: " . $dbh->errorInfo()[2]);
}

// ─── Una página por mascota ───────────────────────────────────────────────────
foreach ($mascotas as $row) {
    $pdf->AddPage();

    $startY = 30; // Justo bajo el header

    // ── Título de la ficha ──────────────────────────────────────────────────
    $pdf->SetFillColor(...COLOR_PRIMARIO);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('helvetica', 'B', 13);
    $pdf->SetXY(15, $startY);
    $pdf->Cell(180, 10, 'Ficha de Mascota: ' . strtoupper($row['nombre_mascota']), 0, 1, 'L', true);

    $startY += 13;

    // ── Foto a la IZQUIERDA ─────────────────────────────────────────────────
    $fotoW = 55;
    $fotoH = 55;
    $fotoX = 15;
    $fotoY = $startY;

    $hayFoto = !empty($row['ruta_img_mascota']) && file_exists($row['ruta_img_mascota']);

    if ($hayFoto) {
        // Marco de la foto
        $pdf->SetDrawColor(...COLOR_SECUNDARIO);
        $pdf->SetLineWidth(0.6);
        $pdf->RoundedRect($fotoX - 1, $fotoY - 1, $fotoW + 2, $fotoH + 2, 2, '1111', 'D');
        $pdf->Image($row['ruta_img_mascota'], $fotoX, $fotoY, $fotoW, $fotoH, '', '', '', true, 150, '', false, false, 0, true);
    } else {
        // Placeholder si no hay foto
        $pdf->SetFillColor(...COLOR_FONDO);
        $pdf->SetDrawColor(...COLOR_SECUNDARIO);
        $pdf->RoundedRect($fotoX, $fotoY, $fotoW, $fotoH, 2, '1111', 'DF');
        $pdf->SetTextColor(170, 170, 170);
        $pdf->SetFont('helvetica', 'I', 9);
        $pdf->SetXY($fotoX, $fotoY + 22);
        $pdf->Cell($fotoW, 8, 'Sin imagen', 0, 0, 'C');
    }

    // ── Datos a la DERECHA de la foto ───────────────────────────────────────
    $datosX = $fotoX + $fotoW + 6;  // 76mm desde el margen
    $datosW = 180 - ($datosX - 15); // Ancho restante
    $datosY = $startY;

    // Función helper para cada fila de dato
    $campos = [
        ['Especie',                $row['nombre_especie']],
        ['Raza',                   $row['nombre_raza']],
        ['Sexo',                   $row['nombre_sexo']],
        ['Edad',                   $row['nombre_edad']],
        ['Desparasitación',        $row['nombre_desparasitacion']],
        ['Esterilización',         $row['nombre_esterilizacion']],
        ['Vacunación',             $row['nombre_vacuna']],
    ];

    $filaH = 7;
    foreach ($campos as $i => [$etiqueta, $valor]) {
        $y = $datosY + ($i * $filaH);

        // Fondo alterno en filas
        if ($i % 2 === 0) {
            $pdf->SetFillColor(...COLOR_FONDO);
            $pdf->Rect($datosX, $y, $datosW, $filaH, 'F');
        }

        // Etiqueta
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->SetTextColor(...COLOR_PRIMARIO);
        $pdf->SetXY($datosX + 1, $y + 1);
        $pdf->Cell(38, 5, $etiqueta . ':', 0, 0, 'L');

        // Valor
        $pdf->SetFont('helvetica', '', 9);
        $pdf->SetTextColor(...COLOR_TEXTO);
        $pdf->SetXY($datosX + 40, $y + 1);
        $pdf->Cell($datosW - 42, 5, htmlspecialchars($valor), 0, 0, 'L');
    }

    // Borde alrededor del bloque de datos
    $pdf->SetDrawColor(...COLOR_SECUNDARIO);
    $pdf->SetLineWidth(0.4);
    $pdf->RoundedRect($datosX, $datosY, $datosW, count($campos) * $filaH, 2, '1111', 'D');

    // ── Sección características de comportamiento ───────────────────────────
    $comportY = $startY + $fotoH + 6;

    $pdf->SetFillColor(...COLOR_SECUNDARIO);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->SetXY(15, $comportY);
    $pdf->Cell(180, 8, '  Características de Comportamiento', 0, 1, 'L', true);

    $comportY += 10;
    $pdf->SetFillColor(...COLOR_FONDO);
    $pdf->SetTextColor(...COLOR_TEXTO);
    $pdf->SetFont('helvetica', '', 10);
    $pdf->SetXY(15, $comportY);

    // Caja con fondo suave para el texto
    $texto = htmlspecialchars($row['caracteristicas_de_comportamiento_mascota']);
    $pdf->SetFillColor(...COLOR_FONDO);
    $pdf->writeHTMLCell(
        180,
        0,
        15,
        $comportY,
        '<span style="font-size:10px; line-height:1.6;">' . $texto . '</span>',
        ['LRTB' => ['width' => 0.4, 'color' => array_values(COLOR_SECUNDARIO)]],
        1,
        true,
        true,
        'J',
        true
    );
}

// ─── Descargar ────────────────────────────────────────────────────────────────
$pdf->Output('reporte_mascotas_asopaticas.pdf', 'D');
