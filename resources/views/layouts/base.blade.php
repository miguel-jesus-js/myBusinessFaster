<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('img/logo-icono.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Raleway:wght@300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.mCustomScrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/general.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/iconfont/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    @yield('css')
    <title>SOFTCODE</title>
</head>

<body>
    
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Pre-loader end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header" id="navbar">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a class="mobile-menu waves-effect waves-light" id="mobile-collapse" href="#!">
                            <i class="ti ti-menu-2 h2"></i>
                        </a>
                        <div class="mobile-search waves-effect waves-light">
                            <div class="header-search">
                                <div class="main-search morphsearch-search">
                                    <div class="input-group">
                                        <span class="input-group-prepend search-close"><i
                                                class="ti-close input-group-text"></i></span>
                                        <input type="text" class="form-control" placeholder="Enter Keyword">
                                        <span class="input-group-append search-btn"><i
                                                class="ti-search input-group-text"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="/dashboard">
                            <img src="{{ asset('img/logo-horizontal-white.png') }}" alt="logo" width="130">
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="ti-more"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a>
                                </div>
                            </li>
                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()" class="waves-effect waves-light">
                                    <i class="ti ti-arrows-maximize h2"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <i class="ti ti-bell h2"></i>
                                    <span class="badge bg-c-red"></span>
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius"
                                                src="" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                    elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius"
                                                src="" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Joseph William</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                    elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius"
                                                src="" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Sara Soudein</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer
                                                    elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="">
                                <a href="#offcanvasConfig" role="button" aria-controls="offcanvasConfig" class="waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-placement="bottom" title="Paleta de colores">
                                    <i class="ti ti-palette h2"></i>
                                </a>
                            </li>
                            <li class="user-profile header-notification">
                                <a href="#!" class="waves-effect waves-light">
                                    <img src="{{ asset('img/usuarios/'.Auth::user()->persona->foto_perfil) }}" class="img-radius"
                                        alt="Foto de perfil">
                                    <span>{{ Auth::user()->nom_user }}</span>
                                    <i class="ti ti-chevron-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li class="waves-effect waves-light">
                                        <a href="#" class="open-modal-perfil">
                                            <i class="ti ti-user"></i> Perfil
                                        </a>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <a href="/settings">
                                            <i class="ti ti-settings"></i> Configuraciones
                                        </a>
                                    </li>
                                    <li class="waves-effect waves-light">
                                        <form action="api/logout" method="POST">
                                            @csrf
                                            <a href="#" onclick="this.closest('form').submit()">
                                                <i class="ti ti-logout"></i> Cerrar sesión
                                            </a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu">
                            <div class="" id="page-header-menu">
                                <div class="main-menu-header">
                                    <img class="img-80 img-radius" src="{{ asset('img/usuarios/'.Auth::user()->persona->foto_perfil) }}"
                                        alt="Foto de perfil">
                                    <div class="user-details">
                                        <span id="more-details">{{ Auth::user()->nom_user }}<i class="ti ti-chevron-down"></i></span>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="#" class="open-modal-perfil">
                                                <i class="ti ti-user"></i> Perfil
                                            </a>
                                            <a href="/settings">
                                                <i class="ti ti-settings"></i> Configuraciones
                                            </a>
                                            <form action="api/logout" method="POST">
                                                @csrf
                                                <a href="#" onclick="this.closest('form').submit()">
                                                    <i class="ti ti-logout"></i> Cerrar sesión
                                                </a>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <ul class="pcoded-item pcoded-left-item pt-2">
                                <li class="{{ (request()->is('dashboard')) ? 'active' : '' }} data-item-color">
                                    <a href="/dashboard" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti ti-smart-home icono"></i></span>
                                        <span class="pcoded-mtext">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                            </ul>
                            <div class="pcoded-navigation-label">MODULOS</div>
                            
                            <ul class="pcoded-item pcoded-left-item">
                                <li class="{{ (request()->is('catalogos')) ? 'active' : '' }} data-item-color">
                                    <a href="/catalogos" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti ti-briefcase icono"></i></span>
                                        <span class="pcoded-mtext">Catálogos</span>
                                    </a>
                                </li>
                                <li class="pcoded-hasmenu data-item-color">
                                    <a href="javascript:void(0)" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti ti-shopping-cart icono"></i></span>
                                        <span class="pcoded-mtext">Ventas</span>
                                        <span class="ti ti-chevron-down acordeon"></span>
                                    </a>
                                    <ul class="pcoded-submenu">
                                        <li class=" ">
                                            <a href="/punto-de-venta" target="_blank" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Punto de venta</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="/historial" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Historial</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="{{ (request()->is('asignar_productos')) ? 'active' : '' }} data-item-color">
                                    <a href="/asignar_productos" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti ti-git-branch icono"></i></span>
                                        <span class="pcoded-mtext">Asignar productos</span>
                                    </a>
                                </li>
                                <li class="{{ (request()->is('gastos')) ? 'active' : '' }} data-item-color">
                                    <a href="/gastos" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti ti-currency-dollar-off icono"></i></span>
                                        <span class="pcoded-mtext">Gastos</span>
                                    </a>
                                </li>
                                <li class="{{ (request()->is('corte_caja')) ? 'active' : '' }} data-item-color">
                                    <a href="/corte_caja" class="waves-effect waves-dark">
                                        <span class="pcoded-micon"><i class="ti ti-device-laptop icono"></i></span>
                                        <span class="pcoded-mtext">Corte de caja</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                    <div class="pcoded-content">
                        <!-- Page-header start -->
                        @yield('contenido')

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Offcanvas configuraciones -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasConfig" aria-labelledby="offcanvasConfigLabel">
        <div class="offcanvas-header">
        <h2 class="offcanvas-title" id="offcanvasConfigLabel"> <i class="ti ti-palette"></i> Paleta de colores</h2>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <form id="form-settings" action="">
            <div class="mb-3">
                <label class="form-label">Colores disponibles</label>
                <div class="row g-2">
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#1d273b" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-dark rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput form-colorinput-light">
                      <input name="color" type="radio" value="#ffffff" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-white rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#206bc4" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-blue rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#4299e1" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-azure rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#4263eb" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-indigo rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#ae3ec9" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-purple rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#d6336c" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-pink rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#d63939" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-red rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#f76707" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-orange rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#f59f00" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-yellow rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#74b816" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-lime rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#2fb344" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-green rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#0ca678" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-teal rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <label class="form-colorinput">
                      <input name="color" type="radio" value="#17a2b8" class="form-colorinput-input">
                      <span class="form-colorinput-color bg-cyan rounded-circle"></span>
                    </label>
                  </div>
                  <div class="col-auto">
                    <a href="">Perzonalizado</a>
                  </div>
                </div>
            </div>
            <br>
            <div class="divide-y">
                <div>
                  <label class="row">
                    <span class="col">Mostrar menu</span>
                    <span class="col-auto">
                      <label class="form-check form-check-single form-switch">
                        <input class="form-check-input" type="checkbox" name="mostrar_sidebar" id="mostrar_sidebar" value="true">
                      </label>
                    </span>
                  </label>
                </div>
                <div>
                  <label class="row">
                    <span class="col">Mostrar banner</span>
                    <span class="col-auto">
                      <label class="form-check form-check-single form-switch">
                        <input class="form-check-input" type="checkbox" name="mostrar_banner" id="mostrar_banner" value="true">
                      </label>
                    </span>
                  </label>
                </div>
                <div>
                    <label class="row">
                      <span class="col">Mostrar avatar</span>
                      <span class="col-auto">
                        <label class="form-check form-check-single form-switch">
                          <input class="form-check-input" type="checkbox" name="mostrar_foto" id="mostrar_foto" value="true">
                        </label>
                      </span>
                    </label>
                </div>
            </div>
            <br><br>
            <button class="btn btn-secondary" type="button" data-bs-dismiss="offcanvas" id="closeCanvas">
                <i class="ti ti-x icono"></i> Cancelar
            </button>
            <button class="btn btn-success" type="submit">
                <i class="ti ti-device-floppy icono"></i> Guardar
            </button>
        </form>
        </div>
    </div>
    <!-- MODAL EDITAR PERFIL -->
    <div class="modal modal-blur fade" id="modal-perfil" tabindex="-1" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-perfil"></h5>
                    <button type="button" class="btn-close" onclick="closeModal('modal-perfil', 'form-add-perfil')"></button>
                </div>
                <div class="modal-body">
                    <form id="form-perfil">
                        <ul class="nav nav-pills" data-bs-toggle="tabs">
                            <li class="nav-item active">
                                <a href="#tab-datos-pers-perfil" class="nav-link active btn-tab" data-bs-toggle="tab">
                                    <i class="ti ti-id icono me-1"></i>
                                    Datos personales</a>
                            </li>
                            <li class="nav-item">
                                <a href="#contacto-perfil" class="nav-link btn-tab" data-bs-toggle="tab">
                                    <i class="ti ti-phone icono me-1"></i>
                                    Datos de contacto</a>
                            </li>
                            <li class="nav-item">
                                <a href="#foto-perfil" class="nav-link btn-tab" data-bs-toggle="tab">
                                    <i class="ti ti-photo icono me-1"></i>
                                    Subir foto</a>
                            </li>
                            <li class="nav-item">
                                <a href="#key-perfil" class="nav-link btn-tab" data-bs-toggle="tab">
                                    <i class="ti ti-key icono me-1"></i>
                                    Cambiar contraseña</a>
                            </li>
                            
                        </ul>
                        <br>
                        <div class="tab-content">
                            <div id="load-form-perfil" class="efecto-cargando">
    
                            </div>
                            <div class="tab-pane active show" id="tab-datos-pers-perfil">
                                <div class="row">
                                    <div class="col-sm-6 col-md-4 mb-3">
                                        <input type="number" class="d-none" id="id" name="id" value="{{ Auth::user()->persona->id }}">
                                        <input type="number" class="d-none" id="cliente_id" name="cliente_id" value="{{ Auth::user()->id }}">
                                        <input type="number" class="d-none" id="role_id" name="role_id" value="{{ Auth::user()->role_id }}">
                                        <select class="form-select d-none" name="sucursale_id" id="sucursale_id" onclick="getSucursales()" required>
                                            <option value="{{ Auth::user()->sucursale_id }}" id="load-select" ></option>
                                        </select>
                                        <label class="form-label required">Nombre(s)</label>
                                        <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombre(s)" required autocomplete="off" pattern="[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,25}+[a-zA-ZñÑáéíóúÁÉÍÓÚüÜ]{2,50}" value="{{ Auth::user()->persona->nombres }}">
                                        <div class="invalid-feedback" id="error-nombres"></div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mb-2">
                                        <label class="form-label">RFC</label>
                                        <input type="text" class="form-control" name="rfc" id="rfc" placeholder="RFC" autocomplete="off" pattern="^([A-ZÑ\x26]{3,4}([0-9]{2})(0[1-9]|1[0-2])(0[1-9]|1[0-9]|2[0-9]|3[0-1]))([A-Z\d]{3})?$">
                                        <div class="invalid-feedback" id="error-rfc" value="{{ Auth::user()->persona->rfc }}"></div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mb-2">
                                        <label class="form-label required">Usuario</label>
                                        <input type="text" class="form-control" name="nom_user" id="nom_user" placeholder="Usuario" required autocomplete="off" maxlength="20" minlength="5" value="{{ Auth::user()->nom_user }}">
                                        <div class="invalid-feedback" id="error-nom_user"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="contacto-perfil">
                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label required">Teléfono</label>
                                        <input type="text" name="telefono" id="telefono" class="form-control" data-mask="(00) 0000-0000" data-mask-visible="true" placeholder="(00) 0000-0000" required autocomplete="off" value="{{ Auth::user()->persona->telefono }}">
                                        <div class="invalid-feedback" id="error-telefono"></div>
                                    </div>
                                    <div class="col-sm-6 mb-3">
                                        <label class="form-label required">Correo</label>
                                        <input type="email" class="form-control" name="email" id="email" placeholder="Correo" required autocomplete="off" pattern="[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*@[a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{1,5}" value="{{ Auth::user()->persona->email }}">
                                        <div class="invalid-feedback" id="error-email"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="foto-perfil">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <span class="avatar avatar-xl">
                                            <img src="{{ asset('img/usuarios/'.Auth::user()->persona->foto_perfil) }}" alt="" id="show-foto_perfil">
                                        </span>
                                    </div>
                                    <div class="col-auto">
                                        <label for="" class="form-label">Cambiar logotipo</label>
                                        <input type="file" class="form-control" name="foto_perfil" id="foto_perfil" accept="image/jpeg,image/jpg,image/png" onchange="preview('foto_perfil', 'view-foto_perfil')">
                                        <div id="preview-foto_perfil" class="d-none row">
                                            <div class="col-auto">
                                              <span class="avatar"><img src="" alt="" id="view-foto_perfil"></span>
                                            </div>
                                            <div class="col">
                                              <div class="text-truncate">
                                                <strong id="name-foto_perfil"></strong>
                                              </div>
                                              <div class="text-muted" id="peso-foto_perfil"></div>
                                            </div>
                                            <div class="col-auto align-self-center">
                                              <button type="button" class="ti ti-x btn btn-danger text-white rounded-circle remover" onclick="removeImg('logotipo')"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="key-perfil">
                                <div class="row align-items-center">
                                    <div class="col-sm-6 col-md-6 mb-2">
                                        <label class="form-label">Contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" autocomplete="off" maxlength="20" minlength="8">
                                            <span class="input-group-text">
                                                <a href="#" onclick="showHidePassword('password', 'eye-icon')" class="input-group-link"><i id="eye-icon" class="ti ti-eye"></i></a>
                                            </span>
                                            <div class="invalid-feedback" id="error-password"></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6 mb-2">
                                        <label class="form-label">Repetir contraseña</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" name="password-repeat" id="password-repeat" placeholder="Contraseña" autocomplete="off" maxlength="20" minlength="8">
                                            <span class="input-group-text">
                                                <a href="#" onclick="showHidePassword('password-repeat', 'eye-icon-1')" class="input-group-link"><i id="eye-icon-1" class="ti ti-eye"></i></a>
                                            </span>
                                            <div class="invalid-feedback" id="error-password-eye"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-red btn-pill" onclick="closeModal('modal-perfil', 'form-perfil')">Cancelar</button>
                                <button type="submit" class="btn btn-blue btn-pill">
                                    <span id="load-button-perfil" class="spinner-grow spinner-grow-sm me-1 d-none" role="status" aria-hidden="true"></span>
                                    <b id="btn-modal-perfil">Actualizar</b>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Jquery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/tabler.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
    <script src="{{ asset('assets/js/vertical-layout.min.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/js/respuestas.js') }}"></script>
    <script src="{{ asset('assets/js/pagination.js') }}"></script>
    <script src="{{ asset('assets/js/moverElementos.js') }}"></script>
    <script src="{{ asset('assets/js/redimensionarTabla.js') }}"></script>
    <script src="{{ asset('assets/js/filter.js') }}"></script>
    <script src="{{ asset('assets/js/openCloseModal.js') }}"></script>
    <script src="{{ asset('assets/js/showHidePassword.js') }}"></script>
    <script src="{{ asset('assets/js/settings/settings.js') }}"></script>
    <script src="{{ asset('assets/js/shared.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            getLocalSettings(); 
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.open-modal-perfil').click(function(){
            openModal('modal-perfil', 'perfil', 1);
        })
    </script>
    @yield('script')
</body>

</html>
