<?php
// Activar depuración de errores
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Incluir conexión
include_once("bd/Conexion.php");

// Verificar conexión
if (!$dbh) {
    http_response_code(500);
    echo json_encode(["error" => "Error al conectar a la base de datos"]);
    exit();
}

// Consulta SQL
$sql = "SELECT id_mascotas, nombre_mascota, nombre_especie, nombre_sexo, nombre_edad,   
               nombre_desparasitacion, nombre_raza, 
               nombre_esterilizacion, nombre_vacuna, caracteristicas_de_comportamiento_mascota, 
               nombre_estado_adopcion 
        FROM tabla_mascotas tm 
        JOIN mascota_desparasitacion m2 ON tm.id_estado_desparasitacion_mascota = m2.id_estado_desparasitacion_mascota
        JOIN mascota_edad m3 ON tm.id_edad_mascota = m3.id_edad_mascota
        JOIN mascota_especie m4 ON tm.id_especie_mascota = m4.id_especie_mascota
        JOIN mascota_esterilizacion m5 ON tm.id_estado_esterilizacion_mascota = m5.id_estado_esterilizacion_mascota
        JOIN mascota_raza m9 ON tm.id_razas_mascota = m9.id_razas_mascota
        JOIN mascota_sexo m10 ON tm.id_sexo_mascota = m10.id_sexo_mascota
        JOIN mascota_vacuna m12 ON tm.id_estado_vacuna_mascota = m12.id_estado_vacuna_mascota
        JOIN mascota_estado_adopcion m13 ON tm.id_estado_adopcion_mascota = m13.id_estado_adopcion_mascota";

try {
    $stmt = $dbh->query($sql);
    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["error" => "Error al ejecutar la consulta"]);
        exit();
    }

    // Obtener todos los registros como un arreglo asociativo
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Indicar que la respuesta es JSON
    header('Content-Type: application/json; charset=utf-8');

    // Convertir a JSON y mostrar
    echo json_encode($resultados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
?>
