<?php
require_once ('template.php');
require_once('funtion/scripts.php');
// Verificar si se proporcionó un ID de cliente en la URL
if (empty($_GET['id_cliente'])) {
    header('Location: ');
    exit; // Detener la ejecución del script 
}
// Obtener el ID del cliente de la URL
$idCliente = $_GET["id_cliente"];
// Realizar la consulta para obtener los detalles del cliente con el ID proporcionado
$conexion = new PDO("mysql:host=localhost;dbname=login_register","root","");
$stament = $conexion->prepare("SELECT * FROM cliente WHERE idusuario = :id");
$stament->bindParam(':id', $idCliente);
$stament->execute();
$cliente = $stament->fetch(PDO::FETCH_ASSOC);
// Verificar si se encontró el cliente
if (!$cliente) {
    echo "No se encontró ningún cliente con el ID proporcionado.";
    exit; // Detener la ejecución del script
}
// Convertir los detalles del cliente en un array
$clienteArray = array(
    'idusuario' => $cliente['idusuario'],
);
?>

<!DOCTYPE html>
<html lang="en">
<?=Head('registrar macota')?>

<?=starBody()?>
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
<center><h2 class="custom-title">REGISTRAR MASCOTA</h2></center>
<section>
    <div class="container">
<div class="card">
    <div class="card-body ">
        <h5 class="card-title text-center">Registrar Mascota</h5>
        <form id="formulario1" class="row g-3" method="post" action="consultas/crear_mascota.php" enctype="multipart/form-data">
            <!-- Columna para la imagen -->
 
               <div class="col-md-4">
                <div class="card rounded h-100">
                    
                    <div class="card-body d-flex flex-column justify-content-center align-items-center">
                    <div class="card rounded-circle text-center overflow-hidden" class="card-img-top rounded-circle mb-3" style="width: 305px; height: 305px;">
                    <img id="imagen-preview-mascota" src="#" alt="Preview de la imagen" class="card-img-top img-thumbnail w-100 h-100" style="object-fit: cover;">
                       </div>
                       <label for="imagen" class="form-label mt-3">Imagen:</label>
                       <input type="file" class="form-control mt-1" id="imagen-mascota" name="imagen" accept="image/*">
                        
                    </div>
                </div>
            </div>
 <!-- Columna para los otros campos --> 
            <div class="col-md-8">
                <div class="col-8">
                    <label for="nombre" class="form-label">Nombre completo:</label>
                    <input type="text" name="nombre" id="usuario" class="form-control form-control-lg" placeholder="Nombre completo" required>
                </div>
                <div class="col-8">
                    <label for="especie" class="form-label">Especie:</label>
                    <select name="especie" id="especie" class="form-control form-control-lg" required>
                        <!-- Aquí se mostrarán las opciones de las razas -->
                        <option value="1">Perro</option>
                        <option value="2">Gato</option>
                        <option value="3">Otro</option>
                    </select>
                </div>
                <div class="col-8">
                    <label for="raza" class="form-label">Raza:</label>
                    <select name="raza" id="raza" class="form-control form-control-lg" required>
                        <!-- Aquí se mostrarán las opciones de las razas -->
                        <option value="1">Labrador Retriever</option>
                        <option value="2">Bulldog Francés</option>
                        <option value="3">Golden Retriever</option>
                    <option value="4">Dálmata</option>
                    <option value="5">Persa</option>
                    <option value="6">Siames</option>
                    <option value="7">Maine Coon</option>
                    <option value="8">Siberiano</option>
                    <option value="9">Bengalí</option>
                    <option value="10">Scottish Fold</option>
                    <option value="11">otro</option>
                    <option value="12">Siames</option>
                    <option value="13">Maine Coon</option>
                    <option value="14">Siberiano</option>
                    <option value="15">Bengalí2</option>
                        <!-- Otras opciones -->
                    </select>
                </div>
                <div class="col-8">
                    <label for="documento" class="form-label">ID del Dueño</label>
                    <input type="text" name="documento" id="documento" class="form-control form-control-lg" placeholder="ID-Dueño" value="<?php echo $clienteArray["idusuario"]; ?>" required>
                </div>
                <div class="col-8">
                    <label for="peso" class="form-label">Peso:</label>
                    <input type="number" name="peso" id="peso" class="form-control form-control-lg" placeholder="Peso kg" required>
                </div>
                <div class="col-8">
                    <label for="sexo" class="form-label">Sexo:</label>
                    <select name="sexo" id="sexo" class="form-control form-control-lg" required>
                        <option value="macho">Macho</option>
                        <option value="hembra">Hembra</option>
                    </select>
                </div>
                <div class="col-8">
                    <label for="color" class="form-label">Color:</label>
                    <input type="text" name="color" id="color" class="form-control form-control-lg" placeholder="Color" required>
                </div>
                <div class="row">
                <div class="col-md-4">
                    <label for="edad" class="form-label">Edad:</label>
                    <input type="text" name="edad" id="direccion" class="form-control form-control-lg" placeholder="En Meses" required>
                    </div>
                    <div class="col-md-4">
                        <label for="edad" class="form-label">-</label>
                    <select name="edad" id="edad" class="form-control form-control-lg" required>
                        <option value="macho">meses</option>
                        <option value="hembra">años</option>
                    </select>
                    </div>
                </div>
                <div class="text-center mt-3">
                    
                    
                     <button onclick="window.location.href = 'editar.php'" class="btn btn-warning">Volver a Usuarios</button>
                     <button id="btnmascota" type="submit" class="btn btn-success mr-2">Guardar Datos</button>
                    
                </div>
                <div id="mensaje-exito"></div>
            </div>
        </form>
    </div>
</div>
</section>
</div>
    <script>
      document.getElementById("btnmascota").addEventListener("click", function(event) {
      event.preventDefault(); // Evitar el comportamiento predeterminado del botón submit

    // Obtener los datos del formulario
    var formData = new FormData(document.getElementById("formulario1"));

    // Enviar los datos del formulario usando AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "consultas/guardar_mascota.php");
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Manejar la respuesta del servidor
            var response = JSON.parse(xhr.responseText);
            if (response.exito) {
                // Mostrar mensaje de éxito
                document.getElementById("mensaje-exito").innerHTML = '<p style="color: green;">¡Los datos se han guardado correctamente!</p>';
                // Limpiar el formulario
                document.getElementById("formulario1").reset();
            } else {
                // Mostrar mensaje de error
                document.getElementById("mensaje-exito").innerHTML = '<p style="color: red;">Error al guardar los datos.</p>';
            }
        }
    };
     xhr.send(formData);
});
</script>       

    <script src="funtion/preview_imge_mascota.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<?=endBody()?>