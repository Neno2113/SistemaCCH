$(document).ready(function() {


    function init() {
        // $("#btn-consultar").attr('disabled', true);
       
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
   
        $.ajax({
            url: "existencia/consulta",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(existencia),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    console.log(datos);
                    var tipo_consulta = $("#tipo_consulta").val();
                    var ref = $("#productoSearch option:selected").text(); 
                 
                    if(tipo_consulta == 'Totales'){
                        $("#transacciones").html(
                            "<tr id='cortes'>"+
                            "<th>CP(Corte)</th>"+
                            "<th>1</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th id='a_corte' class='font-weight-normal'>"+datos.a+"</th>"+
                            "<th id='b_corte' class='font-weight-normal'>"+datos.b+"</th>"+
                            "<th id='c_corte' class='font-weight-normal'>"+datos.c+"</th>"+
                            "<th id='d_corte' class='font-weight-normal'>"+datos.d+"</th>"+
                            "<th id='e_corte' class='font-weight-normal'>"+datos.e+"</th>"+
                            "<th id='f_corte' class='font-weight-normal'>"+datos.f+"</th>"+
                            "<th id='g_corte' class='font-weight-normal'>"+datos.g+"</th>"+
                            "<th id='h_corte' class='font-weight-normal'>"+datos.h+"</th>"+
                            "<th id='i_corte' class='font-weight-normal'>"+datos.i+"</th>"+
                            "<th id='j_corte' class='font-weight-normal'>"+datos.j+"</th>"+
                            "<th id='k_corte' class='font-weight-normal'>"+datos.k+"</th>"+
                            "<th id='l_corte' class='font-weight-normal'>"+datos.l+"</th>"+
                            "</tr>"+
                            "<tr id='almacen'>"+
                            "<th>EA(Almacen)</th>"+
                            "<th>2</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th id='a_alm' class='text-success font-weight-normal'>"+datos.a_alm+"</th>"+
                            "<th id='b_alm' class='text-success font-weight-normal'>"+datos.b_alm+"</th>"+
                            "<th id='c_alm' class='text-success font-weight-normal'>"+datos.c_alm+"</th>"+
                            "<th id='d_alm' class='text-success font-weight-normal'>"+datos.d_alm+"</th>"+
                            "<th id='e_alm' class='text-success font-weight-normal'>"+datos.e_alm+"</th>"+
                            "<th id='f_alm' class='text-success font-weight-normal'>"+datos.f_alm+"</th>"+
                            "<th id='g_alm' class='text-success font-weight-normal'>"+datos.g_alm+"</th>"+
                            "<th id='h_alm' class='text-success font-weight-normal'>"+datos.h_alm+"</th>"+
                            "<th id='i_alm' class='text-success font-weight-normal'>"+datos.i_alm+"</th>"+
                            "<th id='j_alm' class='text-success font-weight-normal'>"+datos.j_alm+"</th>"+
                            "<th id='k_alm' class='text-success font-weight-normal'>"+datos.k_alm+"</th>"+
                            "<th id='l_alm' class='text-success font-weight-normal'>"+datos.l_alm+"</th>"+
                            "</tr>"+
                            "<tr id='perdidas'>"+
                            "<th>PE(Perdida)</th>"+
                            "<th>3</th>"+
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
                            "</tr>"+
                            "<tr id='segundas'>"+
                            "<th>Se(Segunda)</th>"+
                            "<th>4</th>"+
                            "<th id=''  class='font-weight-normal'>"+ref+"</th>"+
                            "<th id='a_seg' class='text-primary font-weight-normal'>"+datos.a_seg+"</th>"+
                            "<th id='b_seg' class='text-primary font-weight-normal'>"+datos.b_seg+"</th>"+
                            "<th id='c_seg' class='text-primary font-weight-normal'>"+datos.c_seg+"</th>"+
                            "<th id='d_seg' class='text-primary font-weight-normal'>"+datos.d_seg+"</th>"+
                            "<th id='e_seg' class='text-primary font-weight-normal'>"+datos.e_seg+"</th>"+
                            "<th id='f_seg' class='text-primary font-weight-normal'>"+datos.f_seg+"</th>"+
                            "<th id='g_seg' class='text-primary font-weight-normal'>"+datos.g_seg+"</th>"+
                            "<th id='h_seg' class='text-primary font-weight-normal'>"+datos.h_seg+"</th>"+
                            "<th id='i_seg' class='text-primary font-weight-normal'>"+datos.i_seg+"</th>"+
                            "<th id='j_seg' class='text-primary font-weight-normal'>"+datos.j_seg+"</th>"+
                            "<th id='k_seg' class='text-primary font-weight-normal'>"+datos.k_seg+"</th>"+
                            "<th id='l_seg' class='text-primary font-weight-normal'>"+datos.l_seg+"</th>"+
                            "<th id='x_seg' class='text-primary font-weight-normal'>"+datos.x_seg+"</th>"+
                            "</tr>"+
                            "<tr id='orden_pedido'>"+
                            "<th>OP(Orden Pedido)</th>"+
                            "<th>5</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th id='a_op'  class='text-primary font-weight-normal'>"+datos.a_op+"</th>"+
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
                            "</tr>"
                        )
                        //almacen
                        let a_alm = parseInt($("#a_alm").text());
                        let b_alm = parseInt($("#b_alm").text());
                        let c_alm = parseInt($("#c_alm").text());
                        let d_alm = parseInt($("#d_alm").text());
                        let e_alm = parseInt($("#e_alm").text());
                        let f_alm = parseInt($("#f_alm").text());
                        let g_alm = parseInt($("#g_alm").text());
                        let h_alm = parseInt($("#h_alm").text());
                        let i_alm = parseInt($("#i_alm").text());
                        let j_alm = parseInt($("#j_alm").text());
                        let k_alm = parseInt($("#k_alm").text());
                        let l_alm = parseInt($("#l_alm").text());

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
                        
                        //segundas
                        let a_seg = parseInt($("#a_seg").text());
                        let b_seg = parseInt($("#b_seg").text());
                        let c_seg = parseInt($("#c_seg").text());
                        let d_seg = parseInt($("#d_seg").text());
                        let e_seg = parseInt($("#e_seg").text());
                        let f_seg = parseInt($("#f_seg").text());
                        let g_seg = parseInt($("#g_seg").text());
                        let h_seg = parseInt($("#h_seg").text());
                        let i_seg = parseInt($("#i_seg").text());
                        let j_seg = parseInt($("#j_seg").text());
                        let k_seg = parseInt($("#k_seg").text());
                        let l_seg = parseInt($("#l_seg").text());

                        //existencia
                        let a_op = parseInt($("#a_op").text());
                        let b_op = parseInt($("#b_op").text());
                        let c_op = parseInt($("#c_op").text());
                        let d_op = parseInt($("#d_op").text());
                        let e_op = parseInt($("#e_op").text());
                        let f_op = parseInt($("#f_op").text());
                        let g_op = parseInt($("#g_op").text());
                        let h_op = parseInt($("#h_op").text());
                        let i_op = parseInt($("#i_op").text());
                        let j_op = parseInt($("#j_op").text());
                        let k_op = parseInt($("#k_op").text());
                        let l_op = parseInt($("#l_op").text());

                        $("#ref").html(ref);
                        $("#a").html(a_corte - a_perd);
                        $("#b").html(b_corte - b_perd);
                        $("#c").html(c_corte - c_perd);
                        $("#d").html(d_corte - d_perd);
                        $("#e").html(e_corte - e_perd);
                        $("#f").html(f_corte - f_perd);
                        $("#g").html(g_corte - g_perd);
                        $("#h").html(h_corte - h_perd);
                        $("#i").html(i_corte - i_perd);
                        $("#j").html(j_corte - j_perd);
                        $("#k").html(k_corte - k_perd);
                        $("#l").html(l_corte - l_perd);

                        $("#ref_venta").html(ref);
                        (a_alm - a_perd - a_op < 0) ? $("#a_venta").html(0) : $("#a_venta").html(a_alm - a_perd - a_op - a_seg);  
                        (b_alm - b_perd - b_op < 0) ? $("#b_venta").html(0) : $("#b_venta").html(b_alm - b_perd - b_op - b_seg);
                        (c_alm - c_perd - c_op < 0) ? $("#c_venta").html(0) : $("#c_venta").html(c_alm - c_perd - c_op - c_seg);  
                        (d_alm - d_perd - d_op < 0) ? $("#d_venta").html(0) : $("#d_venta").html(d_alm - d_perd - d_op - d_seg); 
                        (e_alm - e_perd - e_op < 0) ? $("#e_venta").html(0) : $("#e_venta").html(e_alm - e_perd - e_op - e_seg);
                        (f_alm - f_perd - f_op < 0) ? $("#f_venta").html(0) : $("#f_venta").html(f_alm - f_perd - f_op - f_seg);  
                        (g_alm - g_perd - g_op < 0) ? $("#g_venta").html(0) : $("#g_venta").html(g_alm - g_perd - g_op - g_seg);  
                        (h_alm - h_perd - h_op < 0) ? $("#h_venta").html(0) : $("#h_venta").html(h_alm - h_perd - h_op - h_seg);  
                        (i_alm - i_perd - i_op < 0) ? $("#i_venta").html(0) : $("#i_venta").html(i_alm - i_perd - i_op - i_seg);                   
                        (j_alm - j_perd - j_op < 0) ? $("#j_venta").html(0) : $("#j_venta").html(j_alm - j_perd - j_op - j_seg); 
                        (k_alm - k_perd - k_op < 0) ? $("#k_venta").html(0) : $("#k_venta").html(k_alm - k_perd - k_op - k_seg);
                        (l_alm - l_perd - l_op < 0) ? $("#l_venta").html(0) : $("#l_venta").html(l_alm - l_perd - l_op - l_seg); 
                        

                        $("#totales").show();
                        $("#disp_venta").show();
                    }else if(tipo_consulta == 'Detallada'){
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

                        for (let i = 0; i < longitud; i++) {
                            var fila =  "<tr>"+
                            "<th> CP(Corte)</th>"+
                            "<th>"+datos.tallas[i].corte.numero_corte +"</th>"+
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
                            "<th>"+datos.tallasAlmacen[i].id +"</th>"+
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
                            "<th>"+datos.tallasPerdidas[i].perdida.no_perdida+"</th>"+
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
                            "<th>"+ datos.tallaSegundas[i].perdida.no_perdida +"</th>"+
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
                            "<th>"+ datos.tallasOrdenes[i].orden_pedido_id +"</th>"+
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

  

 




    init();
});
