<?php
session_start();

// 1. Validar que exista sesión
if (!isset($_SESSION['usuario'])) {
    header('Location: iniciar_sesion.php');
    exit();
}

// 2. Obtener el nickname del usuario
$usuario = $_SESSION['usuario'];

include_once("bd/Conexion.php");

// 3. Consultar rol y nombre de forma segura
$stmt = $dbh->prepare("SELECT id_rol, nombre_usuario FROM tabla_usuarios WHERE nickname_usuario = ?");
$stmt->execute([$usuario]);
$row = $stmt->fetch();

// 4. Validar que exista y que sea admin (id_rol = 2)
if (!$row || $row['id_rol'] != 2) {
    header('Location: iniciar_sesion.php');
    exit();
}

// 5. Disponible en todas las páginas que incluyan este archivo
$nombre_usuario = $row['nombre_usuario'];
