<?php

$ruta = 'files/img_mascotas/';

if (
      ($_FILES["file"]["type"] == "image/jpg")  ||
      ($_FILES["file"]["type"] == "image/jpeg") ||
      ($_FILES["file"]["type"] == "image/png")  ||
      ($_FILES["file"]["type"] == "image/gif")
) {
      // Obtener la extensión original del archivo
      $extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

      // Generar nombre aleatorio único
      $nombreAleatorio = uniqid('mascota_', true) . '.' . $extension;

      // Mover el archivo con el nuevo nombre
      move_uploaded_file($_FILES['file']['tmp_name'], $ruta . $nombreAleatorio);

      $rutaCompleta = $ruta . $nombreAleatorio;

      echo json_encode($rutaCompleta);
} else {
      echo "775";
}
