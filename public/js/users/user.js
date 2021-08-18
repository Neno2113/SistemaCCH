$(document).ready(function() {
    $("[data-mask]").inputmask();

    // $("#formulario").validate({
    //     rules: {
    //         name: {
    //             required: true,
    //             minlength: 3
    //         },
    //         surname: {
    //             required: true,
    //             minlength: 4
    //         },
    //         edad: "required",
    //         email: {
    //             required: true,
    //             email: true
    //         },
    //         password: {
    //             required: true,
    //             minlength: 8
    //         }
    //     },
    //     messages: {
    //         name: {
    //             required: "Introduzca el name",
    //             minlength: "Debe contener al menos 3 letras"
    //         },
    //         surname: {
    //             required: "Introduzca el surname",
    //             minlength: "Debe contener al menos 4 letras"
    //         },
    //         edad: "La edad es obligatoria",
    //         email: {
    //             required: "El email es obligatorio",
    //             email: "Debe itroducir un email valido"
    //         },
    //         password: {
    //             required: "La contraseña es obligatoria",
    //             minlength: "Debe contener al menos 8 caracteres"
    //         }
    //     }
    // })


    var tabla;

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

    function limpiar() {
        $("#name").val("").attr('readonly', false);
        $("#surname").val("").attr('readonly', false);
        $("#fecha_nacimiento").val("2000-01-01").attr('readonly', false);
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

        var user = {
            nombre: $("#name").val(),
            apellido: $("#surname").val(),
            email: $("#email").val(),
            fecha_nacimiento: $("#fecha_nacimiento").val(),
            telefono: $("#telefono").val(),
            celular: $("#celular").val(),
            direccion: $("#direccion").val(),
            role: $("#role").val(),
            password: $("#password").val(),
            avatar: $("#image_name").val()
        };

        $.ajax({
            url: "user",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(user),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Usuario creado!!',
                        'Usuario registrado y creado correctamente.',
                        'success'
                    )
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
            ajax:{
                "url": "api/users",
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
                { data: "Expandir", orderable: false, searchable: false },
                { data: "eliminar", orderable: false, searchable: false },
                { data: "editar", orderable: false, searchable: false },
                { data: "name" },
                { data: "surname" },
                { data: "email" },
                { data: "role" },
                { data: "fecha_nacimiento" },
                { data: "celular" },
                { data: "status", orderable: false, searchable: false },
            ],
            order: [[6, 'asc']],
            rowGroup: {
                dataSrc: 'role'
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
            fecha_nacimiento: $("#fecha_nacimiento").val(),
            telefono: $("#telefono").val(),
            celular: $("#celular").val(),
            direccion: $("#direccion").val(),
            role: $("#role").val(),
            password: $("#password").val(),
            avatar: $("#image_name").val()
        };

        $.ajax({
            url: "user/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(user),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Usuario actualizado!!',
                        'Usuario actualizado correctamente.',
                        'success'
                    )
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

    $("#formUpload").submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        // console.log( JSON.stringify(formData));
        $.ajax({
            url: "avatar",
            type: "POST",
            data: formData,
            dataType: "JSON",
            processData: false,
            cache: false,
            contentType: false,
            success: function(datos) {
                if (datos.status == "success") {

                    $("#avatar").val("");
                    $("#image_name").val(datos.avatar);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function(datos) {
                console.log(datos.responseJSON.message);
                let errores = datos.responseJSON.message;

                Object.entries(errores).forEach(([key, val]) => {
                    bootbox.alert({
                        message:
                            "<h4 class='invalid-feedback d-block'>" +
                            val +
                            "</h4>",
                        size: "small"
                    });
                });
            }
        });
    });

    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#userForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#avatar-img").hide();
        } else {
            $("#listadoUsers").show();
            $("#alerts").hide();
            $("#registroForm").hide();
            $("#userForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
        }
    }


    $("#btn-upload").click(function(e) {
        // e.preventDefault();
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            type: 'success',
            title: 'Imagen cargada.'
        })
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

$("#btnConfirm").on('click', (e) => {
    e.preventDefault();
   
    const password = {
        vieja: $("#vieja").val(),
        nueva: $("#nueva").val(),
        confirmar: $("#confirmar").val()
    }
    // console.log(password);
    $.ajax({
        url: "confirm-password",
        type: "POST",
        dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: JSON.stringify(password),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                // location.reload();
                Swal.fire(
                    'contraseña actualizada',
                    'La proxima vez para accesar debe escribir su contraseña nueva.',
                    'success'
                )
             
                setInterval(() => {
                    window.location = './home';
                }, 5000);
               
            } else if(datos.status == 'validation') {
                Swal.fire(
                    'Error',
                    'Las contraseñas digitadas no coincicen.',
                    'error'
                )
            } else if(datos.status == 'validationBoth'){
                Swal.fire(
                    'Error',
                    'La contraseña actual no coincide.',
                    'error'
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

function mostrar(id_user) {
    $.post("user/" + id_user, function(data, status) {
           
        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {

            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#userForm").show();
            $("#btnCancelar").show();
            $("#btn-edit").show();
            $("#btnAgregar").hide();
            $("#btn-guardar").hide();
            $("#ver-contra").show();
            $("#avatar-img").show();
            $("#alerts").show();

            // console.log(data);
            $("#id").val(data.user.id);
            $("#name").val(data.user.name).attr('readonly', false);
            $("#surname").val(data.user.surname).attr('readonly', false);
            $("#fecha_nacimiento").val(data.user.fecha_nacimiento).attr('readonly', false);
            $("#telefono").val(data.user.telefono).attr('readonly', false);
            $("#celular").val(data.user.celular).attr('readonly', false);
            $("#direccion").val(data.user.direccion).attr('readonly', false);
            $("#email").val(data.user.email).attr('readonly', false);
            $("#role").val(data.user.role).attr('disabled', false);
            $("#avatar-img").attr("src", '/sistemaCCH/public/avatar/'+data.user.avatar)
            $("#image_name").val(data.user.avatar);
        }
    });
}


function ver(id_user) {
    $.post("user/" + id_user, function(data, status) {
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-guardar").hide();


        $("#name").val(data.user.name).attr('readonly', true);
        $("#ver-contra").hide();
        $("#surname").val(data.user.surname).attr('readonly', true);
        $("#fecha_nacimiento").val(data.user.fecha_nacimiento).attr('readonly', true);
        $("#telefono").val(data.user.telefono).attr('readonly', true);
        $("#celular").val(data.user.celular).attr('readonly', true);
        $("#direccion").val(data.user.direccion).attr('readonly', true);
        $("#email").val(data.user.email).attr('readonly', true);
        $("#role").val(data.user.role).attr('disabled', true);
    });
}


function eliminar(id_user){
    $.post("usercheck/delete/" + id_user, function(data, status) {
        console.log(data);
        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            Swal.fire({
                title: '¿Esta seguro de eliminar este usuario?',
                text: "Va a eliminar este usuario!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto'
              }).then((result) => {
                if (result.value) {
                    $.post("user/delete/" + id_user, function(data){
                        Swal.fire(
                        'Eliminado!',
                        'Usuario eliminado correctamente.',
                        'success'
                        )
                        $("#users").DataTable().ajax.reload();
                    })
                }
              })
        }
    })
   
}

const activar = (id) => {
    Swal.fire({
        title: '¿Esta seguro de activar este usuario?',
        text: "Va a darle acceso a este usuario!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("user/active/" + id, function(data){
                Swal.fire(
                'Usuario activado!',
                'Usuario activado correctamente.',
                'success'
                )
                $("#users").DataTable().ajax.reload();
            })
        }
      })

}


const desactivar = (id) => {
    Swal.fire({
        title: '¿Esta seguro de desactivar este usuario?',
        text: "Este usuario no podra accesar al sistema!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("user/desactive/" + id, function(data){
                Swal.fire(
                'Usuario desactivado!',
                'Usuario desactivado correctamente.',
                'success'
                )
                $("#users").DataTable().ajax.reload();
            })
        }
      })

}
