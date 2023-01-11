@extends('layouts.base')
@section('contenido')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="page-header-title">
                    <h5 class="m-b-10">CONFIGURACIONES</h5>
                    <p class="m-b-0 text-white">Bienvenido</p>
                </div>
            </div>
            <div class="col-md-4">
                <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
                    <li class="breadcrumb-item"><i class="ti ti-smart-home me-2"></i><a href="/dashboard">Home</a></li>
                    <li class="breadcrumb-item active"><i class="ti ti-circles me-2"></i><a href="#">Configuraciones</a>
                    </li>
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
                <div class="container-xl">
                    <div class="accordion mb-3 shadow-sm bg-white d-block d-md-none" id="accordion-example">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading-1">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-1" aria-expanded="false">
                                <i class="ti ti-menu-2"></i>
                                </button>
                            </h2>
                            <div id="collapse-1" class="accordion-collapse collapse" data-bs-parent="#accordion-example" style="">
                                <div class="accordion-body pt-0">
                                    <h4 class="subheader">CONFIGURACIÓN DE NEGOCIOS</h4>
                                    <ul class="list-group list-group-transparent" data-bs-toggle="tabs">
                                        <li class="nav-item">
                                            <a href="#tabs-mi-perfil" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="tab">Mi perfil</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#tabs-mi-empresa" class="list-group-item list-group-item-action d-flex align-items-center active" data-bs-toggle="tab">Mi empresa</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-3 d-none d-md-block border-end">
                                <div class="card-body">
                                    <h4 class="subheader">CONFIGURACIÓN DE NEGOCIOS</h4>
                                    <ul class="list-group list-group-transparent" data-bs-toggle="tabs">
                                        <li class="nav-item">
                                            <a href="#tabs-mi-perfil" class="list-group-item list-group-item-action d-flex align-items-center" data-bs-toggle="tab">Mi perfil</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#tabs-mi-empresa" class="list-group-item list-group-item-action d-flex align-items-center active" data-bs-toggle="tab">Mi empresa</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col d-flex flex-column">
                                <div class="card-body">
                                    <div class="tab-content">
                                        <div id="load-form" class="efecto-cargando">
                                        </div>
                                        <div class="tab-pane" id="tabs-mi-perfil">
                                            <h2 class="mb-4">My Account</h2>
                                            <h3 class="card-title">Profile Details</h3>
                                            <div class="row align-items-center">
                                                <div class="col-auto"><span class="avatar avatar-xl"
                                                        style="background-image: url(./static/avatars/000m.jpg)"></span>
                                                </div>
                                                <div class="col-auto"><a href="#" class="btn">
                                                        Change avatar
                                                    </a></div>
                                                <div class="col-auto"><a href="#" class="btn btn-ghost-danger">
                                                        Delete avatar
                                                    </a></div>
                                            </div>
                                            <h3 class="card-title mt-4">Business Profile</h3>
                                            <div class="row g-3">
                                                <div class="col-md">
                                                    <div class="form-label">Business Name</div>
                                                    <input type="text" class="form-control" value="Tabler">
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-label">Business ID</div>
                                                    <input type="text" class="form-control" value="560afc32">
                                                </div>
                                                <div class="col-md">
                                                    <div class="form-label">Location</div>
                                                    <input type="text" class="form-control" value="Peimei, China">
                                                </div>
                                            </div>
                                            <h3 class="card-title mt-4">Email</h3>
                                            <p class="card-subtitle">This contact will be shown to others publicly, so choose it
                                                carefully.</p>
                                            <div>
                                                <div class="row g-2">
                                                    <div class="col-auto">
                                                        <input type="text" class="form-control w-auto"
                                                            value="paweluna@howstuffworks.com">
                                                    </div>
                                                    <div class="col-auto"><a href="#" class="btn">
                                                            Change
                                                        </a></div>
                                                </div>
                                            </div>
                                            <h3 class="card-title mt-4">Password</h3>
                                            <p class="card-subtitle">You can set a permanent password if you don't want to use
                                                temporary login codes.</p>
                                            <div>
                                                <a href="#" class="btn">
                                                    Set new password
                                                </a>
                                            </div>
                                            <h3 class="card-title mt-4">Public profile</h3>
                                            <p class="card-subtitle">Making your profile public means that anyone on the Dashkit
                                                network will be able to find
                                                you.</p>
                                            <div>
                                                <label class="form-check form-switch form-switch-lg">
                                                    <input class="form-check-input" type="checkbox">
                                                    <span class="form-check-label form-check-label-on">You're currently
                                                        visible</span>
                                                    <span class="form-check-label form-check-label-off">You're
                                                        currently invisible</span>
                                                </label>
                                            </div>
                                            <div class="card-footer bg-transparent mt-auto">
                                                <div class="btn-list justify-content-end">
                                                    <a href="#" class="btn">
                                                        Cancel
                                                    </a>
                                                    <a href="#" class="btn btn-primary">
                                                        Submit
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane active show" id="tabs-mi-empresa">
                                            <form id="form-general-settings">
                                                <h2 class="mb-4"><i class="ti ti-building"></i> Mi empresa</h2>
                                                <p class="card-subtitle">Esta informción se mostrará a los demás públicamente, elija con cuidado.</p>
                                                <div class="row align-items-center">
                                                    <div class="col-auto">
                                                        <span class="avatar avatar-xl">
                                                            <img src="" alt="" id="show-logotipo">
                                                        </span>
                                                    </div>
                                                    <div class="col-auto">
                                                        <label for="" class="form-label">Cambiar logotipo</label>
                                                        <input type="file" class="form-control" name="logotipo" id="logotipo" accept="image/jpeg,image/jpg,image/png" onchange="preview('logotipo', 'view-logotipo')">
                                                        <div id="preview-logotipo" class="d-none row">
                                                            <div class="col-auto">
                                                              <span class="avatar"><img src="" alt="" id="view-logotipo"></span>
                                                            </div>
                                                            <div class="col">
                                                              <div class="text-truncate">
                                                                <strong id="name-logotipo"></strong>
                                                              </div>
                                                              <div class="text-muted" id="peso-logotipo"></div>
                                                            </div>
                                                            <div class="col-auto align-self-center">
                                                              <button type="button" class="ti ti-x btn btn-danger text-white rounded-circle remover" onclick="removeImg('logotipo')"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row g-3 mb-3">
                                                    <div class="col-sm-6 col-md-4">
                                                        <label for="" class="form-label required">Razón social</label>
                                                        <input type="text" class="form-control" name="razon_social" id="razon_social" required placeholder="Razón social" autocomplete="off" minlength="3" maxlength="100">
                                                    </div>
                                                    <div class="col-sm-6 col-md-4">
                                                        <label for="" class="form-label required">Télefono</label>
                                                        <input type="text" name="telefono" id="telefono" class="form-control" data-mask="(00) 0000-0000" data-mask-visible="true" placeholder="(00) 0000-0000" required autocomplete="off">
                                                    </div>
                                                    <div class="col-sm-6 col-md-4">
                                                        <label for="" class="form-label">RFC</label>
                                                        <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC" autocomplete="off" minlength="12" maxlength="13">
                                                    </div>
                                                </div>
                                                <label for="" class="form-label required">Correo</label>
                                                <input type="email" class="form-control" name="correo" id="correo" required placeholder="Correo" autocomplete="off" minlength="7" maxlength="100">
                                                <br>
                                                <label for="" class="form-label required">Dirección</label>
                                                <textarea class="form-control" name="direccion" id="direccion" required placeholder="Dirección" autocomplete="off" rows="3" minlength="10" maxlength="200"></textarea>
                                                <div class="row my-3">
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
                                                <div class="card-footer bg-transparent mt-auto">
                                                    <div class="btn-list justify-content-end">
                                                        <button type="button" class="btn btn-danger btn-pill" onclick="getSettings()">
                                                            <b>Cancelar</b>
                                                        </button>
                                                        <button type="submit" class="btn btn-blue btn-pill">
                                                            <span id="load-button" class="spinner-grow spinner-grow-sm me-1 d-none" role="status"
                                                                aria-hidden="true"></span>
                                                            <b id="btn-modal">Guardar</b>
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page-body end -->
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script>
    $(document).ready(function () {
        getSettings();
    })
</script>
@endsection
