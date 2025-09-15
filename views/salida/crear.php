<?php include_once "../layout/header.php"?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Registrar Salida</h1>
    <a href="index.php?opcion=mostrarSalidas" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-list fa-sm text-white-50"></i> Volver al Listado
    </a>
</div>

<?php if (isset($_GET['error']) && $_GET['error'] == 'stock_insuficiente'): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> No hay suficiente stock para realizar esta salida.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>

<!-- Formulario de Registro de Salida -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nueva Salida de Producto</h6>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="producto">Producto</label>
                <select class="form-control" name="salida[ID_producto]" id="producto" required>
                    <option value="">Seleccione un producto</option>
                    <?php foreach ($productos as $producto): ?>
                    <option value="<?= $producto["ID"] ?>">
                        <?= $producto["nombre"] ?> (Stock disponible: 
                        <?= $producto["stock"]?>)
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" name="salida[cantidad]" id="cantidad" min="1" required>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" name="salida[fecha]" id="fecha" value="<?= date('Y-m-d') ?>" required>
            </div>

            <button type="submit" class="btn btn-primary" name="registrarSalida">
                <i class="fas fa-save fa-sm text-white-50"></i>
                Registrar Salida
            </button>
        </form>
    </div>
</div>

<?php include_once "../layout/footer.php"?>