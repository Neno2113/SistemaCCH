@extends('adminlte.layout')

@section('title', 'Recepcion')


@section('content')
{{-- <div class="container"> --}}
<div class="row">
    <div class="col-md-6 mt-3 ">
        <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-th-list"></i></button>
        <button class="btn btn-danger mb-3" id="btnCancelar"><i class="fas fa-window-close"></i></button>
    </div>
</div>
<div class="row ">
    <div class="col-12 ">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center border-top bg-light">
                <h4>Formulario de recepcion de lavanderia:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Corte(*):</label>
                            <select name="tags[]" id="cortesSearch" class="form-control select2">
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="">Num. Envio</label>
                            <select name="tags[]" id="lavanderias" class="form-control select2">
                            </select>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Fecha(*):</label>
                            <input type="date" name="" id="fecha_recepcion" class="form-control">
                        </div>
                        <div class="col-4">
                            <label for="">Cantidad Rec.(*):</label>
                            <input type="text" name="" id="cantidad_recibida" class="form-control">
                        </div>
                        <div class="col-4 pl-5">
                            <label for="">¿Estandar recibido?</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="r1" value="1" checked>
                                    <label for="radioPrimary1">
                                        Si
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" value="0" name="r1">
                                    <label for="radioPrimary2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer bg-light text-muted d-flex justify-content-end">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4">
            </div>
            </form>
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
</div>
</div> --}}



@include('adminlte/scripts')
<script src="{{asset('js/recepcion.js')}}"></script>

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