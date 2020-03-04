@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Lavanderia')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-2">
    <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>

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
                        <div class="col-md-2">
                            <label for="" class="d-flex justify-content-center pers">Numero de envio</label>
                            <input type="text" name="" id="numero_envio" class="form-control text-center font-weight-bold" readonly>
                            <input type="hidden" name="" id="sec" value="">
                            <input type="hidden" name="" id="id" value="">
                        </div>
                        <div class="col-6 mt-4 pt-2">
                            <button id="btn-generar" class="btn btn-secondary "><i class="fas fa-file-alt fa-lg"></i> Generar</button>
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
                                <label for=""></label>
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
                                <label for=""></label>
                                <select name="tags[]" id="suplidores" class="form-control select2" style="width: 100%">
                                </select>
                                <div id="lavanderia">
                                </div>
                                <input type="text" name="suplidor_lavanderia" id="suplidor_lavanderia"
                                    class="form-control text-center mt-3" readonly>
                            </div>

                        </div>

                        <div class="row mt-5">
                            <div class="col-md-4">
                                <label for="" class=""></label>
                                <input type="date" name="fecha_envio" id="fecha_envio" class="form-control">
                            </div>

                            <div class="col-md-2">
                                <label for="" class=""></label>
                                <input type="text" name="cantidad" placeholder="Cantidad" id="cantidad" class="form-control">
                            </div>
                            <div class="col-md-2">
                                <label for="" class=""></label>
                                <input type="text" placeholder="Restante por enviar" name="restante_enviar" id="restante_enviar" class="form-control text-center" readonly>
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
                            <div class="col-md-6">
                                <label for=""></label>
                                <textarea name="receta_lavado" placeholder="Receta de lavado" id="receta_lavado" cols="30" rows="1"
                                    class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4 pl-5 mt-3" id="nuevo_envio">
                                <label for="">¿Es un envio nuevo?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="envio_nuevo1" name="r2" value="1" checked>
                                        <label for="envio_nuevo1">
                                            Si
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="envio_nuevo2" value="0" name="r2">
                                        <label for="envio_nuevo2">
                                            No
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 pl-5 mt-3" id="reparar_lav">
                                <label for="">¿Envio para reparar en lavanderia?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="reparar1" name="r3" value="1" >
                                        <label for="reparar1">
                                            Si
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="reparar2" value="0" name="r3" checked>
                                        <label for="reparar2">
                                            No
                                        </label>
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4 pl-5" id="reparada_lav">
                                <label for="">¿Envio de mercancia reparada a lavanderia?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="reparada1" name="r4" value="1" >
                                        <label for="reparada1">
                                            Si
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="reparada2" value="0" name="r4" checked>
                                        <label for="reparada2">
                                            No
                                        </label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
            </div>
            <div class="card-footer ">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn  btn-warning mt-2 float-right"><i class="far fa-edit fa-lg"></i> Editar</button>
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
        <table id="lavanderias" class="table table-hover table-bordered datatables text-sm" style="width: 100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Actions</th>
                    <th># Envio</th>
                    <th># Corte</th>
                    <th>Ref.</th>
                    <th>Envio</th>
                    <th>T. Envio</th>
                    <th>Disp Envio</th>
                    <th>Pendiente</th>
                    <th>Lav.</th>
                    <th>Status</th>
                    {{-- <th>Estandar</th> --}}

                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Actions</th>
                    <th># Envio</th>
                    <th># Corte</th>
                    <th>Ref.</th>
                    <th>Envio</th>
                    <th>T. Envio</th>
                    <th>Disp Envio</th>
                    <th>Pendiente</th>
                    <th>Lav.</th>
                    <th>Status</th>
                    {{-- <th>Estandar</th> --}}
                </tr>
            </tfoot>
        </table>
    </div>


</div>



@include('adminlte/scripts')
<script src="{{asset('js/corte/lavanderia.js')}}"></script>




@endsection
