
<?php

include_once("bd/Conexion.php");


$sql = "SELECT id_tipo_documento,nombre_documento FROM tabla_documetno WHERE 1";





$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_tipo_documento' => $row['id_tipo_documento'],
'nombre_documento' => $row['nombre_documento']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





