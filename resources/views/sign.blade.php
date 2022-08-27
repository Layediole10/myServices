@extends('layouts.app')
@section('title', "s'inscrire")
@section('content')
    <div class="d-flex justify-content-evenly p-5">
        <div>
            <div class="card">
                <a href="{{route('register')}}">
                    <img src="{{asset('avatar/avatar.png')}}" alt="avatar" width="200px">
                </a>
            </div>
            <p>Je suis demandeur de services</p>
        </div>
        
        <div>
            <div class="card">
                <a href="{{route('professional.create')}}">
                    <img src="{{asset('avatar/avatar.png')}}" alt="avatar" width="200px">
                </a>
            </div>
            <p>J'offre des services</p>
        </div>
    </div>
    
@endsection