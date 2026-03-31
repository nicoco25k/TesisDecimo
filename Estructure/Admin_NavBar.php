<!--INICIO MENU-->

<body>
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