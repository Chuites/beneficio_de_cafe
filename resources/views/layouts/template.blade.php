<!DOCTYPE html>
<html lang="es">
    <head>
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="appToken" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ config('constantes.appIcon') }}" type="image/x-icon" />
        <title> {{ config('constantes.appName')}} | @yield('tituloPagina') </title>

        <!-- Bootstrap -->
        {!!Html::style('sources/bootstrap-3.3.6/css/bootstrap.min.css')!!}    
        <!-- Font Awesome -->
        {!!Html::style('sources/font-awesome-5.12.0/css/all.min.css')!!}    
        {!!Html::style('templates/simple-template/bootstrap-submenu/css/bootstrap-submenu.css')!!}    
        <!-- Custom Theme Style -->            
        {!!Html::style('templates/simple-template/style.css')!!}
        @yield('styles')
    </head>
    <body>

        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="{{route('inicio')}}" class="navbar-brand"><span>{{ config('constantes.appName') }}</span></a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <!-- li menu -->
                    @include('layouts.simple-template.menu')
                    <!-- /li menu -->
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="#" id="OpcionLink1" data-toggle="tooltip" title="OpcionLink1">
                                <i class="fas fa-globe fa-1x"></i>
                                <span class="badge" style="color: #eee; background-color: #246686;">0</span>
                            </a>
                        </li>
                        <li>
                            <a href="#" id="OpcionLink2" data-toggle="tooltip" title="OpcionLink2">
                                <i class="fas fa-globe fa-1x"></i>
                                <span class="badge" style="color: #eee; background-color: #246686;">0</span>
                            </a>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <img src="data:image/png;base64,{{ Session::get('userphoto') }}" class="img-circle" width="15"> {{ Session::get('username')}} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <img src="data:image/png;base64,{{ Session::get('userphoto') }}" alt="usuario" class="thumbnail img-responsive" style="max-width: 80px; margin: auto;">
                                </li>
                                <li><div id="top-menu-username">{{ Session::get('usernombre')}} <br>{{ Session::get('userapellido')}} </div></li>
                                <li><a href="{{route('cambioPwd')}}"><i class="fas fa-user-lock"></i> Cambio de Contraseña</a></li>
                                <li><a href="{{asset('pdf/manual.pdf')}}" target="_blank" data-toggle="tooltip" data-placement="top" title="Manual de Usuario">
                                        <span class="fas fa-book" aria-hidden="true"> Manual de Usuario</span>
                                    </a></li>
                                <li><a href="{{route('salir')}}"><i class="fas fa-sign-out-alt"></i> Salir</a></li>
                            </ul>
                        </li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <main>
            <div class="container">
                <div class="container-fluid">
                    <div class="row" id="titulo-pagina">
                        <h1> @yield('titulo') | <small>@yield('subtitulo')</small></h1>
                    </div>
                    <!-- notificaciones -->
                    <div class="row">
                        <div class="alert alert-danger alert-dismissible" role="alert" id="alerta" hidden>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="alert alert-success" id="aviso" hidden>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        @include('alerts.request')
                        @include('alerts.errors')
                        @include('alerts.success')
                    </div>
                    <!-- /notificaciones -->
                </div>
            </div>
            <div class="container bodycontent">
                @yield('contenedor_pantalla')
            </div>
        </main>

        <footer>
            <div class="container">
                <div class="pull-left">
                    <strong> <a > Ministerio de Gobernación</a> </strong> <br>
                    6a avenida 13-71 zona 1, Guatemala, Guatemala. PBX 2413-8888. <br>
                    www.mingob.gob.gt
                </div>
                <div class="pull-right">
                    <img src="{{ config('constantes.appLogoFooter') }}" height="70">
                </div>
                <div class="clearfix"></div>
            </div>
        </footer>

        <!-- jQuery -->
        {!!Html::script('js/jquery-1.12.4.min.js')!!}
        <!-- Bootstrap -->
        {!!Html::script('sources/bootstrap-3.3.6/js/bootstrap.min.js')!!}
        {!!Html::script('templates/simple-template/bootstrap-submenu/js/bootstrap-submenu.js')!!}
        <!-- Custom Theme Scripts -->
        {!!Html::script('js/blockUI-2.70.0.js')!!}
        {!! Html::script('js/bootbox.min.js') !!}
        {!!Html::script('js/mingobapp.js')!!}
        <script type="text/javascript">
            $(document).ready(function() {
                $('[data-submenu]').submenupicker();
                $('body').tooltip({selector: '[data-toggle="tooltip"]',placement: "auto"});
            });
        </script>
        @yield('scripts')
    </body>
</html>