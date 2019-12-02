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
			margin-right: 35%;
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
			color: #57B223;
			font-size: 1.2em;
			font-weight: normal;
			margin: 0 0 0.2em 0;
		}

		table .no {
			color: #FFFFFF;
			font-size: 15px;
			background: #57B223;
			text-align: center;

		}

		table .desc {
			text-align: center;
			font-size: 15px;
		}

		table .unit {
			background: #DDDDDD;
		}

		table .unit_talla {
			background: #DDDDDD;
			text-align: center;
			font-size: 13px;
		}

		table .qty {}

		table .total {
			background: #57B223;
			color: #FFFFFF;
		}

		table td.unit,
		table td.qty,
		table td.total {
			font-size: 1.2em;
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
			font-size: 1.4em;
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

		<div id="invoice company">
			<h1>ORDEN PEDIDO: {{$orden->no_orden_pedido}}</h1>
			<div class="date">Fecha pedido: {{$orden->fecha}}</div>
			<div class="date">Fecha Entrega: {{$orden->fecha_entrega}}</div>
		</div>
		</div>
	</header>
	<main>
		<div id="details" class="clearfix">
			<div id="client">
				<div class="to">CONDUCE PARA:</div>
				<h2 class="name">{{$orden->cliente->nombre_cliente}}</h2>
				<div class="address">{{$orden->cliente->direccion_principal}}</div>
				<div class="email"><a href="mailto:john@example.com">{{$orden->cliente->email_principal}}</a></div>
				<div class="to">SUCURSAL:</div>
				<h2 class="name">{{$orden->sucursal->nombre_sucursal}}</h2>
			</div>
			<div id="invoice">
				<h1>ORDEN DE EMPAQUE: {{$orden_empaque->no_orden_empaque}}</h1>
				<div class="date">FECHA IMPRESO: {{$orden_empaque->fecha}}</div>
			</div>
		</div>
		<table border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th class="no">REFERENCIA</th>
						<th class="desc">FECHA ENTREGA</th>
						<th class="unit">PRECIO UNIDAD</th>
						<th class="qty">CANTIDAD</th>
						<th class="total">TOTAL</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			
			</table>
		<table border="0" cellspacing="0" cellpadding="0">
			<thead>
				
				<tr>
					<th class="desc">Referencia</th>
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
					@if ($talla->i == null || $talla->i < 0)
					<td class="unit_talla">0</td>
					@else
					<td class="unit_talla">{{$talla->i}}</td>
					@endif
					@if ($talla->j == null || $talla->j < 0 )
					<td class="unit_talla">0</td>
					@else
					<td class="unit_talla">{{$talla->j}}</td>
					@endif
					@if ($talla->k == null || $talla->k < 0)
					<td class="unit_talla">0</td>
					@else
					<td class="unit_talla">{{$talla->k}}</td>
					@endif
					@if ($talla->l == null || $talla->l < 0)
					<td class="unit_talla">0</td>
					@else
					<td class="unit_talla">{{$talla->l}}</td>
					@endif
				</tr>
				@endforeach
			</tbody>
		</table>
		<div id="thanks"></div>
		<div id="notices">
			<div>TRAMO:</div>
			<div class="notice">
				@foreach ($productos as $talla)
				<p>{{$talla->ubicacion}} {{$talla->referencia_producto}}</p>
				@endforeach
			</div>
		</div>
		{{-- <div class="firmas">
			<div class="firma_enviado">Enviado por:</div>
			<div class="firma_recibido">Recibido por:</div>
		</div> --}}
	</main>
	<footer class="pagina1">
		Conduce generado desde SistemaCCH.
	</footer>
</body>

</html>