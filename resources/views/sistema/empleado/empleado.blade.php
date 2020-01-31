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
                    <div class="row" id="fila-detail">
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
                            <label for="telefono_2">Celular:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono_2" name="telefono_2" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                    </div>

                    <div class="" id="fila-address">
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
                                    <option>ADMINISTRACION</option>
                                    <option>VENTA</option>
                                    <option>CORTE</option>
                                    <option>PRODUCCION</option>
                                    <option>ARTESANIA</option>
                                    <option>TERMINACION</option>
                                    <option>AlMACEN PRODUCTO TERMINADO</option>
                                </select>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="cargo">Cargo(*):</label>
                                <select name="cargo" id="cargo" class="form-control select2">
                                    <option>OPERARIO-1738 - OPERARIO</option>
                                    <option>OPERARIO-1738 - COCER</option>
                                    <option>OPERARIO-1738 - SUPERVISOR CALIDAD</option>
                                    <option>OPERARIO-1738 - ENCARGADO ARTESANIA</option>
                                    <option>OPERARIO-1738 - OPERARIO ARTESANIA</option>
                                    <option>OPERARIO-1738 - PLANCHADORA</option>
                                    <option>OPERARIO-1738 - ENCARGADO OPERACIONES</option>
                                    <option>OPERARIO-1738 - MECANICO</option>
                                    <option>OPERARIO-1738 - REVISORA CALIDAD</option>
                                    <option>OPERARIO-1738 - CORTE</option>
                                    <option>OPERARIO-1738 - AYUDANTE CORTE</option>
                                    <option>OPERARIO-1738 - MUETRISTA</option>
                                    <option>OPERARIO-1738 - ENCARGADO DE PONER ETIQUETAS</option>
                                    <option>OPERARIO-1738 - LIMPIEZA DE HILOS</option>
                                    <option>DISEÑADOR-4115 - DISEÑADOR</option>
                                    <option>DISEÑADOR-4115 - PATRONISTA</option>
                                    <option>VENDEDOR-219 - VENDEDORA</option>
                                    <option>VENDEDOR-219 - PROMOTORA</option>
                                    <option>CONTADOR-4374</option>
                                    <option>AUXILIAR CONTADOR-5103 - AUXILIAR</option>
                                    <option>CHOFER, AUTOMOVIL-4840</option>
                                    <option>SERENO-822</option>
                                    <option>DIRECTOR PRODUCCION Y OPERACIONES/RESTAURACION-4069 - AYUDANTE SUPERVISOR</option>
                                    <option>CONSERJE-4635</option>
                                    <option>VIGILANTE-327</option>
                                    <option>PRESIDENTE, EMPRESA-1343</option>
                                    <option>ALMACENISTA-5064 - PRODUCTOS TERMINADOS</option>
                                    <option>INGENIERO, SISTEMAS INFORMATICOS-3247</option>
                                    <option>GERENTE GENERAL, EMPRESA/INDUSTRIAS MANUFACTURERAS-3394</option>
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
                                    data-inputmask='"mask": "999RD$"' data-mask>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label for="">Banco de cobro:</label>
                                <select name="banco_tarjeta_cobro" id="banco_tarjeta_cobro"
                                    class="form-control select2">
                                    <option></option>
                                    <option>Banco Popular</option>
                                    <option>Banreservas</option>
                                    <option>Banco BHD Leon</option>
                                    <option>Scotiabank</option>
                                    <option>Banco Santa Cruz</option>
                                    <option>Banco Caribe</option>
                                    <option>Banco Ademi</option>
                                    <option>Banco Promerica</option>

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
                            <table class="table tabla-dependientes" >
                                <thead class="text-center dependientes-encabezado">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Asegurado</th>
                                    </tr>
                                </thead>
                                <tbody id="hijos" class="bg-white">
                                    
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
                <button type="submit" id="btn-guardar-detalle" class="btn btn-info mt-2 float-right"><i
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
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Cargo</th>
                    <th>Contrato</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Cargo</th>
                    <th>Contrato</th>
                    <th>Email</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>

@include('adminlte/scripts')
<script src="{{asset('js/empleado.js')}}"></script>

<script>
    function mostrar(id_empleado) {
        $.get("empleado/" + id_empleado, function(data, status) {
           
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#btn-guardar-detalle").hide();
            $("#fila-dependientes").show();
            $("#fila-bancaria").show();
            $("#fila-address").show();
            $("#fila-detail").show();

         
            $("#id").val(data.empleado.id);
            $("#nombre").val(data.empleado.nombre).attr('readonly', false);
            $("#apellido").val(data.empleado.apellido).attr('readonly', false);
            $("#cedula").val(data.empleado.cedula).attr('readonly', false);
            $("#calle").val(data.empleado.calle).attr('readonly', false);
            $("#sector").val(data.empleado.sector).attr('readonly', false);
            $("#provincia").val(data.empleado.provincia).trigger("change").attr('disabled', false);
            $("#sitios_cercanos").val(data.empleado.sitios_cercanos).attr('readonly', false);
            $("#email").val(data.empleado.email).attr('readonly', false);
            $("#telefono_1").val(data.empleado.telefono_1).attr('readonly', false);
            $("#telefono_2").val(data.empleado.telefono_2).attr('readonly', false);
            $("#departamento").val(data.empleado.departamento).trigger("change").attr('disabled', false);
            $("#cargo").val(data.empleado.cargo).trigger("change").attr('disabled', false);
            $("#tipo_contrato").val(data.empleado.tipo_contrato).attr('disabled', false);
            $("#forma_pago").val(data.empleado.forma_pago).attr('disabled', false);
            $("#sueldo").val(data.empleado.sueldo).attr('readonly', false);
            $("#valor_hora").val(data.empleado.valor_hora).attr('readonly', false);
            $("#banco_tarjeta_cobro").val(data.empleado.banco_tarjeta_cobro).trigger("change").attr('disabled', false);
            $("#no_cuenta").val(data.empleado.no_cuenta).attr('readonly', false);
            $("#nss").val(data.empleado_detalle.nss).attr('readonly', false);
            $("#nombre_esposa").val(data.empleado_detalle.nombre_esposa).attr('readonly', false);
            $("#telefono_esposa").val(data.empleado_detalle.telefono_esposa).attr('readonly', false);
            $("#cantidad_dependientes").val(data.empleado_detalle.cantidad_dependientes).attr('readonly', false);
            $("#nombre_dependiente_1").val(data.empleado_detalle.nombre_dependiente_1).attr('readonly', false);
            $("#hijos").empty();

            let longitud  = data.empleado_detalle.cantidad_dependientes;

            for (let i = 0; i < longitud; i++) {
            var fila =  "<tr >"+
            "<td><input type='text' name='nombre_dependiente_"+[i]+"' id='nombre_dependiente_"+[i]+"' class='form-control'></td>"+
            "<td class='text-center'><div class='custom-control custom-checkbox'>"+
            "<input class='custom-control-input' type='checkbox' id='hijo_"+[i]+"' value='1' name='hijo_"+[i]+"'>"+
            "<label for='hijo_"+[i]+"' class='custom-control-label font-weight-normal'>Marcar si esta asegurado</label></div>"+
            "</td>"+
            "</tr>";

            $("#hijos").append(fila);
            }
            $("#nombre_dependiente_0").val(data.empleado_detalle.nombre_dependiente_1).attr('readonly', false);
            $("#nombre_dependiente_1").val(data.empleado_detalle.nombre_dependiente_2).attr('readonly', false);
            $("#nombre_dependiente_2").val(data.empleado_detalle.nombre_dependiente_3).attr('readonly', false);
            $("#nombre_dependiente_3").val(data.empleado_detalle.nombre_dependiente_4).attr('readonly', false);
            $("#nombre_dependiente_4").val(data.empleado_detalle.nombre_dependiente_5).attr('readonly', false);
            $("#nombre_dependiente_5").val(data.empleado_detalle.nombre_dependiente_6).attr('readonly', false);
            $("#nombre_dependiente_6").val(data.empleado_detalle.nombre_dependiente_7).attr('readonly', false);

            if(data.empleado_detalle.dependiente_1_nss == 1){
                $("input[name='hijo_0']").prop('checked', true);
            }
            if(data.empleado_detalle.dependiente_2_nss == 1){
                $("input[name='hijo_1']").prop('checked', true);
            } 
            if(data.empleado_detalle.dependiente_3_nss == 1){
                $("input[name='hijo_2']").prop('checked', true);
            }
            if(data.empleado_detalle.dependiente_4_nss == 1){
                $("input[name='hijo_3']").prop('checked', true);
            } 
            if(data.empleado_detalle.dependiente_5_nss == 1){
                $("input[name='hijo_4']").prop('checked', true);
            }
            if(data.empleado_detalle.dependiente_6_nss == 1){
                $("input[name='hijo_5']").prop('checked', true);
            }
            if(data.empleado_detalle.dependiente_7_nss == 1){
                $("input[name='hijo_6']").prop('checked', true);
            } 

        });
    }

    function show(id_empleado) {
        $.get("empleado/" + id_empleado, function(data, status) {
           
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").hide();
            $("#btn-guardar").hide();
            $("#btn-guardar-detalle").show();
            $("#fila-dependientes").show();
            $("#fila-bancaria").show();
            $("#fila-address").hide();
            $("#fila-detail").hide();

            $("#id").val(data.empleado.id);
            $("#nombre").val(data.empleado.nombre).attr('readonly', true);
            $("#apellido").val(data.empleado.apellido).attr('readonly', true);
            $("#cedula").val(data.empleado.cedula).attr('readonly', true);
           
        });
    }


    function ver(id_empleado) {
        $.get("empleado/" + id_empleado, function(data, status) {
           
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#btn-edit").hide();
            $("#btn-guardar").hide();
            $("#btn-guardar-detalle").hide();
            $("#fila-dependientes").show();
            $("#fila-bancaria").show();
            $("#fila-address").show();
            $("#fila-detail").show();

         
            $("#nombre").val(data.empleado.nombre).attr('readonly', true);
            $("#apellido").val(data.empleado.apellido).attr('readonly', true);
            $("#cedula").val(data.empleado.cedula).attr('readonly', true);
            $("#calle").val(data.empleado.calle).attr('readonly', true);
            $("#sector").val(data.empleado.sector).attr('readonly', true);
            $("#provincia").val(data.empleado.provincia).trigger("change").attr('disabled', true);
            $("#sitios_cercanos").val(data.empleado.sitios_cercanos).attr('readonly', true);
            $("#email").val(data.empleado.email).attr('readonly', true);
            $("#telefono_1").val(data.empleado.telefono_1).attr('readonly', true);
            $("#telefono_2").val(data.empleado.telefono_2).attr('readonly', true);
            $("#departamento").val(data.empleado.departamento).trigger("change").attr('disabled', true);;
            $("#cargo").val(data.empleado.cargo).trigger("change").attr('disabled', false);
            $("#tipo_contrato").val(data.empleado.tipo_contrato).attr('disabled', true);
            $("#forma_pago").val(data.empleado.forma_pago).attr('disabled', true);
            $("#sueldo").val(data.empleado.sueldo).attr('readonly', true);
            $("#valor_hora").val(data.empleado.valor_hora).attr('readonly', true);
            $("#banco_tarjeta_cobro").val(data.empleado.banco_tarjeta_cobro).trigger("change").attr('disabled', true);
            $("#no_cuenta").val(data.empleado.no_cuenta).attr('readonly', true);
            $("#nss").val(data.empleado_detalle.nss).attr('readonly', true);
            $("#nombre_esposa").val(data.empleado_detalle.nombre_esposa).attr('readonly', true);
            $("#telefono_esposa").val(data.empleado_detalle.telefono_esposa).attr('readonly', true);
            $("#cantidad_dependientes").val(data.empleado_detalle.cantidad_dependientes).attr('readonly', true);
            $("#hijos").empty();
           
            let longitud  = data.empleado_detalle.cantidad_dependientes;

            for (let i = 0; i < longitud; i++) {
                var fila =  "<tr >"+
                "<td><input type='text' name='nombre_dependiente_"+[i]+"' id='nombre_dependiente_"+[i]+"' class='form-control'></td>"+
                "<td class='text-center'><div class='custom-control custom-checkbox'>"+
                "<input class='custom-control-input' type='checkbox' id='hijo_"+[i]+"' value='1' name='hijo_"+[i]+"'>"+
                "<label for='hijo_"+[i]+"' class='custom-control-label font-weight-normal'>Marcar si esta asegurado</label></div>"+
                "</td>"+
                "</tr>";

                $("#hijos").append(fila);
            }
            $("#nombre_dependiente_0").val(data.empleado_detalle.nombre_dependiente_1).attr('readonly', true);
            $("#nombre_dependiente_1").val(data.empleado_detalle.nombre_dependiente_2).attr('readonly', true);
            $("#nombre_dependiente_2").val(data.empleado_detalle.nombre_dependiente_3).attr('readonly', true);
            $("#nombre_dependiente_3").val(data.empleado_detalle.nombre_dependiente_4).attr('readonly', true);
            $("#nombre_dependiente_4").val(data.empleado_detalle.nombre_dependiente_5).attr('readonly', true);
            $("#nombre_dependiente_5").val(data.empleado_detalle.nombre_dependiente_6).attr('readonly', true);
            $("#nombre_dependiente_6").val(data.empleado_detalle.nombre_dependiente_7).attr('readonly', true);

          
            if(data.empleado_detalle.dependiente_1_nss == 1){
                $("input[name='hijo_0']").prop('checked', true);
            }
            if(data.empleado_detalle.dependiente_2_nss == 1){
                $("input[name='hijo_1']").prop('checked', true);
            } 
            if(data.empleado_detalle.dependiente_3_nss == 1){
                $("input[name='hijo_2']").prop('checked', true);
            }
            if(data.empleado_detalle.dependiente_4_nss == 1){
                $("input[name='hijo_3']").prop('checked', true);
            } 
            if(data.empleado_detalle.dependiente_5_nss == 1){
                $("input[name='hijo_4']").prop('checked', true);
            }
            if(data.empleado_detalle.dependiente_6_nss == 1){
                $("input[name='hijo_5']").prop('checked', true);
            }
            if(data.empleado_detalle.dependiente_7_nss == 1){
                $("input[name='hijo_6']").prop('checked', true);
            }      
           
           
        });
    }

    function eliminar(id_client){
        bootbox.confirm("¿Estas seguro de eliminar este empleado?", function(result){
            if(result){
                $.post("empleado/delete/" + id_client, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Empleado eliminado correctamente!!");
                    $("#clients").DataTable().ajax.reload();
                })
            }
        })
    }

   



</script>



@endsection