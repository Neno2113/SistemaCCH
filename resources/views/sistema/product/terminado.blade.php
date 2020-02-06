@extends('adminlte.layout')

@section('seccion', 'Producto')

@section('title', 'Producto Terminado')

@section('content')
{{-- <div class="container"> --}}

<div class="row mt-4">
    <div class="col-12 ">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4>Producto Terminado</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body" enctype="multipart/form-data">
                    <h5><strong> Producto terminado:</strong></h5>
                    <hr>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <p for="">Referencia producto:</p>
                            <input type="text" name="referencia_producto" id="referencia_producto"
                                class="form-control mt-2 text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-6">
                            <p for="">Descripcion:</p>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="1"
                                class="form-control mt-2 font-weight-bold" readonly></textarea>
                        </div>
                    </div>

                    <br><br>

                    <div class="row mt-2 ">
                        <div class="col-md-4">
                            <p for="">Ubicacion:</p>
                            <input type="text" name="ubicacion" id="ubicacion"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <p for="">Tono:</p>
                            <input type="text" name="tono" id="tono" class="form-control text-center font-weight-bold"
                                readonly>
                        </div>
                        <div class="col-md-4">
                            <p for="">Intensidad proceso seco:</p>
                            <input type="text" name="intensidad_proceso_seco" id="intensidad_proceso_seco"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                    </div>
                    <br>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <p for="">Atributo No.1:</p>
                            <input type="text" name="atributo_no_1" id="atributo_no_1"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <p for="">Atributo No.2:</p>
                            <input type="text" name="atributo_no_2" id="atributo_no_2"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-4">
                            <p for="">Atributo No.3:</p>
                            <input type="text" name="atributo_no_3" id="atributo_no_3"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p for="">Precio lista:</p>
                            <input type="text" name="precio_lista" id="precio_lista"
                                class="form-control text-center font-weight-bold" readonly>
                        </div>
                        <div class="col-md-6">
                            <p for="">Precio venta:</p>
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
    <div class="card-header text-center">
        <h4>Listado de producto terminado</h4>
    </div>
    <div class="card-body">
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
    </div>

</div>
</div>



@include('adminlte/scripts')
<script src="{{asset('js/producto/producto-terminado.js')}}"></script>




@endsection
