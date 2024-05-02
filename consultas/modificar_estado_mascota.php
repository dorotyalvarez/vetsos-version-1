<?php
require_once(__DIR__ . '/../php/Conexion_BD.php');

// Verificar si se recibió el ID del mensaje a modificar
if(isset($_POST['idMensaje'])) {
    // Obtener el ID del mensaje desde el formulario
    $idMensaje = $_POST['idMensaje'];

    try {
        // Conectar a la base de datos
        $conexion = new conexionLogin();
        $db = $conexion->conectar();

        // Preparar la consulta para actualizar el estado del mensaje
        $statement = $db->prepare("UPDATE `mensajes` SET estado = 0 WHERE idMensaje = :id");
        $statement->bindParam(':id', $idMensaje);
        
        // Ejecutar la consulta
        $result = $statement->execute();
        // Verificar si la consulta se ejecutó correctamente
        if($result) {
            // Enviar una respuesta JSON de éxito
            echo json_encode(array('success' => true));
        } else {
            // Enviar una respuesta JSON de error si la consulta falló
            echo json_encode(array('success' => false, 'error' => 'Error al actualizar el estado del mensaje.'));
        }
    } catch(PDOException $e) {
        // Enviar una respuesta JSON de error si hubo una excepción PDO
        echo json_encode(array('success' => false, 'error' => $e->getMessage()));
    }
} else {
    // Enviar una respuesta JSON de error si no se recibió el ID del mensaje
    echo json_encode(array('success' => false, 'error' => 'No se recibió el ID del mensaje.'));
}
?>
