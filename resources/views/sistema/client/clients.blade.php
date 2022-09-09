@extends('adminlte.layout')

@section('seccion', 'Clientes')

@section('title', 'Clientes')

@section('content')

<div class="row">
    <div class="col-7" id="registroForm">
        <div class="card " >
            <div class="card-header bg-dark p-1">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <h5>Registro Cliente</h5>
                    <hr>
                    <div class="Datos">
                        <div class="row mt-2">
                            <div class="col-md-4 mt-2">
                                <label for="nombre_cliente">Codigo Cliente</label>
                                <input type="text" name="codigo_cliente"
                                    id="codigo_cliente" class="form-control">

                            </div>
                            <input type="hidden" name="id" id="id" value="">
                            <div class="col-md-4 mt-2">
                                <label for="nombre_cliente">Nombre Comercial</label>
                                <input type="text" name="nombre_cliente" id="nombre_cliente" class="form-control">

                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="rnc" >RNC</label>
                                <input type="text" name="rnc" id="rnc"
                                    class="form-control text-center" data-inputmask='"mask": "999999999[9[9]]"'
                                    data-mask>

                            </div>



                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4 mt-2">
                                <label for="telefono_1" >Telefono</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono_1"  class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                               
                                </div>
                            </div>  
                            <div class="col-md-7 mt-2">
                                <label for="condiciones_credito" >Condiciones de credito</label>
                                <select name="condiciones_credito" id="condiciones_credito" class="form-control">
                                    <option value="" disabled>Condiciones de credito</option>
                                    <option value="0">Al contado</option>
                                    <option value="30">30 dias</option>
                                    <option value="60">60 dias</option>
                                    <option value="90">90 dias</option>
                                    <option value="120">120 dias</option>
                                </select>
                              
                            </div>                          
                            <!--
                            <div class="col-md-4 mt-2">
                                <label for="telefono_2" >Telefono 2</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono_2"  class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                               
                                </div>
                            </div>
                            -->
                      
                        </div>
                        <br>
                        <hr>
                        <div class="row mt-2">
                            <div class="col-md-4 mt-2">
                                <label for="contacto_cliente" >Nombre Contacto</label>
                                <input type="text" name="contacto_cliente_principal" 
                                    id="contacto_cliente_principal" class="form-control">
                               
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="celular_principal">Celular Contacto</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" id="celular_principal" 
                                        class="form-control " data-inputmask='"mask": "(999) 999-9999"' data-mask>

                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="email_principal" >Email Contacto</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                                <input type="email" name="email_principal" placeholder="Email de Contacto"
                                    id="email_principal" class="form-control">
                               
                                </div>
                            </div>
                        </div>
                        <br>
                        <hr>   
                        <div id="autorizaciones">
                            <div class="row" id="radios">
                                <!--
                                <div class="col-md-6">
                                    <label for="autorizacion_credito_req">¿Autorizacion de credito requerida?</label>
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="radioPrimary1" name="r1" value="1" >
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
                                    <input type="text" name="autorizacion_credito_req" id="autorizacion_credito_req"
                                        class="form-control" readonly>
                                </div>
                                -->
                                <div class="col-md-6">
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
                                <div class="col-md-6 mt-2">
                                    <label for="autorizacion_credito_req">¿Exige factura desglosada por tallas?(*):</label>
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
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label for="autorizacion_credito_req">¿Acepta Segundas?</label>
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
                            <hr>
                            <div class="row">
                                <div class="col-md-12 mt-2">
                                    <label for="">Nota</label>
                                    <textarea name="notas" id="notas"  cols="30" rows="1"
                                        class="form-control"></textarea>
                                    <label for="notas" ></label>
                                </div>
                            </div>
                        </div>  
                        <div class="row mt-2">

                        </div>
                     
                    </div>
            </div>

            <div class="card-footer  text-muted ">
                
                {{-- <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button> --}}
            </div>
        </div>

        </form>
    </div>
    <div class="col-5"  id="datosForm">
        <div class="card">
            <div class="card-header bg-dark p-1">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <h5>Dirección Cliente</h5>
                    <hr>
                    <div class="Datos">
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label for="" >Calle</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text"  name="calle" id="calle" class="form-control">
                              
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="" >Sector</label>
                                <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                                <input type="text" name="sector"  id="sector" class="form-control">
                         
                                </div>
                            </div>
                          
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="" >Provincia</label>
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
                               
                            </div>
                            <div class="col-md-6">
                                <label for="sitios_cercanos" >Referencia</label>
                                <input type="text" name="sitios_cercanos" 
                                    id="sitios_cercanos" class="form-control">
                               
                            </div>
                        </div>
                        {{-- <div class="row mt-4">
                        
                            <div class="col-md-12 mt-1">
                                <label for="" ></label>
                                <button type="button" class="btn btn-primary  mt-1" id="btn-distribucion"
                                data-toggle="modal" data-target=".bd-talla-modal-xl"><i class="fas fa-sort-alpha-down"></i> Distribucion Cliente</button>
                               
                            </div>
                        </div> --}}
                        <br>
                        <hr>
                    </div>
                    <br>

            </div>

            <div class="card-footer  text-muted ">
                {{-- <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button> 
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button> --}}
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>
        </div>

        </form>
    </div>
</div>
<div class="row">
    <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
    class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
    <div class="col-7" id="">
        <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
        class="far fa-save fa-lg"></i> Guardar</button>
    </div>
</div>

{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Cliente')->where('agregar', 1)->first() )
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                @endif
                <h4 class="text-white text-center">Listado de clientes</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Cliente')->where('ver', 1)->first())
        <table id="clients" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Nombre Comercial</th>
                    <th>RNC</th>
                    <th>Contacto</th>
                    <th>Email</th>
                    <th>Credito</th>
                    <th>Segundas</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>Nombre Comercial</th>
                    <th>RNC</th>
                    <th>Contacto</th>
                    <th>Email</th>
                    <th>Credito</th>
                    <th>Segundas</th>
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
                                >
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

<!-- Modal Tallas-->
<div class="modal fade bd-talla-modal-xl" tabindex="-1" role="dialog" id="test" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><strong>Distribucion del cliente</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            
                <h5 class="modal-h5">Asignar porcentaje de distribucion al cliente</h5>
                <hr>
                <div class="row mt-3">
                    <label for="" class="mt-1 label">Referencia</label>
                    <div class="col-md-3 mb-2">
                        <select name="tags[]" id="productos" class="form-control select2">
                            <option value="" disabled>Referencia producto</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <button type="button" id="btnAdd" class="btn btn-dark"
                        >Seleccionar</button>
                    </div>
                </div>
              
                <div class="row">
                    <table id="tabla-curva" class="table  table-bordered tabla-perdidas mt-4">
                        <thead >
                        
                            <tr id="rowHead">
                                <th>Productos</th>
                                <th id="ta">A</th>
                                <th id="tb">B</th>
                                <th id="tc">C</th>
                                <th id="td">D</th>
                                <th id="te">E</th>
                                <th id="tf">F</th>
                                <th id="tg">G</th>
                                <th id="th">H</th>
                                <th id="ti">I</th>
                                <th id="tj">J</th>
                                <th id="tk">K</th>
                                <th id="tl">L</th>
                                <th>Add</th>
                            </tr>
                        
                        </thead>
                        <tr>
                            <th>% Curva</th>
                            <td id="porc_a"></td>
                            <td id="porc_b"></td>
                            <td id="porc_c"></td>
                            <td id="porc_d"></td>
                            <td id="porc_e"></td>
                            <td id="porc_f"></td>
                            <td id="porc_g"></td>
                            <td id="porc_h"></td>
                            <td id="porc_i"></td>
                            <td id="porc_j"></td>
                            <td id="porc_k"></td>
                            <td id="porc_l"></td>
                            <td></td>
                        </tr>
                        <tbody >
                            <th id="refe"></th>
                            <td> 
                                <input type="text" name="" id="a" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td> 
                                <input type="text" name="" id="b" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td> 
                                <input type="text" name="" id="c" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td> 
                                <input type="text" name="" id="d" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td> 
                                <input type="text" name="" id="e" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td> 
                                <input type="text" name="" id="f" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td> 
                                <input type="text" name="" id="g" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td> 
                                <input type="text" name="" id="h" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td> 
                                <input type="text" name="" id="i" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td> 
                                <input type="text" name="" id="j" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td> 
                                <input type="text" name="" id="k" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td> 
                                <input type="text" name="" id="l" class="form-control text-center detalle no-shadow"
                                data-inputmask='"mask": "9[9][.99]"'  data-mask>
                            </td>
                            <td>
                                <button class="btn btn-success" id="bntAgregar"><i class="fas fa-plus"></i></button>
                            </td>
                        </tbody>
                        <tr id="tallas">

                        </tr>

                    </table>
                </div>
                <h5 class="modal-h5">Distribucion de productos del cliente</h5>
                <hr>
                <div class="row">
                    <table class="table  table-bordered tabla-perdidas mt-4">
                        <thead>
                            <tr >
                                <th>Productos</th>
                                <th id="ta">A</th>
                                <th id="tb">B</th>
                                <th id="tc">C</th>
                                <th id="td">D</th>
                                <th id="te">E</th>
                                <th id="tf">F</th>
                                <th id="tg">G</th>
                                <th id="th">H</th>
                                <th id="ti">I</th>
                                <th id="tj">J</th>
                                <th id="tk">K</th>
                                <th id="tl">L</th>
                                <th>Del</th>
                            </tr>
                        </thead>
                        <tbody id="fila">
                       
                        </tbody>
                    

                    </table>
                </div>
         
          
            
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-tallas-cerrar" class="btn btn-danger"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>




@include('adminlte/scripts')
{{-- <script src="{{asset('js/formulario.js')}}"></script> --}}
<script src="{{asset('js/cliente/client.js')}}"></script>
{{-- <script src="{{asset('js/client_branch.js')}}"></script> --}}




@endsection