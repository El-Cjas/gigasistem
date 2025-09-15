<?php include_once "../layout/header.php"?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Registrar Producto</h1>
    <a href="index.php?opcion=listarProductos" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-list fa-sm text-white-50"></i> Volver al Listado
    </a>
</div>

<!-- Formulario de Registro -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Nuevo Producto</h6>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="producto[nombre]" id="nombre" required>
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="producto[descripcion]" id="descripcion" rows="3" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" name="producto[codigo]" id="codigo" required>
            </div>
            
            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select class="form-control" name="producto[ID_categoria]" id="categoria" required>
                    <option value="">Seleccione una categoría</option>
                    <?php foreach ($categorias as $categoria):?>
                    <option value="<?=$categoria['ID']?>"><?=$categoria['nombre']?></option>
                    <?php endforeach?>
                </select>
            </div>
            
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="precio_compra">Precio de Compra</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" step="0.01" class="form-control" name="producto[precio_compra]" id="precio_compra" required  min="0">
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="precio_venta">Precio de Venta</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" step="0.01" class="form-control" name="producto[precio_venta]" id="precio_venta"  min="0">
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save fa-sm text-white-50"></i>
                Registrar Producto
            </button>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const precioCompraInput = document.getElementById('precio_compra');
    const precioVentaInput = document.getElementById('precio_venta');

    form.addEventListener('submit', function (event) {
        // El valor máximo permitido es 999,999,999.99 (9 dígitos enteros)
        const maxVal = 999999999.99;
        const precioCompra = parseFloat(precioCompraInput.value);
        const precioVenta = parseFloat(precioVentaInput.value);
        let errorMessage = '';

        if (precioCompra > maxVal) {
            errorMessage += 'El "Precio de Compra" es demasiado grande (máximo 9 dígitos enteros).\n';
        }
        if (precioVenta > maxVal) {
            errorMessage += 'El "Precio de Venta" es demasiado grande (máximo 9 dígitos enteros).\n';
        }

        if (errorMessage) {
            alert(errorMessage);
            event.preventDefault(); // Detiene el envío del formulario si hay errores
        }
    });
});
</script>
<?php include_once "../layout/footer.php" ?>