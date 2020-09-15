@extends('adminlte.layout')

@section('seccion', 'Reportes')

@section('title', 'Exportar')

@section('content')
{{-- <div class="container"> --}}


<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Reporte existencias</h4>
    </div>
    <div class="card-body">

        {{-- <div class="row">
            <div class="col-md-5">
                <label for="">Desde:</label>
                <input type="date" name="desde" id="desde" class="form-control">
            </div>
            <div class="col-md-5">
                <label for="">Hasta:</label>
                <input type="date" name="hasta" id="hasta" class="form-control">
            </div> --}}
            <div class="col-md-2 mt-4 pt-2">
                <button type="button" id="btn-generar" class="btn btn-primary"> <i class="fas fa-calculator"></i> Generar</a>

            </div>
        {{-- </div> --}}

        <table id="existencias" class="table table-bordered table-hover datatables" style="width: 100%">
            <thead>
                <tr>
                    <th>Customer ID</th>
                    <th>Invoice/CM #</th>
                    <th>Credit Memo</th>
                    <th>Date</th>
                    <th>Ship to Name</th>
                    <th>Ship to Address-Line One</th>
                    <th>Ship to Address-Line Two</th>
                    <th>Ship to City</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th>Customer ID</th>
                    <th>Invoice/CM #</th>
                    <th>Credit Memo</th>
                    <th>Date</th>
                    <th>Ship to Name</th>
                    <th>Ship to Address-Line One</th>
                    <th>Ship to Address-Li
                </tr>
            </tfoot>
        </table>
    </div>
    <div class="card-footer text-muted " style="background: transparent;">
        <a id="btn-print" class="btn btn-secondary float-right"> <i class="fas fa-print"></i> Imprimir</a>
    </div>

</div>



@include('adminlte/scripts')
<script src="{{asset('js/reporte/reporte.js')}}"></script>

@endsection
