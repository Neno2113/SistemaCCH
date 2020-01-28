$(document).ready(function() {

    $("#formulario").validate({
        rules: {
            fecha_envio: {
                required: true,
                minlength: 1
            },
            cantidad: {
                required: true,
                minlength: 1,
                number: true
            },
            receta_lavado: {
                required: true,
                minlength: 10
            }
          
        },
        messages: {
            fecha_envio: {
                required: "La fecha en envio es obligatoria",
                minlength: "La fecha en envio es obligatoria"
            },
            cantidad: {
                required: "La cantidad es un campo numerico obligatorio.",
                minlength: "La cantidad es un campo numerico obligatorio.",
                number: "Este campo solo admite numeros."
            },
            receta_lavado: {
                required: "La receta de lavado es obligatoria",
                minlength: "La receta de lavado debe conteneer al menos 10 caracteres"
            }
        }
    })
   

    var tabla

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
    }


    $("#receta_lavado").on('keyup', function(){
        $("#btn-guardar").attr('disabled', false);
    })




    function listar() {
        tabla = $("#ordenes_aprobacion").DataTable({
            serverSide: true,
            responsive: true,
            dom: "Bfrtip",
            iDisplayLength: 5,
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
                // { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "no_orden_pedido",name: "orden_pedido.no_orden_pedido"},
                { data: "nombre", name: "empleado.nombre" },
                { data: "nombre_cliente", name: "cliente.nombre_cliente" },
                { data: "nombre_sucursal", name: "cliente_sucursales.nombre_sucursal"},
                { data: "fecha", name: "orden_pedido.fecha" },
                { data: "fecha_entrega", name: "orden_pedido.fecha_entrega" },
                { data: "fecha_aprobacion", name: "orden_pedido.fecha_aprobacion" },
                { data: "total", name: "orden_pedido.total", searchable: false  },
                { data: "status_orden_pedido", name: "orden_pedido.status_orden_pedido" },
            ],
            order: [[1, "desc"]],
            // rowGroup: {
            //     dataSrc: "name"
            // }
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
            $("#btnCancelar").hide();
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
        mostrarForm(false);
       

    });
  

    init();
});
