<?php
session_start();

$usuario = $_SESSION['usuario'];

include_once("bd/Conexion.php");



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



            <h3 class="text-center py-3"><b>Digita tu nuevo número de telefono</b></h3>


            <form method="POST" action="" class=" text-center " id="formulario">
                <!-- Grupo: Teléfono -->
                <div class="formulario__grupo" id="grupo__telefono">
                    <div class="formulario__grupo-input">
                        <input type="number" class="formulario__input text-center" name="telefono" id="telefono" placeholder="Escribe tu nuevo número de telefono" minlength="8" maxlength="12" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Querido usuario, el teléfono debe tener de 8 a 12 números.</p>
                </div>




                <div class="formulario__grupo formulario__grupo-btn-enviar py-4">
                    <button type="submit" class="btn btn-success my-2 my-sm-0" id="btn-actualizar-correo">Actualizar Telefono</button>

                </div>
            </form>


        </main>



    </div>
</div>

<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>