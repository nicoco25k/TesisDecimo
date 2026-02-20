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

       <!-- Encabezado / Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a href="index.php" class="navbar-brand text-success logo align-self-center">
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
                            <a class="nav-link fontanimal" href="index.php">Inicio</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontanimal" href="adoptar__apadrinar.php">Adopta - Apadrina</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontanimal" href="noticias.php">Noticias</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fontanimal" href="contactanos.php">Contáctanos</a>
                        </li>
                    </ul>
                </div>

                <!-- Botones de inicio de sesión y registro -->
                <div id="centrar_r">
                    <div class="align-items-center">
                        <a class="btn ov-btn-grow-box1 text-muted fontanimal" href="iniciar_sesion.php">Ingresar</a>
                    </div>
                    <div>
                        <a class="btn ov-btn-grow-box2 text-white fontanimal card25" href="registrar_usuario.php">Registrarse</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>


	<h2 style="padding-top: 45px; text-align: center; "><b>Formulario De Registro</b></h2>
	<div id="centrar_r">
		<a href="asopetssoft.php" class="" target="_blank">
			<img id="logo_asopetssoft" class="img" src="files/img/logoo.png" alt="imagen sobre asopetssoft">
			</a>
		</div>
		


	<main>




	<form method="POST" action="" class="formulario" id="formulario">
	<!-- Grupo: Nombre -->
	<div class="formulario__grupo" id="grupo__nombre">
		<label for="nombre" class="formulario__label">Nombre</label>
		<div class="formulario__grupo-input">
			<input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Escribe tu nombre" minlength="4" maxlength="40" required>
			<i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">Querido usuario, el nombre debe tener de 4 a 16 letras.</p>
	</div>

	<!-- Grupo: Apellido -->
	<div class="formulario__grupo" id="grupo__apellido">
		<label for="apellido" class="formulario__label">Apellido</label>
		<div class="formulario__grupo-input">
			<input type="text" class="formulario__input" name="apellido" id="apellido" placeholder="Escribe tu apellido" minlength="4" maxlength="40" required>
			<i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">Querido usuario, el apellido debe tener de 4 a 16 letras.</p>
	</div>

	<!-- Grupo: Correo Electrónico -->
	<div class="formulario__grupo" id="grupo__correo">
		<label for="correo" class="formulario__label">Correo Electrónico</label>
		<div class="formulario__grupo-input">
			<input type="email" class="formulario__input" name="correo" id="correo" placeholder="Escribe tu correo electrónico" minlength="4" maxlength="60" required>
			<i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">Querido usuario, el correo no es válido.</p>
	</div>

	<!-- Grupo: Teléfono -->
	<div class="formulario__grupo" id="grupo__telefono">
		<label for="telefono" class="formulario__label">Teléfono</label>
		<div class="formulario__grupo-input">
			<input type="number" class="formulario__input" name="telefono" id="telefono" placeholder="Escribe tu número de celular" minlength="8" maxlength="12" required>
			<i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">Querido usuario, el teléfono debe tener de 8 a 12 números.</p>
	</div>

	<!-- Grupo: Tipo de documento y número de documento -->
	<div class="formulario__grupo" id="grupo__documento">
		<label for="documento" class="formulario__label">Tipo de documento</label>
		<div class="caja">
			<select name="tipo_documento" id="documento_opcion" required></select>
			<br>
		</div>
		<div class="formulario__grupo-input">
			<input type="number" class="formulario__input" name="documento" id="documento" placeholder="Escribe tu número de documento" minlength="6" maxlength="12" required>
			<i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">Querido usuario, el documento debe tener de 6 a 12 números.</p>
	</div>

	<!-- Grupo: Usuario -->
	<div class="formulario__grupo" id="grupo__usuario">
		<label for="usuario" class="formulario__label">Nickname de cuenta</label>
		<p style="text-align: center; color: #940a0a; margin: 8px; font-size: 15px;">"Con este nickname iniciarás sesión"</p>
		<div class="formulario__grupo-input">
			<input type="text" class="formulario__input" name="usuario" id="usuario" placeholder="Escribe tu nombre de usuario" minlength="8" maxlength="20" required>
			<i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">Querido usuario, el nickname debe tener de 8 a 20 caracteres.</p>
	</div>

	<!-- Grupo: Contraseña -->
	<div class="formulario__grupo" id="grupo__password">
		<label for="password" class="formulario__label">Contraseña</label>
		<div class="formulario__grupo-input">
			<input type="password" class="formulario__input" name="password" id="password" placeholder="********" minlength="8" maxlength="20" required>
			<i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">La contraseña tiene que ser de 8 a 12 caracteres.</p>
	</div>

	<!-- Grupo: Confirmar contraseña -->
	<div class="formulario__grupo" id="grupo__password2">
		<label for="password2" class="formulario__label">Repetir Contraseña</label>
		<div class="formulario__grupo-input">
			<input type="password" class="formulario__input" name="password2" id="password2" placeholder="********" minlength="8" maxlength="20" required>
			<i class="formulario__validacion-estado fas fa-times-circle"></i>
		</div>
		<p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
	</div>

	<!-- Grupo: Términos y Condiciones -->
	<div class="formulario__grupo" id="grupo__terminos">
		<label class="formulario__label">
			<input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos" required>
			<a href="terminos_y_condiciones.php" target="_blank" class=" text-muted">Acepto los Términos y Condiciones</a>
		</label>
	</div>

	<div class="formulario__grupo formulario__grupo-btn-enviar">
		<button type="submit" class="btn btn-success my-2 my-sm-0">Registrarse</button>
	</div>
</form>


</main>



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
            <a class="nav-link fontanimal" href="index.php">Inicio</a>
            <a class="nav-link fontanimal" href="adoptar__apadrinar.php">Adopta - Apadrina</a>
            <a class="nav-link fontanimal" href="noticias.php">Noticias</a>
            <a class="nav-link fontanimal" href="contactanos.php">Contáctanos</a>
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
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="files/js/jquery-1.11.0.min.js"></script>
    <script src="files/js/jquery-migrate-1.2.1.min.js"></script>
    <script src="files/js/bootstrap.bundle.min.js"></script>
    <script src="files/js/templatemo.js"></script>
	<script src="files/js/custom.js"></script>
	<script src="files/js/registrar_usuario.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	



    <!-- End Script -->

</body>
</html>