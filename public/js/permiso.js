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
                required: "Introduzca el name",
                minlength: "Debe contener al menos 3 letras"
            },
            surname: {
                required: "Introduzca el surname",
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
        usuarios();
        mostrarForm(false);
        $("#btn-edit").hide();
        $("#permisos").select2();
    }


    function usuarios (){

        $.ajax({
            url: "usuarios",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.usuarios.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila =  "<option value="+datos.usuarios[i].id +">"+datos.usuarios[i].name+" "+datos.usuarios[i].surname+"</option>"

                        $("#usuario").append(fila);
                    }
                    $("#usuario").select2();

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
        $("#name").val("").attr('readonly', false);
        $("#surname").val("").attr('readonly', false);
        $("#edad").val("").attr('readonly', false);
        $("#telefono").val("").attr('readonly', false);
        $("#celular").val("").attr('readonly', false);
        $("#direccion").val("").attr('readonly', false);
        $("#email").val("").attr('readonly', false);
        $("#role").val("").attr('disabled', false);
        $("#password").val("").attr('readonly', false);
        $("#ver-contra").show();
    }

    $("#btn-guardar").click(function(e) {
        // validacion(e);
        e.preventDefault();

        var permiso = {
            permiso: $("#permisos").val(),
            usuario: $("#usuario").val()
        };

        console.log(JSON.stringify(permiso));

        $.ajax({
            url: "permiso",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(permiso),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Permiso de acceso agregado");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion del usuario verifique los datos suministrados!!"
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
        tabla = $("#users").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/permisos",
            dom: 'Bfrtip',
            iDisplayLength: 5,
            buttons: [
                'pageLength',
                'copyHtml5',
                 {
                    extend: 'excelHtml5',
                    autoFilter: true,
                    sheetnombre: 'Exported data'
                },
                'csvHtml5',
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }
                ],
            columns: [
                { data: "Opciones", orderable: false, searchable: false },
                { data: "name", name: 'users.name'},
                { data: "permiso", name: 'permiso_usuario.permiso'},
                { data: "role", name: 'users.role'},
                { data: "email", name: 'users.email'}
            ],
            order: [[1, 'asc']],
            rowGroup: {
                dataSrc: 'name'
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();
        var user = {
            id: $("#id").val(),
            nombre: $("#name").val(),
            apellido: $("#surname").val(),
            email: $("#email").val(),
            edad: $("#edad").val(),
            telefono: $("#telefono").val(),
            celular: $("#celular").val(),
            direccion: $("#direccion").val(),
            role: $("#role").val(),
            password: $("#password").val()
        };

        $.ajax({
            url: "user/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(user),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el usuario");
                    $("#id").val("");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                    // $("#listadoUsers").show();
                    // $("#registroForm").hide();
                    // $("#btnCancelar").hide();
                    // $("#btn-edit").hide();
                    // $("#btn-guardar").show();
                    // $("#btnAgregar").show();

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
    // setInterval(function(){
    //     tabla.ajax.reload();
    // }, 30000)

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
        e.preventDefault();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        mostrarForm(false);
    });


    init();
});