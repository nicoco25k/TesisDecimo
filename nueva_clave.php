<?php
if (isset($_POST['variable'])) {
    $id_usuario = $_POST['variable'];
}





?>

<?php require_once __DIR__ . "/Estructure/Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/NavBar.php"; ?>

<div class="container my-5">
    <div class="card shadow-sm redondear">
        <div class="card-body p-4 p-md-5">

            <div class="row align-items-center g-4 justify-content-center">

                <!-- Imagen -->
                <div class="col-12 col-lg-5 text-center">
                    <img class="img_inicio" src="files/img/logoo.png" alt="Restablecer contraseña">
                </div>

                <!-- Formulario -->
                <div class="col-12 col-lg-5">

                    <h2 class="fw-bold text-center mb-4">Restablecer contraseña</h2>

                    <form method="POST" action="validar_claves.php" id="cambiopass">

                        <p class="text-center mb-4">
                            La nueva contraseña debe tener entre 8 y 20 caracteres (letras y números)
                        </p>

                        <!-- Nueva contraseña -->
                        <div class="formulario__grupo">
                            <label for="password1" class="formulario__label">
                                Nueva contraseña
                            </label>

                            <div class="formulario__grupo-input">
                                <input
                                    type="password"
                                    class="formulario__input"
                                    name="password1"
                                    id="password1"
                                    placeholder="********"
                                    minlength="8"
                                    maxlength="20"
                                    required>
                            </div>
                        </div>

                        <!-- Confirmar contraseña -->
                        <div class="formulario__grupo pt-3">
                            <label for="password2" class="formulario__label">
                                Confirmar contraseña
                            </label>

                            <div class="formulario__grupo-input">
                                <input
                                    type="password"
                                    class="formulario__input"
                                    name="password2"
                                    id="password2"
                                    placeholder="********"
                                    minlength="8"
                                    maxlength="20"
                                    required>
                            </div>
                        </div>

                        <!-- ID oculto -->
                        <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">

                        <!-- Botón -->
                        <div class="formulario__grupo formulario__grupo-btn-enviar pt-4">
                            <button type="submit" class="btn btn-success w-100 redondear2 fw-bold py-2">
                                Cambiar contraseña
                            </button>
                        </div>

                        <!-- Volver -->
                        <div class="pt-3">
                            <a href="iniciar_sesion.php" class="btn btn-outline-secondary w-100 redondear2 fw-bold py-2 text-decoration-none">
                                Volver al inicio de sesión
                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>