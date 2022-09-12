@extends('layouts.app')
@section('title', 'demande')
@section('request')

    @if (session('demande'))
        <div class="alert alert-success">
            {{session('demande')}}
        </div>
    @endif
    @foreach ($articles as $req)
        <div class="card m-2">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">{{$req->title}}</</h5>
                <p class="card-text">{{$req->content}}</</p>
                <a href="#" class="btn btn-primary">Postuler</a>
            </div>
        </div>
    @endforeach
@endsection
