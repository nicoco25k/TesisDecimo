
<?php
session_start();

$usuario = $_SESSION['usuraio'];

include_once("bd/Conexion.php");
$sql ="SELECT id_rol 
FROM tabla_usuarios WHERE nickname_usuario='$usuario'";

foreach ($dbh ->query($sql) as $row) 
{
    $n1n = $row['id_rol'];
}

if($n1n!=2){
  header('location: iniciar_sesion.php');
}

if(!isset($usuario)){
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
      <i><a href="asopetssoft.php" target="_blank"><img id="logo_asopetssoft_admin_x" class="img" src="files/img/LOGO_BLANCO_X.png" alt="logo asopetssoft" ></a></i></a>
      
      <span class="logo_name">ASOPETSSOFT</span>
    </div>
    <ul class="nav-links">
      <li>
        <a href="inicio_admin.php">
          <i class='bx bx-grid-alt' ></i>
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
          <i class='bx bxs-chevron-down arrow' ></i>
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
          <i class='bx bxs-chevron-down arrow' ></i>
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
          <i class='bx bxs-chevron-down arrow' ></i>
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
                  <i class='bx bxs-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                  <li><a class="link_name" href="#">Editor</a></li>
                  <li><a href="noticias_add.php">Añadir noticias</a></li>
                 
                </ul>
              </li>

              <li>
                <div class="iocn-link">
                  <a href="#">
                    <i class='bx bx-cog' ></i>
                    <span class="link_name">Configurar</span>
                  </a>
                  <i class='bx bxs-chevron-down arrow' ></i>
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
      <a href="logout.php"><i class='bx bx-log-out' ></i></a>
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

  
<!-- Close <header></header>

-->

            
<div  class="container-fluid py-5  ">
  <h2 class="text-center text-muted "><b>INFORMACIÓN SOBRE SOLICITUDES DE ADOPCIÓN</b></h2>

  <iframe src="listar_solicitudes_adopcion.php" frameborder="0" style="width: 100%; height: 680px; display: block; margin: auto; background-color: #E5E5E5;"></iframe>


            </div>
<a class="btn btn-success my-2 my-sm-0 " href="inicio_admin.php" style="margin-left: 10px;">Regresar</a>
<button class='btn btn-primary' onclick='generarReporte()'>Generar Reporte</button>

<script>


function generarReporte() {
  window.location.href = 'generar_reporte.php';
}
</script>
            
          </section>
    


          



    <!-- Start Script -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="files/js/jquery-1.11.0.min.js"></script>
    <script src="files/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="files/js/bootstrap.bundle.min.js"></script>
    <script src="files/js/templatemo.js"></script>
    <script src="files/js/custom_menu.js"></script>

    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
   
   <!-- JQUERY -->
   <script src="https://code.jquery.com/jquery-3.4.1.js"
   integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous">
   </script>
<!-- DATATABLES -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
</script>


    <!-- End Script -->
</body>
</html>


