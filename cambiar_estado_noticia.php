<?php
include_once("bd/Conexion.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_noticias       = intval($_POST['id_noticias']);
    $id_estado_noticia = intval($_POST['id_estado_noticia']);

    if ($id_noticias > 0 && in_array($id_estado_noticia, [1, 2])) {
        try {
            $stmt = $dbh->prepare("UPDATE tabla_noticias SET id_estado_noticia = :estado WHERE id_noticias = :id");
            $stmt->bindParam(':estado', $id_estado_noticia, PDO::PARAM_INT);
            $stmt->bindParam(':id',     $id_noticias,       PDO::PARAM_INT);
            $stmt->execute();
            echo "ok";
        } catch (PDOException $e) {
            echo "ERROR: " . $e->getMessage();
        }
    } else {
        echo "validacion_fallida: id=$id_noticias estado=$id_estado_noticia";
    }
} else {
    echo "metodo_incorrecto";
}
