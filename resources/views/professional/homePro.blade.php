@extends('layouts.professional')
@section('title', 'Page d\'accueil')
@section('content')
    @foreach ($articles as $article)
        <div class="text-left w-100 m-5 shadow">
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

                {{-- liker un commentaire --}}
                <form action="{{route('articles.like')}}" id="form-js" class="d-inline-flex mx-2">
                    <div class="text-start m-2">
                        <div id="count-js">{{$article->likes->count()}} <strong>personne(s) ont r??agi(s)</strong> 
                        </div>
                    </div>

                    <input type="hidden" name="article-id" value="{{$article->id}}" id="article-id-js">
                    <button type="submit" style="border-style: none">                            
                        <i class="bi bi-hand-thumbs-up fs-2"></i>
                        J'aime
                    </button>
                </form>
                

                <a href="{{route('show',['id'=>$article->id])}}" style="border-style: none">                            
                    <i class="bi bi-chat fs-2"></i>
                    Commenter
                </a>

                <a href="#" style="border-style: none">                            
                    <i class="bi bi-telephone fs-2"></i>
                    contacter
                </a>
                
            </div>
            <hr>
            
            
        </div>
        
    @endforeach
    
@endsection