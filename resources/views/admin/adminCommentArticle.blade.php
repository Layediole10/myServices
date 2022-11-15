@extends('layouts.admin')
@section('title', 'comment-article')
@section('content')

    <div class="row">
       <div class="text-left shadow col-8 mx-4 border border-secondary">
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
                    <div id="count-js">{{$article->likes->count()}} 
                    </div>
                </div>

                <input type="hidden" name="article-id" value="{{$article->id}}" id="article-id-js">
                <button type="submit" class="btn btn-outline-primary" style="text-decoration: none">                            
                    <i class="bi bi-hand-thumbs-up fs-2"></i>
                    J'aime
                </button>
            </form>

            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@commenter"><i class="bi bi-chat fs-2"></i> commenter</button>

            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#contacter" data-bs-whatever="@contacter"><i class="bi bi-telephone fs-2"></i> contacter</button>

            
        </div>
        <hr>
        <div class="container text-left w-75 my-2">
            <h5>Commentaires</h5>

            {{-- ----------------------modal---------------------- --}}

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

            {{-- popup comment article --}}
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Nouveau commentaire</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('comments.store',['id'=>$article->id])}}" method="post">
                            @csrf
                            <div class="form-group pb-1">
                                <input type="hidden" class="form-control" name="article_id" placeholder="last name" value={{$article->id}}>
                            </div>
                        <div class="mb-3">
                          <label for="message-text" class="col-form-label">Commentaire:</label>
                          <textarea class="form-control" id="message-text" name="content"></textarea>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </div>
                      </form>
                    </div>
                    
                  </div>
                </div>
              </div>

              {{-- --------------------end modal---------------------- --}}

            <div class="container m-3 text-dark">
                @foreach ($comments as $comment)
                    <div class="mb-5 bg-white p-3 rounded-sm text-left w-75 shadow">
                        <div class="flex">
                            
                            <div class="mx-3 flex ">
                                
                                <div class="d-flex flex-row mb-3">
                                    @if ($comment)
                                        <img src="{{$comment->author->photo}}" alt="{{$comment->name}}" width="40px" height="40px"  class="rounded-circle mx-1">
                                        
                                        @else
                                            <img src="{{asset('avatar/avatar.png')}}" alt="{{$comment->name}}" width="40px" height="40px" class="rounded-circle mx-1">
                                        
                                    @endif   
                                    <div  class="mt-3">
                                        <strong>{{$comment->name}}</strong>
                                    </div>
                                    
                                </div>
                            </div>
                           

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

        <div class="col">
        </div> 
    
    </div>
    
    <div class="text-center m-3">
        @if (Auth::user()->role=="user")
            <a href="{{url('/home')}}" class="btn btn-primary">Retour</a>
            @else @if (Auth::user()->role=="professional")
                <a href="{{url('/professional')}}" class="btn btn-primary">Retour</a>
            @endif
                <a href="{{url('/admin')}}" class="btn btn-primary">Retour</a>
        @endif
        
    </div>
@endsection