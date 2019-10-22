@extends('adminlte.layout')

@section('title', 'Lavanderia')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3" id="btnAgregar">Create <i class="fas fa-plus"></i></button>
    <button class="btn btn-danger mb-3" id="btnCancelar">Cancel <i class="fas fa-window-close"></i></button>
</div>

<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-light border-top">
                <h4>Envio lavanderia</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de envio a lavanderia:</h5>
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
                    <div class="row mt-5">
                        <div class="col-6" id="cortes">
                            <label for="">Corte(*):</label>
                            <select name="tags[]" id="cortesSearch" class="form-control select2">
                            </select>
                        </div>
                        <div class="col-6" id="corteEdit">
                            <label for="">Corte(*):</label>
                            <input type="text" name="" id="numero_corte" readonly class="form-control">
                        </div>
                        <div class="col-6">
                            <label for="">Lavanderia(*):</label>
                            <select name="tags[]" id="lavanderiaSearch" class="form-control select2">
                            </select>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-4">
                            <label for="">Fecha(*):</label>
                            <input type="date" name="" id="fecha_envio" class="form-control">
                        </div>

                        <div class="col-4">
                            <label for="">Cantidad(*):</label>
                            <input type="text" name="" id="cantidad" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <label for="">Receta de lavado(*):</label>
                            <textarea name="" id="receta_lavado" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                        <div class="col-4 ml-5 pl-4 mt-2">
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
            </div>
            <div class="card-footer bg-light text-muted d-flex justify-content-end border-bottom">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4">
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
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Num. Envio</th>
                <th>Num. Corte</th>
                <th>Fecha Envio</th>
                <th>Cantidad</th>
                <th>Fase</th>
                <th>Receta</th>
                <th>Estandar incluido</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Num. Envio</th>
                <th>Num. Corte</th>
                <th>Fecha Envio</th>
                <th>Cantidad</th>
                <th>Fase</th>
                <th>Receta</th>
                <th>Estandar incluido</th>
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
            $("#receta_lavado").val(data.lavanderia.receta_lavado);
            $("#estandar_incluido").val(result);
            
         
        });
    }

   

    function eliminar(id_cloth){
        bootbox.confirm("¿Estas seguro de eliminar esta tela?", function(result){
            if(result){
                $.post("cloth/delete/" + id_cloth, function(){
                    bootbox.alert("Composicion eliminada correctamente");
                    $("#cloths").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection