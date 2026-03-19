<?php require_once __DIR__ . "/Estructure/Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/NavBar.php"; ?>



<div class="container my-5">
    <div class="card shadow-sm redondear pb-5">


        <h2 class="pb-3 pt-5 text-center"><b>Formulario De Registro</b></h2>
        <div id="centrar_r">
            <img id="logo_asopetssoft" class="img" src="files/img/logoo.png" alt="imagen sobre asopetssoft">

        </div>



        <main>




            <form method="POST" action="" class="formulario" id="formulario">
                <!-- Grupo: Nombre -->
                <div class="formulario__grupo" id="grupo__nombre">
                    <label for="nombre" class="formulario__label">Nombre</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" name="nombre" id="nombre" placeholder="Escribe tu nombre" minlength="4" maxlength="40" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Querido usuario, el nombre debe tener de 4 a 16 letras.</p>
                </div>

                <!-- Grupo: Apellido -->
                <div class="formulario__grupo" id="grupo__apellido">
                    <label for="apellido" class="formulario__label">Apellido</label>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" name="apellido" id="apellido" placeholder="Escribe tu apellido" minlength="4" maxlength="40" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Querido usuario, el apellido debe tener de 4 a 16 letras.</p>
                </div>

                <!-- Grupo: Correo Electrónico -->
                <div class="formulario__grupo" id="grupo__correo">
                    <label for="correo" class="formulario__label">Correo Electrónico</label>
                    <div class="formulario__grupo-input">
                        <input type="email" class="formulario__input" name="correo" id="correo" placeholder="Escribe tu correo electrónico" minlength="4" maxlength="60" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Querido usuario, el correo no es válido.</p>
                </div>

                <!-- Grupo: Teléfono -->
                <div class="formulario__grupo" id="grupo__telefono">
                    <label for="telefono" class="formulario__label">Teléfono</label>
                    <div class="formulario__grupo-input">
                        <input type="number" class="formulario__input" name="telefono" id="telefono" placeholder="Escribe tu número de celular" minlength="8" maxlength="12" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Querido usuario, el teléfono debe tener de 8 a 12 números.</p>
                </div>

                <!-- Grupo: Tipo de documento y número de documento -->
                <div class="formulario__grupo" id="grupo__documento">
                    <label for="documento" class="formulario__label">Tipo de documento</label>
                    <div class="caja">
                        <select name="tipo_documento" id="documento_opcion" required></select>
                        <br>
                    </div>
                    <div class="formulario__grupo-input">
                        <input type="number" class="formulario__input" name="documento" id="documento" placeholder="Escribe tu número de documento" minlength="6" maxlength="12" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Querido usuario, el documento debe tener de 6 a 12 números.</p>
                </div>

                <!-- Grupo: Usuario -->
                <div class="formulario__grupo" id="grupo__usuario">
                    <label for="usuario" class="formulario__label">Nickname de cuenta</label>
                    <p style="text-align: center; color: #940a0a; margin: 8px; font-size: 15px;">"Con este nickname iniciarás sesión"</p>
                    <div class="formulario__grupo-input">
                        <input type="text" class="formulario__input" name="usuario" id="usuario" placeholder="Escribe tu nombre de usuario" minlength="8" maxlength="20" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Querido usuario, el nickname debe tener de 8 a 20 caracteres.</p>
                </div>

                <!-- Grupo: Contraseña -->
                <div class="formulario__grupo" id="grupo__password">
                    <label for="password" class="formulario__label">Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" class="formulario__input" name="password" id="password" placeholder="********" minlength="8" maxlength="20" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">La contraseña tiene que ser de 8 a 12 caracteres.</p>
                </div>

                <!-- Grupo: Confirmar contraseña -->
                <div class="formulario__grupo" id="grupo__password2">
                    <label for="password2" class="formulario__label">Repetir Contraseña</label>
                    <div class="formulario__grupo-input">
                        <input type="password" class="formulario__input" name="password2" id="password2" placeholder="********" minlength="8" maxlength="20" required>
                        <i class="formulario__validacion-estado fas fa-times-circle"></i>
                    </div>
                    <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
                </div>

                <!-- Grupo: Términos y Condiciones -->
                <div class="formulario__grupo" id="grupo__terminos">
                    <label class="formulario__label">
                        <input class="formulario__checkbox" type="checkbox" name="terminos" id="terminos" required>
                        <a href="terminos_y_condiciones.php" target="_blank" class=" text-muted">Acepto los Términos y Condiciones</a>
                    </label>
                </div>

                <div class="formulario__grupo formulario__grupo-btn-enviar">
                    <button type="submit" class="btn btn-success my-2 my-sm-0">Registrarse</button>
                </div>
            </form>


        </main>
    </div>
</div>



<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>