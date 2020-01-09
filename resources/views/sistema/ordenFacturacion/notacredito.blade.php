@extends('adminlte.layout')

@section('seccion', 'Facturacion')

@section('title', 'Nota de credito')

@section('content')
{{-- <div class="container "> --}}
<div class="row mt-3 ml-2">
    {{-- <button class="btn btn-primary mb-3 " id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button> --}}

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
                <h4>Formulario de nota de credito:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5><strong> Formulario Nota de Credito:</strong></h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">No. Factura:</label>
                            <input type="text" name="no_factura" id="no_factura"
                                class="form-control text-center font-weight-bold" readonly>
                            <input type="hidden" name="factura_id" id="factura_id" value="">
                            <input type="hidden" name="producto_id" id="producto_id" value="">
                        </div>
                        <div class="col-md-8">

                        </div>
                        <div class="col-md-2 ">
                            <label for="">No. Nota de credito:</label>
                            <input type="text" name="no_nota_credito" id="no_nota_credito"
                                class="form-control text-center font-weight-bold" readonly>
                            <input type="hidden" name="sec" id="sec" value="">
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
                                <option value="">....</option>
                            </select>
                        </div>

                    </div>
                    <div class="container">
                        <label for="" class="mt-5">Detalle Factura</label>
                        <table id="invoice_detail" class="table table-striped table-bordered datatables mt-5 mb-3 mr-5"
                            style="width:100%; margin-left:-26px;">
                            <thead class="">
                                <tr class="text-sm">
                                    <th>¿Devolver?</th>
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

                                </tr>
                            </thead>
                            <tbody id="disponibles" class="text-sm">

                            </tbody>

                        </table>
                        <div class="row mt-2">
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sa">A</label>
                                <input type="text" name="" id="a" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sb">B</label>
                                <input type="text" name="" id="b" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sc">C</label>
                                <input type="text" name="" id="c" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sd">D</label>
                                <input type="text" name="" id="d" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="se">E</label>
                                <input type="text" name="" id="e" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sf">F</label>
                                <input type="text" name="" id="f" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sg">G</label>
                                <input type="text" name="" id="g" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sh">H</label>
                                <input type="text" name="" id="h" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="si">I</label>
                                <input type="text" name="" id="i" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sj">J</label>
                                <input type="text" name="" id="j" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sk">K</label>
                                <input type="text" name="k" id="k" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                            <div class="col-lg-1 col-md-2">
                                <label for="" class="ml-4" id="sl">L</label>
                                <input type="text" name="l" id="l" class="form-control text-center"
                                    data-inputmask='"mask": "999"' data-mask>
                            </div>
                        </div>

                    </div>


            </div>
            <div class="card-footer text-muted ">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-2 float-right"><i
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
    <div class="card-header text-center">
        <h4>Nota de creditos</h4>
    </div>
    <div class="card-body">
        <table id="facturas_listadas" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Opciones</th>
                    <th># Factura</th>
                    <th>Ref</th>
                    <th>Fecha fact.</th>
                    <th>Fecha imp.</th>
                    <th>Total</th>
                    <th>Transporte</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Opciones</th>
                    <th># Factura</th>
                    <th>Ref</th>
                    <th>Fecha fact.</th>
                    <th>Fecha imp.</th>
                    <th>Total</th>
                    <th>Transporte</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="container" id="listadoUsers">


</div>




@include('adminlte/scripts')
<script src="{{asset('js/nota_credito.js')}}"></script>

<script>
    function mostrar(id_factura) {
        $("#disponibles").empty("");
        $.get("nota_credito/" + id_factura, function(data, status) {
        
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#btn-generar").hide();
            $("#edit-hide").hide();
            $("#edit-hide2").hide();

            $("#factura_id").val(data.factura.id);
            $("#no_factura").val(data.factura.no_factura);
            $("#cliente").val(data.cliente.nombre_cliente);
            $("#sucursal").val(data.sucursal.nombre_sucursal);
            $("#fecha_factura").val(data.factura.fecha);
            $("#fecha_impresion").val(data.factura.fecha_impresion);
            $("#precio_lista_factura").val(data.detalle.precio + " RD$")
            $("#invoice_detail").DataTable().destroy();
            listarFacturaDetalle(data.factura.orden_facturacion.id);
            let genero = data.producto.referencia_producto.substring(1, 2);
            let mujer_plus = data.producto.referencia_producto.substring(3, 4);

            //validacion de talla igual 0 desabilitar input correspondiente a esa talla
            (data.detalle.a <= 0 ) ? $("#a").attr('disabled', true) : $("#a").attr('disabled', false); 
            (data.detalle.b <= 0 ) ? $("#b").attr('disabled', true) : $("#b").attr('disabled', false);
            (data.detalle.c <= 0 ) ? $("#c").attr('disabled', true) : $("#c").attr('disabled', false);
            (data.detalle.d <= 0 ) ? $("#d").attr('disabled', true) : $("#d").attr('disabled', false);
            (data.detalle.e <= 0 ) ? $("#e").attr('disabled', true) : $("#e").attr('disabled', false);
            (data.detalle.f <= 0 ) ? $("#f").attr('disabled', true) : $("#f").attr('disabled', false);
            (data.detalle.g <= 0 ) ? $("#g").attr('disabled', true) : $("#g").attr('disabled', false);
            (data.detalle.h <= 0 ) ? $("#h").attr('disabled', true) : $("#h").attr('disabled', false);
            (data.detalle.i <= 0 ) ? $("#i").attr('disabled', true) : $("#i").attr('disabled', false);
            (data.detalle.j <= 0 ) ? $("#j").attr('disabled', true) : $("#j").attr('disabled', false);
            (data.detalle.k <= 0 ) ? $("#k").attr('disabled', true) : $("#k").attr('disabled', false);
            (data.detalle.l <= 0 ) ? $("#l").attr('disabled', true) : $("#l").attr('disabled', false);

            if (genero == "2"){

                if (mujer_plus == 7) {
                    $("#ta").html("12W");
                    $("#tb").html("14W");
                    $("#tc").html("16W");
                    $("#td").html("18W");
                    $("#te").html("20W");
                    $("#tf").html("22W");
                    $("#tg").html("24W");
                    $("#th").html("26W");
                    $("#sa").html("12W");
                    $("#sb").html("14W");
                    $("#sc").html("16W");
                    $("#sd").html("18W");
                    $("#se").html("20W");
                    $("#sf").html("22W");
                    $("#sg").html("24W");
                    $("#sh").html("26W");
                    // $("#ra").html(datos.a);
                    // $("#rb").html(datos.b);
                    // $("#rc").html(datos.c);
                    // $("#rd").html(datos.d);
                    // $("#re").html(datos.e);
                    // $("#rf").html(datos.f);
                    // $("#rg").html(datos.g);
                    // $("#rh").html(datos.h);
                    // $("#ri").html(datos.i);
                    // $("#rj").html(datos.j);
                    // $("#rk").html(datos.k);
                    // $("#rl").html(datos.l);
                    $("#i").attr("disabled", true);
                    $("#j").attr("disabled", true);
                    $("#k").attr("disabled", true);
                    $("#l").attr("disabled", true);
                    $("#tallas").html(
                    "<th>Dama Plus</th>" +
                    "<th>12W</th>" +
                    "<th>14W</th>" +
                    "<th>16W</th>" +
                    "<th>18W</th>" +
                    "<th>20W</th>" +
                    "<th>22W</th>" +
                    "<th>24W</th>" +
                    "<th>26W</th>"
                    );
                           
                } else {
                    $("#ta").html("0/0");
                    $("#tb").html("1/2");
                    $("#tc").html("3/4");
                    $("#td").html("5/6");
                    $("#te").html("7/8");
                    $("#tf").html("9/10");
                    $("#tg").html("11/12");
                    $("#th").html("13/14");
                    $("#ti").html("15/16");
                    $("#tj").html("17/18");
                    $("#tk").html("19/20");
                    $("#tl").html("21/22");
                    $("#sa").html("0/0");
                    $("#sb").html("1/2");
                    $("#sc").html("3/4");
                    $("#sd").html("5/6");
                    $("#se").html("7/8");
                    $("#sf").html("9/10");
                    $("#sg").html("11/12");
                    $("#sh").html("13/14");
                    $("#si").html("15/16");
                    $("#sj").html("17/18");
                    $("#sk").html("19/20");
                    $("#sl").html("21/22");
                    // $("#ra").html(datos.a);
                    // $("#rb").html(datos.b);
                    // $("#rc").html(datos.c);
                    // $("#rd").html(datos.d);
                    // $("#re").html(datos.e);
                    // $("#rf").html(datos.f);
                    // $("#rg").html(datos.g);
                    // $("#rh").html(datos.h);
                    // $("#ri").html(datos.i);
                    // $("#rj").html(datos.j);
                    // $("#rk").html(datos.k);
                    // $("#rl").html(datos.l);
                    // $("#i").attr("disabled", false);
                    // $("#j").attr("disabled", false);
                    // $("#k").attr("disabled", false);
                    // $("#l").attr("disabled", false);
                    $("#tallas").html(
                        "<th>Dama TA</th>" +
                            "<th>0/0</th>" +
                            "<th>1/2</th>" +
                            "<th>3/4</th>" +
                            "<th>5/6</th>" +
                            "<th>7/8</th>" +
                            "<th>9/10</th>" +
                            "<th>11/12</th>" +
                            "<th>13/14</th>" +
                            "<th>15/16</th>" +
                            "<th>17/18</th>" +
                            "<th>19/20</th>" +
                            "<th>21/22</th>"
                        );
                    }
            }
            if (genero == "3") {
                $("#genero").val("Niño: " + val);
                $("#sub-genero").hide();
                $("#ta").html("2");
                $("#tb").html("4");
                $("#tc").html("6");
                $("#td").html("8");
                $("#te").html("10");
                $("#tf").html("12");
                $("#tg").html("14");
                $("#th").html("16");
                $("#sa").html("2");
                $("#sb").html("4");
                $("#sc").html("6");
                $("#sd").html("8");
                $("#se").html("10");
                $("#sf").html("12");
                $("#sg").html("14");
                $("#sh").html("16");
                // $("#ra").html(datos.a);
                // $("#rb").html(datos.b);
                // $("#rc").html(datos.c);
                // $("#rd").html(datos.d);
                // $("#re").html(datos.e);
                // $("#rf").html(datos.f);
                // $("#rg").html(datos.g);
                // $("#rh").html(datos.h);
                // $("#ri").html(datos.i);
                // $("#rj").html(datos.j);
                // $("#rk").html(datos.k);
                // $("#rl").html(datos.l);
                $("#i").attr("disabled", true);
                $("#j").attr("disabled", true);
                $("#k").attr("disabled", true);
                $("#l").attr("disabled", true);
                $("#tallas").html(
                    "<th>Niño</th>" +
                        "<th>2</th>" +
                        "<th>4</th>" +
                        "<th>6</th>" +
                        "<th>8</th>" +
                        "<th>10</th>" +
                        "<th>12</th>" +
                        "<th>14</th>" +
                        "<th>16</th>"
                );
            } else if (genero == "4") {
                $("#genero").val("Niña: " + val);
                $("#sub-genero").hide();
                $("#ta").html("2");
                $("#tb").html("4");
                $("#tc").html("6");
                $("#td").html("8");
                $("#te").html("10");
                $("#tf").html("12");
                $("#tg").html("14");
                $("#th").html("16");
                $("#sa").html("2");
                $("#sb").html("4");
                $("#sc").html("6");
                $("#sd").html("8");
                $("#se").html("10");
                $("#sf").html("12");
                $("#sg").html("14");
                $("#sh").html("16");
                // $("#ra").html(datos.a);
                // $("#rb").html(datos.b);
                // $("#rc").html(datos.c);
                // $("#rd").html(datos.d);
                // $("#re").html(datos.e);
                // $("#rf").html(datos.f);
                // $("#rg").html(datos.g);
                // $("#rh").html(datos.h);
                // $("#ri").html(datos.i);
                // $("#rj").html(datos.j);
                // $("#rk").html(datos.k);
                // $("#rl").html(datos.l);
                $("#i").attr("disabled", true);
                $("#j").attr("disabled", true);
                $("#k").attr("disabled", true);
                $("#l").attr("disabled", true);
                $("#tallas").html(
                    "<th>Niña</th>" +
                        "<th>2</th>" +
                        "<th>4</th>" +
                        "<th>6</th>" +
                        "<th>8</th>" +
                        "<th>10</th>" +
                        "<th>12</th>" +
                        "<th>14</th>" +
                        "<th>16</th>"
                );
            } else if (genero == "1") {
                $("#genero").val("Hombre: " + val);
                $("#sub-genero").hide();
                $("#ta").html("28");
                $("#tb").html("29");
                $("#tc").html("30");
                $("#td").html("32");
                $("#te").html("34");
                $("#tf").html("36");
                $("#tg").html("38");
                $("#th").html("40");
                $("#ti").html("42");
                $("#tj").html("44");
                $("#sa").html("28");
                $("#sb").html("29");
                $("#sc").html("30");
                $("#sd").html("32");
                $("#se").html("34");
                $("#sf").html("36");
                $("#sg").html("38");
                $("#sh").html("40");
                $("#si").html("42");
                $("#sj").html("44");
                // $("#ra").html(datos.a);
                // $("#rb").html(datos.b);
                // $("#rc").html(datos.c);
                // $("#rd").html(datos.d);
                // $("#re").html(datos.e);
                // $("#rf").html(datos.f);
                // $("#rg").html(datos.g);
                // $("#rh").html(datos.h);
                // $("#ri").html(datos.i);
                // $("#rj").html(datos.j);
                // $("#rk").html(datos.k);
                // $("#rl").html(datos.l);
                $("#i").attr("disabled", false);
                $("#j").attr("disabled", false);
                $("#k").attr("disabled", true);
                $("#l").attr("disabled", true);
                $("#tallas").html(
                    "<th>Caballero Skinny</th>" +
                        "<th>28</th>" +
                        "<th>29</th>" +
                        "<th>30</th>" +
                        "<th>32</th>" +
                        "<th>34</th>" +
                        "<th>36</th>" +
                        "<th>38</th>" +
                        "<th>40</th>" +
                        "<th>42</th>" +
                        "<th>44</th>"
                );
            } 
          
        });
    }

     //funcion para listar en el Datatable
     function listarFacturaDetalle(id) {
       var tabla_orden = $("#invoice_detail").DataTable({
            serverSide: true,
            bFilter: false, 
            lengthChange: false,
            bPaginate: false,
            bInfo: false,
            retrieve: true,
            ajax: "api/fact_detalle/"+id,
            columns: [
                { data: "Opciones", orderable: false, searchable: false },
                { data: "referencia_producto",name: "producto.referencia_producto"},
                { data: "a", name: "orden_facturacion_detalle.a"},
                { data: "b", name: "orden_facturacion_detalle.b" },
                { data: "c", name: "orden_facturacion_detalle.c" },
                { data: "d", name: "orden_facturacion_detalle.d"},
                { data: "e", name: "orden_facturacion_detalle.e"},
                { data: "f", name: "orden_facturacion_detalle.f"},
                { data: "g", name: "orden_facturacion_detalle.g"},
                { data: "h", name: "orden_facturacion_detalle.h"},
                { data: "i", name: "orden_facturacion_detalle.i"},
                { data: "j", name: "orden_facturacion_detalle.j"},
                { data: "k", name: "orden_facturacion_detalle.k"},
                { data: "l", name: "orden_facturacion_detalle.l"},
                { data: "total", name: "orden_facturacion_detalle.total"}
                // { data: "cantidad"},
                // { data: "Opciones", orderable: false, searchable: false },
              
            ],
        });
    }

    function eliminar(id_corte){
        bootbox.confirm("¿Estas seguro de eliminar este corte?", function(result){
            if(result){
                $.post("corte/delete/" + id_corte, function(data){
                    bootbox.alert("Corte <strong>"+ data.corte.numero_corte+ "</strong> eliminado correctamente");
                    $("#cortes_listados").DataTable().ajax.reload();
                })
            }
        })
    }

   

</script>

@endsection