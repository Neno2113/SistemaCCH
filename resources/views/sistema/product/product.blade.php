@extends('adminlte.layout')

@section('seccion', 'Producto')

@section('title', 'Productos')

@section('content')
{{-- <div class="container"> --}}
<div class="row">
    <div class="col-md-6 mt-3 ">
        <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-th-list"></i></button>
      
    </div>
</div>
<div class="row ">
    <div class="col-12 ">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4>Formulario de creacion de referencia de producto:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div class="row ">
                        <div class="col-md-3">
                            <label for="nombre_cliente" class="">Marca(*):</label>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="id" id="id_producto" value="">
                            <select name="marca" id="marca" class="form-control">
                                <option value="" selected>Elige una marca...</option>
                                <option value="L">Lavish</option>
                                <option value="M">Mythos</option>
                                <option value="P">Lavish Premium</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="">Genero(*):</label>
                            <select name="genero" id="genero" class="form-control">
                                <option value="" selected>Elige un genero...</option>
                                <option value="1">Hombre</option>
                                <option value="2">Mujer</option>
                                <option value="3">Niño</option>
                                <option value="4">Niña</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="">Tipo producto(*):</label>
                            <select name="tipo_producto" id="tipo_producto" class="form-control">
                                <option value="" selected>Elige un tipo...</option>
                                <option value="0">Pantalon</option>
                                <option value="1">Bermuda</option>
                                <option value="2">Capri</option>
                                <option value="3">Falda</option>
                                <option value="4">Short</option>
                                <option value="5">Jacket</option>
                                <option value="6">Camisa</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="">Categoria(*):</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="">Elige una categoria</option>
                                <option value="0">Basico</option>
                                <option value="1">Semi-basico</option>
                                <option value="2">Moda</option>
                                <option value="3">T-plus</option>
                                <option value="4">Escolar</option>
                                <option value="5">Tubito</option>
                                <option value="6">Talla alto</option>
                                <option value="7">Super plus</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <label for="">Referencia:</label>
                            <input type="text" name="referencia" id="referencia" class="form-control">
                            <input type="hidden" name="" id="sec" value="">
                        </div>
                        <div class="col-md-3 mt-3" id="mostrarRef2">
                            <label for="">Referencia 2:</label>
                            <input type="text" name="referencia_2" id="referencia_2" class="form-control">
                            <input type="hidden" name="" id="sec" value="">
                        </div>
                        <div class="col-md-3 mt-5">
                            <button class="btn btn-primary" id="btnGenerar">Generar</button>
                        </div>
                        <div class="col-md-3 mt-5">
                            <button type="button" class="btn btn-info  btn-block" data-toggle="modal"
                                data-target=".bd-sku-modal-xl" id="btn-sku">Asignar SKU</button>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="precio_lista">Precio lista(*):</label>
                            <input type="text" name="precio_lista" id="precio_lista" class="form-control text-center"
                                data-inputmask='"mask": "9999"' data-mask>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="precio_venta_publico">Precio publico(*):</label>
                            <input type="text" name="precio_venta_publico" id="precio_venta_publico"
                                class="form-control text-center" data-inputmask='"mask": "9.999"' data-mask>
                        </div>

                    </div>
                    <div class="row" id="precios_2">
                        <div class="col-md-4 mt-3">
                            <label for="precio_lista">Precio lista Ref 2(*):</label>
                            <input type="text" name="precio_lista_2" id="precio_lista_2" class="form-control"
                                data-inputmask='"mask": "9.999"' data-mask>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="precio_venta_publico">Precio publico Ref 2(*):</label>
                            <input type="text" name="precio_venta_publico_2" id="precio_venta_publico_2"
                                class="form-control" data-inputmask='"mask": "9.999"' data-mask>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <label for="" class="d-flex justify-content-center">Descripcion(*):</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="1"
                                class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 mt-3" id="descripcion_ref2">
                            <label for="" class="d-flex justify-content-center">Descripcion Ref 2(*):</label>
                            <textarea name="descripcion" id="descripcion_2" cols="30" rows="1"
                                class="form-control"></textarea>
                        </div>
                    </div>
            </div>
            <div class="card-footer  text-muted">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-2 float-right"><i class="far fa-save fa-lg"></i>  Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i class="far fa-edit fa-lg"></i> Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de productos</h4>
    </div>
    <div class="card-body">
        <table id="products" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Usuario </th>
                    <th>Referencia producto</th>
                    <th>Precio lista</th>
                    <th>Precio venta publico</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Usuario</th>
                    <th>Referencia producto</th>
                    <th>Precio lista</th>
                    <th>Precio venta publico</th>
                    <th>Descripcion</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
</div>
<!-- Modal -->
<div class="modal fade bd-sku-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><strong> Asignacion de SKU</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="BrachForm">
                    <div class="row">
                        <h4>Referencia:</h4>
                        <div class="col-md-6  mb-3">
                            <input type="text" name="referencia" id="referencia_talla" class="form-control text-center">
                        </div>
                        <h5 class="ml-2 mt-2">SKU generico producto(*):</h5>
                        <div class="col-md-2 mr-2">
                            <button class="btn btn-primary mb-4" id="btn-asignar" value="General">Asignar SKU </button>
                        </div>
                    </div>
                    <table class="table  table-bordered table-responsive mt-3">
                        <thead>
                            <tr>
                                <th>Tipo producto</th>
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
                        <tr>
                            <th>Niño</th>
                            <th>2</th>
                            <th>4</th>
                            <th>6</th>
                            <th>8</th>
                            <th>10</th>
                            <th>12</th>
                            <th>14</th>
                            <th>16</th>
                        </tr>
                        <tr>
                            <th>Niña</th>
                            <th>2</th>
                            <th>4</th>
                            <th>6</th>
                            <th>8</th>
                            <th>10</th>
                            <th>12</th>
                            <th>14</th>
                            <th>16</th>
                        </tr>
                        <tr>
                            <th>Dama TA</th>
                            <th>0/0</th>
                            <th>1/2</th>
                            <th>3/4</th>
                            <th>5/6</th>
                            <th>7/8</th>
                            <th>9/10</th>
                            <th>11/12</th>
                            <th>13/14</th>
                            <th>15/16</th>
                            <th>17/18</th>
                            <th>19/20</th>
                            <th>21/22</th>
                        </tr>
                        <tr>
                            <th>Dama plus</th>
                            <th>12W</th>
                            <th>14W</th>
                            <th>16W</th>
                            <th>18W</th>
                            <th>20W</th>
                            <th>22W</th>
                            <th>24W</th>
                            <th>26W</th>
                        </tr>
                        <tr>
                            <th>Caballero Skinny</th>
                            <th>28</th>
                            <th>29</th>
                            <th>30</th>
                            <th>32</th>
                            <th>34</th>
                            <th>36</th>
                            <th>38</th>
                            <th>40</th>
                            <th>42</th>
                            <th>44</th>
                        </tr>
                    </table>
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="text-center">Asignar SKU por tallas</h5>
                            <hr>
                            <hr>
                        </div>

                    </div>
                    <div class="row">
                        {{-- <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary mb-2" id="btn-asignar" value="General">General</button>
                        </div> --}}
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar2" value="A">A</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar3" value="B">B</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar4" value="C">C</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar5" value="D">D</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar6" value="E">E</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar7" value="F">F</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar8" value="G">G</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar9" value="H">H</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar10" value="I">I</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar11" value="J">J</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar12" value="K">K</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-primary btn-block" id="btn-asignar13" value="L">L</button>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- </div> --}}


@include('adminlte/scripts')
<script src="{{asset('js/producto/product.js')}}"></script>

<script>
    function mostrar(id_prouct) {
        $.post("product/" + id_prouct, function(data, status) {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();

            $("#id").val(data.product.id);
            $("#referencia").val(data.product.referencia_producto);
            $("#descripcion").val(data.product.descripcion);
            $("#precio_lista").val(data.product.precio_lista);
            $("#precio_lista_2").val(data.product.precio_lista_2);
            $("#precio_venta_publico").val(data.product.precio_venta_publico);
            $("#precio_venta_publico_2").val(data.product.precio_venta_publico_2);
        });
    }


    function eliminar(id_prouct){
        bootbox.confirm("¿Estas seguro de eliminar esta referencia?", function(result){
            if(result){
                $.post("product/delete/" + id_prouct, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Referencia eliminada correctamente!!");
                    $("#products").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection