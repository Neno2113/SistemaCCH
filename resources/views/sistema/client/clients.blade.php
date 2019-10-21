@extends('adminlte.layout')

@section('title', 'Clientes')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-4">
    <button class="btn btn-primary mb-3" id="btnAgregar">Crear <i class="fas fa-user-plus"></i></button>
    <button class="btn btn-danger mb-3" id="btnCancelar">Cancelar</button>
    <button class="btn btn-info mb-3 ml-2" data-toggle="modal" data-target=".bd-example-modal-lg">Agregar sucursales
        <i class="fas fa-building"></i></button>
</div>

<div class="row">
    <div class="col-12">


        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-light border-top">
                <h4>Formulario de registro de clientes:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div class="row ">
                        <div class="col-md-4">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="nombre_cliente">Nombre(*):</label>
                            <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="rnc">RNC(*):</label>
                            <input type="text" name="rnc" id="rnc" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="direccion_principal">Direccion principal(*):</label>
                            <input type="text" name="direccion_principal" id="direccion_principal" class="form-control">
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

                    <br>
                    <hr>
                    <br>

                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="celular_principal">Celular principal:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="celular_principal" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="email_principal">Email principal(*):</label>
                            <input type="email" name="email_principal" id="email_principal" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="contacto_cliente">Contacto cliente(*):</label>
                            <input type="text" name="contacto_cliente_principal" id="contacto_cliente_principal"
                                class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
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
                    <br>
                    <hr>
                    <br>
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
                            <label for="autorizacion_credito_req">¿Acepta segundas?(*):</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary7" name="r4" value="1" checked>
                                    <label for="radioPrimary7">
                                        Si
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary8" name="r4" value="0">
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
                            <input type="text" name="factura_desglosada_tallas" id="factura_desglosada_tallas"
                                class="form-control" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="notas" class="d-flex justify-content-center">Notas:</label>
                            <textarea name="notas" id="notas" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
            </div>
            <div class="card-footer bg-light text-muted d-flex justify-content-end">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-success mt-4">
                <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-warning mt-4">
            </div>
        </div>

        </form>
    </div>
</div>
{{-- </div> --}}

<div class="container" id="listadoUsers">
    <table id="clients" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th></th>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>Cliente</th>
                <th>RNC</th>
                <th>Contacto</th>
                <th>Tel 1</th>
                <th>Tel 2</th>
                <th>Tel 3</th>
                <th>Celular </th>
                <th>Email</th>
                <th>Condiciones de Credito</th>
                <th>Direccion </th>
                <th>Notas</th>
                <th>Autorizacion de Credito requerida</th>
                <th>Acepta redistribucion de tallas</th>
                <th>Acepta factura desglosada por tallas</th>
                <th>Acepta segundas</th>
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
                <th>Tel 1</th>
                <th>Tel 2</th>
                <th>Tel 3</th>
                <th>Celular </th>
                <th>Email</th>
                <th>Condiciones de Credito</th>
                <th>Direccion</th>
                <th>Notas</th>
                <th>Autorizacion de Credito requerida</th>
                <th>Acepta redistribucion de tallas</th>
                <th>Acepta factura desglosada por tallas</th>
                <th>Acepta segundas</th>
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" id="btn-guardar-branch" class="btn btn-primary">Guardar</button>
            </div>
            </form>
        </div>
    </div>
</div>




@include('adminlte/scripts')
<script src="{{asset('js/client.js')}}"></script>
<script src="{{asset('js/client_branch.js')}}"></script>
<script>
    function mostrar(id_client) {
        $.post("client/" + id_client, function(data, status) {
           
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#autorizacion_credito_req").show();
            $("#redistribucion_tallas").show();
            $("#factura_desglosada_tallas").show();
            $("#acepta_segundas").show();

            let result1, result2, result3, result4; 
            if(data.client.autorizacion_credito_req == 1){
                result1 = 'Si';
            }else{
                result1 = 'No';
            }

            if(data.client.redistribucion_tallas == 1){
                result2 = 'Si';
            }else{
                result2 = 'No';
            }

            if(data.client.factura_desglosada_talla == 1){
                result3 = 'Si';
            }else{
                result3 = 'No';
            }

            if(data.client.acepta_segundas == 1){
                result4 = 'Si';
            }else{
                result4 = 'No';
            }

            // console.log(typeof data.client.autorizacion_credito_req);
            $("#id").val(data.client.id);
            $("#nombre_cliente").val(data.client.nombre_cliente);
            $("#direccion_principal").val(data.client.direccion_principal);
            $("#contacto_cliente_principal").val(data.client.contacto_cliente_principal);
            $("#telefono_1").val(data.client.telefono_1);
            $("#telefono_2").val(data.client.telefono_2);
            $("#telefono_3").val(data.client.telefono_3);
            $("#celular_principal").val(data.client.celular_principal);
            $("#email_principal").val(data.client.email_principal);
            $("#condiciones_credito").val(data.client.condiciones_credito);
            $("#autorizacion_credito_req").val(result1);
            $("#notas").val(data.client.notas);
            $("#redistribucion_tallas").val(result2);
            $("#factura_desglosada_tallas").val(result3);
            $("#acepta_segundas").val(result4);
           
        });
    }

    function eliminar(id_client){
        bootbox.confirm("¿Estas seguro de eliminar este cliente?", function(result){
            if(result){
                $.post("client/delete/" + id_client, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Cliente eliminado correctamente!!");
                    $("#clients").DataTable().ajax.reload();
                })
            }
        })
    }

   



</script>



@endsection