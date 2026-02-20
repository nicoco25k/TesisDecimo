




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
            <td>Nombre</td>
            <td>Teléfono</td>
            <td>Correo</td>
            <td>Mensaje</td>
            <td>Fecha Recibido</td>
            
          </thead>
          <tbody>
     
          
<?php

include_once("bd/Conexion.php");


$sql = "SELECT nombre_usuario_mensaje, telefono_usuario_mensaje, correo_usuario_mensaje, mensaje , fecha_registro FROM tabla_de_mensajes";

foreach ($dbh ->query($sql) as $row) {
 

  
      $nombre_usuario_mensaje = $row['nombre_usuario_mensaje'];
      $telefono_usuario_mensaje = $row['telefono_usuario_mensaje'];
      $correo_usuario_mensaje = $row['correo_usuario_mensaje'];
      $mensaje = $row['mensaje'];
      $fecha_registro = $row['fecha_registro'];  



  echo"<tr>";
echo "<td>".$nombre_usuario_mensaje."</td>";
echo "<td>".$telefono_usuario_mensaje."</td>";
echo "<td>".$correo_usuario_mensaje."</td>";
echo "<td>".$mensaje."</td>";
echo "<td>".$fecha_registro."</td>";


  echo"</tr>";


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
			zeroRecords: "No se encontraron mensajes con tu busqueda",
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
		lengthMenu: [ [10, 25, -1], [10, 25, "Todos los mensajes"] ],
	});
});
    </script>

    
</body>
</html>