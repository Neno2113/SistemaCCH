@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Perdidas')


@section('content')

<div class="row ">
    <div class="col-12 ">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header bg-dark">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de reporte de perdidas</h5>
                    <hr>
                    <div class="d-flex flex-row-reverse">
                        <div class="col-2">
                            <input type="text" name="no_perdida" id="no_perdida" class="form-control text-center"
                            readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="">No. Corte</label>
                            <div id="corteAdd">
                                <select name="cortesSearch" id="cortesSearch" class="form-control select2">
                                </select>
                            </div>
                            <div id="corteEdit" class="mt-2">
                                <input type="text" name="numero_corte" id="numero_corte" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="">Referencia</label>
                            <input type="text" name="referencia_corte" id="referencia_corte" class="form-control text-center">
                        </div>
                        <div class="col-md-4">
                            <label for="">Tipo</label>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="sec" id="sec" value="">
                            <input type="hidden" name="sec_segunda" id="sec_segunda" value="">
                            <select name="tipo_perdida" id="tipo_perdida" class="form-control text-center">
                                <option value="" disabled>Tipo de perdida</option>
                                {{-- <option value="Normal">Total</option>
                                <option value="Segundas">Segundas</option> --}}
                            </select>
                        </div>
                        <div class="col-md-2 mt-3">
                            <button class="btn btn-secondary mt-3" id="btn-generar"><i class="fas fa-trash-restore"></i>
                                Generar</button>
                        </div>
                        {{-- <div class="col-6" id="productoAdd">
                            <label for="">Referencia producto(*):</label>
                            <select name="productos" id="productos" class="form-control select2">
                            </select>
                            <input type="text" name="referencia_producto" id="referencia_producto" class="form-control mt-2">
                        </div> --}}

                    </div>
                    <hr>
                    <div class="row" id="fila1">

                        <div class="col-4">
                            <label for="">Fecha</label>
                            <input type="date" name="fecha" id="fecha" class="form-control">
                        </div>
                        <div class="col-4">
                            <label for="">Fase</label>
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
                        <div class="col-4">
                            <label for="">Motivo</label>
                            <select name="motivo" id="motivo" class="form-control">
                                <option value="" disabled>Motivo</option>
                            </select>
                        </div>
                    </div>
                 
                    <div class="row mt-3" id="fila3">
                        <div class="col-3">
                            <button type="button" class="btn btn-orange btn-block" id="btn-tallas"
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
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Perdidas')->where('agregar', 1)->first())
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                @endif
                <h4 class="text-white text-center">Listado de perdidas</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Perdidas')->where('ver', 1)->first())
        <table id="perdida_listada" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>Imprimir</th>
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
                    <th>Imprimir</th>
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
</div>

<!-- Modal -->
<div class="modal fade bd-talla-modal-xl" tabindex="-1" id="modalPerdida" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reportar perdidas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="">Referencia producto </label>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="genero" id="genero" class="form-control font-weight-bold" readonly>
                    </div>
                </div>
                <div class="row mt-4">
                    {{-- <div class="col-md-3"></div> --}}
                    <div class="table-responsive">
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
                                        <th>Total entrada</th>
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
                                        <td id="total_entrada"></td>
                                    </tr>
                                </tbody>


                            </table>
                        </div>

                    </div>

                </div>

                <div class="table-responsive">
                    <div class="col-md-12 mt-3">
                        <h5 class="modal-almacen-h5" style="padding-top: 21px; font-weight:bold;">Entrada nueva perdida
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
                                        <input type="text" name="" id="h"
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
                                </tr>
                            </thead>
                            <tbody id="disponibles">

                            </tbody>
                            <tfoot class="resultados text-center" id="resultados">

                            </tfoot>


                        </table>
                    </div>

                </div>
           
                {{-- <div class="row mt-3">
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
                        <tbody>
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
                        </tbody>
                        <tfoot>
                            <td>
                                <input type="text" name="" id="a" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                            <td>
                                <input type="text" name="" id="b" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                            <td>
                                <input type="text" name="" id="c" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                            <td>
                                <input type="text" name="" id="d" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                            <td>
                                <input type="text" name="" id="e" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                            <td>
                                <input type="text" name="" id="f" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                            <td>
                                <input type="text" name="" id="g" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                            <td>
                                <input type="text" name="" id="h" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                            <td>
                                <input type="text" name="" id="i" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                            <td>
                                <input type="text" name="" id="j" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                            <td>
                                <input type="text" name="" id="k" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                            <td>
                                <input type="text" name="" id="l" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </td>
                        </tfoot>

                    </table>
                </div> --}}
               
                {{-- <div class="row mt-2">
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="ta">A</label>
                       
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tb">B</label>
                   
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tc">C</label>
                      
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="td">D</label>
                       
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="te">E</label>
                       
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tf">F</label>
                       
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tg">G</label>
                       
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="th">H</label>
                       
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="ti">I</label>
                       
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tj">J</label>
                       
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tk">K</label>
                     
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tl">L</label>
                      
                    </div>
                </div> --}}
                <hr>
                <div class="d-flex flex-row">
                    <div class="col-md-4">
                        <label for="" class="">Talla x:</label>
                        <input type="text" name="talla_x" id="talla_x" class="form-control text-center"
                            placeholder="Solo utilizar esta talla cuando la talla no sea conocida"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    {{-- <div class="col-md-4"></div> --}}
                    <div class="col-md-8 mt-2 d-flex justify-content-end">
                        <button class="btn btn-outline-dark rounded-pill mt-3" name="btn-agregar" id="btn-validar">
                            <i class="fas fa-check-double"></i>
                        Validar</button>
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
