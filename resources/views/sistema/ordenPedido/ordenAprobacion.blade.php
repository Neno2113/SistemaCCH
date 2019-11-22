@extends('adminlte.layout')

@section('seccion', 'Ordenes de pedido')

@section('title', 'Aprobacion')

@section('content')

<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3" id="btnAgregar"> <i class="fas fa-th-list"></i></button>
    <button class="btn btn-danger mb-3 " id="btnCancelar"> <i class="fas fa-window-close"></i></button>
</div>


<div class="container" id="listadoUsers">
    <table id="ordenes_aprobacion" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th></th>
                <th>Actions</th>
                <th>#</th>
                <th>Usuario</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>Fecha</th>
                <th>F. Entr.</th>
                <th>F. Aprob.</th>
                <th>Total</th>
                <th>Status</th>
                <th>Notas </th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Actions</th>
                <th>#</th>
                <th>Usuario</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>Fecha</th>
                <th>F. Entr.</th>
                <th>F. Aprob.</th>
                <th>Total</th>
                <th>Status</th>
                <th>Notas </th>
            </tr>
        </tfoot>
    </table>

</div>



@include('adminlte/scripts')
<script src="{{asset('js/orden_pedido/orden_aprobacion.js')}}"></script>

<script>
    function aprobar(id_orden) {
        bootbox.confirm("¿Estas seguro de aprobar esta orden?", function(result){
            if(result){
                $.post("orden-aprobacion/" + id_orden, function(data, status){
                    bootbox.alert("Orden <strong>"+ data.orden.no_orden_pedido +"</strong> aprobada." );
                  
                    $("#ordenes_aprobacion").DataTable().ajax.reload();
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