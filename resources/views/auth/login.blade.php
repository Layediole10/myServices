@extends('layouts.app')

@section('content')
<div class="vh-75 gradient-custom">
    <div class="container py-5 h-75">
      <div class="row d-flex justify-content-center align-items-center h-75">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-dark text-white" style="border-radius: 1rem;margin-lleft:-40px">
            <div class="card-body text-center">
  
              <div class="mb-md-5 mt-md-4">
  
                <h2 class="fw-bold mb-2 text-uppercase">S'identifier</h2>
                <p class="text-white-50 mb-5">Entrer votre email et votre mot de passe svp!</p>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                <div class="form-outline form-white mb-4">
                  <input type="email" id="typeEmailX" class="form-control form-control-lg" name="email"/>
                  <label class="form-label" for="typeEmailX">Email</label>
                </div>
  
                <div class="form-outline form-white mb-4">
                  <input type="password" id="typePasswordX" class="form-control form-control-lg" name="password"/>
                  <label class="form-label" for="typePasswordX">Mot de passe</label>
                </div>

                @if (Route::has('password.request'))
                    <p class="small mb-5 pb-lg-2">
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié?') }}
                        </a>
                    </p>
                @endif
  
                <button class="btn btn-outline-light btn-lg px-5" type="submit">Se connecter</button>
                </form>
                <div class="d-flex justify-content-center text-center mt-4 pt-1">
                  <a href="#!" class="text-white"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
                  <a href="#!" class="text-white"><i class="fa fa-twitter fa-lg mx-4 px-2" aria-hidden="true"></i></a>
                  <a href="#!" class="text-white"><i class="fa fa-google fa-lg" aria-hidden="true"></i></a>
                </div>
  
              </div>  
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <style>
    body {

        background-image: url('avatar/nature.jpg');
        background-size: 100% 100%;
    }
  </style>
@endsection
