@extends('layouts.admin')
@section('title', 'Page d\'accueil')
@section('content')
    <div class="row">
        <div class="col-8">
            @foreach ($articles as $article)
                @if ($article->publish==1)
                    <div class="text-left shadow border border-secondary my-5">
                        <div class="d-flex flex-row mb-3">
                            @if ($article->author->photo)
                                <img src="{{asset($article->author->photo)}}" alt="img" width="50px" height="50px" class="rounded-circle m-2">
                                @else
                                    <img src="{{asset('avatar/avatar.png')}}" alt="img" width="50px" height="50px" class="rounded-circle m-2">
                            @endif   
                            <div>
                                <p>{{$article->author->name}}</p>
                                <p>{{$article->created_at->diffForHumans()}}</p>
                            </div>
                            
                        </div>
                        <hr>
                        <div>
                            <div>
                                <h5 class="text-center">{{$article->title}}</h5>
                                <p class="text-center">{{$article->content}}</p>
                            </div>
                            <div>
                                
                                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                    <div class="carousel-inner">
                                        @foreach ($article->images as $image)
                                            <div class="carousel-item active">
                                                <img src="{{asset('/articleImages/'.$image->image)}}" class="d-block w-100" alt="artiicle-image" width="90%" height="350px">
                                            </div>  
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                                    
                                
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-evenly">

                        {{-- LIKE ARTICLE --}}
                            <form action="{{route('articles.like')}}" id="form-js" class="d-inline-flex mx-2">
                                <div class="text-start m-2">
                                    <div id="count-js"> <strong>{{$article->likes->count()}}</strong> 
                                    </div>
                                </div>

                                <input type="hidden" name="article-id" value="{{$article->id}}" id="article-id-js">
                                <button type="submit" class="btn btn-outline-primary" id="liker">                            
                                    <i class="bi bi-hand-thumbs-up fs-2"></i>
                                    J'aime
                                </button>
                            </form>
                            

                            <a href="{{route('admin.show',['id'=>$article->id])}}" style="text-decoration: none" class="btn btn-outline-primary">                            
                                <i class="bi bi-chat fs-2"></i>
                                Commenter
                            </a>

                            <a href="{{route('contact',['id'=>$article->id])}}" style="text-decoration: none" class="btn btn-outline-primary">                            
                                <i class="bi bi-telephone fs-2"></i>
                                contacter
                            </a>
                            
                        </div>

                        <hr>
                        
                        
                    </div>
                @endif
                
            @endforeach
        </div>
        <div class="col">
            @if (session('demande'))
                <div class="alert alert-success">
                    {{session('demande')}}
                </div>
            @endif
            <div class="col demande text-center">
                <h4>Demandes de service</h4>
            </div>
            @foreach ($requests as $req)
                
                <div class="card mx-3" style="width: 18rem;">
                    <div class="card-body">
                        @if ($req->author->photo)
                            <img src="{{asset($req->author->photo)}}" alt="img"  class="card-img-top">
                            @else
                                <img src="{{asset('avatar/avatar.png')}}" alt="img"  class="card-img-top">
                        @endif   
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{$req->author->name}}</h5><hr>
                        <h6 class="card-title">{{$req->title}}</h6>
                        <p class="card-text">{{$req->content}}</p>
                        <a href="#" class="btn">Me contacter</a>
                    </div>
            @endforeach
            
        </div>
        <div class="container mx-5 mt-3">
            {{$requests->links()}}
        </div>
    </div>

    <style>
        .card {
            margin-top: 2em;
            padding: 1.5em 0.5em 0.5em;
            border-radius: 2em;
            text-align: center;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        .card img {
            width: 50%;
            height: 120px;
            border-radius: 50%;
            margin: 0 auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .card .card-title {
            font-weight: 700;
            font-size: 1.5em;
        }
        .card .btn{
            border-radius: 2em;
            background-color: rgb(0, 42, 255);
            color: #000000;
            padding: 0.5em 1.5em;
        }
        .card .btn:hover {
            background-color:#000000 ;
            color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
    </style>
    </div>
    
@endsection

