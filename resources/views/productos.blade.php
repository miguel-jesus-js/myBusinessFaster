@extends('layouts.base')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/bootstrap-select.min.css') }}">
@endsection
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
                                <th>Producto</th>
                                <th>Material</th>
                                <th>Unidad medida</th>
                                <th>Marca</th>
                                <th>Categorias</th>
                                <th>Precio</th>
                                <th>Stock</th>
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
                                    <input type="text" class="form-control" name="cod_barra" id="cod_barra" placeholder="Código de barra" required autocomplete="off" pattern="[0-9]{13,13}" minlength="13" maxlength="13" title="Solo numeros, 13 digitos">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Producto</label>
                                    <input type="text" class="form-control" name="producto" id="producto" placeholder="Producto" required autocomplete="off" minlength="5" maxlength="100" title="Mínimo 5 caracteres máximo 100">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Marca</label>
                                    <select class="form-select" name="marca_id" id="marca_id" onclick="getMarcas()" required>
                                        <option value="" id="load-select" disabled selected>Elige una opción</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Material</label>
                                    <select class="form-select" name="materiale_id" id="materiale_id" onclick="getMateriales()" required>
                                        <option value="" id="load-select1" disabled selected>Elige una opción</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Categorias</label>
                                    <select name="categoria_id[]" id="categoria_id" class="w-100 form-select" data-live-search="true" onclick="getCategorias()">
                                        <option value="" id="load-select2" disabled selected>Elige una opción</option>
                                    </select>                                    
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">U.Medida</label>
                                    <select class="form-select" name="unidad_medida_id" id="unidad_medida_id" onclick="getUnidadMedidas()" required>
                                        <option value="" id="load-select3" disabled selected>Elige una opción</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">P.Compra</label>
                                    <input type="number" class="form-control" name="pre_compra" id="pre_compra" placeholder="Precio compra" autocomplete="off" required min="1" maxlength="7" step=0.01>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">P.Venta</label>
                                    <input type="number" class="form-control" name="pre_venta" id="pre_venta" placeholder="Precio venta" autocomplete="off" required min="1" maxlength="7" step=0.01>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">P.Mayoreo</label>
                                    <input type="number" class="form-control" name="pre_mayoreo" id="pre_mayoreo" placeholder="Precio mayoreo" autocomplete="off" required min="1" maxlength="7" step=0.01>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Stock minimo</label>
                                    <input type="number" class="form-control" name="stock_min" id="stock_min" placeholder="Stock minimo" autocomplete="off" required min="1" maxlength="7">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Stock</label>
                                    <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock" autocomplete="off" required min="1" maxlength="7">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <div class="form-label required">Inventario</div>
                                    <div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" name="afecta_ventas" id="afecta_ventas" type="checkbox" checked value="1">
                                            <span class="form-check-label">Afecta a ventas</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" name="es_produccion" id="es_produccion" type="checkbox" value="1">
                                            <span class="form-check-label">Es produccion</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="caract">
                            <div class="d-flex justify-content-end">
                                <label class="form-label required invisible">Característica</label>
                                <button type="button" class="btn btn-success" onclick="openModal('modal-caracteristica','productos', 2)">Agregar característica</button>
                            </div>
                            <br>
                        </div>
                        <div class="tab-pane" id="extras">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">F.Caducidad</label>
                                    <input type="date" class="form-control" name="caducidad" id="caducidad" autocomplete="off">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Color</label>
                                    <input type="text" class="form-control" name="color" id="color" placeholder="Color" autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" minlength="3" maxlength="50" title="Mínimo 3 caracteres máximo 50">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Talla</label>
                                    <select class="form-select" name="talla" id="talla">
                                        <option value="" disabled selected>Elige una opción</option>
                                        <option value="XS">Extra chica</option>
                                        <option value="CH">Chica</option>
                                        <option value="M">Mediana</option>
                                        <option value="G">Grande</option>
                                        <option value="XG">Extra grande</option>
                                    </select>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Imagen 1</label>
                                    <input type="file" class="form-control" name="img1" id="img1" accept="image/gif,image/jpeg,image/jpg,image/png">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Imagen 2</label>
                                    <input type="file" class="form-control" name="img2" id="img2" accept="image/gif,image/jpeg,image/jpg,image/png">
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Imagen 3</label>
                                    <input type="file" class="form-control" name="img3" id="img3" accept="image/gif,image/jpeg,image/jpg,image/png">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Descripción detallada</label>
                                    <textarea class="form-control" name="desc_detallada" id="desc_detallada" placeholder="Descripción detallada" cols="30" rows="5" minlength="5" maxlength="200" title="Mínimo 5 caracteres máximo 200"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-producto', 'form-add-producto')">Cancelar</button>
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
<!-- Modal para agregar caracteristica -->
<div class="modal modal-blur fade" id="modal-caracteristica" tabindex="-1" style="display: none; z-index: 5000" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content border">
            <div class="modal-header">
                <h5 class="modal-title">Agregar característica</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" id="form-add-caracteristica">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label required">Característica</label>
                            <input type="text" class="form-control" name="color" id="color" placeholder="Característica" autocomplete="off" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{5,50}" minlength="5" maxlength="50" title="Mínimo 5 caracteres máximo 50">
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                        <button type="submit" class="btn btn-success">Agregar</button>
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
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap-select.min.js') }}"></script>
<script>
    $( document ).ready(function() {
        getProductos('api/getProductos/', 2);
        $("#modal-producto").draggable();
        $("#modal-caracteristica").draggable();
        // let selectCat = $('button[data-id=categoria_id]').prevObject.prop('onclick', 'getCategorias()');
        // debugger;
    });
</script>
@endsection
