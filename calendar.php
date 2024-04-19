<?php
require_once('template.php');

$id1 = isset($_GET['id1']) ? $_GET['id1'] : '';
$id2 = isset($_GET['id2']) ? $_GET['id2'] : '';
require_once 'php/Conexion_BD.php';

$conexion = new conexionLogin();
$db = $conexion->conectar();

$query_cliente = "SELECT nombre FROM cliente WHERE idusuario = :id1";
$statement_cliente = $db->prepare($query_cliente);
$statement_cliente->bindParam(':id1', $id1, PDO::PARAM_INT);
$statement_cliente->execute();
$resultado_cliente = $statement_cliente->fetch(PDO::FETCH_ASSOC);

// Consulta para obtener el nombre de la mascota
$query_mascota = "SELECT nombre FROM mascota WHERE idmascota = :id2";
$statement_mascota = $db->prepare($query_mascota);
$statement_mascota->bindParam(':id2', $id2, PDO::PARAM_INT);
$statement_mascota->execute();
$resultado_mascota = $statement_mascota->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<?= Head('citas') ?>
<!-- Modal -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
<script>
  var a;
  var id1 = '<?php echo $id1; ?>'; // Declaración de id1 con valor inicial de PHP
   var id2 = '<?php echo $id2; ?>'; // Declaración de id2 con valor inicial de PHP
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'es',
      editable: true,
      selectable: true,
      allDaySlot: false,
      events: 'controllers/cargar_reservas.php',
      dateClick: function(info) {
        a = info.dateStr;
        const fechaComoCadena = a;
        var numeroDia = new Date(fechaComoCadena).getDay();
        var dias = ['LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', "VIERNES"];
        if (numeroDia == "5") {
          Swal.fire({
                        title: 'Error',
                        text: 'no hay servicio los sabados.',
                            icon: 'error',
                        confirmButtonText: 'OK'
                     });
        } else if (numeroDia == "6") {
          Swal.fire({
                        title: 'Error',
                        text: 'no hay servicio domingos.',
                            icon: 'error',
                        confirmButtonText: 'OK'
                     });
        } else {
          var hoy = new Date();
                var dd = String(hoy.getDate()).padStart(2, '0'); // Agrega un 0 delante si el día es menor que 10
                var mm = String(hoy.getMonth() + 1).padStart(2, '0'); // Agrega un 0 delante si el mes es menor que 10
                var yyyy = hoy.getFullYear();

                  hoy = yyyy + '-' + mm + '-' + dd;

              if (hoy <= a) {  
                
                if (id1 === '' || id2 === '') {
                       Swal.fire({
                           title: 'Error',
                           text: 'Por favor, seleccione un cliente y una mascota antes de agendar una cita.',
                           icon: 'error',
                           confirmButtonText: 'OK'
                         });
                             return; // Salir de la función si no se han seleccionado usuario y mascota
                    }
                
                  $('#modal_reservas').modal("show");
                             $('#dia_de_la_semana').html(dias[numeroDia] + " " + a);
                          var fecha = info.dateStr;
                            var res = "";
                           var url = "controllers/verificar_horario.php";
                            $.get(url, {
                              fecha: fecha
                             }, function(datos) {

                                res = datos;
                           $('#respuesta_horario').html(res);


                              });


                        } else {
                          Swal.fire({
                        title: 'Error',
                        text: 'La fecha seleccionada es anterior a la fecha de hoy.',
                            icon: 'error',
                        confirmButtonText: 'OK'
                     });
                   }

        }

      },

    });
    calendar.render();
  });
</script>

<?= starBody() ?>
<h2>Reservar cita </h2>
<div id='calendar'></div>







<!-- Modal -->
<div class="modal fade" id="modal_reservas" tabindex="-1" data-backdrop="static" data-keyboard="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="exampleModalLabel">Reservar para el -- <span id="dia_de_la_semana"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body">
        <div class="row justify-content-center"> <!-- Aplica la clase justify-content-center aquí -->
          <div id="respuesta_horario"></div>
          <div class="col-md-6">
            <center><b style="margin-left: -80px;">Turno mañana</b></center>
            <br>
            <div class="d-grid gap-2">
              <button class="btn btn-success  mb-2" id="btn_h1" data-dismiss="modal" type="button">08:00 - 09:00</button>
              <button class="btn btn-success  mb-2 " id="btn_h2" data-dismiss="modal" type="button">09:00 - 10:00</button>
              <button class="btn btn-success  mb-2" id="btn_h3" data-dismiss="modal" type="button">10:00 - 11:00</button>
              <button class="btn btn-success  mb-2 " id="btn_h4" data-dismiss="modal" type="button">11:00 - 12:00</button>
            </div>
          </div>
          <div class="col-md-6">
            <center><b style="margin-left: -80px;">Turno tarde</b></center>
            <br>
            <div class="d-grid gap-2 ">
              <button class="btn btn-success  mb-2" id="btn_h5" data-dismiss="modal" type="button">02:00 - 03:00</button>
              <button class="btn btn-success  mb-2" id="btn_h6" data-dismiss="modal" type="button">03:00 - 04:00</button>
              <button class="btn btn-success  mb-2" id="btn_h7" data-dismiss="modal" type="button">04:00 - 05:00</button>
              <button class="btn btn-success  mb-2" id="btn_h8" data-dismiss="modal" type="button">05:00 - 06:00</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <a href="" class="btn btn-primary">
          Escoger otra Fecha
        </a>

      </div>
    </div>
  </div>
</div>


<!-- Modal 2 -->
<div class="modal fade" id="modal_formulario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reservar cita el dia <span id="dia_de_la_semana"></span></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="controllers/controller_reservas.php" method="post">
          <div class="row">
            <div class="col-md-6">
              <label for="nombre_mascota">Nombre mascota</label>
              <input type="text" class="form-control" value="<?php echo $resultado_mascota ? $resultado_mascota['nombre'] : 'No encontrado'; ?>" readonly>
              <input type="text" id="nombre_mascota" name="idmascota" value="<?php echo $id2; ?>" hidden>
            </div>
            <div class="col-md-6">
              <label for="title">actividad</label>
              <input type="text" name="title" class="form-control" id="title">
            </div>

          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <label for="servicio">Servicio</label>
              <select id="servicio" name="servicio" class="form-control">
                <option value="1">Cita clínica</option>
                <option value="2">Cita belleza</option>
                <option value="3">Otro</option>
              </select>
            </div>

            <div class="col-md-6">
              <label for="idcliente">dueño</label>
              <input type="text" class="form-control" value="<?php echo $resultado_cliente ? $resultado_cliente['nombre'] : 'No encontrado'; ?>" readonly>
              <input type="text" name="idcliente" id="idcliente" value="<?php echo $id1; ?>" hidden>

            </div>
          </div>
          <div class="row mt-3">
            <div class="col-md-6">
              <label for="fecha_reserva">Fecha de reserva</label>
              <input type="text" class="form-control" id="fecha_reserva" disabled>
              <input type="text" name="fecha_cita" class="form-control" id="fecha_reserva2" hidden>
            </div>
            <div class="col-md-6">
              <label for="hora_reserva">Hora de reserva</label>
              <input type="text" class="form-control" id="hora_reserva" disabled>
              <input type="text" name="hora_cita" class="form-control" id="hora_reserva2" hidden>
            </div>
          </div>


      </div>
      <!-- Mas datos -->

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary">Registar Cita </button>
      </div>
      </form>
    </div>
  </div>
</div>


<script>
  $('#btn_h1').click(function() {
    $('#modal_formulario').modal("show");
    $('#fecha_reserva').val(a);
    $('#fecha_reserva2').val(a);
    var h1 = "08:00 - 09:00";
    $('#hora_reserva').val(h1);
    $('#hora_reserva2').val(h1);
  });

  $('#btn_h2').click(function() {
    $('#modal_formulario').modal("show");
    $('#fecha_reserva').val(a);
    $('#fecha_reserva2').val(a);
    var h2 = "09:00 - 10:00";
    $('#hora_reserva').val(h2);
    $('#hora_reserva2').val(h2);


  });

  $('#btn_h3').click(function() {
    $('#modal_formulario').modal("show");
    $('#fecha_reserva').val(a);
    $('#fecha_reserva2').val(a);
    var h3 = "10:00 - 11:00";
    $('#hora_reserva').val(h3);
    $('#hora_reserva2').val(h3);


  });
  $('#btn_h4').click(function() {
    $('#modal_formulario').modal("show");
    $('#fecha_reserva').val(a);
    $('#fecha_reserva2').val(a);
    var h4 = "11:00 - 12:00";
    $('#hora_reserva').val(h4);
    $('#hora_reserva2').val(h4);

  });

  $('#btn_h5').click(function() {
    $('#modal_formulario').modal("show");
    $('#fecha_reserva').val(a);
    $('#fecha_reserva2').val(a);
    var h5 = "02:00 - 03:00";
    $('#hora_reserva').val(h5);
    $('#hora_reserva2').val(h5);

  });

  $('#btn_h6').click(function() {
    $('#modal_formulario').modal("show");
    $('#fecha_reserva').val(a);
    $('#fecha_reserva2').val(a);
    var h6 = "03:00 - 04:00";
    $('#hora_reserva').val(h6);
    $('#hora_reserva2').val(h6);


  });

  $('#btn_h7').click(function() {
    $('#modal_formulario').modal("show");
    $('#fecha_reserva').val(a);
    $('#fecha_reserva2').val(a);
    var h7 = "04:00 - 05:00";
    $('#hora_reserva').val(h7);
    $('#hora_reserva2').val(h7);


  });

  $('#btn_h8').click(function() {
    $('#modal_formulario').modal("show");
    $('#fecha_reserva').val(a);
    $('#fecha_reserva2').val(a);
    var h8 = "05:00 - 06:00";
    $('#hora_reserva').val(h8);
    $('#hora_reserva2').val(h8);


  });
</script>

<?php


if (isset($_SESSION['mensaje'])) {
  // Mostrar SweetAlert2 en lugar de un alert tradicional
  echo "<script>
            Swal.fire({
                title: '¡Éxito!',
                text: '" . $_SESSION['mensaje'] . "',
                icon: '" . $_SESSION['tipo_mensaje'] . "',
                confirmButtonText: 'Entendido'
            });
          </script>";
  unset($_SESSION['mensaje']); // Limpia el mensaje después de mostrarlo
  unset($_SESSION['tipo_mensaje']); // Limpia el tipo de mensaje también
}


?>


<?= endBody() ?>