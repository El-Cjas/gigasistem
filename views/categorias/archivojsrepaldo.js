<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


$(document).ready(function() {
    let dataCategorias = [];
    let currentPage = 1;
    const itemsPerPage = 5;

    // 1. Listar todas las categorías
    function listarCategorias() {
        $.ajax({
            url: "index.php?opcion=listarCategorias",
            method: "GET",
            dataType: "json",
            success: function(data) {
                dataCategorias = data;
                currentPage = 1;
                renderTabla();
            },
            error: function() {
                $("#categorias-body").html('<tr><td colspan="4" class="text-center">Error al cargar categorías.</td></tr>');
            }
        });
    }

    // 2. Buscar categorías
    $("form[action='index.php?opcion=buscarCategorias']").submit(function(e) {
        e.preventDefault();
        const termino = $("input[name='termino']").val().trim();
        $.ajax({
            url: "index.php?opcion=buscarCategorias",
            method: "POST",
            data: { termino: termino },
            dataType: "json",
            success: function(data) {
                dataCategorias = data;
                currentPage = 1;
                renderTabla();
            },
            error: function() {
                $("#categorias-body").html('<tr><td colspan="4" class="text-center">Error al buscar categorías.</td></tr>');
            }
        });
    });

    // 3. Eliminar categoría
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
                    url: "index.php?opcion=eliminarCategoria",
                    method: "POST",
                    data: { ID: id },
                    dataType: "json",
                    headers: { 'X-Requested-With': 'XMLHttpRequest' },
                    success: function(response) {
                        if (response.success) {
                            Swal.fire("Eliminado", response.message, "success");
                            listarCategorias();
                        } else {
                            Swal.fire("Error", response.message, "error");
                        }
                    },
                    error: function() {
                        Swal.fire("Error", "No se pudo eliminar la categoría.", "error");
                    }
                });
            }
        });
    });

    // 4. Renderizar tabla con paginación
    function renderTabla() {
        const tbody = $("#categorias-body");
        tbody.empty();

        if (!dataCategorias || dataCategorias.length === 0) {
            tbody.append('<tr><td colspan="4" class="text-center">No se encontraron categorías.</td></tr>');
            $("#pagination").empty();
            return;
        }

        const start = (currentPage - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const pageData = dataCategorias.slice(start, end);

        $.each(pageData, function(index, categoria) {
            let fila = `<tr>
                <td>${categoria.ID}</td>
                <td>${categoria.nombre}</td>
                <td>${categoria.descripcion}</td>
                <td>
                    <button class="btn btn-primary btn-circle btn-sm editar-btn" data-id="${categoria.ID}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-danger btn-circle btn-sm eliminar-btn" data-id="${categoria.ID}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>`;
            tbody.append(fila);
        });

        renderPagination();
    }

    // 5. Botones de paginación
    function renderPagination() {
        const totalPages = Math.ceil(dataCategorias.length / itemsPerPage);
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

    // 6. Editar (redirige)
    $(document).on("click", ".editar-btn", function() {
        const id = $(this).data('id');
        window.location.href = `index.php?opcion=actualizarCategoria&ID=${id}`;
    });

    // // Mostrar alerta si se editó correctamente
    // <?php if (isset($_GET['edit']) && $_GET['edit'] === 'ok'): ?>
        // Swal.fire("Editado", "La categoría se editó correctamente.", "success");
    // <?php endif; ?>

    // Inicializa cargando la lista
    listarCategorias();
});


