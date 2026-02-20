<?php



$ruta='files/img_noticias/';





      if (($_FILES["file"]["type"] == "image/jpg")
      || ($_FILES["file"]["type"] == "image/jpeg") 
      || ($_FILES["file"]["type"] == "image/png") 
      || ($_FILES["file"]["type"] == "image/gif") 
      ) {

         move_uploaded_file($_FILES['file']['tmp_name'], $ruta.$_FILES['file']['name']);

         $nombreArchivo = $_FILES['file']['name'];
         $rutaCompleta = $ruta . $nombreArchivo;
      
         echo json_encode($rutaCompleta);
      }
      else {
       
echo "775";


 }

 





?>
