<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo-icono.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Raleway:wght@300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/punto_venta.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/iconfont/tabler-icons.min.css') }}">
    @yield('css')
    <title>SOFTCODE</title>
</head>

<body>
    <div class="container-fluid">
        <div class="page-wrapper">
            <!-- Page-body start -->
            <div class="page-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                    <span class="avatar avatar-md" style="background-image: url({{ asset('img/usuarios/'.Auth::user()->persona->foto_perfil) }})"></span>
                    </div>
                    <div class="col">
                    <h1 class="page-title">Te atiende</h1>
                    <div class="page-subtitle">
                        <div class="row">
                        <div class="col-auto">
                            <i class="ti ti-user icono"></i>
                            <label class="text-reset h2">{{ Auth::user()->persona->nombres}}</label>
                        </div>
                        <div class="col-auto">
                            <i class="ti ti-briefcase icono"></i>
                            <label class="text-reset h2">{{ Auth::user()->sucursal->nombre }}</label>
                        </div>
                        <div class="col-auto">
                            <i class="ti ti-device-desktop icono"></i>
                            <label class="text-reset h2">Caja 1</label>
                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="col-auto d-none d-md-flex">
                        <div class="col">
                            @php
                                $diaActual = \Carbon\Carbon::now()->isoFormat('dddd D \d\e MMMM \d\e\l Y');
                                echo '<h1 class="page-title">'.$diaActual.'</h1>'
                            @endphp
                            <div class="page-subtitle">
                            <div class="row">
                                <div class="col-auto">
                                    <i class="ti ti-clock-hour-2 icono"></i>
                                    <label class="text-reset h2" id="reloj">00 : 00 : 00</label>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row" id="">
                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <section class="search-producto">
                                    <form action="" id="form-search-producto">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <label class="form-label" for="">Producto</label>
                                                <div class="row g-2">
                                                    <div class="col">
                                                    <input type="text" class="form-control" name="cod_barra_search" id="cod_barra_search" placeholder="Código de barras" required autocomplete="off" autofocus>
                                                    </div>
                                                    <div class="col-auto">
                                                    <button type="submit" class="btn" aria-label="Button">
                                                        <i class="ti ti-search icono"></i>
                                                    </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label" for="">Cantidad</label>
                                                <input type="number" class="form-control" name="cantidad_pro" id="cantidad_pro" placeholder="Cantidad" required autocomplete="off" min="1" value="1">
                                            </div>
                                        </div>
                                    </form>
                                </section>
                            </div>
                        </div>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <section class="table-productos">
                                    <div class="d-flex justify-content-end">
                                        <button class="btn btn-outline-secondary btn-sm btn-pill" onclick="cleanCart()">
                                            Limpiar carrito
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                    <table class="table shadow-sm table-bordered table-hover table-striped" id="carrito">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th style="width: 15%">Precio</th>
                                                <th style="width: 25%">Cantidad</th>
                                                <th style="width: 15%">Importe</th>
                                                <th style="width: 15%">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </section>
                            </div>
                            <div class="card-footer text-end">
                                <h4 class="text-secondary">Productos  (<b id="total_productos"></b> productos)</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <form action="" id="form-add-venta">
                                    <section class="informacion">
                                        <label class="form-check mb-3">
                                            <input class="form-check-input" type="checkbox" id="check-cliente">
                                            <span class="form-check-label">Aplicar cliente</span>
                                        </label>
                                        <div class="mb-3 d-none" id="div-cliente">
                                            <div class="form-label required">Cliente</div>
                                            <div class="input-group w-100" id="group-cliente">
                                                <select class="select2 form-select" name="cliente_id" id="cliente_id" required disabled="true">
                                                </select>
                                                <button type="button" class="btn bg-secondary-lt" id="add-cliente" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar cliente"><i class="ti ti-plus"></i></button>
                                                <button type="button" class="btn bg-secondary-lt" id="reload-cliente" data-bs-toggle="tooltip" data-bs-placement="top" title="Recargar"><i class="ti ti-refresh"></i></button>
                                            </div>
                                        </div>
                                    </section>
                                    <section class="costos">
                                        <div class="row mb-2 d-flex justify-content-end">
                                            <div class="col-auto">
                                                <h5>SUBTOTAL:</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-currency-dollar"></i>
                                                    </span>
                                                    <input type="number" class="form-control form-control-lg" name="subtotal" id="subtotal" placeholder="0.00" required autocomplete="off" readonly min="1" step=0.01>
                                                    <input type="hidden" name="tipo"  required autocomplete="off" readonly value="0">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2 d-flex justify-content-end">
                                            <div class="col-auto">
                                                <h5>
                                                    <label class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="check-iva" data-iva="{{ $settings->iva }}">
                                                        <span class="form-check-label">IVA <b>({{ $settings->iva }}%)</b>:</span>
                                                    </label>
                                                </h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-currency-dollar"></i>
                                                    </span>
                                                    <input type="number" class="form-control form-control-lg" name="iva" id="iva" placeholder="0.00" autocomplete="off" required readonly min="0" step=0.01> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2 d-flex justify-content-end">
                                            <div class="col-auto">
                                                <h5>DESCUENTO:</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-currency-dollar"></i>
                                                    </span>
                                                    <input type="number" class="form-control form-control-lg" name="descuento" id="descuento" placeholder="0.00" autocomplete="off" required readonly value="0.00" min="0" step=0.01>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2 d-flex justify-content-end d-none" id="div-pago-inicial">
                                            <div class="col-auto">
                                                <h5 id="txt-paga-con">PAGO INICIAL:</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-currency-dollar"></i>
                                                    </span>
                                                    <input type="number" class="form-control form-control-lg" name="pago_inicial" id="pago_inicial" placeholder="0.00" autocomplete="off" required min="1" step=0.01>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2 d-flex justify-content-end">
                                            <div class="col-auto">
                                                <h5 id="txt-paga-con">EFECTIVO:</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-currency-dollar"></i>
                                                    </span>
                                                    <input type="number" class="form-control form-control-lg" name="paga_con" id="paga_con" placeholder="0.00" autocomplete="off" required min="1" step=0.01>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-3 d-none" id="div-periodos">
                                                <label class="form-label required">Periodos de pago</label>
                                                <select class="form-select" name="periodo_pagos" id="periodo_pagos" required disabled="true">
                                                    <option value="" disabled selected>Elige una opción</option>
                                                    @foreach (\App\Models\Venta::PERIODO_PAGOS as $periodo => $nombre)
                                                      <option value="<?php echo $periodo ?>"><?php echo $nombre ?></option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3 d-none" id="div-dias">
                                                <label class="form-label required">Dias de crédito</label>
                                                <input type="number" class="form-control" name="dias_credito" id="dias_credito" placeholder="0" autocomplete="off" readonly>
                                            </div>
                                            <div class="col-md-4 mb-3 d-none" id="div-limite">
                                                <label class="form-label required">Límite de crédito</label>
                                                <input type="number" class="form-control" name="limite_credito" id="limite_credito" placeholder="0.00" autocomplete="off" readonly min="1" step=0.01>
                                            </div>
                                        </div>
                                        <h2 class="d-none" id="pago-periodo"></h2>
                                        <button class="btn btn-lime btn-lg w-100 mt-2" type="submit"><b class="ms-2" id="total_pagar" data-total=""> $0.00</b></button>
                                    </section>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- End row -->
            </div>
            <!-- Page-body end -->
        </div>
    </div>
    @include('modals.modal_cliente')
    <!-- Required Jquery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/tabler.min.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/respuestas.js') }}"></script>
    <script src="{{ asset('assets/js/openCloseModal.js') }}"></script>
    <script src="{{ asset('assets/js/shared.js') }}"></script>
    <script src="{{ asset('assets/js/punto_venta/punto_venta.js') }}"></script>
    <script src="{{ asset('assets/js/clientes/crud-cliente.js') }}"></script>
    <script src="{{ asset('assets/js/clientes/config.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            let search = window.location.search.split('=');
            tipoVenta = search[1];
            if(tipoVenta == 3){
                $('#check-cliente').prop('checked', true);
                $('#div-periodos').removeClass('d-none');
                $('#periodo_pagos').prop('disabled', false);
                $('#div-dias').removeClass('d-none');
                $('#dias_credito').prop('disabled', false);
                $('#div-limite').removeClass('d-none');
                $('#limite_credito').prop('disabled', false);
                getClientesSelect2();
                $('#div-cliente').removeClass('d-none');
                $('#cliente_id').prop('disabled', false);
                $('#cliente_id').select2({
                    placeholder: 'Selecciona un cliente',
                    theme: 'tabler',
                });
                $('#div-pago-inicial').removeClass('d-none');
                $('#pago-periodo').removeClass('d-none');
            }else{
                $('#pago_inicial').prop('disabled', true);
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
</body>

</html>