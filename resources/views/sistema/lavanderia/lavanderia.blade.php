@extends('adminlte.layout')

@section('seccion', 'Cortes')

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
            <div class="card-header text-center ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
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
                            <button id="btn-generar" class="btn btn-secondary "><i class="fas fa-file-alt fa-lg"></i></button>
                            <input type="text" name="tota_enviado" id="total_enviado"
                                class="form-control text-center" readonly>

                        </div>
                    </div>
                    <br><br>
                    <hr>

                    {{-- <div class="row mt-5" id="formularioLavanderia">
                        <div class="col-12" id="producto">
                            <label for="">Producto(*):</label>
                            <div id="productoADD">
                                <select name="tags[]" id="productos" class="form-control select2" style="width:100%">
                                </select>
                            </div>
                            <div id="productoEdit" class="mt-3">
                                <select name="tags[]" id="productosEdit" class="form-control select2"
                                    style="width:100%">
                                </select>
                            </div>
                            <input type="text" name="" id="referencia_producto" class="form-control text-center mt-3"
                                readonly>
                        </div>

                    </div> --}}
                    <div id="formularioLavanderia">
                        <div class="row mt-3">
                            <div class="col-md-6" id="cortes">
                                <label for="">Corte(*):</label>
                                <div id="corteADD">
                                    <select name="tags[]" id="cortesSearch" class="form-control select2">
                                    </select>
                                </div>

                                <div id="corteEdit">
                                    <select name="tags[]" id="cortesSearchEdit" class="form-control select2">
                                    </select>
                                </div>
                                <input type="text" name="" id="numero_corte" readonly
                                    class="form-control text-center mt-3">
                            </div>

                            <div class="col-md-6" id="suplidor">
                                <label for="">Lavanderia (*):</label>
                                <select name="tags[]" id="suplidores" class="form-control select2" style="width: 100%">
                                </select>
                                <div id="lavanderia">
                                </div>
                                <input type="text" name="suplidor_lavanderia" id="suplidor_lavanderia"
                                    class="form-control text-center mt-3" readonly>
                            </div>

                        </div>

                        <hr>

                        <div class="row mt-5">
                            <div class="col-4">
                                <label for="">Fecha(*):</label>
                                <input type="date" name="fecha_envio" id="fecha_envio" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label for="">Cantidad(*):</label>
                                <input type="text" name="cantidad" id="cantidad" class="form-control">
                            </div>
                            <div class="col-md-4 pl-5">
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
                                <textarea name="receta_lavado" id="receta_lavado" cols="30" rows="1"
                                    class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer   d-flex justify-content-end">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4 mr-3 ml-3">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4">
            </div>

            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Cortes en lavanderia:</h4>
    </div>
    <div class="card-body">
        <table id="lavanderias" class="table table-striped table-bordered datatables" style="width: 100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Actions</th>
                    <th>Num. Envio</th>
                    <th>Num. Corte</th>
                    <th>Ref.</th>
                    <th>Fecha Env.</th>
                    <th>Enviado</th>
                    <th>T. Cortado</th>
                    <th>Lav.</th>
                    <th>Estandar </th>

                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Actions</th>
                    <th>Num. Envio</th>
                    <th>Num. Corte</th>
                    <th>Ref.</th>
                    <th>Fecha Env.</th>
                    <th>Enviado</th>
                    <th>T. Cortado</th>
                    <th>Lav.</th>
                    <th>Estandar </th>
                </tr>
            </tfoot>
        </table>
    </div>


</div>



@include('adminlte/scripts')
<script src="{{asset('js/corte/lavanderia.js')}}"></script>

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
            $("#referencia_producto").show();
            $("#corteEdit").show();
            $("#corteADD").hide();
            $("#productoEdit").show();
            $("#productoADD").hide();
            $("#estandar_incluido").show();
            $("#suplidor_lavanderia").show();
            $("#formularioLavanderia").show();
            $("#total_enviado").hide();
        
            let result;
            if(data.lavanderia.estandar_incluido == 1){
                result = 'Si'
            }else{
                result = 'No'
            }

            $("#id").val(data.lavanderia.id);
            $("#numero_envio").val(data.lavanderia.numero_envio).attr('readonly', false);
            $("#fecha_envio").val(data.lavanderia.fecha_envio).attr('disabled', false);
            $("#cantidad").val(data.lavanderia.cantidad).attr('readonly', false);
            $("#numero_corte").val('Corte elegida: '+data.lavanderia.corte.numero_corte);
            $("#referencia_producto").val('Referencia elegida: '+data.lavanderia.producto.referencia_producto);
            $("#receta_lavado").val(data.lavanderia.receta_lavado).attr('readonly', false);
            $("#estandar_incluido").val(result);
            $("#suplidor_lavanderia").val('Lavanderia elegida: '+data.lavanderia.suplidor.nombre);
            // $("#productos").val(data.lavanderia.producto.referencia_producto).trigger('change');
            
        });
    }

    function ver(id_lavanderia) {
        $.post("lavanderia/" + id_lavanderia, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-guardar").hide();
            $("#numero_corte").show();
            $("#btn-generar").hide();
            $("#referencia_producto").show();
            $("#corteEdit").show();
            $("#corteADD").hide();
            $("#productoEdit").show();
            $("#productoADD").hide();
            $("#estandar_incluido").show();
            $("#suplidor_lavanderia").show();
            $("#formularioLavanderia").show();
            $("#total_enviado").show();
        
            let result;
            if(data.lavanderia.estandar_incluido == 1){
                result = 'Si'
            }else{
                result = 'No'
            }

            $("#total_enviado").val('Total enviado: '+data.lavanderia.total_enviado);
            $("#numero_envio").val(data.lavanderia.numero_envio).attr('readonly', true);
            $("#fecha_envio").val(data.lavanderia.fecha_envio).attr('disabled', true);
            $("#cantidad").val(data.lavanderia.cantidad).attr('readonly', true);
            $("#numero_corte").val('Corte elegida: '+data.lavanderia.corte.numero_corte).attr('readonly', true);
            $("#referencia_producto").val('Referencia elegida: '+data.lavanderia.producto.referencia_producto).attr('readonly', true);
            $("#receta_lavado").val(data.lavanderia.receta_lavado).attr('readonly', true);
            $("#estandar_incluido").val(result).attr('readonly', true);
            $("#suplidor_lavanderia").val('Lavanderia elegida: '+data.lavanderia.suplidor.nombre).attr('readonly', true);
            // $("#productos").val(data.lavanderia.producto.referencia_producto).trigger('change');
            
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