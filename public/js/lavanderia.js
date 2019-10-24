$(document).ready(function() {

    $("#formulario").validate({
        rules: {
            codigo_composicion: {
                required: true,
                minlength: 1
            },
            nombre_composicion: {
                required: true,
                minlength: 1
            },
          
        },
        messages: {
            codigo_composicion: {
                required: "Introduzca el codigo de composicion",
                minlength: "Debe contener al menos 1 letra"
            },
            nombre_composicion: {
                required: "Introduzca el nombre de composicion",
                minlength: "Debe contener al menos 1 letra"
            }
        }
    })
   

    var tabla

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

    function limpiar() {
        $("#numero_envio").val("");
        $("#fecha_envio").val("");
        $("#receta_lavado").val("");
        $("#cantidad").val("");
        $("#estandar_incluido").val("");
        $("#productos").val("").trigger("change");
        $("#corteSearch").val("").trigger("change");
        $("#suplidores").val("").trigger("change");
     
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
        placeholder: "Buscar un numero de corte...",
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
            cache: true
        }
    })

    $("#suplidores").select2({
        placeholder: "Buscar una lavanderia...",
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


    $("#btn-guardar").click(function(e){
        e.preventDefault();
        
        var lavanderia = {
            sec: $("#sec").val(),
            numero_envio: $("#numero_envio").val(),
            producto_id: $("#productos").val(),
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
        tabla = $("#lavanderias").DataTable({
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
            ajax: "api/lavanderias",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "numero_envio", name: "lavanderia.numero_envio" },
                { data: "numero_corte", name: "corte.numero_corte" },
                { data: "referencia_producto", name: "producto.referencia_producto" },
                { data: "fecha_envio", name: "lavanderia.fecha_envio" },
                { data: "cantidad", name: "lavanderia.cantidad" },
                { data: "nombre", name: "suplidor.nombre" },
                { data: "fase", name: "corte.fase" },
                { data: "receta_lavado", name: "lavanderia.receta_lavado" },
                { data: "estandar_incluido", name: "lavanderia.estandar_incluido" },
              
            ]
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var lavanderia = {
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
            $("#corteEdit").hide();
            $("#productoEdit").hide();
            $("#estandar_incluido").hide();
            $("#lavanderia").hide();
        }
    }

    $("#btnAgregar").click(function(e) {
        mostrarForm(true);
        $("#cortes").show();
        $("#corteEdit").hide();
        $("#productos").show();
        $("#productoEdit").hide();
        $("#lavanderia").hide();
        $("#suplidor").show();
    });
    $("#btnCancelar").click(function(e) {
        mostrarForm(false);
    });
  

    init();
});
