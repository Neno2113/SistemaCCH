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
var venta_segunda = 0;
var genero_global;
var genero_plus_global;

var a_red;
var b_red;
var c_red;
var d_red;
var e_red;
var f_red;
var g_red;
var h_red;
var i_red;
var j_red;
var k_red;
var l_red;

let val_valid;
let gen;
let subGenero;
let detallado;
let cantidad_wr;
let precio_valid;
let producto_valid;
let a;
let b;
let c;
let d;
let e;
let f;
let g;
let h;
let i;
let j;
let k;
let l;


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
        eliminarEmpty();
        // mostrarForm(false);
        $("#cantidad").val("");
        $("#precio").val("");
        $("#total").val("");
        $("#total_alm").val("");
        $("#btn-edit").hide();
        $("#no_orden_pedido").val("");
        // $("#corte_en_proceso").hide();
        $("#detallada").hide();
        // ordenPedidoCod();
        $("#btn-consultar").hide();
        //cristobal
     //   $("#redistribucion").hide();
        $("#precio_div").hide();
        $("#total_div").hide();
        $("#total_almdiv").hide();
        $("#btn-agregar").attr("disabled", true);
        $("#btn-copia").attr("disabled", true);
        listar();
        $("#registroForm").hide();
        $("#btnCancelar").hide();
        // $("#btn-agregarProceso").attr("disabled", true);
        $("#total").val("");
        $("#total_alm").val("");
        listarRedistribucion();
        listarOrdenesProceso();
        // listarOrden();
        $("#cliente").hide();
        $("#sucursal").hide();
        $("#generado_internamente").hide();
        $("#listarOrden").hide();
        $("#orden_detalle").hide();
        $("#orden_create").show();
        $("#alerta_proceso").hide();
        $("#cliente_segundas").val("");
        venta_segunda = '';
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
        $('#total_detalle').html('');
        $("#total").val("");
        $("#total_alm").val("");
        $("#orden_pedido_id").val("");
        $("#orden_pedido_id_proceso").val("");
        $("#orden_pedido").empty();
        $("input[name='r2'][value='0']").prop("checked", true);
        $("#sec").val("");
        $("#sec_proceso").val();
        $("#clienteSearch")
            .val("")
            .trigger("change");
        $("#sucursalSearch")
            .val("")
            .trigger("change");
       // $("#productoSearch").empty();
        $("#notas").val("");
        $("#cliente_select").val('');
        $("#venta_actual").val('');
        $("#fecha_entrega").val("");
        $("#cantidad").val("");
        $("#precio").val("");
        $("#corte_proceso").val("");
        $("#orden_pedido").empty();
      
    }

    const limpiarCampos = () => {
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

    function vendedores() {
        $("#vendedores").empty();
        $.ajax({
            url: "vendedores/select",
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
                console.log("Ocurrio un error cargando los vendedores");            }
        });
    }

    function productos(){

        $.ajax({
            url: "productos/seleccionar",
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
                console.log("No cargaron los productos");
            }
        });
    }


    // $("#sucursalSearch").on('change', function(){
    //     $("#sucursalSearch").val(null).trigger('change');
    // });

    function eliminarEmpty(){
        $.ajax({
            url: "ordenes/empty",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#ordenes").DataTable().ajax.reload();
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function() {
                console.log("Ocurrio un error")
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
                                const cliente_actual = $("#clienteSearch option:selected").text();
                                $('#cliente_select').html(cliente_actual);
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
                                productos();
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
        $("#total_almdiv").show();
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

    function sucursal(){

        $("#sucursalSearch").empty();
        var sucursal = {
            cliente: $("#clienteSearch").val(),
        };

        $.ajax({
            url: "sucursal/select",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(sucursal),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.sucursal.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila =
                        `<option value="${datos.sucursal[i].id}">${datos.sucursal[i].nombre_sucursal}</option>`;
                        
                        
                        $("#sucursalSearch").append(fila);
                    }
                    $("#sucursalSearch").select2();

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error"
                );
            }
        });
    }

    $("#clienteSearch").change(function(){
        sucursal();
        vendedores();
    });


    // $("#sucursalSearch").select2({
    //     placeholder: "Nombre sucursal",
    //     ajax: {
    //         url: "selectSucursal",
    //         dataType: "json",
    //         delay: 250,
    //         processResults: function(data) {
    //             return {
    //                 results: $.map(data, function(item) {
    //                     return {
    //                         text: item.nombre_sucursal,
    //                         id: item.id
    //                     };
    //                 })
    //             };
    //         },
    //         cache: true
    //     }
    // });

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
            limpiarCampos();
            consulta();
            // $('#venta_actual').html('Venta de primera');
        } else if (val == 0) {
            mostrarDetalle(false);
            consulta();
            $("#btn-copia").attr("disabled", false);
            // $('#venta_actual').html('Venta de segunda');
        }
    });

    // CRISTOBAL INICIO
    // CRISTOBAL INICIO
    // CRISTOBAL INICIO

    $("select[id='productoSearch']").change(function(cri) {
        cri.preventDefault();

        let val = $("input[name='r2']:checked").val();
        ContenidoSelect = $("#productoSearch").val();

        if (val == 1) {
            mostrarDetalle(true);
            limpiarCampos();
            if (ContenidoSelect != null) {
                consulta();
            }
            
            // $('#venta_actual').html('Venta de primera');
        } else if (val == 0) {
            mostrarDetalle(false);
            if (ContenidoSelect != "") {
                consulta();
            }
            $("#btn-copia").attr("disabled", false);
            // $('#venta_actual').html('Venta de segunda');
        }
    });
    // CRISTOBAL FIN
    // CRISTOBAL FIN
    // CRISTOBAL FIN

    // function corte_proceso(datos) {
    //     $("#corteProceso").empty();

    //     if(datos == ""){


    //     }else{
    //         for (let t = 0; t < datos.corte_proceso.length; t++) {
    //             var fila ="<tr>"+
    //                 "<td>"+datos.corte_proceso[t].numero_corte+"</td>"+
    //                 "<td>"+datos.corte_proceso[t].fase +"</td>"+
    //                 "<td>"+datos.corte_proceso[t].fecha_entrega+"</td>"+
    //                 "<td>"+datos.corte_proceso[t].producto.referencia_producto+"</td>" +
    //                 "<td>"+datos.corte_proceso[t].total+"</td>"+
    //                 "<td><button onclick='agregarProceso("+datos.corte_proceso[t].id+")' class='btn btn-primary'><i class='fas fa-cart-plus'></i></button></td>"+
    //                 "</tr>";
    //             $("#corteProceso").append(fila);
    //         }
    //     }



    // }

    var cont;
    var cantidad;

    function consulta() {
        let segunda = $("#cliente_segundas").val();
        // console.log(segunda);
        let referencia = $("#productoSearch option:selected").text();
        genero_global = referencia.substring(1, 2);
        genero_plus_global = referencia.substring(3, 4);
        // console.log(genero_global);
        // console.log(genero_plus_global);
        // eliminarColumnas()
        
        if(segunda == 1){
            Swal.fire({
                title: "Este cliente acepta segundas",
                text: "¿Desea realizar una venta de segundas?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, acepto"
            }).then(result => {
                if (result.value) {
                    mostrarDetalle(true);
                    $("input[name='r2'][value='1']").prop("checked", true);
                    var ordenDetalle = {
                        producto_id: $("#productoSearch").val(),
                        referencia_producto: $("#productoSearch option:selected").text(),
                        segunda: 1
                    };
                    venta_segunda = 1;
                    ajaxConsulta(ordenDetalle);
                      $('#venta_actual').html('Venta de segunda');
                }else{
                    var ordenDetalle = {
                        producto_id: $("#productoSearch").val(),
                        referencia_producto: $("#productoSearch option:selected").text()
                    };
                    venta_segunda = 0;
                    ajaxConsulta(ordenDetalle);
                    $('#venta_actual').html('Venta de primera');
                }

            });
        }else{
            var ordenDetalle = {
                producto_id: $("#productoSearch").val(),
                referencia_producto: $("#productoSearch option:selected").text()
            };
            venta_segunda = 0;
            ajaxConsulta(ordenDetalle);
            $('#venta_actual').html('Venta de primera');

        }

    }

    function ajaxConsulta(ordenDetalle){

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
                    $("#total_alm").val(datos.total_almacen);
                    $("#precio_div").show();
                    $("#total_div").show();
                    $('#total_almdiv').show();
                    $("#btn-agregar").show();
                    // $("#btn-consultar").attr("disabled", true);
                    $("#btn-agregar").attr("disabled", false);
                    let genero = ref.substring(1, 2);
                    var mujer_plus = ref.substring(3, 4);
                    // genero_global = ref.substring(1, 2);
                    // mujer_plus_global = ref.substring(3, 4);
                    let cantidad = $("#cantidad").val();
                    let total_alm = datos.total_corte;

                    // corte_proceso(datos);

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
                    datos.a <= 0 ? $("#a, #up-a, #down-a").attr("disabled", true) : $("#a, #up-a, #down-a").attr("disabled", false);
                    datos.b <= 0 ? $("#b, #up-b, #down-b").attr("disabled", true) : $("#b, #up-b, #down-b").attr("disabled", false);
                    datos.c <= 0 ? $("#c, #up-c, #down-c").attr("disabled", true) : $("#c, #up-c, #down-c").attr("disabled", false);
                    datos.d <= 0 ? $("#d, #up-d, #down-d").attr("disabled", true) : $("#d, #up-d, #down-d").attr("disabled", false);
                    datos.e <= 0 ? $("#e, #up-e, #down-e").attr("disabled", true) : $("#e, #up-e, #down-e").attr("disabled", false);
                    datos.f <= 0 ? $("#f, #up-f, #down-f").attr("disabled", true) : $("#f, #up-f, #down-f").attr("disabled", false);
                    datos.g <= 0 ? $("#g, #up-g, #down-g").attr("disabled", true) : $("#g, #up-g, #down-g").attr("disabled", false);
                    datos.h <= 0 ? $("#h, #up-h, #down-h").attr("disabled", true) : $("#h, #up-h, #down-h").attr("disabled", false);
                    datos.i <= 0 ? $("#i, #up-i, #down-i").attr("disabled", true) : $("#i, #up-i, #down-i").attr("disabled", false);
                    datos.j <= 0 ? $("#j, #up-j, #down-j").attr("disabled", true) : $("#j, #up-j, #down-j").attr("disabled", false);
                    datos.k <= 0 ? $("#k, #up-k, #down-k").attr("disabled", true) : $("#k, #up-k, #down-k").attr("disabled", false);
                    datos.l <= 0 ? $("#l, #up-l, #down-l").attr("disabled", true) : $("#l, #up-l, #down-l").attr("disabled", false);

                    if(cantidad > total_alm){
                        $("#btn-agregar").attr("disabled", true);
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

                    $("#disponibles").html(
                        "<tr id='cortes'>" +
                        "<td id='a_corte' class='font-weight-bold'>"+validarNan(datos.a)+"</td>"+
                        "<td id='b_corte' class='font-weight-bold'>"+validarNan(datos.b)+"</td>"+
                        "<td id='c_corte' class='font-weight-bold'>"+validarNan(datos.c)+"</td>"+
                        "<td id='d_corte' class='font-weight-bold'>"+validarNan(datos.d)+"</td>"+
                        "<td id='e_corte' class='font-weight-bold'>"+validarNan(datos.e)+"</td>"+
                        "<td id='f_corte' class='font-weight-bold'>"+validarNan(datos.f)+"</td>"+
                        "<td id='g_corte' class='font-weight-bold'>"+validarNan(datos.g)+"</td>"+
                        "<td id='h_corte' class='font-weight-bold'>"+validarNan(datos.h)+"</td>"+
                        "<td id='i_corte' class='font-weight-bold'>"+validarNan(datos.i)+"</td>"+
                        "<td id='j_corte' class='font-weight-bold'>"+validarNan(datos.j)+"</td>"+
                        "<td id='j_corte' class='font-weight-bold'>"+validarNan(datos.k)+"</td>"+
                        "<td id='j_corte' class='font-weight-bold'>"+validarNan(datos.l)+"</td>"+
                        "<td id='j_corte' class='font-weight-bold'>"+validarNan(datos.total_corte)+"</td>"+
                        "</tr>"
                    );
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
                        $("#tk").html("46");
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

                        // $("#a").attr("placeholder", "28");
                        // $("#b").attr("placeholder", "29");
                        // $("#c").attr("placeholder", "30");
                        // $("#d").attr("placeholder", "32");
                        // $("#e").attr("placeholder", "34");
                        // $("#f").attr("placeholder", "36");
                        // $("#g").attr("placeholder", "38");
                        // $("#h").attr("placeholder", "40");
                        // $("#i").attr("placeholder", "42");
                        // $("#j").attr("placeholder", "44");
                        // $("#k").attr("placeholder", "");
                        // $("#l").attr("placeholder", "");


                    } else if (genero == 3 || genero == 4) {
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

                        // $("#a").attr("placeholder", "2");
                        // $("#b").attr("placeholder", "4");
                        // $("#c").attr("placeholder", "6");
                        // $("#d").attr("placeholder", "8");
                        // $("#e").attr("placeholder", "10");
                        // $("#f").attr("placeholder", "12");
                        // $("#g").attr("placeholder", "14");
                        // $("#h").attr("placeholder", "16");
                        // $("#i").attr("placeholder", "");
                        // $("#j").attr("placeholder", "");
                        // $("#k").attr("placeholder", "");
                        // $("#l").attr("placeholder", "");

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

                            // $("#a").attr("placeholder", "12W");
                            // $("#b").attr("placeholder", "14W");
                            // $("#c").attr("placeholder", "16W");
                            // $("#d").attr("placeholder", "18W");
                            // $("#e").attr("placeholder", "20W");
                            // $("#f").attr("placeholder", "22W");
                            // $("#g").attr("placeholder", "24W");
                            // $("#h").attr("placeholder", "26W");
                            // $("#i").attr("placeholder", "");
                            // $("#j").attr("placeholder", "");
                            // $("#k").attr("placeholder", "");
                            // $("#l").attr("placeholder", "");


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

                            // $("#a").attr("placeholder", "0/0");
                            // $("#b").attr("placeholder", "1/2");
                            // $("#c").attr("placeholder", "3/4");
                            // $("#d").attr("placeholder", "5/6");
                            // $("#e").attr("placeholder", "7/8");
                            // $("#f").attr("placeholder", "9/10");
                            // $("#g").attr("placeholder", "11/12");
                            // $("#h").attr("placeholder", "13/14");
                            // $("#i").attr("placeholder", "15/16");
                            // $("#j").attr("placeholder", "17/18");
                            // $("#k").attr("placeholder", "19/20");
                            // $("#l").attr("placeholder", "21/22");


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
        a = validarNan(parseInt($("#a").val()));
        b = validarNan(parseInt($("#b").val()));
        c = validarNan(parseInt($("#c").val()));
        d = validarNan(parseInt($("#d").val()));
        e = validarNan(parseInt($("#e").val()));
        f = validarNan(parseInt($("#f").val()));
        g = validarNan(parseInt($("#g").val()));
        h = validarNan(parseInt($("#h").val()));
        i = validarNan(parseInt($("#i").val()));
        j = validarNan(parseInt($("#j").val()));
        k = validarNan(parseInt($("#k").val()));
        l = validarNan(parseInt($("#l").val()));
        let referencia = $("#productoSearch option:selected").text();
        producto_valid = referencia.substring(0, 9);
        gen = producto_valid.substring(1, 2);
        subGenero = producto_valid.substring(3, 4);
        detallado = $("input[name='r2']:checked").val();
        cantidad_wr = $("#cantidad").val();
        precio_valid = $("#precio").val();
        let total_detalle = a + b + c + d + e + f + g + h + i + j + k + l;
        // console.log(cantidad_wr);
        // console.log(total_detalle);
        // console.log(detallado);

        if(detallado == 1){
            if(total_detalle > cantidad_wr ){
                Swal.fire(
                    'Cuidado!',
                    'Digito una cantidad mayor a la consultada en el sistema.',
                    'info'
                )  
                .then((result) => {
                    if (result.value) {
                        validarTotalDetalle();
                    } 
                  })
            } else if(total_detalle < cantidad_wr) {       
                Swal.fire({
                    title: '¿Esta seguro de continuar?',
                    text: "La cantidad total es menor a la cantidad consultada en el sistema!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, acepto'
                  })  
                  .then((result) => {
                    if (result.value) {
                        validarTotalDetalle();
                    } 
                  })
            } else {
                validarTotalDetalle();
            }

        } else {
            validarTotalDetalle();
        }
        

        
    }


    const validarTotalDetalle = () => {
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
            l: $("#l").val(),
            orden_id: $("#orden_pedido_id").val(),
            producto_id: $("#productoSearch").val()
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
                    val_valid = true;
                  
                    if (total > total_recibido) {
                        bootbox.alert(
                            "<div class='alert alert-danger' role='alert'>" +
                                "<i class='fas fa-exclamation-triangle'></i> La cantidad total de tallas no puede ser mayor a la cantidad recibida de lavanderia" +
                                "</div>"
                        );
                    } else {
                        $("#btn-guardar").show();
                        if (gen == 2) {
                            if (subGenero == 7) {
                                if (a_val > a_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 12W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = true;
                                } else if (b_val > b_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 14W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = true;
                                } else if (c_val > c_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 16W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (d_val > d_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 18W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (e_val > e_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 20W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (f_val > f_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 22W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (g_val > g_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 24W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (h_val > h_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 26W a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
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
                                    val_valid = false;
                                } else if (b_val > b_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 1/2 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (c_val > c_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 3/4 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (d_val > d_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 5/6 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (e_val > e_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 7/8 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (f_val > f_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 9/10 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (g_val > g_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 11/12 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (h_val > h_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 13/14 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (i_val > i_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 15/16 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (j_val > j_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 17/18 a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (k_val > k_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 19/20  a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else if (l_val > l_total) {
                                    bootbox.alert(
                                        "<div class='alert alert-danger' role='alert'>" +
                                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 21/22  a la cantidad disponible para la venta de esta talla" +
                                            "</div>"
                                    );
                                    val_valid = false;
                                } else {
                                    agregarDetalle();
                                }
                            }
                        } else if (gen == 3 || gen == 4) {
                            if (a_val > a_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 2 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (b_val > b_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 4 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (c_val > c_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 6 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (d_val > d_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 8 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (e_val > e_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 10 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (f_val > f_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 12 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (g_val > g_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 14 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (h_val > h_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 16 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else {
                                agregarDetalle();
                            }
                        } else if (gen == 1) {
                            if (a_val > a_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 28 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (b_val > b_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 29 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (c_val > c_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 30 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (d_val > d_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 32 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (e_val > e_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 34 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (f_val > f_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 36 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (g_val > g_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 38 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (h_val > h_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 40 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (i_val > i_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 42 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (j_val > j_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 44 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            } else if (k_val > k_total) {
                                bootbox.alert(
                                    "<div class='alert alert-danger' role='alert'>" +
                                        "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 46 a la cantidad disponible para la venta de esta talla" +
                                        "</div>"
                                );
                                val_valid = false;
                            }else {
                                agregarDetalle();
                            }
                        }
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
                fecha_entrega: $("#fecha_proceso").val(),
                cantidad: $("#cantidad").val(),
                venta_segunda: venta_segunda,
                orden_detallada: 1

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
                fecha_entrega: $("#fecha_proceso").val(),
                producto_id: $("#productoSearch").val(),
                cantidad: $("#cantidad").val(),
                venta_segunda: venta_segunda
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

                    a_red = $("#a").val();
                    b_red = $("#b").val();
                    c_red = $("#c").val();
                    d_red = $("#d").val();
                    e_red = $("#e").val();
                    f_red = $("#f").val();
                    g_red = $("#g").val();
                    h_red = $("#h").val();
                    i_red = $("#i").val();
                    j_red = $("#j").val();
                    k_red = $("#k").val();
                    l_red = $("#l").val();
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
                    $("#fecha_proceso").val("");
                //    $("#productoSearch").val("").select2().trigger('change');
                    $("#cantidad").val("");
                    $("#precio").val("");
                    $("#total").val("");
                    $("#total_alm").val("");
                    // $("#cliente_segundas").val("");
                    $("#btn-agregar").attr("disabled", true);
                    $("#btn-copia").attr("disabled", false);
                    $("#btn-consultar").attr("disabled", true);
                    $("#alerta_proceso").hide();
                    result = false;
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
                        title: "Referencia agregada a la orden correctamente!"
                    });
                    // console.log(val_valid);
                   
                    if (val_valid == false) {
                        val_valid = true;
                    } else if (val_valid == true) {
                        var cont;
                        console.log('Tamo aqui mas abajo');
                        if (gen == 1) {
                            if (detallado == 1) {
                                cantidad = Number(
                                    a + b + c + d + e + f + g + h + i + j + k + l
                                );
                                var fila =
                                    '<tr id="fila'+datos.detalle.id+'"' +
                                    cont +
                                    '" style="font-size: 18px">' +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    producto_valid +
                                    "</th>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    precio_valid +
                                    "</th>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    cantidad +
                                    "</th>" +
                                    "<th id='a_corte' class='font-weight-bold'>" +
                                    a +
                                    "</th>" +
                                    "<th id='b_corte' class='font-weight-bold'>" +
                                    b +
                                    "</th>" +
                                    "<th id='c_corte' class='font-weight-bold'>" +
                                    c +
                                    "</th>" +
                                    "<th id='d_corte' class='font-weight-bold'>" +
                                    d +
                                    "</th>" +
                                    "<th id='e_corte' class='font-weight-bold'>" +
                                    e +
                                    "</th>" +
                                    "<th id='f_corte' class='font-weight-bold'>" +
                                    f +
                                    "</th>" +
                                    "<th id='g_corte' class='font-weight-bold'>" +
                                    g +
                                    "</th>" +
                                    "<th id='h_corte' class='font-weight-bold'>" +
                                    h +
                                    "</th>" +
                                    "<th id='i_corte' class='font-weight-bold'>" +
                                    i +
                                    "</th>" +
                                    "<th id='j_corte' class='font-weight-bold'>" +
                                    j +
                                    "</th>" +
                                    "<th id='k_corte' class='font-weight-bold'>" +
                                    k +
                                    "</th>" +
                                    "<th id='l_corte' class='font-weight-bold'>"+
                                    l +
                                    "</th>" +
                                    "<th id='h_corte' class='font-weight-normal'>"+
                                    "<button type='button' class='btn btn-danger' onclick='delProducto("+datos.detalle.id+")'>"+
                                    "<i class='far fa-trash-alt'></i>"+
                                    "</button> </th>"+
                                    "</tr>";
                                cont++;
                                $("#orden_pedido").append(fila);
                            } else if (detallado == 0) {
                                // let cantidad_wr = $("#cantidad").val();
                                var fila =
                                '<tr id="fila'+datos.detalle.id+'"' +
                                    cont +
                                    '">' +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    producto_valid +
                                    "</th>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    precio_valid +
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
                                    "<th id='j_corte' class='font-weight-normal'></th>" +
                                    "<th id='j_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'>"+
                                    "<button type='button' class='btn btn-danger' onclick='delProducto("+datos.detalle.id+")'>"+
                                    "<i class='far fa-trash-alt'></i>"+
                                    "</button> </th>"+
                                    "</tr>";
                                cont++;
                                $("#orden_pedido").append(fila);
                            }
                        } else if (gen == 3) {
                            if (detallado == 1) {
                                cantidad = Number(
                                    a + b + c + d + e + f + g + h
                                );
                                var fila =
                                '<tr id="fila'+datos.detalle.id+'"' +
                                    cont +
                                    '">' +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    producto_valid +
                                    "</th>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    precio_valid +
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
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'>"+
                                    "<button type='button' class='btn btn-danger' onclick='delProducto("+datos.detalle.id+")'>"+
                                    "<i class='far fa-trash-alt'></i>"+
                                    "</button> </th>"+
                                    "</tr>";
                                cont++;
                                $("#orden_pedido").append(fila);
                            } else if (detallado == 0) {
                                var fila =
                                '<tr id="fila'+datos.detalle.id+'"' +
                                    cont +
                                    '">' +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    producto_valid +
                                    "</th>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    precio_valid +
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
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'>"+
                                    "<button type='button' class='btn btn-danger' onclick='delProducto("+datos.detalle.id+")'>"+
                                    "<i class='far fa-trash-alt'></i>"+
                                    "</button> </th>"+
                                    "</tr>";
                                cont++;
                                $("#orden_pedido").append(fila);
                            }
                        } else if (gen == 4) {
                            if (detallado == 1) {
                                cantidad = Number(
                                    a + b + c + d + e + f + g + h
                                );
                                var fila =
                                '<tr id="fila'+datos.detalle.id+'"' +
                                    cont +
                                    '">' +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    producto_valid +
                                    "</th>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    precio_valid +
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
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'>"+
                                    "<button type='button' class='btn btn-danger' onclick='delProducto("+datos.detalle.id+")'>"+
                                    "<i class='far fa-trash-alt'></i>"+
                                    "</button> </th>"+
                                    "</tr>";
                                cont++;
                                $("#orden_pedido").append(fila);
                            } else if (detallado == 0) {
                                var fila =
                                '<tr id="fila'+datos.detalle.id+'"' +
                                    cont +
                                    '">' +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    producto_valid +
                                    "</th>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    precio_valid +
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
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'>"+
                                    "<button type='button' class='btn btn-danger' onclick='delProducto("+datos.detalle.id+")'>"+
                                    "<i class='far fa-trash-alt'></i>"+
                                    "</button> </th>"+
                                    "</tr>";
                                cont++;
                                $("#orden_pedido").append(fila);
                            }
                        }

                        if (gen == 2) {
                            if (detallado == 1) {
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
                                '<tr id="fila'+datos.detalle.id+'"' +
                                    cont +
                                    '">' +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    producto_valid +
                                    "</th>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    precio_valid +
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
                                    "<th id='h_corte' class='font-weight-normal'>"+
                                    "<button  type='button' class='btn btn-danger' onclick='delProducto("+datos.detalle.id+")'>"+
                                    "<i class='far fa-trash-alt'></i>"+
                                    "</button> </th>"+
                                    "</tr>";
                                cont++;

                                $("#orden_pedido").append(fila);
                            } else if (detallado == 0) {
                                var fila =
                                '<tr id="fila'+datos.detalle.id+'"' +
                                    cont +
                                    '">' +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    producto_valid +
                                    "</th>" +
                                    "<th id='a_corte' class='font-weight-normal'>" +
                                    precio_valid +
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
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'></th>" +
                                    "<th id='h_corte' class='font-weight-normal'>"+
                                    "<button type='button' class='btn btn-danger' onclick='delProducto("+datos.detalle.id+")'>"+
                                    "<i class='far fa-trash-alt'></i>"+
                                    "</button> </th>"+
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
            error: function(datos) {
                console.log(datos.responseJSON.message);

                bootbox.alert("Error: " + datos.responseJSON.message);
            }
        });
    }

    $("#btn-copia").click(function(e){
        e.preventDefault();
        $("#a").prop('disabled') ? $("#a").val("") :  $("#a").val(a_red);
        $("#b").prop('disabled') ? $("#b").val("") :  $("#b").val(b_red);
        $("#c").prop('disabled') ? $("#c").val("") :  $("#c").val(c_red);
        $("#d").prop('disabled') ? $("#d").val("") :  $("#d").val(d_red);
        $("#e").prop('disabled') ? $("#e").val("") :  $("#e").val(e_red);
        $("#f").prop('disabled') ? $("#f").val("") :  $("#f").val(f_red);
        $("#g").prop('disabled') ? $("#g").val("") :  $("#g").val(g_red);
        $("#h").prop('disabled') ? $("#h").val("") :  $("#h").val(h_red);
        $("#i").prop('disabled') ? $("#i").val("") :  $("#i").val(i_red);
        $("#j").prop('disabled') ? $("#j").val("") :  $("#j").val(j_red);
        $("#k").prop('disabled') ? $("#k").val("") :  $("#k").val(k_red);
        $("#l").prop('disabled') ? $("#l").val("") :  $("#l").val(l_red);

    });

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
            ajax:{
                "url": "api/ordenesList",
                "type": "GET"
            },
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
        
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                // { data: "Ver", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_orden_pedido", name: "orden_pedido.no_orden_pedido"},
                { data: "nombre", name: "empleado.nombre" },
                { data: "nombre_cliente", name: "cliente.nombre_cliente" },
                { data: "nombre_sucursal", name: "cliente_sucursales.nombre_sucursal"},
                { data: "fecha", name: "orden_pedido.fecha" },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" },
                { data: "total", name: "orden_pedido.total", searchable: false, orderable: false},
                // { data: "detallada", name: "orden_pedido.detallada" },
                { data: "orden_proceso_impresa", name: "orden_pedido.orden_proceso_impresa" }
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
                { data: "no_orden_pedido", name: "orden_pedido.no_orden_pedido"},
                { data: "referencia_producto", name: "producto.referencia_producto"},
                { data: "client", name: "orden_pedido_detalle.nombre_cliente", searchable: false},
                { data: "sucursal", name: "orden_pedido_detalle.nombre_sucursal", searchable: false},
                { data: "total", name: "orden_pedido_detalle.total", searchable: false },
                { data: "precio", name: "orden_pedido_detalle.precio" },
                { data: "status_orden_pedido", name: "orden_pedido_detalle.status_orden_pedido", searchable: false}
            ],
            order: [[9, "desc"]],
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
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_orden_pedido", name: "orden_pedido.no_orden_pedido"},
                { data: "cliente", name: "orden_pedido.cliente", orderable: false, searchable: false  },
                { data: "sucursal", name: "orden_pedido.sucursal", orderable: false, searchable: false },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" },
                { data: "referencia_producto", name: "orden_pedido.fecha_entrega" },
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

    $("#btnAgregar").click(function(e) {
        limpiar();
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
        $("#orden").DataTable().destroy();
        $("#notas").val("").attr("readonly", false).removeClass("font-weight-bold");
        $("#fecha_entrega").val("").attr("disabled", false);
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
        eliminarEmpty();
    });
/*
    //$("#cantidad").on('keyup', function(){
    $("#cantidad").on('keyup', function(){
        $("#btn-consultar").attr("disabled", false);
        //CRISTOBAL INICIO
        $("#redistribucion").attr("disabled", false);
        //CRISTOBAL FIN
    });*/

    $('input:radio[id="radioPrimary6"]').change(
        function(){
            if ($(this).is(':checked') && $(this).val() == 0) {
                $("#btn-consultar").attr("disabled", false);
                $("#redistribucion").attr("disabled", false);
            }
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
    $.post("orden_pedidocheck/delete/" + id_orden, function(data, status) {
        // console.log(data);
        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
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
        }
  
    })

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
        //CRISTOBAL
        $("#btn-generar").hide();
        $("#orden_create").hide();
        $("#orden_detalle").show();
        //$("#btn-generar").attr("disabled", true);
        //CRISTOBAL FIN
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
       // $("#no_orden_pedido").val(data.orden.no_orden_pedido).addClass("font-weight-bold");
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
                $("#productoSearch").val(datos.producto.id).select2().trigger('change');
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

function agregarProceso(id){

    $.ajax({
        url: "corte/fecha/"+id,
        type: "GET",
        dataType: "json",
        data: JSON.stringify(producto),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                $("#disponibles").html(
                "<tr id='cortes'>" +
                    "<td id='a_corte' >"+validarNan(datos.a)+"</td>"+
                    "<td id='b_corte' >"+validarNan(datos.b)+"</td>"+
                    "<td id='c_corte' >"+validarNan(datos.c)+"</td>"+
                    "<td id='d_corte' >"+validarNan(datos.d)+"</td>"+
                    "<td id='e_corte' >"+validarNan(datos.e)+"</td>"+
                    "<td id='f_corte' >"+validarNan(datos.f)+"</td>"+
                    "<td id='g_corte' >"+validarNan(datos.g)+"</td>"+
                    "<td id='h_corte' >"+validarNan(datos.h)+"</td>"+
                    "<td id='i_corte' >"+validarNan(datos.i)+"</td>"+
                    "<td id='j_corte' >"+validarNan(datos.j)+"</td>"+
                    "<td id='k_corte' >"+validarNan(datos.k)+"</td>"+
                    "<td id='l_corte' >"+validarNan(datos.l)+"</td>"+
                    "</tr>"
                );
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
                $("#total").val(datos.total);

                $("#fecha_proceso").val(datos.fecha_entrega);
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
                $("#ModalSimilares").modal('hide');
                $("#alerta_proceso").show();

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





//Sumar
$("#up-a").click(function(e){
    e.preventDefault();
    let a = Number($("#a").val());

    let result = a + 1;

    $("#a").val(result);

    sumaDetalles();
})
$("#up-b").click(function(e){
    e.preventDefault();
    let b = Number($("#b").val());

    let result = b + 1;

    $("#b").val(result);
    sumaDetalles();
})

$("#up-c").click(function(e){
    e.preventDefault();
    let c = Number($("#c").val());

    let result = c + 1;

    $("#c").val(result);
    sumaDetalles();
})

$("#up-d").click(function(e){
    e.preventDefault();
    let d = Number($("#d").val());

    let result = d + 1;

    $("#d").val(result);
    sumaDetalles();
})

$("#up-e").click(function(t){
    t.preventDefault();
    let e = Number($("#e").val());

    let result = e + 1;

    $("#e").val(result);
    sumaDetalles();
})

$("#up-f").click(function(e){
    e.preventDefault();
    let f = Number($("#f").val());

    let result = f + 1;

    $("#f").val(result);
    sumaDetalles();
})

$("#up-g").click(function(e){
    e.preventDefault();
    let g = Number($("#g").val());

    let result = g + 1;

    $("#g").val(result);
    sumaDetalles();
})

$("#up-h").click(function(e){
    e.preventDefault();
    let h = Number($("#h").val());

    let result = h + 1;

    $("#h").val(result);
    sumaDetalles();
})

$("#up-i").click(function(e){
    e.preventDefault();
    let i = Number($("#i").val());

    let result = i + 1;

    $("#i").val(result);
    sumaDetalles();
})

$("#up-j").click(function(e){
    e.preventDefault();
    let j = Number($("#j").val());

    let result = j + 1;

    $("#j").val(result);
    sumaDetalles();
})

$("#up-k").click(function(e){
    e.preventDefault();
    let k = Number($("#k").val());

    let result = k + 1;

    $("#k").val(result);
    sumaDetalles(); 
})  
$("#up-l").click(function(e){
    e.preventDefault();
    let l = Number($("#l").val());

    let result = l + 1;

    $("#l").val(result);
    sumaDetalles();
})

//restar
$("#down-a").click(function(e){
    e.preventDefault();
    let a = Number($("#a").val());

    let result = a - 1;

    $("#a").val(result);
    sumaDetalles();
})
$("#down-b").click(function(e){
    e.preventDefault();
    let b = Number($("#b").val());

    let result = b - 1;

    $("#b").val(result);
    sumaDetalles();
})

$("#down-c").click(function(e){
    e.preventDefault();
    let c = Number($("#c").val());

    let result = c - 1;

    $("#c").val(result);
    sumaDetalles();
})

$("#down-d").click(function(e){
    e.preventDefault();
    let d = Number($("#d").val());

    let result = d - 1;

    $("#d").val(result);
    sumaDetalles();
})

$("#down-e").click(function(t){
    t.preventDefault();
    let e = Number($("#e").val());

    let result = e - 1;

    $("#e").val(result);
    sumaDetalles();
})      

$("#down-f").click(function(e){
    e.preventDefault();
    let f = Number($("#f").val());

    let result = f - 1;

    $("#f").val(result);
    sumaDetalles();
})

$("#down-g").click(function(e){
    e.preventDefault();
    let g = Number($("#g").val());

    let result = g - 1;

    $("#g").val(result);
    sumaDetalles();
})

$("#down-h").click(function(e){
    e.preventDefault();
    let h = Number($("#h").val());

    let result = h - 1;

    $("#h").val(result);
    sumaDetalles();
})

$("#down-i").click(function(e){
    e.preventDefault();
    let i = Number($("#i").val());

    let result = i - 1;

    $("#i").val(result);
    sumaDetalles();
})

$("#down-j").click(function(e){
    e.preventDefault();
    let j = Number($("#j").val());

    let result = j - 1;

    $("#j").val(result);
    sumaDetalles();
})

$("#down-k").click(function(e){
    e.preventDefault();
    let k = Number($("#k").val());

    let result = k - 1;

    $("#k").val(result);
    sumaDetalles();
})
$("#down-l").click(function(e){
    e.preventDefault();
    let l = Number($("#l").val());

    let result = l - 1;

    $("#l").val(result);
    sumaDetalles();
})

$('#a').on('keyup', () => {
    sumaDetalles();
    
})
$('#b').on('keyup', () => {
    sumaDetalles();
    
})
$('#c').on('keyup', () => {
    sumaDetalles();
    
})
$('#d').on('keyup', () => {
    sumaDetalles();
    
})
$('#e').on('keyup', () => {
    sumaDetalles();
    
})
$('#f').on('keyup', () => {
    sumaDetalles();
    
})
$('#g').on('keyup', () => {
    sumaDetalles();
    
})
$('#h').on('keyup', () => {
    sumaDetalles();
    
})
$('#i').on('keyup', () => {
    sumaDetalles();
    
})
$('#j').on('keyup', () => {
    sumaDetalles();
    
})
$('#k').on('keyup', () => {
    sumaDetalles();
    
})
$('#l').on('keyup', () => {
    sumaDetalles();
    
})


const sumaDetalles = () => {
    let a = Number($("#a").val());
    let b = Number($("#b").val());
    let c = Number($("#c").val());
    let d = Number($("#d").val());
    let e = Number($("#e").val());
    let f = Number($("#f").val());
    let g = Number($("#g").val());
    let h = Number($("#h").val());
    let i = Number($("#i").val());
    let j = Number($("#j").val());
    let k = Number($("#k").val());
    let l = Number($("#l").val());

    let total = a + b + c + d + e + f + g + h + i + j + k + l;

    $('#total_detalle').html(total);
}

function delProducto(id) {
    // console.log(producto);
    Swal.fire({
        title: '¿Esta seguro de eliminar esta referencia del pedido?',
        text: "Va a eliminar esta referencia!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      })
      .then((result) => {
        if (result.value) {
            $.post("detalle/delete/" + id, function(data){
                console.log(data);
                Swal.fire(
                    'Eliminado!',
                    'Producto eliminado correctamente.',
                    'success'
                    )
                    $("#fila"+id).remove();
            })
        } 
        
      })
}

function eliminarColumnas(){
    if(genero_global == 3 || genero_global == 4){
        $("td:nth-child(9) ,th:nth-child(9)").hide();
        $("td:nth-child(10),th:nth-child(10)").hide();
        $("td:nth-child(11),th:nth-child(11)").hide();
        $("td:nth-child(12),th:nth-child(12)").hide();

    }else if(genero_global == 1){
        $("td:nth-child(9) ,th:nth-child(9)").show();
        $("td:nth-child(10),th:nth-child(10)").show();
        $("td:nth-child(11),th:nth-child(11)").hide();
        $("td:nth-child(12),th:nth-child(12)").hide();
    }

    if(genero_plus_global == 7){
        $("td:nth-child(9),th:nth-child(9)").hide();
        $("td:nth-child(10),th:nth-child(10)").hide();
        $("td:nth-child(11),th:nth-child(11)").hide();
        $("td:nth-child(12),th:nth-child(12)").hide();
    }
}


