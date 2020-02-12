var genero_global;
var genero_plus_global;
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



    $("#formulario").validate({
        rules: {
            codigo_composicion: {
                required: true,
                minlength: 1
            },
            nombre_composicion: {
                required: true,
                minlength: 1
            }
        },
        messages: {
            codigo_composicion: {
                required: "Introduzca el codigo de composicion",
                minlength: "Debe contener al menos 1 letra"
            },
            nombre_composicion: {
                required: "Introduzca el nombre de composicion",
                minlength: "Debe contener al menos 1 letra"
            }
        }
    });

    var tabla;

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
        $("#sub-genero").hide();
        $("#loading").hide();
        $("#loading2").hide();
        $("#loading3").hide();
        entradaCod();
    }

    function validarNan(val) {
        if (isNaN(val) || val < 0) {
            return 0;
        } else {
            return val;
        }
    }

    function entradaCod() {
        $("#sec").val("");
        $("#codigo_entrada").val("");

        $.ajax({
            url: "almacen/lastdigit",
            type: "GET",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {

                    var i = Number(datos.sec);
                    $("#sec").val(i);
                    i = (i + 0.01).toFixed(2).split('.').join("");
                    var referencia = "EA"+'-'+i;

                    $("#codigo_entrada").val(referencia);

                } else {
                    bootbox.alert(
                        "Ocurrio un error !!"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error!!"
                );
            }
        });
    }


    function limpiar() {
        $("#id").val("");
        $("#almacen_id").val("");
        $("#cortesSearchEdit").val("").trigger("change");
        $("#cortesSearch").val("").trigger("change");
        $("#ubicacion").val("");
        $("#tono").val("");
        $("#intensidad_proceso_seco").val("");
        $("#atributo_no_1").val("");
        $("#atributo_no_2").val("");
        $("#atributo_no_3").val("");
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
        $("#genero").val("");
        $("#disponibles").empty();
        $("#resultados").empty();
        $("#fecha_entrada").val("");
    }

    function limpiarDetalle(){
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

    $("#cortesSearch").select2({
        placeholder: "Buscar un numero de corte Ej: 2019-xxx",
        ajax: {
            url: "cortes-almacen",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.numero_corte + " - " + item.fase,
                            id: item.id
                        };
                    })
                };
            },
            cache: true
        }
    });

    $("#cortesSearchEdit").select2({
        placeholder: "Buscar un numero de corte Ej: 2019-xxx",
        ajax: {
            url: "cortes_edit",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.numero_corte + " - " + item.fase,
                            id: item.id
                        };
                    })
                };
            },
            cache: true
        }
    });

    $("#productos").select2({
        placeholder: "Busca la referencia de producto Ex: P100-xxxx",
        ajax: {
            url: "productos-almacen",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.referencia_producto,
                            id: item.id
                        };
                    })
                };
            },
            cache: true
        }
    });

    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var almacen = {
            corte: $("#cortesSearch").val(),
            ubicacion: $("#ubicacion").val(),
            tono: $("#tono").val(),
            intensidad_proceso_seco: $("#intensidad_proceso_seco").val(),
            atributo_no_1: $("#atributo_no_1").val(),
            atributo_no_2: $("#atributo_no_2").val(),
            atributo_no_3: $("#atributo_no_3").val(),
            // a: $("#a").val(),
            // b: $("#b").val(),
            // c: $("#c").val(),
            // d: $("#d").val(),
            // e: $("#e").val(),
            // f: $("#f").val(),
            // g: $("#g").val(),
            // h: $("#h").val(),
            // i: $("#i").val(),
            // j: $("#j").val(),
            // k: $("#k").val(),
            // l: $("#l").val()
        };


        $.ajax({
            url: "almacen",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(almacen),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Success',
                        'Registro a almacen realizado correctamente.',
                        'success'
                    )

                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
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
    });

    function listar() {
        tabla = $("#almacenes").DataTable({
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
            ajax: "api/almacenes",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "name", name: "users.name" },
                { data: "numero_corte", name: "corte.numero_corte" },
                { data: "referencia_producto", name: "producto.referencia_producto"},
                { data: "total", name: "almacen.total" },
                { data: "totalCorte", name: "corte.total" },
            ],
            order: [[4, "asc"]],
            rowGroup: {
                dataSrc: "referencia_producto"
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var almacen = {
            id: $("#id").val(),
            producto_id: $("#productos").val(),
            corte: $("#cortesSearchEdit").val(),
            ubicacion: $("#ubicacion").val(),
            tono: $("#tono").val(),
            intensidad_proceso_seco: $("#intensidad_proceso_seco").val(),
            atributo_no_1: $("#atributo_no_1").val(),
            atributo_no_2: $("#atributo_no_2").val(),
            atributo_no_3: $("#atributo_no_3").val(),
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
            url: "almacen/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(almacen),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert(
                        "Se actualizado correctamente el corte en almacen"
                    );
                    limpiar();
                    tabla.ajax.reload();
                    $("#id").val("");
                    $("#referencia_producto").hide();
                    $("#numero_corte").hide();
                    mostrarForm(false);
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

    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#corteAdd").show();
            $("#imagen_frente").show();
            $("#imagen_trasera").show();
            $("#imagen_perfil").show();
            $("#imagen_bolsillo").show();
            $("#btn-upload").show();
            $("#btn-buscar").show();
            $("#btn-imprimir").attr("disabled", true);
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#btn-edit").hide();
            $("#entrada_alm").hide();
            $("#entrada_alm").removeClass("btn-success").addClass("btn-primary");
            $("#btn-imprimir").hide();
            // $("#btn-guardar").show();
            $("#referencia_producto").hide();
            $("#numero_corte").hide();
            $("#corteEdit").hide();
            $("#formUpload").hide();
            $("#form_producto").hide();
            $("#form_producto_2").hide();
            $("#form_talla").hide();
            $("#btn-guardar").attr("disabled", true);
        }
    }

    $("#fecha_entrada").change(function(){
        $("#entrada_alm").show();
    });

    $("#btn-buscar").click(function() {
        $("#loading").show();
        $("#loading2").show();
        $("#loading3").show();

        setInterval(function() {
            $("#loading").hide();
            $("#loading2").hide();
            $("#loading3").hide();
        }, 1500);

        var corte = {
            id: $("#cortesSearch").val(),
            idEdit: $("#cortesSearchEdit").val()
        };

        let corte_id = $("#cortesSearch").val();
        let corte_id_edit = $("#cortesSearchEdit").val();

        $("#corte_id").val(corte_id);
        $("#corte_id_edit").val(corte_id_edit);

        $.ajax({
            url: "show/corte/producto",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    let ubicacion = datos.producto.ubicacion;
                    let val = datos.referencia;
                    let genero = val.substring(1, 2);
                    let mujer_plus = val.substring(3, 4);
                    genero_global = genero;
                    genero_plus_global = mujer_plus;
                    console.log(genero);
                    console.log(mujer_plus);
                    $("#pendiente_produccion").html(datos.pen_produccion);
                    $("#pendiente_lavanderia").html(datos.pen_lavanderia);
                    $("#perdida_x").html(datos.perdida_x);
                    $("#producto_id").val(datos.producto.id);

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
                    (datos.a <= 0 ) ? $("#a").attr('disabled', true) : $("#a").attr('disabled', false);
                    (datos.b <= 0 ) ? $("#b").attr('disabled', true) : $("#b").attr('disabled', false);
                    (datos.c <= 0 ) ? $("#c").attr('disabled', true) : $("#c").attr('disabled', false);
                    (datos.d <= 0 ) ? $("#d").attr('disabled', true) : $("#d").attr('disabled', false);
                    (datos.e <= 0 ) ? $("#e").attr('disabled', true) : $("#e").attr('disabled', false);
                    (datos.f <= 0 ) ? $("#f").attr('disabled', true) : $("#f").attr('disabled', false);
                    (datos.g <= 0 ) ? $("#g").attr('disabled', true) : $("#g").attr('disabled', false);
                    (datos.h <= 0 ) ? $("#h").attr('disabled', true) : $("#h").attr('disabled', false);
                    (datos.i <= 0 ) ? $("#i").attr('disabled', true) : $("#i").attr('disabled', false);
                    (datos.j <= 0 ) ? $("#j").attr('disabled', true) : $("#j").attr('disabled', false);
                    (datos.k <= 0 ) ? $("#k").attr('disabled', true) : $("#k").attr('disabled', false);
                    (datos.l <= 0 ) ? $("#l").attr('disabled', true) : $("#l").attr('disabled', false);

                    $("#ra").html(datos.a);
                    $("#rb").html(datos.b);
                    $("#rc").html(datos.c);
                    $("#rd").html(datos.d);
                    $("#re").html(datos.e);
                    $("#rf").html(datos.f);
                    $("#rg").html(datos.g);
                    $("#rh").html(datos.h);
                    $("#ri").html(datos.i);
                    $("#rj").html(datos.j);
                    $("#rk").html(datos.k);
                    $("#rl").html(datos.l);
                    $("#total").html(datos.total);

                    var corte = {
                        corte_id: $("#cortesSearch").val(),

                    };

                    $.ajax({
                        url: "total_recepcion",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(corte),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                                total_recibido = datos.total_recibido;
                                $("#total_terminacion").html(datos.total_recibido);

                            } else {
                                bootbox.alert(
                                    "Ocurrio un error durante la creacion de la composicion"
                                );
                            }
                        },
                        error: function() {
                           console.log("ocurrio un error")
                        }
                    });

                    $("#genero").val("Referencia producto: " + val);

                    // listarCorteDetalle(datos.id);
                    if (genero == "2") {

                        if (mujer_plus == 7) {
                            $("#ta").html("12W");
                            $("#tb").html("14W");
                            $("#tc").html("16W");
                            $("#td").html("18W");
                            $("#te").html("20W");
                            $("#tf").html("22W");
                            $("#tg").html("24W");
                            $("#th").html("26W");
                            $("#sa").html("12W");
                            $("#sb").html("14W");
                            $("#sc").html("16W");
                            $("#sd").html("18W");
                            $("#se").html("20W");
                            $("#sf").html("22W");
                            $("#sg").html("24W");
                            $("#sh").html("26W");
                            $("#ba").html("12W");
                            $("#bb").html("14W");
                            $("#bc").html("16W");
                            $("#bd").html("18W");
                            $("#be").html("20W");
                            $("#bf").html("22W");
                            $("#bg").html("24W");
                            $("#bh").html("26W");
                            $("#i").attr("disabled", true);
                            $("#j").attr("disabled", true);
                            $("#k").attr("disabled", true);
                            $("#l").attr("disabled", true);


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
                            $("#sa").html("0/0");
                            $("#sb").html("1/2");
                            $("#sc").html("3/4");
                            $("#sd").html("5/6");
                            $("#se").html("7/8");
                            $("#sf").html("9/10");
                            $("#sg").html("11/12");
                            $("#sh").html("13/14");
                            $("#si").html("15/16");
                            $("#sj").html("17/18");
                            $("#sk").html("19/20");
                            $("#sl").html("21/22");
                            $("#ba").html("0/0");
                            $("#bb").html("1/2");
                            $("#bc").html("3/4");
                            $("#bd").html("5/6");
                            $("#be").html("7/8");
                            $("#bf").html("9/10");
                            $("#bg").html("11/12");
                            $("#bh").html("13/14");
                            $("#bi").html("15/16");
                            $("#bj").html("17/18");
                            $("#bk").html("19/20");
                            $("#bl").html("21/22");
                        }
                    }
                    if (genero == "3") {
                        $("#genero").val("Niño: " + val);
                        $("#sub-genero").hide();
                        $("#ta").html("2");
                        $("#tb").html("4");
                        $("#tc").html("6");
                        $("#td").html("8");
                        $("#te").html("10");
                        $("#tf").html("12");
                        $("#tg").html("14");
                        $("#th").html("16");
                        $("#sa").html("2");
                        $("#sb").html("4");
                        $("#sc").html("6");
                        $("#sd").html("8");
                        $("#se").html("10");
                        $("#sf").html("12");
                        $("#sg").html("14");
                        $("#sh").html("16");
                        $("#ba").html("2");
                        $("#bb").html("4");
                        $("#bc").html("6");
                        $("#bd").html("8");
                        $("#be").html("10");
                        $("#bf").html("12");
                        $("#bg").html("14");
                        $("#bh").html("16");

                        $("#i").attr("disabled", true);
                        $("#j").attr("disabled", true);
                        $("#k").attr("disabled", true);
                        $("#l").attr("disabled", true);

                    } else if (genero == "4") {
                        $("#genero").val("Niña: " + val);
                        $("#sub-genero").hide();
                        $("#ta").html("2");
                        $("#tb").html("4");
                        $("#tc").html("6");
                        $("#td").html("8");
                        $("#te").html("10");
                        $("#tf").html("12");
                        $("#tg").html("14");
                        $("#th").html("16");
                        $("#sa").html("2");
                        $("#sb").html("4");
                        $("#sc").html("6");
                        $("#sd").html("8");
                        $("#se").html("10");
                        $("#sf").html("12");
                        $("#sg").html("14");
                        $("#sh").html("16");
                        $("#ba").html("2");
                        $("#bb").html("4");
                        $("#bc").html("6");
                        $("#bd").html("8");
                        $("#be").html("10");
                        $("#bf").html("12");
                        $("#bg").html("14");
                        $("#bh").html("16");
                        $("#i").attr("disabled", true);
                        $("#j").attr("disabled", true);
                        $("#k").attr("disabled", true);
                        $("#l").attr("disabled", true);

                    } else if (genero == "1") {
                        // $("#genero").val("Hombre: " + val);
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
                        $("#sa").html("28");
                        $("#sb").html("29");
                        $("#sc").html("30");
                        $("#sd").html("32");
                        $("#se").html("34");
                        $("#sf").html("36");
                        $("#sg").html("38");
                        $("#sh").html("40");
                        $("#si").html("42");
                        $("#sj").html("44");
                        $("#ba").html("28");
                        $("#bb").html("29");
                        $("#bc").html("30");
                        $("#bd").html("32");
                        $("#be").html("34");
                        $("#bf").html("36");
                        $("#bg").html("38");
                        $("#bh").html("40");
                        $("#bi").html("42");
                        $("#bj").html("44");

                        $("#total").html(datos.total);
                        $("#i").attr("disabled", false);
                        $("#j").attr("disabled", false);
                        $("#k").attr("disabled", true);
                        $("#l").attr("disabled", true);

                    } else if (val == "") {
                        $("#motivo").html("<option value=''> </option>");
                    }

                    if (ubicacion != null) {
                        bootbox.confirm({
                            message:
                                "¿Desea modificar la ubicacion o datos de la referencia?",
                            buttons: {
                                confirm: {
                                    label: "Si",
                                    className: "btn-primary"
                                },
                                cancel: {
                                    label: "No",
                                    className: "btn-warning"
                                }
                            },
                            callback: function(result) {
                                if (result) {
                                    $("#formUpload").show();
                                    $("#form_producto").show();
                                    $("#form_producto_2").show();
                                    $("#form_talla").show();
                                } else {
                                    $("#formUpload").show();
                                    $("#form_producto").hide();
                                    $("#form_producto_2").hide();
                                    $("#form_talla").show();
                                }
                            }
                        });
                    } else {
                        $("#formUpload").show();
                        $("#form_producto").show();
                        $("#form_producto_2").show();
                        $("#form_talla").show();
                    }
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
    });

    function validarTallas(){

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
            almacen_id: $("#id").val()
        };

        $("#entrada_alm").removeClass("btn-secondary").addClass("btn-success");
        $.ajax({
            url: "validar/total",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(validar),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    let total = datos.total;
                    var a = datos.a;
                    var b = datos.b;
                    var c = datos.c;
                    var d = datos.d;
                    var e = datos.e;
                    var f = datos.f;
                    var g = datos.g;
                    var h = datos.h;
                    var i = datos.i;
                    var j = datos.j;
                    var k = datos.k;
                    var l = datos.l;

                    if(total > total_recibido){
                        bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                        "<i class='fas fa-exclamation-triangle'></i> La cantidad total de tallas no puede ser mayor a la cantidad total en terminacion"+
                       "</div>")

                    }else{
                        if(genero_global == 2){
                            if(genero_plus_global == 7){
                                if(a > a_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 12W a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(b > b_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 14W a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(c > c_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 16W a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }
                                else if(d > d_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 18W a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(e > e_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 20W a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(f > f_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 22W a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(g > g_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 24W a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(h > h_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 26W a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else{
                                    agregarDetalle()
                                }
                            }else{
                                if(a > a_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 0/0 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(b > b_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 1/2 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(c > c_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 3/4 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }
                                else if(d > d_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 5/6 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(e > e_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 7/8 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(f > f_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 9/10 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(g > g_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 11/12 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(h > h_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 13/14 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(i > i_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 15/16 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(j > j_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 17/18 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(k > k_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 19/20 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else if(l > l_total){
                                    bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                    "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 21/22 a la cantidad total del corte y las perdidas"+
                                   "</div>")
                                }else{
                                    agregarDetalle()
                                }
                            }
                        }else if(genero_global == 3 && genero_global == 4){
                            if(a > a_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 2 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(b > b_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 4 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(c > c_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 6 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }
                            else if(d > d_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 8 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(e > e_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 10 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(f > f_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 12 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(g > g_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 14 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(h > h_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 16 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else{
                                agregarDetalle()
                            }
                        }else if(genero_global == 1){
                            if(a > a_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 28 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(b > b_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 29 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(c > c_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 30 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }
                            else if(d > d_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 32 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(e > e_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 34 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(f > f_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 36 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(g > g_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 38 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(h > h_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 40 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(i > i_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 42 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(j > j_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 44 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else{
                                agregarDetalle()
                            }
                        }
                    }

                        console.log(total);
                        console.log(total_recibido);



                    } else {
                        bootbox.alert(
                            "Ocurrio un error durante la creacion de la composicion"
                        );
                    }
                },
                error: function() {
                   console.log("ocurrio un error")
                }
        });
    }

    //funcion que validar si el total de tallas es mayor a la cantidad recibida en recepcion
    $("#btn-close").click(function(e){
        e.preventDefault();


    });

    // //funcion para listar en el Datatable
    // function listarCorteDetalle(id) {
    //     tabla_orden = $("#corte_detalle").DataTable({
    //         serverSide: true,
    //         bFilter: false,
    //         lengthChange: false,
    //         bPaginate: false,
    //         bInfo: false,
    //         retrieve: true,
    //         ajax: "api/detalle_corte/" + id,
    //         columns: [
    //             { data: "a", name: "tallas.a" },
    //             { data: "b", name: "tallas.b" },
    //             { data: "c", name: "tallas.c" },
    //             { data: "d", name: "tallas.d" },
    //             { data: "e", name: "tallas.e" },
    //             { data: "f", name: "tallas.f" },
    //             { data: "g", name: "tallas.g" },
    //             { data: "h", name: "tallas.h" },
    //             { data: "i", name: "tallas.i" },
    //             { data: "j", name: "tallas.j" },
    //             { data: "k", name: "tallas.k" },
    //             { data: "l", name: "tallas.l" }
    //         ]
    //     });

    //     $("#corte_detalle")
    //         .DataTable()
    //         .ajax.reload();
    // }

    $("#btn-upload").click(function() {
        $("#btn-guardar").attr("disabled", false);
    });

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        $("#almacenes").DataTable().ajax.reload();
        mostrarForm(false);
    });

    $('#modalAlmacen').on('hidden.bs.modal', function (e) {
        e.preventDefault();


    })

    $("#formUpload").submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "almacen/imagen",
            type: "POST",
            data: formData,
            dataType: "JSON",
            processData: false,
            cache: false,
            contentType: false,
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Success',
                        'Imagenes subidas correctamente',
                        'success'
                    )
                    $("#imagen_frente").val("");
                    $("#imagen_trasera").val("");
                    $("#imagen_perfil").val("");
                    $("#imagen_bolsillo").val("");
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function(datos) {
                console.log(datos.responseJSON.message);
                let errores = datos.responseJSON.message;

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
    });

    $("#btn-agregar").click(function(t){
        t.preventDefault();
        validarTallas();


    });

    function agregarDetalle(){
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


        var tallas = {
            a: a,
            b: b,
            c: c,
            d: d,
            e: e,
            f: f,
            g: g,
            h: h,
            i: i,
            j: j,
            k: k,
            l: l,
            producto_id: $("#producto_id").val(),
            almacen_id: $("#id").val(),
            codigo_entrada: $("#codigo_entrada").val(),
            sec: $("#sec").val(),
            fecha: $("#fecha_entrada").val()
        }


        $.ajax({
            url: "almacen/detalle",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(tallas),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var cont;
                    var fila =
                    '<tr id="fila'+cont +'">'+
                    "<td><input type='hidden' name='a[]' id='a[]' value="+a+">"+a+"</td>"+
                    "<td><input type='hidden' name='b[]' id='b[]' value="+b+">"+b+"</td>"+
                    "<td><input type='hidden' name='c[]' id='c[]' value="+c+">"+c+"</td>"+
                    "<td><input type='hidden' name='d[]' id='d[]' value="+d+">"+d+"</td>"+
                    "<td><input type='hidden' name='e[]' id='e[]' value="+e+">"+e+"</td>"+
                    "<td><input type='hidden' name='f[]' id='f[]' value="+f+">"+f+"</td>"+
                    "<td><input type='hidden' name='g[]' id='g[]' value="+g+">"+g+"</td>"+
                    "<td><input type='hidden' name='h[]' id='h[]' value="+h+">"+h+"</td>"+
                    "<td><input type='hidden' name='i[]' id='i[]' value="+i+">"+i+"</td>"+
                    "<td><input type='hidden' name='j[]' id='j[]' value="+j+">"+j+"</td>"+
                    "<td><input type='hidden' name='k[]' id='k[]' value="+k+">"+k+"</td>"+
                    "<td><input type='hidden' name='l[]' id='l[]' value="+l+">"+l+"</td>"+
                    "<td><input type='hidden' id='total_talla[]' name='total_talla[]' value="+datos.detalle.total+">"+datos.detalle.total+"</td>"+
                    "</tr>";
                    cont++;
                $("#disponibles").append(fila);
                limpiarDetalle();
                calcularTotales();
                entradaCod();
                $("#btn-imprimir").show();
                $("#entrada_alm").removeClass("btn-primary").addClass("btn-success");
                $("#btn-imprimir").attr("href", 'imprimir/DocEA/'+datos.detalle.id);
                // Swal.fire({
                //     position: 'top-end',
                //     type: 'success',
                //     width: '500px',
                //     title: 'Entrada a almacen realizada correctamente',
                //     showConfirmButton: false,
                //     timer: 1500
                // })

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    onOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    type: 'success',
                    title: 'Entrada guardada'
                })
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

    function calcularTotales(){

        var tallas = {
            almacen_id: $("#id").val()
        }

        $.ajax({
            url: "almacen/calcular/total",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(tallas),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#resultados").empty();
                    var resultado =
                    '<tr id="fila">'+
                    "<td><input type='hidden' name='a[]' id='a[]' value="+datos.a+">"+datos.a+"</td>"+
                    "<td><input type='hidden' name='b[]' id='b[]' value="+datos.b+">"+datos.b+"</td>"+
                    "<td><input type='hidden' name='c[]' id='c[]' value="+datos.c+">"+datos.c+"</td>"+
                    "<td><input type='hidden' name='d[]' id='d[]' value="+datos.d+">"+datos.d+"</td>"+
                    "<td><input type='hidden' name='e[]' id='e[]' value="+datos.e+">"+datos.e+"</td>"+
                    "<td><input type='hidden' name='f[]' id='f[]' value="+datos.f+">"+datos.f+"</td>"+
                    "<td><input type='hidden' name='g[]' id='g[]' value="+datos.g+">"+datos.g+"</td>"+
                    "<td><input type='hidden' name='h[]' id='h[]' value="+datos.h+">"+datos.h+"</td>"+
                    "<td><input type='hidden' name='i[]' id='i[]' value="+datos.i+">"+datos.i+"</td>"+
                    "<td><input type='hidden' name='j[]' id='j[]' value="+datos.j+">"+datos.j+"</td>"+
                    "<td><input type='hidden' name='k[]' id='k[]' value="+datos.k+">"+datos.k+"</td>"+
                    "<td><input type='hidden' name='l[]' id='l[]' value="+datos.l+">"+datos.l+"</td>"+
                    "<td><input type='hidden' id='total_talla[]' name='total_talla[]' value="+datos.total+">"+datos.total+"</td>"+
                    "</tr>";

                $("#resultados").append(resultado);
                limpiarDetalle();
                // calcularTotales();

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




    init();
});

function mostrar(id_almacen){
    $.get("almacen/" + id_almacen, function(data, status) {
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").hide();
        $("#btn-guardar").hide();
        $("#referencia_producto").show();
        $("#numero_corte").show();
        // $("#corteEdit").show();
        $("#corteAdd").hide();
        $("#formUpload").show();
        $("#form_producto").show();
        $("#form_producto_2").show();
        $("#form_talla").show();
        $("#btn-buscar").hide();
        // $("#btn-imprimir").hide();
        let genero = data.almacen.producto.referencia_producto.substring(1, 2);
        genero_global = data.almacen.producto.referencia_producto.substring(1, 2);
        let mujer_plus = data.almacen.producto.referencia_producto.substring(3, 4);
        genero_plus_global = data.almacen.producto.referencia_producto.substring(3, 4);

        //validacion de talla igual 0 desabilitar input correspondiente a esa talla
        (data.a <= 0 ) ? $("#a").attr('disabled', true) : $("#a").attr('disabled', false);
        (data.b <= 0 ) ? $("#b").attr('disabled', true) : $("#b").attr('disabled', false);
        (data.c <= 0 ) ? $("#c").attr('disabled', true) : $("#c").attr('disabled', false);
        (data.d <= 0 ) ? $("#d").attr('disabled', true) : $("#d").attr('disabled', false);
        (data.e <= 0 ) ? $("#e").attr('disabled', true) : $("#e").attr('disabled', false);
        (data.f <= 0 ) ? $("#f").attr('disabled', true) : $("#f").attr('disabled', false);
        (data.g <= 0 ) ? $("#g").attr('disabled', true) : $("#g").attr('disabled', false);
        (data.h <= 0 ) ? $("#h").attr('disabled', true) : $("#h").attr('disabled', false);
        (data.i <= 0 ) ? $("#i").attr('disabled', true) : $("#i").attr('disabled', false);
        (data.j <= 0 ) ? $("#j").attr('disabled', true) : $("#j").attr('disabled', false);
        (data.k <= 0 ) ? $("#k").attr('disabled', true) : $("#k").attr('disabled', false);
        (data.l <= 0 ) ? $("#l").attr('disabled', true) : $("#l").attr('disabled', false);

        $("#id").val(data.almacen.id);
        $("#numero_corte").val('Corte: '+data.almacen.corte.numero_corte);
        $("#ubicacion").val(data.almacen.producto.ubicacion);
        $("#tono").val(data.almacen.producto.tono);
        $("#intensidad_proceso_seco").val(data.almacen.producto.intensidad_proceso_seco);
        $("#atributo_no_1").val(data.almacen.producto.atributo_no_1);
        $("#atributo_no_2").val(data.almacen.producto.atributo_no_2);
        $("#atributo_no_3").val(data.almacen.producto.atributo_no_3);
        $("#ra").html(data.a);
        $("#rb").html(data.b);
        $("#rc").html(data.c);
        $("#rd").html(data.d);
        $("#re").html(data.e);
        $("#rf").html(data.f);
        $("#rg").html(data.g);
        $("#rh").html(data.h);
        $("#ri").html(data.i);
        $("#rj").html(data.j);
        $("#rk").html(data.k);
        $("#rl").html(data.l);
        a_total = data.a;
        b_total = data.b;
        c_total = data.c;
        d_total = data.d;
        e_total = data.e;
        f_total = data.f;
        g_total = data.g;
        h_total = data.h;
        i_total = data.i;
        j_total = data.j;
        k_total = data.k;
        l_total = data.l;
        total_recibido = data.total_recibido;

        $("#total").html(data.total);
        $("#genero").val(data.almacen.producto.referencia_producto);
        $("#frente").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_frente)
        $("#trasera").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_trasero)
        $("#perfil").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_perfil)
        $("#bolsillo").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_bolsillo)
        $("#pendiente_produccion").html(data.pen_produccion);
        $("#pendiente_lavanderia").html(data.pen_lavanderia);
        $("#total_terminacion").html(data.total_recibido);
        $("#perdida_x").html(data.perdida_x);
        $("#producto_id").val(data.almacen.producto.id);

        $("#disponibles").empty();
        $("#resultados").empty();

        for (let t = 0; t < data.detalle.length; t++) {
            var fila =  "<tr>"+
            '<tr id="fila">'+
            "<td><input type='hidden' name='a[]' id='a[]' value="+data.detalle[t].a+">"+data.detalle[t].a+"</td>"+
            "<td><input type='hidden' name='b[]' id='b[]' value="+data.detalle[t].b+">"+data.detalle[t].b+"</td>"+
            "<td><input type='hidden' name='c[]' id='c[]' value="+data.detalle[t].c+">"+data.detalle[t].c+"</td>"+
            "<td><input type='hidden' name='d[]' id='d[]' value="+data.detalle[t].d+">"+data.detalle[t].d+"</td>"+
            "<td><input type='hidden' name='e[]' id='e[]' value="+data.detalle[t].e+">"+data.detalle[t].e+"</td>"+
            "<td><input type='hidden' name='f[]' id='f[]' value="+data.detalle[t].f+">"+data.detalle[t].f+"</td>"+
            "<td><input type='hidden' name='g[]' id='g[]' value="+data.detalle[t].g+">"+data.detalle[t].g+"</td>"+
            "<td><input type='hidden' name='h[]' id='h[]' value="+data.detalle[t].h+">"+data.detalle[t].h+"</td>"+
            "<td><input type='hidden' name='i[]' id='i[]' value="+data.detalle[t].i+">"+data.detalle[t].i+"</td>"+
            "<td><input type='hidden' name='j[]' id='j[]' value="+data.detalle[t].j+">"+data.detalle[t].j+"</td>"+
            "<td><input type='hidden' name='k[]' id='k[]' value="+data.detalle[t].k+">"+data.detalle[t].k+"</td>"+
            "<td><input type='hidden' name='l[]' id='l[]' value="+data.detalle[t].l+">"+data.detalle[t].l+"</td>"+
            "<td><input type='hidden' id='total_talla[]' name='total_talla[]' value="+data.detalle[t].total+">"+data.detalle[t].total+"</td>"+
            "</tr>";
            $("#disponibles").append(fila);
        }

        var resultados =  "<tr>"+
            '<tr id="fila">'+
            "<td><input type='hidden' name='a[]' id='a[]' value="+data.a_alm+">"+data.a_alm+"</td>"+
            "<td><input type='hidden' name='b[]' id='b[]' value="+data.b_alm+">"+data.b_alm+"</td>"+
            "<td><input type='hidden' name='c[]' id='c[]' value="+data.c_alm+">"+data.c_alm+"</td>"+
            "<td><input type='hidden' name='d[]' id='d[]' value="+data.d_alm+">"+data.d_alm+"</td>"+
            "<td><input type='hidden' name='e[]' id='e[]' value="+data.e_alm+">"+data.e_alm+"</td>"+
            "<td><input type='hidden' name='f[]' id='f[]' value="+data.f_alm+">"+data.f_alm+"</td>"+
            "<td><input type='hidden' name='g[]' id='g[]' value="+data.g_alm+">"+data.g_alm+"</td>"+
            "<td><input type='hidden' name='h[]' id='h[]' value="+data.h_alm+">"+data.h_alm+"</td>"+
            "<td><input type='hidden' name='i[]' id='i[]' value="+data.i_alm+">"+data.i_alm+"</td>"+
            "<td><input type='hidden' name='j[]' id='j[]' value="+data.j_alm+">"+data.j_alm+"</td>"+
            "<td><input type='hidden' name='k[]' id='k[]' value="+data.k_alm+">"+data.k_alm+"</td>"+
            "<td><input type='hidden' name='l[]' id='l[]' value="+data.l_alm+">"+data.l_alm+"</td>"+
            "<td><input type='hidden' id='total_talla[]' name='total_talla[]' value="+data.total_alm+">"+data.total_alm+"</td>"+
            "</tr>";
            $("#resultados").append(resultados);


        if (genero == "2") {
            if (mujer_plus == 7) {
                $("#ta").html("12W");
                $("#tb").html("14W");
                $("#tc").html("16W");
                $("#td").html("18W");
                $("#te").html("20W");
                $("#tf").html("22W");
                $("#tg").html("24W");
                $("#th").html("26W");
                $("#sa").html("12W");
                $("#sb").html("14W");
                $("#sc").html("16W");
                $("#sd").html("18W");
                $("#se").html("20W");
                $("#sf").html("22W");
                $("#sg").html("24W");
                $("#sh").html("26W");
                $("#ba").html("12W");
                $("#bb").html("14W");
                $("#bc").html("16W");
                $("#bd").html("18W");
                $("#be").html("20W");
                $("#bf").html("22W");
                $("#bg").html("24W");
                $("#bh").html("26W");
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
                $("#sa").html("0/0");
                $("#sb").html("1/2");
                $("#sc").html("3/4");
                $("#sd").html("5/6");
                $("#se").html("7/8");
                $("#sf").html("9/10");
                $("#sg").html("11/12");
                $("#sh").html("13/14");
                $("#si").html("15/16");
                $("#sj").html("17/18");
                $("#sk").html("19/20");
                $("#sl").html("21/22");
                $("#ba").html("0/0");
                $("#bb").html("1/2");
                $("#bc").html("3/4");
                $("#bd").html("5/6");
                $("#be").html("7/8");
                $("#bf").html("9/10");
                $("#bg").html("11/12");
                $("#bh").html("13/14");
                $("#bi").html("15/16");
                $("#bj").html("17/18");
                $("#bk").html("19/20");
                $("#bl").html("21/22");

            }
        }
        if (genero == "3") {
            $("#genero").val("Niño: " + val);
            $("#sub-genero").hide();
            $("#ta").html("2");
            $("#tb").html("4");
            $("#tc").html("6");
            $("#td").html("8");
            $("#te").html("10");
            $("#tf").html("12");
            $("#tg").html("14");
            $("#th").html("16");
            $("#sa").html("2");
            $("#sb").html("4");
            $("#sc").html("6");
            $("#sd").html("8");
            $("#se").html("10");
            $("#sf").html("12");
            $("#sg").html("14");
            $("#sh").html("16");
            $("#ba").html("2");
            $("#bb").html("4");
            $("#bc").html("6");
            $("#bd").html("8");
            $("#be").html("10");
            $("#bf").html("12");
            $("#bg").html("14");
            $("#bh").html("16");
        } else if (genero == "4") {
            // $("#genero").val("Niña: " + val);
            $("#sub-genero").hide();
            $("#ta").html("2");
            $("#tb").html("4");
            $("#tc").html("6");
            $("#td").html("8");
            $("#te").html("10");
            $("#tf").html("12");
            $("#tg").html("14");
            $("#th").html("16");
            $("#sa").html("2");
            $("#sb").html("4");
            $("#sc").html("6");
            $("#sd").html("8");
            $("#se").html("10");
            $("#sf").html("12");
            $("#sg").html("14");
            $("#sh").html("16");
            $("#ba").html("2");
            $("#bb").html("4");
            $("#bc").html("6");
            $("#bd").html("8");
            $("#be").html("10");
            $("#bf").html("12");
            $("#bg").html("14");
            $("#bh").html("16");
        } else if (genero == "1") {
            // $("#genero").val("Hombre: " + val);
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
            $("#sa").html("28");
            $("#sb").html("29");
            $("#sc").html("30");
            $("#sd").html("32");
            $("#se").html("34");
            $("#sf").html("36");
            $("#sg").html("38");
            $("#sh").html("40");
            $("#si").html("42");
            $("#sj").html("44");
            $("#ba").html("28");
            $("#bb").html("29");
            $("#bc").html("30");
            $("#bd").html("32");
            $("#be").html("34");
            $("#bf").html("36");
            $("#bg").html("38");
            $("#bh").html("40")
            $("#bi").html("42")
            $("#bj").html("44")

        }
    });
}

function eliminar(id_almacen){
    Swal.fire({
        title: '¿Esta seguro de eliminar este corte de almacen?',
        text: "Va a eliminar las entradas a almacen!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("almacen/delete/" + id_almacen, function(){
                Swal.fire(
                    'Eliminado!',
                    'Entrada a almacen eliminado correctamente.',
                    'success'
                    )
                $("#almacenes").DataTable().ajax.reload();
            })
        }
      })

}

