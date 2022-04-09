@extends('layouts.app')

@section('content')
<div class="container pt-5">
  <div class="row justify-content-left">
    <!-- Notifications card -->
    <div class="row justify-content-center">
      <div class="col pt-4">
       <h4 class="text-center pb-2">{{ __('Settings') }}</h4>
        <div class="card">
          <div class="card-header text-left">
            <h5>{{ __('Notifications') }}</h5>
            <p class="text-muted mb-0">Check the notifications you would like to receive</p>
          </div>
          <div class="card-body">       
            <form method="POST" action="">
              @csrf
              <div class="row">
                <div class="col">
                  <div class="custom-control custom-checkbox border-bottom">
                    <input type="checkbox" class="custom-control-input" id="fileUploadedCheck">
                    <label class="custom-control-label pb-2" for="fileUploadedCheck">New file uploaded</label>
                  </div>
                  <div class="custom-control custom-checkbox border-bottom">
                    <input type="checkbox" class="custom-control-input" id="messageReceivedCheck">
                    <label class="custom-control-label pb-2" for="messageReceivedCheck">New message received</label>
                  </div>
                </div>
                <div class="col">
                  <div class="custom-control custom-checkbox border-bottom">
                    <input type="checkbox" class="custom-control-input" id="passwordChangedCheck">
                    <label class="custom-control-label pb-2" for="passwordChangedCheck">Password changed</label>
                  </div>
                  <div class="custom-control custom-checkbox border-bottom">
                    <input type="checkbox" class="custom-control-input" id="personalInformationCheck">
                    <label class="custom-control-label pb-2" for="personalInformationCheck">Personal information changed</label>
                  </div>
                </div>
              </div>
              <!-- Button to Save Changes to the Notifications -->
              <div class="row">
                <div class="mt-4 text-center">
                  <button type="submit" class="btn btn-primary">
                      {{ __('Save Changes') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Change password card -->
    <div class="col">
      <div class="card">
        <div class="card-header text-left">
          <h5 class="mb-0">{{ __('Change Password') }}</h5>
        </div>
        <div class="card-body">       
          <form method="POST" action="">
            @csrf
            <!-- Current password field                      -->
            <div class="row g-3 align-items-center">
              <div class="col-auto">
                <label for="inputCurrentPassword" class="col-form-label">Current password</label>
              </div>
              <div class="col-auto">
                <input type="password" id="inputCurrentPassword" class="form-control" aria-describedby="currentPasswordHelpInline">
              </div>
              <div class="col-auto">
                <span id="currentPasswordHelpInline" class="form-text">
                  Type your current password
                </span>
              </div>
            </div>

            <!-- New password field -->
            <div class="row g-1 align-items-center mt-1">
              <div class="col-auto">
                <label for="inputNewPassword" class="col-form-label">New password</label>
              </div>
              <div class="col-auto">
                <input type="password" id="inputNewPassword" class="form-control" aria-describedby="newPasswordHelpInline">
              </div>
              <div class="col-auto">
                <span id="newPasswordHelpInline" class="form-text">
                Must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                </span>
              </div>
            </div>

            <!-- Confirm password field -->
            <div class="row g-3 align-items-center mt-1">
              <div class="col-auto">
                <label for="confirmNewPassword" class="col-form-label">New password</label>
              </div>
              <div class="col-auto">
                <input type="password" id="confirmNewPassword" class="form-control" aria-describedby="confirmPasswordHelpInline">
              </div>
              <div class="col-auto">
                <span id="confirmPasswordHelpInline" class="form-text">
                Type your new password to confirm.
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>