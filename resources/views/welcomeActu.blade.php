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
                    {{-- --------------------like immages----------------------- --}}
                    <div class="timeline">
                        <div class="widget-footer d-flex align-items-center">
                            <div class="col-xl-8 col-md-8 col-7 no-padding d-flex justify-content-start">
                                <div class="users-like">
                                    <a href="#">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="img-fluid rounded-circle" alt="...">
                                    </a>
                                    <a href="#">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar2.png" class="img-fluid rounded-circle" alt="...">
                                    </a>
                                    <a href="#">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="img-fluid rounded-circle" alt="...">
                                    </a>
                                    <a href="#">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar4.png" class="img-fluid rounded-circle" alt="...">
                                    </a>
                                    <a href="#">
                                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-fluid rounded-circle" alt="...">
                                    </a>
                                </div>
                            </div>
                            <div class="col-xl-4 col-md-4 col-5 no-padding d-flex justify-content-end">
                                <div class="meta">
                                    <ul>
                                        <li><a href="#"><i class="la la-comment"></i><span class="numb">12</span></a></li>
                                        <li><a href="#"><i class="la la-heart"></i><span class="numb">30</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- ---------------------end like images----------------------- --}}

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
        
        <div align="center" class="col position-fixed w-25 mt-5 top-25 end-0 text-black">
            @if (session('demande'))
                <div class="alert alert-success">
                    {{session('demande')}}
                </div>
            @endif
            <div class="col mt-5 demande">
                <h4>Les demandes</h4>
            </div>
            <div class="container mx-5 mt-3">
                {{$requests->links()}}
            </div>
            @foreach ($requests as $req)
                
                <div class="card" style="width: 18rem;">
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
                        <a href="{{url('/login')}}" class="btn">Me contacter</a>
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
        .card .btn, .demande{
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

.timeline {
    width: 100%;
    position: relative;
    padding: 1px 0;
    list-style: none;
    font-weight: 500
}


.timeline .widget-body {
    padding: 1rem 1.4rem
}

.timeline .widget-footer {
    border-top: 1px solid #eee;
    margin: 0 1.4rem;
    padding: 1.07rem 0
}

.timeline .users-like {
    padding: 0
}

.timeline .users-like a {
    margin: 0 -1.6rem 0 0;
    transition: all 0.4s ease
}

.timeline .users-like a:hover {
    margin-right: -.3rem
}

.timeline .users-like img {
    width: 40px;
    border: .25rem solid #fff
}

.timeline .users-like a.view-more {
    background: #5d5386;
    color: #fff;
    width: 40px;
    height: 40px;
    border: .25rem solid #fff;
    border-radius: 50%;
    vertical-align: middle;
    font-size: .85rem;
    text-align: center;
    line-height: 30px;
    margin-right: 0
}

.timeline .widget-footer .meta li {
    display: inline-block;
    margin-right: .5rem
}

.timeline .widget-footer .meta li:last-child {
    margin-right: 0
}

.timeline .widget-footer .meta li a {
    color: rgba(52, 40, 104, .3)
}

.timeline .widget-footer .meta li a:hover {
    color: rgba(52, 40, 104, .9)
}

.timeline .widget-footer .meta li i {
    font-size: 1.8rem;
    vertical-align: middle;
    margin-right: .3rem
}

.timeline .widget-footer .meta li .numb {
    vertical-align: middle
}
        
    </style>
    </div>

@endsection

