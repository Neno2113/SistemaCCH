@extends('adminlte.layout')

@section('seccion', 'Ordenes de pedido')

@section('title', 'Orden de Pedido')

@section('content')

<div class="row" id="creacion-orden">
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
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de orden de pedido</h5>
                    <hr>
                    <div class="row">
                        <div class="col-lg-10 col-md-8"></div>
                        <div class="col-lg-2  col-md-4">
                            <label for="" class="d-flex justify-content-center pers">Orden de pedido</label>
                            <input type="text" name="no_orden_pedido" id="no_orden_pedido"
                                class="form-control font-weight-bold text-center" readonly>
                            <input type="hidden" name="orden_pedido_id" id="orden_pedido_id">
                            <input type="hidden" name="orden_pedido_id_proceso" id="orden_pedido_id_proceso">
                            <input type="hidden" name="sec" id="sec" value="">
                            <input type="hidden" name="cliente_segundas" id="cliente_segundas" value="">
                            <input type="hidden" name="venta_segunda" id="venta_segunda" value="">
                            <input type="hidden" name="sec_proceso" id="sec_proceso" value="">
                            <input type="hidden" name="no_orden_pedido_proceso" id="no_orden_pedido_proceso">
                        </div>
                    </div>
                    <div id="orden_create">
                        <div class="row mt-3">
                            <div class="col-md-6" id="clienteBuscar">
                                <label for="">Cliente</label>

                                <select name="tags[]" id="clienteSearch" class="form-control select2">
                                </select>

                            </div>
                            <div class="col-md-6" id="cliente">
                                <label for="">Cliente(*):</label>
                                <input type="text" name="client" id="client"
                                    class="form-control font-weight-bold text-center mt-2" readonly>
                            </div>
                            <div class="col-md-6" id="sucursalBuscar">
                                <label for="">Sucursal</label>
                                <select name="tags[]" id="sucursalSearch" class="form-control select2">
                                    <option value='Principal' >Principal</option>
                                    
                                </select>
                            </div>
                            <div class="col-md-6" id="sucursal">
                                <label for="">Sucursal(*):</label>
                                <input type="text" name="sucur" id="sucur"
                                    class="form-control font-weight-bold text-center mt-2" readonly>
                            </div>
                        </div>
                        <br>
                        <div class="row mt-3">
                            <div class="col-md-4 mt-2">
                                <label for="">Vendedor</label>

                                <select name="tags[]" id="vendedores" class="form-control select2 mt-2" style="width:90%;">
                                    <option value=""></option>
                                </select>

                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="pers">Fecha de entrega</label>
                                {{-- <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                    </div> --}}
                                    <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control">
                                    <input type="hidden" name="" id="fecha_proceso" value="">
                                {{-- </div> --}}
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="autorizacion_credito_req">¿Generado internamente?(*):</label>
                                <div class="form-group clearfix" id="genInt">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="r1" value="1">
                                        <label for="radioPrimary1">
                                            Si
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" name="r1" value="0" checked>
                                        <label for="radioPrimary2">
                                            No
                                        </label>
                                    </div>
                                </div>
                                <input type="text" name="generado_internamente" id="generado_internamente"
                                    class="form-control  text-center font-weight-bold" readonly>
                            </div>

                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <label for="">Notas</label>
                                <textarea name="notas" id="notas" placeholder="Notas" cols="30" rows="1" class="form-control"></textarea>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-2 mt-4 pt-2 float-right">
                                <button class="btn btn-secondary btn-block rounded-pill mt-3" id="btn-generar"><i
                                        class="fas fa-truck-loading"></i> Generar</button>
                            </div>

                        </div>
                        <br>
                        <hr>
                    </div>
                    <br>
                    <!--PRUBEA CRISTOBAL -->
                    <!--PRUBEA CRISTOBAL -->
                    <!--PRUBEA CRISTOBAL -->
                    <!--
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Producto</label>
                            <select name="productos" id="productos" class="form-control text-center">

                            </select>
                        </div>
                        <div class="col-md-4 mt-2">
                            <button class="btn btn-outline-dark mt-4 rounded-pill" id="btn-seleccionar"><i class="fas fa-hand-pointer"></i> Seleccionar</button>
                        </div>
                        <div class="col-md-4 mt-2">
                            <button type="button" class="btn btn-dark  btn-block mt-4" data-toggle="modal"
                            data-target=".bd-sku-modal-xl" id="btn-sku"><i class="fas fa-barcode"></i> Ver Pedido</button>
                        </div>
                    </div>
                    <div class="">
                        <table id="detalle" class="table  mt-2 mb-3 mr-5 tabla-tallas text-sm" style="width:102%;">
                            <thead class="tabla-tallas">
                                <tr>
                                    <th class="talla_head">PLUS</th>
                                    <td class="talla">12W</td>
                                    <td class="talla">14W</td>
                                    <td class="talla">16W</td>
                                    <td class="talla">18W</td>
                                    <td class="talla">20W</td>
                                    <td class="talla">22W</td>
                                    <td class="talla">24W</td>
                                    <td class="talla">26W</td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                </tr>
                                <tr>
                                    <th class="talla_head">MUJER</th>
                                    <td class="talla">0/0 </td>
                                    <td class="talla">1/2 </td>
                                    <td class="talla">3/4 </td>
                                    <td class="talla">5/6 </td>
                                    <td class="talla">7/8 </td>
                                    <td class="talla">9/10 </td>
                                    <td class="talla">11/12</td>
                                    <td class="talla">13/14</td>
                                    <td class="talla">15/16</td>
                                    <td class="talla">17/18</td>
                                    <td class="talla">19/20</td>
                                    <td class="talla">21/22</td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                </tr>
                                <tr>
                                    <th class="talla_head">HOMBRE</th>
                                    <td class="talla">28</td>
                                    <td class="talla">29</td>
                                    <td class="talla">30</td>
                                    <td class="talla">32</td>
                                    <td class="talla">34</td>
                                    <td class="talla">36</td>
                                    <td class="talla">38</td>
                                    <td class="talla">40</td>
                                    <td class="talla">42</td>
                                    <td class="talla">44</td>
                                    <td class="talla">46</td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                </tr>
                                <tr>
                                    <th class="talla_head">NIÑO</th>
                                    <td class="talla">2</td>
                                    <td class="talla">4</td>
                                    <td class="talla">6</td>
                                    <td class="talla">8</td>
                                    <td class="talla">10</td>
                                    <td class="talla">12</td>
                                    <td class="talla">14</td>
                                    <td class="talla">16</td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                </tr>
                                <tr>
                                    <th class="talla_head">NIÑA</th>
                                    <td class="talla">2</td>
                                    <td class="talla">4</td>
                                    <td class="talla">6</td>
                                    <td class="talla">8</td>
                                    <td class="talla">10</td>
                                    <td class="talla">12</td>
                                    <td class="talla">14</td>
                                    <td class="talla">16</td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                    <td class="talla"></td>
                                </tr>
                                <tr>
                                    <th class="talla_head">Ref</th>
                                    <th class="talla_head text-success " id="a_alm"></th>
                                    <th class="talla_head text-success " id="b_alm"></th>
                                    <th class="talla_head text-success " id="c_alm"></th>
                                    <th class="talla_head text-success " id="d_alm"></th>
                                    <th class="talla_head text-success " id="e_alm"></th>
                                    <th class="talla_head text-success " id="f_alm"></th>
                                    <th class="talla_head text-success " id="g_alm"></th>
                                    <th class="talla_head text-success " id="h_alm"></th>
                                    <th class="talla_head text-success " id="i_alm"></th>
                                    <th class="talla_head text-success " id="j_alm"></th>
                                    <th class="talla_head text-success " id="k_alm"></th>
                                    <th class="talla_head text-success " id="l_alm"></th>
                                    <th class="talla_head">Total</th>
                                    <th class="talla_head">Cant</th>
                                    <th class="talla_head">Red</th>
                                    <th class="talla_head">Man</th>
                                </tr>

                            </thead>
                            <tbody id="disponibles" class="text-sm">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="talla_head">Ref</th>
                                    <th class="talla_head">A</th>
                                    <th class="talla_head">B</th>
                                    <th class="talla_head">C</th>
                                    <th class="talla_head">D</th>
                                    <th class="talla_head">E</th>
                                    <th class="talla_head">F</th>
                                    <th class="talla_head">G</th>
                                    <th class="talla_head">H</th>
                                    <th class="talla_head">I</th>
                                    <th class="talla_head">J</th>
                                    <th class="talla_head">K</th>
                                    <th class="talla_head">L</th>
                                    <th class="talla_head">Total</th>
                                    <th class="talla_head">Cant</th>
                                    <th class="talla_head">Red</th>
                                    <th class="talla_head">Man</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    -->
                    <!--FIN PRUBEA CRISTOBAL -->
                    <!--FIN PRUBEA CRISTOBAL -->
                    <!--FIN PRUBEA CRISTOBAL -->


                    <div  id="orden_detalle">
                        <div class="row">

                            <div class="col-lg-6">
                                <div class="row" id="producto">
                                    <div class="col-md-6 " id="productoBuscar">
                                        <label for="">Referencia Producto</label>
                                        <select name="tags[]" id="productoSearch" class="form-control select2"
                                            style="width:100%">
                                            <option value=""></option>
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-3 " id="producto">
                                    <label for="">Referencia Producto</label>
                                    <input type="text" name="referencia_producto" id="referencia_producto"
                                        class="form-control font-weight-bold text-center" readonly>
                                     </div> --}}
                                    <div class="col-md-5 mt-2 border-right">
                                        <label for="">¿Detallado?</label>
                                        <div class="form-group clearfix">
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary5" name="r2" value="1">
                                                <label for="radioPrimary5">
                                                    Si
                                                </label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" id="radioPrimary6" name="r2" value="0" checked>
                                                <label for="radioPrimary6">
                                                    No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="card card-primary">
                                        <div class="card-header">
                                        <h3 class="card-title">About Me</h3>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="card-body">
                                        <strong><i class="fas fa-book mr-1"></i> Education</strong>
                        
                                        <p class="text-muted">
                                            B.S. in Computer Science from the University of Tennessee at Knoxville
                                        </p>
                        
                                        <hr>
                        
                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>
                        
                                        <p class="text-muted">Malibu, California</p>
                        
                                        <hr>
                        
                                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>
                        
                                        <p class="text-muted">
                                            <span class="tag tag-danger">UI Design</span>
                                            <span class="tag tag-success">Coding</span>
                                            <span class="tag tag-info">Javascript</span>
                                            <span class="tag tag-warning">PHP</span>
                                            <span class="tag tag-primary">Node.js</span>
                                        </p>
                        
                                        <hr>
                        
                                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>
                        
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                                        </div> --}}
                                        <!-- /.card-body -->
                                    {{-- </div> --}}
                                    {{-- <div class="col-lg-6 col-md-3">
                                   <!-- About Me Box -->
                                     
                                    </div> --}}
        
                                </div>
                                
                                <div class="row">
                                    <div class="col-lg-4 col-md-4" id="redistribucion">
                                        <label for="">Cantidad:</label>
                                        <input type="text" name="cantidad" id="cantidad" class="form-control text-center"
                                            data-inputmask='"mask": "9[9[9]]"' data-mask>
                                    </div>
                                    <div class="col-lg-5 col-md-4 mt-4">
                                        <button class="btn btn-success rounded-pill mt-2" name="btn-consultar"
                                            id="btn-consultar"><i class="fas fa-search"></i> Consultar</button>
                                    </div>
                                    <div class="col-md-2 ">
    
                                    </div>
                                </div>
                                
                            <div class="row " id="tallas">
                                <div class="col-lg-4 col-md-4 mt-3 " id="precio_div">
                                    <label for="">Precio:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="text" name="precio" id="precio" class="form-control text-center"
                                            data-inputmask='"mask": "RD$ 999[9]"' data-mask>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 mt-3" id="total_div">
                                    <label for="">Disponible Venta</label>
                                    <input type="text" name="total" id="total" class="form-control text-center" readonly>
                                </div>
                                <div class="col-lg-3 col-md-4 mt-3" id="total_almdiv">
                                    <label for="">Total Almacen</label>
                                    <input type="text" name="total" id="total_alm" class="form-control text-center" readonly>
                                </div>
                                <div class="col-md-4 mr-3">

                                </div>

                            </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                  <!-- About Me Box -->
                                  <div class="col-lg-12 col-md-12  .d-sm-block">
                                      <div class="card card-primary">
                                          <div class="card-header">
                                          <h3 class="card-title">Pedido</h3>
                                          </div>
                                          <!-- /.card-header -->
                                          <div class="card-body">
                                          <strong><i class="fas fa-shipping-fast"></i> Cliente</strong>
                          
                                          <p class="text-muted" id="cliente_select">
                                             
                                          </p>
                                          <hr>
                                          <strong><i class="fas fa-box-open"></i> Venta Actual</strong>
                                          <p class="text-muted" id="venta_actual"></p>
                          
                                          </div>
                                          <!-- /.card-body -->
                                      </div>

                                  </div>
                                            
                                </div>
                            </div>
                        </div>
                   
                        {{-- <div class="container collapse mt-4" id="listarOrden">
                            <div class="table-responsive">
                                <table id="orden" class="table table-striped table-bordered datatables"
                                    style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Referencia</th>
                                            <th>A</th>
                                            <th>B</th>
                                            <th>C</th>
                                            <th>D</th>
                                            <th>E</th>
                                            <th>F</th>
                                            <th>G</th>
                                            <th>H</th>
                                            <th>I</th>
                                            <th>J</th>
                                            <th>K</th>
                                            <th>L</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Referencia</th>
                                            <th>A</th>
                                            <th>B</th>
                                            <th>C</th>
                                            <th>D</th>
                                            <th>E</th>
                                            <th>F</th>
                                            <th>G</th>
                                            <th>H</th>
                                            <th>I</th>
                                            <th>J</th>
                                            <th>K</th>
                                            <th>L</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                        </div> --}}


                        <hr>
                        <div class="" id="detallada">
                            <h5 >Disponible</h5>
                            <div class="table-responsive">
                                <table id="tabla_detalle" class="table table-bordered tabla-detallada  mb-3 text-sm">
                                    <thead class="">
                                        <tr>
                                            <th class="talla" id="ta">A</th>
                                            <th class="talla" id="tb">B</th>
                                            <th class="talla" id="tc">C</th>
                                            <th class="talla" id="td">D</th>
                                            <th class="talla" id="te">E</th>
                                            <th class="talla" id="tf">F</th>
                                            <th class="talla" id="tg">G</th>
                                            <th class="talla" id="th">H</th>
                                            <th class="talla" id="ti">I</th>
                                            <th class="talla" id="tj">J</th>
                                            <th class="talla" id="tk">K</th>
                                            <th class="talla" id="tl">L</th>
                                            <th class="talla" style="font-size: 20px">Total</th>
                                        </tr>


                                    </thead>
                                    <tbody id="disponibles" class="text-align-center">

                                    </tbody>
                                    <tfoot>
                                        <tr class="bg-white">
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-a"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-b"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-c"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-d"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-e"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-f"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-g"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-h"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-i"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-j"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-k"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-dark btn-sm" id="up-l"><i
                                                        class="fas fa-plus"></i></button>
                                            </th>
                                            <th></th>
                                        </tr>
                                        <tr>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="da">A</label> --}}
                                                <input type="text" name="" id="a"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="db">B</label> --}}
                                                <input type="text" name="" id="b"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="dc">C</label> --}}
                                                <input type="text" name="" id="c"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="dd">D</label> --}}
                                                <input type="text" name="" id="d"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="de">E</label> --}}
                                                <input type="text" name="" id="e"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="df">F</label> --}}
                                                <input type="text" name="" id="f"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="dg">G</label> --}}
                                                <input type="text" name="" id="g"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="dh">H</label> --}}
                                                <input type="text" name="" id="h"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="di">I</label> --}}
                                                <input type="text" name="" id="i"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="dj">J</label> --}}
                                                <input type="text" name="" id="j"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="dk">K</label> --}}
                                                <input type="text" name="" id="k"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th>

                                                {{-- <label for="" class="ml-4" id="dl">L</label> --}}
                                                <input type="text" name="" id="l"
                                                    class="form-control text-center detalle" autocomplete="off"
                                                    data-inputmask='"mask": "9[9[9]]"' data-mask>

                                            </th>
                                            <th id="total_detalle" class="text-danger" style="font-size: 20px">

                                            </th>
                                        </tr>
                                        <tr>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-a"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-b"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-c"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-d"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-e"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-f"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-g"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-h"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-i"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-j"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-k"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th>
                                                <button class="btn btn-danger btn-sm" id="down-l"><i
                                                        class="fas fa-minus"></i></button>
                                            </th>
                                            <th></th>
                                        </tr>

                                    </tfoot>

                                </table>
                            </div>

                            <div class="row" id="detalles" style="width: 98%; margin-left:-14px;">

                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-md-4">
                                <button class="d-inline p-2 btn btn-primary rounded-lg" name="btn-agregar"
                                    id="btn-agregar">
                                    <i class="fas fa-cart-plus"></i> Agregar</button>
                                <button class="d-inline p-2 btn btn-secondary rounded-lg" name="btn-copia"
                                    id="btn-copia">
                                    <i class="fas fa-copy"></i> Copiar redistribucion</button>
                            </div>

                        </div>
                        <br>
                        <hr>

                        <div class="row" id="agregadas">
                            <h5 >Detalle pedido</h5>
                            <div class="col-md-12 pt-3 pl-3 pb-3 table-responsive">
                                <table class="table  table-bordered  tabla-detallada mt-3 ">
                                    <thead class="">
                                        <tr>
                                            <th >MUJER PLUS</th>
                                            <td ></td>
                                            <td ></td>
                                            <th>12W</th>
                                            <th>14W</th>
                                            <th>16W</th>
                                            <th>18W</th>
                                            <th>20W</th>
                                            <th>22W</th>
                                            <th>24W</th>
                                            <th>26W</th>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                        </tr>
                                        <tr>
                                            <th >MUJER</th>
                                            <td ></td>
                                            <td ></td>
                                            <th>0/0</th>
                                            <th>1/2</th>
                                            <th>3/4</th>
                                            <th>5/6</th>
                                            <th>7/8</th>
                                            <th>9/10</th>
                                            <th>11/12</th>
                                            <th>13/14</th>
                                            <th>15/16</th>
                                            <th>17/18</th>
                                            <th>19/20</th>
                                            <th>21/22</th>
                                            <td ></td>
                                        </tr>
                                        <tr>
                                            <th >HOMBRE</th>
                                            <td ></td>
                                            <td ></td>
                                            <th>28</th>
                                            <th>29</th>
                                            <th>30</th>
                                            <th>32</th>
                                            <th>34</th>
                                            <th>36</th>
                                            <th>38</th>
                                            <th>40</th>
                                            <th>42</th>
                                            <th>44</th>
                                            <th>46</th>
                                            <td ></td>
                                            <td ></td>
                                        </tr>
                                        <tr>
                                            <th >NIÑO</th>
                                            <td ></td>
                                            <td ></td>
                                            <th>2</th>
                                            <th>4</th>
                                            <th>6</th>
                                            <th>8</th>
                                            <th>10</th>
                                            <th>12</th>
                                            <th>14</th>
                                            <th>16</th>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                        </tr>
                                        <tr>
                                            <th >NIÑA</th>
                                            <td ></td>
                                            <td ></td>
                                            <th>2</th>
                                            <th>4</th>
                                            <th>6</th>
                                            <th>8</th>
                                            <th>10</th>
                                            <th>12</th>
                                            <th>14</th>
                                            <th>16</th>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
                                            <td ></td>
        
                                        </tr>
                                        <tr>
                                            <th >Referencia</th>
                                            <th >Precio</th>
                                            <th >Cantidad</th>
                                            <th ></th>
                                            <th ></th>
                                            <th ></th>
                                            <th ></th>
                                            <th ></th>
                                            <th ></th>
                                            <th ></th>
                                            <th ></th>
                                            <th ></th>
                                            <th ></th>
                                            <th ></th>
                                            <th ></th>
                                            <th >Actions</th>
                                        </tr>
                                        {{-- <tr>

                                            <th>Referencias</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>A</th>
                                            <th>B</th>
                                            <th>C</th>
                                            <th>D</th>
                                            <th>E</th>
                                            <th>F</th>
                                            <th>G</th>
                                            <th>H</th>
                                            <th>I</th>
                                            <th>J</th>
                                            <th>K</th>
                                            <th>L</th>
                                            <th>Actions</th>
                                        </tr> --}}
                                    </thead>
                                    <tbody id="orden_pedido">

                                    </tbody>
                                    <tfoot class="light">

                                        <th>Referencias</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tfoot>
                                </table>

                            </div>
                        </div>
                    </div>

            </div>
            <div class="card-footer text-muted">
                <button class="btn btn-danger float-left" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left"></i>
                    Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-primary float-right"><i
                        class="far fa-save"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning float-right"><i
                        class="far fa-edit"></i> Editar</button>
            </div>

            </form>
        </div>
    </div>
</div>

<!-- Modal Sustitutos-->
<div class="modal fade bd-talla-modal-xl" tabindex="-1" role="dialog" id="ModalSustituto"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><strong>Sustitutos en base a
                        atributos</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered tabla-detallada text-sm">
                    <thead class="">
                        <tr>
                            <th class="talla">REFERENCIA</th>
                            <th class="talla" id="">TONO</th>
                            <th class="talla" id="">PROCESO SECO</th>
                            <th class="talla" id="">ATRIBUTO 1</th>
                            <th class="talla" id="">ATRIBUTO 2</th>
                            <th class="talla" id="">ATRIBUTO 3</th>
                            <th class="talla" id="">PRECIO</th>
                            {{-- <th class="talla" id="kg">G</th>
                            <th class="talla" id="kh">H</th>
                            <th class="talla" id="ki">I</th>
                            <th class="talla" id="kj">J</th>
                            <th class="talla" id="kk">K</th>
                            <th class="talla" id="kl">L</th> --}}
                            <th class="talla">TOTAL</th>
                            <th class="talla">AÑADIR</th>
                        </tr>
                    </thead>
                    <tbody id="sustitutos" class="text-align-center font-weight-bold">

                    </tbody>
                    <tfoot>

                    </tfoot>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-tallas-cerrar" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal Sustitutos-->
<div class="modal fade bd-talla-modal-xl" tabindex="-1" role="dialog" id="ModalSimilares"
    aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalLabel"><strong>Cortes en proceso con referencias
                        iguales</strong></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered tabla-detallada text-sm">
                    <thead class="">
                        <tr>
                            <th>No. Corte</th>
                            <th>Fase</th>
                            <th>F. Entrega</th>
                            <th>Ref</th>
                            <th>Total</th>
                            <th>AÑADIR</th>
                        </tr>
                    </thead>
                    <tbody id="corteProceso" class="text-align-center font-weight-bold">

                    </tbody>
                    <tfoot>

                    </tfoot>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-tallas-cerrar" class="btn btn-secondary"
                    data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>








<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Ordenes pedido')->where('agregar', 1)->first())
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                @endif
                <h4 class="text-white text-center">Listado de ordenes</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Ordenes pedido')->where('ver', 1)->first())
        <table id="ordenes" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    {{-- <th>Ver</th> --}}
                    <th>Actions</th>
                    <th>#</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>
                    <th>Sucursal</th>
                    <th>Fecha</th>
                    <th>F. Entrega</th>
                    <th>Total</th>
                    {{-- <th>Detallado</th> --}}
                    <th>Status</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    {{-- <th>Ver</th> --}}
                    <th>Actions</th>
                    <th>#</th>
                    <th>Vendedor</th>
                    <th>Cliente</th>
                    <th>Sucursal</th>
                    <th>F. Gen</th>
                    <th>F. Entrega</th>
                    <th>Total</th>
                    {{-- <th>Detallado</th> --}}
                    <th>Status</th>
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






@include('adminlte/scripts')
<script type="text/javascript" src="{{asset('js/orden_pedido/ordenPedido.js')}}"></script>

<script type="text/javascript">

</script>



@endsection
