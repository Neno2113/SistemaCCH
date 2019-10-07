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
        tabla = $("#compositions").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/compositions",
            columns: [
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "id" },
                { data: "nombre_composicion" },
              
            ]
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
