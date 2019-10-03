@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row">
        <button class="btn btn-primary mb-3" id="btnAgregar">Crear <i class="fas fa-user-plus"></i></button>
        <button class="btn btn-danger mb-3" id="btnCancelar">Cancelar</button>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary">
                <h4>Clientes</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de clientes:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-4">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="nombre_cliente">Nombre(*):</label>
                            <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="direccion_principal">Direccion principal(*):</label>
                            <input type="text" name="direccion_principal" id="direccion_principal" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="contacto_cliente">Contacto cliente(*):</label>
                            <input type="text" name="contacto_cliente_principal" id="contacto_cliente_principal"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="telefono_1">Telefono(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono_1" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="telefono_2">Telefono 2:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono_2" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="telefono_2">Telefono 3:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono_3" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <button class="btn btn-secondary" type="button" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Agregar sucursales
                            </button>
                            </p>
                            <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                    <form action="" id="formSucursales">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="codigo_sucursal">Codigo sucursal</label>
                                                <input type="text" name="codigo_sucursal" id="codigo_sucursal"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="nombre_sucursal">Nombre Sucursal(*):</label>
                                                <input type="text" name="nombre_sucursal" id="nombre_sucursal"
                                                    class="form-control">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="telefono_sucursal">Telefono sucursal(*):</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fas fa-phone"></i></span>
                                                    </div>
                                                    <input type="text" id="telefono_sucursal" class="form-control"
                                                        data-inputmask='"mask": "(999) 999-9999"' data-mask>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mt-2">
                                                <label for="direccion">Direccion(*):</label>
                                                <input type="text" name="direccion" id="direccion" class="form-control">
                                            </div>

                                            <div class="col-md-8 mt-4 d-flex justify-content-end">
                                                <input type="submit" value="Guardar" class="btn btn-success">
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-4 mt-1">
                            <label for="celular_principal">Celular principal:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="celular_principal" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-1">
                            <label for="email_principal">Email principal(*):</label>
                            <input type="email" name="email_principal" id="email_principal" class="form-control">
                        </div>
                        <div class="col-md-4 mt-1">
                            <label for="condiciones_credito">Condiciones de credito(*):</label>
                            <select name="condiciones_credito" id="condiciones_credito" class="form-control">
                                <option value="Contado">Al contado</option>
                                <option value="30 dias">30 dias</option>
                                <option value="60 dias">60 dias</option>
                                <option value="90 dias">90 dias</option>
                                <option value="120 dias">120 dias</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
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
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="autorizacion_credito_req">¿Acepta factura desglosada por tallas?(*):</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary5" name="r3" value="1" checked>
                                    <label for="radioPrimary5">
                                        Si
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary6" name="r3" value="0">
                                    <label for="radioPrimary6">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="notas">Notas:</label>
                            <textarea name="notas" id="notas" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>

                    <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-info mt-4">
                    <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-info mt-4">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="" id="listadoUsers">
    <table id="clients" class="table table-striped table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Nombre Cliente</th>
                <th>Direccion Principal</th>
                <th>Contacto</th>
                <th>Telefono 1</th>
                <th>Celular Principal</th>
                <th>Email</th>
                <th>Condiciones de Credito</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Nombre Cliente</th>
                <th>Direccion Principal</th>
                <th>Contacto</th>
                <th>Telefono 1</th>
                <th>Celular Principal</th>
                <th>Email</th>
                <th>Condiciones de Credito</th>
            </tr>
        </tfoot>
    </table>
</div>




@include('adminlte/scripts')
<script src="{{asset('js/client.js')}}"></script>



@endsection