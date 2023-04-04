@extends('layouts.base')
@section('css')

@endsection
@section('contenido')
<div class="page-header" id="page-header">
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
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item"><i class="ti ti-brand-tidal me-2"></i><a href="/dashboard">Catalogos</a></li>
                    <li class="breadcrumb-item active"><i class="ti ti-cookie me-2"></i><a href="/productos">Productos</a></li>
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
                                    <li>
                                        <a class="btn" data-bs-toggle="offcanvas" href="#offcanvasEnd" role="button" aria-controls="offcanvasEnd">
                                            Busqueda avanzada
                                        </a>
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
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Exportar" onclick="openModal('modal-campos','productos', 0)">
                        <i class="ti ti-file-text icono"></i>
                    </button>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Importar" onclick="openModal('upload-producto','productos', 0)">
                        <i class="ti ti-file-upload icono"></i>
                    </button>
                    <a href="{{ route('downloadPlantillaProducto') }}" target="_blank" class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Descargar plantilla" download="Excel productos">
                        <i class="ti ti-file-download icono"></i>
                    </a>
                    <button class="btn btn-dark btn-icon" aria-label="Button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Recargar" onclick="getProductos(2, '');">
                        <i class="ti ti-refresh icono"></i>
                    </button>
                </div>
                <br><br>
                <div class="table-responsive">
                    <table id="table-producto" class="table shadow-sm bg-white table-bordered">
                        <thead class="disable-selection">
                            <tr>
                                <th>Código de barra</th>
                                <th>Producto</th>
                                <th>Marca</th>
                                <th>Almacén</th>
                                <th>Medida</th>
                                <th>Proveedor</th>
                                <th>Material</th>
                                <th>P.de compra</th>
                                <th>P.de venta</th>
                                <th class="d-none oculto">Precio de mayoreo</th>
                                <th class="d-none oculto">Stock mínimo</th>
                                <th class="d-none oculto">Utilidad</th>
                                <th class="d-none oculto">Código del SAT</th>
                                <th class="d-none oculto">Caducidad</th>
                                <th class="d-none oculto">Color</th>
                                <th class="d-none oculto">Talla</th>
                                <th class="d-none oculto">Modelo</th>
                                <th class="d-none oculto">Meses de garantia</th>
                                <th class="d-none oculto">Peso en KG</th>
                                <th class="d-none oculto">Es producción</th>
                                <th class="d-none oculto">Afecta a ventas</th>
                                <th colspan="4" class="text-center">Acciones</th>
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
                            <a href="#tab-cat" class="nav-link btn-tab" data-bs-toggle="tab" onclick="getCategorias('');">
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
                        <div id="load-form" class="efecto-cargando">
                        </div>
                        <div class="tab-pane active show" id="tab-datos-gen">
                            <div class="row">
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <input type="number" class="d-none" id="id" name="id">
                                    <label class="form-label required">Código de barra</label>
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control" name="cod_barra" id="cod_barra" placeholder="Código de barra" required autocomplete="off" min="0" minlength="13" maxlength="13">
                                        <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Generar" onclick="getCodBarraOrSat(0)"><i class="ti ti-reload"></i></button>
                                        <div class="invalid-feedback" id="error-cod_barra"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label">Código del SAT</label>
                                    <div class="input-group mb-2">
                                        <input type="number" class="form-control" name="cod_sat" id="cod_sat" placeholder="Código del SAT" autocomplete="off" min="0" minlength="8" maxlength="8">
                                        <button class="btn" type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Generar" onclick="getCodBarraOrSat(1)"><i class="ti ti-reload"></i></button>
                                        <div class="invalid-feedback" id="error-cod_sat"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-3">
                                    <label class="form-label required">Producto</label>
                                    <input type="text" class="form-control" name="producto" id="producto" placeholder="Producto" required autocomplete="off" minlength="3" maxlength="50">
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
                                    <input type="number" class="form-control" name="pre_compra" id="pre_compra" placeholder="Precio de compra" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7" step=0.01>
                                    <div class="invalid-feedback" id="error-pre_compra"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Precio de venta</label>
                                    <input type="number" class="form-control" name="pre_venta" id="pre_venta" placeholder="Precio de venta" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7" step=0.01>
                                    <div class="invalid-feedback" id="error-pre_venta"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Precio por mayoreo</label>
                                    <input type="number" class="form-control" name="pre_mayoreo" id="pre_mayoreo" placeholder="Precio por mayoreo" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7" step=0.01>
                                    <div class="invalid-feedback" id="error-pre_mayoreo"></div>
                                </div>
                                <div class="col-sm-6 col-md-4 mb-2">
                                    <label class="form-label required">Stock minimo</label>
                                    <input type="number" class="form-control" name="stock_min" id="stock_min" placeholder="Stock minimo" autocomplete="off" required min="1" max="100000" minlength="1" maxlength="7">
                                    <div class="invalid-feedback" id="error-stock_min"></div>
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
                                    <div id="load-form2" class="efecto-cargando">
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
                                            <th>Características</th>
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
                    <div id="load-form1" class="efecto-cargando">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label required">Característica</label>
                            <input type="text" class="form-control" name="caracteristica" id="caracteristica" placeholder="Característica" autocomplete="off" required pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{5,50}" minlength="5" maxlength="100">
                            <div class="invalid-feedback" id="error-caracteristica"></div>
                        </div>
                    </div>
                    <br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close">Cancelar</button>
                        <button type="submit" class="btn btn-success">
                            <span id="load-button1" class="spinner-grow spinner-grow-sm me-1 d-none" role="status" aria-hidden="true"></span>
                            <b id="btn-modal1">Agregar</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="upload-producto" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Subir excel de productos</h5>
                <button type="button" class="btn-close" onclick="closeModal('upload-producto', 'form-upload-producto')"></button>
            </div>
            <div class="modal-body">
                <form id="form-upload-producto">
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
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('upload-producto', 'form-upload-producto')">Cancelar</button>
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
<div class="modal modal-blur fade" id="modal-campos" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seleccionar campos</h5>
                <button type="button" class="btn-close" onclick="closeModal('modal-campos', 'form-campos')"></button>
            </div>
            <div class="modal-body">
                <form id="form-campos">
                    <div class="tab-content">
                        <div id="load-form3" class="efecto-cargando">
                            
                        </div>
                        <label class="form-label required">Formato</label>
                        <select class="form-select" name="formato" required id="formato">
                            <option value="" disabled selected>Elige un opción</option>
                            <option value="pdf">PDF</option>
                            <option value="excel">Excel</option>
                        </select>
                        <br>
                        <table class="table shadow-sm bg-white">
                            <thead>
                                <tr>
                                    <th colspan="2">
                                        <label class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkTodo">
                                            <span class="form-check-label">Campos</span>
                                        </label>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="marca_id">
                                            <span class="form-check-label">Marcas</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="almacene_id">
                                            <span class="form-check-label">Almacén</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="unidad_medida_id">
                                            <span class="form-check-label">Unidad de medida</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="proveedore_id">
                                            <span class="form-check-label">Proveedor</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="materiale_id">
                                            <span class="form-check-label">Material</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="cod_barra">
                                            <span class="form-check-label">Código de barra</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="cod_sat">
                                            <span class="form-check-label">Código del sat</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="producto">
                                            <span class="form-check-label">Producto</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="pre_compra">
                                            <span class="form-check-label">Precio de compra</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="pre_venta">
                                            <span class="form-check-label">Precio de venta</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="pre_mayoreo">
                                            <span class="form-check-label">Prercio de mayoreo</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="utilidad">
                                            <span class="form-check-label">Utilidad</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="stock_min">
                                            <span class="form-check-label">Stock mínimo</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="stock">
                                            <span class="form-check-label">Stock</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="caducidad">
                                            <span class="form-check-label">Caducidad</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="color">
                                            <span class="form-check-label">Color</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="talla">
                                            <span class="form-check-label">Talla</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="modelo">
                                            <span class="form-check-label">Modelo</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="meses_garantia">
                                            <span class="form-check-label">Meses de garantia</span>
                                        </label>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label class="form-check">
                                            <input class="form-check-input checar" type="checkbox" name="campos[]" value="peso_kg">
                                            <span class="form-check-label">Peso KG</span>
                                        </label>
                                    </td>
                                </tr>   
                            </tbody>
                        </table>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-campos', 'form-campos')">Cancelar</button>
                            <button type="submit" class="btn btn-blue btn-pill">
                                <span id="load-button3" class="spinner-grow spinner-grow-sm me-1 d-none" role="status" aria-hidden="true"></span>
                                <b id="btn-modal3">Cargar</b>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Offcanvas filtros -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEnd" aria-labelledby="offcanvasEndLabel">
    <div class="offcanvas-header">
      <h2 class="offcanvas-title" id="offcanvasEndLabel"> <i class="ti ti-search"></i> Busqueda avanzada</h2>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <form id="form-filter" action="">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Marca</label>
                <select class="form-select" name="f-marca_id" id="f-marca_id" onclick="getMarcas()">
                    <option value="" id="f-load-select" disabled selected>Elige una opción</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Almacén</label>
                <select class="form-select" name="f-almacene_id" id="f-almacene_id" onclick="getAlmacenes()">
                    <option value="" id="f-load-select2" disabled selected>Elige una opción</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Unidad de medida</label>
                <select class="form-select" name="f-unidad_medida_id" id="f-unidad_medida_id" onclick="getUnidadMedidas()">
                    <option value="" id="f-load-select3" disabled selected>Elige una opción</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Proveedor</label>
                <select class="form-select" name="f-proveedore_id" id="f-proveedore_id" onclick="getProveedores()">
                    <option value="" id="f-load-select4" disabled selected>Elige una opción</option>
                </select>
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Material</label>
                <select class="form-select" name="f-materiale_id" id="f-materiale_id" onclick="getMateriales()">
                    <option value="" id="f-load-select5" disabled selected>Elige una opción</option>
                </select>
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label">Código de barras</label>
                <input type="number" class="form-control" name="f-cod_barra" placeholder="Código de barras" autocomplete="off" min="0" minlength="8" maxlength="8">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label">Código del SAT</label>
                <input type="number" class="form-control" name="f-cod_sat" placeholder="Código del SAT" autocomplete="off" min="0" minlength="8" maxlength="8">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label">Stock</label>
                <input type="number" class="form-control" name="f-stock" placeholder="Stock" autocomplete="off" min="0" minlength="1" maxlength="4">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label">Precio mínimo</label>
                <input type="number" class="form-control" name="f-precio_min" placeholder="Precio mínimo" autocomplete="off" min="0" minlength="1" maxlength="8">
            </div>
            <div class="col-sm-6 mb-3">
                <label class="form-label">Precio máximo</label>
                <input type="number" class="form-control" name="f-precio_max" placeholder="Precio máximo" autocomplete="off" min="0" minlength="1" maxlength="8">
            </div>
            <div class="col-sm-12">
                <div class="form-label">Inventario</div>
                <div>
                    <label class="form-check form-check-inline">
                        <input class="form-check-input" name="f-afecta_ventas" type="checkbox" value="1">
                        <span class="form-check-label">Afecta a ventas</span>
                    </label>
                    <div class="invalid-feedback" id="error-afecta_ventas"></div>
                    <label class="form-check form-check-inline">
                        <input class="form-check-input" name="f-es_produccion" type="checkbox" value="1">
                        <span class="form-check-label">Es produccion</span>
                    </label>
                </div>
            </div>
        </div>
        <button class="btn btn-success" type="submit">
            <i class="ti ti-search icono"></i> Buscar
        </button>
        <button class="btn btn-info" type="button" onclick="this.form.reset();">
            <i class="ti ti-trash icono"></i> Limpiar filtros
        </button>
      </form>
      <button class="btn btn-primary d-none" type="button" data-bs-dismiss="offcanvas" id="closeCanvas">
           Close offcanvas
        </button>
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
    });
</script>
@endsection
