@extends('layouts.base')
@section('contenido')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">EMPLEADOS</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active"><i class="ti ti-users me-2"></i><a href="/usuarios">Empleados</a></li>
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
                            <input type="hidden" value="usuarios" id="modulo">
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
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('usuarios', 0)">
                                            <span class="form-check-label">Todos</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('usuarios', 1)">
                                            <span class="form-check-label">Eliminados</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" checked onclick="filterGeneral('usuarios', 2)">
                                            <span class="form-check-label">No eliminados</span>
                                        </label>
                                    </li>
                                </ul>
                            </button>
                        </div>
                    </div>
                    <div class="col-6 col-sm-2 col-md-2 offset-md-1">
                        <label class="form-label invisible">add</label>
                        <button onclick="openModal('modal-user','usuarios', 0)" class="btn btn-primary">
                            Agregar empleado
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
                                    <a href="/api/exportarPdfUser" class="dropdown-item" onclick="">PDF</a>
                                </li>
                                <li>
                                    <a href="/api/exportarExcelUser" class="dropdown-item" onclick="">Excel</a>
                                </li>
                            </ul>
                        </button>
                    </div>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Importar" onclick="openModal('upload-usuario','usuarios', 0)">
                        <i class="ti ti-file-upload icono"></i>
                    </button>
                    <a href="{{ route('downloadPlantillaUsuario') }}" target="_blank" class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Descargar plantilla">
                        <i class="ti ti-file-download icono"></i>
                    </a>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recargar" onclick="getUsuarios(2, '');">
                        <i class="ti ti-refresh icono"></i>
                    </button>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="table-user" class="table shadow-sm bg-white">
                        <thead>
                            <tr>
                                <th colspan="2">Nombre</th>
                                <th>Usuario</th>
                                <th>Tipo</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
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

<div class="modal modal-blur fade" id="modal-user" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-user', 'form-add-user')"></button>
            </div>
            <div class="modal-body">
                <form id="form-add-user">
                    <ul class="nav nav-pills" data-bs-toggle="tabs">
                        <li class="nav-item active">
                            <a href="#tab-datos-pers" class="nav-link active btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-id icono me-1"></i>
                                Datos personales</a>
                        </li>
                        <li class="nav-item">
                            <a href="#contacto" class="nav-link btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-phone icono me-1"></i>
                                Datos de contacto</a>
                        </li>
                        <li class="nav-item">
                            <a href="#permisos" class="nav-link btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-lock-access icono me-1"></i>
                                Permisos de acceso</a>
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
                                    <label class="form-label required">Nombre(s)</label>
                                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombre(s)" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" value="Miguel de Jesús">
                                    <div class="invalid-feedback" id="error-nombres"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Apellido P</label>
                                    <input type="text" class="form-control" name="app" id="app" placeholder="Apellido paterno" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" value="López">
                                    <div class="invalid-feedback" id="error-app"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Apellido M</label>
                                    <input type="text" class="form-control" name="apm" id="apm" placeholder="Apellido materno" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" value="López">
                                    <div class="invalid-feedback" id="error-apm"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Clave</label>
                                    <input type="text" class="form-control" name="clave" id="clave" placeholder="Clave" required autocomplete="off" maxlength="10" minlength="3" value="LPZ006">
                                    <div class="invalid-feedback" id="error-clave"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label">RFC</label>
                                    <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC" autocomplete="off" pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$" value="QUMA470929F37">
                                    <div class="invalid-feedback" id="error-rfc"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Usuario</label>
                                    <input type="text" class="form-control" name="nom_user" id="nom_user" placeholder="Usuario" required autocomplete="off" maxlength="20" minlength="5">
                                    <div class="invalid-feedback" id="error-nom_user"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Contraseña</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required autocomplete="off" maxlength="20" minlength="8">
                                        <span class="input-group-text">
                                            <a href="#" onclick="showHidePassword('password', 'eye-icon')" class="input-group-link"><i id="eye-icon" class="ti ti-eye"></i></a>
                                        </span>
                                        <div class="invalid-feedback" id="error-password"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Ciudad</label>
                                    <input type="text" class="form-control" name="ciudad" id="ciudad" placeholder="Ciudad" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5" value="Ocosingo">
                                    <div class="invalid-feedback" id="error-ciudad"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Estado</label>
                                    <input type="text" class="form-control" name="estado" id="estado" placeholder="Estado" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5" value="Chiapas">
                                    <div class="invalid-feedback" id="error-estado"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Municipio</label>
                                    <input type="text" class="form-control" name="municipio" id="municipio" placeholder="Municipio" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" maxlength="50" minlength="5" value="Ocosingo">
                                    <div class="invalid-feedback" id="error-municipio"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Código postal</label>
                                    <input type="number" class="form-control" name="cp" id="cp" placeholder="Código postal" required autocomplete="off" maxlength="5" minlength="5" value="29950">
                                    <div class="invalid-feedback" id="error-cp"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Colonia</label>
                                    <input type="text" class="form-control" name="colonia" id="colonia" placeholder="Colonia" required autocomplete="off" maxlength="50" minlength="5" value="Bonampack">
                                    <div class="invalid-feedback" id="error-colonia"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Calle</label>
                                    <input type="text" class="form-control" name="calle" id="calle" placeholder="Calle" required autocomplete="off" value="Yaxchilán">
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
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Correo" required autocomplete="off" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" value="winalllpz@gmail.com">
                                    <div class="invalid-feedback" id="error-email"></div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="permisos">
                            <div class="d-flex bd-highlight">
                                <div class="p-2 flex-grow-1 bd-highlight">
                                    <div class="col-md-4">
                                        <label class="form-label required">Rol</label>
                                        <select class="form-select" name="role_id" id="role_id" onclick="getRoles()" required>
                                            <option value="" id="load-select" disabled selected>Elige una opción</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="p-2 bd-highlight">
                                    <label class="form-label required invisible">Modulos</label>
                                    <button type="button" class="btn btn-success" onclick="openModal('modal-modulos','usuarios', 2), getModulos()">Seleccionar modulos</button>
                                </div>
                            </div>
                            <br>
                            <table class="table" id="table-user-modulos">
                                <thead>
                                    <tr>
                                        <th class="role_id">ID</th>
                                        <th>Modulo</th>
                                        <th>Consultar</th>
                                        <th>Registrar</th>
                                        <th>Editar</th>
                                        <th>Eliminar</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="pasar-modulos" class="d-none">
                                        <td colspan="7"><center><h1>Cargando<span class="animated-dots"></span></h1></center></td>
                                    </tr>
                                </tbody>
                            </table>
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
<div class="modal modal-blur fade" id="upload-usuario" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir excel de empleados</h5>
                <button type="button" class="btn-close" onclick="closeModal('upload-usuario', 'form-upload-usuario')"></button>
            </div>
            <div class="modal-body">
                <form id="form-upload-usuario">
                    <div class="tab-content">
                        <div id="load-form2" class="efecto-cargando">
                            
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="form-label required">Archivo</label>
                                <input type="file" class="form-control" name="archivo" id="archivo" accept=".xlsx, .xls, .csv"  required autocomplete="off">
                                <div class="invalid-feedback" id="error-archivo">Invalid feedback</div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('upload-usuario', 'form-upload-usuario')">Cancelar</button>
                            <button type="submit" class="btn btn-blue btn-pill">
                                <span id="load-button2" class="spinner-grow spinner-grow-sm me-1 d-none" role="status" aria-hidden="true"></span>
                                <b id="btn-modal2">Cargar</b>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal para consultar modulos -->
<div class="modal modal-blur fade" id="modal-modulos" tabindex="-1" style="display: none; z-index: 5000" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content border">
            <div class="modal-header">
                <h5 class="modal-title">Buscar modulo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <label class="form-label">Buscar</label>
                <div class="input-icon mb-3">
                    <input id="search-modulo" type="search" class="form-control" placeholder="Buscar..." autocomplete="off">
                    <span class="input-icon-addon">
                        <i class="ti ti-search"></i>
                    </span>
                </div>
                <br>
                <table id="table-modulos" class="table">
                    <thead>
                        <tr>
                            <th><input class="form-check-input" type="checkbox" id="checkTodo"></th>
                            <th class="role_id">ID</th>
                            <th>Modulo</th>
                            <th>Catálogo</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white">
                        
                    </tbody>
                </table>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                    <button type="button" class="btn btn-success" onclick="addModulo()">Agregar</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script src="{{ asset('assets/js/usuarios/config.js') }}"></script>
<script src="{{ asset('assets/js/usuarios/crud-user.js') }}"></script>
<script>
    $( document ).ready(function() {
        getUsuarios(2, '');
        $("#modal-user").draggable();
        $("#modal-modulos").draggable();
    });
</script>
@endsection
