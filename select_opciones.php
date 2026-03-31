<?php
include_once("bd/Conexion.php");

$tipo = $_GET['tipo'] ?? '';

switch ($tipo) {

    case 'especie':
        $sql = "SELECT id_especie_mascota, nombre_especie FROM mascota_especie";
        $campos = ['id_especie_mascota', 'nombre_especie'];
        break;

    case 'raza':
        $sql = "SELECT id_razas_mascota, nombre_raza FROM mascota_raza";
        $campos = ['id_razas_mascota', 'nombre_raza'];
        break;

    case 'sexo':
        $sql = "SELECT id_sexo_mascota, nombre_sexo FROM mascota_sexo";
        $campos = ['id_sexo_mascota', 'nombre_sexo'];
        break;

    case 'edad':
        $sql = "SELECT id_edad_mascota, nombre_edad FROM mascota_edad";
        $campos = ['id_edad_mascota', 'nombre_edad'];
        break;

    case 'desparasitacion':
        $sql = "SELECT id_estado_desparasitacion_mascota, nombre_desparasitacion FROM mascota_desparasitacion";
        $campos = ['id_estado_desparasitacion_mascota', 'nombre_desparasitacion'];
        break;

    case 'esterilizacion':
        $sql = "SELECT id_estado_esterilizacion_mascota, nombre_esterilizacion FROM mascota_esterilizacion";
        $campos = ['id_estado_esterilizacion_mascota', 'nombre_esterilizacion'];
        break;

    case 'vacuna':
        $sql = "SELECT id_estado_vacuna_mascota, nombre_vacuna FROM mascota_vacuna";
        $campos = ['id_estado_vacuna_mascota', 'nombre_vacuna'];
        break;

    default:
        echo json_encode([]);
        exit();
}

$json = [];
foreach ($dbh->query($sql) as $row) {
    $json[] = array_intersect_key($row, array_flip($campos));
}

echo json_encode($json);
