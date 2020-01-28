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
        bootbox.alert("Nota de credito guardada correctamente");
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
                { data: "name", name: 'users.name' },
                // { data: "referencia_producto", name: 'producto.referencia_producto', orderable: false, searchable: false },
                { data: "fecha", name: 'factura.fecha' },
                { data: "fecha_impresion", name: 'factura.fecha_impresion' },
                // { data: "total", name: 'orden_facturacion_detalle.total' },
                { data: "por_transporte", name: 'orden_facturacion.por_transporte' },
            ],
            order: [[4, 'desc']],
            rowGroup: {
                dataSrc: 'name' 
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
