<?php
require_once '../php/Conexion_BD.php';

// Obtener el ID del mensaje y el nuevo estado del formulario
$idMensaje = $_POST['idMensaje'];
$nuevoEstado = $_POST['nuevoEstado'];

// Crear una instancia de la conexión a la base de datos
$conexion = new conexionLogin();
$db = $conexion->conectar();

// Preparar la consulta para actualizar el estado del mensaje en la tabla
$query_actualizar_estado = "UPDATE mensajes SET estado = :nuevoEstado WHERE id = :idMensaje";
$statement_actualizar_estado = $db->prepare($query_actualizar_estado);

// Asignar los valores a los parámetros de la consulta
$statement_actualizar_estado->bindParam(':nuevoEstado', $nuevoEstado, PDO::PARAM_INT);
$statement_actualizar_estado->bindParam(':idMensaje', $idMensaje, PDO::PARAM_INT);

// Ejecutar la consulta para actualizar el estado del mensaje
$response = array();
if ($statement_actualizar_estado->execute()) {
    $response['success'] = true;
    $response['message'] = "Estado del mensaje actualizado correctamente en la base de datos.";
} else {
    $response['success'] = false;
    $response['message'] = "Error al actualizar el estado del mensaje en la base de datos.";
}

// Devolver la respuesta al cliente en formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
