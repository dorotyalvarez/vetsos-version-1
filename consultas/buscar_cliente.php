<?php
require_once('../php/Conexion_BD.php');// Incluye el archivo que contiene la clase de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['documento'])) {
    $documento = $_POST['documento'];

    try {
        // Crear una instancia de la clase de conexión
        $conexion = new conexionLogin();

        // Conectarse a la base de datos
        $pdo = $conexion->conectar();

        // Consulta para obtener el ID del cliente
        $stmt = $pdo->prepare("SELECT idusuario FROM cliente WHERE documento = ?");
        $stmt->execute([$documento]);
        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {
            echo "ID del Cliente: " . $cliente['idusuario'];
        } else {
            echo "Cliente no encontrado para el documento: " . $documento;
        }

        // Desconectar de la base de datos
        $conexion->desconectar();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No se recibió ningún documento.";
}
?>

