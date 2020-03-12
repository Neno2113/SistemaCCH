$(document).ready(function() {




    var tabla

    //Funcion que se ejecuta al inicio
    function init() {
        listar();

    }


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
            ajax: "api/existencias",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                // { data: "Opciones", orderable: false, searchable: false },
                // { data: "fase", name: 'corte.fase' },
                { data: "marca", name: 'corte.marca' },
                { data: "referencia_producto", name: 'producto.referencia_producto',  orderable: false, searchable: false },
                { data: "total_produccion", name: 'producto.total_produccion',  orderable: false, searchable: false },
                { data: "total_lavanderia", name: 'producto.total_lavanderia',  orderable: false, searchable: false },
                { data: "total_recepcion", name: 'producto.total_recepcion',  orderable: false, searchable: false },
                { data: "total_alm", name: 'producto.total_alm',  orderable: false, searchable: false },
            ],
            order: [[3, 'desc']],
            rowGroup: {
                dataSrc: 'marca'
            }
        });
    }








    init();
});





