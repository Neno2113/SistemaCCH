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

    $("#formulario").validate({
        rules: {
            cortesSearch: {
                required: true,
                minlength: 1
            },
            lavanderias: {
                required: true,
                minlength: 1
            },
            fecha_recepcion: {
                required: true,
                minlength: 1
            },
            cantidad_recibida: {
                required: true,
                minlength: 2
            }
        },
        messages: {
            codigo_composicion: {
                required: "El numero de corte es obligatorio"
            },
            nombre_composicion: {
                required: "La lavanderia es obligatoria"
            },
            fecha_recepcion: {
                required: "La fecha de recepcion es obligatoria"
            },
            cantidad_recibida: {
                required: "La cantidad recibida es un campo obligatorio",
                minlength:
                    "La cantidad recibida es un campo numerico obligatorio"
            }
        }
    });

    var tabla;

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

  
    $("#fase").change(function() {
        var val = $(this).val();
        if (val == "Produccion") {
            $("#motivo").html(
                "<option value='Error del operador'>1. Error del operador</option>" +
                    "<option value='Fallo de la maquina'>2. Fallo de la maquina</option>" +
                    "<option value='Defecto de tela'>3. Defecto de tela</option>" +
                    "<option value='Fallo en Dpto.corte'>4. Fallo en Dpto.corte</option>" +
                    "<option value='Extraviado'>5. Extraviado</option>"
            );
        } else if (val == "Procesos secos") {
            $("#motivo").html(
                "<option value='Error del operador'>1. Error del operador</option>" +
                    "<option value='Extraviado'>2. Extraviado</option>"
            );
        } else if (val == "Lavanderia") {
            $("#motivo").html(
                "<option value='Rotos'>1. Rotos</option>" +
                    "<option value='Manchados'>2. Manchados</option>" +
                    "<option value='Extraviado'>3. Extraviado</option>"
            );
        } else if (val == "Terminacion") {
            $("#motivo").html(
                "<option value='Error del operador'>1. Error del operador</option>" +
                    "<option value='Fallo de la maquina'>2. Fallo de la maquina</option>" +
                    "<option value='Defecto de tela'>3. Defecto de tela</option>" +
                    "<option value='Fallo en Dpto. corte'>4. Fallo en Dpto. corte</option>" +
                    "<option value='Extraviado'>5. Extraviado </option>"+
                    "<option value='Extraviado'>6. Error de lavanderia </option>"
            );
        } else if (val == "Almacen") {
            $("#motivo").html(
                "<option value='Extraviado'>1. Extraviado</option>" +
                    "<option value='Termita'>2. Termita</option>" +
                    "<option value='Reaccion luz'>3. Reaccion a la luz</option>"
            );
        } else if (val == "") {
            $("#motivo").html("<option value=''> </option>");
        }
    });

    $("#cortesSearch").change(function() {
        let val = $("#cortesSearch option:selected").text();
        // console.log(val);

        let genero = val.substring(24, 25); 
        let genero_plus = val.substr(26, 1);
        let fase = val.substring(9, 12);
        // console.log("Genero:"+genero);
        // console.log("Fase:"+fase);
        // console.log("genero_plus: "+genero_plus);
        
        if(fase == 'Alm'){
            $("#fase").val('Almacen')
            $("#motivo").html(
                "<option disabled><strong>Almacen</strong></option>"+
                "<option value='Extraviado'>1. Extraviado</option>" +
                "<option value='Termita'>2. Termita</option>" +
                "<option value='Reaccion luz'>3. Reaccion a la luz</option>"
            );
        }else if(fase == 'Lav'){
            $("#fase").val('Lavanderia')
            $("#motivo").html(
                "<option disabled><strong>Lavanderia</strong></option>"+
                "<option value='Rotos'>1. Rotos</option>" +
                "<option value='Manchados'>2. Manchados</option>" +
                "<option value='Extraviado'>3. Extraviado</option>"
            );
            
        }else if(fase == 'Pro'){
            $("#fase").val('Produccion')
            $("#motivo").html(
                "<div class='dropdown-menu'>"+
                "<option disabled><strong>Produccion</strong></option>"+
                "<option   class='dropdown-item'  value='Error del operador'>1. Error del operador</option>" +
                    "<option class='dropdown-item'  value='Fallo de la maquina'>2. Fallo de la maquina</option>" +
                    "<option class='dropdown-item' value='Defecto de tela'>3. Defecto de tela</option>" +
                    "<option class='dropdown-item' value='Fallo en Dpto.corte'>4. Fallo en Dpto.corte</option>" +
                    "<option class='dropdown-item' value='Extraviado'>5. Extraviado</option>"+
                     "<option  disabled>_______________________________________________________</option>"+
                     "<option disabled><strong>Procesos Secos</strong></option>"+
                    "<option class='dropdown-item' value='Error del operador'>1. Error del operador</option>" +
                    "<option class='dropdown-item' value='Extraviado'>2. Extraviado</option>"+
                "</div>"
            );
        }else if(fase == 'Ter'){
            $("#fase").val('Terminacion')
            $("#motivo").html(
                "<option disabled><strong>Terminacion</strong></option>"+
                "<option value='Error del operador'>1. Error del operador</option>" +
                "<option value='Fallo de la maquina'>2. Fallo de la maquina</option>" +
                "<option value='Defecto de tela'>3. Defecto de tela</option>" +
                "<option value='Fallo en Dpto. corte'>4. Fallo en Dpto. corte</option>" +
                "<option value='Extraviado'>5. Extraviado </option>"
            );
        }
    
        if (genero == "2") {
            $("#genero").val('Mujer: '+val);

                if(genero_plus == "7"){
                   $("#genero").val('Mujer plus: '+val);
                   $("#sa").html("12W");
                   $("#sb").html("14W");
                   $("#sc").html("16W");
                   $("#sd").html("18W");
                   $("#se").html("20W");
                   $("#sf").html("22W");
                   $("#sg").html("24W");
                   $("#sh").html("26W");
                   $("#ta").html("12W");
                   $("#tb").html("14W");
                   $("#tc").html("16W");
                   $("#td").html("18W");
                   $("#te").html("20W");
                   $("#tf").html("22W");
                   $("#tg").html("24W");
                   $("#th").html("26W");
                 
                   $("#i").attr('disabled', true);
                   $("#j").attr('disabled', true);
                   $("#k").attr('disabled', true);
                   $("#l").attr('disabled', true);
                   $("#tallas").html(
                       "<th>Dama Plus</th>"+
                       "<th>12W</th>"+
                       "<th>14W</th>"+
                       "<th>16W</th>"+
                       "<th>18W</th>"+
                       "<th>20W</th>"+
                       "<th>22W</th>"+
                       "<th>24W</th>"+
                       "<th>26W</th>"
                   );
               }else{
                $("#genero").val('Mujer: '+val)
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
                $("#i").attr('disabled', false);
                $("#j").attr('disabled', false);
                $("#k").attr('disabled', false);
                $("#l").attr('disabled', false);
                $("#tallas").html(
                    "<th>Dama TA</th>"+
                    "<th>0/0</th>"+
                    "<th>1/2</th>"+
                    "<th>3/4</th>"+
                    "<th>5/6</th>"+
                    "<th>7/8</th>"+
                    "<th>9/10</th>"+
                    "<th>11/12</th>"+
                    "<th>13/14</th>"+
                    "<th>15/16</th>"+
                    "<th>17/18</th>"+
                    "<th>19/20</th>"+
                    "<th>21/22</th>"
            );
               }
        }
        
        if (genero == "3") {
            $("#genero").val('Niño: '+val);
            $("#sub-genero").hide();
            $("#sa").html("2");
            $("#sb").html("4");
            $("#sc").html("6");
            $("#sd").html("8");
            $("#se").html("10");
            $("#sf").html("12");
            $("#sg").html("14");
            $("#sh").html("16");
            $("#ta").html("2");
            $("#tb").html("4");
            $("#tc").html("6");
            $("#td").html("8");
            $("#te").html("10");
            $("#tf").html("12");
            $("#tg").html("14");
            $("#th").html("16");
            $("#i").attr('disabled', true);
            $("#j").attr('disabled', true);
            $("#k").attr('disabled', true);
            $("#l").attr('disabled', true);
            $("#tallas").html(
                            "<th>Niño</th>"+
                            "<th>2</th>"+
                            "<th>4</th>"+
                            "<th>6</th>"+
                            "<th>8</th>"+
                            "<th>10</th>"+
                            "<th>12</th>"+
                            "<th>14</th>"+
                            "<th>16</th>"
            );
        } else if (genero == "4") {
            $("#genero").val('Niña: '+val);
            $("#sub-genero").hide();
            $("#sa").html("2");
            $("#sb").html("4");
            $("#sc").html("6");
            $("#sd").html("8");
            $("#se").html("10");
            $("#sf").html("12");
            $("#sg").html("14");
            $("#sh").html("16");
            $("#ta").html("2");
            $("#tb").html("4");
            $("#tc").html("6");
            $("#td").html("8");
            $("#te").html("10");
            $("#tf").html("12");
            $("#tg").html("14");
            $("#th").html("16");
            $("#i").attr('disabled', true);
            $("#j").attr('disabled', true);
            $("#k").attr('disabled', true);
            $("#l").attr('disabled', true);
            $("#tallas").html(
                "<th>Niña</th>"+
                "<th>2</th>"+
                "<th>4</th>"+
                "<th>6</th>"+
                "<th>8</th>"+
                "<th>10</th>"+
                "<th>12</th>"+
                "<th>14</th>"+
                "<th>16</th>"
            );
        } else if (genero == "1") {
            $("#genero").val('Hombre: '+val);
            $("#sub-genero").hide();
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
            $("#i").attr('disabled', false);
            $("#j").attr('disabled', false);
            $("#k").attr('disabled', true);
            $("#l").attr('disabled', true);
            $("#tallas").html(
                "<th>Caballero Skinny</th>"+
                "<th>28</th>"+
                "<th>29</th>"+
                "<th>30</th>"+
                "<th>32</th>"+
                "<th>34</th>"+
                "<th>36</th>"+
                "<th>38</th>"+
                "<th>40</th>"+
                "<th>42</th>"+
                "<th>44</th>"
            );
        } else if (val == "") {
            $("#motivo").html("<option value=''> </option>");
        }
    });




    // $("#a").on("keyup", function() {
    //     $("#btn-guardar").attr("disabled", false);
    // });

    function limpiar() {
        $("#fase").val("");
        $("#motivo").val("");
        $("#cortesSearch").val("").trigger("change");
        $("#productos").val("").trigger("change");
        $("#no_perdida").val("");
        $("#sec").val("");
        $("#sec_segunda").val("");
        $("#tipo_perdida").val("");
        $("#fecha").val("");
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
            url: "cortes_perd",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.numero_corte + " - " + item.fase + " - "+ item.referencia_producto,
                            id: item.id
                        };
                    })
                };
            },
            cache: true
        }
    });

    $("#productos").select2({
        placeholder: "Busca una referencia de producto...",
        ajax: {
            url: 'products',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.referencia_producto,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })

    $("#cortesSearch").on("change", function(){
        var corte = {
            corte_id: $("#cortesSearch").val(),
        };

        $.ajax({
            url: "perdida/verificar",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    let fecha = datos.corte;
                    let dia = fecha.substr(0, 2);
                    let month = fecha.substr(3, 2);
                    let year = fecha.substr(6, 4);

                    $("#fecha").attr('min', year +"-"+ month+"-"+dia);

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
                  
               
            
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function() {
                // bootbox.alert(
                //     "Ocurrio un error"
                // );
            }
        });
    })




    //funcion para generar codigo de perdida o segunda
    $("#btn-generar").on("click", function(e) {
        e.preventDefault();

            $.ajax({
                url: "perdida/lastdigit",
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

                        var tipo_perdida = $("#tipo_perdida").val()
                
                        if(tipo_perdida == 'Segundas'){
                            var referencia = "SE-" + i;
                        }else if(tipo_perdida = 'Normal'){
                            var referencia = "PE-" + i;
                        }
                      

                        $("#no_perdida").val(referencia);
                        $("#fila1").show();
                        $("#fila2").show();
                        $("#fila3").show();
                        $("#btn-guardar").attr("disabled", false);
                        bootbox.alert(
                            "Numero de perdida generado exitosamente!!"
                        );
                    } else {
                        bootbox.alert("Ocurrio un error !!");
                    }
                },
                error: function() {
                    bootbox.alert("Ocurrio un error!!");
                }
            });
       
           
    });

    $("#tipo_perdida").on("change", function(){
        $("#btn-generar").attr("disabled", false);
    })

    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var perdida = {
            corte: $("#cortesSearch").val(),
            fecha: $("#fecha").val(),
            tipo_perdida: $("#tipo_perdida").val(),
            fase: $("#fase").val(),
            motivo: $("#motivo").val(),
            no_perdida: $("#no_perdida").val(),
            sec: $("#sec").val(),
            // producto_id: $("#productos").val(),
        };

        $.ajax({
            url: "perdida",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(perdida),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                
                    bootbox.alert(
                        "Se registro correctamente la perdida: "+ datos.perdida.no_perdida
                    );
                    // limpiar();
                   
                    var talla = {
                        perdida_id: datos.perdida.id,
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
                        talla_x: $("#talla_x").val()
                    };

                    $.ajax({
                        url: "perdida_tallas",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(talla),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                                
                                tabla.ajax.reload();
                                mostrarForm(false);
                                limpiar();
            
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
                        message:"<h4 class='invalid-feedback d-block'>"+val+"</h4>",
                        size: 'small'
                    });
                });  
            }
        });
    });

    function listar() {
        tabla = $("#perdida_listada").DataTable({
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
            ajax: "api/perdidas",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_perdida", name: "perdidas.no_perdida" },
                { data: "tipo_perdida", name: "perdidas.tipo_perdida" },
                { data: "fecha",name: "perdidas.fecha"},
                { data: "numero_corte", name: "corte.numero_corte" },
                { data: "referencia_producto", name: "producto.referencia_producto" },
                { data: "fase", name: "perdidas.fase" },
                { data: "motivo", name: "perdidas.motivo" }
            ],
            order: [[5, 'desc']],
            rowGroup: {
                dataSrc: 'numero_corte'
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var perdida = {
            id: $("#id").val(),
            corte: $("#cortesSearch").val(),
            fecha: $("#fecha").val(),
            tipo_perdida: $("#tipo_perdida").val(),
            fase: $("#fase").val(),
            motivo: $("#motivo").val(),
            no_perdida: $("#no_perdida").val(),
            producto_id: $("#productos").val(),
            perdida_x: $("#talla_x").val()
        };

        $.ajax({
            url: "perdida/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(perdida),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizo correctamente la perdida");
                  
                    var talla = {
                        perdida_id: datos.perdida.id,
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

                    console.log(JSON.stringify(talla));

                    $.ajax({
                        url: "talla_perdidas/edit",
                        type: "PUT",
                        dataType: "json",
                        data: JSON.stringify(talla),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                                bootbox.alert("Tallas actualizadas correctamente!!")
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
                            console.log(datos.responseJSON.message);
            
                            bootbox.alert("Error: " + datos.responseJSON.message);
                        }
                    });


                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function(datos) {
                bootbox.alert("Error: " + datos.responseJSON.message);
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
            $("#estandar_recibido").hide();
            $("#lavanderia").hide();
            $("#corte").hide();
            $("#corteAdd").show();
            $("#corteEdit").hide();
            $("#lavanderiaAdd").show();
            $("#lavanderiaEdit").hide();
            $("#referencia_producto").hide();
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#estandar_recibido").hide();
            $("#lavanderia").hide();
            $("#corte").hide();
            $("#corteEdit").hide();
            $("#lavanderiaEdit").hide();
            $("#btn-guardar").attr("disabled", true);
            $("#referencia_producto").hide();
            $("#btn-generar").show();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#fila1").hide();
            $("#fila2").hide();
            $("#fila3").hide();
            $("#btn-generar").attr("disabled", true);
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

    init();
});
