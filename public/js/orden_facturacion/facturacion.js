$(document).ready(function() {
    $("[data-mask]").inputmask();

    var tabla;
    var tabla_orden;
    var comprobante;

    //Funcion que se ejecuta al inicio
    function init() {
        // ordenfacturacionCod();
        listar();
        listarFactura();
        facturaCod();
        $("#empacado_listo").hide();
        $("#spiner").hide();
        mostrarForm(false);
        $("#btn-edit").hide();
        $("#itbis").val(18);
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


    $("#tipo_factura").on('change', function() {
        let val = $("#tipo_factura").val();
        console.log(val);

        if (val == "B01") {
            comprobante = 1;
            $("#comprobante").show();
        }else{
            comprobante = 0;
            $("#comprobante").hide();
        }
    });

    $("#fecha").click(function(){
        let fecha = new Date();
        let dia = fecha.getDate();
        let year = fecha.getFullYear();
        let month = fecha.getMonth();

        month = month + 1;

        $("#fecha").attr('min', year +"-"+ month+"-"+ dia);
    });


    //funcion que envia los datos del form al backend usando AJAX
    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        let discount = $("#descuento").val();
        if(discount == ""){
            discount = 0;
        }

        var factura = {
            id: $("#id").val(),
            sec: $("#sec").val(),
            tipo_factura: $("#tipo_factura").val(),
            numeracion: $("#numeracion").val(),
            itbis: $("#itbis").val(),
            descuento: discount,
            fecha: $("#fecha").val(),
            comprobante_fiscal: comprobante,
            numero_comprobante: $("#numero_comprobante").val(),
            nota: $("#nota").val()

        };

        // console.log(JSON.stringify(factura));

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
                    $("#orden_facturacion").DataTable().ajax.reload();
                    $("#facturas").DataTable().ajax.reload();

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
            processing: true,
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
                { data: "no_orden_empaque", name: "orden_empaque.no_orden_empaque"},
                { data: "fecha", name: "orden_facturacion.fecha"},
                { data: "por_transporte", name: "orden_facturacion.por_transporte"},
                { data: "fecha_empaque", name: "orden_empaque.fecha_empaque"},
                // { data: "no_orden_pedido", name: "orden_empaque.no_orden_pedido", orderable: false, searchable: false},
                // { data: "fecha_entrega", name: "orden_facturacion.fecha_entrega", orderable: false, searchable: false},
            ],
            order: [[3, "desc"]],
            // rowGroup: {
            //     dataSrc: "name"
            // }
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
                { data: "tipo_factura", name: "factura.tipo_factura"},
                { data: "status", name: "factura.status"},

            ],
            order: [[6, "asc"]],
            rowGroup: {
                dataSrc: "tipo_factura"
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
            $("#btn-opciones").hide();

        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").hide();
            $("#AprobarPedido").hide();
            $("#btnImprimir").show();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#btn-opciones").show();
        }
    }

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        $("#btn-generar").show();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
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
