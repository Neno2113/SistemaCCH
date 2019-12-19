$(document).ready(function() {

    $("#formulario").validate({
        rules: {
            fecha_envio: {
                required: true,
                minlength: 1
            },
            cantidad: {
                required: true,
                minlength: 1,
                number: true
            },
            receta_lavado: {
                required: true,
                minlength: 10
            }
          
        },
        messages: {
            fecha_envio: {
                required: "La fecha en envio es obligatoria",
                minlength: "La fecha en envio es obligatoria"
            },
            cantidad: {
                required: "La cantidad es un campo numerico obligatorio.",
                minlength: "La cantidad es un campo numerico obligatorio.",
                number: "Este campo solo admite numeros."
            },
            receta_lavado: {
                required: "La receta de lavado es obligatoria",
                minlength: "La receta de lavado debe conteneer al menos 10 caracteres"
            }
        }
    })
   

    var tabla

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
    }


    $("#receta_lavado").on('keyup', function(){
        $("#btn-guardar").attr('disabled', false);
    })

    $("#fecha_envio").on('change', function(){
        var corte = {
            corte_id: $("#cortesSearch").val(),
            producto_id: $("#productos").val(),
            cantidad: $("#cantidad").val()
        };

        $.ajax({
            url: "cantidades",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    let cantidad_restante = datos.total_enviado;
                    let cantidad_corte = datos.total_cortado;
                    let cantidad_perdida = datos.perdidas;
                    let parcial = datos.parcial;

                    let cantidad = cantidad_corte - cantidad_restante - cantidad_perdida;
                    if(cantidad < 0){
                        cantidad = 0
                    }

                    if(cantidad_restante == null || cantidad_restante == 0 && parcial == null || parcial == 0){
                        
                        cantidad = cantidad_corte - cantidad_perdida;
                    }

                    $("#cantidad").val(cantidad);
                  
                    bootbox.alert("La cantidad recomendada para enviar es: "+cantidad);
                   
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

    function limpiar() {
        $("#numero_envio").val("");
        $("#fecha_envio").val("");
        $("#receta_lavado").val("");
        $("#cantidad").val("");
        $("#estandar_incluido").val("");
        $("#productos").val("").trigger("change");
        $("#cortesSearch").val("").trigger("change");
        $("#suplidores").val("").trigger("change");
        $("#suplidoresEdit").val("").trigger("change");
        $("#cortesSearchEdit").val("").trigger("change");
     
    }

    //funcion para generar codigo de corte
    $("#btn-generar").on('click', function(e){
        e.preventDefault();

        $.ajax({
            url: "lavanderia/lastdigit",
            type: "GET",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    var i = Number(datos.sec);
                    $("#sec").val(i);
                    i = (i + 0.01).toFixed(2).split('.').join("");
                  
                    var referencia ='EL-'+i;
                               
                    $("#numero_envio").val(referencia);
                    $('#btn-generar').attr("disabled", true);
                    $("#formularioLavanderia").show();
                    bootbox.alert(
                        "Numero de envio generado exitosamente!!"
                    );

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
    });

    $("#cortesSearch").select2({
        placeholder: "Buscar un numero de corte Ej: 2019-xxx",
        ajax: {
            url: 'cortes',
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
            cache: true,

        }
    })

    $("#cortesSearchEdit").select2({
        placeholder: "Buscar un numero de corte Ej: 2019-xxx",
        ajax: {
            url: 'cortes_edit',
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

    $("#suplidores").select2({
        placeholder: "Buscar una lavanderia por su nombre ",
        ajax: {
            url: 'suplidores_lav',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.nombre+' - '+ item.contacto_suplidor,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })


    $("#btn-guardar").click(function(e){
        e.preventDefault();
        
        var lavanderia = {
            sec: $("#sec").val(),
            numero_envio: $("#numero_envio").val(),
            suplidor_id: $("#suplidores").val(),
            corte_id: $("#cortesSearch").val(),
            fecha_envio: $("#fecha_envio").val(),
            cantidad: $("#cantidad").val(),
            receta_lavado: $("#receta_lavado").val(),
            estandar_incluido: $("input[name='r1']:checked").val(),
        };

        $.ajax({
            url: "lavanderia",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(lavanderia),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Registro");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                    $('#btn-generar').attr("disabled", false);
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
        tabla = $("#ordenes_aprobacion").DataTable({
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
            ajax: "api/ordenes_aprobacion",
            columns: [
                // { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_orden_pedido",name: "orden_pedido.no_orden_pedido"},
                { data: "name", name: "users.name" },
                { data: "nombre_cliente", name: "cliente.nombre_cliente" },
                { data: "nombre_sucursal", name: "cliente_sucursales.nombre_sucursal"},
                { data: "fecha", name: "orden_pedido.fecha" },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" },
                { data: "fecha_aprobacion", name: "orden_pedido.fecha_aprobacion" },
                { data: "total", name: "orden_pedido.total", searchable: false  },
                { data: "status_orden_pedido", name: "orden_pedido.status_orden_pedido" },
            ],
            order: [[1, "desc"]],
            // rowGroup: {
            //     dataSrc: "name"
            // }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var lavanderia = {
            producto_id: $("#productosEdit").val(),
            suplidor_id: $("#suplidores").val(),
            corte_id: $("#cortesSearchEdit").val(),
            numero_envio: $("#numero_envio").val(),
            fecha_envio: $("#fecha_envio").val(),
            cantidad: $("#cantidad").val(),
            receta_lavado: $("#receta_lavado").val(),
            estandar_incluido: $("input[name='r1']:checked").val(),
        };
     
        $.ajax({
            url: "lavanderia/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(lavanderia),
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
                    mostrarForm(false);
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
            $("#corteADD").show();
            $("#productoADD").show();
            $('#btn-generar').attr("disabled", false);
           
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#corteEdit").hide();
            $("#productoEdit").hide();
            $("#referencia_producto").hide();
            $("#numero_corte").hide();
            $("#suplidor_lavanderia").hide();
            $("#estandar_incluido").hide();
            $("#btn-guardar").attr('disabled', true);
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#formularioLavanderia").hide();
           
           
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
