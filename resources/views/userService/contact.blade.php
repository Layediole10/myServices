@extends('layouts.app')
@section('content')
    <div align="center" class="col mt-5">
        <div class="text-center col-4 bg-primary">
            <h4>Contacter {{$article->author->name}}</h4>
        </div>
       
            <div class="card m-2 col-4">
                <div class="card-body">
                    <a href="tel:{{$article->author->contact}}">
                        <i class="bi bi-telephone fs-2"></i>
                        Appeler
                    </a>
                </div>
                <div class="card-body">
                    <a href="mailto:{{$article->author->email}}">
                        <i class="bi bi-envelope fs-2"></i>
                        Envoyer email
                    </a>
                </div>
            </div>
        
    </div>
@endsection