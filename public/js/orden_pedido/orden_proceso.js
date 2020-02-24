
$(document).ready(function() {
    $("[data-mask]").inputmask();


    function init() {
    listarOrdenesProceso();

    }
    var data;



    $("#cantidad").keyup(function() {
        $("#btn-consultar").show();
        $("#precio_div").show();
        $("#total_div").show();
    });


    $("#btn-agregar").click(function(t) {
        t.preventDefault();
        validarDetalle();

    });

    //funcion para listar en el Datatable

    //funcion para listar en el Datatable
    function listarOrdenesProceso() {
        tabla_proceso = $("#ordenes_proceso").DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            dom: "Bfrtip",
            buttons: [
                "pageLength",
                "copyHtml5",
                {
                    extend: "excelHtml5",
                    autoFilter: true,
                    sheetName: "Exported data"
                },
                "csvHtml5",
                {
                    extend: "pdfHtml5",
                    orientation: "landscape",
                    pageSize: "LEGAL"
                }
            ],
            ajax: "api/ordenes_proceso",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_orden_pedido", name: "orden_pedido.no_orden_pedido"},
                { data: "cliente", name: "orden_pedido.cliente", orderable: false, searchable: false  },
                { data: "sucursal", name: "orden_pedido.sucursal", orderable: false, searchable: false },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" },
                { data: "referencia", name: "orden_pedido.referencia" },
                { data: "total", name: "orden_pedido.total", searchable: false},
                { data: "status_orden_pedido", name: "orden_pedido.status_orden_pedido"},
                { data: "generado_internamente", name: "orden_pedido.generado_internamente"},
                { data: "notas", name: "orden_pedido.notas" }
            ],
            order: [[5, "desc"]],
            rowGroup: {
                dataSrc: "fecha_entrega"
            }
        });
    }



    init();
});




// function eliminar(id_orden) {
//     Swal.fire({
//         title: "¿Estas seguro de eliminar esta orden de pedido?",
//         text: "Va a eliminar la orden de pedido!",
//         type: "warning",
//         showCancelButton: true,
//         confirmButtonColor: "#3085d6",
//         cancelButtonColor: "#d33",
//         confirmButtonText: "Si, acepto"
//     }).then(result => {
//         if (result.value) {
//             $.post("orden_pedido/delete/" + id_orden, function() {
//                 Swal.fire(
//                     "Eliminado!",
//                     "Orden de pedido eliminada correctamente.",
//                     "success"
//                 );
//                 $("#ordenes")
//                     .DataTable()
//                     .ajax.reload();
//             });
//         }
//     });

    // bootbox.confirm("¿Estas seguro de eliminar esta orden de producto?", function(result){
    //     if(result){
    //         $.post("orden_pedido/delete/" + id_orden, function(){
    //             bootbox.alert("Orden de pedido eliminada correctamente!!");
    //             $("#ordenes").DataTable().ajax.reload();
    //         })
    //     }
    // })








