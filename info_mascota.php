<?php
include_once("bd/Conexion.php");
require_once('tcpdf/tcpdf.php');



if (isset($_POST['id_mascota'])) {
  $id_mascota = 303;

  try {
    // Construir la consulta SQL para obtener los datos de la mascota específica
    $sql = "
    SELECT nombre_mascota, nombre_especie, nombre_sexo, nombre_edad, nombre_talla, nombre_color, nombre_desparasitacion, nombre_extremidades, nombre_pelaje, nombre_peso, nombre_raza, nombre_esterilizacion, nombre_vacuna, ruta_img_mascota, caracteristicas_de_comportamiento_mascota 
    FROM tabla_mascotas tm, mascota_color m1, mascota_desparasitacion m2, mascota_edad m3, mascota_especie m4, mascota_esterilizacion m5, mascota_extremidades m6, mascota_pelaje m7, mascota_peso m8, mascota_raza m9, mascota_sexo m10, mascota_talla m11, mascota_vacuna m12 
    WHERE tm.id_color_mascota = m1.id_color_mascota
    AND tm.id_estado_desparasitacion_mascota = m2.id_estado_desparasitacion_mascota
    AND tm.id_edad_mascota = m3.id_edad_mascota
    AND tm.id_especie_mascota = m4.id_especie_mascota
    AND tm.id_estado_esterilizacion_mascota = m5.id_estado_esterilizacion_mascota
    AND tm.id_extremidades_mascota = m6.id_extremidades_mascota
    AND tm.id_pelaje_mascota = m7.id_pelaje_mascota
    AND tm.id_peso_aproximado_mascota = m8.id_peso_aproximado_mascota
    AND tm.id_razas_mascota = m9.id_razas_mascota
    AND tm.id_sexo_mascota = m10.id_sexo_mascota
    AND tm.id_talla_mascota = m11.id_talla_mascota
    AND tm.id_estado_vacuna_mascota = m12.id_estado_vacuna_mascota
    AND tm.id_mascotas = :id_mascota AND id_estado_adopcion_mascota='1'";

    // Preparar la consulta
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id_mascota', $id_mascota, PDO::PARAM_INT);

    // Ejecutar la consulta
    $stmt->execute();

    // Verificar si se obtuvieron resultados
    if ($stmt->rowCount() > 0) {
      // Obtener los datos de la mascota
      $mascota = $stmt->fetch(PDO::FETCH_ASSOC);

      // Mostrar los datos de la mascota con estilo CSS
      echo '<h1 class="text-center display-5 text-success ">' . ucfirst($mascota['nombre_mascota']) . '</h1>';
      echo '<div class="animal-card text-success">';
      echo '<div class="animal-details ">';
      echo '<p class="detail">Especie: ' . ucfirst($mascota['nombre_especie']) . '</p>';
      echo '<p class="detail">Sexo: ' . ucfirst($mascota['nombre_sexo']) . '</p>';
      echo '<p class="detail">Edad: ' . ucfirst($mascota['nombre_edad']) . '</p>';
      echo '<p class="detail">Talla: ' . ucfirst($mascota['nombre_talla']) . '</p>';
      echo '<p class="detail">Color: ' . ucfirst($mascota['nombre_color']) . '</p>';
      echo '<p class="detail">Desparasitación: ' . ucfirst($mascota['nombre_desparasitacion']) . '</p>';
      echo '<p class="detail">Extremidades: ' . ucfirst($mascota['nombre_extremidades']) . '</p>';
      echo '<p class="detail">Pelaje: ' . ucfirst($mascota['nombre_pelaje']) . '</p>';
      echo '<p class="detail">Peso: ' . ucfirst($mascota['nombre_peso']) . '</p>';
      echo '<p class="detail">Raza: ' . ucfirst($mascota['nombre_raza']) . '</p>';
      echo '<p class="detail">Esterilización: ' . ucfirst($mascota['nombre_esterilizacion']) . '</p>';
      echo '<p class="detail">Vacuna: ' . ucfirst($mascota['nombre_vacuna']) . '</p>';
      echo '<p class="detail">Características de comportamiento: ' . ucfirst($mascota['caracteristicas_de_comportamiento_mascota']) . '</p>';
      echo '</div>';
      echo '<div class="animal-image">';
      echo '<img src="' . $mascota['ruta_img_mascota'] . '" alt="Imagen de la mascota">';
      echo '<div class="adopt-button-container py-3">';
      echo '<button class="adopt-button" onclick="mostrarAlerta()">Adoptar</button>
      

      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
      <script>

      function mostrarAlerta() {
      	swal("¡Advertencia!", "Antes de realizar una adopción, necesitas tener una cuenta creada. Por favor, regístrate o inicia sesión para continuar.", "warning");
				
      }
</script>





      
      ';
      echo '</div>';

      // Crear un nuevo objeto TCPDF
      $pdf = new TCPDF();
      $pdf->SetAutoPageBreak(true, 10);

      // Agregar contenido al PDF
      $pdf->AddPage();
      $pdf->SetFont('helvetica', 'B', 12);
      $pdf->Ln(10);
      $pdf->Cell(0, 8, 'Nombre de la mascota: ' . ucfirst($mascota['nombre_mascota']), 0, 1);
      $pdf->Cell(0, 8, 'Especie: ' . ucfirst($mascota['nombre_especie']), 0, 1);
      $pdf->Cell(0, 8, 'Sexo: ' . ucfirst($mascota['nombre_sexo']), 0, 1);
      $pdf->Cell(0, 8, 'Edad: ' . ucfirst($mascota['nombre_edad']), 0, 1);
      $pdf->Cell(0, 8, 'Talla: ' . ucfirst($mascota['nombre_talla']), 0, 1);
      $pdf->Cell(0, 8, 'Color: ' . ucfirst($mascota['nombre_color']), 0, 1);
      $pdf->Cell(0, 8, 'Desparasitación: ' . ucfirst($mascota['nombre_desparasitacion']), 0, 1);
      $pdf->Cell(0, 8, 'Extremidades: ' . ucfirst($mascota['nombre_extremidades']), 0, 1);
      $pdf->Cell(0, 8, 'Pelaje: ' . ucfirst($mascota['nombre_pelaje']), 0, 1);
      $pdf->Cell(0, 8, 'Peso: ' . ucfirst($mascota['nombre_peso']), 0, 1);
      $pdf->Cell(0, 8, 'Raza: ' . ucfirst($mascota['nombre_raza']), 0, 1);
      $pdf->Cell(0, 8, 'Esterilización: ' . ucfirst($mascota['nombre_esterilizacion']), 0, 1);
      $pdf->Cell(0, 8, 'Vacuna: ' . ucfirst($mascota['nombre_vacuna']), 0, 1);
      $pdf->Cell(0, 8, 'Características de comportamiento: ' . ucfirst($mascota['caracteristicas_de_comportamiento_mascota']), 0, 1);




      
// Obtener la ruta de la imagen
$ruta_imagen = 'files/img/logo_asopaticas.png';

// Obtener las dimensiones originales de la imagen
list($imagen_ancho, $imagen_alto) = getimagesize($ruta_imagen);

// Definir las dimensiones deseadas para la imagen
$imagen_nuevo_ancho = 28; // Ancho en píxeles
$imagen_nuevo_alto = 25; // Alto en píxeles

// Calcular las coordenadas x e y para colocar la imagen en la parte superior derecha del PDF con espacio adicional
$imagen_x = $pdf->GetPageWidth() - $imagen_nuevo_ancho - 10; // 10 es el margen derecho
$imagen_y = 20; // 20 es el espacio adicional desde el borde superior

// Agregar la imagen al PDF con las nuevas coordenadas y dimensiones
$pdf->Image($ruta_imagen, $imagen_x, $imagen_y, $imagen_nuevo_ancho, $imagen_nuevo_alto);


      
// Obtener la ruta de la imagen de la mascota
$ruta_img_mascota = $mascota['ruta_img_mascota'];

// Obtener el contenido de la imagen
$imageData = file_get_contents($ruta_img_mascota);

// Dimensiones máximas de la imagen en el PDF
$maxWidth = 100;
$maxHeight = 100;

// Obtener las dimensiones originales de la imagen
list($origWidth, $origHeight) = getimagesizefromstring($imageData);

// Calcular el factor de escala para ajustar la imagen dentro de las dimensiones máximas
$scale = min($maxWidth / $origWidth, $maxHeight / $origHeight);

// Calcular las nuevas dimensiones de la imagen con el factor de escala
$newWidth = $origWidth * $scale;
$newHeight = $origHeight * $scale;

// Calcular las coordenadas x e y para colocar la imagen en la parte inferior del PDF
$x = ($pdf->GetPageWidth() - $newWidth) / 2;
$y = $pdf->GetPageHeight() - $newHeight - 20; // 20 es el espacio entre la imagen y el borde inferior del PDF

// Agregar la imagen al PDF con las nuevas dimensiones y en la parte inferior
$pdf->Image('@' . $imageData, $x, $y, $newWidth, $newHeight, '', '', '', false, 300, '', false, false, 0, false, false, false);

      // Generar el contenido del PDF

      $output = $pdf->Output(ucfirst($mascota['nombre_mascota']) . '.pdf', 'S');


      // Mostrar el botón de descarga del PDF
      echo '<a href="data:application/pdf;base64,' . base64_encode($output) . '" download="mascota.pdf" class="btn btn-secondary">Descargar PDF</a>';
      echo '</div>';
      echo '</div>';
    } else {
      echo '<p class="text-center text-success display-4 py-3">Esta mascota ya no esta dispobible.</p>';

    }
  } catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
  }
} else {
  echo '<p>No se especificó una mascota.</p>';
}
?>