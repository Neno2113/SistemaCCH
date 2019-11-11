$(document).ready(function() {
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
                    "<option value='Extraviado'>5. Extraviado </option>"
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

        let genero = val.substring(22,23); 
        let fase = val.substring(11, 14)
        
        if(fase == 'Alm'){
            $("#fase").val('Almacen')
        }else if(fase == 'Lav'){
            $("#fase").val('Lavanderia')
        }else if(fase == 'Pro'){
            $("#fase").val('Produccion')
            $("#motivo").html(
                "<div class='dropdown-menu'>"+
                "<option   class='dropdown-item'  value='Error del operador'>1. Error del operador</option>" +
                    "<option class='dropdown-item'  value='Fallo de la maquina'>2. Fallo de la maquina</option>" +
                    "<option class='dropdown-item' value='Defecto de tela'>3. Defecto de tela</option>" +
                    "<option class='dropdown-item' value='Fallo en Dpto.corte'>4. Fallo en Dpto.corte</option>" +
                    "<option class='dropdown-item' value='Extraviado'>5. Extraviado</option>"+
                    "<hr>"+
                    "<option class='dropdown-item' value='Error del operador'>1. Error del operador</option>" +
                    "<option class='dropdown-item' value='Extraviado'>2. Extraviado</option>"+
                "</div>"


            );
        }else if(fase == 'Ter'){
            $("#fase").val('Terminacion')
        }
    
        if (genero == "2") {
            $("#genero").val('Mujer: '+val);
            $("#sub-genero").show();
          
             $("#sub-genero").on('change', function(){
                var subGenero = $("#sub-genero").val();
             
                if(subGenero == "Mujer"){
                  
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
               }else if (subGenero == "Mujer Plus"){
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
               }
          
            
        });
    }
        
        if (genero == "3") {
            $("#genero").val('Niño: '+val);
            $("#sub-genero").hide();
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




    $("#a").on("keyup", function() {
        $("#btn-guardar").attr("disabled", false);
    });

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

    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var perdida = {
            corte_id: $("#cortesSearch").val(),
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
                console.log(datos.responseJSON.message);

                bootbox.alert("Error: " + datos.responseJSON.message);
            }
        });
    });

    function listar() {
        tabla = $("#perdidas").DataTable({
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
                { data: "motivo", name: "perdidas.motivo" },
                {data: "perdida_X",name: "perdidas.perdida_X"}
            ],
            order: [[2, 'asc']],
            rowGroup: {
                dataSrc: 'numero_corte'
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var perdida = {
            id: $("#id").val(),
            corte_id: $("#cortesSearch").val(),
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
        }
    }

    $("#btnAgregar").click(function(e) {
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        mostrarForm(false);
    });

    init();
});
