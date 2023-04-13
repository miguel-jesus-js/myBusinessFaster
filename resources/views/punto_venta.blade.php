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
                    <span class="avatar avatar-md" style="background-image: url({{ asset('img/usuarios/'.Auth::user()->foto_perfil) }})"></span>
                    </div>
                    <div class="col">
                    <h1 class="page-title">Te atiende</h1>
                    <div class="page-subtitle">
                        <div class="row">
                        <div class="col-auto">
                            <i class="ti ti-user icono"></i>
                            <label class="text-reset h2">{{ Auth::user()->nombres.' '.Auth::user()->app.' '.Auth::user()->apm }}</label>
                        </div>
                        <div class="col-auto">
                            <i class="ti ti-briefcase icono"></i>
                            <label class="text-reset h2">{{ Auth::user()->roles->rol }}</label>
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
                                    <table class="table shadow-sm table-bordered table-hover" id="carrito">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>Precio</th>
                                                <th>Cantidad</th>
                                                <th>Importe</th>
                                                <th>Acciones</th>
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
                                        <div class="mb-3">
                                            <div class="form-label">Cliente</div>
                                            <div class="input-group w-100">
                                                <select class="select2 form-select" name="cliente_id" id="cliente_id">
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
                                                    <input type="number" class="form-control form-control-sm" name="subtotal" id="subtotal" placeholder="0.00" required autocomplete="off" readonly min="1" step=0.01>
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
                                                    <input type="number" class="form-control form-control-sm" name="iva" id="iva" placeholder="0.00" autocomplete="off" required readonly min="0" step=0.01> 
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
                                                    <input type="number" class="form-control form-control-sm" name="descuento" id="descuento" placeholder="0.00" autocomplete="off" required readonly value="0.00" min="0" step=0.01>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-2 d-flex justify-content-end">
                                            <div class="col-auto">
                                                <h5>EFECTIVO:</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="ti ti-currency-dollar"></i>
                                                    </span>
                                                    <input type="number" class="form-control form-control-sm" name="paga_con" id="paga_con" placeholder="0.00" autocomplete="off" required min="1" step=0.01>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-lime btn-lg w-100" type="submit"><b class="ms-2" id="total_pagar" data-total=""> $0.00</b></button>
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
        $(document).ready(function() {
            $('#cliente_id').select2({
                placeholder: 'Seleccionar opción',
                theme: 'tabler',
            });
            getClientesSelect2();
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    
</body>

</html>