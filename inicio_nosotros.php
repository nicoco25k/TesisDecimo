<?php
session_start();

$usuario = $_SESSION['usuario'];

if (!isset($usuario)) {
    header('location: iniciar_sesion.php');
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>ASOPATICAS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="files/img/logo_asopaticas.png">

    <link rel="stylesheet" href="files/css/bootstrap.min.css">
    <link rel="stylesheet" href="files/css/templatemo.css">
    <link rel="stylesheet" href="files/css/custom.css">
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/3a5bbe002b.js" crossorigin="anonymous"></script>

</head>


<body>



    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">

            <!-- logo asopetssoft-->
            <a href="inicio_index.php" class="navbar-brand text-success logo  align-self-center">
                <img id="logo_asopaticas" class="img" src="files/img/logo_asopaticas.png" alt="logo asopaticas">
            </a>


            <!-- close logo asopetssoft-->


            <button class="navbar-toggler border-0 " type="button" data-bs-toggle="collapse" data-bs-target="#templatemo_main_nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon "> </span>
            </button>


            <div class="align-self-center collapse navbar-collapse flex-fill  d-lg-flex justify-content-lg-between" id="templatemo_main_nav">
                <div class="flex-fill text-center">
                    <ul class="nav navbar-nav d-flex justify-content-between mx-lg-auto">

                        <li class="nav-item">
                            <a class="nav-link " href="inicio_index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inicio_adoptar__apadrinar.php">Adoptar - Apadrinar</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-active" href="inicio_nosotros.php">Nosotros</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="inicio_noticias.php">Noticias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="inicio_contactanos.php">Contactanos</a>
                        </li>


                    </ul>
                </div>

                <div id="centrar_r">


                    <div class="btn-group">

                        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $usuario . " "; ?><i class="fa-solid fa-user fa-lg"></i>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="editar_datos.php"><i class="fa-solid fa-pen-to-square"></i> Editar datos</a></li>
                            <li><a class="dropdown-item" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión</a></li>
                        </ul>
                    </div>


                    <!--aca agregar cositaas-->


                </div>


            </div>
        </div>
    </nav>
    <!-- Close <header></header>-->





    <!-- Start Banner Hero -->







    <div class="container-fluid bg-rey py-5 px-0">


        <div class=" bg-rey2">
            <h2 class="display-3 text-success text-center py-3"><b>Nuestra Historia</b></h2>




            <p class="text-justificado text-success">
                Asopaticas se conformó en 16 de enero del 2016 en cabeza principal como
                representante legal en su tiempo la señora AMPARO GARCIA ALDANA basados
                en una necesidad por una problemática latente que se vive a diario en nuestro
                municipio Espinal como lo es el abandono y el maltrato animal, llevamos 6 años
                tratando de mitigar con mucho esfuerzo este alto índice de abandono por sobre
                población indiscriminada de animalitos y maltrato. En la actualidad la representante
                legal y presidente de Asopaticas es la señora ANDREA MERCEDES ARIAS
                VALDEZ quien lleva liderando 2 años la Asociación, la cual es la que ha creado el
                primer refugio u hogar de paso en nuestro municipio.
            </p>


            <p class="text-justificado text-success">
                En estos 6 años hemos podios ayudar a más de 700 animalitos en estado de
                vulnerabilidad, rescatando, rehabilitado y posteriormente entregando en adopción.
                En la actualidad nuestro refugio cuenta con 25 caninos y 12 felinos que no se han
                podido dar en adopción y estamos en la espera de poder seguir ayudando a más
                que nos necesita.</p>



        </div>


        <h2 class="text-center text-success py-5"><b>“NO CAMBIAMOS EL MUNDO, PERO MARCAMOS LA DIFERENCIA” <i class="fa-solid fa-paw"></i>
            </b></h2>



    </div>


    <!-- fin cuadro inicio de historia -->

    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel1" class="carousel slide " data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel1" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel1" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel1" data-bs-slide-to="2"></li>
        </ol>




        <div class="carousel-inner">


            <div class="carousel-item active" id="slider_nosotros_container">
                <div class="container ">

                    <img id="slider_nosotros" class="img-fluid" src="files/img/refugio1.jpg" alt="imagen animal">

                    <div class="row p-2">

                        <div class="col-lg-6 mb-0 d-flex ">
                        </div>
                    </div>
                </div>
            </div>




            <div class="carousel-item " id="slider_nosotros_container">
                <div class="container ">


                    <img id="slider_nosotros" class="img-fluid" src="files/img/refugio3.jpg" alt="refugio">

                    <div class="row p-2">

                        <div class="col-lg-6 mb-0 d-flex ">
                        </div>
                    </div>
                </div>
            </div>


            <div class="carousel-item " id="slider_nosotros_container">
                <div class="container ">


                    <img id="slider_nosotros" class="img-fluid" src="files/img/refugio2.jpg" alt="refugio">

                    <div class="row p-2">

                        <div class="col-lg-6 mb-0 d-flex ">
                        </div>
                    </div>
                </div>
            </div>


        </div>
        <a class="carousel-control-prev text-decoration-none  ps-3" href="#template-mo-zay-hero-carousel1" role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none  pe-3" href="#template-mo-zay-hero-carousel1" role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>


    <div class="container-fluid bg-rey py-5 ">


        <div class="row mx-0 align-items-center bg-rey3">


            <div class="col-lg-6 px-0 text-right">

                <img id="img_mision_vision" src="files/img/perro_mision.png" alt="imagen animal">


            </div>

            <div class="col-lg-6  text-center text-lg-left">
                <h2 class="text-center text-success py-5 display-2">Misión</h2>
                <p class="text-justificado text-success">


                    ASOPATICAS, Asociación protectora de Animales, es una entidad sin ánimo de lucro, del municipio de El Espinal Tolima, cuyo objetivo es ayudar a construir una salud publica en bienestar animal y ambiental. Dentro de la participación de sus funciones está:
                    Rescatar animales de la calle, abandonados y en estado de vulnerabilidad. Protegerlos, defenderlos ayudarlo en su tratamiento, recuperación, rehabilitación y así posteriormente darles una 2 , oportunidad de ubicarlos en una buena familia. Realizar jornadas de esterilizacion a bajos costos y gratuitas de animales domésticos (caninos y felino), realizar jornadas de vacunación, jornadas de adopción, promoción y prevención de enfermedades.

                </p>

            </div>
        </div>


        <div class="row mx-0 align-items-center bg-rey3">

            <div class="col-lg-6 text-center text-lg-left">

                <h2 class="text-center text-success py-5 display-2">Visión</h2>
                <p class="text-justificado text-success">
                    Para el año 2026 Asopaticas se proyecta tener su albergue propio con intalaciones idóneas, el cual permitirá crecer y ayudar a más animales de la zona, buscando recursos mediante ayudas como donaciones y diferentes actividades; al igual que la adquisición de equipos para la atención médica veterinaria que permita el auto sostenimiento de la asociación. Ayudar a la construcción de la mano, con entidades competentes o gubernamentales unas políticas públicas de bienestar animal, lograr disminuir la sobrepoblacion indiscriminada de animales domésticos abandonados mediante Esterilizaciones masivas y socialización de tenencia responsable de animales de compañía de nuestro municipio de El Espinal Tolima. para mejorar las condiciones de vidas de los animales y así reducir ciertas amenazas en el sector de salud pública.
                </p>
                <p class="text-justificado text-success">
                    Ayudar a crear, mediante leyes y acuerdos municipales, un hospital público veterinario para la atención integral de todo animal que lo necesite y este en condición de vulnerable.</p>

            </div>
            <div class="col-lg-6 px-0 text-right">

                <img id="img_mision_vision1" src="files/img/gato_vision.png" alt="imagen animal">


            </div>
        </div>



    </div>



    <!-- inicio de cuadro de 3-->

    <div class="container pt-5 pb-3">
        <h1 class="display-4  text-center mb-5 ">Haz parte del cambio <i class="fa-solid fa-heart"></i></h1>

        <div class="row">


            <div class="col-lg-4 mb-2">
                <div class="rounded text-center pt-4 mt-lg-1 mb-1 container1">
                    <h2>ADOPTAR</h2>



                    <i class=" icon_cuadro_3 fa-solid fa-paw fa-2xl"></i>

                    <h1 class="display-4 text-white mb-0">
                        <a href="inicio_adoptar__apadrinar.php" class="ov-btn-grow-box">BUSCAR</a>
                    </h1>

                </div>
            </div>


            <div class="col-lg-4 mb-2">
                <div class=" rounded text-center pt-4 mt-lg-1 mb-1 container1">
                    <h2>HAZ UNA DONACIÓN</h2>

                    <i class="icon_cuadro_3 fa-solid fa-circle-dollar-to-slot fa-bounce fa-2xl"></i>

                    <h1 class="display-4 text-white mb-0">
                        <a href="inicio_donar.php" class="ov-btn-grow-box">DONAR AHORA</a>
                    </h1>

                </div>
            </div>


            <div class="col-lg-4 mb-2">
                <div class="rounded text-center pt-4 mt-lg-1 mb-1 container1">
                    <h2>CONTACTANOS</h2>

                    <i class=" icon_cuadro_3 fa-solid fa-phone fa-2xl"></i>

                    <h1 class="display-4 text-white mb-0">
                        <a href="inicio_contactanos.php" class="ov-btn-grow-box">CONTACTAR</a>
                    </h1>

                </div>
            </div>

        </div>
    </div>

    <!-- final cuadros de 3 -->



    <!-- inicio de pie de pagina -->

    <img id="pie" src="files/img/pie.png" alt="imagen de pie de pagina">

    <div class="container-fluid py-2 px-sm-3 px-md-3" style="background: #112;">
        <p class="mb-2 text-center" id="pie_text">@Copyright Todos los derechos reservados | <a href="asopetssoft.php" class="text-decoration-none text-white">ASOPETSSOFT</a> 2023</p>
    </div>

    <!-- fin de pie de pagina -->

    <!-- Start Script -->

    <script src="files/js/jquery-1.11.0.min.js"></script>
    <script src="files/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="files/js/bootstrap.bundle.min.js"></script>
    <script src="files/js/templatemo.js"></script>
    <script src="files/js/custom.js"></script>
    <!-- End Script -->
</body>

</html>