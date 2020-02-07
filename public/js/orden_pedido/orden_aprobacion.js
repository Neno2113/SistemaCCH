$(document).ready(function() {

    $("#formulario").validate({
        rules: {
            fecha_envio: {
                required: true,
                minlength: 1
            },
            cantidad: {
                required: true,
                minlength: 1,
                number: true
            },
            receta_lavado: {
                required: true,
                minlength: 10
            }

        },
        messages: {
            fecha_envio: {
                required: "La fecha en envio es obligatoria",
                minlength: "La fecha en envio es obligatoria"
            },
            cantidad: {
                required: "La cantidad es un campo numerico obligatorio.",
                minlength: "La cantidad es un campo numerico obligatorio.",
                number: "Este campo solo admite numeros."
            },
            receta_lavado: {
                required: "La receta de lavado es obligatoria",
                minlength: "La receta de lavado debe conteneer al menos 10 caracteres"
            }
        }
    })


    var tabla

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
    }


    $("#receta_lavado").on('keyup', function(){
        $("#btn-guardar").attr('disabled', false);
    })




    function listar() {
        tabla = $("#ordenes_aprobacion").DataTable({
            serverSide: true,
            responsive: true,
            dom: "Bfrtip",
            iDisplayLength: 5,
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
            ajax: "api/ordenes_aprobacion",
            columns: [
                // { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_orden_pedido",name: "orden_pedido.no_orden_pedido"},
                { data: "nombre", name: "empleado.nombre" },
                { data: "nombre_cliente", name: "cliente.nombre_cliente" },
                { data: "nombre_sucursal", name: "cliente_sucursales.nombre_sucursal"},
                { data: "fecha", name: "orden_pedido.fecha" },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" },
                { data: "fecha_aprobacion", name: "orden_pedido.fecha_aprobacion" },
                { data: "total", name: "orden_pedido.total", searchable: false  },
                { data: "status_orden_pedido", name: "orden_pedido.status_orden_pedido" },
            ],
            order: [[1, "desc"]],
            // rowGroup: {
            //     dataSrc: "name"
            // }
        });
    }



    function mostrarForm(flag) {
        if (flag) {
            $("#AprobarPedido").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#corteADD").show();
            $("#productoADD").show();
            $('#btn-generar').attr("disabled", false);

        } else {
            $("#AprobarPedido").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#badge-red").hide();
            $("#btnAgregar").show();
            $("#corteEdit").hide();
            $("#productoEdit").hide();
            $("#referencia_producto").hide();
            $("#numero_corte").hide();
            $("#suplidor_lavanderia").hide();
            $("#estandar_incluido").hide();
            $("#btn-guardar").attr('disabled', true);
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#formularioLavanderia").hide();


        }
    }

    $("#btnAgregar").click(function(e) {
        mostrarForm(true);


    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        mostrarForm(false);

    });

    init();
});


function aprobar(id_orden) {
    // e.preventDefault();
    bootbox.confirm("¿Estas seguro de aprobar esta orden?", function(result){
        if(result){
            $.post("orden-aprobacion/" + id_orden, function(data, status){
                bootbox.alert("Orden <strong>"+ data.orden.no_orden_pedido +"</strong> aprobada." );

                $("#ordenes_aprobacion").DataTable().ajax.reload();
                $("#ordenes_red").DataTable().ajax.reload();
            })
        }
    })
}

function redistribuir(id_orden){
    Swal.fire({
        title: '¿Esta seguro de redistribuir las tallas?',
        text: "Va a cambiar el pedido en caso de que se haya hecho detallada!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, guardar'
      }).then((result) => {
        if (result.value) {
            accionRedistribuir(id_orden);
        }
      })

}

function accionRedistribuir(id_orden){
    $.get("orden_redistribuir/" + id_orden, function(data){
        // console.log(data);
        Swal.fire(
            'Guardado!',
            'Redistribucion completa',
            'success'
            )
        $("#detalle").DataTable().ajax.reload();
    })
}

function cancelar(id_orden){
    bootbox.confirm("¿Estas seguro de cancelar esta orden?", function(result){
        if(result){
            $.post("orden-cancelacion/" + id_orden, function(data, status){
                bootbox.alert("Orden <strong>"+ data.orden.no_orden_pedido +"</strong> cancelada." );

                $("#ordenes_aprobacion").DataTable().ajax.reload();
            })
        }
    })
}
function ver(id_orden) {
    $.get("ver/orden/" + id_orden, function(data, status) {

        $("#AprobarPedido").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-guardar").hide();
        $("#autorizacion_credito_req").show();
        $("#redistribucion_tallas").show();
        $("#factura_desglosada_tallas").show();
        $("#acepta_segundas").show();

        $("#no_orden_pedido").val(data.orden.no_orden_pedido).attr('readonly', true);
        $("#cliente_apro").val(data.orden.cliente.nombre_cliente).attr('readonly', true);
        $("#sucursal_apro").val(data.orden.sucursal.nombre_sucursal).attr('readonly', true);
        $("#vendedor").val(data.orden.vendedor.nombre+" "+data.orden.vendedor.apellido).attr('readonly', true);
        $("#detalle").DataTable().destroy();
        listarOrdenDetalle(data.orden.id);

        for (let i = 0; i < data.orden_detalle.length; i++) {
            const element = array[i];

        }



    });
}

function ajuste( id_orden){
    Swal.fire({
        title: '¿Esta seguro de guardar este ajuste de esta redistribucion?',
        text: "Solo usar esta opcion en caso de que le redistribucion no sea exacta!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, guardar'
      }).then((result) => {
        if (result.value) {
            agregarDetalle(id_orden);
        }
      })
}

function reajustar( id_orden){
    Swal.fire({
        title: '¿Esta seguro de volver a ajustar esta redistribucion?',
        text: "Solo usar esta opcion en caso de que le redistribucion no sea exacta!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            cambiarAjuste(id_orden);
        }
      })


}

function agregarDetalle(id){

    var ordenDetalle = {
        a: $("#a"+id).val(),
        b: $("#b"+id).val(),
        c: $("#c"+id).val(),
        d: $("#d"+id).val(),
        e: $("#e"+id).val(),
        f: $("#f"+id).val(),
        g: $("#g"+id).val(),
        h: $("#h"+id).val(),
        i: $("#i"+id).val(),
        j: $("#j"+id).val(),
        k: $("#k"+id).val(),
        l: $("#l"+id).val(),
    };

    $.ajax({
        url: "orden/detalle/"+id,
        type: "POST",
        dataType: "json",
        data: JSON.stringify(ordenDetalle),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                $("#detalle").DataTable().ajax.reload();
                Swal.fire(
                'Guardado!',
                'Ajuste guardado',
                'success'
                )
                $("#a").val("");
                $("#b").val("");
                $("#c").val("");
                $("#d").val("");
                $("#e").val("");
                $("#f").val("");
                $("#g").val("");
                $("#h").val("");
                $("#i").val("");
                $("#j").val("");
                $("#k").val("");
                $("#l").val("");
                $("#total").val("");
            } else {
                bootbox.alert(
                    "Ocurrio un error durante la creacion de la composicion"
                );
            }
        },
        error: function(datos) {
            console.log(datos.responseJSON.message);

            bootbox.alert(
                "Error: " + datos.responseJSON.message
            );
        }
    });
}

function cambiarAjuste(id){
    $.ajax({
        url: "orden/detalle/reajuste/"+id,
        type: "POST",
        dataType: "json",
        // data: JSON.stringify(ordenDetalle),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                $("#detalle").DataTable().ajax.reload();
                Swal.fire(
                'Guardado!',
                'Cambios realizados',
                'success'
                )
            } else {
                bootbox.alert(
                    "Ocurrio un error durante la creacion de la composicion"
                );
            }
        },
        error: function(datos) {
            console.log(datos.responseJSON.message);

            bootbox.alert(
                "Error: " + datos.responseJSON.message
            );
        }
    });
}




//funcion para listar en el Datatable
function listarOrdenDetalle(id) {
   var tabla_orden = $("#detalle").DataTable({
        serverSide: true,
        bFilter: false,
        lengthChange: false,
        bPaginate: false,
        bInfo: false,
        retrieve: true,
        ajax: "api/listarDetalle/"+id,
        columns: [
            { data: "referencia_producto",name: "producto.referencia_producto"},
            { data: "a",name: "orden_pedido_detalle.a", orderable: false, searchable: false},
            { data: "b", name: "orden_pedido_detalle.b", orderable: false, searchable: false},
            { data: "c", name: "orden_pedido_detalle.c", orderable: false, searchable: false},
            { data: "d", name: "orden_pedido_detalle.d", orderable: false, searchable: false},
            { data: "e", name: "orden_pedido_detalle.e", orderable: false, searchable: false},
            { data: "f", name: "orden_pedido_detalle.f", orderable: false, searchable: false},
            { data: "g", name: "orden_pedido_detalle.g", orderable: false, searchable: false},
            { data: "h", name: "orden_pedido_detalle.h", orderable: false, searchable: false},
            { data: "i", name: "orden_pedido_detalle.i", orderable: false, searchable: false},
            { data: "j", name: "orden_pedido_detalle.j", orderable: false, searchable: false},
            { data: "k", name: "orden_pedido_detalle.k", orderable: false, searchable: false},
            { data: "l", name: "orden_pedido_detalle.l", orderable: false, searchable: false},
            { data: "total", name: "orden_pedido_detalle.total" },
            { data: "Opciones", orderable: false, searchable: false },
            { data: "manual", orderable: false, searchable: false },

        ],
    });
}
