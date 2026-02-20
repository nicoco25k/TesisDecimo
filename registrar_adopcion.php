<?php
include_once("bd/Conexion.php");

// Obtener los valores enviados a través de la llamada AJAX
$id_usuario = $_POST['id_usuario'];
$id_mascota = $_POST['id_mascota'];

// Verificar si el usuario ya tiene una solicitud existente para la mascota seleccionada
$sql_verificar = "SELECT COUNT(*) FROM tabla_adopcion WHERE id_usuarios = $id_usuario AND id_mascotas = $id_mascota";
$resultado_verificar = $dbh->query($sql_verificar);
$numero_solicitudes = $resultado_verificar->fetchColumn();

if ($numero_solicitudes > 0) {
    // El usuario ya tiene una solicitud existente para esta mascota
    $response = array('success' => false, 'message' => 'Ya has enviado una solicitud previamente para esta mascota.');
    echo json_encode($response);
} else {
    // Insertar la nueva solicitud en la base de datos
    $sql_insertar = "INSERT INTO tabla_adopcion(id_adopciones, id_usuarios, id_mascotas, fecha_adopcion) 
                     VALUES (NULL, $id_usuario, $id_mascota, CONVERT_TZ(NOW(), '+00:00', '-05:00'))";
    
    if (!$dbh->query($sql_insertar)) {
        // Error al registrar la adopción
        $response = array('success' => false, 'message' => 'Error al registrar la adopción.');
        echo json_encode($response);
    } else {
        // La petición se ha registrado con éxito
        $response = array('success' => true, 'message' => '¡La petición se ha registrado con éxito!');
        echo json_encode($response);
    }
}
?>
