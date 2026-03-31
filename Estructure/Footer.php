<?php
$pagina_actual = basename($_SERVER['PHP_SELF']);
?>

<!-- Separador de ola -->
<div class="wave-separator">
    <svg viewBox="0 0 1440 100">
        <path fill="#112" fill-opacity="1" d="M0,80L48,85.3C96,91,192,101,288,90.7C384,80,480,59,576,53.3C672,48,768,64,864,74.7C960,85,1056,91,1152,85.3C1248,80,1344,69,1392,64L1440,59V100H0Z"></path>
    </svg>
</div>



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
            <a class="nav-link fontanimal" href="adoptar__apadrinar.php">Adopta</a>
            <a class="nav-link fontanimal" href="noticias.php">Noticias</a>
            <a class="nav-link fontanimal" href="contactanos.php">Contáctanos</a>

        </div>

        <!-- Columna del mapa de Google -->
        <div class="col-md-4 d-flex flex-column justify-content-center align-items-center">
            <div class="mapa py-2">
                <iframe class="mapa-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.324769090158!2d-74.88538752488449!3d4.146859996501501!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3ed3c1b8da5cd1%3A0x0!2zNC4xNDY4NjAxLC03NC44ODMyMjk!5e0!3m2!1ses!2sco!4v1693143096123!5m2!1ses!2sco" width="100%" height="400" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <a href="https://www.google.com/maps/search/calle+7+%23+9-70+Isa%C3%ADas+olivar/@4.1468601,-74.883199,17z/data=!3m1!4b1?hl=es&entry=ttu&g_ep=EgoyMDI0MDgyOC4wIKXMDSoASAFQAw%3D%3D" target="_blank" class="text-decoration-none text-white">
                <p class="mb-2 text-center text-white " id="pie_text">Sede Principal Calle 7 # 9-70</p>
                <p class="mb-2 text-center text-white" id="pie_text">Isaías Olivar, El Espinal - Tolima [Colombia]</p>
            </a>
        </div>
    </div>

    <!-- Divisor personalizado -->
    <hr class="my-4" style="border-top: 2px solid #fff;">

    <!-- Texto del pie de página -->
    <p class="mb-2 text-center text-white" id="pie_text">&copy; Copyright Todos los derechos reservados | <a href="asopetssoft.php" target="_blank" class="text-decoration-none text-white fontanimal">ASOPETSSOFT</a> 2026</p>
</div>


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

<!-- Scripts que SIEMPRE se ejecutan -->
<script src="files/js/jquery-1.11.0.min.js"></script>
<script src="files/js/jquery-migrate-1.2.1.min.js"></script>
<script src="files/js/bootstrap.bundle.min.js"></script>
<script src="files/js/templatemo.js"></script>


<?php if ($pagina_actual == "iniciar_sesion.php"): ?>

    <!-- SOLO login -->
    <script src="files/js/iniciar_sesion.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php endif; ?>

<?php if ($pagina_actual == "adoptar__apadrinar.php"): ?>

    <script src="files/js/botones_mascotas.js"></script>

<?php endif; ?>

<?php if (in_array($pagina_actual, ["noticias.php", "index.php"])): ?>

    <script src="files/js/swiper-bundle.min.js"></script>
    <script src="files/js/slider_noticias.js"></script>

<?php endif; ?>


<?php if (in_array($pagina_actual, ["contactanos.php", "index.php"])): ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="files/js/registrar_mensaje.js"></script>

<?php endif; ?>


<?php if ($pagina_actual == "recuperar_contra.php"): ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="files/js/recuperar_clave.js"></script>

<?php endif; ?>



<?php if ($pagina_actual == "recuperar_contra_code.php"): ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="files/js/recuperar_clave_code.js"></script>

<?php endif; ?>


<?php if ($pagina_actual == "nueva_clave.php"): ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="files/js/validar_claves.js"></script>

<?php endif; ?>


<?php if ($pagina_actual == "registrar_usuario.php"): ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="files/js/registrar_usuario.js"></script>

<?php endif; ?>


<?php if ($pagina_actual == "editar_correo.php"): ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="files/js/editar_correo.js"></script>

<?php endif; ?>


<?php if ($pagina_actual == "editar_telefono.php"): ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="files/js/editar_telefono.js"></script>

<?php endif; ?>



<?php if ($pagina_actual == "editar_clave.php"): ?>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="files/js/editar_claves.js"></script>

<?php endif; ?>


<!-- SIEMPRE -->
<script src="https://cdn.botpress.cloud/webchat/v2.1/inject.js"></script>
<script src="https://mediafiles.botpress.cloud/39b87354-3420-4b34-a397-1f21272eaf0e/webchat/v2.1/config.js"></script>

</body>

</html>