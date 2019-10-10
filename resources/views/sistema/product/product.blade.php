@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-th-list"></i></button>
            <button class="btn btn-danger mb-3" id="btnCancelar"><i class="fas fa-window-close"></i></button>
        </div>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary">
                <h4>Producto</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de creacion de producto:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-3">
                            <label for="nombre_cliente" class="">Marca(*):</label>
                            <input type="hidden" name="id" id="id" value="">
                            <select name="marca" id="marca" class="form-control">
                                <option value="" selected>Elige una marca...</option>
                                <option value="L">Lavish</option>
                                <option value="M">Mythos</option>
                                <option value="P">Lavish Premium</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="" class="">Genero(*):</label>
                            <select name="genero" id="genero" class="form-control">
                                <option value="" selected>Elige un genero...</option>
                                <option value="1">Hombre</option>
                                <option value="2">Mujer</option>
                                <option value="3">Niño</option>
                                <option value="4">Niña</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="" class="">Tipo producto(*):</label>
                            <select name="tipo_producto" id="tipo_producto" class="form-control">
                                <option value="" selected>Elige un tipo...</option>
                                <option value="0">Pantalon</option>
                                <option value="1">Bermuda</option>
                                <option value="2">Capri</option>
                                <option value="3">Falda</option>
                                <option value="4">Short</option>
                                <option value="5">Jacket</option>
                                <option value="6">Camisa</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="" class="">Categoria(*):</label>
                            <select name="categoria" id="categoria" class="form-control">
                                <option value="">Elige una categoria</option>
                                <option value="0">Basico</option>
                                <option value="1">Semi-basico</option>
                                <option value="2">Moda</option>
                                <option value="3">T-plus</option>
                                <option value="4">Escolar</option>
                                <option value="5">Tubito</option>
                                <option value="6">Talla alto</option>
                                <option value="7">Super plus</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mt-3">
                            <label for="">Referencia:</label>
                            <input type="text" name="referencia" id="referencia" class="form-control">
                            <input type="hidden" name="" id="sec" value="" >
                        </div>
                        <div class="col-md-3 mt-5">
                            <button class="btn btn-secondary" id="btnGenerar">Generar</button>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <div class="row">
                        <div class="col-md-12">
                            <label for="" class="d-flex justify-content-center">Descripcion(*):</label>
                            <textarea name="descripcion" id="descripcion" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-secondary mt-4">
                        <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-secondary mt-4">
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="container" id="listadoUsers">
        <table id="rollos" class="table table-striped table-bordered datatables">
            <thead>
                <tr>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>ID</th>
                    <th>Nombre Suplidor</th>
                    <th>Referencia tela</th>
                    <th>Codigo</th>
                    <th>Tono</th>
                    <th>Fecha compra</th>
                    <th>No. factura compra</th>
                    <th>Longitud en yardas</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th>Editar</th>
                    <th>Eliminar</th>
                    <th>ID</th>
                    <th>Nombre Suplidor</th>
                    <th>Referencia tela</th>
                    <th>Codigo</th>
                    <th>Tono</th>
                    <th>Fecha compra</th>
                    <th>No. factura compra</th>
                    <th>Longitud en yardas</th>
                </tr>
            </tfoot>
        </table>

    </div> --}}

</div>


@include('adminlte/scripts')
<script src="{{asset('js/product.js')}}"></script>

<script>
    function mostrar(id_rollo) {
        $.post("rollo/" + id_rollo, function(data, status) {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();

            // console.log(data);
            // $("#suplidores").select2('val', data.rollo.suplidores.nombre);
            $("#id").val(data.rollo.id);
            $("#codigo_rollo").val(data.rollo.codigo_rollo);
            $("#num_tono").val(data.rollo.num_tono);
            $("#no_factura_compra").val(data.rollo.no_factura_compra);
            $("#fecha_compra").val(data.rollo.fecha_compra);
            $("#longitud_yarda").val(data.rollo.longitud_yarda);
        });
    }


    function eliminar(id_rollo){
        bootbox.confirm("¿Estas seguro de eliminar este rollo?", function(result){
            if(result){
                $.post("rollo/delete/" + id_rollo, function(){
                    // bootbox.alert(e);
                    bootbox.alert("Rollo eliminado correctamente!!");
                    $("#rollos").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection