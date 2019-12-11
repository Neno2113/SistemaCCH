$(document).ready(function() {
    $("[data-mask]").inputmask();

    var tabla;
    var tabla_orden;

    //Funcion que se ejecuta al inicio
    function init() {
        // ordenfacturacionCod();
        listar();
        facturaCod();
        $("#empacado_listo").hide();
        $("#spiner").hide();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

    //funcion para limpiar el formulario(los inputs)
    function limpiar() {
        $("#tipo_factura").val("");
        $("#numeracion").val("");
        $("#itbis").val("");
        $("#descuento").val("");
        $("#fecha").val("");
        $("input[name='r1']:checked").val(0);
        $("#comprobante").hide();
           
    }

    function facturaCod() {
        $.ajax({
            url: "factura/lastdigit",
            type: "GET",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    var i = Number(datos.sec);
                    $("#sec").val(i);
                    i = (i + 0.01).toFixed(2).split('.').join("");
                    var referencia = i;
                
                    $("#no_factura").val(referencia);

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
    }

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

    
    $("input[name='r1']").change(function() {
        let val = $("input[name='r1']:checked").val();
        // console.log(val);

        if (val == 1) {
            $("#comprobante").show();
        }else if(val == 0){ 
            $("#comprobante").hide();
        }
    })

    //funcion que envia los datos del form al backend usando AJAX
    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var factura = {
            id: $("#id").val(),
            sec: $("#sec").val(),
            tipo_factura: $("#tipo_factura").val(),
            numeracion: $("#numeracion").val(),
            itbis: $("#itbis").val(),
            descuento: $("#descuento").val(),
            fecha: $("#fecha").val(),
            comprobante_fiscal: $("input[name='r1']:checked").val(),
            numero_comprobante: $("#numero_comprobante").val()
        };

        console.log(JSON.stringify(factura));

        $.ajax({
            url: "factura",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(factura),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Factura generada");
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
    function listar(){
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
                { data: "por_transporte", name: "orden_facturacion.por_transporte"},
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


      //funcion para listar en el Datatable
      function listarFactura() {
        tabla = $("#facturas").DataTable({
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
            ajax: "api/facturas",
            columns: [
             
                { data: "Opciones", orderable: false, searchable: false },
                { data: "name", name: "users.name"},
                { data: "no_factura", name: "factura.no_factura"},
                { data: "fecha", name: "factura.fecha"},
                { data: "descuento", name: "factura.descuento"},
                { data: "itbis", name: "factura.itbis"},
                { data: "no_orden_facturacion", name: "orden_facturacion.no_orden_facturacion"},
                { data: "tipo_factura", name: "factura.tipo_factura"},
                
            ],
            order: [[2, "desc"]],
            rowGroup: {
                dataSrc: "name"
            }
        });
    }

   

    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-guardar").hide();
          
            
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").hide();
            $("#AprobarPedido").hide();
            $("#btnImprimir").show();
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
    $("#btnImprimir").click(function(e){
        $("#listadoUsers").hide();
        $("#AprobarPedido").show();
        $("#btnImprimir").hide();
        $("#btnCancelar").show();
        $("#facturas").DataTable().destroy();
        listarFactura();

    });

    init();
});
