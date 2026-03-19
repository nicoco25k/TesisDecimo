<?php
require_once __DIR__ . "/Estructure/Header.php";
require_once __DIR__ . "/Estructure/NavBar.php";
require_once __DIR__ . "/models/datos_animales.php";

// Validación segura del ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "<div class='container py-5'><h3>ID no válido</h3></div>";
    require_once __DIR__ . "/Estructure/Footer.php";
    exit;
}

$id = (int) $_GET['id'];

$animal = obtenerAnimalPorId($id);

if (!$animal) {
    echo "<div class='container py-5'><h3>Animal no encontrado</h3></div>";
    require_once __DIR__ . "/Estructure/Footer.php";
    exit;
}
?>


<div class="pf-bg-section">

    <div class="container py-5">

        <div class="pf-card-detalle shadow-lg rounded-4 p-4">

            <div class="row g-5 align-items-start">

                <!-- IMAGEN -->
                <div class="col-lg-7">
                    <div class="pf-image-wrapper">
                        <img src="<?= htmlspecialchars($animal['ruta_img_mascota']) ?>"
                            alt="Imagen de <?= htmlspecialchars($animal['nombre_mascota']) ?>"
                            class="pf-main-image">

                    </div>

                    <div class="pf-botones text-center mt-4">

                        <a href="#como-adoptar"
                            class="btn pf-btn-adopt mb-3">
                            Quiero Adoptar A <?= htmlspecialchars($animal['nombre_mascota']) ?>
                        </a>

                        <br>







                        <button class="btn pf-btn-share pt-2 mb-3"
                            onclick="compartirMascota()">
                            <i class="fa-solid fa-share-nodes"></i> Compartir
                        </button>


                        <a href="adoptar__apadrinar.php"
                            class="btn pf-btn-volver pt-2 mb-3">
                            <i class="fa-solid fa-rotate-left"></i>
                            Volver
                        </a>

                    </div>








                </div>

                <!-- INFORMACIÓN -->
                <div class="col-lg-5">

                    <h2 class="pf-nombre mb-2 text-solid">
                        <?= htmlspecialchars($animal['nombre_mascota']) ?>
                    </h2>

                    <p class="pf-frase pb-3">
                        Está esperando una familia que le brinde amor y un hogar lleno de felicidad
                        <i class="fa-solid fa-paw"></i>
                    </p>

                    <div class="pf-info-box">

                        <div>
                            <i class="fa-solid fa-venus-mars"></i>
                            <strong>Sexo:</strong>
                            <?= htmlspecialchars($animal['nombre_sexo']) ?>
                        </div>

                        <div>
                            <i class="fa-solid fa-cake-candles"></i>
                            <strong>Edad:</strong>
                            <?= htmlspecialchars($animal['nombre_edad']) ?>
                        </div>

                        <div>
                            <i class="fa-solid fa-dog"></i>
                            <strong>Raza:</strong>
                            <?= htmlspecialchars($animal['nombre_raza']) ?>
                        </div>

                        <div>
                            <i class="fa-solid fa-shield-dog"></i>
                            <strong>Esterilizado:</strong>
                            <?= htmlspecialchars($animal['nombre_esterilizacion']) ?>
                        </div>

                        <div>
                            <i class="fa-solid fa-syringe"></i>
                            <strong>Vacunas:</strong>
                            <?= htmlspecialchars($animal['nombre_vacuna']) ?>
                        </div>

                        <div>
                            <i class="fa-solid fa-bug"></i>
                            <strong>Desparasitado:</strong>
                            <?= htmlspecialchars($animal['nombre_desparasitacion']) ?>
                        </div>

                    </div>


                    <hr class="my-4">

                    <!-- CARACTERÍSTICAS -->
                    <div class="pf-caracteristicas mb-4">
                        <h5><i class="fa-solid fa-paw"></i> Características</h5>
                        <p>
                            <?= htmlspecialchars($animal['caracteristicas_de_comportamiento_mascota']) ?>
                        </p>
                    </div>




                </div>
                <!-- BOTONES -->


            </div>

        </div>


        <!-- SECCIÓN CÓMO ADOPTAR -->
        <div id="como-adoptar" class="pf-adopcion-section mt-5 p-4 shadow pt-4">

            <div class="row align-items-center">

                <!-- TEXTO IZQUIERDA -->
                <div class="col-lg-5">

                    <h4 class="pb-4">
                        <i class="fa-solid fa-paw"></i> ¿Cómo adoptar?
                    </h4>

                    <ol class="pf-lista-adopcion pb-2">
                        <li>Interactúa con <strong>MaruBot</strong> en la esquina inferior derecha.</li>
                        <li>Ten claro el nombre del animal que deseas adoptar.</li>
                        <li>Sigue las instrucciones proporcionadas por MaruBot.</li>
                        <li>Acepta los términos y condiciones sobre el tratamiento de datos y el acta de adopción de <strong>ASOPATICAS</strong>.</li>
                        <li>Completa el cuestionario con tus datos personales.</li>
                        <li>Recibirás un correo confirmando que tu solicitud fue enviada exitosamente.</li>
                    </ol>

                    <div class="pf-mensaje-final">

                        Al enviar tu solicitud será revisada y pronto la Asociación ASOPATICAS se contactará contigo.
                        <i class="fa-solid fa-heart"></i>
                    </div>

                </div>

                <!-- IMAGEN DERECHA -->
                <div class="col-lg-5 text-center">
                    <img src="files/img/33.png"
                        alt="Proceso de adopción"
                        class="pf-img-adopcion">
                </div>

            </div>

        </div>

    </div>

</div>

<?php require_once __DIR__ . "/Estructure/AnimalCards.php"; ?>
<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>