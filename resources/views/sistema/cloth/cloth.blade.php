@extends('adminlte.layout')

@section('seccion', 'Utilidades')

@section('title', 'Telas')

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header bg-dark ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                {{-- <h4>Telas</h4> --}}
            </div>
            <div class="card-body">
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <h5>Formulario de creacion de telas</h5>
                    <hr>
                    <div class="row ">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="col-md-6">

                            <select name="tags[]" id="suplidores" class="form-control select2">
                                <option value="" disabled>Suplidor</option>
                            </select>

                            <label for="nombre_cliente" class="label"></label>
                        </div>
                        <div class="col-md-6" id="compo">
                            <button type="button" class="btn btn-secondary btn-block " id="btn-composicion"
                                data-toggle="modal" data-target=".bd-composition-modal-lg"><i
                                    class="fas fa-fill-drip"></i> Agregar composiciones </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">

                            <input type="text" placeholder="Referencia" name="referencia" id="referencia"
                                class="form-control">
                            <label for="referencia" class="label"></label>
                        </div>
                        <div class="col-md-4 mt-3">

                            <input type="text" placeholder="Precio USD por yarda" name="precio_usd" id="precio_usd"
                                class="form-control text-center" data-inputmask='"mask": "USD 9[.99]"' data-mask>
                            <label for="referencia" class="label"></label>
                        </div>
                        <div class="col-md-4 mt-3">

                            <select name="tipo_tela" id="tipo_tela" class="form-control">
                                <option value="" disabled>Tipo tela</option>
                                <option value="Denim">Denim</option>
                                <option value="Twill">Twill</option>
                            </select>
                            <label for="referencia" class="label"></label>
                        </div>
                    </div>

                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-4 mt-3">

                            <input type="text" name="peso" id="peso" placeholder="Peso(Onzas/Yardas^2)"
                                class="form-control" placeholder="Onzas/Yardas^2">
                            <label for="referencia" class="label"></label>
                        </div>
                        <div class="col-md-4 mt-3">

                            <input type="text" id="ancho_cortable" placeholder="Ancho cortable(Pulgadas)"
                                class="form-control" data-inputmask='"mask": "99"' data-mask placeholder="Pulgadas">
                            <label for="referencia" class="label"></label>
                        </div>
                        <div class="col-md-4 mt-3">

                            <input type="text" id="elasticidad_trama" placeholder="Elasticidad en trama"
                                class="form-control" data-inputmask='"mask": "[-]99[.99]%"' data-mask
                                placeholder="Porcentaje">
                            <label for="referencia" class="label"></label>
                        </div>
                    </div>
                    <div class="row" id="radios">
                        <div class="col-md-4 mt-4">

                            <input type="text" id="elasticidad_urdimbre" placeholder="Elasticidad en urdimbre"
                                class="form-control" data-inputmask='"mask": "[-]99[.99]%"' data-mask
                                placeholder="Porcentaje">
                            <label for="referencia" class="label"></label>
                        </div>
                        <div class="col-md-4 mt-4">

                            <input type="text" id="encogimiento_trama" placeholder="Encogimiento en trama"
                                class="form-control" data-inputmask='"mask": "[-]99[.99]%"' data-mask
                                placeholder="Porcentaje">
                            <label for="referencia" class="label"></label>
                        </div>
                        <div class="col-md-4 mt-4">

                            <input type="text" id="encogimiento_urdimbre" placeholder="Encogimiento en urdimbre"
                                class="form-control" data-inputmask='"mask": "[-]99[.99]%"' data-mask
                                placeholder="Porcentaje">
                            <label for="referencia" class="label"></label>
                        </div>
                    </div>
            </div>
            <div class="card-footer  text-muted ">
                <button class="btn btn-danger mt-2" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i>
                    Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                <h4 class="text-white text-center">Listado de telas</h4>
            </div>
        </div>

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
                    {{-- <th>Compo.</th>
                    <th>Compo. 2</th>
                    <th>Compo. 3</th>
                    <th>Compo. 4</th>
                    <th>Compo. 5</th> --}}

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
                    {{-- <th>Compo.</th>
                    <th>Compo. 2</th>
                    <th>Compo. 3</th>
                    <th>Compo. 4</th>
                    <th>Compo. 5</th> --}}
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

                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_1" id="porcentaje_mat_1"
                                class="form-control text-center" data-inputmask='"mask": "999[.99]"' data-mask
                                placeholder="%">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <label for="Material No.2">Material No.2</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_2" class="form-control select2">

                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_2" id="porcentaje_mat_2"
                                class="form-control text-center" data-inputmask='"mask": "999[.99]"' data-mask
                                placeholder="%">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <label for="Material No.3">Material No.3</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_3" class="form-control select2">

                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_3" id="porcentaje_mat_3"
                                class="form-control text-center" data-inputmask='"mask": "999[.99]"' data-mask
                                placeholder="%">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <label for="Material No.4">Material No.4</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_4" class="form-control select2">

                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_4" id="porcentaje_mat_4"
                                class="form-control text-center" data-inputmask='"mask": "99[.99]"' data-mask
                                placeholder="%">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <label for="Material No.5">Material No.5</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_5" class="form-control select2">

                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_5" id="porcentaje_mat_5"
                                class="form-control text-center" data-inputmask='"mask": "99[.99]"' data-mask
                                placeholder="%">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">

                        </div>

                        <div class="col-md-3 mt-3 float-right">
                            <input type="text" name="porcentaje_mat_total" id="porcentaje_mat_total"
                                class="form-control text-center " readonly placeholder="Total">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mt-2">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Atencion!</strong> Las composiciones digitadas deben equivaler al 100% de
                                lo contrario no podra guardar en el sistema.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
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
<script src="{{asset('js/formulario.js')}}"></script>
<script src="{{asset('js/cloth.js')}}"></script>





@endsection
