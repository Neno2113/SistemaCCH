@extends('adminlte.layout')

@section('seccion', 'Ordenes de pedido')

@section('title', 'Aprobacion y Redistribuicion')

@section('content')



<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-dark">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario redistribuir orden</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="" class="pers">No. Orden pedido</label>
                            <input type="text" name="no_orden_pedido" id="no_orden_pedido"
                                class="form-control text-center font-weight-bold" readonly>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="producto_id" id="producto_id" value="">
                        </div>
                        <div class="col-md-3">
                            <label for="" class="pers">Cliente</label>
                            <input type="text" name="cliente_apro" id="cliente_apro"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="pers">Sucursal</label>
                            <input type="text" name="sucursal_apro" id="sucursal_apro"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="pers">Vendedor</label>
                            <input type="text" name="vendedor" id="vendedor"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                    </div>
                    <label for="" style="font-size:20px;" class="mt-3 d-flex justify-content-center pers">Detalle
                        orden</label><span class="badge badge-success ml-2" id="badge-red">Redistribuido <i
                            class="fas fa-check"></i></span>
                    <hr>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Producto</label>
                            <select name="productos" id="productos" class="form-control text-center">

                            </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <button class="btn btn-outline-dark mt-4 rounded-pill" id="btn-seleccionar"><i class="fas fa-hand-pointer"></i> Seleccionar</button>
                        </div>
                        <div class="col-md-4 mt-2">
                            <button type="button" class="btn btn-secondary  btn-block mt-4" data-toggle="modal"
                            data-target=".bd-sku-modal-xl" id="btn-sku"><i class="fas fa-barcode"></i> Ver Pedido</button>
                        </div>
                    </div>
                    <div class="">
                        <table id="detalle" class="table  mt-2 mb-3 mr-5 tabla-tallas text-sm" style="width:102%;">
                            <thead class="tabla-tallas">
                                <tr>
                                    <th class="talla_head">PLUS</th>
                                    <td class="talla">12W</td>
                                    <td class="talla">14W</td>
                                    <td class="talla">16W</td>
                                    <td class="talla">18W</td>
                                    <td class="talla">20W</td>
                                    <td class="talla">22W</td>
                                    <td class="talla">24W</td>
                                    <td class="talla">26W</td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                </tr>
                                <tr>
                                    <th class="talla_head">MUJER</th>
                                    <td class="talla">0/0 </td>
                                    <td class="talla">1/2 </td>
                                    <td class="talla">3/4 </td>
                                    <td class="talla">5/6 </td>
                                    <td class="talla">7/8 </td>
                                    <td class="talla">9/10 </td>
                                    <td class="talla">11/12</td>
                                    <td class="talla">13/14</td>
                                    <td class="talla">15/16</td>
                                    <td class="talla">17/18</td>
                                    <td class="talla">19/20</td>
                                    <td class="talla">21/22</td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                </tr>
                                <tr>
                                    <th class="talla_head">HOMBRE</th>
                                    <td class="talla">28</td>
                                    <td class="talla">29</td>
                                    <td class="talla">30</td>
                                    <td class="talla">32</td>
                                    <td class="talla">34</td>
                                    <td class="talla">36</td>
                                    <td class="talla">38</td>
                                    <td class="talla">40</td>
                                    <td class="talla">42</td>
                                    <td class="talla">44</td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                </tr>
                                <tr>
                                    <th class="talla_head">NIÑO</th>
                                    <td class="talla">2</td>
                                    <td class="talla">4</td>
                                    <td class="talla">6</td>
                                    <td class="talla">8</td>
                                    <td class="talla">10</td>
                                    <td class="talla">12</td>
                                    <td class="talla">14</td>
                                    <td class="talla">16</td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                </tr>
                                <tr>
                                    <th class="talla_head">NIÑA</th>
                                    <td class="talla">2</td>
                                    <td class="talla">4</td>
                                    <td class="talla">6</td>
                                    <td class="talla">8</td>
                                    <td class="talla">10</td>
                                    <td class="talla">12</td>
                                    <td class="talla">14</td>
                                    <td class="talla">16</td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                </tr>
                                <tr>
                                    <th class="talla_head">Ref</th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head"></th>
                                    <th class="talla_head">Total</th>
                                    <th class="talla_head">Cant</th>
                                    <th class="talla_head">Man</th>
                                </tr>

                            </thead>
                            <tbody id="disponibles" class="text-sm">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="talla_head">Ref</th>
                                    <th class="talla_head">A</th>
                                    <th class="talla_head">B</th>
                                    <th class="talla_head">C</th>
                                    <th class="talla_head">D</th>
                                    <th class="talla_head">E</th>
                                    <th class="talla_head">F</th>
                                    <th class="talla_head">G</th>
                                    <th class="talla_head">H</th>
                                    <th class="talla_head">I</th>
                                    <th class="talla_head">J</th>
                                    <th class="talla_head">K</th>
                                    <th class="talla_head">L</th>
                                    <th class="talla_head">Total</th>
                                    <th class="talla_head">Cant</th>
                                    <th class="talla_head">Man</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>



            </div>
            <div class="card-footer">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                {{-- <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4"> --}}
            </div>

            </form>
        </div>
    </div>
</div>


<div class="card" id="listadoUsers">
    <div class="card-header text-center bg-dark">
        <h4 class="text-white">Listado de ordenes</h4>
    </div>
    <div class="card-body">

        <div class="" id="AprobarPedido">
            @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Aprobar y redistribuir')->where('ver', 1)->first())
            <table id="ordenes_aprobacion" class="table table-striped table-bordered datatables" style="width: 100%;">
                <thead>
                    <tr>
                        <th></th>
                        <th>Actions</th>
                        <th>#</th>
                        <th>Vendedor</th>
                        <th>Cliente</th>
                        <th>Sucursal</th>
                        <th>Fecha</th>
                        <th>F. Entr.</th>
                        {{-- <th>F. Aprob.</th> --}}
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Actions</th>
                        <th>#</th>
                        <th>Vendedor</th>
                        <th>Cliente</th>
                        <th>Sucursal</th>
                        <th>Fecha</th>
                        <th>F. Entr.</th>
                        {{-- <th>F. Aprob.</th> --}}
                        <th>Total</th>
                        <th>Status</th>
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

{{-- <div class="container collapse mt-4" id="RedistribuirPedido">
    <table id="ordenes_red" class="table table-striped table-bordered datatables" style="width: 100%;">
        <thead>
            <tr>
                <th>Actions</th>
                <th>#</th>
                <th>Ref.</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>Total</th>
                <th>Precio</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>Actions</th>
                <th>#</th>
                <th>Ref.</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>Total</th>
                <th>Precio</th>
                <th>Status</th>
            </tr>
        </tfoot>
    </table>
</div> --}}


<!-- Modal SKU-->
<div class="modal fade bd-sku-modal-xl" tabindex="-1" id="modalSKU" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><strong>Orden de pedido</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="tablaPedido" class="table  mt-2 mb-3 mr-5 tabla-tallas text-sm" style="width:102%;">
                    <thead class="tabla-tallas">
                        <tr>
                            <th class="talla_head">PLUS</th>
                            <td class="talla">12W</td>
                            <td class="talla">14W</td>
                            <td class="talla">16W</td>
                            <td class="talla">18W</td>
                            <td class="talla">20W</td>
                            <td class="talla">22W</td>
                            <td class="talla">24W</td>
                            <td class="talla">26W</td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                        </tr>
                        <tr>
                            <th class="talla_head">MUJER</th>
                            <td class="talla">0/0 </td>
                            <td class="talla">1/2 </td>
                            <td class="talla">3/4 </td>
                            <td class="talla">5/6 </td>
                            <td class="talla">7/8 </td>
                            <td class="talla">9/10 </td>
                            <td class="talla">11/12</td>
                            <td class="talla">13/14</td>
                            <td class="talla">15/16</td>
                            <td class="talla">17/18</td>
                            <td class="talla">19/20</td>
                            <td class="talla">21/22</td>
                            <td class="talla"></td>
                        </tr>
                        <tr>
                            <th class="talla_head">HOMBRE</th>
                            <td class="talla">28</td>
                            <td class="talla">29</td>
                            <td class="talla">30</td>
                            <td class="talla">32</td>
                            <td class="talla">34</td>
                            <td class="talla">36</td>
                            <td class="talla">38</td>
                            <td class="talla">40</td>
                            <td class="talla">42</td>
                            <td class="talla">44</td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                        </tr>
                        <tr>
                            <th class="talla_head">NIÑO</th>
                            <td class="talla">2</td>
                            <td class="talla">4</td>
                            <td class="talla">6</td>
                            <td class="talla">8</td>
                            <td class="talla">10</td>
                            <td class="talla">12</td>
                            <td class="talla">14</td>
                            <td class="talla">16</td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                        </tr>
                        <tr>
                            <th class="talla_head">NIÑA</th>
                            <td class="talla">2</td>
                            <td class="talla">4</td>
                            <td class="talla">6</td>
                            <td class="talla">8</td>
                            <td class="talla">10</td>
                            <td class="talla">12</td>
                            <td class="talla">14</td>
                            <td class="talla">16</td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                            <td class="talla"></td>
                        </tr>
                        <tr>
                            <th class="talla_head">Ref</th>
                            <th class="talla_head"></th>
                            <th class="talla_head"></th>
                            <th class="talla_head"></th>
                            <th class="talla_head"></th>
                            <th class="talla_head"></th>
                            <th class="talla_head"></th>
                            <th class="talla_head"></th>
                            <th class="talla_head"></th>
                            <th class="talla_head"></th>
                            <th class="talla_head"></th>
                            <th class="talla_head"></th>
                            <th class="talla_head"></th>
                            <th class="talla_head">Total</th>
                            <th class="talla_head">Cant</th>
                        </tr>

                    </thead>
                    <tbody id="ver_pedido" class="text-sm">

                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="talla_head">Ref</th>
                            <th class="talla_head">A</th>
                            <th class="talla_head">B</th>
                            <th class="talla_head">C</th>
                            <th class="talla_head">D</th>
                            <th class="talla_head">E</th>
                            <th class="talla_head">F</th>
                            <th class="talla_head">G</th>
                            <th class="talla_head">H</th>
                            <th class="talla_head">I</th>
                            <th class="talla_head">J</th>
                            <th class="talla_head">K</th>
                            <th class="talla_head">L</th>
                            <th class="talla_head">Total</th>
                            <th class="talla_head">Cant</th>
                        </tr>
                    </tfoot>
                </table>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
          
        </div>
    </div>
</div>


@include('adminlte/scripts')
<script src="{{asset('js/orden_pedido/orden_aprobacion.js')}}"></script>





@endsection
