<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>
<?php include_once("bd/Conexion.php"); ?>

<div class="container-fluid py-5">
  <h2 class="text-center text-muted mb-4"><b>INFORMACIÓN SOBRE CUENTAS REGISTRADAS</b></h2>

  <div class="container mt-4 tabla-admin-container">
    <table id="tablax" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>NickName</th>
          <th>Tipo de documento</th>
          <th>N. documento</th>
          <th>Correo</th>
          <th>Teléfono</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT id_usuarios, nombre_usuario, nickname_usuario, nombre_documento, 
                       numero_documento_usuario, correo_usuario, telefono_usuario, nombre_estado
                FROM tabla_usuarios tu
                JOIN tabla_roles tr ON tu.id_rol = tr.id_rol
                JOIN tabla_documetno td ON tu.id_tipo_documento = td.id_tipo_documento
                JOIN tabla_estado_usuario te ON tu.id_estado_usuario = te.id_estado_usuario
                WHERE tr.id_rol = 1";

        foreach ($dbh->query($sql) as $row) {
          $idUsuario                = $row['id_usuarios'];
          $nombre_usuario           = $row['nombre_usuario'];
          $nickname_usuario         = $row['nickname_usuario'];
          $nombre_documento         = $row['nombre_documento'];
          $numero_documento_usuario = $row['numero_documento_usuario'];
          $correo_usuario           = $row['correo_usuario'];
          $telefono_usuario         = $row['telefono_usuario'];
          $nombre_estado            = $row['nombre_estado'];

          echo "<tr>";
          echo "<td>" . htmlspecialchars($nombre_usuario) . "</td>";
          echo "<td>" . htmlspecialchars($nickname_usuario) . "</td>";
          echo "<td>" . htmlspecialchars($nombre_documento) . "</td>";
          echo "<td>" . htmlspecialchars($numero_documento_usuario) . "</td>";
          echo "<td>" . htmlspecialchars($correo_usuario) . "</td>";
          echo "<td>" . htmlspecialchars($telefono_usuario) . "</td>";
          echo "<td>" . htmlspecialchars($nombre_estado) . "</td>";
          echo "<td class='text-center'>";
          if ($nombre_estado == 'Activado') {
            echo "<button class='btn btn-danger' onclick='confirmarDesactivarUsuario($idUsuario, this)'>Desactivar</button>";
          } else {
            echo "<button class='btn btn-success' onclick='confirmarActivarUsuario($idUsuario, this)'>Activar</button>";
          }
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="card mt-4 shadow-sm" style="border-radius: 10px;">
    <div class="card-body d-flex gap-2 justify-content-center">
      <a class="btn btn-success" href="inicio_admin.php">
        <i class="fa fa-arrow-left me-1"></i> Regresar
      </a>
      <button class="btn btn-primary" onclick="generarReporte()">
        <i class="fa fa-file-alt me-1"></i> Generar Reporte
      </button>
    </div>
  </div>
</div>

</section>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="files/js/custom_menu.js"></script>
<script src="files/js/usuarios_admin.js"></script>

</body>

</html>