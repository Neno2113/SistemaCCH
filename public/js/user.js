$(document).ready(function() {
    $("[data-mask]").inputmask();

    function init() {
        listar();
        mostrarForm(false);
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
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion del usuario verifique los datos suministrados!!"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error durante la creacion del usuario verifique los datos suministrados!!"
                );
            }
        });
    });

    function listar() {
        var tabla = $("#users").DataTable({
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
                { data: "Editar" }
            ]
        });
    }

    function mostrarForm(flag){
        limpiar();
        if(flag){
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
          
        }else{
            $("#listadoUsers").show();
            $("#registroForm").hide()
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
        }
    }

    $("#btnAgregar").click(function(e){
        mostrarForm(true);
    })
    $("#btnCancelar").click(function(e){
        mostrarForm(false);
    })

    init();
});
