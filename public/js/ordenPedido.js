$(document).ready(function() {


    function init() {
            // $("input[name='r1']:checked").val("");
        mostrarDetalle();           
       
    }

    var data;

    String.prototype.replaceAll = function (find, replace) {
        var str = this;
        return str.replace(new RegExp(find, 'g'), replace);
    };

    function mostrarDetalle(flag){
        if(flag){
            $("#ta").show();
            $("#tb").show();
            $("#tc").show();
            $("#td").show();
            $("#te").show();
            $("#tf").show();
            $("#tg").show();
            $("#th").show();
            $("#ti").show();
            $("#tj").show();
            $("#tk").show();
            $("#tl").show();
            $("#detallada").show();
            $("#redistribucion").hide();
            $("#detalles").show();
        }else{
            $("#ta").hide();
            $("#tb").hide();
            $("#tc").hide();
            $("#td").hide();
            $("#te").hide();
            $("#tf").hide();
            $("#tg").hide();
            $("#th").hide();
            $("#ti").hide();
            $("#tj").hide();
            $("#tk").hide();
            $("#tl").hide();
            $("#detallada").hide();
            $("#redistribucion").show();
            $("#detalles").hide();
        }
            
    }


    $("#productoSearch").select2({
        placeholder: "Referencia producto Ej: P100-XXXX",
        ajax: {
            url: 'selectproducto',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        console.log(data);
                        return {
                            text: item.referencia_producto+" - "+ item.fase ,
                            id: item.id
                        }
                    })   
                    
                };
            },
            cache: true,

        }
    })

    $("#clienteSearch").select2({
        placeholder: "Nombre del cliente",
        ajax: {
            url: 'selectCliente',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        console.log(data);
                        return {
                            text: item.nombre_cliente+" - "+ item.contacto_cliente_principal ,
                            id: item.id
                        }
                    })   
                    
                };
            },
            cache: true,

        }
    })

    $("#sucursalSearch").select2({
        placeholder: "Nombre sucursal",
        ajax: {
            url: 'selectSucursal',
            dataType: 'json',
            delay: 250,
            processResults: function(data){
                return {
                    results: $.map(data, function(item){
                        console.log(data);
                        return {
                            text: item.nombre_sucursal,
                            id: item.id
                        }
                    })   
                    
                };
            },
            cache: true,

        }
    })

    $("#btn-consultar").click(function(e){
        e.preventDefault();
        let val = $("input[name='r2']:checked").val();
        
        if(val == 1){
        mostrarDetalle(true);

        var ordenPedido = {
            producto_id: $("#productoSearch").val(),
            referencia_producto: $("#productoSearch option:selected").text(),
            
        };

        $.ajax({
            url: "ordenPedido/consulta",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(ordenPedido),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    console.log(datos);
                    data = datos;
                    var ref = $("#productoSearch option:selected").text(); 
                    var genero = ref.substring(1,2);
                    if(genero == 1){
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
                        $("#da").html("28");
                        $("#db").html("29");
                        $("#dc").html("30");
                        $("#dd").html("32");
                        $("#de").html("34");
                        $("#df").html("36");
                        $("#dg").html("38");
                        $("#dh").html("40");
                        $("#di").html("42");
                        $("#dj").html("44");
                        $("#i").attr('disabled', false);
                        $("#j").attr('disabled', false);
                        $("#k").hide();
                        $("#l").hide();
                        $("#kp").hide();
                        $("#lp").hide();
                      
                        $("#disponibles").html(
                            "<tr id='cortes'>"+
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
                            "</tr>"
                        )
                    }else if(genero == 3){
                        $("#sub-genero").hide();
                        $("#ta").html("2");
                        $("#tb").html("4");
                        $("#tc").html("6");
                        $("#td").html("8");
                        $("#te").html("10");
                        $("#tf").html("12");
                        $("#tg").html("14");
                        $("#th").html("16");
                        $("#da").html("2");
                        $("#db").html("4");
                        $("#dc").html("6");
                        $("#dd").html("8");
                        $("#de").html("10");
                        $("#df").html("12");
                        $("#dg").html("14");
                        $("#dh").html("16");
                        $("#i").attr('disabled', true);
                        $("#j").attr('disabled', true);
                        $("#k").attr('disabled', true);
                        $("#l").attr('disabled', true);
                        $("#disponibles").html(
                            "<tr id='cortes'>"+
                            "<th id='a_corte' class='font-weight-normal'>"+datos.a+"</th>"+
                            "<th id='b_corte' class='font-weight-normal'>"+datos.b+"</th>"+
                            "<th id='c_corte' class='font-weight-normal'>"+datos.c+"</th>"+
                            "<th id='d_corte' class='font-weight-normal'>"+datos.d+"</th>"+
                            "<th id='e_corte' class='font-weight-normal'>"+datos.e+"</th>"+
                            "<th id='f_corte' class='font-weight-normal'>"+datos.f+"</th>"+
                            "<th id='g_corte' class='font-weight-normal'>"+datos.g+"</th>"+
                            "<th id='h_corte' class='font-weight-normal'>"+datos.h+"</th>"+
                            "<th id='i_corte' class='font-weight-normal'>"+"</th>"+
                            "<th id='j_corte' class='font-weight-normal'>"+"</th>"+
                            "<th id='k_corte' class='font-weight-normal'>"+"</th>"+
                            "<th id='l_corte' class='font-weight-normal'>"+"</th>"+
                            "</tr>"
                        );
                    }else if(genero == 4){
                        $("#sub-genero").hide();
                        $("#ta").html("2");
                        $("#tb").html("4");
                        $("#tc").html("6");
                        $("#td").html("8");
                        $("#te").html("10");
                        $("#tf").html("12");
                        $("#tg").html("14");
                        $("#th").html("16");
                        $("#da").html("2");
                        $("#db").html("4");
                        $("#dc").html("6");
                        $("#dd").html("8");
                        $("#de").html("10");
                        $("#df").html("12");
                        $("#dg").html("14");
                        $("#dh").html("16");
                        $("#i").attr('disabled', true);
                        $("#j").attr('disabled', true);
                        $("#k").attr('disabled', true);
                        $("#l").attr('disabled', true);
                        $("#disponibles").html(
                            "<tr id='cortes'>"+
                            "<th id='a_corte' class='font-weight-normal'>"+datos.a+"</th>"+
                            "<th id='b_corte' class='font-weight-normal'>"+datos.b+"</th>"+
                            "<th id='c_corte' class='font-weight-normal'>"+datos.c+"</th>"+
                            "<th id='d_corte' class='font-weight-normal'>"+datos.d+"</th>"+
                            "<th id='e_corte' class='font-weight-normal'>"+datos.e+"</th>"+
                            "<th id='f_corte' class='font-weight-normal'>"+datos.f+"</th>"+
                            "<th id='g_corte' class='font-weight-normal'>"+datos.g+"</th>"+
                            "<th id='h_corte' class='font-weight-normal'>"+datos.h+"</th>"+
                            "<th id='i_corte' class='font-weight-normal'>"+"</th>"+
                            "<th id='j_corte' class='font-weight-normal'>"+"</th>"+
                            "<th id='k_corte' class='font-weight-normal'>"+"</th>"+
                            "<th id='l_corte' class='font-weight-normal'>"+"</th>"+
                            "</tr>"
                        );

                    }
                    if (genero == 2) {
                        $("#genero").val('Mujer: '+val);
                        $("#sub-genero").show();
                      
                         $("#sub-genero").on('change', function(){
                            var subGenero = $("#sub-genero").val();
                         
                            if(subGenero == "Mujer"){
                              
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
                               $("#da").html("0/0");
                               $("#db").html("1/2");
                               $("#dc").html("3/4");
                               $("#dd").html("5/6");
                               $("#de").html("7/8");
                               $("#df").html("9/10");
                               $("#dg").html("11/12");
                               $("#dh").html("13/14");
                               $("#di").html("15/16");
                               $("#dj").html("17/18");
                               $("#dk").html("19/20");
                               $("#dl").html("21/22");
                               $("#i").attr('disabled', false);
                               $("#j").attr('disabled', false);
                               $("#k").attr('disabled', false);
                               $("#l").attr('disabled', false);
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
                           $("#disponibles").html(
                            "<tr id='cortes'>"+
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
                            "</tr>"
                        );
                           }else if (subGenero == "Mujer Plus"){
                            //    $("#genero").val('Mujer plus: '+val);
                               $("#sub-genero").show();
                               $("#ta").html("12W");
                               $("#tb").html("14W");
                               $("#tc").html("16W");
                               $("#td").html("18W");
                               $("#te").html("20W");
                               $("#tf").html("22W");
                               $("#tg").html("24W");
                               $("#th").html("26W");
                               $("#da").html("12W");
                               $("#db").html("14W");
                               $("#dc").html("16W");
                               $("#dd").html("18W");
                               $("#de").html("20W");
                               $("#df").html("22W");
                               $("#dg").html("24W");
                               $("#dh").html("26W");
                               $("#i").attr('disabled', true);
                               $("#j").attr('disabled', true);
                               $("#k").attr('disabled', true);
                               $("#l").attr('disabled', true);
                               $("#tallas").html(
                                   "<th>Dama Plus</th>"+
                                   "<th>12W</th>"+
                                   "<th>14W</th>"+
                                   "<th>16W</th>"+
                                   "<th>18W</th>"+
                                   "<th>20W</th>"+
                                   "<th>22W</th>"+
                                   "<th>24W</th>"+
                                   "<th>26W</th>"+
                                   $("#ti").html("I")+
                                   $("#tj").html("J")+
                                   $("#tk").html("K")+
                                   $("#tl").html("L")
                               );
                           }
                      
                        
                    });
                    }
            

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


        }else if(val == 0){
            mostrarDetalle(false);

        }

    });

    var cont;

   $("#btn-agregar").click(function(t){ 
        t.preventDefault();

        let a = $("#a").val();
        let b = $("#b").val();
        let c = $("#c").val();
        let d = $("#d").val();
        let e = $("#e").val();
        let f = $("#f").val();
        let g = $("#g").val();
        let h = $("#h").val();
        let i = $("#i").val();
        let j = $("#j").val();
        let k = $("#k").val();
        let l = $("#l").val();
        let referencia = $("#productoSearch option:selected").text();
        let producto = referencia.substring(0,9)
      

        var fila  = '<tr id="fila'+cont+'">'+
        "<th id='a_corte' class='font-weight-normal'>"+producto+"</th>"+
        "<th id='a_corte' class='font-weight-normal'></th>"+
        "<th id='a_corte' class='font-weight-normal'>"+a+"</th>"+
        "<th id='b_corte' class='font-weight-normal'>"+b+"</th>"+
        "<th id='c_corte' class='font-weight-normal'>"+c+"</th>"+
        "<th id='d_corte' class='font-weight-normal'>"+d+"</th>"+
        "<th id='e_corte' class='font-weight-normal'>"+e+"</th>"+
        "<th id='f_corte' class='font-weight-normal'>"+f+"</th>"+
        "<th id='g_corte' class='font-weight-normal'>"+g+"</th>"+
        "<th id='h_corte' class='font-weight-normal'>"+h+"</th>"+
        "<th id='i_corte' class='font-weight-normal'>"+i+"</th>"+
        "<th id='j_corte' class='font-weight-normal'>"+j+"</th>"+
        "<th id='k_corte' class='font-weight-normal'>"+k+"</th>"+
        "<th id='l_corte' class='font-weight-normal'>"+l+"</th>"+
        "</tr>"
        cont++;
        $("#orden_pedido").append(fila);
        
   });


   
  

  
  

 




    init();
});
