@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">
      <h1>Hi {{ Auth::user()->first_name }}</h1>
        <div class="card">
          <div class="card-header text-left">{{ __('Profile') }}</div>

          <div class="card-body">
            <!-- <form method="POST" action=""> -->
            <form>
              @csrf

              <div class="row mb-3">
                <!-- First name field -->
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <label for="first_name" class="input-group-text">{{ __('First Name') }}</label>

                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" aria-label="Type or edit your first name" value="{{ auth()->user()->first_name }}" required autocomplete="first_name" autofocus>

                    @error('first_name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <!-- Last name field -->
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <label for="last_name" class="input-group-text">{{ __('Last Name') }}</label>

                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" aria-label="Type or edit your last name" value="{{ auth()->user()->last_name }}" required autocomplete="last_name" autofocus>

                    @error('last_name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>

              <hr>

               
              
              <div class="col-sm-6">
              <!-- Job title field -->
              <!-- *TO DO -->

              <!-- Phone number field -->


              <!-- Address field -->


              <!-- Email field -->
              <div class="row mb-3">
                <div class="input-group mb-3">
                  <label for="email" class="input-group-text">{{ __('Email Address') }}</label>

                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" aria-label="Type or edit your last name" value="{{ old('email') }}" required autocomplete="email">

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <!-- Emergency contact information -->


              </div>
             

            
                  
          <div class="row mb-0">
                <div class="col-md-10 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Save') }}
                  </button>
                </div>
              </div>
            </form>
        </div>
    </div>
  </div>
</div>


@endsection