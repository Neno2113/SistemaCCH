$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#branchForm").validate({
        rules: {
            nombre_sucursal: {
                required: true,
                minlength: 5
            },
            telefono_sucursal: {
                required: true,
                minlength: 4
            },
            direccion:{
                required: true,
                minlength: 4
            }
        },
        messages: {
            nombre_sucursal: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 5 letras"
            },
            telefono_sucursal: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 4 letras"
            },
            direccion:{
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 4 letras"
            }
        }
    })


    var tabla;

    function init() {
        $("#provincia").select2();
        listar();
        // mostrarForm(false);
        $("#btn-edit-branch").hide();
        // $("#results").hide();


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
        $("#nombre_sucursal").val("").attr('readonly', false);
        $("#telefono_sucursal").val("").attr('readonly', false);
        $("#calle").val("").attr('readonly', false);
        $("#sector").val("").attr('readonly', false);
        $("#provincia").val("").trigger("change").attr('disabled', false);
        $("#sitios_cercanos").val("").attr('readonly', false);
        $("#clientes").val("").trigger("change");

    }

    $("#btn-guardar-branch").click(function(e) {
        e.preventDefault();

        var client_branch = {
            client_id : $("#clientes").val(),
            nombre_sucursal: $("#nombre_sucursal").val(),
            telefono_sucursal: $("#telefono_sucursal").val(),
            calle: $("#calle").val(),
            sector: $("#sector").val(),
            provincia: $("#provincia").val(),
            sitios_cercanos: $("#sitios_cercanos").val(),
        };

        $.ajax({
            url: "client-branch",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(client_branch),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Success',
                        'Sucursal creada correctamente.',
                        'success'
                        )
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la sucursal verifique los datos suministrados!!"
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
        tabla = $("#branches").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/branches",
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
                // { data: "Ver", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "nombre_cliente", name: 'cliente.nombre_cliente' },
                // { data: "codigo_sucursal", name: 'cliente_sucursales.codigo_sucursal' },
                { data: "nombre_sucursal", name: 'cliente_sucursales.nombre_sucursal' },
                { data: "telefono_sucursal", name: 'cliente_sucursales.telefono_sucursal' },
                { data: "provincia", name: 'cliente_sucursales.provincia' }
            ],
            order: [[2, 'asc']],
            rowGroup: {
                dataSrc: 'nombre_cliente'
            }
        });
    }

    $("#btn-edit-branch").click(function(e) {
        e.preventDefault();

        var client_branch = {
            id: $("#id").val(),
            client_id : $("#clientes").val(),
            nombre_sucursal: $("#nombre_sucursal").val(),
            telefono_sucursal: $("#telefono_sucursal").val(),
            calle: $("#calle").val(),
            sector: $("#sector").val(),
            provincia: $("#provincia").val(),
            sitios_cercanos: $("#sitios_cercanos").val(),

        };

        // console.log(JSON.stringify(client_branch));
        $.ajax({
            url: "client-branch/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(client_branch),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                    'Actualizacion',
                    'Sucursal actualizada correctamente.',
                    'success'
                    )
                    $("#id").val("");
                    limpiar();
                    tabla.ajax.reload();
                    $("#btn-edit").hide();
                    $("#btn-guardar-branch").show();
                    $("#exampleModal").modal('hide');

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la sucursal"
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

    // setInterval(function(){
    //     tabla.ajax.reload();
    // }, 30000)

    $("#btn-close").click(function(e){
        e.preventDefault();
        $("#id").val("");
        $("#nombre_sucursal").val("");
        $("#telefono_sucursal").val("");
        $("#direccion").val("");
        $("#clientes").val("");

    })

    $("#btn-agregar").click(function(e){
        e.preventDefault();
        $("#btn-edit-branch").hide();
        $("#btn-guardar-branch").show();
   })






    init();
});
