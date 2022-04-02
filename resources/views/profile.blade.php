@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center pt-5">
    <div class="col-md-8">
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
                <div class="col pl-4 justify-content-center">
                  <div class="row my-3">
                    <label for="profile_image" class="h5">Profile Image</label>
                  </div>
                  <form enctype="multipart/form-data" action="" method="POST"> 
                    @csrf
                    <div class="row">
                      <!-- Image by default -->
                      <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="175" height="175">
                        <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green" />
                        <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff" />
                        <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff" />
                        </svg>
                    </div>
                  
                    
              
                    <div class="col my-4">
                      <!-- TO DO:
                      *set Delete and Upload functions to the profile image -->
                      <div class="row pb-4">
                        <button class="btn btn-primary" type="submit">Delete Image</button> 
                      </div>
                      <div class="row">
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#updateImageModal">Update Image</button>  
                      </div>     
                    </div>
                    <!-- Modal to upload image -->
                    
                    <div class="modal fade" id="updateImageModal" aria-labelledby="updateImageModal">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="updateImageModalLabel">Update Image</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            <div class="mb-3">
                              <label for="formFile" class="form-label">Browse your files to choose an image.</label>
                              <input class="form-control" type="file" id="formFile">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary">Upload Image</button>
                          </div>
                        </div>
                      </div>
                    </div>
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
                      <!-- Name for the emergency contact -->
                      <!-- TO DO:
                      * set value 
                      * grab emergency name from user 
                      * check if emergency name is in correct format -->
                      <div class="row mb-2">
                        <div class="input-group">
                          <label for="contact_name" class="input-group-text">{{ __('Name') }}</label>

                          <input id="contact_name" type="text" class="form-control @error('contact_name') is-invalid @enderror" name="contact_name" aria-label="Edit the name of your emergency contact" value="" required autocomplete="contact_name" autofocus>

                          @error('contact_name')
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

                            <input id="contact_phone_number" type="text" class="form-control @error('contact_phone_number') is-invalid @enderror" name="contact_phone_number" aria-label="Edit the phone number for your emergency contact" value="" required autocomplete="contact_phone_number" autofocus>

                            @error('contact_phone_number')
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
    </div>
  </div>
</div>
@endsection