
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_edad WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_edad_mascota' => $row['id_edad_mascota'],
'nombre_edad' => $row['nombre_edad']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





