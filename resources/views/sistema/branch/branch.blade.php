@extends('adminlte.layout')

@section('seccion', 'Clientes')

@section('title', 'Sucursales')

@section('content')
<div class="container">
    <div class="row mt-2">
        <button class="btn btn-info mb-3 ml-2" data-toggle="modal" data-target=".bd-example-modal-lg" id="btn-agregar">
            <i class="fas fa-building fa-lg"></i> Agregar sucursales</button>
    </div>
</div>

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de sucursales</h4>
    </div>
    <div class="card-body">
        <table id="branches" class="table  table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    {{-- <th>Ver</th> --}}
                    <th>Actions</th>
                    <th>Cliente</th>
                    {{-- <th>Codigo sucursal</th> --}}
                    <th>Sucursal</th>
                    <th>Telefono suc.</th>
                    <th>Direccion</th>

                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    {{-- <th>Ver</th> --}}
                    <th>Actions</th>
                    <th>Cliente</th>
                    {{-- <th>Codigo sucursal</th> --}}
                    <th>Sucursal</th>
                    <th>Telefono suc.</th>
                    <th>Direccion</th>
                </tr>
            </tfoot>
        </table>
    </div>

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
                            <label for="Cliente"></label>
                            <input type="hidden" name="id" id="id">
                            <select name="tags[]" id="clientes" class="form-control select2">

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <label for="nombre_sucursal"></label>
                            <input type="text" placeholder="Nombre sucursal" name="nombre_sucursal" id="nombre_sucursal" class="form-control"
                                placeholder="Puede ser el nombre mas la direccion">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="telefono_sucursal"></label>
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                                <input type="text" placeholder="Telefono" id="telefono_sucursal" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            {{-- </div> --}}
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label for="calle"></label>
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div> --}}
                                <input type="text" placeholder="Calle" id="calle" name="calle" class="form-control">
                            {{-- </div> --}}
                        </div>
                        <div class="col-md-4 ">
                            <label for="sector"></label>
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div> --}}
                                <input type="text" id="sector" placeholder="Sector" name="sector" class="form-control">
                            {{-- </div> --}}
                        </div>
                        <div class="col-md-4">
                            <label for="provincia"></label>
                            <select name="provincia" id="provincia" class="form-control select2" style="width:100%">
                                <option value="" disabled>Provincia</option>
                                <option>Santo Domingo</option>
                                <option>Distrito Nacional</option>
                                <option>Santiago</option>
                                <option>San Cristóbal</option>
                                <option>La Vega</option>
                                <option>Puerto Plata</option>
                                <option>San Pedro de Macorís</option>
                                <option>Duarte</option>
                                <option>La Altagracia</option>
                                <option>La Romana</option>
                                <option>San Juan</option>
                                <option>Espaillat</option>
                                <option>Azua</option>
                                <option>Barahona</option>
                                <option>Monte Plata</option>
                                <option>Peravia</option>
                                <option>Monseñor Nouel</option>
                                <option>Valverde</option>
                                <option>Sánchez Ramírez</option>
                                <option>María Trinidad Sánchez</option>
                                <option>Montecristi</option>
                                <option>Samaná</option>
                                <option>Bahoruco</option>
                                <option>Hermanas Mirabal</option>
                                <option>El Seibo</option>
                                <option>Hato Mayor</option>
                                <option>Dajabón</option>
                                <option>Elías Piña</option>
                                <option>San José de Ocoa</option>
                                <option>Santiago Rodríguez</option>
                                <option>Independencia</option>
                                <option>Pedernales</option>
                            </select>

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for=""></label>
                            <input type="text" placeholder="Referencias cercanas" name="sitios_cercanos" id="sitios_cercanos" class="form-control">

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" id="btn-guardar-branch" class="btn btn-primary">Guardar</button>
                <button type="submit" id="btn-edit-branch" class="btn btn-warning">Actualizar</button>
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
            $("#btn-edit-branch").show();
            $("#btn-guardar-branch").hide();


            $("#id").val(data.branch.id);
            $("#clientes").val(data.branch.cliente.nombre_cliente).trigger("change");
            $("#nombre_sucursal").val(data.branch.nombre_sucursal).attr("readonly", false);
            $("#telefono_sucursal").val(data.branch.telefono_sucursal).attr("readonly", false);
            $("#calle").val(data.branch.calle).attr("readonly", false);
            $("#sector").val(data.branch.sector).attr("readonly", false);
            $("#provincia").val(data.branch.provincia).trigger("change").attr("disabled", false);
            $("#sitios_cercanos").val(data.branch.sitios_cercanos).attr("disabled", false);


        });
    }

    function eliminar(id_branch){
        Swal.fire({
        title: '¿Esta seguro de eliminar eliminar esta sucursal?',
        text: "Va a eliminar esta sucursal!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("client-branch/delete/" + id_branch, function(){
                Swal.fire(
                'Eliminado!',
                'Sucursal eliminada correctamente.',
                'success'
                )
                $("#branches").DataTable().ajax.reload();
            })
        }
      })
        // bootbox.confirm("¿Estas seguro de eliminar esta sucursal?", function(result){
        //     if(result){
        //         $.post("client-branch/delete/" + id_branch, function(){
        //             // bootbox.alert(e);
        //             bootbox.alert("Sucursal eliminada correctamente!!");
        //             $("#branches").DataTable().ajax.reload();
        //         })
        //     }
        // })
    }

</script>



@endsection
