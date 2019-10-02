$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#formulario").validate({
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            surname: {
                required: true,
                minlength: 4
            },
            edad: "required",
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            }
        },
        messages: {
            name: {
                required: "Introduzca el nombre",
                minlength: "Debe contener al menos 3 letras"
            },
            surname: {
                required: "Introduzca el apellido",
                minlength: "Debe contener al menos 4 letras"
            },
            edad: "La edad es obligatoria",
            email: {
                required: "El email es obligatorio",
                email: "Debe itroducir un email valido"
            },
            password: {
                required: "La contraseña es obligatoria",
                minlength: "Debe contener al menos 8 caracteres"
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
        $("#name").val("");
        $("#surname").val("");
        $("#edad").val("");
        $("#telefono").val("");
        $("#celular").val("");
        $("#direccion").val("");
        $("#email").val("");
        $("#role").val("");
        $("#password").val("");
    }

    $("#btn-guardar").click(function(e) {
        // validacion(e);
        e.preventDefault();
        
        var user = {
            name: $("#name").val(),
            surname: $("#surname").val(),
            email: $("#email").val(),
            edad: $("#edad").val(),
            telefono: $("#telefono").val(),
            celular: $("#celular").val(),
            direccion: $("#direccion").val(),
            role: $("#role").val(),
            password: $("#password").val()
        };

        $.ajax({
            url: "user",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(user),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se registro y creo usuario correctamente");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion del usuario verifique los datos suministrados!!"
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
        tabla = $("#users").DataTable({
            serverSide: true,
            ajax: "api/users",
            columns: [
                { data: "id" },
                { data: "name" },
                { data: "surname" },
                { data: "email" },
                { data: "role" },
                { data: "telefono" },
                { data: "celular" },
                { data: "direccion" },
                { data: "edad" },
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false }
            ]
        });
    }
    setInterval(function(){
        tabla.ajax.reload();
    }, 30000)

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
