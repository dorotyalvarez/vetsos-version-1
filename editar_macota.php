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
<center><h2 class="custom-title">Información Mascota</h2></center>


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
                <div class="mb-3">
              <label for="peso" class="form-label">peso kg:</label>
              <input type="text" name="peso" id="peso" class="form-control" value="<?php echo $fila['peso']; ?>" required>
                  </div>
                  <div class="mb-3">
              <label for="sexo" class="form-label">sexo</label>
              <select   name="sexo" id="sexo" class="form-control" value="<?php echo $fila['sexo']; ?>" required>
              
              <option value="macho">macho</option>
              <option value="hembra">hembra</option>
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
  <section>
    <div class="row">
      <div class="col-md-6">
      <div class="mt-3 text-center">
    <button onclick="window.location.href = 'editar.php'" class="btn btn-warning">Volver a Usuarios</button>
     </div>
      </div>
      <div class="col-md-6">
      <div class="mt-3 text-center">
<!-- Botón para abrir el modal -->
<button id="openModalBtn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Agregar recordatorio</button>
</div>
      </div>
    </div>
  </section>

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
          <!-- Campo oculto para el ID de la mascota -->
          <input type="hidden" id="idMascota" name="idMascota" value="<?php echo $id2; ?>">
          <div class="mb-3">
            <label for="textoRecordatorio" class="form-label">Texto del recordatorio:</label>
            <textarea class="form-control" id="textoRecordatorio" name="textoRecordatorio" rows="3"></textarea>
          </div>
          <div class="mb-3">
            <label for="fechaVencimiento" class="form-label">Fecha de vencimiento:</label>
            <input type="date" class="form-control" id="fechaVencimiento" name="fechaVencimiento">
          </div>

          <!-- Botón para enviar el formulario -->
          <button type="submit" class="btn btn-primary" id="guardarRecordatorioBtn">Guardar</button>
          <button type="button" class="btn btn-secondary text-center" data-bs-dismiss="modal">Cerrar</button>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!-- Agregar SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Esperar a que el DOM esté completamente cargado
  document.addEventListener('DOMContentLoaded', function() {
    // Agregar un listener al formulario para interceptar su envío
    document.getElementById('recordatorioForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Evitar el envío predeterminado del formulario

      // Obtener los datos del formulario
      var formData = new FormData(this);

      // Realizar una solicitud AJAX para enviar el formulario
      fetch('controllers/recordatorio.php', {
          method: 'POST',
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          // Mostrar el mensaje de éxito con SweetAlert2
          Swal.fire({
            title: 'Recordatorio guardado',
            text: '¡Tu recordatorio ha sido guardado correctamente!',
            icon: 'success',
            confirmButtonText: 'OK'
          }).then((result) => {
            // Cerrar el modal después de mostrar el mensaje de éxito
            var modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
            modal.hide();
          });
        })
        .catch(error => {
          console.error('Error al enviar el formulario:', error);
          // Mostrar un mensaje de error en caso de que falle la solicitud AJAX
          Swal.fire({
            title: 'Error',
            text: 'Ha ocurrido un error al guardar el recordatorio.',
            icon: 'error',
            confirmButtonText: 'OK'
          });
        });
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="funtion/preview_imagen.js"></script>
<script src="funtion/preview_imge_mascota.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?=endBody()?>
