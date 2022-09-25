<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/create.css')}}">
    {{-- Icones --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <title>@yield('title')</title>

    <!-- Scripts -->
    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
      <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="javascript:void(0)">EliteVision</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
            @auth
                <form class="d-flex" style="margin-left: 400px">
                    @csrf
                    <input class="form-control me-2" type="text" placeholder="Search">
                    <button class="btn btn-primary" type="button">Search</button>
                </form>
            @endauth
          <div class="collapse navbar-collapse" id="mynavbar">
            
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
                        
                    <li class="nav-item pt-2">
                        <a class="nav-link" href="{{url('/admin')}}">{{ __("Home") }}</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            @if (Auth::user()->photo == null)
                                <img src="{{asset('avatar/avatar.png')}}" alt="{{Auth::user()->name}}" width="40px" height="40px" class="rounded-circle">
                            @else
                                <img src="{{Auth::user()->photo}}" alt="{{Auth::user()->name}}" width="40px" height="40px"  class="rounded-circle">
                            @endif
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
        <x-navbar/>
        {{-- <main class=" container-fluid">
            <div class="row">
                <x-sidebar/> 
                <div class="col">
                    @yield('content')
                </div>
            
                 
            </div>
        </main> --}}
    </div>
    <main class="text-center mx-5">
        <div class="row">
            
            <div class="col">
                    @if (session('compteUpdate'))
                        <div class="alert alert-success">
                            {{session('compteUpdate')}}
                        </div>
                    @endif

                @auth
                    @if (Auth::user()->photo == null)
                    <img src="{{asset('avatar/avatar.png')}}" alt="{{Auth::user()->name}}" width="90px" height="110px" class="rounded-circle py-3">
                    @else
                        <img src="{{Auth::user()->photo}}" alt="{{Auth::user()->name}}" width="80px" height="100px"  class="rounded-circle py-3">
                    @endif
                        <h6>{{Auth::user()->name}}</h6>
                        
                        <div>
                            <a href="{{route('admin.edit',['admin'=>Auth::user()->id])}}">Gérer mon compte</a>
                        </div>
                @endauth
                <x-sidebar/>
            </div>
            
            <div class="col-10">
               @yield('content') 
              
            </div>

        </div>  
    </main>
    

    <script src="{{asset('js/likeArticle.js')}}"></script>
</body>
</html>