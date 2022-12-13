@extends('layouts.base')
@section('css')

@endsection
@section('contenido')

<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">PRODUCTOS</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-home me-2"></i><a href="/">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-cookie me-2"></i><a href="/">Productos</a></li>
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
            <div class="card p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div id="carousel-indicators-thumb" class="carousel slide carousel-fade" data-bs-ride="carousel">
                            <div class="carousel-indicators carousel-indicators-thumb">
                              <button type="button" data-bs-target="#carousel-indicators-thumb" data-bs-slide-to="0" class="ratio ratio-4x3 active" style="background-image: url({{ asset('img/productos/'.$producto->img1) }})"></button>
                              <button type="button" data-bs-target="#carousel-indicators-thumb" data-bs-slide-to="1" class="ratio ratio-4x3" style="background-image: url({{ asset('img/productos/'.$producto->img2) }})"></button>
                              <button type="button" data-bs-target="#carousel-indicators-thumb" data-bs-slide-to="2" class="ratio ratio-4x3" style="background-image: url({{ asset('img/productos/'.$producto->img3) }})"></button>
                            </div>
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                <img class="d-block w-100" style="max-height: 280px; min-height: 280px" alt="" src="{{ asset('img/productos/'.$producto->img1) }}">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" style="max-height: 280px; min-height: 280px" alt="" src="{{ asset('img/productos/'.$producto->img2) }}">
                              </div>
                              <div class="carousel-item">
                                <img class="d-block w-100" style="max-height: 280px; min-height: 280px" alt="" src="{{ asset('img/productos/'.$producto->img3) }}">
                              </div>
                            </div>
                        </div>
                        <br>
                        <center>
                            <img id="codigo"/ style="max-height: 100px;">
                        </center>
                    </div>
                    <div class="col-md-6">
                        <h2>{{ $producto->producto }}</h2>
                        <br>
                        <div class="table-responsive">
                            <table class="table shadow-sm bg-white">
                                <center><h4>Lista de precios</h4></center>
                                <thead>
                                    <tr>
                                        <th>Compra</th>
                                        <th>Venta</th>
                                        <th>Mayoreo</th>
                                        <th>Utilidad</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <tr>
                                        <td>{{ '$'.number_format($producto->pre_compra, 2) }}</td>
                                        <td>{{ '$'.number_format($producto->pre_venta, 2) }}</td>
                                        <td>{{ '$'.number_format($producto->pre_mayoreo, 2) }}</td>
                                        <td>{{ '$'.number_format($producto->utilidad, 2) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <div class="row border py-2">
                            <div class="col-auto">
                                <span class="avatar bg-primary-lt"><i class="ti ti-truck"></i></span>
                            </div>
                            <div class="col">
                              <div class="text-truncate">
                                <strong>{{ $producto->proveedores->nombres.' '.$producto->proveedores->app.' '.$producto->proveedores->apm}}</strong>
                              </div>
                              <div class="text-muted">{{ $producto->proveedores->empresa }}</div>
                            </div>
                            <div class="col-auto align-self-center">
                              <div class="badge bg-primary"></div>
                            </div>
                        </div>
                        <br>
                        <span class="status status-cyan">
                            <span class="status-dot status-dot-animated"></span>
                            Stock: {{ $producto->stock }}
                        </span>
                        <span class="status status-red">
                            <span class="status-dot status-dot-animated"></span>
                            Stock mínimo: {{ $producto->stock_min }}
                        </span>
                        <span class="status mb-2 status-indigo">
                            <span class="status-dot status-dot-animated"></span>
                            Marca: {{ $producto->marcas->marca }}
                        </span>
                        <span class="status mb-2 status-orange">
                            <span class="status-dot status-dot-animated"></span>
                            Alamcén: {{ $producto->almacenes->nombre }}
                        </span>
                        <span class="status mb-2 status-teal">
                            <span class="status-dot status-dot-animated"></span>
                            U.medida: {{ $producto->unidadMedidas->unidad_medida }}
                        </span>
                        <span class="status mb-2 status-pink">
                            <span class="status-dot status-dot-animated"></span>
                            Material: {{ $producto->materiales == null ? '' : $producto->materiales->material }}
                        </span>
                    </div>
                    <br>
                    <hr>
                    <div class="col-sm-6 col-md-4 p-4">
                        <h4>Características</h4>
                        <ul>
                            @foreach ($producto->caracteristicas as $caracteristica)
                                <li>-{{$caracteristica->caracteristica}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-sm-6 col-md-4 p-4">
                        <h4>Categorias</h4>
                        <ul>
                            @foreach ($producto->categorias as $categoria)
                                <li>-{{$categoria->categoria}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-4 border p-4">
                        <h4>Información adicional</h4>
                        <ul>
                            <li>Código del sat: {{ $producto->cod_sat }}</li>
                            <li>Fecha de caducidad: {{ $producto->caducidad }}</li>
                            <li>Color: {{ $producto->color }}</li>
                            <li>Talla: {{ $producto->talla }}</li>
                            <li>Modelo: {{ $producto->modelo }}</li>
                            <li>Meses de garantía: {{ $producto->meses_garantia }}</li>
                            <li>Peso en kg: {{ $producto->peso_kg }}</li>
                            <li>Peso en kg: {{ $producto->peso_kg }}</li>
                            <li>Es producción: {{ $producto->es_produccion == 1 ? 'Si' : 'No' }}</li>
                            <li>Afecta a ventas: {{ $producto->afecta_ventas == 1 ? 'Si' : 'No' }}</li>
                            <div class="hr-text">Descripción</div>
                            <p>{{ $producto->desc_detallada }}</p>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('assets/js/productos/config.js') }}"></script>
<script src="{{ asset('assets/js/productos/crud-producto.js') }}"></script>
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script src="{{ asset('assets/js/jsBarcode.all.min.js') }}"></script>

<script>
    $( document ).ready(function() {
        JsBarcode("#codigo", {{ $producto->cod_barra }});
    });
</script>
@endsection
