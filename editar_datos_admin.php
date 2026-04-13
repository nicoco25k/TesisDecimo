<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>
<?php require_once __DIR__ . "/Estructure/obtener_datos_admin.php"; ?>
<?php include_once("bd/Conexion.php"); ?>


<div class="container-fluid py-5">

  <!-- Encabezado -->
  <div class="card shadow-sm mb-4" style="border-radius: 10px;">
    <div class="card-body d-flex justify-content-center">
      <h2 class="text-center text-muted"><b>EDITAR DATOS DE TU CUENTA</b></h2>
    </div>
  </div>

  <div class="container_1">

    <h5 class="text-center mb-4"><b>TUS DATOS</b></h5>

    <!-- Datos no editables -->
    <div class="table-container mb-4">
      <table class="user-table">
        <tr>
          <td><b>Nombre:</b></td>
          <td><?php echo htmlspecialchars($nombre_usuario); ?></td>
        </tr>
        <tr>
          <td><b>Apellido:</b></td>
          <td><?php echo htmlspecialchars($apellido_usuario); ?></td>
        </tr>
        <tr>
          <td><b>Tipo de documento:</b></td>
          <td><?php echo htmlspecialchars($nombre_documento); ?></td>
        </tr>
        <tr>
          <td><b>Número de documento:</b></td>
          <td><?php echo htmlspecialchars($numero_documento_usuario); ?></td>
        </tr>
      </table>
    </div>

    <!-- Datos editables -->
    <div class="table-container">
      <table class="user-table">
        <tr>
          <td><b>Correo:</b></td>
          <td><?php echo htmlspecialchars($correo_usuario); ?></td>
          <td class="text-center">
            <a href="editar_datos_admin_correo.php" class="btn btn-primary btn-sm">
              <i class="fa fa-pencil me-1"></i> Editar
            </a>
          </td>
        </tr>
        <tr>
          <td><b>Teléfono:</b></td>
          <td><?php echo htmlspecialchars($telefono_usuario); ?></td>
          <td class="text-center">
            <a href="editar_datos_admin_telefono.php" class="btn btn-primary btn-sm">
              <i class="fa fa-pencil me-1"></i> Editar
            </a>
          </td>
        </tr>
        <tr>
          <td><b>Contraseña:</b></td>
          <td>********</td>
          <td class="text-center">
            <a href="editar_datos_admin_clave.php" class="btn btn-primary btn-sm">
              <i class="fa fa-pencil me-1"></i> Editar
            </a>
          </td>
        </tr>
      </table>
    </div>

  </div>

  <!-- Regresar -->
  <div class="card mt-5 shadow-sm" style="border-radius: 10px;">
    <div class="card-body d-flex justify-content-center">
      <a class="btn btn-success" href="inicio_admin.php">
        <i class="fa fa-arrow-left me-1"></i> Regresar
      </a>
    </div>
  </div>

</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="files/js/custom_menu.js"></script>

</body>

</html>