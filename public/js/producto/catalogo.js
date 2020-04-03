var min_global;
var max_global;
var genero_global;
var genero_plus;
$(document).ready(function() {

    $("[data-mask]").inputmask();



    function init() {
        listar();
        mostrarForm(false);

    }

    function limpiar() {
        $("#codigo").val("");
        $("#descripcion").val("");
        $("#tipo_cuenta").val("");
    }




    $("#btn-guardar").click(function(e) {
        e.preventDefault();
        guardar();

    });


    function guardar(){

        var catalogo = {
            codigo: $("#codigo").val(),
            descripcion: $("#descripcion").val(),
            tipo_cuenta: $("#tipo_cuenta").val()

        };
        // console.log(JSON.stringify(catalogo));

        $.ajax({
            url: "catalogo",
            type: "POST",
            dataType: "json",
            data: JSON.stringify(catalogo),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Success',
                        'Catalogo de cuenta creada correctamente!',
                        'success'
                    )
                    limpiar();
                    tabla.ajax.reload();
                    mostrarForm(false);
                    $("#referencia_talla").val("");

                } else {
                    bootbox.alert("Se genero la referencia");
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
    }

    var tabla;

    function listar() {
        tabla = $("#products").DataTable({
            serverSide: true,
            autoWidth: false,
            responsive: true,
            iDisplayLength: 5,
            ajax: "api/catalogos",
            dom: "Bfrtip",
            buttons: [
                "pageLength",
                "copyHtml5",
                {
                    extend: "excelHtml5",
                    autoFilter: true,
                    sheetName: "Exported data"
                },
                "csvHtml5",
                {
                    extend: "pdfHtml5",
                    orientation: "landscape",
                    pageSize: "LEGAL"
                }
            ],
            columns: [
                { data: "Expandir", orderable: false, searchable: false },
                { data: "Editar", orderable: false, searchable: false },
                { data: "codigo", name: "catalogo_cuenta.codigo" },
                { data: "descripcion", name: "catalogo_cuenta.descripcion"},
                { data: "tipo_cuenta", name: "catalogo_cuenta.tipo_cuenta" },
            ],
            order: [[4, "desc"]],
            rowGroup: {
                dataSrc: "tipo_cuenta"
            }
        });
    }

    $("#btn-edit").click(function(e) {
        e.preventDefault();

        var catalogo = {
            id: $("#catalogo").val(),
            codigo: $("#codigo").val(),
            descripcion: $("#descripcion").val(),
            tipo_cuenta: $("#tipo_cuenta").val()
        };

        // console.log(product);

        $.ajax({
            url: "catalogo/edit",
            type: "PUT",
            dataType: "json",
            data: JSON.stringify(catalogo),
            contentType: "application/json",
            success: function(datos) {
                if (datos.status == "success") {
                    Swal.fire(
                        'Success',
                        'Cuenta  actualizada correctamente!',
                        'success'
                    )
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
                    $("#sec").val("");
                } else {
                    bootbox.alert("Ocurrio un error durante la actualizacion");
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
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-curva").attr("disabled", true);
        } else {
            $("#listadoUsers").show();
            $("#registroForm").hide();
            $("#btnCancelar").hide();
            $("#btnAgregar").show();
            $("#mostrarRef2").hide();
            $("#precios_2").hide();
            $("#descripcion_ref2").hide();
            $("#btn-sku").attr("disabled", true);
            $("#btn-edit").hide();
            $("#btn-guardar").show();
        }
    }

    $("#btnAgregar").click(function(e) {
        e.preventDefault();
        mostrarForm(true);
    });
    $("#btnCancelar").click(function(e) {
        e.preventDefault();
        mostrarForm(false);
    });



    window.onresize = function() {
        tabla.columns.adjust().responsive.recalc();
    };


    function calcularPorcentaje(){
        let a = isNaN(parseFloat($("#a").val())) ? 0: parseFloat($("#a").val());
        let b = isNaN(parseFloat($("#b").val())) ? 0: parseFloat($("#b").val());
        let c = isNaN(parseFloat($("#c").val())) ? 0: parseFloat($("#c").val());
        let d = isNaN(parseFloat($("#d").val())) ? 0: parseFloat($("#d").val());
        let e = isNaN(parseFloat($("#e").val())) ? 0: parseFloat($("#e").val());
        let f = isNaN(parseFloat($("#f").val())) ? 0: parseFloat($("#f").val());
        let g = isNaN(parseFloat($("#g").val())) ? 0: parseFloat($("#g").val());
        let h = isNaN(parseFloat($("#h").val())) ? 0: parseFloat($("#h").val());
        let i = isNaN(parseFloat($("#i").val())) ? 0: parseFloat($("#i").val());
        let j = isNaN(parseFloat($("#j").val())) ? 0: parseFloat($("#j").val());
        let k = isNaN(parseFloat($("#k").val())) ? 0: parseFloat($("#k").val());
        let l = isNaN(parseFloat($("#l").val())) ? 0: parseFloat($("#l").val());
        let total = a + b + c + d + e + f + g + h + i + j + k + l;
        $("#total_percent").val(total+"%");
        if(total == 100){
            $("#btn-guardar").attr("disabled", false);
            $("#btn-curva").removeClass("btn-secondary").addClass("btn-success");
        }else{
            $("#btn-guardar").attr("disabled", true);
        }
    }


    //calculo porcentajes de los inputs
    $("#a, #b, #c, #d, #e, #f, #g, #h, #i, #j, #k, #l").keyup(function(){
        calcularPorcentaje()

    })




    init();
});

function mostrar(id) {
    $.get("catalogo/" + id, function(data, status) {
        // data = JSON.parse(data);
        $("#listadoUsers").hide();
        $("#registroForm").show();
        $("#btnCancelar").show();
        $("#btnAgregar").hide();
        $("#btn-edit").show();
        $("#btn-guardar").hide();

        $("#catalogo").val(data.catalogo.id);
        $("#codigo").val(data.catalogo.codigo);
        $("#descripcion").val(data.catalogo.descripcion);
        $("#tipo_cuenta").val(data.catalogo.tipo_cuenta);

    });
}


function eliminar(id_prouct){
    Swal.fire({
        title: '¿Esta seguro de eliminar esta cuenta?',
        text: "Va a eliminar esta cuenta!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("catalogo/delete/" + id_prouct, function(){
                Swal.fire(
                    'Eliminado!',
                    'Cuenta  eliminada correctamente.',
                    'success'
                    )
                $("#products").DataTable().ajax.reload();
            })
        }
      })


}


