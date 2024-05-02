<?php

require_once('../php/Conexion_BD.php');

// Array para almacenar los mensajes de éxito o error
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $idcliente = $_POST['idusuario'];
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
            // La imagen se ha subido correctamente
            $imagen_actualizada = $imagen_nombre; // Guardar el nombre de la imagen actualizada
        } else {
            // Error al mover la imagen
            $response['exito'] = false;
            $response['mensaje'] = 'Error al subir la imagen.';
            echo json_encode($response);
            exit; // Detener la ejecución del script
        }
    }

    try {
        // Crear una instancia de la clase conexionLogin
        $conexion = new conexionLogin();

        // Conectarse a la base de datos
        $pdo = $conexion->conectar();

        // Preparar la consulta SQL para actualizar los datos del cliente
        if (isset($imagen_actualizada)) {
            $stmt = $pdo->prepare("UPDATE cliente SET nombre=?, telefono=?, correo=?, documento=?, direccion=?, imagen_perfil=? WHERE idusuario=?");
            $stmt->execute([$nombre, $telefono, $correo, $documento, $direccion, $imagen_actualizada, $idcliente]);
        } else {
            $stmt = $pdo->prepare("UPDATE cliente SET nombre=?, telefono=?, correo=?, documento=?, direccion=? WHERE idusuario=?");
            $stmt->execute([$nombre, $telefono, $correo, $documento, $direccion, $idcliente]);
        }

        $conexion->desconectar();         
        $response['exito'] = true;
        $response['mensaje'] = 'Los datos se han actualizado correctamente.';
    } catch (PDOException $e) {
        // Mostrar un mensaje de error si hay un problema con la base de datos
        $response['exito'] = false;
        $response['mensaje'] = 'Error al actualizar los datos en la base de datos: ' . $e->getMessage();
    }
} else {
    // Método de solicitud incorrecto
    $response['exito'] = false;
    $response['mensaje'] = 'Error: Método de solicitud incorrecto.';
}

// Devolver una respuesta JSON
echo json_encode($response);

?>
