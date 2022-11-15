@extends('layouts.app')
@section('title', 'demande')
@section('content')


    <div class="col-8 m-4 text-black">
                    
        <form action="{{route('demandes.store')}}" method="post">
            @csrf

            <div class="card">
                <h5 class="card-header bg-primary">Demande de services</h5>
                <div class="card-body">

                    <div>
                        {{-- <label for="category">Catégorie</label> --}}
                        <input type="hidden" name="category" id="category" value="{{$category->id}}">
                    </div>

                    <div class="card mb-3">
                        <input type="hidden" name="author_id"  value="{{Auth::user()->id}}">
                    </div>
            
                    <div class="card mb-3">
                        <label for="title">Donner un titre à votre demande</label>
                        <input type="text" name="title" id="title" placeholder="Je cherche un jardinier">
                    </div>

                    <div class="card mb-3">
                        <label for="budget">Votre Budget</label>
                        <input type="text" name="budget" id="budget" placeholder="2500FCFA">
                    </div>
                    
                    <div class="card mb-3">
                        <label for="texte">Ajouter une description de la mission</label>
                        <textarea class="form-control" id="texte" name="content" rows="3" required placeholder="Je souhaite démanager un appartement..."></textarea>
                    </div>

                </div>

                <h5 class="card-header bg-primary">Ville De La Prestation</h5>
                <div class="card-body">
                    <div class="card mb-3">
                        <label for="municipality">Votre commune</label>
                        <input type="text" name="municipality" id="municipality" placeholder="Nguékokh">
                    </div>

                    <div class="card mb-3">
                        <label for="district">Votre quartier</label>
                        <input type="text" name="district" id="district" placeholder="Escale">
                    </div>
            
                </div>

                <h5 class="card-header bg-primary">Votre Disponibilité</h5>
                <div class="card-body"> 

                    <div class="card mb-3">
                        <label for="date_start">A partir du</label>
                        <input type="date" name="date_start" id="date_start">
                    </div>

                    <div class="card mb-3">
                        <label for="date_end">Jusqu'au</label>
                        <input type="date" name="date_end" id="date_end">
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" name="publish"  role="switch" id="publish">
                  <label class="form-check-label" for="publish">Published</label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Valider</button>   
        
        </form>

    </div>

    <style>
        body{
            background-image: url('avatar/nature4.jpg');
            background-color: #1f1b1b;
            height: 500px;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            color: #fff;
    
        }
    </style>
    
@endsection