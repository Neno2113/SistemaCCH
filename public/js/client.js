$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#formulario").validate({
        rules: {
            nombre_cliente: {
                required: true,
                minlength: 5
            },
            direccion_principal: {
                required: true,
                minlength: 4
            },
            contacto_cliente_principal:{
                required: true,
                minlength: 4
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
            }
        },
        messages: {
            nombre_cliente: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 5 letras"
            },
            direccion_principal: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 4 letras"
            },
            contacto_cliente_principal:{
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 4 letras"
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
            }
        }
    })
   

    var tabla;

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
        $("#results").hide();

        $("#clientes").select2({
            placeholder: "Elige un cliente...",
            ajax: {
                url: 'clients',
                dataType: 'json',
                delay: 250,
                processResults: function(data){
                    return {
                        results: $.map(data, function(item){
                            return {
                                text: item.nombre_cliente,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })
   
    }

    function limpiar() {
        $("#nombre_cliente").val("");
        $("#direccion_principal").val("");
        $("#contacto_cliente_principal").val("");
        $("#telefono_1").val("");
        $("#telefono_2").val("");
        $("#telefono_3").val("");
        $("#celular_principal").val("");
        $("#email_principal").val("");
        $("#condiciones_credito").val("");
        $("#autorizacion_credito_req").val("");
        $("#notas").val("");
        $("#redistribucion_tallas").val("");
        $("#factura_desglosada_talla").val("");
    }

    $("#btn-guardar").click(function(e) {
        // validacion(e);
        e.preventDefault();
        
        var client = {
            nombre_cliente: $("#nombre_cliente").val(),
            direccion_principal: $("#direccion_principal").val(),
            contacto_cliente_principal: $("#contacto_cliente_principal").val(),
            telefono_1: $("#telefono_1").val(),
            telefono_2: $("#telefono_2").val(),
            telefono_3: $("#telefono_3").val(),
            celular_principal: $("#celular_principal").val(),
            email_principal: $("#email_principal").val(),
            condiciones_credito: $("#condiciones_credito").val(),
            autorizacion_credito_req: $("input[name='r1']:checked").val(),
            notas: $("#notas").val(),
            redistribucion_tallas: $("input[name='r2']:checked").val(),
            factura_desglosada_talla: $("input[name='r3']:checked").val(),
            acepta_segundas: $("input[name='r4']:checked").val()
        };

        // console.log(JSON.stringify(client));

        $.ajax({
            url: "client",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(client),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se registro correctamente el cliente!!");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion del cliente verifique los datos suministrados!!"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*) correctamente"
                );
            }
        });

    });

    function listar() {
        tabla = $("#clients").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/clients",
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
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "nombre_cliente" },
                { data: "direccion_principal" },
                { data: "contacto_cliente_principal" },
                { data: "telefono_1" },
                { data: "telefono_2" },
                { data: "telefono_3" },
                { data: "celular_principal" },
                { data: "email_principal" },
                { data: "condiciones_credito" },
                { data: "notas" },
                { data: "autorizacion_credito_req" },
                { data: "redistribucion_tallas" },
                { data: "factura_desglosada_talla" },
                { data: "acepta_segundas" },
            ],
            order: [[2, 'asc']],
            rowGroup: {
                dataSrc: 'nombre_cliente'
            }
        });
    }
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var client = {
            id: $("#id").val(),
            nombre_cliente: $("#nombre_cliente").val(),
            direccion_principal: $("#direccion_principal").val(),
            contacto_cliente_principal: $("#contacto_cliente_principal").val(),
            telefono_1: $("#telefono_1").val(),
            telefono_2: $("#telefono_2").val(),
            telefono_3: $("#telefono_3").val(),
            celular_principal: $("#celular_principal").val(),
            email_principal: $("#email_principal").val(),
            condiciones_credito: $("#condiciones_credito").val(),
            autorizacion_credito_req: $("input[name='r1']:checked").val(),
            notas: $("#notas").val(),
            redistribucion_tallas: $("input[name='r2']:checked").val(),
            factura_desglosada_talla: $("input[name='r3']:checked").val(),
            acepta_segundas: $("input[name='r4']:checked").val()
        };
        
        // console.log(JSON.stringify(client));
        $.ajax({
            url: "client/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(client),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el usuario");
                    $("#id").val("");
                    limpiar();
                    tabla.ajax.reload();
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

    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#radios").show();
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#autorizacion_credito_req").hide();
            $("#redistribucion_tallas").hide();
            $("#factura_desglosada_tallas").hide();
            $("#acepta_segundas").hide();
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
