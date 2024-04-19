
<?php
session_start();
require_once '../php/Conexion_BD.php';
$conexion = new conexionLogin();
$pdo = $conexion->conectar(); // Asignamos la conexión PDO a la variable $pdo

$idusuario = $_POST['idcliente'];
$idmascota = $_POST['idmascota'];
$idcategoria = $_POST['servicio'];
$fecha_cita = $_POST['fecha_cita'];
$hora_cita = $_POST['hora_cita'];
$title = $_POST['title'];
$start = $fecha_cita;
$end = $fecha_cita;
$color = "#008000";
$fechaHora = date('Y-m-d H:i:s'); // Asegúrate de definir esta variable con la fecha y hora actual

$sentencia = $pdo->prepare('INSERT INTO reservas (idusuario, idmascota, idcategoria, fecha_cita, hora_cita, title, start, end, color, fyh_creacion) VALUES (:idusuario, :idmascota, :idcategoria, :fecha_cita, :hora_cita, :title, :start, :end, :color, :fyh_creacion)');

$sentencia->bindParam(':idusuario', $idusuario);
$sentencia->bindParam(':idmascota', $idmascota);
$sentencia->bindParam(':idcategoria', $idcategoria);
$sentencia->bindParam(':fecha_cita', $fecha_cita);
$sentencia->bindParam(':hora_cita', $hora_cita);
$sentencia->bindParam(':title', $title);
$sentencia->bindParam(':start', $start);
$sentencia->bindParam(':end', $end);
$sentencia->bindParam(':color', $color);
$sentencia->bindParam(':fyh_creacion', $fechaHora); // Corregido para incluir los dos puntos


if ($sentencia->execute()) {
    $_SESSION['mensaje'] = 'La cita se ha guardado correctamente.';
    $_SESSION['tipo_mensaje'] = 'success'; // Tipo de mensaje para SweetAlert2
    header('Location:' .$URL.'/vetsos/calendar.php');
} else {
    echo 'error al registrar la cita';
}
