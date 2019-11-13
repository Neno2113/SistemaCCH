@extends('adminlte.layout')

@section('seccion', 'Existencias')

@section('title', 'Orden de Pedido')

@section('content')

<br><br>

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
                <h4>Formulario de orden de pedido:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Cliente(*):</label>
                            <select name="tags[]" id="clienteSearch" class="form-control select2">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Sucursal(*):</label>
                            <select name="tags[]" id="sucursalSearch" class="form-control select2">
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row mt-3">
                        <div class="col-md-4 mt-2">
                            <label for="">Notas(*):</label>
                            <textarea name="notas" id="notas0" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="">Fecha de entrega</label>
                            <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control">
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="autorizacion_credito_req">¿Generado internamente?(*):</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="r1" value="1" checked>
                                    <label for="radioPrimary1">
                                        Si
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" name="r1" value="0">
                                    <label for="radioPrimary2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-3">
                            <label for="">Referencia Producto</label>
                            <select name="tags[]" id="productoSearch" class="form-control select2" style="width:100%">
                            </select>
                        </div>
                        <div class="col-md-2 mt-2">
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
                        <div class="col-md-6 mr-3" id="detallada">
                            <label for="">Disponible:</label>
                            <select name="sub-genero" id="sub-genero" class="form-control">
                                <option value="Mujer"></option>
                                <option value="Mujer">Mujer</option>
                                <option value="Mujer Plus">Mujer plus</option>
                            </select>
                            <table class="table table-bordered table-responsive">
                                <thead>
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
                        <div class="col-md-4" id="redistribucion">
                            <label for="">Cantidad:</label>
                            <input type="text" name="cantidad" id="cantidad" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button class="btn btn-success rounded-pill" name="btn-consultar"
                                id="btn-consultar">Consultar</button>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row mt-3" id="detalles">
                        <div class="col-lg-1 ">
                            <label for="" class="ml-4" id="da">A</label>
                            <input type="text" name="" id="a" class="form-control text-center">
                        </div>
                        <div class="col-lg-1">
                            <label for="" class="ml-4" id="db">B</label>
                            <input type="text" name="" id="b" class="form-control text-center">
                        </div>
                        <div class="col-lg-1">
                            <label for="" class="ml-4" id="dc">C</label>
                            <input type="text" name="" id="c" class="form-control text-center">
                        </div>
                        <div class="col-lg-1">
                            <label for="" class="ml-4" id="dd">D</label>
                            <input type="text" name="" id="d" class="form-control text-center">
                        </div>
                        <div class="col-lg-1">
                            <label for="" class="ml-4" id="de">E</label>
                            <input type="text" name="" id="e" class="form-control text-center">
                        </div>
                        <div class="col-lg-1">
                            <label for="" class="ml-4" id="df">F</label>
                            <input type="text" name="" id="f" class="form-control text-center">
                        </div>
                        <div class="col-lg-1">
                            <label for="" class="ml-4" id="dg">G</label>
                            <input type="text" name="" id="g" class="form-control text-center">
                        </div>
                        <div class="col-lg-1">
                            <label for="" class="ml-4" id="dh">H</label>
                            <input type="text" name="" id="h" class="form-control text-center">
                        </div>
                        <div class="col-lg-1">
                            <label for="" class="ml-4" id="di">I</label>
                            <input type="text" name="" id="i" class="form-control text-center">
                        </div>
                        <div class="col-lg-1">
                            <label for="" class="ml-4" id="dj">J</label>
                            <input type="text" name="" id="j" class="form-control text-center">
                        </div>
                        <div class="col-lg-1">
                            <label for="" class="ml-4" id="dk">K</label>
                            <input type="text" name="" id="k" class="form-control text-center">
                        </div>
                        <div class="col-lg-1">
                            <label for="" class="ml-4" id="dl">L</label>
                            <input type="text" name="" id="l" class="form-control text-center">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <button class="btn btn-info rounded-lg" name="btn-agregar"  id="btn-agregar">Agregar</button>
                        </div>
                    </div>
                    <br>
                    <hr>

                    <div class="row">
                        <div class="col-12 pt-3 pl-3 pb-3">
                            <table class="table  table-bordered table-responsive mt-3">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Referencias listadas</th>
                                        <th>Precio</th>
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

                        {{-- <div class="col-md-2 " style="margin-top: 26.8%">
                                <button id="btn-guardar" name="btn-guardar" class="btn btn-secondary"><i class="fas fa-sync"></i></button>
                            </div> --}}




                    </div>


            </div>
            <div class="card-footer text-muted d-flex justify-content-end">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-info mt-4">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4">
            </div>

            </form>
        </div>
    </div>
</div>







@include('adminlte/scripts')
<script src="{{asset('js/ordenPedido.js')}}"></script>

<script>
    function mostrar(id_almacen) {
        $.get("almacen/" + id_almacen, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#referencia_producto").show();
            $("#numero_corte").show();
            $("#corteEdit").show();
            $("#corteAdd").hide();
          

        });
    }


    function eliminar(id_almacen){
        bootbox.confirm("¿Estas seguro de eliminar este producto de almacen?", function(result){
            if(result){
                $.post("almacen/delete/" + id_almacen, function(){
                    bootbox.alert("Producto de almacen eliminado correctamente!!");
                    $("#almacenes").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection