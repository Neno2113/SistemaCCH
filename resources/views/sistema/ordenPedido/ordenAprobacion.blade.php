@extends('adminlte.layout')

@section('seccion', 'Ordenes de pedido')

@section('title', 'Aprobacion y Redistribuicion')

@section('content')


<div class="row mt-3">
    {{-- <div class="col-md-6 d-flex justify-content-center border-right border-bottom">
        <button class="btn btn-secondary rounded-pill  mt-3 mb-4" type="button">
            Aprobar pedidos
        </button>
    </div> --}}
    {{-- <div class="col-md-6 border-bottom d-flex justify-content-center">
        <button class="btn btn-primary rounded-pill mt-3 mb-4 border-right" type="button" data-toggle="collapse"
            data-target="#RedistribuirPedido" aria-expanded="false" aria-controls="RedistribuirPedido">
            Redistribuir pedidos
        </button>
    </div> --}}
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
                <h4><strong>Redistribuir orden</strong></h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5><strong> Formulario redistribuir orden:</strong></h5>
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
                          
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="">Cliente:</label>
                            <input type="text" name="cliente_apro" id="cliente_apro"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Sucursal:</label>
                            <input type="text" name="sucursal_apro" id="sucursal_apro"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Vendedor:</label>
                            <input type="text" name="vendedor" id="vendedor"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                       
                    </div>
                    <div class="container">
                        <label for="" class="mt-5">Detalle orden</label>
                        <table id="detalle" class="table datatables mt-5 mb-3 mr-5 tabla-tallas"
                            style="width:100%;">
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
                                    <td class="talla"></td>
                                </tr>
                
                                <tr>
                                    <th class="talla_head">MUJER:</th>
                                    <td class="talla" >0/0</td>
                                    <td class="talla" >1/2</td>
                                    <td class="talla" >3/4</td>
                                    <td class="talla">5/6</td>
                                    <td class="talla">7/8</td>
                                    <td class="talla">9/10</td>
                                    <td class="talla" >11/12</td>
                                    <td class="talla" >13/14</td>
                                    <td class="talla" >15/16</td>
                                    <td class="talla" >17/18</td>
                                    <td class="talla">19/20</td>
                                    <td class="talla">21/22</td>
                                    <td class="talla"></td>
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
                                    <th class="talla_head">Accion</th>
                                </tr>
                            </thead>
                            <tbody id="disponibles">

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
                                    <th class="talla_head">Accion</th>
                                </tr>
                            </tfoot>
                        </table>

                    </div>
            
            </div>
            <div class="card-footer">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                    class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-2 float-right"><i
                    class="far fa-save fa-lg"></i> Guardar</button>
                {{-- <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4"> --}}
            </div>

            </form>
        </div>
    </div>
</div>


    

<div class="" id="AprobarPedido">
    <table id="ordenes_aprobacion" class="table table-striped table-bordered datatables" style="width: 100%;">
        <thead>
            <tr>

                <th>Actions</th>
                <th>#</th>
                <th>Vendedor</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>Fecha</th>
                <th>F. Entr.</th>
                <th>F. Aprob.</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>Actions</th>
                <th>#</th>
                <th>Vendedor</th>
                <th>Cliente</th>
                <th>Sucursal</th>
                <th>Fecha</th>
                <th>F. Entr.</th>
                <th>F. Aprob.</th>
                <th>Total</th>
                <th>Status</th>
            </tr>
        </tfoot>
    </table>
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






@include('adminlte/scripts')
<script src="{{asset('js/orden_pedido/orden_aprobacion.js')}}"></script>
<script src="{{asset('js/orden_pedido/ordenPedido.js')}}"></script>

<script>
    function aprobar(id_orden) {
        // e.preventDefault();
        bootbox.confirm("¿Estas seguro de aprobar esta orden?", function(result){
            if(result){
                $.post("orden-aprobacion/" + id_orden, function(data, status){
                    bootbox.alert("Orden <strong>"+ data.orden.no_orden_pedido +"</strong> aprobada." );
                  
                    $("#ordenes_aprobacion").DataTable().ajax.reload();
                    $("#ordenes_red").DataTable().ajax.reload();
                })
            }
        })
    }

    function redistribuir(id_orden){
        // e.preventDefault();
        bootbox.confirm("¿Estas seguro de redistribuir las tallas?", function(result){
            if(result){
                $.get("orden_redistribuir/" + id_orden, function(){
                    bootbox.alert("Redistibucion completa");
                    $("#detalle").DataTable().ajax.reload();
                })
            }
        })
    }

    function cancelar(id_orden){
        bootbox.confirm("¿Estas seguro de cancelar esta orden?", function(result){
            if(result){
                $.post("orden-cancelacion/" + id_orden, function(data, status){
                    bootbox.alert("Orden <strong>"+ data.orden.no_orden_pedido +"</strong> cancelada." );
                
                    $("#ordenes_aprobacion").DataTable().ajax.reload();
                })
            }
        })
    }
    function ver(id_orden) {
        $.get("ver/orden/" + id_orden, function(data, status) {
           
            $("#AprobarPedido").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-guardar").hide();
            $("#autorizacion_credito_req").show();
            $("#redistribucion_tallas").show();
            $("#factura_desglosada_tallas").show();
            $("#acepta_segundas").show();

         
            $("#no_orden_pedido").val(data.orden.no_orden_pedido).attr('readonly', true);
            $("#cliente_apro").val(data.orden.cliente.nombre_cliente).attr('readonly', true);
            $("#sucursal_apro").val(data.orden.sucursal.nombre_sucursal).attr('readonly', true);
            $("#vendedor").val(data.orden.vendedor.nombre+" "+data.orden.vendedor.apellido).attr('readonly', true);
            $("#detalle").DataTable().destroy();
            listarOrdenDetalle(data.orden.id);
         
           
        });
    }


    //funcion para listar en el Datatable
    function listarOrdenDetalle(id) {
       var tabla_orden = $("#detalle").DataTable({
            serverSide: true,
            bFilter: false, 
            lengthChange: false,
            bPaginate: false,
            bInfo: false,
            retrieve: true,
            ajax: "api/listarDetalle/"+id,
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
                { data: "Opciones", orderable: false, searchable: false },
              
            ],
        });
    }

</script>



@endsection