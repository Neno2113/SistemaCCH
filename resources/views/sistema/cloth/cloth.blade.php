@extends('adminlte.layout')

@section('seccion', 'Utilidades')

@section('title', 'Telas')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>

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
                <h4>Telas</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de telas:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-6">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="nombre_cliente">Suplidor(*):</label>
                            <select name="tags[]" id="suplidores" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-6 pt-2" id="compo">
                            <button type="button" class="btn btn-secondary btn-block mt-4" data-toggle="modal"
                                data-target=".bd-composition-modal-lg">Agregar composiciones <i
                                    class="fas fa-fill-drip"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="referencia">Referencia(*):</label>
                            <input type="text" name="referencia" id="referencia" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="precio_usd">Precio USD por yarda:</label>
                            <input type="text" name="precio_usd" id="precio_usd" class="form-control"
                                data-inputmask='"mask": "9.99"' data-mask>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="telefono_2">Tipo tela(*):</label>
                            <select name="tipo_tela" id="tipo_tela" class="form-control">
                                <option value=""></option>
                                <option value="Denim">Denim</option>
                                <option value="Twill">Twill</option>
                            </select>
                        </div>
                    </div>

                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="email_principal">Peso(Onzas/Yardas^2):</label>
                            <input type="text" name="peso" id="peso" class="form-control" placeholder="Onzas/Yardas^2">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="celular_principal">Ancho cortable(Pulgadas):</label>
                            <input type="text" id="ancho_cortable" class="form-control" data-inputmask='"mask": "99"'
                                data-mask placeholder="Pulgadas">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="elasticidad_trama">Elasticidad en trama:</label>
                            <input type="text" id="elasticidad_trama" class="form-control"
                                data-inputmask='"mask": "99.99%"' data-mask placeholder="Porcentaje">
                        </div>
                    </div>
                    <div class="row" id="radios">
                        <div class="col-md-4 mt-4">
                            <label for="elasticidad_urdimbre">Elasticidad en urdimbre:</label>
                            <input type="text" id="elasticidad_urdimbre" class="form-control"
                                data-inputmask='"mask": "99.99%"' data-mask placeholder="Porcentaje">
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="encogimiento_trama">Encogimiento en trama:</label>
                            <input type="text" id="encogimiento_trama" class="form-control"
                                data-inputmask='"mask": "99.99%"' data-mask placeholder="Porcentaje">
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="encogimiento_urdimbre">Encogimiento en urdimbre:</label>
                            <input type="text" id="encogimiento_urdimbre" class="form-control"
                                data-inputmask='"mask": "99.99%"' data-mask placeholder="Porcentaje">
                        </div>
                    </div>
            </div>
            <div class="card-footer  text-muted ">
                <button class="btn btn-danger mt-2" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i>
                    Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-left"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de telas</h4>
    </div>
    <div class="card-body">
        <table id="cloths" class="table table-hover table-bordered datatables text-sm" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Actions</th>
                    <th>Ref.</th>
                    <th>Suplidor</th>
                    <th>Tela</th>
                    <th>Peso</th>
                    <th>Compo.</th>
                    <th>Compo. 2</th>
                    <th>Compo. 3</th>
                    <th>Compo. 4</th>
                    <th>Compo. 5</th>

                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Actions</th>
                    <th>Ref.</th>
                    <th>Suplidor</th>
                    <th>Tela</th>
                    <th>Peso</th>
                    <th>Compo.</th>
                    <th>Compo. 2</th>
                    <th>Compo. 3</th>
                    <th>Compo. 4</th>
                    <th>Compo. 5</th>
                </tr>
            </tfoot>
        </table>
    </div>


</div>


<!-- Modal -->

<div class="modal fade bd-composition-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Composiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="compositionForm" class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Material No.1">Material No.1</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-2 ml-5">
                            <label for="Porcentaje Mat.No.1">Porcentaje Mat.No.1(*)</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_1" id="porcentaje_mat_1"
                                class="form-control text-center" data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Material No.2">Material No.2</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_2" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-2 ml-5">
                            <label for="Porcentaje Mat.No.2">Porcentaje Mat.No.2</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_2" id="porcentaje_mat_2"
                                class="form-control text-center" data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Material No.3">Material No.3</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_3" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-2 ml-5">
                            <label for="Porcentaje Mat.No.3">Porcentaje Mat.No.3</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_3" id="porcentaje_mat_3"
                                class="form-control text-center" data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Material No.4">Material No.4</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_4" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-2 ml-5">
                            <label for="Porcentaje Mat.No.4">Porcentaje Mat.No.4</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_4" id="porcentaje_mat_4"
                                class="form-control text-center" data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Material No.5">Material No.5</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_5" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-2 ml-5">
                            <label for="Porcentaje Mat.No.5">Porcentaje Mat.No.5</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_5" id="porcentaje_mat_5"
                                class="form-control text-center" data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Atencion!</strong> Las composiciones digitadas deben equivaler al 100% de
                                lo contrario no podra guardar en el sistema.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>

                        <div class="col-md-2 ml-5 mt-3">
                            <label for="Total">Total</label>
                        </div>
                        <div class="col-md-3 mt-3">
                            <input type="text" name="porcentaje_mat_total" id="porcentaje_mat_total"
                                class="form-control text-center" readonly>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>



@include('adminlte/scripts')
<script src="{{asset('js/cloth.js')}}"></script>

<script>
    function mostrar(id_cloth) {
        $.post("cloth/" + id_cloth, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#compo").show();

            $("#id").val(data.tela.id);
            $("#referencia").val(data.tela.referencia).attr('readonly', false);
            $("#precio_usd").val(data.tela.precio_usd).attr('readonly', false);
            $("#tipo_tela").val(data.tela.tipo_tela).attr('disabled', false);
            $("#ancho_cortable").val(data.tela.ancho_cortable).attr('readonly', false);
            $("#peso").val(data.tela.peso).attr('readonly', false);
            $("#elasticidad_trama").val(data.tela.elasticidad_trama).attr('readonly', false);
            $("#elasticidad_urdimbre").val(data.tela.elasticidad_urdimbre).attr('readonly', false);
            $("#encogimiento_trama").val(data.tela.encogimiento_trama).attr('readonly', false);
            $("#encogimiento_urdimbre").val(data.tela.encogimiento_urdimbre).attr('readonly', false);
           
        });
    }

    function ver(id_cloth) {
        $.post("cloth/" + id_cloth, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            // $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#compo").hide();

            $("#referencia").val(data.tela.referencia).attr('readonly', true);
            $("#precio_usd").val(data.tela.precio_usd).attr('readonly', true);
            $("#tipo_tela").val(data.tela.tipo_tela).attr('disabled', true);
            $("#ancho_cortable").val(data.tela.ancho_cortable).attr('readonly', true);
            $("#peso").val(data.tela.peso).attr('readonly', true);
            $("#elasticidad_trama").val(data.tela.elasticidad_trama).attr('readonly', true);
            $("#elasticidad_urdimbre").val(data.tela.elasticidad_urdimbre).attr('readonly', true);
            $("#encogimiento_trama").val(data.tela.encogimiento_trama).attr('readonly', true);
            $("#encogimiento_urdimbre").val(data.tela.encogimiento_urdimbre).attr('readonly', true);
           
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