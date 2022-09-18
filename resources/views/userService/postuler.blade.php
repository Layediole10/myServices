@extends('layouts.app')
@section('content')
    <div align="center" class="col mt-5">
        <div class="text-center col-4 bg-danger">
            <h4>Attention!</h4>
            
        </div>
        <div class="card m-2 col-4 text-black">
            <div class="card-body">
            <p>
                <strong>{{Auth::user()->name}}</strong> votre status ne vous permet de postuler à ce poste.
            </p>
            <p>Nous vous invitons à créer un compte professionnel, si vous êtes vraiment interessé.</p>
            <p>Merci!</p>
            </div>
        </div>
    </div>
    
@endsection