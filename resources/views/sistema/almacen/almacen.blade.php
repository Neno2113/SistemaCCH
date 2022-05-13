@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Almacen')

@section('content')

<div class="row mt-3 ml-3">
    <div class="col-md-6">
        {{-- <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button> --}}
        {{-- <a href="/sistemaCCH/public/producto-terminado" class="btn btn-info mb-3 ml-2"><i class="fas fa-link mr-2"></i>
            ir a producto terminado </a> --}}
    </div>
</div>

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
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body" enctype="multipart/form-data">
                    <h5>Formulario de entrada a almacen</h5>
                    <hr>

                    <div class="row" id="corte-div">
                        <div class="col-md-4">
                            <label for="" class="d-flex justify-content-center pers">Corte</label>
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
                        <div class="col-md-2 mt-1">
                            <button type="button" id="btn-buscar" class="btn btn-secondary btn-block rounded-pill"><i
                                    class="fas fa-search"></i></button>
                        </div>
                        <div class="col-md-4">
                            <label for="" class="d-flex justify-content-center pers">Fecha</label>
                            <input type="date" name="fecha_entrada" id="fecha_entrada" class="form-control">
                        </div>
                        <br>
                        <hr>
                    </div>
                    <br>
                    <hr>
                    <!-- cristobal
                    <div class="row mt-3" id="form_talla">
                        
                        <div class="col-md-4 mt-2">
                            <button type="button" class="btn btn-primary btn-block mt-4  rounded-pill" id="entrada_alm"
                                data-toggle="modal">
                                <i class="fas fa-sort-alpha-down"></i> Entrada por talla</button>
                        </div>
                        <br>
                        <hr>
                    </div>
                    -->
                    <div class="div" id="entrada-form">
                        <div class="row">
                            <label for="" class="mt-1">Referencia producto: </label>
                            <div class="col-md-2 mb-2">
                                <input type="text" name="genero" id="genero"
                                    class="form-control text-center font-weight-bold" readonly>
                                <input type="hidden" name="producto_id" id="producto_id">
                                <input type="hidden" name="almacen_id" id="almacen_id">
                            </div>

                            <label for="" class="mt-1">Entrada almacen: </label>
                            <div class="col-md-2 mb-2">
                                <input type="text" class="form-control font-weight-bold text-center"
                                    name="codigo_entrada" id="codigo_entrada" readonly>
                                <input type="hidden" name="sec" id="sec">
                            </div>

                            <label for="" class="mt-1">Ubicacion: </label>
                        <!--    <div class="col-md-1">
                        
                            </div> -->
                            <button class="btn btn-dark btn-sm mb-1" id="btn-cat"  type="button"
                                data-toggle="modal" data-target=".bd-ubicacion-modal-xl"><i class="fas fa-plus-square"></i></button>
                            <div class="col-md-2 mb-2"> 
                                <select name="ubicacion" id="ubicacion" class="form-control">
                                    <option id="ubi-selected" value="" >Ubicacion</option> 
                                </select>
                            </div>
                            <button type="submit" id="btn-guardar-ubi" class="btn btn-primary mt-1 float-right"><i class="far fa-save fa-lg"></i></button>
        
                        </div>
                        <div class="div-totales">

                            <div class="row">
                                {{-- <div class="col-md-3"></div> --}}
                                {{-- <div class="table-responsive"> --}}
                                    <div class="col-md-8">
                                        <h5 for="" class="modal-almacen-h5">Pendientes</h5>
                                        <table id="corte_detalle" class="table tabla-almacen-totales ml-2 mr-2"
                                            style="width:90">
                                            <thead class="text-center text-sm">
                                                <tr>
                                                    <th>Total Cortado</th>
                                                    <th>Pendiente produccion</th>
                                                    <th>Pendiente lavanderia</th>
                                                    <th>Recibido lavanderia</th>
                                                    <th>Total terminacion</th>
                                                    <th>Perdidas</th>
                                                    <th>Segundas</th>
                                                    <th>Perdida X</th>
                                                    {{-- <th>Total entrada</th> --}}
                                                </tr>
                                            </thead>
                                            <tbody class="text-sm text-center font-weight-bold">
                                                <tr>
                                                    <td id="total_cortado"></td>
                                                    <td id="pendiente_produccion"></td>
                                                    <td id="pendiente_lavanderia"></td>
                                                    <td id="recibido_lavanderia"></td>
                                                    <td id="total_terminacion"></td>
                                                    <td id="total_perdidas"></td>
                                                    <td id="total_segundas"></td>
                                                    <td id="perdida_x"></td>
                                                    {{-- <td id="total_entrada"></td> --}}
                                                </tr>
                                            </tbody>


                                        </table>
                                    </div>
                                    <!-- cristobal
                                    <div class="col-md-3">
                                        <h5 for="" class="modal-almacen-h5">Ubicacion</h5>
                                        <table id="corte_detalle" class="table tabla-almacen-totales ml-2 mr-2"
                                            >
                                            <thead class="text-center text-sm">
                                                <tr>
                                                    <th>Ubicacion</th>
                                              
                                                </tr>
                                            </thead>
                                            <tbody class="text-sm text-center font-weight-bold">
                                                <tr>
                                                    <td id="ubicacion"></td>
                                               
                                                </tr>
                                            </tbody>
    
    
                                        </table>
                                    </div>
                                    -->

                                  

                                {{-- </div> --}}
                           

                            </div>

                            <div class="table-responsive">
                                <div class="col-md-12">
                                    <h5 for="" class="modal-almacen-h5">Total entrada por talla</h5>
                                    <table id="total-corte" class="table text-sm tabla-almacen-totales ml-2"
                                        style="width:99%">
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

                        </div>
                        <div class="table-responsive">
                            <div class="col-md-12 mt-3">
                                <h5 class="modal-almacen-h5" style="padding-top: 21px; font-weight:bold;">Entrada nueva
                                </h5>
                                <hr>
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
                                            <th id="">Fecha</th>
                                        </tr>
                                        <tr id="entradas">
                                            <td>
                                                <input name="a" id="a"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                                <input type="number" name="a_m" id="a_m"
                                                    class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>

                                                <input type="text" name="b" id="b"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                                <input type="number" name="b_m" id="b_m"
                                                    class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>

                                                <input type="text" name="c" id="c"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                                <input type="number" name="c_m" id="c_m"
                                                    class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>
                                                {{-- <label for="" class="ml-4" id="td">D</label> --}}
                                                <input type="text" name="d" id="d"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                                <input type="number" name="d_m" id="d_m"
                                                    class="form-control text-center no-shadow  d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>
                                                {{-- <label for="" class="ml-4" id="te">E</label> --}}
                                                <input type="text" name="e" id="e"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                                <input type="number" name="e_m" id="e_m"
                                                    class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>
                                                {{-- <label for="" class="ml-4" id="tf">F</label> --}}
                                                <input type="text" name="f" id="f"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                                <input type="number" name="f_m" id="f_m"
                                                    class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>
                                                {{-- <label for="" class="ml-4" id="tg">G</label> --}}
                                                <input type="text" name="g" id="g"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                                <input type="number" name="g_m" id="g_m"
                                                    class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>
                                                {{-- <label for="" class="ml-4" id="th">H</label> --}}
                                                <input type="text" name="h" id="h"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                                <input type="number" name="h_m" id="h_m"
                                                    class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>
                                                {{-- <label for="" class="ml-4" id="ti">I</label> --}}
                                                <input type="text" name="i" id="i"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                                <input type="number" name="i_m" id="i_m"
                                                    class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>
                                                {{-- <label for="" class="ml-4" id="tj">J</label> --}}
                                                <input type="text" name="j" id="j"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                                <input type="number" name="j_m" id="j_m"
                                                    class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask": "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>
                                                {{-- <label for="" class="ml-4" id="tk">K</label> --}}
                                                <input type="text" name="k" id="k"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='" mask": "999"' data-mask autocomplete="off">
                                                <input type="number" name="k_m" id="k_m"
                                                    class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask" : "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>
                                                {{-- <label for="" class="ml-4" id="tl">L</label> --}}
                                                <input type="text" name="l" id="l"
                                                    class="form-control text-center no-shadow d-md-none d-lg-block"
                                                    data-inputmask='"mask" : "999"' data-mask autocomplete="off">

                                                <input type="number" name="l_m" id="l_m"
                                                    class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                                    data-inputmask='"mask" : "999"' data-mask autocomplete="off">
                                            </td>
                                            <td>

                                            </td>
                                            <td>

                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody id="disponibles">

                                    </tbody>
                                    <tfoot class="resultados text-center" id="resultados">
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                            <p><span class="">NEGRO</span> = Entradas <br/>
                            <span class="text-danger">ROJO</span> = Segundas <br/>
                            <span class="text-primary">AZUL</span> = Ajustes manuales de personal administrativo</p>
                        <br>
                        <hr>
                        <button class="btn btn-primary rounded-pill" name="btn-agregar" id="btn-agregar"><i
                                class="fas fa-plus"></i>
                            Agregar</button> 
                            @if (Auth::user()->role == "Administrador")
                                <label class="switchE">
                                    <input type="checkbox" id="SwitchEditable" class="SwitchEditable">
                                    <span class="sliderE round"></span> 
                                </label>
                                <label for="SwitchEditable">Activar modo editable</label>
                                
                                <a class="btn btn-warning rounded-pill" name="btn-editar-corte" id="btn-editar-corte" data-toggle="modal"
                                    data-target=".edicion-corte"><i
                                        class="fas fa-not-equal"></i>
                                    Editar</a>
                            @endif
                        <a class="btn btn-secondary rounded-pill float-right text-white" name="btn-imprimir"
                            id="btn-imprimir"><i class="fas fa-print"></i>
                            Imprimir</a>
                    </div>
                    <hr>
                    <br>

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
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Volver</button>
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
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">

                <h4 class="text-white text-center">Listado de cortes en almacen</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Entrada Almacen')->where('ver', 1)->first())
        <table id="almacenes" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>Usuario</th>
                    <th>Num. Corte</th>
                    <th>Ref.</th>
                    <th>Ubicacion</th>
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
                    <th>Ubicacion</th>
                    <th>Total Alm.</th>
                    <th>Total Corte</th>
                </tr>
            </tfoot>
        </table>
        @else
        <div class="row" id="alerts">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle"></i>
                     Info
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Acceso negado!</h5>
                        Usted no posee permisos necesarios para realizar esta accion.
                        Para poder realizar la accion debe comunicarse con el administrador.
                  </div>
               
               
                </div>
        
              </div>
              <!-- /.card -->
            </div>
        </div>
        @endif
    </div>
</div>

<!-- Modal SKU-->
<div class="modal fade edicion-corte" tabindex="-1" id="modalEdicionCorte" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><strong>Ajustar Cantidades</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tablaPedido" class="table  mt-2 mb-3 mr-5 tabla-tallas text-sm" style="width:102%;">
                    <thead class="tabla-tallas">
                        <tr>
                            <th class="talla_head">TALLAS</th>
                            <th id="s-a">A</th>
                            <th id="s-b">B</th>
                            <th id="s-c">C</th>
                            <th id="s-d">D</th>
                            <th id="s-e">E</th>
                            <th id="s-f">F</th>
                            <th id="s-g">G</th>
                            <th id="s-h">H</th>
                            <th id="s-i">I</th>
                            <th id="s-j">J</th>
                            <th id="s-k">K</th>
                            <th id="s-l">L</th>
                            <th id="">Total</th>
                        </tr>
                    </thead>
                    <tfoot>
                    <tr id="edicciones">
                        <td>CANTIDADES</td>
                        <td>
                            <input name="a-e" id="a-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                               autocomplete="off">
                            <input type="number" name="a_mm" id="a_mm"
                                class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                autocomplete="off">
                        </td>
                        <td>

                            <input type="text" name="b-e" id="b-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                                autocomplete="off">
                            <input type="number" name="b_mm" id="b_mm"
                                class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                autocomplete="off">
                        </td>
                        <td>

                            <input type="text" name="c-e" id="c-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                                autocomplete="off">
                            <input type="number" name="c_mm" id="c_mm"
                                class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                autocomplete="off">
                        </td>
                        <td>
                            {{-- <label for="" class="ml-4" id="td">D</label> --}}
                            <input type="text" name="d-e" id="d-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                                autocomplete="off">
                            <input type="number" name="d_mm" id="d_mm"
                                class="form-control text-center no-shadow  d-none d-md-block d-lg-none"
                                autocomplete="off">
                        </td>
                        <td>
                            {{-- <label for="" class="ml-4" id="te">E</label> --}}
                            <input type="text" name="e-e" id="e-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                                autocomplete="off">
                            <input type="number" name="e_mm" id="e_mm"
                                class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                               autocomplete="off">
                        </td>
                        <td>
                            {{-- <label for="" class="ml-4" id="tf">F</label> --}}
                            <input type="text" name="f-e" id="f-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                                autocomplete="off">
                            <input type="number" name="f_mm" id="f_mm"
                                class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                autocomplete="off">
                        </td>
                        <td>
                            {{-- <label for="" class="ml-4" id="tg">G</label> --}}
                            <input type="text" name="g-e" id="g-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                                autocomplete="off">
                            <input type="number" name="g_mm" id="g_mm"
                                class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                autocomplete="off">
                        </td>
                        <td>
                            {{-- <label for="" class="ml-4" id="th">H</label> --}}
                            <input type="text" name="h-e" id="h-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                               autocomplete="off">
                            <input type="number" name="h_mm" id="h_mm"
                                class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                autocomplete="off">
                        </td>
                        <td>
                            {{-- <label for="" class="ml-4" id="ti">I</label> --}}
                            <input type="text" name="i-e" id="i-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                                autocomplete="off">
                            <input type="number" name="i_mm" id="i_mm"
                                class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                autocomplete="off">
                        </td>
                        <td>
                            {{-- <label for="" class="ml-4" id="tj">J</label> --}}
                            <input type="text" name="j-e" id="j-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                                autocomplete="off">
                            <input type="number" name="j_mm" id="j_mm"
                                class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                autocomplete="off">
                        </td>
                        <td>
                            {{-- <label for="" class="ml-4" id="tk">K</label> --}}
                            <input type="text" name="k-e" id="k-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                                autocomplete="off">
                            <input type="number" name="k_mm" id="k_mm"
                                class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                autocomplete="off">
                        </td>
                        <td>
                            {{-- <label for="" class="ml-4" id="tl">L</label> --}}
                            <input type="text" name="l-e" id="l-e"
                                class="form-control text-center no-shadow d-md-none d-lg-block"
                                autocomplete="off">

                            <input type="number" name="l_mm" id="l_mm"
                                class="form-control text-center no-shadow d-none d-md-block d-lg-none"
                                autocomplete="off">
                        </td>
                        <td>

                        </td>
                    </tr>
                    </tfoot>
                </table>
            <div class="modal-footer ">
            <button class="btn btn-primary rounded-pill" name="btn-aplicarEditar" id="btn-aplicarEditar"><i
                                class="fas fa-plus"></i> Aplicar</button> 
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
            </div>
        </div>
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

            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade bd-ubicacion-modal-xl" tabindex="-1" role="dialog" id="modalRollos"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Entrada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-h5">Agregar nueva Ubicacion</h5>
                <hr>
                <form action="" class="form-group">
                    <div class="row">
                  
                        <div class="col-4">
                            <label for="">Ubicacion</label>
                            <input type="text" name="newUbicacion" id="newUbicacion" class="form-control text-center"
                            data-inputmask='"mask": "a[a]-9[9[9]]"' data-mask style="text-transform: uppercase;">
                        </div>
                        <div class="col-4 mt-3">
                            <button type="button" id="btn-saveUbicacion" class="btn btn-outline-primary rounded-pill mt-3 " ><i class="fas fa-plus"></i> Agregar</button>

                        </div>
                    </div>
                  
                    <div class="row mt-3">
                        <hr>
                        <table class="table tabla-existencia table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>Ubicacion</th>
                                    <th id="editar-permisos">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="ubicaciones-list">
    
                            </tbody>
                        </table>
                    </div>

                </form>

               
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
               
            </div>
        </div>
    </div>
</div>

@include(' adminlte/scripts') <script src="{{asset('js/corte/almacen.js')}}"></script>





@endsection
