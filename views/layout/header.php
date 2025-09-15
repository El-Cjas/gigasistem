<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sistema de Inventario">
    <meta name="author" content="">

    <title>GigaSistem - Sistema de Inventario</title>

    <!-- Custom fonts for this template-->
    <link href="../../startbootstrap-sb-admin-2-gh-pages/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom styles for this template-->
    <link href="../../startbootstrap-sb-admin-2-gh-pages/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this project -->
    <link href="../../startbootstrap-sb-admin-2-gh-pages/css/custom.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../auth/dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-box"></i>
                </div>
                <div class="sidebar-brand-text mx-3">GigaSistem</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Menu</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">Gestión</div>

            <!-- Nav Item - Categorías -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCategorias" aria-expanded="true" aria-controls="collapseCategorias">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Categorías</span>
                </a>
                <div id="collapseCategorias" class="collapse" aria-labelledby="headingCategorias" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../categorias/registrarCategoria.php">Registrar Categoría</a>
                        <a class="collapse-item" href="../categorias/listarCategorias.php">Listar Categorías</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Productos -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProductos" aria-expanded="true" aria-controls="collapseProductos">
                    <i class="fas fa-fw fa-box-open"></i>
                    <span>Productos</span>
                </a>
                <div id="collapseProductos" class="collapse" aria-labelledby="headingProductos" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="../productos/registrar.php">Registrar Producto</a>
                        <a class="collapse-item" href="../productos/listar.php">Listar Productos</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Entradas/Salidas -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMovimientos" aria-expanded="true" aria-controls="collapseMovimientos">
                    <i class="fas fa-fw fa-exchange-alt"></i>
                    <span>Movimientos</span>
                </a>
                <div id="collapseMovimientos" class="collapse" aria-labelledby="headingMovimientos" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Entradas:</h6>
                        <a class="collapse-item" href="../entrada/crear.php">Crear Entrada</a>
                        <a class="collapse-item" href="../entrada/listar.php">Listar Entradas</a>
                        <h6 class="collapse-header">Salidas:</h6>
                        <a class="collapse-item" href="../salida/crear.php">Crear Salida</a>
                        <a class="collapse-item" href="../salida/listar.php">Listar Salidas</a>
                    </div>
                </div>
            </li>

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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= htmlspecialchars($_SESSION['user_name'] ?? 'Usuario') ?></span>
                                <img class="img-profile rounded-circle" src="startbootstrap-sb-admin-2-gh-pages/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="index.php?action=logout" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar sesión
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">