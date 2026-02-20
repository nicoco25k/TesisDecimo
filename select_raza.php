
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_raza WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_razas_mascota' => $row['id_razas_mascota'],
'nombre_raza' => $row['nombre_raza']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





