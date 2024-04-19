<?php
require_once('../php/Conexion_BD.php');

// Inicializar el array de respuesta
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $especie = $_POST['especie'];
    $raza = $_POST['raza'];
    $dueño = $_POST['documento']; // Modificado el nombre del campo 'dueño' a 'documento' según tu formulario
    $peso = $_POST['peso'];
    $sexo = $_POST['sexo'];
    $color = $_POST['color'];
    $edad = $_POST['edad'];

    // Verificar si se subió una imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $imagen_temp = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = $_FILES['imagen']['name'];
        $imagen_tipo = $_FILES['imagen']['type'];

        // Carpeta donde se guardarán las imágenes
        $carpeta_destino = '../imgmascotas/';

        // Mover la imagen a la carpeta de destino
        $ruta_imagen = $carpeta_destino . $imagen_nombre;
        if (move_uploaded_file($imagen_temp, $ruta_imagen)) {
            // La imagen se ha subido correctamente
            // Ahora, guardar la información en la base de datos

            try {
                // Crear una instancia de la clase conexionLogin
                $conexion = new conexionLogin();

                // Conectarse a la base de datos
                $pdo = $conexion->conectar();

                // Preparar la consulta SQL para insertar datos
                $stmt = $pdo->prepare("INSERT INTO mascota (nombre, idespecie, idraza, idusuarios, peso, sexo, color, edad, imagen) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

                // Ejecutar la consulta con los datos del formulario
                $stmt->execute([$nombre, $especie, $raza, $dueño, $peso, $sexo, $color, $edad, $ruta_imagen]);

                // Desconectar de la base de datos
                $conexion->desconectar();

                // Guardar mensaje de éxito en el array de respuesta
                $response['exito'] = true;
                $response['mensaje'] = 'Los datos se han guardado correctamente.';
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
