@extends('adminlte.layout')

@section('seccion', 'Usuarios')

@section('title', 'Empleados')

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
                    <h5>Formulario de registro de empleados</h5>
                    <hr>
                    <div class="row ">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="col-md-4">


                            <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control">
                            <label for="nombre" class="label"></label>
                        </div>
                        <div class="col-md-4">

                            <input type="text" name="apellido" id="apellido" placeholder="Apellido"
                                class="form-control">
                            <label for="rnc" class="label"></label>
                        </div>
                        <div class="col-md-4">

                            <input type="text" name="cedula" id="cedula" placeholder="RNC"
                                class="form-control text-center" data-inputmask='"mask": "999-9999999-9"' data-mask>
                            <label for="rnc" class="label"></label>
                        </div>


                    </div>
                    <div class="row" id="fila-detail">
                        <div class="col-md-4 mt-3">

                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div> --}}
                            <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                            <label for="email_principal" class="label"></label>
                            {{-- </div> --}}
                        </div>
                        <div class="col-md-4 mt-3">

                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                            <input type="text" id="telefono_1" placeholder="Telefono" name="telefono_1"
                                class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            <label for="telefono_1" class="label"></label>
                            {{-- </div> --}}
                        </div>
                        <div class="col-md-4 mt-3">

                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                            <input type="text" id="telefono_2" placeholder="Celular" name="telefono_2"
                                class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            <label for="telefono_2" class="label"></label>
                            {{-- </div> --}}
                        </div>
                    </div>

                    <div class="" id="fila-address">
                        <br>
                        <br>
                        <hr>

                        <div class="row mt-3">
                            <div class="col-md-4">

                                {{-- <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                    </div> --}}
                                <input type="text" name="calle" placeholder="Calle" id="calle" class="form-control">
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

                                <input type="text" name="sitios_cercanos" id="sitios_cercanos"
                                    placeholder="Referencias cercanas" class="form-control">
                                <label for="" class="label"></label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mt-3">

                                <select name="departamento" id="departamento" class="form-control">
                                    <option value="" disabled>Departamento</option>
                                    <option>ADMINISTRACION</option>
                                    <option>VENTA</option>
                                    <option>CORTE</option>
                                    <option>PRODUCCION</option>
                                    <option>ARTESANIA</option>
                                    <option>TERMINACION</option>
                                    <option>AlMACEN PRODUCTO TERMINADO</option>
                                </select>
                                <label for="condiciones_credito" class="label"></label>
                            </div>
                            <div class="col-md-4 mt-3">

                                <select name="cargo" id="cargo" class="form-control select2">
                                    <option value="" disabled>Cargo</option>
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
                                    <option>DIRECTOR PRODUCCION Y OPERACIONES/RESTAURACION-4069 - AYUDANTE SUPERVISOR
                                    </option>
                                    <option>CONSERJE-4635</option>
                                    <option>VIGILANTE-327</option>
                                    <option>PRESIDENTE, EMPRESA-1343</option>
                                    <option>ALMACENISTA-5064 - PRODUCTOS TERMINADOS</option>
                                    <option>INGENIERO, SISTEMAS INFORMATICOS-3247</option>
                                    <option>GERENTE GENERAL, EMPRESA/INDUSTRIAS MANUFACTURERAS-3394</option>
                                </select>
                                <label for="cargo" class="label"></label>
                            </div>
                            <div class="col-md-4 mt-3">

                                <select name="tipo_contrato" id="tipo_contrato" class="form-control">
                                    <option value="" disabled>Tipo de contrato</option>
                                    <option value="Temporero">Temporero</option>
                                    <option value="Fijo">Fijo</option>
                                </select>
                                <label for="contacto_cliente" class="label"></label>
                            </div>
                        </div>
                    </div>
                    <div class="div" id="fila-bancaria">
                        <br>
                        <br>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">

                                <select name="forma_pago" id="forma_pago" class="form-control">
                                    <option value="" disabled>Forma de pago</option>
                                    <option value="Por Hora">Por Hora</option>
                                    <option value="Sueldo Fijo">Sueldo Fijo</option>
                                    <option value="Ajuste">Ajuste</option>
                                    <option value="Combinado">Combinado</option>
                                </select>
                                <label for="forma_pago" class="label"></label>
                            </div>
                            <div class="col-md-4">

                                <input type="text" name="sueldo" placeholder="Sueldo" id="sueldo"
                                    class="form-control text-center" data-inputmask='"mask": "RD$ 999[99]"' data-mask>
                                <label for="sueldo" class="label"></label>
                            </div>
                            <div class="col-md-4">

                                <input type="text" name="valor_hora" placeholder="Valor hora" id="valor_hora"
                                    class="form-control text-center" data-inputmask='"mask": "RD$ 999[9]"' data-mask>
                                <label for="valor_hora" class="label"></label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3">

                                <select name="banco_tarjeta_cobro" id="banco_tarjeta_cobro"
                                    class="form-control select2">
                                    <option disabled>Banco tarjeta cobro</option>
                                    <option>Banco Popular</option>
                                    <option>Banreservas</option>
                                    <option>Banco BHD Leon</option>
                                    <option>Scotiabank</option>
                                    <option>Banco Santa Cruz</option>
                                    <option>Banco Caribe</option>
                                    <option>Banco Ademi</option>
                                    <option>Banco Promerica</option>

                                </select>
                                <label for="" class="label"></label>
                            </div>

                            <div class="col-md-4 mt-3">

                                <input type="text" name="no_cuenta" placeholder="No. de cuenta" id="no_cuenta"
                                    class="form-control">
                                <label for="" class="label"></label>
                            </div>
                            <div class="col-md-4 mt-3">

                                <input type="text" name="nss" placeholder="No. seguridad social" id="nss"
                                    class="form-control text-center" data-inputmask='"mask": "999999999[99]"' data-mask>
                                <label for="" class="label"></label>
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

                                <input type="text" name="nombre_esposa" placeholder="Nombre Esposo/a" id="nombre_esposa"
                                    class="form-control">
                                <label for="" class="label"></label>
                            </div>
                            <div class="col-md-4">

                                <input type="text" name="telefono_esposa" placeholder="Telefono esposo/a"
                                    id="telefono_esposa" class="form-control" data-inputmask='"mask": "(999) 999-9999"'
                                    data-mask>
                                <label for="" class="label"></label>
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

                                <input type="text" name="cantidad_dependientes" id="cantidad_dependientes"
                                    class="form-control text-center" placeholder="Cantidad de hijos"
                                    data-inputmask='"mask": "9"' data-mask>
                                <label for="" class="label"></label>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <table class="table tabla-dependientes">
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
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="far fa-id-card"></i> Agregar</button>
                <h4 class="text-white text-center">Listado de empleados</h4>
            </div>
        </div>

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
<script src="{{asset('js/formulario.js')}}"></script>
<script src="{{asset('js/users/empleado.js')}}"></script>



@endsection
