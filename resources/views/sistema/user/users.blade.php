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
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name"  class="form-control"
                                pattern="[a-zA-Z]">
                            {{-- <label for="name" class="label"></label> --}}
                        </div>
                        <div class="col-md-6 col-sm-6 mt-3">
                            <label for="surname">Apellido</label>
                            <input type="text" name="surname" id="surname"  class="form-control">
                            {{-- <label for="surname" class="label"></label> --}}
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-2 mt-3">
                            <label for="edad">Edad</label>
                            <input type="text" name="edad" id="edad"  class="form-control text-center" ]
                                data-inputmask='"mask": "99"' data-mask>
                            {{-- <label for="edad" class="label"></label> --}}
                        </div>
                        <div class="col-md-5 mt-3">
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                            <label for="telefono">Telefono</label>
                            <input type="text" id="telefono" class="form-control"
                                data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            {{-- </div> --}}
                            {{-- <label for="name" class="label"></label> --}}
                        </div>
                        <div class="col-md-5 mt-3">

                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                            <label for="celular">Celular</label>
                            <input type="text" id="celular" class="form-control"
                                data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            {{-- <label for="celular" class="label"></label> --}}
                            {{-- </div> --}}
                        </div>
                    </div>

                    <div class="row mt-4">


                        <div class="col-12 mt-3">
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                </div> --}}
                            <label for="direccion">Direccion</label> 
                            <textarea  id="direccion" class="form-control"></textarea>
                            {{-- <label for="direccion" class="label"></label> --}}
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
                            <label for="password"> Email</label>
                            <input type="Email" name="email" id="email"  class="form-control">
                           
                        </div>
                        <div class="col-md-6 mt-3" id="ver-contra">
                            <label for="password"> Contraseña</label>
                            <input type="password" name="password"  id="password"
                                class="form-control">
                           
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="role" >Rol</label>
                            <select name="role" id="role" class="form-control">
                                <option value="" disabled>Rol</option>
                                <option>Administrador</option>
                                <option>Oficina</option>
                                <option>Soporte</option>
                                <option>General</option>
                            </select>
                          
                        </div>
                    </div>


                </form>
                {{-- <div class="row"> --}}
                    
                <div class="row mt-3" id="vatar">
                    <form action="" method="POST" id="formUpload" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputFile">Avatar</label>
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
                @if(Auth::user()->permisos()->where('permiso', 'Usuarios')->where('modificar', 1)->first())
                <button type="submit" id="btn-edit" class="btn btn-warning mt-1 float-right"><i
                        class="far fa-edit "></i> Editar</button>
                @endif
            </div>

        </div>
    </div>
</div>



<div class="card" id="listadoUsers">
    <div class="card-header bg-dark ">
        <div class="row">
          
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" )
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-user-plus"></i> Agregar </button>
                @elseif (Auth::user()->permisos()->where('permiso', 'Usuarios')->where('agregar', 1)->first() )
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-user-plus"></i> Agregar </button>
                @endif
                <h4 class="text-center  text-white">Listado de usuarios</h4>
            </div>
          
        </div>
    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Usuarios')->where('ver', 1)->first())
        <table id="users" class="table table-bordered table-hover datatables" style="width: 100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Edit</th>
                    <th>Elim</th>
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
                    <th>Edit</th>
                    <th>Elim</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Edad</th>
                    <th>Celular</th>
                </tr>
            </tfoot>
        </table>
        @else
        <div class="row" id="alerts">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle"></i>
                     Info
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Acceso negado!</h5>
                        Usted no posee permisos necesarios para realizar esta accion.
                        Para poder realizar la accion debe comunicarse con el administrador.
                  </div>
               
               
                </div>
        
              </div>
              <!-- /.card -->
            </div>
        </div>
        @endif
    </div>

</div>



@include('adminlte/scripts')
{{-- <script src="{{asset('js/formulario.js')}}"></script> --}}
<script src="{{asset('js/users/user.js')}}"></script>

@endsection
