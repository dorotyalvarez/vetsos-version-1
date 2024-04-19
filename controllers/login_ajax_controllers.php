<?php
    require_once '../php/Conexion_BD.php';
   
    
$user_name= $_POST['user'];  
$pass= $_POST['pwd']; 

$conexion = new ConexionLogin();
$db = $conexion->conectar();

$sql = "SELECT * FROM usuarios WHERE user_name = '$user_name' AND password = '$pass'";

    $resultado = $db->query($sql);
    $usuarios_conteo= count($resultado->fetchAll(PDO::FETCH_ASSOC));
     if($usuarios_conteo==1){ 
           echo(1); //si el nombre de usuario y la contraseña son correctos 
        exit;
         }else{

            echo("Datos incorrectos ");
        
        
     }
    

    
    

 ?>