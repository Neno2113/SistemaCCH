@extends('adminlte.layout')

@section('seccion', 'Ordenes de empaque')

@section('title', 'Orden de empaque')

@section('content')

<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3" id="btnAgregar"> <i class="fas fa-th-list"></i></button>
    <button class="btn btn-danger mb-3 " id="btnCancelar"> <i class="fas fa-window-close"></i></button>
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
                <h4><strong>Orden de empaque</strong></h4>
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

                    <div id="formularioLavanderia">
                        <div class="row mt-3">
                            <div class="col-6" id="cortes">
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

                            <div class="col-6" id="suplidor">
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

                            <div class="col-4">
                                <label for="">Cantidad(*):</label>
                                <input type="text" name="cantidad" id="cantidad" class="form-control">
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

<div class="container" id="listadoUsers">
    <table id="ordenes_aprobacion" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th></th>
                <th>Actions</th>
                <th>#</th>
                <th>User Aprob</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>F. aprob.</th>
                <th>Total</th>
                <th>Status</th>
                <th>F. Entr.</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Actions</th>
                <th>#</th>
                <th>User Aprob</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>F. aprob.</th>
                <th>Total</th>
                <th>Status</th>
                <th>F. Entr.</th>
            </tr>
        </tfoot>
    </table>

</div>



@include('adminlte/scripts')
<script src="{{asset('js/orden_empaque.js')}}"></script>

<script>
    function mostrar(id_lavanderia) {
        $.post("lavanderia/" + id_lavanderia, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();        
        });
    }

    function redistibuir(id_orden){
        bootbox.confirm("¿Estas seguro de redistribuir las tallas?", function(result){
            if(result){
                $.post("orden_redistribuir" + id_orden, function(){
                    bootbox.alert("Redistibucion completa");
                    $("#lavanderias").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection