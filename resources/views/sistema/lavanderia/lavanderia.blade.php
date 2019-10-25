@extends('adminlte.layout')

@section('title', 'Lavanderia')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3" id="btnAgregar"> <i class="fas fa-th-list"></i></button>
    <button class="btn btn-danger mb-3 " id="btnCancelar"> <i class="fas fa-window-close"></i></button>
    {{-- <button class="btn btn-secondary mb-3 ml-2" id="edit-hide2" data-toggle="modal"
        data-target=".bd-talla-modal-xl"> <i class="fas fa-print"></i></button> --}}
</div>

<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-light border-top">
                <h4><strong>Envio lavanderia</strong></h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5><strong> Formulario de envio a lavanderia:</strong></h5>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <label for="">Numero de envio:</label>
                            <input type="text" name="" id="numero_envio" class="form-control text-center" readonly>
                            <input type="hidden" name="" id="sec" value="">
                            <input type="hidden" name="" id="id" value="">
                        </div>
                        <div class="col-6 mt-4 pt-2">
                            <button id="btn-generar" class="btn btn-success ">Generar</button>
                        </div>
                    </div>
                    <br><br>
                    <hr>

                    <div class="row mt-5">
                        <div class="col-12" id="producto">
                            <label for="">Producto(*):</label>
                            <select name="tags[]" id="productos" class="form-control select2" style="width:100%">
                            </select>
                        </div>
                        <div class="col-12" id="productoEdit">
                            <label for="">Producto(*):</label>
                            <input type="text" name="" id="referencia_producto" class="form-control text-center"
                                readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-6" id="cortes">
                            <label for="">Corte(*):</label>
                            <select name="tags[]" id="cortesSearch" class="form-control select2">
                            </select>
                        </div>
                        <div class="col-6" id="corteEdit">
                            <label for="">Corte(*):</label>
                            <input type="text" name="" id="numero_corte" readonly class="form-control text-center">
                        </div>
                        <div class="col-6" id="suplidor">
                            <label for="">Lavanderia (*):</label>
                            <select name="tags[]" id="suplidores" class="form-control select2" style="width: 100%">
                            </select>
                        </div>
                        <div class="col-6" id="lavanderia">
                            <label for="">Lavanderia (*):</label>
                            <input type="text" name="" id="suplidor" class="form-control text-center" readonly>
                        </div>
                    </div>

                    <hr>

                    <div class="row mt-5">
                        <div class="col-4">
                            <label for="">Fecha(*):</label>
                            <input type="date" name="" id="fecha_envio" class="form-control">
                        </div>

                        <div class="col-4">
                            <label for="">Cantidad(*):</label>
                            <input type="text" name="" id="cantidad" class="form-control">
                        </div>
                        <div class="col-4 pl-5">
                            <label for="">¿Estandar incluido?</label>
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
                            <input type="text" name="estandar_incluido" id="estandar_incluido"
                                class="form-control text-center" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="">Receta de lavado(*):</label>
                            <textarea name="" id="receta_lavado" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
            </div>
            <div class="card-footer bg-light text-muted border-bottom d-flex justify-content-end">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4 mr-3 ml-3">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4">
            </div>

            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="container" id="listadoUsers">
    <table id="lavanderias" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th></th>
                <th>Opciones</th>
                <th>Num. Envio</th>
                <th>Num. Corte</th>
                <th>Referencia</th>
                <th>Fecha Envio</th>
                <th>Cantidad</th>
                <th>Enviado</th>
                <th>Lavanderia</th>
                <th>Estandar incluido</th>
                <th>Receta</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Opciones</th>
                <th>Num. Envio</th>
                <th>Num. Corte</th>
                <th>Referencia</th>
                <th>Fecha Envio</th>
                <th>Cantidad</th>
                <th>Enviado</th>
                <th>Lavanderia</th>
                <th>Estandar incluido</th>
                <th>Receta</th>
            </tr>
        </tfoot>
    </table>

</div>



@include('adminlte/scripts')
<script src="{{asset('js/lavanderia.js')}}"></script>

<script>
    function mostrar(id_lavanderia) {
        $.post("lavanderia/" + id_lavanderia, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#numero_corte").show();
            $("#btn-generar").hide();
            $("#cortes").hide();
            $("#corteEdit").show();
            $("#estandar_incluido").show();
            $("#producto").hide();
            $("#productoEdit").show();
            $("#lavanderia").show();
            $("#suplidor").hide();
           

            let result;
            if(data.lavanderia.estandar_incluido == 1){
                result = 'Si'
            }else{
                result = 'No'
            }

            $("#id").val(data.lavanderia.id);
            $("#numero_envio").val(data.lavanderia.numero_envio);
            $("#fecha_envio").val(data.lavanderia.fecha_envio);
            $("#cantidad").val(data.lavanderia.cantidad);
            $("#numero_corte").val(data.lavanderia.corte.numero_corte);
            $("#referencia_producto").val(data.lavanderia.producto.referencia_producto);
            $("#receta_lavado").val(data.lavanderia.receta_lavado);
            $("#estandar_incluido").val(result);
            
        });
    }


    function eliminar(id_lavanderia){
        bootbox.confirm("¿Estas seguro de eliminar este conduce de envio?", function(result){
            if(result){
                $.post("lavanderia/delete/" + id_lavanderia, function(){
                    bootbox.alert("Conduce a lavanderia eliminada correctamente");
                    $("#lavanderias").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection