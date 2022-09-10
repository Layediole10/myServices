@extends('layouts.app')
@section('title', 'demande')
@section('content')

    <h3 class="text-center">Choix de la catégorie</h3>
    <div class="d-flex align-content-stretch flex-wrap">
        @foreach ($categories as $category)
            <div class="card m-2 p-4">
                <a href="{{route('categories.show',['category'=>$category->id])}}">{{$category->title}}</a>
            </div>
        @endforeach
    </div>
@endsection