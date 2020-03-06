$(document).ready(function() {
    $("[data-mask]").inputmask();



    var tabla

    //Funcion que se ejecuta al inicio
    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
        ncCod();


    }

    //funcion para limpiar el formulario(los inputs)
    function limpiar() {
        $("#factura_id").val("");
        $("#tipo_nota_credito").val("");
        $("#a").val("");
        $("#nc_id").val("");
        $("#ncf").val("");
        $("#b").val("");
        $("#c").val("");
        $("#d").val("");
        $("#e").val("");
        $("#f").val("");
        $("#g").val("");
        $("#h").val("");
        $("#i").val("");
        $("#j").val("");
        $("#k").val("");
        $("#l").val("");
    }

    function ncCod() {
        $("#sec").val("");
        $("#no_nota_credito").val("");

        $.ajax({
            url: "nc/lastdigit",
            type: "GET",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {

                    var i = Number(datos.sec);
                    $("#sec").val(i);
                    i = (i + 0.01).toFixed(2).split('.').join("");
                    var referencia = "NC"+'-'+i;

                    $("#no_nota_credito").val(referencia);

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

    $("#tipo_nota_credito").on('change', function(){


        var nc_ncf = $("#tipo_nota_credito").val();

        if(nc_ncf == "CB"){
            $("#comprobante").show();

            $("#ncf").focusout(function(){
                var nota_credito = {
                    sec: $("#sec").val(),
                    no_nota_credito: $("#no_nota_credito").val(),
                    factura_id: $("#factura_id").val(),
                    cliente: $("#cliente_id").val(),
                    tipo_nota_credito: $("#tipo_nota_credito").val(),
                    precio_lista_factura: $("#precio_lista_factura").val(),
                    ncf: $("#ncf").val()
                };

                $.ajax({
                    url: "nota-credito",
                    type: "POST",
                    dataType: "json",
                    data: JSON.stringify(nota_credito),
                    contentType: "application/json",
                    success: function(datos) {
                        if (datos.status == "success") {
                            $("#nc_id").val(datos.nota_credito.id);


                            $("#tipo_nota_credito").attr('disabled', true);
                            $("#detalle-factura").show();

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


        }else{
            var nota_credito = {
                sec: $("#sec").val(),
                no_nota_credito: $("#no_nota_credito").val(),
                factura_id: $("#factura_id").val(),
                cliente: $("#cliente_id").val(),
                tipo_nota_credito: $("#tipo_nota_credito").val(),
                precio_lista_factura: $("#precio_lista_factura").val()
            };

            $.ajax({
                url: "nota-credito",
                type: "POST",
                dataType: "json",
                data: JSON.stringify(nota_credito),
                contentType: "application/json",
                success: function(datos) {
                    if (datos.status == "success") {
                        $("#nc_id").val(datos.nota_credito.id);


                        $("#tipo_nota_credito").attr('disabled', true);
                        $("#detalle-factura").show();

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
        }

    });



    //funcion que envia los datos del form al backend usando AJAX
    $("#btn-guardar").click(function(e){
        e.preventDefault();
        ncCod();
        $("#facturas_listadas").DataTable().ajax.reload();
        Swal.fire(
            'Guardado!',
            'Nota de credito generada correctamente!',
            'success'
            )
        mostrarForm(false);


    });



    //funcion para listar en el Datatable
    function listar() {
        tabla = $("#facturas_listadas").DataTable({
            serverSide: true,
            autoWidth: false,
            responsive: true,
            iDisplayLength: 5,
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
            ajax: "api/nota_credito/facturas",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_factura", name: 'factura.no_factura' },
                { data: "cliente", name: 'factura.cliente',  orderable: false, searchable: false },
                { data: "sucursal", name: 'factura.sucursal',  orderable: false, searchable: false },
                // { data: "referencia_producto", name: 'producto.referencia_producto', orderable: false, searchable: false },
                { data: "fecha", name: 'factura.fecha' },
                { data: "fecha_impresion", name: 'factura.fecha_impresion' },
                // { data: "total", name: 'orden_facturacion_detalle.total' },
                { data: "por_transporte", name: 'orden_facturacion.por_transporte' },
            ],
            order: [[5, 'desc']],
            rowGroup: {
                dataSrc: 'cliente'
            }
        });
    }

    //funcion para editar
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var corte = {
            id: $("#id").val(),
            producto: $("#productos").val(),
            no_marcada: $("#no_marcada").val(),
            ancho_marcada: $("#ancho_marcada").val(),
            largo_marcada: $("#largo_marcada").val(),
            aprovechamiento: $("#aprovechamiento").val()
        };

        $.ajax({
            url: "corte/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el usuario");
                    limpiar();
                    $("#cortes").DataTable().ajax.reload();
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
            error: function() {
                bootbox.alert(
                    "Ocurrio un error!!"
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
            $("#edit-hide").attr("disabled", false);
            $("#detalle-factura").hide();
            $("#comprobante").hide();
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#btn-guardar").attr("disabled", true);
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#tipo_nota_credito").attr('disabled', false);
            $("#detalle-factura").show();
            $("#comprobante").show();
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


    init();
});


var longitud_global;
function mostrar(id_factura) {
    $("#disponibles").empty("");
    $.get("nota_credito/" + id_factura, function(data, status) {

        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").hide();
        $("#btn-guardar").show();
        $("#btn-generar").hide();
        $("#edit-hide").hide();
        $("#edit-hide2").hide();
        $("#detalle-factura").hide();
        $("#comprobante").hide();

        $("#factura_id").val(data.factura.id);
        $("#orden_facturacion_id").val(data.factura.id);
        $("#no_factura").val(data.factura.no_factura);
        $("#cliente").val(data.cliente.nombre_cliente);
        $("#cliente_id").val(data.cliente.id);
        $("#sucursal").val(data.sucursal.nombre_sucursal);
        $("#fecha_factura").val(data.factura.fecha);
        $("#fecha_impresion").val(data.factura.fecha_impresion);
        $("#precio_lista_factura").val(data.precio + " RD$")

        var longitud = data.detalle.length;
        longitud_global = data.detalle.length;
        for (let i = 0; i < longitud; i++) {

            var fila =  "<tr >"+
            "<td class='talla'> "+data.detalle[i].producto.referencia_producto+"</td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].a+" name='a' id='a"+data.detalle[i].id+"' value="+data.detalle[i].a+"></td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].b+" name='b' id='b"+data.detalle[i].id+"' value="+data.detalle[i].b+"></td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].c+" name='c' id='c"+data.detalle[i].id+"' value="+data.detalle[i].c+"></td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].d+" name='d' id='d"+data.detalle[i].id+"' value="+data.detalle[i].d+"></td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].e+" name='e' id='e"+data.detalle[i].id+"' value="+data.detalle[i].e+"></td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].f+" name='f' id='f"+data.detalle[i].id+"' value="+data.detalle[i].f+"></td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].g+" name='g' id='g"+data.detalle[i].id+"' value="+data.detalle[i].g+"></td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].h+" name='h' id='h"+data.detalle[i].id+"' value="+data.detalle[i].h+"></td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].i+" name='i' id='i"+data.detalle[i].id+"' value="+data.detalle[i].i+"></td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].j+" name='j' id='j"+data.detalle[i].id+"' value="+data.detalle[i].j+"></td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].k+" name='k' id='k"+data.detalle[i].id+"' value="+data.detalle[i].k+"></td>"+
            "<td ><input type='number' class='form-control  red' max="+data.detalle[i].l+" name='l' id='l"+data.detalle[i].id+"' value="+data.detalle[i].l+"></td>"+
            "<td ><button type='button' id='btn-detalle"+data.detalle[i].id+"' class='btn btn-info btn-sm' onclick='agregar("+data.detalle[i].id+")'><i class='far fa-save'></i></button></td>"+
            "</tr>";

            $("#disponibles").append(fila);
            //validacion de talla igual 0 desabilitar input correspondiente a esa talla
            (data.detalle[i].a <= 0 ) ? $("#a"+data.detalle[i].id).attr('disabled', true) : $("#a"+data.detalle[i].id).attr('disabled', false);
            (data.detalle[i].b <= 0 ) ? $("#b"+data.detalle[i].id).attr('disabled', true) : $("#b"+data.detalle[i].id).attr('disabled', false);
            (data.detalle[i].c <= 0 ) ? $("#c"+data.detalle[i].id).attr('disabled', true) : $("#c"+data.detalle[i].id).attr('disabled', false);
            (data.detalle[i].d <= 0 ) ? $("#d"+data.detalle[i].id).attr('disabled', true) : $("#d"+data.detalle[i].id).attr('disabled', false);
            (data.detalle[i].e <= 0 ) ? $("#e"+data.detalle[i].id).attr('disabled', true) : $("#e"+data.detalle[i].id).attr('disabled', false);
            (data.detalle[i].f <= 0 ) ? $("#f"+data.detalle[i].id).attr('disabled', true) : $("#f"+data.detalle[i].id).attr('disabled', false);
            (data.detalle[i].g <= 0 ) ? $("#g"+data.detalle[i].id).attr('disabled', true) : $("#g"+data.detalle[i].id).attr('disabled', false);
            (data.detalle[i].h <= 0 ) ? $("#h"+data.detalle[i].id).attr('disabled', true) : $("#h"+data.detalle[i].id).attr('disabled', false);
            (data.detalle[i].i <= 0 ) ? $("#i"+data.detalle[i].id).attr('disabled', true) : $("#i"+data.detalle[i].id).attr('disabled', false);
            (data.detalle[i].j <= 0 ) ? $("#j"+data.detalle[i].id).attr('disabled', true) : $("#j"+data.detalle[i].id).attr('disabled', false);
            (data.detalle[i].k <= 0 ) ? $("#k"+data.detalle[i].id).attr('disabled', true) : $("#k"+data.detalle[i].id).attr('disabled', false);
            (data.detalle[i].l <= 0 ) ? $("#l"+data.detalle[i].id).attr('disabled', true) : $("#l"+data.detalle[i].id).attr('disabled', false);
        }


    });
}

//  //funcion para listar en el Datatable
//  function listarFacturaDetalle(id) {
//    var tabla_orden = $("#invoice_detail").DataTable({
//         serverSide: true,
//         bFilter: false,
//         lengthChange: false,
//         bPaginate: false,
//         bInfo: false,
//         retrieve: true,
//         ajax: "api/fact_detalle/"+id,
//         columns: [
//             { data: "Opciones", orderable: false, searchable: false },
//             { data: "referencia_producto",name: "producto.referencia_producto"},
//             { data: "a", name: "orden_facturacion_detalle.a"},
//             { data: "b", name: "orden_facturacion_detalle.b" },
//             { data: "c", name: "orden_facturacion_detalle.c" },
//             { data: "d", name: "orden_facturacion_detalle.d"},
//             { data: "e", name: "orden_facturacion_detalle.e"},
//             { data: "f", name: "orden_facturacion_detalle.f"},
//             { data: "g", name: "orden_facturacion_detalle.g"},
//             { data: "h", name: "orden_facturacion_detalle.h"},
//             { data: "i", name: "orden_facturacion_detalle.i"},
//             { data: "j", name: "orden_facturacion_detalle.j"},
//             { data: "k", name: "orden_facturacion_detalle.k"},
//             { data: "l", name: "orden_facturacion_detalle.l"},
//             { data: "total", name: "orden_facturacion_detalle.total"}
//             // { data: "cantidad"},
//             // { data: "Opciones", orderable: false, searchable: false },

//         ],
//     });
// }


function eliminar(id_factura){
    bootbox.confirm("¿Estas seguro de eliminar la nota de credito?", function(result){
        if(result){
            $.post("nota-credito/delete/" + id_factura, function(data){
                bootbox.alert("Nota de credito <strong>"+ data.nota_credito.no_nota_credito+ "</strong> eliminada correctamente");
                $("#facturas_listadas").DataTable().ajax.reload();

            })
        }
    })
}

function agregar(factura_detella_id){
    Swal.fire({
        title: '¿Esta seguro de guardar?',
        text: "Va a agregarle detalle a la nota de credito!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, guardar'
      }).then((result) => {
        if (result.value) {
            accionAgregar(factura_detella_id);
        }
      })

}

function accionAgregar(factura_detella_id){

    var nota_credito_detalle = {
        nc_id: $("#nc_id").val(),
        a: $('#a'+factura_detella_id).val(),
        b: $("#b"+factura_detella_id).val(),
        c: $("#c"+factura_detella_id).val(),
        d: $("#d"+factura_detella_id).val(),
        e: $("#e"+factura_detella_id).val(),
        f: $("#f"+factura_detella_id).val(),
        g: $("#g"+factura_detella_id).val(),
        h: $("#h"+factura_detella_id).val(),
        i: $("#i"+factura_detella_id).val(),
        j: $("#j"+factura_detella_id).val(),
        k: $("#k"+factura_detella_id).val(),
        l: $("#l"+factura_detella_id).val()
    }
    // console.log(JSON.stringify(nota_credito_detalle));

    $.ajax({
        url: "nota-credito/detalle/"+factura_detella_id,
        type: "POST",
        dataType: "json",
        data: JSON.stringify(nota_credito_detalle),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                $("#btn-detalle"+ factura_detella_id).attr('disabled', true);

                $("#btn-guardar").attr("disabled", false);
                Swal.fire(
                'Guardado!',
                'Detalle guardado!',
                'success'
                )

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
}
