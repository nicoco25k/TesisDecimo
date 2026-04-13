<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>
<?php include_once("bd/Conexion.php"); ?>


<?php

// Consulta con prepared statement para evitar SQL Injection
$usuario = $_SESSION['usuario'];
$stmt = $dbh->prepare("SELECT correo_usuario FROM tabla_usuarios WHERE nickname_usuario = ?");
$stmt->execute([$usuario]);
$correo_usuario = $stmt->fetchColumn() ?: '';
?>


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


<div class="card mt-5 shadow-sm" style="border-radius: 10px;">
  <div class="card-body d-flex justify-content-center">
    <a class="btn btn-success" href="editar_datos_admin.php">
      <i class="fa fa-arrow-left me-1"></i> Regresar
    </a>
  </div>
</div>







<!-- Start Script -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="files/js/jquery-1.11.0.min.js"></script>
<script src="files/js/jquery-migrate-1.2.1.min.js"></script>
<script src="files/js/bootstrap.bundle.min.js"></script>
<script src="files/js/templatemo.js"></script>
<script src="files/js/custom_menu.js"></script>

<script src="files/js/editar_correo_admin.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- End Script -->
</body>

</html>