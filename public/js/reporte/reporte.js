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

    // let hasta  = $("#hasta").val();

    // Swal.fire(
    //     'Info',
    //     'Fecha de reporte fijada.',
    //     'info'
    // )
    listar();

    // $("#btn-print").attr("href", 'reporte/existencia/'+hasta);

    // $.ajax({
    //     url: "reporte/fechas",
    //     type: "POST",
    //     dataType: "json",
    //     data: JSON.stringify(fecha),
    //     contentType: "application/json",
    //     success: function(datos) {
    //         if (datos.status == "success") {

    //         } else {
    //             bootbox.alert(
    //                 "Ocurrio un error durante la creacion del usuario verifique los datos suministrados!!"
    //             );
    //         }
    //     },
    //     error: function(datos) {
    //         console.log(datos.responseJSON.errors);
    //         let errores = datos.responseJSON.errors;

    //         Object.entries(errores).forEach(([key, val]) => {
    //             bootbox.alert({
    //                 message:"<h4 class='invalid-feedback d-block'>"+val+"</h4>",
    //                 size: 'small'
    //             });
    //         });
    //     }
    // });
});

//funcion para listar en el Datatable
function listar() {
    tabla = $("#existencias").DataTable({
        serverSide: true,
        autoWidth: false,
        responsive: true,
        iDisplayLength: 10,
        dom: 'Bfrtip',
        buttons: [
            'pageLength',
            'copyHtml5',
                {
                extend: 'excelHtml5',
                autoFilter: true,
                sheetName: 'Exported data'
            },
            'csvHtml5',
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            }
            ],
        ajax: "api/exportarFacturas",
        columns: [
            { data: "Customer ID", name: 'cliente.codigo_cliente' },
            { data: "Invoice/CM #", name: 'factura.no_factura',  orderable: false, searchable: false },
            { data: "Credit Memo", name: '',  orderable: false, searchable: false },
            { data: "Date", name: 'factura.fecha',  orderable: false, searchable: false },
            { data: "Ship to Name", name: 'cliente.nombre_cliente',  orderable: false, searchable: false },
            { data: "Ship to Address-Line One", name: 'cliente.calle',  orderable: false, searchable: false },
            { data: "Ship to Address-Line Two", name: 'cliente.sector',  orderable: false, searchable: false },
            { data: "Ship to City", name: 'cliente.provincia',  orderable: false, searchable: false },
        ],
        // order: [[3, 'desc']],
        // rowGroup: {
        //     dataSrc: 'marca'
        // }
    });
}


