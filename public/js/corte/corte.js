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


    $("#productos").change(function(){
        let val = $("#productos option:selected").text();
        $("#referencia_talla").val(val);
        let genero = val.substring(1,2);
        let genero_plus = val.substr(3,1);


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

        console.log(JSON.stringify(corte));

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
                    bootbox.alert("Corte creado !!");
                    limpiar();

                    mostrarForm(false);
                    $('#btn-generar').attr("disabled", false);

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
                        l: $("#l").val()
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
            order: [[7, 'desc']],
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
                    bootbox.alert("Se actualizado correctamente el usuario");
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
                        l: $("#l").val()
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

    //Botones para asignar SKU, se puede mejorar implementando un bucle que recorra cada boton
    //(implementar en el futuro)

    $("#btn-asignar").click(function(e) {
        e.preventDefault();

        var asignacion = {
            id: $("#id_producto").val(),
            talla: $("#btn-asignar").val(),
            referencia: $("#referencia").val()
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
            id: $("#id_producto").val(),
            talla: $("#btn-asignar2").val(),
            referencia: $("#referencia").val()
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
            id: $("#id_producto").val(),
            talla: $("#btn-asignar3").val(),
            referencia: $("#referencia").val()
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
            id: $("#id_producto").val(),
            talla: $("#btn-asignar4").val(),
            referencia: $("#referencia").val()
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
            id: $("#id_producto").val(),
            talla: $("#btn-asignar5").val(),
            referencia: $("#referencia").val()
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
                id: $("#id_producto").val(),
                talla: $("#btn-asignar6").val(),
                referencia: $("#referencia_2").val()
            };
        } else {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar6").val(),
                referencia: $("#referencia").val()
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
                id: $("#id_producto").val(),
                talla: $("#btn-asignar7").val(),
                referencia: $("#referencia_2").val()
            };
        } else {
            var asignacion = {
                id: $("#id_producto").val(),
                talla: $("#btn-asignar7").val(),
                referencia: $("#referencia").val()
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
                id: $("#id_producto").val(),
                talla: $("#btn-asignar8").val(),
                referencia: $("#referencia").val()
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
                id: $("#id_producto").val(),
                talla: $("#btn-asignar9").val(),
                referencia: $("#referencia").val()
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
            id: $("#id_producto").val(),
            talla: $("#btn-asignar10").val(),
            referencia: $("#referencia").val()
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
            id: $("#id_producto").val(),
            talla: $("#btn-asignar11").val(),
            referencia: $("#referencia").val()
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
            id: $("#id_producto").val(),
            talla: $("#btn-asignar12").val(),
            referencia: $("#referencia").val()
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
            id: $("#id_producto").val(),
            talla: $("#btn-asignar13").val(),
            referencia: $("#referencia").val()
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
