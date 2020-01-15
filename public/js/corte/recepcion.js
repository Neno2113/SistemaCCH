$(document).ready(function() {
    var pendiente_guardar;
    var total_devuelto_gloabl;

    
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
              
            }
    })
      


    var tabla

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
        recepcionCod();
    }

    $("#cantidad_recibida").on('keyup', function(){
        $("#btn-guardar").attr("disabled", false);
    })

        
    function limpiar() {
        $("#fecha_recepcion").val("");
        $("#cantidad_recibida").val("");
        $("#cantidad_restante").val("");
        $("#num_factura").val("");
        $("#cortesSearch").val("").trigger("change");
        $("#lavanderias").val("").trigger("change");
    }

    $("#cortesSearch").select2({
        placeholder: "Buscar un numero de corte Ej:2019-xxx",
        ajax: {
            url: 'cortes_rec',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.numero_corte+' - '+item.fase,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })

    $("#cortesSearchEdit").select2({
        placeholder: "Buscar un numero de corte Ej:2019-xxx",
        ajax: {
            url: 'corte_rec_edit',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.numero_corte+' - '+item.fase,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })

    function recepcionCod() {
            $("#sec").val("");
            $("#numero_recepcion").val("");
         
            $.ajax({
                url: "recepcion/lastdigit",
                type: "GET",
                dataType: "json",
                success: function(datos) {
                    if (datos.status == "success") {
                        
                        var i = Number(datos.sec);
                        $("#sec").val(i);
                        i = (i + 0.01).toFixed(2).split('.').join("");
                        var referencia = "RE"+'-'+i;
                                   
                        $("#numero_recepcion").val(referencia);
                               
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
  

    $("#fecha_recepcion").on('change', function(){
        var recepcion = {
            corte_id: $("#cortesSearch").val(),
            // lavanderia_id: $("#lavanderias").val(),
            cantidad: $("#cantidad_recibida").val()
        };

        $.ajax({
            url: "cantidades_recibidas",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(recepcion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    console.log(datos);
                    let total_enviado = datos.total_enviado;
                    let cantidad_corte = datos.total_cortado;
                    let cantidad_perdida = datos.perdidas;
                    let parcial = datos.envio_parcial;
                    let total_recibido = datos.total_recibido;
                    let total_devuelto = datos.total_devuelto;
                    total_devuelto_gloabl = datos.total_devuelto;
                    let pendiente = total_enviado - total_recibido - cantidad_perdida;
                    pendiente_guardar = pendiente; 

                    // $("#cantidad_recibida").val(parcial);
                    bootbox.alert("La cantidad pendiente a recibir de este corte es: <strong>"+ pendiente+"</strong>");

                    // let cantidad = cantidad_corte - cantidad_restante - cantidad_perdida;
                    // if(cantidad < 0){
                    //     cantidad = 0
                    // }

                    if(total_recibido == null || total_recibido == 0){
                        $("#cantidad_restante").val(total_enviado - cantidad_perdida); 
                    }else{
                        $("#cantidad_restante").val(total_enviado - total_recibido - cantidad_perdida); 
                        // bootbox.alert("Se han recibido: "+total_recibido+" de: "+ total_enviado);
                    }   

                    
                
                   
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error"
                );
            }
        });
    })


    $("#btn-guardar").click(function(e){
        e.preventDefault();
       
        var recepcion = {
            corte: $("#cortesSearch").val(),
            numero_recepcion: $("#numero_recepcion").val(),
            numero_factura: $("#num_factura").val(),
            fecha_recepcion: $("#fecha_recepcion").val(),
            cantidad_recibida: $("#cantidad_recibida").val(),
            total_devuelto: total_devuelto_gloabl,
            estandar_recibido: $("input[name='r1']:checked").val(),
            sec: $("#sec").val()
        };

        var cant_recibida = $("#cantidad_recibida").val();
        
        if(cant_recibida > pendiente_guardar){
            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
            "<i class='fas fa-exclamation-triangle'></i> La cantidad digitada no puede ser mayor a la cantidad pendiente por recibir de lavanderia"+
           "</div>")
        }else{
            $.ajax({
                url: "recepcion",
                type: "POST",
                dataType: "json",
                data: JSON.stringify(recepcion),
                contentType: "application/json",
                success: function(datos) {
                    if (datos.status == "success") {
                        bootbox.alert("Corte recibido de lavanderia recibido!!");
                        limpiar();
                        tabla.ajax.reload();
                        mostrarForm(false);
                        recepcionCod();
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
        }

      
    });

    function listar() {
        tabla = $("#recepciones").DataTable({
            serverSide: true,
            responsive: true,
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
            ajax: "api/recepciones",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "numero_recepcion", name: "recepcion.numero_recepcion" },
                { data: "numero_corte", name: "corte.numero_corte" },
                { data: "fecha_recepcion", name: "recepcion.fecha_recepcion" },
                { data: "recibido_parcial", name: "recepcion.recibido_parcial" },
                { data: "total_recibido", name: "recepcion.total_recibido" },
                { data: "pendiente", name: "recepcion.pendiente" },
                { data: "estandar_recibido", name: "recepcion.estandar_recibido" },
              
            ],
            order: [[2, 'desc']],
            rowGroup: {
                dataSrc: 'numero_corte'
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var recepcion = {
            id: $("#id").val(),
            corte: $("#cortesSearchEdit").val(),
            numero_envio: $("#lavanderiasEdit").val(),
            fecha_recepcion: $("#fecha_recepcion").val(),
            cantidad_recibida: $("#cantidad_recibida").val(),
            estandar_recibido: $("input[name='r1']:checked").val(),
        };

        // console.log(JSON.stringify(recepcion));

        $.ajax({
            url: "recepcion/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(recepcion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizo correctamente la recepcion");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function(datos) {
                bootbox.alert(
                    "Error: "+ datos.responseJSON.message
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
            $("#estandar_recibido").hide();
            $("#lavanderia").hide();
            $("#corte").hide();
            $("#corteAdd").show();
            $("#corteEdit").hide();
            $("#lavanderiaAdd").show();
            $("#lavanderiaEdit").hide();
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
  

    init();
});