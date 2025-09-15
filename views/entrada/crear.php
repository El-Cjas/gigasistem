<?php include_once "../layout/header.php"?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Registrar Entrada</h1>
    <a href="index.php?opcion=mostrarEntradas" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-list fa-sm text-white-50"></i> Volver al Listado
    </a>
</div>

<!-- Formulario de Registro de Entrada -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nueva Entrada de Producto</h6>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="producto">Producto</label>
                <select class="form-control" name="entrada[ID_producto]" id="producto" required>
                    <option value="">Seleccione un producto</option>
                    <?php foreach ($productos as $producto): ?>
                    <option value="<?= $producto["ID"] ?>"><?= $producto["nombre"] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" name="entrada[cantidad]" id="cantidad" min="1" required>
            </div>

            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" name="entrada[fecha]" id="fecha" value="<?= date('Y-m-d') ?>" required>
            </div>

            <button type="submit" class="btn btn-primary" name="registrarEntrada">
                <i class="fas fa-save fa-sm text-white-50"></i>
                Registrar Entrada
            </button>
        </form>
    </div>
</div>

<?php include_once "../layout/footer.php" ?>