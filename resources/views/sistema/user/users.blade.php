@extends('adminlte.layout')

@section('seccion', 'Usuarios')

@section('title', 'Usuario')

@section('content')

<div class="row ">
    <div class="col-7">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header bg-dark ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                {{-- <h4 class="">Registro</h4> --}}
            </div>
            <div class="card-body">
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de usuarios</h5>
                    <hr>
                    <div class="row">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="col-md-6 col-sm-6 mt-3">
                            <input type="text" name="name" id="name" placeholder="Nombre" class="form-control"
                                pattern="[a-zA-Z]">
                            <label for="name" class="label"></label>
                        </div>
                        <div class="col-md-6 col-sm-6 mt-3">
                            <input type="text" name="surname" id="surname" placeholder="Apellido" class="form-control">
                            <label for="surname" class="label"></label>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-2 mt-3">
                            <input type="text" name="edad" id="edad" placeholder="Edad" class="form-control text-center" ]
                                data-inputmask='"mask": "99"' data-mask>
                            <label for="edad" class="label"></label>
                        </div>
                        <div class="col-md-5 mt-3">
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                            <input type="text" id="telefono" placeholder="Telefono" class="form-control"
                                data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            {{-- </div> --}}
                            <label for="name" class="label"></label>
                        </div>
                        <div class="col-md-5 mt-3">

                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                            <input type="text" id="celular" placeholder="Celular" class="form-control"
                                data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            <label for="celular" class="label"></label>
                            {{-- </div> --}}
                        </div>
                    </div>

                    <div class="row mt-4">


                        <div class="col-12 mt-3">
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                </div> --}}
                            <textarea  id="direccion" placeholder="Direccion" class="form-control"></textarea>
                            <label for="direccion" class="label"></label>
                            {{-- </div> --}}

                        </div>
                    </div>

                </form>



            </div>
            <div class="flex-row p-2 card-footer">
                <button class="btn  btn-danger mt-1" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left "></i>
                    Cancelar</button>
                {{-- <button type="submit" id="btn-guardar" class="btn btn-primary mt-1 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-1 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button> --}}

            </div>

        </div>
    </div>
    <div class="col-5">
        <div class="card  mb-3" id="userForm">
            <div class="card-header bg-dark ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                {{-- <h4 class="">Registro</h4> --}}
            </div>
            <div class="card-body">
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <h5>Datos de acceso</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mt-3">

                            <input type="Email" name="email" id="email" placeholder="Email" class="form-control">
                            <label for="name" class="label"></label>
                        </div>
                        <div class="col-md-6 mt-3" id="ver-contra">

                            <input type="password" name="password" placeholder="Contraseña" id="password"
                                class="form-control">
                            <label for="password" class="label"></label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">

                            <select name="role" id="role" class="form-control">
                                <option value="" disabled>Rol</option>
                                <option>Administrador</option>
                                <option>Oficina</option>
                                <option>Soporte</option>
                                <option>General</option>
                            </select>
                            <label for="" class="label"></label>
                        </div>
                    </div>


                </form>
                {{-- <div class="row"> --}}
                <div class="row mt-3" id="vatar">
                    <form action="" method="POST" id="formUpload" enctype="multipart/form-data">
                        <div class="form-group">
                            {{-- <label for="exampleInputFile">Avatar</label> --}}
                            <img src="" alt="" id="avatar-img" class="rounded img-fluid img-thumbnail">
                            <div class="input-group mt-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="avatar" id="avatar">
                                    <input type="hidden" name="image_name" id="image_name" value="">
                                    {{-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> --}}
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn-primary" id="btn-upload">
                                        <i class="fas fa-upload"></i> Subir</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- </div> --}}

                <div class="row">
                    <div class="col-md-12">
                        <ul class="error" id="error">

                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex-row p-2 card-footer">
                {{-- <button class="btn  btn-danger mt-1" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i>
                    Cancelar</button> --}}
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-1 float-right"><i
                        class="far fa-save "></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-1 float-right"><i
                        class="far fa-edit "></i> Editar</button>

            </div>

        </div>
    </div>

</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark ">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-user-plus"></i> Agregar </button>

                <h4 class="text-center  text-white">Listado de usuarios</h4>
            </div>
        </div>
    </div>
    <div class="card-body">

        <table id="users" class="table table-bordered table-hover datatables" style="width: 100%">
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
<script src="{{asset('js/formulario.js')}}"></script>
<script src="{{asset('js/users/user.js')}}"></script>

@endsection
