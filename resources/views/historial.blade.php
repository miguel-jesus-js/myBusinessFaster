@extends('layouts.base')
@section('contenido')
<div class="page-header" id="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">HISTORIAL DE VENTAS</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-brand-tidal me-2"></i><a href="/dashboard">Catalogos</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="ti ti-calendar-event me-2"></i><a href="/historial">Historial</a></li>
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
                <div class="accordion bg-white shadow-sm" id="accordion-example">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="heading-1">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="false">
                          Barra de filtros
                        </button>
                      </h2>
                      <div id="collapse-1" class="accordion-collapse collapse" data-bs-parent="#accordion-example" style="">
                        <div class="accordion-body pt-0">
                            <form id="form-filter" action="">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 mb-3">
                                        <label class="form-label">Folio</label>
                                        <input type="number" class="form-control" name="folio" id="folio" placeholder="Folio">
                                    </div>
                                    <div class="col-sm-6 col-md-4 mb-3">
                                        <label class="form-label">Sucursal</label>
                                        <select class="form-select" name="sucursale_id" id="sucursale_id" onclick="getSucursales()">
                                            <option value="" id="load-select" disabled selected>Elige una opción</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mb-3">
                                        <label class="form-label">Empleado</label>
                                        <select class="form-select" name="user_id" id="user_id" onclick="getUsers()">
                                            <option value="" id="load-select-1" disabled selected>Elige una opción</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mb-3">
                                        <label class="form-label">Cliente</label>
                                        <select class="form-select" name="cliente_id" id="cliente_id" onclick="getClientes()">
                                            <option value="" id="load-select-2" disabled selected>Elige una opción</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mb-3">
                                        <label class="form-label">Fecha inicio</label>
                                        <input type="date" class="form-control" name="fecha_ini" id="fecha_ini">
                                    </div>
                                    <div class="col-sm-6 col-md-4 mb-3">
                                        <label class="form-label">Fecha fin</label>
                                        <input type="date" class="form-control" name="fecha_fin" id="fecha_fin">
                                    </div>
                                    <div class="col-6 col-sm-4 col-md-3 mb-3">
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
                                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('historial', 0)">
                                                            <span class="form-check-label">Todos</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="form-check">
                                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('historial', 1)">
                                                            <span class="form-check-label">Eliminados</span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label class="form-check">
                                                            <input class="form-check-input" name="filter" type="checkbox" checked onclick="filterGeneral('historial', 2)">
                                                            <span class="form-check-label">No eliminados</span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <button class="btn btn-info" type="button" onclick="this.form.reset();">
                                        <i class="ti ti-trash icono"></i> Limpiar filtros
                                    </button>
                                    <button class="btn btn-success" type="submit">
                                        <i class="ti ti-search icono"></i> Buscar
                                    </button>
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                </div>
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
                                    <a href="/api/exportarPdfSucursal" class="dropdown-item" onclick="">PDF</a>
                                </li>
                                <li>
                                    <a href="/api/exportarExcelSucursal" class="dropdown-item" onclick="">Excel</a>
                                </li>
                            </ul>
                        </button>
                    </div>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recargar" onclick="getHistorial(2, 0, 5, '');">
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
                                <th>Tipo de pago</th>
                                <th>Estado</th>
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
@endsection
@section('script')
<script src="{{ asset('assets/js/historial/historial.js') }}"></script>
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script>
    $( document ).ready(function() {
        getHistorial(2, 0, 5, '');
        $("#modal-categoria").draggable();
    });
</script>
@endsection
