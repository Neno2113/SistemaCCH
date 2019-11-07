$(document).ready(function() {


    function init() {
        listar();
        mostrarForm(false);
        $("#btn-edit").hide();
    }



    function limpiar() {
        $("#numero_envio").val("");
        $("#fecha_envio").val("");
        $("#receta_lavado").val("");
        $("#cantidad").val("");
        $("#estandar_incluido").val("");
        $("#productos").val("").trigger("change");
        $("#cortesSearch").val("").trigger("change");
        $("#suplidores").val("").trigger("change");
        $("#suplidoresEdit").val("").trigger("change");
        $("#cortesSearchEdit").val("").trigger("change");
     
    }


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

 


  

   
    

    
  

    init();
});
