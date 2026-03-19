  <?php
                include_once("bd/Conexion.php");

                $sql = "
                SELECT id_noticias, img_noticia 
                FROM tabla_noticias 
                ORDER BY id_noticias DESC 
                LIMIT 4
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