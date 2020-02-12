$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#formulario").validate({
        rules: {
            precio_lista: {
                required: true,
                minlength: 3
            },
            precio_publico: {
                required: true,
                minlength: 4
            },
            descripcion: {
                required: true,
                minlength: 5
            },
            telefono_1: {
                required: true,
                minlength: 10
            },
            email_principal: {
                required: true,
                email: true
            },
            condiciones_credito: {
                required: true,
                minlengh: 1
            },
            rnc: {
                required: true,
                digits: true,
                minlengh: 9
            }
        },
        messages: {
            precio_lista: {
                required: "Este campo es obligatorio",
                minlength: "Este campo debe contener al menos 3 numeros"
            },
            direccion_principal: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 4 letras"
            },
            descripcion: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 5 letras"
            },
            telefono_1: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 10 caracteres"
            },
            email_principal: {
                required: "El email es obligatorio",
                email: "Debe itroducir un email valido"
            },
            condiciones_credito: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 1 caracter"
            },
            rnc: {
                required: "Este campo es obligatorio",
                minlengh: "Debe contener al menos 9 numeros",
                digits: "Este campo solo puedo contener numeros"
            }
        }
    });

    function init() {
        listar();
        mostrarForm(false);
        // $("#btn-edit").hide();
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

    $("#btnGenerar").on("click", function(e) {
        e.preventDefault();

        let sec_manual = $("#sec_manual").val();

        var i = Number(sec_manual) / 100;
        var e = Number(sec_manual) / 100;
        i = (i).toFixed(2).split(".").join("");
        i = i.substr(1, 4);

        var marca = $("#marca").val();
        var genero = $("#genero").val();
        var tipo_producto = $("#tipo_producto").val();
        var categoria = $("#categoria").val();
        var year = new Date().getFullYear().toString().substr(-2);
        var referencia = marca + genero + tipo_producto + categoria + "-" + year + i;
        $("#btn-sku").attr("disabled", false);

        if (genero == 3 || genero == 4) {
            $("#mostrarRef2").show();
            $("#precios_2").show();
            $("#descripcion_ref2").show();

            e = (e + 1).toFixed(1).split(".").join("");
            e = e.substr(1, 4);
            $("#referencia_2").val(
                marca + genero + tipo_producto + categoria + "-" + year + e
            );
        } else {
            $("#mostrarRef2").hide();
            $("#precios_2").hide();
            $("#descripcion_ref2").hide();
            $("#referencia_2").val("");
            $("#descripcion_2").val("");
            $("#precio_lista_2").val("");
            $("#precio_venta_publico_2").val("");
        }

        $("#referencia").val(referencia);

        let producto = {
            referencia_producto: referencia
        }
        // console.log(JSON.stringify(corte));

        $.ajax({
            url: "validar/referencia",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(producto),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {

                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        // timerProgressBar: true,
                        onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        type: 'success',
                        title: 'Referencia generada correctamente'
                    })


                    $("#btn-guardar").attr('disabled', false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function(datos) {
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Esta referencia ya fue creada!'
            })
            }
        });



    });




    $("#btn-guardar").click(function(e) {
        e.preventDefault();
        guardar();

    });


    function guardar(){
        var product = {
            referencia: $("#referencia").val(),
            referencia_2: $("#referencia_2").val(),
            sec: $("#sec").val(),
            descripcion: $("#descripcion").val(),
            descripcion_2: $("#descripcion_2").val(),
            precio_lista_2: $("#precio_lista_2").val(),
            precio_lista: $("#precio_lista").val(),
            precio_venta_publico: $("#precio_venta_publico").val(),
            precio_venta_publico_2: $("#precio_venta_publico_2").val()
        };

        $.ajax({
            url: "product",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(product),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Success',
                        'Referencia creada correctamente!',
                        'success'
                    )
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                    $("#referencia_talla").val("");

                } else {
                    bootbox.alert("Se genero la referencia");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    }

    var tabla;

    function listar() {
        tabla = $("#products").DataTable({
            serverSide: true,
            autoWidth: false,
            responsive: true,
            iDisplayLength: 5,
            ajax: "api/products",
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
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "name", name: "users.name" },
                {
                    data: "referencia_producto",
                    name: "producto.referencia_producto"
                },
                { data: "precio_lista", name: "producto.precio_lista" },
                {
                    data: "precio_venta_publico",
                    name: "producto.precio_venta_publico"
                },
                { data: "descripcion", name: "producto.descripcion" }
            ],
            order: [[2, "asc"]],
            rowGroup: {
                dataSrc: "name"
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var product = {
            id: $("#id").val(),
            referencia: $("#referencia").val(),
            descripcion: $("#descripcion").val(),
            referencia_2: $("#referencia_2").val(),
            precio_lista: $("#precio_lista").val(),
            precio_lista_2: $("#precio_lista_2").val(),
            precio_venta_publico_2: $("#precio_venta_publico_2").val(),
            precio_venta_publico: $("#precio_venta_publico").val(),
            sec: $("#sec").val()
        };

        // console.log(product);

        $.ajax({
            url: "product/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(product),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Success',
                        'Referencia actualizada correctamente!',
                        'success'
                    )
                    limpiar();
                    tabla.ajax.reload();
                    $("#id").val("");
                    $("#nombre_composicion").val("");
                    $("#listadoUsers").show();
                    $("#registroForm").hide();
                    $("#btnCancelar").hide();
                    $("#btn-edit").hide();
                    $("#btn-guardar").show();
                    $("#btnAgregar").show();
                    $("#sec").val("");
                } else {
                    bootbox.alert("Ocurrio un error durante la actualizacion");
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
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
            $("#btn-guardar").attr("disabled", true);
        }
    }

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        mostrarForm(false);
    });



    window.onresize = function() {
        tabla.columns.adjust().responsive.recalc();
    };

    init();
});

function mostrar(id_prouct) {
    $.post("product/" + id_prouct, function(data, status) {
        // data = JSON.parse(data);
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").show();
        $("#btn-guardar").hide();

        $("#id").val(data.product.id);
        $("#referencia").val(data.product.referencia_producto);
        $("#descripcion").val(data.product.descripcion);
        $("#precio_lista").val(data.product.precio_lista);
        $("#precio_lista_2").val(data.product.precio_lista_2);
        $("#precio_venta_publico").val(data.product.precio_venta_publico);
        $("#precio_venta_publico_2").val(data.product.precio_venta_publico_2);
    });
}


function eliminar(id_prouct){
    Swal.fire({
        title: '¿Esta seguro de eliminar esta referencia?',
        text: "Va a eliminar esta referencia!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("product/delete/" + id_prouct, function(){
                Swal.fire(
                    'Eliminado!',
                    'Referencia de producto eliminada correctamente.',
                    'success'
                    )
                $("#almacenes").DataTable().ajax.reload();
            })
        }
      })


}
