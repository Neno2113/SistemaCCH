@extends('adminlte.layout')

@section('seccion', 'Usuarios')

@section('title', 'Permisos')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-3">
    {{-- <button class="btn btn-primary mb-3 " id="btnAgregar"><i class="fas fa-user-plus"></i> Agregar </button> --}}
    {{-- <button class="btn btn-danger mb-3 " id="btnCancelar"><i class="fas fa-window-close"></i></button> --}}
</div>

<div class="row ">
    <div class="col-6" id="registroForm">
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
                            <button type="button" id="btn-agregar" name="btn-agregar" class="btn btn-primary"><i class="fas fa-key"></i> Agregar</button>
                        </div>
                    </div>
                  
                    


            </div>
            <div class="card-footer  text-muted ">
                <button class="btn  btn-danger mt-1" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-1 float-right"><i class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-1 float-right"><i class="far fa-edit fa-lg"></i> Editar</button>

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
                                    <th>Usuario</th>
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
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                <h4 class="text-white text-center"> Listado de usuarios</h4>
            </div>
        </div>

    </div>
    <div class="card-body">

        <table id="users" class="table table-bordered table-hover datatables" style="width: 100%" >
            <thead>
                <tr>
                    <th></th>
                    <th>Permisos</th>
                    <th>Nombre</th>
                    {{-- <th>Permiso</th> --}}
                    <th>Rol</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Permisos</th>
                    <th>Nombre</th>
                    {{-- <th>Permiso</th> --}}
                    <th>Rol</th>
                    <th>Email</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>

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



@include('adminlte/scripts')
<script src="{{asset('js/users/permiso.js')}}"></script>

<script>

</script>

@endsection
