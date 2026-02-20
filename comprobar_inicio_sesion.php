<?php

include_once("bd/Conexion.php");
session_start();

$usuario = $_POST["usuario"];
$password = $_POST["password"];


$stmt = $dbh->prepare("SELECT r.nombre_rol AS type 
FROM tabla_usuarios u 
INNER JOIN tabla_roles r ON u.id_rol = r.id_rol 
WHERE u.nickname_usuario = :usuario 
AND u.clave_usuario = :password 
AND u.id_estado_usuario = '1'");




$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':password', $password);
$stmt->execute();

$user = $stmt->fetch();

if ($user) {
    $_SESSION['usuraio'] = $usuario;
    echo $user['type'];


} else {
    echo 'error';
}


?>
