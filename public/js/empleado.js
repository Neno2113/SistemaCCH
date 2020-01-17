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
        $("#banco_tarjeta_cobro").select2();
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
        $("#nombre").val("").attr('readonly', false);
        $("#apellido").val("").attr('readonly', false);
        $("#calle").val("").attr('readonly', false);
        $("#sector").val("").attr('readonly', false);
        $("#provincia").val("").trigger("change").attr('disabled', false);
        $("#sitios_cercanos").val("").attr('readonly', false);
        $("#cedula").val("").attr('readonly', false);
        $("#telefono_1").val("").attr('readonly', false);
        $("#telefono_2").val("").attr('readonly', false);
        $("#cargo").val("").attr('readonly', false);
        $("#email").val("").attr('readonly', false);
        $("#tipo_contrato").val("").attr('readonly', false);
        $("#departamento").val("").attr('readonly', false);
      
        
    }

    $("#btn-guardar").click(function(e) {
        e.preventDefault();
        
        var empleado = {
            nombre: $("#nombre").val(),
            apellido: $("#apellido").val(),
            calle: $("#calle").val(),
            sector: $("#sector").val(),
            provincia: $("#provincia").val(),
            sitios_cercanos: $("#sitios_cercanos").val(),
            cedula: $("#cedula").val(),
            departamento: $("#departamento").val(),
            telefono_1: $("#telefono_1").val(),
            telefono_2: $("#telefono_2").val(),
            cargo: $("#cargo").val(),
            email: $("#email").val(),
            tipo_contrato: $("#tipo_contrato").val(),
          
        };
        console.log(JSON.stringify(empleado));

        // $.ajax({
        //     url: "client",
        //     type: "POST",
        //     dataType: "json",
        //     data: JSON.stringify(client),
        //     contentType: "application/json",
        //     success: function(datos) {
        //         if (datos.status == "success") {
        //             bootbox.alert("Se registro correctamente el cliente!!");
        //             limpiar();
        //             tabla.ajax.reload();
        //             mostrarForm(false);
        //         } else {
        //             bootbox.alert(
        //                 "Ocurrio un error durante la creacion del cliente verifique los datos suministrados!!"
        //             );
        //         }
        //     },
        //     error: function(datos) {
        //         console.log(datos.responseJSON.errors); 
        //         let errores = datos.responseJSON.errors;

        //         Object.entries(errores).forEach(([key, val]) => {
        //             bootbox.alert({
        //                 message:"<h4 class='invalid-feedback d-block'>"+val+"</h4>",
        //                 size: 'small'
        //             });
        //         }); 
        //     }
        // });

    });

    function listar() {
        tabla = $("#clients").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/clients",
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
           
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#fila-dependientes").hide();
            $("#fila-bancaria").hide();
            $("#autorizacion_credito_req").hide();
            $("#redistribucion_tallas").hide();
            $("#factura_desglosada_tallas").hide();
            $("#acepta_segundas").hide();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
        }
    }

    $("input[name='r1']").change(function() {
        let val = $("input[name='r1']:checked").val();

        if(val == 1){
            $('.collapse').collapse('show');
        }else{
            $('.collapse').collapse('hide');
        }
    });

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
