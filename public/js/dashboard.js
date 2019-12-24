$(document).ready(function() {
    $("[data-mask]").inputmask();

   

    var tabla

    //Funcion que se ejecuta al inicio 
    function init() {
        listar();
        listarRollos();
        mostrarForm(false);
        $("#btn-edit").hide();
        ordenes();
        skus();
        cortes();
        
    }

    //funcion para limpiar el formulario(los inputs)
    function limpiar() {
        $("#numero_corte").val("");
        // $("#sec").val("");
        $("#productos").val("").trigger("change");
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
                    console.log(datos);
                    $("#cant_orden").html(datos.orden);
                } else {
                    bootbox.alert(
                        "Ocurrio un error !!"
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

    function skus() {
 
        $.ajax({
            url: "sku_disp",
            type: "get",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#sku_disp").html(datos.sku);
                } else {
                    bootbox.alert(
                        "Ocurrio un error !!"
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

    
    function cortes() {
 
        $.ajax({
            url: "cortes_home",
            type: "get",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    $("#cortes_home").html(datos.corte);
                } else {
                    bootbox.alert(
                        "Ocurrio un error !!"
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
                { data: "id", name: "rollos.id" },
                { data: "referencia", name: "tela.referencia" },
                { data: "codigo_rollo", name: "rollos.codigo_rollo" },
                { data: "longitud_yarda", name: "rollos.longitud_yarda" },
                { data: "Editar", orderable: false, searchable: false },
            ],
            order: [[2, 'desc']],
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
                    $("#listadoUsers").show();
                    $("#registroForm").hide();
                    $("#btnCancelar").hide();
                    $("#btn-edit").hide();
                    $("#btn-guardar").show();
                    $("#btnAgregar").show();

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



    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            // $("#fila1").hide();
            // $("#fila2").hide();
            // $("#fila3").hide();
            // $("#btn-guardar").attr("disabled", true);
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

    window.onresize = function() {
        tabla.columns.adjust().responsive.recalc();
    } 


     // Make the dashboard widgets sortable Using jquery UI
  $('.connectedSortable').sortable({
    placeholder         : 'sort-highlight',
    connectWith         : '.connectedSortable',
    handle              : '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })
  $('.connectedSortable .card-header, .connectedSortable .nav-tabs-custom').css('cursor', 'move')

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })

  //  /* jQueryKnob */
  $('.knob').knob()

  /* Chart.js Charts */
  // Sales chart
  var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d');
  //$('#revenue-chart').get(0).getContext('2d');

  var salesChartData = {
    labels  : ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 
    'Noviembre', 'Diciembre'],
    datasets: [
      {
        label               : 'Digital Goods',
        backgroundColor     : 'rgba(60,141,188,0.9)',
        borderColor         : 'rgba(60,141,188,0.8)',
        pointRadius          : false,
        pointColor          : '#3b8bba',
        pointStrokeColor    : 'rgba(60,141,188,1)',
        pointHighlightFill  : '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data                : [28, 48, 40, 19, 86, 27, 90, 100 , 70, 60, 50, 90]
      },
      // {
      //   label               : 'Electronics',
      //   backgroundColor     : 'rgba(210, 214, 222, 1)',
      //   borderColor         : 'rgba(210, 214, 222, 1)',
      //   pointRadius         : false,
      //   pointColor          : 'rgba(210, 214, 222, 1)',
      //   pointStrokeColor    : '#c1c7d1',
      //   pointHighlightFill  : '#fff',
      //   pointHighlightStroke: 'rgba(220,220,220,1)',
      //   data                : [65, 59, 80, 81, 56, 55, 40, 37, 40, 50, 40, 60, 70]
      // },
    ]
  }

  var salesChartOptions = {
    maintainAspectRatio : false,
    responsive : true,
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        gridLines : {
          display : false,
        }
      }],
      yAxes: [{
        gridLines : {
          display : false,
        }
      }]
    }
  }

  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas, { 
      type: 'line', 
      data: salesChartData, 
      options: salesChartOptions
    }
  )

  

    init();
});
