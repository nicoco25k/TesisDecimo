
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_especie WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_especie_mascota' => $row['id_especie_mascota'],
'nombre_especie' => $row['nombre_especie']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





