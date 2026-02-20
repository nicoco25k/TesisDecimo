
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_talla WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_talla_mascota' => $row['id_talla_mascota'],
'nombre_talla' => $row['nombre_talla']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





