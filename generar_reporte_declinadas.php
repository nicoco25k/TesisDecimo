<?php
require_once('tcpdf/tcpdf.php');
include_once("bd/Conexion.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Crear nuevo PDF
class MYPDF extends TCPDF {
    // Agregar cabecera personalizada
    public function Header() {
        $imageFile = 'files/img/logo_asopaticas.png'; // Cambia esta ruta al logotipo de ASOPATICAS
 
        if (file_exists($imageFile)) {
            // Obtener el ancho de la página
            $pageWidth = $this->getPageWidth();
            // Calcular la posición X para que esté en la esquina superior derecha
            $imageX = $pageWidth - 10 - 30; // 10 es el margen y 30 es el ancho de la imagen
            $this->Image($imageFile, $imageX, 10, 30, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        }
        

        $this->SetY(20); // Ajusta la posición vertical del título
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 15, 'Reporte de ADOPCIONES RECHAZADAS - ASOPATICAS', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(15); // Espacio adicional entre el título y el contenido
    }

    // Agregar pie de página personalizado
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// Crear instancia del PDF
$pdf = new MYPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistema de Adopción');
$pdf->SetTitle('Reporte de Solicitudes de Adopción');
$pdf->SetSubject('Detalles de solicitudes');
$pdf->SetMargins(15, 30, 15); // Ajustar márgenes para el encabezado
$pdf->SetAutoPageBreak(TRUE, 15);

// Consulta para obtener solicitudes
$sql = "SELECT * FROM bot_solicitud_adopcion WHERE id_estado_adopcion = 1";
$solicitudes = $dbh->query($sql);

if (!$solicitudes) {
    die("Error en la consulta SQL: " . $dbh->errorInfo()[2]);
}

// Preguntas específicas
$preguntas = [
    "¿Qué tipo de vivienda tienes?",
    "¿Tienes un jardín o espacio al aire libre?",
    "¿Tienes vecinos que se opongan a tener mascotas?",
    "¿Hay niños en tu hogar?",
    "¿Alguien en tu familia tiene alergias a los animales?",
    "¿Hay otros animales en casa?",
    "¿Trabajas actualmente?",
    "¿Cuántas horas al día estarías en casa?",
    "¿Qué esperas de la convivencia con una mascota?",
    "¿Cuáles son los gastos que consideras al tener una mascota?",
    "¿Por qué quieres adoptar una mascota?",
    "¿Qué harías si la mascota muestra problemas de comportamiento?"
];

$contador = 0;

foreach ($solicitudes as $row) {
    $contador++;
    $pdf->AddPage();
    $html = "
        <style>
            h1 {   color: #4CAF50;
                font-size: 20px;
                font-weight: bold;
                text-align: center;
                }
            h3 { color: #333; font-size: 14px; }
            p { font-size: 12px; line-height: 1.5; }
            .highlight { font-weight: bold; color: #333; }
            .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
            .table th { background-color: #f2f2f2; color: #333; }
            .table tr:nth-child(even) { background-color: #f9f9f9; }
            .table td { padding-left: 10px; padding-right: 10px; }
        </style>
        <h1><br>Solicitud de Adopción #{$contador}</h1>
        <p><span class='highlight'>Nombre de la Mascota:</span> " . htmlspecialchars($row['nombre_mascota']) . "</p>
        <p><span class='highlight'>Nombre del Usuario:</span> " . htmlspecialchars($row['usuario_nombre']) . "</p>
        <p><span class='highlight'>Correo:</span> " . htmlspecialchars($row['usuario_correo']) . "</p>
        <p><span class='highlight'>Teléfono:</span> " . htmlspecialchars($row['usuario_numero']) . "</p>
        <p><span class='highlight'>Dirección:</span> " . htmlspecialchars($row['usuario_direccion']) . "</p>
        
        <h3>Preguntas Evaluativas</h3>
        <table class='table'>
            <thead>
                <tr>
                    <th>Pregunta</th>
                    <th>Respuesta</th>
                </tr>
            </thead>
            <tbody>";
    
    foreach ($preguntas as $index => $pregunta) {
        $respuesta = htmlspecialchars($row['pregunta_' . ($index + 1)]);
        $html .= "
                <tr>
                    <td>{$pregunta}</td>
                    <td>{$respuesta}</td>
                </tr>";
    }

    $html .= "
            </tbody>
        </table>
        
        <br><br>
        <p><span class='highlight'>Estado de mascota: </span> Adopción Rechazda </p>

        <p><span class='highlight'>Porcentaje de Viabilidad:</span> " . htmlspecialchars($row['porcentaje_viabilidad']) . "%</p>
        <p><span class='highlight'>Fecha de Registro:</span> " . htmlspecialchars($row['fecha_registro']) . "</p>
        ";
    
    $pdf->writeHTML($html, true, false, true, false, '');
}

if ($contador == 0) {
    die("No se encontraron solicitudes para generar el reporte.");
}

// Descargar el PDF
$pdf->Output('reporte_solicitudes.pdf', 'D');
?>
