@extends('adminlte.layout')

@section('seccion', 'Reportes')

@section('title', 'Exportar')

@section('content')
{{-- <div class="container"> --}}


<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                <button type="button" id="btn-generar" class="btn btn-primary float-left mr-2"> <i class="fas fa-calculator"></i> Generar</button>
                <button type="button" id="btn-add" class="btn btn-primary float-left"> Add</button>
                <h4 class="text-center text-white">Reporte existencias</h4>
            </div>
        </div>

    </div>
    <div class="card-body">

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
                    <th>Ship to Country</th>
                    <th>Ship Via</th>
                    <th>Date Due</th>
                    <th>Sales Representative ID</th>
                    <th>Accounts Receivable Account</th>
                    <th>Sales Tax ID</th>
                    <th>Invoice Note</th>
                    <th>Note Prints After Line Items</th>
                    <th>Number of Distributions</th>
                    <th>Invoice/CM Distribution</th>
                    <th>Quantity</th>
                    <th>Item ID</th>
                    <th>Description</th>
                    <th>G/L Account</th>
                    <th>Unit Price</th>
                    <th>Tax Type</th>
                    <th>UPC / SKU</th>
                    <th>Amount</th>
                    <th>U/M ID</th>
                    <th>U/M No. of Stocking Units</th>
                    <th>Sales Tax Agency ID</th>
                    <th>Return Authorization</th>
                </tr>
            </thead>
            <tbody></tbody>
            {{-- <tfoot>
                <tr>
                    <th>Customer ID</th>
                    <th>Invoice/CM #</th>
                    <th>Credit Memo</th>
                    <th>Date</th>
                    <th>Ship to Name</th>
                    <th>Ship to Address-Line One</th>
                    <th>Ship to Address-Line Two</th>
                    <th>Ship to City</th>
                    <th>Ship to Country</th>
                    <th>Ship Via</th>
                    <th>Date Due</th>
                    <th>Sales Representative ID</th>
                    <th>Accounts Receivable Account</th>
                    <th>Sales Tax ID</th>
                    <th>Invoice Note</th>
                    <th>Note Prints After Line Items</th>
                    <th>Number of Distributions</th>
                    <th>Invoice/CM Distribution</th>
                    <th>Quantity</th>
                    <th>Item ID</th>
                    <th>Description</th>
                    <th>G/L Account</th>
                    <th>Unit Price</th>
                    <th>Tax Type</th>
                    <th>UPC / SKU</th>
                    <th>Amount</th>
                    <th>U/M ID</th>
                    <th>U/M No. of Stocking Units</th>
                    <th>Sales Tax Agency ID</th>
                    <th>Return Authorization</th>
                </tr>
            </tfoot> --}}
        </table>
    </div>
    <div class="card-footer text-muted " style="background: transparent;">
        <a id="btn-print" class="btn btn-secondary float-right"> <i class="fas fa-print"></i> Imprimir</a>
    </div>

</div>



@include('adminlte/scripts')
<script src="{{asset('js/reporte/exportar.js')}}"></script>

@endsection
