
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_esterilizacion WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_estado_esterilizacion_mascota' => $row['id_estado_esterilizacion_mascota'],
'nombre_esterilizacion' => $row['nombre_esterilizacion']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





