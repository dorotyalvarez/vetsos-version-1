<?php
require_once ('template.php');
require_once('funtion/scripts.php');
require_once('php/Conexion_BD.php'); // Incluir el archivo de conexión

// Verificar si se proporcionó un ID de cliente en la URL
if (empty($_GET['id_cliente'])) {
    header('Location: ');
    exit; // Detener la ejecución del script 
}

// Obtener el ID del cliente de la URL
$idCliente = $_GET["id_cliente"];

// Realizar la consulta para obtener los detalles del cliente con el ID proporcionado
$conexion = new conexionLogin(); // Crear una instancia de la clase de conexión
$db = $conexion->conectar(); // Conectarse a la base de datos

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

<!DOCTYPE html>
<html lang="en">
<?= Head('Actualizar Cliente') ?>
<?= starBody() ?>
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
<center><h2 class="custom-title">Editar Cliente</h2></center>

<section>
    <div class="container">
    <div class="col-md-4">
<button onclick="window.location.href = 'usuarios.php'" class="btn btn-outline-warning">Volver a Cliente</button>
   </div>
        <div class="row mt-4">
            <!-- Tarjeta para la imagen de perfil -->
            <div class="col-md-3">
                <div class="card border-dark mb-3">
                    <div class="card-body text-center">
                        <?php 
                        // Ruta del directorio donde se guardan las imágenes
                        $ruta_imagen = 'imgclientes/' . $clienteArray['imagen_perfil']; 
                        ?>
                        <img id="imagen-preview" src="<?php echo $ruta_imagen; ?>" alt="Imagen de perfil" class="img-thumbnail" style="max-width: 100%; max-height: 200px;">
                        <h5 class="card-title">Imagen de perfil</h5>
                        <p class="card-text">Última Modificación: <?php echo $clienteArray['fecha_actualizado']; ?></p>
                    </div>
                </div>
            </div>
            <!-- Tarjeta para los otros campos -->
            <div class="col-md-9">
                <div class="card border-dark mb-3">
                    <div class="card-body">
                        <form id="formulario" class="row g-3" method="post" action="" enctype="multipart/form-data">
                            <!-- Columna para los otros campos -->
                            <input type="hidden" name="idusuario" id="idusuario" value="<?php echo $clienteArray['idusuario']; ?>">
                            <div class="col-md-4">
                                <label for="nombre" class="form-label">Nombre completo:</label>
                                <input type="text" name="usuario" id="usuario" class="form-control form-control-lg" placeholder="Nombre completo" value="<?php echo $clienteArray['nombre']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="telefono" class="form-label">Teléfono:</label>
                                <input type="number" name="telefono" id="telefono" class="form-control form-control-lg" placeholder="Teléfono" value="<?php echo $clienteArray['telefono']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="correo" class="form-label">Correo:</label>
                                <input type="email" name="correo" id="correo" class="form-control form-control-lg" placeholder="Correo electrónico" value="<?php echo $clienteArray['correo']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="documento" class="form-label">Documento:</label>
                                <input type="number" name="documento" id="documento" class="form-control form-control-lg" placeholder="Documento" value="<?php echo $clienteArray['documento']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="direccion" class="form-label">Dirección:</label>
                                <input type="text" name="direccion" id="direccion" class="form-control form-control-lg" placeholder="Dirección" value="<?php echo $clienteArray['direccion']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="imagen" class="form-label">Imagen:</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                                <div class="mt-3">
                                    
                                </div>
                            </div>
                            <div class="col mt-4">
                                <div class="row justify-content-between">
                                    <div class="col-md-6">
                                        <button id="btnGuardar" type="submit" class="btn btn-outline-success btn-block">Actualizar Datos</button>
                                    </div>
                                   
                                </div>
                            </div>
                            
                        </form>
                        <div id="mensaje"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById("btnGuardar").addEventListener("click", function(event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado de envío del formulario
        
        // Obtener los datos del formulario
        var formData = new FormData(document.getElementById("formulario"));

        // Enviar los datos del formulario usando AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "consultas/actualizar_c.php");
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Manejar la respuesta del servidor
                var response = JSON.parse(xhr.responseText);
                if (response.exito) {
                    // Mostrar mensaje de éxito
                    document.getElementById("mensaje").innerHTML = '<p style="color: green;">¡Los datos se han guardado correctamente!</p>';
                    // Limpiar el formulario después de mostrar el mensaje
                    document.getElementById("formulario").reset();
                    // Redireccionar a editar.php después de 2 segundos
                    setTimeout(function() {
                        window.location.href = 'editar.php';
                    }, 2000); // Tiempo en milisegundos
                } else {
                    // Mostrar mensaje de error
                    document.getElementById("mensaje").innerHTML = '<p style="color: red;">Error al guardar los datos.</p>';
                }
            }
        };
        xhr.send(formData);
    });
</script>

  <script src="funtion/preview_imagen.js"></script>

<?= endBody() ?>
</html>

