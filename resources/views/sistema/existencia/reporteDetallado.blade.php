<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Conduce Orden Pedido</title>
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
            margin-bottom: 5px;
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
            margin-right: 47%;
        }

        #invoice-fiscal h1 {
            color: #000;
            font-size: 1.6em;
            line-height: 1em;
            font-weight: bold;
            margin-top: -17px;
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
            font-weight: bold;
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
            border: solid 2px black;
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
        .tabla-principal td.desc-des li,
        .tabla-principal td.qty li,
        .tabla-principal td.no li,
        .tabla-principal td.total li {
            list-style-type: none;
            text-align: center;
            /* padding-bottom: 350px; */
        }

        .tabla-principal li,
        .tabla-principal li,
        .tabla-principal li,
        .tabla-principal li,
        .tabla-principal li {
            list-style-type: none;
            text-align: center;
            /* padding-bottom: 350px; */
        }

        .tabla-principal td.desc-des li {
            /* font-size: 1.0em; */
            text-align: center;
            list-style-type: none;
            /* margin-bottom: 350px; */
            color: #000;
            /* padding: 0; */
            /* padding-right: 20px; */
        }

        .tabla-principal tbody tr:last-child td {
            /* border: none; */
            /* padding-bottom: 350px; */
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
            margin-top: 35px;
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

        /* footer {
			page-break-after: always;
		} */

        . .tabla-principal-totales {
            border: none;
        }

        .tabla-bultos {
            width: 50%;
            color: #000;
            float: left;
        }

        .tabla-bultos thead th {
            border: 2px solid black;
            padding: 5px;
            text-align: start;
        }

        .tabla-factura {
            float: right;
            width: 50%;
            border: 2px solid black;
            margin-right: 34%;
        }

        .tabla-factura thead .factura {
            font-weight: bolder;
            color: #000;
        }

        .tabla-factura th {
            font-size: 14px;
            /* padding-left: 19px;
			padding-right: 16px; */
            padding-top: 7px;
            text-align: center;
        }

        .tabla-factura tbody .num_factura {
            border-top: 2px solid black;
            border-bottom: 2px solid black;
            text-align: center;
            padding: 7px;
            font-size: 12px;
            color: #c85b5b;
        }

        .tabla-factura tbody .fecha {
            text-align: center;
            font-size: 10px;
            padding: 6px;
        }

        .tabla-factura tbody .page {
            text-align: center;
            font-size: 10px;
            padding: 10px;
            /* padding-bottom: 13px; */
            border-top: 2px solid black;

        }

        .tabla-totales {
            width: 40%;
            color: #000;
            float: right;
            margin-right: 10%;
        }

        .tabla-totales th {
            font-weight: normal;
            font-size: 14px;
        }

        .tabla-totales td {
            font-weight: normal;
            font-size: 12px;
        }

        .tabla-totales th .total {
            font-weight: bold;
            font-size: 15px;
        }

        .tabla-cliente {
            float: left;
            border-top: 2px solid black;
            border-left: 2px solid black;
            border-right: 2px solid black;
            width: 40%;


        }

        .tabla-cliente thead th {
            border-bottom: 2px solid black;
            font-size: 11px;
            padding-left: 11px;
        }

        .tabla-cliente thead td {
            border-bottom: 2px solid black;
            padding-left: 47px;
        }

        .tabla-cliente tbody td {
            border-bottom: 2px solid black;
            padding-right: 106px;
            padding-left: 11px;

        }

        .tabla-cliente tbody th {
            border-right: 2px solid black;
            border-bottom: 2px solid black;
            font-size: 11px;
            font-weight: bold;
            padding-left: 11px;
        }

        .tabla-cliente tbody .direccion {
            padding: 12px;
        }

        .tabla-original {
            float: right;
            margin-right: 20%;
            border: 2px solid black;
            width: 13%;
            margin-top: 20px;
            margin-bottom: 100px;
        }

        .tabla-original th {
            padding: 0px;
        }

        .tabla-ncf {
            width: 90%;
            /* border-collapse: collapse;
            border-spacing: 0; */
            margin-bottom: 20px;
            table-layout: auto;
            border: solid 2px black;
        }

        .tabla-ncf thead th {
            border-bottom: 2px solid black;
            /* border-left: 2px solid black */
            background-color: #131980;
            color: #fff;
            text-align: center;
            /* padding-left: 40px; */
            /* padding-right: 40px; */
            /* margin-left: 20px; */
        }

        .tabla-ncf tbody td {
            /* padding-left: 28px; */
            text-align: center;
            font-size: 12px;
            color: #000;
        }

        .tabla-ncf thead .op {
            /* padding-left: 5px; */
        }

        .tabla-ncf thead .terminos_pago {
            /* padding-left: 10px; */
        }

        .tabla-ncf thead .vencimiento {
            /* padding-left: 30px; */
        }

        .tabla-ncf thead .vendedor {
            /* padding-left: 20px;    */
        }

        .tabla-ncf thead .nfc_vence {
            /* padding-left: 50px; */
        }

        .tabla-ncf tbody .ncf {
            /* padding-left: 50px; */
            color: #c85b5b;
        }

        .tabla-ncf tbody .vencimiento {
            /* padding-left: 50px; */
            color: #c85b5b;
        }

        .tabla-bultos thead .hora_empaque {
            font-weight: lighter;
        }

        .tabla-bultos thead .total_articulos {
            font-weight: lighter;
        }

        .tabla-bultos thead .bultos {
            font-weight: lighter;
        }

        .tabla-bultos thead .fecha_factura {
            font-weight: lighter;
        }

        .tabla-tallas {
            width: 90%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
            table-layout: auto;
            border: solid 2px black;
        }

        .tabla-tallas th,
        .tabla-tallas td {
            /* padding: 20px; */
            background: #fff;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
            border: solid 1px black;
        }

        .tabla-tallas th {
            white-space: nowrap;
            font-weight: bold;
            background-color: #131980;
            font-size: 10px;
            border: solid 2px black;
            color: #fff;
        }

        .tabla-tallas .talla_head {
            color: #fff;
            font-size: 6.5px;
            border: none;
            border-left: solid 2px black;
        }

        .tabla-tallas .talla {
            border: 2px solid black;
            text-align: center;
            font-weight: bold;
            font-size: 8px;
        }

        .tabla-tallas tbody tr:last-child td {
            /* padding-bottom: 31px; */
        }
    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{asset('adminlte/img/LOGO_CCH-01.jpg')}}">
        </div>
        {{-- <div id="logo">
            <h1>CCH</h1>
        </div> --}}

        </div>
    </header>
    <main>

        <table border="0" cellspacing="0" cellpadding="0" class="tabla-tallas">
            <thead class="tabla-tallas">
                <tr>
                    <th class="talla_head"></th>
                    <th class="talla_head"></th>
                    <th class="talla_head"></th>
                    <td class="talla">12W</td>
                    <td class="talla">14W</td>
                    <td class="talla">16W</td>
                    <td class="talla">18W</td>
                    <td class="talla">20W</td>
                    <td class="talla">22W</td>
                    <td class="talla">24W</td>
                    <td class="talla">26W</td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                </tr>

                <tr>
                    <th class="talla_head"></th>
                    <th class="talla_head"></th>
                    <th class="talla_head"></th>
                    <td class="talla">0/0</td>
                    <td class="talla">1/2</td>
                    <td class="talla">3/4</td>
                    <td class="talla">5/6</td>
                    <td class="talla">7/8</td>
                    <td class="talla">9/10</td>
                    <td class="talla">11/12</td>
                    <td class="talla">13/14</td>
                    <td class="talla">15/16</td>
                    <td class="talla">17/18</td>
                    <td class="talla">19/20</td>
                    <td class="talla">21/22</td>
                    <td class="talla"></td>
                </tr>

                <tr>
                    <th class="talla_head">DEPTO</th>
                    <th class="talla_head">MARCA</th>
                    <th class="talla_head">REF</th>
                    <td class="talla">28</td>
                    <td class="talla">29</td>
                    <td class="talla">30</td>
                    <td class="talla">31</td>
                    <td class="talla">32</td>
                    <td class="talla">34</td>
                    <td class="talla">36</td>
                    <td class="talla">38</td>
                    <td class="talla">40</td>
                    <td class="talla">42</td>
                    <td class="talla">44</td>
                    <td class="talla"></td>
                    <th class="talla_head">TOTAL</th>
                </tr>

                <tr>
                    <th class="talla_head"></th>
                    <th class="talla_head"></th>
                    <th class="talla_head"></th>
                    <td class="talla">2</td>
                    <td class="talla">4</td>
                    <td class="talla">6</td>
                    <td class="talla">8</td>
                    <td class="talla">10</td>
                    <td class="talla">12</td>
                    <td class="talla">14</td>
                    <td class="talla">16</td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                </tr>

                <tr>
                    <th class="talla_head"></th>
                    <th class="talla_head"></th>
                    <th class="talla_head"></th>
                    <td class="talla">2</td>
                    <td class="talla">4</td>
                    <td class="talla">6</td>
                    <td class="talla">8</td>
                    <td class="talla">10</td>
                    <td class="talla">12</td>
                    <td class="talla">14</td>
                    <td class="talla">16</td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                    <td class="talla"></td>
                </tr>

            </thead>
            {{-- <thead>

            </thead> --}}
            <tbody>
                <tr>
                    <td>Produccion</td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        Mthos
                    </td>
                </tr>
                {{-- ForEach esta fila  --}}
                @foreach ($tallasCorte as $talla)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        {{$talla->producto->referencia_producto}}
                    </td>
                    <td>{{$talla->a}}</td>
                    <td>{{$talla->b}}</td>
                    <td>{{$talla->c}}</td>
                    <td>{{$talla->d}}</td>
                    <td>{{$talla->e}}</td>
                    <td>{{$talla->f}}</td>
                    <td>{{$talla->g}}</td>
                    <td>{{$talla->h}}</td>
                    <td>{{$talla->i}}</td>
                    <td>{{$talla->j}}</td>
                    <td>{{$talla->k}}</td>
                    <td>{{$talla->l}}</td>
                    <td></td>
                </tr>
                @endforeach
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                {{-- Aqui va el Subtotal --}}
                <tr style="font-weight:800;">
                    <td></td>
                    <td></td>
                    <td>
                        SUBTOTAL
                    </td>
                    <td>{{$a_sub_my}}</td>
                    <td>{{$b_sub_my}}</td>
                    <td>{{$c_sub_my}}</td>
                    <td>{{$d_sub_my}}</td>
                    <td>{{$e_sub_my}}</td>
                    <td>{{$f_sub_my}}</td>
                    <td>{{$g_sub_my}}</td>
                    <td>{{$h_sub_my}}</td>
                    <td>{{$i_sub_my}}</td>
                    <td>{{$j_sub_my}}</td>
                    <td>{{$k_sub_my}}</td>
                    <td>{{$l_sub_my}}</td>
                    <td>{{$total_sub_my}}</td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        Lavish
                    </td>
                </tr>
                @foreach ($tallasCorteLavish as $talla)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        {{$talla->producto->referencia_producto}}
                    </td>
                    <td>{{$talla->a}}</td>
                    <td>{{$talla->b}}</td>
                    <td>{{$talla->c}}</td>
                    <td>{{$talla->d}}</td>
                    <td>{{$talla->e}}</td>
                    <td>{{$talla->f}}</td>
                    <td>{{$talla->g}}</td>
                    <td>{{$talla->h}}</td>
                    <td>{{$talla->i}}</td>
                    <td>{{$talla->j}}</td>
                    <td>{{$talla->k}}</td>
                    <td>{{$talla->l}}</td>
                    <td></td>
                </tr>
                @endforeach
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                {{-- Aqui va el Subtotal --}}
                <tr style="font-weight:800;">
                    <td></td>
                    <td></td>
                    <td>
                        SUBTOTAL
                    </td>
                    <td>{{$a_sub_lav}}</td>
                    <td>{{$b_sub_lav}}</td>
                    <td>{{$c_sub_lav}}</td>
                    <td>{{$d_sub_lav}}</td>
                    <td>{{$e_sub_lav}}</td>
                    <td>{{$f_sub_lav}}</td>
                    <td>{{$g_sub_lav}}</td>
                    <td>{{$h_sub_lav}}</td>
                    <td>{{$i_sub_lav}}</td>
                    <td>{{$j_sub_lav}}</td>
                    <td>{{$k_sub_lav}}</td>
                    <td>{{$l_sub_lav}}</td>
                    <td>{{$total_sub_lav}}</td>
                </tr>
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr style="font-weight:800;">
                    <td></td>
                    <td></td>
                    <td>
                        SUBTOTAL
                    </td>
                    <td>{{$a_sub_prod}}</td>
                    <td>{{$b_sub_prod}}</td>
                    <td>{{$c_sub_prod}}</td>
                    <td>{{$d_sub_prod}}</td>
                    <td>{{$e_sub_prod}}</td>
                    <td>{{$f_sub_prod}}</td>
                    <td>{{$g_sub_prod}}</td>
                    <td>{{$h_sub_prod}}</td>
                    <td>{{$i_sub_prod}}</td>
                    <td>{{$j_sub_prod}}</td>
                    <td>{{$k_sub_prod}}</td>
                    <td>{{$l_sub_prod}}</td>
                    <td>{{$total_sub_prod}}</td>
                </tr>
                <tr>
                    <td>Lavanderia</td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        Mthos
                    </td>
                </tr>
                @foreach ($lavanderia as $lav)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                      {{$lav->producto->referencia_producto}}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$lav->total_enviado}}</td>

                </tr>
                @endforeach
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                {{-- Aqui va el Subtotal --}}
                <tr style="font-weight:800;">
                    <td></td>
                    <td></td>
                    <td>
                        SUBTOTAL
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$sub_lav_m}}</td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        Lavish
                    </td>
                </tr>
                </tr>
                @foreach ($lavanderia_lavish as $lav_lavish)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        {{$lav_lavish->producto->referencia_producto}}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$lav_lavish->total_enviado}}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>


                {{-- Aqui va el Subtotal --}}
                <tr style="font-weight:800;">
                    <td></td>
                    <td></td>
                    <td>
                        SUBTOTAL
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$sub_total_lav}}</td>
                </tr>
                <tr>
                    <td>Recepcion</td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        Mthos
                    </td>
                </tr>
                @foreach ($recepcion_mythos as $rec)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        {{$rec->producto->referencia_producto}}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$rec->total_recibido}}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                {{-- Aqui va el Subtotal --}}
                <tr style="font-weight:800;">
                    <td></td>
                    <td></td>
                    <td>
                        SUBTOTAL
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$sub_rec_m}}</td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        Lavish
                    </td>
                </tr>
                @foreach ($recepcion_lavish as $rec_lav)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        {{$rec_lav->producto->referencia_producto}}
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$rec_lav->total_recibido}}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                {{-- Aqui va el Subtotal --}}
                <tr style="font-weight:800;">
                    <td></td>
                    <td></td>
                    <td>
                        SUBTOTAL
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$sub_total_rec}}</td>
                </tr>
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                {{-- Aqui va el Subtotal --}}
                <tr style="font-weight:800;">
                    <td></td>
                    <td></td>
                    <td>
                        SUBTOTAL
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$sub_total_rec}}</td>
                </tr>
                <tr>
                    <td>Almacen</td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        Mthos
                    </td>
                </tr>
                @foreach ($almacen_mythos as $alm_m)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        {{$alm_m->referencia_producto}}
                    </td>
                    <td>{{$alm_m->a }}</td>
                    <td>{{$alm_m->b}}</td>
                    <td>{{$alm_m->c}}</td>
                    <td>{{$alm_m->d}}</td>
                    <td>{{$alm_m->e}}</td>
                    <td>{{$alm_m->f}}</td>
                    <td>{{$alm_m->g}}</td>
                    <td>{{$alm_m->h}}</td>
                    <td>{{$alm_m->i}}</td>
                    <td>{{$alm_m->j}}</td>
                    <td>{{$alm_m->k}}</td>
                    <td>{{$alm_m->l}}</td>
                    <td>{{$alm_m->total}}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                {{-- Aqui va el Subtotal --}}
                <tr style="font-weight:800;">
                    <td></td>
                    <td></td>
                    <td>
                        SUBTOTAL
                    </td>
                    <td>{{$a_alm_m}}</td>
                    <td>{{$b_alm_m}}</td>
                    <td>{{$c_alm_m}}</td>
                    <td>{{$d_alm_m}}</td>
                    <td>{{$e_alm_m}}</td>
                    <td>{{$f_alm_m}}</td>
                    <td>{{$g_alm_m}}</td>
                    <td>{{$h_alm_m}}</td>
                    <td>{{$i_alm_m}}</td>
                    <td>{{$j_alm_m}}</td>
                    <td>{{$k_alm_m}}</td>
                    <td>{{$l_alm_m}}</td>
                    <td>{{$total_alm_m}}</td>
                </tr>
                <tr>
                    <td>

                    </td>
                    <td>
                        Lavish
                    </td>
                </tr>
                @foreach ($almacen_lavish as $alm_l)
                <tr>
                    <td></td>
                    <td></td>
                    <td>
                        {{$alm_l->referencia_producto}}
                    </td>
                    <td>{{$alm_l->a}}</td>
                    <td>{{$alm_l->b}}</td>
                    <td>{{$alm_l->c}}</td>
                    <td>{{$alm_l->d}}</td>
                    <td>{{$alm_l->e}}</td>
                    <td>{{$alm_l->f}}</td>
                    <td>{{$alm_l->g}}</td>
                    <td>{{$alm_l->h}}</td>
                    <td>{{$alm_l->i}}</td>
                    <td>{{$alm_l->j}}</td>
                    <td>{{$alm_l->k}}</td>
                    <td>{{$alm_l->l}}</td>
                    <td>{{$alm_l->total}}</td>
                </tr>
                @endforeach
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                {{-- Aqui va el Subtotal --}}
                <tr style="font-weight:800;">
                    <td></td>
                    <td></td>
                    <td>
                        SUBTOTAL
                    </td>
                    <td>{{$a_alm_l}}</td>
                    <td>{{$b_alm_l}}</td>
                    <td>{{$c_alm_l}}</td>
                    <td>{{$d_alm_l}}</td>
                    <td>{{$e_alm_l}}</td>
                    <td>{{$f_alm_l}}</td>
                    <td>{{$g_alm_l}}</td>
                    <td>{{$h_alm_l}}</td>
                    <td>{{$i_alm_l}}</td>
                    <td>{{$j_alm_l}}</td>
                    <td>{{$k_alm_l}}</td>
                    <td>{{$l_alm_l}}</td>
                    <td>{{$total_alm_l}}</td>
                </tr>
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td style="color:#fff;">test</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                {{-- Aqui va el Subtotal --}}
                <tr style="font-weight:800;">
                    <td></td>
                    <td></td>
                    <td>
                        SUBTOTAL
                    </td>
                    <td>{{$a_sub_alm}}</td>
                    <td>{{$b_sub_alm}}</td>
                    <td>{{$c_sub_alm}}</td>
                    <td>{{$d_sub_alm}}</td>
                    <td>{{$e_sub_alm}}</td>
                    <td>{{$f_sub_alm}}</td>
                    <td>{{$g_sub_alm}}</td>
                    <td>{{$h_sub_alm}}</td>
                    <td>{{$i_sub_alm}}</td>
                    <td>{{$j_sub_alm}}</td>
                    <td>{{$k_sub_alm}}</td>
                    <td>{{$l_sub_alm}}</td>
                    <td>{{$total_sub_alm}}</td>
                </tr>
                {{-- Aqui va el Grantotal --}}
                <tr style="font-weight:800; line-height: 45px;">
                    <td>GRAN TOTAL</td>
                    <td></td>
                    <td></td>
                    <td>{{$a_total}}</td>
                    <td>{{$b_total}}</td>
                    <td>{{$c_total}}</td>
                    <td>{{$d_total}}</td>
                    <td>{{$e_total}}</td>
                    <td>{{$f_total}}</td>
                    <td>{{$g_total}}</td>
                    <td>{{$h_total}}</td>
                    <td>{{$i_total}}</td>
                    <td>{{$j_total}}</td>
                    <td>{{$k_total}}</td>
                    <td>{{$l_total}}</td>
                    <td>{{$total_reporte}}</td>
                </tr>
            </tbody>
        </table>
        {{--
		<table border="0" cellspacing="0" cellpadding="0" class="tabla-principal">
			<thead>
				<tr>
					<th class="desc">CANT</th>
					<th class="no">REFERENCIA</th>
					<th class="desc">DESCRIPCION</th>
					<th class="unit">PRECIO</th>
					<th class="total">TOTAL</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="desc">

					</td>
					<td class="no">

					</td>
					<td class="desc-des">

					</td>
					<td class="unit">

					</td>
					<td class="total">

					</td>
				</tr>
			</tbody>

		</table> --}}

    </main>
    <footer class="pagina1">
        Reporte generado desde SistemaCCH.
    </footer>

</body>

</html>
