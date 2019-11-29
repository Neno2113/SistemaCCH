$(document).ready(function() {
    $("[data-mask]").inputmask();

    var tabla;

    //Funcion que se ejecuta al inicio
    function init() {
        ordenPedidoCod();
        listar();
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

        var corte = {
            sec: $("#sec").val(),
            numero_corte: $("#numero_corte_gen").val(),
            producto_id: $("#productos").val(),
            fecha_entrega: $("#fecha_entrega").val(),
            no_marcada: $("#no_marcada").val(),
            ancho_marcada: $("#ancho_marcada").val(),
            largo_marcada: $("#largo_marcada").val(),
            aprovechamiento: $("#aprovechamiento").val()
        };

        // console.log(JSON.stringify(corte));

        // funcion que se ejecuta con el callback de la funcion para guardar
        //esta almacena las cantidades por tallas
        $.ajax({
            url: "corte",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Corte creado !!");
                    limpiar();
                    // tabla.ajax.reload();
                    mostrarForm(false);
                    $("#btn-generar").attr("disabled", false);

                    var talla = {
                        corte_id: datos.corte.id,
                        a: $("#a").val(),
                        b: $("#b").val(),
                        c: $("#c").val(),
                        d: $("#d").val(),
                        e: $("#e").val(),
                        f: $("#f").val(),
                        g: $("#g").val(),
                        h: $("#h").val(),
                        i: $("#i").val(),
                        j: $("#j").val(),
                        k: $("#k").val(),
                        l: $("#l").val()
                    };

                    $.ajax({
                        url: "talla",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(talla),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                                // tabla.ajax.reload();
                                bootbox.alert(
                                    "Se asignaron un total de: <strong>" +
                                        datos.talla.total +
                                        "</strong> entre todas las tallas digitadas"
                                );
                                $("#a").val(""),
                                    $("#b").val(""),
                                    $("#c").val(""),
                                    $("#d").val(""),
                                    $("#e").val(""),
                                    $("#f").val(""),
                                    $("#g").val(""),
                                    $("#h").val(""),
                                    $("#i").val(""),
                                    $("#j").val(""),
                                    $("#k").val(""),
                                    $("#l").val("");
                                // tabla.ajax.reload();
                                $("#cortes")
                                    .DataTable()
                                    .ajax.reload();
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
                { data: "total", name: "orden_pedido.total" },
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

        var id = $("#cortesSearch").val();

        $.ajax({
            url: "talla/search/" + id,
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se consulto correctamente!!");
                    $("#a").val(datos.talla.a);
                    $("#b").val(datos.talla.b);
                    $("#c").val(datos.talla.c);
                    $("#d").val(datos.talla.d);
                    $("#e").val(datos.talla.e);
                    $("#f").val(datos.talla.f);
                    $("#g").val(datos.talla.g);
                    $("#h").val(datos.talla.h);
                    $("#i").val(datos.talla.i);
                    $("#j").val(datos.talla.j);
                    $("#k").val(datos.talla.k);
                    $("#l").val(datos.talla.l);
                    $("#total").val(datos.talla.total);
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

    $("#empacado").click(function(e) {
        e.preventDefault();

        bootbox.alert({
            size: "small",
            title: "Introduzca la cantidad de bultos",
            message: "<input type='text' id='cant_bulto'>",
            callback: function() {
                var orden_empaque = {
                    id: $("#id").val(),
                    cant_bulto: $("#cant_bulto").val()
                }

                $.ajax({
                    url: "empacado",
                    type: "POST",
                    dataType: "json",
                    data: JSON.stringify(orden_empaque),
                    contentType: "application/json",
                    success: function(datos) {
                        if (datos.status == "success") {
                            $("#empacado_listo").show();
                            bootbox.alert(
                                "Marco que esta orden de empaque ha sido empacada!!"
                            );

                            $("#empacado").hide();
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
            }
        });
    });

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
        $("#btn-generar").show();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        $("#btn-generar").attr("disabled", false);
        mostrarForm(false);
    });

    init();
});
