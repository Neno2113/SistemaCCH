@extends('adminlte.layout')

@section('title', 'Cortes')

@section('content')
{{-- <div class="container "> --}}
<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3 " id="btnAgregar"><i class="fas fa-th-list"></i></button>
    <button class="btn btn-danger mb-3 " id="btnCancelar"><i class="fas fa-window-close"></i></button>
</div>
<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center  border-top">
                <h4>Formulario de creacion de corte:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div class="row">
                        {{-- <h5 class="mb-3">Generar numero de corte</h5> --}}
                        <div class="col-md-6 mt-3">
                            <label for="">Numero corte(*):</label>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="hidden" name="sec" id="sec" value="">
                            <input type="text" name="numero_corte" id="numero_corte" class="form-control text-center" readonly>
                        </div>
                        <div class="col-md-4 mt-5">
                            <button class="btn btn-primary btn-lg" id="btn-generar" name="btn-generar">Generar</button>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row" id="fila1">
                        <div class="col-md-12">
                            <label for="">Referencia producto(*):</label>
                            <select name="tags[]" id="productos" class="form-control select2">
                            </select>
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
                            <input type="text" name="ancho_marcada" id="ancho_marcada" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="">Largo marcada</label>
                            <input type="text" name="largo_marcada" id="largo_marcada" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-2" id="fila3">
                        <div class="col-md-4 mt-2">
                            <label for="">Aprovechamiento(*):</label>
                            <input type="text" name="aprovechamiento" id="aprovechamiento" class="form-control"
                                data-inputmask='"mask": "99.99%"' data-mask>
                        </div>
                        <div class="col-md-4 mt-3">
                            <button type="button" class="btn btn-info btn-block mt-4" id="edit-hide" data-toggle="modal"
                                data-target=".bd-rollo-modal-lg">Agregar rollos <i
                                    class="fa fa-dolly-flatbed"></i></button>
                        </div>
                        <div class="col-md-4 mt-3">
                            <button type="button" class="btn btn-info btn-block mt-4" id="edit-hide2" data-toggle="modal"
                                data-target=".bd-talla-modal-xl">Definir Corte <i class="fa fa-cut"></i></button>
                        </div>
                    </div>
            </div>
            <div class="card-footer text-muted d-flex justify-content-end border-bottom border-top">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-info mt-4">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-info mt-4">
            </div>

            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="container" id="listadoUsers">
    <table id="cortes" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th></th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Usuario</th>
                <th>No.Corte</th>
                <th>Producto</th>
                <th>Fecha</th>
                <th>Fase</th>
                <th>Total</th>
                <th>Aprovechamiento</th>
                <th>No.Marcada</th>
                <th>L.Marcada</th>
                <th>A.Marcada</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Usuario</th>
                <th>No.Corte</th>
                <th>Producto</th>
                <th>Fecha</th>
                <th>Fase</th>
                <th>Total</th>
                <th>Aprovechamiento</th>
                <th>No.Marcada</th>
                <th>L.Marcada</th>
                <th>A.Marcada</th>
            </tr>
        </tfoot>
    </table>

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
                    <label for="">Corte: </label>
                    <div class="col-md-6">
                        <input type="text" name="corte" id="corte" class="form-control text-center">
                    </div>
                </div>
                <br>
                <hr>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <table id="rollos" style="width: 100%;" class="table table-striped table-bordered datatables">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Referencia tela</th>
                                    <th>Rollo</th>
                                    <th>Yardas</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Referencia tela</th>
                                    <th>Rollo</th>
                                    <th>Yardas</th>
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
                        <tr>
                            <th>Niño</th>
                            <th>2</th>
                            <th>4</th>
                            <th>6</th>
                            <th>8</th>
                            <th>10</th>
                            <th>12</th>
                            <th>14</th>
                            <th>16</th>
                        </tr>
                        <tr>
                            <th>Niña</th>
                            <th>2</th>
                            <th>4</th>
                            <th>6</th>
                            <th>8</th>
                            <th>10</th>
                            <th>12</th>
                            <th>14</th>
                            <th>16</th>
                        </tr>
                        <tr>
                            <th>Dama TA</th>
                            <th>0/0</th>
                            <th>1/2</th>
                            <th>3/4</th>
                            <th>5/6</th>
                            <th>7/8</th>
                            <th>9/10</th>
                            <th>11/12</th>
                            <th>13/14</th>
                            <th>15/16</th>
                            <th>17/18</th>
                            <th>19/20</th>
                            <th>21/22</th>
                        </tr>
                        <tr>
                            <th>Dama plus</th>
                            <th>12W</th>
                            <th>14W</th>
                            <th>16W</th>
                            <th>18W</th>
                            <th>20W</th>
                            <th>22W</th>
                            <th>24W</th>
                            <th>26W</th>
                        </tr>
                        <tr>
                            <th>Caballero Skinny</th>
                            <th>28</th>
                            <th>29</th>
                            <th>30</th>
                            <th>32</th>
                            <th>34</th>
                            <th>36</th>
                            <th>38</th>
                            <th>40</th>
                            <th>42</th>
                            <th>44</th>
                        </tr>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-1 col-xs-">
                        <label for="" class="ml-4">A</label>
                        <input type="text" name="" id="a" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4">B</label>
                        <input type="text" name="" id="b" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4">C</label>
                        <input type="text" name="" id="c" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4">D</label>
                        <input type="text" name="" id="d" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4">E</label>
                        <input type="text" name="" id="e" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4">F</label>
                        <input type="text" name="" id="f" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4">G</label>
                        <input type="text" name="" id="g" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4">H</label>
                        <input type="text" name="" id="h" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4">I</label>
                        <input type="text" name="" id="i" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4">J</label>
                        <input type="text" name="" id="j" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4">K</label>
                        <input type="text" name="" id="k" class="form-control">
                    </div>
                    <div class="col-lg-1">
                        <label for="" class="ml-4">L</label>
                        <input type="text" name="" id="l" class="form-control">
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
<script src="{{asset('js/corte.js')}}"></script>

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
                    $("#cortes").DataTable().ajax.reload();
                })
            }
        })
    }

    function asignar(id_rollo) {     
        var rollo = {
            numero_corte: $("#numero_corte").val(),
        };
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