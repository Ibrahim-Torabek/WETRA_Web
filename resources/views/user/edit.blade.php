@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <form method="POST" action="{{ action([App\Http\Controllers\UserController::class, 'update'], ['user' => $user]) }}">
        @csrf
        {{ method_field('PATCH') }}
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
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="group">Group:</label>
                    </div>
                    <select class="custom-select" id="group" name="group_id">
                        <option selected value="0">Non</option>
                        @foreach($groups as $group)
                        <option value="{{ $group->id }}" {{ ($user->group_id == $group->id) ? 'selected' : '' }}> {{ $group->name }} </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="status">Status:</label>
                    </div>
                    <select class="custom-select" id="status" name="status">
                        <option selected value="0">Inactive</option>
                        <option {{ $user->status == 1 ? 'selected' : '' }} value="1">Active</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-default">Job Title:</span>
                    </div>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" name="job_title" value="{{ $user->job_title }}">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input type="checkbox" aria-label="Checkbox for following text input" id="is-admin" name="is_admin" value="1">
                        </div>
                    </div>
                    <label class="form-control" for="is-admin"> Is Admin </label>
                </div>

                
            </div>

            
        </div>
        <input class="btn btn-primary" type="submit" value="Save & Return">
    </form>
</div>
@stop