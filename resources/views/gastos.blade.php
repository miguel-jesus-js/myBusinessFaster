@extends('layouts.base')
@section('contenido')
<div class="page-header" id="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">GASTOS</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-brand-tidal me-2"></i><a href="/dashboard">Catalogos</a></li>
                    <li class="breadcrumb-item active"><i class="ti ti-currency-dollar-off me-2"></i><a href="/gastos">Gastos</a></li>
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
                            <input type="hidden" value="gastos" id="modulo">
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
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('gastos', 0)">
                                            <span class="form-check-label">Todos</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('gastos', 1)">
                                            <span class="form-check-label">Eliminados</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" checked onclick="filterGeneral('gastos', 2)">
                                            <span class="form-check-label">No eliminados</span>
                                        </label>
                                    </li>
                                </ul>
                            </button>
                        </div>
                    </div>
                    <div class="col-6 col-sm-2 col-md-2 offset-md-1">
                        <label class="form-label invisible">add</label>
                        <button onclick="openModal('modal-gasto','gastos', 0)" class="btn btn-primary">
                            Agregar gasto
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
                                    <a href="/api/exportarPdfGastos" class="dropdown-item" onclick="">PDF</a>
                                </li>
                                <li>
                                    <a href="/api/exportarExcelGastos" class="dropdown-item" onclick="">Excel</a>
                                </li>
                            </ul>
                        </button>
                    </div>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recargar" onclick="getGastos(2, '');">
                        <i class="ti ti-refresh icono"></i>
                    </button>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="table-gasto" class="table shadow-sm bg-white table-bordered">
                        <thead class="disable-selection">
                            <tr>
                                <th>Empleado</th>
                                <th>Tipo</th>
                                <th>Fecha y hora</th>
                                <th>Monto</th>
                                <th>Descripción</th>
                                <th colspan="3" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-gasto" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-gasto', 'form-add-gasto')"></button>
            </div>
            <div class="modal-body">
                <form id="form-add-gasto">
                    <div class="tab-content">
                        <div id="load-form" class="efecto-cargando">
                        </div>
                        <div class="row">
                            <div class="col-sm-6 mb-3">
                                <input type="number" class="d-none" id="id" name="id">
                                <label class="form-label required">Tipo de gasto</label>
                                <select class="form-select" name="tipo_gasto_id" id="tipo_gasto_id" onclick="getTipoGasto()" required>
                                    <option value="" id="load-select" disabled selected>Elige una opción</option>
                                </select>
                                <div class="invalid-feedback" id="error-tipo_gasto_id"></div>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <label class="form-label required">Monto</label>
                                <input type="number" class="form-control" name="monto" id="monto" placeholder="Monto" required min="1" max="100000" minlength="1" maxlength="7" step=0.01>
                                <div class="invalid-feedback" id="error-monto"></div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label required">Comprobante</label>
                                <input type="file" class="form-control" name="comprobante" id="comprobante" accept="image/jpeg,image/jpg,image/png" onchange="preview('comprobante', 'view-comprobante')">
                                <div class="invalid-feedback" id="error-comprobante"></div>
                                <br>
                                <div id="preview-comprobante" class="d-none row">
                                    <div class="col-auto">
                                        <span class="avatar"><img src="" alt="" id="view-comprobante"></span>
                                    </div>
                                    <div class="col">
                                        <div class="text-truncate">
                                        <strong id="name-comprobante"></strong>
                                        </div>
                                        <div class="text-muted" id="peso-comprobante"></div>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <button class="ti ti-x btn btn-danger text-white rounded-circle remover" onclick="removeImg('comprobante')"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label required">Descripción</label>
                                <textarea class="form-control" name="desc" id="desc" placeholder="Descripción" required rows="5"></textarea>
                                <div class="invalid-feedback" id="error-desc"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-gasto', 'form-add-gasto')">Cancelar</button>
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

<div class="modal modal-blur fade" id="upload-gasto" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir excel de gastos</h5>
                <button type="button" class="btn-close" onclick="closeModal('upload-gasto', 'form-upload-gasto')"></button>
            </div>
            <div class="modal-body">
                <form id="form-upload-gasto">
                    <div class="tab-content">
                        <div id="load-form1" class="efecto-cargando">
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label required">Archivo</label>
                                <input type="file" class="form-control" name="archivo" id="archivo" accept=".xlsx, .xls, .csv"  required autocomplete="off">
                                <div class="invalid-feedback" id="error-archivo">Invalid feedback</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('upload-gasto', 'form-upload-gasto')">Cancelar</button>
                            <button type="submit" class="btn btn-blue btn-pill">
                                <span id="load-button1" class="spinner-grow spinner-grow-sm me-1 d-none" role="status" aria-hidden="true"></span>
                                <b id="btn-modal1">Cargar</b>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-detalle-gasto" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles</h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-detalle-gasto', 'form-add-gasto')"></button>
            </div>
            <div class="modal-body">
                <label class="form-label">gasto:</label>
                <p id="nom-gasto"></p>
                <label class="form-label">Fecha de creación:</label>
                <p id="creacion"></p>
                <label class="form-label">Última fecha de actualización:</label>
                <p id="actualizacion"></p>
                <label class="form-label">Fecha de eliminación:</label>
                <p id="eliminacion"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-detalle-gasto', 'form-add-gasto')">Cerrar</button>
            </div>
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
