@extends('adminlte.layout')

@section('seccion', 'Existencias')

@section('title', 'Existencia')

@section('content')

<div class="row pt-3 pl-3">
    <div class="col-md-6">
        <label for="">Referencia Producto</label>
        <select name="tags[]" id="productoSearch" class="form-control select2" style="width:100%">
        </select>
    </div>
    <div class="col-md-3 mt-4 pt-2">
        <select name="tipo_consulta" id="tipo_consulta" class="form-control">
            <option value="Totales">Tipo de consulta</option>
            <option value="Detallada">Detallada</option>
            <option value="Totales">Totales</option>
        </select>
    </div>
    <div class="col-md-3 mt-4 pt-2">
        <button class="btn btn-success" id="btn-consultar">Consultar</button>
    </div>
</div>




<div class="row">
    <div class="col-12 pt-3 pl-3 pb-3">
        <table class="table  table-bordered table-responsive mt-3">
            <thead>
                <tr>
                    <th>Codigo Transaccion</th>
                    <th>No. transaccion</th>
                    <th>Ref. Producto</th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>E</th>
                    <th>F</th>
                    <th>G</th>
                    <th>H</th>
                    <th>I</th>
                    <th>J</th>
                    <th>K</th>
                    <th>L</th>
                    <th>X</th>

                </tr>
            </thead>
            <tbody id="transacciones">

            </tbody>
            <tfoot>
                <tr id="totales">
                    <th>Existencia</th>
                    <th></th>
                    <th id="ref"></th>
                    <th id="a"></th>
                    <th id="b"></th>
                    <th id="c"></th>
                    <th id="d"></th>
                    <th id="e"></th>
                    <th id="f"></th>
                    <th id="g"></th>
                    <th id="h"></th>
                    <th id="i"></th>
                    <th id="j"></th>
                    <th id="k"></th>
                    <th id="l"></th>
                    <th></th>
                </tr>
                <tr id="disp_venta">
                    <th>Disp. venta</th>
                    <th></th>
                    <th id="ref_venta"></th>
                    <th id="a_venta"></th>
                    <th id="b_venta"></th>
                    <th id="c_venta"></th>
                    <th id="d_venta"></th>
                    <th id="e_venta"></th>
                    <th id="f_venta"></th>
                    <th id="g_venta"></th>
                    <th id="h_venta"></th>
                    <th id="i_venta"></th>
                    <th id="j_venta"></th>
                    <th id="k_venta"></th>
                    <th id="l_venta"></th>
                    <th></th>
                </tr>
            </tfoot>
        </table>

    </div>

    {{-- <div class="col-md-2 " style="margin-top: 26.8%">
        <button id="btn-guardar" name="btn-guardar" class="btn btn-secondary"><i class="fas fa-sync"></i></button>
    </div> --}}




</div>













@include('adminlte/scripts')
<script src="{{asset('js/existencia.js')}}"></script>

<script>
    function mostrar(id_almacen) {
        $.get("almacen/" + id_almacen, function(data, status) {
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();
            $("#referencia_producto").show();
            $("#numero_corte").show();
            $("#corteEdit").show();
            $("#corteAdd").hide();
          
           
            
            $("#id").val(data.almacen.id);
            $("#referencia_producto").val('Referencia elegida: '+data.almacen.producto.referencia_producto);
            $("#numero_corte").val('Corte elegido: '+data.almacen.corte.numero_corte);
            $("#ubicacion").val(data.almacen.producto.ubicacion);
            $("#tono").val("");
            $("#intensidad_proceso_seco").val(data.almacen.producto.intensidad_proceso_seco);
            $("#atributo_no_1").val(data.almacen.producto.atributo_no_1);
            $("#atributo_no_2").val(data.almacen.producto.atributo_no_2);
            $("#atributo_no_3").val(data.almacen.producto.atributo_no_3);
            $("#a").val(data.almacen.a);
            $("#b").val(data.almacen.b);
            $("#c").val(data.almacen.c);
            $("#d").val(data.almacen.d);
            $("#e").val(data.almacen.e);
            $("#f").val(data.almacen.f);
            $("#g").val(data.almacen.g);
            $("#h").val(data.almacen.h);
            $("#i").val(data.almacen.i);
            $("#j").val(data.almacen.j);
            $("#k").val(data.almacen.k);
            $("#l").val(data.almacen.l);
            $("#genero").val(data.almacen.producto.referencia_producto);
            $("#frente").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_frente)
            $("#trasera").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_trasero)
            $("#perfil").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_perfil)
            $("#bolsillo").attr("src", '/sistemaCCH/public/producto/terminado/'+data.almacen.producto.imagen_bolsillo)
        });
    }




    function eliminar(id_almacen){
        bootbox.confirm("¿Estas seguro de eliminar este producto de almacen?", function(result){
            if(result){
                $.post("almacen/delete/" + id_almacen, function(){
                    bootbox.alert("Producto de almacen eliminado correctamente!!");
                    $("#almacenes").DataTable().ajax.reload();
                })
            }
        })
    }

</script>



@endsection