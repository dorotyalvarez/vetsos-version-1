<?php
// Conectar a la base de datos y obtener el ID de la mascota a eliminar
require_once('php/conexion.php');
$idMascota = $_POST['idMascota'];

// Actualizar el estado de la mascota en la base de datos
$query = "UPDATE mascota SET active = 0 WHERE idmascota = $idMascota";
$resultado = mysqli_query($conection, $query);

// Verificar si la eliminación fue exitosa
if ($resultado) {
    // Redirigir a editar.php
    header("Location: editar.php");
    exit(); // Detener la ejecución del script después de la redirección
} else {
    // Enviar mensaje de error si la eliminación falla
    echo "Error al eliminar la mascota.";
}
?>
