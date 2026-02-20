
<?php

include_once("bd/Conexion.php");


$sql = "SELECT * FROM mascota_sexo WHERE 1";



$json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
    
      
'id_sexo_mascota' => $row['id_sexo_mascota'],
'nombre_sexo' => $row['nombre_sexo']




    );
  }

  $jsonstring = json_encode($json);
  

  echo $jsonstring;

?>





