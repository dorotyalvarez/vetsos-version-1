<?php
require_once('../templete2.php');
require_once(__DIR__ . '/../php/Conexion_BD.php');


// Verifica si se pasaron los parámetros id y idmascota a través de la URL
if (isset($_GET['id']) && isset($_GET['idmascota'])) {
    // Si los parámetros están definidos, puedes acceder a sus valores
    $id_reserva = $_GET['id'];
    $id_mascota = $_GET['idmascota'];
} else {
    // Si los parámetros no están definidos, puedes mostrar un mensaje de error o tomar alguna otra acción
    echo "No se han pasado los parámetros id y idmascota en la URL.";
}
// Obtener el ID de la reserva de la URL
$id_reserva = $_GET["id"];
$id_mascota = $_GET["idmascota"];
$conexion = new conexionLogin();
$db = $conexion->conectar();
$query = "SELECT res.*, cli.nombre AS nombre_cliente, mas.nombre AS nombre_mascota, cat.nombre AS nombre_categoria, est.nombre AS nombre_estado
FROM reservas AS res
INNER JOIN cliente AS cli ON cli.idusuario = res.idusuario
INNER JOIN mascota AS mas ON mas.idmascota = res.idmascota
INNER JOIN categoria AS cat ON cat.idcategoria = res.idcategoria
INNER JOIN estado AS est ON est.idestado = res.idestado
WHERE res.id = :id_reserva";
$statement = $db->prepare($query);
$statement->bindParam(':id_reserva', $id_reserva, PDO::PARAM_INT);
$statement->execute();


// Verificar si la consulta fue exitosa
$reserva = $statement->fetch(PDO::FETCH_ASSOC);
$nombre_cliente=$reserva['nombre_cliente']; 

// Consulta para obtener todos los datos de la mascota, incluyendo la raza
$query_mascota = "SELECT mascota.*, raza.nombre AS nombre_raza 
                  FROM mascota 
                  INNER JOIN raza ON mascota.idraza = raza.idraza 
                  WHERE mascota.idmascota = :id_mascota";
$statement_mascota = $db->prepare($query_mascota);
$statement_mascota->bindParam(':id_mascota', $id_mascota, PDO::PARAM_INT);
$statement_mascota->execute();
$resultado_mascota = $statement_mascota->fetch(PDO::FETCH_ASSOC);



?>
<!DOCTYPE html>
<html lang="en">
<?= Head('atender') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="titulo.css">
<?= starBody() ?>

<!-- HTML con el título personalizado -->
<center><h2 class="custom-title">ATENCION</h2></center>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 border p-3"> <!-- Añade la clase border y p-3 para márgenes -->
                    <div class="text-center">
                        Fecha de la cita
                        <i class="bi bi-calendar-date-fill"></i>
                        <p class="card-text"> <?php echo $reserva['fecha_cita']; ?></p>
                    </div>
                </div>
                <div class="col-md-3 border p-3"> <!-- Añade la clase border y p-3 para márgenes -->
                    <div class="text-center">
                        Hora de la cita
                        <i class="bi bi-alarm"></i>
                        <p class="card-text"> <?php echo $reserva['hora_cita']; ?></p>
                    </div>
                </div>
                <div class="col-md-3 border p-3"> <!-- Añade la clase border y p-3 para márgenes -->
                    <div class="text-center">
                        Doctor
                        <i class="bi bi-heart-pulse"></i>
                        <p class="card-text"> <?php echo $_SESSION['nombre']; ?></p>
                    </div>
                </div>
                <div class="col-md-3 border p-3"> <!-- Añade la clase border y p-3 para márgenes -->
                    <div class="text-center">
                        Estado
                        <i class="bi bi-device-ssd"></i>
                        <p class="card-text"> <?php echo $reserva['nombre_estado']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container border border-solid">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2 border p-3"> <!-- Añade la clase border y p-3 para márgenes -->
                    <div class="text-center">
                        <div class="row mb-3 border-bottom">
                            <div class="col-md-12">
                                Nombre
                                <i class="bi bi-calendar-date-fill"></i>
                                <p class="card-text"> <?php echo $resultado_mascota['nombre']; ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                Raza
                                <i class="bi bi-alarm"></i>
                                <p class="card-text"> <?php echo $resultado_mascota['nombre_raza']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 border p-3">
                    <div class="text-center">
                        <!-- Primera fila: Peso -->
                        <div class="row mb-3 border-bottom"> <!-- Añade clase 'mb-3' y 'border-bottom' para separación vertical -->
                            <div class="col-md-12">
                                Peso
                                <i class="bi bi-alarm"></i>
                                <p class="card-text"> <?php echo $resultado_mascota['peso']; ?> kg</p>
                            </div>
                        </div>
                        <!-- Segunda fila: Edad -->
                        <div class="row">
                            <div class="col-md-12">
                                Edad
                                <i class="bi bi-device-ssd"></i>
                                <p class="card-text"> <?php echo $resultado_mascota['edad']; ?> meses</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2 border p-3"> <!-- Añade la clase border y p-3 para márgenes -->
                    <div class="text-center">
                        <div class="row mb-3 border-bottom">
                            <div class="col-md-12">
                                Sexo
                                <i class="bi bi-heart-pulse"></i>
                                <p class="card-text"> <?php echo $resultado_mascota['sexo']; ?></p>
                            </div>
                        </div>
                        Color
                        <i class="bi bi-device-ssd"></i>
                        <p class="card-text"> <?php echo $resultado_mascota['color']; ?></p>

                    </div>
                </div>
                <div class="col-md-2 border p-3"> <!-- Añade la clase border y p-3 para márgenes -->
                    <div class="text-center">
                        Dueño
                        <i class="bi bi-device-ssd"></i>
                        <p class="card-text"> <?php echo $reserva['nombre_cliente']; ?></p>
                        Tipo de cita
                        <i class="bi bi-device-ssd"></i>
                        <p class="card-text"> <?php echo $reserva['nombre_categoria']; ?></p>
                    </div>
                </div>
                <div class="col-md-4 border p-3"> <!-- Añade la clase border y p-3 para márgenes -->
                    <div class="text-center">
                        <?php
                        // Ruta del directorio donde se guardan las imágenes de las mascotas
                        $ruta_imagen_mascota = $resultado_mascota['imagen'];
                        ?>
                        <img src="<?php echo $ruta_imagen_mascota; ?>" alt="Imagen de la mascota" class="img-thumbnail rounded-circle mx-auto d-block" style="max-width: 100%; max-height: 100px;">
                        <div class="col-md-12 text-center">
                            <h6>Fecha Registro</h6>
                            <?php echo $resultado_mascota['fecha_creada']; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Atender Mascota</h5>
            <form id="formularioAtencion" method="post" action="historial.php" enctype="multipart/form-data">
                <input type="hidden" id="idMascota" name="idMascota" value="<?php echo $id_mascota; ?>">
                <input type="hidden" id="idMascota" name="idMascota" value="<?php echo $id_mascota; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hora">Hora de atención:</label>
                            <input type="time" class="form-control" id="hora" name="hora">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tratamiento">Tratamiento:</label>
                            <textarea class="form-control" id="tratamiento" name="tratamiento" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="medicamentos">Medicamentos:</label>
                            <input type="text" class="form-control" id="medicamentos" name="medicamentos">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="procedimiento">Procedimiento:</label>
                            <select class="form-control" id="procedimiento" name="procedimiento">
                                <option value="ecografia">ecografia</option>
                                <option value="cirugias">cirugias</option>
                                <option value="vacunacion">vacunacion</option>
                                <option value="odontologia">odontologia</option>
                                <option value="laboratorio clinico">laboratorio clinico</option>
                                <option value="RX">RX</option>
                                <option value="emogramas">emogramas</option>
                                <option value="parcial de orina">parcial de orina</option>
                                <option value="perfil bioquimico">perfil bioquimico</option>
                                <option value="examen de piel">examen de piel</option>
                                <option value="test rapido diasnostico">test rapido diasnostico</option>
                                <option value="peluqueria">peluqueria</option>
                                <option value="baño">baño</option>
                                <option value="corte de uñas">corte de uñas</option>
                                <option value="otro">otro</option>
                                <!-- Agrega más opciones según sea necesario -->
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="evidencia">Evidencia (opcional):</label>
                            <input type="file" class="form-control-file" id="evidencia" name="evidencia" accept="image/*, .pdf">

                        </div>
                    </div>
                </div>
                <button type="submit" id="enviarAtencion" class="btn btn-primary">Enviar</button>
            </form>

        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card"> 
                <div class="card-header">
                    
                    <button class="btn btn-outline-success" id="mostrarHistoriales" data-idmascota="<?php echo $id_mascota; ?>">Mostrar Historiales</button>
                    <button class="btn btn-outline-danger" id="cerrarHistoriales">Cerrar</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
    <div class="card"> 
        <div class="card-header">
            
            <button class="btn btn-outline-success" id="mostrarRecordatorios" data-idmascota="<?php echo $id_mascota; ?>">Mostrar recordatorios</button>
            <button class="btn btn-outline-danger" id="cerrarRecordatorios">Cerrar</button>
        </div>
    </div>
</div>  
<!-- Incluir librería de Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<div class="col-md-4">
    <div class="card"> 
        <div class="card-header">
            
            <button class="btn btn-outline-success" id="mostrarModalBtn" data-toggle="modal" data-target="#exampleModal">Agregar recordatorio</button>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar Recordatorio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar recordatorio -->
                <form id="recordatorioForm" action="recordatorio.php" method="post">
                <input type="hidden" id="idMascota" name="idMascota" value="<?php echo $id_mascota; ?>">
                    <div class="form-group">
                        <label for="textoRecordatorio">Texto del recordatorio:</label>
                        <textarea class="form-control" id="textoRecordatorio" name="textoRecordatorio" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="fechaVencimiento">Fecha de vencimiento:</label>
                        <input type="date" class="form-control" id="fechaVencimiento" name="fechaVencimiento" required>
                    </div>
                    <div class="form-group">
                            <label for="nombre">nombre dueño:</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                    
                    <!-- Botones del modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="container">
<div class="card">
    <div class="card-header">
        <h5 class="card-title">Detalles de la cita</h5>
    </div>
    <div class="card-body">
        <p class="card-text">Aquí puedes ver los detalles de la cita y realizar acciones.</p>
        <ul class="list-group">
            <li class="list-group-item">Cliente: <?php echo $reserva['nombre_cliente']; ?></li>
            <li class="list-group-item">Mascota: <?php echo $reserva['nombre_mascota']; ?></li>
            <li class="list-group-item">Tipo de cita: <?php echo $reserva['nombre_categoria']; ?></li>
            <li class="list-group-item">Fecha de cita: <?php echo $reserva['fecha_cita']; ?></li>
            <li class="list-group-item">Actividad: <?php echo $reserva['title']; ?></li>
            <li class="list-group-item">Hora: <?php echo $reserva['hora_cita']; ?></li>
            <li class="list-group-item">Estado: <?php echo $reserva['nombre_estado']; ?></li>
        </ul>
    </div>
    <div class="card-footer">
        <a href="#" class="btn btn-success btn-block btn-atender" data-id="<?php echo $reserva['id']; ?>"><i class="bi bi-pencil-square"></i>Finalizar Cita</a>
    </div>
</div>
</div>
<div class="container">
    <div id="historialesContainer"></div>
    <div id="recordatoriosContainer"></div>
</div>




<script>
  // Esperar a que el DOM esté completamente cargado
  document.addEventListener('DOMContentLoaded', function() {
    // Agregar un listener al formulario para interceptar su envío
    document.getElementById('recordatorioForm').addEventListener('submit', function(event) {
      event.preventDefault(); // Evitar el envío predeterminado del formulario

      // Obtener los datos del formulario
      var formData = new FormData(this);

      // Realizar una solicitud AJAX para enviar el formulario
      fetch('recordatorio.php', {
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(document).ready(function(){
    $(".btn-atender").click(function(e){
        e.preventDefault();
        var idReserva = $(this).data("id");
        
        $.ajax({
            url: "reserva_actualizar.php",
            type: "POST",
            data: { idReserva: idReserva },
            success: function(response){
                // Manejar la respuesta del servidor aquí
                console.log(response);
                // Mostrar mensaje de éxito con SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: '¡Cita atendida!',
                    text: 'La cita ha sido atendida correctamente.',
                    showConfirmButton: false,
                    timer: 1500
                }).then(function() {
                    // Redireccionar a citas_programadas.php
                    window.location.href = "citas_programadas.php";
                });
            },
            error: function(xhr, status, error){
                // Manejar errores de la petición AJAX aquí
                console.error(xhr.responseText);
            }
        });
    });
});
</script>
<script>
$(document).ready(function() {
    // Evento de clic en el botón para mostrar los recordatorios
    $('#mostrarRecordatorios').click(function() {
        // Obtener la ID de la mascota
        var idMascota = $(this).data('idmascota');
        
        // Realizar una solicitud AJAX para obtener los recordatorios de la mascota
        $.ajax({
            url: 'obtener_recordatorios.php',
            type: 'GET',
            data: { idmascota: idMascota },
            success: function(response) {
                // Insertar los recordatorios en el contenedor correspondiente
                $('#recordatoriosContainer').html(response);
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
    
    // Evento de clic en el botón para cerrar los recordatorios
    $('#cerrarRecordatorios').click(function() {
        // Limpiar el contenido del contenedor de recordatorios
        $('#recordatoriosContainer').empty();
    });
});
</script>

<script>
    $(document).ready(function() {
        // Escuchar el evento de clic en el botón de cerrar
        $('#cerrarHistoriales').click(function() {
            // Ocultar el contenedor de historiales
            $('#historialesContainer').hide();
        });

        // Escuchar el evento de clic en el botón de mostrar historiales
        $(document).on('click', '#mostrarHistoriales', function() {
            // Aquí puedes poner el código para cargar los historiales utilizando AJAX
            // Asegúrate de volver a mostrar el contenedor de historiales si estaba oculto
            $('#historialesContainer').show();
        });
    });
</script>





<script>
  $(document).ready(function() {
    $('#mostrarHistoriales').click(function() {
        // Obtener la ID de la mascota del botón
        var idMascota = $(this).data('idmascota');

        // Realizar una solicitud AJAX para obtener los historiales de la mascota específica
        $.ajax({
            url: 'obtener_historiales.php', // Ruta al script PHP que obtiene los historiales desde la base de datos
            type: 'GET',
            data: { idmascota: idMascota }, // Enviar la ID de la mascota como parámetro
            success: function(response) {
                // Mostrar los historiales en el contenedor
                $('#historialesContainer').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

</script>

<script>
    $(document).ready(function() {
        $('#formularioAtencion').submit(function(event) {
            // Evitar que el formulario se envíe de forma predeterminada
            event.preventDefault();

            // Crear un objeto FormData para enviar el formulario, incluidos los archivos adjuntos
            var formData = new FormData(this);

            // Enviar los datos del formulario de forma asincrónica utilizando AJAX
            $.ajax({
                url: 'historial.php',
                type: 'post',
                data: formData,
                processData: false, // Evitar el procesamiento de datos para permitir el envío de archivos
                contentType: false, // Evitar la configuración incorrecta del tipo de contenido
                success: function(response) {
                    // Verificar la respuesta del servidor en la consola del navegador
                    console.log(response);

                    // Verificar si la respuesta indica éxito
                    if (response) {
                        // Mostrar mensaje de éxito con SweetAlert2
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response,
                            showConfirmButton: false,
                            timer: 2000 // Mostrar el mensaje por 2 segundos
                        });

                        // Restablecer el formulario después de 2 segundos
                        setTimeout(function() {
                            $('#formularioAtencion')[0].reset();
                        }, 2000);

                        // Deshabilitar el formulario después de 2 segundos
                        setTimeout(function() {
                            $('#formularioAtencion input, #formularioAtencion textarea, #formularioAtencion select, #formularioAtencion button').prop('disabled', true);
                        }, 2000);
                    } else {
                        // Mostrar mensaje de error si la respuesta indica fallo
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Hubo un error al guardar los datos'
                        });
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?= endBody() ?>