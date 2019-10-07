$(document).ready(function() {
    $("[data-mask]").inputmask();

    $("#branchForm").validate({
        rules: {
            nombre_sucursal: {
                required: true,
                minlength: 5
            },
            telefono_sucursal: {
                required: true,
                minlength: 4
            },
            direccion:{
                required: true,
                minlength: 4
            }
        },
        messages: {
            nombre_sucursal: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 5 letras"
            },
            telefono_sucursal: {
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 4 letras"
            },
            direccion:{
                required: "Este campo es obligatorio",
                minlength: "Debe contener al menos 4 letras"
            }
        }
    })
   

    var tabla;

    function init() {
        listar();
        // mostrarForm(false);
        $("#btn-edit").hide();
        // $("#results").hide();
   
    }

    function limpiar() {
        $("#nombre_sucursal").val("");
        $("#telefono_sucursal").val("");
        $("#direccion").val("");
        $("#clientes").val("").trigger("change");
       
    }

    $("#btn-guardar-branch").click(function(e) {
        e.preventDefault();
        
        var client_branch = {
            client_id : $("#clientes").val(),
            nombre_sucursal: $("#nombre_sucursal").val(),
            telefono_sucursal: $("#telefono_sucursal").val(),
            direccion: $("#direccion").val(),
           
        };

        $.ajax({
            url: "client-branch",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(client_branch),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    bootbox.alert("Se registro correctamente la sucursal !!");
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                } else {
                    bootbox.alert(
                        "Ocurrio un error durante la creacion de la sucursal verifique los datos suministrados!!"
                    );
                }
            },
            error: function() {
                bootbox.alert(
                    "Ocurrio un error, trate rellenando los campos obligatorios(*) correctamente"
                );
            }
        });

        



    });

    function listar() {
        tabla = $("#branches").DataTable({
            serverSide: true,
            responsive: true,
            ajax: "api/branches",
            columns: [
                { data: "Editar", orderable: false, searchable: false },
                { data: "Eliminar", orderable: false, searchable: false },
                { data: "codigo_sucursal" },
                { data: "nombre_sucursal" },
                { data: "telefono_sucursal" },
                { data: "direccion" }
            ],
            order: [[2, 'asc']],
            rowGroup: {
                dataSrc: 'nombre_sucursal'
            }
        });
    }

    setInterval(function(){
        tabla.ajax.reload();
    }, 30000)

   

    


    init();
});
