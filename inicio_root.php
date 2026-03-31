<?php
session_start();

$usuario = $_SESSION['usuario'];

include_once("bd/Conexion.php");
$sql = "SELECT id_rol 
FROM tabla_usuarios WHERE nickname_usuario='$usuario'";

foreach ($dbh->query($sql) as $row) {
  $n1n = $row['id_rol'];
}

if ($n1n != 3) {
  header('location: iniciar_sesion.php');
}

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





  <!--INICIO MENU-->
  <div class="sidebar close">
    <div class="logo-details">
      <i><a href="#" target="_blank"><img id="logo_asopetssoft_admin_x" class="img" src="files/img/LOGO_BLANCO_X.png" alt="logo asopetssoft"></a></i></a>

      <span class="logo_name">ASOPETSSOFT</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="inicio_root.php">
          <i class='bx bx-grid-alt'></i>
          <span class="link_name">Inicio</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="#">Inicio</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-dog"></i>
            <span class="link_name">Mascotas</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Mascotas</a></li>
          <li><a href="#">Añadir nueva mascota</a></li>
          <li><a href="#">Consultar mascotas</a></li>


        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-regular fa-clipboard"></i>
            <span class="link_name">Adopciones</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Adopciones</a></li>
          <li><a href="#">Solicitudes de adopción</a></li>
          <li><a href="#">Solicitudes de apadrinar</a></li>
        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-users"></i>
            <span class="link_name">Usuarios</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Usuarios</a></li>
          <li><a href="#">Consultar usuarios</a></li>
          <li><a href="#">Consultar mensajes</a></li>



        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class="fa-solid fa-pen-to-square"></i>
            <span class="link_name">Editor</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Editor</a></li>
          <li><a href="#">Añadir noticias</a></li>
          <li><a href="#">Editar noticias</a></li>

        </ul>
      </li>

      <li>
        <div class="iocn-link">
          <a href="#">
            <i class='bx bx-cog'></i>
            <span class="link_name">Configurar</span>
          </a>
          <i class='bx bxs-chevron-down arrow'></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="#">Configurar</a></li>
          <li><a href="#">Editar datos de cuenta</a></li>
          <li><a href="logout.php">Cerrar sesión</a></li>

        </ul>
      </li>





      <li>

        <div class="profile-details">

          <div class="profile-content">
            <img id="admin_img" class="img" src="files/img/admin1.png" alt="logo admin">
          </div>

          <div class="name-job">
            <div class="profile_name"><?php echo $usuario; ?></div>
            <div class="job">Administrador</div>
          </div>
          <a href="logout.php"><i class='bx bx-log-out'></i></a>
        </div>
      </li>



    </ul>
  </div>


  <!--FIN MENU-->


  <section class="home-section">

    <!-- Header -->
    <nav class=" navbar-light shadow">
      <div class="container d-flex justify-content-between align-items-center">



        <div class="home-content">
          <i class='bx bx-menu'></i>

        </div>

        <div id="centrar_r">

          <a href="index.php" class="navbar-brand text-success logo  align-self-center" target="_blank">
            <img id="logo_asopaticas_admin" class="img" src="files/img/logo_asopaticas.png" alt="logo asopaticas">
          </a>

        </div>

      </div>
    </nav>
    <!-- Close <header></header>-->


    <div class="container-fluid bg-rey py-5 redondear" style="margin-top: 40px;">


      <p class="text-center text-success dis py-3 display-6">Bienvenido! <?php echo $usuario; ?></b> al módulo ROOT</p>

      <img id="logo_asopetssoft_admin_blanco" src="files/img/LOGO_BLANCO.png" alt="logo asopetssoft">
      <p class="mb-2 text-center text" id="pie_text">@Copyright Todos los derechos reservados | <a href="asopetssoft.php" target="_blank" class="text-decoration-none text-white">ASOPETSSOFT</a> 2023</p>


    </div>
















  </section>
















  <!-- Start Script -->

  <script src="files/js/jquery-1.11.0.min.js"></script>
  <script src="files/js/jquery-migrate-1.2.1.min.js"></script>
  <script src="files/js/bootstrap.bundle.min.js"></script>
  <script src="files/js/templatemo.js"></script>
  <script src="files/js/custom_menu.js"></script>
  <!-- End Script -->
</body>

</html>