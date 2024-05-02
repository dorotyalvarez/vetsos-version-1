<?php
require_once(__DIR__ . '/../php/Conexion_BD.php');

$conexion = new conexionLogin();
$db = $conexion->conectar();

$stament = $db->prepare("SELECT * FROM `cliente` WHERE documento = :cedula");  
$stament->execute(array(':cedula' => $_POST['cedula']));
$cliente = $stament->fetch(PDO::FETCH_ASSOC);

// Verificar si el cliente existe
if ($cliente) {
    // Obtener el ID del cliente
    $cliente_id = $cliente['idusuario'];

    // Realizar una consulta para obtener las mascotas asociadas al cliente
    $stament_mascotas = $db->prepare("SELECT * FROM `mascota` WHERE idusuarios = :cliente_id");
    $stament_mascotas->execute(array(':cliente_id' => $cliente_id));
    $mascotas = $stament_mascotas->fetchAll(PDO::FETCH_ASSOC);

    // Construir un arreglo de mascotas con sus nombres e IDs
    $mascotas_info = array();
    foreach ($mascotas as $mascota) {
        $mascota_info = array(
            'nombre' => $mascota['nombre'],
            'id' => $mascota['idmascota']
        );
        $mascotas_info[] = $mascota_info;
    }

    // Construir la respuesta
    $respuesta = array(
        'nombre' => $cliente['nombre'],
        'id' => $cliente['idusuario'],
        'mascotas' => $mascotas_info, // Incluir las mascotas en la respuesta
        // Otros datos que quieras incluir
    );

    // Convertir la respuesta a JSON y enviarla
    echo json_encode($respuesta);
} else {
    echo "El cliente no esta Registrado.";
}
?>

