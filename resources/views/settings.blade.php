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
          <h5>{{ __('Change Password') }}</h5>
        </div>
        <div class="card-body">       
          <form method="POST" action="">
            @csrf
            <div class="d-flex pt-3 border-bottom">
            
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>