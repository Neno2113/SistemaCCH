@extends('adminlte.layout')

@section('seccion', 'Corte')

@section('title', 'Cortes')

@section('content')
{{-- <div class="container "> --}}
<div class="row mt-3 ml-2">
    <button class="btn btn-primary mb-3 " id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>

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
                <h4>Formulario de creacion de corte:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="">Numero de corte:</label>
                            {{-- <input type="text" name="numero_corte" id="numero_corte"
                                class="form-control text-center " readonly> --}}
                            <input type="number" min="1900" max="2099" step="1" value="2019" />
                            <input type="hidden" name="sec" id="sec" value="">
                            <input type="hidden" name="id" id="id" value="">
                        </div>
                        <div class="col-md-2">
                            <label for="">Secuencia(*):</label>
                            <input type="number" min="001" max="999" step="1" value="001" name="form-control" id="">
                        </div>
                    </div>

                    {{-- <div class="row">
                       
                        <div class="col-md-6 mt-3">
                            <label for="">Numero corte(*):</label>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="sec" id="sec" value="">
                            <input type="text" name="numero_corte" id="numero_corte" class="form-control text-center"
                                readonly>
                        </div>
                        <div class="col-md-4 mt-5">
                            <button class="btn btn-success" id="btn-generar" name="btn-generar">Generar</button>
                        </div>
                    </div> --}}
                    <br>
                    <hr>
                    <br>
                    <div class="row" id="fila1">
                        <div class="col-md-6">
                            <label for="">Referencia producto(*):</label>
                            <select name="tags[]" id="productos" class="form-control select2">
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="">Fecha estimada de entrega(*):</label>
                            <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control"
                                data-toggle="tooltip" data-placement="bottom">
                        </div>
                    </div>
                    <br>
                    <div class="row mt-2" id="fila2">
                        <div class="col-md-4 mt-2">
                            <label for="">Marcada No.</label>
                            <input type="text" name="no_marcada" id="no_marcada" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="">Ancho marcada</label>
                            <input type="text" name="ancho_marcada" id="ancho_marcada" class="form-control"
                                placeholder="Pulgadas">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="">Largo marcada</label>
                            <input type="text" name="largo_marcada" id="largo_marcada" class="form-control"
                                placeholder="Yardas">
                        </div>
                    </div>
                    <div class="row mt-2" id="fila3">
                        <div class="col-md-4 mt-2">
                            <label for="">Aprovechamiento(*):</label>
                            <input type="text" name="aprovechamiento" id="aprovechamiento" class="form-control"
                                data-inputmask='"mask": "99.99%"' data-mask>
                        </div>
                        <div class="col-md-4 mt-3">
                            <button type="button" class="btn btn-secondary btn-block mt-4" id="edit-hide"
                                data-toggle="modal" data-target=".bd-rollo-modal-lg">Agregar rollos <i
                                    class="fa fa-dolly-flatbed"></i></button>
                        </div>
                        <div class="col-md-4 mt-3">
                            <button type="button" class="btn btn-secondary btn-block mt-4" id="edit-hide2"
                                data-toggle="modal" data-target=".bd-talla-modal-xl">Distribucion de tallas<i
                                    class="fa fa-cut"></i></button>
                        </div>
                    </div>
            </div>
            <div class="card-footer text-muted ">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>

            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de cortes</h4>
    </div>
    <div class="card-body">
        <table id="cortes_listados" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Opciones</th>
                    <th>User</th>
                    <th>No.Corte</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                    <th>Est.</th>
                    <th>Fase</th>
                    <th>Total</th>
                    <th>Aprovecha.</th>
                    <th>No.Marc.</th>
                    <th>L.Marc.</th>
                    <th>A.Marc.</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Opciones</th>
                    <th>User</th>
                    <th>No.Corte</th>
                    <th>Producto</th>
                    <th>Fecha</th>
                    <th>Est.</th>
                    <th>Fase</th>
                    <th>Total</th>
                    <th>Aprovecha.</th>
                    <th>No.Marc.</th>
                    <th>L.Marc.</th>
                    <th>A.Marc.</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="container" id="listadoUsers">


</div>

<!-- Modal -->
<div class="modal fade bd-rollo-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Rollos(*):</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    {{-- <label for="">Corte: </label>
                    <div class="col-md-6">
                        <input type="text" name="corte" id="corte" class="form-control text-center">
                    </div> --}}
                </div>
                <br>
                <hr>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <table id="rollos" style="width: 100%;" class="table table-striped table-bordered datatables">
                            <thead>
                                <tr>
                                    <th>Rollo</th>
                                    <th>Referencia tela</th>
                                    <th>Yardas</th>
                                    <th>Tono</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>Rollo</th>
                                    <th>Referencia tela</th>
                                    <th>Yardas</th>
                                    <th>Tono</th>
                                    <th>Accion</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-talla-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Corte por tallas(*):</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <label for="">Corte: </label>
                    <div class="col-md-6 mb-2">
                        <input type="text" name="corte_tallas" id="corte_tallas" class="form-control text-center">
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
                    <table class="table  table-bordered table-responsive">
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
                <br><br>
                <div class="row">
                    <div class="col-lg-1 col-xs-">
                        <label for="" class="ml-4" id="ta">A</label>
                        <input type="text" name="" id="a" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tb">B</label>
                        <input type="text" name="" id="b" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tc">C</label>
                        <input type="text" name="" id="c" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="td">D</label>
                        <input type="text" name="" id="d" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="te">E</label>
                        <input type="text" name="" id="e" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4" id="tf">F</label>
                        <input type="text" name="" id="f" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tg">G</label>
                        <input type="text" name="" id="g" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="th">H</label>
                        <input type="text" name="" id="h" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="ti">I</label>
                        <input type="text" name="" id="i" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tj">J</label>
                        <input type="text" name="" id="j" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tk">K</label>
                        <input type="text" name="" id="k" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4" id="tl">L</label>
                        <input type="text" name="" id="l" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                </div>
                <hr>
                {{-- <div class="row">
                    <label for="" class="mt-3">Total:</label>
                    <div class="col-md-6 mt-3">
                        <input type="text" name="total" id="total" class="form-control text-center">
                    </div>
                </div> --}}
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@include('adminlte/scripts')
<script src="{{asset('js/corte/corte.js')}}"></script>

<script>
    function mostrar(id_corte) {
        $.post("corte/" + id_corte, function(data, status) {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#fila1").show();
            $("#fila2").show();
            $("#fila3").show();
            $("#btn-generar").hide();
            $("#edit-hide").hide();
            $("#edit-hide2").hide();

            // console.log(data);
            $("#id").val(data.corte.id);
            $("#numero_corte").val(data.corte.numero_corte);
            $("#no_marcada").val(data.corte.no_marcada);
            $("#ancho_marcada").val(data.corte.ancho_marcada);
            $("#largo_marcada").val(data.corte.largo_marcada);
            $("#aprovechamiento").val(data.corte.aprovechamiento);
           
        });
    }

    function eliminar(id_corte){
        bootbox.confirm("¿Estas seguro de eliminar este corte?", function(result){
            if(result){
                $.post("corte/delete/" + id_corte, function(data){
                    bootbox.alert("Corte <strong>"+ data.corte.numero_corte+ "</strong> eliminado correctamente");
                    $("#cortes_listados").DataTable().ajax.reload();
                })
            }
        })
    }

    function asignar(id_rollo) {     
        var rollo = {
            numero_corte: $("#numero_corte_gen").val(),
        };
        console.log(JSON.stringify(rollo));

        $.ajax({
            url: "asignar/"+ id_rollo,
            type: "POST",
            dataType: "json",
            data: JSON.stringify(rollo),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Rollo <strong>"+datos.rollo.codigo_rollo +"</strong> asignado correctamente al corte: <strong>"
                        +datos.rollo.corte_utilizado+"</strong>");
                    $("#btn-guardar").attr("disabled", false);
                    $("#rollos").DataTable().ajax.reload();
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante esta operacion!!"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Rollo ya asignado a un numero de corte"
                );
            }
        });
    }

</script>

@endsection