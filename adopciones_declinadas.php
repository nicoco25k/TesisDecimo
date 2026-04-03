<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>
<?php include_once("bd/Conexion.php"); ?>

<div class="container-fluid py-5">


  <div class="card shadow-sm" style="border-radius: 10px;">
    <div class="card-body d-flex gap-2 justify-content-center">
      <h2 class="text-center text-muted"><b>INFORMACIÓN SOBRE SOLICITUDES DE ADOPCIONES RECHAZADAS</b></h2>

    </div>
  </div>

  <div class="container mt-4} tabla-admin-container">
    <table id="tablax" class="table table-striped table-bordered">
      <thead>
        <tr>
          <th>Mascota</th>
          <th>Nombre Adoptante</th>
          <th>Teléfono</th>
          <th>Viabilidad</th>
          <th>Solucitud Enviada</th>
          <th>Fecha Respuesta</th>
          <th>Ver Información</th>


      </thead>
      <tbody>
        <?php
        $sql = "SELECT * FROM bot_solicitud_adopcion WHERE id_estado_adopcion = 2";

        foreach ($dbh->query($sql) as $row) {
          $id_solicitud_adopcion  = $row['id_solicitud_adopcion'];
          $nombre_mascota         = $row['nombre_mascota'];
          $usuario_nombre         = $row['usuario_nombre'];
          $usuario_correo         = $row['usuario_correo'];
          $usuario_numero         = $row['usuario_numero'];
          $porcentaje_viabilidad  = $row['porcentaje_viabilidad'];
          $fecha_registro         = $row['fecha_registro'];
          $usuario_direccion      = $row['usuario_direccion'];
          $fecha_resolucion      = $row['fecha_resolucion'];


          $preguntas = [
            "¿Qué tipo de vivienda tienes?"                                => $row['pregunta_1'],
            "¿Tienes un jardín o espacio al aire libre?"                   => $row['pregunta_2'],
            "¿Tienes vecinos que se opongan a tener mascotas?"             => $row['pregunta_3'],
            "¿Hay niños en tu hogar?"                                      => $row['pregunta_4'],
            "¿Alguien en tu familia tiene alergias a los animales?"        => $row['pregunta_5'],
            "¿Hay otros animales en casa?"                                 => $row['pregunta_6'],
            "¿Trabajas actualmente?"                                       => $row['pregunta_7'],
            "¿Cuántas horas al día estarías en casa?"                      => $row['pregunta_8'],
            "¿Qué esperas de la convivencia con una mascota?"              => $row['pregunta_9'],
            "¿Cuáles son los gastos que consideras al tener una mascota?"  => $row['pregunta_10'],
            "¿Por qué quieres adoptar una mascota?"                        => $row['pregunta_11'],
            "¿Qué harías si la mascota muestra problemas de comportamiento?" => $row['pregunta_12'],
          ];

          echo "<tr>";
          echo "<td>" . htmlspecialchars($nombre_mascota) . "</td>";
          echo "<td>" . htmlspecialchars($usuario_nombre) . "</td>";
          echo "<td>" . htmlspecialchars($usuario_numero) . "</td>";
          echo "<td>" . htmlspecialchars($porcentaje_viabilidad) . "% Viable</td>";
          echo "<td>" . htmlspecialchars($fecha_registro) . "</td>";
          echo "<td>" . htmlspecialchars($fecha_resolucion) . "</td>";

          // Botón Ver preguntas
          echo "<td class='text-center'>";
          echo "<button class='btn btn-info btn-sm' onclick='verSolicitud($id_solicitud_adopcion)'>
                  <i class='fa fa-eye'></i> Ver
                </button>";
          echo "</td>";


          echo "</tr>";

          // Guardamos los datos del modal en un array para pasarlo al JS
          $preguntas_json = htmlspecialchars(json_encode($preguntas), ENT_QUOTES, 'UTF-8');
          echo "<div style='display:none' id='data-solicitud-$id_solicitud_adopcion'
        data-nombre-mascota='" . htmlspecialchars($nombre_mascota, ENT_QUOTES) . "'
        data-usuario-nombre='" . htmlspecialchars($usuario_nombre, ENT_QUOTES) . "'
        data-usuario-correo='" . htmlspecialchars($usuario_correo, ENT_QUOTES) . "'
        data-usuario-numero='" . htmlspecialchars($usuario_numero, ENT_QUOTES) . "'
        data-usuario-direccion='" . htmlspecialchars($usuario_direccion, ENT_QUOTES) . "'
        data-viabilidad='" . htmlspecialchars($porcentaje_viabilidad, ENT_QUOTES) . "'
        data-fecha='" . htmlspecialchars($fecha_registro, ENT_QUOTES) . "'
        data-preguntas='$preguntas_json'>
      </div>";
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
      <button class="btn btn-primary" onclick="generarReporte_declinadas()">
        <i class="fa fa-file-alt me-1"></i> Generar Reporte
      </button>
    </div>
  </div>
</div>




<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="files/js/custom_menu.js"></script>
<script src="files/js/solicitudes_admin.js"></script>

</section>

<!-- Modal Ver Solicitud -->
<div id="modalSolicitud">
  <div class="modal-fondo" onclick="cerrarModalSolicitud()"></div>
  <div class="modal-contenido">



    <!-- Info adoptante con gradiente -->
    <div style="background: linear-gradient(to right, #064bab, #17a2b8); padding: 20px; color: white;">
      <div style="display:flex; align-items:center; gap:15px;">
        <div style="background:rgba(255,255,255,0.2); border-radius:50%; width:60px; height:60px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
          <i class="fa fa-user" style="font-size:28px;"></i>
        </div>
        <div>
          <h4 id="modal-sol-nombre" style="margin:0; font-weight:bold;"></h4>
          <small id="modal-sol-correo" style="opacity:0.85;"></small>
        </div>
        <div style="margin-left:auto; text-align:center; flex-shrink:0;">
          <div style="background:rgba(255,255,255,0.2); border-radius:10px; padding:8px 15px;">
            <div style="font-size:22px; font-weight:bold;" id="modal-sol-viabilidad"></div>
            <small>% Viable</small>
          </div>
        </div>
      </div>
    </div>

    <!-- Info de contacto -->
    <div style="padding: 15px 20px; background:#f8f9fa; border-bottom: 1px solid #dee2e6;">
      <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px;">
        <div>
          <small style="color:#6c757d;">Mascota Solicitada</small>
          <div style="font-weight:bold;" id="modal-sol-mascota"></div>
        </div>
        <div>
          <small style="color:#6c757d;">Teléfono</small>
          <div style="font-weight:bold;" id="modal-sol-telefono"></div>
        </div>
        <div>
          <small style="color:#6c757d;">Dirección</small>
          <div style="font-weight:bold;" id="modal-sol-direccion"></div>
        </div>
        <div>
          <small style="color:#6c757d;">Fecha solicitud</small>
          <div style="font-weight:bold;" id="modal-sol-fecha"></div>
        </div>
      </div>
    </div>

    <!-- Preguntas evaluativas con scroll -->
    <div style="padding: 15px 20px; max-height: 300px; overflow-y: auto;">
      <p style="font-weight:bold; color:#064bab; border-bottom:2px solid #064bab; padding-bottom:5px;">
        <i class="fa fa-question-circle me-1"></i> Preguntas Evaluativas
      </p>
      <div id="modal-sol-preguntas"></div>
    </div>

    <!-- Pie igual al de mascotas -->
    <div class="modal-pie text-center py-2">
      <button onclick="cerrarModalSolicitud()" class="btn btn-secondary">
        <i class="fa fa-times me-1"></i> Cerrar
      </button>
    </div>

  </div>
</div>
</body>

</html>