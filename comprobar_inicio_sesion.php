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

    $_SESSION['usuario'] = $usuario;

    // 🔥 CLAVE
    $rol = trim(strtolower($user['type']));

    if ($rol == 'administrador') {
        $_SESSION['rol'] = 'admin';
        echo 'admin';
    } elseif ($rol == 'root') {
        $_SESSION['rol'] = 'root';
        echo 'root';
    } else {
        $_SESSION['rol'] = 'user';
        echo 'user';
    }
} else {
    echo 'error';
}
