@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Perdidas')


@section('content')
{{-- <div class="container"> --}}
<div class="row">
    <div class="col-md-6 mt-3 ml-2">
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
                <h4 class="font-weight-bold">Perdidas</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h4>Formulario de reporte de perdidas</h4>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""></label>
                            <div id="corteAdd">
                                <select name="cortesSearch" id="cortesSearch" class="form-control select2">
                                </select>
                            </div>
                            <div id="corteEdit" class="mt-2">
                                <input type="text" name="numero_corte" id="numero_corte" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <label for=""></label>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="sec" id="sec" value="">
                            <input type="hidden" name="sec_segunda" id="sec_segunda" value="">
                            <select name="tipo_perdida" id="tipo_perdida" class="form-control text-center">
                                <option value="" disabled>Tipo de perdida</option>
                                {{-- <option value="Normal">Total</option>
                                <option value="Segundas">Segundas</option> --}}
                            </select>
                        </div>
                        {{-- <div class="col-6" id="productoAdd">
                            <label for="">Referencia producto(*):</label>
                            <select name="productos" id="productos" class="form-control select2">
                            </select>
                            <input type="text" name="referencia_producto" id="referencia_producto" class="form-control mt-2">
                        </div> --}}

                    </div>
                    <div class="row">
                        <div class="col-3 mt-4 pt-2 mr-3">
                            <input type="text" name="no_perdida" id="no_perdida" class="form-control text-center"
                                readonly>
                        </div>
                        <div class="col-3">
                            <div class="mt-4 pt-2">
                                <button class="btn btn-secondary" id="btn-generar"><i class="fas fa-trash-restore"></i>
                                    Generar</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>

                    <div class="row" id="fila1">

                        <div class="col-md-6">
                            <label for="">Fecha(*)</label>
                            <input type="date" name="fecha" id="fecha" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2" id="fila2">
                        <div class="col-6 mt-1">
                            <label for=""></label>
                            <select name="fase" id="fase" class="form-control">
                                <option value="" disabled>Fase</option>
                                <option value="Produccion">Produccion</option>
                                <option value="Procesos secos">Procesos secos</option>
                                <option value="Lavanderia">Lavanderia</option>
                                <option value="Terminacion">Terminacion</option>
                                <option value="Almacen">Terminado o almacen</option>
                                <option value="Muestra desarrollo">Muestra desarrollo</option>
                            </select>
                        </div>
                        <div class="col-6 mt-1">
                            <label for=""></label>
                            <select name="motivo" id="motivo" class="form-control">
                                <option value="" disabled>Motivo</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row" id="fila3">
                        <div class="col-4">
                            <button type="button" class="btn btn-secondary btn-block mt-4" id="btn-tallas"
                                data-toggle="modal" data-target=".bd-talla-modal-xl"><i
                                    class="fas fa-sort-alpha-down"></i> Identificar Tallas
                            </button>
                        </div>
                    </div>

            </div>
            <div class="card-footer text-muted ">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de perdidas</h4>
    </div>
    <div class="card-body">
        <table id="perdida_listada" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>#</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Corte</th>
                    <th>Producto</th>
                    <th>Fase</th>
                    <th>Motivo</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>#</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Corte</th>
                    <th>Producto</th>
                    <th>Fase</th>
                    <th>Motivo</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
</div>

<!-- Modal -->
<div class="modal fade bd-talla-modal-xl" tabindex="-1" id="modalPerdida" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reportar perdidas(*):</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="">Referencia producto: </label>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="genero" id="genero" class="form-control font-weight-bold" readonly>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered tabla-perdidas">
                        <thead>
                            <tr>
                                <th id="sa">A</th>
                                <th id="sb">B</th>
                                <th id="sc">C</th>
                                <th id="sd">D</th>
                                <th id="se">E</th>
                                <th id="sf">F</th>
                                <th id="sg">G</th>
                                <th id="sh">H</th>
                                <th id="si">I</th>
                                <th id="sj">J</th>
                                <th id="sk">K</th>
                                <th id="sl">L</th>
                            </tr>
                        </thead>
                        <tr>
                            <td id="ra"></td>
                            <td id="rb"></td>
                            <td id="rc"></td>
                            <td id="rd"></td>
                            <td id="re"></td>
                            <td id="rf"></td>
                            <td id="rg"></td>
                            <td id="rh"></td>
                            <td id="ri"></td>
                            <td id="rj"></td>
                            <td id="rk"></td>
                            <td id="rl"></td>
                        </tr>

                    </table>
                </div>
                <br>
                <br>
                <div class="row mt-2">
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="ta">A</label>
                        <input type="text" name="" id="a" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tb">B</label>
                        <input type="text" name="" id="b" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tc">C</label>
                        <input type="text" name="" id="c" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="td">D</label>
                        <input type="text" name="" id="d" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="te">E</label>
                        <input type="text" name="" id="e" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tf">F</label>
                        <input type="text" name="" id="f" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tg">G</label>
                        <input type="text" name="" id="g" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="th">H</label>
                        <input type="text" name="" id="h" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="ti">I</label>
                        <input type="text" name="" id="i" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tj">J</label>
                        <input type="text" name="" id="j" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tk">K</label>
                        <input type="text" name="" id="k" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tl">L</label>
                        <input type="text" name="" id="l" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label for="" class="mt-4">Talla x:</label>
                    <div class="col-md-6 mt-3">
                        <input type="text" name="talla_x" id="talla_x" class="form-control text-center"
                            placeholder="Solo utilizar esta talla cuando la talla no sea conocida"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>



@include('adminlte/scripts')
<script src="{{asset('js/corte/perdidas.js')}}"></script>


@endsection
