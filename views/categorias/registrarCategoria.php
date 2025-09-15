<?php include_once "../layout/header.php"; ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Registrar Categoría</h1>
    <a href="../categorias/listarCategorias.php" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-list fa-sm text-white-50"></i> Volver al Listado
    </a>
</div>

<!-- Formulario de Registro -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nueva Categoría</h6>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="descripcion" id="descripcion" rows="3" required></textarea>
            </div>
            <input type="button" class="btn btn-primary" value="Registrar Categoría" id="enviar" name="enviar">
        </form>
    </div>
</div>
<?php include_once "../../controllers/registrarCategoria.php"; ?>

<?php include_once "../layout/footer.php" ?>
