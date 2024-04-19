<?php
require_once('php/conexion.php');
if(!empty($_POST)){
    $idCliente = $_POST['idusuario'];
    //$query_delete= mysqli_query($conection,"DELETE FROM cliente WHERE idusuario =$idCliente");
    $query_update_cliente= mysqli_query($conection,"UPDATE cliente SET active =0 WHERE idusuario =$idCliente");
     if ($query_update_cliente) {
        // Actualizar el estado de las mascotas asociadas al cliente
        $query_update_mascotas = mysqli_query($conection, "UPDATE mascota SET active = 0 WHERE idusuarios = $idCliente");
          }
         if ($query_update_mascotas){
               header("location: usuarios.php");
           }else{
    echo"error";
   }
}
require_once ('template.php');
require_once('funtion/scripts.php');
// Verificar si se proporcionó un ID de cliente en la URL
if (empty($_GET['id_cliente'])) {
    header('Location: usuarios.php');
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
    'nombre' => $cliente['nombre'],
    'telefono' => $cliente['telefono'],
    'correo' => $cliente['correo'],
    'documento' => $cliente['documento']
);

?>

<!DOCTYPE html>
<html lang="en">
<?= Head('Eliminar') ?>
<?= starBody() ?>


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
<center><h2 class="custom-title">Eliminar Cliente - ID: <?php echo $idCliente; ?></h2></center>

<div class="container">
    <form  >
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="col-8">
                    <label for="nombre" class="form-label">Nombre completo:</label>
                    <input type="text" class="form-control" value="<?php echo $clienteArray['nombre']; ?>" readonly>
                </div>
                <div class="col-8">
                    <label for="telefono" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" value="<?php echo $clienteArray['telefono']; ?>" readonly>
                </div>
                <div class="col-8">
                    <label for="correo" class="form-label">Correo:</label>
                    <input type="email" class="form-control" value="<?php echo $clienteArray['correo']; ?>" readonly>
                </div>
                <div class="col-8">
                    <label for="documento" class="form-label">Documento:</label>
                    <input type="text" class="form-control" value="<?php echo $clienteArray['documento']; ?>" readonly>
                </div>
            
            </div>
        </div>
    </form>
    
  
</div>

<div>
    <br></br>
</div>
<div>
<form id="formulario" method="post" action="">
    <input type="hidden" name="idusuario" value="<?php echo $idCliente; ?>"/> 
    <a href="usuarios.php" class="btn_cancel">cancelar</a>
    <input type="submit" value="Confirmar eliminación" class="btn_ok"/> 
</form>
<div class="mt-3 text-right">
    <button onclick="window.location.href = 'editar.php'" class="btn btn-secondary">Volver a Usuarios</button>
</div>
<style>
    .btn_cancel {
        padding: 10px 20px;
        background-color: #f44336; /* Rojo */
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        margin-right: 10px; /* Espacio entre botones */
    }

    .btn_ok {
        padding: 10px 20px;
        background-color: #4CAF50; /* Verde */
        color: white;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
    }

    /* Estilos para el formulario */
    #formulario {
        display: flex;
        justify-content: center; /* Centra los botones horizontalmente */
        align-items: center; /* Centra los botones verticalmente */
        gap: 10px; /* Espacio entre elementos del formulario */
    }
</style>

    
  
</div>


<?= endBody() ?>
</html>


