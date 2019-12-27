<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Condude Orden de pedido</title>
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

        h2.name {
            font-size: 1.2em;
            font-weight: normal;
            margin: 0;
        }

        #invoice {
            float: right;
            text-align: right;
            margin-right: 48%;
        }

        #invoice_proceso {
            float: right;
            text-align: right;
            margin-right: 48%;
        }

        #invoice_proceso li {
            list-style-type: none;
        }

        #invoice h1 {
            color: #0087C3;
            font-size: 2.2em;
            line-height: 1em;
            font-weight: normal;
            margin: 0 0 10px 0;
        }

        #invoice-fiscal {
            float: right;
            text-align: right;
            margin-right: 52%;
        }

        #invoice-fiscal h1 {
            color: #0087C3;
            font-size: 1.6em;
            line-height: 1em;
            font-weight: bold;
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
            font-weight: bold;

        }

        table td {
            text-align: right;
        }

        table td h3 {
            color: #57B223;
            font-size: 1.2em;
            font-weight: normal;
            margin: 0 0 0.2em 0;
        }

        table .no {
            color: #FFFFFF;
            font-size: 13px;
            background: #57B223;
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

        table .unit_talla {
            background: #DDDDDD;
            text-align: center;
            font-size: 9.5px;
        }

        table th.qty {
            font-size: 1.2em;
            font-weight: bold;
        }

        table .total {
            background: #57B223;
            color: #FFFFFF;
        }

        table td.unit,
        table td.desc,
        table td.qty,
        table td.no,
        table td.total {
            font-size: 1.2em;
            text-align: center;

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
            color: #57B223;
            font-size: 1.4em;
            border-top: 1px solid #57B223;

        }

        table tfoot tr td:first-child {
            border: none;
        }

        #thanks {
            font-size: 2em;
            margin-bottom: 50px;
        }

        #notices {
            padding-left: 6px;
            border-left: 6px solid #0087C3;
        }

        #notices .notice {
            font-size: 1.2em;
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
            margin-top: 130px;
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
        table .tabla-tallas th{
            font-size: 8px;
        }


        .pagina1 {
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
            <div id="invoice">
                <h1>{{$perdida->no_perdida}}</h1>
                <div class="date">Fecha perdida: {{date("d-m-20y", strtotime($perdida->fecha))}}</div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="unit">REFERENCIA</th>
                    <th class="desc">FECHA</th>
                    <th class="unit">TIPO PERDIDA</th>
                    <th class="qty">FASE</th>
                    <th class="unit">MOTIVO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="unit">
                        <p>{{$perdida->producto->referencia_producto}}</p>
                    </td>
                    <td class="desc">
                        {{date("d-m-20y", strtotime($perdida->fecha))}}
                    </td>
                    <td class="unit">
                        <p>{{$perdida->tipo_perdida}}</p>
                    </td>
                    <td class="qty">
                        <p>{{$perdida->fase}}</p>
                    </td>
                    <td class="unit">
                        <p>{{$perdida->motivo}}</p>
                    </td>
                </tr>
            </tbody>
            {{-- <tfoot>
				<tr>
					<td colspan="2"></td>
					<td colspan="2">SUBTOTAL</td>
					<td>${{number_format($subtotal)}}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">IMPUESTO 18%</td>
                <td>${{number_format($tax)}}</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td colspan="2">TOTAL FINAL</td>
                <td>${{number_format($total)}}</td>
            </tr>
            </tfoot> --}}
        </table>
        <table border="0" cellspacing="0" cellpadding="0" class="tabla-tallas">
            <thead>
                @if ($genero == 2)
                @if ($genero_plus == 7)
                <tr>
                    <th class="unit_talla">12W</th>
                    <th class="unit_talla">14W</th>
                    <th class="unit_talla">16W</th>
                    <th class="unit_talla">18W</th>
                    <th class="unit_talla">20W</th>
                    <th class="unit_talla">22W</th>
                    <th class="unit_talla">24W</th>
                    <th class="unit_talla">26W</th>
                    <th class="unit_talla">I</th>
                    <th class="unit_talla">J</th>
                    <th class="unit_talla">K</th>
                    <th class="unit_talla">L</th>
                    <th class="unit_talla">X</th>
                </tr>
                @else
                <tr>
                    <th class="unit_talla">0/0</th>
                    <th class="unit_talla">1/2</th>
                    <th class="unit_talla">3/4</th>
                    <th class="unit_talla">5/6</th>
                    <th class="unit_talla">7/8</th>
                    <th class="unit_talla">9/10</th>
                    <th class="unit_talla">11/12</th>
                    <th class="unit_talla">13/14</th>
                    <th class="unit_talla">15/16</th>
                    <th class="unit_talla">17/18</th>
                    <th class="unit_talla">19/20</th>
                    <th class="unit_talla">21/22</th>
                    <th class="unit_talla">X</th>
                </tr>
                @endif
                @endif
                @if ($genero == 1)
                <tr>
                    <th class="unit_talla">28</th>
                    <th class="unit_talla">29</th>
                    <th class="unit_talla">30</th>
                    <th class="unit_talla">31</th>
                    <th class="unit_talla">32</th>
                    <th class="unit_talla">34</th>
                    <th class="unit_talla">36</th>
                    <th class="unit_talla">38</th>
                    <th class="unit_talla">40</th>
                    <th class="unit_talla">42</th>
                    <th class="unit_talla">44</th>
                    <th class="unit_talla">L</th>
                    <th class="unit_talla">X</th>
                </tr>
                @endif
                @if ($genero == 3)
                <tr>
                    <th class="unit_talla">2</th>
                    <th class="unit_talla">4</th>
                    <th class="unit_talla">6</th>
                    <th class="unit_talla">8</th>
                    <th class="unit_talla">10</th>
                    <th class="unit_talla">12</th>
                    <th class="unit_talla">14</th>
                    <th class="unit_talla">16</th>
                    <th class="unit_talla">I</th>
                    <th class="unit_talla">J</th>
                    <th class="unit_talla">K</th>
                    <th class="unit_talla">L</th>
                    <th class="unit_talla">X</th>
                </tr>
                    
                @endif
                @if ($genero == 4)
                <tr>
                    <th class="unit_talla">2</th>
                    <th class="unit_talla">4</th>
                    <th class="unit_talla">6</th>
                    <th class="unit_talla">8</th>
                    <th class="unit_talla">10</th>
                    <th class="unit_talla">12</th>
                    <th class="unit_talla">14</th>
                    <th class="unit_talla">16</th>
                    <th class="unit_talla">I</th>
                    <th class="unit_talla">J</th>
                    <th class="unit_talla">K</th>
                    <th class="unit_talla">L</th>
                    <th class="unit_talla">X</th>
                </tr>
                    
                @endif

            </thead>
            <tbody>
                @foreach ($detalle as $talla)
                <tr>
                    <td class="desc">
                        @if ($talla->a == 0)

                        @else
                        {{$talla->a}}
                        @endif
                    </td>
                    <td class="desc">
                        @if ($talla->b == 0)
                        @else
                        {{$talla->b}}
                        @endif
                    </td>
                    <td class="desc">
                        @if ($talla->c == 0)

                        @else
                        {{$talla->c}}
                        @endif
                    </td>
                    <td class="desc">
                        @if ($talla->d == 0)

                        @else
                        {{$talla->d}}
                        @endif
                    </td>
                    <td class="desc">
                        @if ($talla->e == 0)

                        @else
                        {{$talla->e}}
                        @endif
                    </td>
                    <td class="desc">
                        @if ($talla->f == 0)

                        @else
                        {{$talla->f}}
                        @endif
                    </td>
                    <td class="desc">
                        @if ($talla->g == 0)

                        @else
                        {{$talla->g}}
                        @endif
                    </td>
                    <td class="desc">
                        @if ($talla->h == 0)

                        @else
                        {{$talla->h}}
                        @endif
                    </td>
                    <td class="desc">
                        @if ($talla->i == 0)

                        @else
                        {{$talla->i}}
                        @endif
                    </td>
                    <td class="desc">
                        @if ($talla->j == 0)

                        @else
                        {{$talla->j}}
                        @endif
                    </td>
                    <td class="desc">
                        @if ($talla->k == 0)

                        @else
                        {{$talla->k}}
                        @endif

                    </td>
                    <td class="desc">
                        @if ($talla->l == 0)

                        @else
                        {{$talla->l}}
                        @endif
                    </td>
                    <td class="desc">
                        @if ($talla->talla_x == 0)

                        @else
                        {{$talla->talla_x}}
                        @endif
                    </td>
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
        Documento generado desde SistemaCCH.
    </footer>
</body>

</html>