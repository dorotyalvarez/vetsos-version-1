<?php
require_once('../php/Conexion_BD.php');

// Verificar si se proporcionó la ID de la mascota en la URL
if (isset($_GET['idmascota'])) {
    // Asignar la ID de la mascota a la variable $id_mascota
    $id_mascota = $_GET['idmascota'];
    
    $ruta_evidencia = '../imghistorial/';
    
    // Establecer la conexión a la base de datos utilizando tu clase de conexión
    $conexion = new conexionLogin();
    $pdo = $conexion->conectar();
    
    // Realizar una consulta para obtener los historiales de la mascota
    $stmt = $pdo->prepare("SELECT * FROM historial WHERE idMascota = ?");
    $stmt->execute([$id_mascota]);
    $historiales = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Mostrar los historiales en tarjetas
    foreach ($historiales as $historial) {
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">Historial #' . $historial['id'] . '</h5>';
        
        // Obtener la extensión del archivo de evidencia
        $extension = pathinfo($historial['evidencia'], PATHINFO_EXTENSION);
        
        // Mostrar la evidencia según su tipo
        if ($extension === 'pdf') {
            // Mostrar el PDF en un iframe
            echo '<iframe src="' . $ruta_evidencia . $historial['evidencia'] . '" width="100%" height="600px"></iframe>';
        } else if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif'])) {
            // Mostrar la imagen
            echo '<img src="' . $ruta_evidencia . $historial['evidencia'] . '" alt="Evidencia" class="img-thumbnail" style="max-width: 100%;">';
        } else {
            // Mostrar un enlace para descargar el archivo
            echo '<a href="' . $ruta_evidencia . $historial['evidencia'] . '" download>Descargar Evidencia</a>';
        }
        
        // Mostrar información adicional del historial si es necesario
        echo '<div class="mt-3 test-center">';
        echo '<p>hora de atención: ' . $historial['hora_atencion'] . '</p>';
        echo '<p>Tratamiento: ' . $historial['tratamiento'] . '</p>';
        echo '<p>Medicamentos: ' . $historial['medicamentos'] . '</p>';
        echo '<p>Procedimiento: ' . $historial['procedimiento'] . '</p>';
        echo '<p>fecha atendido: ' . $historial['fecha'] . '</p>';
        echo '</div>';
        
        echo '</div>'; // Cerrar div card-body
        echo '</div>'; // Cerrar div card
    }
    
    // Desconectar la base de datos
    $conexion->desconectar();
    
    
} else {
    // No se proporcionó la ID de la mascota en la URL
    echo 'Error: No se proporcionó la ID de la mascota.';
}
?>
