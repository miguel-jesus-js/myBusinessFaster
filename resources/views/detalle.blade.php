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
                          <button class="nav-link dropdown-toggle btn btn-outline-success btn-sm mx-4 p-2" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="true">
                            Remisión
                          </button>
                          <div class="dropdown-menu" data-bs-popper="static">
                              <button class="dropdown-item">
                                  <ul>
                                      <li>
                                        <a href="/api/remision/{{$venta->id}}?isPrint=true" class="dropdown-item" target="_blank" ><i class="ti ti-printer"></i>Imprimir remisión</a>
                                      </li>
                                      <li>
                                        <a href="/api/ticket/{{$venta->id}}?isPrint=false" class="dropdown-item" target="_blank"><i class="ti ti-printer"></i>Descargar remisión</a>  
                                      </li>
                                  </ul>
                              </button>
                          </div>
                          <button class="nav-link dropdown-toggle btn btn-outline-success btn-sm mx-4 p-2" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="true">
                            Ticket
                          </button>
                          <div class="dropdown-menu" data-bs-popper="static">
                              <button class="dropdown-item">
                                  <ul>
                                      <li>
                                        <a href="/api/remision/{{$venta->id}}?isPrint=true" class="dropdown-item" target="_blank" ><i class="ti ti-printer"></i>Imprimir ticket</a>
                                      </li>
                                      <li>
                                        <a href="/api/ticket/{{$venta->id}}?isPrint=false" class="dropdown-item" target="_blank"><i class="ti ti-printer"></i>Descargar ticket</a>  
                                      </li>
                                  </ul>
                              </button>
                          </div>
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
                          <small><strong class="datagrid-title class-name h6">Tipo de venta: </strong> {{ $venta->tipo_venta == 0 ? 'Venta a menudeo' : 'Venta a mayoreo' }}</small>
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
                            @if ($venta->tipo_venta_pago == 0)
                            <tr>
                                <td colspan="4" class="p-1 strong text-end">Efectivo:</td>
                                <td class="p-1 text-end">${{ $venta->paga_con }}</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="p-1 strong text-end">Cambio:</td>
                                <td class="p-1 text-end">${{ $venta->paga_con - $venta->total }}</td>
                            </tr>
                            @else
                            <tr>
                                <td colspan="4" class="p-1 strong text-end">Pago inicial:</td>
                                <td class="p-1 text-end">${{ $venta->pago_inicial }}</td>
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
                                      Modalidad: {{ $venta->tipo_venta_pago == 0 ? 'Venta de contado' : 'Venta a crédito' }}
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
                                @if ($venta->tipo_venta_pago == 1)
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
