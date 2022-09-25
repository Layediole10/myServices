@extends('layouts.app')
@section('title', "s'inscrire")
@section('content')
    <div class="d-flex justify-content-evenly p-5">
        
        <div class="container" style="margin-left: -40px">
            <div class="row justify-content-center">
              
                <div class="col-12 col-lg-4">
                    <a href="{{route('register')}}" style="text-decoration: none">
                        <div class="card box-shadow mx-auto my-5" style="width: 18rem;">
                            <img src="{{asset('avatar/avatar.png')}}" alt="avatar" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Je suis demandeur de services</h5>
                                <hr>
                                <p class="card-text"></p>
                            </div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,192L48,197.3C96,203,192,213,288,192C384,171,480,117,576,90.7C672,64,768,64,864,85.3C960,107,1056,149,1152,186.7C1248,224,1344,256,1392,272L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                
                        </div>
                    </a>
                    
                </div>

                <div class="col-12 col-lg-4">
                    <a href="{{route('professional.create')}}" style="text-decoration: none">
                        <div class="card box-shadow mx-auto my-5" style="width: 18rem;">
                            <img src="{{asset('avatar/avatar.png')}}" alt="avatar" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">J'offre des services</h5>
                                <hr>
                                <p class="card-text"></p>
                            </div>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="#ffffff" fill-opacity="1" d="M0,192L48,197.3C96,203,192,213,288,192C384,171,480,117,576,90.7C672,64,768,64,864,85.3C960,107,1056,149,1152,186.7C1248,224,1344,256,1392,272L1440,288L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>
                                
                        </div>
                    </a>
                    
                </div>
              
            </div>
        </div>
        
        
    </div>

    <style>
        
body
{
	color:#868686;
    overflow:scroll;

    background-image: url('avatar/nature.jpg');
    background-size: 100% 100%;

} 

a
{
	cursor:pointer;
}

p
{
	padding-bottom:1rem;
}

h5
{
	font-weight:bold;
	color:#2b2b2b;
}

.box-shadow
{
	-webkit-box-shadow: 0 1px 1px rgba(72,78,85,.6);
	box-shadow: 0 1px 1px rgba(72,78,85,.6);
	-webkit-transition: all .2s ease-out;
	-moz-transition: all .2s ease-out;
	-ms-transition: all .2s ease-out;
	-o-transition: all .2s ease-out;
	transition: all .2s ease-out;
}

.box-shadow:hover
{
	-webkit-box-shadow: 0 20px 40px rgba(72,78,85,.6);
	box-shadow: 0 20px 40px rgba(192, 169, 41, 0.6);
	-webkit-transform: translateY(-15px);
	-moz-transform: translateY(-15px);
	-ms-transform: translateY(-15px);
	-o-transform: translateY(-15px);
	transform: translateY(-15px);
}

.card
{
	border-radius: 25px;
	
}

.card img
{
	border-top-left-radius: 25px;
	border-top-right-radius: 25px;
}

.card svg
{
	position:absolute;
	top:19rem;
  -webkit-transition: all .2s ease-out;
	-moz-transition: all .2s ease-out;
	-ms-transition: all .2s ease-out;
	-o-transition: all .2s ease-out;
	transition: all .2s ease-out;
	filter:drop-shadow(2px -9px 4px rgba(0, 69, 134, 0.2));
}
.card:hover svg
{
	filter:drop-shadow(2px -9px 4px rgba(0, 69, 134, 0.4));
}

i
{
	position:absolute;
	top: 18rem;
	right: 2rem;
	color:white;
	font-size:3rem;
	background: rgb(238,174,202);
	background: linear-gradient(133deg, rgba(255,255,255,1) 0%, rgba(211,210,231,1) 19%, rgba(11,39,73,1) 100%);
	padding: 1rem;
	border-radius: 100%;
	transition: all .6s ease-in-out;
}

.card:hover i
{
	transform: rotate(-180deg);
}

i:hover
{
	box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.7) 0px 18px 36px -18px inset;
}
    </style>
    
@endsection