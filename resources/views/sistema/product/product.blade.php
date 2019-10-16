@extends('adminlte.layout')


@section('title', 'Productos')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-th-list"></i></button>
            <button class="btn btn-danger mb-3" id="btnCancelar"><i class="fas fa-window-close"></i></button>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary">
                <h4>Producto</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de creacion de referencia de producto:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">
                            <label for="nombre_cliente" class="">Marca(*):</label>
                            <input type="hidden" name="id" id="id" value="">
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
                            <input type="text" name="referencia_" id="referencia_2" class="form-control">
                            <input type="hidden" name="" id="sec" value="">
                        </div>
                        <div class="col-md-3 mt-5">
                            <button class="btn btn-secondary" id="btnGenerar">Generar</button>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="precio_lista">Precio lista(*):</label>
                            <input type="text" name="precio_lista" id="precio_lista" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="precio_venta_publico">Precio publico(*):</label>
                            <input type="text" name="precio_venta_publico" id="precio_venta_publico"
                                class="form-control">
                        </div>
                        <div class="col-md-4 mt-5">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target=".bd-example-modal-lg">Asignar SKU</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-3">
                            <label for="" class="d-flex justify-content-center">Descripcion(*):</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="1"
                                class="form-control"></textarea>
                        </div>
                    </div>
            </div>
            <div class="card-footer text-muted d-flex justify-content-end">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-secondary mt-4">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-secondary mt-4">
            </div>
            </form>
        </div>
    </div>

    <div class="container" id="listadoUsers">
        <table id="products" class="table table-striped table-bordered datatables">
            <thead>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Usuario </th>
                    <th>Referencia producto</th>
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
                    <th>Descripcion</th>
                </tr>
            </tfoot>
        </table>

    </div>

</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Asignar SKU</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="BrachForm">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar" value="General">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU A</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar2" value="A">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU B</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar3" value="B">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU C</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar4" value="C">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU D</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar5" value="D">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU E</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar6" value="E">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU F</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar7" value="F">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU G</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar8" value="G">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU H</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar9" value="H">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU I</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar10" value="I">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU J</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar11" value="J">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU K</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar12" value="K">Asignar</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">SKU L</label>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary mb-2" id="btn-asignar13" value="L">Asignar</button>
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
</div>


@include('adminlte/scripts')
<script src="{{asset('js/product.js')}}"></script>

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