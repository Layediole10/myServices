<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Icones --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body style="background-color: black; color:white">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __("S'identifier") }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('signin') }}">{{ __("S'inscrire") }}</a>
                                </li>
                            @endif
                        @else
                                
                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ __("Devis") }}</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">{{ __("Missions") }}</a>
                        </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Déconnexion') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="text-center mx-5">
            <div class="row">
                
                <div class="col">
                    @auth
                        @if (Auth::user()->photo == null)
                        <img src="{{asset('avatar/avatar.png')}}" alt="{{Auth::user()->name}}" width="90px" height="110px" class="rounded-circle py-3">
                        @else
                            <img src="{{Auth::user()->photo}}" alt="{{Auth::user()->name}}" width="80px" height="80px"  class="rounded-circle py-3">
                        @endif
                            <h6>{{Auth::user()->name}}</h6>
                            <div>
                                <a href="{{route('categories.index')}}">Mes demandes</a>
                            </div>
                            <div>
                                <a href="{{route('users.edit',['user'=>Auth::user()->id])}}">Gérer mon compte</a>
                            </div>
                    @endauth
                </div>
                
                <div class="col-10">
                   @yield('content') 
                  
                </div>
                
            </div>  
        </main>
    </div>



    <script src="{{asset('js/likeArticle.js')}}"></script>
</body>
</html>
