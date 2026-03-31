<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>
<?php include_once("bd/Conexion.php"); ?>

<div class="container-fluid py-5">


  <div class="card shadow-sm" style="border-radius: 10px;">
    <div class="card-body d-flex gap-2 justify-content-center">
      <h2 class="text-center text-muted"><b>INFORMACIÓN SOBRE MASCOTAS REGISTRADAS</b></h2>

    </div>
  </div>



  <div class="container mt-4 tabla-admin-container">
    <table id="tablax" class="table table-striped table-bordered">

      <thead>
        <tr>
          <th>Nombre</th>
          <th>Especie</th>
          <th>Sexo</th>
          <th>Raza</th>
          <th>Caracteristicas</th>
          <th>Estado</th>
          <th>Ver</th>
          <th>Acciones</th>

        </tr>
      </thead>
      <tbody>
        <?php
        $sql = "
          SELECT 
              id_mascotas,
              nombre_mascota, 
              nombre_especie, 
              nombre_sexo, 
              nombre_edad,  
              nombre_desparasitacion,   
              nombre_raza, 
              nombre_esterilizacion, 
              nombre_vacuna, 
              ruta_img_mascota, 
              caracteristicas_de_comportamiento_mascota,
              nombre_estado_adopcion
          FROM tabla_mascotas tm
          JOIN mascota_desparasitacion m2 
              ON tm.id_estado_desparasitacion_mascota = m2.id_estado_desparasitacion_mascota
          JOIN mascota_edad m3 
              ON tm.id_edad_mascota = m3.id_edad_mascota
          JOIN mascota_especie m4 
              ON tm.id_especie_mascota = m4.id_especie_mascota
          JOIN mascota_esterilizacion m5 
              ON tm.id_estado_esterilizacion_mascota = m5.id_estado_esterilizacion_mascota
          JOIN mascota_raza m9 
              ON tm.id_razas_mascota = m9.id_razas_mascota
          JOIN mascota_sexo m10 
              ON tm.id_sexo_mascota = m10.id_sexo_mascota
          JOIN mascota_vacuna m12 
              ON tm.id_estado_vacuna_mascota = m12.id_estado_vacuna_mascota
          JOIN mascota_estado_adopcion m13
              ON tm.id_estado_adopcion_mascota = m13.id_estado_adopcion_mascota
          ORDER BY id_mascotas DESC
        ";

        foreach ($dbh->query($sql) as $row) {
          $id_mascotas                              = $row['id_mascotas'];
          $nombre_mascota                           = $row['nombre_mascota'];
          $nombre_estado_adopcion                   = $row['nombre_estado_adopcion'];
          $nombre_especie                           = $row['nombre_especie'];
          $nombre_raza                              = $row['nombre_raza'];
          $nombre_sexo                              = $row['nombre_sexo'];
          $nombre_edad                              = $row['nombre_edad'];
          $nombre_esterilizacion                    = $row['nombre_esterilizacion'];
          $nombre_desparasitacion                   = $row['nombre_desparasitacion'];
          $ruta_img_mascota                         = $row['ruta_img_mascota'];
          $caracteristicas_de_comportamiento_mascota = $row['caracteristicas_de_comportamiento_mascota'];

          echo "<tr>";
          echo "<td>" . htmlspecialchars($nombre_mascota) . "</td>";
          echo "<td>" . htmlspecialchars($nombre_especie) . "</td>";
          echo "<td>" . htmlspecialchars($nombre_sexo) . "</td>";
          echo "<td>" . htmlspecialchars($nombre_raza) . "</td>";
          echo "<td>" . htmlspecialchars($caracteristicas_de_comportamiento_mascota) . "</td>";
          echo "<td>" . htmlspecialchars($nombre_estado_adopcion) . "</td>";
          echo "<td class='text-center'>";

          // Botón Ver Detalles
          echo "<button class='btn btn-info btn-sm mr-1' 
                  onclick='verDetalles(
                    \"" . htmlspecialchars($nombre_mascota) . "\",
                    \"" . htmlspecialchars($nombre_especie) . "\",
                    \"" . htmlspecialchars($nombre_sexo) . "\",
                    \"" . htmlspecialchars($nombre_edad) . "\",
                    \"" . htmlspecialchars($nombre_raza) . "\",
                    \"" . htmlspecialchars($nombre_esterilizacion) . "\",
                    \"" . htmlspecialchars($nombre_desparasitacion) . "\",
                    \"" . htmlspecialchars($nombre_estado_adopcion) . "\",
                    \"" . htmlspecialchars($ruta_img_mascota) . "\"
                  )'>
                  <i class='fa fa-eye'></i> Ver
                </button>";
          echo "</td>";
          echo "<td class='text-center'>";


          // Botón Activar/Desactivar
          if ($nombre_estado_adopcion == 'Adoptado') {
            echo "<button class='btn btn-danger' onclick='confirmarDesactivarMascota($id_mascotas, this)'>Cambiar Estado
</button>";
          } else {
            echo "<button class='btn btn-success' onclick='confirmarActivarMascota($id_mascotas, this)'>Cambiar Estado</button>";
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
      <button class="btn btn-primary" onclick="generarReporte()">
        <i class="fa fa-file-alt me-1"></i> Generar Reporte
      </button>
    </div>
  </div>




  <!-- Scripts -->
  <!-- 1. jQuery PRIMERO -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

  <!-- 2. Bootstrap (depende de jQuery) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

  <!-- 3. DataTables (depende de jQuery) -->
  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>

  <!-- 4. SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




  <!-- 5. Tus archivos AL FINAL -->
  <!-- <script src="files/js/templatemo.js"></script> -->
  <script src="files/js/custom_menu.js"></script>
  <script src="files/js/mascotas_admin.js"></script>

  </section>


  <!-- Modal Ver Detalles -->
  <div id="modalDetallesMascota">

    <div class="modal-fondo" onclick="cerrarModal()"></div>

    <div class="modal-contenido">

      <div class="modal-encabezado">
        <h5>Detalles de la Mascota <i class="fa fa-paw me-2"></i></h5>
        <span onclick="cerrarModal()">&times;</span>
      </div>

      <div class="modal-foto-container">
        <img id="modal-foto" src="" alt="Foto mascota">
      </div>

      <div class="modal-nombre">
        <h4 id="modal-nombre"></h4>
      </div>

      <div class="modal-datos">
        <table class="table table-sm table-bordered mt-3">
          <tbody>
            <tr>
              <th style="width:45%">Especie</th>
              <td id="modal-especie"></td>
            </tr>
            <tr>
              <th>Sexo</th>
              <td id="modal-sexo"></td>
            </tr>
            <tr>
              <th>Edad</th>
              <td id="modal-edad"></td>
            </tr>
            <tr>
              <th>Raza</th>
              <td id="modal-raza"></td>
            </tr>
            <tr>
              <th>Esterilizado</th>
              <td id="modal-esterilizacion"></td>
            </tr>
            <tr>
              <th>Desparasitado</th>
              <td id="modal-desparasitacion"></td>
            </tr>

            <tr>
              <th>Estado de adopción</th>
              <td id="modal-estado_adopcion"></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="modal-pie text-center">
        <button onclick="cerrarModal()" class="btn btn-secondary">
          <i class="fa fa-times me-1"></i> Cerrar
        </button>
      </div>

    </div>
  </div>

  </body>

  </html>