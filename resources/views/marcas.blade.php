@extends('layouts.base')
@section('contenido')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">MARCAS</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti-brand-airtable me-2"></i><a href="#">Marcas</a></li>
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
                    <div class="col-md-5">
                        <label class="form-label">Buscar</label>
                        <div class="input-icon mb-3">
                            <input type="search" id="search" class="form-control" placeholder="Buscar..." autocomplete="off">
                            <input type="hidden" value="marcas" id="modulo">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label">Filtros</label>
                        <button class="nav-link dropdown-toggle btn" data-bs-toggle="dropdown"
                            data-bs-auto-close="outside" role="button" aria-expanded="true">
                            <span class="nav-link-icon d-md-none d-lg-inline-block">
                                <i class="ti ti-filter icono"></i>
                            </span>
                        </button>
                        <div class="dropdown-menu" data-bs-popper="static">
                            <button class="dropdown-item">
                                <ul>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('marcas', 'api/getMarcas/', 0)">
                                            <span class="form-check-label">Todos</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('marcas', 'api/getMarcas/', 1)">
                                            <span class="form-check-label">Eliminados</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" checked onclick="filterGeneral('marcas', 'api/getMarcas/', 2)">
                                            <span class="form-check-label">No eliminados</span>
                                        </label>
                                    </li>
                                </ul>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label invisible">add</label>
                        <button onclick="openModal('modal-marca','marcas', 0)" class="btn btn-primary">
                            Agregar marca
                        </button>
                    </div>
                </div><!-- row end -->
                <br>
                <div class="d-flex justify-content-end">
                    <button class="btn" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recargar" onclick="getMarcas('api/getMarcas/', 2);">
                        <i class="ti ti-refresh icono"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="table-marca" class="table shadow-sm bg-white">
                        <thead>
                            <tr>
                                <th>Marca</th>
                                <th colspan="2">Acciones</th>
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

<div class="modal modal-blur fade" id="modal-marca" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-marca', 'form-add-marca')"></button>
            </div>
            <div class="modal-body">
                <form id="form-add-marca">
                    <div class="tab-content">
                        <div id="load-form" class="efecto-cargando d-none">
                            <div id="preloader6">
                                <span></span>
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                            <b class="h3">Cargando</b>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <input type="number" class="d-none" id="id" name="id">
                                <label class="form-label required">Marca</label>
                                <input type="text" class="form-control" name="marca" id="marca" placeholder="Marca" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-marca', 'form-add-marca')">Cancelar</button>
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
<script src="{{ asset('assets/js/marcas/config.js') }}"></script>
<script src="{{ asset('assets/js/marcas/crud-marca.js') }}"></script>
<script>
    $( document ).ready(function() {
        getMarcas('api/getMarcas/', 2);
        $("#modal-marca").draggable();
        $("#modal-modulos").draggable();
    });
</script>
@endsection
