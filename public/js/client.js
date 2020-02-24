$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#formulario").validate({
        rules: {
            nombre_cliente: {
                required: true,
                minlength: 3
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
            },
            rnc: {
                required: true,
                digits: true,
                minlengh: 9
            }
        },
        messages: {
            nombre_cliente: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 3 letras"
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
            },
            rnc:{
                required: "Este campo es obligatorio",
                minlengh: "Debe contener al menos 9 numeros",
                digits: "Este campo solo puedo contener numeros"

            }
        }
    })


    var tabla;

    function init() {
        $("#provincia").select2();
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
        $("#nombre_cliente").val("").attr('readonly', false);
        $("#calle").val("").attr('readonly', false);
        $("#sector").val("").attr('readonly', false);
        $("#provincia").val("").trigger("change").attr('disabled', false);
        $("#sitios_cercanos").val("").attr('readonly', false);
        $("#contacto_cliente_principal").val("").attr('readonly', false);;
        $("#telefono_1").val("").attr('readonly', false);;
        $("#telefono_2").val("").attr('readonly', false);;
        $("#telefono_3").val("").attr('readonly', false);;
        $("#celular_principal").val("").attr('readonly', false);;
        $("#email_principal").val("").attr('readonly', false);;
        $("#condiciones_credito").val("").attr('disabled', false);;
        $("#autorizacion_credito_req").val("").attr('readonly', false);;
        $("#notas").val("").attr('readonly', false);;
        $("#redistribucion_tallas").val("").attr('readonly', false);;
        $("#factura_desglosada_talla").val("").attr('readonly', false);;
        $("#rnc").val("").attr('readonly', false);;
    }

    $("#btn-guardar").click(function(e) {
        // validacion(e);
        e.preventDefault();

        var client = {
            nombre_cliente: $("#nombre_cliente").val(),
            calle: $("#calle").val(),
            sector: $("#sector").val(),
            provincia: $("#provincia").val(),
            sitios_cercanos: $("#sitios_cercanos").val(),
            contacto_cliente_principal: $("#contacto_cliente_principal").val(),
            rnc: $("#rnc").val(),
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
        tabla = $("#clients").DataTable({
            serverSide: true,
            responsive: true,
            ajax:{
                "url": "api/clients",
                "type": "POST"
            },
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
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Ver", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "nombre_cliente" },
                { data: "rnc" },
                { data: "contacto_cliente_principal" },
                { data: "email_principal" },
                { data: "condiciones_credito" },

            ],
            order: [[2, 'asc']],
            // rowGroup: {
            //     dataSrc: 'nombre_cliente'
            // }
        });
    }
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var client = {
            id: $("#id").val(),
            nombre_cliente: $("#nombre_cliente").val(),
            calle: $("#calle").val(),
            sector: $("#sector").val(),
            provincia: $("#provincia").val(),
            sitios_cercanos: $("#sitios_cercanos").val(),
            contacto_cliente_principal: $("#contacto_cliente_principal").val(),
            rnc: $("#rnc").val(),
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

function mostrar(id_client) {
    $.post("client/" + id_client, function(data, status) {

        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").show();
        $("#btn-guardar").hide();
        $("#autorizacion_credito_req").show();
        $("#redistribucion_tallas").show();
        $("#factura_desglosada_tallas").show();
        $("#acepta_segundas").show();

        let result1, result2, result3, result4;
        if(data.client.autorizacion_credito_req == 1){
            result1 = 'Si';
        }else{
            result1 = 'No';
        }

        if(data.client.redistribucion_tallas == 1){
            result2 = 'Si';
        }else{
            result2 = 'No';
        }

        if(data.client.factura_desglosada_talla == 1){
            result3 = 'Si';
        }else{
            result3 = 'No';
        }

        if(data.client.acepta_segundas == 1){
            result4 = 'Si';
        }else{
            result4 = 'No';
        }

        // console.log(typeof data.client.autorizacion_credito_req);
        $("#id").val(data.client.id);
        $("#nombre_cliente").val(data.client.nombre_cliente).attr('readonly', false);
        $("#rnc").val(data.client.rnc).attr('readonly', false);
        $("#calle").val(data.client.calle).attr('readonly', false);
        $("#sector").val(data.client.sector).attr('readonly', false);
        $("#provincia").val(data.client.provincia).trigger("change").attr('disabled', false);
        $("#sitios_cercanos").val(data.client.sitios_cercanos).attr('readonly', false);
        $("#contacto_cliente_principal").val(data.client.contacto_cliente_principal).attr('readonly', false);
        $("#telefono_1").val(data.client.telefono_1).attr('readonly', false);
        $("#telefono_2").val(data.client.telefono_2).attr('readonly', false);
        $("#telefono_3").val(data.client.telefono_3).attr('readonly', false);
        $("#celular_principal").val(data.client.celular_principal).attr('readonly', false);
        $("#email_principal").val(data.client.email_principal).attr('readonly', false);
        $("#condiciones_credito").val(data.client.condiciones_credito).attr('disabled', false);
        $("#autorizacion_credito_req").val(result1);
        $("#notas").val(data.client.notas);
        $("#redistribucion_tallas").val(result2);
        $("#factura_desglosada_tallas").val(result3);
        $("#acepta_segundas").val(result4);

    });
}

function ver(id_client) {
    $.post("client/" + id_client, function(data, status) {

        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-guardar").hide();
        $("#autorizacion_credito_req").show();
        $("#redistribucion_tallas").show();
        $("#factura_desglosada_tallas").show();
        $("#acepta_segundas").show();

        let result1, result2, result3, result4;
        if(data.client.autorizacion_credito_req == 1){
            result1 = 'Si';
        }else{
            result1 = 'No';
        }

        if(data.client.redistribucion_tallas == 1){
            result2 = 'Si';
        }else{
            result2 = 'No';
        }

        if(data.client.factura_desglosada_talla == 1){
            result3 = 'Si';
        }else{
            result3 = 'No';
        }

        if(data.client.acepta_segundas == 1){
            result4 = 'Si';
        }else{
            result4 = 'No';
        }

        // console.log(typeof data.client.autorizacion_credito_req);
        $("#nombre_cliente").val(data.client.nombre_cliente).attr('readonly', true);
        $("#rnc").val(data.client.rnc).attr('readonly', true);
        $("#calle").val(data.client.calle).attr('readonly', true);
        $("#sector").val(data.client.sector).attr('readonly', true);
        $("#provincia").val(data.client.provincia).trigger("change").attr('disabled', true);
        $("#sitios_cercanos").val(data.client.sitios_cercanos).attr('readonly', true);
        $("#contacto_cliente_principal").val(data.client.contacto_cliente_principal).attr('readonly', true);
        $("#telefono_1").val(data.client.telefono_1).attr('readonly', true);
        $("#telefono_2").val(data.client.telefono_2).attr('readonly', true);
        $("#telefono_3").val(data.client.telefono_3).attr('readonly', true);
        $("#celular_principal").val(data.client.celular_principal).attr('readonly', true);
        $("#email_principal").val(data.client.email_principal).attr('readonly', true);
        $("#condiciones_credito").val(data.client.condiciones_credito).attr('disabled', true);
        $("#autorizacion_credito_req").val(result1).attr('readonly', true);
        $("#notas").val(data.client.notas).attr('readonly', true);
        $("#redistribucion_tallas").val(result2).attr('readonly', true);
        $("#factura_desglosada_tallas").val(result3).attr('readonly', true);
        $("#acepta_segundas").val(result4).attr('readonly', true);

    });
}

function eliminar(id_client){
    bootbox.confirm("¿Estas seguro de eliminar este cliente?", function(result){
        if(result){
            $.post("client/delete/" + id_client, function(){
                // bootbox.alert(e);
                bootbox.alert("Cliente eliminado correctamente!!");
                $("#clients").DataTable().ajax.reload();
            })
        }
    })
}
