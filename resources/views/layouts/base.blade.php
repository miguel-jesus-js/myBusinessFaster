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
    <title>GEDO</title>
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
                        <a href="index.html">
                            <img src="{{ asset('img/logo-horizontal.png') }}" alt="logo" width="150">
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
                                    <img src="{{ asset('img/usuarios/'.Auth::user()->foto_perfil) }}" class="img-radius"
                                        alt="User-Profile-Image">
                                    <span>{{ Auth::user()->nom_user }}</span>
                                    <i class="ti ti-chevron-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li class="waves-effect waves-light">
                                        <a href="user-profile.html">
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
                                    <img class="img-80 img-radius" src="{{ asset('img/usuarios/'.Auth::user()->foto_perfil) }}"
                                        alt="User-Profile-Image">
                                    <div class="user-details">
                                        <span id="more-details">{{ Auth::user()->nom_user }}<i class="ti ti-chevron-down"></i></span>
                                    </div>
                                </div>
                                <div class="main-menu-content">
                                    <ul>
                                        <li class="more-details">
                                            <a href="user-profile.html">
                                                <i class="ti ti-user"></i> Perfil
                                            </a>
                                            <a href="#!">
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
                                            <a href="breadcrumb.html" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Punto de venta</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                        <li class=" ">
                                            <a href="button.html" class="waves-effect waves-dark">
                                                <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                                <span class="pcoded-mtext">Historial</span>
                                                <span class="pcoded-mcaret"></span>
                                            </a>
                                        </li>
                                    </ul>
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
    <script type="text/javascript">
        $(document).ready(function(){
            getLocalSettings(); 
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @yield('script')
</body>

</html>
