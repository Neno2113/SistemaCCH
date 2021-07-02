let id_rollo = 0;

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
            fecha_compra: $("#fecha_compra").val(),
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
                    // limpiar();
                    // tabla.ajax.reload();
                    // mostrarForm(false);
                    id_rollo = datos.rollo.id;
                    $("#row-detail").show();
                    $("#btn-guardar").attr("disabled", true);
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


    $("#btn-agregar").on('click', (e) => {
        e.preventDefault();
        let data = {
            id_rollo: id_rollo,
            id_tela: $("#cloths").val(),
            numero: $("#codigo_rollo").val(),
            tono: $("#num_tono").val(),
            longitud: $("#longitud_yarda").val()
        }

        // console.log(JSON.stringify(data));

        $.ajax({
            url: "detalle",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(data),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })

                    Toast.fire({
                        type: 'success',
                        title: 'Rollo agregado correctamente.'
                    })
                    limpiar();
                    var fila =
                    '<tr id="fila'+datos.rollo.id+'">'+
                    "<td class=''><input type='hidden' id='usuario"+datos.rollo.id+"' value="+datos.rollo.numero+">"+datos.rollo.numero+"</td>"+
                    "<td class='font-weight-bold'><input type='hidden' id='permiso"+datos.rollo.tono+"' value="+datos.rollo.tono+">"+datos.rollo.tono+"</td>"+
                    "<td class='font-weight-bold'><input type='hidden' id='permiso"+datos.rollo.longitud+"' value="+datos.rollo.longitud+">"+datos.rollo.longitud+"</td>"+
                    "<td><button type='button' id='btn-eliminar' onclick='delRollo("+datos.rollo.id+")' class='btn btn-danger'><i class='far fa-trash-alt'></i></button></td>"+
                    "</tr>";
                    $("#permisos-agregados").append(fila);
                } else if(datos.status == 'info') {
                    Swal.fire(
                        'Info!',
                        'Este rollo ya existe!.',
                        'info'
                        )
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*)"
                );
            }
        });

    })
    

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
                { data: "tela", name: "rollos.tela", orderable: false, searchable: false },
                { data: "fecha_compra", name: "rollos.fecha_compra" },
                { data: "no_factura_compra", name: "rollos.no_factura_compra" },
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
            fecha_compra: $("#fecha_compra").val(),
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
                    // limpiar();
                    // tabla.ajax.reload();
                    // mostrarForm(false);
                    id_rollo = datos.rollo.id;
                  
                    // $("#btn-guardar").attr("disabled", true);

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
            $("#rollosForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
        } else {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#rollosForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").hide();
            $("#btn-finish").show();
        }
    }


    $("#btn-finish").on('click', (e) => {
        e.preventDefault();
        Swal.fire(
            'Success',
            'Rollos agregados correctamente.',
            'success'
            );

        limpiar();
        tabla.ajax.reload();
        mostrarForm(true);
    })

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        mostrarForm(false);
        $("#suplidores").val('').select2().trigger('change').attr("disabled", false);
        $("#cloths").val('').select2().trigger('change').attr("disabled", false);
        $("#no_factura_compra").val('');
        $("#fecha_compra").val('');
        $("#permisos-agregados").empty();
        $("#btn-guardar").attr("disabled", false);
        $("#row-detail").hide();

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
            $("#rollosForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#btn-finish").show();
            // $("#btn-save").hide();

            // console.log(data);
            // $("#suplidores").select2('val', data.rollo.suplidores.nombre);
            $("#id").val(data.rollo.id);
            $("#suplidores").val(data.rollo.id_suplidor).select2().trigger('change').attr("disabled", true);
            $("#codigo_rollo").val(data.rollo.codigo_rollo);
            $("#num_tono").val(data.rollo.num_tono);
            $("#no_factura_compra").val(data.rollo.no_factura_compra);
            $("#fecha_compra").val(data.rollo.fecha_compra);
            $("#longitud_yarda").val(data.rollo.longitud_yarda);
            $("#permisos-agregados").empty();
            $("#cloths").val(data.rollo.id_tela).select2().trigger('change');
            // telas();

            for (let i = 0; i < data.rollos.length; i++) {
                var fila =
                '<tr id="fila'+data.rollos[i].id+'">'+
                "<td class=''><input type='hidden' id='usuario"+data.rollos[i].id+"' value="+data.rollos[i].id+">"+data.rollos[i].numero+"</td>"+
                "<td class='font-weight-bold'><input type='hidden' id='permiso"+data.rollos[i].tono+"' value="+data.rollos[i].tono+">"+data.rollos[i].tono+"</td>"+
                "<td class='font-weight-bold'><input type='hidden' id='permiso"+data.rollos[i].longitud+"' value="+data.rollos[i].longitud+">"+data.rollos[i].longitud+"</td>"+
                "<td><button type='button' id='btn-eliminar' onclick='delRollo("+data.rollos[i].id+")' class='btn btn-danger'><i class='far fa-trash-alt'></i></button></td>"+
                "</tr>";
                $("#permisos-agregados").append(fila);
            }
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


const delRollo = (id) => {
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
            $.post("detail/delete/" + id, function(){
                Swal.fire(
                'Eliminado!',
                'Rollo eliminado correctamente.',
                'success'
                )
                $("#fila"+id).remove();
            })
        }
      })
}