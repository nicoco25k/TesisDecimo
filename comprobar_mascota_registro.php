<?php
include_once("bd/Conexion.php");

$rutaCompleta         = $_POST['rutaCompleta'];
$nombre               = $_POST["nombre"];
$caracteristicas      = $_POST["caracteristicas"];
$especie_opcion       = $_POST["especie_opcion"];
$raza_opcion          = $_POST["raza_opcion"];
$sexo_opcion          = $_POST["sexo_opcion"];
$edad_opcion          = $_POST["edad_opcion"];
$desparasitacion_opcion  = $_POST["desparasitacion_opcion"];
$esterilizacion_opcion   = $_POST["esterilizacion_opcion"];
$vacuna_opcion        = $_POST["vacuna_opcion"];

$sql = "
  INSERT INTO `tabla_mascotas` (
    `id_mascotas`, `nombre_mascota`, `ruta_img_mascota`,
    `id_especie_mascota`, `id_edad_mascota`, `id_sexo_mascota`,
    `id_razas_mascota`, `id_estado_esterilizacion_mascota`,
    `id_estado_vacuna_mascota`, `id_estado_desparasitacion_mascota`,
    `id_estado_adopcion_mascota`, `caracteristicas_de_comportamiento_mascota`,
    `fecha_creacion_mascota`
  )
  VALUES (
    NULL, '$nombre', '$rutaCompleta',
    '$especie_opcion', '$edad_opcion', '$sexo_opcion',
    '$raza_opcion', '$esterilizacion_opcion',
    '$vacuna_opcion', '$desparasitacion_opcion',
    '1', '$caracteristicas',
    CONVERT_TZ(NOW(), '+00:00', '-05:00')
  )
";

if (!$dbh->query($sql)) {
    echo "923";
} else {
    echo "2309";
}
