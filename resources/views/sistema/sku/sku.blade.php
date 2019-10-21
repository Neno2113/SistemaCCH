@extends('adminlte.layout')

@section('title', 'SKU')

@section('content')

<div class="container">
    <div class="row mt-3 ml-3">
        <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-th-list"></i></button>
        <button class="btn btn-danger mb-3" id="btnCancelar"><i class="fas fa-window-close"></i></button>
    </div>

    @if(Session::has('msg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong class="d-flex justify-content-center">{{Session::get('msg')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary border-top">
                <h4>Favor seleccionar el excel con los SKU</h4>
            </div>
            <div class="card-body">
                <form action="/sistemaCCH/public/text-read" method="POST" enctype="multipart/form-data" id="formulario"
                    class="form-group carta panel-body">
                    @csrf
                    <h5>Importar SKUs:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-12 d-flex justify-content-center">
                            <h5></h5>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center mt-2">
                            <input type="file" name="sku" id="" class="form control">
                        </div>
                    </div>
            </div>
            <div class="card-footer text-muted d-flex justify-content-center border-bottom">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-primary mt-4">
            </div>
            </form>
        </div>
    </div>
</div>
<div class="container" id="listadoUsers">
    <table id="skus" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Producto</th>
                <th>Talla</th>
            
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>SKU</th>
                <th>Producto</th>
                <th>Talla</th>
            </tr>
        </tfoot>
    </table>

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