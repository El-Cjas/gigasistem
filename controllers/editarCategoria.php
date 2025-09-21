<link rel="stylesheet" href="../../controllers/lib/sweetalert2.min.css">
<script src="../../controllers/lib/jquery-3.7.1.min.js"></script>
<script src="../../controllers/lib/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function ($) {
        const params = new URLSearchParams(window.location.search);
        let id = params.get("id");

        $.ajax({
            url: "../../models/Categoria.php",
            type: "POST",
            data : {categoria: "consultar1",id}, //datos que se envian
            success: function(respuesta){
                let usuario = respuesta
                console.log(usuario);
                
                $("#nombre").val(usuario.nombre);
            },
        }
        )

        //funcion para llenar los campos del formulario segun los parametros que hayan
        function llenarFormulario(id) {
            
        }

        $("#nombre").focus();

        $("#enviar").click(function (params) {
            const formulario = [];
            const datos = {
                nombre: $("#nombre").val(),
                descripcion: $("#descripcion").val()
            };
        console.log(datos);
        $.post("../../models/Categoria.php",{categoria:"editar" ,datos:JSON.stringify(datos)})
        .done(function(data){
            //console.log("Respuesta:", "["+data+"]", "tipo:", typeof data);
            //console.log("Respuesta del servidor:", data, typeof data);
            if (data) {
                Swal.fire({
                    title: "Registro realizado!",
                    text: "Se ha registrado una categoria con exito",
                    icon: "success",
                    confirmButtonText: "Ok"
                }).then(()=>{
                    window.location.href = "listarCategorias.php"
                });
            
            }
        })
        .fail(function(xhr, status, error){
            console.error("Error de red o servidor:", status, error);
            Swal.fire({
                title: "Error!",
                text: "Ha ocurrido un error!",
                icon: "error"
            })
        });

    })//fin de la ejecucion del boton enviar
    }
)

</script>