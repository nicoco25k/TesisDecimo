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



            <h3 class="text-center py-3"><b>Digita tu nuevo contraseña</b></h3>
            <label for="emails" class="formulario__label text-center py-3">Recuerda que la nueva contraseña puede contener letras o numeros y esta debe contar entre 8 a 20 caracteres</label>

            <form method="POST" action="" class="formulario" id="formulario">


                <!-- Grupo: Contraseña -->
                <div class="formulario__grupo" id="grupo__password">
                    <label for="password" class="formulario__label">Nueva Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" class="formulario__input" name="password" id="password" placeholder="********" minlength="8" maxlength="20" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">La contraseña tiene que ser de 8 a 12 caracteres.</p>
                </div>

                <!-- Grupo: Confirmar contraseña -->
                <div class="formulario__grupo" id="grupo__password2">
                    <label for="password2" class="formulario__label">Repetir Nueva Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" class="formulario__input" name="password2" id="password2" placeholder="********" minlength="8" maxlength="20" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                </div>



                <div class="formulario__grupo formulario__grupo-btn-enviar py-3">
                    <button type="submit" class="btn btn-success my-2 my-sm-0">Cambiar contraseña</button>
                </div>

    </div>


    </form>


    </main>




</div>
</div>


<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>