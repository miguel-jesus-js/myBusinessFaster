@extends('layouts.base')
@section('contenido')
<div class="page-header" id="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">PRODUCCIÓN</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active"><i class="ti ti-circles me-2"></i><a href="/produccion">Producción</a></li>
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
                <div class="card">
                    <div class="card-body">
                        <form id="form-add-insumo">
                            <div class="tab-content">
                                <div id="load-form" class="efecto-cargando">
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label required">Producto padre</label>
                                                <select class="form-select" name="parent_id" id="parent_id" required>
                                                    <option value="" disabled selected id="load-select">Elige una opción</option>
                                                </select>
                                                <div class="invalid-feedback" id="error-parent_id"></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label required">Cantidad</label>
                                                <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad" autocomplete="off" min="1" max="100000" minlength="1" maxlength="7">
                                                <div class="invalid-feedback" id="error-cantidad"></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label required">Insumos</label>
                                                <select class="form-select" name="id" id="id" required>
                                                    <option value="" disabled selected id="load-select-1">Elige una opción</option>
                                                </select>
                                                <div class="invalid-feedback" id="error-id"></div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label class="form-label required">Cantidad x producto</label>
                                                <input type="number" class="form-control" name="cantidad_producto" id="cantidad_producto" placeholder="Cantidad x producto" autocomplete="off" min="1" max="100000" minlength="1" maxlength="7">
                                                <div class="invalid-feedback" id="error-cantidad_producto"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="text-center mb-2">Información del producto padre</h5>
                                        <dl class="row text-right">
                                            <dt class="col-5">Código de barras: </dt>
                                            <dd class="col-4 text-left" id="parent-cod"></dd>
                                            <dt class="col-5">Producto: </dt>
                                            <dd class="col-4 text-left" id="parent-prod"></dd>
                                            <dt class="col-5">Stock: </dt>
                                            <dd class="col-4 text-left" id="parent-stock"></dd>
                                        </dl>
                                        <h5 class="text-center my-2">Información del insumo</h5>
                                        <dl class="row text-right">
                                            <dt class="col-5">Código de barras: </dt>
                                            <dd class="col-4 text-left" id="insumo-cod"></dd>
                                            <dt class="col-5">Producto: </dt>
                                            <dd class="col-4 text-left" id="insumo-prod"></dd>
                                            <dt class="col-5">Stock: </dt>
                                            <dd class="col-4 text-left" id="insumo-stock"></dd>
                                        </dl>
                                    </div>
                                </div>
                                <h4>Cantidad a producir: <b id="html-cantidad"></b></h4>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-red btn-pill">Cancelar</button>
                                    <button type="submit" class="btn btn-blue btn-pill">
                                        <span id="load-button" class="spinner-grow spinner-grow-sm me-1 d-none" role="status" aria-hidden="true"></span>
                                        <b id="btn-modal">Agregar</b>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <br>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('assets/js/produccion/crud-insumo.js') }}"></script>
<script src="{{ asset('assets/js/produccion/config.js') }}"></script>
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script>
    $( document ).ready(function() {
        getProductos();
    });
</script>
@endsection
