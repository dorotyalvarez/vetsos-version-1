<?php
require_once('../php/Conexion_BD.php');

// Verificar si se proporcionó la ID de la mascota en la URL
if (isset($_GET['idmascota'])) {
    $id_mascota = $_GET['idmascota'];

    // Establecer la conexión a la base de datos utilizando tu clase de conexión
    $conexion = new conexionLogin();
    $pdo = $conexion->conectar();

    // Realizar una consulta para obtener los recordatorios de la mascota
    $stmt = $pdo->prepare("SELECT * FROM recordatorios WHERE idMascota = ?");
    $stmt->execute([$id_mascota]);
    $recordatorios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Mostrar los recordatorios
    if ($recordatorios) {
        foreach ($recordatorios as $recordatorio) {
            echo '<div class="card">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">identificador : ' . $recordatorio['idRecordatorio'] . '</h5>';
            echo '<p class="card-text"> texto : ' . $recordatorio['textoRecordatorio'] . '</p>';
            echo '<p class="card-text">Fecha vencimiento: ' . $recordatorio['fechaVencimiento'] . '</p>';
            echo '<p class="card-text"> fecha creacion: ' . $recordatorio['fechaCreacion'] . '</p>';
            echo '</div>'; // Cerrar div card-body
            echo '</div>'; // Cerrar div card
        }
    } else {
        echo '<div style="text-align: center; margin-top: 20px;">
        <h4 style="color: #ff0000; font-weight: bold;">No se encontraron recordatorios para esta mascota.</h4>
    </div>';
    }

    // Desconectar la base de datos
    $conexion->desconectar();
} else {
    // No se proporcionó la ID de la mascota en la URL
    echo 'Error: No se proporcionó la ID de la mascota.';
}
?>

