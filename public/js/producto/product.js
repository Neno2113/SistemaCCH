var min_global;
var max_global;
var genero_global;
var genero_plus;
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
        catalogos();
        $('#range_1').ionRangeSlider({
            min     : 02,
            max     : 16,
            from    : 08,
            to      : 16,
            type    : 'double',
            step    : 02,
            prefix  : 'T',
            skin    : "round",
            prettify: false,
            hasGrid : true,
            onStart: function (data) {
                max_global = data.to;
                min_global = data.from;
            },
            onChange: function (data) {

                min_global = data.from;
            },
            onFinish: function (data) {

                max_global = data.to;
            },
        })
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
        $("#frente").attr("src", '');
        $("#trasera").attr("src", '');
        $("#perfil").attr("src", '');
        $("#bolsillo").attr("src", '');
    }

    $("#btnGenerar").on("click", function(e) {
        e.preventDefault();

        let sec_manual = $("#sec_manual").val();
        // let year =
        let sec_manual_2 = Number(sec_manual) + 1;

        var i = Number(sec_manual) / 100;
        var e = Number(sec_manual_2) / 100;
        i = (i).toFixed(2).split(".").join("");
        i = i.substr(1, 4);


        var marca = $("#marca").val();
        var genero = $("#genero").val();
        var tipo_producto = $("#tipo_producto").val();
        var categoria = $("#categoria").val();
        var year = $("#year").val().toString().substr(+2);
        var referencia = marca + genero + tipo_producto + categoria + "-" + year + i;
        $("#btn-sku").attr("disabled", false);

        genero_global = $("#genero").val();
        genero_plus = $("#categoria").val();
        tallas();
        $("#btn-curva").attr("disabled", false);

        if (genero == 3 || genero == 4) {
            $("#mostrarRef2").show();
            $("#precios_2").show();
            $("#descripcion_ref2").show();

            e = (e).toFixed(2).split(".").join("");
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
                } else if(datos.status == "validation"){
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'Esta referencia ya fue creada!'
                    })
                }
            },
            error: function(datos) {
         
            }
        });

    });

    function catalogos(){

        $.ajax({
            url: "catalogo-select",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.catalogo.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila =
                        "<option value='' disabled>Cuenta Catalogo</option>"+
                        "<option value=" +datos.catalogo[i].id +">"+datos.catalogo[i].codigo+"</option>";
                        $("#tipo_cuenta").append(fila);
                    }
                    $("#tipo_cuenta").select2();
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


    $("#btn-guardar").click(function(e) {
        e.preventDefault();
        guardar();

    });


    function guardar(){

        var product = {
            referencia: $("#referencia").val(),
            referencia_2: $("#referencia_2").val(),
            sec: $("#sec").val(),
            genero: $("#genero").val(),
            catalogo: $("#tipo_cuenta").val(),
            descripcion: $("#descripcion").val(),
            descripcion_2: $("#descripcion_2").val(),
            precio_lista_2: $("#precio_lista_2").val(),
            precio_lista: $("#precio_lista").val(),
            precio_venta_publico: $("#precio_venta_publico").val(),
            precio_venta_publico_2: $("#precio_venta_publico_2").val(),
            marca: $("#marca option:selected").text(),
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
            min: min_global,
            max: max_global
        };

        $.ajax({
            url: "product",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(product),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#product_id").val(datos.producto.id);
                    

                    var formData = new FormData($("#formUpload")[0]);
            
                    $.ajax({
                        url: "product/imagen",
                        type: "POST",
                        data: formData,
                        dataType: "JSON",
                        processData: false,
                        cache: false,
                        contentType: false,
                        success: function(datos) {
                            if (datos.status == "success") {
                            
                                $("#imagen_frente").val("");
                                $("#imagen_trasera").val("");
                                $("#imagen_perfil").val("");
                                $("#imagen_bolsillo").val("");
                            } else {
                                bootbox.alert(
                                    "Ocurrio un error durante la creacion de la composicion"
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
             
                { data: "referencia_producto", name: "producto.referencia_producto"},
                { data: "name", name: "users.name" },
                { data: "precio_lista", name: "producto.precio_lista" },
                { data: "precio_venta_publico", name: "producto.precio_venta_publico"},
                { data: "descripcion", name: "producto.descripcion" }
            ],
            order: [[4, "desc"]],
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
            catalogo: $("#tipo_cuenta").val(),
            precio_lista: $("#precio_lista").val(),
            precio_lista_2: $("#precio_lista_2").val(),
            precio_venta_publico_2: $("#precio_venta_publico_2").val(),
            precio_venta_publico: $("#precio_venta_publico").val(),

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
            min: min_global,
            max: max_global
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
            $("#btn-curva").attr("disabled", true);
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


    function calcularPorcentaje(){
        let a = isNaN(parseFloat($("#a").val())) ? 0: parseFloat($("#a").val());
        let b = isNaN(parseFloat($("#b").val())) ? 0: parseFloat($("#b").val());
        let c = isNaN(parseFloat($("#c").val())) ? 0: parseFloat($("#c").val());
        let d = isNaN(parseFloat($("#d").val())) ? 0: parseFloat($("#d").val());
        let e = isNaN(parseFloat($("#e").val())) ? 0: parseFloat($("#e").val());
        let f = isNaN(parseFloat($("#f").val())) ? 0: parseFloat($("#f").val());
        let g = isNaN(parseFloat($("#g").val())) ? 0: parseFloat($("#g").val());
        let h = isNaN(parseFloat($("#h").val())) ? 0: parseFloat($("#h").val());
        let i = isNaN(parseFloat($("#i").val())) ? 0: parseFloat($("#i").val());
        let j = isNaN(parseFloat($("#j").val())) ? 0: parseFloat($("#j").val());
        let k = isNaN(parseFloat($("#k").val())) ? 0: parseFloat($("#k").val());
        let l = isNaN(parseFloat($("#l").val())) ? 0: parseFloat($("#l").val());
        let total = a + b + c + d + e + f + g + h + i + j + k + l;
        $("#total_percent").val(total+"%");
        if(total == 100){
            $("#btn-guardar").attr("disabled", false);
            $("#btn-curva").removeClass("btn-secondary").addClass("btn-success");
        }else{
            $("#btn-guardar").attr("disabled", true);
        }
    }


    //calculo porcentajes de los inputs
    $("#a, #b, #c, #d, #e, #f, #g, #h, #i, #j, #k, #l").keyup(function(){
        calcularPorcentaje()

    })

  
    // $("#btn-upload").on('click', (e) => {
    //     e.preventDefault();
    //     console.log($("#formUpload"));
    // })

    init();
});


function tallas(){
    if (genero_global == "2") {
        if(genero_plus == "7"){

            $("#ta").html("12W");
            $("#tb").html("14W");
            $("#tc").html("16W");
            $("#td").html("18W");
            $("#te").html("20W");
            $("#tf").html("22W");
            $("#tg").html("24W");
            $("#th").html("26W");

        }else{

            $("#ta").html("0/0");
            $("#tb").html("1/2");
            $("#tc").html("3/4");
            $("#td").html("5/6");
            $("#te").html("7/8");
            $("#tf").html("9/10");
            $("#tg").html("11/12");
            $("#th").html("13/14");
            $("#ti").html("15/16");
            $("#tj").html("17/18");
            $("#tk").html("19/20");
            $("#tl").html("21/22");

        }
    }
    if (genero_global == "3" || genero_global == "4") {

        $("#sub-genero").hide();
        $("#ta").html("2");
        $("#tb").html("4");
        $("#tc").html("6");
        $("#td").html("8");
        $("#te").html("10");
        $("#tf").html("12");
        $("#tg").html("14");
        $("#th").html("16");

    }  else if (genero_global == "1") {

        $("#ta").html("28");
        $("#tb").html("29");
        $("#tc").html("30");
        $("#td").html("32");
        $("#te").html("34");
        $("#tf").html("36");
        $("#tg").html("38");
        $("#th").html("40");
        $("#ti").html("42");
        $("#tj").html("44");

    }
}

function mostrar(id_prouct) {
    $.post("product/" + id_prouct, function(data, status) {

        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();

            $("#id").val(data.product.id);
            $("#product_id").val(data.product.id);
            $("#referencia").val(data.product.referencia_producto);
            $("#descripcion").val(data.product.descripcion);
            $("#precio_lista").val(data.product.precio_lista);
            $("#precio_lista_2").val(data.product.precio_lista_2);
            $("#precio_venta_publico").val(data.product.precio_venta_publico);
            $("#precio_venta_publico_2").val(data.product.precio_venta_publico_2);
            $("#a").val(data.a);
            $("#b").val(data.b);
            $("#c").val(data.c);
            $("#d").val(data.d);
            $("#e").val(data.e);
            $("#f").val(data.f);
            $("#g").val(data.g);
            $("#h").val(data.h);
            $("#i").val(data.i);
            $("#j").val(data.j);
            $("#k").val(data.k);
            $("#l").val(data.l);
            $("#frente").attr("src", '/sistemaCCH/public/producto/terminado/'+data.product.imagen_frente);
            $("#trasera").attr("src", '/sistemaCCH/public/producto/terminado/'+data.product.imagen_trasero);
            $("#perfil").attr("src", '/sistemaCCH/public/producto/terminado/'+data.product.imagen_perfil);
            $("#bolsillo").attr("src", '/sistemaCCH/public/producto/terminado/'+data.product.imagen_bolsillo);
            genero_global = data.product.genero;
            genero_plus = data.product.referencia_producto.substring(3, 4);
            let marca = data.product.referencia_producto.substring(0, 1);
            let genero = data.product.referencia_producto.substring(1, 2);
            let tipo_producto = data.product.referencia_producto.substring(2, 3);
            let categoria = data.product.referencia_producto.substring(3, 4);
            $("#marca").val(marca);
            $("#genero").val(genero);
            $("#tipo_producto").val(tipo_producto);
            $("#categoria").val(categoria);
            tallas();
        }
        
    });
}


function eliminar(id_prouct){
    $.post("productcheck/delete/" + id_prouct, function(data, status) {
        // console.log(data);
        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            Swal.fire({
                title: '¿Esta seguro de eliminar esta referencia?',
                text: `Solo puede eliminar referencias recien creadas que no se encuentren en uso.`,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto'
              })
              .then((result) => {
                if(result.value){
                    EliminarProducto(id_prouct);
                }
                
              });
        }
  
    })

}

const EliminarProducto = (id) => {

    $.ajax({
        url: "product/delete/"+id,
        type: "POST",
        dataType: "json",
        // data: JSON.stringify(permiso),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                // console.log(datos);
                Swal.fire(
                    'Eliminado!',
                    'Referencia  eliminada correctamente.',
                    'success'
                    )
                $("#products").DataTable().ajax.reload();

            } else {
                bootbox.alert(
                    "Ocurrio un error durante la creacion del usuario verifique los datos suministrados!!"
                );
            }
        },
        error: function(datos) {
            Swal.fire(
            'Info!',
            'Esta referencia no puede ser borrada ya que se encuentra en uso.',
            'info'
            )
        }
    });
}


