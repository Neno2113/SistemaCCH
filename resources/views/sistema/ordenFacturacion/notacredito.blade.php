@extends('adminlte.layout')

@section('seccion', 'Facturacion')

@section('title', 'Nota de credito')

@section('content')

<div class="row">
    <div class="col-12">
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
                    <h5>Formulario Nota de Credito</h5>
                    <hr>
                    <div class="row" id="buscador">
                        <div class="col-md-6">
                            <select name="tags[]" id="facturas" class="form-control select2">
                                <option value="" disabled>Facturas</option>
                            </select>
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-1 ml-2">
                            <button type="button" id="btn-buscar" class="btn btn-secondary btn-block rounded-pill"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <div id="factura-form">
                        <div class="row">
                            <div class="col-md-2">
                                <label for="">No. Factura:</label>
                                <input type="text" name="no_factura" id="no_factura"
                                    class="form-control text-center font-weight-bold" readonly>
                                <input type="hidden" name="factura_id" id="factura_id" value="">
                                <input type="hidden" name="orden_facturacion_id" id="orden_facturacion_id" value="">
                            </div>
                            <div class="col-md-8">

                            </div>

                        </div>
                        <div class="row mt-3" id="">
                            <div class="col-md-4">
                                <label for="">Cliente:</label>
                                <input type="text" name="cliente" id="cliente"
                                    class="form-control text-center font-weight-bold" readonly>
                                <input type="hidden" name="cliente_id" id="cliente_id">
                            </div>
                            <div class="col-md-4">
                                <label for="">Sucursal:</label>
                                <input type="text" name="sucursal" id="sucursal"
                                    class="form-control text-center font-weight-bold" readonly>
                                    <input type="hidden" name="sucursal_id" id="sucursal_id">
                            </div>
                            <div class="col-md-2">
                                <label for="">Fecha factura:</label>
                                <input type="text" name="fecha_factura" id="fecha_factura"
                                    class="form-control text-center font-weight-bold" readonly>
                            </div>
                            <div class="col-md-2">
                                <label for="">Fecha impresion:</label>
                                <input type="text" name="fecha_impresion" id="fecha_impresion"
                                    class="form-control text-center font-weight-bold" readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4 mt-2">
                                <label for="">Total Factura</label>
                                <input type="text" name="precio_lista_factura" id="precio_lista_factura"
                                    class="form-control text-center font-weight-bold" readonly>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="">Tipo Nota de credito</label>
                                <select name="tipo_nota_credito" id="tipo_nota_credito" class="form-control">
                                    <option value="CN">NOTA DE CREDITO</option>
                                    <option value="CB">NOTA DE CREDITO NCF</option>
                                </select>
                            </div>

                            <div class="col-md-4 mt-2">
                                <label for="">No. Nota de credito:</label>
                                <input type="text" name="no_nota_credito" id="no_nota_credito"
                                    class="form-control text-center font-weight-bold" data-inputmask='"mask": "aa-999999999"' data-mask>
                                <input type="hidden" name="sec" id="sec" value="">
                                <input type="hidden" name="nc_id" id="nc_id" value="">
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-2 mt-2">
                                <label for="">ITBIS</label>
                                <input type="text" name="itbis_m" id="itbis" class="form-control text-center"
                                    data-inputmask='"mask": "99[99]%"' data-mask>
                            </div>
                            <div class="col-md-2 mt-2">
                                <label for="">Descuento</label>
                                <input type="text" name="descuento_m" id="descuento" class="form-control text-center"
                                    data-inputmask='"mask": "99[99]%"' data-mask>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4 mt-2 pt-2">
                                <button class="btn btn-secondary float-right mt-4" id="btn-generar"><i class="fas fa-file-alt"></i> Generar</button>
                            </div>
                            {{-- <div class="col-md-4 mt-2" id="comprobante">
                                <label for="">NCF</label>
                                <input type="text" name="ncf" id="ncf" class="form-control font-weight-bold">

                            </div> --}}
                        </div>
                    </div>

                    <div id="detalle-factura">
                        <label for="" class="mt-5">Detalle Factura</label>
                        <table id="invoice_detail" class="table datatables tabla-detalle mt-5 mb-3 mr-5 tabla-nc"
                            style="width:103%; margin-left: -15px;">
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
                                    <td class="talla">31</td>
                                    <td class="talla">32</td>
                                    <td class="talla">34</td>
                                    <td class="talla">36</td>
                                    <td class="talla">38</td>
                                    <td class="talla">40</td>
                                    <td class="talla">42</td>
                                    <td class="talla">44</td>
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
                                    <th class="talla_head">Guardar</th>

                                </tr>
                            </thead>

                            <tbody id="disponibles" class="text-sm">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="talla"></th>
                                    <td class="talla">A</td>
                                    <td class="talla">B</td>
                                    <td class="talla">C</td>
                                    <td class="talla">D</td>
                                    <td class="talla">E</td>
                                    <td class="talla">F</td>
                                    <td class="talla">G</td>
                                    <td class="talla">H</td>
                                    <td class="talla">I</td>
                                    <td class="talla">J</td>
                                    <td class="talla">K</td>
                                    <td class="talla">L</td>
                                    <td class="talla"></td>

                                </tr>
                            </tfoot>

                        </table>
                    </div>

                    {{-- <div class="row mt-2" id="">
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sa">A</label>
                                <input type="number" name="" id="a" class="form-control text-center"
                                    readonly>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sb">B</label>
                                <input type="number" name="" id="b" class="form-control text-center"
                                    readonly>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sc">C</label>
                                <input type="number" name="" id="c" class="form-control text-center"
                                    readonly>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sd">D</label>
                                <input type="number" name="" id="d" class="form-control text-center"
                                    readonly>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="se">E</label>
                                <input type="number" name="" id="e" class="form-control text-center"
                                    readonly>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sf">F</label>
                                <input type="number" name="" id="f" class="form-control text-center"
                                    readonly>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sg">G</label>
                                <input type="number" name="" id="g" class="form-control text-center"
                                    readonly>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sh">H</label>
                                <input type="number" name="" id="h" class="form-control text-center"
                                    readonly>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="si">I</label>
                                <input type="number" name="" id="i" class="form-control text-center"
                                    readonly>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sj">J</label>
                                <input type="number" name="" id="j" class="form-control text-center"
                                    readonly>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sk">K</label>
                                <input type="number" name="k" id="k" class="form-control text-center"
                                    readonly>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sl">L</label>
                                <input type="number" name="l" id="l" class="form-control text-center"
                                    readonly>
                            </div>
                        </div> --}}




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
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                <h4 class="text-white text-center">Nota de creditos</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        <table id="facturas_listadas" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Opciones</th>
                    <th># Nota</th>
                    <th># Factura</th>
                    <th>Cliente</th>
                    <th>Sucursal</th>
                    <th>Fecha fact.</th>
                    <th>Fecha Nota</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Opciones</th>
                    <th># Nota</th>
                    <th># Factura</th>
                    <th>Cliente</th>
                    <th>Sucursal</th>
                    <th>Fecha fact.</th>
                    <th>Fecha Nota</th>
                    <th>Total</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="container" id="listadoUsers">


</div>




@include('adminlte/scripts')
<script src="{{asset('js/orden_facturacion/nota_credito.js')}}"></script>



@endsection
