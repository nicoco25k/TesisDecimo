
<?php

include_once("bd/Conexion.php");



$search = $_POST['search'];






if(!empty($search)) {
  $sql = "SELECT nombre_usuario, apellido_usuario, nombre_documento, numero_documento_usuario, correo_usuario, telefono_usuario, nombre_estado 
  FROM tabla_usuarios tu, tabla_roles tr, tabla_documetno td, tabla_estado_usuario te
  WHERE tu.id_tipo_documento=td.id_tipo_documento and tu.id_rol=tr.id_rol and tu.id_estado_usuario=te.id_estado_usuario and tr.id_rol=1 and nombre_usuario LIKE '$search%' ";
 

  $json = array();
foreach ($dbh ->query($sql) as $row) {
    $json[] = array(
      'nombre_usuario' => $row['nombre_usuario'],
      'apellido_usuario' => $row['apellido_usuario'],
      'nombre_documento' => $row['nombre_documento'],
      'numero_documento_usuario' => $row['numero_documento_usuario'],
      'correo_usuario' => $row['correo_usuario'],
      'telefono_usuario' => $row['telefono_usuario'],
      'nombre_estado' => $row['nombre_estado']


    );
  }





  $jsonstring = json_encode($json);

  echo $jsonstring;




}







?>




