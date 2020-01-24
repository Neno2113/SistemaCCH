$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#formulario").validate({
        rules: {
            precio_lista: {
                required: true,
                minlength: 3
            },
            precio_publico: {
                required: true,
                minlength: 4
            },
            descripcion: {
                required: true,
                minlength: 5
            },
            telefono_1: {
                required: true,
                minlength: 10
            },
            email_principal: {
                required: true,
                email: true
            },
            condiciones_credito: {
                required: true,
                minlengh: 1
            },
            rnc: {
                required: true,
                digits: true,
                minlengh: 9
            }
        },
        messages: {
            precio_lista: {
                required: "Este campo es obligatorio",
                minlength: "Este campo debe contener al menos 3 numeros"
            },
            direccion_principal: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 4 letras"
            },
            descripcion: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 5 letras"
            },
            telefono_1: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 10 caracteres"
            },
            email_principal: {
                required: "El email es obligatorio",
                email: "Debe itroducir un email valido"
            },
            condiciones_credito: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 1 caracter"
            },
            rnc: {
                required: "Este campo es obligatorio",
                minlengh: "Debe contener al menos 9 numeros",
                digits: "Este campo solo puedo contener numeros"
            }
        }
    });

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

    function limpiar() {
        $("#marca").val("");
        $("#genero").val("");
        $("#tipo_producto").val("");
        $("#categoria").val("");
        $("#sec").val("");
        $("#referencia").val("");
        $("#descripcion").val("");
        $("#precio_lista").val("");
        $("#precio_venta_publico").val("");
        $("#descripcion_2").val("");
        $("#precio_lista_2").val("");
        $("#precio_venta_publico_2").val("");
    }

    $("#btnGenerar").on("click", function(e) {
        e.preventDefault();

        let sec_manual = $("#sec_manual").val();

        var i = Number(sec_manual) / 100;
        var e = Number(sec_manual) / 100;
        i = (i).toFixed(2).split(".").join("");
        i = i.substr(1, 4);
     
        var marca = $("#marca").val();
        var genero = $("#genero").val();
        var tipo_producto = $("#tipo_producto").val();
        var categoria = $("#categoria").val();
        var year = new Date().getFullYear().toString().substr(-2);
        var referencia = marca + genero + tipo_producto + categoria + "-" + year + i;
        $("#btn-sku").attr("disabled", false);

        if (genero == 3 || genero == 4) {
            $("#mostrarRef2").show();
            $("#precios_2").show();
            $("#descripcion_ref2").show();
          
            e = (e + 1).toFixed(1).split(".").join("");
            e = e.substr(1, 4);
            $("#referencia_2").val(
                marca + genero + tipo_producto + categoria + "-" + year + e
            );
        } else {
            $("#mostrarRef2").hide();
            $("#precios_2").hide();
            $("#descripcion_ref2").hide();
            $("#referencia_2").val("");
            $("#descripcion_2").val("");
            $("#precio_lista_2").val("");
            $("#precio_venta_publico_2").val("");
        }

        $("#referencia").val(referencia);

        bootbox.alert("Referencia de producto generada exitosamente!!");

        var referencias = {
            referencia: $("#referencia").val(),
            referencia_2: $("#referencia_2").val(),
            sec: $("#sec").val()
        };

        $.ajax({
            url: "product_ref",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(referencias),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#id_producto").val(datos.producto.id);
                    let genero = referencia.substr(1, 1);
                    let genero_plus = referencia.substr(3, 1);

                    if (genero == "3") {
                        $("#referencia_talla").val("Niño: " + referencia);
                        $("#btn-asignar2").html("2");
                        $("#btn-asignar3").html("4");
                        $("#btn-asignar4").html("6");
                        $("#btn-asignar5").html("8");
                        $("#btn-asignar6").html("10");
                        $("#btn-asignar7").html("12");
                        $("#btn-asignar8").html("14");
                        $("#btn-asignar9").html("16");
                        $("#btn-asignar10").attr("disabled", true);
                        $("#btn-asignar11").attr("disabled", true);
                        $("#btn-asignar12").attr("disabled", true);
                        $("#btn-asignar13").attr("disabled", true);
                        $("#ta").html("2");
                        $("#tb").html("4");
                        $("#tc").html("6");
                        $("#td").html("8");
                        $("#te").html("10");
                        $("#tf").html("12");
                        $("#tg").html("14");
                        $("#th").html("16");
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
                        $("#referencia_talla").val("Niña: " + referencia);
                        $("#btn-asignar2").html("2");
                        $("#btn-asignar3").html("4");
                        $("#btn-asignar4").html("6");
                        $("#btn-asignar5").html("8");
                        $("#btn-asignar6").html("10");
                        $("#btn-asignar7").html("12");
                        $("#btn-asignar8").html("14");
                        $("#btn-asignar9").html("16");
                        $("#btn-asignar10").attr("disabled", true);
                        $("#btn-asignar11").attr("disabled", true);
                        $("#btn-asignar12").attr("disabled", true);
                        $("#btn-asignar13").attr("disabled", true);
                        $("#ta").html("2");
                        $("#tb").html("4");
                        $("#tc").html("6");
                        $("#td").html("8");
                        $("#te").html("10");
                        $("#tf").html("12");
                        $("#tg").html("14");
                        $("#th").html("16");
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
                        $("#referencia_talla").val("Hombre: " + referencia);
                        $("#btn-asignar2").html("28");
                        $("#btn-asignar3").html("29");
                        $("#btn-asignar4").html("30");
                        $("#btn-asignar5").html("32");
                        $("#btn-asignar6").html("34");
                        $("#btn-asignar7").html("36");
                        $("#btn-asignar8").html("38");
                        $("#btn-asignar9").html("40");
                        $("#btn-asignar10").html("42");
                        $("#btn-asignar11").html("44");
                        $("#btn-asignar12").attr("disabled", true);
                        $("#btn-asignar13").attr("disabled", true);
                        $("#k").attr("disabled", true);
                        $("#l").attr("disabled", true);
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
                    } else if (genero == "2") {
                        if (genero_plus == "7") {
                            $("#referencia_talla").val(
                                "Mujer Plus: " + referencia
                            );
                            $("#sub-genero").show();
                            $("#btn-asignar2").html("12W");
                            $("#btn-asignar3").html("14W");
                            $("#btn-asignar4").html("16W");
                            $("#btn-asignar5").html("18W");
                            $("#btn-asignar6").html("20W");
                            $("#btn-asignar7").html("22W");
                            $("#btn-asignar8").html("24W");
                            $("#btn-asignar9").html("26W");
                            $("#btn-asignar10").attr("disabled", true);
                            $("#btn-asignar11").attr("disabled", true);
                            $("#btn-asignar12").attr("disabled", true);
                            $("#btn-asignar13").attr("disabled", true);
                            $("#ta").html("12W");
                            $("#tb").html("14W");
                            $("#tc").html("16W");
                            $("#td").html("18W");
                            $("#te").html("20W");
                            $("#tf").html("22W");
                            $("#tg").html("24W");
                            $("#th").html("26W");
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
                            $("#referencia_talla").val("Mujer: " + referencia);
                            $("#btn-asignar2").html("0/0");
                            $("#btn-asignar3").html("1/2");
                            $("#btn-asignar4").html("3/4");
                            $("#btn-asignar5").html("5/6");
                            $("#btn-asignar6").html("7/8");
                            $("#btn-asignar7").html("9/10");
                            $("#btn-asignar8").html("11/12");
                            $("#btn-asignar9").html("13/14");
                            $("#btn-asignar10").html("15/16");
                            $("#btn-asignar11").html("17/18");
                            $("#btn-asignar12").html("19/20");
                            $("#btn-asignar13").html("21/22");
                            $("#btn-asignar2").attr("disabled", false);
                            $("#btn-asignar2").attr("disabled", false);
                            $("#btn-asignar2").attr("disabled", false);
                            $("#btn-asignar2").attr("disabled", false);
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

                    var referencias = {
                        referencia: $("#id_producto").val()
                    };

                    $.ajax({
                        url: "producto/validarSku",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(referencias),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                                let a = $("#btn-asignar").val();
                                let b = $("#btn-asignar").val();  
                                let c = $("#btn-asignar").val();  
                                let d = $("#btn-asignar").val();  
                                let e = $("#btn-asignar").val();  
                                let f = $("#btn-asignar").val();  
                                let g = $("#btn-asignar").val();  
                                let h = $("#btn-asignar").val();  
                                let i = $("#btn-asignar").val();  
                                let j = $("#btn-asignar").val();  
                                let k = $("#btn-asignar").val();  
                                let l = $("#btn-asignar").val();  
                                   
                                // for (let i = 0; i < datos.sku.length; i++) {
                                //     console.log($("#btn-asignar"+[i]))
                                //     if(datos.sku[i].talla == $("#btn-asignar"+[i])){
                                //         console.log("HI"[i]);
                                //     }
                                    
                                // }


                            } else {
                                bootbox.alert("Se genero la referencia");
                            }
                        },
                        error: function() {
                           ;
                        }
                    });


                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error, al crear el producto");
            }
        });
    });

    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var product = {
            id: $("#id_producto").val(),
            descripcion: $("#descripcion").val(),
            descripcion_2: $("#descripcion_2").val(),
            precio_lista_2: $("#precio_lista_2").val(),
            precio_lista: $("#precio_lista").val(),
            precio_venta_publico: $("#precio_venta_publico").val(),
            precio_venta_publico_2: $("#precio_venta_publico_2").val()
        };

        $.ajax({
            url: "product",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(product),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se genero la referencia!!");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                    $("#referencia_talla").val("");
                    $("#btn-asignar").attr("disabled", false);
                    $("#btn-asignar2").attr("disabled", false);
                    $("#btn-asignar3").attr("disabled", false);
                    $("#btn-asignar4").attr("disabled", false);
                    $("#btn-asignar5").attr("disabled", false);
                    $("#btn-asignar6").attr("disabled", false);
                    $("#btn-asignar7").attr("disabled", false);
                    $("#btn-asignar8").attr("disabled", false);
                    $("#btn-asignar9").attr("disabled", false);
                    $("#btn-asignar10").attr("disabled", false);
                    $("#btn-asignar11").attr("disabled", false);
                    $("#btn-asignar12").attr("disabled", false);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    var tabla;

    function listar() {
        tabla = $("#products").DataTable({
            serverSide: true,
            autoWidth: false,
            responsive: true,
            iDisplayLength: 5,
            ajax: "api/products",
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
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "name", name: "users.name" },
                {
                    data: "referencia_producto",
                    name: "producto.referencia_producto"
                },
                { data: "precio_lista", name: "producto.precio_lista" },
                {
                    data: "precio_venta_publico",
                    name: "producto.precio_venta_publico"
                },
                { data: "descripcion", name: "producto.descripcion" }
            ],
            order: [[2, "asc"]],
            rowGroup: {
                dataSrc: "name"
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var product = {
            id: $("#id").val(),
            referencia: $("#referencia").val(),
            descripcion: $("#descripcion").val(),
            referencia_2: $("#referencia_2").val(),
            precio_lista: $("#precio_lista").val(),
            precio_lista_2: $("#precio_lista_2").val(),
            precio_venta_publico_2: $("#precio_venta_publico_2").val(),
            precio_venta_publico: $("#precio_venta_publico").val(),
            sec: $("#sec").val()
        };

        // console.log(product);

        $.ajax({
            url: "product/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(product),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el usuario");
                    limpiar();
                    tabla.ajax.reload();
                    $("#id").val("");
                    $("#nombre_composicion").val("");
                    $("#listadoUsers").show();
                    $("#registroForm").hide();
                    $("#btnCancelar").hide();
                    $("#btn-edit").hide();
                    $("#btn-guardar").show();
                    $("#btnAgregar").show();
                    $("#sec").val("");
                } else {
                    bootbox.alert("Ocurrio un error durante la actualizacion");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
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
            $("#btnAgregar").show();
            $("#mostrarRef2").hide();
            $("#precios_2").hide();
            $("#descripcion_ref2").hide();
            $("#btn-sku").attr("disabled", true);
            $("#btn-edit").hide();
            $("#btn-guardar").show();
        }
    }

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        mostrarForm(false);
    });

    $("#btn-asignar").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#id_producto").val(),
            talla: $("#btn-asignar").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar").attr("disabled", true);
                } else {
                    bootbox.alert("Error");
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });
    });

    $("#btn-asignar2").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#id_producto").val(),
            talla: $("#btn-asignar2").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar2").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    $("#btn-asignar3").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#id_producto").val(),
            talla: $("#btn-asignar3").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar3").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    $("#btn-asignar4").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#id_producto").val(),
            talla: $("#btn-asignar4").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar4").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    $("#btn-asignar5").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#id_producto").val(),
            talla: $("#btn-asignar5").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar5").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    $("#btn-asignar6").click(function(e) {
        e.preventDefault();

        let gen = $("#genero").val();

        if (gen == 3 || gen == 4) {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar6").val(),
                referencia: $("#referencia_2").val()
            };
        } else {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar6").val(),
                referencia: $("#referencia").val()
            };
        }

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar6").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    $("#btn-asignar7").click(function(e) {
        e.preventDefault();

        let gen = $("#genero").val();

        if (gen == 3 || gen == 4) {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar7").val(),
                referencia: $("#referencia_2").val()
            };
        } else {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar7").val(),
                referencia: $("#referencia").val()
            };
        }

        // console.log(JSON.stringify(asignacion));
        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar7").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    $("#btn-asignar8").click(function(e) {
        e.preventDefault();

        let gen = $("#genero").val();

        if (gen == 3 || gen == 4) {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar8").val(),
                referencia: $("#referencia_2").val()
            };
        } else {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar8").val(),
                referencia: $("#referencia").val()
            };
        }

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar8").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    $("#btn-asignar9").click(function(e) {
        e.preventDefault();

        let gen = $("#genero").val();

        if (gen == 3 || gen == 4) {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar9").val(),
                referencia: $("#referencia_2").val()
            };
        } else {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar9").val(),
                referencia: $("#referencia").val()
            };
        }

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar9").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    $("#btn-asignar10").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#id_producto").val(),
            talla: $("#btn-asignar10").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar10").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });
    $("#btn-asignar11").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#id_producto").val(),
            talla: $("#btn-asignar11").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar11").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    $("#btn-asignar12").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#id_producto").val(),
            talla: $("#btn-asignar12").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar12").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    $("#btn-asignar13").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#id_producto").val(),
            talla: $("#btn-asignar13").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar13").attr("disabled", true);
                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    window.onresize = function() {
        tabla.columns.adjust().responsive.recalc();
    };

    init();
});
