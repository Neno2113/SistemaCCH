@extends('adminlte.layout')

@section('seccion', 'Existencias')

@section('title', 'Reporte')

@section('content')
{{-- <div class="container"> --}}


<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Reporte existencias</h4>
    </div>
    <div class="card-body">

        <table id="existencias" class="table table-bordered table-hover datatables" style="width: 100%">
            <thead>
                <tr>
                    <th></th>
                    {{-- <th>Actions</th> --}}
                    {{-- <th>Dpto</th> --}}
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
                    {{-- <th>Actions</th> --}}
                    {{-- <th>Dpto</th> --}}
                    <th>Marca</th>
                    <th>Referencia</th>
                    <th>Produccion</th>
                    <th>Lavanderia</th>
                    <th>Terminacion</th>
                    <th>Almacen</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="card-footer text-muted " style="background: transparent;">
        <a href="reporte/existencia" class="btn btn-default ml-1 float-right"> <i class="fas fa-print"></i> Print</a>
    </div>

</div>



@include('adminlte/scripts')
<script src="{{asset('js/reporte/reporte.js')}}"></script>

@endsection
