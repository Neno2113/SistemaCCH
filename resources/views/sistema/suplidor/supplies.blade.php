@extends('adminlte.layout')

@section('seccion', 'Suplidores')

@section('title', 'Suplidor')

@section('content')
{{-- <div class="container"> --}}
<div class="row mt-3 ml-4">
    <button class="btn btn-primary  mb-2" id="btnAgregar"><i class="fas fa-th-list"></i></button>
    <button class="btn btn-danger  mb-2" id="btnCancelar"><i class="fas fa-window-close"></i></button>
</div>

<div class="row">
    <div class="col-12">


        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
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
                            <label for="rnc">RNC(*):</label>
                            <input type="text" name="rnc" id="rnc" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="contacto_suplidor">Contacto suplidor(*):</label>
                            <input type="text" name="contacto_suplidor" id="contacto_suplidor" class="form-control">
                        </div>
                    </div>
                    <div class="row mt-1">
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
                    <br>
                    <hr><br>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="email">Email(*):</label>
                            <input type="email" name="email" id="email" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="terminos_de_pago">Tipo suplidor(*):</label>
                            <select name="tipo_suplidor" id="tipo_suplidor" class="form-control">
                                <option value="">Elige un tipo...</option>
                                <option value="Material">Material</option>
                                <option value="Lavanderia">Lavanderia</option>
                                <option value="Servicio">Servicio</option>
                            </select>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="terminos_de_pago">Terminos de pago(*):</label>
                            <select name="terminos_pago" id="terminos_de_pago" class="form-control">
                                <option value="Contado">Al contado</option>
                                <option value="30 dias">30 dias</option>
                                <option value="60 dias">60 dias</option>
                                <option value="90 dias">90 dias</option>
                                <option value="120 dias">120 dias</option>
                            </select>

                        </div>
                    </div>
                    <div class="row mt-1">
                        <div class="col-md-6 mt-3">
                            <label for="direccion">Direccion(*):</label>
                            <textarea name="direccion" id="direccion" cols="30" rows="1"
                                class="form-control"></textarea>
                        </div>
                        <div class="col-md-6 mt-3">
                            <label for="nota">Nota:</label>
                            <textarea name="nota" id="nota" cols="30" rows="1" class="form-control"></textarea>
                        </div>
                    </div>
            </div>
            <div class="card-footer  d-flex justify-content-end ">
                <button type="submit" id="btn-guardar" class="btn btn-lg btn-info mt-4"><i class="far fa-save fa-lg"></i></button>
                <button type="submit" id="btn-edit" class="btn btn-lg btn-warning mt-4"><i class="far fa-edit fa-lg"></i></button>
            </div>
            </form>
        </div>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4>Listado de suplidores</h4>
    </div>
    <div class="card-body">
        <table id="suppliers" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>RNC</th>
                    <th>Contacto</th>
                    <th>Email</th>
                    <th>Terminos de pago</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Ver</th>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>RNC</th>
                    <th>Contacto</th>
                    <th>Email</th>
                    <th>Terminos de pago</th>
                </tr>
            </tfoot>
        </table>
    </div>

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
                $("#rnc").val(data.supplier.rnc);
                $("#direccion").val(data.supplier.direccion);
                $("#contacto_suplidor").val(data.supplier.contacto_suplidor);
                $("#telefono_1").val(data.supplier.telefono_1);
                $("#telefono_2").val(data.supplier.telefono_2);
                $("#celular").val(data.supplier.celular);
                $("#email").val(data.supplier.email);
                $("#tipo_suplidor").val(data.supplier.tipo_suplidor);
                $("#terminos_de_pago").val(data.supplier.terminos_de_pago);
                $("#nota").val(data.supplier.nota);
               
            });
        }

        function ver(id_supplier) {
            $.post("supplier/" + id_supplier, function(data, status) {
           
                $("#listadoUsers").hide();
                $("#registroForm").show();
                $("#btnCancelar").show();
                $("#btnAgregar").hide();
                // $("#btn-edit").show();
                $("#btn-guardar").hide();
                
                $("#id").val(data.supplier.id);
                $("#nombre").val(data.supplier.nombre).attr('readonly', true);
                $("#rnc").val(data.supplier.rnc).attr('readonly', true);
                $("#direccion").val(data.supplier.direccion).attr('readonly', true);
                $("#contacto_suplidor").val(data.supplier.contacto_suplidor).attr('readonly', true);
                $("#telefono_1").val(data.supplier.telefono_1).attr('readonly', true);
                $("#telefono_2").val(data.supplier.telefono_2).attr('readonly', true);
                $("#celular").val(data.supplier.celular).attr('readonly', true);
                $("#email").val(data.supplier.email).attr('readonly', true);
                $("#tipo_suplidor").val(data.supplier.tipo_suplidor).attr('disabled', true);
                $("#terminos_de_pago").val(data.supplier.terminos_de_pago).attr('disabled', true);
                $("#nota").val(data.supplier.nota).attr('readonly', true);
               
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