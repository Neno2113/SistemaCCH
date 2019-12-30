$(document).ready(function() {
    $("[data-mask]").inputmask();

    function init() {
        // $("input[name='r1']:checked").val("");
        limpiar();
        mostrarDetalle();
        // mostrarForm(false);
        $("#cantidad").val("");
        $("#precio").val("");
        $("#total").val("");
        $("#btn-edit").hide();
        $("#no_orden_pedido").val("");
        // $("#corte_en_proceso").hide();
        $("#detallada").hide();
        // ordenPedidoCod();
        $("#btn-consultar").hide();
        $("#precio_div").hide();
        $("#total_div").hide();
        $("#btn-agregar").hide();
        listar();
        $("#registroForm").hide();
        $("#btnCancelar").hide();
        // $("#btn-agregarProceso").attr("disabled", true);
        $("#total").val("");
        listarRedistribucion();
        listarOrdenesProceso();
        listarOrden();
        $("#cliente").hide();
        $("#sucursal").hide();
        $("#generado_internamente").hide();
        $("#listarOrden").hide();
        $("#orden_detalle").hide();
        $("#orden_create").show();
    }

    var data;

    String.prototype.replaceAll = function(find, replace) {
        var str = this;
        return str.replace(new RegExp(find, "g"), replace);
    };

    function mostrarDetalle(flag) {
        if (flag) {
            $("#ta").show();
            $("#tb").show();
            $("#tc").show();
            $("#td").show();
            $("#te").show();
            $("#tf").show();
            $("#tg").show();
            $("#th").show();
            $("#ti").show();
            $("#tj").show();
            $("#tk").show();
            $("#tl").show();
            $("#detallada").show();
            $("#redistribucion").hide();
            $("#detalles").show();
            $("#corte_en_proceso").show();
        } else {
            $("#ta").hide();
            $("#tb").hide();
            $("#tc").hide();
            $("#td").hide();
            $("#te").hide();
            $("#tf").hide();
            $("#tg").hide();
            $("#th").hide();
            $("#ti").hide();
            $("#tj").hide();
            $("#tk").hide();
            $("#tl").hide();
            $("#detallada").hide();
            $("#redistribucion").show();
            $("#detalles").hide();
            $("#corte_en_proceso").hide();
        }
    }

    function limpiar() {
        // $("#no_orden_pedido").val("");
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
        $("#orden_pedido_id").val("");
        $("#orden_pedido_id_proceso").val("");
        $("#sec").val("");
        $("#sec_proceso").val();
        $("#clienteSearch")
            .val("")
            .trigger("change");
        $("#sucursalSearch")
            .val("")
            .trigger("change");
        $("#productoSearch")
            .val("")
            .trigger("change");
        $("#notas").val("");
        $("#fecha_entrega").val("");
        $("#cantidad").val("");
        $("#precio").val("");
        $("#corte_proceso").val("");
        $("#orden_pedido").empty();
    }

    $("#btn-generar").click(function(e) {
        e.preventDefault();

        $("#sec").val("");
        $("#no_orden_pedido").val("");
        $.ajax({
            url: "ordenPedido/lastdigit",
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

                    $("#no_orden_pedido").val("OP-" + i);

                    let sucursal = $("#sucursalSearch").val();

                    if (sucursal) {
                        sucursal = $("#sucursalSearch").val();
                    } else {
                        sucursal = 2;
                    }

                    var orden = {
                        cliente: $("#clienteSearch").val(),
                        sucursal: sucursal,
                        notas: $("#notas").val(),
                        fecha_entrega: $("#fecha_entrega").val(),
                        generado_internamente: $(
                            "input[name='r1']:checked"
                        ).val(),
                        detallada: $("input[name='r2']:checked").val(),
                        sec: $("#sec").val(),
                        no_orden_pedido: $("#no_orden_pedido").val()
                    };

                    $.ajax({
                        url: "orden",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(orden),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                                $("#orden_create").hide();
                                $("#orden_detalle").show();
                                $("#sec_proceso").val(Number(datos.orden.sec));
                                i_2 = datos.orden.sec;
                                i_2 = (i_2 + 0.01)
                                    .toFixed(2)
                                    .split(".")
                                    .join("");
                                $("#no_orden_pedido_proceso").val("OP-" + i_2);

                                // $("#registroForm").hide();
                                $("#ordenes")
                                    .DataTable()
                                    .ajax.reload();
                                // $("#listadoUsers").show();
                                $("#orden_pedido_id").val(datos.orden.id);
                                bootbox.alert(
                                    "Orden <strong>OP-" +
                                        i +
                                        "</strong> generada correctamente."
                                );
                                $("#btn-generar").attr("disabled", true);
                            } else {
                                bootbox.alert(
                                    "Ocurrio un error durante la creacion de la composicion"
                                );
                            }
                        },
                        error: function(datos) {
                            console.log(datos.responseJSON.errors);
                            let errores = datos.responseJSON.errors;

                            Object.entries(errores).forEach(([key, val]) => {
                                bootbox.alert({
                                    message:
                                        "<h4 class='invalid-feedback d-block'>" +
                                        val +
                                        "</h4>",
                                    size: "small"
                                });
                            });
                        }
                    });
                } else {
                    bootbox.alert("Ocurrio un error !!");
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });
    });

    function validarNan(val) {
        if (isNaN(val) || val < 0) {
            return 0;
        } else {
            return val;
        }
    }

    // function validarExistencia(val){
    //     if(val < 0 || val == 0 ){
    //         return alert("Funcion ejecutada!!");
    //         // Bootbox.alert("Actualmente no hay en existencias de la talla" + val);
    //     } else {
    //         return val;
    //     }
    // }

    $("#cantidad").keyup(function() {
        $("#btn-consultar").show();
        $("#precio_div").show();
        $("#total_div").show();
    });

    $("input[name='r2']").change(function() {
        let val = $("input[name='r2']:checked").val();

        if (val == 1) {
            $("#btn-consultar").show();
            $("#btn-consultar").attr("disabled", false);
        } else if (val == 0) {
            $("#btn-consultar").attr("disabled", false);
        }
    });

    $("#productoSearch").select2({
        placeholder: "Referencia producto Ej: P100-XXXX",
        ajax: {
            url: "selectproducto",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.referencia_producto + " - " + item.fase,
                            id: item.id
                        };
                    })
                };
            },
            cache: true
        }
    });

    $("#clienteSearch").select2({
        placeholder: "Nombre del cliente",
        ajax: {
            url: "selectCliente",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text:
                                item.nombre_cliente +
                                " - " +
                                item.contacto_cliente_principal,
                            id: item.id
                        };
                    })
                };
            },
            cache: true
        }
    });

    $("#sucursalSearch").select2({
        placeholder: "Nombre sucursal",
        ajax: {
            url: "selectSucursal",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.nombre_sucursal,
                            id: item.id
                        };
                    })
                };
            },
            cache: true
        }
    });

    $("#btn-consultar").click(function(e) {
        e.preventDefault();
        let val = $("input[name='r2']:checked").val();

        if (val == 1) {
            mostrarDetalle(true);

            var ordenDetalle = {
                producto_id: $("#productoSearch").val(),
                referencia_producto: $("#productoSearch option:selected").text()
            };

            $.ajax({
                url: "ordenPedido/consulta",
                type: "POST",
                dataType: "json",
                data: JSON.stringify(ordenDetalle),
                contentType: "application/json",
                success: function(datos) {
                    if (datos.status == "success") {
                        data = datos;

                        let corte_proceso = datos.corte_proceso;
                        let fecha_entrega = datos.fecha_entrega;
                        let precio = datos.producto.precio_venta_publico;
                        precio = precio.replace(".00", "")
                        console.log(precio);
                        var ref = $("#productoSearch option:selected").text();
                        $("#precio").val(precio);
                        $("#total").val(datos.total_corte);
                        $("#precio_div").show();
                        $("#total_div").show();
                        $("#btn-agregar").show();
                        $("#btn-consultar").attr("disabled", true);
                        $("#btn-agregar").attr("disabled", false);
                        var genero = ref.substring(1, 2);
                        var mujer_plus = ref.substring(3, 4);
                        if (genero == 1) {
                            $("#sub-genero").hide();
                            $("#ta").html("28");
                            $("#tb").html("29");
                            $("#tc").html("30");
                            $("#td").html("32");
                            $("#te").html("34");
                            $("#tf").html("36");
                            $("#tg").html("38");
                            $("#th").html("40");
                            $("#ti").html("42");
                            $("#tj").html("44");
                            $("#da").html("28");
                            $("#db").html("29");
                            $("#dc").html("30");
                            $("#dd").html("32");
                            $("#de").html("34");
                            $("#df").html("36");
                            $("#dg").html("38");
                            $("#dh").html("40");
                            $("#di").html("42");
                            $("#dj").html("44");
                            $("#i").attr("disabled", false);
                            $("#j").attr("disabled", false);
                            $("#k").attr("disabled", true);
                            $("#l").attr("disabled", true);
                            $("#kp").hide();
                            $("#lp").hide();

                            $("#a").attr("placeholder", "28");
                            $("#b").attr("placeholder", "29");
                            $("#c").attr("placeholder", "30");
                            $("#d").attr("placeholder", "32");
                            $("#e").attr("placeholder", "34");
                            $("#f").attr("placeholder", "36");
                            $("#g").attr("placeholder", "38");
                            $("#h").attr("placeholder", "40");
                            $("#i").attr("placeholder", "42");
                            $("#j").attr("placeholder", "44");
                            $("#k").attr("placeholder", "");
                            $("#l").attr("placeholder", "");

                         

                            $("#disponibles").html(
                                "<tr id='cortes'>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    validarNan(datos.a) +
                                    "</th>" +
                                    "<th id='b_corte' class='font-weight-normal'>" +
                                    validarNan(datos.b) +
                                    "</th>" +
                                    "<th id='c_corte' class='font-weight-normal'>" +
                                    validarNan(datos.c) +
                                    "</th>" +
                                    "<th id='d_corte' class='font-weight-normal'>" +
                                    validarNan(datos.d) +
                                    "</th>" +
                                    "<th id='e_corte' class='font-weight-normal'>" +
                                    validarNan(datos.e) +
                                    "</th>" +
                                    "<th id='f_corte' class='font-weight-normal'>" +
                                    validarNan(datos.f) +
                                    "</th>" +
                                    "<th id='g_corte' class='font-weight-normal'>" +
                                    validarNan(datos.g) +
                                    "</th>" +
                                    "<th id='h_corte' class='font-weight-normal'>" +
                                    validarNan(datos.h) +
                                    "</th>" +
                                    "<th id='i_corte' class='font-weight-normal'>" +
                                    validarNan(datos.i) +
                                    "</th>" +
                                    "<th id='j_corte' class='font-weight-normal'>" +
                                    validarNan(datos.j) +
                                    "</th>" +
                                    "</tr>"
                            );
                            let data_consulta = {
                                a: data.a,
                                b: data.b,
                                c: data.c,
                                d: data.d,
                                e: data.e,
                                f: data.f,
                                g: data.g,
                                h: data.h,
                                i: data.i,
                                j: data.j
                            };

                            let consulta = Object.values(data_consulta);
                            var result = true;

                            for (let i = 0; i < consulta.length; i++) {
                                if (consulta[i] <= 0) {
                                    bootbox.alert(
                                        "Alerta existe una de las tallas la cual su existencia es igual a 0"
                                    );
                                    result = false;
                                    break;
                                }
                            }
                        } else if (genero == 3) {
                            $("#sub-genero").hide();
                            $("#ta").html("2");
                            $("#tb").html("4");
                            $("#tc").html("6");
                            $("#td").html("8");
                            $("#te").html("10");
                            $("#tf").html("12");
                            $("#tg").html("14");
                            $("#th").html("16");
                            $("#da").html("2");
                            $("#db").html("4");
                            $("#dc").html("6");
                            $("#dd").html("8");
                            $("#de").html("10");
                            $("#df").html("12");
                            $("#dg").html("14");
                            $("#dh").html("16");
                            $("#i").attr("disabled", true);
                            $("#j").attr("disabled", true);
                            $("#k").attr("disabled", true);
                            $("#l").attr("disabled", true);

                            $("#a").attr("placeholder", "2");
                            $("#b").attr("placeholder", "4");
                            $("#c").attr("placeholder", "6");
                            $("#d").attr("placeholder", "8");
                            $("#e").attr("placeholder", "10");
                            $("#f").attr("placeholder", "12");
                            $("#g").attr("placeholder", "14");
                            $("#h").attr("placeholder", "16");
                            $("#i").attr("placeholder", "");
                            $("#j").attr("placeholder", "");
                            $("#k").attr("placeholder", "");
                            $("#l").attr("placeholder", "");


                            $("#disponibles").html(
                                "<tr id='cortes'>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    validarNan(datos.a) +
                                    "</th>" +
                                    "<th id='b_corte' class='font-weight-normal'>" +
                                    validarNan(datos.b) +
                                    "</th>" +
                                    "<th id='c_corte' class='font-weight-normal'>" +
                                    validarNan(datos.c) +
                                    "</th>" +
                                    "<th id='d_corte' class='font-weight-normal'>" +
                                    validarNan(datos.d) +
                                    "</th>" +
                                    "<th id='e_corte' class='font-weight-normal'>" +
                                    validarNan(datos.e) +
                                    "</th>" +
                                    "<th id='f_corte' class='font-weight-normal'>" +
                                    validarNan(datos.f) +
                                    "</th>" +
                                    "<th id='g_corte' class='font-weight-normal'>" +
                                    validarNan(datos.g) +
                                    "</th>" +
                                    "<th id='h_corte' class='font-weight-normal'>" +
                                    validarNan(datos.h) +
                                    "</th>" +
                                    "<th id='i_corte' class='font-weight-normal'>" +
                                    "</th>" +
                                    "<th id='j_corte' class='font-weight-normal'>" +
                                    "</th>" +
                                    "<th id='k_corte' class='font-weight-normal'>" +
                                    "</th>" +
                                    "<th id='l_corte' class='font-weight-normal'>" +
                                    "</th>" +
                                    "</tr>"
                            );
                            let data_consulta = {
                                a: data.a,
                                b: data.b,
                                c: data.c,
                                d: data.d,
                                e: data.e,
                                f: data.f,
                                g: data.g,
                                h: data.h
                            };

                            let consulta = Object.values(data_consulta);
                            var result = true;

                            for (let i = 0; i < consulta.length; i++) {
                                if (consulta[i] <= 0) {
                                    bootbox.alert(
                                        "Alerta existe una de las tallas la cual su existencia es igual a 0"
                                    );
                                    result = false;
                                    break;
                                }
                            }
                        } else if (genero == 4) {
                            $("#sub-genero").hide();
                            $("#ta").html("2");
                            $("#tb").html("4");
                            $("#tc").html("6");
                            $("#td").html("8");
                            $("#te").html("10");
                            $("#tf").html("12");
                            $("#tg").html("14");
                            $("#th").html("16");
                            $("#da").html("2");
                            $("#db").html("4");
                            $("#dc").html("6");
                            $("#dd").html("8");
                            $("#de").html("10");
                            $("#df").html("12");
                            $("#dg").html("14");
                            $("#dh").html("16");
                            $("#i").attr("disabled", true);
                            $("#j").attr("disabled", true);
                            $("#k").attr("disabled", true);
                            $("#l").attr("disabled", true);

                            $("#a").attr("placeholder", "2");
                            $("#b").attr("placeholder", "4");
                            $("#c").attr("placeholder", "6");
                            $("#d").attr("placeholder", "8");
                            $("#e").attr("placeholder", "10");
                            $("#f").attr("placeholder", "12");
                            $("#g").attr("placeholder", "14");
                            $("#h").attr("placeholder", "16");
                            $("#i").attr("placeholder", "");
                            $("#j").attr("placeholder", "");
                            $("#k").attr("placeholder", "");
                            $("#l").attr("placeholder", "");


                            $("#disponibles").html(
                                "<tr id='cortes'>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    validarNan(datos.a) +
                                    "</th>" +
                                    "<th id='b_corte' class='font-weight-normal'>" +
                                    validarNan(datos.b) +
                                    "</th>" +
                                    "<th id='c_corte' class='font-weight-normal'>" +
                                    validarNan(datos.c) +
                                    "</th>" +
                                    "<th id='d_corte' class='font-weight-normal'>" +
                                    validarNan(datos.d) +
                                    "</th>" +
                                    "<th id='e_corte' class='font-weight-normal'>" +
                                    validarNan(datos.e) +
                                    "</th>" +
                                    "<th id='f_corte' class='font-weight-normal'>" +
                                    validarNan(datos.f) +
                                    "</th>" +
                                    "<th id='g_corte' class='font-weight-normal'>" +
                                    validarNan(datos.g) +
                                    "</th>" +
                                    "<th id='h_corte' class='font-weight-normal'>" +
                                    validarNan(datos.h) +
                                    "</th>" +
                                    "<th id='i_corte' class='font-weight-normal'>" +
                                    "</th>" +
                                    "<th id='j_corte' class='font-weight-normal'>" +
                                    "</th>" +
                                    "<th id='k_corte' class='font-weight-normal'>" +
                                    "</th>" +
                                    "<th id='l_corte' class='font-weight-normal'>" +
                                    "</th>" +
                                    "</tr>"
                            );

                            let data_consulta = {
                                a: data.a,
                                b: data.b,
                                c: data.c,
                                d: data.d,
                                e: data.e,
                                f: data.f,
                                g: data.g,
                                h: data.h
                            };

                            let consulta = Object.values(data_consulta);
                            var result = true;

                            for (let i = 0; i < consulta.length; i++) {
                                if (consulta[i] <= 0) {
                                    bootbox.alert(
                                        "Alerta existe una de las tallas la cual su existencia es igual a 0"
                                    );
                                    result = false;
                                    break;
                                }
                            }
                        }
                        if (genero == 2) {
                            if (mujer_plus == 7) {
                                $("#sub-genero").show();
                                $("#ta").html("12W");
                                $("#tb").html("14W");
                                $("#tc").html("16W");
                                $("#td").html("18W");
                                $("#te").html("20W");
                                $("#tf").html("22W");
                                $("#tg").html("24W");
                                $("#th").html("26W");
                                $("#da").html("12W");
                                $("#db").html("14W");
                                $("#dc").html("16W");
                                $("#dd").html("18W");
                                $("#de").html("20W");
                                $("#df").html("22W");
                                $("#dg").html("24W");
                                $("#dh").html("26W");
                                $("#i").attr("disabled", true);
                                $("#j").attr("disabled", true);
                                $("#k").attr("disabled", true);
                                $("#l").attr("disabled", true);
                               
                                $("#a").attr("placeholder", "12W");
                                $("#b").attr("placeholder", "14W");
                                $("#c").attr("placeholder", "16W");
                                $("#d").attr("placeholder", "18W");
                                $("#e").attr("placeholder", "20W");
                                $("#f").attr("placeholder", "22W");
                                $("#g").attr("placeholder", "24W");
                                $("#h").attr("placeholder", "26W");
                                $("#i").attr("placeholder", "");
                                $("#j").attr("placeholder", "");
                                $("#k").attr("placeholder", "");
                                $("#l").attr("placeholder", "");

                               
                            } else {
                                $("#ta").html("0/0");
                                $("#tb").html("1/2");
                                $("#tc").html("3/4");
                                $("#td").html("5/6");
                                $("#te").html("7/8");
                                $("#tf").html("9/10");
                                $("#tg").html("11/12");
                                $("#th").html("13/14");
                                $("#ti").html("15/16");
                                $("#tj").html("17/18");
                                $("#tk").html("19/20");
                                $("#tl").html("21/22");
                                $("#da").html("0/0");
                                $("#db").html("1/2");
                                $("#dc").html("3/4");
                                $("#dd").html("5/6");
                                $("#de").html("7/8");
                                $("#df").html("9/10");
                                $("#dg").html("11/12");
                                $("#dh").html("13/14");
                                $("#di").html("15/16");
                                $("#dj").html("17/18");
                                $("#dk").html("19/20");
                                $("#dl").html("21/22");
                                $("#i").attr("disabled", false);
                                $("#j").attr("disabled", false);
                                $("#k").attr("disabled", false);
                                $("#l").attr("disabled", false);

                                $("#a").attr("placeholder", "0/0");
                                $("#b").attr("placeholder", "1/2");
                                $("#c").attr("placeholder", "3/4");
                                $("#d").attr("placeholder", "5/6");
                                $("#e").attr("placeholder", "7/8");
                                $("#f").attr("placeholder", "9/10");
                                $("#g").attr("placeholder", "11/12");
                                $("#h").attr("placeholder", "13/14");
                                $("#i").attr("placeholder", "15/16");
                                $("#j").attr("placeholder", "17/18");
                                $("#k").attr("placeholder", "19/20");
                                $("#l").attr("placeholder", "21/22");

                                $("#disponibles").html(
                                    "<tr id='cortes'>" +
                                        "<th id='a_corte' class='font-weight-normal'>" +
                                        validarNan(datos.a) +
                                        "</th>" +
                                        "<th id='b_corte' class='font-weight-normal'>" +
                                        validarNan(datos.b) +
                                        "</th>" +
                                        "<th id='c_corte' class='font-weight-normal'>" +
                                        validarNan(datos.c) +
                                        "</th>" +
                                        "<th id='d_corte' class='font-weight-normal'>" +
                                        validarNan(datos.d) +
                                        "</th>" +
                                        "<th id='e_corte' class='font-weight-normal'>" +
                                        validarNan(datos.e) +
                                        "</th>" +
                                        "<th id='f_corte' class='font-weight-normal'>" +
                                        validarNan(datos.f) +
                                        "</th>" +
                                        "<th id='g_corte' class='font-weight-normal'>" +
                                        validarNan(datos.g) +
                                        "</th>" +
                                        "<th id='h_corte' class='font-weight-normal'>" +
                                        validarNan(datos.h) +
                                        "</th>" +
                                        "<th id='i_corte' class='font-weight-normal'>" +
                                        validarNan(datos.i) +
                                        "</th>" +
                                        "<th id='j_corte' class='font-weight-normal'>" +
                                        validarNan(datos.j) +
                                        "</th>" +
                                        "<th id='k_corte' class='font-weight-normal'>" +
                                        validarNan(datos.k) +
                                        "</th>" +
                                        "<th id='l_corte' class='font-weight-normal'>" +
                                        validarNan(datos.l) +
                                        "</th>" +
                                        "</tr>"
                                );
                                let data_consulta = {
                                    a: data.a,
                                    b: data.b,
                                    c: data.c,
                                    d: data.d,
                                    e: data.e,
                                    f: data.f,
                                    g: data.g,
                                    h: data.h,
                                    i: data.i,
                                    j: data.j,
                                    k: data.k,
                                    l: data.l
                                };

                                let consulta = Object.values(data_consulta);
                                var result = true;

                                for (let i = 0; i < consulta.length; i++) {
                                    if (consulta[i] <= 0) {
                                        bootbox.alert(
                                            "Alerta existe una de las tallas la cual su existencia es igual a 0"
                                        );
                                        result = false;
                                        break;
                                    }
                                }
                            }
                        }

                        if (corte_proceso != "" && fecha_entrega != "") {
                            $("#no_corte").html(corte_proceso.numero_corte);
                            $("#fase").html(corte_proceso.fase);
                            $("#f_entrega").html(fecha_entrega);
                            $("#fecha_proceso").val(
                                corte_proceso.fecha_entrega
                            );
                        } else if (
                            corte_proceso == null &&
                            fecha_entrega == ""
                        ) {
                            $("#corte_en_proceso").hide();
                        }
                    } else {
                        bootbox.alert(
                            "Ocurrio un error durante la creacion de la composicion"
                        );
                    }
                },
                error: function(datos) {
                    console.log(datos.responseJSON.message);

                    bootbox.alert("Error: " + datos.responseJSON.message);
                }
            });
        } else if (val == 0) {
            mostrarDetalle(false);

            var ordenPedido = {
                producto_id: $("#productoSearch").val(),
                referencia_producto: $("#productoSearch option:selected").text()
            };

            $.ajax({
                url: "ordenPedido/consulta",
                type: "POST",
                dataType: "json",
                data: JSON.stringify(ordenPedido),
                contentType: "application/json",
                success: function(datos) {
                    if (datos.status == "success") {
                        $("#btn-agregar").show();
                        data = datos;

                        let cantidad_wrx = $("#cantidad").val();
                        let total_corte = datos.total_corte;
                        let precio = datos.producto.precio_venta_publico;
                        precio = precio.replace(".00", "")
                        $("#precio").val(precio);
                        $("#total").val(datos.total_corte);

                        if (cantidad_wrx > total_corte) {
                            bootbox.alert(
                                "La cantidad digitada <strong>" +
                                    cantidad_wrx +
                                    "</strong> es mayor a la cantidad total en almacen <strong>" +
                                    total_corte +
                                    "</strong>"
                            );
                            $("#btn-agregar").attr("disabled", true);
                        } else {
                            $("#btn-agregar").attr("disabled", false);
                        }
                    } else {
                        bootbox.alert(
                            "Ocurrio un error durante la creacion de la composicion"
                        );
                    }
                },
                error: function(datos) {
                    console.log(datos.responseJSON.message);

                    bootbox.alert("Error: " + datos.responseJSON.message);
                }
            });
        }
    });

    var cont;
    var cantidad;

    $("#btn-agregar").click(function(t) {
        t.preventDefault();

        let a = validarNan(parseInt($("#a").val()));
        let b = validarNan(parseInt($("#b").val()));
        let c = validarNan(parseInt($("#c").val()));
        let d = validarNan(parseInt($("#d").val()));
        let e = validarNan(parseInt($("#e").val()));
        let f = validarNan(parseInt($("#f").val()));
        let g = validarNan(parseInt($("#g").val()));
        let h = validarNan(parseInt($("#h").val()));
        let i = validarNan(parseInt($("#i").val()));
        let j = validarNan(parseInt($("#j").val()));
        let k = validarNan(parseInt($("#k").val()));
        let l = validarNan(parseInt($("#l").val()));
        let referencia = $("#productoSearch option:selected").text();
        let producto = referencia.substring(0, 9);
        let genero = producto.substring(1, 2);
        let subGenero = $("#sub-genero").val();
        let val = $("input[name='r2']:checked").val();
        let cantidad_wr = $("#cantidad").val();
        let precio = $("#precio").val();

        var cont;

        if (genero == 1) {
            if (val == 1) {
                cantidad = Number(a + b + c + d + e + f + g + h + i + j);
                var fila =
                    '<tr id="fila' +
                    cont +
                    '">' +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    producto +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    precio +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    cantidad +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    a +
                    "</th>" +
                    "<th id='b_corte' class='font-weight-normal'>" +
                    b +
                    "</th>" +
                    "<th id='c_corte' class='font-weight-normal'>" +
                    c +
                    "</th>" +
                    "<th id='d_corte' class='font-weight-normal'>" +
                    d +
                    "</th>" +
                    "<th id='e_corte' class='font-weight-normal'>" +
                    e +
                    "</th>" +
                    "<th id='f_corte' class='font-weight-normal'>" +
                    f +
                    "</th>" +
                    "<th id='g_corte' class='font-weight-normal'>" +
                    g +
                    "</th>" +
                    "<th id='h_corte' class='font-weight-normal'>" +
                    h +
                    "</th>" +
                    "<th id='i_corte' class='font-weight-normal'>" +
                    i +
                    "</th>" +
                    "<th id='j_corte' class='font-weight-normal'>" +
                    j +
                    "</th>" +
                    "</tr>";
                cont++;
                $("#orden_pedido").append(fila);
            } else if (val == 0) {
                // let cantidad_wr = $("#cantidad").val();
                var fila =
                    '<tr id="fila' +
                    cont +
                    '">' +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    producto +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    precio +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    cantidad_wr +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'></th>" +
                    "<th id='b_corte' class='font-weight-normal'></th>" +
                    "<th id='c_corte' class='font-weight-normal'></th>" +
                    "<th id='d_corte' class='font-weight-normal'></th>" +
                    "<th id='e_corte' class='font-weight-normal'></th>" +
                    "<th id='f_corte' class='font-weight-normal'></th>" +
                    "<th id='g_corte' class='font-weight-normal'></th>" +
                    "<th id='h_corte' class='font-weight-normal'></th>" +
                    "<th id='i_corte' class='font-weight-normal'></th>" +
                    "<th id='j_corte' class='font-weight-normal'></th>" +
                    "</tr>";
                cont++;
                $("#orden_pedido").append(fila);
            }
        } else if (genero == 3) {
            if (val == 1) {
                cantidad = Number(a + b + c + d + e + f + g + h);
                var fila =
                    '<tr id="fila' +
                    cont +
                    '">' +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    producto +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    precio +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    cantidad +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    a +
                    "</th>" +
                    "<th id='b_corte' class='font-weight-normal'>" +
                    b +
                    "</th>" +
                    "<th id='c_corte' class='font-weight-normal'>" +
                    c +
                    "</th>" +
                    "<th id='d_corte' class='font-weight-normal'>" +
                    d +
                    "</th>" +
                    "<th id='e_corte' class='font-weight-normal'>" +
                    e +
                    "</th>" +
                    "<th id='f_corte' class='font-weight-normal'>" +
                    f +
                    "</th>" +
                    "<th id='g_corte' class='font-weight-normal'>" +
                    g +
                    "</th>" +
                    "<th id='h_corte' class='font-weight-normal'>" +
                    h +
                    "</th>" +
                    "</tr>";
                cont++;
                $("#orden_pedido").append(fila);
            } else if (val == 0) {
                var fila =
                    '<tr id="fila' +
                    cont +
                    '">' +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    producto +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    precio +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    cantidad_wr +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'></th>" +
                    "<th id='b_corte' class='font-weight-normal'></th>" +
                    "<th id='c_corte' class='font-weight-normal'></th>" +
                    "<th id='d_corte' class='font-weight-normal'></th>" +
                    "<th id='e_corte' class='font-weight-normal'></th>" +
                    "<th id='f_corte' class='font-weight-normal'></th>" +
                    "<th id='g_corte' class='font-weight-normal'></th>" +
                    "<th id='h_corte' class='font-weight-normal'></th>" +
                    "</tr>";
                cont++;
                $("#orden_pedido").append(fila);
            }
        } else if (genero == 4) {
            if (val == 1) {
                cantidad = Number(a + b + c + d + e + f + g + h);
                var fila =
                    '<tr id="fila' +
                    cont +
                    '">' +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    producto +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    precio +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    cantidad +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    a +
                    "</th>" +
                    "<th id='b_corte' class='font-weight-normal'>" +
                    b +
                    "</th>" +
                    "<th id='c_corte' class='font-weight-normal'>" +
                    c +
                    "</th>" +
                    "<th id='d_corte' class='font-weight-normal'>" +
                    d +
                    "</th>" +
                    "<th id='e_corte' class='font-weight-normal'>" +
                    e +
                    "</th>" +
                    "<th id='f_corte' class='font-weight-normal'>" +
                    f +
                    "</th>" +
                    "<th id='g_corte' class='font-weight-normal'>" +
                    g +
                    "</th>" +
                    "<th id='h_corte' class='font-weight-normal'>" +
                    h +
                    "</th>" +
                    "</tr>";
                cont++;
                $("#orden_pedido").append(fila);
            } else if (val == 0) {
                var fila =
                    '<tr id="fila' +
                    cont +
                    '">' +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    producto +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    precio +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    cantidad_wr +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'></th>" +
                    "<th id='b_corte' class='font-weight-normal'></th>" +
                    "<th id='c_corte' class='font-weight-normal'></th>" +
                    "<th id='d_corte' class='font-weight-normal'></th>" +
                    "<th id='e_corte' class='font-weight-normal'></th>" +
                    "<th id='f_corte' class='font-weight-normal'></th>" +
                    "<th id='g_corte' class='font-weight-normal'></th>" +
                    "<th id='h_corte' class='font-weight-normal'></th>" +
                    "</tr>";
                cont++;
                $("#orden_pedido").append(fila);
            }
        }

        if (genero == 2) {
            if (subGenero == "Mujer") {
                cantidad = Number(
                    a + b + c + d + e + f + g + h + i + j + k + l
                );
                var fila =
                    '<tr id="fila' +
                    cont +
                    '">' +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    producto +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    precio +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    cantidad +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    a +
                    "</th>" +
                    "<th id='b_corte' class='font-weight-normal'>" +
                    b +
                    "</th>" +
                    "<th id='c_corte' class='font-weight-normal'>" +
                    c +
                    "</th>" +
                    "<th id='d_corte' class='font-weight-normal'>" +
                    d +
                    "</th>" +
                    "<th id='e_corte' class='font-weight-normal'>" +
                    e +
                    "</th>" +
                    "<th id='f_corte' class='font-weight-normal'>" +
                    f +
                    "</th>" +
                    "<th id='g_corte' class='font-weight-normal'>" +
                    g +
                    "</th>" +
                    "<th id='h_corte' class='font-weight-normal'>" +
                    h +
                    "</th>" +
                    "<th id='i_corte' class='font-weight-normal'>" +
                    i +
                    "</th>" +
                    "<th id='j_corte' class='font-weight-normal'>" +
                    j +
                    "</th>" +
                    "<th id='k_corte' class='font-weight-normal'>" +
                    k +
                    "</th>" +
                    "<th id='l_corte' class='font-weight-normal'>" +
                    l +
                    "</th>" +
                    "</tr>";
                cont++;
                $("#orden_pedido").append(fila);
            } else if (subGenero == "Mujer Plus") {
                cantidad = Number(a + b + c + d + e + f + g + h);
                var fila =
                    '<tr id="fila' +
                    cont +
                    '">' +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    producto +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    precio +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    cantidad +
                    "</th>" +
                    "<th id='a_corte' class='font-weight-normal'>" +
                    a +
                    "</th>" +
                    "<th id='b_corte' class='font-weight-normal'>" +
                    b +
                    "</th>" +
                    "<th id='c_corte' class='font-weight-normal'>" +
                    c +
                    "</th>" +
                    "<th id='d_corte' class='font-weight-normal'>" +
                    d +
                    "</th>" +
                    "<th id='e_corte' class='font-weight-normal'>" +
                    e +
                    "</th>" +
                    "<th id='f_corte' class='font-weight-normal'>" +
                    f +
                    "</th>" +
                    "<th id='g_corte' class='font-weight-normal'>" +
                    g +
                    "</th>" +
                    "<th id='h_corte' class='font-weight-normal'>" +
                    h +
                    "</th>" +
                    "</tr>";
                cont++;
            }
        }

        var ordenDetalle = {
            orden_id: $("#orden_pedido_id").val(),
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
            l: $("#l").val(),
            precio: $("#precio").val(),
            producto_id: $("#productoSearch").val(),
            cantidad: $("#cantidad").val()
        };

        $.ajax({
            url: "orden/detalle",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(ordenDetalle),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
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

                    $("#cantidad").val("");
                    $("#btn-agregar").attr("disabled", true);
                    $("#btn-consultar").attr("disabled", false);
                    $("#btn-agregarProceso").attr("disabled", false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function(datos) {
                console.log(datos.responseJSON.message);

                bootbox.alert("Error: " + datos.responseJSON.message);
            }
        });
    });

    $("#btn-guardar").click(function(e) {
        e.preventDefault();
        limpiar();
        $("#registroForm").hide();
        $("#listadoUsers").show();
    });

    $("#btn-agregarProceso").click(function(e) {
        e.preventDefault();

        $("#corte_proceso").val("Si");

        var ordenProceso = {
            cliente_id: $("#clienteSearch").val(),
            sucursal_id: $("#sucursalSearch").val(),
            notas: $("#notas").val(),
            fecha_entrega: $("#fecha_proceso").val(),
            generado_internamente: $("input[name='r1']:checked").val(),
            detallada: $("input[name='r2']:checked").val(),
            precio: $("#precio").val(),
            sec: $("#sec_proceso").val(),
            no_orden_pedido: $("#no_orden_pedido_proceso").val()
        };
        // console.log(JSON.stringify(ordenProceso));

        $.ajax({
            url: "orden/proceso",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(ordenProceso),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#orden_pedido_id_proceso").val(datos.orden.id);
                    let referencia = $(
                        "#productoSearch option:selected"
                    ).text();
                    let producto = referencia.substring(0, 9);
                    let cantidad_wr = $("#cantidad_proceso").val();
                    let precio = $("#precio").val();

                    var fila =
                        '<tr id="fila' +
                        cont +
                        '">' +
                        "<th id='a_corte' class='font-weight-normal'>" +
                        producto +
                        "</th>" +
                        "<th id='a_corte' class='font-weight-normal'>" +
                        precio +
                        "</th>" +
                        "<th id='a_corte' class='font-weight-normal'>" +
                        cantidad_wr +
                        "</th>" +
                        "<th id='a_corte' class='font-weight-normal'></th>" +
                        "<th id='b_corte' class='font-weight-normal'></th>" +
                        "<th id='c_corte' class='font-weight-normal'></th>" +
                        "<th id='d_corte' class='font-weight-normal'></th>" +
                        "<th id='e_corte' class='font-weight-normal'></th>" +
                        "<th id='f_corte' class='font-weight-normal'></th>" +
                        "<th id='g_corte' class='font-weight-normal'></th>" +
                        "<th id='h_corte' class='font-weight-normal'></th>" +
                        "<th id='i_corte' class='font-weight-normal'></th>" +
                        "<th id='j_corte' class='font-weight-normal'></th>" +
                        "</tr>";
                    cont++;
                    $("#orden_pedido").append(fila);
                    $("#btn-agregarProceso").attr("disabled", true);

                    var ordenDetalleProceso = {
                        orden_id: $("#orden_pedido_id_proceso").val(),
                        precio: precio,
                        producto_id: $("#productoSearch").val(),
                        cantidad: cantidad_wr
                    };

                    $.ajax({
                        url: "orden-proceso/detalle",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(ordenDetalleProceso),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                                $("#corte_proceso").val("");
                                $("#btn-agregarProceso").attr(
                                    "disabled",
                                    false
                                );

                                $("#cantidad_proceso").val("");
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
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function(datos) {
                console.log(datos.responseJSON.message);

                bootbox.alert("Error: " + datos.responseJSON.message);
            }
        });
    });

    //funcion para listar en el Datatable
    function listar() {
        tabla = $("#ordenes").DataTable({
            serverSide: true,
            autoWidth: false,
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
            ajax: "api/ordenes",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Ver", orderable: false, searchable: false },
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
                { data: "fecha", name: "orden_pedido.fecha" },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" },
                {
                    data: "total",
                    name: "orden_pedido.total",
                    searchable: false,
                    orderable: false
                },
                { data: "detallada", name: "orden_pedido.detallada" }
            ],
            order: [[3, "desc"]]
            // rowGroup: {
            //     dataSrc: "name"
            // }
        });
    }

    //funcion para listar en el Datatable
    function listarRedistribucion() {
        tabla_red = $("#ordenes_red").DataTable({
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
            ajax: "api/ordenes_redistribucion",
            columns: [
                { data: "Opciones", orderable: false, searchable: false },
                {
                    data: "no_orden_pedido",
                    name: "orden_pedido.no_orden_pedido"
                },
                {
                    data: "referencia_producto",
                    name: "producto.referencia_producto"
                },
                {
                    data: "client",
                    name: "orden_pedido_detalle.nombre_cliente",
                    searchable: false
                },
                {
                    data: "sucursal",
                    name: "orden_pedido_detalle.nombre_sucursal",
                    searchable: false
                },
                {
                    data: "total",
                    name: "orden_pedido_detalle.total",
                    searchable: false
                },
                { data: "precio", name: "orden_pedido_detalle.precio" },
                {
                    data: "status_orden_pedido",
                    name: "orden_pedido_detalle.status_orden_pedido",
                    searchable: false
                }
            ],
            order: [[1, "desc"]],
            rowGroup: {
                dataSrc: "no_orden_pedido"
            }
        });
    }

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
                {
                    data: "no_orden_pedido",
                    name: "orden_pedido.no_orden_pedido"
                },
                { data: "nombre_cliente", name: "cliente.nombre_cliente" },
                {
                    data: "nombre_sucursal",
                    name: "cliente_sucursales.nombre_sucursal"
                },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" },
                {
                    data: "total",
                    name: "orden_pedido.total",
                    searchable: false
                },
                {
                    data: "status_orden_pedido",
                    name: "orden_pedido.status_orden_pedido"
                },
                {
                    data: "generado_internamente",
                    name: "orden_pedido.generado_internamente"
                },
                { data: "notas", name: "orden_pedido.notas" }
            ],
            order: [[4, "desc"]],
            rowGroup: {
                dataSrc: "fecha_entrega"
            }
        });
    }

    $("#btnAgregar").click(function(e) {
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#registroForm").show();
        $("#listadoUsers").hide();
        $("#corte_en_proceso").hide();
        $("#detallada").hide();
        $("#cliente").hide();
        $("#clienteBuscar").show();
        $("#sucursal").hide();
        $("#sucursalBuscar").show();
        $("#btn-generar").attr("disabled", false);
        $("#btn-generar").attr("disabled", false);
        $("#generado_internamente").hide();
        $("#tallas").show();
        $("#producto").show();
        $("#genInt").show();
        $("#agregadas").show();
        $("#listarOrden").hide();
        $("#orden")
            .DataTable()
            .destroy();
        $("#notas")
            .val("")
            .attr("readonly", false)
            .removeClass("font-weight-bold");
        $("#fecha_entrega")
            .val("")
            .attr("disabled", false);
        $("#no_orden_pedido")
            .val("")
            .removeClass("font-weight-bold");
        // $("#generado_internamente").val(result);
        $("#btn-guardar").show();
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        $("#btnCancelar").hide();
        $("#btnAgregar").show();
        $("#registroForm").hide();
        $("#listadoUsers").show();
    });

    window.onresize = function() {
        tabla.columns.adjust().responsive.recalc();
    };

    init();
});
