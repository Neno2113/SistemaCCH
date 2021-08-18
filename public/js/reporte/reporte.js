$(document).ready(function() {




    var tabla

    //Funcion que se ejecuta al inicio
    function init() {
        // listar();
        $("#desde").val("");
        $("#hasta").val("");
        $("#btn-print").attr("disabled", true);
        $("#btn-printPrimera").attr("disabled", true);
        $("#btn-printSegunda").attr("disabled", true);
        $("#btn-printPendiente").attr("disabled", true);
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

  
});


$("#btn-generarPrimera").click(function(e){
    e.preventDefault();

    let hasta  = $("#hasta").val();

    Swal.fire(
        'Reporte generado!',
        'Fecha de reporte fijada.',
        'info'
    )


    $("#btn-printPrimera").attr("href", 'reporte/primera/'+hasta);

 
});


$("#btn-generarSegunda").click(function(e){
    e.preventDefault();

    let hasta  = $("#hasta").val();

    Swal.fire(
        'Reporte generado!',
        'Fecha de reporte fijada.',
        'info'
    )


    $("#btn-printSegunda").attr("href", 'reporte/segunda/'+hasta);

 
});

$("#btn-generarPendiente").click(function(e){
    e.preventDefault();

    let hasta  = $("#hasta").val();

    Swal.fire(
        'Reporte generado!',
        'Fecha de reporte fijada.',
        'info'
    )


    $("#btn-printPendiente").attr("href", 'reporte/pendiente/'+hasta);

 
});


//funcion para listar en el Datatable


