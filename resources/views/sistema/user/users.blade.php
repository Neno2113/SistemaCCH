@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="card  mb-3">
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
                            <label for="name">Email(*):</label>
                            <input type="Email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-md-4">
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
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="password">Contraseña(*):</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                    </div>

                    <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-info mt-3">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    

</script>

@endsection