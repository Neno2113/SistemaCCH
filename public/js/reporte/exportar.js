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
            { data: "codigo_cliente", name: 'orden_facturacion_detalle.codigo_cliente',  orderable: false, searchable: false  },
            { data: "no_factura", name: ''  },
            { data: "nota", name: '',  orderable: false, searchable: false },
            { data: "fecha", name: 'factura.fecha',  orderable: false, searchable: false },
            { data: "nombre_cliente", name: 'cliente.nombre_cliente',  orderable: false, searchable: false },
            { data: "calle", name: 'cliente.calle',  orderable: false, searchable: false },
            { data: "sector", name: 'cliente.sector',  orderable: false, searchable: false },
            { data: "provincia", name: 'cliente.provincia',  orderable: false, searchable: false },
            { data: "pais", name: '',  orderable: false, searchable: false },
            { data: "transporte", name: 'factura.por_transporte',  orderable: false, searchable: false },
            { data: "fecha_vencimiento", name: 'factura.fecha_vencimiento',  orderable: false, searchable: false },
            { data: "codigo_empleado", name: '',  orderable: false, searchable: false },
            { data: "account_re", name: '',  orderable: false, searchable: false },
            { data: "tax_id", name: '',  orderable: false, searchable: false },
            { data: "factura_nota", name: 'factura.nota',  orderable: false, searchable: false },
            { data: "nota_impresa", name: '',  orderable: false, searchable: false },
            { data: "distribuiciones", name: '',  orderable: false, searchable: false },
            { data: "Invoice_distribuciones", name: '',  orderable: false, searchable: false },
            { data: "cantidad", name: '',  orderable: false, searchable: false },
            { data: "referencia_producto", name: 'orden.referencia_producto',  orderable: false, searchable: false },
            { data: "Description", name: 'orden.referencia_producto',  orderable: false, searchable: false },
            { data: "gl_cuenta", name: '',  orderable: false, searchable: false },
            { data: "precio_unitario", name: 'orden.precio',  orderable: false, searchable: false },
            { data: "tax_type", name: '',  orderable: false, searchable: false },
            { data: "sku", name: 'sku',  orderable: false, searchable: false },
            { data: "Amount", name: 'factura.total',  orderable: false, searchable: false },
            { data: "um_id", name: '',  orderable: false, searchable: false },
            { data: "um_stockings", name: '',  orderable: false, searchable: false },
            { data: "sales_agency", name: '',  orderable: false, searchable: false },
            { data: "return_auth", name: '',  orderable: false, searchable: false },
        ],
        order: [[1, 'desc']],
        rowGroup: {
            dataSrc: 'no_factura'
        },

    });
}


