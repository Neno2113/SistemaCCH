@extends('adminlte.layout')

@section('content')
<div class="container">
    <div class="row">
        <button class="btn btn-primary mb-3" id="btnAgregar">Create <i class="fas fa-plus"></i></button>
        <button class="btn btn-danger mb-3" id="btnCancelar">Cancel <i class="fas fa-window-close"></i></button>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center bg-secondary">
                <h4>Telas</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de telas:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-6">
                            <input type="hidden" name="id" id="id" value="">
                            <label for="nombre_cliente">Suplidor(*):</label>
                            <select name="tags[]" id="suplidores" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-secondary btn-block mt-4" data-toggle="modal"
                                data-target=".bd-composition-modal-lg">Agregar composiciones <i
                                    class="fas fa-fill-drip"></i></button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="referencia">Referencia(*):</label>
                            <input type="text" name="referencia" id="referencia" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="precio_usd">Precio USD por yarda:</label>
                            <input type="text" name="precio_usd" id="precio_usd" class="form-control"
                            data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="telefono_2">Tipo tela:</label>
                            <select name="tipo_tela" id="tipo_tela" class="form-control">
                                <option value=""></option>
                                <option value="Denim">Denim</option>
                                <option value="Twill">Twill</option>
                            </select>
                        </div>
                    </div>

                    <br>
                    <br>

                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="email_principal">Peso(*):</label>
                            <input type="text" name="peso" id="peso" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="celular_principal">Ancho cortable:</label>
                            <input type="text" id="ancho_cortable" class="form-control" data-inputmask='"mask": "99.99"'
                                data-mask>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="elasticidad_trama">Elasticidad en trama(*):</label>
                            <input type="text" id="elasticidad_trama" class="form-control"
                                data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                    </div>
                    <div class="row" id="radios">
                        <div class="col-md-4 mt-4">
                            <label for="elasticidad_urdimbre">Elasticidad en urdimbre(*):</label>
                            <input type="text" id="elasticidad_urdimbre" class="form-control"
                                data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="encogimiento_trama">Encogimiento en trama(*):</label>
                            <input type="text" id="encogimiento_trama" class="form-control"
                                data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label for="encogimiento_urdimbre">Encogimiento en urdimbre(*):</label>
                            <input type="text" id="encogimiento_urdimbre" class="form-control"
                                data-inputmask='"mask": "99.99"' data-mask>
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
    <table id="cloths" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Nombre Suplidor</th>
                <th>Precio USD/Yarda</th>
                <th>Tipo tela</th>
                <th>Peso</th>
                <th>Ancho cortable</th>
                <th>Elasticidad en trama</th>
                <th>Elasticidad en urdimbre</th>
                <th>Encogimiento en trama</th>
                <th>Encogimiento en urdimbre</th>
                <th>Composicion</th>
                <th>Composicion 2</th>
                <th>Composicion 3</th>
                <th>Composicion 4</th>
                <th>Composicion 5</th>

            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Nombre Suplidor</th>
                <th>Precio USD/Yarda</th>
                <th>Tipo tela</th>
                <th>Peso</th>
                <th>Ancho cortable</th>
                <th>Elasticidad en trama</th>
                <th>Elasticidad en urdimbre</th>
                <th>Encogimiento en trama</th>
                <th>Encogimiento en urdimbre</th>
                <th>Composicion</th>
                <th>Composicion 2</th>
                <th>Composicion 3</th>
                <th>Composicion 4</th>
                <th>Composicion 5</th>
            </tr>
        </tfoot>
    </table>

</div>


<!-- Modal -->

<div class="modal fade bd-composition-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Composiciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="compositionForm" class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Material No.1">Material No.1</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-2 ml-5">
                            <label for="Porcentaje Mat.No.1">Porcentaje Mat.No.1</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_1" id="porcentaje_mat_1" class="form-control"
                            data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Material No.2">Material No.2</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_2" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-2 ml-5">
                            <label for="Porcentaje Mat.No.2">Porcentaje Mat.No.2</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_2" id="porcentaje_mat_2" class="form-control"
                            data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Material No.3">Material No.3</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_3" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-2 ml-5">
                            <label for="Porcentaje Mat.No.3">Porcentaje Mat.No.3</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_3" id="porcentaje_mat_3" class="form-control"
                            data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Material No.4">Material No.4</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_4" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-2 ml-5">
                            <label for="Porcentaje Mat.No.4">Porcentaje Mat.No.4</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_4" id="porcentaje_mat_4" class="form-control"
                            data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label for="Material No.5">Material No.5</label>
                        </div>
                        <div class="col-md-4">
                            <select name="tags[]" id="composiciones_5" class="form-control select2">

                            </select>
                        </div>
                        <div class="col-md-2 ml-5">
                            <label for="Porcentaje Mat.No.5">Porcentaje Mat.No.5</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_5" id="porcentaje_mat_5" class="form-control"
                            data-inputmask='"mask": "99.99"' data-mask>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end mt-5 mr-1">
                        <div class="col-md-2 ml-5">
                            <label for="Total">Total</label>
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="porcentaje_mat_total" id="porcentaje_mat_total" class="form-control">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="btn-close" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>



@include('adminlte/scripts')
<script src="{{asset('js/cloth.js')}}"></script>

<script>
    function mostrar(id_cloth) {
        $.post("cloth/" + id_cloth, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();

            $("#id").val(data.tela.id);
            $("#referencia").val(data.tela.referencia);
            $("#precio_usd").val(data.tela.precio_usd);
            // $("#porcentaje_mat_1").val(data.tela.composicion);
            // $("#porcentaje_mat_2").val(data.tela.compsicion_2);
            // $("#porcentaje_mat_3").val(data.tela.compsicion_3);
            // $("#porcentaje_mat_4").val(data.tela.compsicion_4);
            // $("#porcentaje_mat_5").val(data.tela.compsicion_5);
            $("#tipo_tela").val(data.tela.tipo_tela);
            $("#ancho_cortable").val(data.tela.ancho_cortable);
            $("#peso").val(data.tela.peso);
            $("#elasticidad_trama").val(data.tela.elasticidad_trama);
            $("#elasticidad_urdimbre").val(data.tela.elasticidad_urdimbre);
            $("#encogimiento_trama").val(data.tela.encogimiento_trama);
            $("#encogimiento_urdimbre").val(data.tela.encogimiento_urdimbre);
           
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var cloth = {
            id: $("#id").val(),
            id_suplidor: $("#suplidores").val(),
            id_composiciones: $("#compositions").val(),
            referencia: $("#referencia").val(),
            precio_usd: $("#precio_usd").val(),
            tipo_tela: $("#tipo_tela").val(),
            ancho_cortable: $("#ancho_cortable").val(),
            peso: $("#peso").val(),
            elasticidad_trama: $("#elasticidad_trama").val(),
            elasticidad_urdimbre: $("#elasticidad_urdimbre").val(),
            encogimiento_trama: $("#encogimiento_trama").val(),
            encogimiento_urdimbre: $("#encogimiento_urdimbre").val(),
            composiciones: $("#composiciones").val(),
            composiciones_2: $("#composiciones_2").val(),
            composiciones_3: $("#composiciones_3").val(),
            composiciones_4: $("#composiciones_4").val(),
            composiciones_5: $("#composiciones_5").val(),
            porcentaje_mat_1: $("#porcentaje_mat_1").val(),
            porcentaje_mat_2: $("#porcentaje_mat_2").val(),
            porcentaje_mat_3: $("#porcentaje_mat_3").val(),
            porcentaje_mat_4: $("#porcentaje_mat_4").val(),
            porcentaje_mat_5: $("#porcentaje_mat_5").val()
        };

        // console.log(JSON.stringify(cloth));

        $.ajax({
            url: "cloth/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(cloth),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizo la tela correctamente");
                    $("#id").val("");
                    $("#codigo_composicion").val("");
                    $("#nombre_composicion").val("");
                    $("#listadoUsers").show();
                    $("#registroForm").hide();
                    $("#btnCancelar").hide();
                    $("#btn-edit").hide();
                    $("#btn-guardar").show();

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error!!"
                );
            }
        });
       
    });

    function eliminar(id_cloth){
        bootbox.confirm("¿Estas seguro de eliminar esta tela?", function(result){
            if(result){
                $.post("cloth/delete/" + id_cloth, function(){
                    bootbox.alert("Composicion eliminada correctamente");
                })
            }
        })
    }

    
    $("#suplidores").select2({
        placeholder: "Elige un suplidor...",
        ajax: {
            url: 'suplidores',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.nombre+' - '+ item.contacto_suplidor,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })

    $("#composiciones").select2({
        placeholder: "Busca una composicion",
        ajax: {
            url: 'compositions',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.nombre_composicion,
                            id: item.nombre_composicion
                        }
                    })
                };
            },
            cache: true
        }
    })

    $("#composiciones_2").select2({
        placeholder: "Busca una composicion",
        ajax: {
            url: 'compositions',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.nombre_composicion,
                            id: item.nombre_composicion
                        }
                    })
                };
            },
            cache: true
        }
    })

    $("#composiciones_3").select2({
        placeholder: "Busca una composicion",
        ajax: {
            url: 'compositions',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.nombre_composicion,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })

    $("#composiciones_4").select2({
        placeholder: "Busca una composicion",
        ajax: {
            url: 'compositions',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.nombre_composicion,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })

    $("#composiciones_5").select2({
        placeholder: "Busca una composicion",
        ajax: {
            url: 'compositions',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.nombre_composicion,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })

  

</script>



@endsection