<?php
require_once '../php/Conexion_BD.php';

$conexion = new conexionLogin();
$db = $conexion->conectar(); // Asignamos la conexión PDO a la variable $db

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['user_name']) && !empty($_POST['password']) && !empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['identificacion']) && isset($_POST['id_rol'])) {
        $nombre = $_POST['nombre'];
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];
        $apellido = $_POST['apellido'];
        $identificacion = $_POST['identificacion'];
        $email = $_POST['email'];
        $id_rol = $_POST['id_rol'];

        try {
            $stmt = $db->prepare("INSERT INTO usuarios (nombre, user_name, password, apellido, identificacion, email, id_rol) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bindParam(1, $nombre);
            $stmt->bindParam(2, $user_name);
            $stmt->bindParam(3, $hashed_password);
            $stmt->bindParam(4, $apellido);
            $stmt->bindParam(5, $identificacion);
            $stmt->bindParam(6, $email);
            $stmt->bindParam(7, $id_rol);
            $stmt->execute();
header('Location: ../register.html?status=success'); 
exit;
            
        } catch (PDOException $e) {
            die("Error en la base de datos: " . $e->getMessage());
        }
    } else {
        echo "Por favor, completa todos los campos requeridos.";
    }
}
?>
