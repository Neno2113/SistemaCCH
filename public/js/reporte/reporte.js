$(document).ready(function() {




    var tabla

    //Funcion que se ejecuta al inicio
    function init() {
        // listar();
        $("#desde").val("");
        $("#hasta").val("");
        $("#btn-print").attr("disabled", true);
    }



    init();
});



$("#btn-generar").click(function(e){
    e.preventDefault();

    let hasta  = $("#hasta").val();

    Swal.fire(
        'Reporte generado!',
        'Fecha de reporte fijada.',
        'info'
    )


    $("#btn-print").attr("href", 'reporte/existencia/'+hasta);

    $.ajax({
        url: "reporte/fechas",
        type: "POST",
        dataType: "json",
        data: JSON.stringify(fecha),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {

            } else {
                bootbox.alert(
                    "Ocurrio un error durante la creacion del usuario verifique los datos suministrados!!"
                );
            }
        },
        error: function(datos) {
            console.log(datos.responseJSON.errors);
            let errores = datos.responseJSON.errors;

            Object.entries(errores).forEach(([key, val]) => {
                bootbox.alert({
                    message:"<h4 class='invalid-feedback d-block'>"+val+"</h4>",
                    size: 'small'
                });
            });
        }
    });
});

//funcion para listar en el Datatable


