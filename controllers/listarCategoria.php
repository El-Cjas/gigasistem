<script src="../../controllers/lib/jquery-3.7.1.min.js"></script>


<script>

$(document).ready(function () {
    $.get("../../models/Categoria.php?",{categoria:"consultar"}, function (data) {
        console.log("datos recibidos",data);
        let tbody = $("tbody");

        data.forEach(categoria => {
        
        fila = `
            <tr>
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
            </tr>
        `;
           tbody.append(fila); 
        });
    })
        //editar
    $(document).on("click",".editar-btn", function() {
        //logica de editar
        let id = $(this).data("id"); // $(this) es el elemento clickeado
        
        window.location.href = "editarCategoria.php?id="+id;
    });
    //eliminar
    $(document).on("click", ".eliminar-btn", function () {
        //logica de eliminar
        let texto = $(this).data("id"); // $(this) es el elemento clickeado
        console.log("Hiciste click en:", texto);
    })
})

</script>