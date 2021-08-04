let total_recibido;
let alm_id;
let a_total;
let b_total;
let c_total;
let d_total;
let e_total;
let f_total;
let g_total;
let h_total;
let i_total;
let j_total;
let k_total;
let l_total;
let genero_global;
let genero_plus_global;
$(document).ready(function() {
    $("[data-mask]").inputmask();
   

    // $("#formulario").validate({
    //     rules: {
    //         cortesSearch: {
    //             required: true,
    //             minlength: 1
    //         },
    //         lavanderias: {
    //             required: true,
    //             minlength: 1
    //         },
    //         fecha_recepcion: {
    //             required: true,
    //             minlength: 1
    //         },
    //         cantidad_recibida: {
    //             required: true,
    //             minlength: 2
    //         }
    //     },
    //     messages: {
    //         codigo_composicion: {
    //             required: "El numero de corte es obligatorio"
    //         },
    //         nombre_composicion: {
    //             required: "La lavanderia es obligatoria"
    //         },
    //         fecha_recepcion: {
    //             required: "La fecha de recepcion es obligatoria"
    //         },
    //         cantidad_recibida: {
    //             required: "La cantidad recibida es un campo obligatorio",
    //             minlength:
    //                 "La cantidad recibida es un campo numerico obligatorio"
    //         }
    //     }
    // });

    var tabla;

    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
        cortesSearch();
    }


    $("#fase").change(function() {
        var val = $(this).val();
        if (val == "Produccion") {
            $("#motivo").html(
                "<option value='Error del operador'>1. Error del operador</option>" +
                    "<option value='Fallo de la maquina'>2. Fallo de la maquina</option>" +
                    "<option value='Defecto de tela'>3. Defecto de tela</option>" +
                    "<option value='Fallo en Dpto.corte'>4. Fallo en Dpto.corte</option>" +
                    "<option value='Extraviado'>5. Extraviado</option>"
            );
        } else if (val == "Procesos secos") {
            $("#motivo").html(
                "<option value='Error del operador'>1. Error del operador</option>" +
                    "<option value='Extraviado'>2. Extraviado</option>"
            );
        } else if (val == "Lavanderia") {
            $("#motivo").html(
                "<option value='Rotos'>1. Rotos</option>" +
                    "<option value='Manchados'>2. Manchados</option>" +
                    "<option value='Extraviado'>3. Extraviado</option>"
            );
        } else if (val == "Terminacion") {
            $("#motivo").html(
                "<option value='Error del operador'>1. Error del operador</option>" +
                    "<option value='Fallo de la maquina'>2. Fallo de la maquina</option>" +
                    "<option value='Defecto de tela'>3. Defecto de tela</option>" +
                    "<option value='Fallo en Dpto. corte'>4. Fallo en Dpto. corte</option>" +
                    "<option value='Extraviado'>5. Extraviado </option>"+
                    "<option value='Extraviado'>6. Error de lavanderia </option>"
            );
        } else if (val == "Almacen") {
            $("#motivo").html(
                "<option value='Extraviado'>1. Extraviado</option>" +
                    "<option value='Termita'>2. Termita</option>" +
                    "<option value='Reaccion luz'>3. Reaccion a la luz</option>"
            );
        } else if (val == "") {
            $("#motivo").html("<option value=''> </option>");
        }
    });


    function limpiar() {
        $("#fase").val("");
        $("#motivo").val("");
        $("#cortesSearch").val("").trigger("change");
        $("#productos").val("").trigger("change");
        $("#no_perdida").val("");
        $("#sec").val("");
        $("#sec_segunda").val("");
        $("#tipo_perdida").val("");
        $("#fecha").val("");
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

    const cortesSearch = () => {
        $.ajax({
            url: "cortes/perdidas",
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

    // $("#cortesSearch").select2({
    //     placeholder: "Buscar un numero de corte Ej: 2019-xxx",
    //     ajax: {
    //         url: "cortes_perd",
    //         dataType: "json",
    //         delay: 250,
    //         processResults: function(data) {
    //             return {
    //                 results: $.map(data, function(item) {
    //                     return {
    //                         text: item.numero_corte + " - " + item.fase + " - "+ item.referencia_producto,
    //                         id: item.id
    //                     };
    //                 })
    //             };
    //         },
    //         cache: true
    //     }
    // });

    $("#productos").select2({
        placeholder: "Busca una referencia de producto...",
        ajax: {
            url: 'products',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        return {
                            text: item.referencia_producto,
                            id: item.id
                        }
                    })
                };
            },
            cache: true
        }
    })

    $('#fase').on('change', () => {
        let fase = {
            corte_id: $("#cortesSearch").val(),
            fase: $('#fase').val()
        }
        console.log(fase);
        // $.ajax({
        //     url: "fase-corte",
        //     type: "POST",
        //     dataType: "json",
        //     data: JSON.stringify(fase),
        //     contentType: "application/json",
        //     success: function(datos) {
        //         if (datos.status == "success") {
        //             console.log(datos);
        //             if(datos.pendiente > 0 ){
        //                 total_recibido = datos.pendiente;
        //             }
        //             console.log(total_recibido);
        //         } else {
        //             bootbox.alert("Ocurrio un error !!");
        //         }
        //     },
        //     error: function() {

        //     }
        // });

    });

    $("#cortesSearch").on("change", function(){
        let corte = {
            corte_id: $("#cortesSearch").val(),
        };

        $.ajax({
            url: "perdida/verificar",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(corte),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    let fecha = datos.fecha_corte;
                    let dia = fecha.substr(0, 2);
                    let month = fecha.substr(3, 2);
                    let year = fecha.substr(6, 4);
                    let fase =  datos.fase;

                    month = month;
                    var i = Number(month) / 100;
                    i = (i).toFixed(2).split(".").join("");
                    i = i.substr(1, 4);

                    var e = Number(dia) / 100;
                    e = (e).toFixed(2).split(".").join("");
                    e = e.substr(1, 4);

                    $("#fecha").attr('min', year +"-"+ i+"-"+e);
                    // console.log(month);
                    // console.log(year);
                    // console.log(i);
                    // console.log(e);

                    a_total = datos.a;
                    b_total = datos.b;
                    c_total = datos.c;
                    d_total = datos.d;
                    e_total = datos.e;
                    f_total = datos.f;
                    g_total = datos.g;
                    h_total = datos.h;
                    i_total = datos.i;
                    j_total = datos.j;
                    k_total = datos.k;
                    l_total = datos.l;
                    total_recibido = datos.total_entrada;
                    if(datos.almacen){
                        alm_id = datos.almacen.id
                        $("#total_cortado").html(datos.total_cortado);
                        $("#pendiente_produccion").html(datos.pen_produccion);
                        $("#pendiente_lavanderia").html(datos.pen_lavanderia);
                        $("#recibido_lavanderia").html(datos.total_recibido);
                        $("#total_terminacion").html(datos.total_entrada);
                        // $("#total_entrada").html(data.total_entrada);
                        $("#perdida_x").html(datos.perdida_x);
                        $("#total_perdidas").html(datos.total_perdidas);
                        $("#total_segundas").html(datos.total_segundas);
                    }


                    //validacion de talla igual 0 desabilitar input correspondiente a esa talla
                    (datos.a <= 0 ) ? $("#a").attr('disabled', true) : $("#a").attr('disabled', false);
                    (datos.b <= 0 ) ? $("#b").attr('disabled', true) : $("#b").attr('disabled', false);
                    (datos.c <= 0 ) ? $("#c").attr('disabled', true) : $("#c").attr('disabled', false);
                    (datos.d <= 0 ) ? $("#d").attr('disabled', true) : $("#d").attr('disabled', false);
                    (datos.e <= 0 ) ? $("#e").attr('disabled', true) : $("#e").attr('disabled', false);
                    (datos.f <= 0 ) ? $("#f").attr('disabled', true) : $("#f").attr('disabled', false);
                    (datos.g <= 0 ) ? $("#g").attr('disabled', true) : $("#g").attr('disabled', false);
                    (datos.h <= 0 ) ? $("#h").attr('disabled', true) : $("#h").attr('disabled', false);
                    (datos.i <= 0 ) ? $("#i").attr('disabled', true) : $("#i").attr('disabled', false);
                    (datos.j <= 0 ) ? $("#j").attr('disabled', true) : $("#j").attr('disabled', false);
                    (datos.k <= 0 ) ? $("#k").attr('disabled', true) : $("#k").attr('disabled', false);
                    (datos.l <= 0 ) ? $("#l").attr('disabled', true) : $("#l").attr('disabled', false);

                    $("#ra").html(datos.a);
                    $("#rb").html(datos.b);
                    $("#rc").html(datos.c);
                    $("#rd").html(datos.d);
                    $("#re").html(datos.e);
                    $("#rf").html(datos.f);
                    $("#rg").html(datos.g);
                    $("#rh").html(datos.h);
                    $("#ri").html(datos.i);
                    $("#rj").html(datos.j);
                    $("#rk").html(datos.k);
                    $("#rl").html(datos.l);

                    $("#disponibles").empty();
                    $("#resultados").empty();     
                    if(datos.almacen){

                        for (let i = 0; i < datos.segundas.length; i++) {
                            let fila =
                            '<tr id="fila">'+
                            "<td class='text-danger' ><input type='hidden' name='a[]' id='a[]' value="+datos.segundas[i].a+">"+datos.segundas[i].a+"</td>"+
                            "<td class='text-danger'><input type='hidden' name='b[]' id='b[]' value="+datos.segundas[i].b+">"+datos.segundas[i].b+"</td>"+
                            "<td class='text-danger'> <input type='hidden' name='c[]' id='c[]' value="+datos.segundas[i].c+">"+datos.segundas[i].c+"</td>"+
                            "<td class='text-danger'><input type='hidden' name='d[]' id='d[]' value="+datos.segundas[i].d+">"+datos.segundas[i].d+"</td>"+
                            "<td class='text-danger'><input type='hidden' name='e[]' id='e[]' value="+datos.segundas[i].e+">"+datos.segundas[i].e+"</td>"+
                            "<td class='text-danger'><input type='hidden' name='f[]' id='f[]' value="+datos.segundas[i].f+">"+datos.segundas[i].f+"</td>"+
                            "<td class='text-danger'><input type='hidden' name='g[]' id='g[]' value="+datos.segundas[i].g+">"+datos.segundas[i].g+"</td>"+
                            "<td class='text-danger'><input type='hidden' name='h[]' id='h[]' value="+datos.segundas[i].h+">"+datos.segundas[i].h+"</td>"+
                            "<td class='text-danger'><input type='hidden' name='i[]' id='i[]' value="+datos.segundas[i].i+">"+datos.segundas[i].i+"</td>"+
                            "<td class='text-danger'><input type='hidden' name='j[]' id='j[]' value="+datos.segundas[i].j+">"+datos.segundas[i].j+"</td>"+
                            "<td class='text-danger'><input type='hidden' name='k[]' id='k[]' value="+datos.segundas[i].k+">"+datos.segundas[i].k+"</td>"+
                            "<td class='text-danger'><input type='hidden' name='l[]' id='l[]' value="+datos.segundas[i].l+">"+datos.segundas[i].l+"</td>"+
                            "<td class='text-danger'><input type='hidden' id='total_talla[]' name='total_talla[]' value="+datos.segundas[i].total+">"+datos.segundas[i].total+"</td>"+
                            "</tr>";
                            $("#disponibles").append(fila);
                        }
        
                        for (let t = 0; t < datos.detalle.length; t++) {
                            let fila =
                            '<tr id="fila">'+
                            "<td><input type='hidden' name='a[]' id='a[]' value="+datos.detalle[t].a+">"+datos.detalle[t].a+"</td>"+
                            "<td><input type='hidden' name='b[]' id='b[]' value="+datos.detalle[t].b+">"+datos.detalle[t].b+"</td>"+
                            "<td><input type='hidden' name='c[]' id='c[]' value="+datos.detalle[t].c+">"+datos.detalle[t].c+"</td>"+
                            "<td><input type='hidden' name='d[]' id='d[]' value="+datos.detalle[t].d+">"+datos.detalle[t].d+"</td>"+
                            "<td><input type='hidden' name='e[]' id='e[]' value="+datos.detalle[t].e+">"+datos.detalle[t].e+"</td>"+
                            "<td><input type='hidden' name='f[]' id='f[]' value="+datos.detalle[t].f+">"+datos.detalle[t].f+"</td>"+
                            "<td><input type='hidden' name='g[]' id='g[]' value="+datos.detalle[t].g+">"+datos.detalle[t].g+"</td>"+
                            "<td><input type='hidden' name='h[]' id='h[]' value="+datos.detalle[t].h+">"+datos.detalle[t].h+"</td>"+
                            "<td><input type='hidden' name='i[]' id='i[]' value="+datos.detalle[t].i+">"+datos.detalle[t].i+"</td>"+
                            "<td><input type='hidden' name='j[]' id='j[]' value="+datos.detalle[t].j+">"+datos.detalle[t].j+"</td>"+
                            "<td><input type='hidden' name='k[]' id='k[]' value="+datos.detalle[t].k+">"+datos.detalle[t].k+"</td>"+
                            "<td><input type='hidden' name='l[]' id='l[]' value="+datos.detalle[t].l+">"+datos.detalle[t].l+"</td>"+
                            "<td><input type='hidden' id='total_talla[]' name='total_talla[]' value="+datos.detalle[t].total+">"+datos.detalle[t].total+"</td>"+
                            "</tr>";
                            $("#disponibles").append(fila);
                        }
        
                        var resultados =
                            '<tr id="fila">'+
                            "<td><input type='hidden' name='a[]' id='a[]' value="+datos.a_alm+">"+datos.a_alm+"</td>"+
                            "<td><input type='hidden' name='b[]' id='b[]' value="+datos.b_alm+">"+datos.b_alm+"</td>"+
                            "<td><input type='hidden' name='c[]' id='c[]' value="+datos.c_alm+">"+datos.c_alm+"</td>"+
                            "<td><input type='hidden' name='d[]' id='d[]' value="+datos.d_alm+">"+datos.d_alm+"</td>"+
                            "<td><input type='hidden' name='e[]' id='e[]' value="+datos.e_alm+">"+datos.e_alm+"</td>"+
                            "<td><input type='hidden' name='f[]' id='f[]' value="+datos.f_alm+">"+datos.f_alm+"</td>"+
                            "<td><input type='hidden' name='g[]' id='g[]' value="+datos.g_alm+">"+datos.g_alm+"</td>"+
                            "<td><input type='hidden' name='h[]' id='h[]' value="+datos.h_alm+">"+datos.h_alm+"</td>"+
                            "<td><input type='hidden' name='i[]' id='i[]' value="+datos.i_alm+">"+datos.i_alm+"</td>"+
                            "<td><input type='hidden' name='j[]' id='j[]' value="+datos.j_alm+">"+datos.j_alm+"</td>"+
                            "<td><input type='hidden' name='k[]' id='k[]' value="+datos.k_alm+">"+datos.k_alm+"</td>"+
                            "<td><input type='hidden' name='l[]' id='l[]' value="+datos.l_alm+">"+datos.l_alm+"</td>"+
                            "<td><input type='hidden' id='total_talla[]' name='total_talla[]' value="+datos.total_alm+">"+datos.total_alm+"</td>"+
                            "</tr>";
                            $("#resultados").append(resultados);
                    }


                    let val = datos.ref;
                    let genero = val.substring(1, 2);
                    let genero_plus = val.substring(3, 4);
                    genero_global = val.substring(1, 2);
                    genero_plus_global = val.substring(3, 4);

                    switch (fase) {
                        case "Terminacion":
                            $("#tipo_perdida").html(
                                "<option value='Normal'>Total</option>" +
                                "<option value='Segundas'>Segundas</option>"
                            );
                            $("#btn-generar").attr("disabled", false);
                            $("#fase").val('Terminacion')
                            $("#motivo").html(
                                "<option disabled><strong>Terminacion</strong></option>"+
                                "<option value='Error del operador'>1. Error del operador</option>" +
                                "<option value='Fallo de la maquina'>2. Fallo de la maquina</option>" +
                                "<option value='Defecto de tela'>3. Defecto de tela</option>" +
                                "<option value='Fallo en Dpto. corte'>4. Fallo en Dpto. corte</option>" +
                                "<option value='Extraviado'>5. Extraviado </option>"
                            );
                            break;
                        case "Almacen":
                            $("#tipo_perdida").html(
                                "<option value='Normal'>Total</option>" +
                                "<option value='Segundas'>Segundas</option>"
                            );
                            $("#btn-generar").attr("disabled", false);
                            $("#fase").val('Almacen')
                            $("#motivo").html(
                                "<option disabled><strong>Almacen</strong></option>"+
                                "<option value='Extraviado'>1. Extraviado</option>" +
                                "<option value='Termita'>2. Termita</option>" +
                                "<option value='Reaccion luz'>3. Reaccion a la luz</option>"
                            );
                        break;

                        case "Produccion":
                            $("#tipo_perdida").html(
                                "<option value='Normal'>Total</option>"
                            );
                            $("#btn-generar").attr("disabled", false);
                            $("#fase").val('Produccion')
                            $("#motivo").html(
                                "<div class='dropdown-menu'>"+
                                "<option disabled><strong>Produccion</strong></option>"+
                                "<option   class='dropdown-item'  value='Error del operador'>1. Error del operador</option>" +
                                    "<option class='dropdown-item'  value='Fallo de la maquina'>2. Fallo de la maquina</option>" +
                                    "<option class='dropdown-item' value='Defecto de tela'>3. Defecto de tela</option>" +
                                    "<option class='dropdown-item' value='Fallo en Dpto.corte'>4. Fallo en Dpto.corte</option>" +
                                    "<option class='dropdown-item' value='Extraviado'>5. Extraviado</option>"+
                                     "<option  disabled>_______________________________________________________</option>"+
                                     "<option disabled><strong>Procesos Secos</strong></option>"+
                                    "<option class='dropdown-item' value='Error del operador'>1. Error del operador</option>" +
                                    "<option class='dropdown-item' value='Extraviado'>2. Extraviado</option>"+
                                "</div>"
                            );
                        break;

                        case "Lavanderia":
                            $("#tipo_perdida").html(
                                "<option value='Normal'>Total</option>"
                            );
                            $("#btn-generar").attr("disabled", false);
                            $("#fase").val('Lavanderia')
                            $("#motivo").html(
                                "<option disabled><strong>Lavanderia</strong></option>"+
                                "<option value='Rotos'>1. Rotos</option>" +
                                "<option value='Manchados'>2. Manchados</option>" +
                                "<option value='Extraviado'>3. Extraviado</option>"
                            );
                        break;
                        default:
                            $("#tipo_perdida").html(
                                "<option value='Normal'>Total</option>" +
                                "<option value='Segundas'>Segundas</option>"
                            );
                            $("#btn-generar").attr("disabled", false);
                        break;
                    }

                    if (genero == "2") {
                        $("#genero").val('Mujer: '+val);

                            if(genero_plus == "7"){
                               $("#genero").val('Mujer plus: '+val);
                               $("#sa").html("12W");
                               $("#sb").html("14W");
                               $("#sc").html("16W");
                               $("#sd").html("18W");
                               $("#se").html("20W");
                               $("#sf").html("22W");
                               $("#sg").html("24W");
                               $("#sh").html("26W");
                               $("#ta").html("12W");
                               $("#tb").html("14W");
                               $("#tc").html("16W");
                               $("#td").html("18W");
                               $("#te").html("20W");
                               $("#tf").html("22W");
                               $("#tg").html("24W");
                               $("#th").html("26W");


                               $("#tallas").html(
                                   "<th>Dama Plus</th>"+
                                   "<th>12W</th>"+
                                   "<th>14W</th>"+
                                   "<th>16W</th>"+
                                   "<th>18W</th>"+
                                   "<th>20W</th>"+
                                   "<th>22W</th>"+
                                   "<th>24W</th>"+
                                   "<th>26W</th>"
                               );
                           }else{
                            $("#genero").val('Mujer: '+val)
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
                            // $("#i").attr('disabled', false);
                            // $("#j").attr('disabled', false);
                            // $("#k").attr('disabled', false);
                            // $("#l").attr('disabled', false);
                            $("#tallas").html(
                                "<th>Dama TA</th>"+
                                "<th>0/0</th>"+
                                "<th>1/2</th>"+
                                "<th>3/4</th>"+
                                "<th>5/6</th>"+
                                "<th>7/8</th>"+
                                "<th>9/10</th>"+
                                "<th>11/12</th>"+
                                "<th>13/14</th>"+
                                "<th>15/16</th>"+
                                "<th>17/18</th>"+
                                "<th>19/20</th>"+
                                "<th>21/22</th>"
                        );
                           }
                    }

                    if (genero == "3") {
                        $("#genero").val('Niño: '+val);
                        $("#sub-genero").hide();
                        $("#sa").html("2");
                        $("#sb").html("4");
                        $("#sc").html("6");
                        $("#sd").html("8");
                        $("#se").html("10");
                        $("#sf").html("12");
                        $("#sg").html("14");
                        $("#sh").html("16");
                        $("#ta").html("2");
                        $("#tb").html("4");
                        $("#tc").html("6");
                        $("#td").html("8");
                        $("#te").html("10");
                        $("#tf").html("12");
                        $("#tg").html("14");
                        $("#th").html("16");
                        // $("#i").attr('disabled', true);
                        // $("#j").attr('disabled', true);
                        // $("#k").attr('disabled', true);
                        // $("#l").attr('disabled', true);
                        $("#tallas").html(
                                        "<th>Niño</th>"+
                                        "<th>2</th>"+
                                        "<th>4</th>"+
                                        "<th>6</th>"+
                                        "<th>8</th>"+
                                        "<th>10</th>"+
                                        "<th>12</th>"+
                                        "<th>14</th>"+
                                        "<th>16</th>"
                        );
                    } else if (genero == "4") {
                        $("#genero").val('Niña: '+val);
                        $("#sub-genero").hide();
                        $("#sa").html("2");
                        $("#sb").html("4");
                        $("#sc").html("6");
                        $("#sd").html("8");
                        $("#se").html("10");
                        $("#sf").html("12");
                        $("#sg").html("14");
                        $("#sh").html("16");
                        $("#ta").html("2");
                        $("#tb").html("4");
                        $("#tc").html("6");
                        $("#td").html("8");
                        $("#te").html("10");
                        $("#tf").html("12");
                        $("#tg").html("14");
                        $("#th").html("16");
                        // $("#i").attr('disabled', true);
                        // $("#j").attr('disabled', true);
                        // $("#k").attr('disabled', true);
                        // $("#l").attr('disabled', true);
                        $("#tallas").html(
                            "<th>Niña</th>"+
                            "<th>2</th>"+
                            "<th>4</th>"+
                            "<th>6</th>"+
                            "<th>8</th>"+
                            "<th>10</th>"+
                            "<th>12</th>"+
                            "<th>14</th>"+
                            "<th>16</th>"
                        );
                    } else if (genero == "1") {
                        $("#genero").val('Hombre: '+val);
                        $("#sub-genero").hide();
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
                        $("#sk").html("46");
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
                        $("#tk").html("46");
                        // $("#i").attr('disabled', false);
                        // $("#j").attr('disabled', false);
                        // $("#k").attr('disabled', true);
                        // $("#l").attr('disabled', true);
                        $("#tallas").html(
                            "<th>Caballero</th>"+
                            "<th>28</th>"+
                            "<th>29</th>"+
                            "<th>30</th>"+
                            "<th>32</th>"+
                            "<th>34</th>"+
                            "<th>36</th>"+
                            "<th>38</th>"+
                            "<th>40</th>"+
                            "<th>42</th>"+
                            "<th>44</th>"+
                            "<th>46</th>"
                        );
                    }

                    eliminarColumnas();
                } else{
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la composicion"
                    );
                }
            },
            error: function() {
                // bootbox.alert(
                //     "Ocurrio un error"
                // );
            }
        });
    })

    //funcion para generar codigo de perdida o segunda
    $("#btn-generar").on("click", function(e) {
        e.preventDefault();

            $.ajax({
                url: "perdida/lastdigit",
                type: "GET",
                dataType: "json",
                success: function(datos) {
                    if (datos.status == "success") {
                        var i = Number(datos.sec);
                        $("#sec").val(i);
                        i = (i + 0.01)
                            .toFixed(2)
                            .split(".")
                            .join("");

                        var tipo_perdida = $("#tipo_perdida").val()

                        if(tipo_perdida == 'Segundas'){
                            var referencia = "SE-" + i;
                        }else if(tipo_perdida = 'Normal'){
                            var referencia = "PE-" + i;
                        }


                        $("#no_perdida").val(referencia);
                        $("#fila1").show();
                        $("#fila2").show();
                        $("#fila3").show();
                        $("#btn-guardar").attr("disabled", false);
                        bootbox.alert(
                            "Numero de perdida generado exitosamente!!"
                        );
                    } else {
                        bootbox.alert("Ocurrio un error !!");
                    }
                },
                error: function() {
                    bootbox.alert("Ocurrio un error!!");
                }
            });


    });

    $("#tipo_perdida").on("change", function(){
        $("#btn-generar").attr("disabled", false);
    })

    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var perdida = {
            corte: $("#cortesSearch").val(),
            fecha: $("#fecha").val(),
            tipo_perdida: $("#tipo_perdida").val(),
            fase: $("#fase").val(),
            motivo: $("#motivo").val(),
            no_perdida: $("#no_perdida").val(),
            sec: $("#sec").val(),
            // producto_id: $("#productos").val(),
        };

        $.ajax({
            url: "perdida",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(perdida),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                    'Success',
                    'Perdida registrada correctamente.',
                    'success'
                    )
                    // limpiar();

                    var talla = {
                        perdida_id: datos.perdida.id,
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
                        talla_x: $("#talla_x").val()
                    };

                    $.ajax({
                        url: "perdida_tallas",
                        type: "POST",
                        dataType: "json",
                        data: JSON.stringify(talla),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {

                                tabla.ajax.reload();
                                mostrarForm(false);
                                limpiar();

                            } else {
                                bootbox.alert(
                                    "Ocurrio un error durante la creacion de la composicion"
                                );
                            }
                        },
                        error: function(datos) {
                            console.log(datos.responseJSON.message);

                            bootbox.alert("Error: " + datos.responseJSON.message);
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

    function listar() {
        tabla = $("#perdida_listada").DataTable({
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
            ajax: "api/perdidas",
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Opciones", orderable: false, searchable: false },
                { data: "imprimir", orderable: false, searchable: false },
                { data: "no_perdida", name: "perdidas.no_perdida" },
                { data: "tipo_perdida", name: "perdidas.tipo_perdida" },
                { data: "fecha",name: "perdidas.fecha"},
                { data: "numero_corte", name: "corte.numero_corte" },
                { data: "referencia_producto", name: "producto.referencia_producto" },
                { data: "fase", name: "perdidas.fase" },
                { data: "motivo", name: "perdidas.motivo" }
            ],
            order: [[5, 'desc']],
            rowGroup: {
                dataSrc: 'numero_corte'
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var perdida = {
            id: $("#id").val(),
            corte: $("#cortesSearch").val(),
            fecha: $("#fecha").val(),
            tipo_perdida: $("#tipo_perdida").val(),
            fase: $("#fase").val(),
            motivo: $("#motivo").val(),
            no_perdida: $("#no_perdida").val(),
            producto_id: $("#productos").val(),
            perdida_x: $("#talla_x").val()
        };

        $.ajax({
            url: "perdida/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(perdida),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Actualizada',
                        'Perdida actualizada correctamente.',
                        'success'
                        )

                    var talla = {
                        perdida_id: datos.perdida.id,
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
                        url: "talla_perdidas/edit",
                        type: "PUT",
                        dataType: "json",
                        data: JSON.stringify(talla),
                        contentType: "application/json",
                        success: function(datos) {
                            if (datos.status == "success") {
                                bootbox.alert("Tallas actualizadas correctamente!!")
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
                            console.log(datos.responseJSON.message);

                            bootbox.alert("Error: " + datos.responseJSON.message);
                        }
                    });


                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la actualizacion de la composicion"
                    );
                }
            },
            error: function(datos) {
                bootbox.alert("Error: " + datos.responseJSON.message);
            }
        });
    });

    function validarTallas(){
        var validar = {
            almacen_id: alm_id,
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
            url: "validar/total",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(validar),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    let total = datos.total;
                    let a = datos.a;
                    let b = datos.b;
                    let c = datos.c;
                    let d = datos.d;
                    let e = datos.e;
                    let f = datos.f;
                    let g = datos.g;
                    let h = datos.h;
                    let i = datos.i;
                    let j = datos.j;
                    let k = datos.k;
                    let l = datos.l;
                    // console.log(genero_global);
                    // console.log(a);
                    // console.log(a_total);
                    if(total > total_recibido){
                        bootbox.alert(`<div class='alert alert-danger' role='alert'>
                        <i class='fas fa-exclamation-triangle'></i> La cantidad total de tallas no puede ser mayor a <strong>${ total_recibido} </strong>
                       </div>`)
                       $("#btn-guardar").hide();
                    } else if(genero_global == '2'){

                        if(genero_plus_global == '7'){
                            if(a > a_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 12W a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(b > b_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 14W a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(c > c_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 16W a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }
                            else if(d > d_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 18W a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(e > e_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 20W a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(f > f_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 22W a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(g > g_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 24W a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(h > h_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 26W a la cantidad total del corte y las perdidas"+
                                "</div>")
                            } else {
                                Swal.fire(
                                    'Cantidad validada!',
                                    'Cantidad valida para guardar.',
                                    'info'
                                )
                                $("#btn-tallas").removeClass("btn-orange").addClass("btn-success");

                            }
                        }else{
                            if(a > a_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 0/0 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(b > b_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 1/2 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(c > c_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 3/4 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }
                            else if(d > d_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 5/6 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(e > e_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 7/8 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(f > f_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 9/10 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(g > g_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 11/12 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(h > h_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 13/14 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(i > i_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 15/16 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(j > j_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 17/18 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(k > k_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 19/20 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            }else if(l > l_total){
                                bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                                "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 21/22 a la cantidad total del corte y las perdidas"+
                                "</div>")
                            } else {
                                Swal.fire(
                                    'Cantidad validada!',
                                    'Cantidad valida para guardar.',
                                    'info'
                                )
                                $("#btn-tallas").removeClass("btn-orange").addClass("btn-success");

                            }
                        }

                    }else if(genero_global == '3' || genero_global == '4'){
                        if(a > a_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 2 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(b > b_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 4 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(c > c_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 6 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }
                        else if(d > d_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 8 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(e > e_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 10 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(f > f_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 12 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(g > g_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 14 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(h > h_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 16 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        } else {
                            Swal.fire(
                                'Cantidad validada!',
                                'Cantidad valida para guardar.',
                                'info'
                            )
                                $("#btn-tallas").removeClass("btn-orange").addClass("btn-success");

                        }
                    }else if(genero_global == '1'){
                        if(a > a_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 28 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(b > b_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 29 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(c > c_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 30 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }
                        else if(d > d_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 32 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(e > e_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 34 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(f > f_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 36 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(g > g_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 38 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(h > h_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 40 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(i > i_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 42 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(j > j_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 44 a la cantidad total del corte y las perdidas"+
                            "</div>")
                        }else if(k > k_total){
                            bootbox.alert("<div class='alert alert-danger' role='alert'>"+
                            "<i class='fas fa-exclamation-triangle'></i> Digito una cantidad mayor en la talla 46 a la cantidad total del corte y las perdidas"+
                            "</div>") 
                        } else {
                            Swal.fire(
                                'Cantidad validada!',
                                'Cantidad valida para guardar.',
                                'info'
                            )
                            $("#btn-tallas").removeClass("btn-orange").addClass("btn-success");

                        }
                    }else{
                        $("#btn-guardar").show();
                    }




                      

                    } else {
                        bootbox.alert(
                            "Ocurrio un error durante la creacion de la composicion"
                        );
                    }
                },
                error: function() {
                   console.log("ocurrio un error")
                }
        });
    }

    $("#btn-validar").click(function(e){
        e.preventDefault();
        validarTallas();

    });

    // $('#modalPerdida').on('hidden.bs.modal', function (e) {
    //     e.preventDefault();
    //     validarTallas();

    // })

    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#estandar_recibido").hide();
            $("#lavanderia").hide();
            $("#corte").hide();
            $("#corteAdd").show();
            $("#corteEdit").hide();
            $("#lavanderiaAdd").show();
            $("#lavanderiaEdit").hide();
            $("#referencia_producto").hide();
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#estandar_recibido").hide();
            $("#lavanderia").hide();
            $("#corte").hide();
            $("#corteEdit").hide();
            $("#lavanderiaEdit").hide();
            $("#btn-guardar").attr("disabled", true);
            $("#btn-tallas").removeClass("btn-success").addClass("btn-orange");
            $("#referencia_producto").hide();
            $("#btn-generar").show();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
            $("#fila1").hide();
            $("#fila2").hide();
            $("#fila3").hide();
            $("#btn-generar").attr("disabled", true);
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

    init();
});

function mostrar(id_perdida) {
    $.get("perdida/" + id_perdida, function(data, status) {
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
            $("#estandar_recibido").show();
            $("#lavanderia").show();
            $("#corte").show();
            // $("#corteAdd").hide();
            $("#corteEdit").show();
            $("#btn-generar").hide();
            $("#productoEdit").show();
            $("#referencia_producto").show();
            $("#fila1").show();
            $("#fila2").show();
            $("#fila3").show();
            $("#btn-close").hide();
    
    
            $("#id").val(data.perdida.id);
            $("#no_perdida").val(data.perdida.no_perdida);
            $("#tipo_perdida").val(data.perdida.tipo_perdida).change();
            $("#referencia_producto").val('Producto seleccionado: '+data.perdida.producto.referencia_producto);
            $("#fecha").val(data.perdida.fecha);
            $("#fase").val(data.perdida.fase).change();
            $("#motivo").val(data.perdida.motivo).change();
            $("#numero_corte").val('Corte seleccionado: '+data.perdida.corte.numero_corte);
    
            $("#a").val(data.tallas.a);
            $("#b").val(data.tallas.b);
            $("#c").val(data.tallas.c);
            $("#d").val(data.tallas.d);
            $("#e").val(data.tallas.e);
            $("#f").val(data.tallas.f);
            $("#g").val(data.tallas.g);
            $("#h").val(data.tallas.h);
            $("#i").val(data.tallas.i);
            $("#j").val(data.tallas.j);
            $("#k").val(data.tallas.k);
            $("#l").val(data.tallas.l);
            $("#i").attr('disabled', false);
            $("#j").attr('disabled', false);
            $("#k").attr('disabled', false);
            $("#l").attr('disabled', false);
        }
       

    });
}

function eliminar(id_perdida){
    $.post("perdidacheck/delete/" + id_perdida, function(data, status) {
        // console.log(data);
        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            Swal.fire({
                title: '¿Estas seguro de eliminar esta perdida?',
                text: "Va a eliminar las perdidas registradas de este corte!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto'
              }).then((result) => {
                if (result.value) {
                    $.post("perdida/delete/" + id_perdida, function(){
                        Swal.fire(
                        'Eliminado!',
                        'Perdida eliminada correctamente.',
                        'success'
                        )
                        $("#perdida_listada").DataTable().ajax.reload();
                    })
                }
              })
        }
    
    })

}


function eliminarColumnas(){
    if(genero_global == 3 || genero_global == 4){
        $("td:nth-child(9) ,th:nth-child(9)").hide();
        $("td:nth-child(10),th:nth-child(10)").hide();
        $("td:nth-child(11),th:nth-child(11)").hide();
        $("td:nth-child(12),th:nth-child(12)").hide();

    }else if(genero_global == 1){
        $("td:nth-child(9) ,th:nth-child(9)").show();
        $("td:nth-child(10),th:nth-child(10)").show();
        $("td:nth-child(11),th:nth-child(11)").show();

        $("td:nth-child(12),th:nth-child(12)").hide();
    }

    if(genero_plus_global == 7){
        $("td:nth-child(9),th:nth-child(9)").hide();
        $("td:nth-child(11),th:nth-child(10)").hide();
        $("td:nth-child(11),th:nth-child(11)").hide();
        $("td:nth-child(12),th:nth-child(12)").hide();
    }
}
