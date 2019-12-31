$(document).ready(function() {
    $("[data-mask]").inputmask();

    var tabla;

    //Funcion que se ejecuta al inicio
    function init() {
        $("#btn-edit").hide();
        ordenes();
        disp_venta();
        cortes();
        venta12meses();
        latest_orders();
        latest_products();
    }

    //funcion para limpiar el formulario(los inputs)
    function limpiar() {
        $("#numero_corte").val("");
        // $("#sec").val("");
        $("#productos")
            .val("")
            .trigger("change");
        $("#fecha_entrega").val("");
        $("#no_marcada").val("");
        $("#corte").val("");
        $("#ancho_marcada").val("");
        $("#largo_marcada").val("");
        $("#aprovechamiento").val("");
    }

    function ordenes() {
        $.ajax({
            url: "orden_all",
            type: "get",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    // console.log(datos);
                    $("#cant_orden").html(datos.orden);
                } else {
                    bootbox.alert("Ocurrio un error !!");
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });
    }

    function disp_venta() {
        $.ajax({
            url: "dispVentas",
            type: "get",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#disp_venta").html(datos.existencia);
                } else {
                    bootbox.alert("Ocurrio un error !!");
                }
            },
            error: function() {
                console.log("error");
            }
        });
    }

    function cortes() {
        $.ajax({
            url: "cortes_home",
            type: "get",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#cortes_home").html(datos.corte);
                } else {
                    bootbox.alert("Ocurrio un error !!");
                }
            },
            error: function() {
                bootbox.alert("Ocurrio un error!!");
            }
        });
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

    window.onresize = function() {
        tabla.columns.adjust().responsive.recalc();
    };

    // // Make the dashboard widgets sortable Using jquery UI
    $(".connectedSortable").sortable({
        placeholder: "sort-highlight",
        connectWith: ".connectedSortable",
        handle: ".card-header, .nav-tabs",
        forcePlaceholderSize: true,
        zIndex: 999999
    });
    $(
        ".connectedSortable .card-header, .connectedSortable .nav-tabs-custom"
    ).css("cursor", "move");

    // // jQuery UI sortable for the todo list
    $(".todo-list").sortable({
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 999999
    });

    //  /* jQueryKnob */
    $(".knob").knob();

    /* Chart.js Charts */
    // Sales chart
 

    function venta12meses() {
        $.ajax({
            url: "venta12meses",
            type: "get",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    // console.log(datos.ventas);
                    for (let i = 0; i < datos.ventas.length; i++) {
                        console.log(datos.ventas[i]);
                    }
                    var salesChartCanvas = document
                    .getElementById("revenue-chart-canvas")
                    .getContext("2d");
                $('#revenue-chart').get(0).getContext('2d');

                var salesChartData = {
                    type: 'bar',
                    labels: ["December", "January"],
                    datasets: [
                        {
                            label: "Digital Goods",
                            backgroundColor: "rgba(60,141,188,0.9)",
                            borderColor: "rgba(60,141,188,0.8)",
                            pointRadius: false,
                            pointColor: "#3b8bba",
                            pointStrokeColor: "rgba(60,141,188,1)",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(60,141,188,1)",
                            data: [500, 100]
                        }
                    ]
                };
            
                var salesChartOptions = {
                    maintainAspectRatio: false,
                    responsive: true,
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [
                            {
                                gridLines: {
                                    display: false
                                }
                            }
                        ],
                        yAxes: [
                            {
                                gridLines: {
                                    display: false
                                }
                            }
                        ]
                    }
                };
            
                // This will get the first returned node in the jQuery collection.
                var salesChart = new Chart(salesChartCanvas, {
                    type: "line",
                    data: salesChartData,
                    options: salesChartOptions
                });
            
                } else {
                    bootbox.alert("Ocurrio un error !!");
                }
            },
            error: function() {
                console.log("error");
            }
        });
    }


    function latest_orders(){

        $.ajax({
            url: "latest_orders",
            type: "get",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    console.log(datos);
                } else {
                    bootbox.alert("Ocurrio un error !!");
                }
            },
            error: function() {
                console.log("error");
            }
        });
    }

    function latest_products(){

        $.ajax({
            url: "latest_products",
            type: "get",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    let productos = datos.productos;
                    for (let i = 0; i < datos.productos.length; i++) {
                        var producto = "<li class='item'>" +
                        "<div class='product-info'>"+
                          "<a href='javascript:void(0)' class='product-title'>"+productos[i].referencia_producto+
                            "<span class='badge badge-warning float-right'>$"+productos[i].precio_venta_publico +"</span></a>"+
                          "<span class='product-description'>"
                            +productos[i].descripcion +
                          "</span>"+
                        "</div>"+
                      "</li>"  
                        
                    }

                  $("#productos").append(producto);
                } else {
                    bootbox.alert("Ocurrio un error !!");
                }
            },
            error: function() {
                console.log("error");
            }
        });
    }

 
    init();
});
