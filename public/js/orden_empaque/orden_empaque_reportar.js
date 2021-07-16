let orden_facturacion_id;
let orden_id;

$(document).ready(function() {
    $("[data-mask]").inputmask();

    var tabla;

    //Funcion que se ejecuta al inicio
    function init() {
        ordenPedidoCod();
        listar();
        $("#empacado_listo").hide();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

    //funcion para limpiar el formulario(los inputs)
    function limpiar() {
        $("#numero_corte").val("");
        $("#sec").val("");
        $("#productos")
            .val("")
            .trigger("change");
        $("#fecha_entrega").val("");
        $("#no_marcada").val("");
        $("#corte").val("");
        $("#ancho_marcada").val("");
        $("#largo_marcada").val("");
        $("#aprovechamiento").val("");
    }

    function ordenPedidoCod() {
        $.ajax({
            url: "corte/lastdigit",
            type: "GET",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    var i = Number(datos.sec);
                    $("#sec").val(i);
                    i = (i + 0.01)
                        .toFixed(2)
                        .split(".")
                        .join("");
                    var year = new Date().getFullYear().toString();
                    var referencia = year + "-" + i;

                    $("#numero_corte_gen").val(referencia);
                    $("#corte").val(referencia);
                } else {
                    bootbox.alert("Ocurrio un error !!");
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });
    }

    //funcion que envia los datos del form al backend usando AJAX
    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        $("#listar_OE").DataTable().ajax.reload();
        mostrarForm(false);
        
        Swal.fire(
        'Success!',
        'Orden empacada correctamente.',
        'success'
        )


    });

    // const save = () => {
    //     var ordenFacturacion = {
    //         empaque_id: $("#orden_empaque_id").val(),
    //         por_transporte: $("input[name='r1']:checked").val(),
    //     };

    //     $.ajax({
    //         url: "orden_facturacion",
    //         type: "POST",
    //         dataType: "json",
    //         data: JSON.stringify(ordenFacturacion),
    //         contentType: "application/json",
    //         success: function(datos) {
    //             if (datos.status == "success") {
    //                 $("#orden_facturacion_id").val(datos.orden_facturacion.id);
                  
                   


    //             } else if(datos.status == 'info') {
    //                 Swal.fire(
    //                     'Info!',
    //                     'Debe Registrar la cantidad de bultos.',
    //                     'info'
    //                 )
    //             }
    //         },
    //         error: function() {
    //             bootbox.alert(
    //                 "Ocurrio un error, trate rellenando los campos obligatorios(*)"
    //             );
    //         }
    //     });
    // }

    //funcion para listar en el Datatable
    function listar() {
        tabla = $("#listar_OE").DataTable({
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
            ajax: "api/ordenes_aprobacion_empaque",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_orden_pedido",name: "orden_pedido.no_orden_pedido", searchable: false },
                { data: "cliente", name: "cliente", orderable: false, searchable: false  },
                { data: "sucursal", name: "sucursal", orderable: false, searchable: false},
                { data: "total", name: "orden_pedido.total", searchable: false },
                { data: "impreso", name: "orden_pedido.impreso", searchable: false, orderable: false, },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" }
            ],
            order: [[2, "desc"]],
            // rowGroup: {
            //     dataSrc: "name"
            // }
        });
    }



    //funcion para editar
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var corte = {
            id: $("#id").val(),
            producto_id: $("#productos").val(),
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
                    $("#cortes")
                        .DataTable()
                        .ajax.reload();
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
                bootbox.alert("Ocurrio un error!!");
            }
        });
    });


    // function test(e){
    //     e.preventDefault();
    //     alert('Test');
    // }

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
            $("#btnAgregar").hide();
            $("#btn-edit").hide();
            // $("#btn-guardar").show().attr("disabled", true);
        }
    }

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        $("#btn-generar").show();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        mostrarForm(false);
    });

    init();
});

String.prototype.replaceAll = function (find, replace) {
    var str = this;
    return str.replace(new RegExp(find, 'g'), replace);
};

var orden_detalle;

function mostrar(id_orden) {
    $("#disponibles").empty("");
    $.get("orden_empaque/" + id_orden, function(data, status) {

        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $('#btn-completar').hide();
            // $("#btn-guardar").hide();
    
            $("#id").val(data.orden_empaque.id);
            $("#no_orden_pedido").val(data.orden_pedido.no_orden_pedido);
            $("#no_orden_empaque").val(data.orden_empaque.no_orden_empaque);
            $("#orden_empaque_id").val(data.orden_empaque.id);
            $("#cliente").val(data.cliente.nombre_cliente);
            $("#sucursal").val(data.sucursal.nombre_sucursal);
            $("#fecha_entrega").val(data.orden_pedido.fecha_entrega);
            $("#orden_detalle").DataTable().destroy();
            // listarOrdenDetalle(data.orden_pedido.id);
            orden_detalle = data.orden_detalle;
            orden_facturacion_id = data.orden_facturacion.id;
            orden_id = data.orden_empaque.orden_pedido_id;

            tablaDetalle(id_orden);
        }


 
    });
}

//funcion para listar en el Datatable
function listarOrdenDetalle(id) {
   var tabla_orden = $("#orden_detalle").DataTable({
        serverSide: true,
        bFilter: false,
        lengthChange: false,
        bPaginate: false,
        bInfo: false,
        retrieve: true,
        ajax: "api/orden_detalle/"+id,
        columns: [
            { data: "referencia_producto",name: "producto.referencia_producto"},
            { data: "a", name: "orden_pedido_detalle.a",  orderable: false, },
            { data: "b", name: "orden_pedido_detalle.b",  orderable: false,  },
            { data: "c", name: "orden_pedido_detalle.c",  orderable: false,  },
            { data: "d", name: "orden_pedido_detalle.d",  orderable: false, },
            { data: "e", name: "orden_pedido_detalle.e",  orderable: false, },
            { data: "f", name: "orden_pedido_detalle.f",  orderable: false, },
            { data: "g", name: "orden_pedido_detalle.g",  orderable: false, },
            { data: "h", name: "orden_pedido_detalle.h",  orderable: false, },
            { data: "i", name: "orden_pedido_detalle.i",  orderable: false, },
            { data: "j", name: "orden_pedido_detalle.j",  orderable: false, },
            { data: "k", name: "orden_pedido_detalle.k",  orderable: false, },
            { data: "l", name: "orden_pedido_detalle.l",  orderable: false, },
            { data: "total", name: "orden_pedido_detalle.total"},
            { data: "cantidad"},
            { data: "Opciones", orderable: false, searchable: false },

        ],
    });
}

function test(id){
    // console.log(id);
    var empaque = {
        id: $("#id").val(),
        cantidad: $("#cantidad"+id).val(),
        producto: $("#producto"+id).val(),
        facturacion_id: orden_facturacion_id,
        por_transporte: $("input[name='r1']:checked").val(),
        a: $("#a"+id).val(),
        b: $("#b"+id).val(),
        c: $("#c"+id).val(),
        d: $("#d"+id).val(),
        e: $("#e"+id).val(),
        f: $("#f"+id).val(),
        g: $("#g"+id).val(),
        h: $("#h"+id).val(),
        i: $("#i"+id).val(),
        j: $("#j"+id).val(),
        k: $("#k"+id).val(),
        l: $("#l"+id).val(),
        total: $("#total"+id).html()
    }

    // console.log($("#total"+id));
    $.ajax({
        url: "empaque_detalle/"+id,
        type: "POST",
        dataType: "json",
        data: JSON.stringify(empaque),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                // $("#btn-guardar").attr("href", 'empaque/facturar/'+datos.orden_empaque.orden_pedido_id);
                // console.log(datos);
                bootbox.alert("Referencia perteneciente a la orden empaque <strong>"+ datos.orden_empaque.no_orden_empaque+"</strong> ha sido empacada");
                $(".cantidad").val("");
                tablaDetalle(datos.orden.orden_pedido_id);

                var detalle = {
                    orden_facturacion_id: orden_facturacion_id,
                    detalle: datos.orden_empaque_detalle.id,
                    a: $("#a"+id).val(),
                    b: $("#b"+id).val(),
                    c: $("#c"+id).val(),
                    d: $("#d"+id).val(),
                    e: $("#e"+id).val(),
                    f: $("#f"+id).val(),
                    g: $("#g"+id).val(),
                    h: $("#h"+id).val(),
                    i: $("#i"+id).val(),
                    j: $("#j"+id).val(),
                    k: $("#k"+id).val(),
                    l: $("#l"+id).val(),
                }

                $.ajax({
                    url: "factura_detalle",
                    type: "POST",
                    dataType: "json",
                    data: JSON.stringify(detalle),
                    contentType: "application/json",
                    success: function(datos) {
                        if (datos.status == "success") {
                            // $("#btn-guardar").attr("disabled", false);
                            // $("#orden_detalle").DataTable().ajax.reload();


                        } else {
                            bootbox.alert(
                                "Ocurrio un error durante la actualizacion de la composicion"
                            );
                        }
                    },
                    error: function() {
                        bootbox.alert("Recuerde digitar la cantidad de bultos!!");
                    }
                });

               

            } else if(datos.status == 'mayor') {
                Swal.fire(
                    'Cuidado!',
                    'La cantidad digitada no puede ser mayor al total a empacar.',
                    'info'
                    )
            }
        },
        error: function() {
            Swal.fire(
                'Error!',
                'Recuerde digitar la cantidad de bultos!!.',
                'error'
                )
        }
    });

}


function redistribuir(id_orden){
    Swal.fire({
        title: '¿Esta seguro de redistribuir las tallas?',
        text: "Va a sortear la orden en caso de que sea detallada!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.get("orden_redistribuir/" + id_orden, function(){
                Swal.fire(
                'Success!',
                'Redistibucion completa.',
                'success'
                )
                $("#listar_OE").DataTable().ajax.reload();
            })
        }
      })
    // bootbox.confirm("¿Estas seguro de redistribuir las tallas?", function(result){
    //     if(result){
    //         $.get("orden_redistribuir/" + id_orden, function(){
    //             bootbox.alert("Redistibucion completa");
    //             $("#listar_OE").DataTable().ajax.reload();
    //         })
    //     }
    // })
}

$('#btn-completar').on('click', (e) => {
    e.preventDefault();
    Swal.fire({
        title: '¿Esta seguro de marcar completa esta orden?',
        text: "No podra revertir este cambio!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            let data = {
                orden: orden_id,
                orden_empaque: $("#id").val()
            }

            $.ajax({
                url: "empaque_completar",
                type: "POST",
                dataType: "json",
                data: JSON.stringify(data),
                contentType: "application/json",
                success: function(datos) {
                    if (datos.status == "success") {
                        tablaDetalle(orden_id);    
                        $('#btn-completar').hide();

                    } else {
                        bootbox.alert(
                            "Ocurrio un error durante la actualizacion de la composicion"
                        );
                    }
                },
                error: function() {
                    bootbox.alert("Recuerde digitar la cantidad de bultos!!");
                }
            });
        }
      })


})


const tablaDetalle = (id) => {

    $.get("orden_empaque/" + id, function(data, status) { 
        $("#disponibles").empty();
        for (let i = 0; i < data.orden_detalle.length; i++) {
            let fila = 
              `<tr id="fila${data.orden_detalle[i].id}">
                  <td><input type='hidden'  id='producto${data.orden_detalle[i].id}'value='${data.orden_detalle[i].producto.id} ' />${data.orden_detalle[i].producto.referencia_producto}</td>
                    ${
                        (data.orden_detalle[i].a) <= 0 
                        ? `<td><input type="text"  id="a${data.orden_detalle[i].id}" name="a" readonly  class="form-control red " value='0'></td>` 
                        : `<td><input type="number"  id="a${data.orden_detalle[i].id}" name="a"  class="form-control red" value='${data.orden_detalle[i].a}'></td>`
                    }            
                    ${
                        (data.orden_detalle[i].b) <= 0
                        ? `<td><input type="text"  id="b${data.orden_detalle[i].id}" name="a" readonly  class="form-control red " value='0'></td>` 
                        : `<td><input type="number"  id="b${data.orden_detalle[i].id}" name="a"  class="form-control red" value='${data.orden_detalle[i].b}'></td>`
                    }
    
                    ${
                        (data.orden_detalle[i].c <= 0)
                        ? `<td><input type="text"  id="c${data.orden_detalle[i].id}" name="a" readonly  class="form-control red" value='0'></td>`
                        : `<td><input type="number"  id="c${data.orden_detalle[i].id}" name="a"   class="form-control red" value='${data.orden_detalle[i].c}'></td>`
                    }
                    
                    ${
                        (data.orden_detalle[i].d <= 0)
                        ? `<td><input type="text"  id="d${data.orden_detalle[i].id}" name="a" readonly  class="form-control red" value='0'></td>`
                        : `<td><input type="number"  id="d${data.orden_detalle[i].id}" name="a"  class="form-control red" value='${data.orden_detalle[i].d}'></td>`
                    }
    
                    ${
                        (data.orden_detalle[i].e <= 0)
                        ? `<td><input type="text"  id="e${data.orden_detalle[i].id}" name="a"  readonly class="form-control red" value='0'></td>`
                        : `<td><input type="number"  id="e${data.orden_detalle[i].id}" name="a"  class="form-control red" value='${data.orden_detalle[i].e}'></td>`
                    }
    
                    ${
                        (data.orden_detalle[i].f <= 0)
                        ? `<td><input type="text"  id="f${data.orden_detalle[i].id}" name="a" readonly  class="form-control red" value='0'></td>`
                        : `<td><input type="number"  id="f${data.orden_detalle[i].id}" name="a"  class="form-control red" value='${data.orden_detalle[i].f}'></td>`
                    }
    
                    ${
                        (data.orden_detalle[i].g <= 0)
                        ? `<td><input type="text"  id="g${data.orden_detalle[i].id}" name="a" readonly  class="form-control red" value='0'></td>`
                        : `<td><input type="number"  id="g${data.orden_detalle[i].id}" name="a"  class="form-control red" value='${data.orden_detalle[i].g}'></td>`
                    }
                  
                    ${
                        (data.orden_detalle[i].h <= 0)
                        ? `<td><input type="text"  id="h${data.orden_detalle[i].id}" name="a" readonly  class="form-control red" value='0'></td>`
                        : `<td><input type="number"  id="h${data.orden_detalle[i].id}" name="a"  class="form-control red" value='${data.orden_detalle[i].h}'></td>`
                    }
                 
                    ${
                        (data.orden_detalle[i].i <= 0)
                        ? `<td><input type="text"  id="i${data.orden_detalle[i].id}" name="a"  readonly class="form-control red" value='0'></td>`
                        : `<td><input type="number"  id="i${data.orden_detalle[i].id}" name="a"  class="form-control red" value='${data.orden_detalle[i].i}'></td>`
                    }
                    
                    ${
                        (data.orden_detalle[i].j <= 0)
                        ? `<td><input type="text"  id="j${data.orden_detalle[i].id}" name="a" readonly  class="form-control red" value='0'></td>`
                        : `<td><input type="number"  id="j${data.orden_detalle[i].id}" name="a"  class="form-control red" value='${data.orden_detalle[i].j}'></td>`  
                    }
                    
                    ${
                        (data.orden_detalle[i].k <= 0)
                        ? `<td><input type="text"  id="k${data.orden_detalle[i].id}" name="a" readonly  class="form-control red" value='0'></td>`
                        : `<td><input type="number"  id="k${data.orden_detalle[i].id}" name="a"  class="form-control red" value='${data.orden_detalle[i].k}'></td>`
                    }
                  
                    ${
                        (data.orden_detalle[i].l <= 0)
                        ? `<td><input type="text"  id="l${data.orden_detalle[i].id}" name="a" readonly  class="form-control red" value='0'></td>`
                        : `<td><input type="number"  id="l${data.orden_detalle[i].id}" name="a"  class="form-control red" value='${data.orden_detalle[i].l}'></td>`
                    }
                   
                  <td><span id='total${data.orden_detalle[i].id}'>${data.orden_detalle[i].total}</span></td>
                    ${
                        (data.orden_detalle[i].total <= 0)
                        ? `<td></td> `
                        : `<td><input type="text" id="cantidad${data.orden_detalle[i].id}" name="cantidad" class="cantidad form-control red text-center" ></td>`
                    }
                  
                    ${
                        (data.orden_detalle[i].total <= 0)
                        ? `<td><span id="empacado_listo" class="badge badge-success">Empacado <i class="fas fa-check"></i> </span></td>`
                        : `<td><a onclick="test(${data.orden_detalle[i].id})" id="guardar" class="btn btn-primary btn-sm ml-1 text-white"> <i class="far fa-save"></i></a></td>`
                    }
                 
              </tr>`        
            
            $("#disponibles").append(fila);


            if(data.orden_empaque.empacado == 0){
                $('#btn-completar').hide(); 
            } else {
                $('#btn-completar').show();
            }

            if(data.orden_detalle[i].total <= 0){
                $('#btn-completar').hide(); 
            }
          }
    }

   
)}

