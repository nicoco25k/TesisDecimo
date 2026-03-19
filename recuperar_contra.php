<?php require_once __DIR__ . "/Estructure/Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/NavBar.php"; ?>

<div class="container my-5">
    <div class="card shadow-sm redondear">
        <div class="card-body p-4 p-md-5">

            <div class="row align-items-center g-4 justify-content-center">

                <!-- Imagen (opcional, puedes quitarla si no quieres) -->
                <div class="col-12 col-lg-5 text-center">
                    <img class="img_inicio" src="files/img/logoo.png" alt="Recuperar contraseña">
                </div>

                <!-- Formulario -->
                <div class="col-12 col-lg-5">

                    <h2 class="fw-bold text-center mb-4">Recuperar Contraseña</h2>

                    <form method="POST" action="" id="emailForm">

                        <!-- Grupo: Email -->
                        <div class="formulario__grupo">
                            <label for="email" class="formulario__label">
                                Ingresa tu correo electrónico
                            </label>

                            <div class="formulario__grupo-input">
                                <input
                                    type="email"
                                    class="formulario__input"
                                    name="email"
                                    id="email"
                                    placeholder="correo@ejemplo.com"
                                    minlength="8"
                                    maxlength="60"
                                    required>
                            </div>

                            <p class="formulario__input-error">
                                Ingresa un correo válido.
                            </p>
                        </div>

                        <!-- Botón -->
                        <div class="formulario__grupo formulario__grupo-btn-enviar pt-3">
                            <button type="submit" class="btn btn-success w-100 redondear2 fw-bold py-2">
                                Buscar cuenta
                            </button>
                        </div>

                        <!-- Volver al login -->
                        <div class="pt-4">
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