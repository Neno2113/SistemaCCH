var min_global;
var max_global;
var genero_global;
var genero_plus;
$(document).ready(function() {

    $("[data-mask]").inputmask();


    // $("#formulario").validate({
    //     rules: {
    //         precio_lista: {
    //             required: true,
    //             minlength: 3
    //         },
    //         precio_publico: {
    //             required: true,
    //             minlength: 4
    //         },
    //         descripcion: {
    //             required: true,
    //             minlength: 5
    //         },
    //         telefono_1: {
    //             required: true,
    //             minlength: 10
    //         },
    //         email_principal: {
    //             required: true,
    //             email: true
    //         },
    //         condiciones_credito: {
    //             required: true,
    //             minlengh: 1
    //         },
    //         rnc: {
    //             required: true,
    //             digits: true,
    //             minlengh: 9
    //         }
    //     },
    //     messages: {
    //         precio_lista: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Este campo debe contener al menos 3 numeros"
    //         },
    //         direccion_principal: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 4 letras"
    //         },
    //         descripcion: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 5 letras"
    //         },
    //         telefono_1: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 10 caracteres"
    //         },
    //         email_principal: {
    //             required: "El email es obligatorio",
    //             email: "Debe itroducir un email valido"
    //         },
    //         condiciones_credito: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 1 caracter"
    //         },
    //         rnc: {
    //             required: "Este campo es obligatorio",
    //             minlengh: "Debe contener al menos 9 numeros",
    //             digits: "Este campo solo puedo contener numeros"
    //         }
    //     }
    // });

    function init() {
        listar();
        mostrarForm(false);
        catalogos();
        //Cristobal
        $("#btn-rollos").hide();
    }


    const slider = () => {
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
        $('#referencia_talla').val('');
        $("#precio_venta_publico_2").val("");
        $("#entalle_bragueta").val("");
        $("#entalle_piernas").val("");
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
        $("#sku").val("");
        $("#referencia_talla_2").hide();
        $("#productos_ref").hide();
        $("#segunda_ref").hide();
    }

//    $("#btnGenerar").on("click", function(e) {
    $("#sec_manual").keyup(function(e){
        e.preventDefault();

        let sec_manual = $("#sec_manual").val();
        // let year =
        let sec_manual_2 = Number(sec_manual) + 1;

        var i = Number(sec_manual) / 100;
        var e = Number(sec_manual_2) / 100;
        i = (i).toFixed(2).split(".").join("");
        i = i.substr(1, 4);


        var marca = $("#marca option:selected").text().substring(0,1);

        var genero = $("#genero").val();
        var tipo_producto = $("#tipo_producto").val();
        var categoria = $("#categoria").val();
        var year = $("#year").val().toString().substr(+2);
        var referencia = marca + genero + tipo_producto + categoria + "-" + year + i;
        // $("#btn-sku").attr("disabled", false);
        //console.log(marca);

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
                    $("#referencia_talla").val(referencia);
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
            marca: $("#marca").val(),
            entalle_bragueta: $("#entalle_bragueta").val(),
            entalle_piernas: $("#entalle_piernas").val(),
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

                    // CRISTOBAL
                    $("#id").val(datos.producto.id);
                    $("#referencia_talla").val(datos.producto.referencia_producto);

                    genero_global = datos.producto.genero;
                    genero_plus = datos.producto.referencia_producto.substring(3, 4);
                    eliminarColumnas();

                    if(datos.producto.referencia_producto_2){
                        $("#referencia_talla_2").show();
                        $("#productos_ref").show();
                        $("#segunda_ref").show();
                        $("#referencia_talla_2").val(datos.producto.referencia_producto_2);
        
                        $("#productos_ref").append(
                            `<option value="${datos.producto.id}">${datos.producto.referencia_producto}</option>`
                        );
        
                        $("#productos_ref").append(
                            `<option value="${datos.producto.id}">${datos.producto.referencia_producto_2}</option>`
                        );
                    }
                    // CRISTOBAL

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
                        '¡¡Referencia Creada!!',
                        'Procede a asignar los SKUs correspondientes.',
                        'success'
                    )
                
                    $(".bd-sku-modal-xl").modal('show');

                } else {
                 //   bootbox.alert("Se genero la referencia");
                    bootbox.alert("¿¿¿¿¿?????");
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
            iDisplayLength: 25,
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
            //    { data: "Expandir", orderable: false, searchable: false },
                { data: "id", name: "producto.id" },
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "referencia_producto", name: "producto.referencia_producto"},
                { data: "name", name: "users.name" },
                { data: "precio_lista", name: "producto.precio_lista" },
                { data: "precio_venta_publico", name: "producto.precio_venta_publico"},
                { data: "descripcion", name: "producto.descripcion" }
            ],
            order: [[0, "desc"]],
           /* rowGroup: {
                dataSrc: "name"
            } */
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var product = {
            id: $("#id").val(),
            referencia: $("#referencia").val(),
            referencia_2: $("#referencia_2").val(),
            descripcion: $("#descripcion").val(),
            descripcion_2: $("#descripcion_2").val(),
            catalogo: $("#tipo_cuenta").val(),
            precio_lista: $("#precio_lista").val(),
            precio_lista_2: $("#precio_lista_2").val(),
            precio_venta_publico_2: $("#precio_venta_publico_2").val(),
            precio_venta_publico: $("#precio_venta_publico").val(),
            entalle_bragueta: $("#entalle_bragueta").val(),
            entalle_piernas: $("#entalle_piernas").val(),

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
                        'Referencia actualizada!!',
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
            $("#boton-sku").hide();
            marcas();
            generos();
            tipos();
            categorias();
            slider();
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#mostrarRef2").hide();
            $("#precios_2").hide();
            $("#descripcion_ref2").hide();
            $("#btn-rollos").removeClass("btn-success").addClass("btn-orange");
            // $("#btn-sku").attr("disabled", true);
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#btn-guardar").attr("disabled", true);
        }
    }
    
    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        mostrarForm(true);
        $("#tallas").empty();
        $("#talla").empty();
        $("#sec_manual").val('');
        $("#year").val('');
        /*
        let lastid = parseInt($("#lastID").val());
        lastid += 1;
        $("#id").val(lastid); 
        */
    });

    $("#terminarSKU, #cerrarSKU").click(function(e) {
        e.preventDefault();

        limpiar();
        tabla.ajax.reload();
        mostrarForm(false);
        $("#referencia_talla").val("");
 
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
            $("#btn-curva").removeClass("btn-orange").addClass("btn-success");
        }else{
            $("#btn-guardar").attr("disabled", true);
        }
    }

    $('#modalRollos').on('hidden.bs.modal', function (e) {
        e.preventDefault();
        $("#btn-rollos").removeClass("btn-orange").addClass("btn-success");
    })


    //calculo porcentajes de los inputs
    $("#a, #b, #c, #d, #e, #f, #g, #h, #i, #j, #k, #l").keyup(function(){
        calcularPorcentaje()

    })

    //CRISTOBAL
    /*
    $("#btn-sku").on('click', (e) => {
        e.preventDefault();
        let referTemp = $("#referencia").val();
        $("#referencia_talla").val(referTemp); 
        
        genero_global = $("#referencia").val().substring(1, 2);
        genero_plus = $("#referencia").val().substring(3, 4);
        eliminarColumnas();
        
    })
    */
    //CRISTOBAL

    $("#btn-saveSku").on('click', (e) => {
        e.preventDefault();

        const sku_check = document.getElementById('sku').value;

        if(sku_check){

            let data = {
                producto: $("#id").val(),
                sku: $("#sku").val(),
                talla: $("#talla").val(),
                // ref: $('#productos_ref').val(),
                referencia: $("#productos_ref option:selected").text()
            }
    
            $.ajax({
                url: "sku-save",
                type: "POST",
                dataType: "json",
                data: JSON.stringify(data),
                contentType: "application/json",
                success: function(datos) {
                    if (datos.status == "success") {
                        $("#sku").val('');
                        let talla = $(
                            "#talla option:selected"
                        ).text();
    
                        // let fila =
                        // '<tr id="fila'+datos.sku.id+'">'+
                        // "<td class='font-weight-bold'><input type='hidden' id='sku"+datos.sku.id+"' value="+sku.id+">"+datos.sku.sku+"</td>"+
                        // "<td class='font-weight-bold'><input type='hidden' id='permiso"+datos.sku.id+"' value="+datos.sku.id+">"+datos.sku.referencia_producto+"</td>"+
                        // "<td class='font-weight-bold'><input type='hidden' id='permiso"+datos.sku.id+"' value="+datos.sku.id+">"+talla+"</td>"+
                        // "<td>"+
                        // "<button type='button' id='btn-eliminar' onclick='editSKU("+datos.sku.id+")'   class='btn btn-light mr-2'><i class='far fa-edit'></i></button>"+
                        // "<button type='button' id='btn-eliminar' onclick='delSKU("+datos.sku.id+")'  class='btn btn-danger'><i class='far fa-trash-alt'></i></button></td>"+
                        // "</tr>";
                        // $("#tallas").append(fila);

                        skus( datos )
    
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
                            title: 'SKU agregado correctamente!'
                        })
                    } else if(datos.status == 'validation') {
                        Swal.fire(
                            `${datos.sku.referencia_producto}`,
                            `Este SKU ya esta asignado.`,
                            'info'
                            )
                    } else if(datos.status == 'talla_exist'){
                        Swal.fire(
                        `SKU asignado.`,
                        datos.message,
                        'info'
                        )
                    }
                },
                error: function() {
                    bootbox.alert(
                        "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                    );
                }
            });
        } else {
            Swal.fire(
            `Digite un SKU`,
            `No digito un SKU.`,
            'info'
            )
        }

    })
 

    $("#btn-cat").on('click', (e) => {
        e.preventDefault();
        let select = $("#btn-cat").val();
        $("#tipo").val(select);
        listarCategorias(select);
    })
    $("#btn-mar").on('click', (e) => {
        e.preventDefault();
        let select = $("#btn-mar").val();
        $("#tipo").val(select);
        listarCategorias(select);
    })
    $("#btn-gen").on('click', (e) => {
        e.preventDefault();
        let select = $("#btn-gen").val();
        $("#tipo").val(select);
        listarCategorias(select);
    })
    $("#btn-tipo").on('click', (e) => {
        e.preventDefault();
        let select = $("#btn-tipo").val();
        $("#tipo").val(select);
        listarCategorias(select);
    })
    $("#btn-bra").on('click', (e) => {
        e.preventDefault();
        let select = $("#btn-bra").val();
        $("#tipo").val(select);
        listarCategorias(select);
    })
    $("#btn-pier").on('click', (e) => {
        e.preventDefault();
        let select = $("#btn-pier").val();
        $("#tipo").val(select);
        listarCategorias(select);
    })

    init();
    $("#btn-save").on('click', () => {
    
        let data = {
            tipo: $("#tipo").val(),
            indice: $("#indice").val(),
            nombre: $("#nombre").val()
        }
    

        $.ajax({
            url: "categoria",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(data),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
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
                        title: 'Nueva entrada registrada.'
                    })
                    $("#indice").val('');
                    $("#nombre").val('');
                    marcas();
                    generos();
                    tipos();
                    categorias();
                    listarCategorias($("#tipo").val());
                
                
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
    });
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
        $("#tk").html("44");

    }
}

function mostrar(id_prouct) {
    generos();
    tipos();
    categorias();
    marcas();
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
            $("#referencia_talla_2").hide();
            $("#productos_ref").hide();
            $("#segunda_ref").hide();
            $("#productos_ref").empty();

            $("#boton-sku").show();
            $("#id").val(data.product.id);
            $("#product_id").val(data.product.id);
            $("#referencia").val(data.product.referencia_producto);
            $("#referencia_2").val(data.product.referencia_producto_2);
            $("#referencia_talla").val(data.product.referencia_producto);
            $("#descripcion").val(data.product.descripcion);
            $("#descripcion_2").val(data.product.descripcion_2);
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
            
            $("#imagen_frente").val("");
            $("#imagen_trasera").val("");
            $("#imagen_perfil").val("");
            $("#imagen_bolsillo").val("");
            setTimeout(() => {
                $("#frente").attr("src", './producto/terminado/'+data.product.imagen_frente);
                $("#trasera").attr("src", './producto/terminado/'+data.product.imagen_trasero);
                $("#perfil").attr("src", './producto/terminado/'+data.product.imagen_perfil);
                $("#bolsillo").attr("src", './producto/terminado/'+data.product.imagen_bolsillo);
                
            }, 500);
            genero_global = data.product.genero;
            genero_plus = data.product.referencia_producto.substring(3, 4);
            let marca = data.product.referencia_producto.substring(0, 1);
            let genero = data.product.referencia_producto.substring(1, 2);
            let tipo_producto = data.product.referencia_producto.substring(2, 3);
            let categoria = data.product.referencia_producto.substring(3, 4);
            let year = data.product.referencia_producto.substring(5, 7);
            let secuence = data.product.referencia_producto.substring(7, 9);

            if(data.product.referencia_producto_2){
                $("#referencia_talla_2").show();
                $("#productos_ref").show();
                $("#segunda_ref").show();
                $("#referencia_talla_2").val(data.product.referencia_producto_2);

            
                $("#productos_ref").append(
                    `<option value="${data.product.id}">${data.product.referencia_producto}</option>`
                );

                $("#productos_ref").append(
                    `<option value="${data.product.id}">${data.product.referencia_producto_2}</option>`
                );


            }
         //   console.log(secuence);
            $("#year").val(20+year);
            $("#sec_manual").val(secuence);
         
            // $("#skuGeneral").val(data.skuGen.sku);
            tallas();
            eliminarColumnas();
            skus(data);
         
            $("#entalle_bragueta").val(data.product.entalle_bragueta).attr('selected', 'selected').trigger("change");
            $("#entalle_piernas").val(data.product.entalle_piernas).attr('selected', 'selected').trigger("change");
            $("#marca").val(data.product.marca).attr('selected', 'selected').trigger("change");
            $("#genero").val(genero).attr('selected', 'selected').trigger("change");
            setTimeout(() => {
                $("#tipo_producto").val(tipo_producto).attr('selected', 'selected').trigger("change");
                $("#categoria").val(categoria).attr('selected', 'selected').trigger("change");
                
            }, 500);

            $('#range_1').ionRangeSlider({
                min     : 02,
                max     : 16,
                from    : data.product.min,
                to      : data.product.max,
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

            if (data.product.genero == 3 || data.product.genero == 4) {
                $("#mostrarRef2").show();
                $("#precios_2").show();
                $("#descripcion_ref2").show();
            } else {
                $("#mostrarRef2").hide();
                $("#precios_2").hide();
                $("#descripcion_ref2").hide();
                $("#referencia_2").val("");
                $("#descripcion_2").val("");
                $("#precio_lista_2").val("");
                $("#precio_venta_publico_2").val("");
            }
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


const listarCategorias = (tipo) => {

    $("#permisos-agregados").empty();
    $("#Input-indice").empty();

    $.ajax({
        url: "listar/"+tipo,
        type: "get",
        dataType: "json",
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                
                for (let i = 0; i < datos.categorias.length; i++) {
                    var fila =
                    '<tr id="fila'+datos.categorias[i].id+'">'+
                //    "<td class=''><input type='hidden' id='usuario"+datos.categorias[i].id+"' value="+datos.categorias[i].id+">"+datos.categorias[i].tipo+"</td>"+
                    "<input type='hidden' id='usuario"+datos.categorias[i].id+"' value="+datos.categorias[i].id+">"+datos.categorias[i].tipo+
                    "<td class='font-weight-bold'><input type='hidden' id='permiso"+datos.categorias[i].indice+"' value="+datos.categorias[i].indice+">"+datos.categorias[i].indice+"</td>"+
                    "<td class='font-weight-bold'><input type='hidden' id='permiso"+datos.categorias[i].nombre+"' value="+datos.categorias[i].nombre+">"+datos.categorias[i].nombre+"</td>"+
                    "<td><button type='button' id='btn-eliminar' onclick='delCategoria("+datos.categorias[i].id+")' class='btn btn-danger'><i class='far fa-trash-alt'></i></button></td>"+
                    "</tr>";
                    var LastIndice = parseInt(datos.categorias[i].indice);
                    $("#permisos-agregados").append(fila);
                }

                    var tipoModal = $("#tipo").val();
                    if (tipoModal == "marca") {
                        $("#Input-indice").append("<label for='indice'>Indice</label><input type='text' name='indice' id='indice' class='form-control text-center'>");
                    }else {
                        if (isNaN(LastIndice)) {
                            LastIndice = 0;
                        } else {
                            LastIndice += 1;
                        }
                        $("#Input-indice").append("<label for='indice'>El indice sera generado automaticamente</label><input type='hidden' name='indice' id='indice' value='"+LastIndice+"' class='form-control text-center'>");
                    //    $("#permisos-agregados").append("<input type='hidden' id='LastIndice' value="+LastIndice+">");
                    }

            } else {
                bootbox.alert(
                    "Ocurrio un error durante la actualizacion de la composicion"
                );
            }
        },
        error: function() {
            bootbox.alert(
                "Ocurrio un error"
            );
        }
    });
}


const delCategoria = (id) => {
    Swal.fire({
        title: '¿Esta seguro de eliminar esta categoria?',
        text: "Va a eliminar esta categoria!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("categoria/delete/" + id, function(){
                Swal.fire(
                'Eliminado!',
                'Rollo eliminado correctamente.',
                'success'
                )
                $("#fila"+id).remove();
                $("#indice").val('');
                $("#nombre").val('');
                marcas();
                generos();
                tipos();
                categorias();
                listarCategorias($("#tipo").val());
            })
        }
      })
}


const marcas = () => {
    $("#marca").empty();
    $("#marca").append(`<option value="" selected disabled>Marca</option>`);
    $.ajax({
        url: "marcas",
        type: "GET",
        dataType: "json",
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                var longitud = datos.marcas.length;

                for (let i = 0; i < longitud; i++) {
                    var fila =
                    `<option value="${datos.marcas[i].nombre}">${datos.marcas[i].indice} - ${datos.marcas[i].nombre}</option>`
                    $("#marca").append(fila);
                }
                $("#marca").select2();
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
const generos = () => {
    $("#genero").empty();
    $("#genero").append(`<option value="" selected disabled>Genero</option>`);
    $.ajax({
        url: "generos",
        type: "GET",
        dataType: "json",
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                var longitud = datos.generos.length;

                for (let i = 0; i < longitud; i++) {
                    var fila =
                    ` <option value="${datos.generos[i].indice}">${datos.generos[i].indice} - ${datos.generos[i].nombre}</option>`
                    $("#genero").append(fila);
                }
                $("#genero").select2();
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
const tipos = () => {
    $("#tipo_producto").empty();
    $("#tipo_producto").append(`<option value="" selected disabled>Tipo producto</option>`);
    $.ajax({
        url: "tipos",
        type: "GET",
        dataType: "json",
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                var longitud = datos.tipos.length;

                for (let i = 0; i < longitud; i++) {
                    var fila =
                    ` <option value="${datos.tipos[i].indice}">${datos.tipos[i].indice} - ${datos.tipos[i].nombre}</option>`
                    $("#tipo_producto").append(fila);
                }
                $("#tipo_producto").select2();
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
const categorias = () => {
    $("#categoria").empty();
    $("#categoria").append(`<option value="" selected disabled>Categoria</option>`);
    $.ajax({
        url: "categorias",
        type: "GET",
        dataType: "json",
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                var longitud = datos.categorias.length;

                for (let i = 0; i < longitud; i++) {
                    var fila =
                    ` <option value="${datos.categorias[i].indice}">${datos.categorias[i].indice} - ${datos.categorias[i].nombre}</option>`
                    $("#categoria").append(fila);
                }
                $("#categoria").select2();
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
const entalle_braguetas = () => {
    $("#entalle_bragueta").empty();
    $("#entalle_bragueta").append(`<option value="" selected disabled>Entalle de Bragueta</option>`);
    $.ajax({
        url: "entalle_bragueta",
        type: "GET",
        dataType: "json",
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                var longitud = datos.entalle_braguetas.length;

                for (let i = 0; i < longitud; i++) {
                    var fila =
                    ` <option value="${datos.entalle_braguetas[i].indice}">${datos.entalle_braguetas[i].indice} - ${datos.entalle_braguetas[i].nombre}</option>`
                    $("#entalle_bragueta").append(fila);
                }
                $("#entalle_bragueta").select2();
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

function eliminarColumnas(){
    if(genero_global == 3 || genero_global == 4){
        $("#talla").empty();
        // $("#referencia_talla_2").show();
        let tallas = `
        <option value="General">General</option>
        <option value="A">2</option>
        <option value="B">4</option>
        <option value="C">6</option>
        <option value="D">8</option>
        <option value="E">10</option>
        <option value="F">12</option>
        <option value="G">14</option>
        <option value="H">16</option>
        `
        $("#talla").append(tallas);
    }else if(genero_global == 1){
        $("#talla").empty();
        let tallas = `
            <option value="General">General</option>
            <option value="A">28</option>
            <option value="B">29</option>
            <option value="C">30</option>
            <option value="D">32</option>
            <option value="E">34</option>
            <option value="F">36</option>
            <option value="G">38</option>
            <option value="H">40</option>
            <option value="I">42</option>
            <option value="J">44</option>
            <option value="K">46</option>
        `
        $("#talla").append(tallas);
    }

    if(genero_global == 2){
        $("#talla").empty();
        let tallas = `
        <option value="General">General</option>
        <option value="A">0/0</option>
        <option value="B">1/2</option>
        <option value="C">3/4</option>
        <option value="D">5/6</option>
        <option value="E">7/8</option>
        <option value="F">9/10</option>
        <option value="G">11/12</option>
        <option value="H">13/14</option>
        <option value="I">15/16</option>
        <option value="J">17/18</option>
        <option value="J">19/20</option>
        <option value="J">21/22</option>
    `
    $("#talla").append(tallas);
    }

    if(genero_plus == 7){
        $("#talla").empty();
        let tallas = `
        <option value="General">General</option>
        <option value="A">12W</option>
        <option value="B">14W</option>
        <option value="C">16W</option>
        <option value="D">18W</option>
        <option value="E">20W</option>
        <option value="F">22W</option>
        <option value="G">24W</option>
        <option value="H">26W</option>
    `
    $("#talla").append(tallas);
    }
}

const skus = ( { sku } ) => {
    if(genero_global == 3 || genero_global == 4){
        
        for (let i = 0; i < sku.length; i++) {
            (sku[i].talla == 'A') ? sku[i].talla = '2' : '';
            (sku[i].talla == 'B') ? sku[i].talla = '4' : '';
            (sku[i].talla == 'C') ? sku[i].talla = '6' : '';
            (sku[i].talla == 'D') ? sku[i].talla = '8' : '';
            (sku[i].talla == 'E') ? sku[i].talla = '10' : '';
            (sku[i].talla == 'F') ? sku[i].talla = '12' : '';
            (sku[i].talla == 'G') ? sku[i].talla = '14' : '';
            (sku[i].talla == 'H') ? sku[i].talla = '16' : '';
        }
    }else if(genero_global == 1){

        for (let i = 0; i < sku.length; i++) {
            (sku[i].talla == 'A') ? sku[i].talla = '28' : '';
            (sku[i].talla == 'B') ? sku[i].talla = '29' : '';
            (sku[i].talla == 'C') ? sku[i].talla = '30' : '';
            (sku[i].talla == 'D') ? sku[i].talla = '32' : '';
            (sku[i].talla == 'E') ? sku[i].talla = '34' : '';
            (sku[i].talla == 'F') ? sku[i].talla = '36' : '';
            (sku[i].talla == 'G') ? sku[i].talla = '38' : '';
            (sku[i].talla == 'H') ? sku[i].talla = '40' : '';
            (sku[i].talla == 'I') ? sku[i].talla = '42' : '';
            (sku[i].talla == 'J') ? sku[i].talla = '44' : '';
            (sku[i].talla == 'K') ? sku[i].talla = '46' : '';
        }
    }

    if(genero_global == 2){ 
        for (let i = 0; i < sku.length; i++) {
            (sku[i].talla == 'A') ? sku[i].talla = '0/0' : '';
            (sku[i].talla == 'B') ? sku[i].talla = '1/2' : '';
            (sku[i].talla == 'C') ? sku[i].talla = '3/4' : '';
            (sku[i].talla == 'D') ? sku[i].talla = '5/6' : '';
            (sku[i].talla == 'E') ? sku[i].talla = '7/8' : '';
            (sku[i].talla == 'F') ? sku[i].talla = '9/10' : '';
            (sku[i].talla == 'G') ? sku[i].talla = '11/12' : '';
            (sku[i].talla == 'H') ? sku[i].talla = '13/14' : '';
            (sku[i].talla == 'I') ? sku[i].talla = '15/16' : '';
            (sku[i].talla == 'J') ? sku[i].talla = '17/18' : '';
            (sku[i].talla == 'K') ? sku[i].talla = '19/20' : '';
            (sku[i].talla == 'L') ? sku[i].talla = '21/22' : '';
        }
    }

    if(genero_plus == 7){ 
        for (let i = 0; i < sku.length; i++) {
            (sku[i].talla == 'A') ? sku[i].talla = '12W' : '';
            (sku[i].talla == 'B') ? sku[i].talla = '14W' : '';
            (sku[i].talla == 'C') ? sku[i].talla = '16W' : '';
            (sku[i].talla == 'D') ? sku[i].talla = '18W' : '';
            (sku[i].talla == 'E') ? sku[i].talla = '20W' : '';
            (sku[i].talla == 'F') ? sku[i].talla = '22W' : '';
            (sku[i].talla == 'G') ? sku[i].talla = '24W' : '';
            (sku[i].talla == 'H') ? sku[i].talla = '26W' : '';

        }
    }


    $("#tallas").empty();
    for (let i = 0; i < sku.length; i++) {
        let fila =
        '<tr id="fila'+sku[i].id+'">'+
        "<td class='font-weight-bold'><input type='hidden' id='sku"+sku[i].id+"' value="+sku[i].id+">"+sku[i].sku+"</td>"+
        "<td class='font-weight-bold'><input type='hidden' id='permiso"+sku[i].id+"' value="+sku[i].id+">"+sku[i].referencia_producto+"</td>"+
        "<td class='font-weight-bold'><input type='hidden' id='permiso"+sku[i].id+"' value="+sku[i].id+">"+sku[i].talla+"</td>"+
        "<td>" +
        "<button type='button' id='btn-eliminar' onclick='editSKU("+sku[i].id+")'   class='btn btn-light mr-2'><i class='far fa-edit'></i></button>"+
        "<button type='button' id='btn-eliminar' onclick='delSKU("+sku[i].id+")'  class='btn btn-danger'><i class='far fa-trash-alt'></i></button></td>"+
        "</tr>";
        $("#tallas").append(fila);
    }

}


const delSKU = (id) => {
    Swal.fire({
        title: '¿Esta seguro de eliminar este SKU?',
        text: "Va a eliminar este SKU!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("sku/delete/" + id, function(){
                Swal.fire(
                'Eliminado!',
                'SKU eliminado correctamente.',
                'success'
                )
                $("#fila"+id).remove();
          
            })
        }
      })
}

const editSKU = (id) => {
    Swal.fire({
        title: '¿Esta seguro de desvincular  este SKU a esta referencia?',
        text: "Va a desvincular el SKU asignado a la referencia!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("sku/edit/" + id, function(){
                Swal.fire(
                'SKU del producto desvinculado correctamente!',
                'SKU desvinculado correctamente.',
                'success'
                )
                $("#fila"+id).remove();
          
            })
        }
      })
}



