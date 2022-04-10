@extends('layouts.app')

@section('content')
<div class="container pt-5 ">

  <!-- Notifications card -->
  <div class="row pt-4 justify-content-center">
    <div class="col-md-10">
      <h4 class="text-center pb-2">{{ __('Settings') }} of {{ Auth::user()->first_name }}</h4>
      <div class="col">
        <div class="card">
          <div class="card-header text-left">
            <h5>{{ __('Notifications') }}</h5>
            <p class="text-muted mb-0">Check the notifications you would like to receive</p>
          </div>
          <div class="card-body">
            <form method="POST" action="{{ action([\App\Http\Controllers\SettingController::class, 'update'], ['setting' => Auth::user()->settings]) }}">
              @csrf
              {{ method_field('PATCH') }}
              <input type="hidden" name="settingsType" value="notification">
              <div class="row">
                <div class="col">
                  <div class="custom-control custom-checkbox border-bottom">
                    <input type="hidden" name="file_upload" value="0">
                    <input type="checkbox" class="custom-control-input" id="file_upload" name="file_upload" value="1" {{ Auth::user()->settings->file_upload == 1 ? 'checked' : '' }}>
                    <label class="custom-control-label pb-2" for="file_upload" name>New file uploaded</label>
                  </div>
                  <div class="custom-control custom-checkbox border-bottom mt-2">
                    <input type="hidden" name="new_message" value="0">
                    <input type="checkbox" class="custom-control-input" id="new_message" name="new_message" value="1" {{ Auth::user()->settings->new_message == 1 ? 'checked' : '' }}>
                    <label class="custom-control-label pb-2" for="new_message">New message received</label>
                  </div>
                  <div class="custom-control custom-checkbox border-bottom mt-2">
                    <input type="hidden" name="new_schedule" value="0">
                    <input type="checkbox" class="custom-control-input" id="new_schedule" name="new_schedule" value="1" {{ Auth::user()->settings->new_schedule == 1 ? 'checked' : '' }}>
                    <label class="custom-control-label pb-2" for="new_schedule">New Schedule created</label>
                  </div>
                </div>
                <!-- <div class="col">
                  <div class="custom-control custom-checkbox border-bottom">
                    <input type="checkbox" class="custom-control-input" id="passwordChangedCheck">
                    <label class="custom-control-label pb-2" for="passwordChangedCheck">Password changed</label>
                  </div>
                  <div class="custom-control custom-checkbox border-bottom mt-2">
                    <input type="checkbox" class="custom-control-input" id="personalInformationCheck">
                    <label class="custom-control-label pb-2" for="personalInformationCheck">Personal information changed</label>
                  </div>
                </div>
              </div> -->
                <!-- Button to Save Changes to the Notifications -->
                <div class="row">
                  <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-primary btn-lg">
                      {{ __('Save Notifications') }}
                    </button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Change password card -->
  <div class="row pt-4 justify-content-center">
    <div class="col-md-10">
      <div class="card">
        <div class="card-header text-left">
          <h5 class="mb-0">{{ __('Change Password') }}</h5>
        </div>
        <div class="card-body">
          <form id='password-form' method="POST" action="{{ action([\App\Http\Controllers\SettingController::class, 'update'], ['setting' => Auth::user()->settings]) }}">
            @csrf
            {{ method_field('PATCH') }}
            <input type="hidden" name="settingsType" value="password">
            <!-- Current password field -->
            <div class="row align-items-center">
              <div class="col-md-2">
                <label for="inputCurrentPassword" class="col-form-label">Current password</label>
              </div>
              <div class="col">
                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" aria-label="Type your current password">
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <!-- New password field -->
            <div class="row align-items-center mt-3">
              <div class="col-md-2">
                <label for="new-password" class="col-form-label">New password</label>
              </div>
              <div class="col">
                <input type="password" id="new-password" name="newPassword" class="form-control @error('notvalid') is-invalid @enderror" aria-describedby="newPasswordHelpBlock" required>
                <div id="newPasswordHelpBlock" class="form-text" style="display:none;">
                  <span id="length" class="invalid mr-2">Minimum <b>8 characters</b></span>
                  <span id="letter" class="invalid mr-2">A <b>lowercase</b> letter</span>
                  <span id="capital" class="invalid mr-2">A <b>capital (uppercase)</b> letter</span>
                  <span id="number" class="invalid mr-2">A <b>number</b></span>
                </div>
              </div>
            </div>

            <!-- Confirm password field -->
            <div class="row align-items-center mt-3">
              <div class="col-md-2">
                <label for="confirm-passowrd" class="col-form-label">Confirm password</label>
              </div>
              <div class="col">
                <input type="password" id="confirm-password" name="confirmPassword" class="form-control  @error('notvalid') is-invalid @enderror" aria-label="Confirm your new password" required>
                <!-- <span class="invalid-feedback" role="alert"> -->
                @error('notvalid')
                <strong> <span class="text-danger" id="not-confirmed">{{ $message }}</span></strong>
                @enderror
                <!-- </span> -->
              </div>
            </div>

            <!-- Button to Save password change -->
            <div class="row text-center">
              <div class="mt-4">
                <button type="submit" class="btn btn-primary btn-lg" id="submit-password">
                  {{ __('Update Password') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
  var myInput = document.getElementById("new-password");
  var letter = document.getElementById("letter");
  var capital = document.getElementById("capital");
  var number = document.getElementById("number");
  var length = document.getElementById("length");
  var validate1 = false;
  var validate2 = false;
  var validate3 = false;
  var validate4 = false;

  myInput.onfocus = function() {
    document.getElementById("newPasswordHelpBlock").style.display = "block";
  }

  myInput.onkeyup = function() {
    // Validate lowercase letters
    var lowerCaseLetters = /[a-z]/g;
    if (myInput.value.match(lowerCaseLetters)) {
      letter.classList.remove("invalid");
      letter.classList.add("valid");
      validate1 = true;
    } else {
      letter.classList.remove("valid");
      letter.classList.add("invalid");
      
    }

    // Validate capital letters
    var upperCaseLetters = /[A-Z]/g;
    if (myInput.value.match(upperCaseLetters)) {
      capital.classList.remove("invalid");
      capital.classList.add("valid");
      validate2 = true;
    } else {
      capital.classList.remove("valid");
      capital.classList.add("invalid");
    }

    // Validate numbers
    var numbers = /[0-9]/g;
    if (myInput.value.match(numbers)) {
      number.classList.remove("invalid");
      number.classList.add("valid");
      validate3 = true;
    } else {
      number.classList.remove("valid");
      number.classList.add("invalid");
    }

    // Validate length
    if (myInput.value.length >= 8) {
      length.classList.remove("invalid");
      length.classList.add("valid");
      validate4 = true;
    } else {
      length.classList.remove("valid");
      length.classList.add("invalid");
    }
  }


  $('#submit-password').click(function(e) {
    e.preventDefault();
    
    if(validate1 && validate2 && validate3 && validate4){
      
      $('#password-form').submit();
      return;
    }
    console.log("Not match passord validation");
  });
</script>

<style>
  .valid {
    color: green;
  }

  .valid:before {
    position: relative;
    left: -3px;
    content: "✔";
  }

  /* Add a red text color and an "x" when the requirements are wrong */
  .invalid {
    color: red;
  }

  .invalid:before {
    position: relative;
    left: -3px;
    content: "✖";
  }
</style>
@stop