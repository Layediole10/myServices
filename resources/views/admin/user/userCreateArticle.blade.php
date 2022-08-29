@extends('layouts.professional')
@section('title','creer une annonce')
@section('content')
    <div class="container p-4">
                    
        <form action="{{route('articlepro.store')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="card">
                <div class="card-body">
                    <h5 class="card-header">Votre annonce</h5>
                    <div class="card mb-3">
                        <label for="category">Catégories</label>
                        <select class="custom-select" name="category" id="category">
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->title}}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="card mb-3">
                        <label for="title">Titre</label>
                        <input type="text" name="title" id="title" class="@error('title') is-invalid @enderror">

                        @error('title')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="card mb-3">
                        <label for="texte">Texte</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="texte" name="content" rows="3" required></textarea>

                        @error('content')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="card mb-3">
                        <label for="images">Téléchargez vos images</label>
                        <input type="file" name="images[]" multiple id="images">
                    </div>
                </div>

                <h5 class="card-header">Votre localisation</h5>
                <div class="card-body">
                    <div class="card mb-3">
                        <label for="region">Région</label>
                        <select class="custom-select" name="region" id="region">
                            @foreach ($regions as $region)
                            <option value="{{$region->id}}">{{$region->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="card mb-3">
                        <label for="department">Département</label>
                        <select class="custom-select" name="department" id="department">
                            @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="card mb-3">
                        <label for="municipality">Commune</label>
                        <select class="custom-select" name="municipality" id="municipality">
                            @foreach ($municipalities as $municipality)
                            <option value="{{$municipality->id}}">{{$municipality->name}}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <div class="card mb-3">
                        <label for="district">Quartier</label>
                        <select class="custom-select" name="district" id="district">
                            @foreach ($districts as $district)
                            <option value="{{$district->id}}">{{$district->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <h5 class="card-header">Votre occupation</h5>
                <div class="card-body"> 

                    <div class="card mb-3">
                        <label for="occupation">Profession</label>
                        <input type="text" name="occupation" id="occupation" class="@error('occupation') is-invalid @enderror">

                        @error('occupation')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
                    </div>

                    <div class="card mb-3">
                        <label for="contac">Contact</label>
                        <input type="text" name="contact" id="contact" value="{{Auth::user()->contact}}" class="@error('contact') is-invalid @enderror">

                        @error('contact')
                            <div class="alert alert-danger">
                                {{$message}}
                            </div>
                        @enderror
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
@endsection