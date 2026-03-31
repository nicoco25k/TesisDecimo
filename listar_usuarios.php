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
    <!-- SWEETALERT -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #E5E5E5;
        }

        th,
        td {
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
                <td>NickName</td>
                <td>Tipo de documento</td>
                <td>N. documento</td>
                <td>Correo</td>
                <td>Teléfono</td>
                <td>Estado</td>
                <td></td>
            </thead>
            <tbody>
                <?php
                include_once("bd/Conexion.php");

                $sql = "SELECT id_usuarios, nombre_usuario, nickname_usuario, nombre_documento, numero_documento_usuario, correo_usuario, telefono_usuario, nombre_estado
                    FROM tabla_usuarios tu, tabla_roles tr, tabla_documetno td, tabla_estado_usuario te
                    WHERE tu.id_tipo_documento=td.id_tipo_documento and tu.id_rol=tr.id_rol and tu.id_estado_usuario=te.id_estado_usuario and tr.id_rol=1;";

                foreach ($dbh->query($sql) as $row) {
                    $idUsuario = $row['id_usuarios'];
                    $nombre_usuario = $row['nombre_usuario'];
                    $nickname_usuario = $row['nickname_usuario'];
                    $nombre_documento = $row['nombre_documento'];
                    $numero_documento_usuario = $row['numero_documento_usuario'];
                    $correo_usuario = $row['correo_usuario'];
                    $telefono_usuario = $row['telefono_usuario'];
                    $nombre_estado = $row['nombre_estado'];

                    echo "<tr>";
                    echo "<td>" . $nombre_usuario . "</td>";
                    echo "<td>" . $nickname_usuario . "</td>";
                    echo "<td>" . $nombre_documento . "</td>";
                    echo "<td>" . $numero_documento_usuario . "</td>";
                    echo "<td>" . $correo_usuario . "</td>";
                    echo "<td>" . $telefono_usuario . "</td>";
                    echo "<td>" . $nombre_estado . "</td>";

                    echo "<td class='text-center'>";
                    if ($nombre_estado == 'Activado') {
                        echo "<button class='btn btn-danger' onclick='confirmarDesactivarUsuario($idUsuario)'>Desactivar</button>";
                    } else {
                        echo "<button class='btn btn-success' onclick='confirmarActivarUsuario($idUsuario)'>Activar</button>";
                    }
                    echo "</td>";

                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
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
                    zeroRecords: "No se encontraron usuarios con tu busqueda",
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
                lengthMenu: [
                    [10, 25, -1],
                    [10, 25, "Todos los usuarios"]
                ],
            });
        });

        function confirmarDesactivarUsuario(idUsuario) {
            Swal.fire({
                title: 'Confirmar Desactivar Usuario',
                text: '¿Estás seguro de que deseas desactivar el usuario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, desactivar',
                cancelButtonText: 'Cancelar',
                backdrop: 'static'
            }).then((result) => {
                if (result.isConfirmed) {
                    actualizarEstadoUsuario(idUsuario, 'Desactivar');
                }
            });
        }

        function confirmarActivarUsuario(idUsuario) {
            Swal.fire({
                title: 'Confirmar Activar Usuario',
                text: '¿Estás seguro de que deseas activar el usuario?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, activar',
                cancelButtonText: 'Cancelar',
                backdrop: 'static'
            }).then((result) => {
                if (result.isConfirmed) {
                    actualizarEstadoUsuario(idUsuario, 'Activar');
                }
            });
        }

        function actualizarEstadoUsuario(idUsuario, accion) {
            // Realizar una solicitud AJAX al archivo PHP
            $.ajax({
                url: 'actualizar_estado_usuario.php',
                type: 'POST',
                data: {
                    idUsuario: idUsuario,
                    accion: accion
                },
                success: function(response) {
                    // El estado del usuario se ha actualizado correctamente
                    Swal.fire({
                        title: 'Éxito',
                        text: 'El estado del usuario ha sido actualizado.',
                        icon: 'success'
                    }).then(() => {
                        // Recargar la página para reflejar los cambios
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    // Ocurrió un error al actualizar el estado del usuario
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al actualizar el estado del usuario.',
                        icon: 'error'
                    });
                }
            });
        }
    </script>
</body>

</html>