@extends('layouts.base')
@section('contenido')
<div class="page-header" id="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">SUCURSALES</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-brand-tidal me-2"></i><a href="/dashboard">Catalogos</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><i class="ti ti-package me-2"></i><a href="/sucursales">Sucursales</a></li>
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
                            <input type="hidden" value="sucursales" id="modulo">
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
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('sucursales', 0)">
                                            <span class="form-check-label">Todos</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('sucursales', 1)">
                                            <span class="form-check-label">Eliminados</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" checked onclick="filterGeneral('sucursales', 2)">
                                            <span class="form-check-label">No eliminados</span>
                                        </label>
                                    </li>
                                </ul>
                            </button>
                        </div>
                    </div>
                    <div class="col-6 col-sm-2 col-md-2 offset-md-1">
                        <label class="form-label invisible">add</label>
                        <button onclick="openModal('modal-sucursal','sucursales', 0)" class="btn btn-primary">
                            Agregar sucursales
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
                                    <a href="/api/exportarPdfSucursal" class="dropdown-item" onclick="">PDF</a>
                                </li>
                                <li>
                                    <a href="/api/exportarExcelSucursal" class="dropdown-item" onclick="">Excel</a>
                                </li>
                            </ul>
                        </button>
                    </div>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Importar" onclick="openModal('upload-sucursal','sucursales', 0)">
                        <i class="ti ti-file-upload icono"></i>
                    </button>
                    <a href="/api/downloadPlantillaSucursal" target="_blank" class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" download="Excel sucursales" data-bs-placement="bottom" title="Descargar plantilla">
                        <i class="ti ti-file-download icono"></i>
                    </a>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recargar" onclick="getSucursales(2, '');">
                        <i class="ti ti-refresh icono"></i>
                    </button>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="table-sucursal" class="table shadow-sm bg-white table-bordered">
                        <thead class="disable-selection">
                            <tr>
                                <th>Nombre</th>
                                <th>Responsable</th>
                                <th>Teléfono</th>
                                <th>Correo</th>
                                <th>RFC</th>
                                <th>Redes</th>
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

<div class="modal modal-blur fade" id="modal-sucursal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-sucursal', 'form-add-sucursal')"></button>
            </div>
            <div class="modal-body">
                <form id="form-add-sucursal">
                    <ul class="nav nav-pills" data-bs-toggle="tabs" id="list-tab">
                        <li class="nav-item active">
                            <a href="#tab-datos-pers" class="nav-link active btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-id icono me-1"></i>
                                Datos generales</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contacto" class="nav-link btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-phone icono me-1"></i>
                                Datos de contacto</a>
                        </li>
                        <li class="nav-item">
                            <a href="#redes-sociales" class="nav-link btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-lock-access icono me-1"></i>
                                Redes sociales</a>
                        </li>
                        
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div id="load-form" class="efecto-cargando">

                        </div>
                        <div class="tab-pane active show" id="tab-datos-pers">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <input type="number" class="d-none" id="id" name="id">
                                    <label class="form-label required">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre(s)" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}">
                                    <div class="invalid-feedback" id="error-nombre"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Responsable</label>
                                    <select class="form-select" name="user_id" id="user_id" onclick="getUsers()" required>
                                        <option value="" id="load-select" disabled selected>Elige una opción</option>
                                    </select>
                                    <div class="invalid-feedback" id="error-user_id"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label">RFC</label>
                                    <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC" autocomplete="off" pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$">
                                    <div class="invalid-feedback" id="error-rfc"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Ciudad</label>
                                    <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5">
                                    <div class="invalid-feedback" id="error-ciudad"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Estado</label>
                                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5">
                                    <div class="invalid-feedback" id="error-estado"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Municipio</label>
                                    <input type="text" class="form-control" name="municipio" id="municipio" placeholder="Municipio" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5">
                                    <div class="invalid-feedback" id="error-municipio"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Código postal</label>
                                    <input type="number" class="form-control" name="cp" id="cp" placeholder="Código postal" required autocomplete="off" maxlength="5" minlength="5">
                                    <div class="invalid-feedback" id="error-cp"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Colonia</label>
                                    <input type="text" class="form-control" name="colonia" id="colonia" placeholder="Colonia" required autocomplete="off" maxlength="50" minlength="5">
                                    <div class="invalid-feedback" id="error-colonia"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Calle</label>
                                    <input type="text" class="form-control" name="calle" id="calle" placeholder="Calle" required autocomplete="off">
                                    <div class="invalid-feedback" id="error-calle"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">N° Exterior</label>
                                    <input type="number" class="form-control" name="n_exterior" id="n_exterior" placeholder="N° Exterior" autocomplete="off" min="0" max="200">
                                    <div class="invalid-feedback" id="error-n_exterior"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">N° Interior</label>
                                    <input type="number" class="form-control" name="n_interior" id="n_interior" placeholder="N° Interior" autocomplete="off" min="0" max="200">
                                    <div class="invalid-feedback" id="error-n_interior"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="contacto">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label required">Teléfono</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control" data-mask="(00) 0000-0000" data-mask-visible="true" placeholder="(00) 0000-0000" required autocomplete="off">
                                    <div class="invalid-feedback" id="error-telefono"></div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label required">Correo</label>
                                    <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" required autocomplete="off" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
                                    <div class="invalid-feedback" id="error-correo"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="redes-sociales">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label for="" class="form-label">URL de facebook</label>
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                          <i class="ti ti-brand-facebook"></i>
                                        </span>
                                        <input type="text" class="form-control" name="facebook" id="facebook" placeholder="URL de facebook" autocomplete="off" minlength="10" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="" class="form-label">URL de twitter</label>
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                          <i class="ti ti-brand-twitter"></i>
                                        </span>
                                        <input type="text" class="form-control" name="twitter" id="twitter" placeholder="URL de twitter" autocomplete="off" minlength="10" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="" class="form-label">URL de instagram</label>
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                          <i class="ti ti-brand-instagram"></i>
                                        </span>
                                        <input type="text" class="form-control" name="instagram" id="instagram" placeholder="URL de instagram" autocomplete="off" minlength="10" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="" class="form-label">URL de tiktok</label>
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                          <i class="ti ti-brand-tiktok"></i>
                                        </span>
                                        <input type="text" class="form-control" name="tiktok" id="tiktok" placeholder="URL de tiktok" autocomplete="off" minlength="10" maxlength="200">
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label for="" class="form-label">Número de whatsapp</label>
                                    <div class="input-icon mb-3">
                                        <span class="input-icon-addon">
                                          <i class="ti ti-brand-whatsapp"></i>
                                        </span>
                                        <input type="text" class="form-control" name="whatsapp" id="whatsapp" placeholder="Número de whatsapp" autocomplete="off" minlength="10" maxlength="10">
                                    </div>
                                </div>
                                <div class="col-sm-6 mb-3 d-none" id="div-mensaje">
                                    <label for="" class="form-label">Mensaje</label>
                                    <input type="text" class="form-control" name="mernsaje" id="mernsaje" placeholder="Hola necesito información" autocomplete="off" minlength="10" maxlength="200">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-user', 'form-add-user')">Cancelar</button>
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

<div class="modal modal-blur fade" id="upload-sucursal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir excel de sucursales</h5>
                <button type="button" class="btn-close" onclick="closeModal('upload-sucursal', 'form-upload-sucursal')"></button>
            </div>
            <div class="modal-body">
                <form id="form-upload-sucursal">
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
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('upload-sucursal', 'form-upload-sucursal')">Cancelar</button>
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

<div class="modal modal-blur fade" id="modal-detalle-sucursal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles</h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-detalle-sucursal', 'form-add-sucursal')"></button>
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
                <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-detalle-sucursal', 'form-add-sucursal')">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/sucursales/crud-sucursal.js') }}"></script>
<script src="{{ asset('assets/js/sucursales/config.js') }}"></script>
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script>
    $( document ).ready(function() {
        getSucursales(2, '');
        $("#modal-categoria").draggable();
    });
</script>
@endsection
