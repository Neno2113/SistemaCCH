$(document).ready(function() {
    $("[data-mask]").inputmask();

    // $("#formulario").validate({
    //     rules: {
    //         codigo_rollo: {
    //             required: true

    //         },
    //         num_tono: {
    //             required: true,
    //             minlength: 1
    //         },
    //         longitud_yarda: {
    //             required: true


    //         }
    //     },
    //     messages: {
    //         codigo_rollo: {
    //             required: "Este campo es obligatorio"

    //         },
    //         num_tono: {
    //             required: "Este campo es obligatorio",
    //             minlength: "Debe contener al menos 1 caracter"
    //         },
    //         longitud_yarda: {
    //             required: "Este campo es obligatorio",

    //         }
    //     }
    // });

    var tabla;

    function init() {
        listar();
        suplidores();
        mostrarForm(true);
        $("#btn-edit").hide();

        // var table = $("#table-data")[0];

        // $(table).on('click', '.tr_clone_add', function(){
        //     var thisRow = $(this).closest('tr')[0];
        //     $(thisRow).clone(true, true).insertAfter(thisRow).find('input:text').val("");
        //     // limpiar();
        // })
        $("#suplidores").on('change', function(){
            $("#cloths").val(null).trigger('change');
        });

        $("#num_tono").keyup(function(){
            let val =  $("#num_tono").val();
            $("#num_tono").val(val.toUpperCase());
        });


        // $("#suplidores").select2({
        //     placeholder: "Busca un suplidor...",
        //     ajax: {
        //         url: 'suplidores',
        //         dataType: 'json',
        //         delay: 250,
        //         processResults: function(data){
        //             return {
        //                 results: $.map(data, function(item){
        //                     return {
        //                         text: item.nombre+' - '+ item.contacto_suplidor,
        //                         id: item.id
        //                     }
        //                 })
        //             };
        //         },
        //         cache: true
        //     }
        // })

    }

    const suplidores = () => {

        $.ajax({
            url: "suppliers",
            type: "GET",
            dataType: "json",
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    // console.log(datos);
                    var longitud = datos.suplidores.length;

                    for (let i = 0; i < longitud; i++) {
                        var fila =  "<option value="+datos.suplidores[i].id +">"+datos.suplidores[i].nombre+"</option>"

                        $("#suplidores").append(fila);
                    }
                    // $("#clientes").attr('disabled', true);
                    $("#suplidores").select2();

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
            suplidor: $("#suplidores").val(),
            tela: $("#cloths").val(),
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
                    Swal.fire(
                    'Success',
                    'Rollo creado correctamente.',
                    'success'
                    )
                    limpiar();
                    tabla.ajax.reload();
                    // mostrarForm(false);
                } else if(datos.status == 'info') {
                    Swal.fire(
                        'Info!',
                        'Este rollo ya existe!.',
                        'info'
                        )
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
        tabla = $("#rollos").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/rollos",
            dom: 'Bfrtip',
            iDisplayLength: 5,
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
                { data: "Opciones", orderable: false, searchable: false },
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
                dataSrc: 'nombre'
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var rollo = {
            id: $("#id").val(),
            suplidor: $("#suplidores").val(),
            tela: $("#cloths").val(),
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
                    Swal.fire(
                    'Success',
                    'Rollo actualizado correctamente.',
                    'success'
                    )
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
        e.preventDefault();
        mostrarForm(false);
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        mostrarForm(true);
    });

    init();
});

function mostrar(id_rollo) {
    $.post("rollo/" + id_rollo, function(data, status) {

        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();

            // console.log(data);
            // $("#suplidores").select2('val', data.rollo.suplidores.nombre);
            $("#id").val(data.rollo.id);
            $("#suplidores").val(data.rollo.id_suplidor).select2().trigger('change');
            $("#codigo_rollo").val(data.rollo.codigo_rollo);
            $("#num_tono").val(data.rollo.num_tono);
            $("#no_factura_compra").val(data.rollo.no_factura_compra);
            $("#fecha_compra").val(data.rollo.fecha_compra);
            $("#longitud_yarda").val(data.rollo.longitud_yarda);
        }
     
    });
}


function eliminar(id_rollo){
    $.post("rollocheck/delete/" + id_rollo, function(data, status) {
        console.log(data);
        if(data.status == 'denied'){
            return Swal.fire(
                'Acceso denegado!',
                'No tiene permiso para realizar esta accion.',
                'info'
            )
        } else {
            Swal.fire({
                title: '¿Esta seguro de eliminar este rollo?',
                text: "Va a eliminar este rollo!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, acepto'
              }).then((result) => {
                if (result.value) {
                    $.post("rollo/delete/" + id_rollo, function(){
                        Swal.fire(
                        'Eliminado!',
                        'Rollo eliminado correctamente.',
                        'success'
                        )
                        $("#rollos").DataTable().ajax.reload();
                    })
                }
              })
        }
    })

}

$("#suplidores").on('change', () => {
    telas();
});




// $("#cloths").change(function(){
//     telas();
// });

function telas(){
    $("#cloths").empty();
    var rollo = {
        suplidor: $("#suplidores").val(),
    };

    $.ajax({
        url: "tela/select",
        type: "POST",
        dataType: "json",
        data: JSON.stringify(rollo),
        contentType: "application/json",
        success: function(datos) {
            if (datos.status == "success") {
                var longitud = datos.tela.length;

                for (let i = 0; i < longitud; i++) {
                    var fila ="<option value=" +datos.tela[i].id +">"+datos.tela[i].referencia+"</option>";
                    $("#cloths").append(fila);
                }
                $("#cloths").select2();

            } else {
                bootbox.alert(
                    "Ocurrio un error durante la actualizacion de la composicion"
                );
            }
        },
        error: function() {
            bootbox.alert(
                "Ocurrio un error"
            );
        }
    });

}
