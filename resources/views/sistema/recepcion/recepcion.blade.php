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
                    <div class="row d-flex justify-content-end">
                        <div class="col-md-2 ">
                            <label for="" class="d-flex justify-content-center pers">Numero de recepcion</label>
                            <input type="text" name="numero_recepcion" id="numero_recepcion" class="form-control text-center font-weight-bold" readonly>
                            <input type="hidden" name="sec" id="sec" value="">
                        </div>
                    </div>
                    <hr>
                    <div class="row ">
                        <div class="col-md-6 mt-2">
                            <label for=""></label>
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
                        <div class="col-md-6 mt-2">
                            <label for=""></label>
                            <input type="text" name="num_factura" id="num_factura" class="form-control" placeholder="Numero de Factura o Conduce">
                            {{-- <div id="lavanderiaAdd">
                                <select name="tags[]" id="lavanderias" class="form-control select2">
                                </select>
                            </div> --}}
                            {{-- <div id="lavanderiaEdit">
                                <select name="tags[]" id="lavanderiasEdit" class="form-control select2">
                                </select>
                            </div> --}}
                            {{-- <input type="text" name="lavanderia" id="lavanderia" class="form-control mt-2" readonly> --}}
                        </div>
                    </div>
                    <br>
                    {{-- <hr> --}}
                    <br>
                    <div class="row">
                        <div class="col-md-4">
                            <label for=""></label>
                            <input type="text" name="fecha_recepcion" placeholder="Fecha de recepcion"  onfocus="(this.type='date')" id="fecha_recepcion" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for=""></label>
                            <input type="text" placeholder="Cantidad recibida" name="cantidad_recibida" id="cantidad_recibida" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for=""></label>
                            <input type="text" placeholder="Restante por recibir" name="cantidad_restante" id="cantidad_restante" class="form-control"
                                readonly>
                        </div>

                    </div>
                    <div class="row mt-5">
                        <div class="col-md-4 pl-3 mt-2">
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
                        <div class="col-md-4 pl-3 mt-2">
                            <label for="">¿Recibiendo para darle terminacion?</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="recibir1" name="r2" value="1" checked>
                                    <label for="recibir1">
                                        Si
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="recibir2" value="0" name="r2" >
                                    <label for="recibir2">
                                        No
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4 pl-3 mt-2">
                            <label for="">Recibiendo para devolverlo a produccion?</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="dev_prod1" name="r3" value="1">
                                    <label for="dev_prod1">
                                        Si
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="dev_prod2" value="0" name="r3" checked>
                                    <label for="dev_prod2">
                                        No
                                    </label>
                                </div>
                            </div>

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
                    <th># Recep</th>
                    <th># Corte</th>
                    <th>Fecha Recep</th>
                    <th>Cant. Recibida</th>
                    <th>Total Recibida</th>
                    <th>Pendiente</th>
                    <th>Estandar Rec.</th>
                    <th>status</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th># Recep</th>
                    <th># Corte</th>
                    <th>Fecha Recep</th>
                    <th>Cant. Recibida</th>
                    <th>Total Recibida</th>
                    <th>Pendiente</th>
                    <th>Estandar Rec.</th>
                    <th>status</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
</div>



@include('adminlte/scripts')
<script src="{{asset('js/corte/recepcion.js')}}"></script>




@endsection
