@extends('adminlte.layout')

@section('seccion', 'Producto')

@section('title', 'Articulo')

@section('content')

<div class="row ">
    <div class="col-12 ">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                <h4 class="">Producto Articulos</h4>
            </div>
            <div class="card-body">
                <h5>Formulario de creacion de productos</h5>
                <hr>
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <div class="row">
                        <input type="hidden" name="articulo" id="articulo">
                        <div class="col-md-4">
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control text-center">
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion">
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-4">
                            <select name="tipo_articulo" id="tipo_articulo" class="form-control">
                                <option selected disabled>Tipo de articulo</option>
                                <option >Material</option>
                                <option >Tela</option>
                                <option >Hilos</option>
                                <option >Otros</option>

                            </select>
                            <label for="" class="label"></label>
                        </div>
                    </div>

            </div>
            <div class="card-footer  text-muted">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                <h4 class="text-white text-center">Listado de productos</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        <table id="products" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Nombre </th>
                    <th>Descripcion</th>
                    <th>Tipo Articulo</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Nombre </th>
                    <th>Descripcion</th>
                    <th>Tipo Articulo</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
</div>




@include('adminlte/scripts')
<script src="{{asset('js/formulario.js')}}"></script>
<script src="{{asset('js/producto/articulo.js')}}"></script>



@endsection
