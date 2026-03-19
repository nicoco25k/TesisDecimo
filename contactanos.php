<?php require_once __DIR__ . "/Estructure/Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/NavBar.php"; ?>

<!-- Fondo de entrada -->
<div class="wave-footer">
    <div class="container-fluid-2 py-4 px-2 bg-pie1">
        <div class="row align-items-center g-2">
            <!-- Texto -->
            <div class="col-md-7 text-section ">
                <h3 class="text-success fontanimal text-center text-md-start pb-3">
                    ¿Tienes alguna pregunta?
                </h3>

                <p class="text-success texto-info pt-3">
                    ¡Estamos aquí para ayudarte! Puedes ponerte en contacto con nosotros a través de:
                </p>

                <p class="text-success mb-1">
                    <b>Email:</b>
                    <a href="mailto:amigosdeasopaticas@gmail.com"
                        class="text-decoration-none text-success text-container1">
                        amigosdeasopaticas@gmail.com
                    </a>
                </p>

                <p class="text-success">
                    <b>Teléfono:</b>
                    <a href="tel:+573023171054"
                        class="text-decoration-none text-success text-container1">
                        +57 302 317 1054
                    </a>
                </p>
            </div>

            <!-- Imagen -->
            <div class="col-md-5 text-center image-section-2">
                <img src="files/img/logofull.png"
                    alt="Logo Asopaticas"
                    class="img-fluid img-fluid-3">
            </div>
        </div>
    </div>

    <svg viewBox="0 0 1440 100">
        <path fill="#112" fill-opacity="1"
            d="M0,80L48,85.3C96,91,192,101,288,90.7C384,80,480,59,576,53.3C672,48,768,64,864,74.7C960,85,1056,91,1152,85.3C1248,80,1344,69,1392,64L1440,59V100H0Z">
        </path>
    </svg>
</div>


<!-- Contenedor blanco que agrupa ambas secciones -->
<div class="container-fluid px-3 px-md-5 my-5 py-2">

    <div class="card shadow-sm redondear img_fondo pb-4">

        <div class="text-center pt-5 pb-3">
            <h2 class="fw-bold">¿Quieres conocernos o tienes alguna duda?</h2>
        </div>

        <div class="card-body p-3 p-md-4">
            <div class="row g-5 justify-content-center">

                <!-- Refugio Section -->
                <div class="col-12 col-lg-5 px-lg-4">
                    <div class="card h-100 product-wap redondear">
                        <div class="card-body redondear colorfont1">
                            <h2 class="text-success text-center py-2"><b>Visita nuestro refugio</b></h2>
                            <div class="mapa py-3">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.324769090158!2d-74.88538752488449!3d4.146859996501501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3ed3c1b8da5cd1%3A0x0!2zNC4xNDY4NjAxLC03NC44ODMyMjk!5e0!3m2!1ses!2sco!4v1693143096123!5m2!1ses!2sco"
                                    width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                                </iframe>
                            </div>
                            <h3 class="text-success"><b>Dirección</b></h3>
                            <p class="text-justificado">
                                <a class="text-decoration-none text-success" target="_blank" href="https://www.google.com/maps/search/calle+7+%23+9-70+Isa%C3%ADas+olivar/@4.1468601,-74.883199,17z/data=!3m1!4b1?hl=es&entry=ttu&g_ep=EgoyMDI0MDgyNi4wIKXMDSoASAFQAw%3D%3D">Sede Principal calle 7 # 9-70 Isaías olivar El Espinal - Tolima [Colombia]</a>
                            </p>
                            <p class="text-justificado">
                                <a class="text-decoration-none text-success" target="_blank" href="https://www.google.com/maps/search/refugio+vereda+San+Francisco+chicoral/@4.2133489,-74.9871745,16z/data=!3m1!4b1?hl=es&entry=ttu&g_ep=EgoyMDI0MDgyNi4wIKXMDSoASAFQAw%3D%3D">Refugio vereda San Francisco chicoral</a>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form Section -->
                <div class="col-12 col-lg-5 px-lg-4">
                    <div class="card h-100 product-wap redondear">
                        <div class="card-body redondear colorfont1">
                            <form method="POST" action="" id="formulario">
                                <h2 class="text-success text-center py-4"><b>Envíanos tu mensaje</b></h2>

                                <!-- Nombre -->
                                <div class="formulario__grupo" id="grupo__nombre">
                                    <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Nombre" minlength="4" maxlength="20" required>
                                    <i class="formulario__validacion-estado fas fa-times-circle" style="display: none;"></i>
                                    <p class=""></p>
                                </div>

                                <!-- Telefono -->
                                <div class="formulario__grupo" id="grupo__telefono">
                                    <input type="text" class="formulario__input" name="telefono" id="telefono" placeholder="Teléfono" minlength="8" maxlength="12" required>
                                    <i class="formulario__validacion-estado fas fa-times-circle" style="display: none;"></i>
                                    <p class=""></p>
                                </div>

                                <!-- Correo -->
                                <div class="formulario__grupo" id="grupo__correo">
                                    <input type="email" class="formulario__input" name="correo" id="correo" placeholder="Correo" minlength="4" maxlength="60" required>
                                    <i class="formulario__validacion-estado fas fa-times-circle" style="display: none;"></i>
                                    <p class=""></p>
                                </div>

                                <!-- Mensaje -->
                                <div class="formulario__grupo" id="grupo__usuario">
                                    <textarea name="mensaje" id="mensaje" class="mensaje input" placeholder="Mensaje"></textarea>
                                    <i class="formulario__validacion-estado fas fa-times-circle" style="display: none;"></i>
                                    <p class="formulario__input-error"></p>
                                </div>

                                <!-- Botón Enviar -->
                                <div class="formulario__grupo formulario__grupo-btn-enviar pt-3">
                                    <button type="submit" class="btn btn-success my-2 my-sm-0">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<?php require_once __DIR__ . "/Estructure/AnimalCards.php"; ?>
<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>