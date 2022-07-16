@extends('layouts.base')
@section('contenido')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">PRODUCTOS</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti-brand-airtable me-2"></i><a href="#">Productos</a></li>
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
                            <input type="hidden" value="productos" id="modulo">
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
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('productos', 'api/getProductos/', 0)">
                                            <span class="form-check-label">Todos</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('productos', 'api/getProductos/', 1)">
                                            <span class="form-check-label">Eliminados</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" checked onclick="filterGeneral('productos', 'api/getProductos/', 2)">
                                            <span class="form-check-label">No eliminados</span>
                                        </label>
                                    </li>
                                </ul>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label invisible">add</label>
                        <button onclick="openModal('modal-producto','productos', 0)" class="btn btn-primary">
                            Agregar producto
                        </button>
                    </div>
                </div><!-- row end -->
                <br>
                <div class="d-flex justify-content-end">
                    <button class="btn" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recargar" onclick="getProductos('api/getProductos/', 2);">
                        <i class="ti ti-refresh icono"></i>
                    </button>
                </div>
                <div class="table-responsive">
                    <table id="table-producto" class="table shadow-sm bg-white">
                        <thead>
                            <tr>
                                <th>Categoría</th>
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

<div class="modal modal-blur fade" id="modal-producto" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-producto', 'form-add-producto')"></button>
            </div>
            <div class="modal-body">
            <form id="form-add-producto">
                    <ul class="nav nav-pills" data-bs-toggle="tabs">
                        <li class="nav-item active">
                            <a href="#tab-datos-gen" class="nav-link active btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-notes icono me-1"></i>
                                Datos generales</a>
                        </li>
                        <li class="nav-item">
                            <a href="#cat" class="nav-link btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-sitemap icono me-1"></i>
                                Categorias</a>
                        </li>
                        <li class="nav-item">
                            <a href="#caract" class="nav-link btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-list-details icono me-1"></i>
                                Características</a>
                        </li>
                        <li class="nav-item">
                            <a href="#extras" class="nav-link btn-tab" data-bs-toggle="tab">
                                <i class="ti ti-plus icono me-1"></i>
                                Extras</a>
                        </li>
                        
                    </ul>
                    <br>
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
                        <div class="tab-pane active show" id="tab-datos-gen">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <input type="number" class="d-none" id="id" name="id">
                                    <label class="form-label required">C.Barra</label>
                                    <input type="text" class="form-control" name="cod_barra" id="cod_barra" placeholder="Código de barra" required autocomplete="off" pattern="[0-9]{13,13}">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Producto</label>
                                    <input type="text" class="form-control" name="producto" id="producto" placeholder="Producto" required autocomplete="off" pattern="{5,100}">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Marca</label>
                                    <select class="form-select" name="marca_id" id="marca_id" onclick="getMarcas()">
                                        <option value="" id="load-select" disabled selected>Elige una opción</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Material</label>
                                    <select class="form-select">
                                        <option>Mustard</option>
                                        <option>Ketchup</option>
                                        <option>Relish</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">P.Compra</label>
                                    <input type="number" class="form-control" name="pre_compra" id="pre_compra" placeholder="Precio compra" autocomplete="off">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">P.Venta</label>
                                    <input type="number" class="form-control" name="pre_venta" id="pre_venta" placeholder="Precio venta" autocomplete="off">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">P.Mayoreo</label>
                                    <input type="number" class="form-control" name="pre_mayoreo" id="pre_mayoreo" placeholder="Precio mayoreo" autocomplete="off">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Stock minimo</label>
                                    <input type="number" class="form-control" name="stock_min" id="stock_min" placeholder="Stock minimo" autocomplete="off">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Stock</label>
                                    <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock" autocomplete="off">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <div class="form-label required">Inventario</div>
                                    <div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" checked>
                                            <span class="form-check-label">Afecta a ventas</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox">
                                            <span class="form-check-label">Es produccion</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="cat">
                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label required">Telefóno</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control" data-mask="(00) 0000-0000" data-mask-visible="true" placeholder="(00) 0000-0000" required autocomplete="off">
                                </div>
                                <div class="col-sm-6 mb-3">
                                    <label class="form-label required">Correo</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Correo" required autocomplete="off" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}">
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="caract">
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
@endsection
@section('script')
<script src="{{ asset('assets/js/productos/config.js') }}"></script>
<script src="{{ asset('assets/js/productos/crud-producto.js') }}"></script>
<script>
    $( document ).ready(function() {
        getProductos('api/getProductos/', 2);
        $('materiale_id').selectpicker();
        $("#modal-producto").draggable();
    });
</script>
@endsection
