$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#formulario").validate({
        rules: {
            codigo_composicion: {
                required: true,
                minlength: 1
            },
            nombre_composicion: {
                required: true,
                minlength: 1
            },
          
        },
        messages: {
            codigo_composicion: {
                required: "Introduzca el codigo de composicion",
                minlength: "Debe contener al menos 1 letra"
            },
            nombre_composicion: {
                required: "Introduzca el nombre de composicion",
                minlength: "Debe contener al menos 1 letra"
            }
        }
    })
   

    var tabla

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

    function limpiar() {
        $("#referencia").val("");
        $("#precio_usd").val("");
        $("#tipo_tela").val("");
        $("#ancho_cortable").val("");
        $("#peso").val("");
        $("#elasticidad_trama").val("");
        $("#encogimiento_trama").val("");
        $("#elasticidad_urdimbre").val("");
        $("#encogimiento_urdimbre").val("");
        $("#suplidores").val("").trigger("change");
        $("#compositions").val("").trigger("change");
        $("#compositions_2").val("").trigger("change");
        $("#compositions_3").val("").trigger("change");
        $("#compositions_4").val("").trigger("change");
        $("#compositions_5").val("").trigger("change");
        $("#porcentaje_mat_1").val("");
        $("#porcentaje_mat_2").val("");
        $("#porcentaje_mat_3").val("");
        $("#porcentaje_mat_4").val("");
        $("#porcentaje_mat_5").val("");
    }

 

    $("#btn-guardar").click(function(e){
        e.preventDefault();
        
        var cloth = {
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
            url: "cloth",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(cloth),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se registro la tela correctamente");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    function listar() {
        tabla = $("#cloths").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/cloths",
            columns: [
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "id", name: 'tela.id' },
                { data: "nombre", name: "suplidor.nombre" },
                { data: "precio_usd", name: "tela.precio_usd" },
                { data: "tipo_tela", name: "tela.tipo_tela" },
                { data: "peso", name: "tela.peso" },
                { data: "ancho_cortable", name: "tela.ancho_cortable" },
                { data: "elasticidad_trama", name: "tela.elasticidad_trama" },
                { data: "elasticidad_urdimbre", name: "tela.elasticidad_urdimbre" },
                { data: "encogimiento_trama", name: "tela.encogimiento_trama" },
                { data: "encogimiento_urdimbre", name: "tela.encogimiento_urdimbre" },
                { data: "composicion", name: "tela.composicion" },
                { data: "composicion_2", name: "tela.composicion_2" },
                { data: "composicion_3", name: "tela.composicion_3" },
                { data: "composicion_4", name: "tela.composicion_4" },
                { data: "composicion_5", name: "tela.composicion_5" },
              
            ],
            order: [[2, 'asc']],
            rowGroup: {
                dataSrc: 'nombre'
            }
        });
    }
    setInterval(function(){
      tabla.ajax.reload();
    }, 30000)

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
        }
    }

    $("#btnAgregar").click(function(e) {
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        mostrarForm(false);
    });
  

    init();
});
