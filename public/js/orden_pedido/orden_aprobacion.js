let genero_global;
let genero_plus_global;
let pedido_id;
let a_total;
let b_total;
let c_total;
let d_total;
let e_total;
let f_total;
let g_total;
let h_total;
let i_total;
let j_total;
let k_total;
let l_total;
$(document).ready(function() {
    $("[data-mask]").inputmask();

  


    var tabla

    function init() {
        // $("[data-mask]").inputmask();
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
        // $('input[name="c"]').inputmask("999");
    }


    $("#receta_lavado").on('keyup', function(){
        $("#btn-guardar").attr('disabled', false);
    })




    function listar() {
        tabla = $("#ordenes_aprobacion").DataTable({
            serverSide: true,
            responsive: true,
            dom: "Bfrtip",
            // iDisplayLength: 5,
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
            ajax: "api/ordenes_aprobacion",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_orden_pedido",name: "orden_pedido.no_orden_pedido"},
                { data: "nombre", name: "empleado.nombre" },
                { data: "nombre_cliente", name: "cliente.nombre_cliente" },
                { data: "nombre_sucursal", name: "cliente_sucursales.nombre_sucursal"},
                { data: "fecha", name: "orden_pedido.fecha" },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" },
                // { data: "fecha_aprobacion", name: "orden_pedido.fecha_aprobacion" },
                { data: "total", name: "orden_pedido.total", searchable: false  },
                { data: "status_orden_pedido", name: "orden_pedido.status_orden_pedido" },
            ],
            order: [[2, "desc"]],
            rowGroup: {
                dataSrc: "status_orden_pedido"
            }
        });
    }



    function mostrarForm(flag) {
        if (flag) {
            $("#AprobarPedido").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#corteADD").show();
            $("#productoADD").show();
            $('#btn-generar').attr("disabled", false);

        } else {
            $("#AprobarPedido").show();
            $("#registroForm").hide();
            $("#listadoUsers").show();
            $("#btnCancelar").hide();
            $("#badge-red").hide();
            $("#btnAgregar").show();
            $("#corteEdit").hide();
            $("#productoEdit").hide();
            $("#referencia_producto").hide();
            $("#numero_corte").hide();
            $("#suplidor_lavanderia").hide();
            $("#estandar_incluido").hide();
            $("#btn-guardar").attr('disabled', true);
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#formularioLavanderia").hide();


        }
    }

    $("#btnAgregar").click(function(e) {
        mostrarForm(true);


    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        mostrarForm(false);
        $("#ordenes_aprobacion").DataTable().ajax.reload();

    });

    $('input[name="c"]').keyup(function(){
        alert('Hi');
    });

 
    $('#btn-seleccionar').on('click', (e) => {
        e.preventDefault();
      
        seleccionar();

    });

    init();
});


function inicio(){
    $("[data-mask]").inputmask();
    $('input[name="c"]').inputmask("999");

}


function aprobar(id_orden) {
    // e.preventDefault();
    $.post("checkAprob/delete/" + id_orden, function(data, status) {
        console.log(data);
        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            Swal.fire({
                title: "¿Estas seguro de aprobar este pedido?",
                text: "Va a aprobar este pedido!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, acepto"
            }).then(result => {
                if (result.value) {
                    $.post("orden-aprobacion/" + id_orden, function(data, status){
                        Swal.fire(
                            "Aprobado!",
                            "Orden "+ data.orden.no_orden_pedido +"</strong> aprobada",
                            "success"
                        );
                        $("#ordenes_aprobacion").DataTable().ajax.reload();
                        $("#ordenes_red").DataTable().ajax.reload();
                    });
                }
            });
        }
   
    })
    // bootbox.confirm("¿Estas seguro de aprobar esta orden?", function(result){
    //     if(result){
    //         $.post("orden-aprobacion/" + id_orden, function(data, status){
    //             bootbox.alert("Orden "+ data.orden.no_orden_pedido +"</strong> aprobada." );

    //             $("#ordenes_aprobacion").DataTable().ajax.reload();
    //             $("#ordenes_red").DataTable().ajax.reload();
    //         })
    //     }
    // })
}

function redistribuir(id_orden){
    Swal.fire({
        title: '¿Esta seguro de redistribuir las tallas?',
        text: "Va a cambiar el pedido en caso de que se haya hecho detallada!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, guardar'
      }).then((result) => {
        if (result.value) {
            accionRedistribuir(id_orden);
            
        }
      })

}

function accionRedistribuir(id_orden){
    $.get("orden_redistribuir/" + id_orden, function(data){
        // console.log(data);
       
        Swal.fire(
            'Guardado!',
            'Redistribucion completa',
            'success'
            )
        $("#detalle").DataTable().ajax.reload();
        validarCant(id_orden, data);
    })
}


const validarCant = (id,data) => {
    // console.log("estoy funcionando");
    if(data.a_red > data.a_alm){
        $("#a"+id).addClass('text-danger');
    } 
    if(data.b_red > data.b_alm){
        $("#b"+id).addClass('text-danger');
    } 
    if(data.c_red > data.c_alm){
        $("#c"+id).addClass('text-danger');
    } 
    if(data.d_red > data.d_alm){
        $("#d"+id).addClass('text-danger');
    } 
    if(data.e_red > data.e_alm){
        $("#e"+id).addClass('text-danger');
    } 
    if(data.f_red > data.f_alm){
        $("#f"+id).addClass('text-danger');
    } 
    if(data.g_red > data.g_alm){
        $("#g"+id).addClass('text-danger');
    } 
    if(data.h_red > data.h_alm){
        $("#h"+id).addClass('text-danger');
    } 
    if(data.i_red > data.i_alm){
        $("#i"+id).addClass('text-danger');
    } 
    if(data.j_red > data.j_alm){
        $("#j"+id).addClass('text-danger');
    } 
    if(data.k_red > data.k_alm){
        $("#k"+id).addClass('text-danger');
    } 
    if(data.l_red > data.l_alm){
        $("#l"+id).addClass('text-danger');
    } 
    

}

function cancelar(id_orden){
    Swal.fire({
        title: "¿Estas seguro de cancelar esta orden de pedido?",
        text: "Va a cancelar esta orden de  pedido!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, acepto"
    }).then(result => {
        if (result.value) {
            $.post("orden-cancelacion/" + id_orden, function(data, status){
                Swal.fire(
                    "Cancelada!",
                    "Orden "+ data.orden.no_orden_pedido +"</strong> cancelada.",
                    "success"
                );
                $("#ordenes_aprobacion").DataTable().ajax.reload();
                $("#ordenes_red").DataTable().ajax.reload();
            });
        }
    });
    // bootbox.confirm("¿Estas seguro de cancelar esta orden?", function(result){
    //     if(result){
    //         $.post("orden-cancelacion/" + id_orden, function(data, status){
    //             bootbox.alert("Orden "+ data.orden.no_orden_pedido +"</strong> cancelada." );

    //             $("#ordenes_aprobacion").DataTable().ajax.reload();
    //         })
    //     }
    // })
}
function ver(id_orden) {
    $.get("ver/orden/" + id_orden, function(data, status) {

        $("#AprobarPedido").hide();
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-guardar").hide();
        $("#autorizacion_credito_req").show();
        $("#redistribucion_tallas").show();
        $("#factura_desglosada_tallas").show();
        $("#acepta_segundas").show();
        pedido_id = data.orden.id;
        $("#no_orden_pedido").val(data.orden.no_orden_pedido).attr('readonly', true);
        $("#cliente_apro").val(data.orden.cliente.nombre_cliente).attr('readonly', true);
        $("#sucursal_apro").val(data.orden.sucursal.nombre_sucursal).attr('readonly', true);
        $("#vendedor").val(data.orden.vendedor.nombre+" "+data.orden.vendedor.apellido).attr('readonly', true);
        $("#disponibles").empty();
        
        productos(id_orden);
        $("#ver_pedido").empty();
        for (let i = 0; i < data.detalle.length; i++) {
            let fila = `
            <tr>
                <td>${data.detalle[i].producto.referencia_producto}</td>
                <td class="text-dark"> ${data.detalle[i].a}</td>
                <td class="text-dark"> ${data.detalle[i].b}</td>
                <td class="text-dark"> ${data.detalle[i].c}</td>
                <td class="text-dark"> ${data.detalle[i].d}</td>
                <td class="text-dark"> ${data.detalle[i].e}</td>
                <td class="text-dark"> ${data.detalle[i].f}</td>
                <td class="text-dark"> ${data.detalle[i].g}</td>
                <td class="text-dark"> ${data.detalle[i].h}</td>
                <td class="text-dark"> ${data.detalle[i].i}</td>
                <td class="text-dark"> ${data.detalle[i].j}</td>
                <td class="text-dark"> ${data.detalle[i].k}</td>
                <td class="text-dark"> ${data.detalle[i].l}</td>
                <td class="text-danger">${data.detalle[i].total}</td>
                <td class="text-danger">${data.detalle[i].cantidad}</td>
                <td></td>
            
            
            </tr>
            `
            $("#ver_pedido").append(fila);
            
        }
       

    });
}

function ajuste( id_orden){
    Swal.fire({
        title: '¿Esta seguro de guardar este ajuste de esta redistribucion?',
        text: "Solo usar esta opcion en caso de que le redistribucion no sea exacta!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, guardar'
      }).then((result) => {
        if (result.value) {
            validar(id_orden);
        }
      })
}

function reajustar( id_orden){
    Swal.fire({
        title: '¿Esta seguro de volver a ajustar esta redistribucion?',
        text: "Solo usar esta opcion en caso de que le redistribucion no sea exacta!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            cambiarAjuste(id_orden);
        }
      })


}

const seleccionar = () => {
    $("#disponibles").empty();
    let data = { 
        pedido: pedido_id,
        producto: $('#productos').val()
    }

    $.ajax({
        url: "producto-curva",
        type: "POST",
        dataType: "json",
         data: JSON.stringify(data),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                // console.log(datos);
                genero_global = datos.producto.referencia_producto.substring(1, 2);
                genero_plus_global = datos.producto.referencia_producto.substring(3, 4);
                // console.log(genero_global);
                // console.log(genero_plus_global);

                a_total = datos.a_alm;
                b_total = datos.b_alm;
                c_total = datos.c_alm;
                d_total = datos.d_alm;
                e_total = datos.e_alm;
                f_total = datos.f_alm;
                g_total = datos.g_alm;
                h_total = datos.h_alm;
                i_total = datos.i_alm;
                j_total = datos.j_alm;
                k_total = datos.k_alm;
                l_total = datos.l_alm;

                let filaPercProducto = `
                <tr>
                    <td>% Meta</td>
                    <td class="text-primary">% ${datos.curva_producto.a}</td>
                    <td class="text-primary">% ${datos.curva_producto.b}</td>
                    <td class="text-primary">% ${datos.curva_producto.c}</td>
                    <td class="text-primary">% ${datos.curva_producto.d}</td>
                    <td class="text-primary">% ${datos.curva_producto.e}</td>
                    <td class="text-primary">% ${datos.curva_producto.f}</td>
                    <td class="text-primary">% ${datos.curva_producto.g}</td>
                    <td class="text-primary">% ${datos.curva_producto.h}</td>
                    <td class="text-primary">% ${datos.curva_producto.i}</td>
                    <td class="text-primary">% ${datos.curva_producto.j}</td>
                    <td class="text-primary">% ${datos.curva_producto.k}</td>
                    <td class="text-primary">% ${datos.curva_producto.l}</td>
                    <td class="text-primary">${datos.total_curva_producto}</td>
                    <td class="text-danger"></td>
                    <td></td>
                
                
                </tr>
                `
                $("#disponibles").append(filaPercProducto);

                let fila = 
                `<tr id="fila${datos.producto.id}">
                    <td><input type='hidden'  id='producto${datos.producto.id}'value='${datos.producto.referencia_producto} ' />${datos.producto.referencia_producto}</td>
                      ${
                          (datos.a_alm <= 0) 
                          ? `<td id="a${datos.producto.id}">0</td>` 
                          : `<td><input autocomplete="off" type="number"  id="a${datos.producto.id}" name="a" value="${datos.orden_detalle.a}"  class="form-control red" ></td>`
                      }            
                      ${
                          (datos.b_alm <= 0)
                          ? `<td id="b${datos.producto.id}">0</td>` 
                          : `<td><input type="number" autocomplete="off"  id="b${datos.producto.id}" name="a" value="${datos.orden_detalle.b}"  class="form-control red" ></td>`
                      }
      
                      ${
                          (datos.c_alm <= 0)
                          ? `<td id="c${datos.producto.id}">0</td>` 
                          : `<td><input type="number" autocomplete="off"  id="c${datos.producto.id}" name="a" value="${datos.orden_detalle.c}"  class="form-control red" ></td>`
                      }
                      
                      ${
                          (datos.d_alm <= 0)
                          ? `<td id="d${datos.producto.id}">0</td>` 
                          : `<td><input type="number" autocomplete="off"  id="d${datos.producto.id}" name="a" value="${datos.orden_detalle.d}"  class="form-control red" ></td>`
                      }
      
                      ${
                          (datos.e_alm <= 0)
                          ? `<td id="e${datos.producto.id}">0</td>` 
                          : `<td><input type="number" autocomplete="off"  id="e${datos.producto.id}" name="a" value="${datos.orden_detalle.e}"  class="form-control red" ></td>`
                      }
      
                      ${
                          (datos.f_alm <= 0)
                          ? `<td id="f${datos.producto.id}">0</td>` 
                          : `<td><input type="number" autocomplete="off"  id="f${datos.producto.id}" name="a" value="${datos.orden_detalle.f}"  class="form-control red" ></td>`
                      }
      
                      ${
                          (datos.g_alm <= 0)
                          ? `<td id="g${datos.producto.id}">0</td>` 
                          : `<td><input type="number" autocomplete="off" id="g${datos.producto.id}" name="a" value="${datos.orden_detalle.g}"  class="form-control red" ></td>`
                      }
                    
                      ${
                          (datos.h_alm <= 0)
                          ? `<td id="h${datos.producto.id}">0</td>` 
                          : `<td><input type="number" autocomplete="off"  id="h${datos.producto.id}" name="a" value="${datos.orden_detalle.h}" class="form-control red" ></td>`
                      }
                   
                      ${
                          (datos.i_alm <= 0)
                          ? `<td id="i${datos.producto.id}">0</td>` 
                          : `<td><input type="number" autocomplete="off"  id="i${datos.producto.id}" name="a" value="${datos.orden_detalle.i}"  class="form-control red" ></td>`
                      }
                      
                      ${
                          (datos.j_alm <= 0)
                          ? `<td id="j${datos.producto.id}">0</td>`  
                          : `<td><input type="number" autocomplete="off"  id="j${datos.producto.id}" name="a" value="${datos.orden_detalle.j}" class="form-control red" ></td>`  
                      }
                      
                      ${
                          (datos.k_alm <= 0)
                          ? `<td id="k${datos.producto.id}">0</td>` 
                          : `<td><input type="number" autocomplete="off"  id="k${datos.producto.id}" name="a" value="${datos.orden_detalle.k}"  class="form-control red" ></td>`
                      }
                      ${
                          (datos.l_alm <= 0)
                          ? `<td id="l${datos.producto.id}">0</td>` 
                          : `<td><input type="number" autocomplete="off"  id="l${datos.producto.id}" name="a" value="${datos.orden_detalle.l}" class="form-control red" ></td>`
                        }
                        ${
                            (datos.orden_detalle.total > 0)
                            ? `<td id="total${datos.producto.id}">${datos.orden_detalle.total}</td>`
                            : `<td id="total${datos.producto.id}"></td>`
                        }
                     
                    <td class="text-success" id="cant${datos.producto.id}">${datos.orden_detalle.cantidad}</td> 
                    <td><a onclick="saveDetail(${datos.producto.id})" id="guardar" class="btn btn-primary btn-sm ml-1 text-white"> <i class="far fa-save"></i></a></td>
                    
    
                   
                </tr>`        
              
              $("#disponibles").append(fila);

              let filaPercAlmacen = `
              <tr>
                  <td class="text-danger">% Alm</td>
                  <td class="text-danger">% ${datos.a_perc}</td>
                  <td class="text-danger">% ${datos.b_perc}</td>
                  <td class="text-danger">% ${datos.c_perc}</td>
                  <td class="text-danger">% ${datos.d_perc}</td>
                  <td class="text-danger">% ${datos.e_perc}</td>
                  <td class="text-danger">% ${datos.f_perc}</td>
                  <td class="text-danger">% ${datos.g_perc}</td>
                  <td class="text-danger">% ${datos.h_perc}</td>
                  <td class="text-danger">% ${datos.i_perc}</td>
                  <td class="text-danger">% ${datos.j_perc}</td>
                  <td class="text-danger">% ${datos.k_perc}</td>
                  <td class="text-danger">% ${datos.l_perc}</td>
                  <td class="text-danger">${datos.total_perc_alm}</td>
                  <td class="text-danger"></td>
                  <td></td>
              
              
              </tr>
              `
              $("#disponibles").append(filaPercAlmacen);


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

function validar(id){
    let a = $('#a'+id).html() || $('#a'+id).val();
    let b = $('#b'+id).html() || $('#b'+id).val();
    let c = $('#c'+id).html() || $('#c'+id).val();
    let d = $('#d'+id).html() || $('#d'+id).val();
    let e = $('#e'+id).html() || $('#e'+id).val();
    let f = $('#f'+id).html() || $('#f'+id).val();
    let g = $('#g'+id).html() || $('#g'+id).val();
    let h = $('#h'+id).html() || $('#h'+id).val();
    let i = $('#i'+id).html() || $('#i'+id).val();
    let j = $('#j'+id).html() || $('#j'+id).val();
    let k = $('#k'+id).html() || $('#k'+id).val();
    let l = $('#l'+id).html() || $('#l'+id).val();
    let total = $("#total"+id).html();

    let data = {
        a: a,
        b: b,
        c: c,
        d: d,
        e: e,
        f: f,
        g: g,
        h: h,
        i: i,
        j: j,
        k: k,
        l: l,
        total: total,
        almacen_id: $("#id").val()
    };

    $.ajax({
        url: "validar/total",
        type: "POST",
        dataType: "json",
        data: JSON.stringify(data),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                // console.log(datos);
                let total = datos.total;
                let a = datos.a;
                let b = datos.b;
                let c = datos.c;
                let d = datos.d;
                let e = datos.e;
                let f = datos.f;
                let g = datos.g;
                let h = datos.h;
                let i = datos.i;
                let j = datos.j;
                let k = datos.k;
                let l = datos.l;

                if(genero_global == 2){
                    if(genero_plus_global == 7){
                        if(a > a_total){
                            Swal.fire(
                                "Disponible:  "+ a_total ,
                                "Digito una cantidad mayor en la talla 12W a la disponible en almacen!",
                                "error"
                            );
                        }else if(b > b_total){
                            Swal.fire(
                                "Disponible:  "+ b_total ,
                                "Digito una cantidad mayor en la talla 14W a la disponible en almacen!",
                                "error"
                            );
                        }else if(c > c_total){
                            Swal.fire(
                                "Disponible:  "+ c_total ,
                                "Digito una cantidad mayor en la talla 16W a la disponible en almacen!",
                                "error"
                            );
                        }
                        else if(d > d_total){
                            Swal.fire(
                                "Disponible:  "+ d_total ,
                                "Digito una cantidad mayor en la talla 18W a la disponible en almacen!",
                                "error"
                            );
                        }else if(e > e_total){
                            Swal.fire(
                                "Disponible:  "+ e_total ,
                                "Digito una cantidad mayor en la talla 20W a la disponible en almacen!",
                                "error"
                            );
                        }else if(f > f_total){
                            Swal.fire(
                                "Disponible:  "+ f_total ,
                                "Digito una cantidad mayor en la talla 22W a la disponible en almacen!",
                                "error"
                            );
                        }else if(g > g_total){
                            Swal.fire(
                                "Disponible:  "+ g_total ,
                                "Digito una cantidad mayor en la talla 24W a la disponible en almacen!",
                                "error"
                            );
                        }else if(h > h_total){
                            Swal.fire(
                                "Disponible:  "+ h_total ,
                                "Digito una cantidad mayor en la talla 26W a la disponible en almacen!",
                                "error"
                            );
                        }else{
                            distribucion(id)
                        }
                    }else{
                        if(a > a_total){
                            Swal.fire(
                                "Disponible: "+ a_total ,
                                "Digito una cantidad mayor en la talla 0/0 a la disponible en almacen!",
                                "error"
                            );
                        }else if(b > b_total){
                            Swal.fire(
                                "Disponible:  "+ b_total ,
                                "Digito una cantidad mayor en la talla 1/2 a la disponible en almacen!",
                                "error"
                            );
                        }else if(c > c_total){
                            Swal.fire(
                                "Disponible:  "+ c_total ,
                                "Digito una cantidad mayor en la talla 3/4 a la disponible en almacen!",
                                "error"
                            );
                        }
                        else if(d > d_total){
                            Swal.fire(
                                "Disponible:  "+ d_total ,
                                "Digito una cantidad mayor en la talla 5/6 a la disponible en almacen!",
                                "error"
                            );
                        }else if(e > e_total){
                            Swal.fire(
                                "Disponible:  "+ e_total ,
                                "Digito una cantidad mayor en la talla 7/8 a la disponible en almacen!",
                                "error"
                            );
                        }else if(f > f_total){
                            Swal.fire(
                                "Disponible:  "+ f_total ,
                                "Digito una cantidad mayor en la talla 9/10 a la disponible en almacen!",
                                "error"
                            );
                        }else if(g > g_total){
                            Swal.fire(
                                "Disponible:  "+ g_total ,
                                "Digito una cantidad mayor en la talla 11/12 a la disponible en almacen!",
                                "error"
                            );
                        }else if(h > h_total){
                            Swal.fire(
                                "Disponible:  "+ h_total ,
                                "Digito una cantidad mayor en la talla 13/14 a la disponible en almacen!",
                                "error"
                            );
                        }else if(i > i_total){
                            Swal.fire(
                                "Disponible:  "+ i_total ,
                                "Digito una cantidad mayor en la talla 15/16 a la disponible en almacen!",
                                "error"
                            );
                        }else if(j > j_total){
                            Swal.fire(
                                "Disponible:  "+ j_total ,
                                "Digito una cantidad mayor en la talla 17/18 a la disponible en almacen!",
                                "error"
                            );
                        }else if(k > k_total){
                            Swal.fire(
                                "Disponible:  "+ k_total ,
                                "Digito una cantidad mayor en la talla 19/20 a la disponible en almacen!",
                                "error"
                            );
                        }else if(l > l_total){
                            Swal.fire(
                                "Disponible:  "+ l_total ,
                                "Digito una cantidad mayor en la talla 21/222 a la disponible en almacen!",
                                "error"
                            );
                        }else{
                            distribucion(id)
                        }
                    }
                }else if(genero_global == 3 || genero_global == 4){
                    if(a > a_total){
                        Swal.fire(
                            "Disponible:  "+ a_total ,
                            "Digito una cantidad mayor en la talla 2 a la disponible en almacen!",
                            "error"
                        );
                    }else if(b > b_total){
                        Swal.fire(
                            "Disponible:  "+ b_total ,
                            "Digito una cantidad mayor en la talla 4 a la disponible en almacen!",
                            "error"
                        );
                    }else if(c > c_total){
                        Swal.fire(
                            "Disponible:  "+ c_total ,
                            "Digito una cantidad mayor en la talla 6 a la disponible en almacen!",
                            "error"
                        );
                    }
                    else if(d > d_total){
                        Swal.fire(
                            "Disponible:  "+ d_total ,
                            "Digito una cantidad mayor en la talla 8 a la disponible en almacen!",
                            "error"
                        );
                    }else if(e > e_total){
                        Swal.fire(
                            "Disponible:  "+ e_total ,
                            "Digito una cantidad mayor en la talla 10 a la disponible en almacen!",
                            "error"
                        );
                    }else if(f > f_total){
                        Swal.fire(
                            "Disponible:  "+ f_total ,
                            "Digito una cantidad mayor en la talla 12 a la disponible en almacen!",
                            "error"
                        );
                    }else if(g > g_total){
                        Swal.fire(
                            "Disponible:  "+ g_total ,
                            "Digito una cantidad mayor en la talla 14 a la disponible en almacen!",
                            "error"
                        );
                    }else if(h > h_total){
                        Swal.fire(
                            "Disponible:  "+ h_total ,
                            "Digito una cantidad mayor en la talla 16 a la disponible en almacen!",
                            "error"
                        );
                    }else{
                        distribucion(id)
                    }
                }else if(genero_global == 1){
                    if(a > a_total){
                        Swal.fire(
                            "Disponible:  "+ a_total ,
                            "Digito una cantidad mayor en la talla 38 a la disponible en almacen!",
                            "error"
                        );
                    }else if(b > b_total){
                        Swal.fire(
                            "Disponible:  "+ b_total ,
                            "Digito una cantidad mayor en la talla 29 a la disponible en almacen!",
                            "error"
                        );
                    
                    }else if(c > c_total){
                        Swal.fire(
                            "Disponible:  "+ c_total ,
                            "Digito una cantidad mayor en la talla 30 a la disponible en almacen!",
                            "error"
                        );
                    
                    }
                    else if(d > d_total){
                        Swal.fire(
                            "Disponible:  "+ d_total ,
                            "Digito una cantidad mayor en la talla 32 a la disponible en almacen!",
                            "error"
                        );
                    }else if(e > e_total){
                        Swal.fire(
                            "Disponible:  "+ e_total ,
                            "Digito una cantidad mayor en la talla 34 a la disponible en almacen!",
                            "error"
                        );
                    }else if(f > f_total){
                        Swal.fire(
                            "Disponible:  "+ e_total ,
                            "Digito una cantidad mayor en la talla 36 a la disponible en almacen!",
                            "error"
                        );
                    }else if(g > g_total){
                        Swal.fire(
                            "Disponible:  "+ g_total ,
                            "Digito una cantidad mayor en la talla 38 a la disponible en almacen!",
                            "error"
                        );
                    }else if(h > h_total){
                        Swal.fire(
                            "Disponible:  "+ h_total ,
                            "Digito una cantidad mayor en la talla 40 a la disponible en almacen!",
                            "error"
                        );
                    }else if(i > i_total){
                        Swal.fire(
                            "Disponible:  "+ i_total ,
                            "Digito una cantidad mayor en la talla 42 a la disponible en almacen!",
                            "error"
                        );
                    }else if(j > j_total){
                        Swal.fire(
                            "Disponible:  "+ j_total ,
                            "Digito una cantidad mayor en la talla 44 a la disponible en almacen!",
                            "error"
                        );
                    }else{
                        distribucion(id)
                    }
                }
               
            } else if(datos.status == "validation")  {
                Swal.fire(
                'Error!',
                datos.message,
                'error'
                )
            }
        },
        error: function(datos) {
            console.log(datos.responseJSON.message);

            bootbox.alert(
                "Error: " + datos.responseJSON.message
            );
        }
    });


}




const productos = (id) => {
    $("#productos").empty();
    $("#productos").append(`<option value="" selected disabled>Productos</option>`);

    $.ajax({
        url: "orden-productos/"+id,
        type: "GET",
        dataType: "json",
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                var longitud = datos.detalle.length;

                for (let i = 0; i < longitud; i++) {
                    var fila =  "<option value="+datos.detalle[i].producto.id +">"+datos.detalle[i].producto.referencia_producto+"</option>"

                    $("#productos").append(fila);
                }
                $("#productos").select2();

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
}


function cambiarAjuste(id){
    $.ajax({
        url: "orden/detalle/reajuste/"+id,
        type: "POST",
        dataType: "json",
        // data: JSON.stringify(ordenDetalle),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                $("#detalle").DataTable().ajax.reload();
                Swal.fire(
                'Guardado!',
                'Cambios realizados',
                'success'
                )
            } else {
                bootbox.alert(
                    "Ocurrio un error durante la creacion de la composicion"
                );
            }
        },
        error: function(datos) {
            console.log(datos.responseJSON.message);

            bootbox.alert(
                "Error: " + datos.responseJSON.message
            );
        }
    });
}

//funcion para listar en el Datatable
// function listarOrdenDetalle(id) {
//     // $("#tablaPedido").DataTable().destroy();


//    let tabla_orden = $("#tablaPedido").DataTable({
//         serverSide: true,
//         bFilter: false,
//         lengthChange: false,
//         bPaginate: false,
//         bInfo: false,
//         retrieve: true,
//         ajax: "api/listarorden/"+id,
//         columns: [
//             { data: "referencia_producto",name: "producto.referencia_producto"},
//             { data: "a", name: "orden_pedido_detalle.a", orderable: false, searchable: false},
//             { data: "b", name: "orden_pedido_detalle.b", orderable: false, searchable: false},
//             { data: "c", name: "orden_pedido_detalle.c", orderable: false, searchable: false},
//             { data: "d", name: "orden_pedido_detalle.d", orderable: false, searchable: false},
//             { data: "e", name: "orden_pedido_detalle.e", orderable: false, searchable: false},
//             { data: "f", name: "orden_pedido_detalle.f", orderable: false, searchable: false},
//             { data: "g", name: "orden_pedido_detalle.g", orderable: false, searchable: false},
//             { data: "h", name: "orden_pedido_detalle.h", orderable: false, searchable: false},
//             { data: "i", name: "orden_pedido_detalle.i", orderable: false, searchable: false},
//             { data: "j", name: "orden_pedido_detalle.j", orderable: false, searchable: false},
//             { data: "k", name: "orden_pedido_detalle.k", orderable: false, searchable: false},
//             { data: "l", name: "orden_pedido_detalle.l", orderable: false, searchable: false},
//             { data: "total", name: "orden_pedido_detalle.total",  },
//             { data: "cant_red", name: "orden_pedido_detalle.cant_red" }

//         ],
//     });
// }

const saveDetail = (id) =>{
    // alert(product_id);
    Swal.fire({
        title: '¿Esta seguro de guardar esta distribucion?',
        text: "Guardara una distribucion del producto!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            validar(id);
        }
      }
)}


const distribucion = (id) => {
    let data = {
        producto: id,
        pedido: pedido_id,
        cantidad: $('#cant'+id).html(),
        a: $('#a'+id).html() || $('#a'+id).val(),
        b: $('#b'+id).html() || $('#b'+id).val(),
        c: $('#c'+id).html() || $('#c'+id).val(),
        d: $('#d'+id).html() || $('#d'+id).val(),
        e: $('#e'+id).html() || $('#e'+id).val(),
        f: $('#f'+id).html() || $('#f'+id).val(),
        g: $('#g'+id).html() || $('#g'+id).val(),
        h: $('#h'+id).html() || $('#h'+id).val(),
        i: $('#i'+id).html() || $('#i'+id).val(),
        j: $('#j'+id).html() || $('#j'+id).val(),
        k: $('#k'+id).html() || $('#k'+id).val(),
        l: $('#l'+id).html() || $('#l'+id).val(),
    }

    // console.log(data);
    $.ajax({
        url: "orden_distribuir",
        type: "POST",
        dataType: "json",
        data: JSON.stringify(data),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                // console.log(datos);
                if(datos.detalle.cantidad > datos.detalle.total ){
                    // console.log("Hi");
                    Swal.fire(
                        'Pedido: '+datos.detalle.cantidad,
                        'Recuerde que el total distribuido debe ser igual al total pedido',
                        'info'
                        )
                        seleccionar();
                } else {
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
                        title: 'Distribucion guardada correctamente.!'
                    })
                    seleccionar();
                }
              
            } else if(datos.status == "validation")  {
                Swal.fire(
                'Error!',
                datos.message,
                'error'
                )
            }
        },
        error: function(datos) {
            console.log(datos.responseJSON.message);

            bootbox.alert(
                "Error: " + datos.responseJSON.message
            );
        }
    });
}


inicio();
