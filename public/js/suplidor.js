$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#formulario").validate({
        rules: {
            nombre: {
                required: true,
                minlength: 2
            },
            direccion: {
                required: true,
                minlength: 5
            },
            contacto_suplidor: {
                required: true,
                minlength: 4
            },
            telefono_1: {
                required: true,
                minlength: 10
            },
            email: {
                required: true,
                minlength: 4
            },
            terminos_de_pago: {
                required: true
            }
        },
        messages: {
            nombre: {
                required: "El nombre es obligatorio",
                minlength: "Debe contener al menos 2 letras"
            },
            direccion: {
                required: "La direccion es obligatoria",
                minlength: "Debe contener al menos 5 letras"
            },
            contacto_suplidor: {
                required: "El contacto del suplidor es obligatorio",
                minlength: "Debe contener al menos 4 letras"
            },
            telefono_1: {
                required: "El telefono de contacto es obligatorio",
                minlength: "Debe contener al menos 10 caracteres"
            },
            email: {
                required: "El email es obligatorio",
                minlength: "El email debe tener al menos 4 caracteres"
            },
            terminos_de_pago: {
                required: "El termino de pago de suplidor es obligatorio"
            }
        }
    })
   

    var tabla;

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

    function limpiar() {
        $("#nombre").val("");
        $("#direccion").val("");
        $("#contacto_suplidor").val("");
        $("#telefono_1").val("");
        $("#telefono_2").val("");
        $("#celular").val("");
        $("#email").val("");
        $("#terminos_de_pago").val("");
        $("#nota").val("");
        $("#rnc").val("");
    }

    $("#btn-guardar").click(function(e) {
        
        e.preventDefault();
        
        var suplidor = {
            nombre: $("#nombre").val(),
            rnc: $("#rnc").val(),
            direccion: $("#direccion").val(),
            contacto_suplidor: $("#contacto_suplidor").val(),
            telefono_1: $("#telefono_1").val(),
            telefono_2: $("#telefono_2").val(),
            celular: $("#celular").val(),
            email: $("#email").val(),
            tipo_suplidor: $("#tipo_suplidor").val(),
            terminos_de_pago: $("#terminos_de_pago").val(),
            nota: $("#nota").val()
        };

        $.ajax({
            url: "supplier",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(suplidor),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se registro correctamente el suplidor");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante el registro del suplidor"
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
        tabla = $("#suppliers").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/suppliers",
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
                { data: "Ver", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "nombre" },
                { data: "tipo_suplidor" },
                { data: "rnc" },
                { data: "contacto_suplidor" },
                { data: "email" },
                { data: "terminos_de_pago" },
            ],
            order: [[4, 'asc']],
            rowGroup: {
                dataSrc: 'tipo_suplidor'
            }
        });
    }
   
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var suplidor = {
            id: $("#id").val(),
            nombre: $("#nombre").val(),
            rnc: $("#rnc").val(),
            direccion: $("#direccion").val(),
            contacto_suplidor: $("#contacto_suplidor").val(),
            telefono_1: $("#telefono_1").val(),
            telefono_2: $("#telefono_2").val(),
            celular: $("#celular").val(),
            email: $("#email").val(),
            tipo_suplidor: $("#tipo_suplidor").val(),
            terminos_de_pago: $("#terminos_de_pago").val(),
            nota: $("#nota").val()
        };

        $.ajax({
            url: "supplier/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(suplidor),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizo el suplidor correctamente");
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
                        "Ocurrio un error durante la actualizacion del suplidor"
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
            $("#btn-edit").hide();
            $("#btn-guardar").show();
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
