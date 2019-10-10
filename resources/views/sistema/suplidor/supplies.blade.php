@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row">
        <button class="btn btn-primary btn-lg mb-2" id="btnAgregar"><i class="fas fa-plus"></i></button>
        <button class="btn btn-danger btn-lg mb-2" id="btnCancelar"><i class="fas fa-window-close"></i></button>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary">
                <h4>Suplidor</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de suplidores:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-4">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="nombre">Nombre(*):</label>
                            <input type="text" name="nombre" id="nombre" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="direccion">Direccion(*):</label>
                            <input type="text" name="direccion" id="direccion" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="contacto_suplidor">Contacto suplidor(*):</label>
                            <input type="text" name="contacto_suplidor" id="contacto_suplidor" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="telefono_1">Telefono 1(*):</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono_1" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="telefono_2">Telefono 2:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="telefono_2" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="celular">Celular:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="celular" class="form-control"
                                    data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="email">Email(*):</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="terminos_de_pago">Terminos de pago(*):</label>
                            <input type="text" name="terminos_de_pago" id="terminos_de_pago" class="form-control"
                                placeholder="Cantidad en dias para pagar">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="nota">Nota:</label>
                            <textarea name="nota" id="nota" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>

                    <input type="submit" value="Registrar" id="btn-guardar" class="btn btn-lg btn-info mt-4">
                    <input type="submit" value="Actualizar" id="btn-edit" class="btn btn-lg btn-info mt-4">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container" id="listadoUsers">
    <table id="suppliers" class="table table-striped table-bordered datatables" >
        <thead>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Contacto</th>
                <th>Telefono 1</th>
                <th>Telefono 2</th>
                <th>Celular</th>
                <th>Email</th>
                <th>Terminos de pago</th>
                <th>Nota</th>
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Contacto</th>
                <th>Telefono 1</th>
                <th>Telefono 2</th>
                <th>Celular</th>
                <th>Email</th>
                <th>Terminos de pago</th>
                <th>Nota</th>
            </tr>
        </tfoot>
    </table>
</div>




@include('adminlte/scripts')
<script src="{{asset('js/suplidor.js')}}"></script>
<script>
    function mostrar(id_supplier) {
            $.post("supplier/" + id_supplier, function(data, status) {
           
                $("#listadoUsers").hide();
                $("#registroForm").show();
                $("#btnCancelar").show();
                $("#btnAgregar").hide();
                $("#btn-edit").show();
                $("#btn-guardar").hide();
    
                
                $("#id").val(data.supplier.id);
                $("#nombre").val(data.supplier.nombre);
                $("#direccion").val(data.supplier.direccion);
                $("#contacto_suplidor").val(data.supplier.contacto_suplidor);
                $("#telefono_1").val(data.supplier.telefono_1);
                $("#telefono_2").val(data.supplier.telefono_2);
                $("#celular").val(data.supplier.celular);
                $("#email").val(data.supplier.email);
                $("#terminos_de_pago").val(data.supplier.terminos_de_pago);
                $("#nota").val(data.supplier.nota);
               
            });
        }
    
        function eliminar(id_supplier){
            bootbox.confirm("¿Estas seguro de eliminar este suplidor?", function(result){
                if(result){
                    $.post("supplier/delete/" + id_supplier, function(){
                        // bootbox.alert(e);
                        bootbox.alert("Suplidor eliminado!!");
                        $("#suppliers").DataTable().ajax.reload();
                    })
                }
            })
        }
    
</script>




@endsection