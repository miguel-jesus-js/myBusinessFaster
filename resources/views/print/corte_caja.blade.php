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
                    {{Auth::user()->sucursal->calle.' '.Auth::user()->sucursal->n_exterior}}<br>
                    {{Auth::user()->sucursal->colonia.', '.Auth::user()->sucursal->cp}}<br>
                    {{Auth::user()->sucursal->municipio.', '.Auth::user()->sucursal->estado.', '.Auth::user()->sucursal->ciudad}}<br>
                </address>
            </small>
        </center>
        <small>
            <strong class="datagrid-title class-name h6">Sucursal: </strong>{{ Auth::user()->sucursal->nombre }}
        </small>
        <br>
        <small>
            <strong class="datagrid-title class-name h6">Teléfono: </strong>{{ Auth::user()->sucursal->telefono }}
        </small>
        <br>
        <small>
            <strong class="datagrid-title class-name h6">Correo:
            </strong>{{ Auth::user()->sucursal->correo }}
        </small>
        <br>
        <div class="hr-text hr-text-left">Ingresos</div>
        <dl class="row">
            <dt class="col-8">Total de ventas</dt>
            <dd class="col-4">{{ $nVentas }}</dd>
            <dt class="col-8">Ventas en efectivo</dt>
            <dd class="col-4">${{ $ventasEfectivo }}</dd>
            <dt class="col-8">Ventas en tarjeta:</dt>
            <dd class="col-4">${{ $ventasTarjeta }}</dd>
            <dt class="col-8">Pagos:</dt>
            <dd class="col-4">${{ $pagos }}</dd>
        </dl>
        <div class="hr-text hr-text-left">Egresos</div>
        <dl class="row">
            <dt class="col-8">Compras</dt>
            <dd class="col-4">${{ $compras }}</dd>
            <dt class="col-8">Descuentos</dt>
            <dd class="col-4">${{ $descuentos }}</dd>
            <dt class="col-8">gastos y retiros</dt>
            <dd class="col-4">${{ $gastos }}</dd>
        </dl>
        <div class="hr-text hr-text-left">Caja</div>
        <dl class="row">
            <dt class="col-8">Saldo inicail</dt>
            <dd class="col-4">${{ $saldoInicial }}</dd>
            <dt class="col-8">Saldo final</dt>
            <dd class="col-4">${{ $saldoFinal }}</dd>
            <input type="hidden" class="form-control" name="saldo-final" id="saldo-final" min="0" max="1000000" step=0.01 value="{{ $saldoFinal }}">
        </dl>
        <div class="hr-text hr-text-left">Cuentas</div>
        <dl class="row">
            <dt class="col-8">Efectivo contado</dt>
            <dd class="col-4">${{ $efectivo_contado }}</dd>
            <dt class="col-8">Diferencia</dt>
            <dd class="col-4" id="diferencia">${{ $efectivo_contado - $saldoFinal }}</dd>
        </dl>
        <br>
        <br>
        <center>
            <small class="text-muted text-center mt-3 border-top p-2 border-dark">
                {{ Auth::user()->persona->nombres }}
            </small>
        </center>
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
