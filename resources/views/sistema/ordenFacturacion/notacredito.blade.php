@extends('adminlte.layout')

@section('seccion', 'Facturacion')

@section('title', 'Nota de credito')

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
                <h4>Formulario de nota de credito:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                   
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
        <h4>Nota de creditos</h4>
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
                    {{-- <div class="col-md-4">
                        <select name="sub-genero" id="sub-genero" class="form-control">
                            <option value=""></option>
                            <option value="Mujer">Mujer</option>
                            <option value="Mujer Plus">Mujer plus</option>
                        </select>
                    </div> --}}
                </div>
                <div class="row">
                    <table class="table  table-bordered  table-responsive">
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
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="ta">A</label>
                        <input type="text" name="" id="a" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tb">B</label>
                        <input type="text" name="" id="b" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2 ">
                        <label for="" class="ml-4" id="tc">C</label>
                        <input type="text" name="" id="c" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="td">D</label>
                        <input type="text" name="" id="d" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="te">E</label>
                        <input type="text" name="" id="e" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tf">F</label>
                        <input type="text" name="" id="f" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tg">G</label>
                        <input type="text" name="" id="g" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="th">H</label>
                        <input type="text" name="" id="h" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="ti">I</label>
                        <input type="text" name="" id="i" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tj">J</label>
                        <input type="text" name="" id="j" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
                        <label for="" class="ml-4" id="tk">K</label>
                        <input type="text" name="" id="k" class="form-control" data-inputmask='"mask": "999"' data-mask>
                    </div>
                    <div class="col-lg-1 col-md-2">
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
<script src="{{asset('js/nota_credito.js')}}"></script>

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

   

</script>

@endsection