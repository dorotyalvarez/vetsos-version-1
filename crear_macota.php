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

<div class="mt-3 text-right">
    <button onclick="window.location.href = 'editar.php'" class="btn btn-secondary">Volver a Usuarios</button>
</div>

<h1>registar mascota </h1>
<div class="container">
        <form id="formulario1" class="row g-3" method="post" action="consultas/crear_mascota.php" enctype="multipart/form-data">
            <!-- Columna para la imagen -->
            <div class="col-md-4">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control" id="imagen-mascota" name="imagen" accept="image/*">
                <div class="mt-3">
                    <img id="imagen-preview-mascota" src="#" alt="Preview de la imagen" class="img-thumbnail" style="max-width: 100%; max-height: 200px;">
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
                   

                    <!-- Puedes incluir más opciones aquí -->
                </select>
                </div>
                <div class="col-8">
                    <label for="documento" class="form-label">ID del Dueño</label>
                    <input type="text" name="documento" id="documento" class="form-control form-control-lg" placeholder="ID-Dueño" value="<?php echo $clienteArray["idusuario"]; ?>" required>
                </div>
                
                <div class="col-8">
                    <label for="peso" class="form-label">peso:</label>
                    <input type="text" name="peso" id="peso" class="form-control form-control-lg" placeholder="Peso kg"required>
                </div>
                <div class="col-8">
                    <label for="sexo" class="form-label">sexo:</label>
                    <select name="sexo" id="sexo" class="form-control form-control-lg" required>
                    <option value="macho">Macho</option>
                    <option value="hermbra">hembra</option>
                </select>
                </div>
                <div class="col-8">
                    <label for="color" class="form-label">color:</label>
                    <input type="text" name="color" id="color" class="form-control form-control-lg" placeholder="Color"required>
                </div>
                <div class="col-8">
                    <label for="edad" class="form-label">edad:</label>
                    <input type="text" name="edad" id="direccion" class="form-control form-control-lg" placeholder="Edad en meses"required>
                </div>
                <div class="text-center mt-3">
  <button id="btnmascota" type="submit" class="btn btn-success mr-2">Guardar Datos</button>
  <button onclick="window.location.href = 'editar.php'" class="btn btn-secondary ml-2">Volver a Usuarios</button>
</div>

                  
                <div id="mensaje-exito"></div>
              
            </div>
        </form>
        
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