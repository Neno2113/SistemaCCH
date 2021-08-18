@extends('adminlte.layout')

@section('seccion', 'Existencias')

@section('title', 'Existencia')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header bg-dark ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                {{-- <h4 class="">Registro</h4> --}}
            </div>
            <div class="card-body bg-white">
                @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Existencia Talla')->where('ver', 1)->first())
                <div class="row pt-3 pl-3">
                    <div class="col-md-4">
                        <label for="">Referencia Producto</label>
                        <select name="tags[]" id="productoSearch" class="form-control select2" style="width:100%">
                        </select>
                    </div>
                    <div class="col-md-2" id="refDos-div">
                        <label for="">Referencia Grande</label>
                        <input type="text" name="referenciaDos" id="referenciaDos" class="form-control">
                    </div>
                    <div class="col-md-3 mt-4 pt-2">
                        <select name="tipo_consulta" id="tipo_consulta" class="form-control">
                            <option value="Totales">Tipo de consulta</option>
                            {{-- <option value="Detallada">Detallada</option> --}}
                            <option value="Totales">Totales</option>
                        </select>
                    </div>
                    <div class="col-md-3 mt-4 pt-2">
                        <button class="btn btn-success" id="btn-consultar"><i class="fas fa-search"></i> Consultar</button>
                    </div>
                </div>
                
                <div id="printArea">
                    <div class="row">
                        <div class="col-12 pt-3 pl-3 pb-3">
                            <table class="table  table-bordered mt-3 tabla-existencia">
                                <thead>
                                    <tr>
                                        <th>Cod. Trans.</th>
                                        <th id="codigo">Cod</th>
                                        <th>Ref. Producto</th>
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
                                        <th>X</th>
                                        <th>Total</th>
                
                                    </tr>
                                </thead>
                                <tbody id="transacciones">
                
                                </tbody>
                                <tfoot>
                                    <tr id="totales" class="totales">
                                        <th>Existencia</th>
                                        <th id="ref"></th>
                                        <th id="a"></th>
                                        <th id="b"></th>
                                        <th id="c"></th>
                                        <th id="d"></th>
                                        <th id="e"></th>
                                        <th id="f"></th>
                                        <th id="g"></th>
                                        <th id="h"></th>
                                        <th id="i"></th>
                                        <th id="j"></th>
                                        <th id="k"></th>
                                        <th id="l"></th>
                                        <th></th>
                                        <th id="total"></th>
                                    </tr>
                                    <tr id="disp_venta" class="disp_venta">
                                        <th>Disp. V. Primera</th>
                                        <th id="ref_venta"></th>
                                        <th id="a_venta"></th>
                                        <th id="b_venta"></th>
                                        <th id="c_venta"></th>
                                        <th id="d_venta"></th>
                                        <th id="e_venta"></th>
                                        <th id="f_venta"></th>
                                        <th id="g_venta"></th>
                                        <th id="h_venta"></th>
                                        <th id="i_venta"></th>
                                        <th id="j_venta"></th>
                                        <th id="k_venta"></th>
                                        <th id="l_venta"></th>
                                        <th></th>
                                        <th id="total_venta"></th>
                                    </tr>
                                    <tr id="disp_venta_segunda" class="disp_venta">
                                        <th>Disp. V. Segunda</th>
                                        <th id="ref_venta"></th>
                                        <th id="a_venta_seg"></th>
                                        <th id="b_venta_seg"></th>
                                        <th id="c_venta_seg"></th>
                                        <th id="d_venta_seg"></th>
                                        <th id="e_venta_seg"></th>
                                        <th id="f_venta_seg"></th>
                                        <th id="g_venta_seg"></th>
                                        <th id="h_venta_seg"></th>
                                        <th id="i_venta_seg"></th>
                                        <th id="j_venta_seg"></th>
                                        <th id="k_venta_seg"></th>
                                        <th id="l_venta_seg"></th>
                                        <th></th>
                                        <th id="total_venta_seg"></th>
                                    </tr>
                                </tfoot>
                            </table>
                
                        </div>
                
                
                        {{-- <div class="col-md-2 " style="margin-top: 26.8%">
                            <button id="btn-guardar" name="btn-guardar" class="btn btn-secondary"><i class="fas fa-sync"></i></button>
                        </div> --}}
                    </div>
                </div>
                
                {{-- <div class="row d-flex">
                    <div class="col-md-3 pb-2 justify-content-end">
                        <button class="btn btn-primary" onclick="printDiv('printArea')"><i class="fas fa-print"></i> Imprimir</button>
                    </div>
                
                </div> --}}
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
</div>





@include('adminlte/scripts')
<script src="{{asset('js/reporte/existencia.js')}}"></script>




@endsection
