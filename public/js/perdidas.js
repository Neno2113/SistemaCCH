$(document).ready(function() {

    
    $("#formulario").validate({
  rules: {
      cortesSearch: {
          required: true,
          minlength: 1
      },
      lavanderias: {
          required: true,
          minlength: 1
          
      },
      fecha_recepcion: {
          required: true,
          minlength: 1
      },
      cantidad_recibida: {
          required: true,
          minlength: 2
      }
    
  },
  messages: {
      codigo_composicion: {
          required: "El numero de corte es obligatorio"
      },
      nombre_composicion: {
          required: "La lavanderia es obligatoria"
      },
      fecha_recepcion: {
          required: "La fecha de recepcion es obligatoria"
      },
      cantidad_recibida: {
          required: "La cantidad recibida es un campo obligatorio",
          minlength: "La cantidad recibida es un campo numerico obligatorio"
      }
  }
})





var tabla

function init() {
listar();
mostrarForm(false);
$("#btn-edit").hide();
}

$("#fase").change(function(){
    var val = $(this).val();
    if(val == "Produccion"){
        $("#motivo").html(
            "<option value='Error del operador'>1. Error del operador</option>"+
            "<option value='Fallo de la maquina'>2. Fallo de la maquina</option>"+
            "<option value='Defecto de tela'>3. Defecto de tela</option>"+
            "<option value='Fallo en Dpto.corte'>4. Fallo en Dpto.corte</option>"+
            "<option value='Extraviado'>5. Extraviado</option>"
            )
    }else if(val == "Procesos secos"){
        $("#motivo").html(
            "<option value='Error del operador'>1. Error del operador</option>"+
            "<option value='Extraviado'>2. Extraviado</option>"
            )
    }else if(val == "Lavanderia"){
        $("#motivo").html(
            "<option value='Rotos'>1. Rotos</option>"+
            "<option value='Manchados'>2. Manchados</option>"+
            "<option value='Extraviado'>3. Extraviado</option>"
            )
    }else if(val == "Terminacion"){
        $("#motivo").html(
            "<option value='Error del operador'>1. Error del operador</option>"+
            "<option value='Fallo de la maquina'>2. Fallo de la maquina</option>"+
            "<option value='Defecto de tela'>3. Defecto de tela</option>"+
            "<option value='Fallo en Dpto. corte'>4. Fallo en Dpto. corte</option>"+
            "<option value='Extraviado'>5. Extraviado </option>"
            )
    }else if(val == "Almacen"){
        $("#motivo").html(
            "<option value='Extraviado'>1. Extraviado</option>"+
            "<option value='Termita'>2. Termita</option>"+
            "<option value='Reaccion luz'>3. Reaccion a la luz</option>"
            )
    }
});







$("#cantidad_recibida").on('keyup', function(){
$("#btn-guardar").attr("disabled", false);
})


function limpiar() {
$("#fecha_recepcion").val("");
$("#cantidad_recibida").val("");
$("#cortesSearch").val("").trigger("change");
$("#lavanderias").val("").trigger("change");
}

$("#cortesSearch").select2({
placeholder: "Buscar un numero de corte Ej: 2019-xxx",
ajax: {
  url: 'cortes_perd',
  dataType: 'json',
  delay: 250,
  processResults: function(data){
      return {
          results: $.map(data, function(item){
              return {
                  text: item.numero_corte+' - '+item.fase,
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

var recepcion = {
  corte_id: $("#cortesSearch").val(),
  id_lavanderia: $("#lavanderias").val(),
  fecha_recepcion: $("#fecha_recepcion").val(),
  cantidad_recibida: $("#cantidad_recibida").val(),
  estandar_recibido: $("input[name='r1']:checked").val(),
};

$.ajax({
  url: "recepcion",
  type: "POST",
  dataType: "json",
  data: JSON.stringify(recepcion),
  contentType: "application/json",
  success: function(datos) {
      if (datos.status == "success") {
          bootbox.alert("Hi!! here goes almost everything important from the form of Lavanderia");
          limpiar();
          tabla.ajax.reload();
          mostrarForm(false);
      } else {
          bootbox.alert(
              "Ocurrio un error durante la creacion de la composicion"
          );
      }
  },
  error: function(datos) {
      console.log(datos.responseJSON.message);
     
      bootbox.alert(
          "Error: "+ datos.responseJSON.message
      );
  }
});
});

function listar() {
tabla = $("#recepciones").DataTable({
  serverSide: true,
  responsive: true,
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
  ajax: "api/recepciones",
  columns: [
      { data: "Expandir", orderable: false, searchable: false },
      { data: "Opciones", orderable: false, searchable: false },
      { data: "id", name: "recepcion.id" },
      { data: "fecha_recepcion", name: "recepcion.fecha_recepcion" },
      { data: "cantidad_recibida", name: "recepcion.cantidad_recibida" },
      { data: "numero_corte", name: "corte.numero_corte" },
      { data: "numero_envio", name: "lavanderia.numero_envio" },
      { data: "fecha_envio", name: "lavanderia.fecha_envio" },
      { data: "cantidad", name: "lavanderia.cantidad" },
      { data: "estandar_recibido", name: "recepcion.estandar_recibido" },
    
  ]
});
}

$("#btn-edit").click(function(e) {
e.preventDefault();

var recepcion = {
  id: $("#id").val(),
  corte_id: $("#cortesSearchEdit").val(),
  id_lavanderia: $("#lavanderiasEdit").val(),
  fecha_recepcion: $("#fecha_recepcion").val(),
  cantidad_recibida: $("#cantidad_recibida").val(),
  estandar_recibido: $("input[name='r1']:checked").val(),
};

// console.log(JSON.stringify(recepcion));

$.ajax({
  url: "recepcion/edit",
  type: "PUT",
  dataType: "json",
  data: JSON.stringify(recepcion),
  contentType: "application/json",
  success: function(datos) {
      if (datos.status == "success") {
          bootbox.alert("Se actualizo correctamente la recepcion");
          limpiar();
          tabla.ajax.reload();
          mostrarForm(false);
      
      } else {
          bootbox.alert(
              "Ocurrio un error durante la actualizacion de la composicion"
          );
      }
  },
  error: function(datos) {
      bootbox.alert(
          "Error: "+ datos.responseJSON.message
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
  $("#estandar_recibido").hide();
  $("#lavanderia").hide();
  $("#corte").hide();
  $("#corteAdd").show();
  $("#corteEdit").hide();
  $("#lavanderiaAdd").show();
  $("#lavanderiaEdit").hide();
} else {
  $("#listadoUsers").show();
  $("#registroForm").hide();
  $("#btnCancelar").hide();
  $("#btnAgregar").show();
  $("#estandar_recibido").hide();
  $("#lavanderia").hide();
  $("#corte").hide();
  $("#corteEdit").hide();
  $("#lavanderiaEdit").hide();
//   $("#btn-guardar").attr("disabled", true);
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
