$(document).ready(function() {
    $("[data-mask]").inputmask();

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
        // $("[data-mask]").inputmask();
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
        // $('input[name="c"]').inputmask("999");
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

    $('input[name="c"]').keyup(function(){
        alert('Hi');
    });

    init();
});


function inicio(){
    $("[data-mask]").inputmask();
    $('input[name="c"]').inputmask("999");

}


function aprobar(id_orden) {
    // e.preventDefault();
    Swal.fire({
        title: "¿Estas seguro de aprobar este pedido?",
        text: "Va a aprobar este pedido!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, acepto"
    }).then(result => {
        if (result.value) {
            $.post("orden-aprobacion/" + id_orden, function(data, status){
                Swal.fire(
                    "Aprobado!",
                    "Orden <strong>"+ data.orden.no_orden_pedido +"</strong> aprobada",
                    "success"
                );
                $("#ordenes_aprobacion").DataTable().ajax.reload();
                $("#ordenes_red").DataTable().ajax.reload();
            });
        }
    });
    // bootbox.confirm("¿Estas seguro de aprobar esta orden?", function(result){
    //     if(result){
    //         $.post("orden-aprobacion/" + id_orden, function(data, status){
    //             bootbox.alert("Orden <strong>"+ data.orden.no_orden_pedido +"</strong> aprobada." );

    //             $("#ordenes_aprobacion").DataTable().ajax.reload();
    //             $("#ordenes_red").DataTable().ajax.reload();
    //         })
    //     }
    // })
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
    Swal.fire({
        title: "¿Estas seguro de cancelar esta orden de pedido?",
        text: "Va a cancelar esta orden de  pedido!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, acepto"
    }).then(result => {
        if (result.value) {
            $.post("orden-cancelacion/" + id_orden, function(data, status){
                Swal.fire(
                    "Cancelada!",
                    "Orden <strong>"+ data.orden.no_orden_pedido +"</strong> cancelada.",
                    "success"
                );
                $("#ordenes_aprobacion").DataTable().ajax.reload();
                $("#ordenes_red").DataTable().ajax.reload();
            });
        }
    });
    // bootbox.confirm("¿Estas seguro de cancelar esta orden?", function(result){
    //     if(result){
    //         $.post("orden-cancelacion/" + id_orden, function(data, status){
    //             bootbox.alert("Orden <strong>"+ data.orden.no_orden_pedido +"</strong> cancelada." );

    //             $("#ordenes_aprobacion").DataTable().ajax.reload();
    //         })
    //     }
    // })
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
        // $("#detalle").empty();
        listarOrdenDetalle(data.orden.id);
        // for (let t = 0; t < data.detalle.length; t++) {
        //     var fila =
        //     '<tr id="fila">'+
        //     "<td>"+data.detalle[t].producto.referencia_producto+"</td>"+
        //     "<td><input type='text' name='a' id='a' class='form-control red' data-inputmask='"+'mask'+": "+'9[99]'+"' data-mask value="+data.detalle[t].a+"></td>"+
        //     "<td><input type='text' name='b' id='b' class='form-control red' value="+data.detalle[t].b+"></td>"+
        //     "<td><input type='text' name='c' id='c' class='form-control red' value="+data.detalle[t].c+"></td>"+
        //     "<td><input type='text' name='d' id='d' class='form-control red' value="+data.detalle[t].d+"></td>"+
        //     "<td><input type='text' name='e' id='e' class='form-control red' value="+data.detalle[t].e+"></td>"+
        //     "<td><input type='text' name='f' id='f' class='form-control red' value="+data.detalle[t].f+"></td>"+
        //     "<td><input type='text' name='g' id='g' class='form-control red' value="+data.detalle[t].g+"></td>"+
        //     "<td><input type='text' name='h' id='h' class='form-control red' value="+data.detalle[t].h+"></td>"+
        //     "<td><input type='text' name='i' id='i' class='form-control red' value="+data.detalle[t].i+"></td>"+
        //     "<td><input type='text' name='j' id='j' class='form-control red' value="+data.detalle[t].j+"></td>"+
        //     "<td><input type='text' name='k' id='k' class='form-control red' value="+data.detalle[t].k+"></td>"+
        //     "<td><input type='text' name='l' id='l' class='form-control red' value="+data.detalle[t].l+"></td>"+
        //     "<td><input type='text' id='total_talla' class='form-control red'  name='total_talla[]' value="+data.detalle[t].total+"></td>"+
        //     "<td><input type='text' id='total_talla' class='form-control red' name='total_talla[]' value="+data.detalle[t].total+"></td>"+
        //     "<td><input type='text' id='total_talla' class='form-control red' name='total_talla[]' value="+data.detalle[t].total+"></td>"+
        //     "<td><input type='text' id='total_talla' class='form-control red' name='total_talla[]' value="+data.detalle[t].total+"></td>"+
        //     "</tr>";
        //     $("#disponibles").append(fila);
        // }

        // $("[data-mask]").inputmask();

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
            validar(id_orden);
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

function validar(id){
    let a = parseInt($("#a"+id).val());
    let b = parseInt($("#b"+id).val());
    let c = parseInt($("#c"+id).val());
    let d = parseInt($("#d"+id).val());
    let e = parseInt($("#e"+id).val());
    let f = parseInt($("#f"+id).val());
    let g = parseInt($("#g"+id).val());
    let h = parseInt($("#h"+id).val());
    let i = parseInt($("#i"+id).val());
    let j = parseInt($("#j"+id).val());
    let k = parseInt($("#k"+id).val());
    let l = parseInt($("#l"+id).val());
    let total = $("#total"+id).val();

    let sum = a + b + c + d + e + f + g + h + i + j + k + l;

    if(sum > total){
        $("#red"+id).val(sum).addClass('text-danger');
        // total.attr('class', '')
        Swal.fire(
        'Alerta!',
        'El total ajustado es mayor a la cantidad del pedido!',
        'warning'
        )
    }else if(sum < total){
        $("#red"+id).val(sum).val(sum).addClass('text-danger');
        Swal.fire(
            'Alerta!',
            'El total ajustado es menor a la cantidad del pedido!',
            'warning'
            )
    }else{
        $("#red"+id).val(sum).removeClass('text-danger');
        $("#red"+id).val(sum).addClass('text-success');
        agregarDetalle(id);
    }

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
            { data: "a", name: "orden_pedido_detalle.a", orderable: false, searchable: false},
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
            { data: "total", name: "orden_pedido_detalle.total",  },
            { data: "cant_red", name: "orden_pedido_detalle.cant_red" },
            { data: "Opciones", orderable: false, searchable: false },
            { data: "manual", orderable: false, searchable: false },

        ],
    });
}


inicio();
