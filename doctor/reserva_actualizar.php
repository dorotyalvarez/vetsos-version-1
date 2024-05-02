<?php
// Verificar si se recibió una solicitud POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Verificar si se recibió el ID de la reserva
    if (isset($_POST["idReserva"])) {
        // Recibir el ID de la reserva
        $idReserva = $_POST["idReserva"];
        
        try {
            // Establecer la conexión a la base de datos
            require_once(__DIR__ . '/../php/Conexion_BD.php');
            $conexion = new conexionLogin();
            $db = $conexion->conectar();

            // Preparar la consulta SQL para actualizar el estado de la reserva
            $statement = $db->prepare("UPDATE reservas SET idestado = 3 WHERE id = :idReserva");
            // Vincular el parámetro
            $statement->bindParam(':idReserva', $idReserva);
            // Ejecutar la consulta
            $statement->execute();

            // Enviar una respuesta JSON en caso de éxito
            http_response_code(200);
            echo json_encode(array("message" => "¡Se ha actualizado el estado de la reserva con éxito!"));
        } catch (PDOException $e) {
            // Manejar errores de la base de datos
            http_response_code(500);
            echo json_encode(array("message" => "Error al actualizar el estado de la reserva: " . $e->getMessage()));
        }
    } else {
        // No se recibió el ID de la reserva
        http_response_code(400);
        echo json_encode(array("message" => "Error: Falta el ID de la reserva."));
    }
} else {
    // La solicitud no se hizo mediante POST
    http_response_code(405);
    echo json_encode(array("message" => "Error: La solicitud debe ser mediante POST."));
}
?>
