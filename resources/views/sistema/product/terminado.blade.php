@extends('adminlte.layout')

@section('seccion', 'Producto')

@section('title', 'Producto Terminado')

@section('content')
{{-- <div class="container"> --}}

<div class="row mt-4">
    <div class="col-12 ">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header bg-dark">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                {{-- <h4>Producto Terminado</h4> --}}
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body" enctype="multipart/form-data">
                    <h5>Producto terminado</h5>
                    <hr>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Referencia producto</label>
                            <input type="text" name="referencia_producto" id="referencia_producto"
                                class="form-control mt-2 text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Descripcion</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="1"
                                class="form-control mt-2 font-weight-bold" readonly></textarea>
                        </div>
                    </div>

                    <br><br>

                    <div class="row mt-2 ">
                        <div class="col-md-4">
                            <label for="">Ubicacion</label>
                            <input type="text" name="ubicacion" id="ubicacion"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Tono</label>
                            <input type="text" name="tono" id="tono" class="form-control text-center font-weight-bold"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Intensidad proceso seco</label>
                            <input type="text" name="intensidad_proceso_seco" id="intensidad_proceso_seco"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Atributo No.1</label>
                            <input type="text" name="atributo_no_1" id="atributo_no_1"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Atributo No.2</label>
                            <input type="text" name="atributo_no_2" id="atributo_no_2"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Atributo No.3</label>
                            <input type="text" name="atributo_no_3" id="atributo_no_3"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Precio lista</label>
                            <input type="text" name="precio_lista" id="precio_lista"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Precio venta</label>
                            <input type="text" name="precio_venta_publico" id="precio_venta_publico"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                    </div>
                    <br>
                    <hr>
                </form>
                <h4 class="text-center">Imagenes</h4>
                <div class="row justify-content-center galeria" id="">
                    <div class="col-sm-2 ">
                        <a href='' id="imagen_frente" data-toggle="lightbox" data-title="Foto Frontal"
                            data-gallery="producto-gallery" data-max-width="600">
                            <img src="" id="imagen_frente_img" class="img-fluid mb-2 prod_img" alt="Foto frontal " />
                        </a>
                    </div>
                    <div class="col-sm-2 ">
                        <a href="" id="imagen_trasera" data-toggle="lightbox" data-title="Foto Trasera"
                            data-gallery="producto-gallery" data-max-width="600">
                            <img src="" id="imagen_trasera_img" class="img-fluid mb-2 prod_img" alt="Foto trasera" />
                        </a>
                    </div>
                    <div class="col-sm-2 ">
                        <a href="" id="imagen_perfil" data-toggle="lightbox" data-title="Foto Perfil"
                            data-gallery="producto-gallery">
                            <img src="" id="imagen_perfil_img" class="img-fluid mb-2 prod_img" alt="Foto perfil" />
                        </a>
                    </div>
                    <div class="col-sm-2 ">
                        <a href="" id="imagen_bolsillo" data-toggle="lightbox" data-title="Foto Bolsillo"
                            data-gallery="producto-gallery">
                            <img src="" id="imagen_bolsillo_img" class="img-fluid mb-2 prod_img" alt="Foto bolsillo" />
                        </a>
                    </div>
                </div>


            </div>
            <div class="card-footer  text-muted d-flex justify-content-start ">
                <button class="btn btn-danger mt-2 " id="btnCancelar"><i
                    class="fas fa-arrow-alt-circle-left fa-lg"></i> Volver</button>
            </div>
        </div>
    </div>
</div>

<div class="card" id="listadoUsers">
    <div class="card-header text-center bg-dark">
        <h4 class="text-white">Listado de producto terminado</h4>
    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Producto terminado')->where('ver', 1)->first())
        <table id="producto-terminado" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Referencia producto</th>
                    <th>Tono</th>
                    <th>Precio lista</th>
                    <th>Precio venta publico</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Referencia producto</th>
                    <th>Tono</th>
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



@include('adminlte/scripts')
<script src="{{asset('js/producto/producto-terminado.js')}}"></script>




@endsection
