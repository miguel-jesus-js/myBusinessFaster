@extends('layouts.base')
@section('contenido')
<div class="page-header" id="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">DASHBOARD</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><a href="/" class="invisible">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="/dashboard">Dashboard</a></li>
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
                <div class="row row-cards">
                    <div class="col-sm-6 col-lg-6 col-xl-3">
                      <div class="card card-sm">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <span class="bg-primary text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
                                <i class="ti ti-currency-dollar icon-dashboard"></i>
                              </span>
                            </div>
                            <div class="col">
                              <div class="font-weight-medium">
                               <b class="count">{{ $totales[0] }}</b> Ventas totales (hoy)
                              </div>
                              <div class="text-muted">
                                <b class="count">{{ $totales[1] }}</b> Mi sucursal
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-lg-6 col-xl-3">
                      <div class="card card-sm">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <span class="bg-green text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/shopping-cart -->
                                <i class="ti ti-cookie icon-dashboard"></i>
                              </span>
                            </div>
                            <div class="col">
                              <div class="font-weight-medium">
                                {{ $totales[2] }} Productos totales
                              </div>
                              <div class="text-muted">
                                {{ $totales[3] }} Mi sucursal
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-lg-6 col-xl-3">
                      <div class="card card-sm">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <span class="bg-twitter text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                <i class="ti ti-users icon-dashboard"></i>
                            </div>
                            <div class="col">
                              <div class="font-weight-medium">
                                {{ $totales[4] }} Empleados totales
                              </div>
                              <div class="text-muted">
                                {{ $totales[5] }} Mi sucursal
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-6 col-lg-6 col-xl-3">
                      <div class="card card-sm">
                        <div class="card-body">
                          <div class="row align-items-center">
                            <div class="col-auto">
                              <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                                <i class="ti ti-friends icon-dashboard"></i>
                              </span>
                            </div>
                            <div class="col">
                              <div class="font-weight-medium">
                                {{ $totales[5] }} Clientes totales
                              </div>
                              {{-- <div class="text-muted">
                                21 Mi sucursal
                              </div> --}}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                <div class="row">
                    <!-- Material statustic card start -->
                    {{-- <div class="col-xl-4 col-md-12">
                        <div class="card mat-stat-card">
                            <div class="card-block">
                                <div class="row align-items-center b-b-default">
                                    <div class="col-sm-6 b-r-default p-b-20 p-t-20">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="far fa-user text-c-purple f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>10K</h5>
                                                <p class="text-muted m-b-0">Visitors</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 p-b-20 p-t-20">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i
                                                    class="fas fa-volume-down text-c-green f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>100%</h5>
                                                <p class="text-muted m-b-0">Volume</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-sm-6 p-b-20 p-t-20 b-r-default">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="far fa-file-alt text-c-red f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>2000+</h5>
                                                <p class="text-muted m-b-0">Files</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 p-b-20 p-t-20">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i
                                                    class="far fa-envelope-open text-c-blue f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>120</h5>
                                                <p class="text-muted m-b-0">Mails</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12">
                        <div class="card mat-stat-card">
                            <div class="card-block">
                                <div class="row align-items-center b-b-default">
                                    <div class="col-sm-6 b-r-default p-b-20 p-t-20">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i
                                                    class="fas fa-share-alt text-c-purple f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>1000</h5>
                                                <p class="text-muted m-b-0">Share</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 p-b-20 p-t-20">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="fas fa-sitemap text-c-green f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>600</h5>
                                                <p class="text-muted m-b-0">Network</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row align-items-center">
                                    <div class="col-sm-6 p-b-20 p-t-20 b-r-default">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="fas fa-signal text-c-red f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>350</h5>
                                                <p class="text-muted m-b-0">Returns</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 p-b-20 p-t-20">
                                        <div class="row align-items-center text-center">
                                            <div class="col-4 p-r-0">
                                                <i class="fas fa-wifi text-c-blue f-24"></i>
                                            </div>
                                            <div class="col-8 p-l-0">
                                                <h5>100%</h5>
                                                <p class="text-muted m-b-0">Connections</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-12">
                        <div class="card mat-clr-stat-card text-white green ">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-3 text-center bg-c-green">
                                        <i class="fas fa-star mat-icon f-24"></i>
                                    </div>
                                    <div class="col-9 cst-cont">
                                        <h5>4000+</h5>
                                        <p class="m-b-0">Ratings Received</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card mat-clr-stat-card text-white blue">
                            <div class="card-block">
                                <div class="row">
                                    <div class="col-3 text-center bg-c-blue">
                                        <i class="fas fa-trophy mat-icon f-24"></i>
                                    </div>
                                    <div class="col-9 cst-cont">
                                        <h5>17</h5>
                                        <p class="m-b-0">Achievements</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Material statustic card end -->
                    <!-- order-visitor start -->


                    <!-- order-visitor end -->

                    <!--  sale analytics start -->
                    <div class="col-xl-6 col-md-12">
                        <div class="card table-card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5>Rendimiento de los vendedores (Hoy)</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="form-select" name="sucursale_id" id="sucursale_id" onclick="getSucursales()">
                                            <option value="" id="load-select" disabled selected>Elige una sucursal</option>
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="card-block card-table">
                                <div class="table-responsive">
                                    <table class="table table-hover m-b-0 without-header" id="table-saleByEmployees">
                                        <tbody>
                                            
                                        </tbody>
                                        {{-- <tfoot>
                                            <tr>
                                                <td colspan='15'>
                                                    <ul class='pagination d-flex justify-content-end' id="paginacion">
                                                        
                                                    </ul>
                                                </td>
                                            </tr>
                                        </tfoot> --}}
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-md-12">
                        <div class="row">
                            <!-- sale card start -->
                            <div class="col-md-6">
                                <div class="card text-center order-visitor-card">
                                    <div class="card-block">
                                        <h6 class="m-b-0">Productos vendidos</h6>
                                        <h4 class="m-t-15 m-b-15">
                                            <b class="count">{{$productos_v_t}}</b>
                                        </h4>
                                        <p class="m-b-0">En las ultimas 24 horas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card text-center order-visitor-card">
                                    <div class="card-block">
                                        <h6 class="m-b-0">Ventas totales</h6>
                                        <h4 class="m-t-15 m-b-15 count">
                                            $<b class="count">{{$ventas_totales}}</b>
                                        </h4>
                                        <p class="m-b-0">En las ultimas 24 horas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="table-responsive card-table-pro">
                                    <table class="table bg-white shadow-sm table-bordered table-hover w-100">
                                        <thead>
                                          <tr>
                                            <th>Producto</th>
                                            <th>Precio</th>
                                            <th>Cantidad</th>
                                            <th>importe</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($productos_t as $item)
                                                <tr>
                                                    <td>{{ $item->producto->producto }}</td>
                                                    <td>${{ $item->precio }}</td>
                                                    <td>{{ $item->total_cantidad }}</td>
                                                    <td>${{ $item->precio * $item->total_cantidad }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                              </div>
                            {{-- <div class="col-md-6">
                                <div class="card bg-c-red total-card">
                                    <div class="card-block">
                                        <div class="text-left">
                                            <h4>489</h4>
                                            <p class="m-0">Total Comment</p>
                                        </div>
                                        <span class="label bg-c-red value-badges">15%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-c-green total-card">
                                    <div class="card-block">
                                        <div class="text-left">
                                            <h4>$5782</h4>
                                            <p class="m-0">Income Status</p>
                                        </div>
                                        <span class="label bg-c-green value-badges">20%</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card text-center order-visitor-card">
                                    <div class="card-block">
                                        <h6 class="m-b-0">Unique Visitors</h6>
                                        <h4 class="m-t-15 m-b-15"><i
                                                class="fa fa-arrow-down m-r-15 text-c-red"></i>652
                                        </h4>
                                        <p class="m-b-0">36% From Last 6 Months</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card text-center order-visitor-card">
                                    <div class="card-block">
                                        <h6 class="m-b-0">Monthly Earnings</h6>
                                        <h4 class="m-t-15 m-b-15"><i
                                                class="fa fa-arrow-up m-r-15 text-c-green"></i>5963
                                        </h4>
                                        <p class="m-b-0">36% From Last 6 Months</p>
                                    </div>
                                </div>
                            </div> --}}
                            <!-- sale card end -->
                        </div>
                    </div>

                    <!--  sale analytics end -->

                    <!-- Project statustic start -->
                    <div class="col-xl-12 mt-4">
                        <div class="row">
                            @foreach ($ventas_by_sucursal as $item)    
                            <div class="col-md-4">
                                <div class="card proj-progress-card">
                                    <div class="card-block">
                                        <div class="row">
                                            <h6>{{ $item->nombre }}</h6>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Ayer</label>
                                                    <h5 class="m-b-30 f-w-700">${{ $item->total_ayer }} </h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Hoy</label>
                                                    <h5 class="m-b-30 f-w-700">${{ $item->total_hoy }}</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    @php
                                                        $residuo = $item->total_hoy - $item->total_ayer;
                                                        $porcentaje = 0;
                                                        if($item->total_hoy != 0){
                                                            $porcentaje = ($residuo / $item->total_hoy) * 100;
                                                        }
                                                    @endphp
                                                    <label class="invisible" for="">%</label>
                                                    <h6 class="m-b-30 f-w-700"><span class="{{$porcentaje > 0 ? 'text-c-green' : 'text-c-red'}} m-l-10">{{$porcentaje}}%</span></h6>
                                                </div>
                                            </div>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-primary" style="width: 71.0%"></div>
                                              </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Project statustic end -->
                </div>
            </div>
            <!-- Page-body end -->
        </div>
        <div id="styleSelector"> </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-information" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Advertencia</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="empty">
                    <div class="empty-img"><img src="{{ asset('img/settings.jpg') }}" height="128" alt="">
                    </div>
                    <p class="empty-title">Empresa no configurada</p>
                    <p class="empty-subtitle text-muted">
                      Dirigite a la opción de configuraciones para agregar la información de tu empresa
                    </p>
                    <div class="empty-action">
                      <a href="/settings" class="btn btn-primary">
                        <i class="ti ti-settings"></i>
                        Ir a configuración
                      </a>
                    </div>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/dashboard/dashboard-info.js') }}"></script>
<script src="{{ asset('assets/js/almacenes/config.js') }}"></script>
<script src="{{ asset('assets/js/counter.js') }}"></script>
<script>
    $(document).ready(function(){
        //$('#modal-information').modal('show')
        getSaleByEmployees(1, 0, 5);
    })
</script>
@endsection
