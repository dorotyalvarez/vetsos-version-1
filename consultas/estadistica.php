<?php

require_once(__DIR__ . '/../php/Conexion_BD.php');

function obtenerClientesActivos() {
    $conexion = new conexionLogin();
    $db = $conexion->conectar();

    $statement = $db->prepare("SELECT COUNT(*) AS total FROM `cliente` WHERE active = 1");
    $statement->execute();
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    return $resultado['total'];
}

function obtenerCitasAtendidas() {
   
    $conexion = new conexionLogin();
    $db = $conexion->conectar();

    // Obtener la fecha de inicio de la última semana (lunes)
    $inicioSemana = date('Y-m-d', strtotime('last monday'));

    // Obtener la fecha de fin de la última semana (domingo)
    $finSemana = date('Y-m-d', strtotime('next sunday'));

    // Realizar la consulta para obtener el número de citas atendidas dentro de la última semana
    $statement = $db->prepare("SELECT COUNT(*) AS total FROM `reservas` WHERE idestado = 3 AND fecha_cita BETWEEN :inicioSemana AND :finSemana");
    $statement->bindParam(':inicioSemana', $inicioSemana);
    $statement->bindParam(':finSemana', $finSemana);
    $statement->execute();
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    return $resultado['total'];
    
}

function obtenerCitasPendientes() {
    $conexion = new conexionLogin();
    $db = $conexion->conectar();

    // Obtener la fecha de inicio de la última semana (lunes)
    $inicioSemana = date('Y-m-d', strtotime('last monday'));

    // Obtener la fecha de fin de la última semana (domingo)
    $finSemana = date('Y-m-d', strtotime('next sunday'));

    // Realizar la consulta para obtener el número de citas pendientes dentro de la última semana
    $statement = $db->prepare("SELECT COUNT(*) AS total FROM `reservas` WHERE idestado = 1 AND fecha_cita BETWEEN :inicioSemana AND :finSemana");
    $statement->bindParam(':inicioSemana', $inicioSemana);
    $statement->bindParam(':finSemana', $finSemana);
    $statement->execute();
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    return $resultado['total'];
}

function obtenerMensajesPendientes() {
    $conexion = new conexionLogin();
    $db = $conexion->conectar();

    // Obtener la fecha de inicio de la última semana (lunes)
    $inicioSemana = date('Y-m-d', strtotime('last monday'));

    // Obtener la fecha de fin de la última semana (domingo)
    $finSemana = date('Y-m-d', strtotime('next sunday'));

    // Realizar la consulta para obtener el número de mensajes pendientes dentro de la última semana
    $statement = $db->prepare("SELECT COUNT(*) AS total FROM `mensajes` WHERE estado = '1' AND fecha_creacion BETWEEN :inicioSemana AND :finSemana");
    $statement->bindParam(':inicioSemana', $inicioSemana);
    $statement->bindParam(':finSemana', $finSemana);
    $statement->execute();
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    return $resultado['total'];
}


function obtenerMensajesTotales() {
    $conexion = new conexionLogin();
    $db = $conexion->conectar();

    // Obtener la fecha de inicio de la última semana (lunes)
    $inicioSemana = date('Y-m-d', strtotime('last monday'));

    // Obtener la fecha de fin de la última semana (domingo)
    $finSemana = date('Y-m-d', strtotime('next sunday'));

    // Realizar la consulta para obtener el número de mensajes pendientes dentro de la última semana
    $statement = $db->prepare("SELECT COUNT(*) AS total FROM `mensajes` WHERE estado = '2' AND fecha_creacion BETWEEN :inicioSemana AND :finSemana");
    $statement->bindParam(':inicioSemana', $inicioSemana);
    $statement->bindParam(':finSemana', $finSemana);
    $statement->execute();
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    return $resultado['total'];
}


function obtenerRecordatoriosPendientes() {
    $conexion = new conexionLogin();
    $db = $conexion->conectar();

    // Obtener la fecha de inicio de la última semana (lunes)
    $inicioSemana = date('Y-m-d', strtotime('last monday'));

    // Obtener la fecha de fin de la última semana (domingo)
    $finSemana = date('Y-m-d', strtotime('next sunday'));

    // Realizar la consulta para obtener el número de recordatorios pendientes dentro de la última semana
    $statement = $db->prepare("SELECT COUNT(*) AS total FROM `recordatorios` WHERE  fechaVencimiento BETWEEN :inicioSemana AND :finSemana");
    $statement->bindParam(':inicioSemana', $inicioSemana);
    $statement->bindParam(':finSemana', $finSemana);
    $statement->execute();
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    return $resultado['total'];
}

function obtenerTotalMascotas() {
    $conexion = new conexionLogin();
    $db = $conexion->conectar();

    // Realizar la consulta para obtener el número total de mascotas
    $statement = $db->prepare("SELECT COUNT(*) AS total FROM `mascota`");
    $statement->execute();
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    return $resultado['total'];
}
function obtenerTotalMensajes() {
    $conexion = new conexionLogin();
    $db = $conexion->conectar();

    // Realizar la consulta para obtener el número total de mensajes
    $statement = $db->prepare("SELECT COUNT(*) AS total FROM `mensajes`");
    $statement->execute();
    $resultado = $statement->fetch(PDO::FETCH_ASSOC);

    return $resultado['total'];
}


?>
