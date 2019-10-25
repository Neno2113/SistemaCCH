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
        $("#fecha_recepcion").val("");
        $("#cantidad_recibida").val("");
        $("#cortesSearch").val("").trigger("change");
        $("#lavanderias").val("").trigger("change");
    }

    $("#cortesSearch").select2({
        placeholder: "Buscar un numero de corte Ex:2019-xxx",
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

    $("#lavanderias").select2({
        placeholder: "Buscar un numero de envio Ex:EL-xxx",
        ajax: {
            url: 'lavanderia_rec',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.numero_envio,
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
        
        var recepcion = {
            corte_id: $("#cortesSearch").val(),
            id_lavanderia: $("#lavanderias").val(),
            fecha_recepcion: $("#fecha_recepcion").val(),
            cantidad_recibida: $("#cantidad_recibida").val(),
            estandar_recibido: $("input[name='r1']:checked").val(),
        };


        $.ajax({
            url: "recepcion",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(recepcion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Hi!! here goes almost everything important from the form of Lavanderia");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function(datos) {
                console.log(datos.responseJSON.message);
               
                bootbox.alert(
                    "Error: "+ datos.responseJSON.message
                );
            }
        });
    });

    function listar() {
        tabla = $("#compositions").DataTable({
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
            ajax: "api/compositions",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "id" },
                { data: "nombre_composicion" },
              
            ]
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var composition = {
            id: $("#id").val(),
            codigo_composicion: $("#codigo_composicion").val(),
            nombre_composicion: $("#nombre_composicion").val()
        };
     
        $.ajax({
            url: "composition/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(composition),
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
