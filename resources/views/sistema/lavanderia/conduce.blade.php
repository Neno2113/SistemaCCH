<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Conduce de envio</title>
  <style>
    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color: #5D6975;
      text-decoration: underline;
    }

    body {
      position: relative;
      width: 21cm;
      height: 29.7cm;
      margin: 0 auto;
      color: #001028;
      background: #FFFFFF;
      font-family: Arial, sans-serif;
      font-size: 14px;
      font-family: Arial;
    }

    header {
      padding: 10px 0;
      margin-bottom: 30px;
    }

    #logo {
      text-align: center;
      margin-bottom: 10px;
      margin-right: 25px;
    }

    #logo img {
      width: 170px;
    }

    h4 {
      border-top: 1px solid #5D6975;
      border-bottom: 1px solid #5D6975;
      color: #5D6975;
      font-size: 2.0em;
      line-height: 1.4em;
      font-weight: normal;
      text-align: center;
      margin: 0 0 20px 0;
      background: url({{asset('adminlte/img/dimension.png')}});
      margin-right: 93px;
    }

    #project {
      float: left;
      margin-top: 100px;
      border: 1px solid black;
      padding: 10px;
      /* margin-bottom: 15px; */
      /* margin-top: 15px; */
    }

    #project span {
      color: #5D6975;
      text-align: right;
      width: 52px;
      margin-right: 10px;
      display: inline-block;
      font-size: 0.9em;
    }

    .enviado {
      border-bottom: 1px solid black;
     width: 100%;
      /* margin-top: 30%; */ 
    }

    #company {
      float: right;
      text-align: right;
      margin-right: 60%;
      padding-top: 15px;
      
    }

    #project div,
    #company div {
      white-space: nowrap;
    }

    table {
      width: 90%;
      border-collapse: collapse;
      border-spacing: 0;
      margin-bottom: 50px;
      /* margin-top: 20px; */
    }

    table tr:nth-child(2n-1) td {
      background: #F5F5F5;
    }

    table th,
    table td {
      text-align: center;
    }

    table th {
      padding: 5px 20px;
      color: #5D6975;
      border-bottom: 1px solid #C1CED9;
      white-space: nowrap;
      font-weight: normal;
    }

    table .service,
    table .desc {
      text-align: left;
    }

    table .sku {
      text-align: center;
    }

    table td {
      padding: 20px;
      text-align: right;
    }

    table td.service,
    table td.desc {
      vertical-align: top;
    }

    table td.unit,
    table td.qty,
    table td.total {
      font-size: 1.0em;
    }

    table td.grand {
      border-top: 1px solid #5D6975;
      ;
      /* margin-top: 50px;
  margin-left: 50px;  */
    }

    #notices .notice {
     color: #5D6975;
    font-size: 1.0em;
    width: 70%;
    }


    .firmas {
      margin-top: 180px;
    }

    .firma_enviado {

      float: left;
      border-top: 1px solid black;
      width: 15%;
    }

    .firma_recibido {
      float: right;
      border-top: 1px solid black;
      margin-right: 46%;
      width: 15%;
    }

    footer {
      color: #5D6975;
      width: 100%;
      height: 30px;
      position: absolute;
      bottom: 0;
      border-top: 1px solid #C1CED9;
      padding: 8px 0;
      text-align: center;
    }
  </style>
</head>

<body>
  <header class="clearfix">
    {{-- <div id="logo">
      <img src="{{asset('adminlte/img/LOGO_CCH-01.jpg')}}">
    </div> --}}
    
    <div id="company" class="clearfix">
      <div>Confecciones Carmen Herrera, SRL</div>
      <div>C/ Diego Tristan, casi esq. Ave. la pista<br /> Hainamosa, Santo Domingo Este</div>
      <div>(809) 699-8400</div>
      <div><a href="mailto:oper.cch.srl@gmail.com">oper.cch.srl@gmail.com</a></div>
    </div>
    <h4>Conduce de envio: {{$lavanderia->numero_envio}}</h4>
    <div id="project">
      <h3 class="enviado">Enviado a:</h3>
      <div><span>Codigo</span>{{$lavanderia->suplidor->rnc}}</div>
      <div><span>Lavanderia</span>{{$lavanderia->suplidor->nombre}}</div>
      <div><span>Direccion</span>{{$lavanderia->suplidor->direccion}}</div>
      <div><span>Email</span> <a href="mailto:{{$lavanderia->suplidor->email}}">{{$lavanderia->suplidor->email}}</a></div>
      <div><span>Fecha</span>{{$lavanderia->fecha_envio}}</div>
      <div><span>Enviado</span> Chofer</div>
    </div>
  </header>
  <main>
    <table id="detalle">
      <thead>
        <tr>
          <th class="sku">Cant</th>
          <th>UPC/SKU</th>
          <th class="sku">Codigo</th>
          <th class="sku">U/M</th>
          <th class="desc">Estandar</th>
          <th>TOTAL</th>
        </tr>
      </thead>
      <tbody>
       
        <tr>
          <td class="sku">{{$lavanderia->total_enviado}}</td>
          <td class="sku">{{$lavanderia->sku->sku}}</td>
          <td class="sku">{{$lavanderia->producto->referencia_producto}}  
          {{$lavanderia->producto->referencia_producto_2}}</td>
          <td class="sku">UNIDAD</td>
          <td class="sku"> 
          @if ($lavanderia->estandar_incluido == 1)
                Si
            @else
                No
          @endif</td>
          <td class="sku">{{$lavanderia->total_enviado}}</td>
        </tr>
      
        {{-- <tr>
            <td class="service"></td>
            <td class="desc"></td>
            <td class="sku">{{}}</td>
            <td class="qty"></td>
            <td class="total"></td>
          </tr> --}}
          {{-- <tr>
            <td class="service">SEO</td>
            <td class="desc">Optimize the site for search engines (SEO)</td>
            <td class="unit">$40.00</td>
            <td class="qty">20</td>
            <td class="total">$800.00</td>
          </tr>
          <tr>
            <td class="service">Training</td>
            <td class="desc">Initial training sessions for staff responsible for uploading web content</td>
            <td class="unit">$40.00</td>
            <td class="qty">4</td>
            <td class="total">$160.00</td>
          </tr> --}}
        {{-- <tr>
            <td colspan="4">SUBTOTAL</td>
            <td class="total">$5,200.00</td>
          </tr>
          <tr>
            <td colspan="4">TAX 25%</td>
            <td class="total">$1,300.00</td>
          </tr> --}}
        <tr style="">
          <td colspan="4" class="grand total">TOTAL</td>
          <td class="grand sku">{{$lavanderia->total_enviado}}</td>
        </tr>
      </tbody>
    </table>
    <div id="notices">
        <div>Descripcion:</div>
        <div class="notice">{{$lavanderia->receta_lavado}}</div>
      </div>

    <div class="firmas">
      <div class="firma_enviado">Enviado por:</div>
      <div class="firma_recibido">Recibido por:</div>
    </div>
  </main>
  <footer>
    Conduce de envio generado desde SistemaCCH
  </footer>
</body>

{{-- <script src="{{asset('js/lavanderia.js')}}"></script> --}}

{{-- <script>

  function asignar(id){
    $.get("conduce/" + id_lavanderia, function(data, status) {
           
      var cont;
      var fila = '<tr id="fila'+cont+'"">'+
      '<td>'+data.lavanderia.cantidad+'</td>'+
      '<td>'+data.lavanderia.sku.sku+'</td>'+
      '<td>'+data.lavanderia.cantidad+'</td>'+
      '<td>'+data.lavanderia.producto.referencia_producto+'</td>'+
      '<td>''</td>'
           
    });

    
  }

</script> --}}
</html>

