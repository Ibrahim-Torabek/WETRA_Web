@extends('layouts.app')

@section('content')
<div class="container pt-5">
    <div id='calendar'></div>

</div>

<!-- Modal Dialog Start -->
<div class="modal-dialog">
    <div id="dayDialog" class="modal hidden" tabindex="-1">
        <div class="dialo-body">
            <!-- action="{{ action([\App\Http\Controllers\ScheduleController::class, 'store']) }}" method="POST" -->
            <div id="dayClick">
                <!-- @csrf -->
                <!-- <input class="col-5" type="checkbox" checked data-toggle="toggle" data-on="Event" data-off="Task" data-onstyle="success" data-offstyle="danger" width="50"> -->
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="scheduleType" id="schedule-type">
                <div class="form-group mb-0 floating mt-3">

                    <input type="text" class="form-control floating" name="title" id="title" required value="">
                    <label for="title">Title</label>
                </div>
                <div class="btn-group btn-group-toggle mb-3" data-toggle="buttons" id="event-task-selection">
                    <label class="btn btn-secondary active">
                        <input type="radio" name="options" id="add-event" checked> Add Event
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" name="options" id="add-task"> Add Task
                    </label>
                </div>
                <div class="form-group hide" id="task-description">
                    <label>Task Description</label>
                    <input type="text" class="form-control" name="description" id="description" placeholder="Task Description" required>
                </div>

                <div class="form-group">
                    <label>Start Date</label>
                    <input type="text" class="form-control" id="start" name="start" placeholder="Start Date & Time" required>
                </div>
                <div class="form-group" id="end-date">
                    <label>End Date</label>
                    <input type="text" class="form-control" id="end" name="end" placeholder="Start Date & Time" required>
                </div>
                <div class="custom-control custom-switch" id="all-day">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1 allDay" name="allDay">
                    <label class="custom-control-label" for="customSwitch1">All Day</label>
                </div>
                <div class="form-group" id="assigned-to">
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
                    <button type="button" class="btn btn-primary float-right" id="submit-event">Save</button>
                </div>
                <div class="form-group">
                    <a class="btn btn-danger float-right mr-3" id="delete-event">Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Dialog End -->

<!-- Non-admin User Modal -->
<div class="modal-dialog">
    <div id="taskDialog" class="modal hidden" tabindex="-1">
        <div class="dialog-body">
            <!-- action="{{ action([\App\Http\Controllers\ScheduleController::class, 'store']) }}" method="POST" -->
            <div id="dayClick">
                <!-- @csrf -->
                <!-- <input class="col-5" type="checkbox" checked data-toggle="toggle" data-on="Event" data-off="Task" data-onstyle="success" data-offstyle="danger" width="50"> -->
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="scheduleType" id="schedule-type">

                <div class="form-check m-3">
                    <input class="form-check-input taskStatus" type="radio" name="taskStatus" id="completed" value="completed">
                    <label class="form-check-label" for="completed">
                        Completed
                    </label>
                </div>
                <div class="form-check m-3">
                    <input class="form-check-input taskStatus" type="radio" name="taskStatus" id="request-time-off" value="requestTimeOff">
                    <label class="form-check-label" for="request-time-off">
                        Request Time-off
                    </label>
                </div>
                <hr>
                <div class="form-group">
                    <button type="button" class="btn btn-primary float-right" id="submit-task">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Dialog End -->

<script>
    // Initial for Add Event 
    $('#schedule-type').val('event');
    $('#task-description').hide();
    $('#assigned-to').hide();
    $('#all-day').hide();

    // Add event button clicked
    $('#add-event').click(function(e) {
        eventClicked();
    });

    // Add Task button clicked
    $('#add-task').click(function(e) {
        taskClicked();
    });

    $('.multiple_select').select2({
        placeholder: "Select a group or a person",
        allowClear: true,
        dropdownParent: $('#dayDialog')
    });


    var calendarEl = document.getElementById('calendar');

    var calendar = $('#calendar').fullCalendar({
        //plugins: [ interactionPlugin ],
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'year,month,agendaWeek,agendaDay,listWeek'
        },
        height: 650,
        showNonCurrenDates: false,
        initialView: 'listWeek',
        //defaultView: 'listWeek',
        events: "{{ url('schedules') }}",

        eventRender: function(event, element) {
            if(event.allDay == 1){
                evet.allDay = true;
                console.log(event);
            }
            if (event.scheduleType == 'task') {
                element.html('<i class="material-icons" style="font-size: 16px;line-height: 1;">task_alt</i> ' + event.title);
                if(event.is_completed == 1){
                    element.css("background-color", "grey");
                    element.html('<i class="material-icons" style="font-size: 16px;line-height: 1;">done_all</i> ' + event.title);
                }
                if(event.request_time_off_id > 0){
                    element.css("background-color", "orange");
                    element.html('<i class="material-icons" style="font-size: 16px;line-height: 1;">auto_delete</i> ' + event.title);
                }
            }
        },

        showNonCurrentDates: false,
        eventDidMount: function(info) {
            var tooltip = new Tooltip(info.el, {
                title: "Hello World", //info.event.description,
                placement: 'top',
                trigger: 'hover',
                container: 'body'
            });
            console.log(info);
        },

        navLinks: true,
        navLinkDayClick: function(date, jsEvent) {
            console.log('day', date.toISOString());
            console.log('coords', jsEvent.pageX, jsEvent.pageY);
            $('#calendar').fullCalendar('changeView', 'agendaDay', date);
        },

        @auth
        @if(Auth::user() -> is_admin == 1)
        selectable: true,
        dragabble: true,
        selectHelper: true,
        editable: true,
        // dayClick: function(date, event, view) {
        //     var date = $.fullCalendar.formatDate(date, 'Y-MM-DD HH:mm:ss');
        //     $("#title").val("");
        //     $("#start").val((date));
        //     $("#end").val((date));
        //     $("#delete-event").hide();
        //     $("#id").val('');
        //     $("#submit-event").html('Add Event');
        //     $('#dayDialog').dialog({
        //         title: 'Add Schedule',
        //         width: 600,
        //         height: 650,
        //         modal: true,
        //         show: {
        //             effect: 'clip',
        //             duration: 350
        //         },
        //         hide: {
        //             effect: 'clip',
        //             duration: 250
        //         },
        //     });
        //     //calendar.fullCalendar('renderEvent', event, true);
        // },
        select: function(start, end) {
            var start = $.fullCalendar.formatDate(start, 'Y-MM-DD HH:mm:ss');
            var end = $.fullCalendar.formatDate(end, 'Y-MM-DD HH:mm:ss');
            $('#event-task-selection').show();
            $("#title").val("");
            $('#start').val((start));
            $('#end').val((end));
            $("#delete-event").hide();
            $("#id").val('');
            $("#description").val('');
            $("#submit-event").html('Save');
            $('#dayDialog').dialog({
                title: 'Add Schedule',
                width: 600,
                height: 650,
                modal: true,
                show: {
                    effect: 'clip',
                    duration: 350
                },
                hide: {
                    effect: 'clip',
                    duration: 250
                },
            })
        },
        eventClick: function(event) {
            $('#event-task-selection').hide();
            if (event.scheduleType == 'task') {
                taskClicked();
                $('#schedule-type').val('task');
            } else {
                eventClicked();
                $('#schedule-type').val('event');
            }
            $("#title").val(event.title);
            $("#start").val($.fullCalendar.formatDate(event.start, 'Y-MM-DD HH:mm:ss'));
            $("#end").val($.fullCalendar.formatDate(event.end, 'Y-MM-DD HH:mm:ss'));
            $("#allDay").val(event.allDay);
            $("#description").val(event.description);
            $("#assigned_to").val(event.assigned_to);
            $("#color").val(event.color);
            $("#textColor").val(event.textColor);
            $("#id").val(event.id);
            $("#submit-event").html('Update');
            //var url = "{{ url('schedules/deleteEvent') }}";
            $("#delete-event").show(); //.attr('href', url + '/' + event.id);
            $('#dayDialog').dialog({
                title: 'Edit Schedule',
                width: 600,
                height: 650,
                modal: true,
                show: {
                    effect: 'clip',
                    duration: 350
                },
                hide: {
                    effect: 'clip',
                    duration: 50
                },
            })
        },
        @else

        eventClick: function(event) {  
            if (event.scheduleType == 'task' && event.is_completed != 1) {
                $("#id").val(event.id);
                $('#schedule-type').val('task');
                $('#taskDialog').dialog({
                    title: event.title,
                    width: 400,
                    height: 250,
                    modal: true,
                    show: {
                        effect: 'clip',
                        duration: 350
                    },
                    hide: {
                        effect: 'clip',
                        duration: 50
                    },
                })
            } 

        },
        @endif
        @endauth

    });





    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Add event
    $("#submit-event").click(function(e) {
        e.preventDefault();
        //$("#dayDialog").hide();
        //alert("Clicked");
        $.ajax({
            url: "schedules",
            type: "POST",
            data: {
                //_token: "{{ csrf_token() }}",
                scheduleType: $("#schedule-type").val(),
                title: $("#title").val(),
                start: $("#start").val(),
                end: $("#end").val(),
                allDay: $("#allDay").val(),
                description: $("#description").val(),
                assigned_to: $("#assigned_to").val(),
                color: $("#color").val(),
                textColor: $("#textColor").val(),
                id: $("#id").val(),
            },
            success: function(data) {
                $("#dayDialog").dialog('close');

                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Event added or updated successfully',

                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                $('#calendar').fullCalendar('refetchEvents');

            },
            error: function(result) {
                //$("#dayDialog").hide();
                alert("Error: " + result);
                console.log(result);

            },
        });
    });

    //Delete Event
    $("#delete-event").click(function(e) {
        e.preventDefault;
        //var confirmDelete = confirm("Are you sure you want to delete?");
        if (true) {
            $.ajax({
                url: "schedules/destroy",
                type: "DELETE",
                data: {
                    id: $("#id").val(),
                    scheduleType: $('#schedule-type').val(),
                },
                success: function(data) {
                    $("#dayDialog").dialog('close');
                    $('#calendar').fullCalendar('refetchEvents');
                    Swal.fire({
                        toast: true,
                        icon: 'success',
                        title: 'Event deleted successfully',
                        animation: false,
                        position: 'top-right',
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    });

                },
                error: function(result) {
                    //alert("Error: " + result);
                    console.log(result);
                },
            });
        }
    });

    // Change Task Status
    $("#submit-task").click(function(e) {
        e.preventDefault();
        //$("#dayDialog").hide();
        //alert("Clicked");
        var url = "schedules/update"; // + $("#id").val();
        console.log(url);
        $.ajax({
            url: url,
            type: "PUT",
            data: {
                //_token: "{{ csrf_token() }}",
                id: $("#id").val(),
                taskStatus: $(".taskStatus:checked").val(), // $("input[type='radio']:checked").val(),
            },
            success: function(data) {
                $("#taskDialog").dialog('close');

                Swal.fire({
                    toast: true,
                    icon: 'success',
                    title: 'Task status updated successfully',

                    position: 'top-right',
                    showConfirmButton: false,
                    timer: 1000,
                });
                $('#calendar').fullCalendar('refetchEvents');

            },
            error: function(result) {
                //$("#dayDialog").hide();
                alert("Error: " + result);
                console.log(result);

            },
        });
    });

    function taskClicked() {
        $('#schedule-type').val('task');
        $('#end-date').hide();

        $('#task-description').show();
        $('#assigned-to').show();

        //$('#submit-event').html('Add Task');
    }

    function eventClicked() {
        $('#schedule-type').val('event');
        $('#task-description').hide();
        $('#assigned-to').hide();

        $('#end-date').show();
    }
</script>
<style>
    .form-group.floating>label {
        bottom: 34px;
        left: 8px;
        position: relative;
        background-color: white;
        padding: 0px 5px 0px 5px;
        font-size: 1.1em;
        transition: 0.1s;
        pointer-events: none;
        font-weight: 500 !important;
        transform-origin: bottom left;
    }

    .form-control.floating:focus~label {
        transform: translate(1px, -85%) scale(0.80);
        opacity: .5;
        color: #005ebf;
    }

    .form-control.floating:valid~label {
        transform-origin: bottom left;
        transform: translate(1px, -85%) scale(0.80);
        opacity: .8;
    }
</style>
@stop

@section('script')


@endsection