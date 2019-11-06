@extends('adminlte.layout')

@section('seccion', 'Producto')

@section('title', 'Producto Terminado')

@section('content')
{{-- <div class="container"> --}}
<div class="row">
    {{-- <div class="col-md-6 mt-3 ">
        <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-th-list"></i></button>
        <button class="btn btn-danger mb-3" id="btnCancelar"><i class="fas fa-window-close"></i></button>
    </div> --}}
</div>
<div class="row mt-4">
    <div class="col-12 ">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4>Formulario de creacion de referencia de producto:</h4>
            </div>
            <div class="card-body">
                


            </div>
            <div class="card-footer  text-muted d-flex justify-content-end ">

            </div>
        </div>
    </div>
</div>

{{-- <div class="container" id="listadoUsers">
    <table id="products" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th></th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Usuario </th>
                <th>Referencia producto</th>
                <th>Precio lista</th>
                <th>Precio venta publico</th>
                <th>Descripcion</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Usuario</th>
                <th>Referencia producto</th>
                <th>Precio lista</th>
                <th>Precio venta publico</th>
                <th>Descripcion</th>
            </tr>
        </tfoot>
    </table>
</div> --}}
</div>



@include('adminlte/scripts')
<script src="{{asset('js/producto/producto-terminado.js')}}"></script>

<script>
    function mostrar(id_prouct) {
        $.post("product/" + id_prouct, function(data, status) {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();

            $("#id").val(data.product.id);
            $("#referencia").val(data.product.referencia_producto);
            $("#descripcion").val(data.product.descripcion);
            $("#precio_lista").val(data.product.precio_lista);
            $("#precio_lista_2").val(data.product.precio_lista_2);
            $("#precio_venta_publico").val(data.product.precio_venta_publico);
            $("#precio_venta_publico_2").val(data.product.precio_venta_publico_2);
        });
    }


    function eliminar(id_prouct){
        bootbox.confirm("¿Estas seguro de eliminar esta referencia?", function(result){
            if(result){
                $.post("product/delete/" + id_prouct, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Referencia eliminada correctamente!!");
                    $("#products").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection