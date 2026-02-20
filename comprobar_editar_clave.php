<?php
session_start();

include_once("bd/Conexion.php");
$usuario = $_SESSION['usuraio'];
$password = $_POST["password"];
$password2 = $_POST["password2"];

$expresionPassword = '/^[a-zA-Z0-9]{8,20}$/';



if (!preg_match($expresionPassword, $password)) {
    echo "995"; // no cumple requisitos
}

elseif ($password != $password2){
    echo "998"; //contras diferentes
}else{



$c3=0;
//consultar si este dato existe
$sql = "SELECT clave_usuario FROM tabla_usuarios WHERE nickname_usuario='$usuario'";


foreach ($dbh ->query($sql) as $row) 
{

    $clave_usuario = $row['clave_usuario'];

    if($clave_usuario==$password){                 $c3 = 1;       }

}


if($c3==1){        echo "3"; /*pass_repetida*/      }




$c_max=0;
if($c3==0)
{
    $c_max=1;
}


if($c_max==1){



$sql = "

UPDATE tabla_usuarios SET clave_usuario='$password' WHERE nickname_usuario='$usuario'

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
