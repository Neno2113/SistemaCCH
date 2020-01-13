<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Factura Resumida</title>
    <style>
        @font-face {
            font-family: SourceSansPro;
            src: url(SourceSansPro-Regular.ttf);
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #0087C3;
            text-decoration: none;
        }

        body {
            position: relative;
            width: 21cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #555555;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 10px;
            font-family: SourceSansPro;
        }

        header {
            padding: 0px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
            margin-right: 8%;
        }

        #logo {
            float: left;
            margin-top: 5px;
        }

        #logo img {
            height: 52px;
        }

        #company {
            float: right;
            text-align: right;
            margin-right: 42%;
            font-size: 8px;
        }


        #details {
            margin-bottom: 50px;
        }

        #client {
            /* padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left; */
        }

        #client .to {
            color: #777777;
        }

        #client-orden {
            padding-left: 6px;
            /* border-left: 6px solid #0087C3;
            border-bottom: 6px solid #0087C3; */
            /* padding: 5px;
            float: left;
            margin-left: 20%; */
        }

        #client-orden .to {
            color: #777777;
            font-size: 13px;
        }

        h2.name {
            font-size: 1.2em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
            margin-right: 30%;
            width: 30%;
        }

        #invoice-fiscal {
            float: right;
            text-align: right;
            margin-right: 45%;
        }

        #invoice-fiscal h1 {
            color: #0087C3;
            font-size: 1.6em;
            line-height: 1em;
            font-weight: bold;
        }

        #invoice_proceso {
            float: right;
            text-align: right;
            margin-right: 46%;
        }

        #invoice h1 {
            color: #000;
            font-size: 2.2em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice_proceso h1 {
            color: #000;
            font-size: 2.2em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #000;
        }

        #invoice_proceso .date {
            font-size: 1.1em;
            color: #000;
        }

        .tabla-principal {
            width: 90%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
            table-layout: auto;
            border: solid 2px black;
        }

        .tabla-principal th,
        .tabla-principal td {
            /* padding: 20px; */
            background: #fff;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
            /* border: solid 2px black; */
        }

        .tabla-principal th {
            white-space: nowrap;
            font-weight: normal;
            background-color: #131980;
            /* border: solid 2px black; */
        }

        .tabla-principal td {
            text-align: right;
            /* border: solid 2px black; */
        }

        .tabla-principal td h3 {
            color: #fff;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
            /* border: solid 2px black; */
        }

        .tabla-principal .no {
            color: #fff;
            font-size: 13px;
            /* background: #160c70; */
            text-align: center;
            border: solid 2px black;

        }

        .tabla-principal .desc {
            text-align: center;
            font-size: 13px;
            color: #fff;
            border: solid 2px black;

        }

        .tabla-principal .unit {
            /* background-color: #160c70; */
            font-size: 13px;
            color: #fff;
            border: solid 2px black;
            /* font-weight: bold; */
        }

        .tabla-principal .unit-fiscal {
            background: #fff;
            font-size: 13px;
            border: solid 2px black;
        }

        .tabla-principal .unit_talla {
            background: #fff;
            text-align: center;
            font-size: 11px;
            font-weight: bold;
            /* border: solid 2px black; */
        }

        .tabla-principal .qty {}

        .tabla-principal .total {
            /* background: #fff; */
            color: #fff;
            font-size: 13px;
            border: solid 2px black;
        }

        .tabla-principal tbody tr {
            padding-bottom: 30px;
        }

        .tabla-principal td.unit,
        .tabla-principal td.desc,
        .tabla-principal td.qty,
        .tabla-principal td.no,
        .tabla-principal td.total {
            font-size: 1.2em;
            /* text-decoration: none; */
            color: #000;
            border: solid 2px black;
        }

        .tabla-principal td.unit-fiscal,
        .tabla-principal td.desc-fiscal {
            font-size: 1.2em;
            text-align: center;
        }

        .tabla-principal td.unit li,
        .tabla-principal td.desc li,
        .tabla-principal td.qty li,
        .tabla-principal td.no li,
        .tabla-principal td.total li {
            list-style-type: none;
            text-align: center;
            padding-bottom: 350px;
        }

        .tabla-principal td.desc-des li {
            /* font-size: 1.0em; */
            text-align: center;
            list-style-type: none;
            margin-bottom: 350px;
            color: #000;
            /* padding: 0; */
            /* padding-right: 20px; */
        }

        .tabla-principal tbody tr:last-child td {
            /* border: none; */
        }

        .tabla-principal tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        .tabla-principal tfoot tr:first-child td {
            border-top: none;
        }

        .tabla-principal tfoot tr:last-child td {
            color: #0087C3;
            font-size: 1.4em;
            border-top: 1px solid #0087C3;

        }

        /* 
        .tabla-totales {
            border: 2px  solid black;
            text-align: center;
        }
        .tabla-totales tbody {
            border: 2px  solid black;
        } */


        .tabla-principal tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 20px;
            color: #000;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #160c70;
            color: #000;
        }

        #notices .notice {
            font-size: 1.2em;
            width: 90%;
            color: #000;
        }

        footer {
            color: #777777;
            width: 90%;
            height: 35px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #AAAAAA;
            padding: 8px 0;
            text-align: center;
        }

        .firmas {
            margin-top: 50px;
            text-align: center;
            font-weight: bold;
            color: #000;
        }

        .firma_enviado {
            float: left;
            border-top: 1px solid black;
            width: 15%;
        }

        .firma_despachado {
            float: right;
            border-top: 1px solid black;
            margin-right: 52%;
            width: 15%;
        }

        .firma_recibido {
            float: left;
            border-top: 1px solid black;
            margin-left: 50%;
            width: 15%;
        }
        footer {
            page-break-after: always;
        }
        . .tabla-principal-totales{
            border: none;
        }
        .tabla-bultos{
            width:50%; 
            color:#000; 
            float:left;
        }
        .tabla-bultos thead th{
            border: 2px solid black;
            padding: 5px;
            text-align: start;
        }

        .tabla-factura{
            float: right;
            width: 19%;
            border: 2px solid black;
            margin-right: 10%;
        }

        .tabla-factura th{
            font-size: 20px;
            padding-left: 19px;
            padding-right: 16px; 
            padding-top: 7px; 
        }
        .tabla-factura tbody .num_factura{
            border-top: 2px solid black;
            border-bottom: 2px solid black;
            text-align: center;
            font-size: 12px;
            color:#c85b5b; 
        }
        .tabla-factura tbody .fecha{
            text-align: center;
            font-size: 10px;
            padding: 6px;
        }
        .tabla-factura tbody .page{
            text-align: center;
            font-size: 10px;
            padding: 6px;
            border-top: 2px solid black;

        }

        .tabla-totales{
            width:40%; 
            color:#000; 
            float:right; 
            margin-right:10%;
        }
        .tabla-totales .total{
            font-weight:bold; 
            font-size:13px;
        }
        .tabla-cliente{
            float: left;
            border-top:2px solid black;
            border-left:2px solid black;
            border-right:2px solid black;
            width: 52%;

        }
        .tabla-cliente thead th{
            border-bottom: 2px solid black;
            font-size: 11px;
        }
        .tabla-cliente thead td{
            border-bottom: 2px solid black;
            padding-left: 47px;
        }
        .tabla-cliente tbody td{
            border-bottom: 2px solid black;
            padding-right: 106px;
        }
        .tabla-cliente tbody th{
            border-right: 2px solid black;
            border-bottom: 2px solid black;
            font-size: 11px;
        }
        .tabla-cliente tbody .direccion{
            padding: 12px;
        }
    </style>
</head>

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
                    <tr >
                        <th>Cliente codigo</th>
                        <td>Cod</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th>Nombre</th>
                        <td>{{$orden_pedido->cliente->nombre_cliente}}</td>
                    </tr>
                    <tr>
                        <th class="direccion">Direccion</th>
                        <td class="direccion">{{$orden_pedido->cliente->calle}}, {{$orden_pedido->cliente->sector}}
                            {{$orden_pedido->cliente->provincia}}, {{$orden_pedido->cliente->sitios_cercanos}}<</td>
                    </tr>
                    <tr>
                        <th>Sucursal</th>
                        <td>{{$orden_pedido->sucursal->nombre_sucursal}}</td>
                    </tr>
                    <tr>
                        <th>Tel</th>
                        <td>{{$orden_pedido->cliente->telefono_1}}</td>
                    </tr>
                    <tr>
                        <th>RNC</th>
                        <td>{{$orden_pedido->cliente->rnc}}</td>
                    </tr>
                </tbody>
              
            </table>
            {{-- <div id="client">
                <div class="to">FACTURA PARA:</div>
                <h2 class="name">{{$orden_pedido->cliente->nombre_cliente}}</h2>
                <div class="address">{{$orden_pedido->cliente->direccion_principal}}</div>
                <div class="name">RNC:{{$orden_pedido->cliente->rnc}}</div>
                <div class="name">{{$orden_pedido->cliente->telefono_1}}</div>
                <div class="email"><a href="mailto:john@example.com">{{$orden_pedido->cliente->email_principal}}</a>
                </div>
                <div class="to">SUCURSAL:</div>
                <h2 class="name">{{$orden_pedido->sucursal->nombre_sucursal}}</h2>
            </div> --}}
            {{-- <div id="invoice"> --}}
                <table  class="tabla-factura">
                    <thead>
                        <tr>    
                            <th>FACTURA</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="num_factura">FB-00098897</td>
                        </tr>
                        <tr>
                            <td class="fecha">Fecha:      13/1/2020</td>
                        </tr>
                        <tr>
                            <td class="page">Pagina 1</td>
                        </tr>
                    </tbody>
                </table>

                {{-- <h1>{{$factura->no_factura}}</h1>
                <div class="date">Fecha: {{$factura->fecha}} </div>
                <div class="date">Fecha Entrega: </div> --}}
            {{-- </div> --}}
            {{-- <div id="client-orden">
                <div class="to">ORDEN PEDIDO:</div>
                @foreach ($ordenes_pedido as $orden)
                <h2 class="name">{{$orden->no_orden_pedido}}</h2>
                @endforeach
                <div class="date">Fecha: {{$orden_pedido->fecha}} </div>
                <div class="to">TERMINOS DE PAGO:</div>
                <div class="address">{{$orden_pedido->cliente->condiciones_credito}}</div>
                <div class="email"><a href="mailto:john@example.com"></a></div>
                <div class="to">SUCURSAL:</div>
                <h2 class="name"></h2>
            </div> --}}
        </div>
        @if ($factura->comprobante_fiscal == 1)
        <div id="invoice-fiscal">
            <h1>FACTURA VALIDA PARA CREDITO FISCAL</h1>
        </div>
        <br>
        <br>
        <br>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="desc">VENDEDOR</th>
                    <th class="unit">NCF</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="desc-fiscal">Carmen Herrera</td>
                    <td class="unit-fiscal">B01000001731</td>
                </tr>
            </tbody>
        </table>
        @endif

        <table border="0" cellspacing="0" cellpadding="0" class="tabla-principal" >
            <thead>
                <tr>
                    <th class="desc">CANT</th>
                    <th class="no">REFERENCIA</th>
                    <th class="unit">UPC/SKU</th>
                    <th class="desc">DESCRIPCION</th>
                    <th class="unit">PRECIO</th>
                    <th class="total">TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="desc">
                        @foreach ($orden_facturacion_detalle as $cantidad)
                        <li>{{$cantidad->total}}</li>
                        @endforeach
                    </td>
                    <td class="no">
                        @foreach ($productosFactura as $producto)
                        <li>{{$producto->referencia_producto}}</li>
                        @endforeach
                    </td>
                    <td class="unit">
                        @foreach ($sku as $barra)
                        @if ($barra->talla = "General")
                        <li>{{$barra->sku}}</li>
                        @endif
                        @break

                        @endforeach
                    </td>
                    <td class="desc-des">
                        @foreach ($productosFactura as $producto)
                        <li>{{$producto->descripcion}}</li>
                        @endforeach
                    </td>
                    <td class="unit">
                        @foreach ($orden_facturacion_detalle as $precio)
                        <li>{{$precio->precio}}</li>
                        @endforeach
                    </td>
                    <td class="total">
                        @foreach ($detalles_totales as $total)
                        <li>{{$total}} RD$</li>
                        @endforeach
                    </td>
                </tr>
            </tbody>
            {{-- <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">SUBTOTAL</td>
                    <td>{{number_format($subtotal)}} RD$</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">DESCUENTO {{$factura->descuento}}%</td>
                <td>{{number_format($descuento)}} RD$</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">IMPUESTO {{$factura->itbis}}%</td>
                <td>{{number_format($impuesto)}} RD$</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">TOTAL FINAL</td>
                <td>{{number_format($total_final)}} RD$</td>
            </tr>
            </tfoot> --}}
        </table>
        <div style="clear: fix;"> 
            <table border="0" cellspacing="0" cellpadding="0"  class="tabla-bultos">
                <thead>
                    <tr>
                        <th >TOTAL DE ARTICULOS:</th>
                        <th >FECHA:</th>
                    </tr>
                    <tr>
                        <th >CANTIDAD DE BULTOS:</th>
                        <th >HORA DE DESPACHO:</th>
                    </tr>
                
                </thead>
        
            </table>
       
            <table  class="tabla-totales">
             
                <tr>
                    
                    <td colspan="2">SUBTOTAL:</td>
                    <td>{{number_format($subtotal)}} RD$</td>
                </tr>
                <tr>
                    
                    <td colspan="2">DESCUENTO: {{$factura->descuento}}%</td>
                    <td>{{number_format($descuento)}} RD$</td>
                </tr>
                <tr>
                    <td colspan="2">IMPUESTO: {{$factura->itbis}}%</td>
                    <td>{{number_format($impuesto)}} RD$</td>
                </tr>
                <tr  class="total">
                    <td colspan="2">TOTAL FINAL:</td>
                    <td>{{number_format($total_final)}} RD$</td>
                </tr>
            </table>
        </div>
      

        @if ($factura->descuento <> 0)
            <div id="thanks">FACTURA CON EL DESCUENTO APLICADO</div>
            <div id="notices">
                <div>NOTAS:</div>
                <p class="notice">Cargo por cheque devuelto por falta de fonto o por firma discordante. Les sera cargado
                    a
                    los clientes un monto de RD$ 500.00
                    descuento por pronto pago que haya sido aprovechado por un cliente sera reevaluado si el cheque con
                    el
                    que realizo el pago
                    devuelto por las siguientes razones: falta de fondo, firma diferente.
                </p>
                <p class="notice">
                    Reclamos de Facturacion. El cliente acepta que para toda facturacion producida por CCH, las mismas
                    se
                    presumen como a
                    En caso que el Cliente entienda necesaria la realizacion de alguna observacion o rectificacion,
                    tanto en
                    los productos entre
                    a la factura enviada por CCH, este gozara de un plazo de (15) dias para la presentacion escria de la
                    misma en el Departamento de
                    operaciones.
                </p>
            </div>
            @endif


            <div class="firmas">
                <div class="firma_enviado">Preparado por:</div>
                <div class="firma_despachado">Despachado por:</div>
                <div class="firma_recibido">Recibido por:</div>
            </div>
    </main>
    <footer class="pagina1">
        Factura generada desde SistemaCCH.
    </footer>
    @if ($factura->orden_facturacion->por_transporte == 1)
    @for ($i = 0; $i < $bultos; $i++) <header class="clearfix">
        <div id="logo">
            <img src="{{asset('adminlte/img/LOGO_CCH-01.jpg')}}">
        </div>
        <div id="company">
            <h2 class="name">Confecciones Carmen Herrera</h2>
            <div>C/ Diego Tristan, casi esq. Ave. la pista<br /> Hainamosa, Santo Domingo Este</div>
            <div>(809) 699-8400</div>
            <div><a href="mailto:oper.cch.srl@gmail.com">oper.cch.srl@gmail.com</a></div>
        </div>
        </div>
        </header>
        <main>
            <div id="details" class="clearfix">
                <div id="client">
                    <div class="to">CONDUCE PARA:</div>
                    <h2 class="name">{{$orden_pedido->cliente->nombre_cliente}}</h2>
                    <div class="address">{{$orden_pedido->cliente->direccion_principal}}</div>
                    <div class="name">RNC:{{$orden_pedido->cliente->rnc}}</div>
                    <div class="name">{{$orden_pedido->cliente->telefono_1}}</div>
                    <div class="email"><a href="mailto:john@example.com">{{$orden_pedido->cliente->email_principal}}</a>
                    </div>
                    <div class="to">SUCURSAL:</div>
                    <h2 class="name">{{$orden_pedido->sucursal->nombre_sucursal}}</h2>
                </div>
                <div id="invoice">
                    <h1>{{$orden_pedido->no_orden_pedido}}</h1>
                    <div class="date">Fecha pedido: {{$orden_pedido->fecha}}</div>
                    <div class="date">Fecha Entrega: {{$orden_pedido->fecha_entrega}}</div>
                </div>
            </div>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr>
                        <th class="desc">CANT</th>
                        <th class="no">REFERENCIA</th>
                        <th class="unit">SKU</th>
                        <th class="desc">DESCRIPCION</th>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="desc">
                            @foreach ($orden_facturacion_detalle as $cantidad)
                            <li>{{$cantidad->total}}</li>
                            @endforeach
                        </td>
                        <td class="no">
                            @foreach ($productosFactura as $producto)
                            <li>{{$producto->referencia_producto}}</li>
                            @endforeach
                        </td>
                        <td class="unit">
                            @foreach ($sku as $barra)
                            @if ($barra->talla = "General")
                            <li>{{$barra->sku}}</li>
                            @endif

                            @break

                            @endforeach
                        </td>
                        <td class="desc-des">
                            @foreach ($productosFactura as $producto)
                            <li>{{$producto->descripcion}}</li>
                            @endforeach
                        </td>

                    </tr>
                </tbody>
            </table>
            <table border="0" cellspacing="0" cellpadding="0">
                <thead>
                    <tr style="font-size:5px;">
                        <th class="desc">Ref</th>
                        <th class="desc">A</th>
                        <th class="desc">B</th>
                        <th class="desc">C</th>
                        <th class="desc">D</th>
                        <th class="desc">E</th>
                        <th class="desc">F</th>
                        <th class="desc">G</th>
                        <th class="desc">H</th>
                        <th class="desc">I</th>
                        <th class="desc">J</th>
                        <th class="desc">K</th>
                        <th class="desc">L</th>
                        <th class="desc">Bultos</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orden_facturacion_detalle as $talla)
                    <tr>
                        <td class="unit_talla">{{$talla->producto->referencia_producto}}</td>
                        <td class="unit_talla">{{$talla->a}}</td>
                        <td class="unit_talla">{{$talla->b}}</td>
                        <td class="unit_talla">{{$talla->c}}</td>
                        <td class="unit_talla">{{$talla->d}}</td>
                        <td class="unit_talla">{{$talla->e}}</td>
                        <td class="unit_talla">{{$talla->f}}</td>
                        <td class="unit_talla">{{$talla->g}}</td>
                        <td class="unit_talla">{{$talla->h}}</td>
                        <td class="unit_talla">{{$talla->i}}</td>
                        <td class="unit_talla">{{$talla->j}}</td>
                        <td class="unit_talla">{{$talla->k}}</td>
                        <td class="unit_talla">{{$talla->l}}</td>
                        <td class="unit_talla">{{$talla->cant_bultos}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div id="thanks">Gracias!</div>
            <div id="notices">
                <div>NOTICE:</div>
                <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
            </div>
            <div class="firmas">
                <div class="firma_enviado">Enviado por:</div>
                <div class="firma_recibido">Recibido por:</div>
            </div>
        </main>
        <footer class="pagina1">
            Conduce generado desde SistemaCCH.
        </footer>
        @endfor
        @endif

</body>

</html>