@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Almacen')

@section('content')

<div class="row mt-3 ml-3">
    <div class="col-md-6">
        <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>
        {{-- <a href="/sistemaCCH/public/producto-terminado" class="btn btn-info mb-3 ml-2"><i class="fas fa-link mr-2"></i>
            ir a producto terminado </a> --}}
    </div>
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
                <h4><strong>Almacen</strong></h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body" enctype="multipart/form-data">
                    <h5><strong> Formulario de introduccion a almacen:</strong></h5>
                    <hr>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Corte:</label>
                            <div id="corteAdd">
                                <input type="hidden" name="id" id="id">
                                <select name="tags[]" id="cortesSearch" class="form-control select2" style="width:100%">
                                </select>
                            </div>
                            <div id="corteEdit">
                                <select name="tags[]" id="cortesSearchEdit" class="form-control select2"
                                    style="width:100%">
                                </select>
                            </div>

                            <input type="text" name="numero_corte" id="numero_corte"
                                class="form-control font-weight-bold  text-center" readonly>
                        </div>
                        <div class="col-md-1 mt-4 pt-2">
                            <button type="button" id="btn-buscar" class="btn btn-secondary btn-block rounded-pill"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-center mt-2" >
                        <div class="spinner-grow text-primary"  role="status" id="loading">
                            <span class="sr-only">Loading...</span>
                          </div>
                          <div class="spinner-grow text-dark " role="status" id="loading2">
                            <span class="sr-only">Loading...</span>
                          </div>
                          <div class="spinner-grow text-success"   role="status" id="loading3">
                            <span class="sr-only">Loading...</span>
                          </div>

                        </div>
                    </div> --}}
                    <br><br>

                    <div class="row mt-2" id="form_producto">
                        <div class="col-md-4">
                            <label for="">Ubicacion</label>
                            <input type="text" name="ubicacion" id="ubicacion" class="form-control text-center"
                                data-inputmask='"mask": "a-9"' data-mask>
                        </div>
                        <div class="col-md-4">
                            <label for="">Tono</label>
                            <select name="tono" id="tono" class="form-control">
                                <option value=""></option>
                                <option value="Crudo o Puro">1- Crudo o puro</option>
                                <option value="Dark Stone Suave">2- Dark Stone Suave</option>
                                <option value="Dark Stone">3- Dark Stone</option>
                                <option value="Intermedio">4- Intermedio</option>
                                <option value="Intermedio claro">5- Intermedio claro</option>
                                <option value="Bleach">6- Bleach</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Intensidad proceso seco</label>
                            <select name="intensidad_proceso_seco" id="intensidad_proceso_seco" class="form-control">
                                <option value=""></option>
                                <option value="Alto contraste">1- Alto contraste</option>
                                <option value="Intermedio">2- Intermedio</option>
                                <option value="Suave">3- Suave</option>
                                <option value="No tiene">4- No tiene</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row mt-2" id="form_producto_2">
                        <div class="col-md-4">
                            <label for="">Atributo No.1:</label>
                            <select name="atributo_no_1" id="atributo_no_1" class="form-control">
                                <option value=""></option>
                                <option value="Roto">1- Roto</option>
                                <option value="Parcho">2- Parcho</option>
                                <option value="Bordado">3- Bordardo</option>
                                <option value="Dirty">4- Dirty</option>
                                <option value="Zipper decorativo">5- Zipper decorativo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Atributo No.2:</label>
                            <select name="atributo_no_2" id="atributo_no_2" class="form-control">
                                <option value=""></option>
                                <option value="Roto">1- Roto</option>
                                <option value="Parcho">2- Parcho</option>
                                <option value="Bordado">3- Bordardo</option>
                                <option value="Dirty">4- Dirty</option>
                                <option value="Zipper decorativo">5- Zipper decorativo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Atributo No.3:</label>
                            <select name="atributo_no_3" id="atributo_no_3" class="form-control">
                                <option value=""></option>
                                <option value="Roto">1- Roto</option>
                                <option value="Parcho">2- Parcho</option>
                                <option value="Bordado">3- Bordardo</option>
                                <option value="Dirty">4- Dirty</option>
                                <option value="Zipper decorativo">5- Zipper decorativo</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row" id="form_talla">
                        <div class="col-md-4">
                            <label for="">Fecha:</label>
                            <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2">
                            <button type="button" class="btn btn-primary btn-block mt-4  rounded-pill" id="entrada_alm"
                                data-toggle="modal" data-target=".bd-talla-modal-xl">
                                <i class="fas fa-sort-alpha-down"></i> Entrada por talla</button>
                        </div>
                    </div>
                    <br>
                    <hr>
                </form>
                <form action="" method="POST" id="formUpload" enctype="multipart/form-data">
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="">Imagen frente:</label>
                            <input type="hidden" name="corte_id" id="corte_id" value="">
                            <input type="hidden" name="corte_id_edit" id="corte_id_edit" value="">
                            <img src="" alt="" id="frente" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" name="imagen_frente" id="imagen_frente" alt=""
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imagen trasera:</label>
                            <img src="" alt="" id="trasera" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" alt="" name="imagen_trasera" id="imagen_trasera"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imagen perfil:</label>
                            <img src="" alt="" id="perfil" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" alt="" name="imagen_perfil" id="imagen_perfil"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imagen bolsillo:</label>
                            <img src="" alt="" id="bolsillo" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" alt="" name="imagen_bolsillo" id="imagen_bolsillo"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <input type="submit" value="Guardar" id="btn-upload" class="btn btn-primary">

                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn  btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>


        </div>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de cortes en almacen</h4>
    </div>
    <div class="card-body">
        <table id="almacenes" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>Usuario</th>
                    <th>Num. Corte</th>
                    <th>Ref.</th>
                    <th>Total Alm.</th>
                    <th>Total Corte</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>Usuario</th>
                    <th>Num. Corte</th>
                    <th>Ref.</th>
                    <th>Total Alm.</th>
                    <th>Total Corte</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>



<!-- Modal -->
<div class="modal fade bd-talla-modal-xl" tabindex="-1" id="modalAlmacen" role="dialog"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reportar tallas:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="" class="mt-1">Referencia producto: </label>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="genero" id="genero" class="form-control text-center font-weight-bold" readonly>
                        <input type="hidden" name="producto_id" id="producto_id">
                        <input type="hidden" name="almacen_id" id="almacen_id">
                    </div>
                    <div class="col-md-1">

                    </div>
                    <label for="" class="mt-1">Entrada almacen: </label>
                    <div class="col-md-2 mb-2">
                        <input type="text" class="form-control font-weight-bold text-center" name="codigo_entrada" id="codigo_entrada"  readonly>
                        <input type="hidden" name="sec" id="sec">
                    </div>
                </div>
                <div class="div-totales">
                    <div class="row">
                        <div class="col-md-10">
                            <label for="" class="ml-4">Total corte:</label>
                            <table class="table text-sm tabla-almacen-totales ml-2" style="width:90">
                                <thead class="text-center">
                                    <tr>
                                        <th id="ba">A</th>
                                        <th id="bb">B</th>
                                        <th id="bc">C</th>
                                        <th id="bd">D</th>
                                        <th id="be">E</th>
                                        <th id="bf">F</th>
                                        <th id="bg">G</th>
                                        <th id="bh">H</th>
                                        <th id="bi">I</th>
                                        <th id="bj">J</th>
                                        <th id="bk">K</th>
                                        <th id="bl">L</th>
                                        <th id="">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center font-weight-bold">
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
                                        <td id="total"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        {{-- <div class="col-md-3"></div> --}}
                        <div class="col-md-7">
                            <table id="corte_detalle" class="table tabla-almacen-totales ml-2 mr-2" style="width:90">
                                <thead class="text-center text-sm">
                                    <tr>
                                        <th>Pendiente produccion</th>
                                        <th>Pendiente lavanderia</th>
                                        <th>Total terminacion</th>
                                        <th>Perdida X</th>
                                    </tr>
                                </thead>
                                <tbody class="text-sm text-center font-weight-bold">
                                    <tr>
                                        <td id="pendiente_produccion"></td>
                                        <td id="pendiente_lavanderia"></td>
                                        <td id="total_terminacion"></td>
                                        <td id="perdida_x"></td>
                                    </tr>
                                </tbody>


                            </table>
                        </div>

                    </div>
                </div>


                <div class="col-md-12 mt-3">
                    <table id="corte_detalle" class="table tabla-existencia" style="width:100%">
                        <thead class="text-center">
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
                                <th id="">Total</th>
                            </tr>
                        </thead>
                        <tbody id="disponibles">

                        </tbody>
                        <tfoot class="resultados text-center" id="resultados">

                        </tfoot>


                    </table>
                </div>
                <br>
                <div class="row">

                </div>
                <br>
                <div class="row mt-2">
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="ta">A</label>
                        <input type="text" name="a" id="a" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tb">B</label>
                        <input type="text" name="b" id="b" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tc">C</label>
                        <input type="text" name="c" id="c" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="td">D</label>
                        <input type="text" name="d" id="d" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="te">E</label>
                        <input type="text" name="e" id="e" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tf">F</label>
                        <input type="text" name="f" id="f" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tg">G</label>
                        <input type="text" name="g" id="g" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="th">H</label>
                        <input type="text" name="" id="h" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="ti">I</label>
                        <input type="text" name="i" id="i" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tj">J</label>
                        <input type="text" name="j" id="j" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tk">K</label>
                        <input type="text" name="k" id="k" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tl">L</label>
                        <input type="text" name="l" id="l" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                </div>
                <hr>
                <button class="btn btn-primary rounded-pill" name="btn-agregar" id="btn-agregar"><i
                        class="fas fa-plus"></i>
                    Agregar</button>
                <a  class="btn btn-secondary rounded-pill float-right text-white" name="btn-imprimir" id="btn-imprimir"><i
                        class="fas fa-print"></i>
                    Imprimir</a>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>


@include('adminlte/scripts')
<script src="{{asset('js/corte/almacen.js')}}"></script>





@endsection
