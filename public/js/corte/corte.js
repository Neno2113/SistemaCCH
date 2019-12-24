$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#formulario").validate({
        rules: {
            no_marcada: {
                required: true,
                minlength: 1,
                number: true
            },
            ancho_marcada: {
                required: true,
                minlength: 1,
                number: true
            },
            largo_marcada: {
                required: true,
                minlength: 1,
                number: true
            },
        },
        messages: {
            no_marcada: {
                required: "El numero de marcada es obligatorio",
                minlength: "Debe contener al menos 1 numero",
                number: "Este campo solo admite numeros"
            },
            ancho_marcada: {
                required: "El ancho de la marcada es obligatorio",
                minlength: "Debe contener al menos 1 numero",
                number: "Este campo solo admite numeros"
            },
            largo_marcada: {
                required: "El largo de la marcada es obligatorio",
                minlength: "Debe contener al menos 1 numero",
                number: "Este campo solo admite numeros"
            },
           

        }
    })
   

    var tabla

    //Funcion que se ejecuta al inicio 
    function init() {
        listar();
        listarRollos();
        mostrarForm(false);
        $("#btn-edit").hide();
        ordenPedidoCod();
        
    }

    //funcion para limpiar el formulario(los inputs)
    function limpiar() {
        $("#numero_corte").val("");
        // $("#sec").val("");
        $("#productos").val("").trigger("change");
        $("#fecha_entrega").val("");
        $("#no_marcada").val("");
        $("#corte").val("");
        $("#ancho_marcada").val("");
        $("#largo_marcada").val("");
        $("#aprovechamiento").val("");
    }

    function ordenPedidoCod() {
        $("#sec").val("");
        $("#numero_corte_gen").val("");
        $("#corte").val("");
        $("#numero_corte").val("");
        $("#corte_tallas").val(""); 
        
        $.ajax({
            url: "corte/lastdigit",
            type: "GET",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    
                    var i = Number(datos.sec);
                    $("#sec").val(i);
                    i = (i + 0.01).toFixed(2).split('.').join("");
                    var year = new Date().getFullYear().toString();
                    var referencia = year+'-'+i;
                    // console.log(referencia);
                               
                    $("#numero_corte_gen").val(referencia);
                    $("#corte").val(referencia);
                    $("#numero_corte").val(referencia);
                    $("#corte_tallas").val(referencia);          
                    

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

    // //funcion para generar codigo de corte
    // $("#btn-generar").on('click', function(e){
    //     e.preventDefault();

    //     $.ajax({
    //         url: "corte/lastdigit",
    //         type: "GET",
    //         dataType: "json",
    //         success: function(datos) {
    //             if (datos.status == "success") {
    //                 var i = Number(datos.sec);
    //                 $("#sec").val(i);
    //                 i = (i + 0.01).toFixed(2).split('.').join("");
    //                 var year = new Date().getFullYear().toString();
    //                 var referencia = year+'-'+i;
                   
                               
    //                 $("#numero_corte").val(referencia);
    //                 $("#corte").val(referencia);
    //                 // $("#corte_tallas").val(referencia +" - "+ referencia_producto );
    //                 $('#btn-generar').attr("disabled", true);
    //                 $("#fila1").show();
    //                 $("#fila2").show();
    //                 $("#fila3").show();
    //                 $("#edit-hide").show();
    //                 $("#edit-hide2").show();
    //                 bootbox.alert(
    //                     "Numero de corte generado exitosamente!!"
    //                 );

    //             } else {
    //                 bootbox.alert(
    //                     "Ocurrio un error !!"
    //                 );
    //             }
    //         },
    //         error: function() {
    //             bootbox.alert(
    //                 "Ocurrio un error!!"
    //             );
    //         }
    //     });
    // });

    //Select2 productos

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
     //Select2 cortes para consulta

    $("#cortesSearch").select2({
        placeholder: "Busca un numero de corte...",
        ajax: {
            url: 'cortes',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.numero_corte+' - '+item.fase  +' | Producto: '+item.referencia_producto,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })


    $("#productos").change(function(){
        let val = $("#productos option:selected").text();
        $("#corte_tallas").val(val);
        let genero = val.substring(1,2);

        if (genero == "2") {
            $("#corte_tallas").val('Mujer: '+val);
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
            $("#corte_tallas").val('Niño: '+val);
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
            $("#corte_tallas").val('Niña: '+val);
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
            $("#corte_tallas").val('Hombre: '+val);
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


    $("#fecha_entrega").click(function(){
        let fecha = new Date();
        let dia = fecha.getDate();
        let year = fecha.getFullYear();
        let month = fecha.getMonth();

        if(dia < 15){
            month = month + 2;
            if(month > 12){
                year = year;
                month = month - 1;
                console.log(year+'/'+month+'/'+dia);
            
            }
           
            $("#fecha_entrega").attr('min', year +"-"+ month+"-14")
            $("#fecha_entrega").attr('max', year +"-"+ month+"-14")
            $("#fecha_entrega").attr('title', "Fecha estimada de entrega es la primera quincena del mes: "+month);
        }else if(dia > 15){
            month = month + 2;
            $("#fecha_entrega").attr('min', year +"-"+ month+"-28")
            $("#fecha_entrega").attr('max', year +"-"+ month+"-28")
            $("#fecha_entrega").attr('title', "Fecha estimada de entrega es la segunda quincena del mes: "+month);
        }
    });

    //funcion que envia los datos del form al backend usando AJAX
    $("#btn-guardar").click(function(e){
        e.preventDefault();
        
        var corte = {
            sec: $("#sec").val(),
            numero_corte: $("#numero_corte_gen").val(),
            producto: $("#productos").val(),
            fecha_entrega: $("#fecha_entrega").val(), 
            no_marcada: $("#no_marcada").val(),
            ancho_marcada: $("#ancho_marcada").val(),
            largo_marcada: $("#largo_marcada").val(),
            aprovechamiento: $("#aprovechamiento").val()
        };

        console.log(JSON.stringify(corte));

        // funcion que se ejecuta con el callback de la funcion para guardar
        //esta almacena las cantidades por tallas
        $.ajax({
            url: "corte",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Corte creado !!");
                    limpiar();
                   
                    mostrarForm(false);
                    $('#btn-generar').attr("disabled", false);

                    var talla = {
                        corte_id: datos.corte.id,
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
                        url: "talla",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(talla),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                                // tabla.ajax.reload();
                                ordenPedidoCod();
                                bootbox.alert("Se asignaron un total de: <strong>"+datos.talla.total+"</strong> entre todas las tallas digitadas");
                                $("#a").val(""),
                                $("#b").val(""),
                                $("#c").val(""),
                                $("#d").val(""),
                                $("#e").val(""),
                                $("#f").val(""),
                                $("#g").val(""),
                                $("#h").val(""),   
                                $("#i").val(""),
                                $("#j").val(""),
                                $("#k").val(""),
                                $("#l").val("");    
                                // tabla.ajax.reload();  
                                $("#cortes_listados").DataTable().ajax.reload();      
                                
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

    //funcion para listar en el Datatable
    function listar() {
        // tabla.responsive.recalc();
        tabla = $("#cortes_listados").DataTable({
            serverSide: true,
            autoWidth: false,
            responsive: true,
            iDisplayLength: 5,
            dom: 'Bfrtip',
            buttons: [
                'pageLength',
                'copyHtml5',
                 {
                    extend: 'excelHtml5',
                    autoFilter: true,
                    sheetName: 'Exported data'
                },
                'csvHtml5',
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }
                ],
            ajax: "api/cortes",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "name", name: 'users.name' },
                { data: "numero_corte", name: 'corte.numero_corte' },
                { data: "referencia_producto", name: 'producto.referencia_producto' },
                { data: "fecha_corte", name: 'corte.fecha_corte' },
                { data: "fecha_entrega", name: 'corte.fecha_entrega' },
                { data: "fase", name: 'corte.fase' },
                { data: "total", name: 'corte.total' },
                { data: "aprovechamiento", name: 'corte.aprovechamiento' },
                { data: "no_marcada", name: 'corte.no_marcada' },
                { data: "largo_marcada", name: 'corte.largo_marcada' },
                { data: "ancho_marcada", name: 'corte.ancho_marcada' },
            ],
            order: [[7, 'desc']],
            rowGroup: {
                dataSrc: 'fase' 
            }
        });
    }

    //funcion para listar rollos sin corte asigando
    function listarRollos() {
        tabla = $("#rollos").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/rollos_corte",
            dom: 'Bfrtip',
            iDisplayLength: 5,
            buttons: [
                'pageLength',
                'copyHtml5',
                 {
                    extend: 'excelHtml5',
                    autoFilter: true,
                    sheetName: 'Exported data'
                },
                'csvHtml5',
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }
                ],
            columns: [
                { data: "codigo_rollo", name: "rollos.codigo_rollo" },
                { data: "referencia", name: "tela.referencia" },
                { data: "longitud_yarda", name: "rollos.longitud_yarda" },
                { data: "num_tono", name: "rollos.num_tono" },
                { data: "Editar", orderable: false, searchable: false },
            ],
            order: [[2, 'desc']],
            rowGroup: {
                dataSrc: 'referencia'
            }
        });
    }

    //funcion para editar
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var corte = {
            id: $("#id").val(),
            producto: $("#productos").val(),
            no_marcada: $("#no_marcada").val(),
            ancho_marcada: $("#ancho_marcada").val(),
            largo_marcada: $("#largo_marcada").val(),
            aprovechamiento: $("#aprovechamiento").val()
        };

        $.ajax({
            url: "corte/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el usuario");
                    limpiar();
                    $("#cortes").DataTable().ajax.reload();
                    $("#id").val("");
                    $("#listadoUsers").show();
                    $("#registroForm").hide();
                    $("#btnCancelar").hide();
                    $("#btn-edit").hide();
                    $("#btn-guardar").show();
                    $("#btnAgregar").show();

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error!!"
                );
            }
        });
       
    });

    $("#btn-buscar").click(function(e) {
        e.preventDefault();

       
        var id = $("#cortesSearch").val()
        
        $.ajax({
            url: "talla/search/"+ id,
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se consulto correctamente!!");
                    $("#a").val(datos.talla.a);
                    $("#b").val(datos.talla.b);
                    $("#c").val(datos.talla.c);
                    $("#d").val(datos.talla.d);
                    $("#e").val(datos.talla.e);
                    $("#f").val(datos.talla.f);
                    $("#g").val(datos.talla.g);
                    $("#h").val(datos.talla.h);
                    $("#i").val(datos.talla.i);
                    $("#j").val(datos.talla.j);
                    $("#k").val(datos.talla.k);
                    $("#l").val(datos.talla.l);
                    $("#total").val(datos.talla.total);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error!!"
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
            // $("#fila1").hide();
            // $("#fila2").hide();
            // $("#fila3").hide();
            // $("#btn-guardar").attr("disabled", true);
            $("#btn-edit").hide();
            $("#btn-guardar").show();
        }
    }

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        $("#btn-generar").show();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        $("#btn-generar").attr("disabled", false);
        mostrarForm(false);
    });

    window.onresize = function() {
        tabla.columns.adjust().responsive.recalc();
    } 
  

    init();
});
