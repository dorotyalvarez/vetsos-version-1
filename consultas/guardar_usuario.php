<?php

require_once('../php/Conexion_BD.php');

// Array para almacenar los mensajes de éxito o error
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['usuario'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $documento = $_POST['documento'];
    $direccion = $_POST['direccion'];

    // Verificar si se subió una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_tipo = $_FILES['imagen']['type'];

        // Carpeta donde se guardarán las imágenes
        $carpeta_destino = '../imgclientes/';

        // Mover la imagen a la carpeta de destino
        if (move_uploaded_file($imagen_temp, $carpeta_destino . $imagen_nombre)) {
            try {
                // Crear una instancia de la clase conexionLogin
                $conexion = new conexionLogin();

                // Conectarse a la base de datos
                $pdo = $conexion->conectar();

                // Preparar la consulta SQL para insertar datos
                $stmt = $pdo->prepare("INSERT INTO cliente (nombre, telefono, correo, documento, direccion, imagen_perfil) VALUES (?, ?, ?, ?, ?, ?)");

                // Ejecutar la consulta con los datos del formulario
                $stmt->execute([$nombre, $telefono, $correo, $documento, $direccion, $imagen_nombre]); // Guardar el nombre de la imagen en lugar de la ruta completa

                // Obtener el ID del último registro insertado
                $ultimo_id = $pdo->lastInsertId();

                $conexion->desconectar();         
                $response['exito'] = true;
                $response['mensaje'] = 'Los datos se han guardado correctamente.';
                $response['id_registro'] = $ultimo_id; // Añadir el ID del registro al array de respuesta
            } catch (PDOException $e) {
                // Mostrar un mensaje de error si hay un problema con la base de datos
                $response['exito'] = false;
                $response['mensaje'] = 'Error al guardar los datos en la base de datos: ' . $e->getMessage();
            }
        } else {
            // Error al mover la imagen
            $response['exito'] = false;
            $response['mensaje'] = 'Error al subir la imagen.';
        }
    } else {
        // No se ha subido ninguna imagen
        $response['exito'] = false;
        $response['mensaje'] = 'Error: No se ha subido ninguna imagen.';
    }
} else {
    // Método de solicitud incorrecto
    $response['exito'] = false;
    $response['mensaje'] = 'Error: Método de solicitud incorrecto.';
}

// Devolver una respuesta JSON
echo json_encode($response);

?>
