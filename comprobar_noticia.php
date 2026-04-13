<?php
include_once("bd/Conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $rutaCompleta = $_POST['rutaCompleta'] ?? '';

    if (empty($rutaCompleta)) {
        echo "0923";
        exit;
    }

    try {
        $stmt = $dbh->prepare("
      INSERT INTO tabla_noticias (id_noticias, id_estado_noticia, img_noticia, fecha_subida) 
      VALUES (NULL, 1, :ruta, NOW())
    ");
        $stmt->bindParam(':ruta', $rutaCompleta, PDO::PARAM_STR);
        $stmt->execute();
        echo "2309";
    } catch (PDOException $e) {
        echo "0923";
    }
} else {
    echo "0923";
}
