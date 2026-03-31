<?php
session_start();

$usuario = $_SESSION['usuario'];

if (!isset($usuario)) {
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
                            <a class="nav-link text-active fontanimal" href="inicio_adoptar__apadrinar.php">Adopta</a>
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
                <div id="centrar_r">

                    <div class="btn-group">

                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $usuario . " "; ?><i class="fa-solid fa-user fa-lg"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="inicio_editar_datos.php"><i class="fa-solid fa-pen-to-square"></i> Editar datos</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a></li>
                        </ul>
                    </div>


                    <!--aca agregar cositaas-->


                </div>
            </div>
        </div>
        </div>
    </nav>
    <!-- Fin del encabezado -->






    <div class="card25 py-2">
        <div class="container py-4">





            <?php include 'info_mascota.php'; ?>
            <p class="text-center">
                <a class="adopt-button" href="inicio_adoptar__apadrinar.php">Volver</a>
            </p>



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
                <a class="nav-link fontanimal" href="inicio_adoptar__apadrinar.php">Adopta</a>
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