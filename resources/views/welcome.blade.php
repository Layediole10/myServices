<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        {{-- <link rel="stylesheet" href="{{asset('css/welcome.css')}}"> --}}

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

        {{-- Icones --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

        @viteReactRefresh
        @vite(['resources/js/app.js', 'resources/css/app.css'])
    </head>
    <body>
        
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <div class="container-fluid">
              <a class="navbar-brand" href="{{url("/")}}">EliteVision</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
              </button>
              
              <div class="collapse navbar-collapse" id="mynavbar">
                @if (Route::has('login'))
                <ul class="navbar-nav me-auto">
                    @auth
                      @if (Auth::user()->role=="user")
                        <li class="nav-item">
                          <a class="nav-link" href="{{ url('/home') }}">Accueil</a>
                        </li>
                        @else
                          @if (Auth::user()->role=="professional")
                            <li class="nav-item">
                              <a class="nav-link" href="{{ url('/professional') }}">Accueil</a>
                            </li>
                          @else
                          <li class="nav-item">
                            <a class="nav-link" href="{{ url('/admin') }}">Accueil</a>
                          </li>
                        @endif
                      @endif
                        
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">S'identifier</a>
                            </li>
                            @if (Route::has('signin'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('signin') }}">S'inscrire</a>
                                </li>
                            @endif
                    @endauth
                
                </ul>
                @endif
                <form class="d-flex" method="GET" action="{{route('recherche')}}">
                  @csrf
                  <input class="form-control me-2" type="text" placeholder="chercher" name="q" value="{{request()->q ?? ''}}">
                  <button class="btn btn-primary" type="submit">chercher</button>
                </form>
              </div>
            </div>
            
          </nav>
          <div class="imageSite">
            <img src="{{asset('avatar/siteModif.jpg')}}" alt="avatar" width="100%">
          </div>
        <main class="text-center">
            <div class="row">
                <div class="col">
                    
                </div>
                <div class="col-10">

                  @yield('content')
                </div>
                <div class="col">
                  
                </div>
            </div>  
        </main>

        

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
        <script src="{{asset('js/likeArticle.js')}}"></script>
    </body>
</html>
