@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Almacen')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header bg-dark ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body" enctype="multipart/form-data">
                    <h5>Formulario de definir atributos del producto</h5>
                    <hr>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for=""></label>
                            <div id="corteAdd">
                                <input type="hidden" name="id" id="id">
                                <label for="">Corte</label>
                                <select name="tags[]" id="cortesSearch" class="form-control select2 text-center" style="width:100%">
                                    <option value="" disabled>Seleccione el corte</option>
                                </select>
                            </div>
                            <div id="corteEdit">
                                <select name="tags[]" id="cortesSearchEdit" class="form-control select2"
                                    style="width:100%">
                                </select>
                            </div>

                            <input type="text" name="numero_corte" id="numero_corte"
                                class="form-control font-weight-bold  text-center" readonly>
                        </div>
                        <div class="col-md-1 mt-5  self-center">
                            <button type="button" id="btn-buscar" class="btn btn-secondary btn-block rounded-pill mt-1"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>

                    <br><br>

                    <div class="row " id="form_producto">
                        <!-- cristobal -->
                        <div class="col-md-4">
                            <label for="" >Ubicacion</label> <button class="btn btn-dark btn-sm mb-2" id="btn-cat"  type="button"
                            data-toggle="modal" data-target=".bd-ubicacion-modal-xl"><i class="fas fa-plus-square"></i></button>
                            <select name="ubicacion" id="ubicacion" class="form-control">
                                <option value="" disabled>Ubicacion</option>
                            </select>
                           
                        </div>
                        
                        <div class="col-md-4 mt-2">
                            <label for="" >Tono</label>
                            <select name="tono" id="tono" class="form-control">
                                <option value="" disabled>Tono</option>
                                <option value="Crudo o Puro">1- Crudo o puro</option>
                                <option value="Dark Stone Suave">2- Dark Stone Suave</option>
                                <option value="Dark Stone">3- Dark Stone</option>
                                <option value="Intermedio">4- Intermedio</option>
                                <option value="Intermedio claro">5- Intermedio claro</option>
                                <option value="Bleach">6- Bleach</option>
                            </select>
                          
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="" >Intensidad proceso seco</label>
                            <select name="intensidad_proceso_seco" id="intensidad_proceso_seco" class="form-control">
                                <option value="" disabled>Intensidad proceso seco</option>
                                <option value="Alto contraste">1- Alto contraste</option>
                                <option value="Intermedio">2- Intermedio</option>
                                <option value="Suave">3- Suave</option>
                                <option value="No tiene">4- No tiene</option>
                            </select>
                           
                        </div>
                    </div>
                    <br>
                    <div class="row mt-2" id="form_producto_2">
                        <div class="col-md-4">
                            <label for="" >Atributo 1</label> <button class="btn btn-primary btn-sm mb-2" id="btn-cat"  type="button"
                            data-toggle="modal" data-target=".bd-marca-modal-xl"><i class="fas fa-plus-square"></i></button>
                            <select name="atributo_no_1" id="atributo_no_1" class="form-control">
                                <option value="" disabled>Atributo No.1</option>
                                <option value="Roto">1- Roto</option>
                                <option value="Parcho">2- Parcho</option>
                                <option value="Bordado">3- Bordardo</option>
                                <option value="Dirty">4- Dirty</option>
                                <option value="Zipper decorativo">5- Zipper decorativo</option>
                            </select>
                            
                        </div>
                        <div class="col-md-4">
                            <label for="" >Atributo 2</label> <button class="btn btn-primary btn-sm mb-2" id="btn-cat"  type="button"
                            data-toggle="modal" data-target=".bd-marca-modal-xl"><i class="fas fa-plus-square"></i></button>
                            <select name="atributo_no_2" id="atributo_no_2" class="form-control">
                                <option value="" disabled>Atributo No.2</option>
                                <option value="Roto">1- Roto</option>
                                <option value="Parcho">2- Parcho</option>
                                <option value="Bordado">3- Bordardo</option>
                                <option value="Dirty">4- Dirty</option>
                                <option value="Zipper decorativo">5- Zipper decorativo</option>
                            </select>
                           
                        </div>
                        <div class="col-md-4">
                            <label for="" >Atributo 3</label> <button class="btn btn-primary btn-sm mb-2" id="btn-cat"  type="button"
                            data-toggle="modal" data-target=".bd-marca-modal-xl"><i class="fas fa-plus-square"></i></button>
                            <select name="atributo_no_3" id="atributo_no_3" class="form-control">
                                <option value="" disabled>Atributo No.3</option>
                                <option value="Roto">1- Roto</option>
                                <option value="Parcho">2- Parcho</option>
                                <option value="Bordado">3- Bordardo</option>
                                <option value="Dirty">4- Dirty</option>
                                <option value="Zipper decorativo">5- Zipper decorativo</option>
                            </select>
                       
                        </div>
                    </div>
                    <br>
                    <hr>
                </form>
                <form action="" method="POST" id="formUpload" class="formUpload" enctype="multipart/form-data">
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="" >Imagen frente</label>
                            <input type="hidden" name="corte_id" id="corte_id" value="">
                            <input type="hidden" name="corte_id_edit" id="corte_id_edit" value="">
                            <img src="" alt="" id="frente" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" name="imagen_frente" id="imagen_frente" alt=""
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="" >Imagen trasera</label>
                            <img src="" alt="" id="trasera" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" alt="" name="imagen_trasera" id="imagen_trasera"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="" >Imagen perfil</label>
                            <img src="" alt="" id="perfil" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" alt="" name="imagen_perfil" id="imagen_perfil"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="" >Imagen bolsillo</label>
                            <img src="" alt="" id="bolsillo" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" alt="" name="imagen_bolsillo" id="imagen_bolsillo"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <button type="submit" id="btn-upload" class="btn btn-primary"><i class="fas fa-file-upload"></i> Guardar</button>

                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn  btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>


        </div>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Definir Atributos')->where('agregar', 1)->first())
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                @endif
                <h4 class="text-white text-center">Listado de cortes en almacen</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Definir Atributos')->where('ver', 1)->first())
        <table id="almacenes" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>Usuario</th>
                    <th>Num. Corte</th>
                    <th>Ref.</th>
                    <th>Total Alm.</th>

                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>Usuario</th>
                    <th>Num. Corte</th>
                    <th>Ref.</th>
                    <th>Total Alm.</th>
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
                <h5 class="modal-h5">Agregar nuevo Atributo</h5>
                <hr>
                <form action="" class="form-group">
                    <div class="row">
                        <div class="col-4">
                            <label for="">Indice</label>
                            <input type="text" name="indice" id="indice" class="form-control text-center">
                        </div>
                        <div class="col-4">
                            <label for="">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="form-control text-center">
                        </div>
                        <div class="col-4 mt-3">
                            <button type="button" id="btn-save" class="btn btn-outline-danger rounded-pill mt-3 " ><i class="fas fa-plus"></i> Agregar</button>

                        </div>
                    </div>
                  
                    <div class="row mt-3">
                        <hr>
                        <table class="table tabla-existencia table-bordered">
                            <thead class="text-center">
                                <tr>
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
                <button type="button" id="btn-close" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
               
            </div>
        </div>
    </div>
</div>

<div class="modal fade bd-ubicacion-modal-xl" tabindex="-1" role="dialog" id="modalRollos"
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
                <h5 class="modal-h5">Agregar nueva Ubicacion</h5>
                <hr>
                <form action="" class="form-group">
                    <div class="row">
                  
                        <div class="col-4">
                            <label for="">Ubicacion</label>
                            <input type="text" name="newUbicacion" id="newUbicacion" class="form-control text-center"
                            data-inputmask='"mask": "a[a]-9[9[9]]"' data-mask style="text-transform: uppercase;">
                        </div>
                        <div class="col-4 mt-3">
                            <button type="button" id="btn-saveUbicacion" class="btn btn-outline-primary rounded-pill mt-3 " ><i class="fas fa-plus"></i> Agregar</button>

                        </div>
                    </div>
                  
                    <div class="row mt-3">
                        <hr>
                        <table class="table tabla-existencia table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>Ubicacion</th>
                                    <th id="editar-permisos">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="ubicaciones-list">
    
                            </tbody>
                        </table>
                    </div>

                </form>

               
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-dark" data-dismiss="modal">Cerrar</button>
               
            </div>
        </div>
    </div>
</div>





@include('adminlte/scripts')
<script src="{{asset('js/corte/def-atributo.js')}}"></script>





@endsection
