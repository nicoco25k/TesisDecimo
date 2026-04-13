<?php

$ruta = 'files/img_noticias/';

$tiposPermitidos = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];
$tipo = $_FILES["file"]["type"] ?? '';

if (in_array($tipo, $tiposPermitidos)) {

      // Generar nombre único para evitar sobreescritura
      $extension    = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
      $nombreUnico  = uniqid('noticia_', true) . '.' . $extension;
      $rutaCompleta = $ruta . $nombreUnico;

      if (move_uploaded_file($_FILES['file']['tmp_name'], $rutaCompleta)) {
            echo json_encode($rutaCompleta);
      } else {
            echo "775"; // Error al mover el archivo
      }
} else {
      echo "775"; // Formato no permitido
}
