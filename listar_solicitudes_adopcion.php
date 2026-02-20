





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- DATATABLES -->
    <!--  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> -->
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body{
            background-color: #E5E5E5;
        }
        th,td {
            padding: 0.4rem !important;
        }
        body>div {
            
            box-shadow: 10px 10px 8px #888888;
            border: 2px solid black;
            border-radius: 10px;
        }
    </style>
    <title>Paginacion</title>
</head>
<body>
  
  
    <div class="container" style="margin-top: 10px;padding: 5px">



        <table id="tablax" class="table table-striped table-bordered">
        <thead>
    <tr>
        <th>Mascota</th>
        <th>Nombre Adoptante</th>
        <th>Telefono</th>
        <th>Porcentaje de viabilidad</th>
        <th>Fecha solicitud</th>
        <th>Ver preguntas</th>
        <th>Aceptar adopción</th>
        <th>Declinar adopción</th>
    </tr>
</thead>

          <tbody>
     
          
          <?php

include_once("bd/Conexion.php");
require_once('tcpdf/tcpdf.php');


// Consulta SQL para obtener todas las solicitudes de adopción
$sql = "SELECT * 
FROM `bot_solicitud_adopcion` WHERE id_estado_adopcion=1";

// Iterar sobre los resultados de la consulta
foreach ($dbh->query($sql) as $row) {
    // Asignar variables con los datos de cada fila
    $id_solicitud_adopcion = $row['id_solicitud_adopcion'];
    $nombre_mascota = $row['nombre_mascota'];
    $usuario_nombre = $row['usuario_nombre'];
    $usuario_correo = $row['usuario_correo'];
    $usuario_numero = $row['usuario_numero'];
    $porcentaje_viabilidad = $row['porcentaje_viabilidad'];
    $fecha_registro = $row['fecha_registro'];
    $usuario_direccion = $row['usuario_direccion'];

    // Asignar respuestas de las preguntas
    $preguntas = [
        "¿Qué tipo de vivienda tienes?" => $row['pregunta_1'],
        "¿Tienes un jardín o espacio al aire libre?" => $row['pregunta_2'],
        "¿Tienes vecinos que se opongan a tener mascotas?" => $row['pregunta_3'],
        "¿Hay niños en tu hogar?" => $row['pregunta_4'],
        "¿Alguien en tu familia tiene alergias a los animales?" => $row['pregunta_5'],
        "¿Hay otros animales en casa?" => $row['pregunta_6'],
        "¿Trabajas actualmente?" => $row['pregunta_7'],
        "¿Cuántas horas al día estarías en casa?" => $row['pregunta_8'],
        "¿Qué esperas de la convivencia con una mascota?" => $row['pregunta_9'],
        "¿Cuáles son los gastos que consideras al tener una mascota?" => $row['pregunta_10'],
        "¿Por qué quieres adoptar una mascota?" => $row['pregunta_11'],
        "¿Qué harías si la mascota muestra problemas de comportamiento?" => $row['pregunta_12']
    ];

    // Mostrar fila de la tabla
    echo "<tr>";
    echo "<td>" . htmlspecialchars($nombre_mascota) . "</td>";
    echo "<td>" . htmlspecialchars($usuario_nombre) . "</td>";
    echo "<td>" . htmlspecialchars($usuario_numero) . "</td>";
    echo "<td>" . htmlspecialchars($porcentaje_viabilidad) . "% Viable</td>";
    echo "<td>" . htmlspecialchars($fecha_registro) . "</td>";

    // Botón que abre el modal con más información
    echo "<td>";
    echo "<button class='btn btn-info' data-bs-toggle='modal' data-bs-target='#modal" . $id_solicitud_adopcion . "'>Ver Más</button>";
    echo "</td>";
 
    echo "<td>";
    echo "<button class='btn btn-success' onclick='confirmaradopcion($id_solicitud_adopcion)'>Confirmar</button>";
    echo "</td>";
    
    echo "<td>";
    echo "<button class='btn btn-danger' onclick='rechazarAdopcion($id_solicitud_adopcion)'>Rechazar</button>";
    echo "</td>";
    

    echo "</tr>";

    // Modal que muestra información detallada
    echo "<div class='modal fade' id='modal" . $id_solicitud_adopcion . "' tabindex='-1' aria-labelledby='modalLabel" . $id_solicitud_adopcion . "' aria-hidden='true'>";
    echo "<div class='modal-dialog'>";
    echo "<div class='modal-content'>";
    echo "<div class='modal-header'>";
    echo "<h5 class='modal-title' id='modalLabel" . $id_solicitud_adopcion . "'>Detalles de la solicitud</h5>";






    echo "<button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>";
    echo "</div>";
    echo "<div class='modal-body'>";

    // Mostrar información detallada
    echo "<p><strong>Nombre de la mascota:</strong> " . htmlspecialchars($nombre_mascota) . "</p>";
    echo "<p><strong>Nombre del usuario:</strong> " . htmlspecialchars($usuario_nombre) . "</p>";
    echo "<p><strong>Correo del usuario:</strong> " . htmlspecialchars($usuario_correo) . "</p>";
    echo "<p><strong>Teléfono del usuario:</strong> " . htmlspecialchars($usuario_numero) . "</p>";
    echo "<p><strong>Dirección del usuario:</strong> " . htmlspecialchars($usuario_direccion) . "</p>";
    echo "<p><strong>Porcentaje de viabilidad:</strong> " . htmlspecialchars($porcentaje_viabilidad) . "%</p>";
    echo "<p><strong>Fecha de registro:</strong> " . htmlspecialchars($fecha_registro) . "</p>";

    // Preguntas y respuestas
    echo "<p class='text-center py-2'><strong>Preguntas Evaluativas</strong></p>";
    foreach ($preguntas as $pregunta => $respuesta) {
        echo "<p><strong>" . htmlspecialchars($pregunta) . ":</strong> " . htmlspecialchars($respuesta) . "</p>";
    }

    echo "</div>";
    echo "<div class='modal-footer'>";
    echo "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
    echo "</div>";
}








?>


  
          </tbody>
      </table>








      </div>









    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous">
        </script>
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
    </script>

        <!-- DATATABLES -->
        <script src="files/js/solicitudes.js"></script>

    <!-- BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js">
    </script>
    <script>

$(document).ready(function () {
	$('#tablax').DataTable({
		language: {
			processing: "Tratamiento en curso...",
			search: "Buscar&nbsp;:",
			lengthMenu: "Grupos: _MENU_ ",
			info: "_START_ de _END_",
			infoEmpty: "Por favor refresca la página.",
			infoFiltered: "(filtrado de _MAX_ elementos en total)",
			infoPostFix: "",
			loadingRecords: "Cargando...",
			zeroRecords: "No se encontraron solicitudes con tu busqueda",
			emptyTable: "No hay datos disponibles en la tabla.",
			paginate: {
				first: "Primero",
				previous: "Anterior",
				next: "Siguiente",
				last: "Ultimo"
			},
			aria: {
				sortAscending: ": active para ordenar la columna en orden ascendente",
				sortDescending: ": active para ordenar la columna en orden descendente"
			}
		},
		scrollY: 400,
		lengthMenu: [ [10, 25, -1], [10, 25, "Todas las solicitudes"] ],
	});
});








        function confirmaradopcion(id_solicitud_adopcion) {
            Swal.fire({
                title: 'Confirmar Adopción',
                text: '¿Estás seguro de que deseas confirmar esta solicitud de adopción?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, Confirmar',
                cancelButtonText: 'Cancelar',
                backdrop: 'static'
            }).then((result) => {
                if (result.isConfirmed) {
                    actualizarEstadoUsuario(id_solicitud_adopcion, '3');
                }
            });
        }



        
function rechazarAdopcion(id_solicitud_adopcion) {
            Swal.fire({
                title: 'Rechazar Adopción',
                text: '¿Estás seguro de que deseas rechazar esta solicitud de adopción?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, confirmar',
                cancelButtonText: 'Cancelar',
                backdrop: 'static'
            }).then((result) => {
                if (result.isConfirmed) {
                    actualizarEstadoUsuario(id_solicitud_adopcion, '2');
                }
            });
        }

        function actualizarEstadoUsuario(id_solicitud_adopcion, accion) {
    $.ajax({
        url: 'update_adoption_status.php',
        type: 'POST',
        data: {
            idUsuario: id_solicitud_adopcion,
            accion: accion
        },
        success: function(response) {
            // Mostrar respuesta del servidor para depurar
            console.log(response);

            Swal.fire({
                title: 'Éxito',
                text: 'Se ha completado con exito la acción',
                icon: 'success'
            }).then(() => {
                location.reload();
            });
        },
        error: function(xhr, status, error) {
            console.error('Error:', xhr.responseText);
            Swal.fire({
                title: 'Error',
                text: 'Error al actualizar el estado de la adopción.',
                icon: 'error'
            });
        }
    });
}



    </script>
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>


    
















</body>
</html>




