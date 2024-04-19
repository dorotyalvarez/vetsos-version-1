<?php
require_once ('template.php');
$id1 = $_GET['id1'];
$id2 = $_GET['id2'];
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Ahora puedes usar $id1 y $id2 en tu script de PHP como lo necesites.
require_once('php/conexion.php'); //Conecta a la base de datos

// Consultar los datos de la mascota
$query = "SELECT m.nombre AS nombre_mascota, m.idespecie, m.idraza, c.nombre AS nombre_usuario, m.peso, m.sexo, m.color, m.edad, m.imagen, m.fecha_creada
          FROM mascota m
          JOIN cliente c ON m.idusuarios = c.idusuario
          WHERE m.idmascota = $id2";

$resultado = mysqli_query($conection, $query);

if ($resultado) {
    $fila = mysqli_fetch_assoc($resultado);
    // Rellenar los campos del formulario con la información recuperada de la base de datos
    $nombre_mascota = $fila['nombre_mascota'];
    $idespecie = $fila['idespecie'];
    $idraza = $fila['idraza'];
    $peso = $fila['peso'];
    $sexo = $fila['sexo'];
    $color = $fila['color'];
    $edad = $fila['edad'];
    $imagen = $fila['imagen'];
    $fecha= $fila['fecha_creada'];
}

// Procesar el formulario cuando se envíe
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_mascota = $_POST['nombre_mascota'];
    $idespecie = $_POST['especie'];
    $idraza = $_POST['raza'];
    $peso = $_POST['peso'];
    $sexo = $_POST['sexo'];
    $color = $_POST['color'];
    $edad = $_POST['edad'];

    // Actualizar los datos en la base de datos
    $query = "UPDATE mascota SET nombre = '$nombre_mascota', idespecie = '$idespecie', idraza = '$idraza', peso = '$peso', sexo = '$sexo', color = '$color', edad = '$edad' WHERE idmascota = $id2";
    $resultado = mysqli_query($conection, $query);

    if ($resultado) {
        $mensaje = "Los datos se han actualizado correctamente.";
    } else {
        $mensaje = "Error al actualizar los datos.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<?=Head('Editar M')?>

<?=starBody()?>
<div class="mt-3 text-right">
    <button onclick="window.location.href = 'editar.php'" class="btn btn-secondary">Volver a Usuarios</button>
</div>
<div class="container my-8">
  <div class="card" style="max-width: 1600px;">
    <div class="row g-0">
      <!-- Columna de la imagen de la mascota -->
      <div class="col-md-3">
        <div class="card-body">
          <div class="card">
          <div class="mt-3">
                    <?php 
                    // Ruta del directorio donde se guardan las imágenes
                    $ruta_imagen = 'imgmacotas/' . $fila['imagen']; 
                    ?>
                  
                    <img id="imagen-preview" src="<?php echo $ruta_imagen; ?>" alt="Imagen de perfil" class="img-thumbnail" style="max-width: 100%; max-height: 200px;">
                    <div class="col-md-12 text-center">
                    <h6>Fecha Registro</h6>
                    <?php echo $fila['fecha_creada']; ?>
                   </div>
                  </div>
          </div>
        </div>
        
      </div>
      <!-- Columna del formulario -->
      <div class="col-md-9">
        <div class="card-body">
          <h5 class="card-title justify-content-center align-items-center" >Perfil de la Mascota</h5>
          <form id="formulario" class="row g-3" method="post" action="">
          <input type="hidden" name="idMascota" value="<?php echo $id2; ?>">
            <div class="row">
              <!-- Primera parte del formulario -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="imagen-mascota" class="form-label">mantenimiento</label>
                  <input type="file" class="form-control" id="imagen-mascota" name="imagen" accept="image/*">
                </div>
                <div class="mb-3">
                  <label for="nombre_mascota" class="form-label">Nombre Mascota:</label>
                  <input type="" name="nombre_mascota" id="nombre_mascota" class="form-control" value="<?php echo $fila['nombre_mascota']; ?>" required>
                </div>
                <div class="mb-3">
                  <label for="especie" class="form-label">Especie:</label>
                  <select name="especie" id="especie" class="form-control" required>
                <option value="1">Perro</option>
                <option value="2">Gato</option>
                <option value="3">Otro</option>
                  </select>
                </div>
                <!-- Agregar más campos de la primera parte del formulario si es necesario -->
                <div class="mb-3">
              <label for="edad" class="form-label">Edad</label>
              <input type="text" name="edad" id="edad" class="form-control" value="<?php echo $fila['edad']; ?>" required>
            </div>
              </div>
              <!-- Segunda parte del formulario -->
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="raza" class="form-label">Raza:</label>
                  <select name="raza" id="raza" class="form-control" required>
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
                <!-- Agrega más opciones de razas aquí -->
                  </select>
                </div>
                <!-- No incluyas el campo del nombre del usuario -->
                <!-- Agregar más campos de la segunda parte del formulario si es necesario -->
                <div class="mb-3">
              <label for="peso" class="form-label">peso kg:</label>
              <input type="text" name="peso" id="peso" class="form-control" value="<?php echo $fila['peso']; ?>" required>
                  </div>
                  <div class="mb-3">
              <label for="sexo" class="form-label">sexo</label>
              <select   name="sexo" id="sexo" class="form-control" value="<?php echo $fila['sexo']; ?>" required>
              
              <option value="1">macho</option>
              <option value="2">hembra</option>
              </select>
              </div>
              <div class="mb-3">
              <label for="color" class="form-label">Color</label>
              <input type="text" name="color" id="color" class="form-control" value="<?php echo $fila['color']; ?>" required>
                </div>
                 </div>
                 </div>
                 <div class="container">
                <div class="row">
               <div class="col-6 d-flex justify-content-end">
                     <button id="btnGuardar" type="submit" class="btn btn-success">Actualizar Datos</button>
                   </div>
                  <div class="col-6 d-flex justify-content-start">
                  <button id="btnEliminar" class="btn btn-danger" onclick="eliminarMascota()">Eliminar Mascota</button>
                     </div>
                     </div>
                </div>
                <div id="mensaje"><?php echo isset($mensaje) ? $mensaje : ''; ?></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div>
  <br></br>
</div>
<!-- citas -->
<div class="container-fluid bg-light py-3">
  <div class="row justify-content-between align-items-center">
    <div class="col-md-6">
      <h3 class="m-0">Tus Citas</h3>
    </div>
    <div class="col-md-6 text-md-right">
      <button class="btn btn-primary">Agregar cita</button>
    </div>
  </div>
</div>
<div>
  <br></br>
</div>
<!-- recordatorio -->
<!-- Botón para abrir el modal -->
<button id="openModalBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar recordatorio</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Recordatorio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Formulario para ingresar texto -->
        <form id="recordatorioForm" action="controllers/recordatorio.php" method="post">
          <div class="mb-3">
            <label for="textoRecordatorio" class="form-label">Texto del recordatorio:</label>
            <textarea class="form-control" id="textoRecordatorio" name="textoRecordatorio" rows="3"></textarea>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <!-- Botón para cerrar el modal -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        <!-- Botón para enviar el formulario -->
        <button type="submit" form="recordatorioForm" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>


<script>
  // Esperar a que el DOM esté completamente cargado
  document.addEventListener('DOMContentLoaded', function() {
    // Obtener el botón de abrir modal
    var openModalBtn = document.getElementById('openModalBtn');
    
    // Agregar un listener al botón para abrir el modal al hacer clic
    openModalBtn.addEventListener('click', function() {
      var myModal = new bootstrap.Modal(document.getElementById('exampleModal'));
      myModal.show();
    });
  });
</script>















<script>
    function eliminarMascota() {
        if (confirm('¿Estás seguro de que quieres eliminar esta mascota?')) {
            var idMascota = <?php echo $id2; ?>;
            // Realizar una petición AJAX para actualizar el estado de la mascota
            $.ajax({
                type: 'POST',
                url: 'eliminar_mascota.php',
                data: { idMascota: idMascota },
                success: function(response) {
                    if (response.success) {
                        // Mostrar un mensaje de éxito al usuario
                        alert('Mascota eliminada correctamente.');
                        // Redirigir a editar.php después de la eliminación
                        window.location.href = 'editar.php';
                    } else {
                        alert('Error al eliminar la mascota.');
                    }
                },
                error: function() {
                    alert('Error al eliminar la mascota. Inténtalo de nuevo más tarde.');
                }
            });
        }
    }
</script>



<script src="funtion/preview_imagen.js"></script>
<script src="funtion/preview_imge_mascota.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?=endBody()?>
