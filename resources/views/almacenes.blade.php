@extends('layouts.base')
@section('contenido')
<div class="page-header" id="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">ALMACENES</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-brand-tidal me-2"></i><a href="/dashboard">Catalogos</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="ti ti-package me-2"></i><a href="/almacenes">Almacenes</a></li>
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
                            <input type="hidden" value="almacenes" id="modulo">
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
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('almacenes', 0)">
                                            <span class="form-check-label">Todos</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('almacenes', 1)">
                                            <span class="form-check-label">Eliminados</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" checked onclick="filterGeneral('almacenes', 2)">
                                            <span class="form-check-label">No eliminados</span>
                                        </label>
                                    </li>
                                    @if(Auth::user()->isAdmin)    
                                    <label class="form-label">Sucursal</label>
                                    <li>
                                        <select class="form-select" name="sucursale_id1" id="sucursale_id1" onclick="getSucursales()" required>
                                            <option value="" id="load-select1" disabled selected>Elige una opción</option>
                                        </select>
                                    </li>
                                    @endif
                                </ul>
                            </button>
                        </div>
                    </div>
                    <div class="col-6 col-sm-2 col-md-2 offset-md-1">
                        <label class="form-label invisible">add</label>
                        <button onclick="openModal('modal-almacen','almacenes', 0)" class="btn btn-primary">
                            Agregar almacenes
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
                                    <a href="/api/exportarPdfAlmacen" class="dropdown-item" onclick="">PDF</a>
                                </li>
                                <li>
                                    <a href="/api/exportarExcelAlmacen" class="dropdown-item" onclick="">Excel</a>
                                </li>
                            </ul>
                        </button>
                    </div>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Importar" onclick="openModal('upload-almacen','almacenes', 0)">
                        <i class="ti ti-file-upload icono"></i>
                    </button>
                    <a href="/api/downloadPlantillaAlmacen" target="_blank" class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" download="Excel almacenes" data-bs-placement="bottom" title="Descargar plantilla">
                        <i class="ti ti-file-download icono"></i>
                    </a>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recargar" onclick="getAlmacenes(2, '');">
                        <i class="ti ti-refresh icono"></i>
                    </button>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="table-almacen" class="table shadow-sm bg-white table-bordered">
                        <thead class="disable-selection">
                            <tr>
                                <th style="width:">Almacén</th>
                                <th style="width:">Sucursal</th>
                                <th style="width:">Descripción</th>
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

<div class="modal modal-blur fade" id="modal-almacen" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-almacen', 'form-add-almacen')"></button>
            </div>
            <div class="modal-body">
                <form id="form-add-almacen">
                    <div class="tab-content">
                        <div id="load-form" class="efecto-cargando">
                        </div>
                        <div class="row">
                            @if(Auth::user()->isAdmin) 
                            <div class="col-md-12 mb-3">
                                <label class="form-label required">Sucursal</label>
                                <select class="form-select" name="sucursale_id" id="sucursale_id" onclick="getSucursales()" required>
                                    <option value="" id="load-select" disabled selected>Elige una opción</option>
                                </select>
                                <div class="invalid-feedback" id="error-sucursale_id"></div>
                            </div>
                            @endif
                            <div class="col-md-12 mb-3">
                                <input type="number" class="d-none" id="id" name="id">
                                <label class="form-label required">Nombre</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}">
                                <div class="invalid-feedback" id="error-nombre"></div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label required">Descripción</label>
                                <textarea  class="form-control" name="desc" id="desc" placeholder="Descripción" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" cols="30" rows="5"></textarea>
                                <div class="invalid-feedback" id="error-desc"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-almacen', 'form-add-almacen')">Cancelar</button>
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

<div class="modal modal-blur fade" id="upload-almacen" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir excel de almacenes</h5>
                <button type="button" class="btn-close" onclick="closeModal('upload-almacen', 'form-upload-almacen')"></button>
            </div>
            <div class="modal-body">
                <form id="form-upload-almacen">
                    <div class="tab-content">
                        <div id="load-form1" class="efecto-cargando">
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label required">Archivo</label>
                                <input type="file" class="form-control" name="archivo" id="archivo" accept=".xlsx, .xls, .csv"  required autocomplete="off">
                                <div class="invalid-feedback" id="error-archivo"></div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('upload-almacen', 'form-upload-almacen')">Cancelar</button>
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

<div class="modal modal-blur fade" id="modal-detalle-almacen" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles</h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-detalle-almacen', 'form-add-almacen')"></button>
            </div>
            <div class="modal-body">
                <label class="form-label">Almacén:</label>
                <p id="nom-nombre"></p>
                <label class="form-label">Descripción:</label>
                <p id="nom-desc"></p>
                <label class="form-label">Fecha de creación:</label>
                <p id="creacion"></p>
                <label class="form-label">Última fecha de actualización:</label>
                <p id="actualizacion"></p>
                <label class="form-label">Fecha de eliminación:</label>
                <p id="eliminacion"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-detalle-almacen', 'form-add-almacen')">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/almacenes/crud-almacen.js') }}"></script>
<script src="{{ asset('assets/js/almacenes/config.js') }}"></script>
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script>
    $( document ).ready(function() {
        getAlmacenes(2, '');
        $("#modal-categoria").draggable();
    });
</script>
@endsection
