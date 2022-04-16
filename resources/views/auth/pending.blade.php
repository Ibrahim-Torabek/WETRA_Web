@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">

                    {{ __('Your accont is pending now, please wait for the admin to accept your registration.') }}
                    {{ __('Only thing you can do is change your profiles.') }},
                </div>
                <div class="card-footer">
                    <a href="{{ url('users/profile') }}">Click to change profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop