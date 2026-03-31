<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pagina_actual = basename($_SERVER['PHP_SELF']);
$usuario = $_SESSION['usuario'] ?? null;
$rol = $_SESSION['rol'] ?? null;
$mostrarSesion = true;

// Páginas permitidas para admin
$paginas_admin = ['inicio_admin.php'];

// Si es admin y está fuera de su zona → ocultar sesión
if ($rol === 'admin' && !in_array($pagina_actual, $paginas_admin)) {
    $mostrarSesion = false;
}


if ($rol === 'admin' && ($pagina_actual == 'editar_clave.php' || $pagina_actual == 'editar_correo.php' || $pagina_actual == 'editar_telefono.php' || $pagina_actual == 'editar_datos.php')) {
    header('Location: index.php');
    exit();
}


// Bloquear acceso a login/registro SOLO si la sesión está activa visualmente
if ($usuario && $mostrarSesion && ($pagina_actual == 'iniciar_sesion.php' || $pagina_actual == 'registrar_usuario.php')) {
    header('Location: index.php');
    exit();
}
?>

<!-- Encabezado / Navegación -->
<nav class="navbar navbar-expand-lg navbar-light shadow bg_navbar">
    <div class="container d-flex justify-content-between align-items-center ">
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
                        <a class="nav-link fontanimalBar <?php if ($pagina_actual == 'index.php') {
                                                                echo 'text-active';
                                                            } ?>" href="index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fontanimalBar <?php if ($pagina_actual == 'adoptar__apadrinar.php') {
                                                                echo 'text-active';
                                                            } ?>" href="adoptar__apadrinar.php"> Adopta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fontanimalBar <?php if ($pagina_actual == 'noticias.php') {
                                                                echo 'text-active';
                                                            } ?>" href="noticias.php">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fontanimalBar <?php if ($pagina_actual == 'contactanos.php') {
                                                                echo 'text-active';
                                                            } ?>" href="contactanos.php">Contáctanos</a>
                    </li>
                </ul>
            </div>





            <!-- Botones de inicio de sesión y registro -->
            <div class="align-items-center bajar_boton">

                <div id="centrar_r">

                    <?php if ($usuario && $mostrarSesion): ?>
                        <!-- CUANDO EL USUARIO ESTÁ LOGUEADO -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                <?php echo $usuario; ?> <i class="fa-solid fa-user fa-lg"></i>
                            </button>

                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="editar_datos.php">
                                        <i class="fa-solid fa-pen-to-square"></i> Editar datos
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="logout.php">
                                        <i class="fa-solid fa-right-from-bracket"></i> Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                        </div>

                    <?php else: ?>

                        <!-- CUANDO NO HAY SESIÓN -->
                        <div class="align-items-center">
                            <a class="btn ov-btn-grow-box1 text-muted fontanimal" href="iniciar_sesion.php">Ingresar</a>
                        </div>
                        <div>
                            <a class="btn ov-btn-grow-box2 text-white fontanimal card25" href="registrar_usuario.php">Registrarse</a>
                        </div>

                    <?php endif; ?>

                </div>

            </div>

            <!-- 
<button class="animated-button " onclick="window.location.href='iniciar_sesion.php'">
  <svg xmlns="http://www.w3.org/2000/svg" class="arr-2" viewBox="0 0 24 24">
    <path
      d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
    ></path>
  </svg>
  <span class="text">Ingresar</span>
  <span class="circle"></span>
  <svg xmlns="http://www.w3.org/2000/svg" class="arr-1" viewBox="0 0 24 24">
    <path
      d="M16.1716 10.9999L10.8076 5.63589L12.2218 4.22168L20 11.9999L12.2218 19.778L10.8076 18.3638L16.1716 12.9999H4V10.9999H16.1716Z"
    ></path>
  </svg>
</button> -->





        </div>

    </div>
    </div>
</nav>
<!-- Fin del encabezado -->