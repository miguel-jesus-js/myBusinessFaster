@extends('layouts.base')
@section('contenido')
<div class="page-header" id="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">CLIENTES</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-brand-tidal me-2"></i><a href="/dashboard">Catalogos</a></li>
                    <li class="breadcrumb-item active"><i class="ti ti-friends me-2"></i><a href="/clientes">Clientes</a></li>
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
                            <input type="hidden" value="clientes" id="modulo">
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
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('clientes', 0)">
                                            <span class="form-check-label">Todos</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('clientes', 1)">
                                            <span class="form-check-label">Eliminados</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" checked onclick="filterGeneral('clientes', 2)">
                                            <span class="form-check-label">No eliminados</span>
                                        </label>
                                    </li>
                                </ul>
                            </button>
                        </div>
                    </div>
                    <div class="col-6 col-sm-2 col-md-2 offset-md-1">
                        <label class="form-label invisible">add</label>
                        <button onclick="openModal('modal-cliente','clientes', 0)" class="btn btn-primary">
                            Agregar cliente
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
                                    <a href="/api/exportarPdfCliente" class="dropdown-item" onclick="">PDF</a>
                                </li>
                                <li>
                                    <a href="/api/exportarExcelCliente" class="dropdown-item" onclick="">Excel</a>
                                </li>
                            </ul>
                        </button>
                    </div>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Importar" onclick="openModal('upload-cliente','clientes', 0)">
                        <i class="ti ti-file-upload icono"></i>
                    </button>
                    <a href="{{ route('downloadPlantillaCliente') }}" target="_blank" class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Descargar plantilla" download="Excel clientes">
                        <i class="ti ti-file-download icono"></i>
                    </a>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recargar" onclick="getClientes(2, '');">
                        <i class="ti ti-refresh icono"></i>
                    </button>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="table-cliente" class="table shadow-sm bg-white table-bordered">
                        <thead class="disable-selection">
                            <tr>
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th colspan="2" class="text-center">Acciones</th>
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

@include('modals.modal_cliente')

<div class="modal modal-blur fade" id="upload-cliente" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir excel de clientes</h5>
                <button type="button" class="btn-close" onclick="closeModal('upload-cliente', 'form-upload-cliente')"></button>
            </div>
            <div class="modal-body">
                <form id="form-upload-cliente">
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
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('upload-cliente', 'form-upload-cliente')">Cancelar</button>
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
@endsection
@section('script')
<script src="{{ asset('assets/js/clientes/crud-cliente.js') }}"></script>
<script src="{{ asset('assets/js/clientes/config.js') }}"></script>
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script>
    $( document ).ready(function() {
        getClientes(2, '');
        $("#modal-direcciones").draggable();
    });
</script>
@endsection
