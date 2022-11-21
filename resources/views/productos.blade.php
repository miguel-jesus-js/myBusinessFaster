@extends('layouts.base')
@section('css')

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
                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="/productos">Productos</a></li>
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
                            <input type="hidden" value="productos" id="modulo">
                            <span class="input-icon-addon">
                                <i class="ti ti-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col-6 col-sm-4 col-md-3">
                        <label class="form-label" id="filtro-select">Filtro: No eliminados</label>
                        <button class="nav-link dropdown-toggle btn" data-bs-toggle="dropdown"
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
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('productos', 0)">
                                            <span class="form-check-label">Todos</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" onclick="filterGeneral('productos', 1)">
                                            <span class="form-check-label">Eliminados</span>
                                        </label>
                                    </li>
                                    <li>
                                        <label class="form-check">
                                            <input class="form-check-input" name="filter" type="checkbox" checked onclick="filterGeneral('productos', 2)">
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
                <div class="btn-group table-actions">
                    <a href="{{ route('exportarPdfMarca') }}" class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Exportar PDF">
                        <i class="ti ti-file-text icono"></i>
                    </a>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Importar" onclick="openModal('upload-marca','marcas', 0)">
                        <i class="ti ti-file-upload icono"></i>
                    </button>
                    <a href="{{ route('downloadPlantillaMarca') }}" target="_blank" class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Descargar plantilla" onclick="downloadPlantilla()">
                        <i class="ti ti-file-download icono"></i>
                    </a>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recargar" onclick="getProductos(2, '');">
                        <i class="ti ti-refresh icono"></i>
                    </button>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="table-producto" class="table shadow-sm bg-white">
                        <thead class="disable-selection">
                            <tr>
                                <th>Código de barra</th>
                                <th>Producto</th>
                                <th>Marca</th>
                                <th>Almacén</th>
                                <th>Unidad de medida</th>
                                <th>Proveedor</th>
                                <th>Material</th>
                                <th>Precio de compra</th>
                                <th>Precio de venta</th>
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
                            <a href="#tab-cat" class="nav-link btn-tab" data-bs-toggle="tab" onclick="getCategorias();">
                                <i class="ti ti-category icono me-1"></i>
                                Categorías</a>
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
                                    <label class="form-label required">Código de barra</label>
                                    <input type="number" class="form-control" name="cod_barra" id="cod_barra" placeholder="Código de barra" required autocomplete="off" min="0" minlength="13" maxlength="13" value="1234567890123">
                                    <div class="invalid-feedback" id="error-cod_barra"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Código del SAT</label>
                                    <input type="number" class="form-control" name="cod_sat" id="cod_sat" placeholder="Código del SAT" autocomplete="off" min="0" minlength="8" maxlength="8" value="12345678">
                                    <div class="invalid-feedback" id="error-cod_sat"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Producto</label>
                                    <input type="text" class="form-control" name="producto" id="producto" placeholder="Producto" required autocomplete="off" minlength="3" maxlength="50" value="Takis">
                                    <div class="invalid-feedback" id="error-producto"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Marca</label>
                                    <select class="form-select" name="marca_id" id="marca_id" onclick="getMarcas()" required>
                                        <option value="" id="load-select" disabled selected>Elige una opción</option>
                                    </select>
                                    <div class="invalid-feedback" id="error-marca_id"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Almacen</label>
                                    <select class="form-select" name="almacene_id" id="almacene_id" onclick="getAlmacenes()" required>
                                        <option value="" id="load-select1" disabled selected>Elige una opción</option>
                                    </select>
                                    <div class="invalid-feedback" id="error-almacene_id"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Unidad de medida</label>
                                    <select class="form-select" name="unidad_medida_id" id="unidad_medida_id" onclick="getUnidadMedidas()" required>
                                        <option value="" id="load-select2" disabled selected>Elige una opción</option>
                                    </select>
                                    <div class="invalid-feedback" id="error-unidad_medida_id"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Proveedor</label>
                                    <select class="form-select" name="proveedore_id" id="proveedore_id" onclick="getProveedores()" required>
                                        <option value="" id="load-select3" disabled selected>Elige una opción</option>
                                    </select>
                                    <div class="invalid-feedback" id="error-proveedore_id"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Material</label>
                                    <select class="form-select" name="materiale_id" id="materiale_id" onclick="getMateriales()">
                                        <option value="" id="load-select4" disabled selected>Elige una opción</option>
                                    </select>
                                    <div class="invalid-feedback" id="error-materiale_id"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Precio de compra</label>
                                    <input type="number" class="form-control" name="pre_compra" id="pre_compra" placeholder="Precio de compra" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7" step=0.01 value="10">
                                    <div class="invalid-feedback" id="error-pre_compra"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Precio de venta</label>
                                    <input type="number" class="form-control" name="pre_venta" id="pre_venta" placeholder="Precio de venta" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7" step=0.01 value="14">
                                    <div class="invalid-feedback" id="error-pre_venta"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Precio por mayoreo</label>
                                    <input type="number" class="form-control" name="pre_mayoreo" id="pre_mayoreo" placeholder="Precio por mayoreo" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7" step=0.01 value="12">
                                    <div class="invalid-feedback" id="error-pre_mayoreo"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Stock minimo</label>
                                    <input type="number" class="form-control" name="stock_min" id="stock_min" placeholder="Stock minimo" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7" value="2">
                                    <div class="invalid-feedback" id="error-stock_min"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Stock</label>
                                    <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7" value="10">
                                    <div class="invalid-feedback" id="error-stock"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <div class="form-label required">Inventario</div>
                                    <div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" name="afecta_ventas" id="afecta_ventas" type="checkbox" checked value="1">
                                            <span class="form-check-label">Afecta a ventas</span>
                                        </label>
                                        <div class="invalid-feedback" id="error-afecta_ventas"></div>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" name="es_produccion" id="es_produccion" type="checkbox" value="1">
                                            <span class="form-check-label">Es produccion</span>
                                        </label>
                                        <div class="invalid-feedback" id="error-es_produccion"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-cat">
                            <div class="mb-3">
                                <label class="form-label">Seleccionar categorías</label>
                                <div class="form-selectgroup" id="categorias">
                                    <div id="load-form1" class="efecto-cargando">
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                        <div class="tab-pane" id="caract">
                            <div class="d-flex justify-content-end">
                                <label class="form-label required invisible">Característica</label>
                                <button type="button" class="btn btn-success" onclick="openModal('modal-caracteristica','productos', 2)">Agregar característica</button>
                            </div>
                            <br>
                            <div class="table-responsive">
                                <table id="table-caracteristicas" class="table shadow-sm bg-white">
                                    <thead class="disable-selection">
                                        <tr>
                                            <th class="caracteristica_id">ID</th>
                                            <th>Característica</th>
                                            <th colspan="2">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="extras">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Fecha de caducidad</label>
                                    <input type="date" class="form-control" name="caducidad" id="caducidad" autocomplete="off">
                                    <div class="invalid-feedback" id="error-caducidad"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Color</label>
                                    <input type="text" class="form-control" name="color" id="color" placeholder="Color" autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{3,50}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{3,50}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{3,50}" minlength="3" maxlength="50">
                                    <div class="invalid-feedback" id="error-color"></div>
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
                                    <div class="invalid-feedback" id="error-talla"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Modelo</label>
                                    <input type="text" class="form-control" name="modelo" id="modelo" placeholder="Modelo" autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{3,30}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{3,30}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{3,30}" minlength="3" maxlength="30">
                                    <div class="invalid-feedback" id="error-modelo"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label">Meses de garantía</label>
                                    <input type="number" class="form-control" name="meses_garantia" id="meses_garantia" placeholder="Meses de garantía" autocomplete="off" min="0" max="36">
                                    <div class="invalid-feedback" id="error-meses_garantia"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label">Peso KG</label>
                                    <input type="number" class="form-control" name="peso_kg" id="peso_kg" placeholder="Peso en KG" autocomplete="off" min="0" max="500" step=0.01>
                                    <div class="invalid-feedback" id="error-peso_kg"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Imagen 1</label>
                                    <input type="file" class="form-control" name="img1" id="img1" accept="image/jpeg,image/jpg,image/png" onchange="preview('img1', 'view-img1')">
                                    <div class="invalid-feedback" id="error-img1"></div>
                                    <br>
                                    <div id="preview-img1" class="d-none row">
                                        <div class="col-auto">
                                          <span class="avatar"><img src="" alt="" id="view-img1"></span>
                                        </div>
                                        <div class="col">
                                          <div class="text-truncate">
                                            <strong id="name-img1"></strong>
                                          </div>
                                          <div class="text-muted" id="peso-img1"></div>
                                        </div>
                                        <div class="col-auto align-self-center">
                                          <button class="ti ti-x btn btn-danger text-white rounded-circle remover" onclick="removeImg('img1')"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Imagen 2</label>
                                    <input type="file" class="form-control" name="img2" id="img2" accept="image/jpeg,image/jpg,image/png" onchange="preview('img2', 'view-img2')">
                                    <div class="invalid-feedback" id="error-img2"></div>
                                    <br>
                                    <div id="preview-img2" class="d-none row">
                                        <div class="col-auto">
                                          <span class="avatar"><img src="" alt="" id="view-img2"></span>
                                        </div>
                                        <div class="col">
                                          <div class="text-truncate">
                                            <strong id="name-img2"></strong>
                                          </div>
                                          <div class="text-muted" id="peso-img2"></div>
                                        </div>
                                        <div class="col-auto align-self-center">
                                          <button class="ti ti-x btn btn-danger text-white rounded-circle remover" onclick="removeImg('img2')"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Imagen 3</label>
                                    <input type="file" class="form-control" name="img3" id="img3" accept="image/jpeg,image/jpg,image/png" onchange="preview('img3', 'view-img3')">
                                    <div class="invalid-feedback" id="error-img3"></div>
                                    <br>
                                    <div id="preview-img3" class="d-none row">
                                        <div class="col-auto">
                                          <span class="avatar"><img src="" alt="" id="view-img3"></span>
                                        </div>
                                        <div class="col">
                                          <div class="text-truncate">
                                            <strong id="name-img3"></strong>
                                          </div>
                                          <div class="text-muted" id="peso-img3"></div>
                                        </div>
                                        <div class="col-auto align-self-center">
                                          <button class="ti ti-x btn btn-danger text-white rounded-circle remover" onclick="removeImg('img3')"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Descripción detallada</label>
                                    <textarea class="form-control" name="desc_detallada" id="desc_detallada" placeholder="Descripción detallada" cols="30" rows="5" minlength="5" maxlength="200"></textarea>
                                    <div class="invalid-feedback" id="error-desc_detallada"></div>
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
                            <input type="text" class="form-control" name="color" id="color" placeholder="Característica" autocomplete="off" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{5,50}" minlength="5" maxlength="50">
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
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script>
    $( document ).ready(function() {
        getProductos(2, '');
        $("#modal-producto").draggable();
        $("#modal-caracteristica").draggable();
        // let selectCat = $('button[data-id=categoria_id]').prevObject.prop('onclick', 'getCategorias()');
        // debugger;
    });
</script>
@endsection
