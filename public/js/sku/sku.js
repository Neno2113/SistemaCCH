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
        clientes();
        $("#btn-edit").hide();
        $("#btn-upload").attr("disabled", true,'class', 'btn-secundary');
        $("#btn-upload").attr("class", "btn-secundary");
    }

    function limpiar() {
        $("#codigo_composicion").val("");
        $("#nombre_composicion").val("");
        $("#cliente_id").val("");
        $("#nombre_cliente").val("");
        $("#referencia").val("");
        $("#product_id").val("");
        $("#permisos-agregados").empty();
        $("#clientes").val("").trigger("change");
        $("#btn-upload").attr("disabled", true,'class', 'btn-secundary');
        $("#btn-upload").attr("class", "btn-secundary");

    }

    $("#clientes").change(function(){
        $("#btn-upload").attr("disabled", false);
        $("#btn-upload").attr("class", "btn-primary");
        $("#cliente_id").val($('select[name=clientes] option').filter(':selected').val());
        $("#nombre_cliente").val($('#clientes').find('option:selected').text());
        $("#referencia").val($("#referencia_product").val()); 
        $("#product_id").val($("#prod_id").val());

    });

    $("#btn-upload").click(function(e) {
        // e.preventDefault();
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
            title: 'Archivo Cargado.'
        })
    });

    $("#formUpload").submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        // console.log( JSON.stringify(formData));
        $.ajax({
            url: "fileskus",
            type: "POST",
            data: formData,
            dataType: "JSON",
            processData: false,
            cache: false,
            contentType: false,
            success: function(datos) {
                if (datos.status == "success") {
                    for (let i = 0; i < datos.skus_esp.length; i++) {
                        var fila =
                        '<tr id="fila'+data.skus_esp[i].id+'">'+
                        "<td class=''><input type='checkbox' id='checkboxtalla' value='"+data.skus_esp[i].id+"' name='checkboxtalla'></td>"+
                        "<td class='font-weight-bold'>"+data.skus_esp[i].sku_especial+"</td>"+
                        "<td class='font-weight-bold'>"+data.skus_esp[i].referencia_producto+"</td>"+
                        "<td class='font-weight-bold'>"+data.skus_esp[i].talla+"</td>"+
                        "<td class='font-weight-bold'><input type='number' class='text-center' placeholder='Cantidad' name='cantidad' id='cantidad0' value='"+data.skus_esp[i].cantidad+"'></td>"+
                        "<td><a href='print_label/"+data.skus_esp[i].id+"/"+data.skus_esp[i].cantidad+"' target='_blank' id='enlaceprint"+i+"' onclick='redirigir("+i+","+data.skus_esp[i].id+");' class='btn btn-primary ml-1'> <i class='fas fa-print'></i></a></td>"+
                        "</tr>";
                        $("#permisos-agregados").append(fila);
                    }
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la carga del archivo"
                    );
                }
            },
            error: function(datos) {
                console.log(datos.responseJSON.message);
                let errores = datos.responseJSON.message;
    
                Object.entries(errores).forEach(([key, val]) => {
                    bootbox.alert({
                        message:
                            "<h4 class='invalid-feedback d-block'>" +
                            val +
                            "</h4>",
                        size: "small"
                    });
                });
            }
        });
    });

    function clientes (){

        $.ajax({
            url: "cliente/select",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.cliente.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila =  "<option value="+datos.cliente[i].id +">"+datos.cliente[i].nombre_cliente+"</option>";

                        $("#clientes").append(fila);
                    }
                    $("#clientes").select2();

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de los clientes"
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

function redirigir(num,id) {
    var newTotal = $("#cantidad"+num).val();
    $("#enlaceprint"+num).attr("href", "print_label/"+id+"/"+newTotal+"");
}

function mostrar(id_sku) {
    $.post("sku_id/" + id_sku, function(data, status) {

        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            if (data.status == "success") {

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
                var mujer_plus = data.sku.referencia_producto.substring(3, 4);
            
                var fila =
                '<tr id="fila'+data.sku.id+'">'+
                "<td class=''><input type='checkbox' id='checkboxtalla' value='"+data.sku.id+"' name='checkboxtalla'></td>"+
                "<td class='font-weight-bold'>"+data.sku.sku+"</td>"+
                "<td class='font-weight-bold' id='referencia_product'><input type='hidden' name='prod_id' id='prod_id' value='"+data.sku.producto_id+"'>"+data.sku.referencia_producto+"</td>"+
                "<td class='font-weight-bold'>"+data.sku.talla+"</td>"+
                "<td class='font-weight-bold'><input type='number' class='text-center' placeholder='Cantidad' name='cantidad' id='cantidad0' value='"+total+"'></td>"+
                "<td><a href='print_label/"+data.sku.id+"/"+total+"' target='_blank' id='enlaceprint0' onclick='redirigir(0,"+data.sku.id+");' class='btn btn-primary ml-1'> <i class='fas fa-print'></i></a></td>"+
                "</tr>";
                $("#permisos-agregados").append(fila);
            //    <button type='button' id='btn-print' class='btn btn-danger'><i class='fas fa-print'></i></button>
            //    $("#id").val(data.tela.id);
            //    $("#referencia").val(data.tela.referencia).attr('readonly', false);
    
                for (let i = 0; i < data.skus.length; i++) {
                    ///////////////////////////////////////
                    ///////////////////////////////////////
                    if (data.producto.genero == "2") {
                        if (mujer_plus == "7") {
                            var a = '12W';
                            var b = '14W';
                            var c = '16W';
                            var d = '18W';
                            var e = '20W';
                            var f = '22W';
                            var g = '24W';
                            var h = '26W';
                        } else {
                            var a = '0/0';
                            var b = '1/2';
                            var c = '3/4';
                            var d = '5/6';
                            var e = '7/8';
                            var f = '9/10';
                            var g = '11/12';
                            var h = '13/14';
                            var y = '15/16';
                            var j = '17/18';
                            var k = '19/20';
                            var l = '21/22';
                        }
                    } else if (data.producto.genero == "3" || data.producto.genero == "4") {
                            var a = '2';
                            var b = '4';
                            var c = '6';
                            var d = '8';
                            var e = '10';
                            var f = '12';
                            var g = '14';
                            var h = '16';
                    } else if (data.producto.genero == "1") {
                            var a = '28';
                            var b = '29';
                            var c = '30';
                            var d = '32';
                            var e = '34';
                            var f = '36';
                            var g = '38';
                            var h = '40';
                            var y = '42';
                            var j = '44';
                            var k = '46';
                    }

                    if (data.skus[i].talla == 'A') {
                        var talla = a;
                    } else if (data.skus[i].talla == 'B') {
                        var talla = b;
                    } else if (data.skus[i].talla == 'C') {
                        var talla = c;
                    } else if (data.skus[i].talla == 'D') {
                        var talla = d;
                    } else if (data.skus[i].talla == 'E') {
                        var talla = e;
                    } else if (data.skus[i].talla == 'F') {
                        var talla = f;
                    } else if (data.skus[i].talla == 'G') {
                        var talla = g;
                    } else if (data.skus[i].talla == 'H') {
                        var talla = h;
                    } else if (data.skus[i].talla == 'I') {
                        var talla = y;
                    } else if (data.skus[i].talla == 'J') {
                        var talla = j;
                    } else if (data.skus[i].talla == 'K') {
                        var talla = k;
                    } else if (data.skus[i].talla == 'L') {
                        var talla = l;
                    } 



                    ///////////////////////////////////////
                    ///////////////////////////////////////
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
                        "<td class='' id='referencia_product'>"+data.skus[i].referencia_producto+"</td>"+
                        "<td class=''>"+talla+"</td>"+
                        "<td class=''><input type='number' class='text-center' placeholder='Cantidad' name='cantidad' id='cantidad"+i+"' value='"+total+"'></td>"+
                        "<td><a href='print_label/"+data.skus[i].id+"/"+total+"' target='_blank' id='enlaceprint"+i+"' onclick='redirigir("+i+","+data.skus[i].id+");'class='btn btn-primary ml-1'> <i class='fas fa-print'></i></a></td>"+
                        "</tr>";
                        $("#permisos-agregados").append(fila);
                    }
                    
                }

            } else {
                bootbox.alert(
                    data.message
                );
            }
        
        }
     
    });
}