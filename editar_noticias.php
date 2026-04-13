<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>
<?php include_once("bd/Conexion.php"); ?>

<div class="container-fluid py-5">

  <div class="card shadow-sm" style="border-radius: 10px;">
    <div class="card-body d-flex gap-2 justify-content-center">
      <h2 class="text-center text-muted"><b>INFORMACIÓN SOBRE NOTICIAS REGISTRADAS</b></h2>
    </div>
  </div>

  <div class="container mt-4 tabla-admin-container">
    <table id="tablax" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>ID</th>
          <th>Fecha Subida</th>
          <th>Estado</th>
          <th>Ver Imagen</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "
          SELECT 
              n.id_noticias,
              n.img_noticia,
              n.fecha_subida,
              e.nombre_estado
          FROM tabla_noticias n
          JOIN tabla_estado_noticia e
              ON n.id_estado_noticia = e.id_estado_noticia
          ORDER BY n.id_noticias DESC
        ";

        foreach ($dbh->query($sql) as $row) {
          $id_noticias    = $row['id_noticias'];
          $img_noticia    = $row['img_noticia'];
          $fecha_subida   = $row['fecha_subida'];
          $nombre_estado  = $row['nombre_estado'];

          echo "<tr>";
          echo "<td>" . htmlspecialchars($id_noticias) . "</td>";
          echo "<td>" . htmlspecialchars($fecha_subida) . "</td>";
          echo "<td>" . htmlspecialchars($nombre_estado) . "</td>";

          // Botón Ver Imagen
          echo "<td class='text-center'>";
          echo "<button class='btn btn-info btn-sm' 
                  onclick='verImagenNoticia(\"" . htmlspecialchars($img_noticia) . "\")'>
                  <i class='fa fa-image'></i> Ver Imagen
                </button>";
          echo "</td>";

          // Botón Cambiar Estado
          echo "<td class='text-center'>";
          if ($nombre_estado == 'Noticia Activada') {
            echo "<button class='btn btn-danger btn-sm' onclick='confirmarDesactivarNoticia($id_noticias, this)'>
                    <i class='fa fa-toggle-off'></i> Desactivar
                  </button>";
          } else {
            echo "<button class='btn btn-success btn-sm' onclick='confirmarActivarNoticia($id_noticias, this)'>
                    <i class='fa fa-toggle-on'></i> Activar
                  </button>";
          }
          echo "</td>";

          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <div class="card mt-5 shadow-sm" style="border-radius: 10px;">
    <div class="card-body d-flex gap-2 justify-content-center">
      <a class="btn btn-success" href="inicio_admin.php">
        <i class="fa fa-arrow-left me-1"></i> Regresar
      </a>
    </div>
  </div>

</div><!-- fin container-fluid -->


<!-- ===================== MODAL VER IMAGEN ===================== -->
<div id="modalImagenNoticia">

  <div class="modal-fondo" onclick="cerrarModalNoticia()"></div>

  <div class="modal-contenido">

    <div class="modal-encabezado">
      <h5><i class="fa fa-newspaper me-2"></i> Imagen de la Noticia</h5>
      <span onclick="cerrarModalNoticia()">&times;</span>
    </div>

    <div class="modal-foto-container text-center p-3">
      <img id="modal-img-noticia" src="" alt="Imagen noticia" style="max-width:100%; border-radius:8px;">
    </div>

    <div class="modal-pie text-center">
      <button onclick="cerrarModalNoticia()" class="btn btn-secondary">
        <i class="fa fa-times me-1"></i> Cerrar
      </button>
    </div>

  </div>
</div>
<!-- =========================================================== -->


<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="files/js/custom_menu.js"></script>
<script src="files/js/noticias_admin.js"></script>

</body>

</html>