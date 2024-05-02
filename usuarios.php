<?php
require_once('template.php');
require_once('php/Conexion_BD.php');

$conexion = new conexionLogin();
$db = $conexion->conectar();

$statement = $db->prepare("SELECT * FROM `cliente` WHERE active = 1");
$statement->execute();
$clientes = $statement->fetchAll(PDO::FETCH_ASSOC); // Cambiar fetch por fetchAll

?>

<!DOCTYPE html>
<html lang="en">
<?= Head('usuario') ?>

<?= starBody() ?>
<style>
  /* Estilos para el título */
  .custom-title {
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
<center><h2 class="custom-title">Clientes Activos</h2></center>

<div class="card">
    <div>
    <br>
    <!-- Botón desplegable con Bootstrap -->
   
</div>
<center><div>
<h3 id="tituloVista text-center">Vista de clientes activos</h3>
    <br>
</div></center>

<div id="clientesTableContainer">
    <table id="clientesTable" class="display">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Telefono</th>
                <th>Correo</th>
                <th>Documento</th>
                <th>Direccion</th>
                <th>Editar</th> <!-- Nuevo encabezado para editar -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $alumno): ?>
            <tr>
                <td><?php echo $alumno['nombre'] ?></td>
                <td><?php echo $alumno['telefono'] ?></td>
                <td><?php echo $alumno['correo'] ?></td>
                <td><?php echo $alumno['documento'] ?></td>
                <td><?php echo $alumno['direccion'] ?></td>
                <td><a href="editar.php?id=<?php echo $alumno['idusuario']; ?>" class="btn btn-info">Ver Informacion</a></td>
 <!-- Enlace para editar -->
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</div


<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"></script> <!-- No estoy seguro de la ubicación exacta de este archivo, asegúrate de verificar la ruta -->

<script>
    $(function () {
        $("#clientesTable").DataTable({
           
            "language" :{
                "url":"//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
            }
            
        })
    });
</script>


<?= endBody() ?>
