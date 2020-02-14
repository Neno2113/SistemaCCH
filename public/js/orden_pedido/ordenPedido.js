var total_recibido;
var a_total;
var b_total;
var c_total;
var d_total;
var e_total;
var f_total;
var g_total;
var h_total;
var i_total;
var j_total;
var k_total;
var l_total;

$(document).ready(function() {
    $("[data-mask]").inputmask();
    // var total_recibido;
    // var a_total;
    // var b_total;
    // var c_total;
    // var d_total;
    // var e_total;
    // var f_total;
    // var g_total;
    // var h_total;
    // var i_total;
    // var j_total;
    // var k_total;
    // var l_total;
    // var genero_global;
    // var mujer_plus_global;
    // var val = false;

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
        // listarOrden();
        $("#cliente").hide();
        $("#sucursal").hide();
        $("#generado_internamente").hide();
        $("#listarOrden").hide();
        $("#orden_detalle").hide();
        $("#orden_create").show();
        vendedores();
        productos();
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
            // $("#redistribucion").hide();
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
            // $("#corte_en_proceso").hide();
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
        $("#total").val("");
        $("#orden_pedido_id").val("");
        $("#orden_pedido_id_proceso").val("");
        $("input[name='r2'][value='0']").prop("checked", true);
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
        $("#cliente_segundas").val("");
        $("#venta_segunda").val("");
    }

    function vendedores() {
        $.ajax({
            url: "vendedores",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.vendedores.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila =
                            "<option value=" +
                            datos.vendedores[i].id +
                            ">" +
                            datos.vendedores[i].nombre +
                            " " +
                            datos.vendedores[i].apellido +
                            "</option>";

                        $("#vendedores").append(fila);
                    }
                    $("#vendedores").select2();
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

    function productos(){

        $.ajax({
            url: "productos/select",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.productos.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila ="<option value=" +datos.productos[i].id +">"+datos.productos[i].referencia_producto+"</option>";
                        $("#productoSearch").append(fila);
                    }
                    $("#productoSearch").select2();
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
                        no_orden_pedido: $("#no_orden_pedido").val(),
                        vendedor_id: $("#vendedores").val()
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
                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 3000,
                                    // timerProgressBar: true,
                                    onOpen: toast => {
                                        toast.addEventListener(
                                            "mouseenter",
                                            Swal.stopTimer
                                        );
                                        toast.addEventListener(
                                            "mouseleave",
                                            Swal.resumeTimer
                                        );
                                    }
                                });

                                Toast.fire({
                                    type: "success",
                                    title: "Orden generada correctamente"
                                });
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
            // $("#btn-consultar").show();
            $("#btn-consultar").attr("disabled", false);
        } else if (val == 0) {
            $("#btn-consultar").attr("disabled", false);
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

    $("#fecha_entrega").on("change", function() {
        var cliente = {
            cliente_id: $("#clienteSearch").val()
        };

        $.ajax({
            url: "cliente/segundas",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(cliente),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#cliente_segundas").val(datos.cliente_segundas);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error");
            }
        });
    });

    $("#btn-consultar").click(function(e) {
        e.preventDefault();

        let val = $("input[name='r2']:checked").val();

        if (val == 1) {
            mostrarDetalle(true);
            consulta();
        } else if (val == 0) {
            mostrarDetalle(false);
            consulta();
        }
    });

    function corte_proceso(datos) {
        $("#corteProceso").empty();

        if(datos == ""){


        }else{
            for (let t = 0; t < datos.corte_proceso.length; t++) {
                var fila ="<tr>"+
                    "<td>"+datos.corte_proceso[t].numero_corte+"</td>"+
                    "<td>"+datos.corte_proceso[t].fase +"</td>"+
                    "<td>"+datos.corte_proceso[t].fecha_entrega+"</td>"+
                    "<td>"+datos.corte_proceso[t].producto.referencia_producto+"</td>" +
                    "<td>"+datos.corte_proceso[t].total+"</td>"+
                    "<td><button onclick='consultaSustituto()' class='btn btn-primary'><i class='fas fa-cart-plus'></i></button></td>"+
                    "</tr>";
                $("#corteProceso").append(fila);
            }
        }



    }

    var cont;
    var cantidad;

    function consulta() {

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

                    let precio = datos.producto.precio_lista;
                    precio = precio.replace(".00", "");
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
                    // genero_global = ref.substring(1, 2);
                    // mujer_plus_global = ref.substring(3, 4);
                    let cantidad = $("#cantidad").val();
                    let total_alm = datos.total_corte;

                    corte_proceso(datos);

                    a_total = datos.a;
                    b_total = datos.b;
                    c_total = datos.c;
                    d_total = datos.d;
                    e_total = datos.e;
                    f_total = datos.f;
                    g_total = datos.g;
                    h_total = datos.h;
                    i_total = datos.i;
                    j_total = datos.j;
                    k_total = datos.k;
                    l_total = datos.l;

                    //validacion de talla igual 0 desabilitar input correspondiente a esa talla
                    datos.a <= 0 ? $("#a").attr("disabled", true) : $("#a").attr("disabled", false);
                    datos.b <= 0 ? $("#b").attr("disabled", true) : $("#b").attr("disabled", false);
                    datos.c <= 0 ? $("#c").attr("disabled", true) : $("#c").attr("disabled", false);
                    datos.d <= 0 ? $("#d").attr("disabled", true) : $("#d").attr("disabled", false);
                    datos.e <= 0 ? $("#e").attr("disabled", true) : $("#e").attr("disabled", false);
                    datos.f <= 0 ? $("#f").attr("disabled", true) : $("#f").attr("disabled", false);
                    datos.g <= 0 ? $("#g").attr("disabled", true) : $("#g").attr("disabled", false);
                    datos.h <= 0 ? $("#h").attr("disabled", true) : $("#h").attr("disabled", false);
                    datos.i <= 0 ? $("#i").attr("disabled", true) : $("#i").attr("disabled", false);
                    datos.j <= 0 ? $("#j").attr("disabled", true) : $("#j").attr("disabled", false);
                    datos.k <= 0 ? $("#k").attr("disabled", true) : $("#k").attr("disabled", false);
                    datos.l <= 0 ? $("#l").attr("disabled", true) : $("#l").attr("disabled", false);


                    if(cantidad > total_alm){

                        if(total_alm == 0){
                            Swal.fire({
                                type: 'warning',
                                title: 'Alerta',
                                html: 'La cantidad digitada es mayor a la cantidad disponible en almacen.'
                                +'<hr><button onclick="ajustarCantidad()" class="btn btn-primary ml-1" disabled>Ajustar cantidad</button>'
                                +'<button onclick="cortes_similares()" class="btn btn-secondary ml-4 mr-4">Cortes similares</button>'
                                +'<button onclick="buscarSustituto()" class="btn btn-info mr-1">Buscar sustitutos</button>',
                                showConfirmButton: false
                            })
                        }else{
                            Swal.fire({
                                type: 'warning',
                                title: 'Alerta',
                                html: 'La cantidad digitada es mayor a la cantidad disponible en almacen'
                                +'<hr><button onclick="ajustarCantidad()"  class="btn btn-primary ml-1">Ajustar cantidad</button>'
                                +'<button onclick="cortes_similares()" class="btn btn-secondary ml-4 mr-4">Cortes similares</button>'
                                +'<button onclick="buscarSustituto()" class="btn btn-info mr-1">Buscar sustitutos</button>',
                                showConfirmButton: false
                            })
                        }


                    }
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
                        // $("#i").attr("disabled", false);
                        // $("#j").attr("disabled", false);
                        // $("#k").attr("disabled", true);
                        // $("#l").attr("disabled", true)
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
                        // $("#i").attr("disabled", true);
                        // $("#j").attr("disabled", true);
                        // $("#k").attr("disabled", true);
                        // $("#l").attr("disabled", true);

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
                            $("#ka").html("Test");
                            // $("#i").attr("disabled", true);
                            // $("#j").attr("disabled", true);
                            // // $("#k").attr("disabled", true);
                            // // $("#l").attr("disabled", true);

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
                            // $("#i").attr("disabled", false);
                            // $("#j").attr("disabled", false);
                            // $("#k").attr("disabled", false);
                            // $("#l").attr("disabled", false);

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
                        }
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

    $("#btn-agregar").click(function(t) {
        t.preventDefault();
        validarDetalle();

    });

    function validarDetalle(){
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
        let subGenero = producto.substring(3, 4);
        var detalle = $("input[name='r2']:checked").val();
        let cantidad_wr = $("#cantidad").val();
        let precio = $("#precio").val();

        var validar = {
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
            url: "validar/orden_pedido",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(validar),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    let total = datos.total;
                    var a_val = datos.a;
                    var b_val = datos.b;
                    var c_val = datos.c;
                    var d_val = datos.d;
                    var e_val = datos.e;
                    var f_val = datos.f;
                    var g_val = datos.g;
                    var h_val = datos.h;
                    var i_val = datos.i;
                    var j_val = datos.j;
                    var k_val = datos.k;
                    var l_val = datos.l;
                    var val = true;


                    if (total > total_recibido) {
                        bootbox.alert(
                            "<div class='alert alert-danger' role='alert'>" +
                                "<i class='fas fa-exclamation-triangle'></i> La cantidad total de tallas no puede ser mayor a la cantidad recibida de lavanderia" +
                                "</div>"
                        );
                    } else {
                        $("#btn-guardar").show();
                        if (genero == 2) {
                            if (subGenero == 7) {
                                if (a_val > a_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 12W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = true;
                                } else if (b_val > b_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 14W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = true;
                                } else if (c_val > c_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 16W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (d_val > d_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 18W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (e_val > e_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 20W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (f_val > f_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 22W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (g_val > g_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 24W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (h_val > h_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 26W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else {
                                    agregarDetalle();
                                }
                            } else {
                                if (a_val > a_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 0/0 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (b_val > b_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 1/2 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (c_val > c_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 3/4 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (d_val > d_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 5/6 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (e_val > e_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 7/8 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (f_val > f_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 9/10 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (g_val > g_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 11/12 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (h_val > h_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 13/14 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (i_val > i_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 15/16 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (j_val > j_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 17/18 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (k_val > k_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 19/20  a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else if (l_val > l_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 21/22  a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val = false;
                                } else {
                                    agregarDetalle();
                                }
                            }
                        } else if (genero == 3 && genero == 4) {
                            if (a_val > a_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 2  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (b_val > b_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 4  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (c_val > c_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 6  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (d_val > d_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 8  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (e_val > e_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 10  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (f_val > f_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 12  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (g_val > g_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 14  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (h_val > h_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 16  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else {
                                agregarDetalle();
                            }
                        } else if (genero == 1) {
                            if (a_val > a_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 28  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (b_val > b_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 30  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (c_val > c_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 32  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (d_val > d_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 34  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (e_val > e_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 36  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (f_val > f_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 38  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (g_val > g_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 40  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (h_val > h_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 42  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else if (i_val > i_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 44  a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val = false;
                            } else {
                                agregarDetalle();
                            }
                        }
                    }
                    if (val == false) {
                        val = true;
                    } else if (val == true) {
                        var cont;

                        if (genero == 1) {
                            if (detalle == 1) {
                                cantidad = Number(
                                    a + b + c + d + e + f + g + h + i + j
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
                                    "</tr>";
                                cont++;
                                $("#orden_pedido").append(fila);
                            } else if (detalle == 0) {
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
                            if (detalle == 1) {
                                cantidad = Number(
                                    a + b + c + d + e + f + g + h
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
                                    "</tr>";
                                cont++;
                                $("#orden_pedido").append(fila);
                            } else if (detalle == 0) {
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
                            if (detalle == 1) {
                                cantidad = Number(
                                    a + b + c + d + e + f + g + h
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
                                    "</tr>";
                                cont++;
                                $("#orden_pedido").append(fila);
                            } else if (detalle == 0) {
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
                            if (detalle == 1) {
                                cantidad = Number(
                                    a +
                                        b +
                                        c +
                                        d +
                                        e +
                                        f +
                                        g +
                                        h +
                                        i +
                                        j +
                                        k +
                                        l
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
                            } else if (detalle == 0) {
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
                        // agregarDetalle();
                    }
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function() {
                console.log("ocurrio un error");
            }
        });
    }


    function agregarDetalle() {

        let val = $("input[name='r2']:checked").val();
        if(val == 1){
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
                segunda: $("#venta_segunda").val()
            };
        }else{
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
                cantidad: $("#cantidad").val(),
                segunda: $("#venta_segunda").val()
            };
        }



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
                    result = false;
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

    $("#btn-guardar").click(function(e) {
        e.preventDefault();
        limpiar();
        $("#registroForm").hide();
        $("#listadoUsers").show();
        $("#btnAgregar").show();
        $("#orden_create").show();
        $("#orden_detalle").hide();
        Swal.fire("Success", "Orden de pedido creada correctamente", "success");
        // listar();
        $("#ordenes")
            .DataTable()
            .ajax.reload();
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
                // { data: "Ver", orderable: false, searchable: false },
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
            order: [[2, "desc"]],
            rowGroup: {
                dataSrc: "nombre_cliente"
            }
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
        $("#corte_en_proceso").show();
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
        // $("#no_orden_pedido")
        //     .val("")
        //     .removeClass("font-weight-bold");
        // $("#generado_internamente").val(result);
        $("#btn-guardar").show();
        $("#orden_detalle").hide();
        $("#orden_create").show();
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        $("#btnCancelar").hide();
        $("#btnAgregar").show();
        $("#registroForm").hide();
        $("#listadoUsers").show();
    });

    $("#cantidad").on('keyup', function(){
        $("#btn-consultar").attr("disabled", false);
    });

    $("#productoSearch").on('change', function(){
        $("#btn-consultar").attr("disabled", false);
    });

    window.onresize = function() {
        tabla.columns.adjust().responsive.recalc();
    };

    init();
});



function validarNan(val) {
    if (isNaN(val) || val < 0) {
        return 0;
    } else {
        return val;
    }
}

function eliminar(id_orden) {
    Swal.fire({
        title: "¿Estas seguro de eliminar esta orden de pedido?",
        text: "Va a eliminar la orden de pedido!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, acepto"
    }).then(result => {
        if (result.value) {
            $.post("orden_pedido/delete/" + id_orden, function() {
                Swal.fire(
                    "Eliminado!",
                    "Orden de pedido eliminada correctamente.",
                    "success"
                );
                $("#ordenes")
                    .DataTable()
                    .ajax.reload();
            });
        }
    });

    // bootbox.confirm("¿Estas seguro de eliminar esta orden de producto?", function(result){
    //     if(result){
    //         $.post("orden_pedido/delete/" + id_orden, function(){
    //             bootbox.alert("Orden de pedido eliminada correctamente!!");
    //             $("#ordenes").DataTable().ajax.reload();
    //         })
    //     }
    // })
}

function ver(id_orden) {
    $.post("mostrar/" + id_orden, function(data, status) {
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-guardar").hide();
        $("#autorizacion_credito_req").show();
        $("#redistribucion_tallas").show();
        $("#factura_desglosada_tallas").show();
        $("#acepta_segundas").show();
        $("#cliente").show();
        $("#clienteBuscar").hide();
        $("#sucursal").show();
        $("#sucursalBuscar").hide();
        $("#btn-generar").attr("disabled", true);
        $("#generado_internamente").show();
        $("#tallas").hide();
        $("#producto").hide();
        $("#genInt").hide();
        $("#agregadas").hide();
        $("#listarOrden").show();

        let result;
        if (data.orden.generado_internamente == 1) {
            result = "Si";
        } else {
            result = "No";
        }
        $("#orden").DataTable().destroy();
        listarOrden(data.orden.id);
        $("#notas").val(data.orden.notas).attr("readonly", true).addClass("font-weight-bold");
        $("#client").val(data.orden.cliente.nombre_cliente);
        $("#sucur").val(data.orden.sucursal.nombre_sucursal);
        $("#fecha_entrega").val(data.orden.fecha_entrega).attr("disabled", true);
        // $("#no_orden_pedido")
        //     .val(data.orden.no_orden_pedido)
        //     .addClass("font-weight-bold");
        $("#generado_internamente").val(result);
    });
}

function listarOrden(id) {
    var tabla_orden = $("#orden").DataTable({
        serverSide: true,
        bFilter: false,
        lengthChange: false,
        bPaginate: false,
        bInfo: false,
        retrieve: true,
        responsive: true,
        ajax: "api/listarorden/" + id,
        columns: [
            {
                data: "referencia_producto",
                name: "producto.referencia_producto"
            },
            { data: "a", name: "orden_pedido_detalle.a" },
            { data: "b", name: "orden_pedido_detalle.b" },
            { data: "c", name: "orden_pedido_detalle.c" },
            { data: "d", name: "orden_pedido_detalle.d" },
            { data: "e", name: "orden_pedido_detalle.e" },
            { data: "f", name: "orden_pedido_detalle.f" },
            { data: "g", name: "orden_pedido_detalle.g" },
            { data: "h", name: "orden_pedido_detalle.h" },
            { data: "i", name: "orden_pedido_detalle.i" },
            { data: "j", name: "orden_pedido_detalle.j" },
            { data: "k", name: "orden_pedido_detalle.k" },
            { data: "l", name: "orden_pedido_detalle.l" }
        ],
        order: [[1, "desc"]]
    });
}

function ajustarCantidad(){
    $("#btn-consultar").attr("disabled", false);
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
    // $("#redistribucion").hide();
    $("#detalles").show();
    $("#corte_en_proceso").show();
    $("input[name='r2'][value='1']").prop("checked", true);
    Swal.close()

}

function cortes_similares(){
    var rowCount = $("#corteProceso tr").length;

    if(rowCount == 0){
        Swal.fire({
            type: 'error',
            title: 'Oops...',
            text: 'No existe otro corte con la misma referencia!',
            footer: 'Pruebe con las demas opciones para continuar el pedido.'
        })
    }else{
        $("#btn-consultar").attr("disabled", false);
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
        // $("#redistribucion").hide();
        $("#detalles").show();
        $("#corte_en_proceso").show();
        Swal.close()
        $("#ModalSimilares").modal('show');
    }



}


function consultaSustituto(id){
    $.ajax({
        url: "ordenPedido/consulta/"+id,
        type: "GET",
        dataType: "json",
        data: JSON.stringify(orden),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                // console.log(datos);
                let precio = datos.producto.precio_lista;
                precio = precio.replace(".00", "");
                $("input[name='r2'][value='1']").prop("checked", true);
                $("#productoSearch").val(datos.producto.id).select2().trigger('change');;
                $("#precio").val(precio);
                $("#total").val(datos.total_real);
                $("#disponibles").html(
                    "<tr id='cortes'>" +
                    "<td id='a_corte'>"+validarNan(datos.a)+"</td>"+
                    "<td id='b_corte'>"+validarNan(datos.b)+"</td>"+
                    "<td id='c_corte'>"+validarNan(datos.c)+"</td>"+
                    "<td id='d_corte'>"+validarNan(datos.d)+"</td>"+
                    "<td id='e_corte'>"+validarNan(datos.e)+"</td>"+
                    "<td id='f_corte'>"+validarNan(datos.f)+"</td>"+
                    "<td id='g_corte'>"+validarNan(datos.g)+"</td>"+
                    "<td id='h_corte'>"+validarNan(datos.h)+"</td>"+
                    "<td id='i_corte'>"+validarNan(datos.i)+"</td>"+
                    "<td id='j_corte'>"+validarNan(datos.j)+"</td>"+
                    "<td id='j_corte'>"+validarNan(datos.k)+"</td>"+
                    "<td id='j_corte'>"+validarNan(datos.l)+"</td>"+
                    "</tr>"
                );
                //validacion de talla igual 0 desabilitar input correspondiente a esa talla
                datos.a <= 0 ? $("#a").attr("disabled", true) : $("#a").attr("disabled", false);
                datos.b <= 0 ? $("#b").attr("disabled", true) : $("#b").attr("disabled", false);
                datos.c <= 0 ? $("#c").attr("disabled", true) : $("#c").attr("disabled", false);
                datos.d <= 0 ? $("#d").attr("disabled", true) : $("#d").attr("disabled", false);
                datos.e <= 0 ? $("#e").attr("disabled", true) : $("#e").attr("disabled", false);
                datos.f <= 0 ? $("#f").attr("disabled", true) : $("#f").attr("disabled", false);
                datos.g <= 0 ? $("#g").attr("disabled", true) : $("#g").attr("disabled", false);
                datos.h <= 0 ? $("#h").attr("disabled", true) : $("#h").attr("disabled", false);
                datos.i <= 0 ? $("#i").attr("disabled", true) : $("#i").attr("disabled", false);
                datos.j <= 0 ? $("#j").attr("disabled", true) : $("#j").attr("disabled", false);
                datos.k <= 0 ? $("#k").attr("disabled", true) : $("#k").attr("disabled", false);
                datos.l <= 0 ? $("#l").attr("disabled", true) : $("#l").attr("disabled", false);

                a_total = datos.a;
                b_total = datos.b;
                c_total = datos.c;
                d_total = datos.d;
                e_total = datos.e;
                f_total = datos.f;
                g_total = datos.g;
                h_total = datos.h;
                i_total = datos.i;
                j_total = datos.j;
                k_total = datos.k;
                l_total = datos.l;

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
                // $("#redistribucion").hide();
                $("#detalles").show();
                $("#corte_en_proceso").show();
                $("#ModalSustituto").modal('hide');
                $("#btn-consultar").attr("disabled", false);

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

}

function buscarSustituto(){

    var producto = {
        producto: $("#productoSearch").val(),
        cantidad: $("#cantidad").val()
    };

    $.ajax({
        url: "producto/sustituto",
        type: "POST",
        dataType: "json",
        data: JSON.stringify(producto),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                if(datos.almacen == ""){
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'No existe otra referencia para sustituir!',
                        footer: 'Pruebe con las demas opciones para continuar el pedido'
                    })
                }else{
                    Swal.close();
                    $("#ModalSustituto").modal('show');
                    let ref =  $("#productoSearch option:selected").text()
                    let genero = ref.substring(1, 2);
                    let mujer_plus = ref.substring(3, 4)
                    // console.log(genero);
                    // console.log(mujer_plus);


                    $("#sustitutos").empty();
                    for (let t = 0; t < datos.almacen.length; t++) {
                        var fila = "<tr>"+
                        "<td>"+datos.almacen[t].producto.referencia_producto+"</td>"+
                        "<td>"+datos.almacen[t].producto.tono+"</td>"+
                        "<td>"+datos.almacen[t].producto.intensidad_proceso_seco+"</td>"+
                        "<td>"+datos.almacen[t].producto.atributo_no_1+"</td>"+
                        "<td>"+datos.almacen[t].producto.atributo_no_2+"</td>"+
                        "<td>"+datos.almacen[t].producto.atributo_no_3+"</td>"+
                        "<td>"+datos.almacen[t].producto.precio_lista+"</td>"+
                        // "<td>"+datos.almacen[t].g+"</td>"+
                        // "<td>"+datos.almacen[t].h+"</td>"+
                        // "<td>"+datos.almacen[t].i+"</td>"+
                        // "<td>"+datos.almacen[t].j+"</td>"+
                        // "<td>"+datos.almacen[t].k+"</td>"+
                        // "<td>"+datos.almacen[t].l+"</td>"+
                        "<td>"+datos.almacen[t].total+"</td>"+
                        "<td><button onclick='consultaSustituto("+datos.almacen[t].id+")' class='btn btn-primary'><i class='fas fa-cart-plus'></i></button></td>"+
                        "</tr>";
                        $("#sustitutos").append(fila);
                    }
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
