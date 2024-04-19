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
WHERE res.idestado = 1;";
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

<!-- Tu otro código aquí -->
>
<p></p>
<h1>doctores</h1>
<p></p>
<body>

<div class="container-fluid">
  <div class="row">
    <!-- Primera card (20% del ancho de la pantalla) -->
    <div class="col-md-3">
      <div class="card rounded" >
        <!-- Imagen y algunos datos -->
        <p></p>
        <h5 class="text-center">Informacion del doctor</h5>
        <img src="tablacss/icono-del-hombre-medico-veterinario-hy3bxm.jpg" class="card-img-top rounded-circle" alt="...">
        <div class="card-body">
          <h5 class="card-title">Título de la card</h5>
          <p class="card-text">Algunos datos del doctor.</p>
        </div>
      </div>
    </div>
    <!-- Segunda y tercera card (80% del ancho de la pantalla) -->
    <div class="col-md-9">
      <div class="row">
        <!-- Segunda card -->
        <div class="col-md-10">
          <div class="card">
          <h5 class="card-header">Featured</h5>
            <div class="card-body">
              <h5 class="card-title">Special title treatment</h5>
              <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
              <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
          </div>
        </div>
        <!-- Tercera card -->
        <div class="col-md-10">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Título de la card</h5>
              <p class="card-text">Algunos datos adicionales.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</body>



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
                                    <td><?php echo $reserva['nombre_estado']; ?></td>
                                    <td style="text-align: center">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                        <a href="show.php?id_cita=<?php echo $reserva['id']; ?>" class="btn btn-info"><i class="bi bi-eye-fill"></i> Ver</a>
                                         <a href="update.php?id_cita=<?php echo $reserva['id'];?>" type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i> Editar</a>
                                         <a href="delete.php?id_cita=<?php echo $reserva['id'];?>" type="button" class="btn btn-danger"><i class="bi bi-trash3-fill"></i> Borrar</a>

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
            "language": {
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
                "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Usuarios",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "Buscador:",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "responsive": true, "lengthChange": true, "autoWidth": false,
            buttons: [{
                extend: 'collection',
                text: 'Reportes',
                orientation: 'landscape',
                buttons: [{
                    text: 'Copiar',
                    extend: 'copy',
                }, {
                    extend: 'pdf'
                },{
                    extend: 'csv'
                },{
                    extend: 'excel'
                },{
                    text: 'Imprimir',
                    extend: 'print'
                }
                ]
            },
                {
                    extend: 'colvis',
                    text: 'Visor de columnas',
                    collectionLayout: 'fixed three-column'
                }
            ],
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>


<?=endBody()?>