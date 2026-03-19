<?php require_once __DIR__ . "/Estructure/Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/NavBar.php"; ?>

<div class="container my-5">
	<div class="card shadow-sm redondear">
		<div class="card-body p-4 p-md-5">

			<div class="row align-items-center g-4 justify-content-center">

				<!-- Imagen -->
				<div class="col-12 col-lg-5 text-center">

					<img class="img_inicio" src="files/img/logoo.png" alt="imagen sobre asopetssoft">
				</div>


				<!-- Formulario -->
				<div class="col-12 col-lg-5">

					<h2 class="fw-bold text-center mb-4">Iniciar Sesión</h2>

					<form method="POST" action="asopetssoft.php" id="formulario">

						<!-- Grupo: usuario -->
						<div class="formulario__grupo" id="grupo__usuario">
							<label for="usuario" class="formulario__label">Nickname</label>
							<div class="formulario__grupo-input">
								<input type="text" class="formulario__input" name="usuario" id="usuario" placeholder="Escribe tu nombre de usuario" minlength="8" maxlength="20" required>
								<i class="formulario__validacion-estado fas fa-times-circle"></i>
							</div>
							<p class="formulario__input-error">Querido usuario, el nickname debe tener 8 a 20 caracteres.</p>
						</div>

						<!-- Grupo: Contraseña -->
						<div class="formulario__grupo py-3 pb-5" id="grupo__password">
							<label for="password" class="formulario__label">Contraseña</label>
							<div class="formulario__grupo-input">
								<input type="password" class="formulario__input" name="password" id="password" placeholder="********" minlength="8" maxlength="20" required>
								<i class="formulario__validacion-estado fas fa-times-circle"></i>
							</div>
							<p class="formulario__input-error">La contraseña tiene que ser de 8 a 12 caracteres.</p>
						</div>


						<div class="formulario__grupo formulario__grupo-btn-enviar pt-3">
							<button type="submit" class="btn btn-success w-100 redondear2 fw-bold py-2">
								Iniciar Sesión
							</button>
						</div>

						<div class="py-3">
							<a href="recuperar_contra.php" class="btn btn-outline-secondary w-100 redondear2 fw-bold py-2 text-decoration-none">
								¿Olvidaste tu contraseña?
							</a>
						</div>

						<div class="pt-5">
							<a href="registrar_usuario.php" class="btn btn-outline-success w-100 redondear2 fw-bold py-2 text-decoration-none">
								Crear cuenta nueva
							</a>
						</div>

					</form>
				</div>

			</div>
		</div>
	</div>
</div>


<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>