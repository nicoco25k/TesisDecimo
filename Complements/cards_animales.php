<?php if (!isset($animal)) return; ?>


<div class="col-lg-4 col-md-6 mb-4 d-flex justify-content-center">

    <div class="pf-card-wrap pb-4">
        <div class="pf-card">

            <!-- FRONT -->
            <div class="pf-front">
                <div class="pf-image">
                    <img src="<?= $animal['ruta_img_mascota'] ?>"
                        alt="Imagen de <?= $animal['nombre_mascota'] ?>">

                    <div class="pf-gradient"></div>

                    <div class="pf-text">
                        <h3><?= $animal['nombre_mascota'] ?></h3>
                        <span><?= $animal['nombre_sexo'] ?></span>
                    </div>
                </div>

                <div class="pf-body">
                    <div class="pf-breed">
                        <span class="label_negrilla">Edad: </span>
                        <?= $animal['nombre_edad'] ?>
                    </div>

                    <div class="pf-breed">
                        <span class="label_negrilla">Raza: </span>
                        <?= $animal['nombre_raza'] ?>
                    </div>

                    <div class="pf-divider"></div>

                    <div class="pf-buttons">
                        <a href="detalle_mascota.php?id=<?= $animal['id_mascotas'] ?>"
                            class="pf-btn-primary text-align-center text-decoration-none text-white">
                            Conocer Más
                        </a> <button class="pf-btn-secondary pf-fast text-align-center ">
                            <i class="fa-solid fa-clipboard-list"></i>
                            Datos Rápidos
                        </button>
                    </div>
                </div>
            </div>

            <!-- BACK -->
            <div class="pf-back">
                <div class="pf-back-overlay"></div>

                <div class="pf-back-content">
                    <h3>Datos de <?= $animal['nombre_mascota'] ?></h3>

                    <div class="pf-facts">
                        <div><span>Sexo</span><b><?= $animal['nombre_sexo'] ?></b></div>
                        <div><span>Edad</span><b><?= $animal['nombre_edad'] ?></b></div>
                        <div><span>Raza</span><b><?= $animal['nombre_raza'] ?></b></div>
                        <div><span>Esterilizado</span><b><?= $animal['nombre_esterilizacion'] ?></b></div>
                        <div><span>Desparasitado</span><b><?= $animal['nombre_desparasitacion'] ?></b></div>
                    </div>

                    <div class="pf-caracteristicas">
                        <span>Características</span>
                        <p><?= $animal['caracteristicas_de_comportamiento_mascota'] ?></p>
                    </div>

                    <div class="pf-buttons-back">
                        <a href="detalle_mascota.php?id=<?= $animal['id_mascotas'] ?>"
                            class="pf-btn-primary text-align-center text-decoration-none text-white">
                            Conocer Más
                        </a>

                        <button class="pf-btn-secondary pf-btn-back">
                            <i class="fa-solid fa-rotate-left"></i>
                            Volver
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>