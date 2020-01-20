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
        $("#cargo").select2();
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
        $("#results").hide();

    
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
        $("#cargo").val("").trigger("change").attr('disabled', false);
        $("#email").val("").attr('readonly', false);
        $("#tipo_contrato").val("").trigger("change").attr('disabled', false);
        $("#departamento").val("").trigger("change").attr('disabled', false);
        $("#forma_pago").val("").attr('readonly', false);
        $("#sueldo").val("").attr('readonly', false);
        $("#valor_hora").val("").attr('readonly', false);
        $("#banco_tarjeta_cobro").val("").attr('readonly', false);
        $("#no_cuenta").val("").attr('readonly', false);
        $("#nss").val("").attr('readonly', false);
        $("#nombre_esposa").val("").attr('readonly', false);
        $("#telefono_esposa").val("").attr('readonly', false);
        $("#cantidad_dependientes").val("").attr('readonly', false);
        $("#nombre_dependiente_1").val("").attr('readonly', false);
        $("#nombre_dependiente_2").val("").attr('readonly', false);
        $("#nombre_dependiente_3").val("").attr('readonly', false);
        $("#nombre_dependiente_4").val("").attr('readonly', false);
        $("#nombre_dependiente_5").val("").attr('readonly', false);
        $("#nombre_dependiente_6").val("").attr('readonly', false);
        $("#nombre_dependiente_7").val("").attr('readonly', false);
        $("#nombre_dependiente_1").val("").attr('readonly', false);
        
      
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
        
        $.ajax({
            url: "empleado",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(empleado),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Empleado <strong>"+datos.empleado.nombre +"</strong> registrado correctamente.");
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
    
    $("#btn-guardar-detalle").click(function(e) {
        e.preventDefault();
        
        var empleado_detalle = {
            id: $("#id").val(),
            forma_pago: $("#forma_pago").val(),
            sueldo: $("#sueldo").val(),
            valor_hora: $("#valor_hora").val(),
            banco_tarjeta_cobro: $("#banco_tarjeta_cobro").val(),
            no_cuenta: $("#no_cuenta").val(),
            nss: $("#nss").val(),
            casado: $("input[name='r1']:checked").val(),
            nombre_esposa: $("#nombre_esposa").val(),
            telefono_esposa: $("#telefono_esposa").val(),
            casado: $("input[name='r1']:checked").val(),
            esposa_seguro: $("input[name='r2']:checked").val(),
            cantidad_dependientes: $("#cantidad_dependientes").val(),
            nombre_dependiente_1: $("#nombre_dependiente_0").val(),
            nombre_dependiente_2: $("#nombre_dependiente_1").val(),
            nombre_dependiente_3: $("#nombre_dependiente_2").val(),
            nombre_dependiente_4: $("#nombre_dependiente_3").val(),
            nombre_dependiente_5: $("#nombre_dependiente_4").val(),
            nombre_dependiente_6: $("#nombre_dependiente_5").val(),
            nombre_dependiente_7: $("#nombre_dependiente_6").val(),
            dependiente_1_nss: $("input[name='hijo_0']:checked").val(),
            dependiente_2_nss: $("input[name='hijo_1']:checked").val(),
            dependiente_3_nss: $("input[name='hijo_2']:checked").val(),
            dependiente_4_nss: $("input[name='hijo_3']:checked").val(),
            dependiente_5_nss: $("input[name='hijo_4']:checked").val(),
            dependiente_6_nss: $("input[name='hijo_5']:checked").val(),
            dependiente_7_nss: $("input[name='hijo_6']:checked").val(),
        };

        // console.log(JSON.stringify(empleado_detalle));
        
        $.ajax({
            url: "empleado/detalle",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(empleado_detalle),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Datos del empleado <strong>"+datos.empleado.nombre +"</strong> actualizadas correctamente.");
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

    $("#cantidad_dependientes").change(function(){
        let cantidad = $("#cantidad_dependientes").val()

        if(cantidad > 7){
            bootbox.alert("=(  No se puede registrar mas de 7 dependientes por empleado.");
        }else{
            for (let i = 0; i < cantidad; i++) {
                var fila =  "<tr >"+
                "<td><input type='text' name='nombre_dependiente_"+[i]+"' id='nombre_dependiente_"+[i]+"' class='form-control'></td>"+
                "<td class='text-center'><div class='custom-control custom-checkbox'>"+
                "<input class='custom-control-input' type='checkbox' id='hijo_"+[i]+"' value='1' name='hijo_"+[i]+"'>"+
                "<label for='hijo_"+[i]+"' class='custom-control-label'>Marcar si esta asegurado</label></div>"+
                "</td>"+
                "</tr>";

                $("#hijos").append(fila);
            }

              
        }

      
        
    });


    function listar() {
        tabla = $("#clients").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/empleados",
            dom: 'Bfrtip',
            iDisplayLength: 10,
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
                // { data: "codigo" },
                { data: "nombre" },
                { data: "departamento" },
                { data: "cargo" },
                { data: "tipo_contrato" },
                { data: "email" },
    
            ],
            order: [[4, 'asc']],
            rowGroup: {
                dataSrc: 'departamento'
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var empleado = {
            id: $("#id").val(),
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
            forma_pago: $("#forma_pago").val(),
            sueldo: $("#sueldo").val(),
            valor_hora: $("#valor_hora").val(),
            banco_tarjeta_cobro: $("#banco_tarjeta_cobro").val(),
            no_cuenta: $("#no_cuenta").val(),
            nss: $("#nss").val(),
            casado: $("input[name='r1']:checked").val(),
            nombre_esposa: $("#nombre_esposa").val(),
            telefono_esposa: $("#telefono_esposa").val(),
            casado: $("input[name='r1']:checked").val(),
            esposa_seguro: $("input[name='r2']:checked").val(),
            cantidad_dependientes: $("#cantidad_dependientes").val(),
            nombre_dependiente_1: $("#nombre_dependiente_0").val(),
            nombre_dependiente_2: $("#nombre_dependiente_1").val(),
            nombre_dependiente_3: $("#nombre_dependiente_2").val(),
            nombre_dependiente_4: $("#nombre_dependiente_3").val(),
            nombre_dependiente_5: $("#nombre_dependiente_4").val(),
            nombre_dependiente_6: $("#nombre_dependiente_5").val(),
            nombre_dependiente_7: $("#nombre_dependiente_6").val(),
            dependiente_1_nss: $("input[name='hijo_0']:checked").val(),
            dependiente_2_nss: $("input[name='hijo_1']:checked").val(),
            dependiente_3_nss: $("input[name='hijo_2']:checked").val(),
            dependiente_4_nss: $("input[name='hijo_3']:checked").val(),
            dependiente_5_nss: $("input[name='hijo_4']:checked").val(),
            dependiente_6_nss: $("input[name='hijo_5']:checked").val(),
            dependiente_7_nss: $("input[name='hijo_6']:checked").val(),
        };
        
        // console.log(JSON.stringify(empleado));
        $.ajax({
            url: "empleado/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(empleado),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Datos del empleado <strong>"+datos.empleado.nombre +"</strong> editados correctamente.");
                    $("#id").val("");
                    limpiar();
                    tabla.ajax.reload();
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
            $("#fila-address").show();
            $("#fila-bancaria").hide();
            $("#fila-dependientes").hide();
            $('.collapse').collapse('hide');
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
          
          
           
            $("#fila-detail").show();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#btn-guardar-detalle").hide();
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
