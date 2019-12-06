<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="{{asset('/adminlte/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">CCH</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('adminlte/img/images.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">{{Auth::user()->name}} {{Auth::user()->surname}}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="far fa-address-card"></i>
            <p>
              Usuarios
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/sistemaCCH/public/user" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Usuarios</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link ">
            <i class="far fa-address-book"></i>
            <p>
              Clientes
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/sistemaCCH/public/client" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Clientes</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sistemaCCH/public/branch" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Sucursales</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link ">
            <i class="fas fa-shipping-fast"></i>
            <p>
              Suplidores
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/sistemaCCH/public/supplier" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Suplidores</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-toolbox"></i>
            <p>
              Utilidades
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/sistemaCCH/public/composition" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Composiciones</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sistemaCCH/public/cloth" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Telas</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sistemaCCH/public/rollos" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Rollos</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview">
          <a href="#" class="nav-link ">
            <i class="fas fa-barcode"></i>
            <p>
              SKU
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/sistemaCCH/public/sku" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>SKU</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link ">
            <i class="far fa-clipboard"></i>
            <p>
              Producto
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/sistemaCCH/public/product" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Producto</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sistemaCCH/public/producto-terminado" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Producto terminado</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link ">
            <i class="fas fa-cut"></i>
            <p>
              Corte
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/sistemaCCH/public/corte" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Corte</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sistemaCCH/public/lavanderia" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Lavanderia</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sistemaCCH/public/recepcion" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Recepcion</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sistemaCCH/public/almacen" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Almacen</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sistemaCCH/public/perdida" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Perdidas</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link ">
            <i class="fas fa-boxes"></i>
            <p>
              Ordenes de pedido
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/sistemaCCH/public/orden_pedido" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Orden Pedido</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sistemaCCH/public/orden_aprobacion" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Aprobacion y redistibucion</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link ">
            <i class="fas fa-box"></i>
            <p>
              Ordenes Empaque
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/sistemaCCH/public/orden_empaque_listar" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Imprimir Orden</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sistemaCCH/public/orden_empaque" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Reportar Empaque</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link ">
            <i class="fas fa-file-invoice"></i>
            <p>
              Ordenes Facturacion
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/sistemaCCH/public/orden_facturacion" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Orden Facturacion</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/sistemaCCH/public/facturacion" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Facturar</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview ">
          <a href="#" class="nav-link ">
            <i class="fas fa-random"></i>
            <p>
              Existencias
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="/sistemaCCH/public/existencia" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Existencia</p>
              </a>
            </li>

          </ul>

        </li>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>