@extends('adminlte.layout')

@section('seccion', 'Utilidades')

@section('title', 'Compisiciones')


@section('content')
<div class="container">
    <div class="row mt-3 ml-3">

        <button class="btn btn-danger mb-3" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i>
            Cancelar</button>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="col-6">
            <div class="card  mb-3" id="registroForm">
                <div class="card-header bg-dark pb-4">
                    {{-- <h4>Composiciones</h4> --}}
                </div>
                <div class="card-body">
                    <form action="" id="formulario" class="form-group carta panel-body">
                        <h5>Formulario de creacion composiciones:</h5>
                        <hr>
                        <div class="row ">
                            <div class="col-md-6">
                                <input type="hidden" name="id" id="id" value="">
                                {{-- <label for="codigo composicion">Codigo composicion(*):</label>
                                <input type="text" name="codigo_composicion" id="codigo_composicion" class="form-control"> --}}
                            </div>
                            <div class="col-md-12">
                                <label for="nombre composicion">Nombre composicion</label>
                                <input type="text" name="nombre_composicion"
                                    id="nombre_composicion" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer  text-muted ">
                    <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                            class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                    <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
                            class="far fa-save fa-lg"></i> Guardar</button>
                    <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i
                            class="far fa-edit fa-lg"></i> Editar</button>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Composicion')->where('agregar', 1)->first())
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                @endif
                <h4 class="text-white text-center">Listado de composiciones</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Composicion')->where('ver', 1)->first())
        <table id="compositions" class="table table-hover table-bordered datatables">
            <thead>
                <tr>
                    <th>Opciones</th>
                    <th>Nombre composicion</th>

                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th>Opciones</th>
                    <th>Nombre composicion</th>
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
<script src="{{asset('js/corte/composition.js')}}"></script>




@endsection
