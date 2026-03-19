<?php
include_once("bd/Conexion.php");

$correo = strtolower($_POST['email']);

// Consulta segura
$sql = "SELECT id_usuarios, correo_usuario 
        FROM tabla_usuarios 
        WHERE correo_usuario = :correo";

$stmt = $dbh->prepare($sql);
$stmt->bindParam(':correo', $correo);
$stmt->execute();

$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if ($usuario) {

    $idUsuario = $usuario['id_usuarios'];

    // Generar código
    $codigoSeguridad = sprintf("%06d", mt_rand(0, 999999));

    $destinatario = $correo;
    $asunto = 'Código de recuperación';
    $cuerpo = 'Tu código de seguridad es: ' . $codigoSeguridad;
    $headers = 'From: asopaticas@asopaticas.com';

    if (true) {

        $sqlInsert = "
            INSERT INTO tabla_recuperar_clave 
            (id_usuarios, codigo, id_estado_codigo, fecha_enviado)
            VALUES (:idUsuario, :codigo, 1, NOW())
        ";

        $stmtInsert = $dbh->prepare($sqlInsert);
        $stmtInsert->bindParam(':idUsuario', $idUsuario);
        $stmtInsert->bindParam(':codigo', $codigoSeguridad);

        if ($stmtInsert->execute()) {
            echo "2309"; // éxito
        } else {
            echo "0923"; // error BD
        }
    } else {
        echo "51"; // error al enviar correo
    }
} else {
    echo "0925"; // correo no existe
}
