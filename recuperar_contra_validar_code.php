<?php
include_once("bd/Conexion.php");


$codigo = $_POST['code'];


if (preg_match('/^\d{6}$/', $codigo)) {
    //codigo valido de 6 cifras



    
$sql = "SELECT id_usuarios, codigo FROM tabla_recuperar_clave WHERE codigo = '$codigo' and id_estado_codigo='1'";

    




$resultado = $dbh->query($sql);

if ($resultado->rowCount() > 0) {
    // Si se encontró una coincidencia, obtener los datos
    $fila = $resultado->fetch(PDO::FETCH_ASSOC);
    $idUsuario = $fila['id_usuarios'];
    $codigoEncontrado = $fila['codigo'];
    
    //echo "ID de usuario: " . $idUsuario . "<br>";
    //echo "Código encontrado: " . $codigoEncontrado;


    $sql1 ="UPDATE tabla_recuperar_clave SET id_estado_codigo='2' WHERE id_usuarios ='$idUsuario'";
    if (!$dbh->query($sql1)) {
        //echo "Ha ocurrdio un error";
    }
    else{
        //echo"codigo actualizado";
        echo $idUsuario;
    }



} else {
    //echo "El código no existe en la base de datos";
    echo "147";
}






















} else {
    //el codigo no es de 6 cifras
    echo "666";
}


?>
