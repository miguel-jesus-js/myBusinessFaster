@extends('layouts.base')
@section('contenido')
<div class="page-header" id="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">DETALLE DE VENTA</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-brand-tidal me-2"></i><a href="/dashboard">Catalogos</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-calendar-event me-2"></i><a href="/dashboard">Historial</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="ti ti-list-details me-2"></i><a href="/historial">Detalle</a></li>
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
            <div class="page-body">
              <div class="card">
                <div class="card-body">
                    <section class="search-venta">
                        <form action="" id="form-search-venta">
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label" for="">Folio</label>
                                    <div class="row g-2">
                                        <div class="col">
                                        <input type="text" class="form-control" name="folio" id="folio" placeholder="Folio de venta" required autocomplete="off" autofocus>
                                        </div>
                                        <div class="col-auto">
                                        <button type="submit" class="btn" aria-label="Button">
                                            <i class="ti ti-search icono"></i>
                                        </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
              </div>
                <div class="accordion bg-white mb-3" id="reporte">
                </div>
                <div class="card card-lg">
                    <div class="card-body" id="venta-detalle">
                      
                    </div>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('assets/js/pagos/pagos.js') }}"></script>
@endsection
