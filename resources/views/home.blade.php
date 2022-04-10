@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">

        <!-- Card on the left to display some last uploaded Files -->
        <div class="col mt-5">
            <div class="card">
                <div class="card-header text-left h5">Files</div>
                <div class="card-body">
                    <!-- TO DO: display recent uploaded files, if they are-->
                    <div class="card">
                        <div class="card-body">
                            File info goes here
                        </div>
                    </div>
                    <div class="card mt-2">
                        <div class="card-body">
                            File info goes here
                        </div>
                    </div>
                    <!-- Button to go to Files page -->
                    <div class="row text-center">
                        <div class="mt-4">
                            <a class="btn btn-primary btn-lg" href="{{ url('/files') }}" role="button">{{ __('See My Files') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  
        <!-- Card in the center showing the tasks for today and the following week -->
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
                    <h5 class="text-center pt-1">You have 2 tasks today.</h5>

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
                                <tr>
                                    <td scope="row">Time 1</td>
                                    <td>Task 1</td>
                                    <td>Completed/Not completed.</td>
                                </tr>
                                <tr>
                                    <td scope="row">Time 2</td>
                                    <td>Task 2</td>
                                    <td>Completed/Not completed</td>
                                </tr>   
                            </tbody> 
                        </table> 
                    </div>
            
                    <!-- Table to display user tasks for a week -->
                    <div class="pt-2 table-responsive">
                        <h5 class="text-left pt-1"><strong>My tasks for the following week - {{ date('l, M d, Y,', strtotime('+1 Day')) }} to {{ date('l, M d, Y', strtotime('+1 Week')) }}.</strong></h5> 
                        
                        <table class="table table-hover table-striped">
                            <thead class="text-light" style="background-color:#620227;">
                                <tr>
                                    <th scope="col">Time</th>
                                    <th scope="col">Task</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- TO DO: set tasks in the rows to display for each week's task -->
                                <tr>
                                    <td scope="row">Time 1</td>
                                    <td>Task 1</td>
                                    <td>Completed/Not completed.</td>
                                    <td><button type="button" class="btn btn-primary float-right" id="submit-task">Request Time Off</button></td>
                                </tr>
                                <tr>
                                    <td scope="row">Time 2</td>
                                    <td>Task 2</td>
                                    <td>Completed/Not completed</td>
                                    <td><button type="button" class="btn btn-primary float-right" id="submit-task">Request Time Off</button></td>
                                </tr>   
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

        <!-- Card on the right to display new Messages -->
        <div class="col mt-5">
            <div class="card">
                
                <div class="card-header text-left h5">Messages</div>
                <div class="card-body">
                    <!-- TO DO: display recent messages or how many new messages, if they are -->
                    Messages' information goes here 
                </div>
            </div>
        </div>

    </div>
</div>
@endsection