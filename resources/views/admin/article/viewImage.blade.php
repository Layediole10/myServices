@extends('layouts.admin')
@section('title', 'images de l\'article')
@section('content')
  <h2>Images de l'article : <span class="text-primary">{{$article->title}}</span> </h2>
  <a href="{{route('articles.index')}}" class="btn btn-primary">Go Back</a>
  <div class="row mt-4">
    @foreach ($images as $image)
        <div class="col-md-3">
          <div class="card text-white mb-3" style="max-width: 20rem;">
            <div class="card-body">
              <img src="/articleImages/{{$image->image}}" class="card-img-top">
            </div>
          </div>
        </div>
    @endforeach
  </div>
@endsection