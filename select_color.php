
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_color WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_color_mascota' => $row['id_color_mascota'],
'nombre_color' => $row['nombre_color']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





