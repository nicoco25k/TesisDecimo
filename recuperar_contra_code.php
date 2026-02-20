
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
    <a href="index.php" class="navbar-brand text-success logo  align-self-center">
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
                        <a class="nav-link" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adoptar__apadrinar.php">Adoptar - Apadrinar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="nosotros.php">Nosotros</a>
                    </li>
             
                    <li class="nav-item">
                        <a class="nav-link" href="noticias.php">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactanos.php">Contactanos</a>
                    </li>
                    

                </ul>
            </div>

              <div id="centrar_r">

<div class="align-items-center">
<a class="btn ov-btn-grow-box1 text-muted" href="iniciar_sesion.php">Ingresar</a>  
</div>
  
<div>
<a class="btn ov-btn-grow-box2 text-white" href="registrar_usuario.php">Registrarse</a>  
</div>

          
            <!--aca agregar cositaas-->

        
            </div>
            
            
        </div>
    </div>
</nav>
<!-- Close <header></header>-->



<h2 style="padding-top: 45px; text-align: center; " class="py-5"><b>Código de verificación</b></h2>
    

	<main style="
	
	border:5px solid #ada5a5;
 	border-radius: 25px;
	max-width: 500px;
	width: 90%;
	margin: auto;
  

	padding: 40px;
	
	">



	<form method="POST" action="" class="" id="codeform">




<!-- Grupo: usuario -->
<div class="formulario__grupo" id="">
	<label for="emails" class="formulario__label text-center">Por favor revisa el correo electrónico en el que solicitaste tu código. Tu código tiene 6 números.</label>
    <p class="text-center" ></p>

	<div class="formulario__grupo-input" >

    <input type="number" class="formulario__input" name="code" id="code" placeholder="Código" required>


	</div>
	
</div>

<div class="formulario__grupo formulario__grupo-btn-enviar py-3">
    <button type="submit" class="btn btn-success my-2 my-sm-0"  >Enviar código</button>
</div>
	</form>

</main>





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
    <script src="files/js/recuperar_clave_code.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- End Script -->
</body>
</html>