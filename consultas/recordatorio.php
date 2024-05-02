<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["idMascota"]) && isset($_POST["textoRecordatorio"]) && isset($_POST["fechaVencimiento"])&& isset($_POST["nombre"]) ) {
        // Recibir los datos del formulario
        $idMascota = $_POST["idMascota"];
        $textoRecordatorio = $_POST["textoRecordatorio"];
        $fechaVencimiento = $_POST["fechaVencimiento"];
        $nombre_cliente = $_POST["nombre"];

        try {
            // Establecer la conexión a la base de datos
            require_once(__DIR__ . '/../php/Conexion_BD.php');
            $conexion = new conexionLogin();
            $db = $conexion->conectar();

            // Preparar la consulta SQL para insertar el recordatorio
            $statement = $db->prepare("INSERT INTO recordatorios (idMascota, textoRecordatorio, fechaVencimiento, nombre) VALUES (:idMascota, :textoRecordatorio, :fechaVencimiento, :nombre_cliente)");
            // Vincular los parámetros
            $statement->bindParam(':idMascota', $idMascota);
            $statement->bindParam(':textoRecordatorio', $textoRecordatorio);
            $statement->bindParam(':fechaVencimiento', $fechaVencimiento);
            $statement->bindParam(':nombre_cliente', $nombre_cliente);
            // Ejecutar la consulta
            $statement->execute();

            // Enviar una respuesta JSON en caso de éxito
            http_response_code(200);
            echo json_encode(array("message" => "¡Se ha guardado el recordatorio con éxito!"));
        } catch (PDOException $e) {
            // Manejar errores de la base de datos
            http_response_code(500);
            echo json_encode(array("message" => "Error al guardar el recordatorio: " . $e->getMessage()));
        }
    } else {
        // No se han recibido todos los datos esperados
        http_response_code(400);
        echo json_encode(array("message" => "Error: Falta uno o más datos del formulario."));
    }
} else {
    // El formulario no se ha enviado mediante POST
    http_response_code(405);
    echo json_encode(array("message" => "Error: El formulario no ha sido enviado correctamente."));
}

?>