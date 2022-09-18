@extends('layouts.professional')
@section('content')
    <div align="center" class="col mt-5">
        <div class="text-center col-4 bg-primary">
            <h4>Contacter {{$demande->author->name}}</h4>
            
        </div>
            <div class="card m-2 col-4 text-black">
                <div class="card-body">
                    <h5>{{$demande->title}}</h5>
                    <p>{{$demande->content}}</p>
                
                    <h6>Budget:{{$demande->budget}}</h6>
                    <p>Je serai disponible du <em>{{$demande->date_start}}</em> au <em>{{$demande->date_end}}</em>.</p>
                </div>
            </div>
            <div class="card m-2 col-4">
                <div class="card-body">
                    <a href="tel:{{$demande->author->contact}}">
                        <i class="bi bi-telephone fs-2"></i>
                        Appeler
                    </a>
                </div>
                <div class="card-body">
                    <a href="mailto:{{$demande->author->email}}">
                        <i class="bi bi-envelope fs-2"></i>
                        Envoyer email
                    </a>
                </div>
            </div>
        
    </div>
@endsection