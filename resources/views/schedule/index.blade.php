@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div id='calendar'></div>
</div>
@stop

@section('script')


@endsection


<!-- Modal Dialog Start -->
<div class="dayDialog hidden" id="dayDialog" style="display:none;">
    <div class="dialo-body">
        <form id="dayClick" action="{{ action([\App\Http\Controllers\ScheduleController::class, 'store']) }}" method="POST">
            @csrf
            <!-- <div class="btn-group btn-group-toggle" data-toggle="buttons">
                <label class="btn btn-secondary active">
                    <input type="radio" name="options" id="option1" checked> Add Event
                </label>
                <label class="btn btn-secondary">
                    <input type="radio" name="options" id="option2"> Add Task
                </label>
            </div> -->
            <!-- <input class="col-5" type="checkbox" checked data-toggle="toggle" data-on="Event" data-off="Task" data-onstyle="success" data-offstyle="danger" width="50"> -->
            <input type="hidden" name="id" id="id">
            <div class="form-group">
                <label>Event Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Event Title" required>
            </div>
            <!-- <div class="form-group">
                <label>Event Description</label>
                <input type="text" class="form-control" name="description" id="description" placeholder="Event Description" required>
            </div> -->

            <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control" id="start" name="start" placeholder="Start Date & Time" required>
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="text" class="form-control" id="end" name="end" placeholder="Start Date & Time" required>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch1 allDay" name="allDay" >
                <label class="custom-control-label" for="customSwitch1">All Day</label>
            </div>
            <div class="form-group">
                <label>Assigned To</label>
                <select class="form-control multiple_select" name="assigned_to" id="assigned_to" single="single" style="width:100%">
                    <option value="0"></option>
                    <option value="0">All Users</option>
                    <option value="admins">Admins</option>
                    <option value="barn">Barn Staff</option>
                    <option value="office">Office Staff</option>
                    <option value="instructors">Instructors</option>
                    <option value="volunteers">Volunteers</option>
                    ...
                    <optgroup label="Users">
                        @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->first_name}} {{ $user->last_name}}</option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
            <div class="form-group">
                <label>Background Color</label>
                <input type="color" class="form-control" name="color" id="color" value="#0000ff">
            </div>
            <div class="form-group">
                <label>Text Color</label>
                <input type="color" class="form-control" name="textColor" id="textColor" value="#ffffff">
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-primary float-right">Save</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Dialog End -->