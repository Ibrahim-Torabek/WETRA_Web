@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <!-- Card on the left to display some last uploaded Files -->
        <div class="col mt-5">
            <div class="card">
                <div class="card-header text-left h5">
                    Latest Public <a href="{{ url('/files') }}"> Files </a>
                </div>
                <div class="card-body">

                    <ul class="list-group list-group-flush">
                        @if(count($publicFiles) > 0)
                        @foreach($publicFiles as $file)
                        <li class="list-group-item d-inline-block text-truncate" style="max-width: 350px;"><a href="{{ str_replace('storage/upload', 'storage/files', $file->file_url)  }}">{{ $file->file_name }}</a></li>
                        @endforeach
                        @else
                            There is no publicly shared files
                        @endif
                    </ul>

                    <!-- Button to go to Files page -->
                    <!-- <div class="row text-center">
                        <div class="mt-4">
                            <a class="btn btn-primary btn-lg" href="{{ url('/files') }}" role="button">{{ __('See My Files') }}</a>
                        </div>
                    </div> -->
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header text-left h5">
                    Latest Personal <a href="{{ url('/files') }}"> Files </a>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @if(count($personalFiles) > 0)
                        @foreach($personalFiles as $file)
                        <li class="list-group-item"><a href="{{ str_replace('storage/upload', 'storage/files', $file->file_url) }}">{{ $file->file_name }}</a></li>
                        @endforeach
                        @else
                            You have NO privately shared files.
                        @endif
                    </ul>
                </div>
            </div>
        </div>

        <!-- Card in the center showing the tasks for today and the following week -->
        @if(Auth::user()->is_admin == 1)
        <div class="col-auto mt-2">
            <div class="card">
                <div class="card-body">
                    <!-- <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            {{ __('You are logged in!') }}
                        </div>
                    </div> -->

                    <h3 class="text-center pb-2 pt-2 border-bottom">Hi {{ Auth::user()->first_name }}</h3>

                    
                    <h5 class="text-center pt-1">You have {{ count($pendingUsers) }} user{{count($pendingUsers) > 1? 's': ''}} that waiting for grouping.</h5>

                    <!-- Table to display user tasks for a week -->
                    <div class="pt-2 table-responsive">
                        

                        <table class="table table-hover table-striped">
                            <thead class="text-light" style="background-color:#620227;">
                                <tr>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendingUsers as $user)
                                <tr>
                                    <td scope="row">{{ $user->first_name }}</td>
                                    <td> <span class="d-inline-block text-truncate text-uppercase" style="max-width: 200px;"> {{ $user->last_name }}</span></td>
                                    <td>
                                        <span class="text-info">
                                        {{ $user->email }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ action([App\Http\Controllers\UserController::class, 'edit'], ['user' => $user]) }}">
                                                Edit
                                            </button>
</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <!-- Button to go to the Schedules Page -->
                    <div class="row text-center">
                        <div class="mt-4">
                            <a class="btn btn-primary btn-lg" href="{{ url('/users') }}" role="button">{{ __('See All Users') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-auto mt-2">
            <div class="card">
                <div class="card-body">
                    <!-- <div class="card">
                        <div class="card-header">{{ __('Dashboard') }}</div>
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            {{ __('You are logged in!') }}
                        </div>
                    </div> -->

                    <h3 class="text-center pb-2 pt-2 border-bottom">Hi {{ Auth::user()->first_name }}</h3>

                    <!-- TODO: If user does not have any tasks, display: "You dont have any tasks today." Overwise, display:" You have number of tasks today" -->
                    <h5 class="text-center pt-1">You have {{ count($dayTasks) }} task{{count($dayTasks) > 1? 's': ''}} today.</h5>
                    @if(count($dayTasks) > 0)
                    <h5 class="text-left pt-1"><strong>My tasks for today, {{ date('l M d, Y') }}.</strong></h5>

                    <!-- Table to display user tasks for today -->
                    <div class="pt-2 table-responsive">
                        <table class="table table-hover table-striped">
                            <thead class="text-light" style="background-color:#620227;">
                                <tr>
                                    <th scope="col">Time</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- TO DO: set tasks in the rows to display for each today's task -->
                                @foreach($dayTasks as $task)
                                <tr>
                                    <td scope="row">{{ date('H:i:s', strtotime($task->start)) }}</td>
                                    <td> <span class="d-inline-block text-truncate" style="max-width: 200px;">{{ $task->title }}</span> </td>
                                    <td>{{ $task->is_compled == 1 ? 'Competed' : 'Not Completed' }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                        <h5 class="font-weight-bold">No Task Found</h5>
                    @endif

                    <!-- Table to display user tasks for a week -->
                    <div class="pt-2 table-responsive">
                        <h5 class="text-left pt-1"><strong>My tasks for the next 7 days - {{ date('l, M d, Y,', strtotime('+1 Day')) }} to {{ date('l, M d, Y', strtotime('+1 Week')) }}.</strong></h5>

                        <table class="table table-hover table-striped">
                            <thead class="text-light" style="background-color:#620227;">
                                <tr>
                                    <th scope="col">Time</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Mark as</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($weekTasks as $task)
                                <tr>
                                    <td scope="row">{{ date('Y-m-d H:i:s', strtotime($task->start)) }}</td>
                                    <td> <span class="d-inline-block text-truncate text-uppercase" style="max-width: 200px;"> {{ $task->title }}</span></td>
                                    <td>
                                        {{ $task->is_compled == 1 ? 'Competed' : 'Not Completed' }}
                                        <br/>
                                        <span class="text-info">
                                        {{ $task->request_time_off_id > 0 ? 'Time off requested' : '' }}
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ action([App\Http\Controllers\ScheduleController::class, 'update'],['schedule' => $task->id]) }}">
                                            @csrf
                                            {{ method_field('PATCH') }}
                                            <input type="hidden" name="id" value="{{ $task->id }}">
                                            <input type="hidden" name="taskStatus" value="requestTimeOff">
                                            <button type="submit" class="btn btn-primary float-right request-time-off {{ $task->request_time_off_id > 0 ? 'disabled' : '' }}" id="request-time-off" value="{{ $task->id }}"
                                            
                                            >
                                                Request Time Off
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>

                    <!-- Button to go to the Schedules Page -->
                    <div class="row text-center">
                        <div class="mt-4">
                            <a class="btn btn-primary btn-lg" href="{{ url('/schedules') }}" role="button">{{ __('See My Schedule') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- Card on the right to display new Messages -->
        <div class="col mt-5">
            <div class="card">

                <div class="card-header text-left h5">New Messages</div>
                <div class="card-body">
                <ul class="list-group list-group-flush">
                        @if(count($messages) > 0)
                        @foreach($messages as $message)
                        <li class="list-group-item text-truncate" style="max-width: 400px;">
                            <a href="messages/chat?selectedUser={{ $message->sender->id }}">
                                {{ $message->sender->first_name }}: 
                            </a> {{ $message->line_text }}</span>
                            
                        </li>
                        @endforeach
                        @else
                            You have no new messages
                        @endif
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection