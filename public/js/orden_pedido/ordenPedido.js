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
        $("#clienteSearch").val("").trigger("change");
        $("#sucursalSearch").val("").trigger("change");
        $("#productoSearch").val("").trigger("change");
        $("#corte_en_proceso").hide();
        $("#detallada").hide();
        ordenPedidoCod();
        $("#btn-consultar").hide();
        $("#precio_div").hide();
        $("#total_div").hide();
        $("#btn-agregar").hide();
        listar();
        $("#registroForm").hide();
        $("#btnCancelar").hide();
        $("#btn-agregarProceso").attr('disabled', true);
        $("#total").val("");
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
    }

    function ordenPedidoCod() {
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
                    i = (i + 0.01).toFixed(2).split(".").join("");

                    $("#no_orden_pedido").val("OP-" + i);
                } else {
                    bootbox.alert("Ocurrio un error !!");
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });
    }

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
            $("#btn-consultar").attr('disabled', false);
        }else if(val == 0){ 
            $("#btn-consultar").attr('disabled', false);
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
                        var ref = $("#productoSearch option:selected").text();
                        $("#precio").val(datos.producto.precio_lista);
                        $("#total").val(datos.total_corte);
                        $("#precio_div").show();
                        $("#total_div").show();
                        $("#btn-agregar").show();
                        $("#btn-consultar").attr('disabled', true);
                        $("#btn-agregar").attr('disabled', false);
                        var genero = ref.substring(1, 2);
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

                            $("#disponibles").html(
                                "<tr id='cortes'>" +
                                "<th id='a_corte' class='font-weight-normal'>"+validarNan(datos.a)+"</th>" +
                                "<th id='b_corte' class='font-weight-normal'>"+validarNan(datos.b)+"</th>" +
                                "<th id='c_corte' class='font-weight-normal'>"+validarNan(datos.c)+"</th>"+
                                "<th id='d_corte' class='font-weight-normal'>"+validarNan(datos.d)+"</th>"+
                                "<th id='e_corte' class='font-weight-normal'>"+validarNan(datos.e)+"</th>"+
                                "<th id='f_corte' class='font-weight-normal'>"+validarNan(datos.f)+"</th>"+
                                "<th id='g_corte' class='font-weight-normal'>"+validarNan(datos.g)+"</th>"+
                                "<th id='h_corte' class='font-weight-normal'>"+validarNan(datos.h)+"</th>"+
                                "<th id='i_corte' class='font-weight-normal'>"+validarNan(datos.i)+"</th>" +
                                "<th id='j_corte' class='font-weight-normal'>"+validarNan(datos.j)+"</th>"+
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
                            }
    
                            let consulta = Object.values(data_consulta);
                            var result = true;
                            
                            for (let i = 0; i < consulta.length; i++) {
                                if(consulta[i] <= 0){
                                    bootbox.alert("Alerta existe una de las tallas la cual su existencia es igual a 0");
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
                            $("#disponibles").html(
                                "<tr id='cortes'>" +
                                    "<th id='a_corte' class='font-weight-normal'>"+validarNan(datos.a)+"</th>" +
                                    "<th id='b_corte' class='font-weight-normal'>"+validarNan(datos.b)+"</th>"+
                                    "<th id='c_corte' class='font-weight-normal'>"+validarNan(datos.c)+"</th>"+
                                    "<th id='d_corte' class='font-weight-normal'>"+validarNan(datos.d)+"</th>"+
                                    "<th id='e_corte' class='font-weight-normal'>"+validarNan(datos.e)+"</th>"+
                                    "<th id='f_corte' class='font-weight-normal'>"+validarNan(datos.f)+"</th>"+
                                    "<th id='g_corte' class='font-weight-normal'>"+validarNan(datos.g)+"</th>"+
                                    "<th id='h_corte' class='font-weight-normal'>"+validarNan(datos.h)+"</th>"+
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
                            }
    
                            let consulta = Object.values(data_consulta);
                            var result = true;
                            
                            for (let i = 0; i < consulta.length; i++) {
                                if(consulta[i] <= 0){
                                    bootbox.alert("Alerta existe una de las tallas la cual su existencia es igual a 0");
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
                            $("#disponibles").html(
                                "<tr id='cortes'>" +
                                    "<th id='a_corte' class='font-weight-normal'>"+validarNan(datos.a)+"</th>"+
                                    "<th id='b_corte' class='font-weight-normal'>"+validarNan(datos.b)+"</th>"+
                                    "<th id='c_corte' class='font-weight-normal'>"+validarNan(datos.c)+"</th>"+
                                    "<th id='d_corte' class='font-weight-normal'>"+validarNan(datos.d)+"</th>"+
                                    "<th id='e_corte' class='font-weight-normal'>"+validarNan(datos.e)+"</th>"+
                                    "<th id='f_corte' class='font-weight-normal'>"+validarNan(datos.f)+"</th>"+
                                    "<th id='g_corte' class='font-weight-normal'>"+validarNan(datos.g)+"</th>"+
                                    "<th id='h_corte' class='font-weight-normal'>"+validarNan(datos.h)+"</th>"+
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
                            }
    
                            let consulta = Object.values(data_consulta);
                            var result = true;
                            
                            for (let i = 0; i < consulta.length; i++) {
                                if(consulta[i] <= 0){
                                    bootbox.alert("Alerta existe una de las tallas la cual su existencia es igual a 0");
                                    result = false;
                                    break;
                                }
                                
                            }
                        }
                        if (genero == 2) {
                            $("#genero").val("Mujer: " + val);
                            $("#sub-genero").show();

                            $("#sub-genero").on("change", function() {
                                var subGenero = $("#sub-genero").val();

                                if (subGenero == "Mujer") {
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
                                    $("#tallas").html(
                                        "<th>Dama TA</th>" +
                                            "<th>0/0</th>" +
                                            "<th>1/2</th>" +
                                            "<th>3/4</th>" +
                                            "<th>5/6</th>" +
                                            "<th>7/8</th>" +
                                            "<th>9/10</th>" +
                                            "<th>11/12</th>" +
                                            "<th>13/14</th>" +
                                            "<th>15/16</th>" +
                                            "<th>17/18</th>" +
                                            "<th>19/20</th>" +
                                            "<th>21/22</th>"
                                    );
                                    $("#disponibles").html(
                                        "<tr id='cortes'>" +
                                            "<th id='a_corte' class='font-weight-normal'>"+validarNan(datos.a)+"</th>"+
                                            "<th id='b_corte' class='font-weight-normal'>"+validarNan(datos.b)+"</th>"+
                                            "<th id='c_corte' class='font-weight-normal'>"+validarNan(datos.c)+"</th>"+
                                            "<th id='d_corte' class='font-weight-normal'>"+validarNan(datos.d)+"</th>" +
                                            "<th id='e_corte' class='font-weight-normal'>"+validarNan(datos.e)+"</th>"+
                                            "<th id='f_corte' class='font-weight-normal'>"+validarNan(datos.f)+"</th>"+
                                            "<th id='g_corte' class='font-weight-normal'>"+validarNan(datos.g)+"</th>"+
                                            "<th id='h_corte' class='font-weight-normal'>"+validarNan(datos.h)+"</th>"+
                                            "<th id='i_corte' class='font-weight-normal'>"+validarNan(datos.i)+"</th>"+
                                            "<th id='j_corte' class='font-weight-normal'>"+validarNan(datos.j)+"</th>"+
                                            "<th id='k_corte' class='font-weight-normal'>"+validarNan(datos.k)+"</th>"+
                                            "<th id='l_corte' class='font-weight-normal'>"+validarNan(datos.l)+"</th>"+
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
                                    }
            
                                    let consulta = Object.values(data_consulta);
                                    var result = true;
                                    
                                    for (let i = 0; i < consulta.length; i++) {
                                        if(consulta[i] <= 0){
                                            bootbox.alert("Alerta existe una de las tallas la cual su existencia es igual a 0");
                                            result = false;
                                            break;
                                        }
                                        
                                    }
                                } else if (subGenero == "Mujer Plus") {
                                    //    $("#genero").val('Mujer plus: '+val);
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
                                    $("#tallas").html(
                                        "<th>Dama Plus</th>" +
                                            "<th>12W</th>" +
                                            "<th>14W</th>" +
                                            "<th>16W</th>" +
                                            "<th>18W</th>" +
                                            "<th>20W</th>" +
                                            "<th>22W</th>" +
                                            "<th>24W</th>" +
                                            "<th>26W</th>" +
                                            $("#ti").html("I") +
                                            $("#tj").html("J") +
                                            $("#tk").html("K") +
                                            $("#tl").html("L")
                                    );
                                }
                            });
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
                        $("#precio").val(datos.producto.precio_lista);
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

        

        if (genero == 1) {
            if (val == 1) {
                cantidad = Number(a + b + c + d + e + f + g + h + i + j);
                var fila =
                    '<tr id="fila'+cont +'">'+
                    "<th id='a_corte' class='font-weight-normal'>"+producto+"</th>"+
                    "<th id='a_corte' class='font-weight-normal'>"+precio+"</th>"+
                    "<th id='a_corte' class='font-weight-normal'>"+cantidad+"</th>"+
                    "<th id='a_corte' class='font-weight-normal'>"+a+"</th>"+
                    "<th id='b_corte' class='font-weight-normal'>"+b+"</th>"+
                    "<th id='c_corte' class='font-weight-normal'>"+c+"</th>"+
                    "<th id='d_corte' class='font-weight-normal'>"+d+"</th>"+
                    "<th id='e_corte' class='font-weight-normal'>"+e+"</th>"+
                    "<th id='f_corte' class='font-weight-normal'>"+f+"</th>"+
                    "<th id='g_corte' class='font-weight-normal'>"+g+"</th>"+
                    "<th id='h_corte' class='font-weight-normal'>"+h+"</th>"+
                    "<th id='i_corte' class='font-weight-normal'>"+i+"</th>"+
                    "<th id='j_corte' class='font-weight-normal'>"+j+"</th>"+
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
                    '<tr id="fila'+cont+'">'+
                    "<th id='a_corte' class='font-weight-normal'>"+producto+"</th>"+
                    "<th id='a_corte' class='font-weight-normal'>"+precio+"</th>"+
                    "<th id='a_corte' class='font-weight-normal'>"+cantidad+"</th>"+
                    "<th id='a_corte' class='font-weight-normal'>"+a+"</th>"+
                    "<th id='b_corte' class='font-weight-normal'>"+b+"</th>"+
                    "<th id='c_corte' class='font-weight-normal'>"+c+"</th>"+
                    "<th id='d_corte' class='font-weight-normal'>"+d+"</th>"+
                    "<th id='e_corte' class='font-weight-normal'>"+e+"</th>"+
                    "<th id='f_corte' class='font-weight-normal'>"+f+"</th>"+
                    "<th id='g_corte' class='font-weight-normal'>"+g+"</th>"+
                    "<th id='h_corte' class='font-weight-normal'>"+h+"</th>"+
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
                '<tr id="fila'+cont+'">'+
                "<th id='a_corte' class='font-weight-normal'>"+producto+"</th>"+
                "<th id='a_corte' class='font-weight-normal'>"+precio+"</th>"+
                "<th id='a_corte' class='font-weight-normal'>"+cantidad+"</th>"+
                "<th id='a_corte' class='font-weight-normal'>"+a+"</th>"+
                "<th id='b_corte' class='font-weight-normal'>"+b+"</th>"+
                "<th id='c_corte' class='font-weight-normal'>"+c+"</th>"+
                "<th id='d_corte' class='font-weight-normal'>"+d+"</th>"+
                "<th id='e_corte' class='font-weight-normal'>"+e+"</th>"+
                "<th id='f_corte' class='font-weight-normal'>"+f+"</th>"+
                "<th id='g_corte' class='font-weight-normal'>"+g+"</th>"+
                "<th id='h_corte' class='font-weight-normal'>"+h+"</th>"+
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
                    limpiar();

                    $("#cantidad").val("");
                    $("#btn-agregar").attr('disabled', true);
                    $("#btn-consultar").attr('disabled', false);
                    $("#btn-agregarProceso").attr('disabled', false);
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

        let sucursal = $("#sucursalSearch").val();

        if(sucursal){
            sucursal = $("#sucursalSearch").val();
        }else{
            sucursal = 7;
        }

        var orden = {
            cliente_id: $("#clienteSearch").val(),
            sucursal_id: sucursal,
            notas: $("#notas").val(),
            fecha_entrega: $("#fecha_entrega").val(),
            generado_internamente: $("input[name='r1']:checked").val(),
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

                    let corte_proceso = $("#corte_proceso").val();
                    ordenPedidoCod();
        
                    if (corte_proceso == "Si") {
                        var i = Number(datos.orden.sec);
                        $("#sec_proceso").val(i);
                        i = (i + 0.01).toFixed(2).split(".").join("");
                        $no_orden_proceso = "OP-"+ i;
                        $("#no_orden_pedido_proceso").val($no_orden_proceso);
                        
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

                        $.ajax({
                            url: "orden/proceso",
                            type: "POST",
                            dataType: "json",
                            data: JSON.stringify(ordenProceso),
                            contentType: "application/json",
                            success: function(datos) {
                                if (datos.status == "success") {
                                    ordenPedidoCod();
                                    let referencia = $("#productoSearch option:selected").text();
                                    let producto = referencia.substring(0, 9);
                                    let cantidad_wr = $("#cantidad_proceso").val();
                                    let precio = $("#precio").val();

                                    var ordenDetalleProceso = {
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
                                                $("#clienteSearch").val("").trigger("change");
                                                $("#sucursalSearch").val("").trigger("change");
                                                $("#productoSearch").val("").trigger("change");
                                                $("#notas").val("");
                                                $("#fecha_entrega").val("");
                                                $("#cantidad").val("");
                                                $("#precio").val("");
                                                $("#corte_proceso").val("");
                                                $("#orden_pedido").empty();
                                                $("#registroForm").hide();
                                                $("#ordenes").DataTable().ajax.reload();
                                                $("#listadoUsers").show();
                                                $("#btn-agregarProceso").attr('disabled', false);

                                                $("#cantidad_proceso").val("");
                                            } else {
                                                bootbox.alert(
                                                    "Ocurrio un error durante la creacion de la composicion"
                                                );
                                            }
                                        },
                                        error: function(datos) {
                                            console.log(
                                                datos.responseJSON.message
                                            );

                                            bootbox.alert(
                                                "Error: " +
                                                    datos.responseJSON.message
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

                                bootbox.alert(
                                    "Error: " + datos.responseJSON.message
                                );
                            }
                        });
                    }else{
                        $("#clienteSearch").val("").trigger("change");
                        $("#sucursalSearch").val("").trigger("change");
                        $("#productoSearch").val("").trigger("change");
                        $("#notas").val("");
                        $("#fecha_entrega").val("");
                        $("#cantidad").val("");
                        $("#precio").val("");
                        $("#corte_proceso").val("");
                        $("#orden_pedido").empty();
                        $("#registroForm").hide();
                        $("#ordenes").DataTable().ajax.reload();
                        $("#listadoUsers").show();
                    }

                   
                    bootbox.alert(
                        "Se creo una orden de pedido nueva codigo: <strong>" +
                            datos.orden.no_orden_pedido +
                            "</strong>"
                    );
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

    $("#btn-agregarProceso").click(function(e) {
        e.preventDefault();

        $("#corte_proceso").val("Si");

        let referencia = $("#productoSearch option:selected").text();
        let producto = referencia.substring(0, 9);
        let cantidad_wr = $("#cantidad_proceso").val();
        let precio = $("#precio").val();

        var fila =
            '<tr id="fila' +cont +'">' +
            "<th id='a_corte' class='font-weight-normal'>" +producto +"</th>" +
            "<th id='a_corte' class='font-weight-normal'>" +precio +"</th>" +
            "<th id='a_corte' class='font-weight-normal'>" +cantidad_wr +"</th>" +
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
        $("#btn-agregarProceso").attr('disabled', true);
    });

    //funcion para listar en el Datatable
    function listar() {
        tabla = $("#ordenes").DataTable({
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
            ajax: "api/ordenes",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_orden_pedido",name: "orden_pedido.no_orden_pedido"},
                { data: "name", name: "users.name" },
                { data: "nombre_cliente", name: "cliente.nombre_cliente" },
                { data: "nombre_sucursal", name: "cliente_sucursales.nombre_sucursal"},
                { data: "fecha", name: "orden_pedido.fecha" },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" },
                { data: "total", name: "orden_pedido.total" },
                { data: "detallada", name: "orden_pedido.detallada" },
                { data: "generado_internamente", name: "orden_pedido.generado_internamente"},
                { data: "notas", name: "orden_pedido.notas" }
            ],
            order: [[2, "desc"]],
            rowGroup: {
                dataSrc: "name"
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

    });
    $("#btnCancelar").click(function(e) {
        $("#btnCancelar").hide();
        $("#btnAgregar").show();
        $("#registroForm").hide();
        $("#listadoUsers").show();
    });

    init();
});
