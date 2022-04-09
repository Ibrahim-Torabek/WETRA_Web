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
    <div class="col-md-8">
      <div class="card">
        <div class="card-header text-left">
          <h5 class="mb-0">{{ __('Change Password') }}</h5>
        </div>
        <div class="card-body">
          <form method="POST" action="">
            @csrf
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
                <label for="inputNewPassword" class="col-form-label">New password</label>
              </div>
              <div class="col">
                <input type="password" id="inputNewPassword" class="form-control" aria-describedby="newPasswordHelpBlock">
                <div id="newPasswordHelpBlock" class="form-text">
                  Must be 8-20 characters long and contain only letters and numbers.
                </div>
              </div>
            </div>

            <!-- Confirm password field -->
            <div class="row align-items-center mt-3">
              <div class="col-md-2">
                <label for="confirmNewPassword" class="col-form-label">Confirm password</label>
              </div>
              <div class="col">
                <input type="password" id="confirmNewPassword" class="form-control" aria-label="Confirm your new password">
              </div>

            </div>

            <!-- Button to Save password change -->
            <div class="row text-center">
              <div class="mt-4">
                <button type="submit" class="btn btn-primary btn-lg">
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
@stop