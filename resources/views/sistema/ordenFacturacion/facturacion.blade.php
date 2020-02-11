@extends('adminlte.layout')

@section('seccion', 'Facturacion')

@section('title', 'Generar factura')

@section('content')

<ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
            href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
            aria-selected="true">Facturar</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
            href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
            aria-selected="false">Imprimir</a>
    </li>
</ul>
<div class="tab-content" id="custom-content-below-tabContent">
    <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel"
        aria-labelledby="custom-content-below-home-tab">
        <div class="container mt-4" id="listadoUsers">
            <table id="orden_facturacion" class="table  table-striped table-bordered datatables mt-2">
                <thead>
                    <tr>
                        <th></th>
                        <th>Accion</th>
                        <th>Usuario Gen.</th>
                        <th>No. Orden E.</th>
                        <th>Fecha Creado.</th>
                        <th>Env. Transporte</th>
                        <th>Fecha empacado</th>
                        {{-- <th>No Orden P.</th>
                        <th>F. entrega</th> --}}
                    </tr>
                </thead>
                <tbody id="disponibles">

                </tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Accion</th>
                        <th>Usuario Gen.</th>
                        <th>No. Orden E.</th>
                        <th>Fecha Creado.</th>
                        <th>Env. Transporte</th>

                        <th>Fecha empacado</th>
                        {{-- <th>No Orden P.</th>
                        <th>F. entrega</th> --}}
                    </tr>
                </tfoot>
            </table>

        </div>
    </div>
    <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
        aria-labelledby="custom-content-below-profile-tab">
        <div class="container  mt-4" id="FacturaImprimir">
            <table id="facturas" class="table table-striped table-bordered datatables" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Actions</th>
                        <th>Usuario</th>
                        <th># Factura</th>
                        <th>Fecha</th>
                        <th>Descuento</th>
                        <th>ITBIS</th>
                        <th>Tipo Fact.</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th>Actions</th>
                        <th>Usuario</th>
                        <th># Factura</th>
                        <th>Fecha</th>
                        <th>Descuento</th>
                        <th>ITBIS</th>
                        <th>Tipo Fact.</th>
                        <th>Status</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

</div>
{{-- <div class="row mt-3" id="btn-opciones">
    <div class="col-md-6 d-flex justify-content-center border-right border-bottom">
        <button class="btn btn-info rounded-pill  mt-3 mb-4" type="button" data-toggle="collapse"
            data-target="#listadoUsers" aria-expanded="false" data-toggle="button" aria-pressed="false"
            aria-controls="listadoUsers"><i class="fas fa-file-invoice-dollar"></i> Generar factura

        </button>
    </div>
    <div class="col-md-6 border-bottom d-flex justify-content-center">
        <button class="btn btn-secondary rounded-pill mt-3 mb-4 border-right" type="button" data-toggle="collapse"
            data-target="#FacturaImprimir" aria-expanded="false" aria-controls="FacturaImprimir">
            <i class="fas fa-print"></i> Imprimir facturas
        </button>
    </div>
</div> --}}

<div class="row mt-3">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4><strong>Facturacion</strong></h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5><strong> Formulario facturacion:</strong></h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-8 ">
                        </div>
                        <div class="col-md-2">
                            <label for="">No. Factura:</label>
                            <input type="text" name="no_factura" id="no_factura"
                                class="form-control text-center font-weight-bold" readonly>
                            <input type="hidden" name="sec" id="sec" value="">
                            <input type="hidden" name="id" id="id" value="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Cliente</label>
                            <input type="text" name="cliente" id="cliente" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Sucursal</label>
                            <input type="text" name="sucursal" id="sucursal" class="form-control" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Fecha entrega</label>
                            <input type="text" name="fecha_entrega" id="fecha_entrega" class="form-control" readonly>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="">Tipo Factura(*):</label>
                            <select name="tipo_factura" id="tipo_factura" class="form-control">
                                <option value="IN">Factura</option>
                                <option value="B01">Credito Fiscal</option>
                                <option value="B02">Consumidor Final</option>
                                <option value="B03">Nota de Debito(Gubernamental)</option>
                                <option value="DN">Nota de Debito(Normal)</option>
                                <option value="B04">Nota de Credito con NCF(Gubernamental)</option>
                                <option value="B14">Comprobante Regimen Especiales</option>
                                <option value="B15">Comprobante Gubernamental</option>
                                <option value="B16">Comprobante para Exportaciones</option>
                                <option value="CN">Nota de Credito</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Numero Factura</label>
                            <input type="text" name="numeracion" id="numeracion" class="form-control">
                        </div>
                        <div class="col-md-2">
                            <label for="">ITBIS</label>
                            <input type="text" name="itbis" id="itbis" class="form-control text-center"
                                data-inputmask='"mask": "99%"' data-mask>
                        </div>
                        <div class="col-md-3">
                            <label for="">Descuento</label>
                            <input type="text" name="descuento" id="descuento" class="form-control text-center"
                                data-inputmask='"mask": "99%"' data-mask>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 mt-3">
                            <label for="">Fecha(*):</label>
                            <input type="date" name="fecha" id="fecha" class="form-control text-center">
                        </div>
                        <div class="col-md-4 mt-3">
                            <div id="comprobante">
                                <label for="">Numero Comprobante</label>
                                <input type="text" name="numero_comprobante" id="numero_comprobante"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Nota:</label>
                            <textarea name="nota" id="nota" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-5">
                        {{-- <div class="col-md-2">
                            <label for="autorizacion_credito_req">¿Comprobante fiscal?(*):</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="r1" value="1">
                                    <label for="radioPrimary1">
                                        Si
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="r1" value="0" checked>
                                    <label for="radioPrimary2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div> --}}
                        <div class="col-md-4">


                        </div>
                        <div class="col-md-4">

                        </div>

                    </div>
                    {{-- <label for="">Detalle</label> --}}
                    <div class="container">
                        <h5 class="mt-3"><strong>Detalle de factura</strong></h5>
                        <table id="facturacion_detalle" class="table datatables mb-5 mb-3 tabla-tallas"
                            style="width:100%;">
                            <thead>
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
            <div class="card-footer ">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info float-right">
                    <i class="far fa-save fa-lg"></i> Guardar
                </button>
                {{-- <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4"> --}}
            </div>

            </form>
        </div>
    </div>
</div>
{{-- </div> --}}







@include('adminlte/scripts')
<script src="{{asset('js/orden_facturacion/facturacion.js')}}"></script>

<script>
    function mostrar(id_orden) {
        $.get("orden_facturacion/" + id_orden, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            // $("#btn-edit").show();
            $("#btn-guardar").show();
            $("#btnImprimir").hide();
            $("#btn-opciones").hide();


            $("#id").val(data.orden_facturacion.id);
            $("#cliente").val(data.orden_pedido.cliente.nombre_cliente);
            $("#sucursal").val(data.orden_pedido.sucursal.nombre_sucursal);
            $("#fecha_entrega").val(data.orden_pedido.fecha_entrega);

            $("#facturacion_detalle").DataTable().destroy();
            listarOrdenDetalle(data.orden_facturacion.id);



        });
    }

      //funcion para listar en el Datatable
      function listarOrdenDetalle(id) {
       var tabla_orden = $("#facturacion_detalle").DataTable({
            serverSide: true,
            bFilter: false,
            lengthChange: false,
            bPaginate: false,
            bInfo: false,
            retrieve: true,
            ajax: "api/factura_detalle/"+id,
            columns: [
                { data: "referencia_producto",name: "producto.referencia_producto"},
                { data: "a",name: "orden_pedido_detalle.a"},
                { data: "b", name: "orden_pedido_detalle.b" },
                { data: "c", name: "orden_pedido_detalle.c" },
                { data: "d", name: "orden_pedido_detalle.d"},
                { data: "e", name: "orden_pedido_detalle.e"},
                { data: "f", name: "orden_pedido_detalle.f"},
                { data: "g", name: "orden_pedido_detalle.g"},
                { data: "h", name: "orden_pedido_detalle.h"},
                { data: "i", name: "orden_pedido_detalle.i"},
                { data: "j", name: "orden_pedido_detalle.j"},
                { data: "k", name: "orden_pedido_detalle.k"},
                { data: "l", name: "orden_pedido_detalle.l"},
                { data: "total", name: "orden_pedido_detalle.total"},

            ],
        });
    }


</script>



@endsection
