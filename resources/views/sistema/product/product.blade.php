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
                <h4 class="">Producto</h4>
            </div>
            <div class="card-body">
                <h5>Formulario de creacion de referencia de producto</h5>
                <hr>
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div class="row ">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="id" id="id_producto" value="">
                        <div class="col-md-3">
                            <select name="marca" id="marca" class="form-control">
                                <option value="" selected disabled>Marca</option>
                                <option value="L">Lavish</option>
                                <option value="M">Mythos</option>
                                <option value="P">Lavish Premium</option>
                            </select>
                            <label for="nombre_cliente" class="label"></label>
                        </div>
                        <div class="col-md-3">

                            <select name="genero" id="genero" class="form-control">
                                <option value="" selected disabled>Genero</option>
                                <option value="1">Hombre</option>
                                <option value="2">Mujer</option>
                                <option value="3">Niño</option>
                                <option value="4">Niña</option>
                            </select>
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-3">
                            <select name="tipo_producto" id="tipo_producto" class="form-control">
                                <option value="" selected disabled>Tipo producto</option>
                                <option value="0">Pantalon</option>
                                <option value="1">Bermuda</option>
                                <option value="2">Capri</option>
                                <option value="3">Falda</option>
                                <option value="4">Short</option>
                                <option value="5">Jacket</option>
                                <option value="6">Camisa</option>
                            </select>
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-3">

                            <select name="categoria" id="categoria" class="form-control">
                                <option value="" disabled>Categoria</option>
                                <option value="0">Basico</option>
                                <option value="1">Semi-basico</option>
                                <option value="2">Moda</option>
                                <option value="3">T-plus</option>
                                <option value="4">Escolar</option>
                                <option value="5">Tubito</option>
                                <option value="6">Talla alto</option>
                                <option value="7">Super plus</option>
                            </select>
                            <label for="" class="label"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mt-3">

                            <input type="number" min="1" max="999" step="1" id="sec_manual" placeholder="Secuencia"
                                class="form-control">
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-3 mt-3">

                            <input type="text" name="referencia" placeholder="Referencia" id="referencia"
                                class="form-control" readonly>
                            <label for="" class="label"></label>
                            <input type="hidden" name="" id="sec" value="">
                        </div>
                        <div class="col-md-3 mt-3" id="mostrarRef2">

                            <input type="text" name="referencia_2" placeholder="Referencia 2" id="referencia_2"
                                class="form-control">
                            <label for="" class="label"></label>
                            <input type="hidden" name="" id="sec" value="">
                        </div>
                        <div class="col-md-4 mt-3">
                            <button class="d-inline btn btn-primary rounded-pill" id="btnGenerar">Generar</button>
                            {{-- <button type="button" class="d-inline btn btn-secondary rounded-pill ml-3" id="btn-curva"
                                data-toggle="modal" data-target=".bd-curva-modal-xl">
                                <i class="fas fa-percentage"></i> Porcentaje por Talla</button> --}}
                        </div>

                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-4 mt-2">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" placeholder="Precio lista" name="precio_lista" id="precio_lista"
                                    class="form-control text-center" data-inputmask='"mask": "RD$ 999[9]"' data-mask>
                            </div>
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-4 mt-2">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" placeholder="Precio publico" name="precio_venta_publico"
                                    id="precio_venta_publico" class="form-control text-center"
                                    data-inputmask='"mask": "RD$ 999[9]"' data-mask>

                            </div>
                            <label for="" class="label"></label>
                        </div>
                        {{-- <div class="col-md-4 mt-4">
                            <label for=""></label>
                            <button type="button" class="btn btn-secondary  btn-block " data-toggle="modal"
                                data-target=".bd-curva-modal-xl" id="btn-sku"><i class="fas fa-chart-area"></i> Asignar curva</button>
                        </div> --}}

                    </div>
                    <div class="row" id="precios_2">
                        <div class="col-md-4 mt-3">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" name="precio_lista_2" id="precio_lista_2"
                                    placeholder="Preio lista ref 2" class="form-control text-center"
                                    data-inputmask='"mask": "RD$ 999[9]"' data-mask>
                            </div>
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-4 mt-3">

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" placeholder="Precio publico ref 2" name="precio_venta_publico_2"
                                    id="precio_venta_publico_2" class="form-control text-center"
                                    data-inputmask='"mask": "RD$ 999[9]"' data-mask>
                            </div>
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-4">
                            <label for="">Rango segunda referencia</label>
                            <input id="range_1" type="text" name="range_1" value="">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-3">

                            <textarea name="descripcion" id="descripcion" placeholder="Descripcion" cols="30" rows="1"
                                class="form-control"></textarea>
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-12 mt-3" id="descripcion_ref2">

                            <textarea name="descripcion" id="descripcion_2" placeholder="Descripcion ref 2" cols="30"
                                rows="1" class="form-control"></textarea>
                            <label for="" class="label"></label>
                        </div>
                    </div>
            </div>
            <div class="card-footer  text-muted">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
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
<div class="modal fade bd-curva-modal-xl" tabindex="-1" role="dialog" id="test" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><strong>Corte por tallas:</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="">Porcentaje a redistribuir por talla</label>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-2">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Atencion!</strong> El total del porcentaje debe ser igual a 100 para poder
                            guardar.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>


                <table class="table  table-bordered tabla-perdidas">
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
                            {{-- <th>Total</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>

                                <input type="text" name="" id="a" class="form-control text-center detalle red"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                            </td>
                            <th>
                                <input type="text" name="" id="b" class="form-control text-center detalle red"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                                </td>
                            <td>


                                <input type="text" name="" id="c" class="form-control text-center detalle red"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                            </td>
                            <td>


                                <input type="text" name="" id="d" class="form-control text-center detalle"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                            </td>
                            <td>

                                {{-- <label for="" class="ml-4" id="de">E</label> --}}
                                <input type="text" name="" id="e" class="form-control text-center detalle"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                            </td>
                            <td>

                                {{-- <label for="" class="ml-4" id="df">F</label> --}}
                                <input type="text" name="" id="f" class="form-control text-center detalle"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                            </td>
                            <td>

                                {{-- <label for="" class="ml-4" id="dg">G</label> --}}
                                <input type="text" name="" id="g" class="form-control text-center detalle"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                            </td>
                            <td>

                                {{-- <label for="" class="ml-4" id="dh">H</label> --}}
                                <input type="text" name="" id="h" class="form-control text-center detalle"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                            </td>
                            <td>

                                {{-- <label for="" class="ml-4" id="di">I</label> --}}
                                <input type="text" name="" id="i" class="form-control text-center detalle"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                            </td>
                            <td>

                                {{-- <label for="" class="ml-4" id="dj">J</label> --}}
                                <input type="text" name="" id="j" class="form-control text-center detalle"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                            </td>
                            <td>

                                {{-- <label for="" class="ml-4" id="dk">K</label> --}}
                                <input type="text" name="" id="k" class="form-control text-center detalle"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                            </td>
                            <td>

                                {{-- <label for="" class="ml-4" id="dl">L</label> --}}
                                <input type="text" name="" id="l" class="form-control text-center detalle"
                                    data-inputmask='"mask": "99[.99]"' data-mask>

                            </td>
                            {{-- <td id="total_percent"></td> --}}
                        </tr>
                    </tbody>
                    {{-- <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </tfoot> --}}


                </table>

                <div class="row">
                    <div class="col-md-4">
                        <input type="text" name="total_percent" id="total_percent" class="form-control text-center"
                            placeholder="Total">
                    </div>

                </div>


            </div>
            <div class="modal-footer">
                <button type="button" id="btn-tallas-cerrar" class="btn btn-secondary"
                    data-dismiss="modal">Guardar</button>
            </div>
        </div>
    </div>
</div>


@include('adminlte/scripts')
<script src="{{asset('js/formulario.js')}}"></script>
<script src="{{asset('js/producto/product.js')}}"></script>



@endsection
