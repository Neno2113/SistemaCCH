@extends('adminlte.layout')

@section('seccion', 'Cortes')

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
            <div class="card-header text-center ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                </div>
                <h4>Formulario de recepcion de lavanderia:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div class="row">
                        <div class="col-6">
                            <label for="">Corte(*):</label>
                            <input type="hidden" name="" id="id">
                            <div id="corteAdd">
                                <select name="cortesSearch" id="cortesSearch" class="form-control select2">
                                </select>
                            </div>

                            <div id=corteEdit>
                                <select name="tags[]" id="cortesSearchEdit" class="form-control select2">
                                </select>
                            </div>

                            <input type="text" name="corte" id="corte" class="form-control mt-2" readonly>
                        </div>
                        <div class="col-6">
                            <label for="">Num. Envio</label>
                            <div id="lavanderiaAdd">
                                <select name="tags[]" id="lavanderias" class="form-control select2">
                                </select>
                            </div>
                            <div id="lavanderiaEdit">
                                <select name="tags[]" id="lavanderiasEdit" class="form-control select2">
                                </select>
                            </div>
                            <input type="text" name="lavanderia" id="lavanderia" class="form-control mt-2" readonly>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <label for="">Fecha(*):</label>
                            <input type="date" name="fecha_recepcion" id="fecha_recepcion" class="form-control">
                        </div>
                        <div class="col-2">
                            <label for="">Cantidad Rec.(*):</label>
                            <input type="text" name="cantidad_recibida" id="cantidad_recibida" class="form-control">
                        </div>
                        <div class="col-2">
                            <label for="">Restante por recibir:</label>
                            <input type="text" name="cantidad_restante" id="cantidad_restante" class="form-control">
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
                            <input type="text" name="" id="estandar_recibido" class="form-control " readonly>
                        </div>
                    </div>
            </div>
            <div class="card-footer text-muted d-flex justify-content-end ">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4">
            </div>
            </form>
        </div>
    </div>
</div>

<div class="container" id="listadoUsers">
    <table id="recepciones" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th></th>
                <th>Acciones</th>
                <th>Num. Recepcion</th>
                <th>F. Recepcion </th>
                <th>C. Recibida</th>
                <th>Corte</th>
                <th>Num. Envio</th>
                <th>F. Envio</th>
                <th>Cant. Recibida</th>
                <th>Total</th>
                <th>Estandar Recibido</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Acciones</th>
                <th>Num. Recepcion</th>
                <th>F. Recepcion </th>
                <th>C. Recibida</th>
                <th>Corte</th>
                <th>Num. Envio</th>
                <th>F. Envio</th>
                <th>Cant. Recibida</th>
                <th>Total</th>
                <th>Estandar Recibido</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>



@include('adminlte/scripts')
<script src="{{asset('js/recepcion.js')}}"></script>

<script>
    function mostrar(id_recepcion) {
        $.get("recepcion/" + id_recepcion, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#estandar_recibido").show();
            $("#lavanderia").show();
            $("#corte").show();
            $("#corteAdd").hide();
            $("#corteEdit").show();
            $("#lavanderiaAdd").hide();
            $("#lavanderiaEdit").show();

            let result;
            if(data.recepcion.estandar_recibido == 1){
                result = 'Si'
            }else{
                result = 'No'
            }       

            $("#id").val(data.recepcion.id);
            $("#corte").val('Corte elegido: '+data.recepcion.corte.numero_corte);
            $("#lavanderia").val('Numero de envio: '+data.recepcion.lavanderia.numero_envio);
            $("#fecha_recepcion").val(data.recepcion.fecha_recepcion);
            $("#cantidad_recibida").val(data.recepcion.cantidad_recibida);
            $("#estandar_recibido").val('Estandar recbido: '+result);
        });
    }

    function eliminar(id_recepcion){
        bootbox.confirm("¿Estas seguro de eliminar esta recepcion?", function(result){
            if(result){
                $.post("recepcion/delete/" + id_recepcion, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Recepcion eliminada correctamente!!");
                    $("#recepciones").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection