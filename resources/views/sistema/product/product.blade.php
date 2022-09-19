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
                                {{-- <option value="" selected disabled>Marca</option> --}}
                                {{-- <option value="L"><b>L</b> - Genius</option>
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
                                class="form-control text-center" onfocus="(this.type='number')" autocomplete="off">
                            <label for="" class="d-flex justify-content-center pers"></label>
                        </div>
                        <div class="col-md-2 mt-4">
                            <label for="">Secuencia</label>
                            <input type="number" min="1" max="999" step="1" id="sec_manual" autocomplete="off" class="form-control text-center">

                        </div>
                        <div class="col-md-3 mt-4">
                            <label for="">Referencia</label>
                            <input type="text" name="referencia" id="referencia" class="form-control text-center" readonly>

                            <input type="hidden" name="" id="sec" value="">
                        </div>
                        <div class="col-md-3 mt-4" id="mostrarRef2">
                            <label for="">Referencia 2</label>
                            <input type="text" name="referencia_2" id="referencia_2" class="form-control text-center">

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
                     
                        <div class="col-md-3 mt-1" id="boton-sku">
                            <label for="">SKU</label>
                            {{-- <select name="tags[]" id="tipo_cuenta" class="form-control select2">

                            </select> --}}
                            <button type="button" class="btn btn-dark  btn-block" data-toggle="modal"
                                data-target=".bd-sku-modal-xl" id="btn-sku"><i class="fas fa-barcode"></i>
                                SKUS</button>

                        </div>
                        <div class="col-md-3 mt-2">
                            <label for=""></label>
                            <button type="button" class="btn btn-orange btn-block mt-1" id="btn-rollos"
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
                        class="far fa-edit fa-lg"></i> Guardar</button>
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
                    <th>ID</th> 
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
                    <th>ID</th>
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

{{-- 
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
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                    </tbody>
              


                </table> --}}

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
                        <!--
                        <div class="col-4">
                            <label for="">Tipo</label>
                            <select name="tipo" id="tipo" class="form-control">
                                <option value="marca">Marca</option>
                                <option value="genero">Genero</option>
                                <option value="tipo_producto">Tipo Producto</option>
                                <option value="categoria">Categoria</option>
                            </select>
                        </div>
                        -->
                        <input type="hidden" name="tipo" id="tipo" value="tipo_producto">
                            <div class="col-4" id="Input-indice">
                                <!--
                                <label for="indice">Indice</label>
                                <input type="text" name="indice" id="indice" class="form-control text-center">
                                -->
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
                                <!--    <th>Tipo</th> -->
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


<!-- Modal SKU-->
<div class="modal fade bd-sku-modal-xl" tabindex="-1" id="modalSKU" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><strong> Asignacion de SKU</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="BrachForm">
                    <div class="row mb-3">
                        <h5>Referencia</h5>
                        <div class="col-md-3">
                            <input type="text" name="referencia_talla" id="referencia_talla"
                                class="form-control text-center" disabled>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="referencia_talla_2" id="referencia_talla_2"
                                class="form-control text-center" disabled>
                        </div>
                    </div>
                    <h5 class="text-center">Skus</h5>
                    <hr>
                    <div class="row ml-3">
                        <div class="col-md-4">
                            <label for="">SKU</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                            class="fas fa-barcode"></i></span>
                                    </div>
                                    <input type="text" id="sku" class="form-control text-center" 
                                        />
                                </div>
                        </div>
                        <div class="col-md-3" id="segunda_ref" >
                            <label for="">Referencia</label>
                            <select name="productos_ref" id="productos_ref" class="form-control">

                            </select>
                        </div>
                        <div class="col-md-2">
                            <label >Talla</label>
                            <select name="talla" id="talla" class="form-control">
                             
                            </select>
                        </div>
                    

                        <div class="col-md-3 mt-4" >
                            <button class="btn btn-dark mb-4 mt-2" id="btn-saveSku" > <i
                                    class="fas fa-barcode"></i> Asignar SKU </button>
                        </div>
                  
                    </div>
                    <table class="table  table-bordered mt-3 tabla-perdidas">
                        <thead>
                            <tr>
                                <th>SKU</th>
                                <th>Referencia</th>
                                <th>Talla</th>
                                <th>Eliminar</th>
                                {{-- <th id="tb">B</th>
                                <th id="tc">C</th>
                                <th id="td">D</th>
                                <th id="te">E</th>
                                <th id="tf">F</th>
                                <th id="tg">G</th>
                                <th id="th">H</th>
                                <th id="ti">I</th>
                                <th id="tj">J</th>
                                <th id="tk">K</th>
                                <th id="tl">L</th> --}}
                            </tr>
                        </thead>
                        <tbody id="tallas">

                            {{-- <tr>
                                <td>
                                    <input type="text"  class="form-control text-center" id="a"  />
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="b"  />
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="c"  />
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="d"  />
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="e"  />
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="f"  />
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="g"  />
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="h"  />
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="i"  />
                                </td>
                                <td>
                                    <input type="text" class="form-control text-center" id="j"  />
                                </td>
                                <td>
                                    <input type="text"  class="form-control text-center" id="k"  />
                                </td>
                                <td>
                                    <input type="text"  class="form-control text-center" id="l"  />
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>

                    {{-- <div class="row">

                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar2" value="A">A</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar3" value="B">B</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar4" value="C">C</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar5" value="D">D</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar6" value="E">E</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar7" value="F">F</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar8" value="G">G</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar9" value="H">H</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar10" value="I">I</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar11" value="J">J</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar12" value="K">K</button>
                        </div>
                        <div class="col-lg-1 col-xs-">
                            <button class="btn btn-secondary btn-block" id="btn-asignar13" value="L">L</button>
                        </div>
                    </div> --}}
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection