@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row">
        <button class="btn btn-primary mb-3" id="btnAgregar"> Agregar</button>
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
                                <option value="0">Adminitrador</option>
                                <option value="1">Soporte</option>
                                <option value="2">Oficina</option>
                                <option value="3">General</option>
                            </select>
                        </div>
                    </div>

                    <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-info mt-4">
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
            </tr>
        </thead>
        {{-- <tbody></tbody>
        <tfoot>
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
            </tr>
        </tfoot> --}}
    </table>
</div>
<div class="container">
    <div class="row">
        <button class="btn btn-danger mt-3" id="btnCancelar">Cancelar</button>
    </div>
</div>


@include('adminlte/scripts')
<script src="{{asset('js/user.js')}}"></script>

@endsection