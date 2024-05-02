<?php

require_once('../php/Conexion_BD.php');

// Array para almacenar los mensajes de éxito o error
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $idMascota = $_POST['idMascota'];
    $horaAtencion = $_POST['hora'];
    $tratamiento = $_POST['tratamiento'];
    $medicamentos = $_POST['medicamentos'];
    $procedimiento = $_POST['procedimiento'];

    // Verificar si se ha proporcionado un archivo de evidencia
    if (isset($_FILES['evidencia']) && $_FILES['evidencia']['error'] === UPLOAD_ERR_OK) {
        // Manejo del archivo de evidencia
        $evidencia_nombre = $_FILES['evidencia']['name'];
        $evidencia_temp = $_FILES['evidencia']['tmp_name'];
        $evidencia_tipo = $_FILES['evidencia']['type'];

        // Carpeta donde se guardará el archivo (nivel superior)
        $carpeta_destino = '../imghistorial/';

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($evidencia_temp, $carpeta_destino . $evidencia_nombre)) {
            try {
                // Crear una instancia de la clase conexionLogin
                $conexion = new conexionLogin();

                // Conectarse a la base de datos
                $pdo = $conexion->conectar();

                // Preparar la consulta SQL para insertar datos
                $stmt = $pdo->prepare("INSERT INTO historial (idMascota, hora_atencion, tratamiento, medicamentos, procedimiento, evidencia) VALUES (?, ?, ?, ?, ?, ?)");

                // Ejecutar la consulta con los datos del formulario
                $stmt->execute([$idMascota, $horaAtencion, $tratamiento, $medicamentos, $procedimiento, $evidencia_nombre]);

                // Obtener el ID del último registro insertado
                $ultimo_id = $pdo->lastInsertId();

                $conexion->desconectar();

               // $response['exito'] = true;
                $response['mensaje'] = 'Los datos se han guardado correctamente.';
                //$response['id_registro'] = $ultimo_id; // Añadir el ID del registro al array de respuesta
            } catch (PDOException $e) {
                // Mostrar un mensaje de error si hay un problema con la base de datos
                $response['exito'] = false;
                $response['mensaje'] = 'Error al guardar los datos en la base de datos: ' . $e->getMessage();
            }
        } else {
            // Error al mover el archivo de evidencia
            $response['exito'] = false;
            $response['mensaje'] = 'Error al subir el archivo de evidencia.';
        }
    } else {
        // No se ha proporcionado ningún archivo de evidencia
        $response['exito'] = false;
        $response['mensaje'] = 'Error: No se ha proporcionado ningún archivo de evidencia.';
    }
} else {
    // Método de solicitud incorrecto
    $response['exito'] = false;
    $response['mensaje'] = 'Error: Método de solicitud incorrecto.';
}

// Devolver una respuesta JSON
echo json_encode($response);

?>
