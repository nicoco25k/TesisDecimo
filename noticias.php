<?php require_once __DIR__ . "/Estructure/Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/NavBar.php"; ?>



<div class="container-contacto py-2">
    <h3 class="text-success text-center pt-5 pb-2 fontanimal">Últimas Noticias</h3>

    <div class="slide-container swiper">
        <div class="slide-content">
            <div class="card-wrapper swiper-wrapper">
                <?php
                include_once("bd/Conexion.php");

                $sql = "
         SELECT id_noticias, img_noticia 
FROM tabla_noticias 
WHERE id_estado_noticia = 1
ORDER BY id_noticias DESC 
LIMIT 6
                ";

                foreach ($dbh->query($sql) as $row) {
                    $img_noticia = $row['img_noticia'];

                    echo '
                    <div class="card swiper-slide">
                        <div class="image-content">
                            <span class="overlay"></span>
                            <div class="card-image image-container">
                                <img src="' . $img_noticia . '" alt="Imagen de la noticia" class="card-img" title="Noticias recientes" />
                            </div>
                        </div>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>

        <div class="swiper-button-next swiper-navBtn"></div>
        <div class="swiper-button-prev swiper-navBtn"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<!-- Fin de la sección "Nosotros" -->














<?php require_once __DIR__ . "/Estructure/AnimalCards.php"; ?>
<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>