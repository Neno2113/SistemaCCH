@extends('adminlte.layout')

@section('title', 'Usuarios')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3 " id="btnAgregar"><i class="fas fa-user-plus"></i></button>
    <button class="btn btn-danger mb-3 " id="btnCancelar"><i class="fas fa-window-close"></i></button>
</div>

<div class="row ">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-light border-top">
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
                            <input type="text" name="name" id="name" class="form-control" pattern="[a-zA-Z]">
                        </div>
                        <div class="col-md-4">
                            <label for="surname">Apellido(*):</label>
                            <input type="text" name="surname" id="surname" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="edad">Edad:</label>
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
                            <label for="celular">Celular:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="celular" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="direccion">Direccion:</label>
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
                            <label for="name">Rol:</label>
                            <select name="" id="role" class="form-control">
                                <option value="General"></option>
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
            </div>
            <div class="card-footer bg-light text-muted d-flex justify-content-end">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4">
            </div>
            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="container" id="listadoUsers">
    <table id="users" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th></th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Telefono</th>
                <th>Celular</th>
                <th>Direccion</th>
                <th>Edad</th>

            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Telefono</th>
                <th>Celular</th>
                <th>Direccion</th>
                <th>Edad</th>

            </tr>
        </tfoot>
    </table>
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
            $("#btnAgregar").hide();
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

  

    function eliminar(id_user){
        bootbox.confirm("¿Estas seguro de eliminar este usuario?", function(result){
            if(result){
                $.post("user/delete/" + id_user, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Usuario eliminado correctamente");
                    $("#users").DataTable().ajax.reload();
                })
            }
        })
    }

</script>

@endsection