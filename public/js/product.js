$(document).ready(function() {

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

    function limpiar() {
        $("#marca").val("");
        $("#genero").val("");
        $("#tipo_producto").val("");
        $("#categoria").val("");
        $("#sec").val("");
        $("#referencia").val("");
        $("#descripcion").val("");
     
    }

    $("#btnGenerar").on('click', function(e){
        e.preventDefault();

        $.ajax({
            url: "product/lastdigit",
            type: "GET",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    var i = Number(datos.sec);
                    var e = Number(datos.sec);
                    $("#sec").val(i);
                    i = (i + 0.1).toFixed(1).split('.').join("");
                    var marca = $("#marca").val();
                    var genero = $("#genero").val();
                    var tipo_producto = $("#tipo_producto").val();
                    var categoria = $("#categoria").val();
                    var year = new Date().getFullYear().toString().substr(-2);
                    var referencia = marca + genero + tipo_producto + categoria+'-'+year+i;
                    
                    if(genero == 3 || genero == 4){
                        $("#mostrarRef2").show();
                        $("#sec").val(e + 0.1);
                        // console.log($("#sec").val());
                        e = (e + 0.2).toFixed(1).split('.').join("");
                        $("#referencia_2").val(marca + genero + tipo_producto + categoria+'-'+year+e);
                        
                    }else{
                        $("#mostrarRef2").hide();
                    }
                    $("#referencia").val(referencia);

                } else {
                    bootbox.alert(
                        "Ocurrio un error !!"
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

    $("#btn-guardar").click(function(e){
        e.preventDefault();
        
        var product = {
            referencia: $("#referencia").val(),
            referencia_2: $("#referencia_2").val(),
            descripcion: $("#descripcion").val(),
            sec: $("#sec").val()
        };

        $.ajax({
            url: "product",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(product),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se genero la referencia!!");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                } else {
                    bootbox.alert(
                        "Se genero la referencia"
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

    var tabla

    function listar() {
        tabla = $("#products").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/products",
            dom: 'Bfrtip',
            buttons: [
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
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "name", name: "users.name" },
                { data: "referencia_producto", name: "producto.referencia_producto" },
                { data: "descripcion", name: "producto.descripcion" }              
            ],
            order: [[2, 'asc']],
            rowGroup: {
                dataSrc: 'name'
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var product = {
            id: $("#id").val(),
            referencia: $("#referencia").val(),
            descripcion: $("#descripcion").val(),
            sec: $("#sec").val()
        };

        console.log(product);

        $.ajax({
            url: "product/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(product),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el usuario");
                    limpiar();
                    tabla.ajax.reload();
                    $("#id").val("");
                    $("#nombre_composicion").val("");
                    $("#listadoUsers").show();
                    $("#registroForm").hide();
                    $("#btnCancelar").hide();
                    $("#btn-edit").hide();
                    $("#btn-guardar").show();
                    $("#btnAgregar").show();

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion"
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
            $("#mostrarRef2").hide();
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
