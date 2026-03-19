<?php require_once __DIR__ . "/Estructure/Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/NavBar.php"; ?>

<div class="container my-5">
    <div class="card shadow-sm redondear">
        <div class="card-body p-4 p-md-5">

            <div class="row align-items-center g-4 justify-content-center">

                <!-- Imagen -->
                <div class="col-12 col-lg-5 text-center">
                    <img class="img_inicio" src="files/img/logoo.png" alt="Código de verificación">
                </div>

                <!-- Formulario -->
                <div class="col-12 col-lg-5">

                    <h2 class="fw-bold text-center mb-4">Código de verificación</h2>

                    <form method="POST" action="" id="codeform">

                        <!-- Grupo: Código -->
                        <div class="formulario__grupo">
                            <label for="code" class="formulario__label">
                                Revisa tu correo e ingresa el código de 6 dígitos
                            </label>

                            <div class="formulario__grupo-input">
                                <input
                                    type="text"
                                    class="formulario__input text-center fw-bold"
                                    name="code"
                                    id="code"
                                    placeholder="000000"
                                    maxlength="6"
                                    pattern="[0-9]{6}"
                                    required>
                            </div>

                            <p class="formulario__input-error">
                                El código debe tener 6 números.
                            </p>
                        </div>

                        <!-- Botón -->
                        <div class="formulario__grupo formulario__grupo-btn-enviar pt-3">
                            <button type="submit" class="btn btn-success w-100 redondear2 fw-bold py-2">
                                Verificar código
                            </button>
                        </div>

                        <!-- Volver -->
                        <div class="pt-4">
                            <a href="recuperar_contra.php" class="btn btn-outline-secondary w-100 redondear2 fw-bold py-2 text-decoration-none">
                                Volver
                            </a>
                        </div>

                    </form>

                </div>

            </div>

        </div>
    </div>
</div>

<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>