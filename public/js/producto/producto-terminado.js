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
        $("#imagen_frente").attr("href", '/avatar/1663764719foto%20jeans%20default.jpg');
        $("#imagen_frente_img").attr("src", '/avatar/1663764719foto%20jeans%20default.jpg');
        $("#imagen_trasera").attr("href", '/avatar/1663764719foto%20jeans%20default.jpg');
        $("#imagen_trasera_img").attr("src", '/avatar/1663764719foto%20jeans%20default.jpg');
        $("#imagen_perfil").attr("href", '/avatar/1663764719foto%20jeans%20default.jpg');
        $("#imagen_perfil_img").attr("src", '/avatar/1663764719foto%20jeans%20default.jpg');
        $("#imagen_bolsillo").attr("href", '/avatar/1663764719foto%20jeans%20default.jpg');
        $("#imagen_bolsillo_img").attr("src", '/avatar/1663764719foto%20jeans%20default.jpg');
    }

    var tabla

    function listar() {
        tabla = $("#producto-terminado").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/producto-terminado",
            dom: 'Bfrtip',
            iDisplayLength: 25,
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
            //    { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "referencia_producto", name: "producto.referencia_producto" },
                { data: "tono", name: "producto.tono" },
                { data: "intensidad_proceso_seco", name: "producto.intensidad_proceso_seco" },
                { data: "atributo_no_1", name: "producto.atributo_no_1" },
                { data: "atributo_no_2", name: "producto.atributo_no_2" },
                { data: "atributo_no_3", name: "producto.atributo_no_3" },
                { data: "descripcion", name: "producto.descripcion" }
            ],
            order: [[1, "desc"]],
            /*
            rowGroup: {
                dataSrc: "name"
            } */
        });
    }



    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#imageCard").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#imageCard").hide();
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




    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        mostrarForm(false);
    });




    init();
});


$(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
});

function mostrar(id_prouct) {
    $.post("product-terminado/" + id_prouct, function(data, status) {
        // data = JSON.parse(data);
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#imageCard").show();
        $("#btnCancelar").show();
        $("#btn-guardar").hide();

        $("#referencia_producto").val(data.product.referencia_producto);
        $("#descripcion").val(data.product.descripcion);
        $("#ubicacion").val(data.product.ubicacion);
        $("#tono").val(data.product.tono);
        $("#intensidad_proceso_seco").val(data.product.intensidad_proceso_seco);
        $("#atributo_no_1").val(data.product.atributo_no_1);
        $("#atributo_no_2").val(data.product.atributo_no_2);
        $("#atributo_no_3").val(data.product.atributo_no_3);
        $("#precio_lista").val(data.product.precio_lista+" RD$");
        $("#precio_lista_2").val(data.product.precio_lista_2);
        $("#precio_venta_publico").val(data.product.precio_venta_publico+" RD$");
        $("#precio_venta_publico_2").val(data.product.precio_venta_publico_2);
        $("#cantidad").val(data.almacen.total);
    //    $("#imagen_frente").attr("href", './producto/terminado/'+data.product.imagen_frente);
    //    $("#imagen_frente_img").attr("src", './producto/terminado/'+data.product.imagen_frente);
    //    $("#imagen_trasera").attr("href", './producto/terminado/'+data.product.imagen_trasero);
    //    $("#imagen_trasera_img").attr("src", './producto/terminado/'+data.product.imagen_trasero);
    //    $("#imagen_perfil").attr("href", './producto/terminado/'+data.product.imagen_perfil);
    //    $("#imagen_perfil_img").attr("src", './producto/terminado/'+data.product.imagen_perfil);
    //    $("#imagen_bolsillo").attr("href", './producto/terminado/'+data.product.imagen_bolsillo);
    //    $("#imagen_bolsillo_img").attr("src", './producto/terminado/'+data.product.imagen_bolsillo);

        let cant_cortes = data.cortes.length;
            for (let z = 0; z < cant_cortes; z++) {
                var fila_cortes =  "<tr>"+
                "<td>"+[z+1]+"</td>"+
                "<td>"+data.cortes[z].numero_corte+"</td>"+
                "</tr>";
                $("#lista_cortes").append(fila_cortes);
            }

            var mujer_plus = data.product.referencia_producto.substring(3, 4);
            if (data.product.genero == "2") {
                if (mujer_plus == "7") {
                    var a = '12W';
                    var b = '14W';
                    var c = '16W';
                    var d = '18W';
                    var e = '20W';
                    var f = '22W';
                    var g = '24W';
                    var h = '26W';
                    var all = "12W - 26W";
                } else {
                    var a = '0/0';
                    var b = '1/2';
                    var c = '3/4';
                    var d = '5/6';
                    var e = '7/8';
                    var f = '9/10';
                    var g = '11/12';
                    var h = '13/14';
                    var i = '15/16';
                    var j = '17/18';
                    var k = '19/20';
                    var l = '21/22';
                    var all = "0/0 - 21/22";
                }
            } else if (data.product.genero == "3" || data.product.genero == "4") {
                    var a = '2';
                    var b = '4';
                    var c = '6';
                    var d = '8';
                    var e = '10';
                    var f = '12';
                    var g = '14';
                    var h = '16';
                    var all = "2 - 16";
            } else if (data.product.genero == "1") {
                    var a = '28';
                    var b = '29';
                    var c = '30';
                    var d = '32';
                    var e = '34';
                    var f = '36';
                    var g = '38';
                    var h = '40';
                    var i = '42';
                    var j = '44';
                    var k = '46';
                    var all = "28 - 46";
            }

        let cant_skus = data.skus.length;

            for (let x = 0; x < cant_skus; x++) {
                if (data.skus[x].talla == "General") {
                    var talla = all;
                }
                if (data.skus[x].talla == 'A') {
                    var talla = a;
                } else if (data.skus[x].talla == 'B') {
                    var talla = b;
                } else if (data.skus[x].talla == 'C') {
                    var talla = c;
                } else if (data.skus[x].talla == 'D') {
                    var talla = d;
                } else if (data.skus[x].talla == 'E') {
                    var talla = e;
                } else if (data.skus[x].talla == 'F') {
                    var talla = f;
                } else if (data.skus[x].talla == 'G') {
                    var talla = g;
                } else if (data.skus[x].talla == 'H') {
                    var talla = h;
                } else if (data.skus[x].talla == 'I') {
                    var talla = i;
                } else if (data.skus[x].talla == 'J') {
                    var talla = j;
                } else if (data.skus[x].talla == 'K') {
                    var talla = k;
                } else if (data.skus[x].talla == 'L') {
                    var talla = l;
                } 
                
                var fila_skus =  "<tr>"+
                "<td>"+data.skus[x].sku+"</td>"+
                "<td>"+talla+"</td>"+
                "</tr>";
                $("#lista_skus").append(fila_skus);
            }
        
    });
}


function eliminar(id_prouct){
bootbox.confirm("¿Estas seguro de eliminar esta referencia?", function(result){
if(result){
    $.post("product/delete/" + id_prouct, function(){
        // bootbox.alert(e);
        bootbox.alert("Referencia eliminada correctamente!!");
        $("#products").DataTable().ajax.reload();
    })
}
})
}
