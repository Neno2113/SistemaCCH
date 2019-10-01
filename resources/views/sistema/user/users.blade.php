@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row">
        <button class="btn btn-primary mb-3" id="btnAgregar">Crear <i class="fas fa-user-plus"></i></button>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary">
                <h4>Registro</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de usuarios:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-4">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="name">Nombre(*):</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="surname">Apellido(*):</label>
                            <input type="text" name="surname" id="surname" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="edad">Edad(*):</label>
                            <input type="text" name="edad" id="edad" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="name">Telefono(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="celular">Celular(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="celular" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="direccion">Direccion(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                </div>
                                <input type="text" id="direccion" class="form-control">
                            </div>

                        </div>
                    </div>
                    <h5 class="text-center mt-4">Datos de acceso</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="name">Email(*):</label>
                            <input type="Email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="password">Contraseña(*):</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="name">Rol(*):</label>
                            <select name="" id="role" class="form-control">
                                <option value=""></option>
                                <option value="Administrador">Adminitrador</option>
                                <option value="Soporte">Soporte</option>
                                <option value="Oficina">Oficina</option>
                                <option value="General">General</option>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <ul class="error" id="error">

                            </ul>
                        </div>
                    </div>

                    <input type="submit" value="Registrar" id="btn-guardar"  class="btn btn-lg btn-info mt-4">
                    <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-info mt-4">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container" id="listadoUsers">
    <table id="users" class="table table-striped table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Telefono</th>
                <th>Celular</th>
                <th>Direccion</th>
                <th>Edad</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
    </table>
</div>
<div class="container">
    <div class="row">
        <button class="btn btn-danger mt-3" id="btnCancelar">Cancelar</button>
    </div>
</div>


@include('adminlte/scripts')
<script src="{{asset('js/user.js')}}"></script>

<script>
    function mostrar(id_user) {
        $.post("user/" + id_user, function(data, status) {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btn-edit").show();
            $("#btn-guardar").hide();

            // console.log(data);
            $("#id").val(data.user.id);
            $("#name").val(data.user.name);
            $("#surname").val(data.user.surname);
            $("#edad").val(data.user.edad);
            $("#telefono").val(data.user.telefono);
            $("#celular").val(data.user.celular);
            $("#direccion").val(data.user.direccion);
            $("#email").val(data.user.email);
            $("#role").val(data.user.role);
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();
        var user = {
            id: $("#id").val(),
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
            url: "user/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(user),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el usuario");
                    $("#name").val("");
                    $("#surname").val("");
                    $("#edad").val("");
                    $("#telefono").val("");
                    $("#celular").val("");
                    $("#direccion").val("");
                    $("#email").val("");
                    $("#role").val("");
                    $("#password").val("");
                    $("#listadoUsers").show();
                    $("#registroForm").hide();
                    $("#btnCancelar").hide();
                    $("#btn-edit").hide();
                    $("#btn-guardar").show();

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion del usuario verifique los datos suministrados!!"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error durante la actualizacion del usuario verifique los datos suministrados!!"
                );
            }
        });
       
    });

    function eliminar(id_user){
        bootbox.confirm("¿Estas seguro de eliminar este usuario?", function(result){
            if(result){
                $.post("user/delete/" + id_user, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Usuario eliminado correctamente");
                })
            }
        })
    }

</script>

@endsection