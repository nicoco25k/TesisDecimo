<?php
session_start();

$usuario = $_SESSION['usuario'];

include_once("bd/Conexion.php");
$sql = "SELECT nombre_usuario,apellido_usuario,telefono_usuario,nombre_documento,numero_documento_usuario,correo_usuario 
FROM tabla_usuarios,tabla_documetno WHERE tabla_usuarios.id_tipo_documento = tabla_documetno.id_tipo_documento and nickname_usuario='$usuario'";

foreach ($dbh->query($sql) as $row) {

    $nombre_usuario = $row['nombre_usuario'];
    $apellido_usuario = $row['apellido_usuario'];
    $telefono_usuario = $row['telefono_usuario'];
    $nombre_documento = $row['nombre_documento'];
    $numero_documento_usuario = $row['numero_documento_usuario'];
    $correo_usuario = $row['correo_usuario'];
}


//echo $nombre_usuario.$apellido_usuario.$telefono_usuario.$id_tipo_documento.$numero_documento_usuario.$correo_usuario;



if (!isset($usuario)) {
    header('location: iniciar_sesion.php');
}



?>


<?php require_once __DIR__ . "/Estructure/Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/NavBar.php"; ?>









<div class="container my-5">
    <div class="card shadow-sm redondear pb-5">






        <h2 class="text-center py-5"><b>Editar datos de tu cuenta</b></h2>





        <main>



            <h3 class="text-center py-3"><b>TUS DATOS</b></h3>

            <!-- Grupo: Nombre -->

            <div class="table-container">
                <table class="user-table">

                    <tr>
                        <td><b>Nombre:</b></td>
                        <td><?php echo $nombre_usuario; ?></td>
                    </tr>
                    <tr>
                        <td><b>Apellido:</b></td>
                        <td><?php echo $apellido_usuario; ?></td>
                    </tr>
                    <tr>
                        <td><b>Tipo de documento:</b></td>
                        <td><?php echo $nombre_documento; ?></td>
                    </tr>
                    <tr>
                        <td><b>Número de documento:</b></td>
                        <td><?php echo $numero_documento_usuario; ?></td>
                    </tr>
                </table>
                <p class="py-3"></p>
                <table class="user-table">
                    <tr>
                        <td><b>Correo:</b></td>
                        <td><?php echo $correo_usuario; ?></td>
                        <td class="text-center"><button class="btn btn-primary" onclick="window.location.href = 'editar_correo.php';">Editar</button></td>
                    </tr>
                    <tr>
                        <td><b>Teléfono:</b></td>
                        <td><?php echo $telefono_usuario; ?></td>
                        <td class="text-center"><button class="btn btn-primary" onclick="window.location.href = 'editar_telefono.php';">Editar</button></td>
                    </tr>
                    <tr>
                        <td><b>Contraseña:</b></td>
                        <td>********</td>
                        <td class="text-center"><button class="btn btn-primary" onclick="window.location.href = 'editar_clave.php';">Editar</button></td>
                    </tr>



                </table>
            </div>




        </main>



    </div>


</div>


<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>