@extends('adminlte.layout')

@section('seccion', 'Producto')

@section('title', 'Productos')

@section('content')
{{-- <div class="container"> --}}
<div class="row">
    <div class="col-md-6 mt-3 ml-2 ">
        <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>

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
                        <div class="col-md-2 mt-3">
                            <label for="">Secuencia(*):</label>
                            <input type="number" min="1" max="999" step="1" id="sec_manual" class="form-control">
                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="">Referencia:</label>
                            <input type="text" name="referencia" id="referencia" class="form-control" readonly>
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

                    </div>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="precio_lista">Precio lista(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" name="precio_lista" id="precio_lista"
                                    class="form-control text-center" data-inputmask='"mask": "RD$ 999[9]"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="precio_venta_publico">Precio publico(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" name="precio_venta_publico" id="precio_venta_publico"
                                    class="form-control text-center" data-inputmask='"mask": "RD$ 999[9]"' data-mask>

                            </div>
                        </div>
                        {{-- <div class="col-md-4 mt-4">
                            <label for=""></label>
                            <button type="button" class="btn btn-secondary  btn-block " data-toggle="modal"
                                data-target=".bd-curva-modal-xl" id="btn-sku"><i class="fas fa-chart-area"></i> Asignar curva</button>
                        </div> --}}

                    </div>
                    <div class="row" id="precios_2">
                        <div class="col-md-4 mt-3">
                            <label for="precio_lista">Precio lista Ref 2(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" name="precio_lista_2" id="precio_lista_2"
                                    class="form-control text-center" data-inputmask='"mask": "RD$ 999[9]"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="precio_venta_publico">Precio publico Ref 2(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" name="precio_venta_publico_2" id="precio_venta_publico_2"
                                    class="form-control text-center" data-inputmask='"mask": "RD$ 999[9]"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="">Rango segunda referencia:</label>
                            <input id="range_1" type="text" name="range_1" value="">
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


<!-- Modal Curva-->
<div class="modal fade bd-curva-modal-xl" tabindex="-1" id="modalSKU" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><strong> Declarar curva referencia</strong>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="BrachForm">
                    <div class="row">
                        <h5>Referencia:</h5>
                        <div class="col-md-3  mb-3">
                            <input type="text" name="referencia_talla" id="referencia_talla"
                                class="form-control text-center">
                        </div>
                    </div>
                    <h5 class="text-center">Asignar porcentaje por talla</h5>
                    <hr>
                    <table class="table  table-bordered mt-3 tabla-perdidas">
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
                        <tbody id="tallas">

                        </tbody>
                    </table>

            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>



@include('adminlte/scripts')
<script src="{{asset('js/producto/product.js')}}"></script>



@endsection
