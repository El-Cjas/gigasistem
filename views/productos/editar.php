<?php include_once "../layout/header.php"?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Editar Producto</h1>
    <a href="index.php?opcion=listarProductos" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
        <i class="fas fa-list fa-sm text-white-50"></i> Volver al Listado
    </a>
</div>

<!-- Formulario de Edición -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Editar Producto</h6>
    </div>
    <div class="card-body">
        <form action="" method="post">
            <input type="hidden" name="producto[ID]" value="<?=$producto['ID']?>">
            
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="producto[nombre]" id="nombre" value="<?=$producto['nombre']?>" required>
            </div>
            
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control" name="producto[descripcion]" id="descripcion" rows="3" required><?=$producto['descripcion'] ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" class="form-control" name="producto[codigo]" id="codigo" value="<?=$producto['codigo']?>" required>
            </div>
            
            <div class="form-group">
                <label for="categoria">Categoría</label>
                <select class="form-control" name="producto[ID_categoria]" id="categoria" required>
                    <?php foreach ($categorias as $categoria):?>
                    <option value="<?=$categoria['ID']?>" <?= ($categoria['ID'] == $producto['ID_categoria']) ? "selected" : ""?> required><?=$categoria['nombre']?></option>
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
                        <input type="number" step="0.01" class="form-control" name="producto[precio_compra]" id="precio_compra" value="<?=$producto['precio_compra']?>" required>
                    </div>
                </div>
                
                <div class="form-group col-md-6">
                    <label for="precio_venta">Precio de Venta</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$</span>
                        </div>
                        <input type="number" step="0.01" class="form-control" name="producto[precio_venta]" id="precio_venta" value="<?=$producto['precio_venta']?>" required>
                    </div>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save fa-sm text-white-50"></i>
                Guardar Cambios
            </button>
        </form>
    </div>
</div>

<?php include_once "..layout/footer.php"?>