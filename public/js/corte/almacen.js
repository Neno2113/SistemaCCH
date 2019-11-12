$(document).ready(function() {
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

    $("#tono").change(function() {
        var corte = {
            id: $("#cortesSearch").val(),
            idEdit: $("#cortesSearchEdit").val()
        };

        let corte_id = $("#cortesSearch").val() 
        let corte_id_edit = $("#cortesSearchEdit").val();
        console.log(corte_id_edit);
        console.log(corte_id)

        $("#corte_id").val(corte_id);
        $("#corte_id_edit").val(corte_id_edit);
        // console.log(JSON.stringify(corte));
        $.ajax({
            url: "almacen/producto",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    let val = datos.referencia;
                    let genero = val.substring(1, 2);

                    if (genero == "2") {
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
                            }
                        });
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

    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var almacen = {
            corte_id: $("#cortesSearch").val(),
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
                    bootbox.alert("Se registro correctamenete el corte en almacen");
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
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    function listar() {
        tabla = $("#almacenes").DataTable({
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
            corte_id: $("#cortesSearchEdit").val(),
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
            // $("#frente").hide();
            // $("#trasera").hide();
            // $("#perfil").hide();
            // $("#bolsillo").hide();
        }
    }

    $("#btnAgregar").click(function(e) {
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        mostrarForm(false);
    });

    $("#formUpload").submit(function(e){
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "almacen/imagen",
            type: "POST",
            data: formData,
            dataType:'JSON',
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
            error: function() {
                bootbox.alert("Ocurrio un error");
            }
        });
        
    });

    init();
});
