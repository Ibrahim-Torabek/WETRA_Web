@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <!-- <div class="col-md-8"> -->
      <!-- <h2>Hi {{ Auth::user()->first_name }}</h2> -->
        <div class="card">
          <div class="card-header text-left h5">{{ __('My Profile') }}</div>

          <div class="card-body">
            <!-- <form method="POST" action=""> -->
            <form>
              @csrf
              <div class="row">
                <!-- First name field -->
                <div class="col">
                  <div class="input-group">
                    <label for="first_name" class="input-group-text">{{ __('First Name') }}</label>

                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" aria-label="Edit your first name" value="{{ auth()->user()->first_name }}" required autocomplete="first_name" autofocus>

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

                    <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" aria-label="Edit your last name" value="{{ auth()->user()->last_name }}" required autocomplete="last_name" autofocus>

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
                <div class="col">
                  <div class="row my-3 justify-content-around">
                    <label for="profile_image" class="h5">Image</label>
                  </div>
                  <form enctype="multipart/form-data" action="" method="POST"> 
                    @csrf
                    <div class="row ml-3">
                      <img src="" class="rounded-circle" style="width:175px; height:175px;"> 
                    </div>
                  
                    <!-- Make pop up to upload image <input type="file" name="image_url"> -->
              
                    <div class="row my-4 justify-content-around">
                      <!-- TO DO:
                      *set Delete and Upload functions to the profile image -->
                      <input class="btn btn-primary mr-2" type="submit" value="Delete">  
                      <input class="btn btn-primary" type="submit" value="Update">        
                    </div>
                  </form>
                </div> 
                  
                  
                <div class="col-md-8">
                  <!-- Job title field readonly -->
                  <!-- TO DO: 
                  * grab job title from user,
                  * set value,
                  * check if job title is in correct format -->
                  <div class="row mb-2">
                    <div class="input-group">
                      <label for="job_title" class="input-group-text">{{ __('Job Title') }}</label>

                      <input id="staticJobTitle" type="job_title" readonly class="form-control-plaintext p-2 border" name="staticJobTitle" aria-label="Inactive job title row" value="">

                    </div>
                  </div>

                  <!-- Phone number field -->
                  <!-- TO DO: 
                  * grab phone # from user,
                  * set value, 
                  * check if phone number is in correct format -->
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
                  * grab address from user,
                  *set value, 
                  * check if address is in correct format -->
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
                
                  <!-- Emergency contact information -->
                  <div class="card">
                    <div class="card-header text-left text-white" style="background-color:#5fc7cc; height: 3rem">
                      <label class="h5">Emergency Contact</label>
                    </div>
                    <div class="card-body">
                      <!-- First name for the emergency contact -->
                      <!-- TO DO:
                      * set value 
                      * grab emergency first name from user 
                      * check if emergency first name is in correct format -->
                      <div class="row mb-2">
                        <div class="input-group">
                          <label for="first_name_emergency" class="input-group-text">{{ __('First Name') }}</label>

                          <input id="first_name_emergency" type="text" class="form-control @error('first_name_emergency') is-invalid @enderror" name="first_name_emergency" aria-label="Edit the first name of your emergency contact" value="" required autocomplete="first_name_emergency" autofocus>

                          @error('first_name_emergency')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>
                      <!-- Last name field for the emergency contact-->
                      <!-- To Do:
                      * set value,
                      * grab emergency last name from user 
                      * check if emergency last name is in correct format -->
                      <div class="row mb-2">
                        <div class="input-group">
                          <label for="last_name_emergency" class="input-group-text">{{ __('Last Name') }}</label>

                          <input id="last_name_emergency" type="text" class="form-control @error('last_name_emergency') is-invalid @enderror" name="last_name_emergency" aria-label="Edit the last name of your emergency contact" value="" required autocomplete="last_name_emergency" autofocus>

                          @error('last_name_emergency')
                            <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                            </span>
                          @enderror
                        </div>
                      </div>

                      <!-- Phone number for the emergency contact-->
                      <!-- To Do:
                      * set value,
                      * grab emergency phone number from user 
                      * check if phone number is in correct format --> 
                      <div class="row">
                        <div class="input-group">
                            <label for="phone_number_emergency" class="input-group-text">{{ __('Phone Number') }}</label>

                            <input id="phone_number_emergency" type="text" class="form-control @error('phone_number_emergency') is-invalid @enderror" name="phone_number_emergency" aria-label="Edit the phone number for your emergency contact" value="" required autocomplete="phone_number_emergency" autofocus>

                            @error('phone_number_emergency')
                              <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                              </span>
                            @enderror
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Button to Save Changes to the Profile Page -->
              <div class="row">
                <div class="col-md-10 offset-md-4 mb-2">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Save Changes') }}
                  </button>
                </div>
              </div>
                  
                <!-- </div>
              </div> -->
            </form>
          </div>
        </div>
    <!-- </div> -->
  </div>
</div>
@endsection