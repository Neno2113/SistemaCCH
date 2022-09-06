@extends('adminlte.layout')

@section('seccion', 'Usuarios')

@section('title', 'Usuario')

@section('content')

<div class="row ">
    <!--
    <div class="col-7">
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
            <div class="card-body">
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de usuarios</h5>
                    <hr>
                    <div class="row">
                        <input type="hidden" name="id" id="id" value="">
                       
                        <div class="col-md-6 col-sm-6 mt-3">
                            <label for="name">Nombre</label>
                            <input type="text" name="name" id="name"  class="form-control"
                                pattern="[a-zA-Z]">
                            {{-- <label for="name" class="label"></label> --}}
                        </div>
                        <div class="col-md-6 col-sm-6 mt-3">
                            <label for="surname">Apellido</label>
                            <input type="text" name="surname" id="surname"  class="form-control">
                            {{-- <label for="surname" class="label"></label> --}}
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-4 mt-3">
                            <label for="edad">Fecha Nacimiento</label>
                            <input 
                                type="date" 
                                name="fecha_nacimiento" 
                                id="fecha_nacimiento" 
                                class="form-control"
                                value="2000-01-01"    
                            >
                            {{-- <label for="edad" class="label"></label> --}}
                        </div>
                        <div class="col-md-4 mt-3">
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                            <label for="telefono">Telefono</label>
                            <input type="text" id="telefono" class="form-control"
                                data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            {{-- </div> --}}
                            {{-- <label for="name" class="label"></label> --}}
                        </div>
                        <div class="col-md-4 mt-3">

                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div> --}}
                            <label for="celular">Celular</label>
                            <input type="text" id="celular" class="form-control"
                                data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            {{-- <label for="celular" class="label"></label> --}}
                            {{-- </div> --}}
                        </div>
                    </div>

                    <div class="row mt-4">


                        <div class="col-12 mt-3">
                            {{-- <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-address-card"></i></span>
                                </div> --}}
                            <label for="direccion">Direccion</label> 
                            <textarea  id="direccion" class="form-control"></textarea>
                            {{-- <label for="direccion" class="label"></label> --}}
                            {{-- </div> --}}

                        </div>
                    </div>

                </form>
            </div>


            <div class="flex-row p-2 card-footer">
                <button class="btn  btn-danger mt-1" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left "></i>
                    Cancelar</button>
                {{-- <button type="submit" id="btn-guardar" class="btn btn-primary mt-1 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-1 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button> --}}

            </div>

        </div>
    </div>
     -->
    {{-- <div class="col-5"> --}}
    <div class="col-10">
        <div class="card  mb-3" id="userForm">
            <div class="card-header bg-dark ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                {{-- <h4 class="">Registro</h4> --}}
            </div>
            <div class="card-body">
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <h5>Datos de acceso para: <span id="nameAcceso"></span></h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="email"> Usuario</label>
                            <input type="Email" name="email" id="email"  class="form-control">
                            <input type="text" name="codigo" id="codigo"  class="form-control">
                           
                        </div>
                        <div class="col-md-6 mt-3" id="ver-contra">
                            <label for="password"> Contraseña</label>
                            <input type="password" name="password"  id="password"
                                class="form-control">
                           
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="role" >Departamento</label>
                            <select name="role" id="role" class="form-control">
                                <option value="" disabled>Departamento</option>
                                <option>Administrador</option>
                                <option>Oficina</option>
                                <option>Soporte</option>
                                <option>Operario</option>
                                <option>Venta</option>
                                <option>Corte</option>
                                <option>Produccion</option>
                                <option>Artesania</option>
                                <option>Terminacion</option>
                                <option>Almacen Producto Terminado</option>
                                <option>General</option>
                            </select>
                          
                        </div>
                    </div>


                </form>
                {{-- <div class="row"> --}}
                    
                <div class="row mt-3" id="vatar">
                    <form action="" method="POST" id="formUpload" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="exampleInputFile">Foto</label>
                            <img src="" alt="" id="avatar-img" class="rounded img-fluid img-thumbnail">
                            <div class="input-group mt-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="avatar" id="avatar">
                                    <input type="hidden" name="image_name" id="image_name" value="">
                                    {{-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> --}}
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn-primary" id="btn-upload">
                                        <i class="fas fa-upload"></i> Subir</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                {{-- </div> --}}

                <div class="row">
                    <div class="col-md-12">
                        <ul class="error" id="error">

                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex-row p-2 card-footer">
                {{-- <button class="btn  btn-danger mt-1" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i>
                    Cancelar</button> --}}
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-1 float-right"><i
                        class="far fa-save "></i> Guardar</button>
             
                <button type="submit" id="btn-edit" class="btn btn-warning mt-1 float-right"><i
                        class="far fa-edit "></i> Editar</button>
              
            </div>

        </div>
    </div>
</div>

<!-- CRISTOBAL -->

<div class="row ">
    <div class="col-6" id="registroFormP">
        <div class="card  mb-3" >
            <div class="card-header bg-dark ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de asignacion de permisos de acceso</h5>
                    <hr>
                    <div class="row" id="fila1">
                        <div class="col-md-7">
                            <label for="">Accesos</label>
                            <select name="tags[]" id="permisos" class="form-control select2">
                                {{-- <option disabled>DASHBOARD</option>
                                <option value="Dashboard">Dashboard</option>
                                <option  disabled>_______________________________________________________</option> --}}
                                <option disabled>USUARIOS</option>
                                <option value="Usuarios">Usuarios</option>
                                <option value="Empleados">Empleados</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>CLIENTE</option>
                                <option value="Cliente">Cliente</option>
                                <option value="Sucursales">Sucursales</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>SUPLIDORES</option>
                                <option value="Suplidores">Suplidores</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>SKU</option>
                                <option value="Sku">SKU</option>
                                <option disabled>PRODUCTO</option>
                                <option value="Catalogo cuenta">Catalogo</option>
                                <option value="Productos">Productos</option>
                                <option value="Articulos">Articulos</option>
                                <option value="Producto terminado">Producto Terminado</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>CORTE</option>
                                <option value="Composicion">Composicion</option>
                                <option value="Telas">Telas</option>
                                <option value="Rollos">Rollos</option>
                                <option value="Corte">Corte</option>
                                <option value="Lavanderia">Lavanderia</option>
                                <option value="Recepcion">Recepcion</option>
                                <option value="Definir Atributos">Definir atributos</option>
                                <option value="Entrada Almacen">Entrada almacen</option>
                                <option value="Perdidas">Perdidas</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>ORDEN PEDIDO</option>
                                <option value="Ordenes pedido">Orden Pedido</option>
                                <option value="Aprobar y redistribuir">Aprobacion y redistribucion</option>
                                <option value="Ordenes proceso">Ordenes Proceso</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>ORDENES EMPAQUE</option>
                                <option value="Imprimir ordenes empaque">Imprimir Empaque</option>
                                <option value="Reportar empaque">Reportar Empaque</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>FACTURACION</option>
                                <option value="Facturacion">Generar Factura</option>
                                <option value="Nota credito">Nota de Credito</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>Reportes</option>
                                <option value="Existencia Talla">Existencia por talla</option>
                                <option value="Reporte Existencias">Reporte existencias</option>
                                <option value="Reporte Disponibles">Reporte Disponibles</option>
                                <option value="Reporte Segundas">Reporte Segundas</option>
                                <option value="Reporte Pendientes">Reporte Pendientes</option>
                            </select>
                        </div>
                      
                        <div class="col-md-5">
                            <label for="">Usuario</label>
                            <select name="usuario" id="usuario" class="form-control select2">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5 mt-3 ml-2">
                            <button type="button" id="btn-agregarP" name="btn-agregarP" class="btn btn-primary"><i class="fas fa-key"></i> Agregar</button>
                        </div>
                    </div>
                  
                    


            </div>
            <div class="card-footer  text-muted ">
                <button class="btn  btn-danger mt-1" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardarP" class="btn btn-info mt-1 float-right"><i class="far fa-save fa-lg"></i> Guardar</button>
             <!--   <button type="submit" id="btn-edit" class="btn btn-warning mt-1 float-right"><i class="far fa-edit fa-lg"></i> Editar</button> -->

            </div>
            </form>
        </div>
    </div>
    <div class="col-6" id="permisoCard">
        <div class="card  mb-3" >
            <div class="card-header bg-dark ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Permisos</h5>
                    <hr>
                   
                       
                    <div class="row mt-4">
                        <table class="table tabla-existencia table-bordered">
                            <thead class="text-center">
                                <tr>
                                <!--    <th>Usuario</th> -->
                                    <th>Acceso</th>
                                    <th>Permisos</th>
                                    <th id="editar-permisos">Eliminar</th>
                                </tr>
                            </thead>
                            <tbody id="permisos-agregados">

                            </tbody>
                        </table>
                    </div>


            </div>
            <div class="card-footer  text-muted ">
                {{-- <button class="btn  btn-danger mt-1" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button> --}}
                {{-- <button type="submit" id="btn-guardar" class="btn btn-info mt-1 float-right"><i class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-1 float-right"><i class="far fa-edit fa-lg"></i> Editar</button> --}}

            </div>
            </form>
        </div>
    </div>
</div>


<!-- CRISTOBAL -->



<div class="card" id="listadoUsers">
    <div class="card-header bg-dark ">
        <div class="row">
          
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" )
                <!--
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-user-plus"></i> Agregar </button>
                -->
                @elseif (Auth::user()->permisos()->where('permiso', 'Usuarios')->where('agregar', 1)->first() )
                <!--
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-user-plus"></i> Agregar </button>
                -->
                @endif
                <h4 class="text-center  text-white">Listado de usuarios</h4>
            </div>
          
        </div>
    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Usuarios')->where('ver', 1)->first())
        <table id="users" class="table table-bordered table-hover datatables" style="width: 100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Active</th>
                    <th>Actions</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Edad</th>
                    <th>Celular</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Active</th>
                    <th>Actions</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Edad</th>
                    <th>Celular</th>
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

<!-- CRISTOBAL -->
<div class="modal fade bd-edit-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header bg-dark ">
        <h5 class="modal-title font-weight-bold">Permisos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div id="" class="modal-body">
        <form>
            <div class="row justify-content-md-center">
              <div class="col-3">
              
                <div class="form-group">
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="permiso" type="checkbox" id="ver" value="r">
                    <label for="ver" class="custom-control-label">Ver</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="permiso" type="checkbox" id="agregar" value="a">
                    <label for="agregar" class="custom-control-label">Agregar</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="permiso" type="checkbox" id="modificar" value="w">
                    <label for="modificar" class="custom-control-label">Modificar</label>
                  </div>
                  <div class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="permiso" type="checkbox" id="eliminar" value="d">
                    <label for="eliminar" class="custom-control-label">Eliminar</label>
                  </div>
           
                </div>
              </div>
            </div>
        </form>
      
        {{-- <div class="modal-footer">
            <button type="button" id="btn-close" class="btn btn-primary" data-dismiss="modal"> Cerrar</button>
        </div> --}}
    </div>

  </div>
</div>
</div>
<!-- FIN CRISTOBAL -->


@include('adminlte/scripts')
{{-- <script src="{{asset('js/formulario.js')}}"></script> --}}
<script src="{{asset('js/users/user.js')}}"></script>

@endsection
