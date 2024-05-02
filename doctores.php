<?php

require_once('template.php');
require_once('php/Conexion_BD.php');

$conexion = new conexionLogin();
$db = $conexion->conectar();

$query = "SELECT * FROM `doctor` WHERE 1;";
$statement = $db->query($query);
// Verificar si la consulta fue exitosa
$reservas = $statement->fetchAll(PDO::FETCH_ASSOC);


// Consulta para obtener los datos del doctor
$query_mascota = "SELECT nombre FROM mascota WHERE idmascota = :id2";
$statement_mascota = $db->prepare($query_mascota);
$statement_mascota->bindParam(':id2', $id2, PDO::PARAM_INT);
$statement_mascota->execute();
$resultado_mascota = $statement_mascota->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<?=Head('doctores')?>
<link rel="stylesheet" href="tablacss/estilo.css">
<style>
    .card {
      margin-bottom: 20px; /* Espaciado entre las cards */
    }
  </style>
<?=starBody()?>
<!-- Incluye jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- Incluye DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.6/js/jquery.dataTables.min.js"></script>

<!-- Incluye DataTables Buttons -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
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
    color: green; /* Cambio de color del texto al pasar el cursor */
    border-bottom-color: #666; /* Cambio de color de la línea inferior al pasar el cursor */
  }
</style>
<!-- HTML con el título personalizado -->
<center><h2 class="custom-title">Registro de veterinario</h2></center>


<style>
        /* Estilo personalizado para resaltar las celdas de encabezado */
        th {
            background-color: grey;
        }
        /* Estilo para los bordes redondeados de la tabla */
        .table-custom {
            border-collapse: separate;
            border-spacing: 0;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
           
        }
        .table-custom th,
        .table-custom td {
            border: 3px solid #dee2e6;
        }
        .table-custom thead th {
            border-bottom: 2px solid #dee2e6;
        }
    </style>

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h2 class="mb-0 text-center">Doctores Activos</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Especialidad</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Fecha de Registro</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($reservas as $reserva) : ?>
                            <tr>
                                <td><?php echo $reserva['nombre']; ?></td>
                                <td><?php echo $reserva['especialidad']; ?></td>
                                <td><?php echo $reserva['correo']; ?></td>
                                <td><?php echo $reserva['telefono']; ?></td>
                                <td><?php echo $reserva['fecha_registro']; ?></td>
                               
                                <td style="text-align: center">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="veterinario.php?id=<?php echo $reserva['id']; ?>" class="btn btn-outline-primary"><i class="bi bi-eye-fill"></i> Ver</a>
                                    </div>
                                </td>
                            </tr>
                            
                        <?php endforeach; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?=endBody()?>