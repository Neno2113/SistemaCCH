let genero_global;
let plus_global;
let id;
let clienteId;
$(document).ready(function() {
    $("[data-mask]").inputmask();

    // $("#formulario").validate({
    //     rules: {
    //         nombre_cliente: {
    //             required: true,
    //             minlength: 3
    //         },
    //         direccion_principal: {
    //             required: true,
    //             minlength: 4
    //         },
    //         telefono_1: {
    //             required: true,
    //             minlength: 10
    //         },
    //         email_principal: {
    //             required: true,
    //             email: true
    //         },
    //         condiciones_credito: {
    //             required: true,
    //             minlengh: 1
    //         },
    //         rnc: {
    //             required: true,
    //             digits: true,
    //             minlengh: 9
    //         }
    //     },
    //     messages: {
    //         nombre_cliente: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 3 letras"
    //         },
    //         direccion_principal: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 4 letras"
    //         },
    //         telefono_1: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 10 caracteres"
    //         },
    //         email_principal: {
    //             required: "El email es obligatorio",
    //             email: "Debe itroducir un email valido"
    //         },
    //         condiciones_credito: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 1 caracter"
    //         },
    //         rnc:{
    //             required: "Este campo es obligatorio",
    //             minlengh: "Debe contener al menos 9 numeros",
    //             digits: "Este campo solo puedo contener numeros"

    //         }
    //     }
    // })


    var tabla;

    function init() {
        $("#provincia").select2();
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
        $("#results").hide();
        productos();

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

    $("#nombre_cliente").keyup(function(){
        let val =  $("#nombre_cliente").val();
        $("#nombre_cliente").val(val.toUpperCase());
    });


    const productos = () => {
        $.ajax({
            url: "select-product",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.productos.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila =  "<option value="+datos.productos[i].id +">"+datos.productos[i].referencia_producto+"</option>"

                        $("#productos").append(fila);
                    }
                    $("#productos").select2();

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
    }
    function limpiar() {
        $("#nombre_cliente").val("").attr('readonly', false);
        $("#codigo_cliente").val("").attr('readonly', false);
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
        $("#condiciones_credito").val("").attr('disabled', false);
        $("#autorizacion_credito_req").val("").attr('readonly', false);;
        $("#notas").val("").attr('readonly', false);;
        $("#redistribucion_tallas").val("").attr('readonly', false);;
        $("#factura_desglosada_talla").val("").attr('readonly', false);;
        $("#rnc").val("").attr('readonly', false);;
    }

    const limpiarDistri = () => {
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

    $("#btn-guardar").click(function(e) {
        // validacion(e);
        e.preventDefault();

        var client = {
            nombre_cliente: $("#nombre_cliente").val(),
            codigo_cliente: $("#codigo_cliente").val(),
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
                    Swal.fire(
                        'Success',
                        'Se ha creado el cliente correctamente.',
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

    $("#bntAgregar").on('click', () => {
        const distribucion = {
            producto: id,
            cliente: clienteId,
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

        }
        // console.log(distribucion);
        $.ajax({
            url: "client-distribution",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(distribucion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    limpiarDistri();
                    let fila = `
                    <tr id="fila${datos.distribucion.id}">
                    <th>${datos.distribucion.producto.referencia_producto}</th>
                    <td>${datos.distribucion.a}</td>
                    <td>${datos.distribucion.b}</td>
                    <td>${datos.distribucion.c}</td>
                    <td>${datos.distribucion.d}</td>
                    <td>${datos.distribucion.e}</td>
                    <td>${datos.distribucion.f}</td>
                    <td>${datos.distribucion.g}</td>
                    <td>${datos.distribucion.h}</td>
                    <td>${datos.distribucion.i}</td>
                    <td>${datos.distribucion.j}</td>
                    <td>${datos.distribucion.k}</td>
                    <td>${datos.distribucion.l}</td>
                    <td><button class="btn btn-danger" onclick='delDistribucion(${datos.distribucion.id})'><i class="fas fa-trash-alt"></i></button></td>
                    </tr>
                `;
                $("#fila").append(fila);
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
    })

    $("#btnAdd").on('click', () => {
        id = $("#productos").val();
        // ClienteProductoDistribucion(clienteId);
        let referencia = $("#productos option:selected").text();
        const producto = {
            id: id,
            cliente: clienteId
        };

        $.ajax({
            url: "distribution-check",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(producto),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    genero_global = referencia.substring(1,2);
                    plus_global = referencia.substr(3,1);
                    $("#refe").html(referencia);
                    // eliminarColumnas();
                   
                    
                    $("#porc_a").html(datos.a +" %");
                    $("#porc_b").html(datos.b +" %");
                    $("#porc_c").html(datos.c +" %");
                    $("#porc_d").html(datos.d +" %");
                    $("#porc_e").html(datos.e +" %");
                    $("#porc_f").html(datos.f +" %");
                    $("#porc_g").html(datos.g +" %");
                    $("#porc_h").html(datos.h +" %");
                    $("#porc_i").html(datos.i +" %");
                    $("#porc_j").html(datos.j +" %");
                    $("#porc_k").html(datos.k +" %");
                    $("#porc_l").html(datos.l +" %");

                    if (genero_global == "2") {
                        if(plus_global == "7"){
                        
                            $("#ta").html("12W");
                            $("#tb").html("14W");
                            $("#tc").html("16W");
                            $("#td").html("18W");
                            $("#te").html("20W");
                            $("#tf").html("22W");
                            $("#tg").html("24W");
                            $("#th").html("26W");
                    
                        }else{
                        
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
                    
                        }

                    }
                    if (genero_global == "3" || genero_global == "4") {
                        $("#ta").html("2");
                        $("#tb").html("4");
                        $("#tc").html("6");
                        $("#td").html("8");
                        $("#te").html("10");
                        $("#tf").html("12");
                        $("#tg").html("14");
                        $("#th").html("16");

                    }  else if (genero_global == "1") {
                    
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
                    
                    }


                   
                    
                } else {
                    Swal.fire(
                        'Info',
                        'Este producto ya esta agregado.',
                        'info'
                    )
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


        
        
      
       
    })

  

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
                { data: 'acepta_segundas' }

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
            codigo_cliente: $("#codigo_cliente").val(),
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
                    Swal.fire(
                        'Success',
                        'Se ha actualizado los datos del cliente correctamente.',
                        'success'
                        )
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

    $("#provincia").change(function(){
        $("#autorizaciones").show();
    });

    function mostrarForm(flag) {
        limpiar();
        limpiarDistri();
        if (flag) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#datosForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#autorizaciones").hide();
            $("#radios").show();
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#datosForm").hide();
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


        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else { 
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#datosForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#autorizacion_credito_req").show();
            $("#redistribucion_tallas").show();
            $("#factura_desglosada_tallas").show();
            $("#acepta_segundas").show();
            clienteId = id_client;
            ClienteProductoDistribucion(id_client);

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
            $("#codigo_cliente").val(data.client.codigo_cliente).attr('readonly', false);
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

        }

    });
}

const ClienteProductoDistribucion = (id) => {
    // console.log(id);
    if(id){
        const cliente = {
            id
        }

        $.ajax({
            url: "cliente-distribuciones",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(cliente),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    
                    for (let i = 0; i < datos.distribucion.length; i++) {
                        let fila =`
                        <tr id="fila${datos.distribucion[i].id}">
                        <th>${datos.distribucion[i].producto.referencia_producto}</th>
                        <td>${datos.distribucion[i].a}</td>
                        <td>${datos.distribucion[i].b}</td>
                        <td>${datos.distribucion[i].c}</td>
                        <td>${datos.distribucion[i].d}</td>
                        <td>${datos.distribucion[i].e}</td>
                        <td>${datos.distribucion[i].f}</td>
                        <td>${datos.distribucion[i].g}</td>
                        <td>${datos.distribucion[i].h}</td>
                        <td>${datos.distribucion[i].i}</td>
                        <td>${datos.distribucion[i].j}</td>
                        <td>${datos.distribucion[i].k}</td>
                        <td>${datos.distribucion[i].l}</td>
                        <td><button class="btn btn-danger" onclick='delDistribucion(${datos.distribucion[i].id})' ><i class="fas fa-trash-alt"></i></button></td>
                        </tr>
                        `
                        $("#fila").append(fila);
                    }
                    
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

    } 
  
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
    $.post("clientcheck/delete/" + id_client, function(data, status) {
        // console.log(data);
        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            Swal.fire({
                title: '¿Estas seguro de eliminar este cliente?',
                text: "Va a eliminar este cliente!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto'
              }).then((result) => {
                if (result.value) {
                    $.post("client/delete/" + id_client, function(data){
                        Swal.fire(
                        'Eliminado!',
                        'Cliente eliminado correctamente.',
                        'success'
                        )
                        $("#clients").DataTable().ajax.reload();
                    })
                }
              })
        }
    })
    // bootbox.confirm("", function(result){
    //     if(result){
    //         $.post("client/delete/" + id_client, function(){
    //             // bootbox.alert(e);
    //             bootbox.alert("Cliente eliminado correctamente!!");
    //             $("#clients").DataTable().ajax.reload();
    //         })
    //     }
    // })
}

function eliminarColumnas(){
    if(genero_global == 3 || genero_global == 4){
        $("td:nth-child(10) ,th:nth-child(10)").hide();
        $("td:nth-child(11),th:nth-child(11)").hide();
        $("td:nth-child(12),th:nth-child(12)").hide();
        $("td:nth-child(13),th:nth-child(13)").hide();

    }else if(genero_global == 1){
        $("td:nth-child(10) ,th:nth-child(10)").show();
        $("td:nth-child(11),th:nth-child(11)").show();

        $("td:nth-child(12),th:nth-child(12)").hide();
        $("td:nth-child(13),th:nth-child(13)").hide();
    }

    if(plus_global == 7){
        $("td:nth-child(10),th:nth-child(10)").hide();
        $("td:nth-child(11),th:nth-child(11)").hide();
        $("td:nth-child(12),th:nth-child(12)").hide();
        $("td:nth-child(13),th:nth-child(13)").hide();
    }
}


const delDistribucion = (id) => {
    Swal.fire({
        title: '¿Esta seguro de eliminar esta distribucion?',
        text: "Eliminar distribucion del producto al cliente",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("distribucion/delete/" + id, function(){
                Swal.fire(
                'Eliminada!',
                'Distribucion del producto eliminada correctamente.',
                'success'
                )
                $("#fila"+id).remove();
            })
        }
      })
}


