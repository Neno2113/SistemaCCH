@extends('adminlte.layout')

@section('title', 'Rollos')

@section('content')
{{-- <div class="container"> --}}
<div class="row">
    <div class="col-md-6 mt-3 ml-3">
        <button class="btn btn-primary mb-3 " id="btnAgregar"><i class="fas fa-th-list"></i></button>
        <button class="btn btn-danger mb-3 " id="btnCancelar"><i class="fas fa-window-close"></i></button>
    </div>
</div>
<div class="row">
    <div class="col-12">


        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center  border-top">
                <h4>Formulario de registro de rollos:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="nombre_cliente">Suplidor(*):</label>
                            <select name="tags[]" id="suplidores" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="nombre_cliente">Tela(*):</label>
                            <select name="tags[]" id="cloths" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="">Fecha compra(*):</label>
                            <input type="date" name="" id="fecha_compra" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for="">Factura(*):</label>
                            <input type="text" name="" id="no_factura_compra" placeholder="Numero" class="form-control">
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 mt-2">
                            <label for="">Codigo(*):</label>
                            <input type="text" name="" id="codigo_rollo" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for="">Tono(*):</label>
                            <input type="text" name="" id="num_tono" class="form-control">
                        </div>


                        <div class="col-md-4 mt-2">
                            <label for="">Longitud en yarda(*):</label>
                            <input type="text" name="" id="longitud_yarda" class="form-control">
                        </div>
                    </div>
            </div>
            <div class="card-footer bg-light text-muted d-flex justify-content-end border-bottom border-top">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4">
            </div>
            </form>
        </div>
    </div>
</div>

<div class="container" id="listadoUsers">
    <table id="rollos" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th></th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Suplidor</th>
                <th>Tela</th>
                <th>Codigo</th>
                <th>Tono</th>
                <th>Fecha compra</th>
                <th>Factura compra</th>
                <th>Corte asignado</th>
                <th>Longitud en yardas</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th></th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Suplidor</th>
                <th>Tela</th>
                <th>Codigo</th>
                <th>Tono</th>
                <th>Fecha compra</th>
                <th>Factura compra</th>
                <th>Corte asignado</th>
                <th>Longitud en yardas</th>
            </tr>
        </tfoot>
    </table>

</div>


{{-- <table id="table-data" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th>Suplidor</th>
                <th>Referencia</th>
                <th>Codigo</th>
                <th>Tono</th>
                <th>Fecha de compra</th>
                <th>Longitud en yarda</th>
                <th>Guardado</th>
               
            </tr>
        </thead>
        <tbody>
            <tr class="tr_clone">
                <th><select name="tags[]" id="suplidores" class="form-control select2 suplidor"></select></th>
                <th><select name="tags[]" id="cloths" class="form-control select2 suplidor"></select></th>
                <th><input type="text" name="" id="codigo_rollo" class="form-control"></th>
                <th><input type="text" name="" id="num_tono" class="form-control"></th>
                <th><input type="date" name="" id="fecha_compra" class="form-control"></th>
                <th><input type="text" name="" id="longitud_yarda" class="form-control"></th>
                <th><button  id="" class="btn btn-success btn-guardar">Guardar</button></th>
                
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Suplidor</th>
                <th>Referencia</th>
                <th>Codigo</th>
                <th>Tono</th>
                <th>Fecha de compra</th>
                <th>Longitud en yarda</th>
                <th>Guardado</th>
                
            </tr>
        </tfoot>
    </table> --}}



{{-- </div> --}}


@include('adminlte/scripts')
<script src="{{asset('js/rollos.js')}}"></script>

<script>
    function mostrar(id_rollo) {
        $.post("rollo/" + id_rollo, function(data, status) {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();

            // console.log(data);
            // $("#suplidores").select2('val', data.rollo.suplidores.nombre);
            $("#id").val(data.rollo.id);
            $("#codigo_rollo").val(data.rollo.codigo_rollo);
            $("#num_tono").val(data.rollo.num_tono);
            $("#no_factura_compra").val(data.rollo.no_factura_compra);
            $("#fecha_compra").val(data.rollo.fecha_compra);
            $("#longitud_yarda").val(data.rollo.longitud_yarda);
        });
    }


    function eliminar(id_rollo){
        bootbox.confirm("¿Estas seguro de eliminar este rollo?", function(result){
            if(result){
                $.post("rollo/delete/" + id_rollo, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Rollo eliminado correctamente!!");
                    $("#rollos").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection