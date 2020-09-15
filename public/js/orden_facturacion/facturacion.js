var contado;
var fecha_vencimiento;
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
        $("#cantidad").val("");
        $("input[name='r1']:checked").val(0);
        $("#comprobante").hide();
        $("#clienteSearch").val("");
        // $("#sucursalSearch").val("");
        $("#productoSearch").val("");
        $("#fecha_m").val("");
        $("#fecha_vencimiento_m").val("");
        $("#tipo_factura_m").val("");
        $("#numeracion_m").val("");
        $("#itbis_m").val("");
        $("#descuento_m").val("");
        $("#nota_m").val("");
        $("#precio").val("");

    }

    $("#clienteSearch").select2({
        placeholder: "Nombre del cliente",
        ajax: {
            url: "selectCliente",
            dataType: "json",
            delay: 250,
            processResults: function(data) {
                return {
                    results: $.map(data, function(item) {
                        return {
                            text:
                                item.nombre_cliente +
                                " - " +
                                item.contacto_cliente_principal,
                            id: item.id
                        };

                    })
                };
            },
            cache: true
        }
    });

    function sucursal(){

        $("#sucursal").empty();
        var sucursal = {
            cliente: $("#cliente").val(),
        };

        $.ajax({
            url: "sucursal/select",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(sucursal),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.sucursal.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila ="<option value=" +datos.sucursal[i].id +">"+datos.sucursal[i].nombre_sucursal+"</option>";
                        $("#sucursalSearch").append(fila);
                    }
                    $("#sucursalSearch").select2();

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error"
                );
            }
        });
    }

    function productos(){

        $.ajax({
            url: "producto/normal",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.articulo.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila ="<option value=" +datos.articulo[i].id +">"+datos.articulo[i].nombre+"</option>";
                        $("#productoSearch").append(fila);
                    }
                    $("#productoSearch").select2();
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function() {
                console.log("No cargaron los productos");
            }
        });
    }

    $("#clienteSearch").change(function(){
        sucursal();
        productos();
    });

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
        $("#numeracion").val("");
        let val = $("#tipo_factura").val();


        var factura = {
            tipo: val
        };

        $.ajax({
            url: "secuencia/factura",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(factura),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#numeracion").val(datos.sec);
                    var cant = $("#numeracion").val();
                    cant = cant.split('_').join("");
                    let nume = "00000000";
                    var res = nume.concat(cant);

                    while(res.length > 8){
                       res = res.replace("0", "");

                    }
                    // console.log(res);
                    $("#numeracion").val(res);


                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function() {
                console.log("Ocurrio un error")
            }
        });

        if (val == "B01") {
            comprobante = 1;
            // $("#comprobante").show();
        }else{
            comprobante = 0;
            // $("#comprobante").hide();
        }
    });

    $("#fecha, #fecha_m").on('click', () =>{
        let fecha = new Date();
        let dia = fecha.getDate();
        let year = fecha.getFullYear();
        let month = fecha.getMonth();

        month = month + 1;
        var i = Number(month) / 100;
        i = (i).toFixed(2).split(".").join("");
        i = i.substr(1, 4);

        var e = Number(dia) / 100;
        e = (e).toFixed(2).split(".").join("");
        e = e.substr(1, 4);

        $("#fecha").attr('min', year +"-"+ i+"-"+ e);
        $("#fecha_m").attr('min', year +"-"+ i+"-"+ e);
        contado = Number(contado);
        e = Number(e);
        vencimiento = contado + e;
        var result = new Date();
        result.setDate(result.getDate() + vencimiento);
        let dia_ven = result.getDate();
        let year_ven = result.getFullYear();
        let month_ven = result.getMonth();
        month_ven = Number(month_ven) + 1;
        // console.log(dia_ven);
        // console.log(year_ven);
        // console.log(month_ven + 1);
        fecha_vencimiento = year_ven +"-"+month_ven+"-"+dia_ven;



    });

    $("#fecha").on('change', () => {
        $("#fecha_vencimiento").val(fecha_vencimiento);

    })


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
            fecha_vencimiento: $("#fecha_vencimiento").val(),
            comprobante_fiscal: comprobante,
            numero_comprobante: $("#numero_comprobante").val(),
            nota: $("#nota").val()

        };

        $.ajax({
            url: "factura",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(factura),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Success',
                        'Factura generada correctamente!',
                        'success'
                    )
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
            order: [[3, "desc"]],
            rowGroup: {
                dataSrc: "tipo_factura"
            }
        });
    }

    $("#btn-guardar_m").click(function(e) {
        e.preventDefault();

        let discount = $("#descuento_m").val();
        if(discount == ""){
            discount = 0;
        }

        var factura_manual = {
            sec: $("#sec").val(),
            tipo_factura: $("#tipo_factura_m").val(),
            numeracion: $("#numeracion_m").val(),
            itbis: $("#itbis_m").val(),
            descuento: discount,
            fecha: $("#fecha_m").val(),
            fecha_vencimiento: $("#fecha_vencimiento_m").val(),
            comprobante_fiscal: comprobante,
            nota: $("#nota_m").val(),
            cliente: $("#clienteSearch").val(),
            sucursal: $("#sucursalSearch").val(),
            producto: $("#productoSearch").val(),
            cantidad: $("#cantidad").val(),
            precio: $("#precio").val()

        };

        // console.log(JSON.stringify(factura_manual));

        $.ajax({
            url: "factura_manual",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(factura_manual),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Success',
                        'Factura generada correctamente!',
                        'success'
                    )
                    limpiar();
                    mostrarForm(false);
                    $("#orden_facturacion").DataTable().ajax.reload();
                    $("#facturas").DataTable().ajax.reload();
                    $("#detalle_manual").empty();

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

    $("#btn-edit").click(function(e) {
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
            fecha_vencimiento: $("#fecha_vencimiento").val(),
            comprobante_fiscal: comprobante,
            numero_comprobante: $("#numero_comprobante").val(),
            nota: $("#nota").val()

        };

        // console.log(JSON.stringify(factura));

        $.ajax({
            url: "factura/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(factura),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Success',
                        'Referencia actualizada correctamente!',
                        'success'
                    )

                    mostrarForm(false);
                    $("#orden_facturacion").DataTable().ajax.reload();
                    $("#facturas").DataTable().ajax.reload();
                    limpiar();
                    tabla.ajax.reload();

                } else {
                    bootbox.alert("Ocurrio un error durante la actualizacion");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    function agregarDetalle(){
        var detalle_manual = {
            producto: $("#productoSearch").val(),
            cantidad: $("#cantidad").val(),
            precio: $("#precio").val()
        };


        $.ajax({
            url: "manual_detalle",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(detalle_manual),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success"){
                    console.log(datos);
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        type: 'success',
                        title: 'Producto agregado correctamente'
                    })
                    $("#cantidad").val("");
                    $("#precio").val("");
                    $("#productoSearch").val("");


                    var fila =
                        '<tr id="fila'+datos.factura_detalle.id+'">' +
                        "<th id='a_corte' class='font-weight-normal'>" +
                        datos.factura_detalle.producto.nombre +
                        "</th>" +
                        "<th id='a_corte' class='font-weight-normal'>RD$" +
                        datos.factura_detalle.precio+
                        "</th>" +
                        "<th id='a_corte' class='font-weight-normal'>" +
                        datos.factura_detalle.cantidad +

                        "</tr>";

                    $("#detalle_manual").append(fila);

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
    }


    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").hide();
            $("#listadoFacturas").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-guardar").hide();
            $("#btn-opciones").hide();

        } else {
            $("#listadoUsers").show();
            $("#listadoFacturas").show();
            $("#registroForm").hide();
            $("#normal").hide();
            // $("#botones-imprimir").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#AprobarPedido").hide();
            $("#btnImprimir").show();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#btn_guardar_m").attr("disabled", true);
            $("#btn-opciones").show();
        }
    }

    $("#btn-agregar").click(function(e){
        e.preventDefault();
        agregarDetalle();
    });

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        $("#pantalones").hide();
        $("#normal").show();
        $("#botones-imprimir").hide();
        mostrarForm(true);

        // $("#btn-edit").hide();
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

function mostrar(id_orden) {
    $.get("orden_facturacion/" + id_orden, function(data, status) {
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        // $("#btn-edit").show();
        $("#btn-guardar").show();
        $("#btnImprimir").hide();
        $("#btn-opciones").hide();


        $("#id").val(data.orden_facturacion.id);
        $("#cliente").val(data.orden_pedido.cliente.nombre_cliente);
        $("#sucursal").val(data.orden_pedido.sucursal.nombre_sucursal);
        $("#fecha_entrega").val(data.orden_pedido.fecha_entrega);
        contado = data.orden_pedido.cliente.condiciones_credito;
        $("#facturacion_detalle").DataTable().destroy();
        listarOrdenDetalle(data.orden_facturacion.id);



    });
}

  //funcion para listar en el Datatable
  function listarOrdenDetalle(id) {
   var tabla_orden = $("#facturacion_detalle").DataTable({
        serverSide: true,
        bFilter: false,
        lengthChange: false,
        bPaginate: false,
        bInfo: false,
        retrieve: true,
        ajax: "api/factura_detalle/"+id,
        columns: [
            { data: "referencia_producto",name: "producto.referencia_producto"},
            { data: "a",name: "orden_pedido_detalle.a"},
            { data: "b", name: "orden_pedido_detalle.b" },
            { data: "c", name: "orden_pedido_detalle.c" },
            { data: "d", name: "orden_pedido_detalle.d"},
            { data: "e", name: "orden_pedido_detalle.e"},
            { data: "f", name: "orden_pedido_detalle.f"},
            { data: "g", name: "orden_pedido_detalle.g"},
            { data: "h", name: "orden_pedido_detalle.h"},
            { data: "i", name: "orden_pedido_detalle.i"},
            { data: "j", name: "orden_pedido_detalle.j"},
            { data: "k", name: "orden_pedido_detalle.k"},
            { data: "l", name: "orden_pedido_detalle.l"},
            { data: "total", name: "orden_pedido_detalle.total"},

        ],
    });
}

function addDays(days) {
    var result = new Date();
    result.setDate(result.getDate() + days);
    console.log(result);
    return result;
}


function edit(id) {
    $.get("factura-edit/" + id, function(data, status) {
        // data = JSON.parse(data);
        // $("#listadoUsers").hide();
        $("#listadoFacturas").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").show();
        $("#btn-guardar").hide();

        let numeracion = data.factura.no_factura.substring(3);

        $("#id").val(data.factura.id);
        $("#cliente").val(data.orden_pedido.cliente.nombre_cliente);
        $("#sucursal").val(data.orden_pedido.sucursal.nombre_sucursal);
        $("#fecha_entrega").val(data.orden_pedido.fecha_entrega);
        $("#tipo_factura").val(data.factura.tipo_factura);
        $("#numeracion").val(numeracion);
        $("#itbis").val(data.factura.itbis);
        $("#descuento").val(data.factura.descuento);
        $("#fecha").val(data.factura.fecha);
        $("#fecha_vencimiento").val(data.factura.fecha_vencimiento);
        $("#nota").val(data.factura.nota);

        $("#facturacion_detalle").DataTable().destroy();
        listarOrdenDetalle(data.orden_facturacion.id);

    });
}
