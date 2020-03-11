$(document).ready(function() {




    var tabla

    //Funcion que se ejecuta al inicio
    function init() {
        listar();

    }


    //funcion para listar en el Datatable
    function listar() {
        tabla = $("#facturas_listadas").DataTable({
            serverSide: true,
            autoWidth: false,
            responsive: true,
            iDisplayLength: 5,
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
            ajax: "api/reporteExistencias",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_factura", name: 'factura.no_factura' },
                { data: "cliente", name: 'factura.cliente',  orderable: false, searchable: false },
                { data: "sucursal", name: 'factura.sucursal',  orderable: false, searchable: false },
                // { data: "referencia_producto", name: 'producto.referencia_producto', orderable: false, searchable: false },
                { data: "fecha", name: 'factura.fecha' },
                { data: "fecha_impresion", name: 'factura.fecha_impresion' },
                // { data: "total", name: 'orden_facturacion_detalle.total' },
                { data: "por_transporte", name: 'orden_facturacion.por_transporte' },
            ],
            order: [[5, 'desc']],
            rowGroup: {
                dataSrc: 'cliente'
            }
        });
    }








    init();
});





