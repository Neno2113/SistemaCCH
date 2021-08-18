@extends('adminlte.layout')

@section('seccion', 'Existencias')

@section('title', 'Reporte')

@section('content')
{{-- <div class="container"> --}}


<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <h4 class="text-center text-white">Reporte Disponible Pendiente</h4>
    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Reporte')->where('ver', 1)->first())
        <div class="row">
      
            <div class="col-md-5">
                <label for="">Hasta:</label>
                <input type="date" name="hasta" id="hasta" class="form-control">
            </div>
            <div class="col-md-2 mt-4 pt-2">
                <button type="button" id="btn-generarPendiente" class="btn btn-outline-success"> <i class="fas fa-calculator"></i> Generar</a>

            </div>
        </div>
        {{-- <div class="row">
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
        {{-- <table id="existencias" class="table table-bordered table-hover datatables" style="width: 100%">
            <thead>
                <tr>
                    <th></th>

                    <th>Marca</th>
                    <th>Referencia</th>
                    <th>Produccion</th>
                    <th>Lavanderia</th>
                    <th>Terminacion</th>
                    <th>Almacen</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>

                    <th>Marca</th>
                    <th>Referencia</th>
                    <th>Produccion</th>
                    <th>Lavanderia</th>
                    <th>Terminacion</th>
                    <th>Almacen</th>
                </tr>
            </tfoot>
        </table> --}}
    </div>
    <div class="card-footer text-muted " style="background: transparent;">
        <a id="btn-printPendiente" class="btn btn-secondary float-right"> <i class="fas fa-print"></i> Imprimir</a>
    </div>

</div>



@include('adminlte/scripts')
<script src="{{asset('js/reporte/reporte.js')}}"></script>

@endsection
