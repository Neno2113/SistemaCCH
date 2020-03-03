@extends('adminlte.layout')

@section('seccion', 'Utilidades')

@section('title', 'Rollos')

@section('content')
{{-- <div class="container"> --}}
<div class="row">
    <div class="col-md-6 mt-3 ml-3">
        <button class="btn btn-primary mb-3 " id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>

    </div>
</div>
<div class="row">
    <div class="col-12">


        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center  border-top">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4 class="font-weight-bold">Rollos</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de rollos</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="nombre_cliente"></label>
                            <select name="tags[]" id="suplidores" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="nombre_cliente"></label>
                            <select name="tags[]" id="cloths"  class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for=""></label>
                            <input type="date" placeholder="Fecha compra" name="fecha_compra" id="fecha_compra" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label for=""></label>
                            <input type="text" placeholder="Factura" name="no_factura_compra" id="no_factura_compra" placeholder="Numero" class="form-control">
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-md-4 mt-2">
                            <label for=""></label>
                            <input type="text" placeholder="Numero de rollo" name="codigo_rollo" id="codigo_rollo" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for=""></label>
                            <input type="text" placeholder="Tono" name="num_tono" id="num_tono" class="form-control">
                        </div>
                        <div class="col-md-4 mt-2">
                            <label for=""></label>
                            <input type="text" placeholder="Longitud en yarda" name="longitud_yarda" id="longitud_yarda" class="form-control">
                        </div>
                    </div>
            </div>
            <div class="card-footer  text-muted">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn  btn-info mt-2 float-right"><i class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn  btn-warning mt-2 float-right"><i class="far fa-edit fa-lg"></i> Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de rollos</h4>
    </div>
    <div class="card-body">
        <table id="rollos" class="table table-hover table-bordered datatables text-sm" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>Suplidor</th>
                    <th>Tela</th>
                    <th>Codigo</th>
                    <th>Tono</th>
                    <th>F. compra</th>
                    <th>No. Factura</th>
                    <th>Corte asig.</th>
                    <th>Yardas</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Actions</th>
                    <th>Suplidor</th>
                    <th>Tela</th>
                    <th>Codigo</th>
                    <th>Tono</th>
                    <th>F. compra</th>
                    <th>No. Factura</th>
                    <th>Corte asig.</th>
                    <th>Yardas</th>
                </tr>
            </tfoot>
        </table>
    </div>


</div>


{{-- <table id="table-data" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th>Suplidor</th>
                <th>Referencia</th>
                <th>Codigo</th>
                <th>Tono</th>
                <th>Fecha de compra</th>
                <th>Longitud en yarda</th>
                <th>Guardado</th>

            </tr>
        </thead>
        <tbody>
            <tr class="tr_clone">
                <th><select name="tags[]" id="suplidores" class="form-control select2 suplidor"></select></th>
                <th><select name="tags[]" id="cloths" class="form-control select2 suplidor"></select></th>
                <th><input type="text" name="" id="codigo_rollo" class="form-control"></th>
                <th><input type="text" name="" id="num_tono" class="form-control"></th>
                <th><input type="date" name="" id="fecha_compra" class="form-control"></th>
                <th><input type="text" name="" id="longitud_yarda" class="form-control"></th>
                <th><button  id="" class="btn btn-success btn-guardar">Guardar</button></th>

            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th>Suplidor</th>
                <th>Referencia</th>
                <th>Codigo</th>
                <th>Tono</th>
                <th>Fecha de compra</th>
                <th>Longitud en yarda</th>
                <th>Guardado</th>

            </tr>
        </tfoot>
    </table> --}}



{{-- </div> --}}


@include('adminlte/scripts')
<script src="{{asset('js/rollos.js')}}"></script>


@endsection
