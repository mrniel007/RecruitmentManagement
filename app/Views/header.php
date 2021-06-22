<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Niel Vasquez powered by SB Admin 2">

    <title>RecruitManagement</title>

    <!-- Custom fonts for this template-->
    <link href="public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="public/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="public/img/favicon.png"/>
    <script src="node_modules/sweetalert2/dist/sweetalert2.all.js"></script>
    <link href="node_modules/sweetalert2/dist/sweetalert2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home">
                <div class="sidebar-brand-icon">
                        <i class="fas fa-id-badge"></i>
                    </div>
                <div class="mx-3">R<sup><sup>M</sup></sup></div>
            </a>
            <?php if($userData[0]->tipo == 1){?>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="home">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Inicio</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Administrativo
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-tasks"></i>
                    <span>Gestionar</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestión:</h6>
                        <a class="collapse-item" href="reportes">Reportes</a>
                        <a class="collapse-item" href="candidatos">Gestión de Candidatos</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                    aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Utilidades</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Gestión de datos:</h6>
                        <a class="collapse-item" href="competencias">Competencias</a>
                        <a class="collapse-item" href="idiomas">Idiomas</a>
                        <a class="collapse-item" href="capacitaciones">Capacitaciones</a>
                        <a class="collapse-item" href="puestos">Puestos</a>
                    </div>
                </div>
            </li>
            <?php }?>
            <?php if($userData[0]->tipo == 2 or $userData[0]->tipo == 3){?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <?php if($userData[0]->tipo == 2){?>
                Vacante
                <?php }
                if($userData[0]->tipo == 3){
                ?>
                    Capacitate!
                <?php }?>
            </div>
            <?php if($userData[0]->tipo == 2){?>
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="vacantes">
                    <i class="fas fa-fw fa-briefcase"></i>
                    <span>Vacantes</span></a>
            </li>
            <?php }?>
            <?php if($userData[0]->tipo == 3){?>
            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="capacitaciones">
                    <i class="fas fa-fw fa-graduation-cap"></i>
                    <span>Capacitaciones</span></a>
            </li>
            <?php }?>
            <?php }?>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $userData[0]->nombre_usuario;?></span>
                                <img class="img-profile rounded-circle"
                                    src="public/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <?php if($userData[0]->tipo == 2){?>
                                <a class="dropdown-item" href="userinfo">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Mis datos
                                </a>
                                <div class="dropdown-divider"></div>
                                <?php }?>
                                <a class="dropdown-item" id="cerrarSesion" href="#">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesión
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->