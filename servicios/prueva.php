<?php
require_once ('template.php');
?>
<!DOCTYPE html>
<html lang="en">
<?=Head('vetsos')?>

<?=starBody()?>

<h1>hola mundo</h1>
<?=endBody()?>

<!DOCTYPE html>
<html>

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
</head>

<body>
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
            <div class="header-search">
                <form>
                    <div class="form-group mb-0">
                        <i class="dw dw-search2 search-icon"></i>
                        <input type="text" class="form-control search-input" placeholder="Search Here" />
                        <div class="dropdown">
                            <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                                <i class="ion-arrow-down-c"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">From</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">To</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input class="form-control form-control-sm form-control-line" type="text" />
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Subject</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>

									</div>
									<div class="text-right">
										<button class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="header-right">
				<div class="dashboard-setting user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="javascript:;"
							data-toggle="right-sidebar"
						>
							<i class="dw dw-settings2"></i>
						</a>
					</div>
				</div>
				<div class="user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<i class="icon-copy dw dw-notification"></i>
							<span class="badge notification-active"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">
								<ul>
									<li>
										<a href="#">
											<img src="vendors/images/img.jpg" alt="" />
											<h3>John Doe</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo1.jpg" alt="" />
											<h3>Lea R. Frith</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo2.jpg" alt="" />
											<h3>Erik L. Richards</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo3.jpg" alt="" />
											<h3>John Doe</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/photo4.jpg" alt="" />
											<h3>Renee I. Hansen</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
									<li>
										<a href="#">
											<img src="vendors/images/img.jpg" alt="" />
											<h3>Vicki M. Coleman</h3>
											<p>
												Lorem ipsum dolor sit amet, consectetur adipisicing
												elit, sed...
											</p>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<img src="vendors/images/photo1.jpg" alt="" />
							</span>
							<span class="user-name">Ross C. Lopez</span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="profile.html"
								><i class="dw dw-user1"></i> Profile</a
							>
							<a class="dropdown-item" href="profile.html"
								><i class="dw dw-settings2"></i> Setting</a
							>
							<a class="dropdown-item" href="faq.html"
								><i class="dw dw-help"></i> Help</a
							>
							<a class="dropdown-item" href="controllers/salir.php"
								><i class="dw dw-logout"></i> Log Out</a
							>
						</div>
					</div>
				</div>
				<div class="github-link">
					
						<img src="vendors/images/github.svg" alt=""
					/></a>
				</div>
			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					Layout Settings
					<span class="btn-block font-weight-400 font-12"
						>User Interface Settings</span
					>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Header Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-white active"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
					<div class="sidebar-radio-group pb-10 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-1"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebaricon-1"
								><i class="fa fa-angle-down"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebaricon-2" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-2" />
                                    <label class="custom-control-label" for="sidebaricon-2"><i class="ion-plus-round"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebaricon-3" name="menu-dropdown-icon" class="custom-control-input" value="icon-style-3" />
                                    <label class="custom-control-label" for="sidebaricon-3"><i class="fa fa-angle-double-right"></i
							></label>
                                </div>
                            </div>

                            <h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
                            <div class="sidebar-radio-group pb-30 mb-10">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-1" name="menu-list-icon" class="custom-control-input" value="icon-list-style-1" checked="" />
                                    <label class="custom-control-label" for="sidebariconlist-1"><i class="ion-minus-round"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-2" name="menu-list-icon" class="custom-control-input" value="icon-list-style-2" />
                                    <label class="custom-control-label" for="sidebariconlist-2"><i class="fa fa-circle-o" aria-hidden="true"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-3" name="menu-list-icon" class="custom-control-input" value="icon-list-style-3" />
                                    <label class="custom-control-label" for="sidebariconlist-3"><i class="dw dw-check"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-4" name="menu-list-icon" class="custom-control-input" value="icon-list-style-4" checked="" />
                                    <label class="custom-control-label" for="sidebariconlist-4"><i class="icon-copy dw dw-next-2"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-5" name="menu-list-icon" class="custom-control-input" value="icon-list-style-5" />
                                    <label class="custom-control-label" for="sidebariconlist-5"><i class="dw dw-fast-forward-1"></i
							></label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="sidebariconlist-6" name="menu-list-icon" class="custom-control-input" value="icon-list-style-6" />
                                    <label class="custom-control-label" for="sidebariconlist-6"><i class="dw dw-next"></i
							></label>
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
                    <a href="index.html">
                        <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo" />
                        <img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo" />
                    </a>
                    <div class="close-sidebar" data-toggle="left-sidebar-close">
                        <i class="ion-close-round"></i>
                    </div>
                </div>
                <div class="menu-block customscroll">
                    <div class="sidebar-menu">
                        <ul id="accordion-menu">
                            <li class="dropdown">
                                <a href="index.html" class="dropdown-toggle no-arrow">
                                    <span class="micon bi bi-house"></span
								><span class="mtext">Home</span>
                                </a>

                            </li>
                            <li class="dropdown">
                                <a href="estadistica.php" class="dropdown-toggle no-arrow">
                                    <span class="micon bi bi-textarea-resize"></span
								><span class="mtext">Estadistica</span>
                                </a>

                            </li>
                            <li class="dropdown">
                                <a href="usuarios.php" class="dropdown-toggle no-arrow">
                                    <span class="micon bi bi-table"></span
								><span class="mtext">Usuarios</span>
                                </a>

                            </li>
                            <li>
                                <a href="calendar.html" class="dropdown-toggle no-arrow">
                                    <span class="micon bi bi-calendar4-week"></span
								><span class="mtext">Calendar</span>
                                </a>
                            </li>
                            <li class="dropdown">
                                <a href="mascota.php" class="dropdown-toggle no-arrow">
                                    <span class="micon bi bi-archive"></span
								><span class="mtext"> Mascota (Paciente) </span>
                                </a>

                            </li>

                            <li class="dropdown">
                                <a href="doctores.php" class="dropdown-toggle no-arrow">
                                    <span class="micon bi bi-pie-chart"></span
								><span class="mtext">Doctores</span>
                                </a>

                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon bi bi-file-earmark-text"></span
								><span class="mtext">Opciones Adicionales</span>
                                </a>
                                <ul class="submenu">
                                    <li><a href="login.php">Login</a></li>
                                    <li><a href="forgot-password.html">Forgot Password</a></li>
                                    <li><a href="reset-password.html">Reset Password</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon bi bi-bug"></span
								><span class="mtext">Error Pages</span>
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
                                    <span class="micon bi bi-back"></span
								><span class="mtext">Extra Pages</span>
                                </a>

                            </li>

                            <li>
                                <a href="citas_programadas.php" class="dropdown-toggle no-arrow">
                                    <span class="micon bi bi-diagram-3"></span
								><span class="mtext">Citas Programadas</span>
                                </a>
                            </li>
                            <li>
                                <a href="chat.html" class="dropdown-toggle no-arrow">
                                    <span class="micon bi bi-chat-right-dots"></span
								><span class="mtext">Chat</span>
                                </a>
                            </li>
                            <li>
                                <a href="invoice.html" class="dropdown-toggle no-arrow">
                                    <span class="micon bi bi-receipt-cutoff"></span
								><span class="mtext">inventario</span>
                                </a>
                            </li>


                            <li>

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-overlay"></div>




            <!-- dividir aqui -->


            <div class="main-container">



                <!-- dividir aqui -->


                <div class="title pb-20 pt-20">
                    <h2 class="h3 mb-0">entidad relacional</h2>
                </div>

                <div class="footer-wrap pd-20 mb-20 card-box">
                    veterinaria sos todos los derechos reservados
                    <a href="https://github.com/dorotyalvarez" target="_blank">VETERINARIA SOS</a
					>
				</div>
			</div>
		</div>
		<!-- welcome modal start -->
		<div class="welcome-modal">
			<button class="welcome-modal-close">
				<i class="bi bi-x-lg"></i>
			</button>
			<iframe
				class="w-100 border-0"
				src="https://embed.lottiefiles.com/animation/31548"
			></iframe>
			<div class="text-center">
				<h3 class="h5 weight-500 text-center mb-2">
					feliz dia
					<span role="img" aria-label="gratitude">❤️</span>
                                                    </h3>
                                                    <div class="pb-2">
                                                       
			</div>
			<div class="text-center mb-1">
				<div>
					<a
						
					>
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
        <noscript><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
        <!-- End Google Tag Manager (noscript) -->
</body>

</html>