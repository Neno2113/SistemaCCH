@extends('adminlte.layout')

@section('seccion', 'Dashboard')

@section('title', 'Home')

@section('content')

<div class="row mt-2" style="backgroung-colod">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        <h3 id="cant_orden"></h3>

        <p>Nuevas Ordenes</p>
      </div>
      <div class="icon">
        <i class="ion ion-bag"></i>
      </div>
      <a href="/sistemaCCH/public/orden_pedido" class="small-box-footer">Ver más <i
          class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-success">
      <div class="inner">
        <h3>53<sup style="font-size: 20px">%</sup></h3>

        <p>Bounce Rate</p>
      </div>
      <div class="icon">
        <i class="ion ion-stats-bars"></i>
      </div>
      <a href="/sistemaCCH/public/orden_pedido" class="small-box-footer">Ver más <i
          class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-warning">
      <div class="inner">
        <h3 id="cortes_home"></h3>

        <p>Cortes en proceso</p>
      </div>
      <div class="icon">
        <i class="ion ion-scissors"></i>
      </div>
      <a href="/sistemaCCH/public/corte" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-danger">
      <div class="inner">
        <h3 id="disp_venta"></h3>

        <p>Disponibles venta</p>
      </div>
      <div class="icon">
        <i class="ion ion-pie-graph"></i>
      </div>
      <a href="/sistemaCCH/public/existencia" class="small-box-footer">Ver más <i
          class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
</div>
<!-- Main row -->
<div class="row  ml-1 mr-1">
  <!-- Left col -->
  <section class="col-md-7 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-pie mr-1"></i>
          Sales
        </h3>
        <div class="card-tools">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
            </li>
          </ul>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content p-0">
          <!-- Morris chart - Sales -->
          <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
          </div>
          <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
            <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
          </div>
        </div>
      </div><!-- /.card-body -->
    </div>
    <!-- /.card -->
    <!-- TABLE: LATEST ORDERS -->
    <div class="card">
      <div class="card-header border-transparent text-black bg-gradient-info">
        <h3 class="card-title">Ultimas Ordenes generadas</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr>
                <th>Orden ID</th>
                <th>Cliente</th>
                <th>Status</th>
                <th>Fecha Entrega</th>
              </tr>
            </thead>
            <tbody id="latest_orders">
              {{-- <tr id="">
                <td><a href="pages/examples/invoice.html">OP-001</a></td>
                <td>Lordish</td>
                <td><span class="badge badge-secondary">StanBy</span></td>
                <td>
                  <div class="sparkbar" data-color="#00a65a" data-height="20">31-12-2019</div>
                </td>
              </tr> --}}

            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <a href="/sistemaCCH/public/orden_pedido" class="btn btn-sm btn-secondary float-right">Ver todas las ordenes</a>
      </div>
      <!-- /.card-footer -->
    </div>

     <!-- TABLE: LATEST CORTES -->
     <div class="card ">
      <div class="card-header border-transparent text-black bg-gradient-primary">
        <h3 class="card-title">Cortes en proceso</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0 ">
        <div class="table-responsive">
          <table class="table m-0">
            <thead>
              <tr class="">
                <th>Corte ID</th>
                <th>Fase</th>
                <th>Producto</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody id="latest_cortes">
            
            </tbody>
          </table>
        </div>
        <!-- /.table-responsive -->
      </div>
      <!-- /.card-body -->
      <div class="card-footer clearfix">
        <a href="/sistemaCCH/public/cortes" class="btn btn-sm btn-secondary float-right">Ver todos los cortes</a>
      </div>
      <!-- /.card-footer -->
    </div>


    <!-- /.card -->
  </section>
  <!-- /.Left col -->
  <!-- right col (We are only adding the ID to make the widgets sortable)-->
  <section class="col-md-5 connectedSortable">
    
     <!-- Custom tabs (Charts with tabs)-->
     <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <i class="fas fa-chart-pie mr-1"></i>
          Sales
        </h3>
        <div class="card-tools">
          <ul class="nav nav-pills ml-auto">
            <li class="nav-item">
              <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
            </li>
          </ul>
        </div>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content p-0">
          <!-- Morris chart - Sales -->
          <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
            <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
          </div>
          <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
            <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
          </div>
        </div>
      </div><!-- /.card-body -->
    </div>
    <!-- PRODUCT LIST -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Referencias creadas recientemente</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body p-0">
        <ul class="products-list product-list-in-card pl-2 pr-2" id="productos">
         
        </ul>
      </div>
      <!-- /.card-body -->
      <div class="card-footer text-center">
        <a href="javascript:void(0)" class="uppercase">Ver todos los productos</a>
      </div>
      <!-- /.card-footer -->
    </div>

  </section>
  <!-- right col -->
</div>






@include('adminlte/scripts')
<script src="js/dashboard.js"></script>



@endsection