@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row">
        <button class="btn btn-info mb-3 ml-2" data-toggle="modal" data-target=".bd-example-modal-lg">Agregar sucursales
            <i class="fas fa-building"></i></button>
    </div>
</div>

<div class="container" id="listadoUsers">
    <table id="branches" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Codigo sucursal</th>
                <th>Nombre  sucursal</th>
                <th>Telefono sucursal</th>
                <th>Direccion</th>
            
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Codigo sucursal</th>
                <th>Nombre  sucursal</th>
                <th>Telefono sucursal</th>
                <th>Direccion</th>
            </tr>
        </tfoot>
    </table>
</div>


{{-- Modal Sucursales --}}

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Formulario de registro de sucursales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="BrachForm">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="Cliente">Cliente(*):</label>
                            <input type="hidden" name="id" id="id">
                            <select name="tags[]" id="clientes" class="form-control select2">

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <label for="nombre_sucursal">Nombre Sucursal(*)</label>
                            <input type="text" name="nombre_sucursal" id="nombre_sucursal" class="form-control"
                                placeholder="Puede ser el nombre mas la direccion">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="telefono_sucursal">Telefono(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono_sucursal" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="direccion">Direccion(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                </div>
                                <input type="text" id="direccion" class="form-control">
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal" >Close</button>
                <button type="submit" id="btn-guardar-branch" class="btn btn-primary">Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-primary">Actualizar</button>
            </div>
            </form>
        </div>
    </div>
</div>




@include('adminlte/scripts')
<script src="{{asset('js/client_branch.js')}}"></script>
<script>
    function mostrar(id_branch) {
        $.post("client-branch/" + id_branch, function(data, status) {
           
            $("#exampleModal").modal('show');
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar-branch").hide();
         
            $("#id").val(data.branch.id);
            $("#nombre_sucursal").val(data.branch.nombre_sucursal);
            $("#telefono_sucursal").val(data.branch.telefono_sucursal);
            $("#direccion").val(data.branch.direccion);
           
           
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var client_branch = {
            id: $("#id").val(),
            client_id : $("#clientes").val(),
            nombre_sucursal: $("#nombre_sucursal").val(),
            telefono_sucursal: $("#telefono_sucursal").val(),
            direccion: $("#direccion").val(),
        
        };
        
        // console.log(JSON.stringify(client_branch));
        $.ajax({
            url: "client-branch/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(client_branch),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizo correctamente la sucursal!!");
                    $("#id").val("");
                    $("#nombre_sucursal").val("");
                    $("#telefono_sucursal").val("");
                    $("#direccion").val("");
                    $("#clientes").val("");


                    $("#btn-edit").hide();
                    $("#btn-guardar-branch").show();
                    $("#exampleModal").modal('hide');

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la sucursal"
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

    function eliminar(id_branch){
        bootbox.confirm("¿Estas seguro de eliminar esta sucursal?", function(result){
            if(result){
                $.post("client-branch/delete/" + id_branch, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Sucursal eliminada correctamente!!");
                })
            }
        })
    }

    $("#clientes").select2({
        placeholder: "Elige un cliente...",
        ajax: {
            url: 'clients',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.nombre_cliente,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })

    $("#btn-close").click(function(e){
        e.preventDefault();
        $("#id").val("");
        $("#nombre_sucursal").val("");
        $("#telefono_sucursal").val("");
        $("#direccion").val("");
        $("#clientes").val("");
        
    })

    



</script>



@endsection