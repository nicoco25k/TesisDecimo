<?php
session_start();

include_once("bd/Conexion.php");
$usuario = $_SESSION['usuario'];
$correo = $_POST["correo"];


$expresionCorreo = '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';


if (strlen($correo) >= 10 && strlen($correo) <= 60) {

    // Validar correo
    if (!preg_match($expresionCorreo, $correo)) {
        echo "996";
    } else {


        $c3 = 0;
        //consultar si este dato existe
        $sql = "SELECT correo_usuario FROM tabla_usuarios WHERE 1";


        foreach ($dbh->query($sql) as $row) {

            $correo_c = $row['correo_usuario'];

            if ($correo_c == $correo) {
                $c3 = 1;
            }
        }


        if ($c3 == 1) {
            echo "3"; /*correo_ocupado*/
        }




        $c_max = 0;
        if ($c3 == 0) {
            $c_max = 1;
        }


        if ($c_max == 1) {



            $sql = "

UPDATE tabla_usuarios SET correo_usuario='$correo' WHERE nickname_usuario='$usuario'

";



            if (!$dbh->query($sql)) {
                echo "0923";
            } else {
                echo "2309";
            }
        }
    }
} else {



    echo "225";
}
