@extends('adminlte.layout')

@section('seccion', 'Ordenes de empaque')

@section('title', 'Orden de empaque')

@section('content')

<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3" id="btnAgregar"> <i class="fas fa-th-list"></i></button>
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
                <h4><strong>Orden de empaque</strong></h4>
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
                            <label for="">No. Orden empaque:</label>
                            <input type="text" name="no_orden_empaque" id="no_orden_empaque"
                                class="form-control text-center font-weight-bold" readonly>
                            <input type="hidden" name="orden_empaque_id" id="orden_empaque_id" value="">
                            <input type="hidden" name="orden_facturacion_id" id="orden_facturacion_id" value="">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="">Cliente:</label>
                            <input type="text" name="cliente" id="cliente"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Sucursal:</label>
                            <input type="text" name="sucursal" id="sucursal"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Fecha entrega:</label>
                            <input type="text" name="fecha_entrega" id="fecha_entrega"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-3 mt-2">
                            <label for="autorizacion_credito_req">¿Iran por transporte?</label>
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
                    </div>
                    <div class="container">
                        <label for="" class="mt-5">Orden de empaque</label>
                        <table id="orden_detalle" class="table table-striped table-bordered datatables mt-5 mb-3 mr-5"
                            style="width:100%; margin-left:-26px;">
                            <thead class="">
                                <tr>
                                    <th id="">Ref</th>
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
                                    <th>Cant Bultos</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="disponibles">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th id="">Ref</th>
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
                                    <th>Cant Bultos</th>
                                    <th>Accion</th>
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
{{-- </div> --}}

<div class="container" id="listadoUsers">
    <table id="listar_OE" class="table table-striped table-bordered datatables">
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

</div>



@include('adminlte/scripts')
<script src="{{asset('js/orden_empaque/orden_empaque_reportar.js')}}"></script>

<script>
    String.prototype.replaceAll = function (find, replace) {
        var str = this;
        return str.replace(new RegExp(find, 'g'), replace);
    };

    var orden_detalle;

    function mostrar(id_orden) {
        $("#disponibles").empty("");
        $.get("orden_empaque/" + id_orden, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            // $("#btn-guardar").hide();

            $("#id").val(data.orden_empaque.id);
            $("#no_orden_pedido").val(data.orden_pedido.no_orden_pedido);
            $("#no_orden_empaque").val(data.orden_empaque.no_orden_empaque);
            $("#orden_empaque_id").val(data.orden_empaque.id);
            $("#cliente").val(data.cliente.nombre_cliente);
            $("#sucursal").val(data.sucursal.nombre_sucursal);
            $("#fecha_entrega").val(data.orden_pedido.fecha_entrega);
            $("#orden_detalle").DataTable().destroy();
            listarOrdenDetalle(data.orden_pedido.id);
            orden_detalle = data.orden_detalle;
        });
    }

    //funcion para listar en el Datatable
    function listarOrdenDetalle(id) {
       var tabla_orden = $("#orden_detalle").DataTable({
            serverSide: true,
            bFilter: false,
            lengthChange: false,
            bPaginate: false,
            bInfo: false,
            retrieve: true,
            ajax: "api/orden_detalle/"+id,
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
                { data: "cantidad"},
                { data: "Opciones", orderable: false, searchable: false },

            ],
        });
    }

    function test(id){
        var empaque = {
            id: $("#id").val(),
            cantidad: $("#cantidad"+id).val()
        }
        $.ajax({
            url: "empaque_detalle/"+id,
            type: "POST",
            dataType: "json",
            data: JSON.stringify(empaque),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Referencia perteneciente a la orden empaque <strong>"+ datos.orden_empaque.no_orden_empaque+"</strong> ha sido empacada");
                    $(".cantidad").val("");

                    var detalle = {
                        orden_empaque_id: $("#orden_empaque_id").val(),
                        orden_facturacion_id: $("#orden_facturacion_id").val()
                    }

                    $.ajax({
                        url: "factura_detalle",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(detalle),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {

                                $("#orden_detalle").DataTable().ajax.reload();


                            } else {
                                bootbox.alert(
                                    "Ocurrio un error durante la actualizacion de la composicion"
                                );
                            }
                        },
                        error: function() {
                            bootbox.alert("Ocurrio un error!!");
                        }
                    });

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });

    }

    function redistribuir(id_orden){
        bootbox.confirm("¿Estas seguro de redistribuir las tallas?", function(result){
            if(result){
                $.get("orden_redistribuir/" + id_orden, function(){
                    bootbox.alert("Redistibucion completa");
                    $("#listar_OE").DataTable().ajax.reload();
                })
            }
        })
    }



</script>



@endsection
