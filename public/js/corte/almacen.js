$(document).ready(function() {
    $("[data-mask]").inputmask();
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
    var genero_global;
    var genero_plus_global;

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
    }

    function limpiar() {
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
            url: "almacen",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(almacen),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert(
                        "Se registro correctamenete el corte en almacen"
                    );
                    console.log(datos);
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
                {
                    data: "referencia_producto",
                    name: "producto.referencia_producto"
                },
                { data: "totalCorte", name: "corte.total" },
                { data: "total", name: "almacen.total" }
            ],
            order: [[2, "asc"]],
            rowGroup: {
                dataSrc: "name"
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
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
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
                                total_recibido = datos.total_recibido - datos.perdidas;
                                
                                
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
                        var subGenero = $("#sub-genero").val();

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
                                    "<th>26W</th>"
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
                            // $("#i").attr("disabled", false);
                            // $("#j").attr("disabled", false);
                            // $("#k").attr("disabled", false);
                            // $("#l").attr("disabled", false);
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
                        $("#i").attr("disabled", true);
                        $("#j").attr("disabled", true);
                        $("#k").attr("disabled", true);
                        $("#l").attr("disabled", true);
                        $("#tallas").html(
                            "<th>Niño</th>" +
                                "<th>2</th>" +
                                "<th>4</th>" +
                                "<th>6</th>" +
                                "<th>8</th>" +
                                "<th>10</th>" +
                                "<th>12</th>" +
                                "<th>14</th>" +
                                "<th>16</th>"
                        );
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
                        $("#i").attr("disabled", true);
                        $("#j").attr("disabled", true);
                        $("#k").attr("disabled", true);
                        $("#l").attr("disabled", true);
                        $("#tallas").html(
                            "<th>Niña</th>" +
                                "<th>2</th>" +
                                "<th>4</th>" +
                                "<th>6</th>" +
                                "<th>8</th>" +
                                "<th>10</th>" +
                                "<th>12</th>" +
                                "<th>14</th>" +
                                "<th>16</th>"
                        );
                    } else if (genero == "1") {
                        $("#genero").val("Hombre: " + val);
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
                        $("#i").attr("disabled", false);
                        $("#j").attr("disabled", false);
                        $("#k").attr("disabled", true);
                        $("#l").attr("disabled", true);
                        $("#tallas").html(
                            "<th>Caballero Skinny</th>" +
                                "<th>28</th>" +
                                "<th>29</th>" +
                                "<th>30</th>" +
                                "<th>32</th>" +
                                "<th>34</th>" +
                                "<th>36</th>" +
                                "<th>38</th>" +
                                "<th>40</th>" +
                                "<th>42</th>" +
                                "<th>44</th>"
                        );
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

    //funcion que validar si el total de tallas es mayor a la cantidad recibida en recepcion
    $("#btn-close").click(function(e){
        e.preventDefault();

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
                        console.log(c);
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
                            }
                        }else if(genero_global == 1){
                            if(a > a_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 28 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(b > b_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 30 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(c > c_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 32 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }
                            else if(d > d_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 34 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(e > e_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 36 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(f > f_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 38 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(g > g_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 40 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(h > h_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 42 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }else if(i > i_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 44 a la cantidad total del corte y las perdidas"+
                               "</div>")
                            }
                        }   

                       
                       

                        if(total > total_recibido){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> La cantidad total de tallas no puede ser mayor a la cantidad recibida de lavanderia"+
                           "</div>")
                           $("#btn-guardar").hide();
                        }else{
                            $("#btn-guardar").show();
                        }
                        
                        
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
        mostrarForm(false);
    });

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
                    bootbox.alert("Imagenes subidas correctamente!!");
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

    init();
});
