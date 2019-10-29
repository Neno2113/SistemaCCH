@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Perdidas')


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
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4>Formulario de reporte de perdidas:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h4>Generacion de codigo:</h4>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label for="">Tipo de perdida(*)</label>
                            <select name="tipo_perdida" id="tipo_perdida" class="form-control">
                                <option value=""></option>
                                <option value="Normal">Normal</option>
                                <option value="Segundas">Segundas</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 mt-4 pt-2 mr-3">
                            <input type="text" name="no_perdida" id="no_perdida" class="form-control" readonly>
                        </div>
                        <div class="col-3">
                            <div class="mt-4 pt-2">
                                <button class="btn btn-primary ">Generar</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>

                    <div class="row">
                        <div class="col-6">
                            <label for="">Corte(*):</label>
                            <input type="hidden" name="" id="id">
                            <div id="corteAdd">
                                <select name="cortesSearch" id="cortesSearch" class="form-control select2">
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="">Fecha(*)</label>
                            <input type="date" name="fecha" id="fecha" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6 mt-1">
                            <label for="">Fase(*):</label>
                            <select name="fase" id="fase" class="form-control">
                                <option value=""></option>
                                <option value="Produccion">Produccion</option>
                                <option value="Procesos secos">Procesos secos</option>
                                <option value="Lavanderia">Lavanderia</option>
                                <option value="Terminacion">Terminacion</option>
                                <option value="Almacen">Terminado o almacen</option>
                            </select>
                        </div>
                        <div class="col-6 mt-1">
                            <label for="">Motivo(*):</label>
                            <select name="motivo" id="motivo" class="form-control">
                                <option value=""></option>
                            </select>
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

{{-- <div class="container" id="listadoUsers">
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
                <th>Cantidad Enviada</th>
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
                <th>Cantidad Enviada</th>
                <th>Estandar Recibido</th>
            </tr>
        </tfoot>
    </table>
</div> --}}
</div>



@include('adminlte/scripts')
<script src="{{asset('js/perdidas.js')}}"></script>

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