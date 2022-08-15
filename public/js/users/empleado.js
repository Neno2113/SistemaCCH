$(document).ready(function() {
    $("[data-mask]").inputmask();

    // $("#formulario").validate({
    //     rules: {
    //         nombre: {
    //             required: true,
    //             minlength: 3
    //         },
    //         apellido: {
    //             required: true,
    //             minlength: 4
    //         },
    //         cedula:{
    //             required: true,
    //             minlength: 11,

    //         },
    //         telefono_1: {
    //             required: true,
    //             minlength: 10
    //         },
    //         email: {
    //             required: true,
    //             email: true
    //         },
    //         calle: {
    //             required: true
    //         },
    //         provincia: {
    //             required: true
    //         }
    //     },
    //     messages: {
    //         nombre: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 3 letras"
    //         },
    //         apellido: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 4 letras"
    //         },
    //         cedula:{
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 11 digitos"

    //         },
    //         telefono_1: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 10 digitos"
    //         },
    //         email: {
    //             required: "El email es obligatorio",
    //             email: "Debe itroducir un email valido"
    //         },
    //         calle: {
    //             required: "Este campo es obligatorio"
    //         },
    //         provincia:{
    //             required: "Este campo es obligatorio",


    //         }
    //     }
    // })


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
        $("#forma_pago").val("").attr('disabled', false);
        $("#sueldo").val("").attr('readonly', false);
        $("#valor_hora").val("").attr('readonly', false);
        $("#banco_tarjeta_cobro").val("").attr('disabled', false);
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
        $("#nombre_dependiente_0").val("").attr('readonly', false);


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
            fecha_nacimiento: $("#fecha_nacimiento").val(),
            cedula: $("#cedula").val(),
            cedula_sin_guion: $("#cedula").val().replace(/\-/g,''),
            telefono_1: $("#telefono_1").val(),
            telefono_2: $("#telefono_2").val(),
            email: $("#email").val(),
            codigo: $("#codigo").val(),
           
            estado_civil: $("#estado_civil").val(),
            fecha_ingreso: $("#fecha_ingreso").val(),
            condicion_medica: $("#condicion_medica").val(),
            
            cantidad_dependientes: $("#cantidad_dependientes").val(),

            nombre_esposa: $("#nombre_esposa").val(),
            telefono_esposa: $("#telefono_esposa").val(),
            esposa_en_nss: $("#esposa_en_nss").val(),
            nombre_dependiente_0: $("#nombre_dependiente_0").val(),
            parentesco_dependiente_0: $("#parentesco_dependiente_0").val(),
            edad_dependiente_0: $("#edad_dependiente_0").val(),
            nombre_dependiente_1: $("#nombre_dependiente_1").val(),
            parentesco_dependiente_1: $("#parentesco_dependiente_1").val(),
            edad_dependiente_1: $("#edad_dependiente_1").val(),
            nombre_dependiente_2: $("#nombre_dependiente_2").val(),
            parentesco_dependiente_2: $("#parentesco_dependiente_2").val(),
            edad_dependiente_2: $("#edad_dependiente_2").val(),
            nombre_dependiente_3: $("#nombre_dependiente_3").val(),
            parentesco_dependiente_3: $("#parentesco_dependiente_3").val(),
            edad_dependiente_3: $("#edad_dependiente_3").val(),
            nombre_dependiente_4: $("#nombre_dependiente_4").val(),
            parentesco_dependiente_4: $("#parentesco_dependiente_4").val(),
            edad_dependiente_4: $("#edad_dependiente_4").val(),
            nombre_dependiente_5: $("#nombre_dependiente_5").val(),
            parentesco_dependiente_5: $("#parentesco_dependiente_5").val(),
            edad_dependiente_5: $("#edad_dependiente_5").val(),
            nombre_dependiente_6: $("#nombre_dependiente_6").val(),
            parentesco_dependiente_6: $("#parentesco_dependiente_6").val(),
            edad_dependiente_6: $("#edad_dependiente_6").val(),
            nombre_ref1: $("#nombre_ref1").val(),
            parentesco_ref1: $("#parentesco_ref1").val(),
            telefono_ref1: $("#telefono_ref1").val(),
            nombre_ref2: $("#nombre_ref2").val(),
            parentesco_ref2: $("#parentesco_ref2").val(),
            telefono_ref2: $("#telefono_ref2").val(),
            primaria: $("#primaria").val(),
            bachiller: $("#bachiller").val(),
            nivel_superior: $("#nivel_superior").val(),
            grado_titulo: $("#grado_titulo").val(),
            especialidad: $("#especialidad").val(),
            fecha_exp: $("#fecha_exp").val(),
            cargo_experiencia_1: $("#cargo_experiencia_1").val(),
            cargo_experiencia_2: $("#cargo_experiencia_2").val(),
            tiempo_experiencia_1: $("#tiempo_experiencia_1").val(),
            tiempo_experiencia_2: $("#tiempo_experiencia_2").val(),
            empresa_experiencia_1: $("#empresa_experiencia_1").val(),
            empresa_experiencia_2: $("#empresa_experiencia_2").val(),
            supervisor_experiencia_1: $("#supervisor_experiencia_1").val(),
            supervisor_experiencia_2: $("#supervisor_experiencia_2").val(),
            telefono_experiencia_1: $("#telefono_experiencia_1").val(),
            telefono_experiencia_2: $("#telefono_experiencia_2").val(),

            departamento: $("#departamento").val(),
            cargo: $("#cargo").val(),
            tipo_contrato: $("#tipo_contrato").val(),
            forma_pago: $("#forma_pago").val(),
            sueldo: $("#sueldo").val(),
            valor_hora: $("#valor_hora").val(),
            banco_tarjeta_cobro: $("#banco_tarjeta_cobro").val(),
            no_cuenta: $("#no_cuenta").val(),
            nss: $("#nss").val() 

        };

        $.ajax({
            url: "empleado",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(empleado),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                    'Emplado registrado!!',
                    'Empleado registrado correctamente.',
                    'success'
                    )
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
                    Swal.fire(
                        'Datos empleado guardados!!',
                        'Datos del empleado guardados correctamente.',
                        'success'
                        )
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
        $("#tr_dependiente_0").remove();
        $("#tr_dependiente_1").remove();
        $("#tr_dependiente_2").remove();
        $("#tr_dependiente_3").remove();
        $("#tr_dependiente_4").remove();
        $("#tr_dependiente_5").remove();
        $("#tr_dependiente_6").remove();
        let cantidad = $("#cantidad_dependientes").val()

        if(cantidad > 7){
            bootbox.alert("=(  No se puede registrar mas de 7 dependientes por empleado.");
        }else{
            for (let i = 0; i < cantidad; i++) {
                var fila =  "<tr id='tr_dependiente_"+[i]+"'>"+
                "<td><input type='text' name='nombre_dependiente_"+[i]+"' id='nombre_dependiente_"+[i]+"' class='form-control'></td>"+
                "<td><select name='parentesco_dependiente_"+[i]+"' id='parentesco_dependiente_"+[i]+"' class='form-control'><option value='' disabled>Parentesco</option><option>Padre</option><option>Madre</option><option>Hijo</option><option>Hija</option><option>Esposa</option><option>Esposo</option></select></td>"+
                "<td><input type='number' name='edad_dependiente_"+[i]+"' id='edad_dependiente_"+[i]+"' class='form-control'></td>"+
             //   "<td class='text-center'><div class='custom-control custom-checkbox'>"+
             //   "<input class='custom-control-input' type='checkbox' id='hijo_"+[i]+"' value='1' name='hijo_"+[i]+"'>"+
            //    "<label for='hijo_"+[i]+"' class='custom-control-label'>Marcar si esta asegurado</label></div>"+
            //    "</td>"+
                "</tr>";

                $("#hijos").append(fila);
            }


        }



    });


    function listar() {
        tabla = $("#clients").DataTable({
            serverSide: true,
            responsive: true,
            ajax:{
                "url": "api/empleados",
                "type": "POST"
            },
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
                { data: "Opciones", orderable: false, searchable: false },
                { data: "nombre" },
                { data: "departamento" },
                { data: "cargo" },
                { data: "tipo_contrato" },
                { data: "email" },
                { data: "fecha_nacimiento" },

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
            fecha_nacimiento: $("#fecha_nacimiento").val(),
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
                    Swal.fire(
                        'Actualizacion',
                        'Empleado actualizado correctamente.',
                        'success'
                        )
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
            $("#fila-bancaria").show();
            $("#fila-dependientes").show();
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

function mostrar(id_empleado) {
    $.get("empleado/" + id_empleado, function(data, status) {

        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {

        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").show();
        $("#btn-guardar").hide();
        $("#btn-edit").show();
        $("#btn-guardar").hide();
        $("#btn-guardar-detalle").hide();
        $("#fila-dependientes").show();
        $("#fila-bancaria").show();
        $("#fila-address").show();
        $("#fila-detail").show();


        $("#id").val(data.empleado.id);
        $("#nombre").val(data.empleado.nombre).attr('readonly', false);
        $("#apellido").val(data.empleado.apellido).attr('readonly', false);
        $("#cedula").val(data.empleado.cedula).attr('readonly', false);
        $("#calle").val(data.empleado.calle).attr('readonly', false);
        $("#sector").val(data.empleado.sector).attr('readonly', false);
        $("#provincia").val(data.empleado.provincia).trigger("change").attr('disabled', false);
        $("#sitios_cercanos").val(data.empleado.sitios_cercanos).attr('readonly', false);
        $("#email").val(data.empleado.email).attr('readonly', false);
        $("#fecha_nacimiento").val(data.empleado.fecha_nacimiento).attr('readonly', false);
        $("#telefono_1").val(data.empleado.telefono_1).attr('readonly', false);
        $("#telefono_2").val(data.empleado.telefono_2).attr('readonly', false);
        $("#departamento").val(data.empleado.departamento).trigger("change").attr('disabled', false);
        $("#cargo").val(data.empleado.cargo).trigger("change").attr('disabled', false);
        $("#tipo_contrato").val(data.empleado.tipo_contrato).attr('disabled', false);
        $("#forma_pago").val(data.empleado.forma_pago).attr('disabled', false);
        $("#sueldo").val(data.empleado.sueldo).attr('readonly', false);
        $("#valor_hora").val(data.empleado.valor_hora).attr('readonly', false);
        $("#banco_tarjeta_cobro").val(data.empleado.banco_tarjeta_cobro).trigger("change").attr('disabled', false);
        $("#no_cuenta").val(data.empleado.no_cuenta).attr('readonly', false);
        $("#nss").val(data.empleado_detalle.nss).attr('readonly', false);
        $("#nombre_esposa").val(data.empleado_detalle.nombre_esposa).attr('readonly', false);
        $("#telefono_esposa").val(data.empleado_detalle.telefono_esposa).attr('readonly', false);
        $("#cantidad_dependientes").val(data.empleado_detalle.cantidad_dependientes).attr('readonly', false);
        $("#nombre_dependiente_1").val(data.empleado_detalle.nombre_dependiente_1).attr('readonly', false);
        $("#hijos").empty();

        let longitud  = data.empleado_detalle.cantidad_dependientes;

        for (let i = 0; i < longitud; i++) {
        var fila =  "<tr >"+
        "<td><input type='text' name='nombre_dependiente_"+[i]+"' id='nombre_dependiente_"+[i]+"' class='form-control'></td>"+
        "<td class='text-center'><div class='custom-control custom-checkbox'>"+
        "<input class='custom-control-input' type='checkbox' id='hijo_"+[i]+"' value='1' name='hijo_"+[i]+"'>"+
        "<label for='hijo_"+[i]+"' class='custom-control-label font-weight-normal'>Marcar si esta asegurado</label></div>"+
        "</td>"+
        "</tr>";

        $("#hijos").append(fila);
        }
        $("#nombre_dependiente_0").val(data.empleado_detalle.nombre_dependiente_1).attr('readonly', false);
        $("#nombre_dependiente_1").val(data.empleado_detalle.nombre_dependiente_2).attr('readonly', false);
        $("#nombre_dependiente_2").val(data.empleado_detalle.nombre_dependiente_3).attr('readonly', false);
        $("#nombre_dependiente_3").val(data.empleado_detalle.nombre_dependiente_4).attr('readonly', false);
        $("#nombre_dependiente_4").val(data.empleado_detalle.nombre_dependiente_5).attr('readonly', false);
        $("#nombre_dependiente_5").val(data.empleado_detalle.nombre_dependiente_6).attr('readonly', false);
        $("#nombre_dependiente_6").val(data.empleado_detalle.nombre_dependiente_7).attr('readonly', false);

        if(data.empleado_detalle.dependiente_1_nss == 1){
            $("input[name='hijo_0']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_2_nss == 1){
            $("input[name='hijo_1']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_3_nss == 1){
            $("input[name='hijo_2']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_4_nss == 1){
            $("input[name='hijo_3']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_5_nss == 1){
            $("input[name='hijo_4']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_6_nss == 1){
            $("input[name='hijo_5']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_7_nss == 1){
            $("input[name='hijo_6']").prop('checked', true);
        }
    }

    });
}

function show(id_empleado) {
    $.get("empleado/" + id_empleado, function(data, status) {

        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").hide();
        $("#btn-guardar").hide();
        $("#btn-guardar-detalle").show();
        $("#fila-dependientes").show();
        $("#fila-bancaria").show();
        $("#fila-address").hide();
        $("#fila-detail").hide();

        $("#id").val(data.empleado.id);
        $("#nombre").val(data.empleado.nombre).attr('readonly', true);
        $("#apellido").val(data.empleado.apellido).attr('readonly', true);
        $("#cedula").val(data.empleado.cedula).attr('readonly', true);

    });
}


function ver(id_empleado) {
    $.get("empleado/" + id_empleado, function(data, status) {

        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").show();
        $("#btn-guardar").hide();
        $("#btn-edit").hide();
        $("#btn-guardar").hide();
        $("#btn-guardar-detalle").hide();
        $("#fila-dependientes").show();
        $("#fila-bancaria").show();
        $("#fila-address").show();
        $("#fila-detail").show();


        $("#nombre").val(data.empleado.nombre).attr('readonly', true);
        $("#apellido").val(data.empleado.apellido).attr('readonly', true);
        $("#cedula").val(data.empleado.cedula).attr('readonly', true);
        $("#calle").val(data.empleado.calle).attr('readonly', true);
        $("#sector").val(data.empleado.sector).attr('readonly', true);
        $("#provincia").val(data.empleado.provincia).trigger("change").attr('disabled', true);
        $("#sitios_cercanos").val(data.empleado.sitios_cercanos).attr('readonly', true);
        $("#email").val(data.empleado.email).attr('readonly', true);
        $("#telefono_1").val(data.empleado.telefono_1).attr('readonly', true);
        $("#telefono_2").val(data.empleado.telefono_2).attr('readonly', true);
        $("#departamento").val(data.empleado.departamento).trigger("change").attr('disabled', true);;
        $("#cargo").val(data.empleado.cargo).trigger("change").attr('disabled', false);
        $("#tipo_contrato").val(data.empleado.tipo_contrato).attr('disabled', true);
        $("#forma_pago").val(data.empleado.forma_pago).attr('disabled', true);
        $("#sueldo").val(data.empleado.sueldo).attr('readonly', true);
        $("#valor_hora").val(data.empleado.valor_hora).attr('readonly', true);
        $("#banco_tarjeta_cobro").val(data.empleado.banco_tarjeta_cobro).trigger("change").attr('disabled', true);
        $("#no_cuenta").val(data.empleado.no_cuenta).attr('readonly', true);
        $("#nss").val(data.empleado_detalle.nss).attr('readonly', true);
        $("#nombre_esposa").val(data.empleado_detalle.nombre_esposa).attr('readonly', true);
        $("#telefono_esposa").val(data.empleado_detalle.telefono_esposa).attr('readonly', true);
        $("#cantidad_dependientes").val(data.empleado_detalle.cantidad_dependientes).attr('readonly', true);
        $("#hijos").empty();

        let longitud  = data.empleado_detalle.cantidad_dependientes;

        for (let i = 0; i < longitud; i++) {
            var fila =  "<tr >"+
            "<td><input type='text' name='nombre_dependiente_"+[i]+"' id='nombre_dependiente_"+[i]+"' class='form-control'></td>"+
            "<td class='text-center'><div class='custom-control custom-checkbox'>"+
            "<input class='custom-control-input' type='checkbox' id='hijo_"+[i]+"' value='1' name='hijo_"+[i]+"'>"+
            "<label for='hijo_"+[i]+"' class='custom-control-label font-weight-normal'>Marcar si esta asegurado</label></div>"+
            "</td>"+
            "</tr>";

            $("#hijos").append(fila);
        }
        $("#nombre_dependiente_0").val(data.empleado_detalle.nombre_dependiente_1).attr('readonly', true);
        $("#nombre_dependiente_1").val(data.empleado_detalle.nombre_dependiente_2).attr('readonly', true);
        $("#nombre_dependiente_2").val(data.empleado_detalle.nombre_dependiente_3).attr('readonly', true);
        $("#nombre_dependiente_3").val(data.empleado_detalle.nombre_dependiente_4).attr('readonly', true);
        $("#nombre_dependiente_4").val(data.empleado_detalle.nombre_dependiente_5).attr('readonly', true);
        $("#nombre_dependiente_5").val(data.empleado_detalle.nombre_dependiente_6).attr('readonly', true);
        $("#nombre_dependiente_6").val(data.empleado_detalle.nombre_dependiente_7).attr('readonly', true);


        if(data.empleado_detalle.dependiente_1_nss == 1){
            $("input[name='hijo_0']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_2_nss == 1){
            $("input[name='hijo_1']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_3_nss == 1){
            $("input[name='hijo_2']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_4_nss == 1){
            $("input[name='hijo_3']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_5_nss == 1){
            $("input[name='hijo_4']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_6_nss == 1){
            $("input[name='hijo_5']").prop('checked', true);
        }
        if(data.empleado_detalle.dependiente_7_nss == 1){
            $("input[name='hijo_6']").prop('checked', true);
        }


    });
}

function eliminar(id_client){
    $.post("empleadocheck/delete/" + id_client, function(data, status) {
        // console.log(data);
        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            Swal.fire({
                title: '¿Esta seguro de eliminar este empleado?',
                text: "Va a eliminar este empleado de manera permanente!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto'
              }).then((result) => {
                if (result.value) {
                    $.post("empleado/delete/" + id_client, function(){
                        Swal.fire(
                        'Eliminado!',
                        'Usuario eliminado de manera correcta.',
                        'success'
                        )
                        $("#clients").DataTable().ajax.reload();
                    })
                }
              })
        }
   
    })
    
}
