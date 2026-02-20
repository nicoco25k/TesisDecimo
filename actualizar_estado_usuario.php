<?php
// Obtener el ID del usuario desde la solicitud AJAX
$idUsuario = $_POST['idUsuario'];

// Realizar la actualización en la base de datos
include_once("bd/Conexion.php");

// Obtener el estado actual del usuario
$sqlEstado = "SELECT id_estado_usuario FROM tabla_usuarios WHERE id_usuarios = :idUsuario";
$stmtEstado = $dbh->prepare($sqlEstado);
$stmtEstado->bindParam(':idUsuario', $idUsuario);
$stmtEstado->execute();
$estadoUsuario = $stmtEstado->fetchColumn();

// Determinar el nuevo estado del usuario
$nuevoEstado = ($estadoUsuario == '1') ? '2' : '1';

// Actualizar el estado del usuario en la base de datos
$sql = "UPDATE tabla_usuarios SET id_estado_usuario = :nuevoEstado WHERE id_usuarios = :idUsuario";

$stmt = $dbh->prepare($sql);
$stmt->bindParam(':nuevoEstado', $nuevoEstado);
$stmt->bindParam(':idUsuario', $idUsuario);

if ($stmt->execute()) {
    // Enviar una respuesta de éxito
    echo 'Éxito';
} else {
    // Ocurrió un error al actualizar el estado del usuario
    echo 'Error';
}
?>
