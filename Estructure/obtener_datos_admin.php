<?php

$usuario = $_SESSION['usuario'];

$sql = "SELECT nombre_usuario, apellido_usuario, telefono_usuario, nombre_documento, numero_documento_usuario, correo_usuario 
        FROM tabla_usuarios, tabla_documetno 
        WHERE tabla_usuarios.id_tipo_documento = tabla_documetno.id_tipo_documento 
        AND nickname_usuario = '$usuario'";

foreach ($dbh->query($sql) as $row) {
    $nombre_usuario           = $row['nombre_usuario'];
    $apellido_usuario         = $row['apellido_usuario'];
    $telefono_usuario         = $row['telefono_usuario'];
    $nombre_documento         = $row['nombre_documento'];
    $numero_documento_usuario = $row['numero_documento_usuario'];
    $correo_usuario           = $row['correo_usuario'];
}
