$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#formulario").validate({
        rules: {
            codigo_composicion: {
                required: true,
                minlength: 1
            },
            nombre_composicion: {
                required: true,
                minlength: 1
            },
          
        },
        messages: {
            codigo_composicion: {
                required: "Introduzca el codigo de composicion",
                minlength: "Debe contener al menos 1 letra"
            },
            nombre_composicion: {
                required: "Introduzca el nombre de composicion",
                minlength: "Debe contener al menos 1 letra"
            }
        }
    })
   

    var tabla

    function init() {
        // listar();
        listarRollos();
        mostrarForm(false);
        $("#btn-edit").hide();
    }

    function limpiar() {
        $("#numero_corte").val("");
        $("#sec").val("");
        $("#productos").val("").trigger("change");
        $("#fecha_corte").val("");
        $("#no_marcada").val("");
        $("#corte").val("");
        $("#ancho_marcada").val("");
        $("#largo_marcada").val("");
        $("#aprovechamiento").val("");
    }

    $("#btn-generar").on('click', function(e){
        e.preventDefault();

        $.ajax({
            url: "corte/lastdigit",
            type: "GET",
            dataType: "json",
            success: function(datos) {
                if (datos.status == "success") {
                    var i = Number(datos.sec);
                    $("#sec").val(i);
                    i = (i + 0.01).toFixed(2).split('.').join("");
                    var year = new Date().getFullYear().toString();
                    var referencia = year+'-'+i;
                               
                    $("#numero_corte").val(referencia);
                    $("#corte").val(referencia);
                    $("#corte_tallas").val(referencia);
                    $('#btn-generar').attr("disabled", true);
                    $("#fila1").show();
                    $("#fila2").show();
                    $("#fila3").show();
                    bootbox.alert(
                        "Numero de corte generado exitosamente!!"
                    );

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
    });

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



    $("#btn-guardar").click(function(e){
        e.preventDefault();

        var date = new Date();
        var dd = String(date.getDate()).padStart(2, '0');
        var mm = String(date.getMonth()+ 1).padStart(2, '0');
        var yyyy = date.getFullYear();
        
        var corte = {
            sec: $("#sec").val(),
            numero_corte: $("#numero_corte").val(),
            producto_id: $("#productos").val(),
            fecha_corte: dd+ '/' +mm+ '/' + yyyy, 
            no_marcada: $("#no_marcada").val(),
            ancho_marcada: $("#ancho_marcada").val(),
            largo_marcada: $("#largo_marcada").val(),
            aprovechamiento: $("#aprovechamiento").val()
        };

        // console.log(JSON.stringify(corte));

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
                    tabla.ajax.reload();
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
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
    });

    function listar() {
        tabla = $("#compositions").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/compositions",
            columns: [
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "id" },
                { data: "nombre_composicion" },
              
            ]
        });
    }

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

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var composition = {
            id: $("#id").val(),
            codigo_composicion: $("#codigo_composicion").val(),
            nombre_composicion: $("#nombre_composicion").val()
        };
     
        $.ajax({
            url: "composition/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(composition),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el usuario");
                    limpiar();
                    tabla.ajax.reload();
                    $("#id").val("");
                    $("#nombre_composicion").val("");
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
            $("#fila1").hide();
            $("#fila2").hide();
            $("#fila3").hide();
            $("#btn-guardar").attr("disabled", true);
        }
    }

    $("#btnAgregar").click(function(e) {
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        mostrarForm(false);
    });
  

    init();
});
