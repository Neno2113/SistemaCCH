@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Almacen')

@section('content')

<div class="row mt-3 ml-3">
    <div class="col-md-6">
        <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>
        {{-- <a href="/sistemaCCH/public/producto-terminado" class="btn btn-info mb-3 ml-2"><i class="fas fa-link mr-2"></i>
            ir a producto terminado </a> --}}
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4><strong>Almacen</strong></h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body" enctype="multipart/form-data">
                    <h5><strong> Formulario de definir atributos producto:</strong></h5>
                    <hr>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Corte:</label>
                            <div id="corteAdd">
                                <input type="hidden" name="id" id="id">
                                <select name="tags[]" id="cortesSearch" class="form-control select2" style="width:100%">
                                    <option value="">Seleccione el corte</option>
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
                        <div class="col-md-1 mt-4 pt-2">
                            <button type="button" id="btn-buscar" class="btn btn-secondary btn-block rounded-pill"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>

                    <br><br>

                    <div class="row mt-2" id="form_producto">
                        <div class="col-md-4">
                            <label for="">Ubicacion</label>
                            <input type="text" name="ubicacion" id="ubicacion" class="form-control text-center"
                                data-inputmask='"mask": "a-9"' data-mask>
                        </div>
                        <div class="col-md-4">
                            <label for="">Tono</label>
                            <select name="tono" id="tono" class="form-control">
                                <option value=""></option>
                                <option value="Crudo o Puro">1- Crudo o puro</option>
                                <option value="Dark Stone Suave">2- Dark Stone Suave</option>
                                <option value="Dark Stone">3- Dark Stone</option>
                                <option value="Intermedio">4- Intermedio</option>
                                <option value="Intermedio claro">5- Intermedio claro</option>
                                <option value="Bleach">6- Bleach</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Intensidad proceso seco</label>
                            <select name="intensidad_proceso_seco" id="intensidad_proceso_seco" class="form-control">
                                <option value=""></option>
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
                            <label for="">Atributo No.1:</label>
                            <select name="atributo_no_1" id="atributo_no_1" class="form-control">
                                <option value=""></option>
                                <option value="Roto">1- Roto</option>
                                <option value="Parcho">2- Parcho</option>
                                <option value="Bordado">3- Bordardo</option>
                                <option value="Dirty">4- Dirty</option>
                                <option value="Zipper decorativo">5- Zipper decorativo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Atributo No.2:</label>
                            <select name="atributo_no_2" id="atributo_no_2" class="form-control">
                                <option value=""></option>
                                <option value="Roto">1- Roto</option>
                                <option value="Parcho">2- Parcho</option>
                                <option value="Bordado">3- Bordardo</option>
                                <option value="Dirty">4- Dirty</option>
                                <option value="Zipper decorativo">5- Zipper decorativo</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Atributo No.3:</label>
                            <select name="atributo_no_3" id="atributo_no_3" class="form-control">
                                <option value=""></option>
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
                <form action="" method="POST" id="formUpload" enctype="multipart/form-data">
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <label for="">Imagen frente:</label>
                            <input type="hidden" name="corte_id" id="corte_id" value="">
                            <input type="hidden" name="corte_id_edit" id="corte_id_edit" value="">
                            <img src="" alt="" id="frente" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" name="imagen_frente" id="imagen_frente" alt=""
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imagen trasera:</label>
                            <img src="" alt="" id="trasera" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" alt="" name="imagen_trasera" id="imagen_trasera"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imagen perfil:</label>
                            <img src="" alt="" id="perfil" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" alt="" name="imagen_perfil" id="imagen_perfil"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imagen bolsillo:</label>
                            <img src="" alt="" id="bolsillo" class="rounded img-fluid img-thumbnail">
                            <input type="file" src="" alt="" name="imagen_bolsillo" id="imagen_bolsillo"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <input type="submit" value="Guardar" id="btn-upload" class="btn btn-primary">

                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn  btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>


        </div>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de cortes en almacen</h4>
    </div>
    <div class="card-body">
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
    </div>
</div>






@include('adminlte/scripts')
<script src="{{asset('js/corte/def-atributo.js')}}"></script>





@endsection
