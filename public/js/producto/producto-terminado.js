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
                { data: "precio_lista", name: "producto.precio_lista" },
                { data: "precio_venta_publico", name: "producto.precio_venta_publico" },
                { data: "descripcion", name: "producto.descripcion" }              
            ]
        });
    }

   

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
        mostrarForm(false);
    });


  
  
    init();
});
