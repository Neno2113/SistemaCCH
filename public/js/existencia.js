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
                            "<tr id='totales'>"+
                            "<th>CP(Corte)</th>"+
                            "<th>1</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th class='font-weight-normal'>"+datos.a+"</th>"+
                            "<th class='font-weight-normal'>"+datos.b+"</th>"+
                            "<th class='font-weight-normal'>"+datos.c+"</th>"+
                            "<th class='font-weight-normal'>"+datos.d+"</th>"+
                            "<th class='font-weight-normal'>"+datos.e+"</th>"+
                            "<th class='font-weight-normal'>"+datos.f+"</th>"+
                            "<th class='font-weight-normal'>"+datos.g+"</th>"+
                            "<th class='font-weight-normal'>"+datos.h+"</th>"+
                            "<th class='font-weight-normal'>"+datos.i+"</th>"+
                            "<th class='font-weight-normal'>"+datos.j+"</th>"+
                            "<th class='font-weight-normal'>"+datos.k+"</th>"+
                            "<th class='font-weight-normal'>"+datos.l+"</th>"+
                            "</tr>"+
                            "<tr id='perdidas'>"+
                            "<th>PE(Perdida)</th>"+
                            "<th>2</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th class='text-red'>"+datos.a_perd+"</th>"+
                            "<th class='text-red'>"+datos.b_perd+"</th>"+
                            "<th class='text-red'>"+datos.c_perd+"</th>"+
                            "<th class='text-red'>"+datos.d_perd+"</th>"+
                            "<th class='text-red'>"+datos.e_perd+"</th>"+
                            "<th class='text-red'>"+datos.f_perd+"</th>"+
                            "<th class='text-red'>"+datos.g_perd+"</th>"+
                            "<th class='text-red'>"+datos.h_perd+"</th>"+
                            "<th class='text-red'>"+datos.i_perd+"</th>"+
                            "<th class='text-red'>"+datos.j_perd+"</th>"+
                            "<th class='text-red'>"+datos.k_perd+"</th>"+
                            "<th class='text-red'>"+datos.l_perd+"</th>"+
                            "<th class='text-red'>"+datos.x_perd+"</th>"+
                            "</tr>"+
                            "<tr id='segundas'>"+
                            "<th>Se(Segunda)</th>"+
                            "<th>3</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th class='text-red'>"+datos.a_seg+"</th>"+
                            "<th class='text-red'>"+datos.b_seg+"</th>"+
                            "<th class='text-red'>"+datos.c_seg+"</th>"+
                            "<th class='text-red'>"+datos.d_seg+"</th>"+
                            "<th class='text-red'>"+datos.e_seg+"</th>"+
                            "<th class='text-red'>"+datos.f_seg+"</th>"+
                            "<th class='text-red'>"+datos.g_seg+"</th>"+
                            "<th class='text-red'>"+datos.h_seg+"</th>"+
                            "<th class='text-red'>"+datos.i_seg+"</th>"+
                            "<th class='text-red'>"+datos.j_seg+"</th>"+
                            "<th class='text-red'>"+datos.k_seg+"</th>"+
                            "<th class='text-red'>"+datos.l_seg+"</th>"+
                            "<th class='text-red'>"+datos.x_seg+"</th>"+
                            "</tr>"
                        )
                    }else if(tipo_consulta == 'Detallada'){
                        var longitud = datos.tallas.length;
                        var longitudPerdidas = datos.tallasPerdidas.length;
                        var longitudSegundas = datos.tallaSegundas.length;
                        $("#totales").hide();
                        $("#perdidas").hide();
                        $("#segundas").hide();

                        for (let i = 0; i < longitud; i++) {
                            var fila =  "<tr>"+
                            "<th>"+datos.tallas[i].corte.numero_corte +"</th>"+
                            "<th>"+ (i+1) +"</th>"+
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
                        for (let i = 0; i < longitudPerdidas; i++) {
                       
                            var fila =  "<tr >"+
                            "<th>"+datos.tallasPerdidas[i].perdida.no_perdida +"</th>"+
                            "<th>"+ (i+1) +"</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].a+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].b +"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].c+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].d+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].e+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].f+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].g+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].h+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].i+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].j+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].k+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].l+"</th>"+
                            "<th class='text-red'>"+datos.tallasPerdidas[i].talla_x+"</th>"+
                            "</tr>";

                            fila = fila.replaceAll('null', '');
                         
                            $("#transacciones").append(fila);
                           
                        }

                        for (let i = 0; i < longitudSegundas; i++) {
                       
                            var fila =  "<tr >"+
                            "<th>"+datos.tallaSegundas[i].perdida.no_perdida +"</th>"+
                            "<th>"+ (i+1) +"</th>"+
                            "<th class='font-weight-normal'>"+ref+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].a+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].b +"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].c+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].d+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].e+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].f+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].g+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].h+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].i+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].j+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].k+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].l+"</th>"+
                            "<th class='text-primary'>"+datos.tallaSegundas[i].talla_x+"</th>"+
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

    $("#tipo_consulta").change(function(){
        $("#btn-consultar").attr('disabled', false);
    });

  

 




    init();
});
