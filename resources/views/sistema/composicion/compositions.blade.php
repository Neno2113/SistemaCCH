@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row">
        <button class="btn btn-primary mb-3" id="btnAgregar">Create <i class="fas fa-plus"></i></button>
        <button class="btn btn-danger mb-3" id="btnCancelar">Cancel <i class="fas fa-window-close"></i></button>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary">
                <h4>Composiciones</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de composiciones:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-6">
                            <input type="hidden" name="id" id="id" value="">
                            {{-- <label for="codigo composicion">Codigo composicion(*):</label>
                            <input type="text" name="codigo_composicion" id="codigo_composicion" class="form-control"> --}}
                        </div>
                        <div class="col-md-12">
                            <label for="nombre composicion">Nombre composicion(*):</label>
                            <input type="text" name="nombre_composicion" id="nombre_composicion" class="form-control">
                        </div>
                    </div>


                    <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-info mt-4">
                    <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-info mt-4">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container" id="listadoUsers">
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

</div>




@include('adminlte/scripts')
<script src="{{asset('js/composition.js')}}"></script>

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