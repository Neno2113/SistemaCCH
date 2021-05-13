<table>
    <thead>
    <tr>
        <th>Customer ID</th>
        <th>Invoice/CM #</th>
        <th>Credit Memo</th>
        <th>Date</th>
        <th>Ship to Name</th>
        <th>Ship to Address-Line One</th>
        <th>Ship to Address-Line Two</th>
        <th>Ship to City</th>
        <th>Ship to Country</th>
        <th>Ship Via</th>
        <th>Date Due</th>
        <th>Sales Representative ID</th>
        <th>Accounts Receivable Account</th>
        <th>Sales Tax ID</th>
        <th>Invoice Note</th>
        <th>Note Prints After Line Items</th>
        <th>Number of Distributions</th>
        <th>Invoice/CM Distribution</th>
        <th>Quantity</th>
        <th>Item ID</th>
        <th>Description</th>
        <th>G/L Account</th>
        <th>Unit Price</th>
        <th>Tax Type</th>
        <th>UPC / SKU</th>
        <th>Amount</th>
        <th>U/M ID</th>
        <th>U/M No. of Stocking Units</th>
        <th>Sales Tax Agency ID</th>
        <th>Return Authorization</th>
    </tr>
    </thead>
    <tbody>
        @foreach ($factura_detalle as $detalle)
        @foreach ($facturacion as $factura)
        @if ($detalle->orden_facturacion_id == $factura->orden_facturacion_id)
        <tr>

            <td>{{$factura->cliente->codigo_cliente}}</td>
            <td>{{$factura->tipo_factura}}-{{$factura->no_factura}}</td>
            <td>FALSE</td>
            <td>{{date("d/m/20y", strtotime($factura->fecha))}}</td>
            <td>{{$factura->cliente->nombre_cliente}}</td>
            <td>{{$factura->cliente->calle}}</td>
            <td>{{$factura->cliente->sector}}</td>
            <td>{{$factura->cliente->provincia}}</td>
            <td>REP. DOM.</td>
            <td>@if ($factura->por_transporte == 1)
                T. BLANCO
                @else
                CHOFER
            @endif</td>
            <td>{{date("d/m/20y", strtotime($factura->fecha_vencimiento))}}</td>
            <td>{{$factura->empleado->codigo}}</td>
            <td>11020-000</td>
            <td>@if ($factura->comprobante_fiscal == 1)
                    ITBIS
                    @else

            @endif</td>
            <td>{{$factura->nota}}</td>
            <td>@if (!empty($factura->nota))
                    TRUE
                    @else
                    FALSE
            @endif</td>
            <td>{{$factura->distribuciones}}</td>
            <td>{{$detalle->cm_distribuciones}}</td>
            <td>{{$detalle->total}}</td>
            <td>{{$detalle->producto->referencia_producto}}</td>
            <td>{{$detalle->producto->descripcion}}</td>
            <td>{{$detalle->catalogo->codigo}}</td>
            <td>{{str_replace('.00', '', $detalle->precio)}}</td>
            <td>1</td>
            <td>{{$detalle->sku->sku}}</td>
            <td>-{{$detalle->total * $detalle->precio}}</td>
            <td>UNIDAD</td>
            <td>1</td>
            <td></td>
            <td></td>

        </tr>
        @endif
        @endforeach

        @endforeach

    </tbody>
</table>
