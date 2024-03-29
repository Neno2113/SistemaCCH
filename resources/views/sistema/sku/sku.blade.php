@extends('adminlte.layout')

@section('seccion', 'Sku')

@section('title', 'SKU')

@section('content')

<div class="container">
    <div class="row mt-3 ml-3">

        <button class="btn btn-danger mb-3" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i>
            Cancelar</button>
    </div>

    @if(Session::has('msg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong class="d-flex justify-content-center">{{Session::get('msg')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-dark">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
                {{-- <h4>Importacion de SKU</h4> --}}
            </div>
            <div class="card-body">
                <form action="/sistemaCCH/public/text-read" method="POST" enctype="multipart/form-data" id="formulario"
                    class="form-group carta panel-body">
                    @csrf
                    <h5>Importar SKUs</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-12 d-flex justify-content-center">
                            <h5></h5>
                        </div>
                        <div class="col-md-12 d-flex justify-content-center mt-2">
                            <input type="file" name="sku" id="" class="form control">
                        </div>
                    </div>
            </div>
            <div class="card-footer text-muted d-flex justify-content-center">
                <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-primary mt-4">
            </div>
            </form>
        </div>
    </div>
</div>

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Sku')->where('agregar', 1)->first() )
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-plus"></i> Agregar</button>
                @endif
                <h4 class="text-white text-center">Listado de skus</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        <div class="container" id="listadoUsers">
            @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Sku')->where('ver', 1)->first())
            <table id="skus" class="table table-striped table-bordered datatables">
                <thead>
                    <tr>
                        <th></th>
                        <th>Opcion</th>
                        <th>SKU</th>
                        <th>Producto</th>
                        <th>Talla</th>

                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <th></th>
                        <th>Opcion</th>
                        <th>SKU</th>
                        <th>Producto</th>
                        <th>Talla</th>
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
    </div>



    @include('adminlte/scripts')
    <script src="{{asset('js/sku/sku.js')}}"></script>

    <script>
        function mostrar(id_composition) {
        $.post("composition/" + id_composition, function(data, status) {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();

            // console.log(data);
            $("#id").val(data.composition.id);
            $("#codigo_composicion").val(data.composition.codigo_composicion);
            $("#nombre_composicion").val(data.composition.nombre_composicion);

        });
    }

    function eliminar(id_composition){
        bootbox.confirm("¿Estas seguro de eliminar esta composicion?", function(result){
            if(result){
                $.post("composition/delete/" + id_composition, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Composicion eliminada correctamente");
                    $("#compositions").DataTable().ajax.reload();
                })
            }
        })
    }

    </script>



    @endsection
