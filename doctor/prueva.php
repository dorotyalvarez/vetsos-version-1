<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Recordatorio</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Botón para mostrar el modal -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card"> 
                    <div class="card-header">
                        <h3>Agregar Recordatorio</h3>
                        <button class="btn btn-outline-success" id="mostrarModalBtn">Agregar recordatorio</button>
                    </div>
                </div>
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
                    <form id="recordatorioForm" action="controllers/recordatorio.php" method="post">
                        <div class="form-group">
                            <label for="textoRecordatorio">Texto del recordatorio:</label>
                            <textarea class="form-control" id="textoRecordatorio" name="textoRecordatorio" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="fechaVencimiento">Fecha de vencimiento:</label>
                            <input type="date" class="form-control" id="fechaVencimiento" name="fechaVencimiento">
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

    <!-- Bootstrap JS y jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Agregar SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script para manejar el envío del formulario -->
    <script>
    $(document).ready(function() {
        // Escuchar el evento de clic en el botón para mostrar el modal
        $('#mostrarModalBtn').click(function() {
            // Mostrar el modal
            $('#exampleModal').modal('show');
        });

        // Escuchar el evento de envío del formulario
        $('#recordatorioForm').submit(function(event) {
            event.preventDefault(); // Evitar el envío predeterminado del formulario

            // Obtener los datos del formulario
            var formData = $(this).serialize();

            // Simular el envío del formulario (aquí puedes hacer la solicitud AJAX)
            // En este ejemplo, simplemente mostramos los datos en un mensaje de alerta
            Swal.fire({
                title: 'Datos del formulario',
                html: formData,
                icon: 'info',
                confirmButtonText: 'OK'
            });

            // Cerrar el modal después de mostrar la alerta
            $('#exampleModal').modal('hide');
        });
    });
    </script>
</body>
</html>
