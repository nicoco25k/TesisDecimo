<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>
<?php include_once("bd/Conexion.php"); ?>

<div class="container-fluid py-5">

  <!-- Encabezado -->
  <div class="card shadow-sm mb-4" style="border-radius: 10px;">
    <div class="card-body d-flex justify-content-center">
      <h2 class="text-center text-muted"><b>REGISTRAR NUEVA NOTICIA</b></h2>
    </div>
  </div>

  <!-- Formulario -->
  <div class="container_1">

    <form method="POST" action="" enctype="multipart/form-data" class="formulario_mascota" id="formulario">

      <!-- Vista previa de imagen -->
      <div class="formulario_mascota__full text-center">
        <div id="preview-container" style="display:none; margin-bottom: 15px;">
          <img id="preview-img" src="" alt="Vista previa"
            style="max-height: 280px; max-width: 100%; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
        </div>
      </div>

      <!-- Input imagen -->
      <div class="formulario_mascota__full">
        <label class="formulario_mascota__label" for="image">
          <i class="fa fa-image me-1"></i> Foto de la noticia <span class="text-danger">*</span>
        </label>
        <input type="file" id="image" name="image" accept="image/*" required class="form-control"
          onchange="previsualizarImagen(); imagenes();">
        <small class="text-muted">Formatos permitidos: JPG, JPEG, PNG. Máx. 5MB.</small>
      </div>

      <!-- Botón enviar -->
      <div class="formulario_mascota__full formulario_mascota__btn mt-3">
        <button type="submit" class="btn btn-success px-5">
          <i class="fa fa-save me-1"></i> Registrar Noticia
        </button>
      </div>

    </form>
  </div>

  <!-- Regresar -->
  <div class="card mt-5 shadow-sm" style="border-radius: 10px;">
    <div class="card-body d-flex justify-content-center">
      <a class="btn btn-success" href="inicio_admin.php">
        <i class="fa fa-arrow-left me-1"></i> Regresar
      </a>
    </div>
  </div>

</div><!-- fin container-fluid -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="files/js/custom_menu.js"></script>
<script src="files/js/registrar_noticia.js"></script>

</body>

</html>