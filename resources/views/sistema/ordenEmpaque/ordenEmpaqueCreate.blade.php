@extends('adminlte.layout')

@section('seccion', 'Ordenes de empaque')

@section('title', 'Orden de empaque')

@section('content')

<div class="row mt-3 ml-3">
    {{-- <button class="btn btn-primary mb-3" id="btnAgregar"> <i class="fas fa-th-list"></i></button> --}}
    {{-- <button class="btn btn-danger mb-3 " id="btnCancelar"> <i class="fas fa-window-close"></i></button> --}}
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
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5><strong> Formulario Orden Empaque:</strong></h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">No. Orden pedido:</label>
                            <input type="text" name="no_orden_pedido" id="no_orden_pedido"
                                class="form-control text-center font-weight-bold" readonly>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="producto_id" id="producto_id" value="">
                        </div>
                        <div class="col-md-8">

                        </div>
                        <div class="col-md-2 ">
                            {{-- <label for="">No. Orden empaque:</label>
                            <input type="text" name="no_orden_empaque" id="no_orden_empaque"
                                class="form-control text-center font-weight-bold" readonly> --}}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="">Cliente</label>
                            <input type="text" name="cliente" id="cliente"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Sucursal</label>
                            <input type="text" name="sucursal" id="sucursal"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Fecha entrega:</label>
                            <input type="text" name="fecha_entrega" id="fecha_entrega"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                    </div>
                    <div class="container">
                        <label for="" class="mt-5">Orden de empaque</label>
                        <div class="table-responsive">
                            <table id="orden_detalle" class="table datatables mt-5 mb-3 tabla-tallas" style="width:103%;">
                                <thead class="tabla-tallas">
                                    <tr>
                                        <th class="talla_head">MUJER PLUS:</th>
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

                                    </tr>
                                    <tr>
                                        <th class="talla_head">MUJER:</th>
                                        <td class="talla">0/0</td>
                                        <td class="talla">1/2</td>
                                        <td class="talla">3/4</td>
                                        <td class="talla">5/6</td>
                                        <td class="talla">7/8</td>
                                        <td class="talla">9/10</td>
                                        <td class="talla">11/12</td>
                                        <td class="talla">13/14</td>
                                        <td class="talla">15/16</td>
                                        <td class="talla">17/18</td>
                                        <td class="talla">19/20</td>
                                        <td class="talla">21/22</td>
                                        <td class="talla"></td>

                                    </tr>
                                    <tr>
                                        <th class="talla_head">HOMBRE:</th>
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
                                        <th class="talla_head">NIÑO:</th>
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
                                        <th class="talla_head">NIÑA:</th>
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
                                        <th class="talla_head">Referencia</th>
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
                                    </tr>
                                </thead>
                                <tbody id="disponibles">

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="talla_head">Referencia</th>
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
                                    </tr>
                                </tfoot>
                            </table>
                        </div>


                    </div>
                    {{-- <div class="row">
                        <div class="col-md-4">
                            <button id="empacado" class="btn btn-primary"><i class="fas fa-box fa-lg"></i></button>
                            <span id="empacado_listo" class="badge badge-success">Empacado <i class="fas fa-check"></i> </span>
                        </div>
                    </div> --}}



            </div>
            <div class="card-footer">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4 mr-3 ml-3">
                {{-- <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4"> --}}
            </div>

            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header text-center bg-dark">
        <h4 class="text-white">Ordenes empaque</h4>
    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Imprimir ordenes empaque')->where('ver', 1)->first())
        <table id="print_OE" class="table table-striped table-bordered datatables">
            <thead>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>#</th>
                    <th>User Aprob</th>
                    <th>Cliente</th>
                    <th>Sucursal</th>
                    <th>F. aprob.</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>F. Entr.</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>#</th>
                    <th>User Aprob</th>
                    <th>Cliente</th>
                    <th>Sucursal</th>
                    <th>F. aprob.</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>F. Entr.</th>
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



@include('adminlte/scripts')
<script src="{{asset('js/orden_empaque/orden_empaque.js')}}"></script>





@endsection
