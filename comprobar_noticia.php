<?php
include_once("bd/Conexion.php");


$rutaCompleta = $_POST['rutaCompleta'];





// Realiza las operaciones necesarias con las variables recibidas

$sql = "INSERT INTO tabla_noticias(id_noticias, img_noticia, fecha_subida) 
VALUES (NULL, '$rutaCompleta',now())"; 


if (!$dbh->query($sql)) {
    echo "0923";
} else {
    echo "2309";
}
?>
