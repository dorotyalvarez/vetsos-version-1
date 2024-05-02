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
WHERE res.idestado = 3;";
$statement = $db->query($query);
// Verificar si la consulta fue exitosa
$reservas = $statement->fetchAll(PDO::FETCH_ASSOC);


// Obtener el ID del doctor de la variable $_GET
$id_doctor = isset($_GET['id']) ? $_GET['id'] : '';

// Consulta para obtener los datos del doctor basado en el ID
$query_doctor = "SELECT * FROM doctor WHERE id = :id_doctor";
$statement_doctor = $db->prepare($query_doctor);
$statement_doctor->bindParam(':id_doctor', $id_doctor);
$statement_doctor->execute();
$resultado_doctor = $statement_doctor->fetch(PDO::FETCH_ASSOC);



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
<style>
  /* Estilos para el título */
  .custom-title {
    text-align: center;
    margin-top: 20px; 
    margin-bottom: 20px; 
    font-size: 24px; 
    color: blue;
    border-bottom: 2px solid #ccc; 
    padding-bottom: 10px; 
  }
  .custom-title:hover {
    color: #666; /* Cambio de color del texto al pasar el cursor */
    border-bottom-color: #666; /* Cambio de color de la línea inferior al pasar el cursor */
  }
</style>

<!-- HTML con el título personalizado -->
<center><h2 class="custom-title">Información Doctores</h2></center>
<body>
<div class="container-fluid">
  <div class="row">
    <!-- Primera card (20% del ancho de la pantalla) -->
    <div class="col-md-3">
      <div class="card rounded" >
        <!-- Imagen y algunos datos -->
        <p></p>
        <h5 class="text-center">Informacion del Veterinario</h5>
        <img src="tablacss/icono-del-hombre-medico-veterinario-hy3bxm.jpg" class="card-img-top rounded-circle" alt="...">
        <div class="card-body">
          <h5 class="card-title"></h5>
          <p class="card-text text-center"><?php echo $resultado_doctor['especialidad']; ?></p>
        </div>
      </div>
    </div>
    <!-- Segunda y tercera card (80% del ancho de la pantalla) -->
    <div class="col-md-9">
      <div class="row">
        <!-- Segunda card -->
        <div class="col-md-10">
          <div class="card">
          <h5 class="card-header">Datos</h5>
            <div class="card-body">
              <h5 class="card-title text-center">veterinario zootecnico</h5>
              <h5 class="card-title">Nombre:  Dr.<?php echo $resultado_doctor['nombre']; ?></h5>
                      <p class="card-text">Especialidad: <?php echo $resultado_doctor['especialidad']; ?></p>
                        <p class="card-text">Correo: <?php echo $resultado_doctor['correo']; ?></p>
                        <p class="card-text">Horario: <?php echo $resultado_doctor['horario']; ?></p>
                        <p class="card-text">Teléfono: <?php echo $resultado_doctor['telefono']; ?></p>
                        <p class="card-text">Direccion:  Dirección: Calle Principal #123, Ciudad Principal, País</p>
            </div>
          </div>
        </div>
        <!-- Tercera card -->
        <div class="col-md-10">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Sobre MI</h5>
              <p class="card-text">"¡Hola! Soy el Dr.<?php echo $resultado_doctor['nombre']; ?> un apasionado veterinario especializado en el cuidado de pequeños animales. Con años de experiencia en el campo, </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
<section>
<section>
    <!-- Sección de botones -->
    <div class="row mt-4">
        <!-- Botón Eliminar Cliente -->
        <div class="col-md-4 text-center">
            <div class="card">
                <div class="card-body">
                   
                    <form action="eliminar_cliente.php" method="get">
                        <input type="hidden" name="id_cliente" value="<?php echo $clienteArray['idusuario']; ?>">
                        <button type="submit" class="btn btn-outline-danger btn-lg">Borrar Veterinario</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Botón Editar Cliente -->
        <div class="col-md-4 text-center">
            <div class="card">
                <div class="card-body">
                   
                    <form action="actualizar_cliente.php" method="get">
                        <input type="hidden" name="id_cliente" value="<?php echo $clienteArray['idusuario']; ?>">
                        <button type="submit" class="btn btn-outline-primary btn-lg">Editar Veterinario</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card">
            <div class="card-body text-center">
            
            <form action="crear_macota.php" method="get">
                        <input type="hidden" name="id_cliente" value="<?php echo $clienteArray['idusuario']; ?>">
                        <button type="submit" class="btn btn-outline-success btn-lg">AGREGAR  Veterinario</button>
                     </form>
            </div>
          </div>
        </div>
    </div>
</div>
</section>
    <div class="container">
    <center><h2 class="custom-title">CITAS Pendientes</h2></center>

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
                                <th style="text-align: center">veterinario </th>
                                <th style="text-align: center">Cliente</th>
                                <th style="text-align: center">Mascota</th>
                                <th style="text-align: center">Tipo De Cita</th>
                                <th style="text-align: center">fecha cita</th>
                                <th style="text-align: center">Procedimiento</th>
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
           
            "language" :{
                "url":"//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
            }
            
        })
    });
</script>
</section>
<?=endBody()?>