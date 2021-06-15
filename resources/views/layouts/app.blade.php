<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Registra Transações!</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                        aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Meu Painel</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())
                        <li><a href="#">Login</a></li>
                    @else
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i>
                                Sair
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
        @if (!Auth::guest())
            <!-- MENU LATERAL -->
                <div class="col-sm-3 col-md-2 sidebar">
                    <div class="row div-perfil">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/upload/users/' . auth()->user()->imagem) }}" class="img-perfil">
                        </div>
                        <div class="col-md-8">
                            {{ Auth::user()->name }} <br>
                            <span style="font-size: 12px;">{{ Auth::user()->perfil->no_perfil }}</span>
                        </div>
                    </div>

                    <ul class="nav nav-sidebar">
                        <li class="li-menu-lateral">
                            <a class="a-menu-lateral" data-toggle="collapse" href="#collapse-financeiro">
                                <i class="fas fa-hand-holding-usd icones-menu-lateral"></i>
                                Financeiro
                            </a>

                            <div id="collapse-financeiro" class="collapse">
                                <ul class="list-group">
                                    <li class="list-group-item">
                                        <a href="{{ route('admin.financeiro') }}" class="a-menu-lateral">
                                            <i class="far fa-credit-card"></i>
                                            Saldo
                                        </a>
                                    </li>
                                    <li class="list-group-item">
                                        <a href="{{ route('admin.financeiro.historico') }}" class="a-menu-lateral">
                                            <i class="fas fa-book"></i>
                                            Histórico Transações
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="li-menu-lateral">
                            <a class="a-menu-lateral" data-toggle="collapse" href="#collapse-usuario">
                                <i class="fas fa-users"></i>
                                Usuários
                            </a>
                            <div id="collapse-usuario" class="collapse">
                                <ul class="list-group">
                                    @if(Auth::user()->perfil_id == 1)
                                        <li class="list-group-item">
                                            <a href="" class="a-menu-lateral">
                                                <i class="fas fa-list-ul"></i>
                                                Lista de usuários
                                            </a>
                                        </li>
                                    @endif
                                    <li class="list-group-item">
                                        <a href="{{ route('admin.usuario.perfil') }}" class="a-menu-lateral">
                                            <i class="far fa-user"></i>
                                            Editar Perfil
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- CONTEUDO -->
                <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
                    @yield('content')
                </div>
            @endif
        </div>
    </div>

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/all.min.js') }}"></script>
</body>
</html>
