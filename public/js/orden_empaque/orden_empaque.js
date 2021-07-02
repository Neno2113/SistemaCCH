$(document).ready(function() {
    $("[data-mask]").inputmask();

    var tabla;

    //Funcion que se ejecuta al inicio
    function init() {
        ordenPedidoCod();
        listar();
        listarOrdenes();
        $("#empacado_listo").hide();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

    //funcion para limpiar el formulario(los inputs)
    function limpiar() {
        $("#numero_corte").val("");
        $("#sec").val("");
        $("#productos")
            .val("")
            .trigger("change");
        $("#fecha_entrega").val("");
        $("#no_marcada").val("");
        $("#corte").val("");
        $("#ancho_marcada").val("");
        $("#largo_marcada").val("");
        $("#aprovechamiento").val("");
    }

    function ordenPedidoCod() {
        $.ajax({
            url: "corte/lastdigit",
            type: "GET",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    var i = Number(datos.sec);
                    $("#sec").val(i);
                    i = (i + 0.01)
                        .toFixed(2)
                        .split(".")
                        .join("");
                    var year = new Date().getFullYear().toString();
                    var referencia = year + "-" + i;

                    $("#numero_corte_gen").val(referencia);
                    $("#corte").val(referencia);
                } else {
                    bootbox.alert("Ocurrio un error !!");
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });
    }

    //funcion que envia los datos del form al backend usando AJAX
    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var ordenFacturacion = {
            empaque_id: $("#orden_empaque_id").val(),
            por_transporte: $("input[name='r1']:checked").val(),
        };

        $.ajax({
            url: "orden_facturacion",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(ordenFacturacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#orden_facturacion_id").val(datos.orden_facturacion.id);
                    $("#listar_OE").DataTable().ajax.reload();
                    mostrarForm(false);


                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });


    });

    //funcion para listar en el Datatable
    function listar() {
        tabla = $("#listar_OE").DataTable({
            serverSide: true,
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
            ajax: "api/ordenes_aprobacion_empaque",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_orden_pedido",name: "orden_pedido.no_orden_pedido"},
                { data: "name", name: "users.name" },
                { data: "nombre_cliente", name: "cliente.nombre_cliente" },
                { data: "nombre_sucursal", name: "cliente_sucursales.nombre_sucursal"},
                { data: "fecha_aprobacion", name: "orden_pedido.fecha_aprobacion"},
                { data: "total", name: "orden_pedido.total", searchable: false },
                { data: "status_orden_pedido", name: "orden_pedido.status_orden_pedido"},
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" }
            ],
            order: [[2, "desc"]],
            rowGroup: {
                dataSrc: "nombre_cliente"
            }
        });
    }

     //funcion para listar en el Datatable
     function listarOrdenes() {
        tabla = $("#print_OE").DataTable({
            serverSide: true,
            responsive: true,
            dom: "Bfrtip",
            iDisplayLength: 10,
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
            ajax: "api/ordenes_empaque",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_orden_pedido",name: "orden_pedido.no_orden_pedido"},
                { data: "name", name: "users.name" },
                { data: "nombre_cliente", name: "cliente.nombre_cliente" },
                { data: "nombre_sucursal", name: "cliente_sucursales.nombre_sucursal"},
                { data: "fecha_aprobacion", name: "orden_pedido.fecha_aprobacion"},
                { data: "total", name: "orden_pedido.total", searchable: false },
                { data: "empaque_impreso", name: "orden_pedido.empaque_impreso", orderable: false, searchable: false},
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" }
            ],
            order: [[2, "desc"]],
            rowGroup: {
                dataSrc: "name"
            }
        });
    }




    //funcion para listar en el Datatable
    function listarOrdenDetalle(id) {
        tabla = $("#orden_detalle").DataTable({
            serverSide: true,
            responsive: true,
            dom: "Bfrtip",
            ajax: "api/orden_detalle/"+id,
            columns: [
                { data: "a",name: "orden_pedido_detalle.a"},
                { data: "b", name: "orden_pedido_detalle.b" },
                { data: "c", name: "orden_pedido_detalle.c" },
                { data: "d", name: "orden_pedido_detalle.d"},
                { data: "e", name: "orden_pedido_detalle.e"},
                { data: "f", name: "orden_pedido_detalle.f"},
                { data: "g", name: "orden_pedido_detalle.g"},
                { data: "h", name: "orden_pedido_detalle.h"},
                { data: "i", name: "orden_pedido_detalle.i"},
                { data: "j", name: "orden_pedido_detalle.j"},
                { data: "k", name: "orden_pedido_detalle.k"},
                { data: "l", name: "orden_pedido_detalle.l"},
                { data: "total", name: "orden_pedido_detalle.total"},

            ],
        });
    }


   function test(){
      return console.log("test")
   }

    //funcion para editar
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var corte = {
            id: $("#id").val(),
            producto_id: $("#productos").val(),
            no_marcada: $("#no_marcada").val(),
            ancho_marcada: $("#ancho_marcada").val(),
            largo_marcada: $("#largo_marcada").val(),
            aprovechamiento: $("#aprovechamiento").val()
        };

        $.ajax({
            url: "corte/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el usuario");
                    limpiar();
                    $("#cortes")
                        .DataTable()
                        .ajax.reload();
                    $("#id").val("");
                    $("#listadoUsers").show();
                    $("#registroForm").hide();
                    $("#btnCancelar").hide();
                    $("#btn-edit").hide();
                    $("#btn-guardar").show();
                    $("#btnAgregar").show();
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });
    });


    // function test(e){
    //     e.preventDefault();
    //     alert('Test');
    // }

    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").hide();

            $("#btn-edit").hide();
            $("#btn-guardar").show();
        }
    }

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        $("#btn-generar").show();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        mostrarForm(false);
    });

    init();
});


String.prototype.replaceAll = function (find, replace) {
    var str = this;
    return str.replace(new RegExp(find, 'g'), replace);
};

function mostrar(id_orden) {
    $("#disponibles").empty("");
    $.get("orden_empaque/" + id_orden, function(data, status) {
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").show();
        $("#btn-guardar").hide();

        $("#no_orden_pedido").val(data.orden_pedido.no_orden_pedido);
        $("#cliente").val(data.cliente.nombre_cliente);
        $("#sucursal").val(data.sucursal.nombre_sucursal);
        $("#fecha_entrega").val(data.orden_pedido.fecha_entrega);
        let longitud = data.orden_detalle.length
        var cont = 0;

        for (let i = 0; i < longitud; i++){
            var fila = "<tr>" +
                "<td class='talla-res' id='producto'>"+data.orden_detalle[i].producto.referencia_producto+"</th>" +
                "<td class='talla-res'>"+data.orden_detalle[i].a+"</th>" +
                "<td class='talla-res'>"+data.orden_detalle[i].b+"</td>" +
                "<td class='talla-res'>"+data.orden_detalle[i].c+"</td>"+
                "<td class='talla-res'>"+data.orden_detalle[i].d+"</td>"+
                "<td class='talla-res'>"+data.orden_detalle[i].e+"</td>"+
                "<td class='talla-res'>"+data.orden_detalle[i].f+"</td>"+
                "<td class='talla-res'>"+data.orden_detalle[i].g+"</td>"+
                "<td class='talla-res'>"+data.orden_detalle[i].h+"</td>"+
                "<td class='talla-res'>"+data.orden_detalle[i].i+"</td>" +
                "<td class='talla-res'>"+data.orden_detalle[i].j+"</td>"+
                "<td class='talla-res'>"+data.orden_detalle[i].k+"</td>"+
                "<td class='talla-res'>"+data.orden_detalle[i].l+"</td>"+
                "<td class='talla-res' id='total'>"+data.orden_detalle[i].total+"</td>"+
                "</tr>"
                fila = fila.replaceAll('null', '');
                $("#disponibles").append(fila);
        }

    });
}


