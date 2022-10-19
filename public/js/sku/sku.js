$(document).ready(function() {

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
        $("#codigo_composicion").val("");
        $("#nombre_composicion").val("");
        $("#permisos-agregados").empty();

    }



    // $("#btn-guardar").click(function(e){
    //     e.preventDefault();

    //     // var data = new FormData()
    //     // jQuery.each(jQuery('#file')[0].files, function(i, file){
    //     //     data.append('file-'+i, file);
    //     // })

    //     // $.ajax({
    //     //     url: "composition",
    //     //     type: "POST",
    //     //     dataType: "json",
    //     //     data: JSON.stringify(composition),
    //     //     contentType: "application/json",
    //     //     success: function(datos) {
    //     //         if (datos.status == "success") {
    //     //             bootbox.alert("Se registro la composicion");
    //     //             limpiar();
    //     //             tabla.ajax.reload();
    //     //             mostrarForm(false);
    //     //         } else {
    //     //             bootbox.alert(
    //     //                 "Ocurrio un error durante la creacion de la composicion"
    //     //             );
    //     //         }
    //     //     },
    //     //     error: function() {
    //     //         bootbox.alert(
    //     //             "Ocurrio un error, trate rellenando los campos obligatorios(*)"
    //     //         );
    //     //     }
    //     // });
    // });

    function listar() {
        tabla = $("#skus").DataTable({
            serverSide: true,
            autoWidth: false,
            // responsive: true,
            iDisplayLength: 20,
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
            ajax: "api/skus",
            columns: [
            //    { data: "Expandir", orderable: false, searchable: false },
                { data: "Editar", orderable: false, searchable: false },
            //    { data: "sku", name: "sku.sku"},
            //    { data: "referencia_producto", name: "sku.referencia_producto"},
            //    { data: "corte", name: "corte.numero_corte"},
            //    { data: "fecha", name: "corte.fecha_corte"},
            //    { data: "marcada", name: "corte.no_marcada"},
            //    { data: "talla", name: "sku.talla"} 

                { data: "sku", name: "sku.sku" },
                { data: "referencia_producto", name: "sku.referencia_producto" },
                { data: "numero_corte", name: "corte.numero_corte" },
                { data: "fecha_corte", name: "corte.fecha_corte" },
                { data: "no_marcada", name: "corte.no_marcada" },
                { data: "talla", name: "sku.talla" },
                { data: "entalle_bragueta", name: "producto.entalle_bragueta" },
                { data: "entalle_piernas", name: "producto.entalle_piernas" } 
            ],
            order: [[1, 'desc']],
        /*    rowGroup: {
                dataSrc: 'referencia_producto'
            } */
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var composition = {
            id: $("#id").val(),
            codigo_composicion: $("#codigo_composicion").val(),
            nombre_composicion: $("#nombre_composicion").val()
        };

        $.ajax({
            url: "composition/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(composition),
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
                    $("#btnCancelarx").hide();
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
        //    $("#tallasSku").show();
        //    $("#btnCancelar").show();
            $("#btnCancelarx").show();
            $("#btnAgregar").hide();
        } else {
            $("#listadoUsers").show();
            $("#tallasSku").hide();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnCancelarx").hide();
            $("#btnAgregar").show();
        }
    }

    $("#btnAgregar").click(function(e) {
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        mostrarForm(false);
    });
    $("#btnCancelarx").click(function(e) {
        mostrarForm(false);
    });

    init();
});

function mostrar(id_sku) {
    $.post("sku_id/" + id_sku, function(data, status) {

        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            $("#listadoUsers").hide();
            $("#registroForm").hide();
            $("#btnCancelarx").hide();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#btnAgregar").hide();
            $("#tallasSku").show();
            $("#btnCancelar").show();

            if (data.producto.genero == 1) {
                var total = data.tallas.total + 6;
            } else {
                var total = data.tallas.total + 8;
            }
          
            var fila =
            '<tr id="fila'+data.sku.id+'">'+
            "<td class=''><input type='checkbox' id='checkboxtalla' value='"+data.sku.id+"' name='checkboxtalla'></td>"+
            "<td class='font-weight-bold'>"+data.sku.sku+"</td>"+
            "<td class='font-weight-bold'>"+data.sku.referencia_producto+"</td>"+
            "<td class='font-weight-bold'>"+data.sku.talla+"</td>"+
            "<td class='font-weight-bold'><input type='number' class='text-center' placeholder='Cantidad' name='cantidad' id='cantidad' value='"+total+"'></td>"+
            "<td><a href='print_label/"+data.sku.id+"' target='_blank' class='btn btn-primary ml-1'> <i class='fas fa-print'></i></a></td>"+
            "</tr>";
            $("#permisos-agregados").append(fila);
        //    <button type='button' id='btn-print' class='btn btn-danger'><i class='fas fa-print'></i></button>
        //    $("#id").val(data.tela.id);
        //    $("#referencia").val(data.tela.referencia).attr('readonly', false);
  
            for (let i = 0; i < data.skus.length; i++) {
                switch (data.skus[i].talla) {
                    case "A": 
                    var total = data.tallas.a + 1;  
                        break;
                    case "B": 
                    var total = data.tallas.b + 1; 
                        break;
                    case "C": 
                    var total = data.tallas.c + 1;  
                        break;
                    case "D": 
                    var total = data.tallas.d + 1;  
                        break;
                    case "E": 
                    var total = data.tallas.e + 1; 
                        break;
                    case "F": 
                    var total = data.tallas.f + 1;  
                        break;
                    case "G": 
                    var total = data.tallas.g + 1;  
                        break;
                    case "H": 
                    var total = data.tallas.h + 1;  
                        break;
                    case "I": 
                    var total = data.tallas.i + 1;   
                        break;
                    case "J": 
                    var total = data.tallas.j + 1;   
                        break;
                    case "K": 
                    var total = data.tallas.k + 1;   
                        break;
                    case "L": 
                    var total = data.tallas.l + 1;   
                        break;
                    default:
                    var total = 0;   
                        break;
                }
                if (data.skus[i].talla == "General") {

                } else {
                    var fila =
                    '<tr id="fila'+data.skus[i].id+'">'+
                    "<td class=''><input type='checkbox' id='checkboxtalla' value='"+data.sku.id+"' name='checkboxtalla'></td>"+
                    "<td class=''>"+data.skus[i].sku+"</td>"+
                    "<td class=''>"+data.skus[i].referencia_producto+"</td>"+
                    "<td class=''>"+data.skus[i].talla+"</td>"+
                    "<td class=''><input type='number' class='text-center' placeholder='Cantidad' name='cantidad' id='cantidad' value='"+total+"'></td>"+
                    "<td><a href='print_label/"+data.skus[i].id+"' target='_blank' class='btn btn-primary ml-1'> <i class='fas fa-print'></i></a></td>"+
                    "</tr>";
                    $("#permisos-agregados").append(fila);
                }
                
            }
        
 
    
        }
     
    });
}