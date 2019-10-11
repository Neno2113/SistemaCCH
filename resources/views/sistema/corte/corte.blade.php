@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row">
        <button class="btn btn-primary mb-3 btn-lg" id="btnAgregar"><i class="fas fa-th-list"></i></button>
        <button class="btn btn-danger mb-3 btn-lg" id="btnCancelar"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary">
                <h4>Corte</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de creacion de corte:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-4">
                            <label for="">Numero corte(*):</label>
                            <input type="hidden" name="id" id="id" value="">
                            <input type="text" name="numero_corte" id="numero_corte" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="">Referencia producto(*):</label>
                            <select name="tags[]" id="productos" class="form-control select2">
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="">Fecha(*):</label>
                            <input type="date" name="fecha_corte" id="fecha_corte" class="form-control">
                        </div>
                    </div>
                    <div class="row">
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
                    <div class="row">
                        <div class="col-md-4 mt-2">
                            <label for="">Aprovechamiento(*):</label>
                            <input type="text" name="aprovechamiento" id="aprovechamiento" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <button type="button" class="btn btn-secondary btn-block mt-4" data-toggle="modal"
                                data-target=".bd-rollo-modal-lg">Agregar rollos <i
                                    class="fa fa-dolly-flatbed"></i></button>
                        </div>
                        <div class="col-md-4 mt-3">
                            <button type="button" class="btn btn-secondary btn-block mt-4" data-toggle="modal"
                                data-target=".bd-talla-modal-xl">Definir Corte <i class="fa fa-cut"></i></button>
                        </div>
                    </div>
            </div>
            <div class="card-footer text-muted d-flex justify-content-end">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-info mt-4">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-info mt-4">
            </div>

            </form>
        </div>
    </div>
</div>

{{-- <div class="container" id="listadoUsers">
    <table id="compositions" class="table table-striped table-bordered datatables" >
        <thead>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Nombre composicion</th>

            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Nombre composicion</th>
            </tr>
        </tfoot>
    </table>

</div> --}}

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
                    <div class="col-md-12">
                        <table id="rollos" style="width: 100%;" class="table table-striped table-bordered datatables">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Referencia producto</th>
                                    <th>Rollo</th>
                                    <th>Yardas</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Referencia producto</th>
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
                    <table class="table  table-bordered">
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
                    <div class="col-md-1">
                        <label for="" class="ml-4">A</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4">B</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4">C</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4">D</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4">E</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="">F</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4">G</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4">H</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4">I</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4">J</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4">K</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="col-md-1">
                        <label for="" class="ml-4">L</label>
                        <input type="text" name="" id="" class="form-control">
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
<script src="{{asset('js/corte.js')}}"></script>

<script>
    function mostrar(id_composition) {
        $.post("composition/" + id_composition, function(data, status) {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();

            // console.log(data);
            $("#id").val(data.composition.id);
            $("#codigo_composicion").val(data.composition.codigo_composicion);
            $("#nombre_composicion").val(data.composition.nombre_composicion);
           
        });
    }

    function eliminar(id_composition){
        bootbox.confirm("¿Estas seguro de eliminar esta composicion?", function(result){
            if(result){
                $.post("composition/delete/" + id_composition, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Composicion eliminada correctamente");
                    $("#compositions").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection