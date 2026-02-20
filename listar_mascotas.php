<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- DATATABLES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
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
                    <th>Nombre</th>
                    <th>Especie</th>
                    <th>Sexo</th>
                    <th>Raza</th>
                    <th>Caracteristicas</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once("bd/Conexion.php");
                $sql = "SELECT id_mascotas,nombre_mascota,nombre_estado_adopcion,nombre_especie,nombre_raza,
                        nombre_sexo, caracteristicas_de_comportamiento_mascota
                        FROM tabla_mascotas tm, mascota_especie m4,  
                        mascota_raza m9, mascota_sexo m10, 
                        mascota_estado_adopcion m13 
                        WHERE tm.id_especie_mascota = m4.id_especie_mascota  
                        AND tm.id_razas_mascota = m9.id_razas_mascota 
                        AND tm.id_sexo_mascota = m10.id_sexo_mascota 
                        AND tm.id_estado_adopcion_mascota = m13.id_estado_adopcion_mascota";

                foreach ($dbh->query($sql) as $row) {
                    $id_mascotas = $row['id_mascotas'];
                    $nombre_mascota = $row['nombre_mascota'];
                    $nombre_estado_adopcion = $row['nombre_estado_adopcion'];
                    $nombre_especie = $row['nombre_especie'];
                    $nombre_raza = $row['nombre_raza'];
                    $caracteristicas_de_comportamiento_mascota = $row['caracteristicas_de_comportamiento_mascota'];
                    $nombre_sexo = $row['nombre_sexo']; 

                    echo "<tr>";
                    echo "<td>".$nombre_mascota."</td>";
                    echo "<td>".$nombre_especie."</td>";
                    echo "<td>".$nombre_sexo."</td>";
                    echo "<td>".$nombre_raza."</td>";
                    echo "<td>".$caracteristicas_de_comportamiento_mascota."</td>";
                    echo "<td>".$nombre_estado_adopcion."</td>";
                    echo "<td class='text-center'>";
                    if ($nombre_estado_adopcion == 'Activo') {
                        echo "<button class='btn btn-danger' onclick='confirmarDesactivarMascota($id_mascotas)'>Desactivar</button>";
                    } else {
                        echo "<button class='btn btn-success' onclick='confirmarActivarMascota($id_mascotas)'>Activar</button>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <!-- DATATABLES -->
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <!-- BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                    zeroRecords: "No se encontraron mascotas con tu búsqueda",
                    emptyTable: "No hay datos disponibles en la tabla.",
                    paginate: {
                        first: "Primero",
                        previous: "Anterior",
                        next: "Siguiente",
                        last: "Último"
                    },
                    aria: {
                        sortAscending: ": active para ordenar la columna en orden ascendente",
                        sortDescending: ": active para ordenar la columna en orden descendente"
                    }
                },
                scrollY: 400,
                lengthMenu: [[10, 25, -1], [10, 25, "Todas las mascotas"]],
            });
        });

        function confirmarDesactivarMascota(id_mascotas) {
            Swal.fire({
                title: 'Desactivar Mascota',
                text: 'Al desactivar esta mascota, no sera visible en el apartado de mascotas en adopción y apadrinamiento',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Desactivar',
                cancelButtonText: 'Cancelar',
                backdrop: 'static'
            }).then((result) => {
                if (result.isConfirmed) {
                    actualizarEstadoMascota(id_mascotas, 'desactivar');
                }
            });
        }

        function confirmarActivarMascota(id_mascotas) {
            Swal.fire({
                title: 'Activar Mascota',
                text: 'Al activar esta mascota, sera visible en el apartado de mascotas en adopción y apadrinamiento',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sí, ponerla en adopción',
                cancelButtonText: 'Cancelar',
                backdrop: 'static'
            }).then((result) => {
                if (result.isConfirmed) {
                    actualizarEstadoMascota(id_mascotas, 'activar');
                }
            });
        }


        function actualizarEstadoMascota(id_mascotas, accion) {
            // Realizar una solicitud AJAX al archivo PHP
            $.ajax({
                url: 'actualizar_estado_adopcion.php',
                type: 'POST',
                data: {
                    id_mascotas: id_mascotas,
                    accion: accion
                },
                success: function(response) {
                    Swal.fire({
                        title: 'Éxito',
                        text: 'El estado de la mascota fue actualizado con éxito',
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Error',
                        text: 'Error al actualizar el estado de la mascota',
                        icon: 'error'
                    });
                }
            });
        }


    </script>
</body>
</html>
