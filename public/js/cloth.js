$(document).ready(function() {
    $("[data-mask]").inputmask();

    var total_global;

    $("#formulario").validate({
        rules: {
            referencia: {
                required: true,
                minlength: 3
            },
            tipo_tela: {
                required: true
            },
            composiciones: {
                required: true
            },
            porcentaje_mat_1: {
                required: true
            }

        },
        messages: {
            referencia: {
                required: "Este campo es obligatorio",
                minlength: "Este campo debe tener al menos 3 caracteres"
            },
            tipo_tela: {
                required: "**Este campo es obligatorio**"
            },
            composiciones: {
                required: "**Este campo es obligatorio**"
            },
            porcentaje_mat_1: {
                required: "**Este campo es obligatorio**"
            }
        }
    })


    var tabla

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
        suplidores();


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
                                id: item.nombre_composicion
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
                                id: item.nombre_composicion
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
                                id: item.nombre_composicion
                            }
                        })
                    };
                },
                cache: true
            }
        })


    }

    $("#referencia").keyup(function(){
        let val =  $("#referencia").val();
        $("#referencia").val(val.toUpperCase());
    });

    function suplidores (){

        $.ajax({
            url: "suplidor/select",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.suplidor.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila =  "<option value="+datos.suplidor[i].id +">"+datos.suplidor[i].nombre+"</option>"

                        $("#suplidores").append(fila);
                    }
                    $("#suplidores").select2();

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
    }

    function limpiar() {
        $("#referencia").val("").attr('readonly', false);
        $("#precio_usd").val("").attr('readonly', false);
        $("#tipo_tela").val("").attr('readonly', false);;
        $("#ancho_cortable").val("").attr('readonly', false);;
        $("#peso").val("").attr('readonly', false);;
        $("#elasticidad_trama").val("").attr('readonly', false);
        $("#encogimiento_trama").val("").attr('readonly', false);
        $("#elasticidad_urdimbre").val("").attr('readonly', false);
        $("#encogimiento_urdimbre").val("").attr('readonly', false);
        $("#suplidores").val("").trigger("change");
        $("#compositions").val("").trigger("change");
        $("#compositions_2").val("").trigger("change");
        $("#compositions_3").val("").trigger("change");
        $("#compositions_4").val("").trigger("change");
        $("#compositions_5").val("").trigger("change");
        $("#porcentaje_mat_1").val("").attr('readonly', false);
        $("#porcentaje_mat_2").val("").attr('readonly', false);
        $("#porcentaje_mat_3").val("").attr('readonly', false);
        $("#porcentaje_mat_4").val("").attr('readonly', false);
        $("#porcentaje_mat_5").val("").attr('readonly', false);
        $("#porcentaje_mat_total").val("");
    }



    $("#btn-guardar").click(function(e){
        e.preventDefault();

        var cloth = {
            suplidor: $("#suplidores").val(),
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
            url: "cloth",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(cloth),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                    'Success',
                    'Tela creada correctamente.',
                    'success'
                    )
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function(datos) {
                console.log(datos.responseJSON.errors);
                let errores = datos.responseJSON.errors;

                Object.entries(errores).forEach(([key, val]) => {
                    bootbox.alert({
                        message:"<h4 class='invalid-feedback d-block'>"+val+"</h4>",
                        size: 'small'
                    });
                });
            }
        });
    });

    function listar() {
        tabla = $("#cloths").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/cloths",
            dom: 'Bfrtip',
            iDisplayLength: 5,
            buttons: [
                'pageLength',
                'copyHtml5',
                 {
                    extend: 'excelHtml5',
                    autoFilter: true,
                    sheetName: 'Exported data'
                },
                'csvHtml5',
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                }
                ],
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Ver", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "referencia", name: 'tela.referencia' },
                { data: "nombre", name: "suplidor.nombre" },
                { data: "tipo_tela", name: "tela.tipo_tela" },
                { data: "peso", name: "tela.peso" },
                // { data: "composicion", name: "tela.composicion" },
                // { data: "composicion_2", name: "tela.composicion_2" },
                // { data: "composicion_3", name: "tela.composicion_3" },
                // { data: "composicion_4", name: "tela.composicion_4" },
                // { data: "composicion_5", name: "tela.composicion_5" },

            ],
            order: [[2, 'asc']],
            rowGroup: {
                dataSrc: 'nombre'
            }
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
                    Swal.fire(
                    'Success',
                    'Tela actualizada correctamente.',
                    'success'
                    )
                    limpiar();
                    tabla.ajax.reload();
                    $("#id").val("");
                    $("#listadoUsers").show();
                    $("#registroForm").hide();
                    $("#btnCancelar").hide();
                    $("#btn-edit").hide();
                    $("#btn-guardar").show();
                    $("#btnAgregar").show();

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function(datos) {
                console.log(datos.responseJSON.errors);
                let errores = datos.responseJSON.errors;

                Object.entries(errores).forEach(([key, val]) => {
                    bootbox.alert({
                        message:"<h4 class='invalid-feedback d-block'>"+val+"</h4>",
                        size: 'small'
                    });
                });
            }
        });

    });



    $("#porcentaje_mat_1").keyup(function(){
        let porcentaje = $("#porcentaje_mat_1").val();
        $("#porcentaje_mat_total").val(porcentaje+"%");
        let total = porcentaje;
        if(total == 99.99){
            $("#btn-guardar").attr("disabled", false);
            $("#btn-composicion").removeClass("btn-secondary").addClass("btn-success");
        }else{
            $("#btn-guardar").attr("disabled", true);
        }
    })

    $("#porcentaje_mat_2").keyup(function(){
        let porcentaje = parseFloat($("#porcentaje_mat_1").val());
        let porcentaje_2 = parseFloat($("#porcentaje_mat_2").val());
        let total = porcentaje + porcentaje_2;
        $("#porcentaje_mat_total").val(total+"%");

        total_global = total;
        if(total == 100){
            $("#btn-guardar").attr("disabled", false);
            $("#btn-composicion").removeClass("btn-secondary").addClass("btn-success");
        }else{
            $("#btn-guardar").attr("disabled", true);
        }
    })

    $("#porcentaje_mat_3").keyup(function(){
        let porcentaje = parseFloat($("#porcentaje_mat_1").val());
        let porcentaje_2 = parseFloat($("#porcentaje_mat_2").val());
        let porcentaje_3 = parseFloat($("#porcentaje_mat_3").val());
        let total = porcentaje + porcentaje_2 + porcentaje_3;
        $("#porcentaje_mat_total").val(total+ "%");

        total_global = total;
        if(total ==  100){
            $("#btn-guardar").attr("disabled", false);
            $("#btn-composicion").removeClass("btn-secondary").addClass("btn-success");
        }else{
            $("#btn-guardar").attr("disabled", true);
        }
    })

    $("#porcentaje_mat_4").keyup(function(){
        let porcentaje = parseFloat($("#porcentaje_mat_1").val());
        let porcentaje_2 = parseFloat($("#porcentaje_mat_2").val());
        let porcentaje_3 = parseFloat($("#porcentaje_mat_3").val());
        let porcentaje_4 = parseFloat($("#porcentaje_mat_4").val());
        let total = porcentaje + porcentaje_2 + porcentaje_3 + porcentaje_4;
        $("#porcentaje_mat_total").val(total +"%");

        total_global = total;
        if(total ==  100){
            $("#btn-guardar").attr("disabled", false);
            $("#btn-composicion").removeClass("btn-secondary").addClass("btn-success");
        }else{
            $("#btn-guardar").attr("disabled", true);
        }
    })

    $("#porcentaje_mat_5").keyup(function(){
        let porcentaje = parseFloat($("#porcentaje_mat_1").val());
        let porcentaje_2 = parseFloat($("#porcentaje_mat_2").val());
        let porcentaje_3 = parseFloat($("#porcentaje_mat_3").val());
        let porcentaje_4 = parseFloat($("#porcentaje_mat_4").val());
        let porcentaje_5 = parseFloat($("#porcentaje_mat_5").val());
        let total = porcentaje + porcentaje_2 + porcentaje_3 + porcentaje_4 + porcentaje_5;
        $("#porcentaje_mat_total").val(total+"%");

        total_global = total;
        if(total ==  100){
            $("#btn-guardar").attr("disabled", false);
            $("#btn-composicion").removeClass("btn-secondary").addClass("btn-success");
        }else{
            $("#btn-guardar").attr("disabled", true);
        }
    })


    $("#btn-close").click(function(){
        // console.log(total_global);

        if(total_global <  99.99){
            bootbox.alert({
                message:
                    "<h4 class='invalid-feedback d-block'>"+
                    "El total a guardar debe ser igual a 100%."+"</h4>",
                size: "small"
            });
        }else if(total_global > 100){
            bootbox.alert({
                message:
                    "<h4 class='invalid-feedback d-block'>"+
                    "El total a guardar debe ser igual a 100%."+"</h4>",
                size: "small"
            });
        }
    });


    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#btn-guardar").attr("disabled", true);
        }
    }

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        mostrarForm(true);
        $("#compo").show();
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        mostrarForm(false);
    });


    init();
});

function mostrar(id_cloth) {
    $.post("cloth/" + id_cloth, function(data, status) {
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").show();
        $("#btn-guardar").hide();
        $("#compo").hide();
        // console.log(data.tela.suplidor.nombre);

        $("#id").val(data.tela.id);
        $("#referencia").val(data.tela.referencia).attr('readonly', false);
        $("#suplidores").find('option[value='+data.suplidor.id+']').attr('selected', 'selected').trigger("change");
        // $("#suplidores").select2(data.suplidor.nombre).trigger("change");
        // $("#suplidores").select2(data.suplidor, {id:data.suplidor.id, item:data.suplidor.nombre}).trigger("change");
        $("#precio_usd").val(data.tela.precio_usd).attr('readonly', false);
        $("#tipo_tela").val(data.tela.tipo_tela).attr('disabled', false);
        $("#ancho_cortable").val(data.tela.ancho_cortable).attr('readonly', false);
        $("#peso").val(data.tela.peso).attr('readonly', false);
        $("#elasticidad_trama").val(data.tela.elasticidad_trama).attr('readonly', false);
        $("#elasticidad_urdimbre").val(data.tela.elasticidad_urdimbre).attr('readonly', false);
        $("#encogimiento_trama").val(data.tela.encogimiento_trama).attr('readonly', false);
        $("#encogimiento_urdimbre").val(data.tela.encogimiento_urdimbre).attr('readonly', false);

    });
}

function ver(id_cloth) {
    $.post("cloth/" + id_cloth, function(data, status) {
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        // $("#btn-edit").show();
        $("#btn-guardar").hide();
        $("#compo").hide();

        $("#referencia").val(data.tela.referencia).attr('readonly', true);
        $("#precio_usd").val(data.tela.precio_usd).attr('readonly', true);
        $("#tipo_tela").val(data.tela.tipo_tela).attr('disabled', true);
        $("#ancho_cortable").val(data.tela.ancho_cortable).attr('readonly', true);
        $("#peso").val(data.tela.peso).attr('readonly', true);
        $("#elasticidad_trama").val(data.tela.elasticidad_trama).attr('readonly', true);
        $("#elasticidad_urdimbre").val(data.tela.elasticidad_urdimbre).attr('readonly', true);
        $("#encogimiento_trama").val(data.tela.encogimiento_trama).attr('readonly', true);
        $("#encogimiento_urdimbre").val(data.tela.encogimiento_urdimbre).attr('readonly', true);

    });
}



function eliminar(id_cloth){
    Swal.fire({
        title: '¿Esta seguro de eliminar esta tela?',
        text: "Va a eliminar la tela permanentemente!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("cloth/delete/" + id_cloth, function(){
                Swal.fire(
                'Eliminado!',
                'Tela eliminada correctamente.',
                'success'
                )
                $("#cloths").DataTable().ajax.reload();
            })
        }
      })
    // bootbox.confirm("¿Estas seguro de eliminar esta tela?", function(result){
    //     if(result){
    //         $.post("cloth/delete/" + id_cloth, function(){
    //             bootbox.alert("Composicion eliminada correctamente");
    //             $("#cloths").DataTable().ajax.reload();
    //         })
    //     }
    // })
}
