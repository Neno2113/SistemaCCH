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
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #AAAAAA;
            margin-right: 8%;
        }

        #logo {
            float: left;
            margin-top: 8px;
        }

        #logo img {
            height: 60px;
        }

        #company {
            float: right;
            text-align: right;
            margin-right: 40%;
        }


        #details {
            margin-bottom: 50px;
        }

        #client {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
            float: left;
        }

        #client .to {
            color: #777777;
        }

        #client-orden {
            padding-left: 6px;
            /* border-left: 6px solid #0087C3;
            border-bottom: 6px solid #0087C3; */
            padding: 5px;
            float: left;
            margin-left: 20%;
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
            margin-right: 50%;
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
            color: #0087C3;
            font-size: 2.2em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice_proceso h1 {
            color: #0087C3;
            font-size: 2.2em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice .date {
            font-size: 1.1em;
            color: #777777;
        }

        #invoice_proceso .date {
            font-size: 1.1em;
            color: #777777;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
            table-layout: auto;
        }

        table th,
        table td {
            padding: 20px;
            background: #EEEEEE;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
        }

        table th {
            white-space: nowrap;
            font-weight: normal;
        }

        table td {
            text-align: right;
        }

        table td h3 {
            color: #2A8EAC;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 13px;
            background: #2A8EAC;
            text-align: center;

        }

        table .desc {
            text-align: center;
            font-size: 13px;

        }

        table .unit {
            background: #DDDDDD;
            font-size: 13px;
        }

        table .unit-fiscal {
            background: #DDDDDD;
            font-size: 13px;
        }

        table .unit_talla {
            background: #DDDDDD;
            text-align: center;
            font-size: 11px;
        }

        table .qty {}

        table .total {
            background: #2A8EAC;
            color: #FFFFFF;
            font-size: 13px;
        }

        table td.unit,
        table td.desc,
        table td.qty,
        table td.no,
        table td.total {
            font-size: 1.2em;
            /* text-decoration: none; */
        }

        table td.unit-fiscal,
        table td.desc-fiscal {
            font-size: 1.2em;
            text-align: center;
        }

        table td.unit li,
        table td.desc li,
        table td.qty li,
        table td.no li,
        table td.total li {
            list-style-type: none;
            text-align: center;
            padding: 0;
        }

        table td.desc-des li {
            font-size: 1.0em;
            text-align: center;
            list-style-type: none;
            padding: 0;
            /* padding-right: 20px; */
        }

        table tbody tr:last-child td {
            border: none;
        }

        table tfoot td {
            padding: 10px 20px;
            background: #FFFFFF;
            border-bottom: none;
            font-size: 1.2em;
            white-space: nowrap;
            border-top: 1px solid #AAAAAA;
        }

        table tfoot tr:first-child td {
            border-top: none;
        }

        table tfoot tr:last-child td {
            color: #0087C3;
            font-size: 1.4em;
            border-top: 1px solid #0087C3;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 20px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1.2em;
            width: 90%;
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
        </div>
        </div>
    </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client">
                <div class="to">FACTURA PARA:</div>
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
                <h1>{{$factura->no_factura}}</h1>
                <div class="date">Fecha: {{$factura->fecha}} </div>
                {{-- <div class="date">Fecha Entrega: </div> --}}
            </div>
            <div id="client-orden">
                <div class="to">ORDEN PEDIDO:</div>
                @foreach ($ordenes_pedido as $orden)
                <h2 class="name">{{$orden->no_orden_pedido}}</h2>
                @endforeach
                <div class="date">Fecha: {{$orden_pedido->fecha}} </div>
                <div class="to">TERMINOS DE PAGO:</div>
                <div class="address">{{$orden_pedido->cliente->condiciones_credito}}</div>
                <div class="email"><a href="mailto:john@example.com"></a></div>
                {{-- <div class="to">SUCURSAL:</div>
                <h2 class="name"></h2> --}}
            </div>
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

        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="desc">CANT</th>
                    <th class="no">REFERENCIA</th>
                    <th class="unit">SKU</th>
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
                        <li>{{$total}}</li>
                        @endforeach
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">SUBTOTAL</td>
                    <td>{{number_format($subtotal)}}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">DESCUENTO {{$factura->descuento}}%</td>
                    <td>{{number_format($descuento)}}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">IMPUESTO {{$factura->itbis}}%</td>
                    <td>{{number_format($impuesto)}}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2">TOTAL FINAL</td>
                    <td>{{number_format($total_final)}}</td>
                </tr>
            </tfoot>
        </table>

        @if ($factura->descuento <> 0)
            <div id="thanks">FACTURA CON EL DESCUENTO APLICADO!</div>
            <div id="notices">
                <div>NOTAS:</div>
                <p class="notice">Cargo por cheque devuelto por falta de fonto o por firma discordante. Les sera cargado
                    a
                    los clientes un monto de RD$ 500.
                    descuent por pronto pago que haya sido aprovechado por un cliente sera reevaluado si el cheque con
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