@extends('layouts.base')
@section('contenido')
<div class="page-header" id="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">COTIZACIÓN DE VENTA</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active"><i class="ti ti-report-money me-2"></i><a href="/cotizacion_venta">Cotización de venta</a></li>
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
                <div class="row">
                    <div class="col-sm-6 col-md-6">
                        <label class="form-label">Buscar</label>
                        <div class="input-icon mb-3">
                            <input type="search" id="search" class="form-control" placeholder="Buscar..." autocomplete="off">
                            <input type="hidden" value="marcas" id="modulo">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-md-3">
                        <label class="form-label" id="filtro-select">Filtro: No eliminados</label>
                        <button class="nav-link dropdown-toggle btn p-2" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="true">
                            <span class="nav-link-icon">
                                <i class="ti ti-filter icono"></i>
                            </span>
                        </button>
                        <div class="dropdown-menu" data-bs-popper="static">
                            <button class="dropdown-item">
                                <ul>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('marcas', 0)">
                                            <span class="form-check-label">Todos</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('marcas', 1)">
                                            <span class="form-check-label">Eliminados</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" checked onclick="filterGeneral('marcas', 2)">
                                            <span class="form-check-label">No eliminados</span>
                                        </label>
                                    </li>
                                </ul>
                            </button>
                        </div>
                    </div>
                    <div class="col-6 col-sm-2 col-md-2 offset-md-1">
                        <label class="form-label invisible">add</label>
                        <button onclick="openModal('modal-cotizacion-venta','cotizacion_venta', 0)" class="btn btn-primary">
                            Agregar cotización de venta
                        </button>
                    </div>
                </div><!-- row end -->
                <br>
                <div class="btn-group table-actions">
                    <button class="btn btn-dark btn-icon" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="true" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Exportar PDF">
                            <i class="ti ti-file-text icono"></i>
                    </button>
                    <div class="dropdown-menu" data-bs-popper="static">
                        <span class="dropdown-header">Exportar como</span>
                        <button class="dropdown-item">
                            <ul>
                                <li>
                                    <a href="/api/exportarPdfMarca" class="dropdown-item" onclick="">PDF</a>
                                </li>
                                <li>
                                    <a href="/api/exportarExcelMarca" class="dropdown-item" onclick="">Excel</a>
                                </li>
                            </ul>
                        </button>
                    </div>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recargar" onclick="getHistorial(2, 0, 5, '', 2);">
                        <i class="ti ti-refresh icono"></i>
                    </button>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="table-historial" class="table shadow-sm bg-white table-bordered">
                        <thead class="disable-selection">
                            <tr>
                                <th>Folio</th>
                                <th>Sucursal</th>
                                <th>Cliente</th>
                                <th>Empleado</th>
                                <th>Fecha</th>
                                <th>Importe</th>
                                <th>Iva</th>
                                <th>Descuento</th>
                                <th>Total</th>
                                <th>Efectivo</th>
                                <th>Pago inicial</th>
                                <th>Tipo de pago</th>
                                <th>Estado</th>
                                <th>Tipo de venta</th>
                                <th>Modalidad</th>
                                <th colspan="3" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan='15'>
                                    <ul class='pagination d-flex justify-content-end' id="paginacion">
                                        
                                    </ul>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-cotizacion-venta" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-cotizacion-venta', 'form-add-cotizacion-venta')"></button>
            </div>
            <div class="modal-body">
                <div class="tab-content">
                    <div id="load-form" class="efecto-cargando">
                    </div>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <label class="form-label required">Cliente</label>
                        <select class="form-select" name="cliente_id" id="cliente_id" onclick="getProveedores()" required>
                            <option value="" id="load-select3" disabled selected>Elige una opción</option>
                        </select>
                        <div class="invalid-feedback" id="error-cliente_id"></div>
                    </div>
                    <section class="search-producto mb-3">
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
                    <section class="table-productos mb-3">
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
                    <div class="mb-3 card-footer text-end">
                        <h6 class="text-secondary">Productos  (<b id="total_productos"></b> productos)</h6>
                    </div>
                    <form action="" id="form-add-venta">
                        <section class="costos">
                            <div class="row mb-2 d-flex justify-content-end">
                                <div class="col-auto">
                                    <h6>SUBTOTAL:</h6>
                                </div>
                                <div class="col-auto">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="ti ti-currency-dollar"></i>
                                        </span>
                                        <input type="number" class="form-control form-control-lg" name="subtotal" id="subtotal" placeholder="0.00" required autocomplete="off" readonly min="1" step=0.01>
                                        <input type="hidden" name="tipo" id="tipo" required autocomplete="off" readonly value="2">
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 d-flex justify-content-end">
                                <div class="col-auto">
                                    <h6>
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" id="check-iva">
                                            <span class="form-check-label">IVA <b>(%)</b>:</span>
                                        </label>
                                    </h6>
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
                                    <h6>DESCUENTO:</h6>
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
                            <div class="row mb-2 d-flex justify-content-end">
                                <div class="col-auto">
                                    <h6 id="txt-paga-con">EFECTIVO:</h6>
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
                            <div class="modal-footer">
                                <button class="btn btn-lime btn-lg w-50 mt-2" type="submit"><b class="ms-2" id="total_pagar" data-total=""> $0.00</b></button>
                                <button type="button" class="btn btn-red btn-lg  w-50" onclick="closeModal('modal-cotizacion-venta', 'form-add-cotizacion-venta')">Cancelar</button>
                            </div>
                        </section>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('assets/js/historial/historial.js') }}"></script>
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script src="{{ asset('assets/js/punto_venta/punto_venta.js') }}"></script>
<script>
    $( document ).ready(function() {
        tipoVenta = 3;
        getHistorial(2, 0, 5, '', 2);
        getClientesSelect2();
    });
</script>
@endsection
