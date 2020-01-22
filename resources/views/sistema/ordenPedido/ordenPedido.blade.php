@extends('adminlte.layout')

@section('seccion', 'Ordenes de pedido')

@section('title', 'Orden de Pedido')

@section('content')

<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>

</div>

<div class="row" id="creacion-orden">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4>Formulario de orden de pedido:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div id="orden_create">
                        <div class="row mt-3">
                            <div class="col-md-6" id="clienteBuscar">
                                <label for="">Cliente(*):</label>
                                <select name="tags[]" id="clienteSearch" class="form-control select2">
                                </select>
                            </div>
                            <div class="col-md-6" id="cliente">
                                <label for="">Cliente(*):</label>
                                <input type="text" name="client" id="client"
                                    class="form-control font-weight-bold text-center mt-2" readonly>
                            </div>
                            <div class="col-md-6" id="sucursalBuscar">
                                <label for="">Sucursal(*):</label>
                                <select name="tags[]" id="sucursalSearch" class="form-control select2">
                                </select>
                            </div>
                            <div class="col-md-6" id="sucursal">
                                <label for="">Sucursal(*):</label>
                                <input type="text" name="sucur" id="sucur"
                                    class="form-control font-weight-bold text-center mt-2" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row mt-3">
                            <div class="col-md-4 mt-2">
                                <label for="">Vendedor:</label>
                                <select name="tags[]" id="vendedores" class="form-control select2">

                                </select>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="">Fecha de entrega:</label>
                                <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control">
                                <input type="hidden" name="" id="fecha_proceso" value="">
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="autorizacion_credito_req">¿Generado internamente?(*):</label>
                                <div class="form-group clearfix" id="genInt">
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
                                <input type="text" name="generado_internamente" id="generado_internamente"
                                    class="form-control  text-center font-weight-bold" readonly>
                            </div>
                         
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <label for="">Notas:</label>
                                <textarea name="notas" id="notas" cols="30" rows="1" class="form-control"></textarea>
                            </div>
                         
                            <div class="col-md-2">
                                <label for="">Orden de pedido:</label>
                                <input type="text" name="no_orden_pedido" id="no_orden_pedido"
                                    class="form-control text-center " readonly>
                                <input type="hidden" name="orden_pedido_id" id="orden_pedido_id">
                                <input type="hidden" name="orden_pedido_id_proceso" id="orden_pedido_id_proceso">
                                <input type="hidden" name="sec" id="sec" value="">
                                <input type="hidden" name="cliente_segundas" id="cliente_segundas" value="">
                                <input type="hidden" name="venta_segunda" id="venta_segunda" value="">
                                <input type="hidden" name="sec_proceso" id="sec_proceso" value="">
                                <input type="hidden" name="no_orden_pedido_proceso" id="no_orden_pedido_proceso">
                            </div>
                            <div class="col-md-1 mt-4 pt-2">
                                <button class="btn btn-secondary btn-block rounded-pill" id="btn-generar"><i
                                        class="fas fa-truck-loading"></i></button>
                            </div>
                          
                        </div>
                        <br>
                        <hr>
                    </div>
                    <br>
                    <div id="orden_detalle">


                        <div class="row" id="producto">
                            <div class="col-md-3 " id="productoBuscar">
                                <label for="">Referencia Producto</label>
                                <select name="tags[]" id="productoSearch" class="form-control select2"
                                    style="width:100%">
                                </select>
                            </div>
                            {{-- <div class="col-md-3 " id="producto">
                            <label for="">Referencia Producto</label>
                            <input type="text" name="referencia_producto" id="referencia_producto"
                                class="form-control font-weight-bold text-center" readonly>
                        </div> --}}
                            <div class="col-md-2 mt-2 border-right">
                                <label for="">¿Detallado?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary5" name="r2" value="1">
                                        <label for="radioPrimary5">
                                            Si
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary6" name="r2" value="0" checked>
                                        <label for="radioPrimary6">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6" id="corte_en_proceso">
                                <label for="">En proceso</label>
                                <table class="table table-bordered ">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>No. Corte</th>
                                            <th>Fase</th>
                                            <th>F. Entrega</th>
                                            <th>Cantidad</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody id="corteProceso">
                                        <tr>
                                            <td id="no_corte"></td>
                                            <td id="fase"></td>
                                            <td id="f_entrega"></td>
                                            <th><input type="text" name="cantidad_proceso" id="cantidad_proceso"
                                                    class="form-control"></th>
                                            <th><button id='btn-agregarProceso' class='btn btn-success'> Agregar</button>
                                            </th>
                                            <input type="hidden" name="corte_proceso" id="corte_proceso" value="">
                                        </tr>
                                    </tbody>


                                </table>
                            </div>


                            <div class="col-md-4" id="redistribucion">
                                <label for="">Cantidad:</label>
                                <input type="text" name="cantidad" id="cantidad" class="form-control">
                            </div>

                        </div>
                        <div class="container collapse mt-4" id="listarOrden">
                            <table id="orden" class="table table-striped table-bordered datatables"
                                style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Referencia</th>
                                        <th>A</th>
                                        <th>B</th>
                                        <th>C</th>
                                        <th>D</th>
                                        <th>E</th>
                                        <th>F</th>
                                        <th>G</th>
                                        <th>H</th>
                                        <th>I</th>
                                        <th>J</th>
                                        <th>K</th>
                                        <th>L</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                                <tfoot>
                                    <tr>
                                        <th>Referencia</th>
                                        <th>A</th>
                                        <th>B</th>
                                        <th>C</th>
                                        <th>D</th>
                                        <th>E</th>
                                        <th>F</th>
                                        <th>G</th>
                                        <th>H</th>
                                        <th>I</th>
                                        <th>J</th>
                                        <th>K</th>
                                        <th>L</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mt-3">
                                <button class="btn btn-success rounded-pill" name="btn-consultar" id="btn-consultar"><i
                                        class="fas fa-search"></i> Consultar</button>
                            </div>
                            <div class="col-md-2 ">

                            </div>

                        </div>
                        <div class="row border-right" id="tallas">
                            <div class="col-md-3 mt-3 " id="precio_div">
                                <label for="">Precio(*):</label>
                                <input type="text" name="precio" id="precio" class="form-control text-center"
                                    data-inputmask='"mask": "9,999RD$"' data-mask>
                            </div>
                            <div class="col-md-2 mt-3" id="total_div">
                                <label for="">Total Ref.:</label>
                                <input type="text" name="total" id="total" class="form-control text-center" readonly>
                            </div>
                            <div class="col-md-4 mr-3">

                            </div>

                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="row" id="detallada">
                            <label for="">Disponible:</label>
                            <table class="table table-bordered  mb-3">
                                <thead class="thead-light">
                                    <tr>
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
                                <tbody id="disponibles">

                                </tbody>

                            </table>
                        </div>

                        <div class="row mt-3" id="detalles">
                            <div class="col-lg-1 ">
                                {{-- <label for="" class="ml-4" id="da">A</label> --}}
                                <input type="text" name="" id="a" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1">
                                {{-- <label for="" class="ml-4" id="db">B</label> --}}
                                <input type="text" name="" id="b" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1">
                                {{-- <label for="" class="ml-4" id="dc">C</label> --}}
                                <input type="text" name="" id="c" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1">
                                {{-- <label for="" class="ml-4" id="dd">D</label> --}}
                                <input type="text" name="" id="d" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1">
                                {{-- <label for="" class="ml-4" id="de">E</label> --}}
                                <input type="text" name="" id="e" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1">
                                {{-- <label for="" class="ml-4" id="df">F</label> --}}
                                <input type="text" name="" id="f" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1">
                                {{-- <label for="" class="ml-4" id="dg">G</label> --}}
                                <input type="text" name="" id="g" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1">
                                {{-- <label for="" class="ml-4" id="dh">H</label> --}}
                                <input type="text" name="" id="h" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1">
                                {{-- <label for="" class="ml-4" id="di">I</label> --}}
                                <input type="text" name="" id="i" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1">
                                {{-- <label for="" class="ml-4" id="dj">J</label> --}}
                                <input type="text" name="" id="j" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1">
                                {{-- <label for="" class="ml-4" id="dk">K</label> --}}
                                <input type="text" name="" id="k" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1">
                                {{-- <label for="" class="ml-4" id="dl">L</label> --}}
                                <input type="text" name="" id="l" class="form-control text-center"
                                data-inputmask='"mask": "999"' data-mask>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <button class="btn btn-info rounded-lg" name="btn-agregar" id="btn-agregar"><i
                                        class="fas fa-plus-circle"></i> Agregar</button>
                            </div>
                        </div>
                        <br>
                        <hr>

                        <div class="row" id="agregadas">
                            <div class="col-md-12 pt-3 pl-3 pb-3">
                                <table class="table  table-bordered  mt-3 ">
                                    <thead class="thead-light">
                                        <tr>

                                            <th>Referencias listadas</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>AP</th>
                                            <th>BP</th>
                                            <th>CP</th>
                                            <th>DP</th>
                                            <th>EP</th>
                                            <th>FP</th>
                                            <th>GP</th>
                                            <th>HP</th>
                                            <th>IP</th>
                                            <th>JP</th>
                                            <th>KP</th>
                                            <th>LP</th>
                                        </tr>
                                    </thead>
                                    <tbody id="orden_pedido">

                                    </tbody>
                                    <tfoot class="light">

                                        <th>Referencias listadas</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>

            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-danger" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i>
                    Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-4 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-4 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>

            </form>
        </div>
    </div>
</div>


<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de ordenes</h4>
    </div>
    <div class="card-body">
        <table id="ordenes" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Actions</th>
                    <th>#</th>
                    <th>User</th>
                    <th>Cliente</th>
                    <th>Sucursal</th>
                    <th>Fecha</th>
                    <th>F. Entrega</th>
                    <th>Total</th>
                    <th>Detallado</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Actions</th>
                    <th>#</th>
                    <th>User</th>
                    <th>Cliente</th>
                    <th>Sucursal</th>
                    <th>F. Gen</th>
                    <th>F. Entrega</th>
                    <th>Total</th>
                    <th>Detallado</th>
                </tr>
            </tfoot>
        </table>

    </div>

</div>




@include('adminlte/scripts')
<script type="text/javascript" src="{{asset('js/orden_pedido/ordenPedido.js')}}"></script>

<script type="text/javascript">
    function eliminar(id_orden){
        bootbox.confirm("¿Estas seguro de eliminar esta orden de producto?", function(result){
            if(result){
                $.post("orden_pedido/delete/" + id_orden, function(){
                    bootbox.alert("Orden de pedido eliminada correctamente!!");
                    $("#ordenes").DataTable().ajax.reload();
                })
            }
        })
    }

    function ver(id_orden) {
        $.post("mostrar/" + id_orden, function(data, status) {
           
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-guardar").hide();
            $("#autorizacion_credito_req").show();
            $("#redistribucion_tallas").show();
            $("#factura_desglosada_tallas").show();
            $("#acepta_segundas").show();
            $("#cliente").show();
            $("#clienteBuscar").hide();
            $("#sucursal").show();
            $("#sucursalBuscar").hide();
            $("#btn-generar").attr('disabled', true);
            $("#generado_internamente").show();
            $("#tallas").hide();
            $("#producto").hide();
            $("#genInt").hide();
            $("#agregadas").hide();
            $("#listarOrden").show();

            let result;
            if(data.orden.generado_internamente == 1){
                result = 'Si';
            }else{
                result = 'No';
            }
            $("#orden").DataTable().destroy();
            listarOrden(data.orden.id);
            $("#notas").val(data.orden.notas).attr('readonly', true).addClass("font-weight-bold");
            $("#client").val(data.orden.cliente.nombre_cliente);
            $("#sucur").val(data.orden.sucursal.nombre_sucursal);
            $("#fecha_entrega").val(data.orden.fecha_entrega).attr('disabled', true);
            $("#no_orden_pedido").val(data.orden.no_orden_pedido).addClass("font-weight-bold");
            $("#generado_internamente").val(result);
           
           
        });
    }

    function listarOrden(id) {
       var tabla_orden = $("#orden").DataTable({
            serverSide: true,
            bFilter: false, 
            lengthChange: false,
            bPaginate: false,
            bInfo: false,
            retrieve: true,
            responsive: true,
            ajax: "api/listarorden/"+id,
            columns: [
                { data: "referencia_producto", name: "producto.referencia_producto"},
                { data: "a", name: "orden_pedido_detalle.a" },
                { data: "b", name: "orden_pedido_detalle.b" },
                { data: "c", name: "orden_pedido_detalle.c" },
                { data: "d", name: "orden_pedido_detalle.d" },
                { data: "e", name: "orden_pedido_detalle.e" },
                { data: "f", name: "orden_pedido_detalle.f" },
                { data: "g", name: "orden_pedido_detalle.g" },
                { data: "h", name: "orden_pedido_detalle.h" },
                { data: "i", name: "orden_pedido_detalle.i" },
                { data: "j", name: "orden_pedido_detalle.j" },
                { data: "k", name: "orden_pedido_detalle.k" },
                { data: "l", name: "orden_pedido_detalle.l" },
            ],
            order: [[1, "desc"]],
        });
    }

</script>



@endsection