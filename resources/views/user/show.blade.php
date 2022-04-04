@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card mb-3">
        <div class="card-header text-white" style="background-color: #5AC7CD">
            <svg class="float-left mr-2" id="Avatar_Icon" data-name="Avatar Icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="30" height="30">
                <circle id="Ellipse_1" data-name="Ellipse 1" cx="25" cy="25" r="25" fill="green" />
                <circle id="Ellipse_2" data-name="Ellipse 2" cx="5" cy="5" r="5" transform="translate(20 13)" fill="#fff" />
                <path id="Path_8" data-name="Path 8" d="M14.99,0c8.188,0,18.333,2.867,14.826,5.5S23.165,10.934,14.99,11,3.421,7.708.164,5.5,6.8,0,14.99,0Z" transform="translate(10 27.678)" fill="#fff" />
            </svg>
            <h4>{{ $user->first_name }} {{ $user->last_name }} </h4>
        </div>

        <div class="card-body">
            <!-- <p class="border-bottom font-weight-bold">Name: {{$user->first_name}}</p> -->
            <!-- <p class="border-bottom">Gender: {{$user->gender}}</p> -->
            <p class="border-bottom">Job Title: {{ $user->job_title }}</p>
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
            <p class="border-bottom">Group: {{ $user->group->name ?? "No Group Assigned" }} </p>
            <p class="border-bottom">Status: {{ $user->status == 1 ? "Active" : "Not Active" }} </p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header text-white" style="background-color: #5AC7CD">
            <h4> Emergency Contact </h4>
        </div>

        <div class="card-body">
            <p class="border-bottom">Name: {{ $user->emergency_name }}</p>
            <p class="border-bottom">Phone Number: {{ $user->emergency_phone }}</p>
        </div>
    </div>

    <a class="btn btn-primary pl-4 pr-4" href="{{ action([App\Http\Controllers\UserController::class, 'edit'], ['user' => $user]) }}">Edit</a>
    <a class="btn btn-primary pl-4 pr-4" href="{{ action([App\Http\Controllers\MessageController::class, 'chat'], ['selectedUser' => $user]) }}">Chat</a>

    <form class="float-right" method="POST" action="{{ action([\App\Http\Controllers\UserController::class,'destroy'],  ['user' => $user]) }}">
        @csrf
        {{ method_field('DELETE') }}
        <input class="btn btn-danger pl-4 pr-4" type="submit" value="Delete" onclick="return confirm('Are you Sure you want to delete this user?')">
    </form>

</div>
@stop