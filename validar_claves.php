<?php
include_once("bd/Conexion.php");


$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$id_usuario = $_POST['id_usuario'];

$expresionPassword = '/^[a-zA-Z0-9]{8,20}$/';


$errorMessages = []; // Array para almacenar los mensajes de error

if (!preg_match($expresionPassword, $password1)) {
    $errorMessages[] = "885";
}if (!preg_match($expresionPassword, $password2)) {
    $errorMessages[] = "886";
}if ($password1 != $password2){
    $errorMessages[] = "887";
}

$sql = "SELECT clave_usuario FROM `tabla_usuarios` WHERE id_usuarios='$id_usuario'";
$cc = 0;
foreach ($dbh ->query($sql) as $row) 
{
    $clave_c = $row['clave_usuario'];
    if($clave_c==$password1){                  $cc = 1;       }
}

if ($password1 == $clave_c){
    $errorMessages[] = "888";
}





if (!empty($errorMessages)) {
    // Mostrar el primer mensaje de error
    echo $errorMessages[0];
}else{

    $sql1 ="UPDATE `tabla_usuarios` SET clave_usuario='$password1' WHERE id_usuarios='$id_usuario'";
    if (!$dbh->query($sql1)) {
        echo "0923";
    }
    else{
        //contraseña actualizada";
        echo "2309";
    }
    



}



//echo $password1.$password2.$id_usuario;





?>
