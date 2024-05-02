<?php
require_once ('template.php');
require_once('php/Conexion_BD.php'); // Incluir el archivo de conexión
// Verificar si se proporcionó un ID de cliente en la URL
if (empty($_GET['id'])) {
    header('Location: usuarios.php');
    exit; // Detener la ejecución del script
}
// Obtener el ID del cliente de la URL
$idCliente = $_GET["id"];
// Crear una instancia de la conexión a la base de datos
$conexion = new conexionLogin();
$db = $conexion->conectar();

// Preparar y ejecutar la consulta para obtener los detalles del cliente
$statement = $db->prepare("SELECT * FROM cliente WHERE idusuario = :id");
$statement->bindParam(':id', $idCliente);
$statement->execute();
$cliente = $statement->fetch(PDO::FETCH_ASSOC);

// Verificar si se encontró el cliente
if (!$cliente) {
    echo "No se encontró ningún cliente con el ID proporcionado.";
    exit; // Detener la ejecución del script
}
// Convertir los detalles del cliente en un array
$clienteArray = array(
    'idusuario' => $cliente['idusuario'],
    'nombre' => $cliente['nombre'],
    'telefono' => $cliente['telefono'],
    'correo' => $cliente['correo'],
    'documento' => $cliente['documento'],
    'direccion' => $cliente['direccion'],
    'fecha_creado' => $cliente['fecha_creado'],
    'fecha_actualizado' => $cliente['fecha_actualizado'],
    'active' => $cliente['active'],
    'imagen_perfil' => $cliente['imagen_perfil']
);
?>
<?php
require_once('php/Conexion_BD.php');
$conexion = new conexionLogin();
$db = $conexion->conectar();
$query = "SELECT mas.*,  raza.nombre AS nombre_raza, especie.typoanimal AS nombre_especie
FROM mascota AS mas
INNER JOIN raza AS raza ON raza.idraza = mas.idraza
INNER JOIN especie AS especie ON especie.idespecie = mas.idespecie
WHERE mas.idusuarios = :id AND mas.active = 1;";
$statement = $db->prepare($query);
$statement->bindParam(':id', $idCliente); // Vincula el parámetro :id con el valor de $idCliente
$statement->execute(); // Ejecuta la consulta
// Obtener el resultado de la consulta
$mascotas = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<?= Head('editar') ?>
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
<center><h2 class="custom-title">Perfil del Cliente</h2></center>
<body><!-- Imagen y algunos datos -->
<section>
    <div class="container">
        <div class="row">
            <!-- Primera card (33.33% del ancho de la pantalla) -->
            <div class="col-md-4">
                <div class="card rounded h-100">
                    <!-- Contenido de la primera card -->
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                        <?php 
                        // Ruta del directorio donde se guardan las imágenes
                        $ruta_imagen = 'imgclientes/' . $clienteArray['imagen_perfil']; 
                        ?>
                        <img id="imagen-preview" src="<?php echo $ruta_imagen; ?>" alt="Imagen de perfil" class="card-img-top rounded-circle mb-3" style="width: 305px; height: 305px;">
                        <h5 class="text-center"><?php echo $clienteArray['nombre']; ?></h5>
                        <p class="text-center">Última Modificación: <?php echo $clienteArray['fecha_actualizado']; ?></p>
                    </div>
                </div>
            </div>
           <div class="col-md-8 d-flex">
                <div class="card flex-grow-1">
                    <!-- Contenido de la segunda card -->
                    <h5 class="card-header">DATOS</h5>
                    <div class="card-body">
                        <h5 class="card-title">PERSONALES</h5>
                        <p class="card-text">Nombre:</p>
                        <P><?php echo $clienteArray['nombre']; ?></P>
                        <p class="card-text">Telefono:</p>
                        <P><?php echo $clienteArray['telefono']; ?></P>
                        <p class="card-text">Correo:</p>
                        <P><?php echo $clienteArray['correo']; ?></P>
                    </div>
                </div>
                <div class="card flex-grow-1">
                    <!-- Contenido de la tercera card -->
                    <h5 class="card-header">-</h5>
                    <div class="card-body">
                        <h5 class="card-title">Otros datos</h5>
                        <p class="card-text">Documento:</p>
                        <P><?php echo $clienteArray['documento']; ?></P>
                        <p class="card-text">Direccion:</p>
                        <P><?php echo $clienteArray['direccion']; ?></P>
                    </div>
                </div>
        </div>
    </div>
    </div>
    </section>
    <div class="mt-3 text-center">
    <button onclick="window.location.href = 'editar.php'" class="btn btn-warning">Volver a Usuarios</button>
</div>
    <section class="container mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">Mascotas de este cliente</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="thead-dark">
                                <tr> 
                                    <th>Nombre</th>
                                    <th>Especie</th>
                                    <th>Raza</th>
                                    <th>Peso</th>
                                    <th>Sexo</th>
                                    <th>Color</th>
                                    <th>Edad mes</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($mascotas as $mascota): ?>
                                <tr>
                                    <td><?php echo $mascota['nombre'] ?></td>
                                    <td><?php echo $mascota['nombre_especie'] ?></td>
                                    <td><?php echo $mascota['nombre_raza'] ?></td>
                                    <td><?php echo $mascota['peso'] ?><span> kg</span></td>
                                    <td><?php echo $mascota['sexo'] ?></td>
                                    <td><?php echo $mascota['color'] ?></td>
                                    <td><?php echo $mascota['edad'] ?><span> meses</span></td>
                                    <td><a href="editar_macota.php?id1=<?php echo $clienteArray['idusuario']; ?>&id2=<?php echo $mascota['idmascota']; ?>" class="btn btn-info">Ver Información</a></td>
                                    <td><a href="calendar.php?id1=<?php echo $clienteArray['idusuario']; ?>&id2=<?php echo $mascota['idmascota']; ?>" class="btn btn-success">Agenda cita</a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <!-- Sección de botones -->
    <div class="row mt-4">
        <!-- Botón Eliminar Cliente -->
        <div class="col-md-4 text-center">
            <div class="card">
                <div class="card-body">
                   
                    <form action="eliminar_cliente.php" method="get">
                        <input type="hidden" name="id_cliente" value="<?php echo $clienteArray['idusuario']; ?>">
                        <button type="submit" class="btn btn-outline-danger btn-lg">Borrar Cliente</button>
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
                        <button type="submit" class="btn btn-outline-primary btn-lg">Editar Cliente</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-center">
          <div class="card">
            <div class="card-body text-center">
            
            <form action="crear_macota.php" method="get">
                        <input type="hidden" name="id_cliente" value="<?php echo $clienteArray['idusuario']; ?>">
                        <button type="submit" class="btn btn-outline-success btn-lg">AGREGAR  MASCOTA</button>
                     </form>
            </div>
          </div>
        </div>
    </div>
</div>
</section>
<script>
$(document).ready(function() {
    $('#clientesTable').DataTable({
      "pageLength": 5,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
        }
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>

<?= endBody() ?>
</html>
