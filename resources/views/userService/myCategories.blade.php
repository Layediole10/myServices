@extends('layouts.app')
@section('title', 'demande')
@section('content')

    @if (Auth::user())

        <h3 class="text-center mt-3 title">Choix de la catégorie</h3>
        <div class="d-flex align-content-stretch flex-wrap">
            @foreach ($categories as $category)
                <div class="card m-2 p-4">
                    <a href="{{route('categories.show',['category'=>$category->id])}}" class="category">{{$category->title}}</a>
                </div>
            @endforeach
        </div>
        
    @endif

    <style>

        .title{
            font-weight: bolder;
            text-transform: uppercase;
            color: #fff;
            text-decoration: underline;
            letter-spacing: 3px;
        }
        .category{
            text-decoration: none;
            font-size: 18px;
            font-weight: bolder;
            text-transform: uppercase;
        }

        .card{
            background-color: gainsboro;
            margin: 5px;
        }

        .card:hover{
            background-color: rgb(4, 4, 69);
            color:#fff;
            box-shadow: 2px 5px 5px rgb(238, 237, 230);
            scale: 1;
        }

        body{
            background-image: url('avatar/nature5.webp');
            background-color: #cccccc;
            height: 500px;
            /* background-position: center; */
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            color: #fff;
    
        }
    </style>

@endsection