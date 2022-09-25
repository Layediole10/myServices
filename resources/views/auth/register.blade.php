@extends('layouts.app')

@section('content')
<!-- Section: Design Block -->
<div class="background-radial-gradient overflow-hidden">
    <style>
      body {
        background-color: hsl(218, 41%, 15%);
        background-image: radial-gradient(650px circle at 0% 0%,
            hsl(218, 41%, 35%) 15%,
            hsl(218, 41%, 30%) 35%,
            hsl(218, 41%, 20%) 75%,
            hsl(218, 41%, 19%) 80%,
            transparent 100%),
          radial-gradient(1250px circle at 100% 100%,
            hsl(218, 41%, 45%) 15%,
            hsl(218, 41%, 30%) 35%,
            hsl(218, 41%, 20%) 75%,
            hsl(218, 41%, 19%) 80%,
            transparent 100%);

      }
  
      #radius-shape-1 {
        height: 220px;
        width: 220px;
        top: -60px;
        left: -130px;
        background: radial-gradient(#44006b, #ad1fff);
        overflow: hidden;
      }
  
      #radius-shape-2 {
        border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
        bottom: -60px;
        right: -110px;
        width: 300px;
        height: 300px;
        background: radial-gradient(#44006b, #ad1fff);
        overflow: hidden;
      }
  
      .bg-glass {
        background-color: hsla(0, 0%, 100%, 0.9) !important;
        backdrop-filter: saturate(200%) blur(25px);
      }
      
    </style>
  
    <div class="container px-4  px-md-5 text-center text-lg-start ">
        <div class="col-lg-10 mb-lg-0 pb-5" style="z-index: 10">
            <h2 class="fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                Je m'inscris en tant que <span style="color: hsl(218, 81%, 75%)">demandeur de services</span>
            </h2>
        </div>
      <div class="row gx-lg-5 align-items-center mb-5">
        <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
          <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
            The best offer <br />
            <span style="color: hsl(218, 81%, 75%)">for your business</span>
          </h1>
          <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
            Lorem ipsum dolor, sit amet consectetur adipisicing elit.
            Temporibus, expedita iusto veniam atque, magni tempora mollitia
            dolorum consequatur nulla, neque debitis eos reprehenderit quasi
            ab ipsum nisi dolorem modi. Quos?
          </p>
        </div>
  
        <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
            
          <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
          <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>
  
          <div class="card bg-glass">
            <div class="card-body px-4 py-5 px-md-5">
              <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="row">
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example1" class="form-control @error('name') is-invalid @enderror" name="name"/>
                      <label class="form-label" for="form3Example1">Nom & Prénom</label>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                  <div class="col-md-6 mb-4">
                    <div class="form-outline">
                      <input type="text" id="form3Example2" class="form-control @error('contact') is-invalid @enderror" name="contact" placeholder="(+221)7XXXXXXX"/>
                      <label class="form-label" for="form3Example2">Contact</label>

                        @error('contact')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                  </div>
                </div>

                <!-- Role -->
                <div class="form-outline">
                    <input type="hidden" id="form3Example3" class="form-control @error('role') is-invalid @enderror" name="role" value="user"/>
                </div>
  
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="email" id="form3Example3" class="form-control @error('email') is-invalid @enderror" name="email"/>
                  <label class="form-label" for="form3Example3">Email address</label>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
  
                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" id="form3Example4" class="form-control @error('password') is-invalid @enderror" name="password"/>
                  <label class="form-label" for="form3Example4">Mot de passe</label>

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
  
                <!-- Password confirmation -->
                <div class="form-outline mb-4">
                    <input type="password" id="form3Example4" class="form-control" name="password_confirmation"/>
                    <label class="form-label" for="form3Example4">Confirmation Mot de passe</label>

                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
  
                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block mb-4">
                  S'inscrire
                </button>
  
                <!-- Register buttons -->
                <div class="text-center">
                  <p>ou connecter avec:</p>

                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <a href="#!" class="text-primary"><i class="fa fa-facebook fa-lg" aria-hidden="true"></i></a>
                  </button>
  
                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <a href="#!" class="text-primary"><i class="fa fa-twitter fa-lg mx-4 px-2" aria-hidden="true"></i></a>
                  </button>
  
                  <button type="button" class="btn btn-link btn-floating mx-1">
                    <a href="#!" class="text-primary"><i class="fa fa-google fa-lg" aria-hidden="true"></i></a>
                  </button>

                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Section: Design Block -->
@endsection
