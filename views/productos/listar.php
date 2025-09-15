<?php include_once "../layout/header.php"?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Productos</h1>
    <a href="index.php?opcion=registrarProducto" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nuevo Producto
    </a>
</div>

<!-- Search Box -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buscar Producto</h6>
    </div>
    <div class="card-body">
        <form action="index.php?opcion=buscarProductos" method="post" class="form-inline mb-3">
            <div class="input-group w-100">
                <input type="text" name="termino" class="form-control" placeholder="Buscar producto...">
                <div class="input-group-append">
                    <button type="submit" name="buscarProductos" class="btn btn-primary">
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
        <h6 class="m-0 font-weight-bold text-primary">Listado de Productos</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Código</th>
                        <th>Categoría</th>
                        <th>Precio Compra</th>
                        <th>Precio Venta</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productos as $producto):?>
                    <tr>
                        <td><?=$producto["ID"] ?></td>
                        <td><?=$producto["nombre"] ?></td>
                        <td><?=$producto["descripcion"] ?></td>
                        <td><?=$producto["codigo"] ?></td>
                        <td><?=$producto["categoria"] ?></td>
                        <td><?=$producto["precio_compra"] ?></td>
                        <td><?=$producto["precio_venta"] ?></td>
                        <td><?=$producto["stock"] ?></td>
                        <td>
                            <button class="btn btn-primary btn-circle btn-sm editar-btn" data-id="<?=$producto["ID"]?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-danger btn-circle btn-sm eliminar-btn" data-id="<?=$producto["ID"]?>">
                                <i class="fas fa-trash"></i> 
                            </button>
                        </td>
                    </tr>
                    <?php endforeach?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Page level plugins -->
<script src="startbootstrap-sb-admin-2-gh-pages/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="startbootstrap-sb-admin-2-gh-pages/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Page level custom scripts -->
<script>
$(document).ready(function() {
  $('#dataTable').DataTable({
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
    },
    "order": [[ 0, "asc" ]]
  });
});

$(document).on("click", ".editar-btn", function() {
    const id = $(this).data('id');
    window.location.href = `index.php?opcion=editarProducto&ID=${id}`;
});

$(document).on("click", ".eliminar-btn", function() {
    const id = $(this).data('id');
    Swal.fire({
        title: "¿Está seguro?",
        text: "Esta acción no se puede deshacer.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Sí, eliminar"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "index.php?opcion=eliminarProducto", // o eliminarCategoria según el caso
                method: "POST",
                data: { ID: id },
                dataType: "json",
                headers: { 'X-Requested-With': 'XMLHttpRequest' },
                success: function(response) {
                    if (response.success) {
                        Swal.fire("Eliminado", response.message, "success");
                        listarProductos(); // o listarCategorias()
                    } else {
                        Swal.fire("Error", response.message, "error");
                    }
                },
                error: function() {
                    Swal.fire("Error", "No se pudo eliminar.", "error");
                }
            });
        }
    });
});

// Mostrar alerta si se editó correctamente
<?php if (isset($_GET['edit']) && $_GET['edit'] === 'ok'): ?>
    Swal.fire("Editado", "El registro se editó correctamente.", "success");
<?php endif; ?>
</script>

<?php include_once "../layout/footer.php"?>