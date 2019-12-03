@extends('adminlte.layout')

@section('seccion', 'Ordenes de empaque')

@section('title', 'Orden de empaque')

@section('content')

<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3" id="btnAgregar"> <i class="fas fa-th-list"></i></button>
    <button class="btn btn-danger mb-3 " id="btnCancelar"> <i class="fas fa-window-close"></i></button>
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
                    <h5><strong> Formulario Orden:</strong></h5>
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
                    <div class="row mt-5">
                        <label for="">Orden de empaque</label>
                        <table class="table table-bordered  mb-3">
                            <thead class="thead-light">
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
                                    <th>Cant Bultos</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody id="disponibles">

                            </tbody>
                        </table>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-4">
                            <button id="empacado" class="btn btn-primary"><i class="fas fa-box fa-lg"></i></button>
                            <span id="empacado_listo" class="badge badge-success">Empacado <i class="fas fa-check"></i> </span>
                        </div>
                    </div> --}}



            </div>
            <div class="card-footer   d-flex justify-content-end">
                {{-- <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4 mr-3 ml-3"> --}}
                {{-- <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4"> --}}
            </div>

            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="container" id="listadoUsers">
    <table id="ordenes_aprobacion" class="table table-striped table-bordered datatables">
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
<script src="{{asset('js/orden_empaque/orden_empaque.js')}}"></script>

<script>
    

     String.prototype.replaceAll = function (find, replace) {
        var str = this;
        return str.replace(new RegExp(find, 'g'), replace);
    };

    function mostrar(id_orden) {
        $("#disponibles").empty("");
        $.get("orden_empaque/" + id_orden, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            
            $("#id").val(data.orden_empaque.id);
            $("#no_orden_pedido").val(data.orden_pedido.no_orden_pedido);
            $("#no_orden_empaque").val(data.orden_empaque.no_orden_empaque);
            $("#cliente").val(data.cliente.nombre_cliente);
            $("#sucursal").val(data.sucursal.nombre_sucursal);
            $("#fecha_entrega").val(data.orden_pedido.fecha_entrega);
            let longitud = data.orden_detalle.length
            let empacado = data.orden_empaque.empacado;
            if(empacado == 1){
                // $("#empacado").hide();
                // $("#empacado_listo").show();
                
            }else{
                // $("#empacado").show();
                // $("#empacado_listo").hide();
              
            }
            for (let i = 0; i < longitud; i++){
                var fila = "<tr>" +
                    "<th class='font-weight-normal' id='producto'>"+data.orden_detalle[i].producto.referencia_producto+"</th>" +
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].a+"</th>" +
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].b+"</th>" +
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].c+"</th>"+
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].d+"</th>"+
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].e+"</th>"+
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].f+"</th>"+
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].g+"</th>"+
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].h+"</th>"+
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].i+"</th>" +
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].j+"</th>"+
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].k+"</th>"+
                    "<th class='font-weight-normal'>"+data.orden_detalle[i].l+"</th>"+
                    "<th class='font-weight-normal' id='total'>"+data.orden_detalle[i].total+"</th>"+
                    "<td><input  type='text' id='cantidad' class='form-control-sm text-center'></td>"+
                    "<td class='font-weight-normal'><a id='empacado' onclick='empaque()' class='btn btn-primary'><i class='fas fa-box '></i></a> </td>"+
                    "</tr>"
                    fila = fila.replaceAll('null', '');
                    $("#disponibles").append(fila);
            } 

        });
    }

    
    function empaque(){
        var empaque = {
            id: $("#id").val(),
            cantidad: $("#cantidad").val(),
            producto: $("#producto").text(),
            total: $("#total").text()       
        };

        console.log(JSON.stringify(empaque));

        $.ajax({
            url: "empacado",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(empaque),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    console.log(datos);
                    $("#cantidad").attr('disabled', true);
                    $("#empacado").hide();
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                        );
                        }
                    },
                error: function() {
                    bootbox.alert(
                        "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                        );
                    }
        });
     
    }

    function redistribuir(id_orden){
        bootbox.confirm("¿Estas seguro de redistribuir las tallas?", function(result){
            if(result){
                $.get("orden_redistribuir/" + id_orden, function(){
                    bootbox.alert("Redistibucion completa");
                    $("#ordenes_aprobacion").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection