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
                <div class="card card-lg" id="reporte">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-10">
                          <img src="{{ asset('img/'.$setting->logotipo) }}" class="logo logo-icons logo-suffix" alt="Logotipo">
                        </div>
                        <div class="col-md-2 d-flex justify-content-end">
                          <a href="/api/print/{{$venta->id}}" target="_blank" class="btn btn-outline-success" id="imprimir"><i class="ti ti-download h1"></i></a>
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-6">
                          <small><strong class="datagrid-title class-name h6">Nombre o razón social: </strong> {{ $setting->razon_social }}</small>
                          <br>
                          <small><strong class="datagrid-title class-name h6">Número de identificación fiscal: </strong> {{ $venta->empleado->sucursal->rfc }}</small>
                          <br>
                          <small>
                            <address>
                              <strong class="datagrid-title class-name h6">Dirección: </strong>
                              {{$venta->empleado->sucursal->calle.' '.$venta->empleado->sucursal->n_exterior}}<br>
                              {{$venta->empleado->sucursal->colonia.', '.$venta->empleado->sucursal->cp}}<br>
                              {{$venta->empleado->sucursal->municipio.', '.$venta->empleado->sucursal->estado.', '.$venta->empleado->sucursal->ciudad}}<br>
                            </address>
                          </small>
                          <small><strong class="datagrid-title class-name h6">Teléfono: </strong> {{ $venta->empleado->sucursal->telefono }}</small>
                          <br>
                          <small><strong class="datagrid-title class-name h6">Correo electrónico: </strong> {{ $venta->empleado->sucursal->correo }}</small>
                        </div>
                        <div class="col-6 text-justify">
                          <small><strong class="datagrid-title class-name h6">Nombre o razón social: </strong> {{ $venta->cliente->nombres.' '.$venta->cliente->app.' '.$venta->cliente->apm }}</small>
                          <br>
                          <small><strong class="datagrid-title class-name h6">Número de identificación fiscal: </strong> {{ $venta->cliente->rfc }}</small>
                          <br>
                          <small>
                            <address>
                              <strong class="datagrid-title class-name h6">Dirección: </strong>
                              {{$venta->cliente->calle.' '.$venta->cliente->n_exterior}}<br>
                              {{$venta->cliente->colonia.', '.$venta->cliente->cp}}<br>
                              {{$venta->cliente->municipio.', '.$venta->cliente->estado.', '.$venta->cliente->ciudad}}<br>
                            </address>
                          </small>
                          <small><strong class="datagrid-title class-name h6">Teléfono: </strong> {{ $venta->cliente->telefono }}</small>
                          <br>
                          <small><strong class="datagrid-title class-name h6">Correo electrónico: </strong> {{ $venta->cliente->email }}</small>
                        </div>
                        <div class="col-12 my-3">
                          <small><strong class="datagrid-title class-name h6">Número de folio: </strong> {{ $venta->folio }}</small>
                          <br>
                          <small><strong class="datagrid-title class-name h6">Fecha y hora: </strong> {{ Carbon\Carbon::parse($venta->fecha)->format('d/m/Y h:i:s A')  }}</small>
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
                                    <td class="p-1">{{$venta->productos[$i]->pre_venta}}</td>
                                    <td class="p-1">${{  $venta->productos[$i]->pivot->importe}}</td>
                                  </tr>
                            @endfor
                            <tr>
                              <td colspan="4" class="p-1 strong text-end">Subtotal:</td>
                              <td class="p-1 text-end">${{ $venta->importe }}</td>
                            </tr>
                            <tr>
                              <td colspan="4" class="p-1 strong text-end">IVA (16%):</td>
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
                                  <td>Tipo de Pago: <i class="{{ $venta->tipo_pago == 'Efectivo' ? 'ti ti-brand-cashapp' : 'ti ti-brand-visa' }}"></i> {{ $venta->tipo_pago }}</td>
                                </tr>
                                <tr>
                                  <td>Estado: {{ $venta->estado}}</td>
                                </tr>
                              </tbody>
                            </thead>
                          </table>
                        </div>
                      </div>
                      <p class="text-muted text-center mt-3">Muchas gracias por hacer negocios con nosotros. ¡Esperamos trabajar con usted nuevamente!</p>
                    </div>
                  </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>
<div id="impresion" style="display: none;"></div>

@endsection
@section('script')
@endsection
