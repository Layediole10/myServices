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
    <link rel="stylesheet" href="{{asset('css/professional.css')}}">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

    <!-- Scripts -->

    @viteReactRefresh
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    
    <div id="app">
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{url('/professional')}}">EliteVision</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
              </button>

              {{-- search bar --}}
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
                            <a class="nav-link" href="{{url('/professional')}}">{{ __("Home") }}</a>
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
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom text-black">
            <h1 class="h2 mx-4">Professional: <em>{{Auth::user()->name}}</em></h1>
            
            <div class="btn-toolbar mb-2 mb-md-0">
               
              <div class="btn-group me-2">
                <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <a href="{{route("articlepro.create")}}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-plus-circle"></i>
                  Create Article
              </a>
        
            </div>
        </div>
        <main class="text-center mx-5">
            <div class="row">
                <div class="col">
                    @if (session('compteUpdate'))
                        <div class="alert alert-success" id="alert">
                            {{session('compteUpdate')}}
                        </div>
                    @endif
                    {{-- @yield('profile') --}}
                    @if (Auth::user()->photo == null)
                        <img src="{{asset('avatar/avatar.png')}}" alt="{{Auth::user()->name}}" width="80px" height="80px" class="rounded-circle my-2">
                        @else
                            <img src="{{Auth::user()->photo}}" alt="{{Auth::user()->name}}" width="80px" height="80px"  class="rounded-circle my-2">
                    @endif
                    
                  <h5 class="text-black">{{Auth::user()->name}}</h5>
                  <h5>
                    <a href="{{url('/services-chat')}}">Mes discussions</a>
                  </h5>
                  <h5>
                    <a href="{{route('professional.edit',['professional'=>Auth::user()->id])}}">Gérer mon compte</a>
                  </h5>
                  
                </div>
                <div class="col-10">
                  @yield('content')
                </div>
            </div>  
        </main>
    </div>


    <script src="{{asset('js/likeArticle.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $("document").ready(function(){
            setTimeout(() => {
                $("#alert").remove();
            }, 3000);
        })
    </script>
</body>
</html>
