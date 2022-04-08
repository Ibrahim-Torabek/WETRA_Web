@extends('layouts.app')

@php
    $user = Auth::user()
@endphp

@section('content')

<div class="container mt-3">
    <div class="row justify-content-center pt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-left h5">My Profile
                </div>
                <div class="card-body">
                    <!-- <form method="POST" action=""> -->
                    <form method="POST" action="{{ action([App\Http\Controllers\UserController::class, 'update'], ['user' => $user]) }}">
                        @csrf
                        {{ method_field('PATCH') }}
                        <div class="row">
                            <!-- First name field -->
                            <div class="col">
                                <div class="input-group">
                                    <label for="first_name" class="input-group-text">First Name</label>

                                    <input id="first_name" type="text" class="form-control " name="first_name" aria-label="Edit your first name" required="" autocomplete="first_name" autofocus="" value="{{ $user->first_name }}">

                                </div>
                            </div>
                            <!-- Last name field -->
                            <div class="col">
                                <div class="input-group">
                                    <label for="last_name" class="input-group-text">Last Name</label>

                                    <input id="last_name" type="text" class="form-control " name="last_name" aria-label="Edit your last name" required="" autocomplete="last_name" autofocus="" value="{{ $user->last_name }}">

                                </div>
                            </div>
                        </div>

                        <hr>

                        <!-- Image field. Modal dialog opens when Update button pressed -->
                        <div class="row">
                            <div class="col pl-4 justify-content-center">
                                <div class="row my-3">
                                    <label for="profile_image" class="h5">Profile Image</label>
                                </div>


                                <div class="row">
                                    <!-- Image by default -->
                                    <svg id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="175" height="175">
                                        <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green"></circle>
                                        <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff"></circle>
                                        <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff"></path>
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


                            </div>

                            <div class="col-md-8">


                                <!-- Phone number field -->
                                <!-- TO DO: 
                * grab phone # from user,
                * set value, 
                * check if phone number is in correct format -->
                                <div class="row mb-2">
                                    <div class="input-group">
                                        <label for="phone_number" class="input-group-text">Phone Number</label>

                                        <input id="phone_number" type="text" class="form-control " name="phone_number" aria-label="Edit your phone number" required=""  value="{{ $user->phone_number }}">

                                    </div>
                                </div>

                                <!-- Address field -->
                                <!-- TO DO: 
                * grab address from user,
                *set value, 
                * check if address is in correct format -->
                                <div class="row mb-2">
                                    <div class="input-group">
                                        <label for="address" class="input-group-text">Address:</label>

                                        <input id="address" type="text" class="form-control " name="address" aria-label="Edit your address" value="{{ $user->address }}">

                                    </div>
                                </div>

                                <!-- Email field readonly -->
                                <div class="row mb-2 mt-5">
                                    <div class="input-group">
                                        <label for="email" class="input-group-text">Email Address</label>

                                        <input id="email" type="email" readonly="" class="form-control-plaintext p-2 border" aria-label="Inactive email row" value="{{ $user->email }}" disabled>
                                    </div>
                                </div>
                                <!-- Job title field readonly -->
                                <div class="row mb-2">
                                    <div class="input-group">
                                        <label for="job_title" class="input-group-text">Job Title</label>

                                        <input id="job_title" type="job_title" readonly="" class="form-control-plaintext p-2 border" aria-label="Inactive job title row" value="{{ $user->job_title }}" disabled>

                                    </div>
                                </div>

                                <!-- Group field readonly -->
                                <div class="row mb-2">
                                    <div class="input-group .bg-light">
                                        <label for="group" class="input-group-text">Group</label>

                                        <input id="group" type="job_title" readonly="" class="form-control-plaintext p-2 border" aria-label="Inactive job title row" value="{{ $user->group['name'] }}" disabled>

                                    </div>
                                </div>

                                <!-- Emergency contact information -->
                                <div class="card">
                                    <div class="card-header text-left text-white" style="background-color:#5fc7cc; height: 3rem">
                                        <label class="h5">Emergency Contact</label>
                                    </div>
                                    <div class="card-body">
                                        <!-- Name for the emergency contact -->
                                        <div class="row mb-2">
                                            <div class="input-group">
                                                <label for="contact_name" class="input-group-text">Name</label>

                                                <input id="contact_name" type="text" class="form-control " name="emergency_name" aria-label="Edit the name of your emergency contact"  value="{{ $user->emergency_name }}">

                                            </div>
                                        </div>

                                        <!-- Phone number for the emergency contact-->
                                        <div class="row">
                                            <div class="input-group">
                                                <label for="phone_number_emergency" class="input-group-text">Phone Number</label>

                                                <input id="contact_phone_number" type="text" class="form-control " name="emergency_phone" aria-label="Edit the phone number for your emergency contact" value="{{ $user->emergency_phone }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Button to Save Changes to the Profile Page -->
                        <div class="row mt-4">
                            <div class="col-md-10 offset-md-4 mb-2">
                                <button type="submit" class="btn btn-primary">
                                    Save Changes
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