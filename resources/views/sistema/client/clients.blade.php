@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row">
        <button class="btn btn-primary mb-3" id="btnAgregar">Crear <i class="fas fa-user-plus"></i></button>
        <button class="btn btn-danger mb-3" id="btnCancelar">Cancelar</button>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary">
                <h4>Clientes</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de clientes:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-4">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="name">Nombre(*):</label>
                            <input type="text" name="name" id="name"  class="form-control" pattern="[a-zA-Z]">
                        </div>
                        <div class="col-md-4">
                            <label for="surname">Apellido(*):</label>
                            <input type="text" name="surname" id="surname" class="form-control" >
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
                  
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="name">Email(*):</label>
                            <input type="Email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="password">Contraseña(*):</label>
                            <input type="password" name="password" id="password"  class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="name">Rol(*):</label>
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

                    <input type="submit" value="Registrar" id="btn-guardar"  class="btn btn-lg btn-info mt-4">
                    <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-info mt-4">
                </form>
            </div>
        </div>
    </div>
</div>




@include('adminlte/scripts')
<script src="{{asset('js/client.js')}}"></script>



@endsection