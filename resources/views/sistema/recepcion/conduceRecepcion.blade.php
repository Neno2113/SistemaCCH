<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Conduce Recepcion</title>
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
            /* margin-bottom: 20px; */
            /* border-bottom: 1px solid #AAAAAA; */
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
            margin-bottom: 10px;
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
            margin-bottom: 5px;
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
            /* background-color: #131980; */
            font-size: 8.5px;
            padding: 5px;
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
            /* color: #fff; */
            font-size: 13px;
            /* background: #160c70; */
            text-align: center;
            border: solid 2px black;

        }

        .tabla-principal .desc {
            text-align: center;
            font-size: 13px;
            /* color: #fff; */
            border: solid 2px black;

        }

        .tabla-principal .unit {
            /* background-color: #160c70; */
            font-size: 13px;
            /* color: #fff; */
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
            font-size: 10px;
            font-weight: bold;
            border: solid 2px black;
            padding-left: 15px;
            padding-right: 12px;
            /* border: solid 2px black; */
        }

        .tabla-principal .qty {}

        .tabla-principal .total {
            /* background: #fff; */
            /* color: #fff; */
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
            padding-bottom: 350px;
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
            color: #0087C3;
            font-size: 1.4em;
            border-top: 1px solid #0087C3;
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

        .tabla-tallas {
            width: 83%;
            border-collapse: collapse;
            border-spacing: 0;
            /* margin-bottom: 20px; */
            table-layout: auto;
            border: solid 2px black;
        }

        .tabla-tallas th,
        .tabla-tallas td {
            /* padding: 20px; */
            background: #fff;
            text-align: center;
            border-bottom: 1px solid #FFFFFF;
            /* border: solid 2px black; */
        }

        .tabla-tallas th {
            white-space: nowrap;
            font-weight: bold;
            background-color: #131980;
            font-size: 10px;
            /* border: solid 2px black; */
        }

        .tabla-tallas .talla_head {
            color: #fff;
            font-size: 6.5px;
        }

        .tabla-tallas .talla {
            border: 2px solid black;
            text-align: center;
            font-weight: bold;
            font-size: 8px;
        }

        .firmas {
            margin-top: 35px;
            text-align: center;
            font-weight: bold;
            color: #000;
            /* padding-top: 200px */
        }

        .firma_enviado {
            float: left;
            border-top: 1px solid black;
            width: 19%;
            font-size: 13px;
        }

        .firma_despachado {
            float: right;
            border-top: 1px solid black;
            margin-right: 49%;
            width: 19%;
            font-size: 13px;
        }

        .firma_recibido {
            float: left;
            border-top: 1px solid black;
            margin-left: 50%;
            width: 15%;
        }

        .tabla-principal-totales {
            border: none;
        }

        .tabla-bultos {
            width: 50%;
            color: #000;
            float: left;
        }

        .tabla-bultos thead th {
            /* border: 2px solid black; */
            padding: 5px;
            text-align: start;
        }

        .tabla-factura {
            float: right;
            width: 40%;
            /* border: 1px solid black; */
            margin-right: 10%;
            padding-top: 5px;
        }

        .tabla-factura thead .factura {
            font-weight: bolder;
            color: #000;
        }

        .tabla-factura th {
            font-size: 14px;
            /* padding-left: 15px;
            padding-right: 16px; */
            /* padding-top: 7px; */
            text-align: right;
        }

        .tabla-factura td {
            font-size: 12px;
            padding-left: 19px;
            /* padding-right: 16px; */
            /* padding-top: 7px; */
            text-align: left;
        }


        .tabla-factura tbody .num_factura {
            /* border-top: 2px solid black;
            border-bottom: 2px solid black; */
            /* text-align: center; */
            font-size: 12px;
            color: #c85b5b;
        }
        .tabla-factura thead .num_factura {
            /* color: #c85b5b; */
            font-size: 14px;
            font-weight: bolder;
        }

        .tabla-factura tbody .fecha {
            text-align: center;
            font-size: 10px;
            padding: 6px;
        }

        .tabla-factura tbody .page {
            text-align: center;
            font-size: 10px;
            /* padding: 11px; */
            /* border-top: 2px solid black; */

        }

        .tabla-totales {
            width: 28%;
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
            font-size: 14px;
        }

        .tabla-totales th .total {
            font-weight: bold;
            font-size: 15px;
        }

        .tabla-cliente {
            float: left;
            border-top: 1px solid black;
            border-left: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            width: 30%;
            padding-top: 8%;


        }

        .tabla-cliente thead th {
            border-bottom: 1px solid black;
            font-size: 11px;
            padding: 5px;
            text-align: center;
            font-size: 15px;
        }

        .tabla-cliente thead td {
            border-bottom: 1px solid black;
            padding-left: 47px;
        }

        .tabla-cliente tbody td {
            /* border-bottom: 1px solid black; */
            padding-right: 106px;
            padding-left: 9px;
            font-size: 12px;
            padding-top: 1px;
            color: #000000b0;
            /* padding-bottom: 9px; */
        }

        .tabla-cliente tbody th {
            /* border-right: 1px solid black;
            border-bottom: 1px solid black; */
            font-size: 11px;
            font-weight: bold;
            padding-left: 11px;
        }

        .tabla-cliente tbody .direccion {
            padding-right: 17px;
            color:#000000a6;;
            font-size: 12px;
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
            width: 75%;
            /* border-collapse: collapse;
            border-spacing: 0; */
            margin-bottom: 20px;
            table-layout: auto;
            border: solid 1px black;
        }

        .tabla-ncf thead th {
            border-bottom: 1px solid black;
            border-left: 1px solid black;
            /* background-color: #131980; */
            /* color: #fff; */
            text-align: center;
            /* padding-left: 40px; */
            /* padding-right: 40px; */
            /* margin-left: 20px; */
            padding: 5px;
            font-size: 15px;
        }

        .tabla-ncf tbody td {
            /* padding-left: 28px; */
            text-align: center;
            font-size: 12px;
            color: #000;
            border-left: 1px solid black;
            padding: 5px;
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

        .main-h5 {
            text-align: center;
            font-weight: bolder;
            font-size: 30px;
            border-bottom: 1px solid #AAAAAA;
        }
    </style>
</head>

<body>
    <header class="">
        <h5 class="main-h5">CONDUCE RECEPCION DE LAVANDERIA</h5>
    </header>
    <main>
        {{-- <h5 class="main-h5">CONDUCE DE ENTREGA A LAVANDERIA</h5>
        <hr> --}}
        <div id="details" class="clearfix">
            <table border="0" cellspacing="0" cellpadding="0" class="tabla-cliente">
                <thead class="cod">
                    <tr>
                        <th>Enviado a</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$lavanderia->suplidor->nombre}}</td>
                    </tr>
                    <tr>
                        <td class="direccion">{{$lavanderia->suplidor->calle}}, {{$lavanderia->suplidor->sector}}
                            {{$lavanderia->suplidor->provincia}} {{$lavanderia->suplidor->sitios_cercanos}}</td>

                    </tr>
                    <tr>
                        <td>{{$lavanderia->suplidor->telefono_1}}</td>
                    </tr>
                    <tr>
                        <td>{{$lavanderia->suplidor->rnc}}</td>
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
        <table class="tabla-factura">
            <thead>
                <tr>
                    <th class="factura">Conduce Recepcion</th>
                    <td class="num_factura">{{$recepcion->numero_recepcion}}</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th class="factura">Fecha:</th>
                    <td class="num_factura">{{$recepcion->fecha_recepcion}}</td>
                </tr>
                <tr>
                    <th class="factura">Pagina </th>
                    <td>1</td>
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

        {{-- <table    class="tabla-original">
                <thead>
                    <tr>
                        <th>Original:</th>
                    </tr>
                    <tr>
                        <th>Copia:</th>
                    </tr>
                </thead>

            </table> --}}

        </div>

        <table cellspacing="0" class="tabla-ncf">
            <thead>
                <tr>
                    <th class="op">Codigo suplidor</th>
                    <th class="terminos_pago">Enviado con</th>
                    <th class="">Enviado por</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$lavanderia->suplidor->codigo_suplidor}}</td>
                    <td>Chofer</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <table border="0" cellspacing="0" cellpadding="0" class="tabla-principal">
            <thead>
                <tr>
                    <th class="desc">CORTE</th>
                    <th class="no">REFERENCIA</th>
                    <th class="desc">ESTANDAR</th>
                    <th class="unit">CANT REC.</th>
                    <th class="unit">TOTAL REC.</th>
                    <th class="total">CANT PEND.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="desc">
                        <li>{{$lavanderia->corte->numero_corte}}</li>
                    </td>
                    <td class="unit">
                        @if (!empty($lavanderia->producto->referencia_producto_2))
                        <li>{{$lavanderia->producto->referencia_producto}} -
                            {{$lavanderia->producto->referencia_producto_2}}</li>
                        @else
                        <li>{{$lavanderia->producto->referencia_producto}}</li>
                        @endif

                    </td>
                    <td class="desc">
                        @if ($recepcion->estandar_recibido == 1)
                        Si
                        @else
                        No
                        @endif
                    </td>
                    <td class="total">
                        <li>{{$recepcion->recibido_parcial}}</li>
                    </td>
                    <td class="total">
                        <li>{{$recepcion->total_recibido}}</li>
                    </td>
                    <td class="total">
                        <li>{{$recepcion->pendiente}}</li>
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
            <table border="0" cellspacing="0" cellpadding="0" class="tabla-bultos">
                <thead>
                    <tr>
                        <th>

                            @if ($recepcion->estandar_recibido  == 1)
                            ESTANDAR RECIBIDO: <span class="total_articulos"> Si</span>
                            @else
                            ESTANDAR RECIBIDO: <span class="total_articulos">No</span>
                            @endif

                        </th>
                        <th>
                            ENVIO NUEVO: <span class="total_articulos"> Si</span>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            ENVIO REPARACION: <span class="total_articulos"> No</span>
                        </th>
                        <th>
                            ENVIO REPARADA: <span class="total_articulos"> No</span>
                        </th>
                    </tr>

                </thead>

            </table>

            <table class="tabla-totales">
                <tr class="total">
                    <th style="font-weight:bold;">TOTAL</th>
                    <td >{{$lavanderia->total_enviado}}</td>
                </tr>
            </table>
        </div>




        <div class="firmas" style="padding-top: 100px ">
            <div class="firma_enviado">Enviado por:</div>
            <div class="firma_despachado">Recibido por:</div>
        </div>


    </main>
    <footer class="pagina1">
        Conduce generado desde SistemaCCH.
    </footer>


</body>

</html>
