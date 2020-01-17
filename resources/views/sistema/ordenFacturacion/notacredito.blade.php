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
                            <input type="hidden" name="orden_facturacion_id" id="orden_facturacion_id" value="">
                        </div>
                        <div class="col-md-8">

                        </div>
                        <div class="col-md-2 ">
                            <label for="">No. Nota de credito:</label>
                            <input type="text" name="no_nota_credito" id="no_nota_credito"
                                class="form-control text-center font-weight-bold" readonly>
                            <input type="hidden" name="sec" id="sec" value="">
                            <input type="hidden" name="nc_id" id="nc_id" value="">
                        </div>
                    </div>
                    <div class="row mt-3">
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
                        <div class="col-md-4 mt-2" id="comprobante">
                            <label for="">NCF</label>
                            <input type="text" name="ncf" id="ncf" class="form-control font-weight-bold">
                         
                        </div>

                    </div>
                    <div class="container" id="detalle-factura">
                        <label for="" class="mt-5">Detalle Factura</label>
                        <table id="invoice_detail" class="table table-bordered datatables mt-5 mb-3 mr-5 tabla-nc"
                            style="width:106%; margin-left: -31px;">
                            {{-- <thead class="text-sm encabezados">
                                <tr>
                                    <th class="genero">MUJER PLUS:</th>
                                    <td class="">12W</td>
                                    <td class="">14W</td>
                                    <td class="">16W</td>
                                    <td class="">18W</td>
                                    <td class="">20W</td>
                                    <td class="">22W</td>
                                    <td class="">24W</td>
                                    <td class="">26W</td>
                                    <td class=""></td>
                                    <td class=""></td>
                                    <td class=""></td>
                                    <td class=""></td>
                                </tr>
                
                                <tr>
                                    <th class="genero">MUJER:</th>
                                    <td class="talla" style="width: 41.883px;">0/0</td>
                                    <td class="talla" style="width: 39.233px;">1/2</td>
                                    <td class="talla" style="width: 39.233px;">3/4</td>
                                    <td class="talla" style="width: 39.233px;">5/6</td>
                                    <td class="talla" style="width: 39.233px;">7/8</td>
                                    <td class="talla" style="width: 39.233px;">9/10</td>
                                    <td class="talla" style="width: 41.517px;">11/12</td>
                                    <td class="talla" style="width: 43.217px;">13/14</td>
                                    <td class="talla" style="width: 41.833px;">15/16</td>
                                    <td class="talla" style="width: 42.567px;">17/18</td>
                                    <td class="talla" style="width: 42.35px;">19/20</td>
                                    <td class="talla" style="width: 42.15px;">21/22</td>
                                </tr>
                
                                <tr>
                                    <th class="genero">HOMBRE:</th>
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
                                </tr>
                
                                <tr>
                                    <th class="genero">NIÑO:</th>
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
                                </tr>
                
                                <tr>
                                    <th class="genero">NIÑA:</th>
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
                                </tr>
                
                            </thead> --}}
                            <thead class="">
                                <tr class="">
                                    <th>Ref</th>
                                    <th id="ta"></th>
                                    <th id="tb"></th>
                                    <th id="tc"></th>
                                    <th id="td"></th>
                                    <th id="te"></th>
                                    <th id="tf"></th>
                                    <th id="tg"></th>
                                    <th id="th"></th>
                                    <th id="ti"></th>
                                    <th id="tj"></th>
                                    <th id="tk"></th>
                                    <th id="tl"></th>
                                    <th>Guardar</th>
                                </tr>
                            </thead>
                            <tbody id="disponibles" class="text-sm">

                            </tbody>

                        </table>
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
                    <th>User</th>
                    <th>Fecha fact.</th>
                    <th>Fecha imp.</th>
                    {{-- <th>Total</th> --}}
                    <th>Transporte</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Opciones</th>
                    <th># Factura</th>
                    <th>User</th>
                    <th>Fecha fact.</th>
                    <th>Fecha imp.</th>
                    {{-- <th>Total</th> --}}
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
    var longitud_global;
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
            $("#detalle-factura").hide();
            $("#comprobante").hide();

            $("#factura_id").val(data.factura.id);
            $("#orden_facturacion_id").val(data.factura.id);
            $("#no_factura").val(data.factura.no_factura);
            $("#cliente").val(data.cliente.nombre_cliente);
            $("#cliente_id").val(data.cliente.id);
            $("#sucursal").val(data.sucursal.nombre_sucursal);
            $("#fecha_factura").val(data.factura.fecha);
            $("#fecha_impresion").val(data.factura.fecha_impresion);
            $("#precio_lista_factura").val(data.precio + " RD$")
         
            var longitud = data.detalle.length;
            longitud_global = data.detalle.length;
            for (let i = 0; i < longitud; i++) {
                 
                var fila =  "<tr >"+
                "<td class='cuerpo'> "+data.detalle[i].producto.referencia_producto+"</td>"+
                "<td ><input type='number' class='form-control' name='a' id='a"+data.detalle[i].id+"' value="+data.detalle[i].a+"></td>"+
                "<td ><input type='number' class='form-control' name='b' id='b"+data.detalle[i].id+"' value="+data.detalle[i].b+"></td>"+
                "<td ><input type='number' class='form-control' name='c' id='c"+data.detalle[i].id+"' value="+data.detalle[i].c+"></td>"+
                "<td ><input type='number' class='form-control' name='d' id='d"+data.detalle[i].id+"' value="+data.detalle[i].d+"></td>"+
                "<td ><input type='number' class='form-control' name='e' id='e"+data.detalle[i].id+"' value="+data.detalle[i].e+"></td>"+
                "<td ><input type='number' class='form-control' name='f' id='f"+data.detalle[i].id+"' value="+data.detalle[i].f+"></td>"+
                "<td ><input type='number' class='form-control' name='g' id='g"+data.detalle[i].id+"' value="+data.detalle[i].g+"></td>"+
                "<td ><input type='number' class='form-control' name='h' id='h"+data.detalle[i].id+"' value="+data.detalle[i].h+"></td>"+
                "<td ><input type='number' class='form-control' name='i' id='i"+data.detalle[i].id+"' value="+data.detalle[i].i+"></td>"+
                "<td ><input type='number' class='form-control' name='j' id='j"+data.detalle[i].id+"' value="+data.detalle[i].j+"></td>"+
                "<td ><input type='number' class='form-control' name='k' id='k"+data.detalle[i].id+"' value="+data.detalle[i].k+"></td>"+
                "<td ><input type='number' class='form-control' name='l' id='l"+data.detalle[i].id+"' value="+data.detalle[i].l+"></td>"+
                "<td ><button type='button' id='btn-detalle"+data.detalle[i].id+"' class='btn btn-info btn-sm' onclick='agregar("+data.detalle[i].id+")'><i class='far fa-save'></i></button></td>"+
                "</tr>";

                $("#disponibles").append(fila);  
                //validacion de talla igual 0 desabilitar input correspondiente a esa talla
                (data.detalle[i].a <= 0 ) ? $("#a"+data.detalle[i].id).attr('disabled', true) : $("#a"+data.detalle[i].id).attr('disabled', false); 
                (data.detalle[i].b <= 0 ) ? $("#b"+data.detalle[i].id).attr('disabled', true) : $("#b"+data.detalle[i].id).attr('disabled', false);
                (data.detalle[i].c <= 0 ) ? $("#c"+data.detalle[i].id).attr('disabled', true) : $("#c"+data.detalle[i].id).attr('disabled', false);
                (data.detalle[i].d <= 0 ) ? $("#d"+data.detalle[i].id).attr('disabled', true) : $("#d"+data.detalle[i].id).attr('disabled', false);
                (data.detalle[i].e <= 0 ) ? $("#e"+data.detalle[i].id).attr('disabled', true) : $("#e"+data.detalle[i].id).attr('disabled', false);
                (data.detalle[i].f <= 0 ) ? $("#f"+data.detalle[i].id).attr('disabled', true) : $("#f"+data.detalle[i].id).attr('disabled', false);
                (data.detalle[i].g <= 0 ) ? $("#g"+data.detalle[i].id).attr('disabled', true) : $("#g"+data.detalle[i].id).attr('disabled', false);
                (data.detalle[i].h <= 0 ) ? $("#h"+data.detalle[i].id).attr('disabled', true) : $("#h"+data.detalle[i].id).attr('disabled', false);
                (data.detalle[i].i <= 0 ) ? $("#i"+data.detalle[i].id).attr('disabled', true) : $("#i"+data.detalle[i].id).attr('disabled', false);
                (data.detalle[i].j <= 0 ) ? $("#j"+data.detalle[i].id).attr('disabled', true) : $("#j"+data.detalle[i].id).attr('disabled', false);
                (data.detalle[i].k <= 0 ) ? $("#k"+data.detalle[i].id).attr('disabled', true) : $("#k"+data.detalle[i].id).attr('disabled', false);
                (data.detalle[i].l <= 0 ) ? $("#l"+data.detalle[i].id).attr('disabled', true) : $("#l"+data.detalle[i].id).attr('disabled', false);           
            }

          
        });
    }

    //  //funcion para listar en el Datatable
    //  function listarFacturaDetalle(id) {
    //    var tabla_orden = $("#invoice_detail").DataTable({
    //         serverSide: true,
    //         bFilter: false, 
    //         lengthChange: false,
    //         bPaginate: false,
    //         bInfo: false,
    //         retrieve: true,
    //         ajax: "api/fact_detalle/"+id,
    //         columns: [
    //             { data: "Opciones", orderable: false, searchable: false },
    //             { data: "referencia_producto",name: "producto.referencia_producto"},
    //             { data: "a", name: "orden_facturacion_detalle.a"},
    //             { data: "b", name: "orden_facturacion_detalle.b" },
    //             { data: "c", name: "orden_facturacion_detalle.c" },
    //             { data: "d", name: "orden_facturacion_detalle.d"},
    //             { data: "e", name: "orden_facturacion_detalle.e"},
    //             { data: "f", name: "orden_facturacion_detalle.f"},
    //             { data: "g", name: "orden_facturacion_detalle.g"},
    //             { data: "h", name: "orden_facturacion_detalle.h"},
    //             { data: "i", name: "orden_facturacion_detalle.i"},
    //             { data: "j", name: "orden_facturacion_detalle.j"},
    //             { data: "k", name: "orden_facturacion_detalle.k"},
    //             { data: "l", name: "orden_facturacion_detalle.l"},
    //             { data: "total", name: "orden_facturacion_detalle.total"}
    //             // { data: "cantidad"},
    //             // { data: "Opciones", orderable: false, searchable: false },
              
    //         ],
    //     });
    // }
   

    function eliminar(id_factura){
        bootbox.confirm("¿Estas seguro de eliminar la nota de credito?", function(result){
            if(result){
                $.post("nota-credito/delete/" + id_factura, function(data){
                    bootbox.alert("Nota de credito <strong>"+ data.nota_credito.no_nota_credito+ "</strong> eliminada correctamente");
                    $("#facturas_listadas").DataTable().ajax.reload();
                
                })
            }
        })
    }

    function agregar(factura_detella_id){

        var nota_credito_detalle = {
            nc_id: $("#nc_id").val(),
            a: $('#a'+factura_detella_id).val(),
            b: $("#b"+factura_detella_id).val(),
            c: $("#c"+factura_detella_id).val(),
            d: $("#d"+factura_detella_id).val(),
            e: $("#e"+factura_detella_id).val(),
            f: $("#f"+factura_detella_id).val(),
            g: $("#g"+factura_detella_id).val(),
            h: $("#h"+factura_detella_id).val(),   
            i: $("#i"+factura_detella_id).val(),
            j: $("#j"+factura_detella_id).val(),
            k: $("#k"+factura_detella_id).val(),
            l: $("#l"+factura_detella_id).val()                 
        }
        // console.log(JSON.stringify(nota_credito_detalle));
      
        $.ajax({
            url: "nota-credito/detalle/"+factura_detella_id,
            type: "POST",
            dataType: "json",
            data: JSON.stringify(nota_credito_detalle),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#btn-detalle"+ factura_detella_id).attr('disabled', true);
                    // $("#invoice_detail").DataTable().ajax.reload();
                    // bootbox.alert("Nota de credito <strong>"+datos.nota_credito.no_nota_credito+"</strong> creada correctamente.");
                    // mostrarForm(false);
                  
                    
            
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function(datos) {
                console.log(datos.responseJSON.errors); 
                let errores = datos.responseJSON.errors;

                Object.entries(errores).forEach(([key, val]) => {
                    bootbox.alert({
                        message:"<h4 class='invalid-feedback d-block'>"+val+"</h4>",
                        size: 'small'
                    });
                });
            }
        });
    }

   

</script>

@endsection