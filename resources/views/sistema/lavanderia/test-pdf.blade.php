<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Conduce envio!</title>

<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
</style>

</head>
<body>

  <table width="100%">
    <tr>
        <td valign="top"><img src="{{asset('images/meteor-logo.png')}}" alt="" width="150"/></td>
        <td align="right">
            <h3>Confecciones Carmen Herrera, SRL</h3>
            <pre>
                C/ Diego Tristan, casi esq.
                Ave. La pista, Hainamosa
                Santo Domingo Este
            </pre>
        </td>
    </tr>

  </table>

  <table style="margin-top:50px; border-collapse:collapse; padding:20px;">
      <thead style="border:solid;">
          <tr>
            <th>Enviado a:</th>
          </tr>
      </thead>
      <tbody style="border:solid; padding:20px;">
          <tr><th>Nombre Lavanderia(here)</th></tr>
          <tr><th>Address(here)</th></tr>
          <tr><th>phonenumber(here)</th></tr>
      </tbody>
  </table>

  {{-- <table width="100%">
    <tr>
        <td><strong>From:</strong> Confecciones Carmen Herrera - Santo Domingo Este</td>
        <td><strong>To:</strong> Lavanderia - Direccion lavanderia</td>
    </tr>

  </table> --}}

  <br/>

  <table width="100%">
    <thead style="background-color: lightgray;">
      <tr>
        <th>#</th>
        <th>Description</th>
        <th>Quantity</th>
        <th>Unit Price $</th>
        <th>Total $</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <th scope="row">1</th>
        <td>Playstation IV - Black</td>
        <td align="right">1</td>
        <td align="right">1400.00</td>
        <td align="right">1400.00</td>
      </tr>
      <tr>
          <th scope="row">1</th>
          <td>Metal Gear Solid - Phantom</td>
          <td align="right">1</td>
          <td align="right">105.00</td>
          <td align="right">105.00</td>
      </tr>
      <tr>
          <th scope="row">1</th>
          <td>Final Fantasy XV - Game</td>
          <td align="right">1</td>
          <td align="right">130.00</td>
          <td align="right">130.00</td>
      </tr>
    </tbody>

    <tfoot>
        <tr>
            <td colspan="3"></td>
            <td align="right">Subtotal $</td>
            <td align="right">1635.00</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Tax $</td>
            <td align="right">294.3</td>
        </tr>
        <tr>
            <td colspan="3"></td>
            <td align="right">Total $</td>
            <td align="right" class="gray">$ 1929.3</td>
        </tr>
    </tfoot>
  </table>

</body>
</html>