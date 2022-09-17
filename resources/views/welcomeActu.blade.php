@extends('welcome')
@section('title', 'Page d\'accueil')
@section('content')
    <div class="row">
        <div class="col-8 mx-4 mt-5">
            @foreach ($articles as $article)
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
                        <a href="{{url('/login')}}">                            
                            <i class="bi bi-chat fs-2"></i>
                            Commenter
                        </a>

                        <a href="{{url('/login')}}">                            
                            <i class="bi bi-telephone fs-2"></i>
                            contacter
                        </a>
                        
                    </div>
                    <hr> 
                </div>
                
            @endforeach
        </div>
        <div class="demande col position-fixed w-25 mt-5 top-25 end-0">
            @if (session('demande'))
                <div class="alert alert-success">
                    {{session('demande')}}
                </div>
            @endif
            <div class="col bg-primary mt-5">
                <h4>Les demandes</h4>
            </div>
            @foreach ($requests as $req)
                <div class="card m-2" style="width: 100%; background-color:darkcyan">
                    <div class="d-flex flex-row mb-3">
                        @if ($req->author->photo)
                            <img src="{{asset($req->author->photo)}}" alt="img" width="50px" height="50px" class="rounded-circle m-2">
                            @else
                                <img src="{{asset('avatar/avatar.png')}}" alt="img" width="50px" height="50px" class="rounded-circle m-2">
                        @endif   
                        <div>
                            <p>{{$req->author->name}}</p>
                        </div>
                    </div><hr>
                    <div class="card-body">
                        <div>
                            <h5 class="card-title">{{$req->title}}</</h5>
                        </div>
                        <hr>
                        <p class="card-text">{{$req->content}}</</p><hr>
                        <a href="{{url('/login')}}" class="btn btn-primary">Postuler</a>
                    </div>
                </div>
            @endforeach
            <div class="text-center mx-5">
                {{$requests->links()}}
            </div>
        </div>
    </div>
    
@endsection

