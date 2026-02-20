
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_extremidades WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_extremidades_mascota' => $row['id_extremidades_mascota'],
'nombre_extremidades' => $row['nombre_extremidades']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





