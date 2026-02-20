
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_vacuna WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_estado_vacuna_mascota' => $row['id_estado_vacuna_mascota'],
'nombre_vacuna' => $row['nombre_vacuna']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





