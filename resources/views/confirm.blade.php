<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>SistemaCCH</title>
      <!--  Favicon -->
    <link rel="icon"  href="{{asset('adminlte/img/favicon/CCHFAV2.ico')}}">


    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/css/adminlte.min.css')}}">
    <!-- Bootstrap -->


    <link rel="stylesheet" href="{{asset('css/styles.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Slabo+13px&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">



</head>
<div class="row bg-white">
    <div class="col-12">
        <div class="login-box">
            <div class="login-logo">
                <b>CCH</b>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">Para poder usar el sistema debe actualizar su contraseña.</p>

                    <form  >
                    
                        <label for="">Contraseña actual</label>
                        <div class="input-group mb-3">
                            <input type="password" id="vieja" class="form-control" placeholder="Contraseña actual">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                        </div>
                        <label for="">Contraseña nueva</label>
                        <div class="input-group mb-3">
                            <input type="password" id="nueva" class="form-control" placeholder="Contraseña nueva">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fas fa-user-lock"></i>
                                </div>
                            </div>
                        </div>
                        <label for="">Confirmar Contraseña</label>
                        <div class="input-group mb-3">
                            <input type="password" id="confirmar" class="form-control" placeholder="Confirmar Contraseña">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <i class="fas fa-user-lock"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" id="btnConfirm" class="btn btn-primary btn-block">Cambiar contraseña</button>
                            </div>
                            
                            <!-- /.col -->
                        </div>
                    </form>

                    <p class="mt-3 mb-1">
                        <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Login</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </p>
                
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
   
</div>


@include('adminlte/scripts')
<script src="{{asset('js/users/user.js')}}"></script>



