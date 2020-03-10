@extends('adminlte.layout')

@section('seccion', 'Cortes')

@section('title', 'Lavanderia')

@section('content')
<body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{asset('adminlte/img/LOGO_CCH-01.jpg')}}">
      </div>
      <div id="company">
        <h2 class="name">Confecciones Carmen Herrera</h2>
        <div>C/ Diego Tristan, casi esq. Ave. la pista<br /> Hainamosa, Santo Domingo Este</div>
        <div>(809) 699-8400</div>
        <div><a href="mailto:oper.cch.srl@gmail.com">oper.cch.srl@gmail.com</a></div>
        <div>RNC: 130-746974</div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <table class="tabla-cliente">
          <thead class="cod">
            <tr>
              <th>LAVANDERIA CODIGO</th>
              <td>{{$lavanderia->numero_envio}}</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Nombre</th>
              <td>{{$lavanderia->suplidor->nombre}}</td>
            </tr>
            <tr>
              <th class="direccion">Direccion</th>
              <td class="direccion">{{$lavanderia->suplidor->calle}}, {{$lavanderia->suplidor->sector}}
                {{$lavanderia->suplidor->provincia}} {{$lavanderia->suplidor->sitios_cercanos}}</td>
            </tr>
            <tr>
              <th>Tel</th>
              <td>{{$lavanderia->suplidor->telefono_1}}</td>
            </tr>
            <tr>
              <th>RNC</th>
              <td>{{$lavanderia->suplidor->rnc}}</td>
            </tr>
          </tbody>

        </table>

        <table class="tabla-factura">
          <thead>
            <tr>
              <th class="factura">CONDUCE LAVANDERIA</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td class="num_factura">{{$lavanderia->numero_envio}}</td>
            </tr>
            <tr>
              <td class="fecha">Fecha:{{$lavanderia->fecha_envio}}</td>
            </tr>
            <tr>
              <td class="page">Pagina 1</td>
            </tr>
          </tbody>
        </table>
      </div>


      <table border="0" cellspacing="0" cellpadding="0" class="tabla-principal">
        <thead>
          <tr>
            <th class="desc">CORTE</th>
            <th class="no">REFERENCIA</th>
            <th class="unit">UPC/SKU</th>
            <th class="desc">ESTANDAR</th>
            {{-- <th class="unit">PRECIO</th> --}}
            <th class="total">TOTAL ENVIADO</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="no">
              <li>{{$lavanderia->corte->numero_corte}}</li>
            </td>
            <td class="no">
            @if (!empty($lavanderia->producto->referencia_producto_2))
              <li>{{$lavanderia->producto->referencia_producto}} - {{$lavanderia->producto->referencia_producto_2}}</li>
            @else
            <li>{{$lavanderia->producto->referencia_producto}}</li>
            @endif

            </td>
            <td class="desc-des">
              <li>{{$lavanderia->sku->sku}}</li>
            </td>
            <td class="unit">
              <li>
                @if ($lavanderia->estandar_incluido == 1)
                Si
                @else
                No
                @endif
              </li>
            </td>
            <td class="total">
              <li>{{$lavanderia->total_enviado}}</li>
            </td>
          </tr>
        </tbody>

      </table>




      <div id="thanks">CONDUCE DE LAVANDERIA</div>
      <div id="notices">
        <div>LAVADO:</div>
        <p class="notice">{{$lavanderia->receta_lavado}}</p>

      </div>



      <div class="firmas">
        <div class="firma_enviado">ENVIADO POR:</div>

        <div class="firma_recibido">RECIBIDO POR:</div>
      </div>
    </main>
    <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print</a>
    <footer class="pagina1">
      Factura generada desde SistemaCCH.
    </footer>


  </body>





@include('adminlte/scripts')
<script src="{{asset('js/corte/envio-lavanderia.js')}}"></script>





@endsection
