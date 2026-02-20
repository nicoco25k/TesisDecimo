<?php
session_start();

$usuario = $_SESSION['usuraio'];

if(!isset($usuario)){
    header('location: .index.php');

}



?>


<!DOCTYPE html>
<html lang="es">

<head>
    <title>ASOPATICAS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Icono de la página -->
    <link rel="icon" href="files/img/logo_asopaticas.png">

    <!-- Archivos CSS -->
    <link rel="stylesheet" href="files/css/bootstrap.min.css">
    <link rel="stylesheet" href="files/css/templatemo.css">
    <link rel="stylesheet" href="files/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="files/css/custom.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">

    <!-- Iconos de Font Awesome -->
    <script src="https://kit.fontawesome.com/3a5bbe002b.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Encabezado / Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a href="inicio_index.php" class="navbar-brand text-success logo align-self-center">
                <img id="logo_asopaticas" class="img" src="files/img/logo_asopaticas.png" alt="logo asopaticas">
            </a>

            <!-- Botón para desplegar el menú en dispositivos móviles -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú de navegación -->
            <div class="align-self-center collapse navbar-collapse flex-fill d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill text-center">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">
                        <li class="nav-item">
                            <a class="nav-link fontanimal" href="inicio_index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active fontanimal" href="inicio_adoptar__apadrinar.php">Adopta - Apadrina</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontanimal" href="inicio_noticias.php">Noticias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontanimal" href="inicio_contactanos.php">Contáctanos</a>
                        </li>
                    </ul>
                </div>

                <!-- Botones de inicio de sesión y registro -->
                <div class="btn-group">

<button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
<?php echo $usuario." "; ?><i class="fa-solid fa-user fa-lg"></i>
</button>
<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
<li><a class="dropdown-item" href="inicio_editar_datos.php"><i class="fa-solid fa-pen-to-square"></i> Editar datos</a></li>
<li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a></li>
</ul>
</div>
            </div>
        </div>
    </nav>
    <!-- Fin del encabezado -->









<!-- Fondo de entrada -->
<div class="wave-footer">
  <div class="container-fluid-2 py-3 px-sm-3 px-md-3 bg-pie1 d-flex align-items-center justify-content-between">
    
    <div class="text-section">
      <h1 class="text-success text-center fontanimal pb-4 py-2">Adopta o Apadrina</h1>
      <p class="text-success text-justificado ps-4 pe-4">Cambia una vida ofreciendo un hogar lleno de amor o brindando apoyo constante a quienes más lo necesitan.</p>
    </div>

    <div class="image-section-2">
      <img src="files/img/nicol_perra.png" alt="Adopción" class="img-fluid-2">
    </div>
  </div>
  
  <svg viewBox="0 0 1440 100">
    <path fill="#112" fill-opacity="1" d="M0,80L48,85.3C96,91,192,101,288,90.7C384,80,480,59,576,53.3C672,48,768,64,864,74.7C960,85,1056,91,1152,85.3C1248,80,1344,69,1392,64L1440,59V100H0Z"></path>
  </svg>
</div>
<!-- Fin Fondo de entrada -->








<div class="container-mascotas pt-5">



<?php
include_once("bd/Conexion.php");

try {
    // Construir la consulta SQL para filtrar los animales


    $sql = "
SELECT 
    id_mascotas,
    nombre_mascota, 
    nombre_especie, 
    nombre_sexo, 
    nombre_edad,  
    nombre_desparasitacion,   
    nombre_raza, 
    nombre_esterilizacion, 
    nombre_vacuna, 
    ruta_img_mascota, 
    caracteristicas_de_comportamiento_mascota 
FROM 
    tabla_mascotas tm
JOIN 
    mascota_desparasitacion m2 ON tm.id_estado_desparasitacion_mascota = m2.id_estado_desparasitacion_mascota
JOIN 
    mascota_edad m3 ON tm.id_edad_mascota = m3.id_edad_mascota
JOIN 
    mascota_especie m4 ON tm.id_especie_mascota = m4.id_especie_mascota
JOIN 
    mascota_esterilizacion m5 ON tm.id_estado_esterilizacion_mascota = m5.id_estado_esterilizacion_mascota
JOIN 
    mascota_raza m9 ON tm.id_razas_mascota = m9.id_razas_mascota
JOIN 
    mascota_sexo m10 ON tm.id_sexo_mascota = m10.id_sexo_mascota
JOIN 
    mascota_vacuna m12 ON tm.id_estado_vacuna_mascota = m12.id_estado_vacuna_mascota
WHERE 
    id_estado_adopcion_mascota = '1';
";

    // Ejecutar la consulta
    $result = $dbh->query($sql);

    // Verificar si se obtuvieron resultados
    if ($result->rowCount() > 0) {
        echo '<div class="container-fluid py-5">';
        echo '<div class="row">';

        // Sección de Anuncios Destacados (30%)
        echo '<div class="col-md-4 text-center caja_anuncios">';
        echo '<img class="img_megafono" src="files/img/megafono.png" alt="megafono de anuncios">';
        

        // Card de Condiciones de adopción
      
        echo 
        
    '   
    
    <div class=" mb-3 caja_anuncios_peque" data-bs-toggle="modal" data-bs-target="#modal-condiciones">
             <div class="card-body text-center py-4 button">
            <span class="text">Condiciones de adopción</span>
            <span class="svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" viewBox="0 0 38 15" fill="none">
                    <path fill="white" d="M10 7.519l-.939-.344h0l.939.344zm14.386-1.205l-.981-.192.981.192zm1.276 5.509l.537.843.148-.094.107-.139-.792-.611zm4.819-4.304l-.385-.923h0l.385.923zm7.227.707a1 1 0 0 0 0-1.414L31.343.448a1 1 0 0 0-1.414 0 1 1 0 0 0 0 1.414l5.657 5.657-5.657 5.657a1 1 0 0 0 1.414 1.414l6.364-6.364zM1 7.519l.554.833.029-.019.094-.061.361-.23 1.277-.77c1.054-.609 2.397-1.32 3.629-1.787.617-.234 1.17-.392 1.623-.455.477-.066.707-.008.788.034.025.013.031.021.039.034a.56.56 0 0 1 .058.235c.029.327-.047.906-.39 1.842l1.878.689c.383-1.044.571-1.949.505-2.705-.072-.815-.45-1.493-1.16-1.865-.627-.329-1.358-.332-1.993-.244-.659.092-1.367.305-2.056.566-1.381.523-2.833 1.297-3.921 1.925l-1.341.808-.385.245-.104.068-.028.018c-.011.007-.011.007.543.84zm8.061-.344c-.198.54-.328 1.038-.36 1.484-.032.441.024.94.325 1.364.319.45.786.64 1.21.697.403.054.824-.001 1.21-.09.775-.179 1.694-.566 2.633-1.014l3.023-1.554c2.115-1.122 4.107-2.168 5.476-2.524.329-.086.573-.117.742-.115s.195.038.161.014c-.15-.105.085-.139-.076.685l1.963.384c.192-.98.152-2.083-.74-2.707-.405-.283-.868-.37-1.28-.376s-.849.069-1.274.179c-1.65.43-3.888 1.621-5.909 2.693l-2.948 1.517c-.92.439-1.673.743-2.221.87-.276.064-.429.065-.492.057-.043-.006.066.003.155.127.07.099.024.131.038-.063.014-.187.078-.49.243-.94l-1.878-.689zm14.343-1.053c-.361 1.844-.474 3.185-.413 4.161.059.95.294 1.72.811 2.215.567.544 1.242.546 1.664.459a2.34 2.34 0 0 0 .502-.167l.15-.076.049-.028.018-.011c.013-.008.013-.008-.524-.852l-.536-.844.019-.012c-.038.018-.064.027-.084.032-.037.008.053-.013.125.056.021.02-.151-.135-.198-.895-.046-.734.034-1.887.38-3.652l-1.963-.384zm2.257 5.701l.791.611.024-.031.08-.101.311-.377 1.093-1.213c.922-.954 2.005-1.894 2.904-2.27l-.771-1.846c-1.31.547-2.637 1.758-3.572 2.725l-1.184 1.314-.341.414-.093.117-.025.032c-.01.013-.01.013.781.624zm5.204-3.381c.989-.413 1.791-.42 2.697-.307.871.108 2.083.385 3.437.385v-2c-1.197 0-2.041-.226-3.19-.369-1.114-.139-2.297-.146-3.715.447l.771 1.846z"></path>
                </svg>
            </span>
        </div>
    </div>
    
    ';

    

    echo 
        
    '   
    
    <div class=" mb-3 caja_anuncios_peque" data-bs-toggle="modal" data-bs-target="#modal-adoptar">
             <div class="card-body text-center py-4 button">
            <span class="text">¿Cómo adoptar?</span>
            <span class="svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" viewBox="0 0 38 15" fill="none">
                    <path fill="white" d="M10 7.519l-.939-.344h0l.939.344zm14.386-1.205l-.981-.192.981.192zm1.276 5.509l.537.843.148-.094.107-.139-.792-.611zm4.819-4.304l-.385-.923h0l.385.923zm7.227.707a1 1 0 0 0 0-1.414L31.343.448a1 1 0 0 0-1.414 0 1 1 0 0 0 0 1.414l5.657 5.657-5.657 5.657a1 1 0 0 0 1.414 1.414l6.364-6.364zM1 7.519l.554.833.029-.019.094-.061.361-.23 1.277-.77c1.054-.609 2.397-1.32 3.629-1.787.617-.234 1.17-.392 1.623-.455.477-.066.707-.008.788.034.025.013.031.021.039.034a.56.56 0 0 1 .058.235c.029.327-.047.906-.39 1.842l1.878.689c.383-1.044.571-1.949.505-2.705-.072-.815-.45-1.493-1.16-1.865-.627-.329-1.358-.332-1.993-.244-.659.092-1.367.305-2.056.566-1.381.523-2.833 1.297-3.921 1.925l-1.341.808-.385.245-.104.068-.028.018c-.011.007-.011.007.543.84zm8.061-.344c-.198.54-.328 1.038-.36 1.484-.032.441.024.94.325 1.364.319.45.786.64 1.21.697.403.054.824-.001 1.21-.09.775-.179 1.694-.566 2.633-1.014l3.023-1.554c2.115-1.122 4.107-2.168 5.476-2.524.329-.086.573-.117.742-.115s.195.038.161.014c-.15-.105.085-.139-.076.685l1.963.384c.192-.98.152-2.083-.74-2.707-.405-.283-.868-.37-1.28-.376s-.849.069-1.274.179c-1.65.43-3.888 1.621-5.909 2.693l-2.948 1.517c-.92.439-1.673.743-2.221.87-.276.064-.429.065-.492.057-.043-.006.066.003.155.127.07.099.024.131.038-.063.014-.187.078-.49.243-.94l-1.878-.689zm14.343-1.053c-.361 1.844-.474 3.185-.413 4.161.059.95.294 1.72.811 2.215.567.544 1.242.546 1.664.459a2.34 2.34 0 0 0 .502-.167l.15-.076.049-.028.018-.011c.013-.008.013-.008-.524-.852l-.536-.844.019-.012c-.038.018-.064.027-.084.032-.037.008.053-.013.125.056.021.02-.151-.135-.198-.895-.046-.734.034-1.887.38-3.652l-1.963-.384zm2.257 5.701l.791.611.024-.031.08-.101.311-.377 1.093-1.213c.922-.954 2.005-1.894 2.904-2.27l-.771-1.846c-1.31.547-2.637 1.758-3.572 2.725l-1.184 1.314-.341.414-.093.117-.025.032c-.01.013-.01.013.781.624zm5.204-3.381c.989-.413 1.791-.42 2.697-.307.871.108 2.083.385 3.437.385v-2c-1.197 0-2.041-.226-3.19-.369-1.114-.139-2.297-.146-3.715.447l.771 1.846z"></path>
                </svg>
            </span>
        </div>
    </div>
    
    ';

    

    echo 
        
    '   
    
    <div class=" mb-3 caja_anuncios_peque" data-bs-toggle="modal" data-bs-target="#modal-apadrinar">
             <div class="card-body text-center py-4 button">
            <span class="text">¿Cómo puedo apadrinar?</span>
            <span class="svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" viewBox="0 0 38 15" fill="none">
                    <path fill="white" d="M10 7.519l-.939-.344h0l.939.344zm14.386-1.205l-.981-.192.981.192zm1.276 5.509l.537.843.148-.094.107-.139-.792-.611zm4.819-4.304l-.385-.923h0l.385.923zm7.227.707a1 1 0 0 0 0-1.414L31.343.448a1 1 0 0 0-1.414 0 1 1 0 0 0 0 1.414l5.657 5.657-5.657 5.657a1 1 0 0 0 1.414 1.414l6.364-6.364zM1 7.519l.554.833.029-.019.094-.061.361-.23 1.277-.77c1.054-.609 2.397-1.32 3.629-1.787.617-.234 1.17-.392 1.623-.455.477-.066.707-.008.788.034.025.013.031.021.039.034a.56.56 0 0 1 .058.235c.029.327-.047.906-.39 1.842l1.878.689c.383-1.044.571-1.949.505-2.705-.072-.815-.45-1.493-1.16-1.865-.627-.329-1.358-.332-1.993-.244-.659.092-1.367.305-2.056.566-1.381.523-2.833 1.297-3.921 1.925l-1.341.808-.385.245-.104.068-.028.018c-.011.007-.011.007.543.84zm8.061-.344c-.198.54-.328 1.038-.36 1.484-.032.441.024.94.325 1.364.319.45.786.64 1.21.697.403.054.824-.001 1.21-.09.775-.179 1.694-.566 2.633-1.014l3.023-1.554c2.115-1.122 4.107-2.168 5.476-2.524.329-.086.573-.117.742-.115s.195.038.161.014c-.15-.105.085-.139-.076.685l1.963.384c.192-.98.152-2.083-.74-2.707-.405-.283-.868-.37-1.28-.376s-.849.069-1.274.179c-1.65.43-3.888 1.621-5.909 2.693l-2.948 1.517c-.92.439-1.673.743-2.221.87-.276.064-.429.065-.492.057-.043-.006.066.003.155.127.07.099.024.131.038-.063.014-.187.078-.49.243-.94l-1.878-.689zm14.343-1.053c-.361 1.844-.474 3.185-.413 4.161.059.95.294 1.72.811 2.215.567.544 1.242.546 1.664.459a2.34 2.34 0 0 0 .502-.167l.15-.076.049-.028.018-.011c.013-.008.013-.008-.524-.852l-.536-.844.019-.012c-.038.018-.064.027-.084.032-.037.008.053-.013.125.056.021.02-.151-.135-.198-.895-.046-.734.034-1.887.38-3.652l-1.963-.384zm2.257 5.701l.791.611.024-.031.08-.101.311-.377 1.093-1.213c.922-.954 2.005-1.894 2.904-2.27l-.771-1.846c-1.31.547-2.637 1.758-3.572 2.725l-1.184 1.314-.341.414-.093.117-.025.032c-.01.013-.01.013.781.624zm5.204-3.381c.989-.413 1.791-.42 2.697-.307.871.108 2.083.385 3.437.385v-2c-1.197 0-2.041-.226-3.19-.369-1.114-.139-2.297-.146-3.715.447l.771 1.846z"></path>
                </svg>
            </span>
        </div>
    </div>
    
    ';

    
    



        echo '<p class="pb-5"></p>';
        echo '</div>'; // Cerrar columna de anuncios

        // Sección de Tarjetas de Mascotas (70%)
        echo '<div class="col-md-8">'; 
        echo '<div class="container">';
        echo '<div class="row justify-content-center">';
        echo '<div class="col-lg-12">';
        echo '<div class="card">';
        echo '<div class="card-body fondoooo">';
        echo '<h3 class="card-title text-center mb-4 fontanimal2 pe-1 ps-1 ">Te Presentamos a Nuestras Encantadoras Mascotas</h3>';
        


        echo '</div>';
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';

        echo '<div class="row">'; // Agregar una fila para las mascotas

        $contador = 0; // Variable para contar los registros mostrados

        while ($animal = $result->fetch(PDO::FETCH_ASSOC)) {
            $contador++; // Incrementar el contador
       
            echo '<div class="col-md-4 mb-4">'; // Dividir en columnas para cada animal



          
            echo '<div class="card custom-card_mascotas ">';
            echo '<h5 class="text-center card-title font-weight-bold custom-title_mascotas pt-4 text-success">' . $animal['nombre_mascota'] . '</h5>';

            echo '<div class="cartitoy">';
            echo '<img src="' . $animal['ruta_img_mascota'] . '" class="card-img-top custom-img_mascotas" alt="Imagen de la mascota">';
            echo '</div>';
            echo '<div class="card-body">';
            echo '<div class="text-center pt-4">';
            echo '<form method="post" action="filter_animal.php">';
            echo '<input type="hidden" name="id_mascota" value="' . $animal['id_mascotas'] . '">';
            echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal' . $animal['id_mascotas'] . '">Más Información</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>'; // Cerrar card-body
            echo '</div>'; // Cerrar card
            echo '</div>'; // Cerrar columna

             // Modal para mostrar más información de la mascota
    echo '<div class="modal fade" id="infoModal' . $animal['id_mascotas'] . '" tabindex="-1" aria-labelledby="infoModalLabel' . $animal['id_mascotas'] . '" aria-hidden="true">';
    echo '<div class="modal-dialog">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<h5 class="modal-title text-center" id="infoModalLabel' . $animal['id_mascotas'] . '">' . $animal['nombre_mascota'] . '</h5>';
    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
    echo '</div>';
    echo '<div class="modal-body">';


     // Mostrar los detalles con un valor predeterminado si no existen
     echo '<p class="card-text pb-4 text-center fontanimal2">Datos Generales</p>';
     echo '<p class="card-text text-justificado"><span class="bold-text">Sexo: </span>' . $animal['nombre_sexo'] . '</p>';
     echo '<p class="card-text text-justificado"><span class="bold-text">Edad: </span>' . $animal['nombre_edad'] . '</p>';
     echo '<p class="card-text text-justificado"><span class="bold-text">Raza: </span>' . $animal['nombre_raza'] . '</p>';
     echo '<p class="card-text text-justificado"><span class="bold-text">Esterilizado: </span>' . $animal['nombre_esterilizacion'] . '</p>';
     echo '<p class="card-text text-justificado"><span class="bold-text">Desparatizado: </span>' . $animal['nombre_desparasitacion'] . '</p>';
     echo '<p class="card-text "><span class="bold-text">Esquema de vacunación: </span>' . $animal['nombre_vacuna'] . '</p>';
     echo '<p class="card-text text-justificado pb-2"><span class="bold-text">Caracteristicas: </span>' . $animal['caracteristicas_de_comportamiento_mascota'] . '</p>';

            
     echo '<img src="' . $animal['ruta_img_mascota'] . '" class="card-img-top custom-img_mascotas2" alt="Imagen de la mascota">';


     echo '<p class="card-text pt-3 text-justificado">Para adoptar o apadrinar a <span class="bold-text">'. $animal['nombre_mascota'] .'</span>, interactúa con nuestro asistente virtual, MaruBot, ubicado en la parte inferior derecha de la pantalla. MaruBot te guiará en el proceso de pre-adopción o apadrinamiento.</p>';

     
     echo '</div>';
     echo '<div class="modal-footer">';
     echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
     echo '</div>';
     echo '</div>';
     echo '</div>';
     echo '</div>';

            if ($contador >= 6) {
                break; // Detener el bucle después de mostrar 6 registros
            }
        }

        echo '</div>'; // Cerrar la fila

        // Verificar si hay más registros ocultos
        if ($result->rowCount() > $contador) {
            echo '<div id="hidden-animals" style="display: none;">'; // Div para ocultar los registros adicionales
            echo '<div class="row">'; // Agregar una fila para los animales ocultos

            while ($animal = $result->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="col-md-4 mb-4">'; // Dividir en columnas para cada animal oculto
                echo '<div class="card custom-card_mascotas pb-3">'; // Usar el mismo formato de tarjeta
                echo '<h5 class="text-center card-title font-weight-bold custom-title_mascotas pt-3">' . $animal['nombre_mascota'] . '</h5>';

                echo '<div class="cartitoy">';
                echo '<img src="' . $animal['ruta_img_mascota'] . '" class="card-img-top custom-img_mascotas" alt="Imagen de la mascota">';
                echo '</div>';                echo '<div class="card-body">';
                echo '<div class="text-center pt-4">';
                echo '<form method="post" action="filter_animal.php">';
                echo '<input type="hidden" name="id_mascota" value="' . $animal['id_mascotas'] . '">';
                echo '<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#infoModal' . $animal['id_mascotas'] . '">Más Información</button>';
                echo '</form>';
                echo '</div>';
                echo '</div>'; // Cerrar card-body
                echo '</div>'; // Cerrar card
                echo '</div>'; // Cerrar columna

                // Modal para mostrar más información de la mascota
    echo '<div class="modal fade" id="infoModal' . $animal['id_mascotas'] . '" tabindex="-1" aria-labelledby="infoModalLabel' . $animal['id_mascotas'] . '" aria-hidden="true">';
    echo '<div class="modal-dialog">';
    echo '<div class="modal-content">';
    echo '<div class="modal-header">';
    echo '<h5 class="modal-title text-center" id="infoModalLabel' . $animal['id_mascotas'] . '">' . $animal['nombre_mascota'] . '</h5>';
    echo '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
    echo '</div>';
    echo '<div class="modal-body">';


     // Mostrar los detalles con un valor predeterminado si no existen
     echo '<p class="card-text pb-4 text-center fontanimal2">Datos Generales</p>';
     echo '<p class="card-text text-justificado"><span class="bold-text">Sexo: </span>' . $animal['nombre_sexo'] . '</p>';
     echo '<p class="card-text text-justificado"><span class="bold-text">Edad: </span>' . $animal['nombre_edad'] . '</p>';
     echo '<p class="card-text text-justificado"><span class="bold-text">Raza: </span>' . $animal['nombre_raza'] . '</p>';
     echo '<p class="card-text text-justificado"><span class="bold-text">Esterilizado: </span>' . $animal['nombre_esterilizacion'] . '</p>';
     echo '<p class="card-text text-justificado"><span class="bold-text">Desparatizado: </span>' . $animal['nombre_desparasitacion'] . '</p>';
     echo '<p class="card-text"><span class="bold-text">Esquema de vacunación: </span>' . $animal['nombre_vacuna'] . '</p>';
     echo '<p class="card-text text-justificado pb-2"><span class="bold-text">Caracteristicas: </span>' . $animal['caracteristicas_de_comportamiento_mascota'] . '</p>';

            
     echo '<img src="' . $animal['ruta_img_mascota'] . '" class="card-img-top custom-img_mascotas2" alt="Imagen de la mascota">';


     echo '<p class="card-text pt-3 text-justificado">Para adoptar o apadrinar a <span class="bold-text">'. $animal['nombre_mascota'] .'</span>, interactúa con nuestro asistente virtual, MaruBot, ubicado en la parte inferior derecha de la pantalla. MaruBot te guiará en el proceso de pre-adopción o apadrinamiento.</p>';

     
     echo '</div>';
     echo '<div class="modal-footer">';
     echo '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>';
     
     echo '</div>';
     echo '</div>';
     echo '</div>';
     echo '</div>';
            }

            echo '</div>'; // Cerrar la fila
            echo '</div>'; // Cerrar el div oculto

            echo '<div class="text-center pt-5">';
            echo '<button id="ver-mas-btn" class="btn btn-primary">Ver más animales</button>'; // Botón "Ver más"
            echo '</div>';

            echo '<script>';
            echo 'document.getElementById("ver-mas-btn").addEventListener("click", function() {';
            echo 'document.getElementById("hidden-animals").style.display = "block";';
            echo 'this.style.display = "none";';
            echo '});';
            echo '</script>';
        }

        echo '</div>'; // Cerrar columna de mascotas
        echo '</div>'; // Cerrar fila
        echo '</div>'; // Cerrar container-fluid
    } else {
        echo '<p>No se encontraron animales.</p>';
    }
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>

</div>

<!-- Modal de Condiciones de adopción -->
<div class="modal fade" id="modal-condiciones" tabindex="-1" role="dialog" aria-labelledby="modalCondicionesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCondicionesLabel">Condiciones de Adopción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Aquí puedes incluir los detalles sobre las condiciones de adopción. Por ejemplo:
                <ul>
                    <li class="pt-4">Debes ser mayor de edad.</li>
                    <li>Te comprometes a cuidar del animal en salud, alimentación, vacunación, recreación y bienestar físico y mental.</li>
                    <li>El animal debe ser tratado como un miembro de tu familia.</li>
                    <li>En caso de incumplimiento en el cuidado del animal, deberás pagar una multa equivalente al 10% de un salario mínimo (aproximadamente $116,000).</li>
                    <li>Aceptar los términos y condiciones de tratamiento de datos y firmar el acta de adopción de la Asociación ASOPATICAS.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Cómo puedo adoptar -->
<div class="modal fade" id="modal-adoptar" tabindex="-1" role="dialog" aria-labelledby="modalAdoptarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdoptarLabel">¿Cómo puedo adoptar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Proceso de Adopción</h5>
                <p class="pb-4">Para adoptar a un animal, sigue estos pasos:</p>
                <ol class="text-justificado">
                    <li>Interactúa con MaruBot en la esquina inferior derecha de la página.</li>
                    <li>Ten claro el nombre del animal que deseas adoptar; puedes consultarlo en la sección de mascotas de nuestra plataforma.</li>
                    <li>Sigue las instrucciones que te proporciona MaruBot para completar el proceso.</li>
                    <li>Acepta los términos y condiciones sobre el tratamiento de datos y el acta de adopción de la Asociación ASOPATICAS.</li>
                    <li>Completa un cuestionario y proporciona tus datos personales.</li>
                    <li>Recibirás un correo confirmando que tu solicitud ha sido enviada exitosamente. Estará en revisión y pronto la Asociación ASOPATICAS se contactará contigo.</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Cómo puedo apadrinar -->
<div class="modal fade" id="modal-apadrinar" tabindex="-1" role="dialog" aria-labelledby="modalApadrinarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalApadrinarLabel">¿Cómo puedo apadrinar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Proceso de Apadrinamiento</h5>
                <p class="pb-4">Para apadrinar a un animal, sigue estos pasos:</p>
                <ol>
                    <li>Interactúa con MaruBot en la esquina inferior derecha de la página.</li>
                    <li class="pb-4">MaruBot te llevará a los canales de atención para completar el proceso de apadrinamiento con la ayuda de la Asociación ASOPATICAS.</li>
                </ol>
                <p>Tu apoyo es fundamental para mejorar las condiciones de vida de los animales en nuestra asociación.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>






                            <!-- Inicio de cuadro de 3 -->
                
    <h2 class="display-4 text-center mb-1 pt-5 fontanimal2">Haz parte del cambio <i class="fa-solid fa-heart"></i></h2>
      
      <div class="card-container py-5">
          <!-- Primera tarjeta para adoptar o apadrinar -->
          <div class="card33 colorfont1">
              <img class="centrar " src="files/img/11.png" alt="Adoptar o apadrinar">
              <h2 class="fontanimal text-success pt-3">Adoptar o Apadrinar</h2>
              <p class="text-success">Haz la diferencia en la vida de un animal. Adopta o apadrina y ofrece un hogar lleno de amor.</p>
              <a href="inicio_adoptar__apadrinar.php" class="btn btn-primary">Más Información</a>
          </div>
          
          <!-- Segunda tarjeta para donar -->
          <div class="card33 colorfont1">
              <img class="centrar" src="files/img/22.png" alt="Donaciones">
              <h2 class="fontanimal text-success pt-3">Donar</h2>
              <p class="text-success">Con tu ayuda podemos continuar rescatando y cuidando animales vulnerables. Cada donación cuenta.</p>
              <a href="inicio_donar.php" class="btn btn-primary">Más Información</a>
          </div>

          <!-- Tercera tarjeta para contacto -->
          <div class="card33 colorfont1">
              <img class="centrar" src="files/img/33.png" alt="Contacto">
              <h2 class="fontanimal text-success pt-3">Contáctanos</h2>
              <p class="text-success">Si quieres conocer más sobre nuestro trabajo o unirte como voluntario, no dudes en contactarnos.</p>
              <a href="inicio_contactanos.php" class="btn btn-primary">Más Información</a>
          </div>
      </div>
      <!-- Fin de cuadro de 3 -->



<!-- Separador de ola -->
<div class="wave-separator">
    <svg viewBox="0 0 1440 100">
        <path fill="#112" fill-opacity="1" d="M0,80L48,85.3C96,91,192,101,288,90.7C384,80,480,59,576,53.3C672,48,768,64,864,74.7C960,85,1056,91,1152,85.3C1248,80,1344,69,1392,64L1440,59V100H0Z"></path>
    </svg>
</div>

<!-- Inicio de pie de página -->
<div class="container-fluid py-3 px-sm-3 px-md-3 bg-pie">
    <div class="row">
        <!-- Columna del logo y redes sociales -->
        <div class="col-md-4 d-flex flex-column align-items-center">
            <img id="logo_asopaticaspie" class="img mb-3" src="files/img/logofull.png" alt="Logo Asopaticas">
            <div class="d-flex justify-content-center">
                <a href="https://www.facebook.com/AmigosDeAsopaticas" class="social-icon mx-2" title="Seguir en Facebook" target="_blank">
                    <img src="files/img/facebook.png" alt="Facebook">
                </a>
                <a href="https://www.instagram.com/asopaticas9/?fbclid=IwAR3CxTSua4dFn4umpzJB6gr63sntAyP6JX4UnJ1h1_aGHkUe1v3eVDW-pJA" class="social-icon mx-2" title="Seguir en Instagram" target="_blank">
                    <img src="files/img/instagram.png" alt="Instagram">
                </a>
                        <a href="https://api.whatsapp.com/send/?phone=573023171054&text=Comun%C3%ADcate%20directamente%20con%20la%20asociaci%C3%B3n%20asopaticas%21&type=phone_number&app_absent=0" class="social-icon mx-2" title="Hablar por WhatsApp" target="_blank">
                    <img src="files/img/whastapp.png" alt="WhatsApp">
                </a>
                
            </div>
            <a class="mb-2 text-center text-white pt-4 nosubrayar" id="correo asopaticas" href="#">amigosdeasopaticas@gmail.com</a>
            <a class="mb-2 text-center text-white nosubrayar" id="pie_text" href="tel:+57 3023171054">+57 302 317 1054</a>
        </div>

        <!-- Columna de navegación -->
        <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
            <a class="nav-link fontanimal" href="inicio_index.php">Inicio</a>
            <a class="nav-link fontanimal" href="inicio_adoptar__apadrinar.php">Adopta - Apadrina</a>
            <a class="nav-link fontanimal" href="inicio_noticias.php">Noticias</a>
            <a class="nav-link fontanimal" href="inicio_contactanos.php">Contáctanos</a>
        </div>

        <!-- Columna del mapa de Google -->
        <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
            <div class="mapa py-2">
                <iframe class="mapa-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.324769090158!2d-74.88538752488449!3d4.146859996501501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3ed3c1b8da5cd1%3A0x0!2zNC4xNDY4NjAxLC03NC44ODMyMjk!5e0!3m2!1ses!2sco!4v1693143096123!5m2!1ses!2sco" width="100%" height="400" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <a href="https://www.google.com/maps/search/calle+7+%23+9-70+Isa%C3%ADas+olivar/@4.1468601,-74.883199,17z/data=!3m1!4b1?hl=es&entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="text-decoration-none text-white">
                <p class="mb-2 text-center text-white" id="pie_text">Sede Principal Calle 7 # 9-70</p>
                <p class="mb-2 text-center text-white" id="pie_text">Isaías Olivar, El Espinal - Tolima [Colombia]</p>
            </a>
        </div>
    </div>

    <!-- Divisor personalizado -->
    <hr class="my-4" style="border-top: 2px solid #fff;">

    <!-- Texto del pie de página -->
    <p class="mb-2 text-center text-white" id="pie_text">&copy; Copyright Todos los derechos reservados | <a href="asopetssoft.php" target="_blank" class="text-decoration-none text-white fontanimal">ASOPETSSOFT</a> 2024</p>
</div>
<!-- Fin de pie de página -->

<!-- Modal para visualizar la imagen -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" class="img-fluid" alt="Imagen ampliada">
            </div>
        </div>
    </div>
</div>

<!-- Start Script -->


<script src="files/js/jquery-1.11.0.min.js"></script>
<script src="files/js/jquery-migrate-1.2.1.min.js"></script>
<script src="files/js/bootstrap.bundle.min.js"></script>
<script src="files/js/templatemo.js"></script>
<script src="files/js/custom.js"></script>
<script src="files/js/swiper-bundle.min.js"></script>
<script src="files/js/slider_noticias.js"></script>
<script src="https://cdn.userway.org/widget.js" data-account="KxQGi0qn4z"></script>
<script src="https://cdn.botpress.cloud/webchat/v2.1/inject.js"></script>
<script src="https://mediafiles.botpress.cloud/39b87354-3420-4b34-a397-1f21272eaf0e/webchat/v2.1/config.js"></script>
<!-- End Script -->


    </body>
    </html>