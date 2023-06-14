@extends('layouts.base')
@section('contenido')
<div class="page-header" id="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-header-title">
                    <h5 class="m-b-10">CORTE DE CAJA</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-brand-tidal me-2"></i><a href="/dashboard">Catalogos</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-device-laptop me-2"></i><a href="/gastos">Corte</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="ti ti-device-desktop-analytics me-2"></i><a href="/productos">Realizar corte</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- Page-header end -->
<div class="pcoded-inner-content">
    <!-- Main-body start -->
    <div class="main-body">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <form action="" id="add-corte">

                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">
                        Detalles del corte
                      </h3>
                    </div>
                    <div class="card-body">
                        <div class="hr-text hr-text-left">Ingresos</div>
                        <dl class="row">
                            <dt class="col-5">Total de ventas</dt>
                            <dd class="col-7">{{ $nVentas }}</dd>
                            <dt class="col-5">Ventas en efectivo</dt>
                            <dd class="col-7">${{ $ventasEfectivo }}</dd>
                            <dt class="col-5">Ventas en tarjeta:</dt>
                            <dd class="col-7">${{ $ventasTarjeta }}</dd>
                            <dt class="col-5">Pagos:</dt>
                            <dd class="col-7">${{ $pagos }}</dd>
                        </dl>
                        <div class="hr-text hr-text-left">Egresos</div>
                        <dl class="row">
                            <dt class="col-5">Compras</dt>
                            <dd class="col-7">${{ $compras }}</dd>
                            <dt class="col-5">Descuentos</dt>
                            <dd class="col-7">${{ $descuentos }}</dd>
                            <dt class="col-5">gastos y retiros</dt>
                            <dd class="col-7">${{ $gastos }}</dd>
                        </dl>
                        <div class="hr-text hr-text-left">Caja</div>
                        <dl class="row">
                            <dt class="col-5">Saldo inicial</dt>
                            <dd class="col-7">${{ $saldoInicial }}</dd>
                            <dt class="col-5">Saldo final</dt>
                            <dd class="col-7">${{ $saldoFinal }}</dd>
                            <input type="hidden" class="form-control" name="saldo-final" id="saldo-final" min="0" max="1000000" step=0.01 value="{{ $saldoFinal }}">
                        </dl>
                        <div class="hr-text hr-text-left">Cuentas</div>
                        <dl class="row">
                            <dt class="col-5">Efectivo contado</dt>
                            <dd class="col-7">
                                <input type="number" class="form-control" name="efectivo" id="efectivo" placeholder="Efectivo contado" required min="0" max="1000000" step=0.01>
                            </dd>
                            <dt class="col-5">Diferencia</dt>
                            <dd class="col-7" id="diferencia">$0.00</dd>
                        </dl>
                        <button type="submit" class="btn btn-success">Realizar corte</button>
                    </div>
                  </div>
            </form>
            <!-- Page-body end -->
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/cortes/crud-corte.js') }}"></script>
<script src="{{ asset('assets/js/cortes/config.js') }}"></script>
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script>
    
</script>
@endsection
