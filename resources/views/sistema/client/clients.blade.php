@extends('adminlte.layout')

@section('seccion', 'Clientes')

@section('title', 'Clientes')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-4">
    <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-user-plus fa-lg"></i> Agregar</button>
  
    <button class="btn btn-info mb-3 ml-2" data-toggle="modal" data-target=".bd-example-modal-lg">
        <i class="fas fa-building fa-lg"></i> Agregar sucursales</button>
</div>

<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
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
                            <input type="text" name="rnc" id="rnc" class="form-control text-center"
                            data-inputmask='"mask": "99999999999"' data-mask>
                        </div>
                        <div class="col-md-4">
                            <label for="celular_principal">Celular principal:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="celular_principal" class="form-control "
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
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

                    <br>

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
                        <div class="col-md-4 mt-3">
                            <label for="email_principal">Email principal(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="email" name="email_principal" id="email_principal" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="contacto_cliente">Contacto cliente(*):</label>
                            <input type="text" name="contacto_cliente_principal" id="contacto_cliente_principal"
                                class="form-control">
                        </div>
                    </div>
                    <br>
                    <hr>
                    <div class="row mt-3">
                        <div class="col-md-4">
                            <label for="">Calle(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text" name="calle" id="calle" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Sector:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text" name="sector" id="sector" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="">Provincia(*):</label>
                            <select name="provincia" id="provincia" class="form-control select2">
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
                            <label for="autorizacion_credito_req">¿Acepta segundas?</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary7" name="r4" value="1" >
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
                                    <input type="radio" id="radioPrimary5" name="r3" value="1" >
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
                    <div class="row">
                        <div class="col-md-12 mt-2">
                            <label for="notas" class="d-flex justify-content-center">Notas:</label>
                            <textarea name="notas" id="notas" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
            </div>
            <div class="card-footer  text-muted ">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-2 float-right"><i class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i class="far fa-edit fa-lg"></i> Editar</button>
            </div>
        </div>

        </form>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de clientes</h4>
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
            $("#nombre_cliente").val(data.client.nombre_cliente).attr('readonly', false);
            $("#rnc").val(data.client.rnc).attr('readonly', false);
            $("#calle").val(data.client.calle).attr('readonly', false);
            $("#sector").val(data.client.sector).attr('readonly', false);
            $("#provincia").val(data.client.provincia).trigger("change").attr('disabled', false);
            $("#sitios_cercanos").val(data.client.sitios_cercanos).attr('readonly', false);
            $("#contacto_cliente_principal").val(data.client.contacto_cliente_principal).attr('readonly', false);
            $("#telefono_1").val(data.client.telefono_1).attr('readonly', false);
            $("#telefono_2").val(data.client.telefono_2).attr('readonly', false);
            $("#telefono_3").val(data.client.telefono_3).attr('readonly', false);
            $("#celular_principal").val(data.client.celular_principal).attr('readonly', false);
            $("#email_principal").val(data.client.email_principal).attr('readonly', false);
            $("#condiciones_credito").val(data.client.condiciones_credito).attr('disabled', false);
            $("#autorizacion_credito_req").val(result1);
            $("#notas").val(data.client.notas);
            $("#redistribucion_tallas").val(result2);
            $("#factura_desglosada_tallas").val(result3);
            $("#acepta_segundas").val(result4);
           
        });
    }

    function ver(id_client) {
        $.post("client/" + id_client, function(data, status) {
           
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
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
            $("#nombre_cliente").val(data.client.nombre_cliente).attr('readonly', true);
            $("#rnc").val(data.client.rnc).attr('readonly', true);
            $("#calle").val(data.client.calle).attr('readonly', true);
            $("#sector").val(data.client.sector).attr('readonly', true);
            $("#provincia").val(data.client.provincia).trigger("change").attr('disabled', true);
            $("#sitios_cercanos").val(data.client.sitios_cercanos).attr('readonly', true);
            $("#contacto_cliente_principal").val(data.client.contacto_cliente_principal).attr('readonly', true);
            $("#telefono_1").val(data.client.telefono_1).attr('readonly', true);
            $("#telefono_2").val(data.client.telefono_2).attr('readonly', true);
            $("#telefono_3").val(data.client.telefono_3).attr('readonly', true);
            $("#celular_principal").val(data.client.celular_principal).attr('readonly', true);
            $("#email_principal").val(data.client.email_principal).attr('readonly', true);
            $("#condiciones_credito").val(data.client.condiciones_credito).attr('disabled', true);
            $("#autorizacion_credito_req").val(result1).attr('readonly', true);
            $("#notas").val(data.client.notas).attr('readonly', true);
            $("#redistribucion_tallas").val(result2).attr('readonly', true);
            $("#factura_desglosada_tallas").val(result3).attr('readonly', true);
            $("#acepta_segundas").val(result4).attr('readonly', true);
           
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