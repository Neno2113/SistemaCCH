@extends('adminlte.layout')

@section('seccion', 'Corte')

@section('title', 'Cortes')

@section('content')
{{-- <div class="container "> --}}
<div class="row mt-3 ml-2">
    <button class="btn btn-primary mb-3 " id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>

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
                <h4>Formulario de creacion de corte:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Año:</label>
                            {{-- <input type="text" name="numero_corte" id="numero_corte"
                                class="form-control text-center " readonly> --}}
                            <input type="number" min="1900" max="2099" step="1" value="2019" id="year" class="form-control">
                            <input type="hidden" name="sec" id="sec" value="">
                            <input type="hidden" name="id" id="id" value="">
                        </div>
                        <div class="col-md-2">
                            <label for="">Secuencia:</label>
                            <input type="number" min="001" max="999" step="1" value="1"  id="sec_manual" class="form-control">
                        </div>
                        <div class="col-md-2 mt-4 pt-2">
                            <button class="btn btn-secondary" id="btn-generar"><i class="fas fa-cut"></i> Generar</button>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="d-flex justify-content-center">Numero de corte:</label>
                            <input type="text" name="numero_corte_gen" id="numero_corte_gen" class="form-control text-center font-weight-bold" readonly>
                        </div>
                    </div>

                    {{-- <div class="row">

                        <div class="col-md-6 mt-3">
                            <label for="">Numero corte(*):</label>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="sec" id="sec" value="">
                            <input type="text" name="numero_corte" id="numero_corte" class="form-control text-center"
                                readonly>
                        </div>
                        <div class="col-md-4 mt-5">
                            <button class="btn btn-success" id="btn-generar" name="btn-generar">Generar</button>
                        </div>
                    </div> --}}
                    <br>
                    <hr>
                    <br>
                    <div class="row" id="fila1">
                        <div class="col-md-4">
                            <label for="">Referencia producto(*):</label>
                            <select name="tags[]" id="productos" class="form-control select2">
                            </select>
                            {{-- <input type="hidden" name="genero" id="genero"> --}}
                        </div>
                        <div class="col-md-4">
                            <label for="">Fecha estimada de entrega(*):</label>
                            <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control"
                                data-toggle="tooltip" data-placement="bottom">
                        </div>
                        <div class="col-md-4">
                            <label for="">Marcada No.</label>
                            <input type="text" name="no_marcada" id="no_marcada" class="form-control">
                        </div>
                    </div>
                    <br>
                    <div class="row mt-2" id="fila2">

                        <div class="col-md-4 mt-2">
                            <label for="">Ancho marcada</label>
                            <input type="text" name="ancho_marcada" id="ancho_marcada" class="form-control"
                                placeholder="Pulgadas">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="">Largo marcada</label>
                            <input type="text" name="largo_marcada" id="largo_marcada" class="form-control"
                                placeholder="Yardas">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="">Aprovechamiento(*):</label>
                            <input type="text" name="aprovechamiento" id="aprovechamiento" class="form-control"
                                data-inputmask='"mask": "99[.99]%"' data-mask>
                        </div>
                    </div>
                    <div class="row mt-2" id="fila3">
                        <div class="col-md-4 mt-3" id="rollo-agregar">
                            <button type="button" class="btn btn-secondary btn-block mt-4" id="edit-hide"
                                data-toggle="modal" data-target=".bd-rollo-modal-lg">
                                {{-- <span class="spinner-grow spinner-grow-sm" role="status" id="spiner" aria-hidden="true"></span> --}}
                                    Agregar rollos <i
                                    class="fa fa-dolly-flatbed"></i>
                                    {{-- <span class="spinner-grow spinner-grow-sm" role="status" id="spiner2" aria-hidden="true"></span>
                                    <span class="sr-only">Loading...</span> --}}
                                </button>
                        </div>
                        <div class="col-md-4 mt-3">
                            <button type="button" class="btn btn-secondary btn-block mt-4" id="btn-tallas"
                                data-toggle="modal" data-target=".bd-talla-modal-xl">Distribucion de tallas <i
                                    class="fa fa-cut"></i></button>
                        </div>
                        <div class="col-md-4 mt-3">
                            <button type="button" class="btn btn-secondary  btn-block mt-4" data-toggle="modal"
                                data-target=".bd-sku-modal-xl" id="btn-sku"><i class="fas fa-barcode"></i> Asignar SKU</button>
                        </div>
                    </div>
            </div>
            <div class="card-footer text-muted ">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-2 float-right"><i
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
    <div class="card-header text-center">
        <h4>Listado de cortes</h4>
    </div>
    <div class="card-body">
        <table id="cortes_listados" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Opciones</th>
                    <th>User</th>
                    <th>No.Corte</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                    <th>Est.</th>
                    <th>Fase</th>
                    <th>Total</th>
                    <th>Aprovecha.</th>
                    <th>No.Marc.</th>
                    <th>L.Marc.</th>
                    <th>A.Marc.</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Opciones</th>
                    <th>User</th>
                    <th>No.Corte</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                    <th>Est.</th>
                    <th>Fase</th>
                    <th>Total</th>
                    <th>Aprovecha.</th>
                    <th>No.Marc.</th>
                    <th>L.Marc.</th>
                    <th>A.Marc.</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="container" id="listadoUsers">


</div>

<!-- Modal Rollos-->
<div class="modal fade bd-rollo-modal-lg" tabindex="-1" role="dialog" id="modalRollos" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rollos:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    {{-- <label for="">Corte: </label>
                    <div class="col-md-6">
                        <input type="text" name="corte" id="corte" class="form-control text-center">
                    </div> --}}
                </div>
                <br>
                <hr>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <table id="rollos" style="width: 100%;" class="table table-hover table-bordered datatables">
                            <thead>
                                <tr>
                                    <th>Rollo</th>
                                    <th>Referencia tela</th>
                                    <th>Yardas</th>
                                    <th>Tono</th>
                                    <th>Corte</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Rollo</th>
                                    <th>Referencia tela</th>
                                    <th>Yardas</th>
                                    <th>Tono</th>
                                    <th>Corte</th>
                                    <th>Accion</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tallas-->
<div class="modal fade bd-talla-modal-xl" tabindex="-1" role="dialog" id="test" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><strong>Corte por tallas:</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="" class="mt-1">Producto</label>
                    <div class="col-md-3 mb-2">
                        <input type="text" name="corte_tallas" id="corte_tallas" class="form-control text-center font-weight-bold">
                    </div>
                </div>
                <br>
                <hr>
                <div class="row">
                    <table class="table  table-bordered tabla-perdidas mt-4">
                        <thead>
                            <tr>
                                <th>Tallas</th>
                                <th id="ta">A</th>
                                <th id="tb">B</th>
                                <th id="tc">C</th>
                                <th id="td">D</th>
                                <th id="te">E</th>
                                <th id="tf">F</th>
                                <th id="tg">G</th>
                                <th id="th">H</th>
                                <th id="ti">I</th>
                                <th id="tj">J</th>
                                <th id="tk">K</th>
                                <th id="tl">L</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr id="fila-inventario">
                                <th>Inventario</th>
                                <td id="a_alm"></td>
                                <td id="b_alm"></td>
                                <td id="c_alm"></td>
                                <td id="d_alm"></td>
                                <td id="e_alm"></td>
                                <td id="f_alm"></td>
                                <td id="g_alm"></td>
                                <td id="h_alm"></td>
                                <td id="i_alm"></td>
                                <td id="j_alm"></td>
                                <td id="k_alm"></td>
                                <td id="l_alm"></td>
                            </tr>
                            <tr id="fila-actual">
                                <th>% Actual</th>
                                <td id="a_act"></td>
                                <td id="b_act"></td>
                                <td id="c_act"></td>
                                <td id="d_act"></td>
                                <td id="e_act"></td>
                                <td id="f_act"></td>
                                <td id="g_act"></td>
                                <td id="h_act"></td>
                                <td id="i_act"></td>
                                <td id="j_act"></td>
                                <td id="k_act"></td>
                                <td id="l_act"></td>
                            </tr>
                            <tr>
                                <th>N. Corte</th>
                                <td>

                                    {{-- <label for="" class="ml-4" id="da">A</label> --}}
                                    <input type="text" name="" id="a"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="db">B</label> --}}
                                    <input type="text" name="" id="b"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dc">C</label> --}}
                                    <input type="text" name="" id="c"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dd">D</label> --}}
                                    <input type="text" name="" id="d"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="de">E</label> --}}
                                    <input type="text" name="" id="e"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="df">F</label> --}}
                                    <input type="text" name="" id="f"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dg">G</label> --}}
                                    <input type="text" name="" id="g"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dh">H</label> --}}
                                    <input type="text" name="" id="h"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="di">I</label> --}}
                                    <input type="text" name="" id="i"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dj">J</label> --}}
                                    <input type="text" name="" id="j"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dk">K</label> --}}
                                    <input type="text" name="" id="k"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dl">L</label> --}}
                                    <input type="text" name="" id="l"
                                        class="form-control text-center detalle"
                                        data-inputmask='"mask": "9[9[9]]"' data-mask>

                                </td>
                            </tr>
                            <tr id="fila-nuevo">
                                <th>% Nuevo</th>
                                <td>

                                    {{-- <label for="" class="ml-4" id="da">A</label> --}}
                                    <input type="text" name="" id="a_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="db">B</label> --}}
                                    <input type="text" name="" id="b_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dc">C</label> --}}
                                    <input type="text" name="" id="c_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dd">D</label> --}}
                                    <input type="text" name="" id="d_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="de">E</label> --}}
                                    <input type="text" name="" id="e_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="df">F</label> --}}
                                    <input type="text" name="" id="f_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dg">G</label> --}}
                                    <input type="text" name="" id="g_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dh">H</label> --}}
                                    <input type="text" name="" id="h_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="di">I</label> --}}
                                    <input type="text" name="" id="i_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dj">J</label> --}}
                                    <input type="text" name="" id="j_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dk">K</label> --}}
                                    <input type="text" name="" id="k_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                                <td>

                                    {{-- <label for="" class="ml-4" id="dl">L</label> --}}
                                    <input type="text" name="" id="l_new"
                                        class="form-control text-center new"
                                        data-inputmask='"mask": "9[9][.99]"' data-mask>

                                </td>
                            </tr>

                        </tbody>
                        <tr id="tallas">

                        </tr>

                    </table>
                </div>

                <div class="row" id="fila-totales">
                    <label for="" class="mt-1">Total inventario</label>
                    <div class="col-md-3 mb-2">
                        <input type="text" name="total_alm" id="total_alm" class="form-control text-center font-weight-bold">
                    </div>

                    <label for="" class="mt-1 ml-4">Total % nuevo</label>
                    <div class="col-md-3 mb-2">
                        <input type="text" name="total_percent" id="total_percent" class="form-control text-center font-weight-bold">
                    </div>
                    <div class="col-md-3 mb-2">
                        <button class="btn btn-primary ml-2" id="btn-curva"><i class="fas fa-chart-line"></i> Guardar curva</button>
                    </div>

                </div>
                {{-- <div class="row">
                    <div class="col-lg-1 col-md-2">

                        <input type="text" name="" id="a" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">

                        <input type="text" name="" id="b" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2 ">

                        <input type="text" name="" id="c" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">

                        <input type="text" name="" id="d" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">

                        <input type="text" name="" id="e" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">

                        <input type="text" name="" id="f" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">

                        <input type="text" name="" id="g" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">

                        <input type="text" name="" id="h" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">

                        <input type="text" name="" id="i" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">

                        <input type="text" name="" id="j" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">

                        <input type="text" name="" id="k" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">

                        <input type="text" name="" id="l" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>

                {{-- <div class="row">
                    <label for="" class="mt-3">Total:</label>
                    <div class="col-md-6 mt-3">
                        <input type="text" name="total" id="total" class="form-control text-center">
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-tallas-cerrar" class="btn btn-secondary" data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal SKU-->
<div class="modal fade bd-sku-modal-xl" tabindex="-1" id="modalSKU" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><strong> Asignacion de SKU</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="BrachForm">
                    <div class="row">
                        <h5>Referencia:</h5>
                        <div class="col-md-3  mb-3">
                            <input type="text" name="referencia_talla" id="referencia_talla" class="form-control text-center">
                        </div>
                    </div>
                    <h5 class="text-center">Asignar SKU por tallas</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-2 mr-1">
                            <button class="btn btn-secondary mb-4" id="btn-asignar" value="General"> <i class="fas fa-barcode"></i> SKU generel </button>
                        </div>
                        {{-- <div class="col-md-2 mr-1">
                            <button class="btn btn-secondary mb-4" id="btn-asignar-ref2" value="General"> <i class="fas fa-barcode"></i> SKU generel </button>
                        </div> --}}
                    </div>

                    <table class="table  table-bordered mt-3 tabla-perdidas">
                        <thead>
                            <tr>
                                <th id="ra">A</th>
                                <th id="rb">B</th>
                                <th id="rc">C</th>
                                <th id="rd">D</th>
                                <th id="re">E</th>
                                <th id="rf">F</th>
                                <th id="rg">G</th>
                                <th id="rh">H</th>
                                <th id="ri">I</th>
                                <th id="rj">J</th>
                                <th id="rk">K</th>
                                <th id="rl">L</th>
                            </tr>
                        </thead>
                        <tbody id="tallas">

                            <tr>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar2" value="A">A</button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar3" value="B">B</button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar4" value="C">C</button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar5" value="D">D</button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar6" value="E">E</button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar7" value="F">F</button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar8" value="G">G</button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar9" value="H">H</button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar10" value="I">I</button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar11" value="J">J</button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar12" value="K">K</button>
                                </td>
                                <td>
                                    <button class="btn btn-secondary btn-block" id="btn-asignar13" value="L">L</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    {{-- <div class="row">

                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar2" value="A">A</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar3" value="B">B</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar4" value="C">C</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar5" value="D">D</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar6" value="E">E</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar7" value="F">F</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar8" value="G">G</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar9" value="H">H</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar10" value="I">I</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar11" value="J">J</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar12" value="K">K</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar13" value="L">L</button>
                        </div>
                    </div> --}}
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

@include('adminlte/scripts')
<script src="{{asset('js/corte/corte.js')}}"></script>



@endsection
