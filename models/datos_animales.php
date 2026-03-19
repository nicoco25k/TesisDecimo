<?php
require_once __DIR__ . "/../bd/Conexion.php";

function obtenerAnimalesDisponibles($limite = null)
{
    global $dbh;

    $sql = "
        SELECT 
            id_mascotas,
            nombre_mascota, 
            nombre_especie, 
            nombre_sexo, 
            nombre_edad,  
            nombre_desparasitacion,   
            nombre_raza, 
            nombre_esterilizacion, 
            nombre_vacuna, 
            ruta_img_mascota, 
            caracteristicas_de_comportamiento_mascota 
        FROM tabla_mascotas tm
        JOIN mascota_desparasitacion m2 
            ON tm.id_estado_desparasitacion_mascota = m2.id_estado_desparasitacion_mascota
        JOIN mascota_edad m3 
            ON tm.id_edad_mascota = m3.id_edad_mascota
        JOIN mascota_especie m4 
            ON tm.id_especie_mascota = m4.id_especie_mascota
        JOIN mascota_esterilizacion m5 
            ON tm.id_estado_esterilizacion_mascota = m5.id_estado_esterilizacion_mascota
        JOIN mascota_raza m9 
            ON tm.id_razas_mascota = m9.id_razas_mascota
        JOIN mascota_sexo m10 
            ON tm.id_sexo_mascota = m10.id_sexo_mascota
        JOIN mascota_vacuna m12 
            ON tm.id_estado_vacuna_mascota = m12.id_estado_vacuna_mascota
        WHERE id_estado_adopcion_mascota = 1
    ";

    if ($limite !== null) {
        $sql .= " LIMIT :limite";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(":limite", $limite, PDO::PARAM_INT);
        $stmt->execute();
    } else {
        $stmt = $dbh->query($sql);
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}







function obtenerAnimalPorId($id)
{
    global $dbh;

    $sql = "SELECT 
                id_mascotas,
                nombre_mascota,
                nombre_especie,
                nombre_sexo,
                nombre_edad,
                nombre_desparasitacion,
                nombre_raza,
                nombre_esterilizacion,
                nombre_vacuna,
                ruta_img_mascota,
                caracteristicas_de_comportamiento_mascota
            FROM tabla_mascotas tm
            JOIN mascota_desparasitacion m2 
                ON tm.id_estado_desparasitacion_mascota = m2.id_estado_desparasitacion_mascota
            JOIN mascota_edad m3 
                ON tm.id_edad_mascota = m3.id_edad_mascota
            JOIN mascota_especie m4 
                ON tm.id_especie_mascota = m4.id_especie_mascota
            JOIN mascota_esterilizacion m5 
                ON tm.id_estado_esterilizacion_mascota = m5.id_estado_esterilizacion_mascota
            JOIN mascota_raza m9 
                ON tm.id_razas_mascota = m9.id_razas_mascota
            JOIN mascota_sexo m10 
                ON tm.id_sexo_mascota = m10.id_sexo_mascota
            JOIN mascota_vacuna m12 
                ON tm.id_estado_vacuna_mascota = m12.id_estado_vacuna_mascota
            WHERE id_mascotas = :id";

    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
