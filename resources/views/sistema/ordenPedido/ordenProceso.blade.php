@extends('adminlte.layout')

@section('seccion', 'Ordenes de pedido')

@section('title', 'Orden de Pedido')

@section('content')

<div class="row mt-3 ml-3">
    {{-- <button class="btn btn-primary mb-3" id="btnAgregar"> <i class="fas fa-th-list"></i></button>
    <button class="btn btn-danger mb-3 " id="btnCancelar"> <i class="fas fa-window-close"></i></button> --}}
</div>




<div class="container" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                {{-- <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button> --}}
                <h4 class="text-white text-center">Listado de ordenes</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        <table id="ordenes_proceso" class="table table-striped table-bordered datatables">
            <thead>
                <tr>
                    <th></th>
                    <th>Action</th>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Sucursal</th>
                    <th>F. Entrega</th>
                    <th>Referencia</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Gen. Interno</th>
                    <th>Notas</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Action</th>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Sucursal</th>
                    <th>F. Entrega</th>
                    <th>Referencia</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Gen. Interno</th>
                    <th>Notas</th>
                </tr>
            </tfoot>
        </table>

    </div>

</div>



@include('adminlte/scripts')
<script type="text/javascript" src="{{asset('js/orden_pedido/orden_proceso.js')}}"></script>

<script type="text/javascript">
    function eliminar(id_orden){
        Swal.fire({
        title: "¿Estas seguro de eliminar esta orden de pedido?",
        text: "Va a eliminar la orden de pedido!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, acepto"
    }).then(result => {
        if (result.value) {
            $.post("orden_pedido/delete/" + id_orden, function() {
                Swal.fire(
                    "Eliminado!",
                    "Orden de pedido eliminada correctamente.",
                    "success"
                );
                $("#ordenes_proceso")
                    .DataTable()
                    .ajax.reload();
            });
        }
    });
    }

</script>



@endsection
