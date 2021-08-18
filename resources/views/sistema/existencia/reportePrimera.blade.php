@extends('adminlte.layout')

@section('seccion', 'Existencias')

@section('title', 'Reporte')

@section('content')
{{-- <div class="container"> --}}


<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <h4 class="text-center text-white">Reporte Disponible venta</h4>
    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Reporte')->where('ver', 1)->first())
        <div class="row">
            {{-- <div class="col-md-5">
                <label for="">Desde:</label>
                <input type="date" name="desde" id="desde" class="form-control">
            </div> --}}
            <div class="col-md-5">
                <label for="">Hasta:</label>
                <input type="date" name="hasta" id="hasta" class="form-control">
            </div>
            <div class="col-md-2 mt-4 pt-2">
                <button type="button" id="btn-generarPrimera" class="btn btn-danger"> <i class="fas fa-calculator"></i> Generar</a>

            </div>
        </div>
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
        {{-- <table id="existencias" class="table table-bordered table-hover datatables" style="width: 100%">
            <thead>
                <tr>
                    <th></th>

                    <th>Marca</th>
                    <th>Referencia</th>
                    <th>Produccion</th>
                    <th>Lavanderia</th>
                    <th>Terminacion</th>
                    <th>Almacen</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>

                    <th>Marca</th>
                    <th>Referencia</th>
                    <th>Produccion</th>
                    <th>Lavanderia</th>
                    <th>Terminacion</th>
                    <th>Almacen</th>
                </tr>
            </tfoot>
        </table> --}}
    </div>
    <div class="card-footer text-muted " style="background: transparent;">
        <a id="btn-printPrimera" class="btn btn-secondary float-right"> <i class="fas fa-print"></i> Imprimir</a>
    </div>

</div>



@include('adminlte/scripts')
<script src="{{asset('js/reporte/reporte.js')}}"></script>

@endsection
