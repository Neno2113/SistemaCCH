@extends('adminlte.layout')

@section('seccion', 'Utilidades')

@section('title', 'Telas')

@section('content')


<div class="row">
    <div class="col-7">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header bg-dark ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                {{-- <h4>Telas</h4> --}}
            </div>
            <div class="card-body">
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <h5>Formulario de creacion de telas</h5>
                    <hr>
                    <div class="row ">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="col-md-6">
                            <label for="nombre_cliente" >Suplidor</label>
                            <select name="tags[]" id="suplidores" class="form-control select2">
                                <option value="" disabled>Suplidor</option>
                            </select>

                          
                        </div>
                        <div class="col-md-6" id="compo">
                            <label for=""></label>
                            <button type="button" class="btn btn-orange btn-block mt-1" id="btn-composicion"
                                data-toggle="modal" data-target=".bd-composition-modal-lg"><i
                                    class="fas fa-fill-drip"></i> Agregar composiciones </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <label for="referencia" >Referencia</label>
                            <input type="text" name="referencia" id="referencia"
                                class="form-control">
                           
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="referencia" >Precio</label>
                            <input type="text" placeholder="Precio USD por yarda" name="precio_usd" id="precio_usd"
                                class="form-control text-center" data-inputmask='"mask": "USD 9[.99]"' data-mask>
                          
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="referencia" >Tipo tela</label>  <button class="btn btn-primary btn-sm mb-2" id="btn-telas"  type="button"
                            data-toggle="modal" data-target=".bd-marca-modal-xl"><i class="fas fa-plus-square"></i></button>
                            <select name="tipo_tela" id="tipo_tela" class="form-control">
                                {{-- <option value="" disabled>Tipo tela</option>
                                <option value="Denim">Denim</option>
                                <option value="Twill">Twill</option> --}}
                            </select>
                           
                        </div>
                    </div>                
                    <br>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="referencia" >Peso</label>
                            <input type="text" name="peso" id="peso" placeholder="Peso(Onzas/Yardas^2)"
                                class="form-control text-center" placeholder="Onzas/Yardas^2">
                        
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="referencia" >Ancho Cortable</label>
                            <input type="text" id="ancho_cortable" placeholder="Ancho cortable(Pulgadas)"
                                class="form-control text-center" data-inputmask='"mask": "99"' data-mask placeholder="Pulgadas">
                           
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="referencia" >Elasticidad en trama</label>
                            <input type="text" id="elasticidad_trama"
                                class="form-control text-center" data-inputmask='"mask": "[-]99[.99]%"' data-mask
                                placeholder="Porcentaje">
                          
                        </div>
                    </div>
                    <div class="row" id="radios">
                        <div class="col-md-4 mt-4">
                            <label for="referencia" >Elasticidad en urdimbre</label>
                            <input type="text" id="elasticidad_urdimbre"
                                class="form-control text-center" data-inputmask='"mask": "[-]99[.99]%"' data-mask
                                placeholder="Porcentaje">
                           
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="referencia" >Encogimiento en trama</label>
                            <input type="text" id="encogimiento_trama" 
                                class="form-control text-center" data-inputmask='"mask": "[-]99[.99]%"' data-mask
                                placeholder="Porcentaje">
                            
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="referencia" >Encogimiento en urdimbre</label>
                            <input type="text" id="encogimiento_urdimbre"
                                class="form-control text-center" data-inputmask='"mask": "[-]99[.99]%"' data-mask
                                placeholder="Porcentaje">
                            
                        </div>
                    </div>
                    <br>
                    <h5>Factura de Rollos</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-4 mt-4">
                            <label for="no_factura_compra" >No. Factura</label>
                            <input type="text" placeholder="Factura" name="no_factura_compra" id="no_factura_compra"
                                class="form-control">
                           
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="fecha_compra" >Fecha de compra</label>
                            <input type="date" placeholder="Fecha Compra" name="fecha_compra" id="fecha_compra" 
                                class="form-control">
                          
                        </div>
                    </div>
            </div>
            <div class="card-footer  text-muted ">
                
                <button class="btn btn-danger mt-2" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i>
                    Cancelar</button>
                
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Guardar</button>
            </div>
            </form>
        </div>
    </div>
    <div class="col-5">
        <div class="card  mb-3" id="rollosForm">
            <div class="card-header bg-dark">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
            </div>
            <div class="card-body">
                <h5>Detalle de Rollos</h5>
                <hr>
                <div class="row">
                    <div class="col-md-12" id="vatar">
                        <form action="" method="POST" id="formUpload" enctype="multipart/form-data">
                            <div class="form-group">
                            <input type="hidden" name="id_tela" id="id_tela" value="">
                            <input type="hidden" name="id_rollo" id="id_rollo" value="">
                                <label for="exampleInputFile">Agregar Rollos</label>
                            <!--    <img src="{{asset('adminlte/img/images.png')}}" alt="" id="avatar-img" style="height: 150px; width: auto;" class="rounded img-fluid img-thumbnail"> -->
                                <div class="input-group mt-4">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" name="rollo" id="rollo">
                                    <!--    <input type="hidden" name="image_name" id="image_name" value="1662435439images.png"> -->
                                    </div>
                                    <div class="input-group-append">
                                        <button type="submit" class="btn-primary" id="btn-upload">
                                            <i class="fas fa-upload"></i> Subir</button>
                                    </div>
                                </div>
                            </div>
                        </form> 
                    </div>   
                </div>
                <div class="row">
                    <table class="table tabla-existencia table-bordered">
                        <thead class="text-center">
                            <tr>
                                <th>Numero</th>
                                <th>Tono</th>
                                <th>Longitud</th>
                                <th id="editar-permisos">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="permisos-agregados">

                        </tbody>
                    </table>
                </div>
                   
                  
            </div>
            <!--
            <div class="card-footer  text-muted">
                {{-- <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button> --}}
                <button type="submit" id="btn-finish" class="btn  btn-primary mt-2 float-right"><i class="far fa-save"></i> Guardar</button>
            </div>
            -->
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12" id="terminar_row" style="margin-bottom: 5px;">
        <div class="card  text-muted">
            <button class="btn btn-success mt-2 float-right" id="btn-terminar"><i class="fas fa-arrow-alt-circle-right fa-lg"></i> Terminar</button>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Telas')->where('agregar', 1)->first())
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                @endif
                <h4 class="text-white text-center">Listado de telas</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Telas')->where('ver', 1)->first())
        <table id="cloths" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                <!--    <th></th>
                    <th>Ver</th> -->
                    <th>Actions</th>
                    <th>Ref.</th>
                    <th>Suplidor</th>
                    <th>Tela</th>
                    <th>Peso</th>
                    {{-- <th>Compo.</th>
                    <th>Compo. 2</th>
                    <th>Compo. 3</th>
                    <th>Compo. 4</th>
                    <th>Compo. 5</th> --}}

                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                <!--    <th></th>
                    <th></th>
                    <th>Ver</th> -->
                    <th>Actions</th>
                    <th>Ref.</th>
                    <th>Suplidor</th>
                    <th>Tela</th>
                    <th>Peso</th>
                    {{-- <th>Compo.</th>
                    <th>Compo. 2</th>
                    <th>Compo. 3</th>
                    <th>Compo. 4</th>
                    <th>Compo. 5</th> --}}
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


<!-- Modal -->

<div class="modal fade bd-composition-modal-lg" id="modalComposiciones" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Composiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="compositionForm" class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Material No.1">Material No.1</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones" class="form-control select2">

                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_1" id="porcentaje_mat_1"
                                class="form-control text-center" data-inputmask='"mask": "9[.]9[.9][9[9]]"' data-mask
                                placeholder="%">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <label for="Material No.2">Material No.2</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_2" class="form-control select2">

                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_2" id="porcentaje_mat_2"
                                class="form-control text-center" data-inputmask='"mask": "9[.]9[.9][9[9]]"' data-mask
                                placeholder="%">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <label for="Material No.3">Material No.3</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_3" class="form-control select2">

                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_3" id="porcentaje_mat_3"
                                class="form-control text-center" data-inputmask='"mask": "9[.]9[.9][9[9]]"' data-mask
                                placeholder="%">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <label for="Material No.4">Material No.4</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_4" class="form-control select2">

                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_4" id="porcentaje_mat_4"
                                class="form-control text-center" data-inputmask='"mask": "9[.]9[.9][9[9]]"' data-mask
                                placeholder="%">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <label for="Material No.5">Material No.5</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_5" class="form-control select2">

                            </select>
                        </div>

                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_5" id="porcentaje_mat_5"
                                class="form-control text-center" data-inputmask='"mask": "9[.]9[.9][9[9]]"' data-mask
                                placeholder="%">
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">

                        </div>

                        <div class="col-md-3 mt-3 float-right">
                            <input type="text" name="porcentaje_mat_total" id="porcentaje_mat_total"
                                class="form-control text-center " readonly placeholder="Total">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12 mt-2">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Atencion!</strong> Las composiciones digitadas deben equivaler al 100% de
                                lo contrario no podra guardar en el sistema.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
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
                        <div class="col-7">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control text-center">
                            <button type="button" id="btn-save" class="btn btn-primary mt-3" ><i class="fas fa-plus"></i> Agregar</button>

                        </div>
                    
                       
                    </div>
                  
                    <div class="row mt-3">
                        <hr>
                        <table class="table tabla-existencia table-bordered">
                            <thead class="text-center">
                                <tr>
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
            </div>
        </div>
    </div>
</div>



@include('adminlte/scripts')
{{-- <script src="{{asset('js/formulario.js')}}"></script> --}}
<script src="{{asset('js/corte/cloth.js')}}"></script>





@endsection
