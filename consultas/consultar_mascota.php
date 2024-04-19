<?php

require_once(__DIR__ . '/../php/Conexion_BD.php');

$conexion = new conexionLogin();
$db = $conexion->conectar();

$stament = $db->prepare("SELECT * FROM `mensajes` WHERE estado = 1");  
$stament->execute();  
$clientes = $stament->fetchAll(PDO::FETCH_ASSOC);


?>
