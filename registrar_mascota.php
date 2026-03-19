
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

<!-- Close <header></header>-->
            
<div  class="container-fluid py-5  ">
  <h2 class="text-center text-muted "><b>REGISTRAR NUEVA MASCOTA</b></h2>


  <div class="container_1" style="max-width: 850px; margin: 0 auto; padding: 10px;">

  

  <form method="POST" action="" class="formulario" id="formulario">

	  <!-- Grupo: Nombre -->
	  <div class="formulario__grupo" id="grupo__nombre">
		  <label for="nombre" class="formulario__label">Nombre</label>
		  <div class="formulario__grupo-input">
			  <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre mascota" minlength="3" maxlength="20" required>
			  <i class="formulario__validacion-estado fas fa-times-circle"></i>
		  </div>
		  <p class="formulario__input-error">El nombre de la mascota debe tener de 3 a 20 caracteres.</p>
	  </div>

	    <!-- Grupo: características -->
		<div class="formulario__grupo" id="grupo__nombre">
			<label for="nombre" class="formulario__label">características</label>
			<div class="formulario__grupo-input">
				<textarea name="mensaje" id="caracteristicas" class="formulario__input" data-required_mark="required" data-field_type="text" data-original_id="mensaje" placeholder="Caracteristicas de comportamiento" required></textarea>

				<i class="formulario__validacion-estado fas fa-times-circle"></i>
			</div>
			<p class="formulario__input-error">Querido usuario, el nombre debe tener de 4 a 16 letras.</p>
		</div>
	


<!-- Grupo: especie -->
<div class="" id="">
<label  class="formulario__label">Selecciona la especie</label>

<div class="caja">					
  
<select name="select_especie" id="especie_opcion" required>	
</select>
</div></div>


<!-- Grupo: raza -->
<div class="" id="">
	<label  class="formulario__label">Selecciona la raza</label>
	
	<div class="caja">					
	  
	<select name="select_raza" id="raza_opcion" required>	
	</select>
	</div></div>


<!-- Grupo: sexo -->
<div class="" id="">
	<label  class="formulario__label">Selecciona el sexo</label>
	
	<div class="caja">					
	  
	<select name="select_sexo" id="sexo_opcion" required>	
	</select>
	</div></div>


<!-- Grupo: edad -->
<div class="" id="">
	<label  class="formulario__label">Selecciona la edad</label>
	
	<div class="caja">					
	  
	<select name="select_edad" id="edad_opcion" required>	
	</select>
	</div></div>



<!-- Grupo: desparasitacion -->
<div class="" id="">
	<label  class="formulario__label">Selecciona si esta desparasitado</label>
	
	<div class="caja">					
	  
	<select name="select_desparasitacion" id="desparasitacion_opcion" required>	
	</select>
	</div></div>


<!-- Grupo: esterilizacion -->
<div class="" id="">
	<label  class="formulario__label">Selecciona si esta esterelizado</label>
	
	<div class="caja">					
	  
	<select name="select_esterilizacion" id="esterilizacion_opcion" required>	
	</select>
	</div></div>


<!-- Grupo: vacuna -->
<div class="" id="">
	<label  class="formulario__label">Selecciona si esta vacunado</label>
	
	<div class="caja">					
	  
	<select name="select_vacuna" id="vacuna_opcion" required>	
	</select>
	</div></div>





  <!-- Grupo: foto mascota -->
  <div class="">
	<label  class="formulario__label centrar" >Foto de la mascota</label>
	<div class="centrar">
		<input type="file" id="image" required  onchange="imagenes()">

	</div>

</div>









	
		  





	  
	
 
	





	  <div class="formulario__grupo formulario__grupo-btn-enviar">
		  <button type="submit" class="btn btn-success my-2 my-sm-0">Registrar</button>

	  </div>


  


  </form>



</div>
            </div>
<a class="btn btn-success my-2 my-sm-0 " href="inicio_admin.php" style="margin-left: 10px;">Regresar</a>
            
          </section>



        
   









    <!-- Start Script -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="files/js/jquery-1.11.0.min.js"></script>
    <script src="files/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="files/js/bootstrap.bundle.min.js"></script>
    <script src="files/js/templatemo.js"></script>
    <script src="files/js/custom_menu.js"></script>
	<script>
    const formulario = document.getElementById("formulario");
const inputs = document.querySelectorAll("#formulario input");
var rutaCompleta; // Variable global para almacenar la ruta completa

//selects

$.ajax({
  url: "select_especie.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `
 
		<option value="${task.id_especie_mascota}">${task.nombre_especie}</option>
		
			  `;
    });
    $("#especie_opcion").html(template);
  },
});

$.ajax({
  url: "select_raza.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_razas_mascota}">${task.nombre_raza}</option>
		
			  `;
    });
    $("#raza_opcion").html(template);
  },
});

$.ajax({
  url: "select_sexo.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_sexo_mascota}">${task.nombre_sexo}</option>
		
			  `;
    });
    $("#sexo_opcion").html(template);
  },
});

$.ajax({
  url: "select_edad.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_edad_mascota}">${task.nombre_edad}</option>
		
			  `;
    });
    $("#edad_opcion").html(template);
  },
});

$.ajax({
  url: "select_desparasitacion.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_estado_desparasitacion_mascota}">${task.nombre_desparasitacion}</option>
		
			  `;
    });
    $("#desparasitacion_opcion").html(template);
  },
});

$.ajax({
  url: "select_esterilizacion.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_estado_esterilizacion_mascota}">${task.nombre_esterilizacion}</option>
		
			  `;
    });
    $("#esterilizacion_opcion").html(template);
  },
});

$.ajax({
  url: "select_vacuna.php",
  type: "GET",
  success: function (response) {
    const documento = JSON.parse(response);
    let template = "";

    documento.forEach((task) => {
      template += `

		<option value="${task.id_estado_vacuna_mascota}">${task.nombre_vacuna}</option>
		
			  `;
    });
    $("#vacuna_opcion").html(template);
  },
});

function imagenes() {
  var formData = new FormData();
  var file = $("#image")[0].files[0];
  formData.append("file", file);

  $.ajax({
    url: "ruta_img_mascota.php",
    type: "post",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      rutaCompleta = JSON.parse(response);
      // Haz lo que necesites con la variable rutaCompleta aquí

      let img = response;

      if (img == 775) {
        swal(
          "Error!",
          "Este la imagen a subir no cumple el formato permitido",
          "error",
        );
      } else {
        $("#formulario").submit((e) => {
          e.preventDefault();
          const postData = {
            nombre: $("#nombre").val(),
            caracteristicas: $("#caracteristicas").val(),
            especie_opcion: $("#especie_opcion").val(),
            raza_opcion: $("#raza_opcion").val(),
            sexo_opcion: $("#sexo_opcion").val(),
            edad_opcion: $("#edad_opcion").val(),
            desparasitacion_opcion: $("#desparasitacion_opcion").val(),
            esterilizacion_opcion: $("#esterilizacion_opcion").val(),
            vacuna_opcion: $("#vacuna_opcion").val(),
            rutaCompleta: rutaCompleta, // Incluir la variable rutaCompleta en el postData
          };

          $.post(
            "comprobar_mascota_registro.php",
            postData,
            function (response) {
              let x = response;

              if (x == 923) {
                swal(
                  "Error!",
                  "No se realizo la conexión con la base de datos",
                  "error",
                );
              }

              if (x == 2309) {
                swal({
                  title: "Mascota registrada con exito",
                  text: "Ahora puedes la información de los registros de los animales dando click a ok",
                  icon: "success",
                  buttons: true,
                  dangerMode: true,
                }).then((willDelete) => {
                  if (willDelete) {
                    window.location = "mascotas.php";
                  } else {
                    window.location = "inicio_admin.php";
                  }
                });

                $("#formulario").trigger("reset");
              }
            },
          );

          e.preventDefault();
        });
      }

      $("#formulario").submit((e) => {
        e.preventDefault();
        const postData = {
          rutaCompleta: rutaCompleta, // Incluir la variable rutaCompleta en el postData
        };

        $.post(
          "comprobar_mascota_registro_img.php",
          postData,
          function (response) {
            let x = response;

            if (x == 923) {
              swal(
                "Error!",
                "No se realizo el registro, imagen no valida",
                "error",
              );
            }
          },
        );

        e.preventDefault();
      });
    },
  });
}

  </script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- End Script -->
</body>
</html>


