
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_peso WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_peso_aproximado_mascota' => $row['id_peso_aproximado_mascota'],
'nombre_peso' => $row['nombre_peso']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





