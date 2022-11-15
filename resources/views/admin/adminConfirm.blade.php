@extends('layouts.admin')
@section('title','confirmation')
@section('content')
    <div class="container">
        <h2 align="center">Article créé avec succès!</h2>
        <img src="{{asset('imgConfirm/adminConfirm.webp')}}" alt="confirmation" width="50%" height="350px" class="confirmation">
    </div>

    <style>
        /* body{
            background : linear-gradient( 135deg, #adcfaa 0%, #51a25f 40%, #7ed652 100% );
        } */
        .confirmation{
            margin-left: 250px;
            padding-top: 20px;
        }
    </style>
@endsection