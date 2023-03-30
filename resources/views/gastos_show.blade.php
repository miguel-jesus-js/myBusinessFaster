@extends('layouts.base')
@section('contenido')
<div class="page-header" id="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="page-header-title">
                    <h5 class="m-b-10">GASTOS</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-6">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-brand-tidal me-2"></i><a href="/dashboard">Catalogos</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-currency-dollar-off me-2"></i><a href="/gastos">Gastos</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="ti ti-list-details me-2"></i><a href="/productos">Detalles</a></li>
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
            <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Detalles del gasto</h3>
                </div>
                <div class="card-body">
                  <div class="datagrid">
                    <div class="datagrid-item">
                      <div class="datagrid-title">Empleado que realizo el gasto</div>
                      <div class="datagrid-content">{{ $gasto->user->nombres.' '.$gasto->user->app.' '.$gasto->user->apm }}</div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Tipo de gasto</div>
                      <div class="datagrid-content">{{ $gasto->tipoGasto->tipo }}</div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Fecha y hora</div>
                      <div class="datagrid-content">{{ Carbon\Carbon::parse($gasto->fecha)->format('d/m/Y h:i:s A') }}</div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Monto</div>
                      <div class="datagrid-content">${{ $gasto->monto }}</div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Descripción</div>
                        <div class="datagrid-content">
                            {{ $gasto->desc }}
                        </div>
                      </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Fecha de creación</div>
                      <div class="datagrid-content">{{ Carbon\Carbon::parse($gasto->created_at)->format('d/m/Y h:i:s A') }}</div>
                    </div>
                    <div class="datagrid-item">
                      <div class="datagrid-title">Ultima actualización</div>
                      <div class="datagrid-content">
                        <div class="datagrid-content">{{ Carbon\Carbon::parse($gasto->updated_at)->format('d/m/Y h:i:s A') }}</div>
                      </div>
                    </div>
                    <div class="datagrid-item">
                        <div class="datagrid-title">Fecha de eliminación</div>
                        <div class="datagrid-content">
                          <div class="datagrid-content">{{ Carbon\Carbon::parse($gasto->deleted_at)->format('d/m/Y h:i:s A') }}</div>
                        </div>
                    </div>
                  </div>
                  <div class="empty">
                    <div class="empty-img">
                      <img src="{{ asset('img/comprobantes/'.$gasto->comprobante) }}" height="128" alt="">
                    </div>
                    @if ($gasto->comprobante != null)    
                      <div class="empty-action">
                        <a href="{{ asset('img/comprobantes/'.$gasto->comprobante) }}" class="btn btn-primary" download="Comprobante">
                          <i class=" ti ti-download icono"></i>
                          Descargar
                        </a>
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/gastos/crud-gasto.js') }}"></script>
<script src="{{ asset('assets/js/gastos/config.js') }}"></script>
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script>
    $( document ).ready(function() {
        getGastos(2, '');
        $("#modal-gasto").draggable();
        $("#modal-modulos").draggable();
        $("#modal-detalle-gasto").draggable();
    });
</script>
@endsection
