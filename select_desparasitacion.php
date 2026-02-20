
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_desparasitacion WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_estado_desparasitacion_mascota' => $row['id_estado_desparasitacion_mascota'],
'nombre_desparasitacion' => $row['nombre_desparasitacion']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





