@extends('adminlte.layout')

@section('seccion', 'Clientes')

@section('title', 'Sucursales')

@section('content')

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Sucursales')->where('agregar', 1)->first())
                <button class="btn btn-primary float-left" data-toggle="modal" data-target=".bd-example-modal-xl" id="btn-agregar">
                    <i class="fas fa-building fa-lg"></i> Agregar sucursales</button>
                @endif
                <h4 class="text-center text-white">Listado de sucursales</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Sucursales')->where('ver', 1)->first())
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
        @else
        <div class="row" id="alerts">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle"></i>
                     Info
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Acceso negado!</h5>
                        Usted no posee permisos necesarios para realizar esta accion.
                        Para poder realizar la accion debe comunicarse con el administrador.
                  </div>
               
               
                </div>
        
              </div>
              <!-- /.card -->
            </div>
        </div>
        @endif
    </div>

</div>


{{-- Modal Sucursales --}}

<!-- Modal -->
<div class="modal fade bd-example-modal-xl" id="exampleModal" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel">Formulario de registro de sucursales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="BrachForm">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="Cliente">Cliente</label>
                            <input type="hidden" name="id" id="id">
                            <select name="tags[]" id="clientes" class="form-control select2">
                                <option value="" disabled>Selecciona o busca un cliente</option>

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-4">
                            <label for="nombre_sucursal">Nombre Sucursal</label>
                            <input type="text"  id="nombre_sucursal" class="form-control"
                                placeholder="Puede ser el nombre mas la direccion">
                        </div>
                        <div class="col-md-6 mt-4">
                            <label for="telefono_sucursal">Telefono</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text"  id="telefono_sucursal" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label for="calle">Calle</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text"  id="calle" name="calle" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <label for="sector">Sector</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text" id="sector"  name="sector" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="provincia">Provincia</label>
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
                            <label for="">Referencias cercanas</label>
                            <input type="text" name="sitios_cercanos" id="sitios_cercanos" class="form-control">

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
<script src="{{asset('js/cliente/client_branch.js')}}"></script>




@endsection
