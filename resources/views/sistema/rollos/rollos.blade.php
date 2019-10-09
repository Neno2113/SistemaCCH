@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-th-list"></i></button>
            <button class="btn btn-danger mb-3" id="btnCancelar"><i class="fas fa-window-close"></i></button>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary">
                <h4>Rollos</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de rollos:</h5>
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
                            <label for="">Codigo(*):</label>
                            <input type="text" name="" id="codigo_rollo" class="form-control">
                        </div>
                        <div class="col-md-3">
                            <label for="">Tono(*):</label>
                            <input type="text" name="" id="num_tono" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-2">
                            <label for="">Fecha compra(*):</label>
                            <input type="date" name="" id="fecha_compra" class="form-control">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="">No.Factura de compra(*):</label>
                            <input type="text" name="" id="no_factura_compra" class="form-control">
                        </div>
                        <div class="col-md-3 mt-2">
                            <label for="">Longitud en yarda(*):</label>
                            <input type="text" name="" id="longitud_yarda" class="form-control">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-secondary mt-4">
                        <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-secondary mt-4">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container" id="listadoUsers">
        <table id="rollos" class="table table-striped table-bordered datatables">
            <thead>
                <tr>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>ID</th>
                    <th>Nombre Suplidor</th>
                    <th>Referencia tela</th>
                    <th>Codigo</th>
                    <th>Tono</th>
                    <th>Fecha compra</th>
                    <th>No. factura compra</th>
                    <th>Longitud en yardas</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>ID</th>
                    <th>Nombre Suplidor</th>
                    <th>Referencia tela</th>
                    <th>Codigo</th>
                    <th>Tono</th>
                    <th>Fecha compra</th>
                    <th>No. factura compra</th>
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



</div>


@include('adminlte/scripts')
<script src="{{asset('js/rollos.js')}}"></script>

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

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var composition = {
            id: $("#id").val(),
            codigo_composicion: $("#codigo_composicion").val(),
            nombre_composicion: $("#nombre_composicion").val()
        };
     
        $.ajax({
            url: "composition/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(composition),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el usuario");
                    $("#id").val("");
                    $("#codigo_composicion").val("");
                    $("#nombre_composicion").val("");
                    $("#listadoUsers").show();
                    $("#registroForm").hide();
                    $("#btnCancelar").hide();
                    $("#btn-edit").hide();
                    $("#btn-guardar").show();

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error!!"
                );
            }
        });
       
    });

    function eliminar(id_composition){
        bootbox.confirm("¿Estas seguro de eliminar esta composicion?", function(result){
            if(result){
                $.post("composition/delete/" + id_composition, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Composicion eliminada correctamente");
                })
            }
        })
    }

</script>



@endsection