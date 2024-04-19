<?php
require_once __DIR__ . '/../php/Conexion_BD.php';

$conexion = new conexionLogin();
$db = $conexion->conectar();

// Consultar la tabla reservas
$query = "SELECT * FROM reservas";
$statement = $db->query($query);

// Verificar si la consulta fue exitosa
$reservas = $statement->fetchAll(PDO::FETCH_ASSOC);

// Asignar el JSON a una variable
$json_reservas = json_encode($reservas);

// Imprimir los resultados en formato JSON
echo $json_reservas;
?>
