<?php
session_start();

include_once("bd/Conexion.php");
$usuario = $_SESSION['usuraio'];
$telefono = $_POST["telefono"];

$expresionTelefono = '/^\d{8,12}$/';



// Validar teléfono
if (!preg_match($expresionTelefono, $telefono)) {
    echo "996";
}else{


$c3=0;
//consultar si este dato existe
$sql = "SELECT telefono_usuario FROM tabla_usuarios WHERE 1";


foreach ($dbh ->query($sql) as $row) 
{

    $telefono_usuario = $row['telefono_usuario'];

    if($telefono_usuario==$telefono){                 $c3 = 1;       }

}


if($c3==1){        echo "3"; /*telefono_ocupado*/      }




$c_max=0;
if($c3==0)
{
    $c_max=1;
}


if($c_max==1){



$sql = "

UPDATE tabla_usuarios SET telefono_usuario='$telefono' WHERE nickname_usuario='$usuario'

";



if (!$dbh->query($sql)) {
    echo "0923";
}
else{
    echo "2309";
}

}

}



?>
