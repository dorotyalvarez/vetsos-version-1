<?php
require_once '../php/Conexion_BD.php';

// Verificar si la fecha se pasó correctamente
if(isset($_GET['fecha'])) {
    $fecha = $_GET['fecha'];

    // Realizar conexión a la base de datos
    $conexion = new conexionLogin();
    $db = $conexion->conectar();

    // Consultar si hay reservas para la fecha especificada
    $query = "SELECT hora_cita FROM reservas WHERE fecha_cita = :fecha";
    $statement = $db->prepare($query);
    $statement->bindParam(':fecha', $fecha);
    $statement->execute();

    // Obtener las horas reservadas
    $horas_reservadas = $statement->fetchAll(PDO::FETCH_COLUMN);

    // Horario disponible
    $horario = ['08:00 - 09:00','09:00 - 10:00','10:00 - 11:00','11:00 - 12:00','02:00 - 03:00','03:00 - 04:00','04:00 - 05:00','05:00 - 06:00'];

    // Deshabilitar botones para horas ya reservadas
    foreach($horario as $hora) {
        if (in_array($hora, $horas_reservadas)) {
            $num = array_search($hora, $horario) + 1;
            $hora_res = "#btn_h$num";
            echo "<script>$('$hora_res').attr('disabled', true); $('$hora_res').css('background-color', 'red');</script>";



        }
    }
} else {
    echo "No se proporcionó una fecha válida.";
}
?>
