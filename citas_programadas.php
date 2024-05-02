<?php
require_once('template.php');
require_once('php/Conexion_BD.php');

$conexion = new conexionLogin();
$db = $conexion->conectar();

$query = "SELECT res.*, cli.nombre AS nombre_cliente, mas.nombre AS nombre_mascota, cat.nombre AS nombre_categoria, est.nombre AS nombre_estado
FROM reservas AS res
INNER JOIN cliente AS cli ON cli.idusuario = res.idusuario
INNER JOIN mascota AS mas ON mas.idmascota = res.idmascota
INNER JOIN categoria AS cat ON cat.idcategoria = res.idcategoria
INNER JOIN estado AS est ON est.idestado = res.idestado
WHERE res.idestado = 1;
";
$statement = $db->query($query);

// Verificar si la consulta fue exitosa
$reservas = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<?=Head('citas')?>
<?=starBody()?>

<style>  .custom-title {
    text-align: center;
    margin-top: 20px; 
    margin-bottom: 20px; 
    font-size: 24px; 
    color: #333;
    border-bottom: 2px solid #ccc; 
    padding-bottom: 10px; 
  }
  .custom-title:hover {
    color: #666; /* Cambio de color del texto al pasar el cursor */
    border-bottom-color: #666; /* Cambio de color de la línea inferior al pasar el cursor */
  }
</style>

<!-- HTML con el título personalizado -->
<center><h2 class="custom-title">Citas Pendientes</h2></center>

    <br>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><b>Citas registradas</b></h3>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table table-striped table-bordered table-hover">
                            <thead>
                                <tr>
                                <th style="text-align: center">Cita #</th>
                                <th style="text-align: center">Cliente</th>
                                <th style="text-align: center">Mascota</th>
                                <th style="text-align: center">Tipo De Cita</th>
                                <th style="text-align: center">fecha cita</th>
                                <th style="text-align: center">Actividad</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center"></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $contador = 0;
                            foreach ($reservas as $reserva){
                                
                                $contador = $contador + 1;
                                
                                ?>
                                <tr>
                                <td><?php echo $contador; ?></td>
                                    <td><?php echo $reserva['nombre_cliente']; ?></td>
                                    <td><?php echo $reserva['nombre_mascota']; ?></td>
                                    <td><?php echo $reserva['nombre_categoria']; ?></td>
                                    <td><?php echo $reserva['fecha_cita']; ?></td>
                                    <td><?php echo $reserva['title']; ?></td>
                                    <td ><i class="bi bi-pencil-square"> <?php echo $reserva['nombre_estado']; ?></td>
                                    <td style="text-align: center">

                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>



    </div>

<?php

?>
<script>
    $(function () {
        $("#example1").DataTable({
           
            "language" :{
                "url":"//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
            }
            
        })
    });
</script>





<?=endBody()?>
</html>
<div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="show.php?id_cita=<?php echo $reserva['id']; ?>" class="btn btn-info"><i class="bi bi-eye-fill"></i> Ver</a>
                                         <a href="update.php?id_cita=<?php echo $reserva['id'];?>" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i> Editar</a>
                                         <a href="delete.php?id_cita=<?php echo $reserva['id'];?>" type="button" class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Borrar</a>