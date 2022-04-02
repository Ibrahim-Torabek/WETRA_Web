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

    <button type="button" class="btn btn-primary pl-4 pr-4">Edit</button>
    <button type="button" class="btn btn-primary pl-4 pr-4">Chat</button>
    <button type="button" class="btn btn-danger pl-4 pr-4 float-right">Delete</button>
</div>
@stop