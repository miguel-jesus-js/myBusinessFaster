<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Inicio de sesión</title>
    <link rel="icon" href="{{ asset('img/logo-icono.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&family=Raleway:wght@300&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/tabler.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/iconfont/tabler-icons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/waves.css') }}">
</head>

<body>
    <!--Hey! This is the original versionof Simple CSS Waves-->
    <div class="header">
        <!--Content before waves-->
        <div class="inner-header flex">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 centrado">
                        <h1 class="text-white">POWERED BY</h1>
                        <img src="{{ asset('img/logo-horizontal.png') }}" alt="logo" class="w-80" width="300">
                        <br>
                        <br>
                        <br>
                        <p class="text-white">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Nesciunt dolorem voluptatibus, maiores pariatur culpa aperiam! Tempore nobis adipisci ullam nam, facilis cum aliquid fugiat repellendus, iste iusto vero consectetur nisi.</p>
                    </div>
                    <div class="col-md-6">
                        <form id="form-login" class="bg-white shadow-sm rounded p-4">
                            <span class="avatar avatar-xl mb-3 avatar-rounded" style="background-image: url({{ asset('img/user-bg.jpg') }})"></span>
                            <center><h1 class="text-dark">INICIO DE SESIÓN</h1></center>
                            <label class="form-label required text-dark">Correo</label>
                            <div class="input-group input-group-flat">
                                <span class="input-group-text border-end" id="icono-email">
                                    <i class="ti ti-mail"></i>
                                </span>
                                <input type="email" class="form-control border-end" name="email" id="email" placeholder="Correo" required autocomplete="off">
                                <div class="invalid-feedback" id="error-email"></div>
                            </div>
                            <br>
                            <label class="form-label required text-dark">Contraseña</label>
                            <div class="input-group input-group-flat">
                                <span class="input-group-text" id="icono-password">
                                    <i class="ti ti-key"></i>
                                </span>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" autocomplete="off">
                                <span class="input-group-text" id="icono-showHide">
                                  <a href="#showHide" class="input-group-link" onclick="showHidePassword('icono')"><i class="ti ti-eye" id="icono"></i></a>
                                </span>
                                <div class="invalid-feedback" id="error-password"></div>
                            </div>

                            <br>
                            <button type="submit" class="btn btn-info w-100" id="btn-enviar">ACCEDER</button>
                        </form>
                    </div>
                </div>
            </div>
            
        </div>
        <!--Waves Container-->
        <div>
            <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
                <defs>
                    <path id="gentle-wave"
                        d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                </defs>
                <g class="parallax">
                    <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
                    <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
                    <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
                    <use xlink:href="#gentle-wave" x="48" y="7" fill="#fff" />
                </g>
            </svg>
        </div>
        <!--Waves end-->

    </div>
    <!--Header ends-->
</body>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/tabler.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('assets/js/respuestas.js') }}"></script>
<script src="{{ asset('assets/js/shared.js') }}"></script>
<script src="{{ asset('assets/js/login/login.js') }}"></script>
</html>
