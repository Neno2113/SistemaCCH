@extends('adminlte.layout')

@section('seccion', 'Usuarios')

@section('title', 'Empleados')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-4">
    <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-user-plus fa-lg"></i> Agregar</button>

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
                <h4>Formulario de registro de empleados:</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <div class="row ">
                        <div class="col-md-4">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="nombre">Nombre(*):</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="rnc">Apellido(*):</label>
                            <input type="text" name="apellido" id="apellido" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="rnc">Cedula(*):</label>
                            <input type="text" name="cedula" id="cedula" class="form-control text-center"
                                data-inputmask='"mask": "999-9999999-9"' data-mask>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="email_principal">Email (*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="email" name="email" id="email" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="telefono_1">Telefono:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono_1" name="telefono_1" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="telefono_2">Telefono 2:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono_2" name="telefono_2" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                    </div>

                    <br>
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

                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="condiciones_credito">Departamento(*):</label>
                            <select name="departamento" id="departamento" class="form-control">
                                <option value="Administracion">Administracion</option>
                                <option value="Venta">Venta</option>
                                <option value="Corte">Cortes</option>
                                <option value="Produccion">Produccion</option>
                                <option value="Artesania">Artesania</option>
                                <option value="Terminacion">Terminacion</option>
                                <option value="Almacen Producto Terminado">Almacen de producto terminado</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="cargo">Cargo(*):</label>
                            <select name="cargo" id="cargo" class="form-control">
                                <option value="Vendedor">Vendedor</option>

                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="contacto_cliente">Tipo de Contrato(*):</label>
                            <select name="tipo_contrato" id="tipo_contrato" class="form-control">
                                <option value="Temporero">Temporero</option>
                                <option value="Fijo">Fijo</option>
                            </select>
                        </div>
                    </div>


                    <div class="div" id="fila-bancaria">
                        <br>
                        <br>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="forma_pago">Forma de pago:</label>
                                <select name="forma_pago" id="forma_pago" class="form-control">
                                    <option value="Por Hora">Por Hora</option>
                                    <option value="Sueldo Fijo">Sueldo Fijo</option>
                                    <option value="Ajuste">Ajuste</option>
                                    <option value="Combinado">Combinado</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="sueldo">Sueldo:</label>
                                <input type="text" name="sueldo" id="sueldo" class="form-control text-center"
                                    placeholder="Mensualidad" data-inputmask='"mask": "99,999RD$"' data-mask>
                            </div>
                            <div class="col-md-4">
                                <label for="valor_hora">Valor de la Hora:</label>
                                <input type="text" name="valor_hora" id="valor_hora" class="form-control text-center"
                                    data-inputmask='"mask": "999999RD$"' data-mask>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label for="">Banco de cobro:</label>
                                <select name="banco_tarjeta_cobro" id="banco_tarjeta_cobro"
                                    class="form-control select2">
                                    <option value=""></option>
                                    <option value="">Banco Popular</option>
                                    <option value="">Banreservas</option>
                                    <option value="">Banco BHD Leon</option>
                                    <option value="">Scotiabank</option>
                                    <option value="">Banco Santa Cruz</option>
                                    <option value="">Banco Caribe</option>
                                    <option value="">Banco Ademi</option>
                                    <option value="">Banco Promerica</option>

                                </select>
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="">No. de cuenta</label>
                                <input type="text" name="no_cuenta" id="no_cuenta" class="form-control">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="">No. Seguridad Social</label>
                                <input type="text" name="nss" id="nss" class="form-control text-center"
                                    data-inputmask='"mask": "999999999"' data-mask>

                            </div>
                        </div>
                    </div>


                    <div class="row" id="fila-dependientes">
                        <br>
                        <br>
                        <hr>
                        <div class="col-md-4 mt-4">
                            <label for="autorizacion_credito_req">¿Tiene esposo/a?</label>
                            <div class="form-group clearfix">
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary1" name="r1" value="1">
                                    <label for="radioPrimary1">
                                        Si
                                    </label>
                                </div>
                                <div class="icheck-primary d-inline">
                                    <input type="radio" id="radioPrimary2" value="0" name="r1" checked>
                                    <label for="radioPrimary2">
                                        No
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse mt-5" id="collapseExample">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="">Nombre Esposo/a</label>
                                <input type="text" name="nombre_esposa" id="nombre_esposa" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="">Telefono Esposo/a</label>
                                <input type="text" name="telefono_esposa" id="telefono_esposa" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                            <div class="col-md-4">
                                <label for="autorizacion_credito_req">¿Esposa incluida en seguro?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary3" name="r2" value="1">
                                        <label for="radioPrimary3">
                                            Si
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary4" value="0" name="r2" checked>
                                        <label for="radioPrimary4">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 mt-2">
                                <label for="">Cantidad de hijos:</label>
                                <input type="text" name="cantidad_dependientes" id="cantidad_dependientes"
                                    class="form-control text-center" data-inputmask='"mask": "9"' data-mask>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <table class="table table-bordered">
                                <thead class="text-center">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Asegurado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    <tr>
                                        <td>
                                            <input type="text" name="nombre_dependiente_1" id="nombre_dependiente_1"
                                                class="form-control">
                                        </td>
                                        <td class="text-center">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" type="checkbox" id="customCheckbox1"
                                                    value="1">
                                                <label for="customCheckbox1" class="custom-control-label">Marcar
                                                    si esta asegurado</label>
                                            </div>
                                        </td>
                                    </tr>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


            </div>
            <div class="card-footer  text-muted ">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-2 float-right"><i
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
    <div class="card-header text-center">
        <h4>Listado de empleados</h4>
    </div>
    <div class="card-body">
        <table id="clients" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Ver</th>
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
                    <th>Ver</th>
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
<script src="{{asset('js/empleado.js')}}"></script>

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