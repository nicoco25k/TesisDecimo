<?php require_once __DIR__ . "/Estructure/Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/NavBar.php"; ?>





<!-- Fondo de entrada -->
<div class="wave-footer">
    <div class="container-fluid-2 py-3 px-sm-3 px-md-3 bg-pie1 d-flex align-items-center justify-content-between">

        <div class="text-section">
            <h1 class="text-success text-center fontanimal pb-4 py-2">Adopta o Apadrina</h1>
            <p class="text-success text-justificado ps-4 pe-4">Cambia una vida ofreciendo un hogar lleno de amor o brindando apoyo constante a quienes más lo necesitan.</p>
        </div>

        <div class="image-section-2">
            <img src="files/img/nicol_perra.png" alt="Adopción" class="img-fluid-2">
        </div>
    </div>

    <svg viewBox="0 0 1440 100">
        <path fill="#112" fill-opacity="1" d="M0,80L48,85.3C96,91,192,101,288,90.7C384,80,480,59,576,53.3C672,48,768,64,864,74.7C960,85,1056,91,1152,85.3C1248,80,1344,69,1392,64L1440,59V100H0Z"></path>
    </svg>
</div>
<!-- Fin Fondo de entrada -->




<!-- Container De las Mascotas -->
<div class="container-mascotas pt-5">



    <?php


    try {

        require_once __DIR__ . "/models/datos_animales.php";

        $animales = obtenerAnimalesDisponibles();
        // Verificar si se obtuvieron resultados
        if (count($animales) > 0) {
            echo '<div class="container-fluid py-5">';
            echo '<div class="row">';

            // Sección de Anuncios Destacados (30%)
            echo '<div class="col-md-4 text-center caja_anuncios">';
            echo '<img class="img_megafono" src="files/img/megafono.png" alt="megafono de anuncios">';


            // Card de Condiciones de adopción

            echo

            '   
    
    <div class=" mb-3 caja_anuncios_peque" data-bs-toggle="modal" data-bs-target="#modal-condiciones">
             <div class="card-body text-center py-4 button">
            <span class="text">Condiciones de adopción</span>
            <span class="svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" viewBox="0 0 38 15" fill="none">
                    <path fill="white" d="M10 7.519l-.939-.344h0l.939.344zm14.386-1.205l-.981-.192.981.192zm1.276 5.509l.537.843.148-.094.107-.139-.792-.611zm4.819-4.304l-.385-.923h0l.385.923zm7.227.707a1 1 0 0 0 0-1.414L31.343.448a1 1 0 0 0-1.414 0 1 1 0 0 0 0 1.414l5.657 5.657-5.657 5.657a1 1 0 0 0 1.414 1.414l6.364-6.364zM1 7.519l.554.833.029-.019.094-.061.361-.23 1.277-.77c1.054-.609 2.397-1.32 3.629-1.787.617-.234 1.17-.392 1.623-.455.477-.066.707-.008.788.034.025.013.031.021.039.034a.56.56 0 0 1 .058.235c.029.327-.047.906-.39 1.842l1.878.689c.383-1.044.571-1.949.505-2.705-.072-.815-.45-1.493-1.16-1.865-.627-.329-1.358-.332-1.993-.244-.659.092-1.367.305-2.056.566-1.381.523-2.833 1.297-3.921 1.925l-1.341.808-.385.245-.104.068-.028.018c-.011.007-.011.007.543.84zm8.061-.344c-.198.54-.328 1.038-.36 1.484-.032.441.024.94.325 1.364.319.45.786.64 1.21.697.403.054.824-.001 1.21-.09.775-.179 1.694-.566 2.633-1.014l3.023-1.554c2.115-1.122 4.107-2.168 5.476-2.524.329-.086.573-.117.742-.115s.195.038.161.014c-.15-.105.085-.139-.076.685l1.963.384c.192-.98.152-2.083-.74-2.707-.405-.283-.868-.37-1.28-.376s-.849.069-1.274.179c-1.65.43-3.888 1.621-5.909 2.693l-2.948 1.517c-.92.439-1.673.743-2.221.87-.276.064-.429.065-.492.057-.043-.006.066.003.155.127.07.099.024.131.038-.063.014-.187.078-.49.243-.94l-1.878-.689zm14.343-1.053c-.361 1.844-.474 3.185-.413 4.161.059.95.294 1.72.811 2.215.567.544 1.242.546 1.664.459a2.34 2.34 0 0 0 .502-.167l.15-.076.049-.028.018-.011c.013-.008.013-.008-.524-.852l-.536-.844.019-.012c-.038.018-.064.027-.084.032-.037.008.053-.013.125.056.021.02-.151-.135-.198-.895-.046-.734.034-1.887.38-3.652l-1.963-.384zm2.257 5.701l.791.611.024-.031.08-.101.311-.377 1.093-1.213c.922-.954 2.005-1.894 2.904-2.27l-.771-1.846c-1.31.547-2.637 1.758-3.572 2.725l-1.184 1.314-.341.414-.093.117-.025.032c-.01.013-.01.013.781.624zm5.204-3.381c.989-.413 1.791-.42 2.697-.307.871.108 2.083.385 3.437.385v-2c-1.197 0-2.041-.226-3.19-.369-1.114-.139-2.297-.146-3.715.447l.771 1.846z"></path>
                </svg>
            </span>
        </div>
    </div>
    
    ';



            echo

            '   
    
    <div class=" mb-3 caja_anuncios_peque" data-bs-toggle="modal" data-bs-target="#modal-adoptar">
             <div class="card-body text-center py-4 button">
            <span class="text">¿Cómo adoptar?</span>
            <span class="svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" viewBox="0 0 38 15" fill="none">
                    <path fill="white" d="M10 7.519l-.939-.344h0l.939.344zm14.386-1.205l-.981-.192.981.192zm1.276 5.509l.537.843.148-.094.107-.139-.792-.611zm4.819-4.304l-.385-.923h0l.385.923zm7.227.707a1 1 0 0 0 0-1.414L31.343.448a1 1 0 0 0-1.414 0 1 1 0 0 0 0 1.414l5.657 5.657-5.657 5.657a1 1 0 0 0 1.414 1.414l6.364-6.364zM1 7.519l.554.833.029-.019.094-.061.361-.23 1.277-.77c1.054-.609 2.397-1.32 3.629-1.787.617-.234 1.17-.392 1.623-.455.477-.066.707-.008.788.034.025.013.031.021.039.034a.56.56 0 0 1 .058.235c.029.327-.047.906-.39 1.842l1.878.689c.383-1.044.571-1.949.505-2.705-.072-.815-.45-1.493-1.16-1.865-.627-.329-1.358-.332-1.993-.244-.659.092-1.367.305-2.056.566-1.381.523-2.833 1.297-3.921 1.925l-1.341.808-.385.245-.104.068-.028.018c-.011.007-.011.007.543.84zm8.061-.344c-.198.54-.328 1.038-.36 1.484-.032.441.024.94.325 1.364.319.45.786.64 1.21.697.403.054.824-.001 1.21-.09.775-.179 1.694-.566 2.633-1.014l3.023-1.554c2.115-1.122 4.107-2.168 5.476-2.524.329-.086.573-.117.742-.115s.195.038.161.014c-.15-.105.085-.139-.076.685l1.963.384c.192-.98.152-2.083-.74-2.707-.405-.283-.868-.37-1.28-.376s-.849.069-1.274.179c-1.65.43-3.888 1.621-5.909 2.693l-2.948 1.517c-.92.439-1.673.743-2.221.87-.276.064-.429.065-.492.057-.043-.006.066.003.155.127.07.099.024.131.038-.063.014-.187.078-.49.243-.94l-1.878-.689zm14.343-1.053c-.361 1.844-.474 3.185-.413 4.161.059.95.294 1.72.811 2.215.567.544 1.242.546 1.664.459a2.34 2.34 0 0 0 .502-.167l.15-.076.049-.028.018-.011c.013-.008.013-.008-.524-.852l-.536-.844.019-.012c-.038.018-.064.027-.084.032-.037.008.053-.013.125.056.021.02-.151-.135-.198-.895-.046-.734.034-1.887.38-3.652l-1.963-.384zm2.257 5.701l.791.611.024-.031.08-.101.311-.377 1.093-1.213c.922-.954 2.005-1.894 2.904-2.27l-.771-1.846c-1.31.547-2.637 1.758-3.572 2.725l-1.184 1.314-.341.414-.093.117-.025.032c-.01.013-.01.013.781.624zm5.204-3.381c.989-.413 1.791-.42 2.697-.307.871.108 2.083.385 3.437.385v-2c-1.197 0-2.041-.226-3.19-.369-1.114-.139-2.297-.146-3.715.447l.771 1.846z"></path>
                </svg>
            </span>
        </div>
    </div>
    
    ';



            echo

            '   
    
    <div class=" mb-3 caja_anuncios_peque" data-bs-toggle="modal" data-bs-target="#modal-apadrinar">
             <div class="card-body text-center py-4 button">
            <span class="text">¿Cómo puedo apadrinar?</span>
            <span class="svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" viewBox="0 0 38 15" fill="none">
                    <path fill="white" d="M10 7.519l-.939-.344h0l.939.344zm14.386-1.205l-.981-.192.981.192zm1.276 5.509l.537.843.148-.094.107-.139-.792-.611zm4.819-4.304l-.385-.923h0l.385.923zm7.227.707a1 1 0 0 0 0-1.414L31.343.448a1 1 0 0 0-1.414 0 1 1 0 0 0 0 1.414l5.657 5.657-5.657 5.657a1 1 0 0 0 1.414 1.414l6.364-6.364zM1 7.519l.554.833.029-.019.094-.061.361-.23 1.277-.77c1.054-.609 2.397-1.32 3.629-1.787.617-.234 1.17-.392 1.623-.455.477-.066.707-.008.788.034.025.013.031.021.039.034a.56.56 0 0 1 .058.235c.029.327-.047.906-.39 1.842l1.878.689c.383-1.044.571-1.949.505-2.705-.072-.815-.45-1.493-1.16-1.865-.627-.329-1.358-.332-1.993-.244-.659.092-1.367.305-2.056.566-1.381.523-2.833 1.297-3.921 1.925l-1.341.808-.385.245-.104.068-.028.018c-.011.007-.011.007.543.84zm8.061-.344c-.198.54-.328 1.038-.36 1.484-.032.441.024.94.325 1.364.319.45.786.64 1.21.697.403.054.824-.001 1.21-.09.775-.179 1.694-.566 2.633-1.014l3.023-1.554c2.115-1.122 4.107-2.168 5.476-2.524.329-.086.573-.117.742-.115s.195.038.161.014c-.15-.105.085-.139-.076.685l1.963.384c.192-.98.152-2.083-.74-2.707-.405-.283-.868-.37-1.28-.376s-.849.069-1.274.179c-1.65.43-3.888 1.621-5.909 2.693l-2.948 1.517c-.92.439-1.673.743-2.221.87-.276.064-.429.065-.492.057-.043-.006.066.003.155.127.07.099.024.131.038-.063.014-.187.078-.49.243-.94l-1.878-.689zm14.343-1.053c-.361 1.844-.474 3.185-.413 4.161.059.95.294 1.72.811 2.215.567.544 1.242.546 1.664.459a2.34 2.34 0 0 0 .502-.167l.15-.076.049-.028.018-.011c.013-.008.013-.008-.524-.852l-.536-.844.019-.012c-.038.018-.064.027-.084.032-.037.008.053-.013.125.056.021.02-.151-.135-.198-.895-.046-.734.034-1.887.38-3.652l-1.963-.384zm2.257 5.701l.791.611.024-.031.08-.101.311-.377 1.093-1.213c.922-.954 2.005-1.894 2.904-2.27l-.771-1.846c-1.31.547-2.637 1.758-3.572 2.725l-1.184 1.314-.341.414-.093.117-.025.032c-.01.013-.01.013.781.624zm5.204-3.381c.989-.413 1.791-.42 2.697-.307.871.108 2.083.385 3.437.385v-2c-1.197 0-2.041-.226-3.19-.369-1.114-.139-2.297-.146-3.715.447l.771 1.846z"></path>
                </svg>
            </span>
        </div>
    </div>
    
    ';






            echo '<p class="pb-5"></p>';
            echo '</div>'; // Cerrar columna de anuncios

            // Sección de Tarjetas de Mascotas (70%)
            echo '<div class="col-md-8">';
            echo '<div class="container">';
            echo '<div class="row justify-content-center">';
            echo '<div class="col-lg-12">';



            echo '<img class="adopta_cambio pt-4 pb-4" src="files/img/adopta_cambia.png" alt="megafono de anuncios">';




            echo '</div>';
            echo '</div>';
            echo '</div>';

            echo '<div class="row">'; // Agregar una fila para las mascotas


            foreach ($animales as $index => $animal) {
                if ($index >= 6) break;



                require __DIR__ . "/Complements/cards_animales.php";
            }

            echo '</div>'; // Cerrar la fila

            // Verificar si hay más registros ocultos
            if (count($animales) > 6) {
                echo '<div id="hidden-animals" style="display: none;">'; // Div para ocultar los registros adicionales
                echo '<div class="row">'; // Agregar una fila para los animales ocultos

                foreach (array_slice($animales, 6) as $animal) {

                    require __DIR__ . "/Complements/cards_animales.php";
                }






                echo '</div>'; // Cerrar la fila
                echo '</div>'; // Cerrar el div oculto

                // echo '<div class="text-center pt-5">';
                // echo '<button id="ver-mas-btn" class="btn btn-primary">Ver más animales</button>'; // Botón "Ver más"
                // echo '</div>';


                echo

                '   
    <div class="mb-3 text-center">
<div id="ver-mas-btn" class="caja_anuncios_peque peque button" style="cursor:pointer;">
             <div class="card-body text-center py-4 button">
            <span class="text">Ver más animales</span>
            <span class="svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="20" viewBox="0 0 38 15" fill="none">
                    <path fill="white" d="M10 7.519l-.939-.344h0l.939.344zm14.386-1.205l-.981-.192.981.192zm1.276 5.509l.537.843.148-.094.107-.139-.792-.611zm4.819-4.304l-.385-.923h0l.385.923zm7.227.707a1 1 0 0 0 0-1.414L31.343.448a1 1 0 0 0-1.414 0 1 1 0 0 0 0 1.414l5.657 5.657-5.657 5.657a1 1 0 0 0 1.414 1.414l6.364-6.364zM1 7.519l.554.833.029-.019.094-.061.361-.23 1.277-.77c1.054-.609 2.397-1.32 3.629-1.787.617-.234 1.17-.392 1.623-.455.477-.066.707-.008.788.034.025.013.031.021.039.034a.56.56 0 0 1 .058.235c.029.327-.047.906-.39 1.842l1.878.689c.383-1.044.571-1.949.505-2.705-.072-.815-.45-1.493-1.16-1.865-.627-.329-1.358-.332-1.993-.244-.659.092-1.367.305-2.056.566-1.381.523-2.833 1.297-3.921 1.925l-1.341.808-.385.245-.104.068-.028.018c-.011.007-.011.007.543.84zm8.061-.344c-.198.54-.328 1.038-.36 1.484-.032.441.024.94.325 1.364.319.45.786.64 1.21.697.403.054.824-.001 1.21-.09.775-.179 1.694-.566 2.633-1.014l3.023-1.554c2.115-1.122 4.107-2.168 5.476-2.524.329-.086.573-.117.742-.115s.195.038.161.014c-.15-.105.085-.139-.076.685l1.963.384c.192-.98.152-2.083-.74-2.707-.405-.283-.868-.37-1.28-.376s-.849.069-1.274.179c-1.65.43-3.888 1.621-5.909 2.693l-2.948 1.517c-.92.439-1.673.743-2.221.87-.276.064-.429.065-.492.057-.043-.006.066.003.155.127.07.099.024.131.038-.063.014-.187.078-.49.243-.94l-1.878-.689zm14.343-1.053c-.361 1.844-.474 3.185-.413 4.161.059.95.294 1.72.811 2.215.567.544 1.242.546 1.664.459a2.34 2.34 0 0 0 .502-.167l.15-.076.049-.028.018-.011c.013-.008.013-.008-.524-.852l-.536-.844.019-.012c-.038.018-.064.027-.084.032-.037.008.053-.013.125.056.021.02-.151-.135-.198-.895-.046-.734.034-1.887.38-3.652l-1.963-.384zm2.257 5.701l.791.611.024-.031.08-.101.311-.377 1.093-1.213c.922-.954 2.005-1.894 2.904-2.27l-.771-1.846c-1.31.547-2.637 1.758-3.572 2.725l-1.184 1.314-.341.414-.093.117-.025.032c-.01.013-.01.013.781.624zm5.204-3.381c.989-.413 1.791-.42 2.697-.307.871.108 2.083.385 3.437.385v-2c-1.197 0-2.041-.226-3.19-.369-1.114-.139-2.297-.146-3.715.447l.771 1.846z"></path>
                </svg>
            </span>
        </div>
    </div>
    </div>
    
    ';

                echo '


    <div class="mb-3 text-center" id="ver-menos-container" style="display:none;">
<div id="ver-menos-btn" class="caja_anuncios_peque peque button" style="cursor:pointer;">
             <div class="card-body text-center py-4 button">
             
            <span class="text">Ver menos animales</span>
          
        </div>
    </div>
    </div>
';
            }

            echo '</div>'; // Cerrar columna de mascotas
            echo '</div>'; // Cerrar fila
            echo '</div>'; // Cerrar container-fluid
        } else {
            echo '<p>No se encontraron animales.</p>';
        }
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
    ?>

</div>






<!-- Modal de Condiciones de adopción -->
<div class="modal fade" id="modal-condiciones" tabindex="-1" role="dialog" aria-labelledby="modalCondicionesLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCondicionesLabel">Condiciones de Adopción</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Aquí puedes incluir los detalles sobre las condiciones de adopción. Por ejemplo:
                <ul>
                    <li class="pt-4">Debes ser mayor de edad.</li>
                    <li>Te comprometes a cuidar del animal en salud, alimentación, vacunación, recreación y bienestar físico y mental.</li>
                    <li>El animal debe ser tratado como un miembro de tu familia.</li>
                    <li>En caso de incumplimiento en el cuidado del animal, deberás pagar una multa equivalente al 10% de un salario mínimo (aproximadamente $116,000).</li>
                    <li>Aceptar los términos y condiciones de tratamiento de datos y firmar el acta de adopción de la Asociación ASOPATICAS.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Cómo puedo adoptar -->
<div class="modal fade" id="modal-adoptar" tabindex="-1" role="dialog" aria-labelledby="modalAdoptarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalAdoptarLabel">¿Cómo puedo adoptar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Proceso de Adopción</h5>
                <p class="pb-4">Para adoptar a un animal, sigue estos pasos:</p>
                <ol class="text-justificado">
                    <li>Interactúa con MaruBot en la esquina inferior derecha de la página.</li>
                    <li>Ten claro el nombre del animal que deseas adoptar; puedes consultarlo en la sección de mascotas de nuestra plataforma.</li>
                    <li>Sigue las instrucciones que te proporciona MaruBot para completar el proceso.</li>
                    <li>Acepta los términos y condiciones sobre el tratamiento de datos y el acta de adopción de la Asociación ASOPATICAS.</li>
                    <li>Completa un cuestionario y proporciona tus datos personales.</li>
                    <li>Recibirás un correo confirmando que tu solicitud ha sido enviada exitosamente. Estará en revisión y pronto la Asociación ASOPATICAS se contactará contigo.</li>
                </ol>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Cómo puedo apadrinar -->
<div class="modal fade" id="modal-apadrinar" tabindex="-1" role="dialog" aria-labelledby="modalApadrinarLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalApadrinarLabel">¿Cómo puedo apadrinar?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Proceso de Apadrinamiento</h5>
                <p class="pb-4">Para apadrinar a un animal, sigue estos pasos:</p>
                <ol>
                    <li>Interactúa con MaruBot en la esquina inferior derecha de la página.</li>
                    <li class="pb-4">MaruBot te llevará a los canales de atención para completar el proceso de apadrinamiento con la ayuda de la Asociación ASOPATICAS.</li>
                </ol>
                <p>Tu apoyo es fundamental para mejorar las condiciones de vida de los animales en nuestra asociación.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>




<?php require_once __DIR__ . "/Estructure/AnimalCards.php"; ?>
<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>