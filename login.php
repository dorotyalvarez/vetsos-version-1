
<?php
$alert = '';
session_start();

if (empty($_SESSION['active'])) {
    if (!empty($_POST)) {
        if (empty($_POST['usuario']) || empty($_POST['clave'])) {
            $alert = "Ingrese su usuario y clave";
        } else {
            require_once "php/conexion.php";

            $user = mysqli_real_escape_string($conection, $_POST['usuario']);
            $pass = mysqli_real_escape_string($conection, $_POST['clave']);  // La contraseña sin hashear para verificar

            $query = mysqli_query($conection, "SELECT * FROM usuarios WHERE user_name = '$user'");
            $result = mysqli_num_rows($query);

            if ($result > 0) {
                $data = mysqli_fetch_array($query);
                
                // Verifica la contraseña usando md5 o password_verify
                if (md5($pass) === $data['password'] || password_verify($pass, $data['password'])) {
                    // Si la contraseña es correcta, iniciamos la sesión
                    $_SESSION['active'] = true;
                    $_SESSION['idUsuario'] = $data['idUsuario'];
                    $_SESSION['nombre'] = $data['nombre'];
                    $_SESSION['pass'] = $data['password'];
                    $_SESSION['apellido'] = $data['apellido'];
                    $_SESSION['identificacion'] = $data['identificacion'];
                    $_SESSION['email'] = $data['email'];
                    $_SESSION['id_rol'] = $data['id_rol'];

                    // Redirección basada en el rol del usuario
                    if ($_SESSION['id_rol'] == 1) {
                        header("Location: admin/index.php");
                        exit;
                    } elseif ($_SESSION['id_rol'] == 2) {
                        header("Location: index.php");
                        exit;
                    } elseif ($_SESSION['id_rol'] == 4) {
                        header("Location: doctor/index.php");
                        exit;
                    } else {
                        $alert = "Usuario o contraseña incorrectos.";
                        session_destroy();
                    }
                } else {
                    $alert = "Usuario o contraseña incorrectos.";
                    session_destroy();
                }
            } else {
                $alert = "Usuario o contraseña incorrectos.";
            }
        }
    }
} else {
    // Si el usuario ya está logueado, redirigirlo según su rol
    if ($_SESSION['id_rol'] == 1) {
        header("Location: admin/index.php");
        exit;
    } elseif ($_SESSION['id_rol'] == 2) {
        header("Location: index.php");
        exit;
    } elseif ($_SESSION['id_rol'] == 4) {
        header("Location: doctor/index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>



<body class="login-page">
    <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.php">
                    <img src="vendors/images/deskapp-logo.svg" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="register.html">Register</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="vendors/images/login-page-img.png" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Iniciar Sesión Veterinaria SOS</h2>
                        </div>
                                   <form action="" method="post"> 
                             
                                       <div class="input-group custom">
                                         <input type="text" name="usuario" id="usuario" class="form-control form-control-lg" placeholder="Username" />
                                         <div class="input-group-append custom">
                                              <span class="input-group-text"><i class="icon-copy dw dw-user1"></i
										         ></span>
                                         </div>
                                      </div>
                                       <div class="input-group custom">
                                         <input type="password" name="clave" id="clave" class="form-control form-control-lg" placeholder="**********" />
                                         <div class="input-group-append custom">
                                             <span class="input-group-text"><i class="dw dw-padlock1"></i
									         	></span>
                                         </div>
                                        
                                         
                                      </div>
							           <div class="alert"><?php echo isset ($alert)? $alert: ''; ?></div>
                                        <input class="btn btn-primary btn-lg btn-block" type="submit" value="INGRESAR"  >
                                 
							        </form> 
						      </div>
					</div>
				</div>
			</div>
		</div>
	

		
		<script src="vendors/scripts/core.js"></script>
		<script src=""> </script>
		
		<script src="vendors/scripts/layout-settings.js"></script>
		
		<!-- Google Tag Manager (noscript) -->
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
		
	</body>
</html>

           