@extends('adminlte.layout')

@section('seccion', 'Usuarios')

@section('title', 'Permisos')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-3">
    <button class="btn btn-primary mb-3 " id="btnAgregar"><i class="fas fa-user-plus"></i> Agregar </button>
    {{-- <button class="btn btn-danger mb-3 " id="btnCancelar"><i class="fas fa-window-close"></i></button> --}}
</div>

<div class="row ">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center ">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4>Permisos</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de asignacion de permisos de acceso:</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-5">
                            <label for="">Accesos:</label>
                            <select name="tags[]" id="permisos" class="form-control select2">
                                {{-- <option disabled>DASHBOARD</option>
                                <option value="Dashboard">Dashboard</option>
                                <option  disabled>_______________________________________________________</option> --}}
                                <option disabled>USUARIOS</option>
                                <option value="Usuarios">Usuario</option>
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
                                <option value="Producto">Producto</option>
                                <option value="Producto Terminado">Producto Terminado</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>CORTE</option>
                                <option value="Composicion">Composicion</option>
                                <option value="Telas">Telas</option>
                                <option value="Rollos">Rollos</option>
                                <option value="Corte">Corte</option>
                                <option value="Lavanderia">Lavanderia</option>
                                <option value="Recepcion">Recepcion</option>
                                <option value="Almacen">Almacen</option>
                                <option value="Perdidas">Perdidas</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>ORDEN PEDIDO</option>
                                <option value="Orden Pedido">Orden Pedido</option>
                                <option value="Aprobacion">Aprobacion y redistribucion</option>
                                <option value="Ordenes Procesos">Ordenes Proceso</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>ORDENES EMPAQUE</option>
                                <option value="Imprimir Empaque">Imprimir Empaque</option>
                                <option value="Reportar Empaque">Reportar Empaque</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>FACTURACION</option>
                                <option value="Generar Factura">Generar Factura</option>
                                <option value="Nota Credito">Nota de Credito</option>
                                <option  disabled>_______________________________________________________</option>
                                <option disabled>Existencia</option>
                                <option value="Existencia">Existencia</option>
                            </select>
                        </div>
                        <div class="col-md-1"></div>
                        <div class="col-md-5">
                            <label for="">Usuario</label>
                            <select name="usuario" id="usuario" class="form-control select2">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10"></div>
                        <div class="col-md-2 mt-3">
                            <button type="button" id="btn-agregar" name="btn-agregar" class="btn btn-secondary"><i class="fas fa-plus-circle"></i> Agregar</button>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <br>
                    <div class="row mt-4">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th>Usuario</th>
                                    <th>Acceso</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
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
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4 > Listado de usuarios</h4>
    </div>
    <div class="card-body">

        <table id="users" class="table table-bordered table-hover datatables" style="width: 100%" >
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Nombre</th>
                    <th>Permiso</th>
                    <th>Rol</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th>Action</th>
                    <th>Nombre</th>
                    <th>Permiso</th>
                    <th>Rol</th>
                    <th>Email</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>



@include('adminlte/scripts')
<script src="{{asset('js/permiso.js')}}"></script>

<script>
    function mostrar(id_user) {
        $.post("user/" + id_user, function(data, status) {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btn-edit").show();
            $("#btnAgregar").hide();
            $("#btn-guardar").hide();
            $("#ver-contra").show();

            // console.log(data);
            $("#id").val(data.user.id);
            $("#name").val(data.user.name).attr('readonly', false);
            $("#surname").val(data.user.surname).attr('readonly', false);
            $("#edad").val(data.user.edad).attr('readonly', false);
            $("#telefono").val(data.user.telefono).attr('readonly', false);
            $("#celular").val(data.user.celular).attr('readonly', false);
            $("#direccion").val(data.user.direccion).attr('readonly', false);
            $("#email").val(data.user.email).attr('readonly', false);
            $("#role").val(data.user.role).attr('disabled', false);
        });
    }


    function ver(id_user) {
        $.post("user/" + id_user, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-guardar").hide();


            $("#name").val(data.user.name).attr('readonly', true);
            $("#ver-contra").hide();
            $("#surname").val(data.user.surname).attr('readonly', true);
            $("#edad").val(data.user.edad).attr('readonly', true);
            $("#telefono").val(data.user.telefono).attr('readonly', true);
            $("#celular").val(data.user.celular).attr('readonly', true);
            $("#direccion").val(data.user.direccion).attr('readonly', true);
            $("#email").val(data.user.email).attr('readonly', true);
            $("#role").val(data.user.role).attr('disabled', true);
        });
    }


    function eliminar(id_permiso){
        bootbox.confirm("¿Estas seguro de eliminarle este acceso a este usuario?", function(result){
            if(result){
                $.post("permiso/delete/" + id_permiso, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Acceso eliminado correctamente!!");
                    $("#users").DataTable().ajax.reload();
                })
            }
        })
    }

</script>

@endsection
