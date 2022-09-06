<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Datos de Empleado</title>
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
			color: #000;
			background: #FFFFFF;
			font-family: Arial, sans-serif;
			font-size: 10px;
			/* font-family: SourceSansPro; */
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
			margin-right: -135px;
		}

		#logo img {
		/*	height: 130px; */
			width: 130px;
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

		h2.session{
			text-align: center;
		}

		h2.session-1{
			float: left;
			margin-left: 20px;
		}

		h2.session-2{
			float: left;
			margin-left: 250px;
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
			border: solid 1px black;
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
			border: solid 1px black;

		}

		.tabla-principal .desc {
			text-align: center;
			font-size: 13px;
			color: #fff;
			border: solid 1px black;

		}

		.tabla-principal .unit {
			/* background-color: #160c70; */
			font-size: 13px;
			color: #fff;
			border: solid 1px black;
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
			border: solid 1px black;
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
			border: solid 1px black;
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
			border: 1px solid black;
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

		footer {
		/*	page-break-after: always; */
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


		.tabla-factura {
			float: left;
		/*	width: 50%; */
			border-top: 1px solid black;
			border-left: 1px solid black;
			border-right: 1px solid black;
		/*	border: 1px solid black; */
		/*	margin-left: 5%; */
			border-spacing: 0px;
		}

		.tabla-factura thead .factura {
		/*	font-weight: bolder; */
			color: #000;
		}


		.tabla-factura tbody th {
			text-align: center;
			font-size: 11px;
			border-right: 1px solid black;
			border-bottom: 1px solid black;
			padding: 2px 4px 2px 5px;
		}

		.tabla-factura tbody .mas_espacio {
			padding: 3px 4px 3px 11px;
		}

		.tabla-factura tbody td {
			padding: 2px 4px 2px 11px;
			border-bottom: 1px solid black;
		/*	font-size: 11px;
			text-align: center;
			font-size: 10px;
			padding: 10px;
			padding-bottom: 13px;
			border-top: 1px solid black; */
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
			border-top: 1px solid black;
			border-left: 1px solid black;
			border-right: 1px solid black;
			width: 59%; 
			margin-right: 4%;
			margin-left: 160px; 
		}

		.tabla-cliente thead th {
			border-bottom: 1px solid black;
			border-right: 1px solid black;
			font-size: 11px;
			padding-left: 11px;
		}

		.tabla-cliente thead td {
			border-bottom: 1px solid black;
			padding: 2px 2px 2px 11px;
		}

		.tabla-cliente tbody td {
			border-bottom: 1px solid black;
		/*	padding-right: 106px; */
			padding: 2px 2px 2px 11px;
		}

		.tabla-cliente tbody th {
			border-right: 1px solid black;
			border-bottom: 1px solid black;
			font-size: 11px;
			font-weight: bold;
			padding-left: 11px;
		}

		.tabla-cliente tbody .direccion {
			padding: 12px;
		}

		.tabla-info {
			float: left;
			border-top: 1px solid black;
			border-left: 1px solid black;
			border-right: 1px solid black;
			width: 40%; 
			margin-right: 4%;
		}

		.tabla-info tbody th {
			border-right: 1px solid black;
			border-bottom: 1px solid black;
			font-size: 11px;
			font-weight: bold;
			padding-left: 11px;
		}

		.tabla-info tbody td {
			border-bottom: 1px solid black;
			padding: 4px 2px 4px 11px;
		}

		.tabla-laboral {
			float: left;
			border-top: 1px solid black;
			border-left: 1px solid black;
			border-right: 1px solid black;
		/*	width: 50%; */
		/*	width: 395px; */
			border-spacing: 0x;
		}

		.tabla-laboral tbody th {
			border-right: 1px solid black;
			border-bottom: 1px solid black;
			font-size: 11px;
		/*	font-weight: bold; */
			text-align: left;
			padding: 2px 4px 2px 5px;
		}

		.tabla-laboral tbody td {
			border-bottom: 1px solid black;
			padding: 4px 2px 4px 11px;
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
			border: solid 1px black;
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
			font-size: 11px;
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

		.tabla-ncf tbody td {
			/* padding-left: 50px; */
			border-bottom: 1px solid black;
		}

		.tabla-depentientes {
			width: 715px;
			/* border-collapse: collapse;
            border-spacing: 0; */
			margin-bottom: 10px;
			table-layout: auto;
			border: solid 1px black;
			margin-left: 320px;
		}

		.tabla-depentientes thead th {
			border-bottom: 2px solid black;
			/* border-left: 2px solid black */
			background-color: #131980;
			color: #fff;
			text-align: center;
		}

		.tabla-depentientes tbody td {
			text-align: center;
			font-size: 11px;
			color: #000;
			border-bottom: 1px solid black;
		}

		.tabla-depentientes thead .titulo-dependientes{
			background-color: #fff;
			color: #000;
			text-align: center;
			font-size: 13px;
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
			border: solid 1px black;
		}

		.tabla-tallas th,
		.tabla-tallas td {
			/* padding: 20px; */
			background: #fff;
			text-align: center;
			border-bottom: 1px solid #FFFFFF;
			border: solid 1px #444;
		}
		.tabla-tallas th {
			white-space: nowrap;
			font-weight: bold;
			background-color: #131980;
			font-size: 10px;
			border: solid 1px black;
			color: #fff;
		}
		.tabla-tallas .talla_head {
			color: #fff;
			font-size: 6.5px;
		}

		.tabla-tallas .talla {
			border: 1px solid black;
			text-align: center;
			font-weight: bold;
			font-size: 8px;
		}
		.tabla-tallas tbody tr:last-child td{
			padding-bottom: 250px;
		}
	</style>
</head>

<body>
	<header class="clearfix">
		<div id="logo">
		<h1 class="name">INFORME DE EMPLEADO</h1>
			<img src="">
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
			<div id="logo">
			<!--	<img src="{{ public_path('adminlte/img/images.png') }}"> -->
				<img src="{{ public_path('adminlte/img/images.png') }}">
			</div>
			<table border="0" cellspacing="0" cellpadding="0" class="tabla-cliente">
				<thead class="cod">
					<tr>
						<th>Codigo Empleado</th>
						<td>{{ $codigo }}</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>Nombre</th>
						<td>{{ $nombre }} {{ $apellido }}</td>
					</tr>
					<tr>
						<th class="direccion">Direccion</th>
						<td class="direccion">{{ $calle }}, {{ $sector }},
							{{ $provincia }}, {{ $sitios_cercanos }}</td> 
					</tr> 
					<tr>
						<th>Email</th>
						<td>{{ $email }}</td>
					</tr>
					<tr>
						<th>Telefonos</th>
						<td>{{ $telefono_1 }} / {{ $celular }}</td>
					</tr>
					<tr>
						<th>Cedula</th>
						<td>{{ $cedula }}</td>
					</tr>
				</tbody>
			</table>
			<table cellpadding="0" class="tabla-factura" style="width:250px;">
				<tbody>
					<tr>
						<th>Estado Civil</th>
						<td>{{ $estado_civil }}</td>
					</tr>
					<tr>
						<th>Fecha Nacimiento</th>
						<td>{{ $fecha_nacimiento }}</td>
					</tr>
					<tr>
						<th>Fecha de Ingreso</th>
						<td>{{ $fecha_ingreso }}</td>
					</tr>
					<tr>
						<th>Departamento</th>
						<td>{{ $departamento }}</td>
					</tr>
					<tr>
						<th>Tipo Contrato</th>
						<td>{{ $tipo_contrato }}</td>
					</tr>
					<tr>
						<th class="mas_espacio">Seguridad Sociales</th>
						<td class="mas_espacio">{{ $nss }}</td>
					</tr>
					<tr>
						<th>Departamento</th>
						<td>{{ $departamento }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
			<h2 class="session">Información Personal &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </h2>
		</div>
		<div id="details" class="clearfix">	
			<table border="0" cellspacing="0" cellpadding="0" class="tabla-info">
				<tbody>
					<tr>
						<th>Condicion Medica</th>
						<td>{{ $condicion_medica }}</td>
					</tr>
					<tr>
						<th>Nombre de Esposo/a</th>
						<td>{{ $nombre_esposa }}</td>
					</tr>
					<tr>
						<th>Telefono de Esposo/a</th>
						<td>{{ $telefono_esposa }}</td>
					</tr>
					<tr>
						<th>¿Esposa Incluida en Seguro?</th>
						<td>{{ $esposa_en_nss }}</td>
					</tr>
					<tr>
						<th>Cantidad de Dependientes</th>
						<td>{{ $cantidad_dependientes }}</td>
					</tr>
				</tbody>
			</table>
			<table cellspacing="0" class="tabla-depentientes">
				<thead>
					<tr>
						<th class="titulo-dependientes" colspan="3">DEPENDIENTES</th>
					</tr>
					<tr>
						<th class="op">NOMBRE</th>
						<th class="terminos_pago">PARENTESCO</th>
						<th class="vendedor">EDAD</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ $nombre_dependiente_0 }}</td>
						<td>{{ $parentesco_dependiente_0 }}</td>
						<td>{{ $edad_dependiente_0 }}</td>
					</tr>
					<tr>
						<td>{{ $nombre_dependiente_1 }}</td>
						<td>{{ $parentesco_dependiente_1 }}</td>
						<td>{{ $edad_dependiente_1 }}</td>
					</tr>
					<tr>
						<td>{{ $nombre_dependiente_2 }}</td>
						<td>{{ $parentesco_dependiente_2 }}</td>
						<td>{{ $edad_dependiente_2 }}</td>
					</tr>
					<tr>
						<td>{{ $nombre_dependiente_3 }}</td>
						<td>{{ $parentesco_dependiente_3 }}</td>
						<td>{{ $edad_dependiente_3 }}</td>
					</tr>
					<tr>
						<td>{{ $nombre_dependiente_4 }}</td>
						<td>{{ $parentesco_dependiente_4 }}</td>
						<td>{{ $edad_dependiente_4 }}</td>
					</tr>
					<tr>
						<td>{{ $nombre_dependiente_5 }}</td>
						<td>{{ $parentesco_dependiente_5 }}</td>
						<td>{{ $edad_dependiente_5 }}</td>
					</tr>
					<tr>
						<td>{{ $nombre_dependiente_6 }}</td>
						<td>{{ $parentesco_dependiente_6 }}</td>
						<td>{{ $edad_dependiente_6 }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
			<h2 class="session">Referencia Personal &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </h2>
		</div>
		<div id="details" class="clearfix">	
			<table cellspacing="0" class="tabla-ncf">
				<thead>
					<tr>
						<th class="op">NOMBRE</th>
						<th class="terminos_pago">PARENTESCO</th>
						<th class="vendedor">TELEFONO</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ $nombre_ref1 }}</td>
						<td>{{ $parentesco_ref1 }}</td>
						<td>{{ $telefono_ref1 }}</td>
					</tr>
					<tr>
						<td>{{ $nombre_ref2 }}</td>
						<td>{{ $parentesco_ref2 }}</td>
						<td>{{ $telefono_ref2 }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
			<h2 class="session">Experiencia Laboral &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </h2>
		</div>
		<div id="details" class="clearfix">	
			<table cellspacing="0" class="tabla-ncf">
				<thead>
					<tr>
						<th class="op">CARGO</th>
						<th class="terminos_pago">TIEMPO</th>
						<th class="vendedor">EMPRESA</th>
						<th class="vendedor">SUPERVISOR</th>
						<th class="vendedor">TELEFONO</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ $cargo_experiencia_1 }}</td>
						<td>{{ $tiempo_experiencia_1 }}</td>
						<td>{{ $empresa_experiencia_1 }}</td>
						<td>{{ $supervisor_experiencia_1 }}</td>
						<td>{{ $telefono_experiencia_1 }}</td>
					</tr>
					<tr>
						<td>{{ $cargo_experiencia_2 }}</td>
						<td>{{ $tiempo_experiencia_2 }}</td>
						<td>{{ $empresa_experiencia_2 }}</td>
						<td>{{ $supervisor_experiencia_1 }}</td>
						<td>{{ $telefono_experiencia_2 }}</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div>
			<h2 class="session">Formación Academica &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Información Laboral &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </h2>
		</div>
		<div id="details" class="clearfix">	
			<table border="0" cellspacing="0" cellpadding="0" class="tabla-info" style="margin-right: 30px;">
				<tbody>
					<tr>
						<th>Primaria</th>
						<td>{{ $primaria }}</td>
					</tr>
					<tr>
						<th>Bachiller</th>
						<td>{{ $bachiller }}</td>
					</tr>
					<tr>
						<th>Nivel Superior</th>
						<td>{{ $nivel_superior }}</td>
					</tr>
					<tr>
						<th>Grado y Titulo</th>
						<td>{{ $grado_titulo }}</td>
					</tr>
					<tr>
						<th>Especialidad</th>
						<td>{{ $especialidad }}</td>
					</tr>
					<tr>
						<th>Fecha de Exp.</th>
						<td>{{ $fecha_exp }}</td>
					</tr>
				</tbody>
			</table>
			<table cellpadding="0" class="tabla-factura" style="width: 395px;">
				<tbody>
					<tr>
						<th>Cargo</th>
						<td>{{ $cargo }}</td>
					</tr>
					<tr>
						<th>Contrato</th>
						<td>{{ $tipo_contrato }}</td>
					</tr>
					<tr>
						<th>Forma de Pago</th>
						<td>{{ $forma_pago }}</td>
					</tr>
					<tr>
						<th>Sueldo</th>
						<td>{{ $sueldo }}</td>
					</tr>
					<tr>
						<th>Valor Hora</th>
						<td>{{ $valor_hora }}</td>
					</tr>
					<tr>
						<th>Banco</th>
						<td>{{ $banco_tarjeta_cobro }}</td>
					</tr>
					<tr>
						<th>No. de Cuenta</th>
						<td>{{ $no_cuenta }}</td>
					</tr>
					<tr>
						<th>Fecha Termino de Contrato</th>
						<td>{{ $fecha_termino_contrato }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</main>
	<footer class="pagina1">
		Fin de documento.
	</footer>
	
</body>

</html>
