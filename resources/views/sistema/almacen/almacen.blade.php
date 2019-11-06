@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Almacen')

@section('content')

<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3" id="btnAgregar"> <i class="fas fa-th-list"></i></button>
    <button class="btn btn-danger mb-3 " id="btnCancelar"> <i class="fas fa-window-close"></i></button>

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
                    <h5><strong> Formulario de introduccion a almacen:</strong></h5>
                    <hr>
                    <br><br>
                    <div class="row">
                        {{-- <div class="col-md-6" id="producto">
                            <label for="">Producto(*):</label>
                            <div id="productoADD">
                                <input type="hidden" name="id" id="id">
                                <select name="tags[]" id="productos" class="form-control select2" style="width:100%">
                                </select>
                                <input type="text" name="referencia_producto" id="referencia_producto"
                                    class="form-control mt-2" readonly>
                            </div>
                        </div> --}}
                        <div class="col-md-12 ">
                            <label for="">Corte(*):</label>
                            <div id="corteAdd">
                                <input type="hidden" name="id" id="id">
                                <select name="tags[]" id="cortesSearch" class="form-control select2" style="width:100%">
                                </select>
                            </div>
                            <div id="corteEdit">
                                <select name="tags[]" id="cortesSearchEdit" class="form-control select2"
                                    style="width:100%">
                                </select>
                            </div>

                            <input type="text" name="numero_corte" id="numero_corte" class="form-control mt-2" readonly>
                        </div>
                    </div>

                    <br><br>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="">Ubicacion</label>
                            <input type="text" name="ubicacion" id="ubicacion" class="form-control">
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
                    <div class="row mt-2">
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
                    <div class="row">
                        <div class="col-4">
                            <button type="button" class="btn btn-primary btn-block mt-4" id="edit-hide2"
                                data-toggle="modal" data-target=".bd-talla-modal-xl">Entrada por talla
                                <i class="fas fa-sort-alpha-down"></i></button>
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
                            <input type="file" src="" name="imagen_frente" id="imagen_frente" alt=""
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imagen trasera:</label>
                            <input type="file" src="" alt="" name="imagen_trasera" id="imagen_trasera"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imagen perfil:</label>
                            <input type="file" src="" alt="" name="imagen_perfil" id="imagen_perfil"
                                class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Imagen bolsillo:</label>
                            <input type="file" src="" alt="" name="imagen_bolsillo" id="imagen_bolsillo"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <input type="submit" value="Subir" class="btn btn-primary">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer   d-flex justify-content-end">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4 mr-3 ml-3">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4">
            </div>


        </div>
    </div>
</div>
{{-- </div> --}}

<div class="container" id="listadoUsers">
    <table id="almacenes" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th></th>
                <th>Actions</th>
                <th>Usuario</th>
                <th>Num. Corte</th>
                <th>Ref.</th>
                <th>Total Corte</th>
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
                <th>Total Corte</th>
                <th>Total Alm.</th>
            </tr>
        </tfoot>
    </table>

</div>



<!-- Modal -->
<div class="modal fade bd-talla-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reportar tallas(*):</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="">Referencia producto: </label>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="genero" id="genero" class="form-control" readonly>
                    </div>
                    <div class="col-md-4">
                        <select name="sub-genero" id="sub-genero" class="form-control">
                            <option value=""></option>
                            <option value="Mujer">Mujer</option>
                            <option value="Mujer Plus">Mujer plus</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered table-responsive">
                        <thead>
                            <tr>
                                <th>Tipo producto</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                                <th>E</th>
                                <th>F</th>
                                <th>G</th>
                                <th>H</th>
                                <th>I</th>
                                <th>J</th>
                                <th>K</th>
                                <th>L</th>
                            </tr>
                        </thead>
                        <tr id="tallas">

                        </tr>

                    </table>
                </div>
                <br>
                <br>
                <div class="row mt-2">
                    <div class="col-lg-1 col-xs-">
                        <label for="" class="ml-4" id="ta">A</label>
                        <input type="text" name="" id="a" class="form-control text-center">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tb">B</label>
                        <input type="text" name="" id="b" class="form-control text-center">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tc">C</label>
                        <input type="text" name="" id="c" class="form-control text-center">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="td">D</label>
                        <input type="text" name="" id="d" class="form-control text-center">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="te">E</label>
                        <input type="text" name="" id="e" class="form-control text-center">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4" id="tf">F</label>
                        <input type="text" name="" id="f" class="form-control text-center">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tg">G</label>
                        <input type="text" name="" id="g" class="form-control text-center">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="th">H</label>
                        <input type="text" name="" id="h" class="form-control text-center">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="ti">I</label>
                        <input type="text" name="" id="i" class="form-control text-center">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tj">J</label>
                        <input type="text" name="" id="j" class="form-control text-center">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tk">K</label>
                        <input type="text" name="" id="k" class="form-control text-center">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tl">L</label>
                        <input type="text" name="" id="l" class="form-control text-center">
                    </div>
                </div>
                <hr>

            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@include('adminlte/scripts')
<script src="{{asset('js/corte/almacen.js')}}"></script>

<script>
    function mostrar(id_almacen) {
        $.get("almacen/" + id_almacen, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#referencia_producto").show();
            $("#numero_corte").show();
            $("#corteEdit").show();
            $("#corteAdd").hide();
          
           
            
            $("#id").val(data.almacen.id);
            $("#referencia_producto").val('Referencia elegida: '+data.almacen.producto.referencia_producto);
            $("#numero_corte").val('Corte elegido: '+data.almacen.corte.numero_corte);
            $("#ubicacion").val(data.almacen.producto.ubicacion);
            $("#tono").val("");
            $("#intensidad_proceso_seco").val(data.almacen.producto.intensidad_proceso_seco);
            $("#atributo_no_1").val(data.almacen.producto.atributo_no_1);
            $("#atributo_no_2").val(data.almacen.producto.atributo_no_2);
            $("#atributo_no_3").val(data.almacen.producto.atributo_no_3);
            $("#a").val(data.almacen.a);
            $("#b").val(data.almacen.b);
            $("#c").val(data.almacen.c);
            $("#d").val(data.almacen.d);
            $("#e").val(data.almacen.e);
            $("#f").val(data.almacen.f);
            $("#g").val(data.almacen.g);
            $("#h").val(data.almacen.h);
            $("#i").val(data.almacen.i);
            $("#j").val(data.almacen.j);
            $("#k").val(data.almacen.k);
            $("#l").val(data.almacen.l);
            $("#genero").val(data.almacen.producto.referencia_producto);
        });
    }


    function eliminar(id_almacen){
        bootbox.confirm("¿Estas seguro de eliminar este producto de almacen?", function(result){
            if(result){
                $.post("almacen/delete/" + id_almacen, function(){
                    bootbox.alert("Producto de almacen eliminado correctamente!!");
                    $("#almacenes").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection