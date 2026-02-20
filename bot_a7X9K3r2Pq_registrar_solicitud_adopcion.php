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
if (isset($_POST["usuario_nombre"], $_POST["usuario_correo"], $_POST["usuario_numero"], $_POST["usuario_direccion"], $_POST["usuario_tipo_documento"], $_POST["usuario_numero_documento"], $_POST["pregunta_1"], $_POST["pregunta_2"], $_POST["pregunta_3"], $_POST["pregunta_4"], $_POST["pregunta_5"], $_POST["pregunta_6"], $_POST["pregunta_7"], $_POST["pregunta_8"], $_POST["pregunta_9"], $_POST["pregunta_10"], $_POST["pregunta_11"], $_POST["pregunta_12"], $_POST["nombre_mascota"], $_POST["porcentaje_viabilidad"])) {
    // Asigna los valores directamente desde el POST
    $nombre = htmlspecialchars($_POST["usuario_nombre"], ENT_QUOTES, 'UTF-8');
    $correo = htmlspecialchars($_POST["usuario_correo"], ENT_QUOTES, 'UTF-8');
    $numero = htmlspecialchars($_POST["usuario_numero"], ENT_QUOTES, 'UTF-8');
    $direccion = htmlspecialchars($_POST["usuario_direccion"], ENT_QUOTES, 'UTF-8');
    $tipo_documento = htmlspecialchars($_POST["usuario_tipo_documento"], ENT_QUOTES, 'UTF-8');
    $numero_documento = htmlspecialchars($_POST["usuario_numero_documento"], ENT_QUOTES, 'UTF-8');
    $pregunta_1 = htmlspecialchars($_POST["pregunta_1"], ENT_QUOTES, 'UTF-8');
    $pregunta_2 = htmlspecialchars($_POST["pregunta_2"], ENT_QUOTES, 'UTF-8');
    $pregunta_3 = htmlspecialchars($_POST["pregunta_3"], ENT_QUOTES, 'UTF-8');
    $pregunta_4 = htmlspecialchars($_POST["pregunta_4"], ENT_QUOTES, 'UTF-8');
    $pregunta_5 = htmlspecialchars($_POST["pregunta_5"], ENT_QUOTES, 'UTF-8');
    $pregunta_6 = htmlspecialchars($_POST["pregunta_6"], ENT_QUOTES, 'UTF-8');
    $pregunta_7 = htmlspecialchars($_POST["pregunta_7"], ENT_QUOTES, 'UTF-8');
    $pregunta_8 = htmlspecialchars($_POST["pregunta_8"], ENT_QUOTES, 'UTF-8');
    $pregunta_9 = htmlspecialchars($_POST["pregunta_9"], ENT_QUOTES, 'UTF-8');
    $pregunta_10 = htmlspecialchars($_POST["pregunta_10"], ENT_QUOTES, 'UTF-8');
    $pregunta_11 = htmlspecialchars($_POST["pregunta_11"], ENT_QUOTES, 'UTF-8');
    $pregunta_12 = htmlspecialchars($_POST["pregunta_12"], ENT_QUOTES, 'UTF-8');
    $nombre_mascota = htmlspecialchars($_POST["nombre_mascota"], ENT_QUOTES, 'UTF-8');
    $viabilidad = htmlspecialchars($_POST["porcentaje_viabilidad"], ENT_QUOTES, 'UTF-8');

    // Prepara la consulta SQL con un statement preparado
    $sql = "
        INSERT INTO `bot_solicitud_adopcion`
        (`usuario_nombre`, `usuario_correo`, `usuario_numero`, `usuario_direccion`, `usuario_tipo_documento`, `usuario_numero_documento`, `pregunta_1`, `pregunta_2`, `pregunta_3`, `pregunta_4`, `pregunta_5`, `pregunta_6`, `pregunta_7`, `pregunta_8`, `pregunta_9`, `pregunta_10`, `pregunta_11`, `pregunta_12`, `nombre_mascota`, `porcentaje_viabilidad`, `id_estado_adopcion`, `fecha_registro`) 
        VALUES (:nombre, :correo, :numero, :direccion, :tipo_documento, :numero_documento, :pregunta_1, :pregunta_2, :pregunta_3, :pregunta_4, :pregunta_5, :pregunta_6, :pregunta_7, :pregunta_8, :pregunta_9, :pregunta_10, :pregunta_11, :pregunta_12, :nombre_mascota, :viabilidad, 1, CONVERT_TZ(NOW(), '+00:00', '-05:00'));
    ";

    try {
        // Prepara y ejecuta la consulta
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':numero', $numero, PDO::PARAM_STR);
        $stmt->bindParam(':direccion', $direccion, PDO::PARAM_STR);
        $stmt->bindParam(':tipo_documento', $tipo_documento, PDO::PARAM_STR);
        $stmt->bindParam(':numero_documento', $numero_documento, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_1', $pregunta_1, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_2', $pregunta_2, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_3', $pregunta_3, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_4', $pregunta_4, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_5', $pregunta_5, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_6', $pregunta_6, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_7', $pregunta_7, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_8', $pregunta_8, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_9', $pregunta_9, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_10', $pregunta_10, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_11', $pregunta_11, PDO::PARAM_STR);
        $stmt->bindParam(':pregunta_12', $pregunta_12, PDO::PARAM_STR);
        $stmt->bindParam(':nombre_mascota', $nombre_mascota, PDO::PARAM_STR);
        $stmt->bindParam(':viabilidad', $viabilidad, PDO::PARAM_STR);







// Si el INSERT fue exitoso, proceder al envío de correo
$destinatarios = [
    'gamernico703@gmail.com',
    'nsalazar29@itfip.edu.co',
    //'amigosdeasopaticas@gmail.com' // Tercer correo
];

$asunto = "Nueva solicitud de adopción - Plataforma ASOPATICAS";

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
            <h1>Notificación de Nueva Solicitud de Adopción</h1>
        </div>
        <div class='content'>
            <h2>Detalles del Solicitante:</h2>
            <p><strong>Nombre:</strong> $nombre</p>
            <p><strong>Correo:</strong> $correo</p>
            <p><strong>Teléfono:</strong> $numero</p>
            <p><strong>Dirección:</strong> $direccion</p>
            <p><strong>Tipo de Documento:</strong> $tipo_documento</p>
            <p><strong>Número de Documento:</strong> $numero_documento</p>
            <p><strong>Nombre de la Mascota:</strong> $nombre_mascota</p>
            <p><strong>Porcentaje de Viabilidad:</strong> $viabilidad%</p>

            <h2>Respuestas del Cuestionario:</h2>
            <p>1. ¿Qué tipo de vivienda tienes?: $pregunta_1</p>
            <p>2. ¿Tienes un jardín o espacio al aire libre?: $pregunta_2</p>
            <p>3. ¿Tienes vecinos que se opongan a tener mascotas?: $pregunta_3</p>
            <p>4. ¿Hay niños en tu hogar?: $pregunta_4</p>
            <p>5. ¿Alguien en tu familia tiene alergias a los animales?: $pregunta_5</p>
            <p>6. ¿Hay otros animales en casa?: $pregunta_6</p>
            <p>7. ¿Trabajas actualmente?: $pregunta_7</p>
            <p>8. ¿Cuántas horas al día estarías en casa?: $pregunta_8</p>
            <p>9. ¿Qué esperas de la convivencia con una mascota?: $pregunta_9</p>
            <p>10. ¿Cuáles son los gastos que consideras al tener una mascota?: $pregunta_10</p>
            <p>11. ¿Por qué quieres adoptar una mascota?: $pregunta_11</p>
            <p>12. ¿Qué harías si la mascota muestra problemas de comportamiento?: $pregunta_12</p>

            <p><strong>Nota Adicional:</strong> Si el usuario $nombre posee un porcentaje de viabilidad superior a 75%, es considerado un óptimo adoptante. De lo contrario, será decisión de la Asociación ASOPATICAS aceptar o descartar esta solicitud.</p>
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

// Enviar el correo a cada destinatario
foreach ($destinatarios as $destinatario) {
    mail($destinatario, $asunto, $cuerpo, $headers);
}











    $destinatarios1 = [
        'pa320411@gmail.com',
        $correo
    ];
    
    $asunto1 = "Confirmación de solicitud de adopción - ASOPATICAS";
    $cuerpo1 = "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f9f9f9;
                color: #333;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 20px auto;
                background-color: #fff;
                border-radius: 8px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }
            .header {
                background-color: #4caf50;
                color: #fff;
                text-align: center;
                padding: 15px;
            }
            .header img {
                max-width: 120px;
                margin-bottom: 10px;
            }
            .content {
                padding: 20px;
            }
            .footer {
                background-color: #f1f1f1;
                text-align: center;
                padding: 10px;
                font-size: 14px;
                color: #666;
            }
            .footer a {
                color: #4caf50;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class='container'>
            <div class='header'>
                <img src='https://asopaticas.org/files/img/logofull.png' alt='ASOPATICAS Logo'> <!-- Reemplaza con la URL real del logo -->
                <h1>Solicitud de Adopción Registrada</h1>
            </div>
            <div class='content'>
                <p>Hola <strong>$nombre</strong>,</p>
                <p>¡Gracias por confiar en <strong>ASOPATICAS</strong>! Nos complace informarte que hemos recibido exitosamente tu solicitud de adopción para la mascota <strong>$nombre_mascota</strong>.</p>
                <p>A continuación, estaremos revisando tu solicitud con detalle para garantizar que esta adorable mascota encuentre el hogar perfecto.</p>
                <p><strong>Detalles de tu solicitud:</strong></p>
                <ul>
                    <li><strong>Nombre:</strong> $nombre</li>
                    <li><strong>Correo:</strong> $correo</li>
                    <li><strong>Teléfono:</strong> $numero</li>
                    <li><strong>Dirección:</strong> $direccion</li>
                </ul>
            <p>Si tienes preguntas o deseas actualizar alguna información, no dudes en ponerte en contacto con nosotros. Te notificaremos tan pronto como tengamos una actualización sobre tu solicitud.</p>
            <p>Gracias nuevamente por ayudarnos a brindar una segunda oportunidad a los animales que más lo necesitan.</p>
            <p>Atentamente,</p>
            <p><strong>Equipo de ASOPATICAS</strong></p>
        </div>
        <div class='footer'>
            <p>Visítanos en nuestra <a href='https://asopaticas.org' target='_blank'>página web</a> o síguenos en redes sociales para más información y actualizaciones.</p>
            <p>&copy; 2024 ASOPATICAS. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
";

$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";
$headers .= "From: ASOPATICAS <amigosdeasopaticas@gmail.com>\r\n";

// Envía el correo a cada destinatario
foreach ($destinatarios1 as $destinatario) {
    mail($destinatario, $asunto1, $cuerpo1, $headers);
}

    


        if ($stmt->execute()) {
            echo "Solicitud de adopción guardada correctamente";
        } else {
            echo "Error al guardar la solicitud de adopción";
        }
    } catch (PDOException $e) {
        // Captura y muestra errores de PDO
        echo "Error en la consulta: " . $e->getMessage();
    }
} else {
    echo "No se recibieron todos los datos necesarios";
}

?>
