$(document).ready(function() {
    $("[data-mask]").inputmask();

    var tabla;
    var tabla_orden;

    //Funcion que se ejecuta al inicio
    function init() {
        // ordenfacturacionCod();
        listar();
        $("#empacado_listo").hide();
        $("#spiner").hide();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

    //funcion para limpiar el formulario(los inputs)
    function limpiar() {
        $("#orden_pedido").val("");
        $("#cliente").val("");
        $("#sucursal").val("");
        $("#no_orden_facturacion").val("");
        $("#empaque_detalle")
            .DataTable()
            .destroy();
        $("#ordenEmpaqueSearch")
            .val("")
            .trigger("change");
    }

    // $("#btn-generar").click(function(e){
    //     e.preventDefault()
        
    //     $.ajax({
    //         url: "ordenfacturacion/lastdigit",
    //         type: "GET",
    //         dataType: "json",
    //         success: function(datos) {
    //             if (datos.status == "success") {
    //                 var i = Number(datos.sec);
    //                 $("#sec").val(i);
    //                 i = (i + 0.01)
    //                     .toFixed(2)
    //                     .split(".")
    //                     .join("");

    //                 var referencia = "OF-" + i;
    //                 $("#no_orden_facturacion").val(referencia);

    //                 var ordenFacturacion = {
    //                     sec: $("#sec").val(),
    //                     no_orden_facturacion: $("#no_orden_facturacion").val(),
    //                     empaque_id: $("#ordenEmpaqueSearch").val()
    //                 };

    //                 $.ajax({
    //                     url: "orden_facturacion",
    //                     type: "POST",
    //                     dataType: "json",
    //                     data: JSON.stringify(ordenFacturacion),
    //                     contentType: "application/json",
    //                     success: function(datos) {
    //                         if (datos.status == "success") {
    //                             bootbox.alert("Orden de facturacion <strong>"+ referencia + "</strong> creada exitosamente!!");
    //                             $("#id").val(datos.orden_facturacion.id);
                              
    //                         } else {
    //                             bootbox.alert(
    //                                 "Ocurrio un error durante la creacion de la composicion"
    //                             );
    //                         }
    //                     },
    //                     error: function() {
    //                         bootbox.alert(
    //                             "Ocurrio un error, trate rellenando los campos obligatorios(*)"
    //                         );
    //                     }
    //                 });


    //             } else {
    //                 bootbox.alert("Ocurrio un error !!");
    //             }
    //         },
    //         error: function() {
    //             bootbox.alert("Ocurrio un error!!");
    //         }
    //     });

    // })

    

    $("#ordenEmpaqueSearch").select2({
        placeholder: "Numero de orden de empaque",
        ajax: {
            url: "selectEmpaque",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text: item.no_orden_empaque,
                            id: item.id
                        };
                    })
                };
            },
            cache: true
        }
    });

    //funcion que envia los datos del form al backend usando AJAX
    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var ordenFacturacion = {
            sec: $("#sec").val(),
            no_orden_facturacion: $("#no_orden_facturacion").val(),
            empaque_id: $("#ordenEmpaqueSearch").val()
        };

        // console.log(JSON.stringify(ordenFacturacion));

        $.ajax({
            url: "orden_facturacion",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(ordenFacturacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Corte creado !!");
                    limpiar();
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

    //funcion para listar en el Datatable
    function listar() {
        tabla = $("#orden_facturacion").DataTable({
            serverSide: true,
            responsive: true,
            dom: "Bfrtip",
            buttons: [
                "pageLength",
                "copyHtml5",
                {
                    extend: "excelHtml5",
                    autoFilter: true,
                    sheetName: "Exported data"
                },
                "csvHtml5",
                {
                    extend: "pdfHtml5",
                    orientation: "landscape",
                    pageSize: "LEGAL"
                }
            ],
            ajax: "api/orden_facturacion",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "name", name: "users.name"},
                { data: "no_orden_facturacion", name: "orden_facturacion.no_orden_facturacion"},
                { data: "fecha", name: "orden_facturacion.fecha"},
                { data: "no_orden_empaque", name: "orden_empaque.no_orden_empaque"},
                { data: "fecha_empaque", name: "orden_empaque.fecha_empaque"},
                // { data: "no_orden_pedido", name: "orden_empaque.no_orden_pedido", orderable: false, searchable: false},
                // { data: "fecha_entrega", name: "orden_facturacion.fecha_entrega", orderable: false, searchable: false},
            ],
            order: [[2, "desc"]],
            rowGroup: {
                dataSrc: "name"
            }
        });
    }

  

    // $("#btn-buscar").click(function(e) {
    //     e.preventDefault();

    //     var empaque = {
    //         id: $("#ordenEmpaqueSearch").val()
    //     };

    //     $.ajax({
    //         url: "empaque/search",
    //         type: "POST",
    //         dataType: "json",
    //         data: JSON.stringify(empaque),
    //         contentType: "application/json",
    //         success: function(datos) {
    //             if (datos.status == "success") {
    //                 $("#empaque_detalle").DataTable().destroy();
                
    //                 listarEmpaqueDetalle(datos.orden_empaque.id);
    //                 $("#cliente").val(
    //                     datos.orden_pedido.cliente.nombre_cliente
    //                 );
    //                 $("#sucursal").val(
    //                     datos.orden_pedido.sucursal.nombre_sucursal
    //                 );
    //                 $("#orden_pedido").val(datos.orden_pedido.no_orden_pedido);
    //             } else {
    //                 bootbox.alert(
    //                     "Ocurrio un error durante la creacion de la composicion"
    //                 );
    //             }
    //         },
    //         error: function() {
    //             bootbox.alert(
    //                 "Ocurrio un error, trate rellenando los campos obligatorios(*)"
    //             );
    //         }
    //     });
    // });

 

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
        }
    }

    $("#btnAgregar").click(function(e) {
        $("#btn-generar").show();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        $("#btn-generar").attr("disabled", false);
        mostrarForm(false);
    });

    init();
});
