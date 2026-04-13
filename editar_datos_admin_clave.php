<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>
<?php include_once("bd/Conexion.php"); ?>

<?php
$usuario = $_SESSION['usuario'] ?? '';

$stmt = $dbh->prepare("SELECT id_rol FROM tabla_usuarios WHERE nickname_usuario = ?");
$stmt->execute([$usuario]);
$id_rol = $stmt->fetchColumn() ?: null;
?>

<p class="py-4"></p>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-11 col-sm-8 col-md-6 col-lg-5">

      <main>
        <h3 class="text-center py-3"><b>Digita tu nueva contraseña</b></h3>
        <p class="text-center text-muted small px-2">
          Recuerda que la nueva contraseña puede contener letras o números y debe contar entre 8 a 20 caracteres.
        </p>

        <form method="POST" action="" class="formulario" id="formulario" style="display: block;">

          <!-- Grupo: Contraseña -->
          <div class="formulario__grupo w-100 mb-3" id="grupo__password" style="display: block;">
            <label for="password" class="formulario__label">Nueva Contraseña</label>
            <div class="formulario__grupo-input">
              <input type="password" class="formulario__input w-100" name="password" id="password" placeholder="********" minlength="8" maxlength="20" required>
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">La contraseña tiene que ser de 8 a 20 caracteres.</p>
          </div>

          <!-- Grupo: Confirmar contraseña -->
          <div class="formulario__grupo w-100 mb-3" id="grupo__password2" style="display: block;">
            <label for="password2" class="formulario__label">Repetir Nueva Contraseña</label>
            <div class="formulario__grupo-input">
              <input type="password" class="formulario__input w-100" name="password2" id="password2" placeholder="********" minlength="8" maxlength="20" required>
              <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">Ambas contraseñas deben ser iguales.</p>
          </div>

          <div class="formulario__grupo formulario__grupo-btn-enviar py-3 text-center">
            <button type="submit" class="btn btn-success w-100">Cambiar contraseña</button>
          </div>

        </form>
      </main>





    </div>
  </div>
</div>

<div class="card mt-5 shadow-sm" style="border-radius: 10px;">
  <div class="card-body d-flex justify-content-center">
    <a class="btn btn-success" href="editar_datos_admin.php">
      <i class="fa fa-arrow-left me-1"></i> Regresar
    </a>
  </div>
</div>
<!-- Start Script -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="files/js/bootstrap.bundle.min.js"></script>
<script src="files/js/templatemo.js"></script>
<script src="files/js/custom_menu.js"></script>
<script src="files/js/editar_claves_admin.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- End Script -->
</body>

</html>