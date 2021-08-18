let genero;
let mujer_plus;
$(document).ready(function() {


    function init() {
        // $("#btn-consultar").attr('disabled', true);
        $("#codigo").hide();
        $('#refDos-div').hide();

    }

    String.prototype.replaceAll = function (find, replace) {
        var str = this;
        return str.replace(new RegExp(find, 'g'), replace);
    };


    $("#productoSearch").select2({
        placeholder: "Referencia producto Ej: P100-XXXX",
        ajax: {
            url: 'producto_existencia',
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
            cache: true,

        }
    })


    $("#btn-consultar").on('click', function(e){
        e.preventDefault();

        var existencia = {
            producto_id: $("#productoSearch").val(),
            referencia_producto: $("#productoSearch option:selected").text(),

        };

        val = $("#productoSearch option:selected").text();
        genero = val.substring(1, 2);
        mujer_plus = val.substring(3, 4);

        $.ajax({
            url: "existencia/consulta",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(existencia),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {

                    var tipo_consulta = $("#tipo_consulta").val();
                    var ref = $("#productoSearch option:selected").text();

                    if(datos.referenciaDos){
                        $('#refDos-div').show();
                        $('#referenciaDos').val(datos.referenciaDos.referencia_producto);
                    } else {
                        $('#refDos-div').hide();
                    }
             
                      // listarCorteDetalle(datos.id);
                      if (genero == "2") {

                        if (mujer_plus == 7) {
                            $("#ta").html("12W");
                            $("#tb").html("14W");
                            $("#tc").html("16W");
                            $("#td").html("18W");
                            $("#te").html("20W");
                            $("#tf").html("22W");
                            $("#tg").html("24W");
                            $("#th").html("26W");
                            $("#ti").html("I");
                            $("#tj").html("J");
                            $("#tk").html("K");
                            $("#tl").html("L");
                        } else {
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
                    if (genero == "3") {
                        $("#genero").val("Niño: " + val);

                        $("#ta").html("2");
                        $("#tb").html("4");
                        $("#tc").html("6");
                        $("#td").html("8");
                        $("#te").html("10");
                        $("#tf").html("12");
                        $("#tg").html("14");
                        $("#th").html("16");
                        $("#ti").html("I");
                        $("#tj").html("J");
                        $("#tk").html("K");
                        $("#tl").html("L");

                    } else if (genero == "4") {
                        $("#genero").val("Niña: " + val);

                        $("#ta").html("2");
                        $("#tb").html("4");
                        $("#tc").html("6");
                        $("#td").html("8");
                        $("#te").html("10");
                        $("#tf").html("12");
                        $("#tg").html("14");
                        $("#th").html("16");
                        $("#ti").html("I");
                        $("#tj").html("J");
                        $("#tk").html("K");
                        $("#tl").html("L");
                    } else if (genero == "1") {
                        $("#genero").val("Hombre: " + val);

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
                        $("#tl").html("L");
                    }




                    if(tipo_consulta == 'Totales'){
                        $("#codigo").hide();
                        $("#transacciones").html(
                            "<tr id='cortes'>"+
                            "<th>CP(Corte)</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th id='a_corte' class='font-weight-normal'>"+datos.a_corte+"</th>"+
                            "<th id='b_corte' class='font-weight-normal'>"+datos.b_corte+"</th>"+
                            "<th id='c_corte' class='font-weight-normal'>"+datos.c_corte+"</th>"+
                            "<th id='d_corte' class='font-weight-normal'>"+datos.d_corte+"</th>"+
                            "<th id='e_corte' class='font-weight-normal'>"+datos.e_corte+"</th>"+
                            "<th id='f_corte' class='font-weight-normal'>"+datos.f_corte+"</th>"+
                            "<th id='g_corte' class='font-weight-normal'>"+datos.g_corte+"</th>"+
                            "<th id='h_corte' class='font-weight-normal'>"+datos.h_corte+"</th>"+
                            "<th id='i_corte' class='font-weight-normal'>"+datos.i_corte+"</th>"+
                            "<th id='j_corte' class='font-weight-normal'>"+datos.j_corte+"</th>"+
                            "<th id='k_corte' class='font-weight-normal'>"+datos.k_corte+"</th>"+
                            "<th id='l_corte' class='font-weight-normal'>"+datos.l_corte+"</th>"+
                            "<th id='l_corte' class='font-weight-normal'></th>"+
                            "<th id='l_corte' class='font-weight-bold'>"+datos.total_corte+"</th>"+
                            "</tr>"+
                            "<tr id='almacen'>"+
                            "<th>EA(Almacen)</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th id='a_alm' class='text-success '>"+datos.a_alm+"</th>"+
                            "<th id='b_alm' class='text-success '>"+datos.b_alm+"</th>"+
                            "<th id='c_alm' class='text-success '>"+datos.c_alm+"</th>"+
                            "<th id='d_alm' class='text-success '>"+datos.d_alm+"</th>"+
                            "<th id='e_alm' class='text-success '>"+datos.e_alm+"</th>"+
                            "<th id='f_alm' class='text-success '>"+datos.f_alm+"</th>"+
                            "<th id='g_alm' class='text-success '>"+datos.g_alm+"</th>"+
                            "<th id='h_alm' class='text-success '>"+datos.h_alm+"</th>"+
                            "<th id='i_alm' class='text-success '>"+datos.i_alm+"</th>"+
                            "<th id='j_alm' class='text-success '>"+datos.j_alm+"</th>"+
                            "<th id='k_alm' class='text-success '>"+datos.k_alm+"</th>"+
                            "<th id='l_alm' class='text-success '>"+datos.l_alm+"</th>"+
                            "<th id='l_alm' class='text-success '></th>"+
                            "<th id='l_alm' class='text-success '>"+datos.total_alm+"</th>"+
                            "</tr>"+
                            "<tr id='perdidas'>"+
                            "<th>PE(Perdida)</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th id='a_perd' class='text-red font-weight-normal'>"+datos.a_perd+"</th>"+
                            "<th id='b_perd' class='text-red font-weight-normal'>"+datos.b_perd+"</th>"+
                            "<th id='c_perd' class='text-red font-weight-normal'>"+datos.c_perd+"</th>"+
                            "<th id='d_perd' class='text-red font-weight-normal'>"+datos.d_perd+"</th>"+
                            "<th id='e_perd' class='text-red font-weight-normal'>"+datos.e_perd+"</th>"+
                            "<th id='f_perd' class='text-red font-weight-normal'>"+datos.f_perd+"</th>"+
                            "<th id='g_perd' class='text-red font-weight-normal'>"+datos.g_perd+"</th>"+
                            "<th id='h_perd' class='text-red font-weight-normal'>"+datos.h_perd+"</th>"+
                            "<th id='i_perd' class='text-red font-weight-normal'>"+datos.i_perd+"</th>"+
                            "<th id='j_perd' class='text-red font-weight-normal'>"+datos.j_perd+"</th>"+
                            "<th id='k_perd' class='text-red font-weight-normal'>"+datos.k_perd+"</th>"+
                            "<th id='l_perd' class='text-red font-weight-normal'>"+datos.l_perd+"</th>"+
                            "<th id='x_perd' class='text-red font-weight-normal'>"+datos.x_perd+"</th>"+
                            "<th id='x_perd' class='text-red font-weight-bold'>"+datos.total_perd+"</th>"+
                            "</tr>"+
                            "<tr id='segundas'>"+
                            "<th>Se(Segunda)</th>"+
                            "<th id=''  class='font-weight-normal'>"+ref+"</th>"+
                            "<th id='a_seg' class='text-red font-weight-normal'>"+datos.a_seg+"</th>"+
                            "<th id='b_seg' class='text-red font-weight-normal'>"+datos.b_seg+"</th>"+
                            "<th id='c_seg' class='text-red font-weight-normal'>"+datos.c_seg+"</th>"+
                            "<th id='d_seg' class='text-red font-weight-normal'>"+datos.d_seg+"</th>"+
                            "<th id='e_seg' class='text-red font-weight-normal'>"+datos.e_seg+"</th>"+
                            "<th id='f_seg' class='text-red font-weight-normal'>"+datos.f_seg+"</th>"+
                            "<th id='g_seg' class='text-red font-weight-normal'>"+datos.g_seg+"</th>"+
                            "<th id='h_seg' class='text-red font-weight-normal'>"+datos.h_seg+"</th>"+
                            "<th id='i_seg' class='text-red font-weight-normal'>"+datos.i_seg+"</th>"+
                            "<th id='j_seg' class='text-red font-weight-normal'>"+datos.j_seg+"</th>"+
                            "<th id='k_seg' class='text-red font-weight-normal'>"+datos.k_seg+"</th>"+
                            "<th id='l_seg' class='text-red font-weight-normal'>"+datos.l_seg+"</th>"+
                            "<th id='x_seg' class='text-red font-weight-normal'>"+datos.x_seg+"</th>"+
                            "<th id='x_seg' class='text-red font-weight-bold'>"+datos.total_seg+"</th>"+
                            "</tr>"+
                            "<tr id='orden_pedido'>"+
                            "<th>OP(Orden Pedido)</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th id='a_op' class='text-primary font-weight-normal'>"+datos.a_op+"</th>"+
                            "<th id='b_op' class='text-primary font-weight-normal'>"+datos.b_op+"</th>"+
                            "<th id='c_op' class='text-primary font-weight-normal'>"+datos.c_op+"</th>"+
                            "<th id='d_op' class='text-primary font-weight-normal'>"+datos.d_op+"</th>"+
                            "<th id='e_op' class='text-primary font-weight-normal'>"+datos.e_op+"</th>"+
                            "<th id='f_op' class='text-primary font-weight-normal'>"+datos.f_op+"</th>"+
                            "<th id='g_op' class='text-primary font-weight-normal'>"+datos.g_op+"</th>"+
                            "<th id='h_op' class='text-primary font-weight-normal'>"+datos.h_op+"</th>"+
                            "<th id='i_op' class='text-primary font-weight-normal'>"+datos.i_op+"</th>"+
                            "<th id='j_op' class='text-primary font-weight-normal'>"+datos.j_op+"</th>"+
                            "<th id='k_op' class='text-primary font-weight-normal'>"+datos.k_op+"</th>"+
                            "<th id='l_op' class='text-primary font-weight-normal'>"+datos.l_op+"</th>"+
                            "<th id='l_op' class='text-primary font-weight-normal'></th>"+
                            "<th id='l_op' class='text-primary font-weight-bold'>"+datos.total_op+"</th>"+
                            "</tr>"+
                            "<tr id='facturado'>"+
                            "<th>FB(Facturacion)</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th id='a_op'  class='text-primary font-weight-normal'>"+datos.a_fb+"</th>"+
                            "<th id='b_op' class='text-primary font-weight-normal'>"+datos.b_fb+"</th>"+
                            "<th id='c_op' class='text-primary font-weight-normal'>"+datos.c_fb+"</th>"+
                            "<th id='d_op' class='text-primary font-weight-normal'>"+datos.d_fb+"</th>"+
                            "<th id='e_op' class='text-primary font-weight-normal'>"+datos.e_fb+"</th>"+
                            "<th id='f_op' class='text-primary font-weight-normal'>"+datos.f_fb+"</th>"+
                            "<th id='g_op' class='text-primary font-weight-normal'>"+datos.g_fb+"</th>"+
                            "<th id='h_op' class='text-primary font-weight-normal'>"+datos.h_fb+"</th>"+
                            "<th id='i_op' class='text-primary font-weight-normal'>"+datos.i_fb+"</th>"+
                            "<th id='j_op' class='text-primary font-weight-normal'>"+datos.j_fb+"</th>"+
                            "<th id='k_op' class='text-primary font-weight-normal'>"+datos.k_fb+"</th>"+
                            "<th id='l_op' class='text-primary font-weight-normal'>"+datos.l_fb+"</th>"+
                            "<th id='l_op' class='text-primary font-weight-normal'></th>"+
                            "<th id='l_op' class='text-primary font-weight-bold'>"+datos.total_fb+"</th>"+
                            "</tr>"+
                            "<tr id='nota_credito'>"+
                            "<th>NC(Nota credito)</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th id='a_op'  class='text-primary font-weight-normal'>"+datos.a_nc+"</th>"+
                            "<th id='b_op' class='text-primary font-weight-normal'>"+datos.b_nc+"</th>"+
                            "<th id='c_op' class='text-primary font-weight-normal'>"+datos.c_nc+"</th>"+
                            "<th id='d_op' class='text-primary font-weight-normal'>"+datos.d_nc+"</th>"+
                            "<th id='e_op' class='text-primary font-weight-normal'>"+datos.e_nc+"</th>"+
                            "<th id='f_op' class='text-primary font-weight-normal'>"+datos.f_nc+"</th>"+
                            "<th id='g_op' class='text-primary font-weight-normal'>"+datos.g_nc+"</th>"+
                            "<th id='h_op' class='text-primary font-weight-normal'>"+datos.h_nc+"</th>"+
                            "<th id='i_op' class='text-primary font-weight-normal'>"+datos.i_nc+"</th>"+
                            "<th id='j_op' class='text-primary font-weight-normal'>"+datos.j_nc+"</th>"+
                            "<th id='k_op' class='text-primary font-weight-normal'>"+datos.k_nc+"</th>"+
                            "<th id='l_op' class='text-primary font-weight-normal'>"+datos.l_nc+"</th>"+
                            "<th id='l_op' class='text-primary font-weight-normal'></th>"+
                            "<th id='l_op' class='text-primary font-weight-bold'>"+datos.total_nc+"</th>"+
                            "</tr>"


                        )


                        // $("#ref").html(ref);
                        $("#a").html(datos.a);
                        $("#b").html(datos.b);
                        $("#c").html(datos.c);
                        $("#d").html(datos.d);
                        $("#e").html(datos.e);
                        $("#f").html(datos.f);
                        $("#g").html(datos.g);
                        $("#h").html(datos.h);
                        $("#i").html(datos.i);
                        $("#j").html(datos.j);
                        $("#k").html(datos.k);
                        $("#l").html(datos.l);
                        $("#total").html(datos.total);

                        // $("#ref_venta").html(ref);
                        $("#a_venta").html(datos.a_disp);
                        $("#b_venta").html(datos.b_disp);
                        $("#c_venta").html(datos.c_disp);
                        $("#d_venta").html(datos.d_disp);
                        $("#e_venta").html(datos.e_disp);
                        $("#f_venta").html(datos.f_disp);
                        $("#g_venta").html(datos.g_disp);
                        $("#h_venta").html(datos.h_disp);
                        $("#i_venta").html(datos.i_disp);
                        $("#j_venta").html(datos.j_disp);
                        $("#k_venta").html(datos.k_disp);
                        $("#l_venta").html(datos.l_disp);
                        $("#total_venta").html(datos.total_disp);

                        // $("#ref_venta").html(ref);
                        $("#a_venta_seg").html(datos.a_dispSeg);
                        $("#b_venta_seg").html(datos.b_dispSeg);
                        $("#c_venta_seg").html(datos.c_dispSeg);
                        $("#d_venta_seg").html(datos.d_dispSeg);
                        $("#e_venta_seg").html(datos.e_dispSeg);
                        $("#f_venta_seg").html(datos.f_dispSeg);
                        $("#g_venta_seg").html(datos.g_dispSeg);
                        $("#h_venta_seg").html(datos.h_dispSeg);
                        $("#i_venta_seg").html(datos.i_dispSeg);
                        $("#j_venta_seg").html(datos.j_dispSeg);
                        $("#k_venta_seg").html(datos.k_dispSeg);
                        $("#l_venta_seg").html(datos.l_dispSeg);
                        $("#total_venta_seg").html(datos.total_dispSeg);


                        $("#totales").show();
                        $("#disp_venta").show();
                    }else if(tipo_consulta == 'Detallada'){
                        $("#codigo").show();
                        var longitud = datos.tallas.length;
                        var longitudPerdidas = datos.tallasPerdidas.length;
                        var longitudSegundas = datos.tallaSegundas.length;
                        var longitudAlmacen = datos.tallasAlmacen.length;
                        var longitudPedidos = datos.tallasOrdenes.length;

                        $("#cortes").hide();
                        $("#perdidas").hide();
                        $("#segundas").hide();
                        $("#almacen").hide();
                        $("#totales").hide();
                        $("#disp_venta").hide();
                        $("#facturado").hide();
                        $("#nota_credito").hide();
                        $("#orden_pedido").hide();
                        $("#disp_venta_segunda").hide();

                        for (let i = 0; i < longitud; i++) {
                            var fila =  "<tr>"+
                            "<th>CP(Corte) </th>"+
                            "<td>"+datos.tallas[i].corte.numero_corte +"</td>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].a+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].b+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].c+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].d+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].e+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].f+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].g+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].h+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].i+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].j+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].k+"</th>"+
                            "<th class='font-weight-normal'>"+datos.tallas[i].l+"</th>"+
                            "</tr>";
                            $("#transacciones").append(fila);
                        }

                        for (let i = 0; i < longitudAlmacen; i++) {

                            var fila =  "<tr >"+
                            "<th> EA(Almacen) </th>"+
                            "<td></td>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].a+"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].b +"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].c+"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].d+"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].e+"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].f+"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].g+"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].h+"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].i+"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].j+"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].k+"</th>"+
                            "<th class='text-success font-weight-normal'>"+datos.tallasAlmacen[i].l+"</th>"+

                            "</tr>";

                            fila = fila.replaceAll('null', '');

                            $("#transacciones").append(fila);

                        }

                        for (let i = 0; i < longitudPerdidas; i++) {

                            var fila =  "<tr >"+
                            "<th>PE(Perdida)</th>"+
                            "<td>"+datos.tallasPerdidas[i].perdida.no_perdida +"</td>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].a+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].b +"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].c+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].d+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].e+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].f+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].g+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].h+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].i+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].j+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].k+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].l+"</th>"+
                            "<th class='text-red font-weight-normal'>"+datos.tallasPerdidas[i].talla_x+"</th>"+
                            "</tr>";

                            fila = fila.replaceAll('null', '');

                            $("#transacciones").append(fila);

                        }

                        for (let i = 0; i < longitudSegundas; i++) {

                            var fila =  "<tr >"+
                            "<th>SE(Segunda)</th>"+
                            "<td>"+datos.tallaSegundas[i].perdida.no_perdida +"</td>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].a+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].b +"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].c+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].d+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].e+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].f+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].g+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].h+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].i+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].j+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].k+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].l+"</th>"+
                            "<th class='text-primary font-weight-normal'>"+datos.tallaSegundas[i].talla_x+"</th>"+
                            "</tr>";

                            fila = fila.replaceAll('null', '');

                            $("#transacciones").append(fila);

                        }

                        for (let i = 0; i < longitudPedidos; i++) {

                            var fila =  "<tr >"+
                            "<th>OP(Orden Pedido)</th>"+
                            "<td>"+datos.tallasOrdenes[i].ordenPedido.no_orden_pedido+"</td>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].a+"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].b +"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].c+"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].d+"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].e+"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].f+"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].g+"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].h+"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].i+"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].j+"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].k+"</th>"+
                            "<th class='text-info font-weight-normal'>"+datos.tallasOrdenes[i].l+"</th>"+
                            "</tr>";

                            fila = fila.replaceAll('null', '');

                            $("#transacciones").append(fila);

                        }
                    }

                    $("#btn-consultar").attr('disabled', true);
                    eliminarColumnas();

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
    });

    $("#btn-guardar").click(function(e) {
        // validacion(e);
        e.preventDefault();

        //corte
        let a_corte = parseInt($("#a_corte").text());
        let b_corte = parseInt($("#b_corte").text());
        let c_corte = parseInt($("#c_corte").text());
        let d_corte = parseInt($("#d_corte").text());
        let e_corte = parseInt($("#e_corte").text());
        let f_corte = parseInt($("#f_corte").text());
        let g_corte = parseInt($("#g_corte").text());
        let h_corte = parseInt($("#h_corte").text());
        let i_corte = parseInt($("#i_corte").text());
        let j_corte = parseInt($("#j_corte").text());
        let k_corte = parseInt($("#k_corte").text());
        let l_corte = parseInt($("#l_corte").text());

        //perdida
        let a_perd = parseInt($("#a_perd").text());
        let b_perd = parseInt($("#b_perd").text());
        let c_perd = parseInt($("#c_perd").text());
        let d_perd = parseInt($("#d_perd").text());
        let e_perd = parseInt($("#e_perd").text());
        let f_perd = parseInt($("#f_perd").text());
        let g_perd = parseInt($("#g_perd").text());
        let h_perd = parseInt($("#h_perd").text());
        let i_perd = parseInt($("#i_perd").text());
        let j_perd = parseInt($("#j_perd").text());
        let k_perd = parseInt($("#k_perd").text());
        let l_perd = parseInt($("#l_perd").text());



        var existencia = {
            a: a_corte - a_perd,
            b: b_corte - b_perd,
            c: c_corte - c_perd,
            d: d_corte - d_perd,
            e: e_corte - e_perd,
            f: f_corte - f_perd,
            g: g_corte - g_perd,
            h: h_corte - h_perd,
            i: i_corte - i_perd,
            j: j_corte - j_perd,
            k: k_corte - k_perd,
            l: l_corte - l_perd,
            producto_id: $("#productoSearch").val(),
            corte_id: $("#corte_id").val(),
            almacen_id: $("#almacen_id").val(),
            perdida: $("#perdida_id").val()
        };

        // console.log(JSON.stringify(existencia));

        $.ajax({
            url: "existencia",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(existencia),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#a").html(datos.existencia.a);
                    $("#b").html(datos.existencia.b);
                    $("#c").html(datos.existencia.c);
                    $("#d").html(datos.existencia.d);
                    $("#e").html(datos.existencia.e);
                    $("#f").html(datos.existencia.f);
                    $("#g").html(datos.existencia.g);
                    $("#h").html(datos.existencia.h);
                    $("#i").html(datos.existencia.i);
                    $("#j").html(datos.existencia.j);
                    $("#k").html(datos.existencia.k);
                    $("#l").html(datos.existencia.l);

                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion del usuario verifique los datos suministrados!!"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    $("#tipo_consulta").change(function(){
        $("#btn-consultar").attr('disabled', false);
    });

    $("#productoSearch").change(function(){
        $("#btn-consultar").attr('disabled', false);
    });






    init();
});

function mostrar(id_almacen) {
    $.get("almacen/" + id_almacen, function(data, status) {
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").show();
        $("#btn-guardar").hide();
        $("#referencia_producto").show();
        $("#numero_corte").show();
        $("#corteEdit").show();
        $("#corteAdd").hide();



        $("#id").val(data.almacen.id);
        $("#referencia_producto").val('Referencia elegida: '+data.almacen.producto.referencia_producto);
        $("#numero_corte").val('Corte elegido: '+data.almacen.corte.numero_corte);
        $("#ubicacion").val(data.almacen.producto.ubicacion);
        $("#tono").val("");
        $("#intensidad_proceso_seco").val(data.almacen.producto.intensidad_proceso_seco);
        $("#atributo_no_1").val(data.almacen.producto.atributo_no_1);
        $("#atributo_no_2").val(data.almacen.producto.atributo_no_2);
        $("#atributo_no_3").val(data.almacen.producto.atributo_no_3);
        $("#a").val(data.almacen.a);
        $("#b").val(data.almacen.b);
        $("#c").val(data.almacen.c);
        $("#d").val(data.almacen.d);
        $("#e").val(data.almacen.e);
        $("#f").val(data.almacen.f);
        $("#g").val(data.almacen.g);
        $("#h").val(data.almacen.h);
        $("#i").val(data.almacen.i);
        $("#j").val(data.almacen.j);
        $("#k").val(data.almacen.k);
        $("#l").val(data.almacen.l);
        $("#genero").val(data.almacen.producto.referencia_producto);
        $("#frente").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_frente)
        $("#trasera").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_trasero)
        $("#perfil").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_perfil)
        $("#bolsillo").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_bolsillo)
    });
}

function eliminarColumnas(){
    if(genero == 3 || genero == 4){
        $("td:nth-child(12) ,th:nth-child(12)").hide();
        $("td:nth-child(13),th:nth-child(13)").hide();
        $("td:nth-child(14),th:nth-child(14)").hide();
        $("td:nth-child(15),th:nth-child(15)").hide();

    }else if(genero == 1){
        $("td:nth-child(12) ,th:nth-child(12)").show();
        $("td:nth-child(13),th:nth-child(13)").show();
        $("td:nth-child(14),th:nth-child(14)").show();

        $("td:nth-child(15),th:nth-child(15)").hide();
    }else if(genero == 2){
        $("td:nth-child(12) ,th:nth-child(12)").show();
        $("td:nth-child(13),th:nth-child(13)").show();
        $("td:nth-child(14),th:nth-child(14)").show();

        $("td:nth-child(15),th:nth-child(15)").show();
    }

    if(mujer_plus == 7){
        $("td:nth-child(12),th:nth-child(12)").hide();
        $("td:nth-child(13),th:nth-child(13)").hide();
        $("td:nth-child(14),th:nth-child(14)").hide();
        $("td:nth-child(15),th:nth-child(15)").hide();
    }
}


function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
}



function eliminar(id_almacen){
    bootbox.confirm("¿Estas seguro de eliminar este producto de almacen?", function(result){
        if(result){
            $.post("almacen/delete/" + id_almacen, function(){
                bootbox.alert("Producto de almacen eliminado correctamente!!");
                $("#almacenes").DataTable().ajax.reload();
            })
        }
    })
}

// function test(){
//     alert("test");
//     console.log("Test");
// }
