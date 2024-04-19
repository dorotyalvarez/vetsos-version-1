<?php
// Conexión a la base de datos
require_once('template.php');
$conexion = new PDO("mysql:host=localhost;dbname=login_register","root","");
$PDO = $conexion;

// Consulta para obtener todas las mascotas
$statement = $PDO->prepare("SELECT * FROM `mascota`");
$statement->execute();
$mascotas = $statement->fetchAll(PDO::FETCH_ASSOC);

// Devolver los resultados en formato JSON
echo json_encode($mascotas);
?>
