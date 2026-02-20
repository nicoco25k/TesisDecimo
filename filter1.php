




<?php
include_once("bd/Conexion.php");

// Iniciar la sesión
session_start();

try {
  // Construir la consulta SQL para filtrar los animales
  $sql = "
  SELECT id_mascotas, nombre_mascota,  nombre_sexo,  nombre_talla, nombre_raza, ruta_img_mascota
  FROM tabla_mascotas tm,  mascota_sexo m10,  mascota_talla m11, mascota_raza m9
  WHERE 
  tm.id_sexo_mascota = m10.id_sexo_mascota
  AND tm.id_talla_mascota = m11.id_talla_mascota
  AND tm.id_razas_mascota = m9.id_razas_mascota
  AND id_estado_adopcion_mascota='1'";

  // Ejecutar la consulta
  $result = $dbh->query($sql);

  // Verificar si se obtuvieron resultados
  if ($result->rowCount() > 0) {
    echo '<div class="row">'; // Agregar una fila para los animales

    $contador = 0; // Variable para contar los registros mostrados

    while ($animal = $result->fetch(PDO::FETCH_ASSOC)) {
      $contador++; // Incrementar el contador

      echo '<div class="col-md-4">'; // Dividir en columnas para cada animal
      echo '<div class="card rounded bg-container_animal">';
      echo '<h3  class="text-center">' . $animal['nombre_mascota'] . '</h3>';
      echo '<div class="card-image">';
      echo '<img src="' . $animal['ruta_img_mascota'] . '" alt="Imagen de la mascota" class="img-fluid">';
      echo '</div>';
      echo '<div class="card-content">';
      echo '<p> ' . $animal['nombre_sexo'] . '</p>';
      echo '<p><strong>Talla:</strong> ' . $animal['nombre_talla'] . '</p>';
      echo '<p><strong>Raza:</strong> ' . $animal['nombre_raza'] . '</p>';
      echo '</div>';
      echo '<div class="card-action">';
      echo '<form method="post" action="filter_animal1.php">';
      echo '<input type="hidden" name="id_mascota" value="' . $animal['id_mascotas'] . '">';
      echo '<button type="submit" class="btn btn-primary">Ver más</button>';
      echo '</form>';
      echo '</div>';
      echo '</div></div>';

      if ($contador >= 6) {
        break; // Detener el bucle después de mostrar 9 registros
      }
    }

    echo '</div>'; // Cerrar la fila

    // Verificar si hay más registros ocultos
    if ($result->rowCount() > $contador) {
      echo '<div id="hidden-animals" style="display: none;">'; // Div para ocultar los registros adicionales

 echo '<div class="row">'; // Agregar una fila para los animales
      while ($animal = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="col-md-4">'; // Dividir en columnas para cada animal oculto
        echo '<div class="card rounded bg-container_animal">';
        echo '<h3  class="text-center">' . $animal['nombre_mascota'] . '</h3>';
        echo '<div class="card-image">';
        echo '<img src="' . $animal['ruta_img_mascota'] . '" alt="Imagen de la mascota" class="img-fluid">';
        echo '</div>';
        echo '<div class="card-content">';
        echo '<p> ' . $animal['nombre_sexo'] . '</p>';
        echo '<p><strong>Talla:</strong> ' . $animal['nombre_talla'] . '</p>';
        echo '<p><strong>Raza:</strong> ' . $animal['nombre_raza'] . '</p>';
        echo '</div>';
        echo '<div class="card-action">';
        echo '<form method="post" action="filter_animal1.php">';
        echo '<input type="hidden" name="id_mascota" value="' . $animal['id_mascotas'] . '">';
        echo '<button type="submit" class="btn btn-primary">Ver más</button>';
        echo '</form>';
        echo '</div>';
        echo '</div></div>';
      }
    echo '</div>'; // Cerrar la fila
      echo '</div>'; // Cerrar el div oculto

      echo '<div class="text-center">';
      echo '<button id="ver-mas-btn" class="btn btn-secondary">Ver más animales</button>'; // Botón "Ver más"
      echo '</div>';

      echo '<script>';
      echo 'document.getElementById("ver-mas-btn").addEventListener("click", function() {';
      echo 'document.getElementById("hidden-animals").style.display = "block";';
      echo 'this.style.display = "none";';
      echo '});';
      echo '</script>';
    }
  } else {
    echo '<p>No se encontraron animales.</p>';
  }
} catch (PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>




