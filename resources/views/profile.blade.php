@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8 text-center">
      <h2>Hi {{ Auth::user()->first_name }}</h2>
        <div class="card">
          <div class="card-header text-left">{{ __('Profile') }}</div>

          <div class="card-body">
            <!-- <form method="POST" action=""> -->
            <form>
              @csrf

              <div class="row">
                <!-- First name field -->
                <div class="col">
                  <div class="input-group">
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
                <div class="col">
                  <div class="input-group">
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
                    
               <!-- Image field To Do add Modal when Update button pressed -->
              
                <div class="row">
                  
                    <div class="col pl-5">
                      
                        <div class="row my-2 pl-4">
                          <label for="profile_image" class="my-2 h5">My Image</label>
                        </div>
                        <form enctype="multipart/form-data" action="" method="POST"> 
                      @csrf
                        <div class="row">
                          <img src="" class="rounded-circle" style="width:150px; height:150px;"> 
                        </div>
                      
                        <!-- Make pop up to upload image <input type="file" name="image_url"> -->
                        
                        <div class="row my-4">
                          <!-- TO DO:
                          *set Delete and Upload functions to the profile image -->
                          <input class="btn btn-primary mr-2" type="submit" value="Delete">  
                          <input class="btn btn-primary" type="submit" value="Update">        
                        </div>
                                       
                      </form>
                    </div> 
                  
                  
                  <div class="col-md-8">
                    <!-- <div class="card"> -->
                      <div class="card-body">
                        <!-- Job title field readonly -->
                        <!-- TO DO: grab job title from user -->
                        <div class="row mb-2">
                          <div class="input-group">
                            <label for="job_title" class="input-group-text">{{ __('Job Title') }}</label>

                            <input id="staticJobTitle" type="job_title" readonly class="form-control-plaintext p-2 border" name="staticJobTitle" aria-label="Inactive job title row" value="">

                          </div>
                        </div>

                        <!-- Phone number field -->
                        <!-- TO DO: 
                        * grab phone # from user 
                        * check if phone number is in correct format-->
                        <div class="row mb-2">
                          <div class="input-group">
                            <label for="phone_number" class="input-group-text">{{ __('Phone Number') }}</label>

                            <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" aria-label="Edit your phone number" value="" required autocomplete="phone_number" autofocus>

                            @error('phone_number')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>

                        <!-- Address field -->
                        <!-- TO DO: 
                        * grab phone # from user 
                        * check if phone number is in correct format-->
                        <div class="row mb-2">
                          <div class="input-group">
                            <label for="address" class="input-group-text">{{ __('Address') }}</label>

                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" aria-label="Edit your address" value="" required autocomplete="address" autofocus>

                            @error('address')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>

                        <!-- Email field readonly -->
                        <div class="row mb-2">
                          <div class="input-group">
                            <label for="email" class="input-group-text">{{ __('Email Address') }}</label>

                            <input id="staticEmail" type="email" readonly class="form-control-plaintext p-2 border" name="email" aria-label="Inactive email row" value="{{ auth()->user()->email }}">

                          </div>
                        </div>
                      </div>

                    <!-- Emergency contact information -->
                    <div class="card">
                      <div class="card-header text-left text-white" style="background-color:#5fc7cc;">
                        <label class="h5">Emergency Contact</label>
                      </div>
                      <div class="card-body">Emergency Conta</div>
                    </div>
                  </div>
      
                  <!-- <div class="row mb-0">
                    <div class="col-md-10 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                          {{ __('Save') }}
                      </button>
                    </div>
                  </div> -->
                  
                </div>
              </div>
            </form>
          </div>
        </div>
    </div>
  </div>
</div>


@endsection