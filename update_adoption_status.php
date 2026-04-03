<?php
// Obtener el ID del usuario desde la solicitud AJAX
$id_solicitud_adopcion = isset($_POST['idUsuario']) ? intval($_POST['idUsuario']) : null;
$nuevoEstado = isset($_POST['accion']) ? intval($_POST['accion']) : null;

// Realizar la actualización en la base de datos
include_once("bd/Conexion.php");



// Actualizar el estado del usuario en la base de datos
$sql = "UPDATE bot_solicitud_adopcion 
        SET id_estado_adopcion = :nuevoEstado,
            fecha_resolucion = CASE 
                WHEN :nuevoEstado2 IN (2, 3) THEN CURDATE() 
                ELSE NULL 
            END
        WHERE id_solicitud_adopcion = :id_solicitud_adopcion";


$stmt = $dbh->prepare($sql);
$stmt->bindParam(':nuevoEstado', $nuevoEstado);
$stmt->bindParam(':nuevoEstado2', $nuevoEstado);
$stmt->bindParam(':id_solicitud_adopcion', $id_solicitud_adopcion);







$sql = "SELECT * FROM bot_solicitud_adopcion WHERE id_solicitud_adopcion='$id_solicitud_adopcion'";

foreach ($dbh->query($sql) as $row) {
    $usuario_nombre = $row['usuario_nombre'];
    $usuario_correo = $row['usuario_correo'];
    $nombre_mascota = $row['nombre_mascota'];
}


if ($nuevoEstado == 3) {


    $destinatarios = [
        'pa320411@gmail.com',
        $usuario_correo
    ];

    $asunto = "Confirmación de Solicitud de Adopción - ASOPATICAS";

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
            .highlight {
                color: #4CAF50;
                font-weight: bold;
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
                <h1>Confirmación de Solicitud de Adopción</h1>
            </div>
            <div class='content'>
                <p>Hola <span class='highlight'>$usuario_nombre</span>,</p>
                <p>Nos complace informarte que tu solicitud de adopción para la mascota <span class='highlight'>$nombre_mascota</span> ha sido <span class='highlight'>APROBADA</span>.</p>
                <p>¡Eres el adoptante ideal!</p>
                <p>La asociación ASOPATICAS se pondrá en contacto contigo para coordinar los detalles de la entrega y asegurarnos de que todo esté listo para dar la bienvenida a tu nuevo amigo.</p>
                <p>Gracias por darle una segunda oportunidad a un animal que lo necesita. Estamos emocionados de verlos juntos.</p>
            </div>
            <div class='footer'>
                <p>Este correo ha sido generado automáticamente por la Plataforma ASOPATICAS.</p>
                <p>Si tienes dudas, contáctanos en <a href='mailto:amigosdeasopaticas@gmail.com'>amigosdeasopaticas@gmail.com</a>.</p>
            </div>
        </div>
    </body>
    </html>
    ";

    // Encabezados para enviar correo en formato HTML
    $headers  = "From: ASOPATICAS <no-reply@asopaticas.com>\r\n";
    $headers .= "Reply-To: amigosdeasopaticas@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Envía el correo a cada destinatario
    foreach ($destinatarios as $destinatario) {
        mail($destinatario, $asunto, $cuerpo, $headers);
    }
}

if ($nuevoEstado == 2) {

    $destinatarios = [
        'pa320411@gmail.com',

        $usuario_correo
    ];

    $asunto = "Resultado de Solicitud de Adopción - ASOPATICAS";

    // Cuerpo del correo en formato HTML
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
                background-color: #f9f9f9;
                margin: 0;
                padding: 0;
            }
            .container {
                width: 80%;
                max-width: 600px;
                margin: 20px auto;
                padding: 20px;
                background: #ffffff;
                border: 1px solid #ddd;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }
            .header {
                text-align: center;
                margin-bottom: 20px;
            }
            .header img {
                width: 150px;
            }
            .content {
                text-align: left;
                color: #555;
            }
            .content h2 {
                color: #E74C3C;
            }
            .highlight {
                color: #E74C3C;
                font-weight: bold;
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
                <h1>Resultado de Solicitud de Adopción</h1>
            </div>
            <div class='content'>
                <h2>Hola <span class='highlight'>$usuario_nombre</span>,</h2>
                <p>Lamentamos informarte que tu solicitud de adopción para la mascota <span class='highlight'>$nombre_mascota</span> ha sido evaluada y <span class='highlight'>no cumple con los requisitos mínimos</span> para ser adoptante en este momento.</p>
                <p>Te agradecemos por tu interés en brindar un hogar a uno de nuestros animales rescatados. Te invitamos a considerar revisar las condiciones necesarias para adoptar y a seguir apoyando nuestra misión.</p>
                <p>Si tienes alguna consulta o deseas más información, no dudes en contactarnos.</p>
            </div>
            <div class='footer'>
                <p>Este correo ha sido enviado automáticamente desde la plataforma web de ASOPATICAS.</p>
                <p>Para más información, contáctanos en <a href='mailto:amigosdeasopaticas@gmail.com'>amigosdeasopaticas@gmail.com</a>.</p>
            </div>
        </div>
    </body>
    </html>
    ";

    // Encabezados para correo HTML
    $headers  = "From: ASOPATICAS <no-reply@asopaticas.com>\r\n";
    $headers .= "Reply-To: amigosdeasopaticas@gmail.com\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Envía el correo a cada destinatario
    foreach ($destinatarios as $destinatario) {
        mail($destinatario, $asunto, $cuerpo, $headers);
    }
}



if ($stmt->execute()) {
    // Enviar una respuesta de éxito
    echo 'Éxitooo';
} else {
    // Ocurrió un error al actualizar el estado del usuario
    echo 'Error';
}
