<?php
require_once '../php/Conexion_BD.php';

// Obtener los datos del formulario
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];
$mensaje = $_POST['mensaje'];

// Crear una instancia de la conexión a la base de datos
$conexion = new conexionLogin();
$db = $conexion->conectar();

// Preparar la consulta para insertar el mensaje en la tabla
$query_insertar_mensaje = "INSERT INTO mensajes (nombre, correo, telefono, mensaje) VALUES (:nombre, :correo, :telefono, :mensaje)";
$statement_insertar_mensaje = $db->prepare($query_insertar_mensaje);

// Asignar los valores a los parámetros de la consulta
$statement_insertar_mensaje->bindParam(':nombre', $nombre, PDO::PARAM_STR);
$statement_insertar_mensaje->bindParam(':correo', $correo, PDO::PARAM_STR);
$statement_insertar_mensaje->bindParam(':telefono', $telefono, PDO::PARAM_STR);
$statement_insertar_mensaje->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);

// Ejecutar la consulta para insertar el mensaje
$response = array();
if ($statement_insertar_mensaje->execute()) {
    $response['success'] = true;
    $response['message'] = "Mensaje insertado correctamente en la base de datos.";
} else {
    $response['success'] = false;
    $response['message'] = "Error al insertar el mensaje en la base de datos.";
}

// Devolver la respuesta al cliente en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

