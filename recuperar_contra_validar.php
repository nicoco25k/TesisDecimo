<?php
include_once("bd/Conexion.php");


$correo = $_POST['email'];
$correo = strtolower($correo);

// Consulta SQL para buscar el correo electrónico en la tabla de usuarios
$sql = "SELECT id_usuarios, correo_usuario FROM tabla_usuarios WHERE correo_usuario = '$correo'";

$encontrado = false;

foreach ($dbh->query($sql) as $row) {
    $correo_c = $row['correo_usuario'];

    if ($correo_c == $correo) {
        $idUsuario = $row['id_usuarios'];
        $codigoSeguridad = sprintf("%06d", mt_rand(0, 999999));
        $destinatario = $correo_c;
        $asunto = 'Has solicitado un código de seguridad para recuperar tu contraseña';
        $cuerpo = 'Has solicitado restablecer tu contraseña, tu código de seguridad es: ' . $codigoSeguridad;
        $headers = 'From: asopaticas@asopaticas.com' . "\r\n" .
        'Reply-To: asopaticas@asopaticas.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();


        if (mail($destinatario, $asunto, $cuerpo, $headers)) {
           
            $sql = "
            INSERT INTO `tabla_recuperar_clave`(`id_recuperar_clave`, `id_usuarios`, `codigo`, `id_estado_codigo`, `fecha_enviado`) 
            VALUES (NULL,'$idUsuario','$codigoSeguridad','1',CONVERT_TZ(NOW(), '+00:00', '-05:00'));
    ";
    
    
    
    if (!$dbh->query($sql)) {
        echo "0923";
    }
    else{
        echo "2309";
    }
    
    }




       

      




        $encontrado = true;
        break;
    }

    else {
        echo "51";
    }




}


if (!$encontrado) {
    echo "0925";
}
?>
