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

<body class="ticket">
    <div class="mr-2">
        <center>
            <img src="{{ asset('img/'.$setting->logotipo) }}" class="logo logo-icons logo-suffix mb-1" alt="Logotipo">
            <small>
                <address>
                    <strong class="datagrid-title class-name h6">Dirección: </strong>
                    {{$pago->venta->sucursal->calle.' '.$pago->venta->sucursal->n_exterior}}<br>
                    {{$pago->venta->sucursal->colonia.', '.$pago->venta->sucursal->cp}}<br>
                    {{$pago->venta->sucursal->municipio.', '.$pago->venta->sucursal->estado.', '.$pago->venta->sucursal->ciudad}}<br>
                </address>
            </small>
        </center>
        <small>
            <strong class="datagrid-title class-name h6">Sucursal: </strong>{{ $pago->venta->sucursal->nombre }}
        </small>
        <br>
        <small>
            <strong class="datagrid-title class-name h6">Teléfono: </strong>{{ $pago->venta->sucursal->telefono }}
        </small>
        <br>
        <small>
            <strong class="datagrid-title class-name h6">Correo:
            </strong>{{ $pago->venta->sucursal->correo }}
        </small>
        <hr class="m-1">
        <small>
            <strong class="datagrid-title class-name h6">Vendedor:
            </strong>{{ $pago->empleado->persona->nombres}}
        </small>
        <br>
        <small>
            <strong class="datagrid-title class-name h6">Cliente:
            </strong>{{ $pago->venta->cliente->persona->nombres }}
        </small>
        <hr class="m-1">
        <p>INFORMACIÓN DE PAGO</p>
        <small>
            <strong class="datagrid-title class-name h6">Fecha estimada de pago:
            </strong>{{ $pago->fecha_estimada }}
        </small>
        <br>
        <small>
            <strong class="datagrid-title class-name h6">Fecha y hora de pago:
            </strong>{{ $pago->fecha_hora }}
        </small>
        <br>
        @php
            use Carbon\Carbon;

            $fechaCarbon = Carbon::parse($pago->fecha_estimada);
            $fechaCarbon->addMonth();
        @endphp
        <small>
            <strong class="datagrid-title class-name h6">Fecha de proximo pago:
            </strong>{{ $fechaCarbon }}
        </small>
        <br>
        <table class="table table-bordered table-sm">
            <tbody>
                <tr>
                    <td style="width: 100px" class="p-1 strong">Subtotal:</td>
                    <td class="p-1">${{ $pago->monto }}</td>
                </tr>
                <tr>
                    <td style="width: 100px" class="p-1 strong">Anticipo:</td>
                    <td class="p-1">${{ $pago->anticipo }}</td>
                </tr>
                <tr>
                    <td style="width: 100px" class="p-1 strong">Total a pagar:</td>
                    <td class="p-1">${{ $pago->monto - $pago->anticipo }}</td>
                </tr>
                <tr>
                    <td style="width: 100px" class="p-1 strong">Efectivo:</td>
                    <td class="p-1">${{ $pago->paga_con }}</td>
                </tr>
                <tr>
                    <td style="width: 100px" class="p-1 strong">Cambio:</td>
                    <td class="p-1">${{ $pago->paga_con - ($pago->monto - $pago->anticipo) }}</td>
                </tr>
            </tbody>
        </table>
        <p class="text-muted text-center mt-3">Muchas gracias por hacer negocios con nosotros.¡Esperamos trabajar con usted nuevamente!</p>
        <br>
        <br>
        <center>-------------------------</center>
    </div>
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
