<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo-icono.ico') }}">
    {{-- <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Raleway:wght@300&display=swap"
        rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('assets/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/iconfont/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    @yield('css')
</head>

<body class="m-4">
    <div class="row">
        <div class="col-md-10">
          <img src="{{ asset('img/'.$setting->logotipo) }}" class="logo logo-icons logo-suffix" alt="Logotipo">
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col-6">
          <small><strong class="datagrid-title class-name h6">Nombre o razón social: </strong> {{ $setting->razon_social }}</small>
          <br>
          <small><strong class="datagrid-title class-name h6">Número de identificación fiscal: </strong> {{ $venta->sucursal->rfc }}</small>
          <br>
          <small>
            <address>
              <strong class="datagrid-title class-name h6">Dirección: </strong>
              {{$venta->sucursal->calle.' '.$venta->sucursal->n_exterior}}<br>
              {{$venta->sucursal->colonia.', '.$venta->sucursal->cp}}<br>
              {{$venta->sucursal->municipio.', '.$venta->sucursal->estado.', '.$venta->sucursal->ciudad}}<br>
            </address>
          </small>
          <small><strong class="datagrid-title class-name h6">Teléfono: </strong> {{ $venta->sucursal->telefono }}</small>
          <br>
          <small><strong class="datagrid-title class-name h6">Correo electrónico: </strong> {{ $venta->sucursal->correo }}</small>
        </div>
        @if ($venta->cliente_id == null)
        <div class="col-6 text-justify">
          <small><strong class="datagrid-title class-name h6">Venta al publico en general</strong></small>
        </div>
        @else
        <div class="col-6 text-justify">
          <small><strong class="datagrid-title class-name h6">Nombre o razón social: </strong> {{ $venta->cliente->persona->nombres }}</small>
          <br>
          <small><strong class="datagrid-title class-name h6">Número de identificación fiscal: </strong> {{ $venta->cliente->persona->rfc }}</small>
          <br>
          <small>
            <address>
              <strong class="datagrid-title class-name h6">Dirección: </strong>
              {{$venta->cliente->calle.' '.$venta->cliente->n_exterior}}<br>
              {{$venta->cliente->colonia.', '.$venta->cliente->cp}}<br>
              {{$venta->cliente->municipio.', '.$venta->cliente->estado.', '.$venta->cliente->ciudad}}<br>
            </address>
          </small>
          <small><strong class="datagrid-title class-name h6">Teléfono: </strong> {{ $venta->cliente->persona->telefono }}</small>
          <br>
          <small><strong class="datagrid-title class-name h6">Correo electrónico: </strong> {{ $venta->cliente->persona->email }}</small>
        </div>
        @endif
        <div class="col-12 my-3">
          <small><strong class="datagrid-title class-name h6">Número de folio: </strong> {{ $venta->folio }}</small>
          <br>
          <small><strong class="datagrid-title class-name h6">Fecha y hora: </strong> {{ Carbon\Carbon::parse($venta->fecha)->format('d/m/Y h:i:s A')  }}</small>
          <br>
          <small><strong class="datagrid-title class-name h6">Tipo de venta: </strong> {{ \App\Models\Venta::TIPO_VENTA[$venta->tipo_venta] }}</small>
          <br>
          <small><strong class="datagrid-title class-name h6">Vendedor: </strong> {{ $venta->empleado->persona->nombres}}</small>
          <br>
        </div>
      </div>
      <div class="datagrid-title"> Descripción de los productos o servicios</div>
      <div class="table-responsive">
        <table class="table bg-white table-bordered table-sm">
          <thead class="disable-selection">
            <tr>
              <th></th>
              <th>Producto</th>
              <th>Cantidad</th>
              <th>Precio unitario</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @for ($i = 0; $i < sizeof($venta->productos); $i++)
                  <tr>
                    <td class="p-1">{{$i + 1}}</td>
                    <td class="p-1">{{$venta->productos[$i]->producto}}</td>
                    <td class="p-1">{{$venta->productos[$i]->pivot->cantidad}}</td>
                    <td class="p-1">{{$venta->productos[$i]->pivot->precio}}</td>
                    <td class="p-1">${{  $venta->productos[$i]->pivot->importe}}</td>
                  </tr>
            @endfor
            <tr>
              <td colspan="4" class="p-1 strong text-end">Subtotal:</td>
              <td class="p-1 text-end">${{ $venta->importe }}</td>
            </tr>
            <tr>
              <td colspan="4" class="p-1 strong text-end">IVA ({{$setting->iva}}%):</td>
              <td class="p-1 text-end">${{ $venta->iva }}</td>
            </tr>
            <tr>
              <td colspan="4" class="p-1 strong text-end">Descuento:</td>
              <td class="p-1 text-end">${{ $venta->descuento }}</td>
            </tr>
            <tr>
              <td colspan="4" class="p-1 strong text-end">Total:</td>
              <td class="p-1 text-end">${{ $venta->total }}</td>
            </tr>
            @if ($venta->tipo_venta == 3)
            <tr>
                <td colspan="4" class="p-1 strong text-end">Pago inicial:</td>
                <td class="p-1 text-end">${{ $venta->pago_inicial }}</td>
            </tr>
            <tr>
              <td colspan="4" class="p-1 strong text-end">Efectivo:</td>
              <td class="p-1 text-end">${{ $venta->paga_con }}</td>
            </tr>
            <tr>
                <td colspan="4" class="p-1 strong text-end">Cambio:</td>
                <td class="p-1 text-end">${{ $venta->paga_con - $venta->pago_inicial }}</td>
            </tr>
            @else
            <tr>
                <td colspan="4" class="p-1 strong text-end">Cambio:</td>
                <td class="p-1 text-end">${{ $venta->paga_con - $venta->total }}</td>
            </tr>
            @endif
          </tbody>
        </table>
      </div>
      <br><br>
      <div class="row">
        <div class="col-md-5">
          <table class="table bg-white table-bordered">
            <thead class="disable-selection">
              <tr>
                <th>Información de pago</th>
              </tr>
              <tbody>
                <tr>
                  <td class="p-1">
                      Modalidad: {{ $venta->tipo_venta == 3 ? 'Venta a crédito' : 'Venta de contado' }}
                  </td>
                </tr>
                <tr>
                    <td class="p-1">Tipo de Pago: <i class="{{ $venta->tipo_pago == 0 ? 'ti ti-brand-cashapp' : 'ti ti-brand-visa' }}"></i>
                        {{ $venta->tipo_pago == 0 ? 'Efectivo' : 'Tarjeta' }}
                    </td>
                </tr>
                <tr>
                    <td class="p-1">Estado: {{ $venta->estado == 0 ? 'Pagado' : 'Pagos pendientes'}}</td>
                </tr>
                @if ($venta->tipo_venta == 3)
                <tr>
                    <td class="p-1">
                        Periodo de pagos: {{ \App\Models\Venta::PERIODO_PAGOS[$venta->periodo_pagos] }}
                    </td>
                </tr>
                @endif
              </tbody>
            </thead>
          </table>
        </div>
      </div>
      <p class="text-muted text-center mt-3">Muchas gracias por hacer negocios con nosotros. ¡Esperamos trabajar con usted nuevamente!</p>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
      $(window).on("load", function() {
          window.print();
      });
      $(window).on("afterprint", function() {
          window.close();
      });
	</script>
</body>

</html>
