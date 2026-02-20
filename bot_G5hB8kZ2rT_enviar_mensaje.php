<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Incluye tu archivo de conexión
include_once("bd/Conexion.php");

// Verifica si la conexión se realizó correctamente
if (!$dbh) {
    echo "Error en la conexión a la base de datos";
    exit;
}

// Verifica si todos los campos han sido enviados
if (isset($_POST["mensaje_nombre"], $_POST["mensaje_telefono"], $_POST["mensaje_correo"], $_POST["mensaje_mensaje"])) {
    // Asigna los valores directamente desde el POST
    $nombre = $_POST["mensaje_nombre"];
    $telefono = $_POST["mensaje_telefono"];
    $correo = $_POST["mensaje_correo"];
    $texto = $_POST['mensaje_mensaje'];

    // Limpia los valores recibidos para evitar inyecciones de código
    $nombre = htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8');
    $telefono = htmlspecialchars($telefono, ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($correo, ENT_QUOTES, 'UTF-8');
    $texto = htmlspecialchars($texto, ENT_QUOTES, 'UTF-8');

    // Prepara la consulta SQL con un statement preparado
    $sql = "
        INSERT INTO `tabla_de_mensajes`
        (`nombre_usuario_mensaje`, `telefono_usuario_mensaje`, `correo_usuario_mensaje`, `mensaje`, `fecha_registro`) 
        VALUES (:nombre, :telefono, :correo, :mensaje, CONVERT_TZ(NOW(), '+00:00', '-05:00'));
    ";

    try {
        // Prepara y ejecuta la consulta
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':telefono', $telefono, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':mensaje', $texto, PDO::PARAM_STR);

        if ($stmt->execute()) {
            echo "Mensaje guardado correctamente";

     // Aquí se envían los correos electrónicos
$destinatarios = [
    'gamernico703@gmail.com',
    'nsalazar29@itfip.edu.co'
    //'amigosdeasopaticas@gmail.com' // Tercer correo
];

$asunto = "Nuevo mensaje de la plataforma web de ASOPATICAS";

// Estructura HTML del correo
$cuerpo = "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
        }
        .content {
            margin-bottom: 20px;
        }
        .content h2 {
            color: #555;
        }
        .content p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <img src='https://asopaticas.org/files/img/logofull.png' alt='ASOPATICAS Logo'>
            <h1>Nuevo Mensaje Recibido</h1>
        </div>
        <div class='content'>
            <h2>Datos del Remitente:</h2>
            <p><strong>Nombre:</strong> $nombre</p>
            <p><strong>Teléfono:</strong> $telefono</p>
            <p><strong>Correo:</strong> $correo</p>
            
            <h2>Mensaje:</h2>
            <p>$texto</p>
        </div>
        <div class='footer'>
            <p>Este correo ha sido generado automáticamente por la Plataforma ASOPATICAS.</p>
            <p>Si tienes dudas, contáctanos en <a href='mailto:amigosdeasopaticas@gmail.com'>amigosdeasopaticas@gmail.com</a>.</p>
        </div>
    </div>
</body>
</html>
";

// Encabezados del correo
$headers  = "From: ASOPATICAS <amigosdeasopaticas@gmail.com>\r\n";
$headers .= "Reply-To: amigosdeasopaticas@gmail.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

// Envía el correo a cada destinatario
foreach ($destinatarios as $destinatario) {
    mail($destinatario, $asunto, $cuerpo, $headers);
}







// Aquí se envían los correos electrónicos al remitente
$destinatarios_usuario = [
    'pa320411@gmail.com',
    $correo
];

$asunto_usuario = "Confirmación de Mensaje - Plataforma ASOPATICAS";

// Estructura HTML del correo
$cuerpo_usuario = "
<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            width: 80%;
            margin: auto;
            border: 1px solid #ddd;
            padding: 20px;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 150px;
        }
        .content {
            margin-bottom: 20px;
        }
        .content h2 {
            color: #555;
        }
        .content p {
            margin: 5px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class='container'>
        <div class='header'>
            <img src='https://asopaticas.org/files/img/logofull.png' alt='ASOPATICAS Logo'>
            <h1>¡Gracias por contactarnos!</h1>
        </div>
        <div class='content'>
            <p>Hola <strong>$nombre</strong>,</p>
            <p>Hemos recibido tu mensaje y ha sido registrado exitosamente en nuestra plataforma. A continuación, te enviamos un comprobante con los detalles:</p>
            <p><strong>Nombre:</strong> $nombre</p>
            <p><strong>Teléfono:</strong> $telefono</p>
            <p><strong>Correo:</strong> $correo</p>
            <p><strong>Mensaje:</strong> $texto</p>
            <p>Nos pondremos en contacto contigo lo antes posible. Gracias por apoyar nuestra misión de bienestar animal.</p>
        </div>
        <div class='footer'>
            <p>Este correo ha sido generado automáticamente por la Plataforma ASOPATICAS.</p>
            <p>Si tienes dudas, contáctanos en <a href='mailto:amigosdeasopaticas@gmail.com'>amigosdeasopaticas@gmail.com</a>.</p>
        </div>
    </div>
</body>
</html>
";

// Encabezados del correo
$headers_usuario  = "From: ASOPATICAS <amigosdeasopaticas@gmail.com>\r\n";
$headers_usuario .= "Reply-To: amigosdeasopaticas@gmail.com\r\n";
$headers_usuario .= "MIME-Version: 1.0\r\n";
$headers_usuario .= "Content-Type: text/html; charset=UTF-8\r\n";

// Envía el correo a cada destinatario
foreach ($destinatarios_usuario as $destinatario_usuario) {
    mail($destinatario_usuario, $asunto_usuario, $cuerpo_usuario, $headers_usuario);
}




        } else {
            echo "Error al guardar el mensaje";
        }
    } catch (PDOException $e) {
        // Captura y muestra errores de PDO
        echo "Error en la consulta: " . $e->getMessage();
    }
} else {
    echo "No se recibieron todos los datos necesarios";
}

?>
