
    <style>
        /* Estilo para mensajes exitosos */
        .success {
            color: green;
            font-weight: bold;
        }

        /* Estilo para mensajes de error */
        .error {
            color: red;
            font-weight: bold;
        }
    </style>

<?php

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $contrasena_actual = $_POST['contrasena_actual'];
    $nueva_contrasena = $_POST['nueva_contrasena'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];

    // Validar que las contraseñas coincidan
    if ($nueva_contrasena !== $confirmar_contrasena) {
        echo '<p class="error">Las password no coinciden.</p>';
    } else {
        // Obtener la contraseña actual almacenada en la sesión
        session_start();
        $contrasena_actual_session = $_SESSION['pass'];
        var_dump($_SESSION['pass']);

        // Verificar si la contraseña actual ingresada coincide con la almacenada en la sesión
        if (password_verify($contrasena_actual, $contrasena_actual_session)) {
            // Conectar con la base de datos y realizar la actualización de la contraseña
            require_once('../php/Conexion_BD.php');
            $conexion = new conexionLogin();
            $pdo = $conexion->conectar();

            // Obtener el ID del usuario
            $id_usuario = $_SESSION['idUsuario']; // Ajusta esto según cómo guardes el ID del usuario en la sesión

            // Generar el hash de la nueva contraseña
            $hash_nueva_contrasena = password_hash($nueva_contrasena, PASSWORD_DEFAULT);

            // Actualizar la contraseña en la base de datos
            $stmt = $pdo->prepare("UPDATE usuarios SET password = ? WHERE idUsuario = ?");
            $stmt->execute([$hash_nueva_contrasena, $id_usuario]);

            // Mostrar un mensaje de éxito
            $conexion->desconectar();
            echo '<p class="success">La credencial se han actualizado correctamente.</p>';
        } else {
            // La contraseña actual no coincide
            echo '<p class="error">La password actual ingresada no es correcta.</p>';
        }
    }
} else {
    // Si no se ha enviado el formulario mediante POST
    echo '<p class="error">Error: Método de solicitud incorrecto.</p>';
}
?>
