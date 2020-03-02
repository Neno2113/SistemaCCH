var total_alm;

$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#formulario").validate({
        rules: {
            no_marcada: {
                required: true,
                minlength: 1,

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
                minlength: "Debe contener al menos 1 numero"
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
        listarRollos();
        mostrarForm(false);
        $("#btn-edit").hide();
        // ordenPedidoCod();
        $("#fila1").hide();
        $("#fila2").hide();
        $("#fila3").hide();
        productos();

    }

    //funcion para limpiar el formulario(los inputs)
    function limpiar() {
        $("#numero_corte_gen").val("");
        // $("#sec").val("");
        $("#productos").val("").trigger("change");
        $("#fecha_entrega").val("");
        $("#no_marcada").val("");
        $("#corte").val("");
        $("#ancho_marcada").val("");
        $("#largo_marcada").val("");
        $("#aprovechamiento").val("");
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
        $("#a_new").val("");
        $("#b_new").val("");
        $("#c_new").val("");
        $("#d_new").val("");
        $("#e_new").val("");
        $("#f_new").val("");
        $("#g_new").val("");
        $("#h_new").val("");
        $("#i_new").val("");
        $("#j_new").val("");
        $("#k_new").val("");
        $("#l_new").val("");
        $("#total_percent").val("");
    }

    // function ordenPedidoCod() {
    //     $("#sec").val("");
    //     $("#numero_corte_gen").val("");
    //     $("#corte").val("");
    //     $("#numero_corte").val("");
    //     $("#corte_tallas").val("");

    //     $.ajax({
    //         url: "corte/lastdigit",
    //         type: "GET",
    //         dataType: "json",
    //         success: function(datos) {
    //             if (datos.status == "success") {

    //                 var i = Number(datos.sec);
    //                 $("#sec").val(i);
    //                 i = (i + 0.01).toFixed(2).split('.').join("");
    //                 var year = new Date().getFullYear().toString();
    //                 var referencia = year+'-'+i;
    //                 // console.log(referencia);

    //                 $("#numero_corte_gen").val(referencia);
    //                 $("#corte").val(referencia);
    //                 $("#numero_corte").val(referencia);
    //                 $("#corte_tallas").val(referencia);


    //             } else {
    //                 bootbox.alert(
    //                     "Ocurrio un error !!"
    //                 );
    //             }
    //         },
    //         error: function() {
    //             bootbox.alert(
    //                 "Ocurrio un error!!"
    //             );
    //         }
    //     });
    // }

    // //funcion para generar codigo de corte
    // $("#btn-generar").on('click', function(e){
    //     e.preventDefault();

    //     $.ajax({
    //         url: "corte/lastdigit",
    //         type: "GET",
    //         dataType: "json",
    //         success: function(datos) {
    //             if (datos.status == "success") {
    //                 var i = Number(datos.sec);
    //                 $("#sec").val(i);
    //                 i = (i + 0.01).toFixed(2).split('.').join("");
    //                 var year = new Date().getFullYear().toString();
    //                 var referencia = year+'-'+i;


    //                 $("#numero_corte").val(referencia);
    //                 $("#corte").val(referencia);
    //                 // $("#corte_tallas").val(referencia +" - "+ referencia_producto );
    //                 $('#btn-generar').attr("disabled", true);
    //                 $("#fila1").show();
    //                 $("#fila2").show();
    //                 $("#fila3").show();
    //                 $("#edit-hide").show();
    //                 $("#edit-hide2").show();
    //                 bootbox.alert(
    //                     "Numero de corte generado exitosamente!!"
    //                 );

    //             } else {
    //                 bootbox.alert(
    //                     "Ocurrio un error !!"
    //                 );
    //             }
    //         },
    //         error: function() {
    //             bootbox.alert(
    //                 "Ocurrio un error!!"
    //             );
    //         }
    //     });
    // });

    //Select2 productos

    // $("#productos").select2({
    //     placeholder: "Busca una referencia de producto...",
    //     ajax: {
    //         url: 'products',
    //         dataType: 'json',
    //         delay: 250,
    //         processResults: function(data){
    //             return {
    //                 results: $.map(data, function(item){
    //                     return {
    //                         text: item.referencia_producto,
    //                         id: item.id
    //                     }
    //                 })
    //             };
    //         },
    //         cache: true
    //     }
    // })

    function productos (){

        $.ajax({
            url: "testSelectProduct",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    var longitud = datos.productos.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila =  "<option value="+datos.productos[i].id +">"+datos.productos[i].referencia_producto+"</option>"

                        $("#productos").append(fila);
                    }
                    $("#productos").select2();

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
     //Select2 cortes para consulta

    $("#cortesSearch").select2({
        placeholder: "Busca un numero de corte...",
        ajax: {
            url: 'cortes',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.numero_corte+' - '+item.fase  +' | Producto: '+item.referencia_producto,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })

    $("#no_marcada").keyup(function(){
        let val =  $("#no_marcada").val();
        $("#no_marcada").val(val.toUpperCase());
    });


    $("#productos").change(function(){
        let val = $("#productos option:selected").text();
        $("#referencia_talla").val(val);
        let genero = val.substring(1,2);
        let genero_plus = val.substr(3,1);
        $("#genero").val(genero);

        if (genero == "2") {
            if(genero_plus == "7"){
                $("#corte_tallas").val('Mujer Plus: '+val);
                $("#ta").html("12W");
                $("#tb").html("14W");
                $("#tc").html("16W");
                $("#td").html("18W");
                $("#te").html("20W");
                $("#tf").html("22W");
                $("#tg").html("24W");
                $("#th").html("26W");
                $("#sa").html("12W");
                $("#sb").html("14W");
                $("#sc").html("16W");
                $("#sd").html("18W");
                $("#se").html("20W");
                $("#sf").html("22W");
                $("#sg").html("24W");
                $("#sh").html("26W");
                $("#ra").html("12W");
                $("#rb").html("14W");
                $("#rc").html("16W");
                $("#rd").html("18W");
                $("#re").html("20W");
                $("#rf").html("22W");
                $("#rg").html("24W");
                $("#rh").html("26W");
                $("#btn-asignar2").html("12W");
                $("#btn-asignar3").html("14W");
                $("#btn-asignar4").html("16W");
                $("#btn-asignar5").html("18W");
                $("#btn-asignar6").html("20W");
                $("#btn-asignar7").html("22W");
                $("#btn-asignar8").html("24W");
                $("#btn-asignar9").html("26W");
                $("#btn-asignar10").attr("disabled", true);
                $("#btn-asignar11").attr("disabled", true);
                $("#btn-asignar12").attr("disabled", true);
                $("#btn-asignar13").attr("disabled", true);

                $("#i").attr('disabled', true);
                $("#j").attr('disabled', true);
                $("#k").attr('disabled', true);
                $("#l").attr('disabled', true);


            }else{
                $("#corte_tallas").val('Mujer: '+val);
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
                $("#sa").html("0/0");
                $("#sb").html("1/2");
                $("#sc").html("3/4");
                $("#sd").html("5/6");
                $("#se").html("7/8");
                $("#sf").html("9/10");
                $("#sg").html("11/12");
                $("#sh").html("13/14");
                $("#si").html("15/16");
                $("#sj").html("17/18");
                $("#sk").html("19/20");
                $("#sl").html("21/22");
                //Modal SKU
                $("#ra").html("0/0");
                $("#rb").html("1/2");
                $("#rc").html("3/4");
                $("#rd").html("5/6");
                $("#re").html("7/8");
                $("#rf").html("9/10");
                $("#rg").html("11/12");
                $("#rh").html("13/14");
                $("#ri").html("15/16");
                $("#rj").html("17/18");
                $("#rk").html("19/20");
                $("#rl").html("21/22");
                $("#btn-asignar2").html("0/0");
                $("#btn-asignar3").html("1/2");
                $("#btn-asignar4").html("3/4");
                $("#btn-asignar5").html("5/6");
                $("#btn-asignar6").html("7/8");
                $("#btn-asignar7").html("9/10");
                $("#btn-asignar8").html("11/12");
                $("#btn-asignar9").html("13/14");
                $("#btn-asignar10").html("15/16");
                $("#btn-asignar11").html("17/18");
                $("#btn-asignar12").html("19/20");
                $("#btn-asignar13").html("21/22");
                $("#btn-asignar2").attr("disabled", false);
                $("#btn-asignar2").attr("disabled", false);
                $("#btn-asignar2").attr("disabled", false);
                $("#btn-asignar2").attr("disabled", false);
                $("#i").attr('disabled', false);
                $("#j").attr('disabled', false);
                $("#k").attr('disabled', false);
                $("#l").attr('disabled', false);

            }

        }
        if (genero == "3" || genero == "4") {
            $("#corte_tallas").val('Niño: '+val);
            $("#sub-genero").hide();
            $("#ta").html("2");
            $("#tb").html("4");
            $("#tc").html("6");
            $("#td").html("8");
            $("#te").html("10");
            $("#tf").html("12");
            $("#tg").html("14");
            $("#th").html("16");
            $("#sa").html("2");
            $("#sb").html("4");
            $("#sc").html("6");
            $("#sd").html("8");
            $("#se").html("10");
            $("#sf").html("12");
            $("#sg").html("14");
            $("#sh").html("16");
            //Modal SKU
            $("#ra").html("2");
            $("#rb").html("4");
            $("#rc").html("6");
            $("#rd").html("8");
            $("#re").html("10");
            $("#rf").html("12");
            $("#rg").html("14");
            $("#rh").html("16");
            $("#i").attr('disabled', true);
            $("#j").attr('disabled', true);
            $("#k").attr('disabled', true);
            $("#l").attr('disabled', true);
            $("#btn-asignar2").html("2");
            $("#btn-asignar3").html("4");
            $("#btn-asignar4").html("6");
            $("#btn-asignar5").html("8");
            $("#btn-asignar6").html("10");
            $("#btn-asignar7").html("12");
            $("#btn-asignar8").html("14");
            $("#btn-asignar9").html("16");
            $("#btn-asignar10").attr("disabled", true);
            $("#btn-asignar11").attr("disabled", true);
            $("#btn-asignar12").attr("disabled", true);
            $("#btn-asignar13").attr("disabled", true);

        }  else if (genero == "1") {
            $("#corte_tallas").val('Hombre: '+val);
            $("#sub-genero").hide();
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
            $("#sa").html("28");
            $("#sb").html("29");
            $("#sc").html("30");
            $("#sd").html("32");
            $("#se").html("34");
            $("#sf").html("36");
            $("#sg").html("38");
            $("#sh").html("40");
            $("#si").html("42");
            $("#sj").html("44");
            //Modal SKU
            $("#ra").html("28");
            $("#rb").html("29");
            $("#rc").html("30");
            $("#rd").html("32");
            $("#re").html("34");
            $("#rf").html("36");
            $("#rg").html("38");
            $("#rh").html("40");
            $("#ri").html("42");
            $("#rj").html("44");
            $("#i").attr('disabled', false);
            $("#j").attr('disabled', false);
            $("#k").attr('disabled', true);
            $("#l").attr('disabled', true);
            $("#btn-asignar2").html("28");
            $("#btn-asignar3").html("29");
            $("#btn-asignar4").html("30");
            $("#btn-asignar5").html("32");
            $("#btn-asignar6").html("34");
            $("#btn-asignar7").html("36");
            $("#btn-asignar8").html("38");
            $("#btn-asignar9").html("40");
            $("#btn-asignar10").html("42");
            $("#btn-asignar11").html("44");
            $("#btn-asignar12").attr("disabled", true);
            $("#btn-asignar13").attr("disabled", true);

        }
    });


    $("#fecha_entrega").click(function(){
        let fecha = new Date();
        let dia = fecha.getDate();
        let year = fecha.getFullYear();
        let month = fecha.getMonth();


        if(dia < 15){
            month = month + 2;
            var i = Number(month) / 100;
            i = (i).toFixed(2).split(".").join("");
            i = i.substr(1, 4);

            $("#fecha_entrega").attr('min', year +"-"+ i+"-14")
            $("#fecha_entrega").attr('max', year +"-"+ i+"-14")
            $("#fecha_entrega").attr('title', "Fecha estimada de entrega es la primera quincena del mes: "+month);
        }else if(dia > 15){
            month = month + 2;
            var i = Number(month) / 100;
            i = (i).toFixed(2).split(".").join("");
            i = i.substr(1, 4);

            $("#fecha_entrega").attr('min', 2020 +"-"+i+"-28")
            $("#fecha_entrega").attr('max', 2020 +"-"+1+"-28")
            $("#fecha_entrega").attr('title', "Fecha estimada de entrega es la segunda quincena del mes: "+month);
        }

        setTimeout(verficarReferencia, 5000);

    });

    function verficarReferencia(){

        var referencia = {
            producto: $("#productos").val()
        }

        $.ajax({
            url: "verificacion/producto",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(referencia),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    //Inventario
                    $("#a_alm").html(datos.a_alm);
                    $("#b_alm").html(datos.b_alm);
                    $("#c_alm").html(datos.c_alm);
                    $("#d_alm").html(datos.d_alm);
                    $("#e_alm").html(datos.e_alm);
                    $("#f_alm").html(datos.f_alm);
                    $("#g_alm").html(datos.g_alm);
                    $("#h_alm").html(datos.h_alm);
                    $("#i_alm").html(datos.i_alm);
                    $("#j_alm").html(datos.j_alm);
                    $("#k_alm").html(datos.k_alm);
                    $("#l_alm").html(datos.l_alm);
                    //Curva actual
                    $("#a_act").html(datos.a + "%");
                    $("#b_act").html(datos.b + "%");
                    $("#c_act").html(datos.c + "%");
                    $("#d_act").html(datos.d + "%");
                    $("#e_act").html(datos.e + "%");
                    $("#f_act").html(datos.f + "%");
                    $("#g_act").html(datos.g + "%");
                    $("#h_act").html(datos.h + "%");
                    $("#i_act").html(datos.i + "%");
                    $("#j_act").html(datos.j + "%");
                    $("#k_act").html(datos.k + "%");
                    $("#l_act").html(datos.l + "%");
                    $("#total_alm").val(datos.total_alm);
                    total_alm = datos.total_alm;
                    $("#fila-nuevo").show();
                    $("#fila-actual").show();
                    $("#fila-inventario").show();
                    $("#fila-totales").show();
                    $("#mod_curva").val(1);
                    Swal.fire(
                        'Alerta',
                        'Esta referencia ya ha sido producia en otros cortes',
                        'warning'
                    )
                    var referencias = {
                        referencia: $("#productos").val()
                    };

                    $.ajax({
                        url: "producto/validarSku",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(referencias),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                                let a = $("#btn-asignar2").val();
                                let b = $("#btn-asignar3").val();
                                let c = $("#btn-asignar4").val();
                                let d = $("#btn-asignar5").val();
                                let e = $("#btn-asignar6").val();
                                let f = $("#btn-asignar7").val();
                                let g = $("#btn-asignar8").val();
                                let h = $("#btn-asignar9").val();
                                let i = $("#btn-asignar10").val();
                                let j = $("#btn-asignar11").val();
                                let k = $("#btn-asignar12").val();
                                let l = $("#btn-asignar13").val();
                                let general = $("#btn-asignar").val();



                                //validacion de talla igual 0 desabilitar input correspondiente a esa talla
                                (datos.General == general ) ? $("#btn-asignar").attr('disabled', true) : $("#btn-asignar").attr('disabled', false);
                                (datos.A == a ) ? $("#btn-asignar2").attr('disabled', true) : $("#btn-asignar2").attr('disabled', false);
                                (datos.B == b ) ? $("#btn-asignar3").attr('disabled', true) : $("#btn-asignar3").attr('disabled', false);
                                (datos.C == c ) ? $("#btn-asignar4").attr('disabled', true) : $("#btn-asignar4").attr('disabled', false);
                                (datos.D == d ) ? $("#btn-asignar5").attr('disabled', true) : $("#btn-asignar5").attr('disabled', false);
                                (datos.E == e ) ? $("#btn-asignar6").attr('disabled', true) : $("#btn-asignar6").attr('disabled', false);
                                (datos.F == f ) ? $("#btn-asignar7").attr('disabled', true) : $("#btn-asignar7").attr('disabled', false);
                                (datos.G == g ) ? $("#btn-asignar8").attr('disabled', true) : $("#btn-asignar8").attr('disabled', false);
                                (datos.H == h ) ? $("#btn-asignar9").attr('disabled', true) : $("#btn-asignar9").attr('disabled', false);
                                (datos.I == i ) ? $("#btn-asignar10").attr('disabled', true) : $("#btn-asignar10").attr('disabled', false);
                                (datos.j == j ) ? $("#btn-asignar11").attr('disabled', true) : $("#btn-asignar11").attr('disabled', false);
                                (datos.K == k ) ? $("#btn-asignar12").attr('disabled', true) : $("#btn-asignar12").attr('disabled', false);
                                (datos.L == l ) ? $("#btn-asignar12").attr('disabled', true) : $("#btn-asignar13").attr('disabled', false);




                            } else {
                                bootbox.alert("Se genero la referencia");
                            }
                        },
                        error: function() {
                           ;
                        }
                    });


                } else {
                    console.log("error");
                }
            },
            error: function(datos) {
                $("#a_act").html(datos.responseJSON.a + "%");
                $("#b_act").html(datos.responseJSON.b + "%");
                $("#c_act").html(datos.responseJSON.c + "%");
                $("#d_act").html(datos.responseJSON.d + "%");
                $("#e_act").html(datos.responseJSON.e + "%");
                $("#f_act").html(datos.responseJSON.f + "%");
                $("#g_act").html(datos.responseJSON.g + "%");
                $("#h_act").html(datos.responseJSON.h + "%");
                $("#i_act").html(datos.responseJSON.i + "%");
                $("#j_act").html(datos.responseJSON.j + "%");
                $("#k_act").html(datos.responseJSON.k + "%");
                $("#l_act").html(datos.responseJSON.l + "%");
            }
        });


    }

    //funcion que envia los datos del form al backend usando AJAX
    $("#btn-guardar").click(function(e){
        e.preventDefault();

        var corte = {
            sec: $("#sec").val(),
            numero_corte: $("#numero_corte_gen").val(),
            producto: $("#productos").val(),
            fecha_entrega: $("#fecha_entrega").val(),
            no_marcada: $("#no_marcada").val(),
            ancho_marcada: $("#ancho_marcada").val(),
            largo_marcada: $("#largo_marcada").val(),
            aprovechamiento: $("#aprovechamiento").val()
        };

        // funcion que se ejecuta con el callback de la funcion para guardar
        //esta almacena las cantidades por tallas
        $.ajax({
            url: "corte",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                    'Success',
                    'Corte creado correctamente.',
                    'success'
                    )

                    var talla = {
                        corte_id: datos.corte.id,
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
                        mod_curva: $("#mod_curva").val()
                    };

                    $.ajax({
                        url: "talla",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(talla),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                                // tabla.ajax.reload();
                                // ordenPedidoCod();
                                bootbox.alert("Se asignaron un total de: <strong>"+datos.talla.total+"</strong> entre todas las tallas digitadas");
                                $("#a").val(""),
                                $("#b").val(""),
                                $("#c").val(""),
                                $("#d").val(""),
                                $("#e").val(""),
                                $("#f").val(""),
                                $("#g").val(""),
                                $("#h").val(""),
                                $("#i").val(""),
                                $("#j").val(""),
                                $("#k").val(""),
                                $("#l").val("");
                                // tabla.ajax.reload();
                                $("#edit-hide").css("background-color", "none");
                                $("#cortes_listados").DataTable().ajax.reload();
                                $("#btn-tallas").removeClass("btn-success").addClass("btn-secondary");
                                $("#btn-sku").removeClass("btn-success").addClass("btn-secondary");
                                $("#edit-hide").removeClass("btn-success").addClass("btn-secondary");
                                limpiar();

                                mostrarForm(false);
                                $('#btn-generar').attr("disabled", false);

                            } else {
                                bootbox.alert(
                                    "Ocurrio un error durante la creacion de la composicion"
                                );
                            }
                        },
                        error: function() {
                            bootbox.alert(
                                "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                            );
                        }
                    });

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
        // tabla.responsive.recalc();
        tabla = $("#cortes_listados").DataTable({
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
            ajax: "api/cortes",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "name", name: 'users.name' },
                { data: "numero_corte", name: 'corte.numero_corte' },
                { data: "referencia_producto", name: 'producto.referencia_producto' },
                { data: "fecha_corte", name: 'corte.fecha_corte' },
                { data: "fecha_entrega", name: 'corte.fecha_entrega' },
                { data: "fase", name: 'corte.fase' },
                { data: "total", name: 'corte.total' },
                { data: "aprovechamiento", name: 'corte.aprovechamiento' },
                { data: "no_marcada", name: 'corte.no_marcada' },
                { data: "largo_marcada", name: 'corte.largo_marcada' },
                { data: "ancho_marcada", name: 'corte.ancho_marcada' },
            ],
            order: [[7, 'asc']],
            rowGroup: {
                dataSrc: 'fase'
            }
        });
    }

    //funcion para listar rollos sin corte asigando
    function listarRollos() {
        tabla = $("#rollos").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/rollos_corte",
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
                { data: "codigo_rollo", name: "rollos.codigo_rollo" },
                { data: "referencia", name: "tela.referencia" },
                { data: "longitud_yarda", name: "rollos.longitud_yarda" },
                { data: "num_tono", name: "rollos.num_tono" },
                { data: "corte_utilizado", name: "rollos.corte_utilizado" },
                { data: "Editar", orderable: false, searchable: false },
            ],
            order: [[1, 'desc']],
            rowGroup: {
                dataSrc: 'referencia'
            }
        });
    }

    //funcion para editar
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var corte = {
            id: $("#id").val(),
            producto: $("#productos").val(),
            fecha_entrega: $("#fecha_entrega").val(),
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
                    Swal.fire(
                    'Success',
                    'Corte actualizado correctamente.',
                    'success'
                    )
                    limpiar();
                    $("#cortes").DataTable().ajax.reload();
                    $("#id").val("");

                    var talla = {
                        corte_id: datos.corte.id,
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
                        mod_curva: $("#mod_curva").val()
                    };

                    $.ajax({
                        url: "talla/update",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(talla),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {

                                bootbox.alert("Se actualizaron un total de: <strong>"+datos.talla.total+"</strong> entre todas las tallas digitadas");
                                $("#a").val(""),
                                $("#b").val(""),
                                $("#c").val(""),
                                $("#d").val(""),
                                $("#e").val(""),
                                $("#f").val(""),
                                $("#g").val(""),
                                $("#h").val(""),
                                $("#i").val(""),
                                $("#j").val(""),
                                $("#k").val(""),
                                $("#l").val("");
                                // tabla.ajax.reload();
                                $("#edit-hide").css("background-color", "none");
                                $("#cortes_listados").DataTable().ajax.reload();
                                mostrarForm(false);
                            } else {
                                bootbox.alert(
                                    "Ocurrio un error durante la creacion de la composicion"
                                );
                            }
                        },
                        error: function() {
                            bootbox.alert(
                                "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                            );
                        }
                    });


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
        var i = Number(sec_manual) / 100;

        i = (i).toFixed(2).split('.').join("");

        let referencia = year + "-"+ i;

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
                        title: 'Corte creado correctamente'
                    })
                    $("#btn-generar").attr('disabled', true);
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
                    text: 'Este corte ya fue creado!'
                })
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
            $("#edit-hide").show();
            // $("#rollo-edit").hide();
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#fila1").hide();
            $("#fila2").hide();
            $("#fila3").hide();
            $("#fila-nuevo").hide();
            // $("#fila-actual").hide();
            $("#fila-inventario").hide();
            $("#fila-totales").hide();
            $("#spiner").hide();
            $("#spiner2").hide();
            $("#btn-curva").attr("disabled", true);
            // $("#rollo-edit").hide();
            $("#btn-guardar").attr("disabled", true);
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

    $("#edit-hide").click(function(){
        $("#spiner").show();
        $("#spiner2").show();
    });

    $("#btn-tallas-cerrar").click(function(e){
        e.preventDefault();
        $("#btn-tallas").removeClass("btn-secondary").addClass("btn-success");
    });

    // $('#test').on('hidden.bs.modal', function (e) {
    //     e.preventDefault();
    //     $("#btn-tallas").removeClass("btn-secondary").addClass("btn-success");
    // })

    // $('#modalRollos').on('hidden.bs.modal', function (e) {
    //     e.preventDefault();
    //     $("#edit-hide").removeClass("btn-secondary").addClass("btn-success");
    // })


    // $('#modalSKU').on('hidden.bs.modal', function (e) {
    //     e.preventDefault();
    //     $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
    // })



    //Botones para asignar SKU, se puede mejorar implementando un bucle que recorra cada boton
    //(implementar en el futuro)

    $("#btn-asignar").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#productos").val(),
            talla: $("#btn-asignar").val(),
            referencia: $("#productos option:selected").text()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
                } else {
                    bootbox.alert("Error");
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });
    });

    $("#btn-asignar-ref2").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#productos").val(),
            talla: $("#btn-asignar-ref2").val(),
            referencia: $("#productos option:selected").text()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
                } else {
                    bootbox.alert("Error");
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });
    });


    $("#btn-asignar2").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#productos").val(),
            talla: $("#btn-asignar2").val(),
            referencia: $("#productos option:selected").text()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar2").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });

    $("#btn-asignar3").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#productos").val(),
            talla: $("#btn-asignar3").val(),
           referencia: $("#productos option:selected").text()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar3").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });

    $("#btn-asignar4").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#productos").val(),
            talla: $("#btn-asignar4").val(),
           referencia: $("#productos option:selected").text()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar4").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });

    $("#btn-asignar5").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#productos").val(),
            talla: $("#btn-asignar5").val(),
           referencia: $("#productos option:selected").text()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar5").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });

    $("#btn-asignar6").click(function(e) {
        e.preventDefault();

        let gen = $("#genero").val();

        if (gen == 3 || gen == 4) {
            var asignacion = {
                id: $("#productos").val(),
                talla: $("#btn-asignar6").val(),
                referencia: $("#productos").val()
            };
        } else {
            var asignacion = {
                id: $("#productos").val(),
                talla: $("#btn-asignar6").val(),
               referencia: $("#productos option:selected").text()
            };
        }

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar6").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });

    $("#btn-asignar7").click(function(e) {
        e.preventDefault();

        let gen = $("#genero").val();

        if (gen == 3 || gen == 4) {
            var asignacion = {
                id: $("#productos").val(),
                talla: $("#btn-asignar7").val(),
                referencia: $("#referencia_2").val()
            };
        } else {
            var asignacion = {
                id: $("#productos").val(),
                talla: $("#btn-asignar7").val(),
               referencia: $("#productos option:selected").text()
            };
        }

        // console.log(JSON.stringify(asignacion));
        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar7").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });

    $("#btn-asignar8").click(function(e) {
        e.preventDefault();

        let gen = $("#genero").val();

        if (gen == 3 || gen == 4) {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar8").val(),
                referencia: $("#referencia_2").val()
            };
        } else {
            var asignacion = {
                id: $("#productos").val(),
                talla: $("#btn-asignar8").val(),
               referencia: $("#productos option:selected").text()
            };
        }

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar8").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });

    $("#btn-asignar9").click(function(e) {
        e.preventDefault();

        let gen = $("#genero").val();

        if (gen == 3 || gen == 4) {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar9").val(),
                referencia: $("#referencia_2").val()
            };
        } else {
            var asignacion = {
                id: $("#productos").val(),
                talla: $("#btn-asignar9").val(),
               referencia: $("#productos option:selected").text()
            };
        }

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar9").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });

    $("#btn-asignar10").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#productos").val(),
            talla: $("#btn-asignar10").val(),
           referencia: $("#productos option:selected").text()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar10").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });
    $("#btn-asignar11").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#productos").val(),
            talla: $("#btn-asignar11").val(),
           referencia: $("#productos option:selected").text()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar11").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });

    $("#btn-asignar12").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#productos").val(),
            talla: $("#btn-asignar12").val(),
           referencia: $("#productos option:selected").text()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar12").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });

    $("#btn-asignar13").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#productos").val(),
            talla: $("#btn-asignar13").val(),
           referencia: $("#productos option:selected").text()
        };

        $.ajax({
            url: "sku",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(asignacion),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("SKU <strong>"+ datos.sku.sku+ "</strong> asignado correctamente");
                    tabla.ajax.reload();
                    $("#btn-asignar13").attr("disabled", true);
                    $("#btn-sku").removeClass("btn-secondary").addClass("btn-success");
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
    });

    window.onresize = function() {
        tabla.columns.adjust().responsive.recalc();
    }


    init();
});

function mostrar(id_corte) {
    $.post("corte/" + id_corte, function(data, status) {
        // data = JSON.parse(data);
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").show();
        $("#btn-guardar").hide();
        $("#fila1").show();
        $("#fila2").show();
        $("#fila3").show();
        $("#btn-generar").hide();
        // $("#edit-hide").hide();
        // $("#rollo-agregar").hide();
        $("#rollo-edit").show();


        // console.log(data);
        $("#id").val(data.corte.id);
        $("#numero_corte_gen").val(data.corte.numero_corte);
        // $("#productos").val(data.corte.producto.referencia_producto);
        $("#fecha_entrega").val(data.corte.fecha_entrega);
        // $("#productos").select2('refresh');
        $("#no_marcada").val(data.corte.no_marcada);
        $("#ancho_marcada").val(data.corte.ancho_marcada);
        $("#largo_marcada").val(data.corte.largo_marcada);
        $("#aprovechamiento").val(data.corte.aprovechamiento);
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

    });
}

function eliminar(id_corte){
    Swal.fire({
        title: '¿Esta seguro de eliminar este corte?',
        text: "Va a eliminar este corte!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("corte/delete/" + id_corte, function(data){
                Swal.fire(
                'Eliminado!',
                'Corte eliminado correctamente.',
                'success'
                )
                $("#cortes_listados").DataTable().ajax.reload();
            })
        }
      })
    // bootbox.confirm("¿Estas seguro de eliminar este corte?", function(result){
    //     if(result){
    //         $.post("corte/delete/" + id_corte, function(data){
    //             bootbox.alert("Corte <strong>"+ data.corte.numero_corte+ "</strong> eliminado correctamente");
    //             $("#cortes_listados").DataTable().ajax.reload();
    //         })
    //     }
    // })
}

function asignar(id_rollo) {
    var rollo = {
        numero_corte: $("#numero_corte_gen").val(),
    };
    // console.log(JSON.stringify(rollo));

    $.ajax({
        url: "asignar/"+ id_rollo,
        type: "POST",
        dataType: "json",
        data: JSON.stringify(rollo),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                bootbox.alert("Rollo <strong>"+datos.rollo.codigo_rollo +"</strong> asignado correctamente al corte: <strong>"
                    +datos.rollo.corte_utilizado+"</strong>");
                $("#btn-guardar").attr("disabled", false);
                $("#edit-hide").removeClass("btn-secondary").addClass("btn-success");
                $("#spiner").hide();
                $("#spiner2").hide();
                $("#rollos").DataTable().ajax.reload();
                $("#edit-hide").removeClass("btn-secondary").addClass("btn-success");
            } else {
                bootbox.alert(
                    "Ocurrio un error durante esta operacion!!"
                );
            }
        },
        error: function() {
            bootbox.alert(
                "Rollo ya asignado a un numero de corte"
            );
        }
    });
}

function remover(id_rollo) {

    var rollo = {
        numero_corte: $("#numero_corte_gen").val(),
    };

    $.ajax({
        url: "remover/"+ id_rollo,
        type: "POST",
        dataType: "json",
        data: JSON.stringify(rollo),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                bootbox.alert("Rollo <strong>"+datos.rollo.codigo_rollo +"</strong> removido correctamente al corte: <strong>"
                    +datos.corte_utilizado+"</strong>");

                $("#edit-hide").css("background-color", "green");
                $("#rollos").DataTable().ajax.reload();
            } else {
                bootbox.alert(
                    "Ocurrio un error durante esta operacion!!"
                );
            }
        },
        error: function() {
            bootbox.alert(
                "Rollo ya asignado a un numero de corte"
            );
        }
    });
}



$("#a").keyup(function(){
    let a = isNaN(parseFloat($("#a").val())) ? 0: parseFloat($("#a").val());
    let result = (a / total_alm) * 100;
    result = result.toFixed(2);
    $("#a_new").val(result);
    calcularPorcentaje();

})
$("#b").keyup(function(){
    let b = isNaN(parseFloat($("#b").val())) ? 0: parseFloat($("#b").val());
    let result = (b / total_alm) * 100;
    result = result.toFixed(2);
    $("#b_new").val(result);
    calcularPorcentaje();

})

$("#c").keyup(function(){
    let c = isNaN(parseFloat($("#c").val())) ? 0: parseFloat($("#c").val());
    let result = (c / total_alm) * 100;
    result = result.toFixed(2);
    $("#c_new").val(result);
    calcularPorcentaje();

})

$("#d").keyup(function(){
    let d = isNaN(parseFloat($("#d").val())) ? 0: parseFloat($("#d").val());
    let result = (d / total_alm) * 100;
    result = result.toFixed(2);
    $("#d_new").val(result);
    calcularPorcentaje();

})

$("#e").keyup(function(){
    let e = isNaN(parseFloat($("#e").val())) ? 0: parseFloat($("#e").val());
    let result = (e / total_alm) * 100;
    result = result.toFixed(2);
    $("#e_new").val(result);
    calcularPorcentaje();

})

$("#f").keyup(function(){
    let f = isNaN(parseFloat($("#f").val())) ? 0: parseFloat($("#f").val());
    let result = (f / total_alm) * 100;
    result = result.toFixed(2);
    $("#f_new").val(result);
    calcularPorcentaje();

})


$("#g").keyup(function(){
    let g = isNaN(parseFloat($("#g").val())) ? 0: parseFloat($("#g").val());
    let result = (g / total_alm) * 100;
    result = result.toFixed(2);
    $("#g_new").val(result);
    calcularPorcentaje();

})

$("#h").keyup(function(){
    let h = isNaN(parseFloat($("#h").val())) ? 0: parseFloat($("#h").val());
    let result = (h / total_alm) * 100;
    result = result.toFixed(2);
    $("#h_new").val(result);
    calcularPorcentaje();

})

$("#i").keyup(function(){
    let i = isNaN(parseFloat($("#i").val())) ? 0: parseFloat($("#i").val());
    let result = (i / total_alm) * 100;
    result = result.toFixed(2);
    $("#i_new").val(result);
    calcularPorcentaje();

})

$("#j").keyup(function(){
    let j = isNaN(parseFloat($("#j").val())) ? 0: parseFloat($("#j").val());
    let result = (j / total_alm) * 100;
    result = result.toFixed(2);
    $("#j_new").val(result);
    calcularPorcentaje();

})

$("#k").keyup(function(){
    let k = isNaN(parseFloat($("#k").val())) ? 0: parseFloat($("#k").val());
    let result = (k / total_alm) * 100;
    result = result.toFixed(2);
    $("#k_new").val(result);
    calcularPorcentaje();
})

$("#l").keyup(function(){
    let l = isNaN(parseFloat($("#l").val())) ? 0: parseFloat($("#l").val());
    let result = (l / total_alm) * 100;
    result = result.toFixed(2);
    $("#l_new").val(result);
    calcularPorcentaje();

})

function calcularPorcentaje(){
    let a = isNaN(parseFloat($("#a_new").val())) ? 0: parseFloat($("#a_new").val());
    let b = isNaN(parseFloat($("#b_new").val())) ? 0: parseFloat($("#b_new").val());
    let c = isNaN(parseFloat($("#c_new").val())) ? 0: parseFloat($("#c_new").val());
    let d = isNaN(parseFloat($("#d_new").val())) ? 0: parseFloat($("#d_new").val());
    let e = isNaN(parseFloat($("#e_new").val())) ? 0: parseFloat($("#e_new").val());
    let f = isNaN(parseFloat($("#f_new").val())) ? 0: parseFloat($("#f_new").val());
    let g = isNaN(parseFloat($("#g_new").val())) ? 0: parseFloat($("#g_new").val());
    let h = isNaN(parseFloat($("#h_new").val())) ? 0: parseFloat($("#h_new").val());
    let i = isNaN(parseFloat($("#i_new").val())) ? 0: parseFloat($("#i_new").val());
    let j = isNaN(parseFloat($("#j_new").val())) ? 0: parseFloat($("#j_new").val());
    let k = isNaN(parseFloat($("#k_new").val())) ? 0: parseFloat($("#k_new").val());
    let l = isNaN(parseFloat($("#l_new").val())) ? 0: parseFloat($("#l_new").val());
    let total = a + b + c + d + e + f + g + h + i + j + k + l;

    $("#total_percent").val(total+"%");
    if(total == 100.00){
        $("#btn-curva").attr("disabled", false);
    }else{
        $("#btn-curva").attr("disabled", true);
    }
}


$("#a_new, #b_new, #c_new, #d_new, #e_new, #f_new, #g_new, #h_new, #i_new, #j_new, #k_new, #l_new").keyup(function(){

    calcularPorcentaje();
})






$("#btn-curva").click(function(e) {
    e.preventDefault();

    var curva = {
        referencia: $("#productos").val(),
        a: $("#a_new").val(),
        b: $("#b_new").val(),
        c: $("#c_new").val(),
        d: $("#d_new").val(),
        e: $("#e_new").val(),
        f: $("#f_new").val(),
        g: $("#g_new").val(),
        h: $("#h_new").val(),
        i: $("#i_new").val(),
        j: $("#j_new").val(),
        k: $("#k_new").val(),
        l: $("#l_new").val()
    };

    console.log(JSON.stringify(curva));

    $.ajax({
        url: "curva/update",
        type: "POST",
        dataType: "json",
        data: JSON.stringify(curva),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                Swal.fire(
                    'Success',
                    'Curva producto actualizada correctamente!',
                    'success'
                )
                $("#a_new").val("");
                $("#b_new").val("");
                $("#c_new").val("");
                $("#d_new").val("");
                $("#e_new").val("");
                $("#f_new").val("");
                $("#g_new").val("");
                $("#h_new").val("");
                $("#i_new").val("");
                $("#j_new").val("");
                $("#k_new").val("");
                $("#l_new").val("");


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


