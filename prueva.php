<?php
require_once('php/Conexion_BD.php');
$conexion = new conexionLogin();
$db = $conexion->conectar();

$idUsuario = 4; // Supongamos que quieres buscar las mascotas del usuario con ID 2

$query = "SELECT * FROM mascota WHERE idusuarios = :id AND active = 1";
$statement = $db->prepare($query); // Preparamos la consulta para evitar la inyección SQL
$statement->bindParam(':id', $idUsuario); // Vinculamos el parámetro :id con la variable $idUsuario
$statement->execute(); // Ejecutamos la consulta

// Obtener el resultado de la consulta
$mascotas = $statement->fetchAll(PDO::FETCH_ASSOC);

// Imprimir el contenido de $mascotas
var_dump($mascotas);
?>
