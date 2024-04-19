<?php
require_once('template.php');
$conexion = new PDO("mysql:host=localhost;dbname=login_register","root","");
$PDO =$conexion;
$stament=$PDO->prepare("SELECT * FROM `cliente` WHERE active = 1" );  
$stament ->execute();  
$clientes=$stament->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<?= Head('usuario') ?>

<?= starBody() ?>

    <div>
    <br>
    <!-- Botón desplegable con Bootstrap -->
    <div class="dropdown mr-3 float-right">
        <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Opciones
        </button>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="#" id="listaMascotasLink">Lista de mascotas</a>
            <a class="dropdown-item" href="#" id="volverClientes">Volver a clientes</a>
            <a class="dropdown-item" href="cliente.php">Nuevo usuario mascota</a>
        </div>
    </div>
</div>
<div>
<h3 id="tituloVista">Vista de clientes activos</h3>
    <br>
</div>

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
               
                <td><?php echo $alumno[1] ?></td>
                <td><?php echo $alumno[2] ?></td>
                <td><?php echo $alumno[3] ?></td>
                <td><?php echo $alumno[4] ?></td>
                <td><?php echo $alumno[5] ?></td>
                
                
                <td><a href="editar.php?id=<?php echo $alumno[0]; ?>" class="btn btn-info">Ver Informacion</a></td> <!-- Enlace para editar -->
                

            </tr>
            <?php endforeach; ?>
        </tbody>
        
    </table>
</div>

<div id="listaMascotasContainer" style="display:none;"></div>
<script src="funtion/mascotas.js"></script>
<script>
$(document).ready(function() {
    $('#clientesTable').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
        }
    });

    $('#listaMascotasLink').on('click', function(e) {
        e.preventDefault();
        cargarListaMascotas();
        $('#clientesTableContainer').hide();
        $('#listaMascotasContainer').show();
        $('#tituloVista').text('Vista de mascotas');
    });

    $('#volverClientes').on('click', function(e) {
        e.preventDefault();
        $('#listaMascotasContainer').hide();
        $('#clientesTableContainer').show();
        $('#tituloVista').text('Vista de clientes activos');
    });

    function cargarListaMascotas() {
        $.ajax({
            url: 'obtener_mascotas.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                $('#listaMascotasContainer').empty();
                var tableHtml = '<table id="listaMascotasTable" class="display"><thead><tr><th>ID</th><th>Nombre</th><th>Especie</th><th>Raza</th><th>Usuario</th><th>Peso</th><th>Sexo</th><th>Color</th><th>Edad</th><th>Fecha Creada</th><th>Activo</th></tr></thead><tbody>';
                response.forEach(function(mascota) {
                    tableHtml += '<tr>';
                    tableHtml += '<td>' + mascota.idmascota + '</td>';
                    tableHtml += '<td>' + mascota.nombre + '</td>';
                    tableHtml += '<td>' + (mascota.idespecie ? mascota.idespecie : 'Desconocido') + '</td>';
                    tableHtml += '<td>' + (mascota.idraza ? mascota.idraza : 'Desconocido') + '</td>';
                    tableHtml += '<td>' + (mascota.idusuarios ? mascota.idusuarios : 'Desconocido') + '</td>';
                    tableHtml += '<td>' + (mascota.peso ? mascota.peso : 'Desconocido') + '</td>';
                    tableHtml += '<td>' + (mascota.sexo ? mascota.sexo : 'Desconocido') + '</td>';
                    tableHtml += '<td>' + (mascota.color ? mascota.color : 'Desconocido') + '</td>';
                    tableHtml += '<td>' + (mascota.edad ? mascota.edad : 'Desconocido') + '</td>';
                    tableHtml += '<td>' + (mascota.fecha_creada ? mascota.fecha_creada : 'Desconocido') + '</td>';
                    tableHtml += '<td>' + (mascota.active ? 'Sí' : 'No') + '</td>';
                    tableHtml += '</tr>';
                });
                tableHtml += '</tbody></table>';
                $('#listaMascotasContainer').html(tableHtml);
                $('#listaMascotasTable').DataTable({
                    "language": {
                        "url": "//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
                    }
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
});
</script>


<?= endBody() ?>
