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
                            <label for="direccion_principal">Composiciones(*):</label>
                            <select name="tags[]" id="compositions" class="form-control select2" multiple="multiple">

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="referencia">Referencia(*):</label>
                            <input type="text" name="referencia" id="referencia" class="form-control">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="precio_usd">Precio USD:</label>
                            <input type="text" name="precio_usd" id="precio_usd" class="form-control">
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
    <table id="compositions" class="table table-striped table-bordered datatables">
        <thead>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Nombre composicion</th>

            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr>
                <th>Editar</th>
                <th>Eliminar</th>
                <th>ID</th>
                <th>Nombre composicion</th>
            </tr>
        </tfoot>
    </table>

</div>




@include('adminlte/scripts')
<script src="{{asset('js/cloth.js')}}"></script>

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

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var composition = {
            id: $("#id").val(),
            codigo_composicion: $("#codigo_composicion").val(),
            nombre_composicion: $("#nombre_composicion").val()
        };
     
        $.ajax({
            url: "composition/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(composition),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el usuario");
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

    function eliminar(id_composition){
        bootbox.confirm("¿Estas seguro de eliminar esta composicion?", function(result){
            if(result){
                $.post("composition/delete/" + id_composition, function(){
                    // bootbox.alert(e);
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

    $("#compositions").select2({
        placeholder: "Elige las composiciones...",
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