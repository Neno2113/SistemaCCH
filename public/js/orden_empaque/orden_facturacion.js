$(document).ready(function() {
    $("[data-mask]").inputmask();

    var tabla;
    var tabla_orden;

    //Funcion que se ejecuta al inicio
    function init() {
        ordenfacturacionCod();
        listar();
        $("#empacado_listo").hide();

        mostrarForm(false);
        $("#btn-edit").hide();
    }

    //funcion para limpiar el formulario(los inputs)
    function limpiar() {
        $("#orden_pedido").val("");
        $("#cliente").val("");
        $("#sucursal").val("");
        $("#empaque_detalle")
            .DataTable()
            .destroy();
        $("#ordenEmpaqueSearch")
            .val("")
            .trigger("change");
    }

    function ordenfacturacionCod() {
        $.ajax({
            url: "ordenfacturacion/lastdigit",
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

                    var referencia = "OF-" + i;

                    $("#no_orden_facturacion").val(referencia);
                } else {
                    bootbox.alert("Ocurrio un error !!");
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });
    }

    $("#ordenEmpaqueSearch").select2({
        placeholder: "Numero de orden de empaque",
        ajax: {
            url: "selectEmpaque",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.no_orden_empaque,
                            id: item.id
                        };
                    })
                };
            },
            cache: true
        }
    });

    //funcion que envia los datos del form al backend usando AJAX
    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var ordenFacturacion = {
            sec: $("#sec").val(),
            no_orden_facturacion: $("#no_orden_facturacion").val(),
            empaque_id: $("#ordenEmpaqueSearch").val()
        };

        // console.log(JSON.stringify(ordenFacturacion));

        $.ajax({
            url: "orden_facturacion",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(ordenFacturacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Corte creado !!");
                    limpiar();
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
        tabla = $("#ordenes_aprobacion").DataTable({
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
                {
                    data: "no_orden_pedido",
                    name: "orden_pedido.no_orden_pedido"
                },
                { data: "name", name: "users.name" },
                { data: "nombre_cliente", name: "cliente.nombre_cliente" },
                {
                    data: "nombre_sucursal",
                    name: "cliente_sucursales.nombre_sucursal"
                },
                {
                    data: "fecha_aprobacion",
                    name: "orden_pedido.fecha_aprobacion"
                },
                {
                    data: "total",
                    name: "orden_pedido.total",
                    searchable: false
                },
                {
                    data: "status_orden_pedido",
                    name: "orden_pedido.status_orden_pedido"
                },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" }
            ],
            order: [[2, "desc"]],
            rowGroup: {
                dataSrc: "name"
            }
        });
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

    $("#btn-buscar").click(function(e) {
        e.preventDefault();

        var empaque = {
            id: $("#ordenEmpaqueSearch").val()
        };

        $.ajax({
            url: "empaque/search",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(empaque),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#empaque_detalle")
                        .DataTable()
                        .destroy();
                    listarEmpaqueDetalle(datos.orden_empaque.id);
                    $("#cliente").val(
                        datos.orden_pedido.cliente.nombre_cliente
                    );
                    $("#sucursal").val(
                        datos.orden_pedido.sucursal.nombre_sucursal
                    );
                    $("#orden_pedido").val(datos.orden_pedido.no_orden_pedido);
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
    function listarEmpaqueDetalle(id) {
        tabla_orden = $("#empaque_detalle").DataTable({
            serverSide: true,
            bFilter: false,
            lengthChange: false,
            bPaginate: false,
            bInfo: false,
            retrieve: true,
            ajax: "api/empaque_detalle/" + id,
            columns: [
                {
                    data: "referencia_producto",
                    name: "producto.referencia_producto"
                },
                { data: "a", name: "orden_empaque_detalle.a" },
                { data: "b", name: "orden_empaque_detalle.b" },
                { data: "c", name: "orden_empaque_detalle.c" },
                { data: "d", name: "orden_empaque_detalle.d" },
                { data: "e", name: "orden_empaque_detalle.e" },
                { data: "f", name: "orden_empaque_detalle.f" },
                { data: "g", name: "orden_empaque_detalle.g" },
                { data: "h", name: "orden_empaque_detalle.h" },
                { data: "i", name: "orden_empaque_detalle.i" },
                { data: "j", name: "orden_empaque_detalle.j" },
                { data: "k", name: "orden_empaque_detalle.k" },
                { data: "l", name: "orden_empaque_detalle.l" },
                { data: "total", name: "orden_empaque_detalle.total" },
                { data: "Opciones", orderable: false, searchable: false }
            ]
        });

        $("#empaque_detalle")
            .DataTable()
            .ajax.reload();
    }

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
            $("#btnAgregar").show();

            $("#btn-edit").hide();
            $("#btn-guardar").show();
        }
    }

    $("#btnAgregar").click(function(e) {
        $("#btn-generar").show();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        $("#btn-generar").attr("disabled", false);
        mostrarForm(false);
    });

    init();
});
