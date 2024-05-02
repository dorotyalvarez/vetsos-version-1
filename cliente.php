<?php
require_once('funtion/scripts.php');
require_once('template.php');
require_once('php/conexion.php');
if ($errorOcurred) {
    redirectToErrorPage(404); // Por ejemplo, redirecciona a la página 404.html en caso de un error 404
}
?>
<!DOCTYPE html>
<html lang="en">
<?= Head('registrar') ?>
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
    color: green; /* Cambio de color del texto al pasar el cursor */
    border-bottom-color: #666; /* Cambio de color de la línea inferior al pasar el cursor */
  }
</style>
<!-- HTML con el título personalizado -->
<center><h2 class="custom-title">Registro de Clientes</h2></center>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }
        .card {
            max-width: 850px;
            margin: 50px auto;
            padding: 30px;
            border: 4px solid #ccc;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-label {
            font-weight: bold;
        }
        .btn {
            margin-top: 20px;
        }
    </style>
  <style>
        .custom-file-label {
            margin-top: 35px; /* Ajusta este valor según lo necesites */
        }
        .custom-file-input{
            margin-top: 50px;
        }
    </style>
    
<container>
    <body>
<div class="card">
    <h2 class="text-center mb-4">Formulario de Registro</h2>
    <form id="formulario" method="post" action="consultas/guardar_usuario.php" enctype="multipart/form-data">
        <!-- Columna para la imagen -->
        <div class="row g-3">
            <!-- Columna para los otros campos -->
            <div class="col-md-8">
                <div class="col-12">
                    <label for="nombre" class="form-label">Nombre completo:</label>
                    <input type="text" name="usuario" id="usuario" class="form-control form-control-lg" placeholder="Nombre completo" required>
                </div>
                <div class="col-12">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="number" name="telefono" id="telefono" class="form-control form-control-lg" placeholder="Teléfono" required>
                </div>
                <div class="col-12">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="email" name="correo" id="correo" class="form-control form-control-lg" placeholder="Correo electrónico" required>
                </div>
                <div class="col-12">
                    <label for="documento" class="form-label">Documento:</label>
                    <input type="number" name="documento" id="documento" class="form-control form-control-lg" placeholder="Documento"required>
                </div>
                <div class="col-12">
                    <label for="direccion" class="form-label">Dirección:</label>
                    <input type="text" name="direccion" id="direccion" class="form-control form-control-lg" placeholder="Dirección"required>
                </div>
                
                <div id="mensaje"></div>
            </div>
            <div class="col-md-4">
                <input type="file" class="custom-file-input" id="imagen" name="imagen" accept="image/*" >
                <label class="custom-file-label" for="imagen">Seleccionar archivo...</label>
                <div class="mt-3">
                    <img id="imagen-preview" src="#" alt="Preview de la imagen" class="card-img-top rounded-circle mb-2" style="width: 250px; height: 250px;">
                </div>
                <div class="text-center"> <!-- Aquí se aplica la clase text-center -->
                    <label class="form-label">Imagen Perfil</label>
                </div>
            </div>
        </div>
        <div class="mt-3 text-center">
                    <button id="btnGuardar" type="submit" class="btn btn-success">Guardar Datos</button>
                </div>
    </form>
</div>
<div class="mt-3 text-center">
    <button onclick="window.location.href = 'editar.php'" class="btn btn-warning">Volver a Usuarios</button>
</div>

</body>
    </container> 
    <div>
    <center><h2 class="custom-title">Registro de Mascotas</h2></center>
    </div>
<section>
    <div class="card">
       <h2 class="text-center mb-4">Formulario de Mascota</h2>
           <form id="formulario1"  method="post" action="consultas/guardar_mascota.php"  enctype="multipart/form-data">
              <!-- Columna para la imagen -->
              <div class="row g-3">
                 <div class="col-md-8">
                <div class="col-12">
                    <label for="nombre" class="form-label">Nombre completo:</label>
                    <input type="text" name="nombre" id="usuario" class="form-control form-control-lg" placeholder="Nombre completo" required>
                </div>
                <div class="col-12">
                    <label for="especie" class="form-label">Especie:</label>
                    <select name="especie" id="especie" class="form-control form-control-lg" required>
                    <!-- Aquí se mostrarán las opciones de las razas -->
                    <option value="1">Perro</option>
                    <option value="2">Gato</option>
                    <option value="3">Otro</option>
                </select>
                </div>
                <div class="col-12">
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
                <div class="col-12">
                    <label for="documentos" class="form-label">ID del Dueño</label>
                    <input type="number" name="documentos" id="documentos" class="form-control form-control-lg" placeholder="ID-Dueño"required>
                </div>
                <div class="col-12">
                    <label for="peso" class="form-label">Peso:</label>
                    <input type="text" name="peso" id="peso" class="form-control form-control-lg" placeholder="Peso en kilogramos"required>
                </div>
                <div class="col-12">
                    <label for="sexo" class="form-label">Sexo:</label>
                    <select name="sexo" id="sexo" class="form-control form-control-lg" required>
                    <option value="macho">Macho</option>
                    <option value="hermbra">hembra</option>
                </select>
                </div>
                <div class="col-12">
                    <label for="color" class="form-label">Color:</label>
                    <input type="text" name="color" id="color" class="form-control form-control-lg" placeholder="Color"required>
                </div>
                <div class="col-12">
                <label for="edad" class="form-label">Edad:</label>
                    <input type="text" name="edad" id="direccion" class="form-control form-control-lg" placeholder="Edad en Meses"required>
                </div>
                
                <div id="mensaje-exito"></div>           
            </div>
            <div class="col-md-4">
                <input type="file" class="custom-file-input" id="imagen-mascota" name="imagen" accept="image/*">
                <label class="custom-file-label" for="imagen">Seleccionar archivo...</label>
                <div class="mt-3">
                    <img id="imagen-preview-mascota" src="#" alt="Preview de la imagen" class="card-img-top rounded-circle mb-2" style="width: 250px; height: 250px;">
                </div>
            </div>
            </div>
            <div class="mt-3 text-center">
                    <button id="btnmascota" type="submit" class="btn btn-success">Guardar Datos</button>
                </div>
            </form>
         </div>
         <div id="mensaje-exito"></div> 
      </div>                    
    </section>
<!-- Declarar una variable global para almacenar el ID del registro -->
<script>
    var id_registro_guardado;
    document.getElementById("btnGuardar").addEventListener("click", function(event) {
        event.preventDefault(); // Evitar el comportamiento predeterminado de envío del formulario
        // Obtener los datos del formulario
        var formData = new FormData(document.getElementById("formulario"));
        // Enviar los datos del formulario usando AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "consultas/guardar_usuario.php");
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Manejar la respuesta del servidor
                var response = JSON.parse(xhr.responseText);
                if (response.exito) {
                    // Mostrar mensaje de éxito
                    document.getElementById("mensaje").innerHTML = '<p style="color: green;">¡Los datos se han guardado correctamente!</p>';
                    // Asignar el ID del registro a la variable global
                    id_registro_guardado = response.id_registro;
                    // Mostrar el ID del registro si está disponible
                    if (response.id_registro) {
                        document.getElementById("mensaje").innerHTML += '<p>ID del registro: ' + response.id_registro + '</p>';
                    }
                    // Asignar el ID del registro al campo de texto "documento"
                    document.getElementById("documentos").value = id_registro_guardado;
                    // Limpiar el formulario después de mostrar el mensaje
                    document.getElementById("formulario").reset();
                } else {
                    // Mostrar mensaje de error
                    document.getElementById("mensaje").innerHTML = '<p style="color: red;">Error al guardar los datos.</p>';
                }
            }
        };
        xhr.send(formData);
    });
</script>
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
<script src="funtion/preview_imagen.js"></script>
<script src="funtion/preview_imge_mascota.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?= endBody() ?>
