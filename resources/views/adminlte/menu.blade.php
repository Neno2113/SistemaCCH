<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{asset('/adminlte/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">CCH</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar text-sm">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (!empty(Auth::user()->avatar))
                <img src="{{URL('/avatar').'/'.Auth::user()->avatar}}" class="img-circle elevation-2" alt="User Image">
                @else
                <img src="{{asset('adminlte/img/images.png')}}" class="img-circle elevation-2" alt="User Image">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}} {{Auth::user()->surname}}</a>
            </div>
        </div>

        @if (Auth::user()->role == "Administrador")
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent " data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item has-treeview">

                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/home" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>

                </li>
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
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/permiso" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permisos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/employee" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Empleados</p>
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


                {{-- <li class="nav-item has-treeview">
          <a href="#" class="nav-link">
            <i class="fas fa-toolbox"></i>
            <p>
              Utilidades
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">


          </ul>
        </li> --}}
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
                            <a href="/sistemaCCH/public/catelogo-cuenta" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Catalogo Cuenta</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/product" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Producto</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/articulo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Articulo</p>
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
                        <li class="nav-header">CORTE Y FASES</li>
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
                            <a href="/sistemaCCH/public/definir-atributo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Definir atributos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/almacen" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Entrada almacen</p>
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
                                <p>Aprobar y redistibuir</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/ordenes_proceso" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ordenes proceso</p>
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
                            Facturacion
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        {{-- <li class="nav-item">
              <a href="/sistemaCCH/public/orden_facturacion" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Orden Facturacion</p>
              </a>
            </li> --}}
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/facturacion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Generar factura</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/nota_credito" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nota de credito</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-random"></i>
                        <p>
                            Reportes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/existencia" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Existencia por talla</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/reporte" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Existencias</p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/exportar-peach" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Exportar Peachtree</p>
                            </a>
                        </li>
                    </ul>
                </li>
        </nav>
        @elseif (Auth::user()->role != "Administrador")
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent " data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                 with font-awesome or any other icon font library -->

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/home" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-list-alt"></i>
                        {{-- <li class="nav-header">CORTE Y FASES</li> --}}
                        <p>
                            Menu de acceso
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                    @if (Auth::user()->permisos()->where('permiso', 'Usuarios')->first())
                        <li class="nav-item">
                            <a href="/sistemaCCH/public/user" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Usuario</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Empleados')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/employee" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Empleado</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Cliente')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/client" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cliente</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Sucursales')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/branch" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sucursales</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Suplidores')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/supplier" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Suplidor</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Sku')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/sku" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SKU</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Productos')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/product" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Producto</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Producto terminado')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/producto-terminado" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Producto terminado</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Composicion')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/composition" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Composiciones</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Telas')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/cloth" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Telas</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Rollos')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/rollos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rollos</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Corte')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/corte" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Corte</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Lavanderia')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/lavanderia" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lavanderia</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Recepcion')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/recepcion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recepcion</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Definir Atributos')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/definir-atributo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Definir atributos</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Entrada Almacen')->first())

                    <li class="nav-item">
                        <a href="/sistemaCCH/public/almacen" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Entradas almacen</p>
                        </a>
                    </li>

                @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Perdidas')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/perdida" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perdidas</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Ordenes pedido')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/orden_pedido" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orden Pedido</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Aprobar y redistribuir')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/orden_aprobacion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aprobacion y redistibucion</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Ordenes proceso')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/ordenes_proceso" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ordenes proceso</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Imprimir ordenes empaque')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/orden_empaque_listar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Imprimir Orden</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Reportar empaque')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/orden_empaque" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reportar Empaque</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Facturacion')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/facturacion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Generar factura</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Nota credito')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/nota_credito" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nota de credito</p>
                            </a>
                        </li>

                    @endif
                    @if (Auth::user()->permisos()->where('permiso', 'Existencias')->first())

                        <li class="nav-item">
                            <a href="/sistemaCCH/public/existencia" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Existencia</p>
                            </a>
                        </li>
                    </ul>
                    @endif
                </li>
        </nav>
        @endif

        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>
