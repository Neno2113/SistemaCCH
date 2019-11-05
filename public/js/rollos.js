$(document).ready(function() {
    $("#formulario").validate({
        rules: {
            codigo_composicion: {
                required: true,
                minlength: 1
            },
            nombre_composicion: {
                required: true,
                minlength: 1
            }
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
    });

    var tabla;

    function init() {
        listar();
        mostrarForm(true);
        $("#btn-edit").hide();

        // var table = $("#table-data")[0];

        // $(table).on('click', '.tr_clone_add', function(){
        //     var thisRow = $(this).closest('tr')[0];
        //     $(thisRow).clone(true, true).insertAfter(thisRow).find('input:text').val("");
        //     // limpiar();
        // })

        $("#suplidores").select2({
            placeholder: "Busca un suplidor...",
            ajax: {
                url: 'suplidores',
                dataType: 'json',
                delay: 250,
                processResults: function(data){
                    return {
                        results: $.map(data, function(item){
                            return {
                                text: item.nombre+' - '+ item.contacto_suplidor,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })

        $("#cloths").select2({
            placeholder: "Busca una tela...",
            ajax: {
                url: 'cloths',
                dataType: 'json',
                delay: 250,
                processResults: function(data){
                    return {
                        results: $.map(data, function(item){
                            return {
                                text: item.referencia,
                                id: item.id
                            }
                        })
                    };
                },
                cache: true
            }
        })

    }

    function limpiar() {
        // $("#suplidores").val("").trigger("change");
        // $("#cloths").val("").trigger("change");
        $("#codigo_rollo").val("");
        $("#num_tono").val("");
        // $("#fecha_compra").val("");
        $("#longitud_yarda").val("");

    }

    $("#btn-guardar").click(function(e) {
        e.preventDefault();

        var rollo = {
            id_suplidor: $("#suplidores").val(),
            id_tela: $("#cloths").val(),
            codigo_rollo: $("#codigo_rollo").val(),
            num_tono: $("#num_tono").val(),
            fecha_compra: $("#fecha_compra").val(),
            longitud_yarda: $("#longitud_yarda").val(),
            no_factura_compra: $("#no_factura_compra").val()
        };

        $.ajax({
            url: "rollos",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(rollo),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se registro el rollo correctamente!!");
                    limpiar();
                    tabla.ajax.reload();
                    // mostrarForm(false);
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
        tabla = $("#rollos").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/rollos",
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
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "id", name: "rollos.id" },
                { data: "nombre", name: "suplidor.nombre" },
                { data: "referencia", name: "tela.ferencia", searchable: false },
                { data: "codigo_rollo", name: "rollos.codigo_rollo" },
                { data: "num_tono", name: "rollos.num_tono" },
                { data: "fecha_compra", name: "rollos.fecha_compra" },
                { data: "no_factura_compra", name: "rollos.no_factura_compra" },
                { data: "corte_utilizado", name: "rollos.corte_utilizado" },
                { data: "longitud_yarda", name: "rollos.longitud_yarda" },
            ],
            order: [[2, 'asc']],
            rowGroup: {
                dataSrc: 'referencia'
            }
        });
    }
  
    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var rollo = {
            id: $("#id").val(),
            id_suplidor: $("#suplidores").val(),
            id_tela: $("#cloths").val(),
            codigo_rollo: $("#codigo_rollo").val(),
            num_tono: $("#num_tono").val(),
            fecha_compra: $("#fecha_compra").val(),
            longitud_yarda: $("#longitud_yarda").val(),
            no_factura_compra: $("#no_factura_compra").val()
        };

        // console.log(JSON.stringify(rollo));
        $.ajax({
            url: "rollo/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(rollo),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se actualizado correctamente el rollo !!");
                    tabla.ajax.reload();
                    limpiar();
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
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });
       
    });

    function mostrarForm(flag) {
        limpiar();
        if (flag) {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
        } else {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").hide();
            $("#btn-guardar").show();
        }
    }

    $("#btnAgregar").click(function(e) {
        mostrarForm(false);
    });
    $("#btnCancelar").click(function(e) {
        mostrarForm(true);
    });

    init();
});
