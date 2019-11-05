$(document).ready(function() {
    $("[data-mask]").inputmask();

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
        $("#precio_lista").val("");
        $("#precio_venta_publico").val("");
        $("#descripcion_2").val("");
        $("#precio_lista_2").val("");
        $("#precio_venta_publico_2").val("");
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
                    $('#btn-sku').attr("disabled", false);
                    
                    if(genero == 3 || genero == 4){
                        $("#mostrarRef2").show();
                        $("#precios_2").show();
                        $("#descripcion_ref2").show();
                        $("#sec").val(e + 0.1);
                        e = (e + 0.2).toFixed(1).split('.').join("");
                        $("#referencia_2").val(marca + genero + tipo_producto + categoria+'-'+year+e);
                        
                    }else{
                        $("#mostrarRef2").hide();
                        $("#precios_2").hide();
                        $("#descripcion_ref2").hide();
                        $("#referencia_2").val("");
                        $("#descripcion_2").val("");
                        $("#precio_lista_2").val("");
                        $("#precio_venta_publico_2").val("");
                    }

                    $("#referencia").val(referencia);
                    $("#referencia_talla").val(referencia);

                    bootbox.alert(
                        "Referencia de producto generada exitosamente!!"
                    );

                    var referencias = {
                        referencia: $("#referencia").val(),
                        referencia_2: $("#referencia_2").val(),
                        sec: $("#sec").val()
                    };
            
                    $.ajax({
                        url: "product_ref",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(referencias),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                            //    console.log(datos);
                               $("#id_producto").val(datos.producto.id);
                                
                            } else {
                                bootbox.alert(
                                    "Se genero la referencia"
                                );
                            }
                        },
                        error: function() {
                            bootbox.alert(
                                "Ocurrio un error, al crear el producto"
                            );
                        }
                    });

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
            id: $("#id_producto").val(),
            descripcion: $("#descripcion").val(),
            descripcion_2: $("#descripcion_2").val(),
            precio_lista_2: $("#precio_lista_2").val(),
            precio_lista: $("#precio_lista").val(),
            precio_venta_publico: $("#precio_venta_publico").val(),
            precio_venta_publico_2: $("#precio_venta_publico_2").val(),
          
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
                    $("#referencia_talla").val("");
                    $("#btn-asignar").attr("disabled", false);
                    $("#btn-asignar2").attr("disabled", false);
                    $("#btn-asignar3").attr("disabled", false);
                    $("#btn-asignar4").attr("disabled", false);
                    $("#btn-asignar5").attr("disabled", false);
                    $("#btn-asignar6").attr("disabled", false);
                    $("#btn-asignar7").attr("disabled", false);
                    $("#btn-asignar8").attr("disabled", false);
                    $("#btn-asignar9").attr("disabled", false);
                    $("#btn-asignar10").attr("disabled", false);
                    $("#btn-asignar11").attr("disabled", false);
                    $("#btn-asignar12").attr("disabled", false);
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
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "name", name: "users.name" },
                { data: "referencia_producto", name: "producto.referencia_producto" },
                { data: "precio_lista", name: "producto.precio_lista" },
                { data: "precio_venta_publico", name: "producto.precio_venta_publico" },
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
            referencia_2: $("#referencia_2").val(),
            precio_lista: $("#precio_lista").val(),
            precio_lista_2: $("#precio_lista_2").val(),
            precio_venta_publico_2: $("#precio_venta_publico_2").val(),
            precio_venta_publico: $("#precio_venta_publico").val(),
            sec: $("#sec").val()
        };

        // console.log(product);

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
                    $("#sec").val("");

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
            $("#precios_2").hide();
            $("#descripcion_ref2").hide();
            $("#btn-sku").attr("disabled", true);
            $("#btn-edit").hide();
            $("#btn-guardar").show();
        }
    }

    $("#btnAgregar").click(function(e) {
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        mostrarForm(false);
    });

    $("#btn-asignar").click(function(e){
        e.preventDefault();
        
        var asignacion = {
            id: $("#id_producto").val(), 
            talla: $("#btn-asignar").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar").attr("disabled", true);
                } else {
                    bootbox.alert(
                        "Error"
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

    $("#btn-asignar2").click(function(e){
        e.preventDefault();
        
        var asignacion = {
            id: $("#id_producto").val(), 
            talla: $("#btn-asignar2").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar2").attr("disabled", true);
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

    $("#btn-asignar3").click(function(e){
        e.preventDefault();
        
        var asignacion = {
            id: $("#id_producto").val(), 
            talla: $("#btn-asignar3").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar3").attr("disabled", true);
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

    $("#btn-asignar4").click(function(e){
        e.preventDefault();
        
        var asignacion = {
            id: $("#id_producto").val(), 
            talla: $("#btn-asignar4").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar4").attr("disabled", true);
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

    $("#btn-asignar5").click(function(e){
        e.preventDefault();
        
        var asignacion = {
            id: $("#id_producto").val(), 
            talla: $("#btn-asignar5").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar5").attr("disabled", true);
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

    $("#btn-asignar6").click(function(e){
        e.preventDefault();

        let gen = $("#genero").val();
        
        if(gen == 3 || gen == 4){
            var asignacion = {
                id: $("#id_producto").val(), 
                talla: $("#btn-asignar6").val(),
                referencia: $("#referencia_2").val()
            };
        }else{
            var asignacion = {
                id: $("#id_producto").val(), 
                talla: $("#btn-asignar6").val(),
                referencia: $("#referencia").val()
            };
        }
        
        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar6").attr("disabled", true);
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

    $("#btn-asignar7").click(function(e){
        e.preventDefault();

        let gen = $("#genero").val();

        if(gen == 3 || gen == 4){
            var asignacion = {
                id: $("#id_producto").val(), 
                talla: $("#btn-asignar7").val(),
                referencia: $("#referencia_2").val()
            };
        }else{
            var asignacion = {
                id: $("#id_producto").val(), 
                talla: $("#btn-asignar7").val(),
                referencia: $("#referencia").val()
            };
        }
        
        // console.log(JSON.stringify(asignacion));
        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar7").attr("disabled", true);
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

    $("#btn-asignar8").click(function(e){
        e.preventDefault();

        let gen = $("#genero").val();
        
        if(gen == 3 || gen == 4){
            var asignacion = {
                id: $("#id_producto").val(), 
                talla: $("#btn-asignar8").val(),
                referencia: $("#referencia_2").val()
            };
        }else{
            var asignacion = {
                talla: $("#btn-asignar8").val(),
                referencia: $("#referencia").val()
            };
        }
      
        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar8").attr("disabled", true);
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

    $("#btn-asignar9").click(function(e){
        e.preventDefault();

        let gen = $("#genero").val();

        if(gen == 3 || gen == 4){
            var asignacion = {
                id: $("#id_producto").val(), 
                talla: $("#btn-asignar9").val(),
                referencia: $("#referencia_2").val()
            };
        }else{
            var asignacion = {
                id: $("#id_producto").val(), 
                talla: $("#btn-asignar9").val(),
                referencia: $("#referencia").val()
            };
        }
        
        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar9").attr("disabled", true);
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

    $("#btn-asignar10").click(function(e){
        e.preventDefault();
        
        var asignacion = {
            id: $("#id_producto").val(), 
            talla: $("#btn-asignar10").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar10").attr("disabled", true);
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
    $("#btn-asignar11").click(function(e){
        e.preventDefault();
        
        var asignacion = {
            id: $("#id_producto").val(), 
            talla: $("#btn-asignar11").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar11").attr("disabled", true);
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

    $("#btn-asignar12").click(function(e){
        e.preventDefault();
        
        var asignacion = {
            id: $("#id_producto").val(), 
            talla: $("#btn-asignar12").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar12").attr("disabled", true);
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

    $("#btn-asignar13").click(function(e){
        e.preventDefault();
        
        var asignacion = {
            id: $("#id_producto").val(), 
            talla: $("#btn-asignar13").val(),
            referencia: $("#referencia").val()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU asignado!!");
                    tabla.ajax.reload();
                    $("#btn-asignar13").attr("disabled", true);
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
  
    init();
});
