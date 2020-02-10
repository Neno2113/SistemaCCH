<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>ORDEN EMPAQUE</title>
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

		.tabla-principal th,
		.tabla-principal td {
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

		.tabla-principal th {
			white-space: nowrap;
			font-weight: bold;
			background-color: #131980;
			font-size: 8.5px;
			padding: 5px;
			/* border: solid 2px black; */
			/* padding-right: 37px; */
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
			font-size: 10px;
			font-weight: bold;
			border: solid 2px black;
			padding-left: 15px;
			padding-right: 12px;
			/* width: 21.95px; */
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

		.tabla-principal tbody td {}

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

		footer {
			page-break-after: always;
		}

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

		.tabla-bultos tbody td {
			border: 2px solid black;
			text-align: center;
		}

		.tabla-factura {
			float: right;
			width: 50%;
			border: 2px solid black;
			margin-right: 30%;
		}

		.tabla-factura thead .factura {
			font-weight: bolder;
			color: #000;
			font-size: 11px;
		}

		.tabla-factura th {
			font-size: 15px;
			/* padding-left: 19px;
			padding-right: 16px; */
			padding-top: 7px;
			text-align: center;
		}

		.tabla-factura tbody .num_factura {
			border-top: 2px solid black;
			border-bottom: 2px solid black;
			text-align: center;
			font-size: 12px;
			color: #c85b5b;
		}

		.tabla-factura tbody .fecha {
			text-align: center;
			font-size: 10px;
			padding: 10px;
		}

		.tabla-factura tbody .page {
			text-align: center;
			font-size: 10px;
			padding: 11px;
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
			<table border="0" cellspacing="0" cellpadding="0" class="tabla-cliente">
				<thead class="cod">
					<tr>
						<th>Cliente codigo</th>
						<td>Cod</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Nombre</th>
						<td>{{$orden->cliente->nombre_cliente}}</td>
					</tr>
					<tr>
						<th class="direccion">Direccion</th>
						<td class="direccion">{{$orden->cliente->calle}}, {{$orden->cliente->sector}}
							{{$orden->cliente->provincia}}, {{$orden->cliente->sitios_cercanos}}<</td> </tr> <tr>
						<th>Sucursal</th>
						<td>{{$orden->sucursal->nombre_sucursal}}</td>
					</tr>
					<tr>
						<th>Tel</th>
						<td>{{$orden->cliente->telefono_1}}</td>
					</tr>
					<tr>
						<th>RNC</th>
						<td>{{$orden->cliente->rnc}}</td>
					</tr>
				</tbody>

			</table>

			<table class="tabla-factura">
				<thead>
					<tr>
						<th class="factura">ORDEN EMPAQUE</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td class="num_factura">{{$orden_empaque->no_orden_empaque}}</td>
					</tr>
					<tr>
						<td class="fecha">Fecha Imp:{{$orden_empaque->fecha}}</td>
					</tr>
					<tr>
						<td class="page">Pagina 1</td>
					</tr>
				</tbody>
			</table>



		</div>

		<table cellspacing="0" class="tabla-ncf">
			<thead>
				<tr>
					<th class="op">ORDEN PEDIDO</th>
					<th class="terminos_pago">FECHA PEDIDO</th>
					<th class="">FECHA ENTREGA</th>
					<th class="vendedor">VENDEDOR</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td> {{$orden->no_orden_pedido}}</td>
					<td>{{$orden->fecha}}</td>
					<td class="vencimiento">{{$orden->fecha_entrega}}</td>
					<td>{{$orden->vendedor->nombre}} {{$orden->vendedor->apellido}}</td>
				</tr>
			</tbody>
		</table>

		<table class="tabla-tallas">

		</table>



		<table border="0" cellspacing="0" cellpadding="0" class="tabla-principal">
			<thead class="tabla-tallas">
				<tr>
					<th class="talla_head">MUJER PLUS:</th>
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
					<th class="talla_head">MUJER:</th>
					<td class="talla" style="width: 41.883px;">0/0</td>
					<td class="talla" style="width: 39.233px;">1/2</td>
					<td class="talla" style="width: 39.233px;">3/4</td>
					<td class="talla" style="width: 39.233px;">5/6</td>
					<td class="talla" style="width: 39.233px;">7/8</td>
					<td class="talla" style="width: 39.233px;">9/10</td>
					<td class="talla" style="width: 41.517px;">11/12</td>
					<td class="talla" style="width: 43.217px;">13/14</td>
					<td class="talla" style="width: 41.833px;">15/16</td>
					<td class="talla" style="width: 42.567px;">17/18</td>
					<td class="talla" style="width: 42.35px;">19/20</td>
                    <td class="talla" style="width: 42.15px;">21/22</td>
                    <td class="talla"></td>
				</tr>

				<tr>
					<th class="talla_head">HOMBRE:</th>
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
                    <td class="talla"></td>
				</tr>

				<tr>
					<th class="talla_head">NIÑO:</th>
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
					<th class="talla_head">NIÑA:</th>
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
			<thead>
				<tr>
					<th style="color:#fff;">REFERENCIA</th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th></th>
					<th style="color:#fff">TOTAL</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($orden_detalle as $talla)
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
					@if ($talla->i == null || $talla->i < 0) <td class="unit_talla">0</td>
						@else
						<td class="unit_talla">{{$talla->i}}</td>
						@endif
						@if ($talla->j == null || $talla->j < 0 ) <td class="unit_talla">0</td>
							@else
							<td class="unit_talla">{{$talla->j}}</td>
							@endif
							@if ($talla->k == null || $talla->k < 0) <td class="unit_talla">0</td>
								@else
								<td class="unit_talla">{{$talla->k}}</td>
								@endif
								@if ($talla->l == null || $talla->l < 0) <td class="unit_talla">0</td>
									@else
									<td class="unit_talla">{{$talla->l}}</td>
									@endif

									<td class="unit_talla">{{$talla->total}}</td>
				</tr>

				@endforeach
			</tbody>
		</table>

		<div style="clear: fix;">
			<table border="0" cellspacing="0" cellpadding="0" class="tabla-bultos">
				<thead>
					<tr>
						<th>UBICACION:</th>
						<th>REFERENCIA:</th>
					</tr>

				</thead>
				<tbody>
					@foreach ($productos as $talla )
					<tr>
						<td>{{$talla->ubicacion}}</td>
						<td>{{$talla->referencia_producto}}</td>
					</tr>
					@endforeach
				</tbody>

			</table>


		</div>





		{{-- <div class="firmas">
                <div class="firma_enviado">Preparado por:</div>
                <div class="firma_despachado">Despachado por:</div>
                <div class="firma_recibido">Recibido por:</div>
            </div> --}}
	</main>
	<footer class="pagina1">
		Factura generada desde SistemaCCH.
	</footer>


</body>

</html>
