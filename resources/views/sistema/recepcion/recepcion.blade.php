@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Recepcion')


@section('content')
{{-- <div class="container"> --}}
<div class="row">
    <div class="col-md-6 mt-3 ml-4">
        <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>
        
    </div>
</div>
<div class="row ">
    <div class="col-12 ">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
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
                                <select name="tags[]" id="cortesSearch" class="form-control select2">
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
                            <input type="text" name="cantidad_restante" id="cantidad_restante" class="form-control"
                                readonly>
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
            <div class="card-footer text-muted">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i class="far fa-edit fa-lg"></i> Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de cortes recibidos de lavanderia</h4>
    </div>
    <div class="card-body">
        <table id="recepciones" class="table table-hover table-bordered datatables " style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>#</th>
                    <th>Fecha </th>
                    <th>Cant. Rec.</th>
                    <th>Corte</th>
                    <th># Envio</th>
                    <th>F. Envio</th>
                    <th>Cant. Recibida</th>
                    <th>Total</th>
                    <th>Estandar Rec.</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th># </th>
                    <th>Fecha </th>
                    <th>Cant. Rec.</th>
                    <th>Corte</th>
                    <th># Envio</th>
                    <th>F. Envio</th>
                    <th>Cant. Recibida</th>
                    <th>Total</th>
                    <th>Estandar Rec.</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
</div>



@include('adminlte/scripts')
<script src="{{asset('js/corte/recepcion.js')}}"></script>

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