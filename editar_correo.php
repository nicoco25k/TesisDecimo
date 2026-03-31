<?php
session_start();

$usuario = $_SESSION['usuario'];

include_once("bd/Conexion.php");
$sql = "SELECT correo_usuario 
FROM tabla_usuarios WHERE nickname_usuario='$usuario'";

foreach ($dbh->query($sql) as $row) {
    $correo_usuario = $row['correo_usuario'];
}


//echo $nombre_usuario.$apellido_usuario.$telefono_usuario.$id_tipo_documento.$numero_documento_usuario.$correo_usuario;



if (!isset($usuario)) {
    header('location: iniciar_sesion.php');
}



?>




<?php require_once __DIR__ . "/Estructure/Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/NavBar.php"; ?>











<div class="container my-5">
    <div class="card shadow-sm redondear pb-5">



        <p class="py-5"></p>
        <main>



            <h3 class="text-center py-3"><b>Digita tu nuevo correo electrónico</b></h3>


            <form method="POST" action="" class=" text-center " id="formulario">
                <!-- Grupo: Correo Electrónico -->

                <div class="formulario__grupo " id="grupo__correo">

                    <div class="formulario__grupo-input ">
                        <input type="email" class="formulario__input text-center" name="correo" id="correo" placeholder="Escribe tu nuevo correo" minlength="4" maxlength="60" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Querido usuario, el correo no es válido.</p>
                </div>




                <div class="formulario__grupo formulario__grupo-btn-enviar py-4">
                    <button type="submit" class="btn btn-success my-2 my-sm-0" id="btn-actualizar-correo">Actualizar Correo</button>

                </div>
            </form>


        </main>


    </div>
</div>






<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>