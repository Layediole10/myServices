@extends('layouts.professional')
@section('title', 'Page d\'accueil')
@section('content')
    <div class="row">
        <div class="col-8 mx-4">
            @foreach ($articles as $article)
                @if ($article->publish==1)
                    <div class="text-left w-100 m-5 shadow border border-secondary">
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
                                <h5>{{$article->title}}</h5>
                                <p>{{$article->content}}</p>
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
                                    <div id="count-js"> <strong class="like-article">{{$article->likes->count()}}</strong> 
                                    </div>
                                </div>

                                <input type="hidden" name="article-id" value="{{$article->id}}" id="article-id-js">
                                <button type="submit" id="liker" class="btn btn-outline-primary">                            
                                    <i class="bi bi-hand-thumbs-up fs-2"></i>
                                    J'aime
                                </button>
                            </form>
                            

                            <a href="{{route('show',['id'=>$article->id])}}" class="btn btn-outline-primary" style="text-decoration: none">                            
                                <i class="bi bi-chat fs-2"></i>
                                Commenter
                            </a>

                            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#contacter" data-bs-whatever="@contacter">
                                <i class="bi bi-telephone fs-2"></i> contacter
                            </button>
                            
                            
                        </div>
                        <hr>

                        {{-- popup contact professional --}}
                        <div class="modal fade" id="contacter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header bg-primary">
                                    <div class="modal-title" id="exampleModalLabel">
                                        <h4>Contacter {{$article->author->name}}</h4>
                                    </div>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                
                                        <div class="card m-2">
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
                                
                                </div>
                            </div>
                        </div>
                        {{-- ----------------------------end popup------------------------------- --}}
                        
                        
                    </div>
                @endif
                
            @endforeach
        </div>
        <div align="center" class="col w-25 mt-3 text-black" id="demande">
            @if (session('demande'))
                <div class="alert alert-success">
                    {{session('demande')}}
                </div>
            @endif
            <div class="col demande">
                <h4>Demandes de service</h4>
            </div>
            <div class="container mx-5 mt-2">
                {{$requests->links()}}
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
                        <a href="{{route('demande.contacter',['id'=>$req->id])}}" class="btn">Me contacter</a>
                    </div>
            @endforeach
            
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
            background-color: teal;
            color: #000000;
            padding: 0.5em 1.5em;
        }
        .card .btn:hover {
            background-color: rgba(43, 7, 164, 0.7);
            color: #000000;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* ------------------------------------------ */
        body{
    margin-top:20px;
    background:#eee;
}

.like-article{
    margin-left: -20px;
    
}


    </style>
    </div>

    <script type="text/javascript">
        $("document").ready(function(){
            setTimeout(() => {
                $("#demande").remove();
            }, 3000);
        })
    </script>
    
@endsection


