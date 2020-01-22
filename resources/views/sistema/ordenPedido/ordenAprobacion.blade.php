@extends('adminlte.layout')

@section('seccion', 'Ordenes de pedido')

@section('title', 'Aprobacion y Redistribuicion')

@section('content')


<div class="row mt-3">
    <div class="col-md-6 d-flex justify-content-center border-right border-bottom">
        <button class="btn btn-secondary rounded-pill  mt-3 mb-4" type="button" data-toggle="collapse"
            data-target="#AprobarPedido" aria-expanded="false" data-toggle="button" aria-pressed="false"
            aria-controls="AprobarPedido">
            Aprobar pedidos
        </button>
    </div>
    <div class="col-md-6 border-bottom d-flex justify-content-center">
        <button class="btn btn-primary rounded-pill mt-3 mb-4 border-right" type="button" data-toggle="collapse"
            data-target="#RedistribuirPedido" aria-expanded="false" aria-controls="RedistribuirPedido">
            Redistribuir pedidos
        </button>
    </div>
</div>


    

<div class="container collapse mt-4" id="AprobarPedido">
    <table id="ordenes_aprobacion" class="table table-striped table-bordered datatables" style="width: 100%;">
        <thead>
            <tr>

                <th>Actions</th>
                <th>#</th>
                <th>Vendedor</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>Fecha</th>
                <th>F. Entr.</th>
                <th>F. Aprob.</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>

                <th>Actions</th>
                <th>#</th>
                <th>Vendedor</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>Fecha</th>
                <th>F. Entr.</th>
                <th>F. Aprob.</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </tfoot>
    </table>
</div>

<div class="container collapse mt-4" id="RedistribuirPedido">
    <table id="ordenes_red" class="table table-striped table-bordered datatables" style="width: 100%;">
        <thead>
            <tr>
                <th>Actions</th>
                <th>#</th>
                <th>Ref.</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>Total</th>
                <th>Precio</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>Actions</th>
                <th>#</th>
                <th>Ref.</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>Total</th>
                <th>Precio</th>
                <th>Status</th>
            </tr>
        </tfoot>
    </table>
</div>






@include('adminlte/scripts')
<script src="{{asset('js/orden_pedido/orden_aprobacion.js')}}"></script>
<script src="{{asset('js/orden_pedido/ordenPedido.js')}}"></script>

<script>
    function aprobar(id_orden) {
        bootbox.confirm("¿Estas seguro de aprobar esta orden?", function(result){
            if(result){
                $.post("orden-aprobacion/" + id_orden, function(data, status){
                    bootbox.alert("Orden <strong>"+ data.orden.no_orden_pedido +"</strong> aprobada." );
                  
                    $("#ordenes_aprobacion").DataTable().ajax.reload();
                    $("#ordenes_red").DataTable().ajax.reload();
                })
            }
        })
    }

    function redistribuir(id_orden){
        bootbox.confirm("¿Estas seguro de redistribuir las tallas?", function(result){
            if(result){
                $.get("orden_redistribuir/" + id_orden, function(){
                    bootbox.alert("Redistibucion completa");
                    $("#ordenes_red").DataTable().ajax.reload();
                })
            }
        })
    }

    function cancelar(id_orden){
        bootbox.confirm("¿Estas seguro de cancelar esta orden?", function(result){
            if(result){
                $.post("orden-cancelacion/" + id_orden, function(data, status){
                    bootbox.alert("Orden <strong>"+ data.orden.no_orden_pedido +"</strong> cancelada." );
                
                    $("#ordenes_aprobacion").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection