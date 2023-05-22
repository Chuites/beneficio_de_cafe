<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Beneficio de Cafe</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css_icons/all.css') }}">
</head>
<body>
@csrf
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <i class="fa-solid fa-mug-hot" style="color: #ffffff;"></i>&nbsp;<a class="navbar-brand" id="btn_bienvenida" href="#">Beneficio de Cafe</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="btn_cargamentos" href="#">Cargamentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btn_agricultores" href="#">Agricultores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btn_piloto" href="#">Piloto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="btn_transporte" href="#">Transporte</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="alert alert-success d-none" role="alert" id="alerta_success" style="margin-left: 1%; margin-right: 1%; margin-top: 1%">
    Esto es un aviso de confirmacion
</div>
<div class="alert alert-danger d-none" role="alert" id="alerta_error" style="margin-left: 1%; margin-right: 1%; margin-top: 1%">
    Esto es un aviso de error
</div>

<div class="container" style="padding: 2%">
    @include('bienvenida')
    @include('cargamentos')
    @include('piloto')
    @include('transporte')
    @include('agricultores')
</div>
    @include('scripts')
</body>
</html>

