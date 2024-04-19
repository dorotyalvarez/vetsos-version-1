<?php 
require_once '../php/Conexion_BD.php';
$conexion = new conexionLogin();
$db = $conexion->conectar();
// Consultar la tabla reservas
$query = "SELECT title,start,end,color FROM reservas";
$statement = $db->query($query);
// Verificar si la consulta fue exitosa
$resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
echo json_encode($resultado); // Enviar los resultados







//print_r($resultado);


//if ($statement) {
    // Obtener los resultados
    //$resultado = $statement->fetchAll(PDO::FETCH_ASSOC);
    // Imprimir los resultados
    //print_r($resultado);
//} else {
    // Si la consulta falla, mostrar el mensaje de error
   // echo "Error al ejecutar la consulta: " . $db->errorInfo()[2];
//}
?>
