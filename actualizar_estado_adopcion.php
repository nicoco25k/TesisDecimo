<?php
// Obtener el ID del usuario desde la solicitud AJAX
$id_mascotas = $_POST['id_mascotas'];

// Realizar la actualización en la base de datos
include_once("bd/Conexion.php");

// Obtener el estado actual de la mascota
$sqlEstado = "SELECT id_estado_adopcion_mascota FROM tabla_mascotas WHERE id_mascotas = :id_mascotas";
$stmtEstado = $dbh->prepare($sqlEstado);
$stmtEstado->bindParam(':id_mascotas', $id_mascotas);
$stmtEstado->execute();
$estadoMascota = $stmtEstado->fetchColumn();

// Determinar el nuevo estado de la mascota
$nuevoEstado = ($estadoMascota == '1') ? '2' : '1';

// Actualizar el estado de la mascota en la base de datos
$sql = "UPDATE tabla_mascotas SET id_estado_adopcion_mascota = :nuevoEstado WHERE id_mascotas = :id_mascotas";

$stmt = $dbh->prepare($sql);
$stmt->bindParam(':nuevoEstado', $nuevoEstado);
$stmt->bindParam(':id_mascotas', $id_mascotas);

if ($stmt->execute()) {
    // Enviar una respuesta de éxito
    echo 'success';
} else {
    // Ocurrió un error al actualizar el estado de la mascota
    echo 'error';
}
