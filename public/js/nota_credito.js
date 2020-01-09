$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#formulario").validate({
        rules: {
            no_marcada: {
                required: true,
                minlength: 1,
                number: true
            },
            ancho_marcada: {
                required: true,
                minlength: 1,
                number: true
            },
            largo_marcada: {
                required: true,
                minlength: 1,
                number: true
            },
        },
        messages: {
            no_marcada: {
                required: "El numero de marcada es obligatorio",
                minlength: "Debe contener al menos 1 numero",
                number: "Este campo solo admite numeros"
            },
            ancho_marcada: {
                required: "El ancho de la marcada es obligatorio",
                minlength: "Debe contener al menos 1 numero",
                number: "Este campo solo admite numeros"
            },
            largo_marcada: {
                required: "El largo de la marcada es obligatorio",
                minlength: "Debe contener al menos 1 numero",
                number: "Este campo solo admite numeros"
            },
           

        }
    })
   

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



    //funcion que envia los datos del form al backend usando AJAX
    $("#btn-guardar").click(function(e){
        e.preventDefault();
        
        var nota_credito = {
            sec: $("#sec").val(),
            no_nota_credito: $("#no_nota_credito").val(),
            factura_id: $("#factura_id").val(),
            tipo_nota_credito: $("#tipo_nota_credito").val(), 
            precio_lista_factura: $("#precio_lista_factura").val(),
            a: $("#a").val(),
            b: $("#b").val(),
            c: $("#c").val(),
            d: $("#d").val(),
            e: $("#e").val(),
            f: $("#f").val(),
            g: $("#g").val(),
            h: $("#h").val(),
            i: $("#i").val(),
            j: $("#j").val(),
            k: $("#k").val(),
            l: $("#l").val(),
        };

        $.ajax({
            url: "nota-credito",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(nota_credito),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Nota de credito <strong>"+datos.nota_credito.no_nota_credito+"</strong> creada correctamente.");
                    ncCod();
                    mostrarForm(false);
                    $("#facturas_listadas").DataTable().ajax.reload();
                   
            
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
                { data: "referencia_producto", name: 'producto.referencia_producto', orderable: false, searchable: false },
                { data: "fecha", name: 'factura.fecha' },
                { data: "fecha_impresion", name: 'factura.fecha_impresion' },
                { data: "total", name: 'orden_facturacion_detalle.total' },
                { data: "por_transporte", name: 'orden_facturacion.por_transporte' },
            ],
            order: [[2, 'desc']],
            rowGroup: {
                dataSrc: 'no_factura' 
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

    $("#btn-buscar").click(function(e) {
        e.preventDefault();

       
        var id = $("#cortesSearch").val()
        
        $.ajax({
            url: "talla/search/"+ id,
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se consulto correctamente!!");
                    $("#a").val(datos.talla.a);
                    $("#b").val(datos.talla.b);
                    $("#c").val(datos.talla.c);
                    $("#d").val(datos.talla.d);
                    $("#e").val(datos.talla.e);
                    $("#f").val(datos.talla.f);
                    $("#g").val(datos.talla.g);
                    $("#h").val(datos.talla.h);
                    $("#i").val(datos.talla.i);
                    $("#j").val(datos.talla.j);
                    $("#k").val(datos.talla.k);
                    $("#l").val(datos.talla.l);
                    $("#total").val(datos.talla.total);
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

    $("#btn-generar").click(function(e){
        e.preventDefault();
        let year = $("#year").val();
        let sec_manual = $("#sec_manual").val();
        let referencia = year + "-"+ sec_manual;

        let corte = {
            numero_corte: referencia
        }
        // console.log(JSON.stringify(corte));

        $.ajax({
            url: "verificacion/corte",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                  
                    $("#numero_corte_gen").val(referencia);
                    $("#corte").val(referencia);
                    $("#numero_corte").val(referencia);
                    $("#corte_tallas").val(referencia); 
                    
                    $("#fila1").show();
                    $("#fila2").show();
                    $("#fila3").show();
                    bootbox.alert("Corte generado correctamente");
                    $("#btn-generar").attr('disabled', true);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
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



    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#edit-hide").attr("disabled", false);
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#fila1").hide();
            $("#fila2").hide();
            $("#fila3").hide();
            // $("#btn-guardar").attr("disabled", true);
            $("#btn-edit").hide();
            $("#btn-guardar").show();
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

    window.onresize = function() {
        tabla.columns.adjust().responsive.recalc();
    } 
  

    init();
});
