@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card mb-3">
        <div class="card-header text-white" style="background-color: #5AC7CD">
            <h4>{{ $user->first_name }} {{ $user->last_name }} </h4>
        </div>

        <div class="card-body">
            <!-- <p class="border-bottom font-weight-bold">Name: {{$user->first_name}}</p> -->
            <!-- <p class="border-bottom">Gender: {{$user->gender}}</p> -->
            <p class="border-bottom">Job Title: </p>
            <p class="border-bottom">Phone Number: {{$user->phone_number}}</p>
            <p class="border-bottom">Email: {{$user->email}}</p>
            <p class="border-bottom">Address: {{$user->address}}</p>
            <p class="border-bottom">Registered Date: {{$user->registered_date}}</p>
        </div>
    </div>
    <div class="card mb-3">
        <div class="card-header text-white" style="background-color: #5AC7CD">
            <h4> Role </h4>
        </div>

        <div class="card-body">
            <p class="border-bottom">Admin: {{ $user->isAdmin() }} </p>
            <p class="border-bottom">Group: </p>
            <p class="border-bottom">Status: </p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header text-white" style="background-color: #5AC7CD">
            <h4> Emergency Contact </h4>
        </div>

        <div class="card-body">
            <p class="border-bottom">Name: </p>
            <p class="border-bottom">Phone Number: </p>
        </div>
    </div>

</div>
@stop