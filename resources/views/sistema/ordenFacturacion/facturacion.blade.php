@extends('adminlte.layout')

@section('seccion', 'Ordenes de facturacion')

@section('title', 'Facturar')

@section('content')

<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3" id="btnAgregar"> <i class="fas fa-th-list"></i></button>
    <button class="btn btn-danger mb-3 " id="btnCancelar"> <i class="fas fa-window-close"></i></button>
    <button class="btn btn-secondary" id="btnImprimir">Print <i class="fas fa-print"></i> </button>
</div>

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
                        <div class="col-md-4 mt-3">
                            <label for="">Fecha(*):</label>
                            <input type="date" name="fecha" id="fecha" class="form-control text-center">
                        </div>
                    </div>
                    <hr>
                    <div class="row mt-5">
                        <div class="col-md-4">
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
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">

                        </div>

                    </div>
                    {{-- <label for="">Detalle</label> --}}
                    <div class="container">
                        <h5 class="mt-3"><strong>Detalle de factura</strong></h5>
                        <table id="facturacion_detalle" class="table table-striped table-bordered datatables mb-5 mb-3"
                            style="width:100%;">
                            <thead>
                                <tr>
                                    <th id="">Referencia</th>
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
                                    <th>Total</th>

                                </tr>
                            </thead>
                            <tbody id="disponibles">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th id="">Referencia</th>
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
                                    <th>Total</th>

                                </tr>
                            </tfoot>
                        </table>

                    </div>



            </div>
            <div class="card-footer   d-flex justify-content-end">
                <button type="submit" value="Generar" id="btn-guardar" class="btn btn-lg btn-secondary mt-4 mr-3 ml-3">
                    <i class="far fa-save fa-lg"></i>
                </button>
                {{-- <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4"> --}}
            </div>

            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="container" id="listadoUsers">
    <table id="orden_facturacion" class="table  table-striped table-bordered datatables mt-2">
        <thead>
            <tr>
                <th></th>
                <th>Accion</th>
                <th>Usuario Gen.</th>
                <th>No. Orden F.</th>
                <th>Fecha Creado.</th>
                <th>No. Orden E.</th>
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
                <th>No. Orden F.</th>
                <th>Fecha Creado.</th>
                <th>No. Orden E.</th>
                <th>Fecha empacado</th>
                {{-- <th>No Orden P.</th>
                <th>F. entrega</th> --}}
            </tr>
        </tfoot>
    </table>

</div>

<div class="container collapse mt-4" id="AprobarPedido">
    <table id="facturas" class="table table-striped table-bordered datatables" style="width: 100%;">
        <thead>
            <tr>
                <th>Actions</th>
                <th>Usuario</th>
                <th># Factura</th>
                <th>Fecha</th>
                <th>Descuento</th>
                <th>ITBIS</th>
                <th># Orden F.</th>
                <th>Tipo Fact.</th>
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
                <th># Orden F.</th>
                <th>Tipo Fact.</th>
            </tr>
        </tfoot>
    </table>
</div>



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