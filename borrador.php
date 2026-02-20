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
