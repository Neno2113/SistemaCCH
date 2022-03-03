<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./home" class="brand-link">
        <img src="{{asset('/adminlte/img/AdminLTELogo.png')}}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SistemaCCH</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar text-sm">
        <!-- Sidebar user panel (optional) -->
<!--    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
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
-->
        @if (Auth::user()->role == "Administrador")
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent " data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item has-treeview">

                    <a href="./home" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                    <!--        <i class="right fas fa-angle-left"></i> -->
                        </p>
                    </a>
<!--
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./home" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
-->
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
                            <a href="./user" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Usuarios</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./permiso" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Permisos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./employee" class="nav-link">
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
                            <a href="./client" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Clientes</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="./branch" class="nav-link">
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
                            <a href="./supplier" class="nav-link">
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
                            <a href="./sku" class="nav-link">
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
                        {{-- <li class="nav-item">
                            <a href="./catelogo-cuenta" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Catalogo Cuenta</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="./product" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Producto</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="./articulo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Articulo</p>
                            </a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="./producto-terminado" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Producto terminado</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-toolbox"></i>
                        <p>
                            Materiales
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./composition" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Composiciones</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./cloth" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Telas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./rollos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rollos</p>
                            </a>
                        </li>
                    
                      
                    </ul>
                </li>
                <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-cut"></i>
                        <p>
                            Corte y Fases
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        
                        {{-- <li class="nav-header">CORTE Y FASES</li> --}}
                        <li class="nav-item">
                            <a href="./corte" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Corte</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./lavanderia" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Envio Lavanderia</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./recepcion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recepcion Lavanderia</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./definir-atributo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Definir atributos</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./almacen" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Entrada almacen</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./perdida" class="nav-link">
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
                            <a href="./orden_pedido" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orden Pedido</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./orden_aprobacion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aprobar y redistibuir</p>
                            </a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="./ordenes_proceso" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ordenes proceso</p>
                            </a>
                        </li> --}}
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
                            <a href="./orden_empaque_listar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Imprimir Orden</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./orden_empaque" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reportar Empaque</p>
                            </a>
                        </li>
                    </ul>
                </li>
                {{-- <li class="nav-item has-treeview ">
                    <a href="#" class="nav-link ">
                        <i class="fas fa-file-invoice"></i>
                        <p>
                            Facturacion
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
            
                        <li class="nav-item">
                            <a href="./facturacion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Generar factura</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./nota_credito" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Nota de credito</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                <li class="nav-item has-treeview ">

                    <a href="#" class="nav-link ">
                        <i class="fas fa-undo"></i>
                        <p>
                            Devoluciones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./nota_credito" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Devolucion</p>
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
                            <a href="./existencia" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Existencia por talla</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="./reporte" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Existencias</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./reporte-primera" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Disponibles</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./reporte-segunda" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Segundas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./reporte-pendientes" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Pendientes</p>
                            </a>
                        </li>

                        {{-- <li class="nav-item">
                            <a href="./exportar-peach" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Exportar Peachtree</p>
                            </a>
                        </li> --}}
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
                            <a href="./home" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @if (Auth::user()->permisos()->where('permiso', 'Usuarios')->first() or Auth::user()->permisos()->where('permiso', 'Empleados')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-users"></i>
                        <p>
                            Usuarios
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->permisos()->where('permiso', 'Usuarios')->first())
                        <li class="nav-item">
                            <a href="./user" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Usuario</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Empleados')->first())
                        <li class="nav-item">
                            <a href="./employee" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Empleado</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                {{-- @if (Auth::user()->permisos()->where('permiso', 'Empleados')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-id-badge"></i>
                        <p>
                            Empleados
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./employee" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Empleado</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif --}}
                @if (Auth::user()->permisos()->where('permiso', 'Cliente')->first() or Auth::user()->permisos()->where('permiso', 'Sucursales')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-id-card"></i>
                        <p>
                            Clientes
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->permisos()->where('permiso', 'Cliente')->first())
                        <li class="nav-item">
                            <a href="./client" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Cliente</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Sucursales')->first())
                        <li class="nav-item">
                            <a href="./branch" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sucursales</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                {{-- @if (Auth::user()->permisos()->where('permiso', 'Sucursales')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-building"></i>
                        <p>
                            Sucursales
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./branch" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sucursales</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif --}}
                @if (Auth::user()->permisos()->where('permiso', 'Suplidores')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-shipping-fast"></i>
                        <p>
                            Suplidores
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./supplier" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Suplidor</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (Auth::user()->permisos()->where('permiso', 'Sku')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-barcode"></i>
                        <p>
                            SKU
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./sku" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>SKU</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (Auth::user()->permisos()->where('permiso', 'Productos')->first() or Auth::user()->permisos()->where('permiso', 'Producto terminado')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-clipboard"></i>
                        <p>
                            Productos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                       @if(Auth::user()->permisos()->where('permiso', 'Productos')->first())
                        <li class="nav-item">
                            <a href="./product" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Producto</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Producto terminado')->first())
                        <li class="nav-item">
                            <a href="./producto-terminado" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Producto terminado</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                {{-- @if (Auth::user()->permisos()->where('permiso', 'Producto terminado')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-images"></i>
                        <p>
                            Producto Terminado
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./producto-terminado" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Producto terminado</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif --}}
                @if (Auth::user()->permisos()->where('permiso', 'Composicion')->first() or Auth::user()->permisos()->where('permiso', 'Telas')->first() or Auth::user()->permisos()->where('permiso', 'Rollos')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-toolbox"></i>
                        <p>
                            Materiales
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->permisos()->where('permiso', 'Composicion')->first())
                        <li class="nav-item">
                            <a href="./composition" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Composiciones</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Telas')->first())
                        <li class="nav-item">
                            <a href="./cloth" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Telas</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Rollos')->first())
                        <li class="nav-item">
                            <a href="./rollos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rollos</p>
                            </a>
                        </li>
                        @endif

                    </ul>
                </li>
                @endif
                {{-- @if (Auth::user()->permisos()->where('permiso', 'Telas')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-pencil-ruler"></i>
                        <p>
                            Telas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./cloth" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Telas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (Auth::user()->permisos()->where('permiso', 'Rollos')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-dolly-flatbed"></i>
                        <p>
                            Rollos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./rollos" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rollos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif --}}
                @if (Auth::user()->permisos()->where('permiso', 'Corte')->first() or Auth::user()->permisos()->where('permiso', 'Lavanderia')->first() or Auth::user()->permisos()->where('permiso', 'Recepcion')->first()
                or Auth::user()->permisos()->where('permiso', 'Definir Atributos')->first() or Auth::user()->permisos()->where('permiso', 'Entrada Almacen')->first() or
                Auth::user()->permisos()->where('permiso', 'Perdidas')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-cut"></i>
                        <p>
                            Corte y fases
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->permisos()->where('permiso', 'Corte')->first())
                        <li class="nav-item">
                            <a href="./corte" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Corte</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Lavanderia')->first())
                        <li class="nav-item">
                            <a href="./lavanderia" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Enviar lavanderia</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Recepcion')->first())
                        <li class="nav-item">
                            <a href="./recepcion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recibir lavanderia</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Definir Atributos')->first())
                        <li class="nav-item">
                            <a href="./definir-atributo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Definir atributos</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Entrada Almacen')->first())
                        <li class="nav-item">
                            <a href="./almacen" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Entradas almacen</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Perdidas')->first())
                        <li class="nav-item">
                            <a href="./perdida" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perdidas</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                {{-- @if (Auth::user()->permisos()->where('permiso', 'Lavanderia')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-industry"></i>
                        <p>
                            Lavanderia
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./lavanderia" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Enviar lavanderia</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif --}}
                {{-- @if (Auth::user()->permisos()->where('permiso', 'Recepcion')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-truck-loading"></i>
                        <p>
                            Recepcion Lavanderia
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./recepcion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Recibir lavanderia</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif --}}
                {{-- @if (Auth::user()->permisos()->where('permiso', 'Definir Atributos')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-chalkboard-teacher"></i>
                        <p>
                            Definir Atributos
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./definir-atributo" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Definir atributos</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif --}}
                {{-- @if (Auth::user()->permisos()->where('permiso', 'Entrada Almacen')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-warehouse"></i>
                        <p>
                            Entradas almacen
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./almacen" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Entradas almacen</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif --}}
                {{-- @if (Auth::user()->permisos()->where('permiso', 'Perdidas')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-trash-restore"></i>
                        <p>
                            Perdidas
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./perdida" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Perdidas</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif --}}
                @if (Auth::user()->permisos()->where('permiso', 'Ordenes pedido')->first() or Auth::user()->permisos()->where('permiso', 'Aprobar y redistribuir')->first() or 
                Auth::user()->permisos()->where('permiso', 'Ordenes proceso')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-boxes"></i>
                        <p>
                            Ordenes pedido
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->permisos()->where('permiso', 'Ordenes pedido')->first())
                        <li class="nav-item">
                            <a href="./orden_pedido" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Orden Pedido</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Aprobar y redistribuir')->first())
                        <li class="nav-item">
                            <a href="./orden_aprobacion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aprobacion y redistibucion</p>
                            </a>
                        </li>
                        @endif
                        {{-- @if (Auth::user()->permisos()->where('permiso', 'Ordenes proceso')->first())
                        <li class="nav-item">
                            <a href="./ordenes_proceso" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ordenes proceso</p>
                            </a>
                        </li>
                        @endif --}}
                    </ul>
                </li>
                @endif
                {{-- @if (Auth::user()->permisos()->where('permiso', 'Aprobar y redistribuir')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-sort-alpha-down"></i>
                        <p>
                            Aprobar y distribuir
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./orden_aprobacion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aprobacion y redistibucion</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (Auth::user()->permisos()->where('permiso', 'Ordenes proceso')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-box"></i>
                        <p>
                            Ordenes proceso
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./ordenes_proceso" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ordenes proceso</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif --}}
                @if (Auth::user()->permisos()->where('permiso', 'Imprimir ordenes empaque')->first() or Auth::user()->permisos()->where('permiso', 'Reportar empaque')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-archive"></i>
                        <p>
                            Ordenes Empaque
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->permisos()->where('permiso', 'Imprimir ordenes empaque')->first())
                        <li class="nav-item">
                            <a href="./orden_empaque_listar" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Imprimir Orden</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Reportar empaque')->first())
                        <li class="nav-item">
                            <a href="./orden_empaque" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reportar Empaque</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                {{-- @if (Auth::user()->permisos()->where('permiso', 'Reportar empaque')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <p>
                            Reportar Empaque
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./orden_empaque" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Reportar Empaque</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif --}}
                @if (Auth::user()->permisos()->where('permiso', 'Nota credito')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-file-alt"></i>
                        <p>
                            Devoluciones
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./nota_credito" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Devolucion</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endif
                @if (Auth::user()->permisos()->where('permiso', 'Existencia Talla')->first() or Auth::user()->permisos()->where('permiso', 'Reporte Existencias')->first()
                or Auth::user()->permisos()->where('permiso', 'Reporte Disponibles')->first() or  Auth::user()->permisos()->where('permiso', 'Reporte Segundas')->first()
                or Auth::user()->permisos()->where('permiso', 'Reporte Pendientes')->first())
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="fas fa-random"></i>
                        <p>
                            Existencias
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if (Auth::user()->permisos()->where('permiso', 'Existencia Talla')->first())
                        <li class="nav-item">
                            <a href="./existencia" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Existencia Talla</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Reporte Existencias')->first())
                        <li class="nav-item">
                            <a href="./reporte" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Existencia Talla</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Reporte Disponibles')->first())
                        <li class="nav-item">
                            <a href="./reporte-primera" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Existencia Talla</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Reporte Segundas')->first())
                        <li class="nav-item">
                            <a href="./reporte-Segundas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Existencia Talla</p>
                            </a>
                        </li>
                        @endif
                        @if (Auth::user()->permisos()->where('permiso', 'Reporte Pendientes')->first())
                        <li class="nav-item">
                            <a href="./reporte-pendientes" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Existencia Talla</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                @endif
                {{-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="far fa-list-alt"></i>
                        <li class="nav-header">CORTE Y FASES</li>
                        <p>
                            Menu de acceso
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="./facturacion" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Generar factura</p>
                            </a>
                        </li>

                        @if (Auth::user()->permisos()->where('permiso', 'Nota credito')->first())

                     

                        @endif
                     

                      
                    </ul>
                </li> --}}
        </nav>
        @endif

        <!-- /.sidebar-menu -->
    </div>

    <!-- /.sidebar -->
</aside>