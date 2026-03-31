<?php
session_start();

$usuario = $_SESSION['usuario'];

include_once("bd/Conexion.php");
$sql = "SELECT nombre_usuario,apellido_usuario,telefono_usuario,nombre_documento,numero_documento_usuario,correo_usuario 
FROM tabla_usuarios,tabla_documetno WHERE tabla_usuarios.id_tipo_documento = tabla_documetno.id_tipo_documento and nickname_usuario='$usuario'";

foreach ($dbh->query($sql) as $row) {

  $nombre_usuario = $row['nombre_usuario'];
  $apellido_usuario = $row['apellido_usuario'];
  $telefono_usuario = $row['telefono_usuario'];
  $nombre_documento = $row['nombre_documento'];
  $numero_documento_usuario = $row['numero_documento_usuario'];
  $correo_usuario = $row['correo_usuario'];
}


//echo $nombre_usuario.$apellido_usuario.$telefono_usuario.$id_tipo_documento.$numero_documento_usuario.$correo_usuario;




$sql = "SELECT id_rol 
FROM tabla_usuarios WHERE nickname_usuario='$usuario'";

foreach ($dbh->query($sql) as $row) {
  $n1n = $row['id_rol'];
}

if ($n1n != 2) {
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
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <script src="https://kit.fontawesome.com/3a5bbe002b.js" crossorigin="anonymous"></script>

</head>


<body>






  <!--INICIO MENU-->
  <div class="sidebar close">
    <div class="logo-details">
      <i><a href="asopetssoft.php" target="_blank"><img id="logo_asopetssoft_admin_x" class="img" src="files/img/LOGO_BLANCO_X.png" alt="logo asopetssoft"></a></i></a>

      <span class="logo_name">ASOPETSSOFT</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="inicio_admin.php">
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
          <li><a href="registrar_mascota.php">Añadir nueva mascota</a></li>
          <li><a href="mascotas.php">Consultar mascotas</a></li>


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
          <li><a href="solicitudes_adopcion.php">Solicitudes de adopción</a></li>
          <li><a href="adopciones_aprobadas.php">Adopciones Aprobadas</a></li>
          <li><a href="adopciones_declinadas.php">Adopciones Reprobadas</a></li>
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
          <li><a href="usuarios_registrados.php">Consultar usuarios</a></li>
          <li><a href="mensajes.php">Consultar mensajes</a></li>


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
          <li><a href="noticias_add.php">Añadir noticias</a></li>

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
          <li><a href="editar_datos_admin.php">Editar datos de cuenta</a></li>
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

  <section class="home-section" style="background-color: #E5E5E5;">

    <!-- Header -->



    <div class="home-content">
      <i class='bx bx-menu' style="padding-left: 10px;"></i>


    </div>

    <!-- Close <header></header>-->

    <!-- Start Banner Hero -->


    <h2 class="text-center py-5"><b>Editar datos de tu cuenta</b></h2>





    <main>



      <h3 class="text-center py-3"><b>TUS DATOS</b></h3>

      <!-- Grupo: Nombre -->

      <div class="table-container">
        <table class="user-table">

          <tr>
            <td><b>Nombre:</b></td>
            <td><?php echo $nombre_usuario; ?></td>
          </tr>
          <tr>
            <td><b>Apellido:</b></td>
            <td><?php echo $apellido_usuario; ?></td>
          </tr>
          <tr>
            <td><b>Tipo de documento:</b></td>
            <td><?php echo $nombre_documento; ?></td>
          </tr>
          <tr>
            <td><b>Número de documento:</b></td>
            <td><?php echo $numero_documento_usuario; ?></td>
          </tr>
        </table>
        <p class="py-3"></p>
        <table class="user-table">
          <tr>
            <td><b>Correo:</b></td>
            <td><?php echo $correo_usuario; ?></td>
            <td class="text-center"><button class="btn btn-primary" onclick="window.location.href = 'editar_datos_admin_correo.php';">Editar</button></td>
          </tr>
          <tr>
            <td><b>Teléfono:</b></td>
            <td><?php echo $telefono_usuario; ?></td>
            <td class="text-center"><button class="btn btn-primary" onclick="window.location.href = 'editar_datos_admin_telefono.php';">Editar</button></td>
          </tr>
          <tr>
            <td><b>Contraseña:</b></td>
            <td>********</td>
            <td class="text-center"><button class="btn btn-primary" onclick="window.location.href = 'editar_datos_admin_clave.php';">Editar</button></td>
          </tr>



        </table>
      </div>




    </main>

    <a class="btn btn-success my-2 my-sm-0 " href="inicio_admin.php" style="margin-left: 10px;">Regresar</a>




    <!-- End Banner Hero -->


    <!-- Start Script -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="files/js/jquery-1.11.0.min.js"></script>
    <script src="files/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="files/js/bootstrap.bundle.min.js"></script>
    <script src="files/js/templatemo.js"></script>
    <script src="files/js/custom_menu.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- End Script -->
</body>

</html>