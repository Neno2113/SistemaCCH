$(document).ready(function() {
    $("[data-mask]").inputmask();

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

    $("#formulario").submit( function(e){
        var nombre = $("#name").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var role = $("#role").val();
        var error = $("#error").val();
        e.preventDefault();

        if(nombre.val == '' || nombre.val == null){
            bootbox.alert("EL nombre esta vacio");
            // error.addClass("block");
            // error.innerHTML=error.innerHTML + '<li>Por favor complete el correo</li>';
        }
    });

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
                    "Ocurrio un error durante la creacion del usuario verifique los datos suministrados!!"
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
