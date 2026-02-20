<?php

include_once("bd/Conexion.php");

$nombre = $_POST["nombre"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$texto = $_POST['mensaje'];




$expresionNombre = '/^[a-zA-Z\s]{4,40}$/';
$expresionCorreo = '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
$expresionTelefono = '/^\d{8,12}$/';



$palabrasProhibidas = ["marica", "gonorrea", "puto","Lichigo","Gorrero","Zunga","Huevon","Lampara","Gordo","Sapo","Arrastrado","Atolondrado","Baboso","Bobo","Cacorro","Corroncho","Culipronta", "Flojo", "Fufa", "Fufurufa", "Garbimba", "Garnupia", "Gonorriento", "Guache", "Guaricha", "Guisa", "Gurrupleta", "Hijueputa", "Hueva", "Huevona", "Idiota", "Imbecil", "Insornia", "Jeton", "Lambon", "Lengua", "Lerdo", "Loca", "Loba", "Malparido", "Mamerto", "Maricon", "Mediocre", "Menso", "Morronga", "Mosca", "Muérgano", "Ñero", "Patirrajado", "Peliteñido", "Pendejo", "Percanta","Petardo", "Prepago", "Pichurria", "Pirobo", "Puta", "Sapo", "Sapo Hijueputa", "Tontarron", "Vago", "Zorra", "Zunga", "Zuripanta" ];




// Validar la longitud del texto
$longitud = strlen($texto);

if ($longitud >= 8 && $longitud <= 200) {

    

    function contienePalabrasGroseras($texto, $palabrasProhibidas) {
        foreach ($palabrasProhibidas as $palabra) {
            if (stripos($texto, $palabra) !== false) {
                return true; // El texto contiene una palabra grosera
            }
        }
        return false; // El texto no contiene palabras groseras
    }
    
    
    $errorMessages = []; // Array para almacenar los mensajes de error
    
    //palabras groseras
    
    if (contienePalabrasGroseras($nombre, $palabrasProhibidas)  || contienePalabrasGroseras($texto, $palabrasProhibidas) ) {
        $errorMessages[] = "2525";
    }
    
    
    // Validar nombre
    if (!preg_match($expresionNombre, $nombre)) {
        $errorMessages[] = "991";
    }
    
    
    // Validar teléfono
    if (!preg_match($expresionTelefono, $telefono)) {
        $errorMessages[] = "992";
    }
    
    
    // Validar correo
    if (!preg_match($expresionCorreo, $correo)) {
        $errorMessages[] = "993";
    }
    
    
    if (!empty($errorMessages)) {
        // Mostrar el primer mensaje de error
        echo $errorMessages[0];
    }else{
    
    
    
    
    
    $sql = "
    
    INSERT INTO `tabla_de_mensajes`(`id_mensajes`, `nombre_usuario_mensaje`, `telefono_usuario_mensaje`, `correo_usuario_mensaje`, `mensaje`, `fecha_registro`) 
    VALUES (NULL, '$nombre','$telefono','$correo','$texto',CONVERT_TZ(NOW(), '+00:00', '-05:00'));
    
    ";
    
    
    
    if (!$dbh->query($sql)) {
        echo "1234";
    }
    else{
        echo "2309";



        
    }
    
    
    }
    







} else {

    echo "994";
}



?>
