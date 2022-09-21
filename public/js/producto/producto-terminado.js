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
    }

    var tabla

    function listar() {
        tabla = $("#producto-terminado").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/producto-terminado",
            dom: 'Bfrtip',
            iDisplayLength: 5,
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
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "referencia_producto", name: "producto.referencia_producto" },
                { data: "tono", name: "producto.tono" },
                { data: "intensidad_proceso_seco", name: "producto.intensidad_proceso_seco" },
                { data: "atributo_no_1", name: "producto.atributo_no_1" },
                { data: "descripcion", name: "producto.descripcion" }
            ],
            order: [[2, "desc"]],
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
        $("#imagen_frente").attr("href", './producto/terminado/'+data.product.imagen_frente)
        $("#imagen_frente_img").attr("src", './producto/terminado/'+data.product.imagen_frente)
        $("#imagen_trasera").attr("href", './producto/terminado/'+data.product.imagen_trasero)
        $("#imagen_trasera_img").attr("src", './producto/terminado/'+data.product.imagen_trasero)
        $("#imagen_perfil").attr("href", './producto/terminado/'+data.product.imagen_perfil);
        $("#imagen_perfil_img").attr("src", './producto/terminado/'+data.product.imagen_perfil)
        $("#imagen_bolsillo").attr("href", './producto/terminado/'+data.product.imagen_bolsillo);
        $("#imagen_bolsillo_img").attr("src", './producto/terminado/'+data.product.imagen_bolsillo)
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
