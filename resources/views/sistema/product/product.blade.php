@extends('adminlte.layout')

@section('seccion', 'Producto')

@section('title', 'Productos')

@section('content')

<div class="row ">
    <div class="col-12 ">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header bg-dark">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                {{-- <h4 class="">Producto</h4> --}}
            </div>
            <div class="card-body">
                <h5>Formulario de creacion de referencia de producto</h5>
                <hr>
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <div class="row ">
                        <input type="hidden" name="id" id="id" value="">
                        <input type="hidden" name="id" id="id_producto" value="">
                        <div class="col-md-3">
                            <label for="nombre_cliente">Marca</label> <button class="btn btn-primary btn-sm mb-2" id="btn-mar" value="marca" type="button"
                            data-toggle="modal" data-target=".bd-marca-modal-xl"><i class="fas fa-plus-square"></i></button>
                            <select name="marca" id="marca" class="form-control">
                                {{-- <option value="" selected disabled>Marca</option>
                                <option value="L"><b>L</b> - Genius</option>
                                <option value="M"><b>M</b> - Mythos</option>
                                <option value="P"><b>L</b> - Lavish</option> --}}
                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="">Genero</label> <button class="btn btn-primary btn-sm mb-2" id="btn-gen" value="genero" type="button"
                            data-toggle="modal" data-target=".bd-marca-modal-xl"><i class="fas fa-plus-square"></i></button>
                            <select name="genero" id="genero" class="form-control">
                                {{-- <option value="" selected disabled>Genero</option>
                                <option value="1"><b>1</b> - Hombre</option>
                                <option value="2"><b>2</b> - Mujer</option>
                                <option value="3"><b>3</b> - Niño</option>
                                <option value="4"><b>4</b> - Niña</option> --}}
                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="">Tipo producto</label> <button class="btn btn-primary btn-sm mb-2 " id="btn-tipo" value="tipo_producto" type="button"
                            data-toggle="modal" data-target=".bd-marca-modal-xl"><i class="fas fa-plus-square"></i></button>
                            <select name="tipo_producto" id="tipo_producto" class="form-control">
                                {{-- <option value="" selected disabled>Tipo producto</option>
                                <option value="0"><b>0</b> - Pantalon</option>
                                <option value="1"><b>1</b> - Bermuda</option>
                                <option value="2"><b>2</b> - Capri</option>
                                <option value="3"><b>3</b> - Falda</option>
                                <option value="4"><b>4</b> - Short</option>
                                <option value="5"><b>5</b> - Jacket</option>
                                <option value="6"><b>6</b> - Camisa</option> --}}
                            </select>

                        </div>
                        <div class="col-md-3">
                            <label for="">Categoria</label> <button class="btn btn-primary btn-sm mb-2" id="btn-cat" value="categoria" type="button"
                            data-toggle="modal" data-target=".bd-marca-modal-xl"><i class="fas fa-plus-square"></i></button>
                            <select name="categoria" id="categoria" class="form-control">
                                {{-- <option value="" disabled>Categoria</option>
                                <option value="0"><b>0</b> - Basico</option>
                                <option value="1"><b>1</b> - Semi-basico</option>
                                <option value="2"><b>2</b> - Moda</option>
                                <option value="3"><b>3</b> - T-plus</option>
                                <option value="4"><b>4</b> - Escolar</option>
                                <option value="5"><b>5</b> - Tubito</option>
                                <option value="6"><b>6</b> - Talla alto</option>
                                <option value="7"><b>7</b> - Super plus</option> --}}
                            </select>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2 mt-4">
                            <label for="">Año</label>
                            <input type="text" min="1900" max="2099" step="1" value="2019" id="year"
                                class="form-control" onfocus="(this.type='number')">
                            <label for="" class="d-flex justify-content-center pers"></label>
                        </div>
                        <div class="col-md-2 mt-4">
                            <label for="">Secuencia</label>
                            <input type="number" min="1" max="999" step="1" id="sec_manual" class="form-control">

                        </div>
                        <div class="col-md-3 mt-4">
                            <label for="">Referencia</label>
                            <input type="text" name="referencia" id="referencia" class="form-control" readonly>

                            <input type="hidden" name="" id="sec" value="">
                        </div>
                        <div class="col-md-3 mt-4" id="mostrarRef2">
                            <label for="">Referencia 2</label>
                            <input type="text" name="referencia_2" id="referencia_2" class="form-control">

                            <input type="hidden" name="" id="sec" value="">
                        </div>
                        <div class="col-md-4 align-self-center mt-4">
                            <button class="d-inline btn btn-primary rounded-pill mt-3" id="btnGenerar">Generar</button>
                            {{-- <button type="button" class="d-inline btn btn-secondary rounded-pill ml-3" id="btn-curva"
                                data-toggle="modal" data-target=".bd-curva-modal-xl">
                                <i class="fas fa-percentage"></i> Porcentaje por Talla</button> --}}
                        </div>

                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <label for="">Precio lista</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" name="precio_lista" id="precio_lista"
                                    class="form-control text-center" data-inputmask='"mask": "RD$ 999[9]"' data-mask>

                            </div>

                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="">Precio publico</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" name="precio_venta_publico" id="precio_venta_publico"
                                    class="form-control text-center" data-inputmask='"mask": "RD$ 999[9]"' data-mask>


                            </div>

                        </div>
                     
                        <div class="col-md-3 mt-2">
                            <label for="">Cuenta contable</label>
                            <select name="tags[]" id="tipo_cuenta" class="form-control select2">

                            </select>

                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""></label>
                            <button type="button" class="btn btn-secondary btn-block mt-1" id="btn-rollos"
                                data-toggle="modal" data-target=".bd-rollo-modal-xl">
                                <i class="fas fa-images"></i>
                                Subir imagenes

                            </button>
                        </div>

                    </div>
                    <div class="row" id="precios_2">
                        <div class="col-md-3 mt-3">
                            <label for="">Precio Lista ref 2</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" name="precio_lista_2" id="precio_lista_2"
                                    class="form-control text-center" data-inputmask='"mask": "RD$ 999[9]"' data-mask>
                            </div>

                        </div>
                        <div class="col-md-3 mt-3">
                            <label for="">Precio Publico ref 2</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                </div>
                                <input type="text" placeholder="Precio publico ref 2" name="precio_venta_publico_2"
                                    id="precio_venta_publico_2" class="form-control text-center"
                                    data-inputmask='"mask": "RD$ 999[9]"' data-mask>
                            </div>

                        </div>
                      
                        <div class="col-md-3">
                            <label for="">Rango segunda referencia</label>
                            <input id="range_1" type="text" name="range_1" value="">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="1"
                                class="form-control"></textarea>

                        </div>
                        <div class="col-md-6 mt-3" id="descripcion_ref2">
                            <label for="">Descripcion ref 2</label>
                            <textarea name="descripcion" id="descripcion_2" cols="30" rows="1"
                                class="form-control"></textarea>

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
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso',
                'Productos')->where('agregar', 1)->first())
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                @endif
                <h4 class="text-white text-center">Listado de productos</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso',
        'Productos')->where('ver', 1)->first())
        <table id="products" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Referencia producto</th>
                    <th>Usuario </th>
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
                    <th>Referencia producto</th>
                    <th>Usuario</th>
                    <th>Precio lista</th>
                    <th>Precio venta publico</th>
                    <th>Descripcion</th>
                </tr>
            </tfoot>
        </table>
        @else
        <div class="row" id="alerts">
            <div class="col-md-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-exclamation-triangle"></i>
                            Info
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-info"></i> Acceso negado!</h5>
                            Usted no posee permisos necesarios para realizar esta accion.
                            Para poder realizar la accion debe comunicarse con el administrador.
                        </div>


                    </div>

                </div>
                <!-- /.card -->
            </div>
        </div>
        @endif
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
{{-- <script src="{{asset('js/formulario.js')}}"></script> --}}
<script src="{{asset('js/producto/product.js')}}"></script>

<!-- Modal Rollos-->
<div class="modal fade bd-rollo-modal-xl" tabindex="-1" role="dialog" id="modalRollos"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Imagenes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-h5">Subida de imagenes de la referencia</h5>
                <hr>

                <form action="" method="POST" id="formUpload" class="formUpload" enctype="multipart/form-data">
                    <div class="row mt-2">
                        <div class="col-md-3">
                       
                            <input type="hidden" name="product_id" id="product_id" value="">
                            {{-- <input type="hidden" name="corte_id_edit" id="corte_id_edit" value=""> --}}
                            <img src="" alt="" id="frente" class="rounded img-fluid img-thumbnail">
                            <label for="" >Imagen frente</label>
                            <input type="file" src="" name="imagen_frente" id="imagen_frente" alt=""
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                          
                            <img src="" alt="" id="trasera" class="rounded img-fluid img-thumbnail">
                            <label for="" >Imagen trasera</label>
                            <input type="file" src="" alt="" name="imagen_trasera" id="imagen_trasera"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            
                            <img src="" alt="" id="perfil" class="rounded img-fluid img-thumbnail">
                            <label for="" >Imagen perfil</label>
                            <input type="file" src="" alt="" name="imagen_perfil" id="imagen_perfil"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                          
                            <img src="" alt="" id="bolsillo" class="rounded img-fluid img-thumbnail">
                            <label for="" >Imagen bolsillo</label>
                            <input type="file" src="" alt="" name="imagen_bolsillo" id="imagen_bolsillo"
                                class="form-control">
                        </div>
                    </div>
                    {{-- <div class="row mt-2">
                        <div class="col-md-4">
                            <button type="submit" id="btn-upload" class="btn btn-primary"><i class="fas fa-file-upload"></i> Guardar</button>

                        </div>
                    </div> --}}
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Rollos-->
<div class="modal fade bd-marca-modal-xl" tabindex="-1" role="dialog" id="modalRollos"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva Entrada</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="modal-h5">Agregar nueva entrada</h5>
                <hr>
                <form action="" class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="marca">Marca</option>
                                <option value="genero">Genero</option>
                                <option value="tipo_producto">Tipo Producto</option>
                                <option value="categoria">Categoria</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <label for="">Indice</label>
                            <input type="text" name="indice" id="indice" class="form-control text-center">
                        </div>
                        <div class="col-4">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control text-center">
                        </div>
                       
                    </div>
                  
                    <div class="row mt-3">
                        <hr>
                        <table class="table tabla-existencia table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>Tipo</th>
                                    <th>Indice</th>
                                    <th>Nombre</th>
                                    <th id="editar-permisos">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="permisos-agregados">
    
                            </tbody>
                        </table>
                    </div>

                </form>

               
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn-save" class="btn btn-primary" ><i class="fas fa-save"></i> Guardar</button>
            </div>
        </div>
    </div>
</div>

@endsection