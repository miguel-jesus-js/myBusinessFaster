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
                  @if ($venta->tipo == 0)    
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-shopping-cart me-2"></i><a href="/historial">Ventas</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="ti ti-list-details me-2"></i><a href="/historial">Detalle</a></li>
                  @else
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-brand-shopee me-2"></i><a href="/dashboard">Compras</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="ti ti-list-details me-2"></i><a href="/historial">Detalle</a></li>
                  @endif
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
                                        <a href="/api/remision/{{$venta->id}}?isPrint=false" class="dropdown-item" target="_blank"><i class="ti ti-printer"></i>Descargar remisión</a>  
                                      </li>
                                  </ul>
                              </button>
                          </div>
                          @if ($venta->tipo == 0)    
                            <button class="nav-link dropdown-toggle btn btn-outline-success btn-sm mx-4 p-2" data-bs-toggle="dropdown"
                              data-bs-auto-close="outside" role="button" aria-expanded="true">
                              Ticket
                            </button>
                            <div class="dropdown-menu" data-bs-popper="static">
                              <button class="dropdown-item">
                                  <ul>
                                      <li>
                                        <a href="/api/ticket/{{$venta->id}}?isPrint=true" class="dropdown-item" target="_blank" ><i class="ti ti-printer"></i>Imprimir ticket</a>
                                      </li>
                                      <li>
                                        <a href="/api/ticket/{{$venta->id}}?isPrint=false" class="dropdown-item" target="_blank"><i class="ti ti-printer"></i>Descargar ticket</a>  
                                      </li>
                                  </ul>
                              </button>
                            </div>
                          @endif
                        </div>
                      </div>
                      <br>
                      <div class="row">
                        <div class="col-6">
                          <small><strong class="datagrid-title class-name h4">Información empresarial</strong></small>
                            <br>
                            <br>
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
                        @if ($venta->tipo == 0 || $venta->tipo == 2)    
                          @if ($venta->cliente_id == null)
                            <div class="col-6 text-justify">
                              <small><strong class="datagrid-title class-name h6">Venta al publico en general</strong></small>
                            </div>
                          @else
                            <div class="col-6 text-justify">
                              <small><strong class="datagrid-title class-name h4">Datos del cliente</strong></small>
                              <br>
                              <br>
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
                        @else
                          <div class="col-6 text-justify">
                            <small><strong class="datagrid-title class-name h4">Datos de proveedor</strong></small>
                            <br>
                            <br>
                            <small><strong class="datagrid-title class-name h6">Nombre o razón social: </strong> {{ $venta->proveedor->persona->nombres }}</small>
                            <br>
                            <small><strong class="datagrid-title class-name h6">Número de identificación fiscal: </strong> {{ $venta->proveedor->persona->rfc }}</small>
                            <br>
                            <small><strong class="datagrid-title class-name h6">Empresa: </strong> {{ $venta->proveedor->empresa }}</small>
                            <br>
                            <small><strong class="datagrid-title class-name h6">Clave: </strong> {{ $venta->proveedor->clave }}</small>
                            <br>
                            <small>
                              <address>
                                <strong class="datagrid-title class-name h6">Dirección: </strong>
                                {{$venta->proveedor->calle.' '.$venta->proveedor->n_exterior}}<br>
                                {{$venta->proveedor->colonia.', '.$venta->proveedor->cp}}<br>
                                {{$venta->proveedor->municipio.', '.$venta->proveedor->estado.', '.$venta->proveedor->ciudad}}<br>
                              </address>
                            </small>
                            <small><strong class="datagrid-title class-name h6">Teléfono: </strong> {{ $venta->proveedor->persona->telefono }}</small>
                            <br>
                            <small><strong class="datagrid-title class-name h6">Correo electrónico: </strong> {{ $venta->proveedor->persona->email }}</small>
                          </div>
                        @endif
                        <div class="col-12 my-3">
                          <small><strong class="datagrid-title class-name h6">Número de folio: </strong> {{ $venta->folio }}</small>
                          <br>
                          <small><strong class="datagrid-title class-name h6">Fecha y hora: </strong> {{ Carbon\Carbon::parse($venta->fecha)->format('d/m/Y h:i:s A')  }}</small>
                          <br>
                          @switch($venta->tipo)
                            @case(0)
                              <small><strong class="datagrid-title class-name h6">Tipo de venta: </strong> {{ \App\Models\Venta::TIPO_VENTA[$venta->tipo_venta] }}</small>
                              @break
                            @case(1)
                              <small><strong class="datagrid-title class-name h6">Tipo de compra: </strong> {{ \App\Models\Venta::TIPO_COMPRA[$venta->tipo_venta] }}</small>
                              @break
                            @case(2)
                            <small><strong class="datagrid-title class-name h6">Tipo: </strong> {{ \App\Models\Venta::TIPO_DOCUMENTO[$venta->tipo] }}</small>
                            @break
                            @default 
                          @endswitch
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
                              <th>Importe</th>
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
                      <div class="row my-4">
                        <div class="col-md-5">
                          <table class="table bg-white table-bordered">
                            <thead class="disable-selection">
                              <tr>
                                <th>Información de pago</th>
                              </tr>
                              <tbody>
                                <tr>
                                  <td class="p-1">
                                      Modalidad: 
                                      @if ($venta->tipo == 1)
                                        Compra de contado
                                      @else
                                        {{ $venta->tipo_venta == 3 ? 'Venta a crédito' : 'Venta de contado'  }}    
                                      @endif
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
                      @if ($venta->tipo_venta == 3)
                      <div class="table-responsive">
                        <table class="table bg-white table-bordered">
                          <thead class="disable-selection">
                            <tr>
                              <th>ID</th>
                              <th>Empleado</th>
                              <th>Fecha estimada</th>
                              <th>Fecha de pago</th>
                              <th>Anticipo</th>
                              <th>Monto</th>
                              <th>Efectivo</th>
                              <th>Cambio</th>
                              <th>Tipo de pago</th>
                              <th>Estado</th>
                              <th>Acciones</th>
                            </tr>
                            <tbody>
                              @foreach ($venta->pagos as $pago)
                                <tr>
                                  <td>{{ $pago->id }}</td>
                                  <td>{{ $pago->empleado->persona->nombres }}</td>
                                  <td>{{ Carbon\Carbon::parse($pago->fecha_estimada)->format('d/m/Y h:i:s A') }}</td>
                                  <td>{{ Carbon\Carbon::parse($pago->fecha)->format('d/m/Y h:i:s A') }}</td>
                                  <td>{{ $pago->anticipo }}</td>
                                  <td>{{ $pago->monto }}</td>
                                  <td>{{ $pago->paga_con }}</td>
                                  <td>{{ $pago->cambio }}</td>
                                  <td>{{ $pago->tipo_pago == 0 ? 'Efectivo' : 'Tarjeta' }}</td>
                                  <td>
                                    <span class="badge {{ \App\Models\Pago::ARRAY_ESTADOS_COLOR[$pago->estado]}} ">{{ \App\Models\Pago::ARRAY_ESTADOS[$pago->estado]}} </span>
                                  </td>
                                  <td>
                                    @switch($pago->estado)
                                        @case(1)
                                            <button type="button" class="btn btn-danger btn-sm">Cancelar</button>
                                            @break
                                        @case(2)
                                          <button type="button" class="btn btn-primary btn-sm" onclick="openModalPago({{$pago->id}}, {{$pago->venta_id}}, {{ $pago->monto}}, {{ $pago->anticipo}})">Realizar pago</button>
                                            @break
                                        @default
                                          <button type="button" class="btn btn-primary btn-sm" onclick="openModalPago({{$pago->id}}, {{$pago->venta_id}}, {{ $pago->monto}}, {{ $pago->anticipo}})">Reintentar pago</button>
                                    @endswitch
                                  </td>
                                </tr>                                  
                              @endforeach
                            </tbody>
                          </thead>
                        </table>
                      </div>
                      @endif
                      @if ($venta->tipo == 0)  
                        <p class="text-muted text-center mt-3">Muchas gracias por hacer negocios con nosotros. ¡Esperamos trabajar con usted nuevamente!</p>
                      @endif
                    </div>
                  </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-realizar-pago" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="modal-title">Realizar pago</h5>
              <button type="button" class="btn-close" onclick="closeModal('modal-realizar-pago', 'form-add-pago')"></button>
          </div>
          <div class="modal-body">
              <form id="form-add-pago">
                  <div class="tab-content">
                      <div id="load-form" class="efecto-cargando">
                      </div>
                      <input type="hidden" class="form-control form-control-lg" name="id" id="id" autocomplete="off" required>
                      <input type="hidden" class="form-control form-control-lg" name="venta_id" id="venta_id" autocomplete="off" required>
                      <input type="hidden" class="form-control form-control-lg" name="total_pagar" id="total_pagar" autocomplete="off" required>
                      <div class="row mb-2">
                        <label class="form-label required">Monto</label>
                        <div class="input-group">
                          <span class="input-group-text">
                              <i class="ti ti-currency-dollar"></i>
                          </span>
                          <input type="number" class="form-control form-control-lg" name="monto" id="monto" placeholder="0.00" autocomplete="off" required min="1" step=0.01 disabled>
                        </div>
                        <label class="form-label required">Anticipo</label>
                        <div class="input-group">
                          <span class="input-group-text">
                              <i class="ti ti-currency-dollar"></i>
                          </span>
                          <input type="number" class="form-control form-control-lg" name="anticipo" id="anticipo" placeholder="0.00" autocomplete="off" required min="0" step=0.01 disabled>
                        </div>
                        <label class="form-label required">Efectivo</label>
                        <div class="input-group">
                          <span class="input-group-text">
                              <i class="ti ti-currency-dollar"></i>
                          </span>
                          <input type="number" class="form-control form-control-lg" name="paga_con" id="paga_con" placeholder="0.00" autocomplete="off" required min="1" step=0.01>
                        </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-realizar-pago', 'form-add-pago')">Cancelar</button>
                          <button type="submit" class="btn btn-blue btn-pill">
                              <span id="load-button" class="spinner-grow spinner-grow-sm me-1 d-none" role="status" aria-hidden="true"></span>
                              <b id="btn-modal"></b>
                          </button>
                      </div>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

@endsection
@section('script')
  <script src="{{ asset('assets/js/pagos/pagos.js') }}"></script>
  <script src="{{ asset('assets/js/shared.js') }}"></script>
@endsection
