<?php

require_once(__DIR__ . '/../php/Conexion_BD.php');
function consultarRecordatorios() {
    $conexion = new conexionLogin();
    $db = $conexion->conectar();

    $fechaActual = date('Y-m-d');
    $fechaLimite = date('Y-m-d', strtotime('+5 days'));

    $statement = $db->prepare("SELECT r.*, m.Nombre AS NombreMascota 
                              FROM recordatorios r
                              INNER JOIN mascota m ON r.idMascota = m.idMascota
                              WHERE r.fechaVencimiento BETWEEN :fechaActual AND :fechaLimite");
    $statement->bindParam(':fechaActual', $fechaActual);
    $statement->bindParam(':fechaLimite', $fechaLimite);
    $statement->execute();
    $recordatorios = $statement->fetchAll(PDO::FETCH_ASSOC);

    return $recordatorios;
}


// Llamar a la función para ver los resultados
consultarRecordatorios();


?>
