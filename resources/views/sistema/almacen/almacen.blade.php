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
                    <h5><strong> Formulario de introduccion a almacen:</strong></h5>
                    <hr>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
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

                            <input type="text" name="numero_corte" id="numero_corte" class="form-control font-weight-bold mt-2" readonly>
                        </div>
                        <div class="col-md-1 mt-4 pt-2">
                            <button type="button" id="btn-buscar" class="btn btn-secondary btn-block rounded-pill"><i
                                    class="fas fa-search"></i></button>
                        </div>
                    </div>
                    {{-- <div class="d-flex justify-content-center mt-2" >
                        <div class="spinner-grow text-primary"  role="status" id="loading">
                            <span class="sr-only">Loading...</span>
                          </div>
                          <div class="spinner-grow text-dark " role="status" id="loading2">
                            <span class="sr-only">Loading...</span>
                          </div>
                          <div class="spinner-grow text-success"   role="status" id="loading3">
                            <span class="sr-only">Loading...</span>
                          </div>

                        </div>
                    </div> --}}
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
                    <div class="row" id="form_talla">
                        <div class="col-md-4">
                            <button type="button" class="btn btn-primary btn-block mt-4 rounded-pill" id="entrada_alm"
                                data-toggle="modal" data-target=".bd-talla-modal-xl">
                                <i class="fas fa-sort-alpha-down"></i> Entrada por talla</button>
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


</div>



<!-- Modal -->
<div class="modal fade bd-talla-modal-xl" tabindex="-1" id="modalAlmacen" role="dialog" aria-labelledby="myLargeModalLabel"
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
                        <input type="text" name="genero" id="genero" class="form-control font-weight-bold" readonly>
                    </div>
                </div>
                <div class="col-md-12">
                    <table id="corte_detalle" class="table table-bordered tabla-dependientes" style="width:100%">
                        <thead >
                            <tr>
                                <th id="sa">A</th>
                                <th id="sb">B</th>
                                <th id="sc">C</th>
                                <th id="sd">D</th>
                                <th id="se">E</th>
                                <th id="sf">F</th>
                                <th id="sg">G</th>
                                <th id="sh">H</th>
                                <th id="si">I</th>
                                <th id="sj">J</th>
                                <th id="sk">K</th>
                                <th id="sl">L</th>
                            </tr>
                        </thead>
                        <tr>
                            <td id="ra"></td>
                            <td id="rb"></td>
                            <td id="rc"></td>
                            <td id="rd"></td>
                            <td id="re"></td>
                            <td id="rf"></td>
                            <td id="rg"></td>
                            <td id="rh"></td>
                            <td id="ri"></td>
                            <td id="rj"></td>
                            <td id="rk"></td>
                            <td id="rl"></td>
                        </tr>

                    </table>
                </div>
                <br>
                <br>
                <div class="row mt-2">
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="ta">A</label>
                        <input type="text" name="a" id="a" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tb">B</label>
                        <input type="text" name="b" id="b" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tc">C</label>
                        <input type="text" name="c" id="c" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="td">D</label>
                        <input type="text" name="d" id="d" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="te">E</label>
                        <input type="text" name="e" id="e" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tf">F</label>
                        <input type="text" name="f" id="f" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tg">G</label>
                        <input type="text" name="g" id="g" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="th">H</label>
                        <input type="text" name="" id="h" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="ti">I</label>
                        <input type="text" name="i" id="i" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tj">J</label>
                        <input type="text" name="j" id="j" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tk">K</label>
                        <input type="text" name="k" id="k" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tl">L</label>
                        <input type="text" name="l" id="l" class="form-control text-center"
                            data-inputmask='"mask": "999"' data-mask>
                    </div>
                </div>
                <hr>

            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Guardar</button>
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
            $("#formUpload").show();
            $("#form_producto").show();
            $("#form_producto_2").show();
            $("#form_talla").show();
            // $("#imagen_frente").hide();
            // $("#imagen_trasera").hide();
            // $("#imagen_perfil").hide();
            // $("#imagen_bolsillo").hide();
            // $("#btn-upload").hide();
            $("#btn-buscar").hide();
            $("#btn-close").hide();
            let genero = data.almacen.producto.referencia_producto.substring(1, 2);
            let mujer_plus = data.almacen.producto.referencia_producto.substring(3, 4);

            //validacion de talla igual 0 desabilitar input correspondiente a esa talla
            (data.almacen.a <= 0 ) ? $("#a").attr('disabled', true) : $("#a").attr('disabled', false);
            (data.almacen.b <= 0 ) ? $("#b").attr('disabled', true) : $("#b").attr('disabled', false);
            (data.almacen.c <= 0 ) ? $("#c").attr('disabled', true) : $("#c").attr('disabled', false);
            (data.almacen.d <= 0 ) ? $("#d").attr('disabled', true) : $("#d").attr('disabled', false);
            (data.almacen.e <= 0 ) ? $("#e").attr('disabled', true) : $("#e").attr('disabled', false);
            (data.almacen.f <= 0 ) ? $("#f").attr('disabled', true) : $("#f").attr('disabled', false);
            (data.almacen.g <= 0 ) ? $("#g").attr('disabled', true) : $("#g").attr('disabled', false);
            (data.almacen.h <= 0 ) ? $("#h").attr('disabled', true) : $("#h").attr('disabled', false);
            (data.almacen.i <= 0 ) ? $("#i").attr('disabled', true) : $("#i").attr('disabled', false);
            (data.almacen.j <= 0 ) ? $("#j").attr('disabled', true) : $("#j").attr('disabled', false);
            (data.almacen.k <= 0 ) ? $("#k").attr('disabled', true) : $("#k").attr('disabled', false);
            (data.almacen.l <= 0 ) ? $("#l").attr('disabled', true) : $("#l").attr('disabled', false);



            $("#id").val(data.almacen.id);
            $("#numero_corte").val('Corte elegido: '+data.almacen.corte.numero_corte);
            $("#ubicacion").val(data.almacen.producto.ubicacion);
            $("#tono").val(data.almacen.producto.tono);
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
            $("#frente").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_frente)
            $("#trasera").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_trasero)
            $("#perfil").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_perfil)
            $("#bolsillo").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_bolsillo)



            if (genero == "2") {

            if (mujer_plus == 7) {
                $("#ta").html("12W");
                $("#tb").html("14W");
                $("#tc").html("16W");
                $("#td").html("18W");
                $("#te").html("20W");
                $("#tf").html("22W");
                $("#tg").html("24W");
                $("#th").html("26W");
                $("#sa").html("12W");
                $("#sb").html("14W");
                $("#sc").html("16W");
                $("#sd").html("18W");
                $("#se").html("20W");
                $("#sf").html("22W");
                $("#sg").html("24W");
                $("#sh").html("26W");



            } else {
                $("#ta").html("0/0");
                $("#tb").html("1/2");
                $("#tc").html("3/4");
                $("#td").html("5/6");
                $("#te").html("7/8");
                $("#tf").html("9/10");
                $("#tg").html("11/12");
                $("#th").html("13/14");
                $("#ti").html("15/16");
                $("#tj").html("17/18");
                $("#tk").html("19/20");
                $("#tl").html("21/22");
                $("#sa").html("0/0");
                $("#sb").html("1/2");
                $("#sc").html("3/4");
                $("#sd").html("5/6");
                $("#se").html("7/8");
                $("#sf").html("9/10");
                $("#sg").html("11/12");
                $("#sh").html("13/14");
                $("#si").html("15/16");
                $("#sj").html("17/18");
                $("#sk").html("19/20");
                $("#sl").html("21/22");

            }
            }
            if (genero == "3") {
                $("#genero").val("Niño: " + val);
                $("#sub-genero").hide();
                $("#ta").html("2");
                $("#tb").html("4");
                $("#tc").html("6");
                $("#td").html("8");
                $("#te").html("10");
                $("#tf").html("12");
                $("#tg").html("14");
                $("#th").html("16");
                $("#sa").html("2");
                $("#sb").html("4");
                $("#sc").html("6");
                $("#sd").html("8");
                $("#se").html("10");
                $("#sf").html("12");
                $("#sg").html("14");
                $("#sh").html("16");

            } else if (genero == "4") {
                $("#genero").val("Niña: " + val);
                $("#sub-genero").hide();
                $("#ta").html("2");
                $("#tb").html("4");
                $("#tc").html("6");
                $("#td").html("8");
                $("#te").html("10");
                $("#tf").html("12");
                $("#tg").html("14");
                $("#th").html("16");
                $("#sa").html("2");
                $("#sb").html("4");
                $("#sc").html("6");
                $("#sd").html("8");
                $("#se").html("10");
                $("#sf").html("12");
                $("#sg").html("14");
                $("#sh").html("16");

            } else if (genero == "1") {
                $("#genero").val("Hombre: " + val);
                $("#sub-genero").hide();
                $("#ta").html("28");
                $("#tb").html("29");
                $("#tc").html("30");
                $("#td").html("32");
                $("#te").html("34");
                $("#tf").html("36");
                $("#tg").html("38");
                $("#th").html("40");
                $("#ti").html("42");
                $("#tj").html("44");
                $("#sa").html("28");
                $("#sb").html("29");
                $("#sc").html("30");
                $("#sd").html("32");
                $("#se").html("34");
                $("#sf").html("36");
                $("#sg").html("38");
                $("#sh").html("40");
                $("#si").html("42");
                $("#sj").html("44");

            }
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
