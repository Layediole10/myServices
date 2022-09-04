@extends('layouts.professional')
@section('title', 'comment-article')
@section('content')
    <div class="text-left w-100 m-5 shadow p-2">
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
                                <img src="{{asset('/articleImages/'.$image->image)}}" class="d-block w-100" alt="artiicle-image" width="80%" height="350px">
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

            {{-- liker un commentaire --}}
            <form action="{{route('articles.like')}}" id="form-js" class="d-inline-flex mx-2">
                <div class="text-start m-2">
                    <div id="count-js">{{$article->likes->count()}} <strong>personne(s) ont réagi(s)</strong> 
                    </div>
                </div>

                <input type="hidden" name="article-id" value="{{$article->id}}" id="article-id-js">
                <button type="submit" style="border-style: none">                            
                    <i class="bi bi-hand-thumbs-up fs-2"></i>
                    J'aime
                </button>
            </form>
            

            <a href="#" style="border-style: none">                            
                <i class="bi bi-chat fs-2"></i>
                Commenter
            </a>

            <a href="#" style="border-style: none">                            
                <i class="bi bi-telephone fs-2"></i>
                contacter
            </a>
            
        </div>
        <hr>
        <div class="container text-left w-50 my-2">
            <h5>Commentaires</h5>

            <form action="{{route('comments.store',['id'=>$article->id])}}" method="post">
                @csrf
                <div class="row my-2 p-2">
                    <div class="col">
                        <div class="form-group pb-1">
                            <input type="hidden" class="form-control" name="name" placeholder="Nom et Prénom" value="{{Auth::user()->name}}">
                        </div>
            
                        <div class="form-group pb-1">
                            <input type="hidden" class="form-control" name="email" placeholder="email" value="{{Auth::user()->email}}">
                        </div>
                    </div>
                </div>

                <div class="row my-2">
                    <div class="form-floating">
                        <textarea class="form-control" name="content" placeholder="Leave a comment here"></textarea>                            
                    </div>
                    <div class="form-group pb-1">
                        <input type="hidden" class="form-control" name="article_id" placeholder="last name" value={{$article->id}}>
                    </div>
                </div>

                <button class="btn btn-md btn-primary"> <i class="bi bi-plus-circle my-2"></i> Save</button>
            </form>

            <div class="container m-3 ">
                @foreach ($comments as $comment)
                    <div class="mb-5 bg-white p-3 rounded-sm text-left w-75 shadow">
                        <div class="flex">
                            {{-- Avatar --}}
                            <div class="mr-3 flex flex-col justify-center">
                                
                                <div class="d-flex flex-row mb-3">
                                    @if ($article->author->photo)
                                        <img src="{{asset($article->author->photo)}}" alt="img" width="50px" height="50px" class="rounded-circle m-2">
                                        @else
                                            <img src="{{asset('avatar/avatar.png')}}" alt="img" width="50px" height="50px" class="rounded-circle m-2">
                                    @endif   
                                    <div  class="mt-3">
                                        <strong>{{$article->author->name}}</strong>
                                    </div>
                                    
                                </div>
                            </div>
                            {{-- Avatar --}}

                        </div>

                        <div class="mt-2">
                            <p>{{ $comment->content }}</p>
                        </div> 
                        <div class="text-end">
                                
                            <small class="text-gray-600"><i>{{ $comment->created_at}}</i></small>
                        </div>
                    </div>    
                        
                @endforeach
            </div>
            
        </div>

    </div>
    <div>
        <a href="{{url('/professional')}}" class="btn btn-primary">Retour</a>
    </div>
@endsection