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
            <div class="form-group">
                <label>Event Title</label>
                <input type="text" class="form-control" name="event_name" placeholder="Event Name" required>
            </div>
            <div class="form-group">
                <label>Event Description</label>
                <input type="text" class="form-control" name="event_description" placeholder="Event Description" required>
            </div>

            <div class="form-group">
                <label>Start Date</label>
                <input type="text" class="form-control" name="event_start_date" placeholder="Start Date & Time"  required>
            </div>
            <div class="form-group">
                <label>End Date</label>
                <input type="text" class="form-control" name="event_end_date" placeholder="Start Date & Time"  required>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="is_all_day">
                <label class="custom-control-label" for="customSwitch1">All Day</label>
            </div>
            <div class="form-group">
                <label>Background Color</label>
                <input type="color" class="form-control" name="color" value="#0000ff">
            </div>
            <div class="form-group">
                <label>Text Color</label>
                <input type="color" class="form-control" name="text_color" value="#ffffff">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Add</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Dialog End -->