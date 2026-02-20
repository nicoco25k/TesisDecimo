<?php

include_once("bd/Conexion.php");

$nombre = $_POST["nombre"];
$apellidos = $_POST["apellido"];
$correo = $_POST["correo"];
$telefono = $_POST["telefono"];
$tipo_documento = $_POST["documento_opcion"];
$documento = $_POST["documento"];
$usuario = $_POST["usuario"];

$password = $_POST["password"];
$password2 = $_POST["password2"];


$expresionNombre = '/^[a-zA-ZñÑ\s]{4,40}$/';
$expresionApellido = '/^[a-zA-ZñÑ\s]{4,40}$/';
$expresionDocumento = '/^\d{6,12}$/';
$expresionUsuario = '/^[a-zA-Z0-9]{8,20}$/';
$expresionPassword = '/^[a-zA-Z0-9]{8,20}$/';
$expresionCorreo = '/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/';
$expresionTelefono = '/^\d{8,12}$/';

$palabrasProhibidas = ["marica", "gonorrea", "puto","Lichigo","Gorrero","Zunga","Huevon","Lampara","Gordo","Sapo","Perro","Arrastrado","Atolondrado","Baboso","Bobo","Cacorro","Corroncho","Culipronta", "Flojo", "Fufa", "Fufurufa", "Garbimba", "Garnupia", "Gonorriento", "Guache", "Guaricha", "Guisa", "Gurrupleta", "Hijueputa", "Hueva", "Huevona", "Idiota", "Imbecil", "Insornia", "Jeton", "Lambon", "Lengua", "Lerdo", "Loca", "Loba", "Malparido", "Mamerto", "Maricon", "Mediocre", "Menso", "Morronga", "Mosca", "Muérgano", "Ñero", "Patirrajado", "Peliteñido", "Pendejo", "Percanta", "Perra","Petardo", "Prepago", "Pichurria", "Pirobo", "Puta", "Sapo", "Sapo Hijueputa", "Tontarron", "Vago", "Zorra", "Zunga", "Zuripanta" ];



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

if (contienePalabrasGroseras($nombre, $palabrasProhibidas)  || contienePalabrasGroseras($apellidos, $palabrasProhibidas) || contienePalabrasGroseras($usuario, $palabrasProhibidas) || contienePalabrasGroseras($password, $palabrasProhibidas)) {
    $errorMessages[] = "2525";
}

if (strlen($correo) >= 10 && strlen($correo) <= 60) {
   
}else{

    $errorMessages[] = "225";
}


// Validar nombre
if (!preg_match($expresionNombre, $nombre)) {
    $errorMessages[] = "991";
}


// Validar apellido
if (!preg_match($expresionApellido, $apellidos)) {
    $errorMessages[] = "992";
}

// Validar documento
if (!preg_match($expresionDocumento, $documento)) {
    $errorMessages[] = "993";
}

// Validar usuario
if (!preg_match($expresionUsuario, $usuario)) {
    $errorMessages[] = "994";
}

// Validar contraseña1
if (!preg_match($expresionPassword, $password)) {
    $errorMessages[] = "995";
}


// Validar contraseña1
if ($password != $password2){
    $errorMessages[] = "998";
}

// Validar correo
if (!preg_match($expresionCorreo, $correo)) {
    $errorMessages[] = "996";
}

// Validar teléfono
if (!preg_match($expresionTelefono, $telefono)) {
    $errorMessages[] = "997";
}

if (!empty($errorMessages)) {
    // Mostrar el primer mensaje de error
    echo $errorMessages[0];
}else{




//consultar si este dato existe
$sql = "SELECT nickname_usuario,numero_documento_usuario,correo_usuario,telefono_usuario FROM tabla_usuarios WHERE 1";

$c1 = 0;
$c2 = 0;
$c3 = 0;
$c4 = 0;

foreach ($dbh ->query($sql) as $row) 
{

    $nick_c = $row['nickname_usuario'];
    $numero_documento_c = $row['numero_documento_usuario'];
    $correo_c = $row['correo_usuario'];
    $telefono_c = $row['telefono_usuario'];
    

    if($nick_c==$usuario){                  $c1 = 1;       }
    if($numero_documento_c==$documento){    $c2 = 1;       }
    if($correo_c==$correo){                 $c3 = 1;       }
    if($telefono_c==$telefono){             $c4 = 1;       }

}



if($c1==1 and $c2==1 and $c3==1 and $c4==1){    echo "1234"; /*nickname_ocupado*//*documento_ocupado*//*correo_ocupado*//*telefono_ocupado*/ $i=1;       }
elseif($c2==1 and $c3==1 and $c4==1){       echo "234"; /*documento_ocupado*//*correo_ocupado*//*telefono_ocupado*/        }
elseif($c1==1 and $c2==1 and $c3==1){       echo "123"; /*nickname_ocupado*//*documento_ocupado*//*correo_ocupado*/      }
elseif($c2==1 and $c1==1 and $c4==1){       echo "214"; /*documento_ocupado*//*nickname_ocupado*//*telefono_ocupado*/        }
elseif($c3==1 and $c1==1 and $c4==1){       echo "314"; /*correo_ocupado*//*nickname_ocupado*//*telefono_ocupado*/      }
elseif($c4==1 and $c1==1){        echo "41"; /*telefono_ocupado*//*nickname_ocupado*/        }
elseif($c2==1 and $c3==1){        echo "23"; /*documento_ocupado*//*correo_ocupado*/       }
elseif($c1==1 and $c2==1){        echo "12"; /*nickname_ocupado*//*documento_ocupado*/      }
elseif($c3==1 and $c1==1 ){       echo "31"; /*correo_ocupado*//*nickname_ocupado*/      }
elseif($c4==1 and $c3==1){        echo "43"; /*telefono_ocupado*//*correo_ocupado*/        }
elseif($c4==1 and $c2==1){        echo "42"; /*telefono_ocupado*//*documento_ocupado*/        }
elseif($c4==1){        echo "4"; /*telefono_ocupado*/        }
elseif($c3==1){        echo "3"; /*correo_ocupado*/      }
elseif($c2==1){        echo "2"; /*documento_ocupado*/       }
elseif($c1==1){        echo "1"; /*nickname_ocupado*/       }









$c_max=0;
if(($c1==0 and $c2==0 and $c3==0 and $c4==0))
{
    $c_max=1;
}




if($c_max==1){



$sql = "

INSERT INTO `tabla_usuarios` (`id_usuarios`, `nombre_usuario`, `apellido_usuario`, `telefono_usuario`, `id_tipo_documento`,
`numero_documento_usuario`, `nickname_usuario`, `clave_usuario`, `correo_usuario`, `id_rol`,`id_estado_usuario`, `fecha_creacion`)

VALUES (NULL, '$nombre', '$apellidos', '$telefono', '$tipo_documento','$documento', '$usuario', '$password', '$correo', '1','1',CONVERT_TZ(NOW(), '+00:00', '-05:00'));

";



if (!$dbh->query($sql)) {
    echo "0923";
}
else{
    echo "2309";
}

}






$c1 = 0;
$c2 = 0;
$c3 = 0;
$c4 = 0;

}

?>
