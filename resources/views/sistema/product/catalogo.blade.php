@extends('adminlte.layout')

@section('seccion', 'Producto')

@section('title', 'Catalogo')

@section('content')
{{-- <div class="container"> --}}
<div class="row">
    <div class="col-md-6 mt-3 ml-2 ">
        <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>

    </div>
</div>
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
                <h4 class="">Catalogo de cuentas</h4>
            </div>
            <div class="card-body">
                <h5>Formulario de creacion de catalogo de cuentas</h5>
                <hr>
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <div class="row">
                        <input type="hidden" name="catalogo" id="catalogo">
                        <div class="col-md-4">

                            <input type="text" name="codigo" id="codigo" placeholder="Codigo" class="form-control text-center"
                            data-inputmask='"mask": "99999-999"' data-mask>
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-4">
                            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion">
                            <label for="" class="label"></label>
                        </div>
                        <div class="col-md-4">
                            <select name="tipo_cuenta" id="tipo_cuenta" class="form-control">
                                <option selected disabled>Tipo de cuenta</option>
                                <option >Cash</option>
                                <option >Account Receivable</option>
                                <option >Other account receivable</option>
                                <option >Fixed Asset</option>
                                <option >Acumulated Depreciation</option>
                                <option>Other Assets</option>
                                <option>Account Payable</option>
                                <option>Other current liabilities</option>
                                <option>Equility-doesn't close</option>
                                <option>Equility-Retained Earnings</option>
                                <option>Income</option>
                                <option>Cost of sale</option>
                                <option>Expenses</option>
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
    <div class="card-header text-center">
        <h4>Listado de productos</h4>
    </div>
    <div class="card-body">
        <table id="products" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Codigo </th>
                    <th>Descripcion</th>
                    <th>Tipo Cuenta</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Editar</th>
                    <th>Codigo </th>
                    <th>Descripcion</th>
                    <th>Tipo Cuenta</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>
</div>




@include('adminlte/scripts')
<script src="{{asset('js/formulario.js')}}"></script>
<script src="{{asset('js/producto/catalogo.js')}}"></script>



@endsection
