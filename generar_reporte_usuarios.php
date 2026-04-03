<?php
require_once('tcpdf/tcpdf.php');
include_once("bd/Conexion.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Crear nuevo PDF
class MYPDF extends TCPDF
{
    // Agregar cabecera personalizada
    public function Header()
    {
        $this->SetY(20); // Ajusta la posición vertical del título
        $this->SetFont('helvetica', 'B', 14);
        $this->Cell(0, 15, 'Reporte de Usuarios Registrados', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(15); // Espacio adicional entre el título y el contenido
    }

    // Agregar pie de página personalizado
    public function Footer()
    {
        $this->SetY(-25);  // Ajusta la posición vertical del pie de página
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->getAliasNumPage() . '/' . $this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

// Crear instancia del PDF
$pdf = new MYPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistema de Gestión');
$pdf->SetTitle('INFORMACIÓN DE USUARIOS');
$pdf->SetSubject('Detalles de los usuarios registrados');
$pdf->SetMargins(15, 30, 15); // Ajustar márgenes para el encabezado
$pdf->SetAutoPageBreak(TRUE, 15);

// Consulta para obtener los usuarios
$sql = "SELECT id_usuarios, nombre_usuario, nickname_usuario, nombre_documento, numero_documento_usuario, correo_usuario, telefono_usuario, nombre_estado
        FROM tabla_usuarios tu, tabla_roles tr, tabla_documetno td, tabla_estado_usuario te
        WHERE tu.id_tipo_documento=td.id_tipo_documento 
          AND tu.id_rol=tr.id_rol 
          AND tu.id_estado_usuario=te.id_estado_usuario 
          AND tr.id_rol=1;";

$usuarios = $dbh->query($sql);

if (!$usuarios) {
    die("Error en la consulta SQL: " . $dbh->errorInfo()[2]);
}
$contador = 0;

foreach ($usuarios as $row) {
    $contador++;

    $pdf->AddPage();  // Agregar una página para cada usuario

    $html = "
        <style>
            h1 { color: #4CAF50; font-size: 20px; font-weight: bold; text-align: center; }
            p { font-size: 12px; line-height: 1.5; }
            .highlight { font-weight: bold; color: #333; }
            .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
            .table th, .table td { border: 1px solid #ddd; padding: 8px; text-align: left; font-size: 12px; }
            .table th { background-color: #f2f2f2; color: #333; }
            .table tr:nth-child(even) { background-color: #f9f9f9; }
            .table td { padding-left: 10px; padding-right: 10px; }
        </style>

                <h1><br>Reporte de Usuario #{$contador}</h1>

        <p><span class='highlight'>Nombre del Usuario:</span> " . htmlspecialchars($row['nombre_usuario']) . "</p>
        <p><span class='highlight'>Nickname:</span> " . htmlspecialchars($row['nickname_usuario']) . "</p>
        <p><span class='highlight'>Tipo de Documento:</span> " . htmlspecialchars($row['nombre_documento']) . "</p>
        <p><span class='highlight'>Número de Documento:</span> " . htmlspecialchars($row['numero_documento_usuario']) . "</p>
        <p><span class='highlight'>Correo Electrónico:</span> " . htmlspecialchars($row['correo_usuario']) . "</p>
        <p><span class='highlight'>Teléfono:</span> " . htmlspecialchars($row['telefono_usuario']) . "</p>
        <p><span class='highlight'>Estado:</span> " . htmlspecialchars($row['nombre_estado']) . "</p>
        <br><br>
    ";

    $pdf->writeHTML($html, true, false, true, false, '');
}

// Descargar el PDF
$pdf->Output('reporte_usuarios.pdf', 'D');
