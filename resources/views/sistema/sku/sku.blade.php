@extends('adminlte.layout')

@section('title', 'SKU')


@section('content')
<div class="container">
    <div class="row">
        <button class="btn btn-primary mb-3" id="btnAgregar">Create <i class="fas fa-plus"></i></button>
        <button class="btn btn-danger mb-3" id="btnCancelar">Cancel <i class="fas fa-window-close"></i></button>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary">
                <h4>SKU</h4>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data" id="formulario" class="form-group carta panel-body">
                    <h5>Importar SKUs:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-12 d-flex justify-content-center">
                            <h5>Favor seleccionar el archivo con los SKU</h5>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center mt-2">
                            <input type="file" name="" id="" class="form control">
                        </div>
                    </div>
                    <input type="submit" value="Guardar" id="btn-guardar" class="btn btn-lg btn-info mt-4 d-flex justify-content-center">
                    <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-info mt-4">
                </form>
            </div>
        </div>
    </div>
</div>






@include('adminlte/scripts')
<script src="{{asset('js/sku.js')}}"></script>

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