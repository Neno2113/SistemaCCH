@extends('adminlte.layout')

@section('seccion', 'Usuarios')

@section('title', 'Empleados')

@section('content')


<div class="row">
    <div class="col-12">
        <div class="card  mb-3" id="registroForm">
            <div class="card-header bg-dark">
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove"><i
                            class="fas fa-remove"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="" id="formulario" name="formulario" class="form-group carta panel-body">
                    <h5>Formulario de registro de empleados</h5>
                    <hr>
                    <div class="row ">
                        <input type="hidden" name="id" id="id" value="">
                        <div class="col-md-3">

                            <label for="nombre" >Nombre *</label>
                            <input type="text" name="nombre" id="nombre"  class="form-control">
                         
                        </div>
                        <div class="col-md-3">
                            <label for="apellido" >Apellido *</label>
                            <input type="text" name="apellido" id="apellido" 
                                class="form-control">
                          
                        </div>
                        <div class="col-md-3">
                            <label for="cedula" >Identificacion *</label>
                            <input type="text" name="cedula" id="cedula" 
                                class="form-control text-center" data-inputmask='"mask": "999-9999999-9"' data-mask>
                            
                        </div>
                        <div class="col-md-3">
                            <label for="">Fecha Nacimiento *</label>
                            <input 
                            type="date" 
                            name="fecha_nacimiento" 
                            id="fecha_nacimiento" 
                            class="form-control"
                            value="1950-01-01"    
                        >
                        </div>

                    </div>

                    <div class="col-md-4 mt-3" id="vatar">
                <!--    <form action="" method="POST" id="formUpload" enctype="multipart/form-data"> -->
                        <div class="form-group">
                            <label for="exampleInputFile">Foto</label>
                            <img src="{{asset('adminlte/img/images.png')}}" alt="" id="avatar-img" class="rounded img-fluid img-thumbnail">
                            <div class="input-group mt-4">
                                <div class="custom-file">
                                    <input type="file" class="form-control" name="avatar" id="avatar">
                                    <input type="hidden" name="image_name" id="image_name" value="">
                                    {{-- <label class="custom-file-label" for="exampleInputFile">Choose file</label> --}}
                                </div>
                                <div class="input-group-append">
                                    <button type="submit" class="btn-primary" id="btn-upload">
                                        <i class="fas fa-upload"></i> Subir</button>
                                </div>
                            </div>
                        </div>
                <!--    </form> -->
                    </div>

                    <div class="row" id="fila-detail">
                        <div class="col-md-4 mt-3">
                            <label for="email">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-at"></i></span>
                                </div>
                           
                            <input type="email" name="email" id="email"  class="form-control">
                           
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="telefono_1" >Teléfono</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                         
                            <input type="text" id="telefono_1" name="telefono_1"
                                class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                          
                            </div>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label for="celular" >Celular *</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                            <input type="text" id="celular"  name="celular"
                                class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="fila-detail-2">
                        <div class="col-md-4">
                            <label for="estado_civil" >Estado Civil</label>
                            <select name="estado_civil" id="estado_civil" class="form-control">
                                <option value="" disabled selected>Estado Civil</option>
                                <option value="Casado">CASADO</option>
                                <option value="Soltero">SOLTERO</option>
                                <option value="Union Libre">UNION LIBRE</option>
                                <option value="Viudo">VIUDO</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="calle" >Dirección</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                            <input type="text" name="calle" placeholder="Calle" id="calle" class="form-control">
                            
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="" >Sector</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                                </div>
                            <input type="text" name="sector" placeholder="Sector" id="sector" class="form-control">
                            
                            </div>
                        </div>   
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label for="" >Provincia</label>
                            <select name="provincia" id="provincia" class="form-control select2">
                                <option value="" disabled>PROVINCIA</option>
                                <option>SANTO DOMINGO</option>
                                <option>DISTRITO NACIONAL</option>
                                <option>SANTIAGO</option>
                                <option>SAN CRISTOBAL</option>
                                <option>LA VEGA</option>
                                <option>PUERTO PLATA</option>
                                <option>SAN PEDRO DE MACORIS</option>
                                <option>DUARTE</option>
                                <option>LA ALTAGRACIA</option>
                                <option>LA ROMANA</option>
                                <option>SAN JUAN</option>
                                <option>ESPAILLAT</option>
                                <option>AZUA</option>
                                <option>BARAHONA</option>
                                <option>MONTE PLATA</option>
                                <option>PERAVIA</option>
                                <option>MONSEÑOR NOUEL</option>
                                <option>VALVERDE</option>
                                <option>SANCHEZ RAMIREZ</option>
                                <option>MARIA TRINIDAD SANCHEZ</option>
                                <option>MONTECRISTI</option>
                                <option>SAMANA</option>
                                <option>BAHORUCO</option>
                                <option>HERMANAS MIRABAL</option>
                                <option>EL SEIBO</option>
                                <option>HATO MAYOR</option>
                                <option>DAJABON</option>
                                <option>ELIAS PIÑA</option>
                                <option>SAN JOSE DE OCOA</option>
                                <option>SANTIAGO RODRIGUEZ</option>
                                <option>INDEPENDENCIA</option>
                                <option>PEDERNALES</option>
                            </select>  
                        </div>
                        <div class="col-md-4">
                            <label for="" >Referencias</label>
                            <input type="text" name="sitios_cercanos" id="sitios_cercanos" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_ingreso">Fecha de Ingreso</label>
                            <input 
                            type="date" 
                            name="fecha_ingreso" 
                            id="fecha_ingreso" 
                            class="form-control"
                            value="2000-01-01"    
                        >
                        </div>
                    </div>

                    <div class="" id="fila-dependientes">
                        <br>
                        <br>
                        <h5>Informacion Personal</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="condicion_medica" >Condicion Medica (Que Ud. o algun familiar directo padezca)</label>
                                <input type="text" name="condicion_medica"  id="condicion_medica"
                                    class="form-control"> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label for="nombre_esposa" >Nombre Esposo/a</label>
                                <input type="text" name="nombre_esposa"  id="nombre_esposa"
                                    class="form-control">
                               
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="telefono_esposa" >Telefono Esposo/a</label>
                                <input type="text" name="telefono_esposa"
                                    id="telefono_esposa" class="form-control" data-inputmask='"mask": "(999) 999-9999"'
                                    data-mask>
                              
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="esposa_en_nss">¿Esposo/a Incluida en Seguro?</label>
                                <select name="esposa_en_nss" id="esposa_en_nss" class="form-control">
                                    <option value="" disabled selected>¿Esposa incluida?</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2 mt-4">
                                <label for="autorizacion_credito_req">Mostrar dependientes?</label>
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary1" name="r1" value="1">
                                        <label for="radioPrimary1">
                                            Si
                                        </label>
                                    </div>
                                    <div class="icheck-primary d-inline">
                                        <input type="radio" id="radioPrimary2" value="0" name="r1" checked>
                                        <label for="radioPrimary2">
                                            No
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 mt-4" id="collapseExample">
                                    <label for="cantidad_dependientes">Cantidad Dependientes</label>
                                    <input type="number" name="cantidad_dependientes" id="cantidad_dependientes"
                                        class="form-control text-center">
                            </div>
                        </div>  
                    </div>
                    <div class="collapse mt-5" id="collapseExample">
                     <!--   <div class="row">
                            
                        </div>
                    -->
                        <div class="row mt-4">
                            <table class="table tabla-dependientes">
                                <thead class="text-center dependientes-encabezado">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Parentesco</th>
                                        <th>Edad</th>
                                    <!--    <th>Asegurado</th> -->
                                    </tr>
                                </thead>
                                <tbody id="hijos" class="bg-white">
                                    <tr id='tr_dependiente_0'>
                                        <td><input type='text' name='nombre_dependiente_0' id='nombre_dependiente_0' class='form-control'></td>
                                        <td><select name='parentesco_dependiente_0' id='parentesco_dependiente_0' class='form-control'><option value='' disabled>Parentesco</option><option>Padre</option><option>Madre</option><option>Hijo</option><option>Hija</option><option>Esposa</option><option>Esposo</option></select></td>
                                        <td><input type='number' name='edad_dependiente_0' id='edad_dependiente_0' class='form-control'></td>
                                    </tr>
                                    <tr id='tr_dependiente_1'>
                                        <td><input type='text' name='nombre_dependiente_1' id='nombre_dependiente_1' class='form-control'></td>
                                        <td><select name='parentesco_dependiente_1' id='parentesco_dependiente_1' class='form-control'><option value='' disabled>Parentesco</option><option>Padre</option><option>Madre</option><option>Hijo</option><option>Hija</option><option>Esposa</option><option>Esposo</option></select></td>
                                        <td><input type='number' name='edad_dependiente_1' id='edad_dependiente_1' class='form-control'></td>
                                    </tr>
                                    <tr id='tr_dependiente_2'>
                                        <td><input type='text' name='nombre_dependiente_2' id='nombre_dependiente_2' class='form-control'></td>
                                        <td><select name='parentesco_dependiente_2' id='parentesco_dependiente_2' class='form-control'><option value='' disabled>Parentesco</option><option>Padre</option><option>Madre</option><option>Hijo</option><option>Hija</option><option>Esposa</option><option>Esposo</option></select></td>
                                        <td><input type='number' name='edad_dependiente_2' id='edad_dependiente_2' class='form-control'></td>
                                    </tr>
                                    <tr id='tr_dependiente_3'>
                                        <td><input type='text' name='nombre_dependiente_3' id='nombre_dependiente_3' class='form-control'></td>
                                        <td><select name='parentesco_dependiente_3' id='parentesco_dependiente_3' class='form-control'><option value='' disabled>Parentesco</option><option>Padre</option><option>Madre</option><option>Hijo</option><option>Hija</option><option>Esposa</option><option>Esposo</option></select></td>
                                        <td><input type='number' name='edad_dependiente_3' id='edad_dependiente_3' class='form-control'></td>
                                    </tr>
                                    <tr id='tr_dependiente_4'>
                                        <td><input type='text' name='nombre_dependiente_4' id='nombre_dependiente_4' class='form-control'></td>
                                        <td><select name='parentesco_dependiente_4' id='parentesco_dependiente_4' class='form-control'><option value='' disabled>Parentesco</option><option>Padre</option><option>Madre</option><option>Hijo</option><option>Hija</option><option>Esposa</option><option>Esposo</option></select></td>
                                        <td><input type='number' name='edad_dependiente_4' id='edad_dependiente_4' class='form-control'></td>
                                    </tr>
                                    <tr id='tr_dependiente_5'>
                                        <td><input type='text' name='nombre_dependiente_5' id='nombre_dependiente_5' class='form-control'></td>
                                        <td><select name='parentesco_dependiente_5' id='parentesco_dependiente_5' class='form-control'><option value='' disabled>Parentesco</option><option>Padre</option><option>Madre</option><option>Hijo</option><option>Hija</option><option>Esposa</option><option>Esposo</option></select></td>
                                        <td><input type='number' name='edad_dependiente_5' id='edad_dependiente_5' class='form-control'></td>
                                    </tr>
                                    <tr id='tr_dependiente_6'>
                                        <td><input type='text' name='nombre_dependiente_6' id='nombre_dependiente_6' class='form-control'></td>
                                        <td><select name='parentesco_dependiente_6' id='parentesco_dependiente_6' class='form-control'><option value='' disabled>Parentesco</option><option>Padre</option><option>Madre</option><option>Hijo</option><option>Hija</option><option>Esposa</option><option>Esposo</option></select></td>
                                        <td><input type='number' name='edad_dependiente_6' id='edad_dependiente_6' class='form-control'></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="" id="fila-refrencias">
                        <br>
                        <br>
                        <h5>Referencia Personal</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="nombre_ref1" >Nombre Referencia 1</label>
                                <input type="text" name="nombre_ref1"  id="nombre_ref1"
                                    class="form-control">
                               
                            </div>
                            <div class="col-md-4">
                            <label for="parentesco_ref" >Parentesco</label>
                                <input type="text" name="parentesco_ref1"
                                    id="parentesco_ref1" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="telefono_ref1" >teléfono</label>
                                <input type="text" name="telefono_ref1"
                                    id="telefono_ref1" class="form-control" data-inputmask='"mask": "(999) 999-9999"'
                                    data-mask>
                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <label for="nombre_ref2" >Nombre Referencia 2</label>
                                <input type="text" name="nombre_ref2"  id="nombre_ref2"
                                    class="form-control">
                               
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="parentesco_ref2" >Parentesco</label>
                                <input type="text" name="parentesco_ref2"
                                    id="parentesco_ref2" class="form-control">
                              
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="telefono_ref2" >teléfono</label>
                                <input type="text" name="telefono_ref2"
                                    id="telefono_ref2" class="form-control" data-inputmask='"mask": "(999) 999-9999"'
                                    data-mask>
                              
                            </div>
                        </div>
                    </div>

                    <div class="" id="fila-academica">
                        <br>
                        <br>
                        <h5>Formación Academica</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="primaria" >Primaria</label>
                                <input type="text" name="primaria"  id="primaria"
                                    class="form-control">
                               
                            </div>
                            <div class="col-md-4">
                            <label for="bachiller" >Bachiller</label>
                                <input type="text" name="bachiller"
                                    id="bachiller" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="nivel_superior" >Nivel Superior</label>
                                <input type="text" name="nivel_superior"
                                    id="nivel_superior" class="form-control">
                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-2">
                                <label for="grado_titulo" >Grado y Titulo</label>
                                <input type="text" name="grado_titulo"  id="grado_titulo"
                                    class="form-control">
                               
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="especialidad" >Especialidad</label>
                                <input type="text" name="especialidad"
                                    id="especialidad" class="form-control">
                              
                            </div>
                            <div class="col-md-4 mt-2">
                                <label for="fecha_exp" >Fecha de Exp.</label>
                                <input type="date" name="fecha_exp" id="fecha_exp" class="form-control"value="2000-01-01">
                                
                            </div>
                        </div>
                    </div>

                    <div class="" id="fila-experiencias">
                        <br>
                        <br>
                        <h5>Experiencia Laboral</h5>
                        <hr>
                    </div>
                    <div>
                        <div class="row mt-4">
                            <table class="table tabla-dependientes">
                                <thead class="text-center experiencia-encabezado">
                                    <tr>
                                        <th>Cargo</th>
                                        <th>Tiempo</th>
                                        <th>Empresa</th>
                                        <th>Supervisor</th>
                                        <th>Teléfono</th>
                                    </tr>
                                </thead>
                                <tbody id="experiencia" class="bg-white">
                                    <tr>
                                        <td><input type='text' name="cargo_experiencia_1" id="cargo_experiencia_1" class='form-control'></td>
                                        <td><input type='text' name="tiempo_experiencia_1" id="tiempo_experiencia_1" class='form-control'></td>
                                        <td><input type='text' name="empresa_experiencia_1" id="empresa_experiencia_1" class='form-control'></td>
                                        <td><input type='text' name="supervisor_experiencia_1" id="supervisor_experiencia_1" class='form-control'></td>
                                        <td><input type='text' name="telefono_experiencia_1" id="telefono_experiencia_1" class='form-control' data-inputmask='"mask": "(999) 999-9999"'
                                    data-mask></td>
                                    </tr>
                                    <tr>
                                        <td><input type='text' name="cargo_experiencia_2" id="cargo_experiencia_2" class='form-control'></td>
                                        <td><input type='text' name="tiempo_experiencia_2" id="tiempo_experiencia_2" class='form-control'></td>
                                        <td><input type='text' name="empresa_experiencia_2" id="empresa_experiencia_2" class='form-control'></td>
                                        <td><input type='text' name="supervisor_experiencia_2" id="supervisor_experiencia_2" class='form-control'></td>
                                        <td><input type='text' name="telefono_experiencia_2" id="telefono_experiencia_2" class='form-control' data-inputmask='"mask": "(999) 999-9999"'
                                    data-mask></td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    

                    <div class="" id="fila-laboral">
                        <br>
                        <br>
                        <h5>Informacion Laboral</h5>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mt-3">
                            <label for="codigo">Codigo Empleado</label>
                            <input type="text" name="codigo" id="codigo"  class="form-control">
                        </div>  
                    </div> 
                    <div class="row"> 
                        <div class="col-md-4">
                            <label for="departamento" >Departamento</label>
                            <select name="departamento" id="departamento" class="form-control">
                                <option value="" disabled>DEPARTAMENTO</option>
                                <option>ADMINISTRADOR</option>
                                <option>OFICINA</option>
                                <option>VENTA</option>
                                <option>CORTE</option>
                                <option>PRODUCCION</option>
                                <option>ARTESANIA</option>
                                <option>TERMINACION</option>
                                <option>ALMACEN PRODUCTO TERMINADO</option>
                                <option>GENERAL</option>
                                
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="cargo" >Cargo</label>
                            <select name="cargo" id="cargo" class="form-control select2">
                                <option value="" disabled>CARGO</option>
                                <option>OPERARIO-1738 - OPERARIO</option>
                                <option>OPERARIO-1738 - COCER</option>
                                <option>OPERARIO-1738 - SUPERVISOR CALIDAD</option>
                                <option>OPERARIO-1738 - ENCARGADO ARTESANIA</option>
                                <option>OPERARIO-1738 - OPERARIO ARTESANIA</option>
                                <option>OPERARIO-1738 - PLANCHADORA</option>
                                <option>OPERARIO-1738 - ENCARGADO OPERACIONES</option>
                                <option>OPERARIO-1738 - MECANICO</option>
                                <option>OPERARIO-1738 - REVISORA CALIDAD</option>
                                <option>OPERARIO-1738 - CORTE</option>
                                <option>OPERARIO-1738 - AYUDANTE CORTE</option>
                                <option>OPERARIO-1738 - MUETRISTA</option>
                                <option>OPERARIO-1738 - ENCARGADO DE PONER ETIQUETAS</option>
                                <option>OPERARIO-1738 - LIMPIEZA DE HILOS</option>
                                <option>DISEÑADOR-4115 - DISEÑADOR</option>
                                <option>DISEÑADOR-4115 - PATRONISTA</option>
                                <option>VENDEDOR-219 - VENDEDORA</option>
                                <option>VENDEDOR-219 - PROMOTORA</option>
                                <option>CONTADOR-4374</option>
                                <option>AUXILIAR CONTADOR-5103 - AUXILIAR</option>
                                <option>CHOFER, AUTOMOVIL-4840</option>
                                <option>SERENO-822</option>
                                <option>DIRECTOR PRODUCCION Y OPERACIONES/RESTAURACION-4069 - AYUDANTE SUPERVISOR
                                </option>
                                <option>CONSERJE-4635</option>
                                <option>VIGILANTE-327</option>
                                <option>PRESIDENTE, EMPRESA-1343</option>
                                <option>ALMACENISTA-5064 - PRODUCTOS TERMINADOS</option>
                                <option>INGENIERO, SISTEMAS INFORMATICOS-3247</option>
                                <option>GERENTE GENERAL, EMPRESA/INDUSTRIAS MANUFACTURERAS-3394</option>
                            </select>
                            
                        </div>  
                    
                        <div class="col-md-4">
                            <label for="tipo_contracto" >Contrato</label>
                            <select name="tipo_contrato" id="tipo_contrato" class="form-control">
                                <option value="" disabled>TIPO DE CONTRATO</option>
                                <option value="TEMPORERO">TEMPORERO</option>
                                <option value="FIJO">FIJO</option>
                            </select>
                            
                        </div>
                    </div>
                    <div class="div" id="fila-bancaria">
                        <br>
                        <br>
                        <h5>Informacion Financiera</h5>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label for="forma_pago" >Forma pago</label>
                                <select name="forma_pago" id="forma_pago" class="form-control">
                                    <option value="" disabled>FORMA DE PAGO</option>
                                    <option value="POR HORA">POR HORA</option>
                                    <option value="SUELDO FIJO">SUELDO FIJO</option>
                                    <option value="AJUSTE">AJUSTE</option>
                                    <option value="COMBINADO">COMBINADO</option>
                                </select>
                               
                            </div>
                            <div class="col-md-4">
                                <label for="sueldo" >Sueldo</label>
                                <input type="text" name="sueldo"  id="sueldo"
                                    class="form-control text-center" data-inputmask='"mask": "999[99]"' data-mask>
                            </div>
                            <div class="col-md-4">
                                <label for="valor_hora" >Valor hora</label>
                                <input type="text" name="valor_hora" id="valor_hora"
                                    class="form-control text-center" data-inputmask='"mask": "999[9]"' data-mask>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <label for="banco_tarjeta_cobro" >Banco</label>
                                <select name="banco_tarjeta_cobro" id="banco_tarjeta_cobro"
                                    class="form-control select2">
                                    <option value="" disabled>BANCO</option>
                                    <option value="BANCO POPULAR">BANCO POPULAR</option>
                                    <option value="BANRESERVAS">BANRESERVAS</option>
                                    <option value="BANCO BHD LEON">BANCO BHD LEON</option>
                                    <option value="SCOTIABANK">SCOTIABANK</option>
                                    <option value="BANCO SANTA CRUZ">BANCO SANTA CRUZ</option>
                                    <option value="BANCO CARIBE">BANCO CARIBE</option>
                                    <option value="BANCO ADEMI">BANCO ADEMI</option>
                                    <option value="BANCO PROMERICA">BANCO PROMERICA</option>
                                </select>
                              
                            </div>

                            <div class="col-md-4 mt-3">
                                <label for="no_cuenta" >No. de cuenta</label>
                                <input type="text" name="no_cuenta" placeholder="No. de cuenta" id="no_cuenta"
                                    class="form-control">
                               
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="nss" >No. Seguridad social</label>
                                <input type="text" name="nss" id="nss"
                                    class="form-control text-center" data-inputmask='"mask": "999999999[9[9]]"' data-mask>
                              
                            </div>
                        </div>
                    </div>


            </div>
            <div class="card-footer  text-muted ">
                <button class="btn btn-danger mt-2 float-left" id="btnCancelar"><i
                        class="fas fa-arrow-alt-circle-left fa-lg"></i> Cancelar</button>
                <button type="submit" id="btn-guardar" class="btn btn-info mt-2 float-right"><i
                        class="far fa-save fa-lg"></i> Guardar</button>
                <button type="submit" id="btn-guardar-detalle" class="btn btn-info mt-2 float-right"> <!-- <i
                        class="far fa-save fa-lg"></i> --> Imprimir</button>
                <button type="submit" id="btn-edit" class="btn btn-info mt-2 float-right"><i
                        class="far fa-edit fa-lg"></i> Guardar</button>
            </div>
        </div>

        </form>
    </div>
</div>
{{-- </div> --}}

<div class="card" id="listadoUsers">
    <div class="card-header bg-dark">
        <div class="row">
            <div class="col-12">
                @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Empleados')->where('agregar', 1)->first()  )
                <button class="btn btn-primary float-left" id="btnAgregar"><i class="fas fa-user-plus"></i> Agregar </button>
                @endif
                <h4 class="text-white text-center">Listado de empleados</h4>
            </div>
        </div>

    </div>
    <div class="card-body">
        @if (Auth::user()->role == "Administrador" || Auth::user()->permisos()->where('permiso', 'Empleados')->where('ver', 1)->first())
        <table id="clients" class="table table-hover table-bordered datatables" style="width:100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Codigo</th>
                    <th>Contrato</th>
                    <th>Fecha Ingreso</th>
                    <th>Tiempo Laborando</th>
                    <th>Celular</th>
                </tr>
            </thead>
            <tbody></tbody>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Opciones</th>
                    <th>Nombre</th>
                    <th>Departamento</th>
                    <th>Codigo</th>
                    <th>Contrato</th>
                    <th>Fecha Ingreso</th>
                    <th>Tiempo Laborando</th>
                    <th>Celular</th>
                </tr>
            </tfoot>
        </table>
        @else
        <div class="row" id="alerts">
            <div class="col-md-12">
              <div class="card card-default">
                <div class="card-header">
                  <h3 class="card-title">
                    <i class="fas fa-exclamation-triangle"></i>
                     Info
                  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-info"></i> Acceso negado!</h5>
                        Usted no posee permisos necesarios para realizar esta accion.
                        Para poder realizar la accion debe comunicarse con el administrador.
                  </div>
               
               
                </div>
        
              </div>
              <!-- /.card -->
            </div>
        </div>
        @endif
    </div>

</div>

@include('adminlte/scripts')
{{-- <script src="{{asset('js/formulario.js')}}"></script> --}}
<script src="{{asset('js/users/empleado.js')}}"></script>



@endsection
