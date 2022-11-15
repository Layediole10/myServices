@extends('layouts.admin')

@section('content')

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<form method="POST" action="{{ route('admin.update', ['admin'=>$user->id]) }}" enctype="multipart/form-data" class="form-horizontal" role="form">
@csrf   
<div class="container-xl px-4 mt-4">

<div class="row">
    <div class="col-xl-4">
        <!-- Profile picture card-->
        <div class="card mb-4 mb-xl-0">
            <div class="card-header">Image du Profil</div>
            <div class="card-body text-center">
                
                    <div class="text-center">
                    <img src="{{$user->photo}}" class="avatar img-circle" alt="avatar">
                    <h6>Modifier l'image</h6>
                    
                    <input type="file" class="form-control" name="photo">
                    </div>
                
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <!-- Account details card-->
        <div class="card mb-4">
            <div class="card-header">Détails du compte</div>
            <div class="card-body">
                
                    <!-- Form Group (username)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputUsername">Prénom & Nom</label>
                        <input class="form-control" id="inputUsername" type="text" placeholder="Enter your username" value="{{$user->name}}" name="name">
                    </div>
                    
                    <!-- Form Group (email address)-->
                    <div class="mb-3">
                        <label class="small mb-1" for="inputEmailAddress">Email address</label>
                        <input class="form-control" id="inputEmailAddress" type="email" value="{{$user->email}}" name="email">
                    </div>

                    <div class="mb-3">
                        <label class="small mb-1" for="inputPhone">Numéro de téléphone</label>
                        <input class="form-control" id="inputPhone" type="tel" value="{{$user->contact}}" name="contact">
                    </div>
                    
                    <!-- Save changes button-->
                    <button class="btn btn-primary" type="submit">Modifier</button>
                
            </div>
        </div>
    </div>
</div>
</div>
</form>

<style>
body { 
        margin-top:20px;
        background: url('https://bootdey.com/img/Content/bg1.jpg') no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        color: #000;
    }
.avatar{
border-radius: 50%;
width:200px;
height:200px;
}	
</style>

@endsection