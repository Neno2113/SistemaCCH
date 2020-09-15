@extends('adminlte.layout')

@section('seccion', 'Clientes')

@section('title', 'Clientes')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header bg-dark">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de clientes</h5>
                    <hr>
                    <div class="Datos">

                        <div class="row mt-4">
                            <div class="col-md-4 mt-2">
                                <input type="text" name="codigo_cliente" placeholder="Codigo Cliente" id="codigo_cliente"
                                    class="form-control">
                                <label for="nombre_cliente" class="label"></label>
                            </div>
                            <input type="hidden" name="id" id="id" value="">
                            <div class="col-md-4 mt-2">

                                <input type="text" name="nombre_cliente" placeholder="Nombre" id="nombre_cliente"
                                    class="form-control">
                                <label for="nombre_cliente" class="label"></label>
                            </div>
                            <div class="col-md-4 mt-2">

                                <input type="text" name="rnc" id="rnc" placeholder="RNC"
                                    class="form-control text-center" data-inputmask='"mask": "99999999999"' data-mask>
                                <label for="rnc" class="label"></label>
                            </div>



                        </div>
                        <div class="row mt-4">
                            <div class="col-md-3 mt-3">


                                <input type="text" id="celular_principal" placeholder="Celular principal"
                                    class="form-control " data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                <label for="celular_principal" class="label"></label>

                            </div>
                            <div class="col-md-3 mt-3">

                                {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                                <input type="text" id="telefono_1" placeholder="Telefono" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                <label for="telefono_1" class="label"></label>
                                {{-- </div> --}}
                            </div>
                            <div class="col-md-3 mt-3">

                                {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                                <input type="text" id="telefono_2" placeholder="Telefono 2" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                <label for="telefono_2" class="label"></label>
                                {{-- </div> --}}
                            </div>
                            <div class="col-md-3 mt-3">

                                {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                                <input type="text" id="telefono_3" placeholder="Telefono 3" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                <label for="telefono_2" class="label"></label>
                                {{-- </div> --}}
                            </div>
                        </div>

                        <br>

                        <br>

                        <div class="row">
                            <div class="col-md-4 mt-3">

                                <select name="condiciones_credito" id="condiciones_credito" class="form-control">
                                    <option value="" disabled>Condiciones de credito</option>
                                    <option value="0">Al contado</option>
                                    <option value="30">30 dias</option>
                                    <option value="60">60 dias</option>
                                    <option value="90">90 dias</option>
                                    <option value="120">120 dias</option>
                                </select>
                                <label for="condiciones_credito" class="label"></label>
                            </div>
                            <div class="col-md-4 mt-3">

                                {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div> --}}
                                <input type="email" name="email_principal" placeholder="Email principal"
                                    id="email_principal" class="form-control">
                                <label for="email_principal" class="label"></label>
                                {{-- </div> --}}
                            </div>
                            <div class="col-md-4 mt-3">

                                <input type="text" name="contacto_cliente_principal" placeholder="Contacto cliente"
                                    id="contacto_cliente_principal" class="form-control">
                                <label for="contacto_cliente" class="label"></label>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <div class="row mt-3">
                            <div class="col-md-4">

                                {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div> --}}
                                <input type="text" placeholder="Calle" name="calle" id="calle" class="form-control">
                                <label for="" class="label"></label>
                                {{-- </div> --}}
                            </div>
                            <div class="col-md-4">

                                {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div> --}}
                                <input type="text" name="sector" placeholder="Sector" id="sector" class="form-control">
                                <label for="" class="label"></label>
                                {{-- </div> --}}
                            </div>
                            <div class="col-md-4">

                                <select name="provincia" id="provincia" class="form-control select2">
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
                                <label for="" class="label"></label>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-4">

                                <input type="text" name="sitios_cercanos" placeholder="Referencias cercanas"
                                    id="sitios_cercanos" class="form-control">
                                <label for="" class="label"></label>
                            </div>
                        </div>
                        <br>
                        <hr>
                    </div>
                    <br>
                    <div id="autorizaciones">
                        <div class="row" id="radios">
                            <div class="col-md-4 mt-4">
                                <label for="autorizacion_credito_req">¿Autorizacion de credito requerida?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="r1" value="1" checked>
                                        <label for="radioPrimary1">
                                            Si
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" value="0" name="r1">
                                        <label for="radioPrimary2">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <input type="text" name="autorizacion_credito_req" id="autorizacion_credito_req"
                                    class="form-control" readonly>
                            </div>
                            <div class="col-md-4 mt-4">
                                <label for="autorizacion_credito_req">¿Acepta redistribucion de tallas?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary3" name="r2" value="1" checked>
                                        <label for="radioPrimary3">
                                            Si
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary4" name="r2" value="0">
                                        <label for="radioPrimary4">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <input type="text" name="redistribucion_tallas" id="redistribucion_tallas"
                                    class="form-control" readonly>
                            </div>
                            <div class="col-md-4 mt-4">
                                <label for="autorizacion_credito_req">¿Acepta segundas?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary7" name="r4" value="1">
                                        <label for="radioPrimary7">
                                            Si
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary8" name="r4" value="0" checked>
                                        <label for="radioPrimary8">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <input type="text" name="acepta_segundas" id="acepta_segundas" class="form-control"
                                    readonly>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-2">
                                <label for="autorizacion_credito_req">Exige factura desglosada por tallas?(*):</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary5" name="r3" value="1">
                                        <label for="radioPrimary5">
                                            Si
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary6" name="r3" value="0" checked>
                                        <label for="radioPrimary6">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <input type="text" name="factura_desglosada_tallas" id="factura_desglosada_tallas"
                                    class="form-control" readonly>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="row">
                            <div class="col-md-12 mt-2">

                                <textarea name="notas" id="notas" placeholder="Notas" cols="30" rows="1"
                                    class="form-control"></textarea>
                                <label for="notas" class="label"></label>
                            </div>
                        </div>
                    </div>

            </div>

            <div class="card-footer  text-muted ">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>
        </div>

        </form>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                <h4 class="text-white text-center">Listado de clientes</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        <table id="clients" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Cliente</th>
                    <th>RNC</th>
                    <th>Contacto</th>
                    <th>Email</th>
                    <th>Condiciones de Credito</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Cliente</th>
                    <th>RNC</th>
                    <th>Contacto</th>
                    <th>Email</th>
                    <th>Condiciones de Credito</th>
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
                            <label for="Cliente">Cliente(*):</label>
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
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <label for="calle">Calle(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text" id="calle" name="calle" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 ">
                            <label for="sector">Sector(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text" id="sector" name="sector" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="provincia">Provincia(*):</label>
                            <select name="provincia" id="provincia" class="form-control select2" style="width:100%">
                                <option value=""></option>
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
                            <label for="">Referencias cercanas:</label>
                            <input type="text" name="sitios_cercanos" id="sitios_cercanos" class="form-control">

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn-guardar-branch" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>




@include('adminlte/scripts')
<script src="{{asset('js/formulario.js')}}"></script>
<script src="{{asset('js/client.js')}}"></script>
<script src="{{asset('js/client_branch.js')}}"></script>




@endsection
