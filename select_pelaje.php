
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_pelaje WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_pelaje_mascota' => $row['id_pelaje_mascota'],
'nombre_pelaje' => $row['nombre_pelaje']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





