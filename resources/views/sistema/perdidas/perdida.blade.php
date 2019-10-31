@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Perdidas')


@section('content')
{{-- <div class="container"> --}}
<div class="row">
    <div class="col-md-6 mt-3 ">
        <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-th-list"></i></button>
        <button class="btn btn-danger mb-3" id="btnCancelar"><i class="fas fa-window-close"></i></button>
    </div>
</div>
<div class="row ">
    <div class="col-12 ">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4>Formulario de reporte de perdidas:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h4>Generacion de codigo:</h4>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-6">
                            <label for="">Tipo de perdida(*)</label>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="sec" id="sec" value="">
                            <input type="hidden" name="sec_segunda" id="sec_segunda" value="">
                            <select name="tipo_perdida" id="tipo_perdida" class="form-control">
                                <option value="Normal"></option>
                                <option value="Normal">Normal</option>
                                <option value="Segundas">Segundas</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="">Referencia producto(*):</label>
                            <select name="productos" id="productos" class="form-control select2">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 mt-4 pt-2 mr-3">
                            <input type="text" name="no_perdida" id="no_perdida" class="form-control text-center" readonly>
                        </div>
                        <div class="col-3">
                            <div class="mt-4 pt-2">
                                <button class="btn btn-primary " id="btn-generar">Generar</button>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>

                    <div class="row">
                        <div class="col-6">
                            <label for="">Corte(*):</label>
                            <div id="corteAdd">
                                <select name="cortesSearch" id="cortesSearch" class="form-control select2">
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <label for="">Fecha(*)</label>
                            <input type="date" name="fecha" id="fecha" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6 mt-1">
                            <label for="">Fase(*):</label>
                            <select name="fase" id="fase" class="form-control">
                                <option value=""></option>
                                <option value="Produccion">Produccion</option>
                                <option value="Procesos secos">Procesos secos</option>
                                <option value="Lavanderia">Lavanderia</option>
                                <option value="Terminacion">Terminacion</option>
                                <option value="Almacen">Terminado o almacen</option>
                            </select>
                        </div>
                        <div class="col-6 mt-1">
                            <label for="">Motivo(*):</label>
                            <select name="motivo" id="motivo" class="form-control">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-4">
                            <button type="button" class="btn btn-info btn-block mt-4" id="edit-hide2"
                                data-toggle="modal" data-target=".bd-talla-modal-xl">Reportar perdidas 
                                 <i class="fas fa-sort-alpha-down"></i></button>
                        </div>
                    </div>

            </div>
            <div class="card-footer text-muted d-flex justify-content-end ">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4">
            </div>
            </form>
        </div>
    </div>
</div>

<div class="container" id="listadoUsers">
    <table id="perdidas" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th></th>
                <th>Acciones</th>
                <th>Num. Perdida</th>
                <th>Tipo perdida </th>
                <th>Fecha</th>
                <th>Corte</th>
                <th>Ref. Producto</th>
                <th>Fase</th>
                <th>Motivo</th>
                <th>Perdida sin talla</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Acciones</th>
                <th>Num. Perdida</th>
                <th>Tipo perdida </th>
                <th>Fecha</th>
                <th>Corte</th>
                <th>Ref. Producto</th>
                <th>Fase</th>
                <th>Motivo</th>
                <th>Perdida sin talla</th>
            </tr>
        </tfoot>
    </table>
</div>
</div>

<!-- Modal -->
<div class="modal fade bd-talla-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reportas perdidas(*):</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="">Elija el genero: </label>
                    <div class="col-md-6 mb-2">
                        <select name="genero" id="genero" class="form-control">
                            <option value="Niño"></option>
                            <option value="Niño">Niño</option>
                            <option value="Niña">Niña</option>
                            <option value="Hombre">Hombre</option>
                            <option value="Mujer">Mujer</option>
                            <option value="Mujer Plus">Mujer Plus</option>
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
                        <input type="text" name="" id="a" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tb">B</label>
                        <input type="text" name="" id="b" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tc">C</label>
                        <input type="text" name="" id="c" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="td">D</label>
                        <input type="text" name="" id="d" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="te">E</label>
                        <input type="text" name="" id="e" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4" id="tf">F</label>
                        <input type="text" name="" id="f" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tg">G</label>
                        <input type="text" name="" id="g" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="th">H</label>
                        <input type="text" name="" id="h" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="ti">I</label>
                        <input type="text" name="" id="i" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tj">J</label>
                        <input type="text" name="" id="j" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tk">K</label>
                        <input type="text" name="" id="k" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tl">L</label>
                        <input type="text" name="" id="l" class="form-control">
                    </div>
                </div>
                <hr>
                <div class="row">
                    <label for="" class="mt-4">Talla x:</label>
                    <div class="col-md-6 mt-3">
                        <input type="text" name="talla_x" id="talla_x" class="form-control text-center" 
                        placeholder="Solo utilizar esta talla cuando la talla no sea conocida">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



@include('adminlte/scripts')
<script src="{{asset('js/perdidas.js')}}"></script>

<script>
    function mostrar(id_recepcion) {
        $.get("recepcion/" + id_recepcion, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#estandar_recibido").show();
            $("#lavanderia").show();
            $("#corte").show();
            $("#corteAdd").hide();
            $("#corteEdit").show();
            $("#lavanderiaAdd").hide();
            $("#lavanderiaEdit").show();

            let result;
            if(data.recepcion.estandar_recibido == 1){
                result = 'Si'
            }else{
                result = 'No'
            }       

            $("#id").val(data.recepcion.id);
            $("#corte").val('Corte elegido: '+data.recepcion.corte.numero_corte);
            $("#lavanderia").val('Numero de envio: '+data.recepcion.lavanderia.numero_envio);
            $("#fecha_recepcion").val(data.recepcion.fecha_recepcion);
            $("#cantidad_recibida").val(data.recepcion.cantidad_recibida);
            $("#estandar_recibido").val('Estandar recbido: '+result);
        });
    }

    function eliminar(id_recepcion){
        bootbox.confirm("¿Estas seguro de eliminar esta recepcion?", function(result){
            if(result){
                $.post("recepcion/delete/" + id_recepcion, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Recepcion eliminada correctamente!!");
                    $("#recepciones").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection