<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>
<?php include_once("bd/Conexion.php"); ?>

<div class="container-fluid py-5">

  <!-- Título -->
  <div class="card shadow-sm" style="border-radius: 10px;">
    <div class="card-body d-flex gap-2 justify-content-center">
      <h2 class="text-center text-muted"><b>INFORMACIÓN SOBRE MENSAJES DE USUARIOS</b></h2>
    </div>
  </div>

  <!-- Tabla -->
  <div class="container mt-4 tabla-admin-container">
    <table id="tablax" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Teléfono</th>
          <th>Correo</th>
          <th>Mensaje</th>
          <th>Fecha Recibido</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "SELECT nombre_usuario_mensaje, telefono_usuario_mensaje, correo_usuario_mensaje, mensaje, fecha_registro
                FROM tabla_de_mensajes
                ORDER BY fecha_registro DESC";

        foreach ($dbh->query($sql) as $row) {
          $nombre   = $row['nombre_usuario_mensaje'];
          $telefono = $row['telefono_usuario_mensaje'];
          $correo   = $row['correo_usuario_mensaje'];
          $mensaje  = $row['mensaje'];
          $fecha    = $row['fecha_registro'];

          echo "<tr>";
          echo "<td>" . htmlspecialchars($nombre)   . "</td>";
          echo "<td>" . htmlspecialchars($telefono) . "</td>";
          echo "<td>" . htmlspecialchars($correo)   . "</td>";
          echo "<td>" . htmlspecialchars($mensaje)  . "</td>";
          echo "<td>" . htmlspecialchars($fecha)    . "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <!-- Botones -->
  <div class="card mt-5 shadow-sm" style="border-radius: 10px;">
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

<!-- Scripts -->
<!-- 1. jQuery PRIMERO -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

<!-- 2. Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

<!-- 3. DataTables -->
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

<!-- 4. SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- 5. Archivos propios -->
<script src="files/js/custom_menu.js"></script>

<script>
  $(document).ready(function() {
    $('#tablax').DataTable({
      language: {
        processing: "Tratamiento en curso...",
        search: "Buscar:",
        lengthMenu: "Mostrar _MENU_ registros",
        info: "Mostrando _START_ a _END_ de _TOTAL_ mensajes",
        infoEmpty: "No hay mensajes disponibles.",
        infoFiltered: "(filtrado de _MAX_ mensajes en total)",
        loadingRecords: "Cargando...",
        zeroRecords: "No se encontraron mensajes con tu búsqueda.",
        emptyTable: "No hay datos disponibles en la tabla.",
        paginate: {
          first: "Primero",
          previous: "Anterior",
          next: "Siguiente",
          last: "Último"
        }
      },
      order: [
        [4, 'desc']
      ], // Ordenar por fecha descendente
      lengthMenu: [
        [10, 25, -1],
        [10, 25, "Todos los mensajes"]
      ],
      columnDefs: [{
          targets: 3,
          className: 'text-wrap',
          width: '35%'
        } // Columna Mensaje más ancha
      ]
    });
  });

  function generarReporte() {
    window.open('generar_reporte_mensajes.php', '_blank');
  }
</script>

</section>
</body>

</html>