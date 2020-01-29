<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light  text-sm">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                @if (Auth::user()->role == 'Administrador')
                <img src="{{asset('adminlte/img/images.png')}}" class="user-image img-circle elevation-2"
                    alt="User Image">
                @elseif(Auth::user()->role == 'Oficina')
                <img src="{{asset('adminlte/img/oficeUser.jpg')}}" class="user-image img-circle elevation-2"
                    alt="User Image">
                @endif
            <span class="d-none d-md-inline"> {{Auth::user()->name}} {{Auth::user()->surname}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <!-- User image -->
                <li class="user-header bg-primary">
                    @if (Auth::user()->role == 'Administrador')
                    <img src="{{asset('adminlte//img/images.png')}}" class="img-circle elevation-2"
                        alt="User Image">
                    @elseif(Auth::user()->role == 'Oficina')
                    <img src="{{asset('adminlte//img/oficeUser.jpg')}}" class="img-circle elevation-2"
                        alt="User Image">
                    @endif

                    <p>
                        {{Auth::user()->name}} {{Auth::user()->surname}}- {{Auth::user()->role}}
                        <small>Miembro desde {{date("d/m/20y", strtotime(Auth::user()->created_at))}}</small>
                    </p>
                </li>
                <!-- Menu Body -->
                <li class="user-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <a href="#"></a>
                        </div>
                    </div>
                    <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    @if (Auth::user()->role == 'Administrador')
                    <a href="/sistemaCCH/public/user" class="btn btn-default btn-flat">Usuarios</a>
                    @endif

                    <a href="{{ route('logout') }}" class="btn btn-default btn-flat float-right"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cierrar sesion</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#"><i
                    class="fas fa-th-large"></i></a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
