@extends('adminlte.layout')

@section('seccion', 'Utilidades')

@section('title', 'Compisiciones')


@section('content')
<div class="container">
    <div class="row mt-3 ml-3">
        <button class="btn btn-primary mb-3" id="btnAgregar"><i class="fas fa-plus-circle fa-lg"></i> Agregar</button>
        <button class="btn btn-danger mb-3" id="btnCancelar"><i class="fas fa-arrow-alt-circle-left fa-lg"></i>
            Cancelar</button>
    </div>

    <div class="row d-flex justify-content-center">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header text-center ">
                <h4>Composiciones</h4>
            </div>
            <div class="card-body">
                <form action="" id="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de composiciones:</h5>
                    <hr>
                    <div class="row ">
                        <div class="col-md-6">
                            <input type="hidden" name="id" id="id" value="">
                            {{-- <label for="codigo composicion">Codigo composicion(*):</label>
                            <input type="text" name="codigo_composicion" id="codigo_composicion" class="form-control"> --}}
                        </div>
                        <div class="col-md-12">
                            <label for="nombre composicion"></label>
                            <input type="text" name="nombre_composicion" placeholder="Nombre composicion"
                                id="nombre_composicion" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer  text-muted ">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-primary mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-edit" class="btn btn-warning mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Editar</button>
            </div>
        </div>
    </div>
</div>

<div class="card" id="listadoUsers">
    <div class="card-header text-center">
        <h4> Listado de composiciones</h4>
    </div>
    <div class="card-body">
        <table id="compositions" class="table table-hover table-bordered datatables">
            <thead>
                <tr>
                    <th>Opciones</th>
                    <th>Nombre composicion</th>

                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th>Opciones</th>
                    <th>Nombre composicion</th>
                </tr>
            </tfoot>
        </table>
    </div>

</div>




@include('adminlte/scripts')
<script src="{{asset('js/composition.js')}}"></script>

<script>
    function mostrar(id_composition) {
        $.post("composition/" + id_composition, function(data, status) {
            // data = JSON.parse(data);
            $("#listadoUsers").hide();
            $("#registroForm").show();
            $("#btnCancelar").show();
            $("#btnAgregar").hide();
            $("#btn-edit").show();
            $("#btn-guardar").hide();

            // console.log(data);
            $("#id").val(data.composition.id);
            $("#codigo_composicion").val(data.composition.codigo_composicion);
            $("#nombre_composicion").val(data.composition.nombre_composicion);

        });
    }

    function eliminar(id_composition){
        Swal.fire({
        title: '¿Esta seguro de eliminar esta composicion?',
        text: "Va a eliminar esta composicion!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, acepto'
      }).then((result) => {
        if (result.value) {
            $.post("composition/delete/" + id_composition, function(){
                Swal.fire(
                'Eliminado!',
                'Composicion eliminada correctamente.',
                'success'
                )
                $("#compositions").DataTable().ajax.reload();
            })
        }
      })

        // bootbox.confirm("¿Estas seguro de eliminar esta composicion?", function(result){
        //     if(result){
        //         $.post("composition/delete/" + id_composition, function(){
        //             // bootbox.alert(e);
        //             bootbox.alert("Composicion eliminada correctamente");
        //             $("#compositions").DataTable().ajax.reload();
        //         })
        //     }
        // })
    }

</script>



@endsection
