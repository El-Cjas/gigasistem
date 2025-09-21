<link rel="stylesheet" href="../../controllers/lib/sweetalert2.min.css">
<script src="../../controllers/lib/jquery-3.7.1.min.js"></script>
<script src="../../controllers/lib/sweetalert2.all.min.js"></script>
<script>
$(document).ready(function($) {
    //obteniendo el id de la url
    const params = new URLSearchParams(window.location.search);
    let id = params.get("id");

    //haciendo la peticion al servior con los datos de get
    $.ajax({
        url: "../../models/Categoria.php",
        type: "POST",
        data: {
            categoria: "consultar1",
            id
        }, //datos que se envian
        success: function(respuesta) {
            let usuario = respuesta[0]; //se recibe el array que da el servidor y se pasa la posicion 0 la cual contiene el json
            $(".text-primary").append(usuario.ID)
            $("#ID").val(usuario.ID);
            $("#nombre").val(usuario.nombre);
            $("#descripcion").val(usuario.descripcion);
        },
    });

    $("#nombre").focus();
    $("#enviar").click(function(params) {
        const formulario = [];
        const datos = {
            id, //escogemos el id recibido de la url
            nombre: $("#nombre").val(),
            descripcion: $("#descripcion").val()
        };
        delete datos;
        console.log(datos);
        $.post("../../models/Categoria.php", {
                categoria: "editar",
                datos: JSON.stringify(datos),
                "id": id
            })
            .done(function(data) {
                if (data) {
                    Swal.fire({
                        title: "Registro actualizado!",
                        text: "Se ha actualizado la categoria con exito",
                        icon: "success",
                        confirmButtonText: "Ok"
                    }).then(() => {
                        window.location.href = "listarCategorias.php"
                    });

                }
            })
            .fail(function(xhr, status, error) {
                console.error("Error de red o servidor:", status, error);
                Swal.fire({
                    title: "Error!",
                    text: "Ha ocurrido un error!",
                    icon: "error"
                })
            });

    }) //fin de la ejecucion del boton enviar
})
</script>