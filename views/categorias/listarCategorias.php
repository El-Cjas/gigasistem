<?php include_once "../layout/header.php"; ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Categorías</h1>
    <a href="./registrarCategoria.php" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nueva Categoría
    </a>
</div>

<!-- Search Box -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buscar Categoría</h6>
    </div>
    <div class="card-body">
        <form action="index.php?opcion=buscarCategorias" method="post" class="form-inline mb-3">
            <div class="input-group w-100">
                <input type="text" name="termino" class="form-control" placeholder="Buscar categoría...">
                <div class="input-group-append">
                    <button type="submit" name="buscarCategorias" class="btn btn-primary">
                        <i class="fas fa-search fa-sm"></i> Buscar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Listado de Categorías</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="categorias-body">
                    <!-- Aquí se renderizan las categorías con JS -->
                     
                </tbody>
            </table>
        </div>
        <div id="pagination"></div>
    </div>
</div>
<?php include_once "../../controllers/listarCategoria.php"?>

<?php include_once "../layout/footer.php"?>

<!-- Incluye jQuery si no está incluido -->
