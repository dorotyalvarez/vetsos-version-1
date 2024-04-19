<?php
require_once('../templete2.php');
require_once('../php/Conexion_BD.php');

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

<h1>Citas</h1>

<!-- CDN Bootstrap 5 JavaScript (requiere jQuery) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <br>
    <div class="container-fluid">
        <h1>Listado de citas Pendientes</h1>

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
                                <th style="text-align: center">Hora</th>
                                <th style="text-align: center">Estado</th>
                                <th style="text-align: center">Acciones</th>
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
                                    <td><?php echo $reserva['hora_cita']; ?></td>
                                    <td><?php echo $reserva['nombre_estado']; ?></td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                        <a ><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#citaModal"><i class="bi bi-eye-fill"></i>Ver</button></a>
                                         <a href="update.php?id_cita=<?php echo $reserva['id'];?>" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i> Editar</a>
                                         

                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>

                        <br><br>


                    </div>
                </div>
            </div>
        </div>



    </div>




<script>
    $(function () {
        $("#example1").DataTable({
            "pageLength": 5,
            "language" :{
                "url":"//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
            }
            
        })
    });
</script>



<?=endBody()?>
</html>
