<?php
require_once('tcpdf/tcpdf.php');
include_once("bd/Conexion.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Crear nuevo PDF
class MYPDF extends TCPDF {
    // Agregar cabecera personalizada
    public function Header() {
        $this->SetY(20); // Ajusta la posición vertical del título
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 15, 'Reporte de Mascotas Disponibles de la asociación ASOPATICAS', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(15); // Espacio adicional entre el título y el contenido
    }

    // Agregar pie de página personalizado
    public function Footer() {
        $this->SetY(-25);  // Ajusta la posición vertical del pie de página
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        // Colocar la imagen al pie de la página con margen superior ajustado
        $this->SetY(-45); // Ajusta la posición Y de la imagen (45mm desde el fondo, para dar espacio)
        $this->SetX((210 - 60) / 2);  // Centra la imagen en la página (60mm de ancho)
        if (isset($this->imagePath)) {
            $this->Image($this->imagePath, '', '', 60, 60); // Ajustamos la imagen a 60mm x 60mm
        }
    }
}

// Crear instancia del PDF
$pdf = new MYPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistema de Adopción');
$pdf->SetTitle('INFORMACIÓN DE LA MASCOTA');
$pdf->SetSubject('Detalles de las mascotas');
$pdf->SetMargins(15, 30, 15); // Ajustar márgenes para el encabezado
$pdf->SetAutoPageBreak(TRUE, 15);

// Consulta para obtener las mascotas disponibles
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
        JOIN mascota_edad m3 ON tm.id_edad_mascota = m3.id_edad_mascota
        JOIN mascota_especie m4 ON tm.id_especie_mascota = m4.id_especie_mascota
        JOIN mascota_esterilizacion m5 ON tm.id_estado_esterilizacion_mascota = m5.id_estado_esterilizacion_mascota
        JOIN mascota_raza m9 ON tm.id_razas_mascota = m9.id_razas_mascota
        JOIN mascota_sexo m10 ON tm.id_sexo_mascota = m10.id_sexo_mascota
        JOIN mascota_vacuna m12 ON tm.id_estado_vacuna_mascota = m12.id_estado_vacuna_mascota
";

$mascotas = $dbh->query($sql);

if (!$mascotas) {
    die("Error en la consulta SQL: " . $dbh->errorInfo()[2]);
}

foreach ($mascotas as $row) {
    $pdf->AddPage();  // Agregar una página para cada mascota

    $html = "
        <style>
            h1 { color: #4CAF50; font-size: 20px; font-weight: bold; }
            p { font-size: 12px; line-height: 1.5; }
            .highlight { font-weight: bold; color: #333; }
            .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
            .table th { background-color: #f2f2f2; color: #333; }
            .table tr:nth-child(even) { background-color: #f9f9f9; }
            .table td { padding-left: 10px; padding-right: 10px; }
        </style><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <h1>Reporte de Mascota</h1>
        <p><span class='highlight'>Nombre de la Mascota:</span> " . htmlspecialchars($row['nombre_mascota']) . "</p>
        <p><span class='highlight'>Especie:</span> " . htmlspecialchars($row['nombre_especie']) . "</p>
        <p><span class='highlight'>Raza:</span> " . htmlspecialchars($row['nombre_raza']) . "</p>
        <p><span class='highlight'>Sexo:</span> " . htmlspecialchars($row['nombre_sexo']) . "</p>
        <p><span class='highlight'>Edad:</span> " . htmlspecialchars($row['nombre_edad']) . "</p>
        <p><span class='highlight'>Estado de Desparacitación:</span> " . htmlspecialchars($row['nombre_desparasitacion']) . "</p>
        <p><span class='highlight'>Estado de Esterilización:</span> " . htmlspecialchars($row['nombre_esterilizacion']) . "</p>
        <p><span class='highlight'>Estado de Vacunación:</span> " . htmlspecialchars($row['nombre_vacuna']) . "</p>
        <p><span class='highlight'>Características Comportamentales:</span> " . htmlspecialchars($row['caracteristicas_de_comportamiento_mascota']) . "</p>
        
        <br><br>
    ";

    // Verifica si hay una imagen de la mascota
    if (!empty($row['ruta_img_mascota']) && file_exists($row['ruta_img_mascota'])) {
        // Ruta absoluta de la imagen (asegurarse de que esté bien definida en el sistema)
        $imagePath = $row['ruta_img_mascota'];
        
        // Centra la imagen en la página (150mm de ancho total, 60mm para la imagen)
        $pdf->SetX((210 - 60) / 2);  // Centra la imagen en la página

 
        $pdf->Image($imagePath, '', '', 60, 60); // Ajustamos la imagen a 60mm x 60mm
    }
    
    $pdf->writeHTML($html, true, false, true, false, '');
}

// Descargar el PDF
$pdf->Output('reporte_mascotas.pdf', 'D');
?>
