<?php include_once "../layout/header.php"; ?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Editar Categoría</h1>
    <a href="../categorias/listarCategorias.php" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-list fa-sm text-white-50"></i> Volver al Listado
    </a>
</div>

<!-- Formulario de Edición -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Editar Categoría #</h6>
    </div>
    <div class="card-body">
        <form action="index.php?opcion=actualizarCategoria" method="post">
            <input type="hidden" name="categoria[ID]" value="">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="categoria[nombre]" id="nombre" value="<?="nada"?>" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="categoria[descripcion]" id="descripcion" rows="3" required><?= "puta" ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save fa-sm text-white-50"></i>
                Actualizar Categoría
            </button>
        </form>
    </div>
</div>

<?php include_once "../layout/footer.php"; ?>