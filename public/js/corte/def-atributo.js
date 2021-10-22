var genero_global;
var genero_plus_global;
var total_recibido;

$(document).ready(function() {
    $("[data-mask]").inputmask();

    var tabla;

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
        $("#sub-genero").hide();
        $("#loading").hide();
        $("#loading2").hide();
        $("#loading3").hide();
        cortes();
        atributos();

    }


    function limpiar() {
        $("#id").val("");
        $("#almacen_id").val("");
        $("#cortesSearchEdit").val("").trigger("change");
        $("#cortesSearch").val("").trigger("change");
        $("#ubicacion").val("");
        $("#tono").val("");
        $("#intensidad_proceso_seco").val("");
        $("#atributo_no_1").val("");
        $("#atributo_no_2").val("");
        $("#atributo_no_3").val("");
        $("#genero").val("");
        $("#disponibles").empty();
        $("#resultados").empty();
        $("#fecha_entrada").val("");
    }



    // $("#cortesSearch").select2({
    //     placeholder: "Buscar un numero de corte Ej: 2019-xxx",
    //     ajax: {
    //         url: "cortes-almacen",
    //         dataType: "json",
    //         delay: 250,
    //         processResults: function(data) {
    //             return {
    //                 results: $.map(data, function(item) {
    //                     return {
    //                         text: item.numero_corte + " - " + item.fase,
    //                         id: item.id
    //                     };
    //                 })
    //             };
    //         },
    //         cache: true
    //     }
    // });

    $("#ubicacion").keyup(function(){
        let val =  $("#ubicacion").val();
        $("#ubicacion").val(val.toUpperCase());
    });

    function cortes(){

        $.ajax({
            url: "cortes/almacen",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.cortes.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila =  "<option value="+datos.cortes[i].id +">"+datos.cortes[i].numero_corte+"</option>"

                        $("#cortesSearch").append(fila);
                    }
                    $("#cortesSearch").select2();

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
    }




    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var almacen = {
            corte: $("#cortesSearch").val(),
            ubicacion: $("#ubicacion").val(),
            tono: $("#tono").val(),
            intensidad_proceso_seco: $("#intensidad_proceso_seco").val(),
            atributo_no_1: $("#atributo_no_1").val(),
            atributo_no_2: $("#atributo_no_2").val(),
            atributo_no_3: $("#atributo_no_3").val(),
        };

        $.ajax({
            url: "almacen",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(almacen),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Entrada a almacen creada!!',
                        'Registro a almacen realizado correctamente.',
                        'success'
                    )

                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
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

    function listar() {
        tabla = $("#almacenes").DataTable({
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
            ajax:{
                "url": "api/almacenes/atributos",
                "type": "POST"
            },
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "name", name: "users.name" },
                { data: "numero_corte", name: "corte.numero_corte" },
                { data: "referencia_producto", name: "producto.referencia_producto"},
                { data: "total", name: "almacen.total" },

            ],
            order: [[3, "desc"]],
            rowGroup: {
                dataSrc: "numero_corte"
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var almacen = {
            id: $("#id").val(),
            producto_id: $("#productos").val(),
            corte: $("#cortesSearch").val(),
            ubicacion: $("#ubicacion").val(),
            tono: $("#tono").val(),
            intensidad_proceso_seco: $("#intensidad_proceso_seco").val(),
            atributo_no_1: $("#atributo_no_1").val(),
            atributo_no_2: $("#atributo_no_2").val(),
            atributo_no_3: $("#atributo_no_3").val(),

        };

        $.ajax({
            url: "almacen/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(almacen),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Success',
                        'Registro a almacen actualizado correctamente.',
                        'success'
                    )
                    limpiar();
                    tabla.ajax.reload();
                    $("#id").val("");
                    $("#referencia_producto").hide();
                    $("#numero_corte").hide();
                    mostrarForm(false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
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
            $("#corteAdd").show();
            $("#imagen_frente").show();
            $("#imagen_trasera").show();
            $("#imagen_perfil").show();
            $("#imagen_bolsillo").show();
            $("#btn-upload").show();
            $("#btn-buscar").show();
            $("#btn-imprimir").attr("disabled", true);
            ubicaciones();
            listarUbicaciones();
            listarAtributos();

        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#btn-edit").hide();
            $("#entrada_alm").hide();
            $("#entrada_alm").removeClass("btn-success").addClass("btn-primary");
            $("#btn-imprimir").hide();
            // $("#btn-guardar").show();
            $("#referencia_producto").hide();
            $("#numero_corte").hide();
            $("#corteEdit").hide();
            $("#formUpload").hide();
            $("#form_producto").hide();
            $("#form_producto_2").hide();
            $("#form_talla").hide();
            // $("#btn-guardar").attr("disabled", true);
        }
    }


    $("#btn-buscar").click(function() {
        $("#loading").show();
        $("#loading2").show();
        $("#loading3").show();

        setInterval(function() {
            $("#loading").hide();
            $("#loading2").hide();
            $("#loading3").hide();
        }, 1500);

        var corte = {
            id: $("#cortesSearch").val(),
            idEdit: $("#cortesSearchEdit").val()
        };

        let corte_id = $("#cortesSearch").val();
        let corte_id_edit = $("#cortesSearchEdit").val();

        $("#corte_id").val(corte_id);
        $("#corte_id_edit").val(corte_id_edit);

        $.ajax({
            url: "show/corte/producto",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    let ubicacion = datos.producto.ubicacion;
                    let val = datos.referencia;
                    let genero = val.substring(1, 2);
                    let mujer_plus = val.substring(3, 4);
                    genero_global = genero;
                    genero_plus_global = mujer_plus;

                    $("#ubicacion").val(datos.producto.ubicacion);
                    $("#tono").val(datos.producto.tono);
                    $("#intensidad_proceso_seco").val(datos.producto.intensidad_proceso_seco);
                    $("#atributo_no_1").val(datos.producto.atributo_no_1);
                    $("#atributo_no_2").val(datos.producto.atributo_no_2);
                    $("#atributo_no_3").val(datos.producto.atributo_no_3);
                    $("#frente").attr("src", './producto/terminado/'+datos.producto.imagen_frente);
                    $("#trasera").attr("src", './producto/terminado/'+datos.producto.imagen_trasero);
                    $("#perfil").attr("src", './producto/terminado/'+datos.producto.imagen_perfil);
                    $("#bolsillo").attr("src", './producto/terminado/'+datos.producto.imagen_bolsillo);

                    if (ubicacion != null) {
                        bootbox.confirm({
                            message:
                                "¿Desea modificar la ubicacion o datos de la referencia?",
                            buttons: {
                                confirm: {
                                    label: "Si",
                                    className: "btn-primary"
                                },
                                cancel: {
                                    label: "No",
                                    className: "btn-warning"
                                }
                            },
                            callback: function(result) {
                                if (result) {
                                    $("#formUpload").show();
                                    $("#form_producto").show();
                                    $("#form_producto_2").show();
                                    $("#form_talla").show();
                                } else {
                                    $("#formUpload").show();
                                    $("#form_producto").hide();
                                    $("#form_producto_2").hide();
                                    $("#form_talla").show();
                                }
                            }
                        });
                    } else {
                        $("#formUpload").show();
                        $("#form_producto").show();
                        $("#form_producto_2").show();
                        $("#form_talla").show();
                    }
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


    //funcion que validar si el total de tallas es mayor a la cantidad recibida en recepcion
    $("#btn-close").click(function(e){
        e.preventDefault();


    });

    // //funcion para listar en el Datatable
    // function listarCorteDetalle(id) {
    //     tabla_orden = $("#corte_detalle").DataTable({
    //         serverSide: true,
    //         bFilter: false,
    //         lengthChange: false,
    //         bPaginate: false,
    //         bInfo: false,
    //         retrieve: true,
    //         ajax: "api/detalle_corte/" + id,
    //         columns: [
    //             { data: "a", name: "tallas.a" },
    //             { data: "b", name: "tallas.b" },
    //             { data: "c", name: "tallas.c" },
    //             { data: "d", name: "tallas.d" },
    //             { data: "e", name: "tallas.e" },
    //             { data: "f", name: "tallas.f" },
    //             { data: "g", name: "tallas.g" },
    //             { data: "h", name: "tallas.h" },
    //             { data: "i", name: "tallas.i" },
    //             { data: "j", name: "tallas.j" },
    //             { data: "k", name: "tallas.k" },
    //             { data: "l", name: "tallas.l" }
    //         ]
    //     });

    //     $("#corte_detalle")
    //         .DataTable()
    //         .ajax.reload();
    // }

    // $("#btn-upload").click(function() {
    //     $("#btn-guardar").attr("disabled", false);
    // });

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        $("#almacenes").DataTable().ajax.reload();
        mostrarForm(false);
    });

    $('#modalAlmacen').on('hidden.bs.modal', function (e) {
        e.preventDefault();


    })

    $("#formUpload").submit(function(e) {
        e.preventDefault();
        var formData = new FormData($(this)[0]);

        $.ajax({
            url: "almacen/imagen",
            type: "POST",
            data: formData,
            dataType: "JSON",
            processData: false,
            cache: false,
            contentType: false,
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Imagenes subidas!!',
                        'Imagenes subidas correctamente',
                        'success'
                    )
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
    });

    $("#btn-agregar").click(function(t){
        t.preventDefault();
        validarTallas();


    });

    $("#btn-save").on('click', () => {
    
        let data = {
            indice: $("#indice").val(),
            nombre: $("#nombre").val()
        }
    

        $.ajax({
            url: "atributo",
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
                    atributos();
                    listarAtributos();
                
                
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

    $("#btn-saveUbicacion").on('click', () => {
    
        let data = {
            ubicacion: $("#newUbicacion").val()
        }
    

        $.ajax({
            url: "ubicacion",
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
                    $("#nombre").val('');
                    ubicaciones();
                    listarUbicaciones();
                
                
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

    init();
});

function mostrar(id_almacen){
    $.get("almacen/" + id_almacen, function(data, status) {
        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#referencia_producto").show();
            // $("#numero_corte").show();
            // $("#corteEdit").show();
            // $("#corteAdd").hide();
            $("#formUpload").show();
            $("#form_producto").show();
            $("#form_producto_2").show();
            $("#form_talla").show();
            $("#btn-buscar").hide();
            // $("#btn-imprimir").hide();
            setTimeout(() => {
                ubicaciones();
                
            }, 500);
            setTimeout(() => {
                listarAtributos();
                
            }, 500);
            setTimeout(() => {
                listarUbicaciones();
                
            }, 500);


            var fila =  "<option value="+data.almacen.corte_id +">"+data.almacen.corte.numero_corte+"</option>"

            $("#cortesSearch").append(fila);

            $("#id").val(data.almacen.id);
            $("#cortesSearch").val(data.almacen.corte_id).select2().trigger('change');
            $("#tono").val(data.almacen.producto.tono);
            $("#intensidad_proceso_seco").val(data.almacen.producto.intensidad_proceso_seco);
            setTimeout(() => {
                $("#ubicacion").val(data.almacen.producto.ubicacion).select2().trigger('change');
                $("#atributo_no_1").val(data.almacen.producto.atributo_no_1).select2().trigger('change');
                $("#atributo_no_2").val(data.almacen.producto.atributo_no_2).select2().trigger('change');
                $("#atributo_no_3").val(data.almacen.producto.atributo_no_3).select2().trigger('change');
                
            }, 1000);

            total_recibido = data.total_recibido;

            $("#total").html(data.total);
            $("#genero").val(data.almacen.producto.referencia_producto);
            $("#frente").attr("src", './producto/terminado/'+data.almacen.producto.imagen_frente)
            $("#trasera").attr("src", './producto/terminado/'+data.almacen.producto.imagen_trasero)
            $("#perfil").attr("src", './producto/terminado/'+data.almacen.producto.imagen_perfil)
            $("#bolsillo").attr("src", './producto/terminado/'+data.almacen.producto.imagen_bolsillo)
            $("#pendiente_produccion").html(data.pen_produccion);
            $("#pendiente_lavanderia").html(data.pen_lavanderia);
            $("#total_terminacion").html(data.total_recibido);
            $("#perdida_x").html(data.perdida_x);
            $("#producto_id").val(data.almacen.producto.id);
            $("#corte_id").val(data.almacen.corte_id);

            $("#disponibles").empty();
            $("#resultados").empty();

            for (let t = 0; t < data.detalle.length; t++) {
                var fila =  "<tr>"+
                '<tr id="fila">'+
                "<td><input type='hidden' name='a[]' id='a[]' value="+data.detalle[t].a+">"+data.detalle[t].a+"</td>"+
                "<td><input type='hidden' name='b[]' id='b[]' value="+data.detalle[t].b+">"+data.detalle[t].b+"</td>"+
                "<td><input type='hidden' name='c[]' id='c[]' value="+data.detalle[t].c+">"+data.detalle[t].c+"</td>"+
                "<td><input type='hidden' name='d[]' id='d[]' value="+data.detalle[t].d+">"+data.detalle[t].d+"</td>"+
                "<td><input type='hidden' name='e[]' id='e[]' value="+data.detalle[t].e+">"+data.detalle[t].e+"</td>"+
                "<td><input type='hidden' name='f[]' id='f[]' value="+data.detalle[t].f+">"+data.detalle[t].f+"</td>"+
                "<td><input type='hidden' name='g[]' id='g[]' value="+data.detalle[t].g+">"+data.detalle[t].g+"</td>"+
                "<td><input type='hidden' name='h[]' id='h[]' value="+data.detalle[t].h+">"+data.detalle[t].h+"</td>"+
                "<td><input type='hidden' name='i[]' id='i[]' value="+data.detalle[t].i+">"+data.detalle[t].i+"</td>"+
                "<td><input type='hidden' name='j[]' id='j[]' value="+data.detalle[t].j+">"+data.detalle[t].j+"</td>"+
                "<td><input type='hidden' name='k[]' id='k[]' value="+data.detalle[t].k+">"+data.detalle[t].k+"</td>"+
                "<td><input type='hidden' name='l[]' id='l[]' value="+data.detalle[t].l+">"+data.detalle[t].l+"</td>"+
                "<td><input type='hidden' id='total_talla[]' name='total_talla[]' value="+data.detalle[t].total+">"+data.detalle[t].total+"</td>"+
                "</tr>";
            $("#disponibles").append(fila);
            }

            var resultados =  "<tr>"+
                '<tr id="fila">'+
                "<td><input type='hidden' name='a[]' id='a[]' value="+data.a_alm+">"+data.a_alm+"</td>"+
                "<td><input type='hidden' name='b[]' id='b[]' value="+data.b_alm+">"+data.b_alm+"</td>"+
                "<td><input type='hidden' name='c[]' id='c[]' value="+data.c_alm+">"+data.c_alm+"</td>"+
                "<td><input type='hidden' name='d[]' id='d[]' value="+data.d_alm+">"+data.d_alm+"</td>"+
                "<td><input type='hidden' name='e[]' id='e[]' value="+data.e_alm+">"+data.e_alm+"</td>"+
                "<td><input type='hidden' name='f[]' id='f[]' value="+data.f_alm+">"+data.f_alm+"</td>"+
                "<td><input type='hidden' name='g[]' id='g[]' value="+data.g_alm+">"+data.g_alm+"</td>"+
                "<td><input type='hidden' name='h[]' id='h[]' value="+data.h_alm+">"+data.h_alm+"</td>"+
                "<td><input type='hidden' name='i[]' id='i[]' value="+data.i_alm+">"+data.i_alm+"</td>"+
                "<td><input type='hidden' name='j[]' id='j[]' value="+data.j_alm+">"+data.j_alm+"</td>"+
                "<td><input type='hidden' name='k[]' id='k[]' value="+data.k_alm+">"+data.k_alm+"</td>"+
                "<td><input type='hidden' name='l[]' id='l[]' value="+data.l_alm+">"+data.l_alm+"</td>"+
                "<td><input type='hidden' id='total_talla[]' name='total_talla[]' value="+data.total_alm+">"+data.total_alm+"</td>"+
                "</tr>";
            $("#resultados").append(resultados);
        }
        



    });
}


const listarAtributos = () => {

    $("#permisos-agregados").empty();

    $.ajax({
        url: "atributos",
        type: "get",
        dataType: "json",
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                
                for (let i = 0; i < datos.atributos.length; i++) {
                    var fila =
                    '<tr id="fila'+datos.atributos[i].id+'">'+
                    "<td class='font-weight-bold'><input type='hidden' id='permiso"+datos.atributos[i].indice+"' value="+datos.atributos[i].indice+">"+datos.atributos[i].indice+"</td>"+
                    "<td class='font-weight-bold'><input type='hidden' id='permiso"+datos.atributos[i].nombre+"' value="+datos.atributos[i].nombre+">"+datos.atributos[i].nombre+"</td>"+
                    "<td><button type='button' id='btn-eliminar' onclick='delCategoria("+datos.atributos[i].id+")' class='btn btn-danger'><i class='far fa-trash-alt'></i></button></td>"+
                    "</tr>";
                    $("#permisos-agregados").append(fila);
                }

            } else {
                bootbox.alert(
                    "Ocurrio un error durante la actualizacion de la composicion"
                );
            }
        },
        error: function() {
         console.log("Ocurrio un error");
        }
    });
}

const atributos = () => {
    $("#atributo_no_1").empty();
    $("#atributo_no_2").empty();
    $("#atributo_no_3").empty();
    $("#atributo_no_1").append(`<option value="" selected disabled>Atributo 1</option>`);
    $("#atributo_no_2").append(`<option value="" selected disabled>Atributo 2</option>`);
    $("#atributo_no_3").append(`<option value="" selected disabled>Atributo 3</option>`);
    $.ajax({
        url: "atributos",
        type: "GET",
        dataType: "json",
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                var longitud = datos.atributos.length;

                for (let i = 0; i < longitud; i++) {
                    var fila =
                    ` <option value="${datos.atributos[i].nombre}">${datos.atributos[i].indice} - ${datos.atributos[i].nombre}</option>`
                    $("#atributo_no_1").append(fila);
                }
                $("#atributo_no_1").select2();

                for (let i = 0; i < longitud; i++) {
                    var fila =
                    ` <option value="${datos.atributos[i].nombre}">${datos.atributos[i].indice} - ${datos.atributos[i].nombre}</option>`
                    $("#atributo_no_2").append(fila);
                }
                $("#atributo_no_2").select2();

                for (let i = 0; i < longitud; i++) {
                    var fila =
                    ` <option value="${datos.atributos[i].nombre}">${datos.atributos[i].indice} - ${datos.atributos[i].nombre}</option>`
                    $("#atributo_no_3").append(fila);
                }
                $("#atributo_no_3").select2();
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

const ubicaciones = () => {
    $("#ubicacion").empty();
    $("#ubicacion").append(`<option value="" selected disabled>Ubicacion</option>`);
    $.ajax({
        url: "ubicaciones",
        type: "GET",
        dataType: "json",
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                var longitud = datos.ubicaciones.length;

                for (let i = 0; i < longitud; i++) {
                    var fila =
                    ` <option value="${datos.ubicaciones[i].ubicacion}">${datos.ubicaciones[i].ubicacion}</option>`
                    $("#ubicacion").append(fila);
                }
                $("#ubicacion").select2();

             
            } else {
                bootbox.alert(
                    "Ocurrio un error durante la actualizacion de la composicion"
                );
            }
        },
        error: function() {
            console.log("No cargaron las ubicaciones");
        }
    });
}



const listarUbicaciones = () => {

    $("#ubicaciones-list").empty();

    $.ajax({
        url: "ubicaciones",
        type: "get",
        dataType: "json",
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                
                for (let i = 0; i < datos.ubicaciones.length; i++) {
                    var fila =
                    '<tr id="ubc'+datos.ubicaciones[i].id+'">'+
                    "<td class='font-weight-bold'><input type='hidden' id='permiso"+datos.ubicaciones[i].ubicacion+"' value="+datos.ubicaciones[i].ubicacion+">"+datos.ubicaciones[i].ubicacion+"</td>"+
                    "<td><button type='button' id='btn-eliminar' onclick='delUbicacion("+datos.ubicaciones[i].id+")' class='btn btn-danger'><i class='far fa-trash-alt'></i></button></td>"+
                    "</tr>";
                    $("#ubicaciones-list").append(fila);
                }

            } else {
                bootbox.alert(
                    "Ocurrio un error durante la actualizacion de la composicion"
                );
            }
        },
        error: function() {
            console.log("Ocurrio un error");
        }
    });
}



function eliminar(id_almacen){
    $.post("almacencheck/delete/" + id_almacen, function(data, status) {
        // console.log(data);
        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            Swal.fire({
                title: '¿Esta seguro de eliminar este corte de almacen?',
                text: "Va a eliminar las entradas a almacen!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto'
              }).then((result) => {
                if (result.value) {
                    $.post("almacen/delete/" + id_almacen, function(){
                        Swal.fire(
                            'Eliminado!',
                            'Entrada a almacen eliminado correctamente.',
                            'success'
                            )
                        $("#almacenes").DataTable().ajax.reload();
                    })
                }
              })
        }
    })

}


const delCategoria = (id) => {
    Swal.fire({
        title: '¿Esta seguro de eliminar este atributo?',
        text: "Va a eliminar este atributo!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("atributo/delete/" + id, function(){
                Swal.fire(
                'Eliminado!',
                'Atributo eliminado correctamente.',
                'success'
                )
                $("#fila"+id).remove();
                atributos();
           
            })
        }
      })
}


const delUbicacion = (id) => {
    Swal.fire({
        title: '¿Esta seguro de eliminar esta ubicacion?',
        text: "Va a eliminar esta ubicacion!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("ubicacion/delete/" + id, function(){
                Swal.fire(
                'Eliminado!',
                'Ubicacion eliminada correctamente.',
                'success'
                )
                $("#ubc"+id).remove();
                ubicaciones();
           
            })
        }
      })
}

