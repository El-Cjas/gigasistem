<?php include_once "../layout/header.php"?>

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>

<!-- Content Row -->
<div class="row">
    <!-- Productos Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Productos</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">  contenido</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-box fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Search Box -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Buscar producto</h6>
    </div>
    <div class="card-body">
        <form action="index.php?opcion=buscarProductos" method="post" class="form-inline mb-2">
            <div class="input-group w-50">
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
                <tbody id="productos-body">
                    <!-- Aquí se renderizan los productos con JS -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="content">
    <!-- Aquí se cargará el contenido paginado -->
</div>

<div id="pagination">
    <!-- Aquí se generarán los botones de paginación -->
</div>

<!-- Incluye jQuery antes de tu script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Page level plugins -->

<!-- Page level custom scripts -->
<script>
$(document).ready(function() {
    let dataProductos = [];        // aquí guardamos todos los productos
    let currentPage = 1;           // página actual
    const itemsPerPage = 5;       // cantidad de registros por página

    // ================================
    // 1. LISTAR TODOS
    // ================================
    function listarProductos() {
        $.ajax({
            url: "index.php?opcion=listarProductos", // Debes crear este endpoint en tu backend
            method: "GET",
            dataType: "json",
            success: function(data) {
                dataProductos = data;
                currentPage = 1;
                renderTabla();
            },
            error: function(xhr, status, error) {
                console.error("Error AJAX (listar):", status, error);
                Swal.fire("Error", "No se pudieron cargar los productos.", "error");
            }
        });
    }

    // ================================
    // 2. BUSCAR
    // ================================
    $("form[action='index.php?opcion=buscarProductos']").submit(function(e) {
        e.preventDefault();
        const termino = $("input[name='termino']").val().trim();

        $.ajax({
            url: "index.php?opcion=buscarProductos", // Debes crear este endpoint en tu backend
            method: "POST",
            data: { termino: termino },
            dataType: "json",
            success: function(data) {
                dataProductos = data;
                currentPage = 1;
                renderTabla();
            },
            error: function(xhr, status, error) {
                console.error("Error AJAX (buscar):", status, error);
                Swal.fire("Error", "No se pudo realizar la búsqueda.", "error");
            }
        });
    });

    // ================================
    // 3. ELIMINAR
    // ================================
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
                    url: "index.php?opcion=eliminarProducto",
                    method: "POST",
                    data: { ID: id },
                    dataType: "json",
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }, 
                    success: function(response) {
                        //alert(JSON.stringify(response)); // linea de prueba Prueba 
                        if (response.success) {
                            Swal.fire("Eliminado", response.message, "success");
                            listarProductos();
                        } else {
                            Swal.fire("Error", response.message, "error");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error AJAX (eliminar):", status, error);
                        Swal.fire("Error", "No se pudo eliminar el producto.", "error");
                    }
                });
            }
        });
    });

    // ================================
    // 4. RENDERIZAR TABLA + PAGINACIÓN
    // ================================
    function renderTabla() {
        const tbody = $("#productos-body");
        tbody.empty();

        if (!dataProductos || dataProductos.length === 0) {
            tbody.append('<tr><td colspan="8" class="text-center">No hay productos disponibles.</td></tr>');
            $("#pagination").empty();
            return;
        }

        // calcular paginación
        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const pageData = dataProductos.slice(start, end);

        $.each(pageData, function(index, producto) {
            let fila = `<tr>
                <td>${producto.nombre}</td>
                <td>${producto.descripcion}</td>
                <td>${producto.codigo}</td>
                <td>${producto.categoria}</td>
                <td>${producto.precio_compra}</td>
                <td>${producto.precio_venta}</td>
                <td>${producto.stock}</td>
                <td>
                    <button class="btn btn-primary btn-circle btn-sm editar-btn" data-id="${producto.ID}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-circle btn-sm eliminar-btn" data-id="${producto.ID}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>`;
            tbody.append(fila);
        });

        renderPagination();
    }

    // ================================
    // 5. BOTONES DE PAGINACIÓN
    // ================================
    function renderPagination() {
        const totalPages = Math.ceil(dataProductos.length / itemsPerPage);
        const pagination = $("#pagination");
        pagination.empty();

        if (totalPages <= 1) return;

        for (let i = 1; i <= totalPages; i++) {
            const btn = $(`<button class="btn btn-sm me-1 ${i === currentPage ? 'btn-primary' : 'btn-outline-primary'}">${i}</button>`);
            btn.click(function() {
                currentPage = i;
                renderTabla();
            });
            pagination.append(btn);
        }
    }

    // ================================
    // 6. EDITAR (Redirige)
    // ================================
    $(document).on("click", ".editar-btn", function() {
        const id = $(this).data('id');
        window.location.href = `index.php?opcion=editarProducto&ID=${id}`;
    });

    // ================================
    // Inicializa cargando la lista
    // ================================
    listarProductos();
});
</script>



<?php include_once "../layout/footer.php"?>

