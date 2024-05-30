<!DOCTYPE html>
<html>
<?php
session_start();

// Verificar si el usuario está logueado
if (empty($_SESSION['active'])) {
    header("location: login.php"); // Redirigir al inicio de sesión si el usuario no está logueado
    exit; // Salir del script
}
// Verificar si el usuario tiene el rol adecuado
if ($_SESSION['id_rol'] != 2) {
    // Si el usuario no tiene el rol adecuado, redirigirlo a la página de error
    header("Location: 400.html");
    exit; // Salir del script
}



error_reporting(E_ALL);
require_once('funtion/scripts.php');
require_once(__DIR__ . '/consultas/estadistica.php');
$clientesActivos = obtenerClientesActivos();
$citasAtendidas = obtenerCitasAtendidas();
$citasPendientes = obtenerCitasPendientes();
$mensajesPendientes =obtenerMensajesPendientes();
$recordatoriosPendientes =obtenerRecordatoriosPendientes();
$totalMascotas= obtenerTotalMascotas();
$totaMensajesAtendidos = obtenerMensajesTotales();
$totaMensajes = obtenerTotalMensajes();


require_once(__DIR__ . '/consultas/notificaciones.php');

$recordatorios = consultarRecordatorios();

?>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>veterinaria sos</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
    <!-- CSS -->

    <link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
    <link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css" />
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="src/plugins/datatables/css/responsive.bootstrap4.min.css" />
    <link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
    <link rel="stylesheet" href="tablacss/estilo.css">

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/2.0.3/i18n/es-ES.json"
                }
            });
        });
    </script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"></script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2973766580778258" crossorigin="anonymous"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag("js", new Date());

        gtag("config", "G-GBZ3SGGX85");
    </script>
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                "gtm.start": new Date().getTime(),
                event: "gtm.js"
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != "dataLayer" ? "&l=" + l : "";
            j.async = true;
            j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, "script", "dataLayer", "GTM-NXZMQSS");
    </script>
    <!-- End Google Tag Manager -->
    <style>
        .bg-image {
            background-image: url('');
            background-size: 1960px 1200px;
            /* Ancho y alto deseados */
            background-position: center;
            /* Centra la imagen de fondo */
            background-repeat: no-repeat;
        }
    </style>
</head>

<body class="bg-image">
    <!-- Tu contenido HTML aquí -->

    <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="vendors/images/deskapp-logo.svg" alt="" />
                <!-- cambiar imagen crear una  -->
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div>

    <div class="header">
        <div class="header-left">
            <div class="menu-icon bi bi-list"></div>
            <div class="search-toggle-icon bi bi-search" data-toggle="header_search"></div>
            
        </div>
        <div class="header-right">
            <div class="text-center mt-4">

                <p id="hora">Barrancabermeja Santander <?php echo fechaC(); ?> </p>

            </div>
            <div class="dashboard-setting user-notification">
                <div class="dropdown">
                    <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                        <i class="dw dw-settings2"></i>
                    </a>
                </div>
            </div>
            <div class="user-notification">
    <div class="dropdown">
        <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
            <i class="icon-copy dw dw-notification"></i>
            <span class="badge notification-active"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <div class="notification-list mx-h-350 customscroll">
                <ul>
                    <?php
                    // Llamamos a la función para obtener los recordatorios
                    $recordatorios = consultarRecordatorios();

                    // Verificamos si hay recordatorios disponibles
                    if ($recordatorios !== null && count($recordatorios) > 0) {
                        // Iteramos sobre los recordatorios y los mostramos en la lista
                        foreach ($recordatorios as $recordatorio) {
                            echo '<li>';
                            echo '<a href="#">';
                            echo '<img src="vendors/images/icons8-recordatorios-de-citas.gif" alt="" />';
							echo '<h3> Mascota :' . $recordatorio['NombreMascota'] . '</h3>';
                            echo '<h3> Cliente :' . $recordatorio['nombre'] . '</h3>';
							echo '<p style="color: red;" > vence: ' . $recordatorio['fechaVencimiento'] . '</p>';
                            echo '<p> Mensaje :' . $recordatorio['textoRecordatorio'] . '</p>';
                            echo '<p> Fecha :' . $recordatorio['fechaCreacion'] . '</p>';
                            echo '</a>';
                            echo '</li>';
                        }
                    } else {
                        // Si no hay recordatorios, mostramos un mensaje indicando que no hay ninguno
                        echo '<li>No hay recordatorios disponibles</li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
            <div class="user-info-dropdown">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-icon">
                            <img src="vendors/images/1876759.png" alt="" />
                        </span>
                        <span class="user-name"><?php echo $_SESSION['nombre']; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="profile.php"><i class="dw dw-user1"></i> Profile</a>
                        <a class="dropdown-item" href=controllers/salir.php><i class="dw dw-logout"></i> Log Out</a>
                    </div>

                </div>

            </div>
            <div class="text-center mt-4">
                <?php
                if ($_SESSION['id_rol'] == 1) {
                    echo "<p> Administrador</p>";
                } elseif ($_SESSION['id_rol'] == 2) {
                    echo "<p> Usuario</p>";
                } elseif ($_SESSION['id_rol'] == 4) {
                    echo "<p> Doctor</p>";
                } else {
                    echo "<p>Rol no definido</p>";
                }
                ?>

            </div>
        </div>
    </div>

    <div class="right-sidebar">
        <div class="sidebar-title">
            <h3 class="weight-600 font-16 text-blue">
                Layout Settings
                <span class="btn-block font-weight-400 font-12">User Interface Settings</span>
            </h3>
            <div class="close-sidebar" data-toggle="right-sidebar-close">
                <i class="icon-copy ion-close-round"></i>
            </div>
        </div>
        <div class="right-sidebar-body customscroll">
            <div class="right-sidebar-body-content">
                <h4 class="weight-600 font-18 pb-10">Header Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-white active">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary header-dark">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
                <div class="sidebar-btn-group pb-30 mb-10">
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-light">White</a>
                    <a href="javascript:void(0);" class="btn btn-outline-primary sidebar-dark active">Dark</a>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
                <div class="sidebar-radio-group pb-10 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-1" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-1" checked="" />
                        <label class="custom-control-label" for="sidebaricon-1"><i class="fa fa-angle-down"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2" />
                        <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3" />
                        <label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i></label>
                    </div>
                </div>

                <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                <div class="sidebar-radio-group pb-30 mb-10">
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="" />
                        <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2" />
                        <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3" />
                        <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="" />
                        <label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5" />
                        <label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i></label>
                    </div>
                    <div class="custom-control custom-radio custom-control-inline">
                        <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6" />
                        <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i></label>
                    </div>
                </div>

                <div class="reset-options pt-30 text-center">
                    <button class="btn btn-danger" id="reset-settings">
                        Reset Settings
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="index.php">
                <img src="vendors/images/untitled1.svg" alt="" class="dark-logo" />
                <img src="vendors/images/untitled2.svg" alt="" class="light-logo" />
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li class="dropdown">
                        <a href="index.php" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-house"></span><span class="mtext">Home</span>
                        </a>

                    </li>

                    <li class="dropdown">
                        <a href="usuarios.php" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-archive"></span><span class="mtext">Usuarios</span>
                        </a>

                    </li>
                    <li>
                        <a href="calendar.php" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-calendar4-week"></span><span class="mtext">Calendario</span>
                        </a>
                    </li>
                    <li class="dropdown">
                        <a href="cliente.php" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-edit-2"></span><span class="mtext"> Mascota (Paciente) </span>
                        </a>

                    </li>

                    <li class="dropdown">
                        <a href="doctores.php" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-pie-chart"></span><span class="mtext">Doctores</span>
                        </a>

                    </li>
                  
                    <li class="dropdown">
                        <a href="javascript:;" class="dropdown-toggle">
                            <span class="micon bi bi-bug"></span><span class="mtext">Error Pages</span>
                        </a>
                        <ul class="submenu">
                            <li><a href="400.html">400</a></li>
                            <li><a href="403.html">403</a></li>
                            <li><a href="404.html">404</a></li>
                            <li><a href="500.html">500</a></li>
                            <li><a href="503.html">503</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a href="blank.html" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-back"></span><span class="mtext">Extra Pages</span>
                        </a>

                    </li>

                    <li>
                        <a href="citas_programadas.php" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-diagram-3"></span><span class="mtext">Citas Programadas</span>
                        </a>
                    </li>
                    <li>
                        <a href="mensaje.php" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-chat-right-dots"></span><span class="mtext">Chat</span>
                        </a>
                    </li>
                    <li>
                        <a href="invoice.html" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-receipt-cutoff"></span><span class="mtext">inventario</span>
                        </a>
                    </li>


                    <li>
                    <li>


                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>


    <!-- dividir aqui -->
    <style>
        .custom-title {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-right: -10%;
            font-size: 24px;
            color: green;
            border-bottom: 4px solid #ccc;
            padding-bottom: 10px;
        }

        .custom-title:hover {
            color: #666;
            /* Cambio de color del texto al pasar el cursor */
            border-bottom-color: #666;
            /* Cambio de color de la línea inferior al pasar el cursor */
        }
    </style>
    <section class="d-flex justify-content-between" style="margin-top: 80px;">
        <div class="container-fluid">
            <h2 class="custom-title">Bienvenido a Veterinaria SOS</h2>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <section class="d-flex justify-content-between">
        <div class="container mt-4">
            <div class="row mt-4">
                <div class="col-md-3">..</div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Buscar Clientes por Cédula</h5>
                            <!-- Formulario con AJAX -->
                            <form id="searchForm">
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" placeholder="Buscar por cédula..." class="search-toggle-icon bi bi-search" data-toggle="header_search" aria-label="Buscar por cédula..." id="searchInput" name="cedula">
                                    <div class="input-group-append">
                                    
                                        <button class="btn btn-primary" type="submit">Buscar</button>
                                    </div>
                                </div>
                            </form>
                            <!-- Fin del formulario con AJAX -->
                            <!-- Contenedor para mostrar los resultados -->
                            <div id="searchResults">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div id="clienteInfo"></div>
                                    </div>
                                    <div class="col-md-7">
                                        <ul id="mascotasList"></ul>
                                        <div id="registroUsuario" style="display: none;">
                                            <button class="btn btn-success" id="registrarUsuarioBtn">Registrar Cliente</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>

    <script>
        // Event listener para el formulario
        document.getElementById('searchForm').addEventListener('submit', function(event) {
            // Detener el comportamiento predeterminado del formulario
            event.preventDefault();
            // Obtener los datos del formulario
            const formData = new FormData(this);
            // Llamar a la función para realizar la búsqueda con AJAX
            searchClients(formData);
        });

        function searchClients(formData) {
            // Realizar la solicitud AJAX
            fetch('consultas/cedula.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    // Verificar si la respuesta es un JSON válido
                    if (!response.ok) {
                        throw new Error('El cliente no existe');
                    }
                    return response.json(); // Parsear la respuesta como JSON
                })
                .then(data => {
                    // Mostrar los resultados de la búsqueda en los contenedores correspondientes
                    document.getElementById('clienteInfo').innerHTML = `
                   <div class="cliente-info">
                     <h6>Cliente: ${data.nombre}</h6>
                        <div class="cliente-id">ID: ${data.id}</div>
                   </div>`;

                    const mascotasList = document.getElementById('mascotasList');
                    mascotasList.innerHTML = '<h6 >Mascotas</h6>';
                    data.mascotas.forEach(mascota => {
                        mascotasList.innerHTML += `
                     <li class="mascota-item row mb-4 align-items-start">
                         <div class="col-md-6 d-flex flex-column justify-content-between">
                             <div class="mascota-nombre">Nombre: ${mascota.nombre}</div>
                             <div><!-- Dejar este espacio vacío para el botón --></div>
                         </div>
                         <div class="col-md-5 d-flex flex-column justify-content-start align-items-end">
                             <button class="btn btn-success agendar-btn" data-cliente-id="${data.id}" data-mascota-id="${mascota.id}">Agendar Cita</button>
                         </div>
                     </li>`;
                    });

                    // Agregar el evento click a los botones de "Agendar Cita"
                    const agendarButtons = document.querySelectorAll('.agendar-btn');
                    agendarButtons.forEach(button => {
                        button.addEventListener('click', function() {
                            const clienteId = this.getAttribute('data-cliente-id');
                            const mascotaId = this.getAttribute('data-mascota-id');
                            window.location.href = `calendar.php?id_cliente=${clienteId}&id_mascota=${mascotaId}`;
                        });
                    });

                    // Mostrar el botón "Registrar Usuario"
                    document.getElementById('registroUsuario').style.display = 'block';
                })
                .catch(error => {
                    // Mostrar mensaje de error
                    document.getElementById('clienteInfo').innerHTML = '<p>EL CLIENTE no esta RGISTRADO</p>';
                    console.error('Error:', error);
                    // Ocultar el botón "Registrar Usuario"
                    document.getElementById('registroUsuario').style.display = 'block';
                });
        }

        // Event listener para el botón "Registrar Usuario"
        document.getElementById('registrarUsuarioBtn').addEventListener('click', function() {
            // Aquí puedes añadir la lógica para registrar un nuevo usuario
            // Por ejemplo, podrías redirigir a una página de registro
            window.location.href = 'cliente.php';
            alert('Funcionalidad de registro de usuario aún no implementada');
        });
    </script>


    <section class="d-flex justify-content-between" style="margin-top: 80px;">
        <div class="container-fluid">
            <h2 class="custom-title">Informacion de la semana</h2>
        </div>
    </section>

    <section class="d-flex justify-content-between">
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-2">.</div>
                <div class="col-md-3">
                    <div class="card bg-success">
                        <div class="card-body d-flex align-item-center justify-content-between">
                            clientes
                            <i class="bi bi-person-circle"></i>
                            
                        </div>
                        <div class="card-footer d-flex align-item-center justify-content-between">
                          Total: <?php echo $clientesActivos; ?>
                          <a href="usuarios.php" class="text-white">Ver detalles</a>

                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-info">
                        <div class="card-body d-flex align-item-center justify-content-between">
                            citas Atendidas     
                            <i class="bi bi-calendar-event-fill"></i>
                        </div>
                        <div class="card-footer d-flex align-item-center justify-content-between"> 
                            Total: <?php echo $citasAtendidas; ?>
                            <a href="citas_atendida.php" class="text-white">Ver detalles</a>

                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning">
                        <div class="card-body d-flex align-item-center justify-content-between">
                            citas pendiente
                            <i class="bi bi-bank"></i>
                        </div>
                        <div class="card-footer d-flex align-item-center justify-content-between">
                        <span><?php echo obtenerCitasPendientes(); ?></span>
                        <a href="citas_programadas.php" class="text-white">Ver detalles</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    

    <section class="d-flex ">
        <div class="container mt-4">
            <div class="row justify-content-end">
                <div class="col-md-1">.</div>
                <div class="col-md-2">
                    <div class="card bg-success">
                        <div class="card-body d-flex align-item-center justify-content-between">
                            pendientes totales
                            <i class="bi bi-chat-square-dots-fill"></i>
                        </div>
                        <div class="card-footer d-flex align-item-center justify-content-between">
                          Total: <?php echo $mensajesPendientes; ?>
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-danger">
                        <div class="card-body d-flex align-item-center justify-content-between">
                            recordatorios  totales   
                            <i class="bi bi-calendar-event-fill"></i>
                        </div>
                        <div class="card-footer d-flex align-item-center justify-content-between"> 
                            Total: <?php echo $recordatoriosPendientes; ?>
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-warning">
                        <div class="card-body d-flex align-item-center justify-content-between">
                            mascotas totales
                            <i class="bi bi-file-earmark-bar-graph"></i>
                        </div>
                        <div class="card-footer d-flex align-item-center justify-content-between">
                        <span><?php echo $totalMascotas; ?></span>
                       
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-warning">
                        <div class="card-body d-flex align-item-center justify-content-between">
                            mensajes atendidos
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <div class="card-footer d-flex align-item-center justify-content-between">
                        <span><?php echo $totaMensajesAtendidos ; ?></span>
                        
                        </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="card bg-warning">
                        <div class="card-body d-flex align-item-center justify-content-between">
                            total mensajes
                            <i class="bi bi-chat-right-heart-fill"></i>
                        </div>
                        <div class="card-footer d-flex align-item-center justify-content-between">
                        <span><?php echo $totaMensajes; ?></span>
                       
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <div class="container-fluid d-flex flex-column min-vh-100">
        <!-- Contenido principal -->
        <div class="row flex-grow-1">
            <div class="col">
                <div class="title pb-20 pt-20">
                    <h2 class="h3 mb-0">.</h2>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="row">
            <div class="col">
                <div class="footer-wrap bg-light">
                    <div class="card-footer text-muted text-center">
                        veterinaria sos todos los derechos reservados
                        <a href="https://github.com/dorotyalvarez" target="_blank">VETERINARIA SOS</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- welcome modal start -->
    <div class="welcome-modal">
        <button class="welcome-modal-close">
            <i class="bi bi-x-lg"></i>
        </button>
        <iframe class="w-100 border-0" src="https://embed.lottiefiles.com/animation/31548"></iframe>
        <div class="text-center">
            <h3 class="h5 weight-500 text-center mb-2">
                feliz dia
                <span role="img" aria-label="gratitude">❤️</span>
            </h3>
            <div class="pb-2">

            </div>
            <div class="text-center mb-1">
                <div>
                    <a>
                        <span class="text-danger weight-600">veterinario</span>
                        <span class="weight-600">FAVORITO</span>
                        <i class="fa fa-github"></i>
                    </a>
                </div>
                <script async defer="defer" src="#"></script>
            </div>

            <p class="font-14 text-center mb-1 d-none d-md-block">
                Quien ama a los animales ama al ser humano
            </p>
            <div class="d-none d-md-flex justify-content-center h1 mb-0 text-danger">
                <i class="fa fa-paw prints"></i>
            </div>
        </div>

        <!-- welcome modal end -->
        <!-- js -->
        <script src="funtion/actualizarhora.js"></script>
        <script src="vendors/scripts/core.js"></script>
        <script src="vendors/scripts/script.min.js"></script>
        <script src="vendors/scripts/process.js"></script>
        <script src="vendors/scripts/layout-settings.js"></script>
        <script src="src/plugins/apexcharts/apexcharts.min.js"></script>
        <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
        <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
        <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
        <script src="vendors/scripts/dashboard3.js"></script>
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

</body>

</html>