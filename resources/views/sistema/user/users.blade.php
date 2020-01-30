@extends('adminlte.layout')

@section('seccion', 'Usuarios')

@section('title', 'Usuario')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3 " id="btnAgregar"><i class="fas fa-user-plus"></i> Agregar </button>
    {{-- <button class="btn btn-danger mb-3 " id="btnCancelar"><i class="fas fa-window-close"></i></button> --}}
</div>

<div class="row ">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
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
                            @if ($errors->has('name'))
                                <div class="error">{{ $errors->name('name') }}</div>
                            @endif
                        </div>
                        <div class="col-md-4">
                            <label for="surname">Apellido(*):</label>
                            <input type="text" name="surname" id="surname" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="edad">Edad:</label>
                            <input type="text" name="edad" id="edad" class="form-control text-center"]
                            data-inputmask='"mask": "99"' data-mask>
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
                    <h4 class="text-center font-weight-bold mt-4">Datos de acceso</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="name">Email(*):</label>
                            <input type="Email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3" id="ver-contra">
                            <label for="password">Contraseña(*):</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Rol:</label>
                            <select name="role" id="role" class="form-control">
                                <option>Administrador</option>
                                <option>Oficina</option>
                                <option>Soporte</option>
                                <option>General</option>
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
            <div class="card-footer  text-muted ">
                <button class="btn  btn-danger mt-1" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-1 float-right"><i class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-1 float-right"><i class="far fa-edit fa-lg"></i> Editar</button>

            </div>
            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4 > Listado de usuarios</h4>
    </div>
    <div class="card-body">

        <table id="users" class="table table-bordered table-hover datatables" style="width: 100%" >
            <thead>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Actions</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Edad</th>
                    <th>Celular</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Actions</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Edad</th>
                    <th>Celular</th>
                </tr>
            </tfoot>
        </table>
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
            $("#btnAgregar").hide();
            $("#btn-guardar").hide();
            $("#ver-contra").show();

            // console.log(data);
            $("#id").val(data.user.id);
            $("#name").val(data.user.name).attr('readonly', false);
            $("#surname").val(data.user.surname).attr('readonly', false);
            $("#edad").val(data.user.edad).attr('readonly', false);
            $("#telefono").val(data.user.telefono).attr('readonly', false);
            $("#celular").val(data.user.celular).attr('readonly', false);
            $("#direccion").val(data.user.direccion).attr('readonly', false);
            $("#email").val(data.user.email).attr('readonly', false);
            $("#role").val(data.user.role).attr('disabled', false);
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
            $("#edad").val(data.user.edad).attr('readonly', true);
            $("#telefono").val(data.user.telefono).attr('readonly', true);
            $("#celular").val(data.user.celular).attr('readonly', true);
            $("#direccion").val(data.user.direccion).attr('readonly', true);
            $("#email").val(data.user.email).attr('readonly', true);
            $("#role").val(data.user.role).attr('disabled', true);
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
