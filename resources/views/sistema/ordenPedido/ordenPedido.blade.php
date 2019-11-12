@extends('adminlte.layout')

@section('seccion', 'Existencias')

@section('title', 'Orden de Pedido')

@section('content')

<br><br>

<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4>Formulario de orden de pedido:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Cliente(*):</label>
                            <select name="tags[]" id="clientes" class="form-control select2">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Sucursal(*):</label>
                            <select name="tags[]" id="clientes" class="form-control select2">
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row mt-3">
                        <div class="col-md-4 mt-2">
                            <label for="">Notas(*):</label>
                            <textarea name="notas" id="notas0" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="">Fecha de entrega</label>
                            <input type="text" name="fecha_entrega" id="fecha_entrega" class="form-control">
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="autorizacion_credito_req">¿Generado internamente?(*):</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="r1" value="1" checked>
                                    <label for="radioPrimary1">
                                        Si
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="r1" value="0">
                                    <label for="radioPrimary2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Referencia Producto</label>
                            <select name="tags[]" id="productoSearch" class="form-control select2" style="width:100%">
                            </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="autorizacion_credito_req">¿Detallado?:</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary3" name="r2" value="1" checked>
                                    <label for="radioPrimary3">
                                        Si
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary4" name="r2" value="0">
                                    <label for="radioPrimary4">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 pt-3 pl-3 pb-3">
                            <table class="table  table-bordered table-responsive mt-3">
                                <thead>
                                    <tr>
                                        <th>Sustituto</th>
                                        <th>Referencias listadas</th>
                                        <th>Precio</th>
                                        <th>Cantidad resumida</th>
                                        <th>AP</th>
                                        <th>BP</th>
                                        <th>CP</th>
                                        <th>DP</th>
                                        <th>EP</th>
                                        <th>FP</th>
                                        <th>GP</th>
                                        <th>HP</th>
                                        <th>IP</th>
                                        <th>JP</th>
                                        <th>KP</th>
                                        <th>LP</th>
                                    </tr>
                                </thead>
                                <tbody id="orden_pedido">
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>50</th>
                                        <th>50</th>
                                        <th>50</th>
                                        <th>50</th>
                                        <th>50</th>
                                        <th>50</th>
                                        <th>50</th>
                                        <th>50</th>
                                        <th>50</th>
                                        <th>50</th>
                                        <th>50</th>
                                        <th>50</th>
                                    </tr>

                                </tbody>
                                <tfoot>
                                    
                                </tfoot>
                            </table>

                        </div>

                        {{-- <div class="col-md-2 " style="margin-top: 26.8%">
                                <button id="btn-guardar" name="btn-guardar" class="btn btn-secondary"><i class="fas fa-sync"></i></button>
                            </div> --}}




                    </div>


            </div>
            <div class="card-footer text-muted d-flex justify-content-end">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-info mt-4">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4">
            </div>

            </form>
        </div>
    </div>
</div>





@include('adminlte/scripts')
<script src="{{asset('js/ordenPedido.js')}}"></script>

<script>
    function mostrar(id_almacen) {
        $.get("almacen/" + id_almacen, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#referencia_producto").show();
            $("#numero_corte").show();
            $("#corteEdit").show();
            $("#corteAdd").hide();
          

        });
    }


    function eliminar(id_almacen){
        bootbox.confirm("¿Estas seguro de eliminar este producto de almacen?", function(result){
            if(result){
                $.post("almacen/delete/" + id_almacen, function(){
                    bootbox.alert("Producto de almacen eliminado correctamente!!");
                    $("#almacenes").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection