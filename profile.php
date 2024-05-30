<?php

require_once('template.php');



// Obtener el ID de la sesión, suponiendo que se almacena en $_SESSION['idUsuario']
$id = isset($_SESSION['idUsuario']) ? $_SESSION['idUsuario'] : null;
$rol = isset($_SESSION['id_rol']) ? $_SESSION['id_rol'] : null;

// Verificar si el usuario tiene el rol adecuado
if ($rol != 2) {
    // Si el usuario no tiene el rol adecuado, redirigirlo a la página de error
    header("Location: 400.html");
    exit; // Salir del script
}

require_once 'php/Conexion_BD.php';

$conexion = new conexionLogin();
$db = $conexion->conectar();

// Modificar la consulta para traer todos los datos de la tabla usuarios
$query_usuario = "SELECT * FROM usuarios WHERE idusuario = :id";
$statement_usuario = $db->prepare($query_usuario);
$statement_usuario->bindParam(':id', $id, PDO::PARAM_INT);
$statement_usuario->execute();
$usuario = $statement_usuario->fetch(PDO::FETCH_ASSOC);
$usuarioarray = array(
    'idUsuario' => $usuario['idUsuario'],
    'nombre' => $usuario['nombre'],
    'user_name' => $usuario['user_name'],
    'password' => $usuario['password'],
    'apellido' => $usuario['apellido'],
    'identificacion' => $usuario['identificacion'],
    'email' => $usuario['email'],
    'id_rol' => $usuario['id_rol'],
    'imagen_perfil' => $usuario['imagen_perfil'],
);
?>

<!DOCTYPE html>
<html lang="en">

<?= Head('Actualizar') ?>
<?= starBody() ?>

<style>
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
        color: #666;
        border-bottom-color: #666;
    }
</style>

<!-- HTML con el título personalizado -->
<center>
    <h2 class="custom-title">Editar Cliente</h2>
</center>

<section>
    <div class="container">
        <div class="row mt-4">
            <!-- Tarjeta para la imagen de perfil -->
            <div class="col-md-3">
                <div class="card border-dark mb-3">
                    <div class="card-body text-center">
                        <?php
                        // Ruta del directorio donde se guardan las imágenes
                        $ruta_imagen = 'imgclientes/' . $usuarioarray['imagen_perfil'];
                        ?>
                        <img id="imagen-preview" src="<?php echo $ruta_imagen; ?>" alt="Imagen de perfil" class="img-thumbnail" style="max-width: 100%; max-height: 200px;">
                        <h5 class="card-title">Imagen de perfil</h5>

                    </div>
                </div>
            </div>
            <!-- Tarjeta para los otros campos -->
            <div class="col-md-9">
                <div class="card border-dark mb-3">
                    <div class="card-body">
                        <form id="formulario" class="row g-3" method="post" action="" enctype="multipart/form-data">
                            <!-- Columna para los otros campos -->
                            <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $usuarioarray['idUsuario']; ?>">
                            <div class="col-md-4">
                                <label for="nombre" class="form-label">Nombre completo:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" placeholder="Nombre completo" value="<?php echo $usuarioarray['nombre']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="telefono" class="form-label">Apellido:</label>
                                <input type="text" name="apellido" id="apellido" class="form-control form-control-lg" placeholder="apellido" value="<?php echo $usuarioarray['apellido']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="email" class="form-label">Correo:</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Correo electrónico" value="<?php echo $usuarioarray['email']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="identificacion" class="form-label">Documento:</label>
                                <input type="number" name="identificacion" id="identificacion" class="form-control form-control-lg" placeholder="Documento" value="<?php echo $usuarioarray['identificacion']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="id_rol" class="form-label">Rol:</label>
                                <input type="text" name="id_rol" id="id_rol" class="form-control form-control-lg" placeholder="Dirección" value="<?php echo $usuarioarray['id_rol']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label for="imagen" class="form-label">Imagen:</label>
                                <input type="file" class="form-control" id="imagen" name="imagen" accept="image/*">
                                <div class="mt-3"></div>
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
                <div class="col-md-12">
                    <div class="card border-dark mb-3">
                        <div class="card-body">
                            <form id="formCambioContrasena" method="post" action="consultas/cambiar_contrasena.php">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="contrasena_actual" class="form-label">Contraseña actual</label>
                                            <input type="password" class="form-control" id="contrasena_actual" name="contrasena_actual" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="nueva_contrasena" class="form-label">Nueva contraseña</label>
                                            <input type="password" class="form-control" id="nueva_contrasena" name="nueva_contrasena" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="confirmar_contrasena" class="form-label">Confirmar nueva contraseña</label>
                                            <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col mt-4">
                                    <div class="row justify-content-between">
                                        <div class="col-md-6">
                                            <button id="btnCambiarContrasena" type="submit" class="btn btn-outline-primary btn-block">Cambiar contraseña</button>
                                        </div>
                                    </div>
                                </div>

                                <div id="mensaje1" class="mt-3"></div>
                            </form>
                        </div>
                    </div>
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
        xhr.open("POST", "consultas/actualizar_usuario.php");
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Manejar la respuesta del servidor
                var response = JSON.parse(xhr.responseText);
                if (response.exito) {
                    // Mostrar mensaje de éxito
                    document.getElementById("mensaje").innerHTML = '<p style="color: green;">¡Los datos se han guardado correctamente!</p>';
                    // Limpiar el formulario después de mostrar el mensaje
                    document.getElementById("formulario").reset();
                    // También podrías ocultar el formulario si lo deseas
                    document.getElementById("formulario").style.display = "none";
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


<script>
    document.getElementById("formCambioContrasena").addEventListener("submit", function(event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado de envío del formulario

        // Obtener los datos del formulario
        var formData = new FormData(this); // 'this' hace referencia al formulario actual

        // Enviar los datos del formulario usando AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "consultas/cambiar_contrasena.php");
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Manejar la respuesta del servidor
                var response = xhr.responseText;
                document.getElementById("mensaje1").innerHTML = response;
            }
        };
        xhr.send(formData);
    });
</script>





<?= endBody() ?>