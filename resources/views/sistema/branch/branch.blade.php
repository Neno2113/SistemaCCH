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
                <th>Nombre cliente</th>
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
                <th>Nombre cliente</th>
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

    function eliminar(id_branch){
        bootbox.confirm("¿Estas seguro de eliminar esta sucursal?", function(result){
            if(result){
                $.post("client-branch/delete/" + id_branch, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Sucursal eliminada correctamente!!");
                    $("#branches").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection