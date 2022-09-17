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
    <body style="background-color: black; color:white">
        
        <div class="text-left w-100 shadow position-fixed" style="background-color: rgb(13, 5, 100); color:white">
            
            @if (Route::has('login'))
                <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block home">
                    
                    @auth
                        <a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Accueil</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">s'identifier</a>

                        @if (Route::has('signin'))
                            <a href="{{ route('signin') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">s'inscrire</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
        
        <main class="text-center">
            <div class="row">
                <div class="col">
                    
                </div>
                <div class="col-10">
                    
                    {{-- <div id="root"></div> --}}
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
