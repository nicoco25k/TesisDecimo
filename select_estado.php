
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_estado_adopcion WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_estado_adopcion_mascota' => $row['id_estado_adopcion_mascota'],
'nombre_estado_adopcion' => $row['nombre_estado_adopcion']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





