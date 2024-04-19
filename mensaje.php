<?php
require_once('template.php');
require_once('consultas/consultar_mensajes.php');
?>

<!DOCTYPE html>
<html lang="en">
<?= Head('usuario') ?>
<?= starBody() ?>
<div>
    <h3 id="tituloVista">mensajes recibidos</h3>
    <br>
</div>
<div id="clientesTableContainer">
    <table id="clientesTable" class="display">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>correo</th>
                <th>Telefono</th>
                <th>fecha_creacion</th>
                <th>Acciones</th>
                <th></th>  <!-- Nuevo encabezado para acciones -->
            </tr>
        </thead>
        <tbody>
            <?php foreach ($mensaje as $mensaje): ?>
            <tr>
                <td><?php echo $mensaje['nombre'] ?></td>
                <td><?php echo $mensaje['correo'] ?></td>
                <td><?php echo $mensaje['telefono'] ?></td>
                <td><?php echo $mensaje['fecha_creacion'] ?></td>
                <td>
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $mensaje['id']; ?>">
                        <i class="bi bi-eye-fill"></i> mensaje
                    </button>
                </td>
                <td>
                    <button type="button" class="btn btn-success btn-atendido" data-id="<?php echo $mensaje['id']; ?>">Atendido</button>
                </td>
            </tr>

            <!-- Modal para cada mensaje -->
            <div class="modal fade" id="exampleModal_<?php echo $mensaje['id']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Detalles del mensaje</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Mensaje</h5>
                                    <p class="card-text"><?php echo $mensaje['mensaje']; ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del modal -->
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
$(document).ready(function() {
    try {
        $('#clientesTable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
            }
        });

        $('.btn-atendido').click(function() {
            var idMensaje = $(this).data('id');
            var botonAtendido = $(this);

            $.ajax({
                url: 'controllers/estado_estado.php',
                method: 'POST',
                data: { idMensaje: idMensaje, nuevoEstado: 2 },
                success: function(response) {
                    console.log(response);
                    // Quitar la fila de la tabla
                    botonAtendido.closest('tr').remove();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });
    } catch (error) {
        console.error('Error en la inicialización de DataTables:', error);
    }
});
</script>

</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?= endBody() ?>
