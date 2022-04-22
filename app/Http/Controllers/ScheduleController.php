<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Task;
use App\Models\User;
use App\Models\Group;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\Schedule;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ScheduleController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth:sanctum', ['except' => []]);
        $this->middleware('is_pending');
        $this->middleware('verified');
    }

    /**
     * Display all events and tasks for admin user
     * Display all public, group or personal events and tasks for regular user
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        
        if ($request->ajax() || $request->wantsJson()) {
            if (Auth::user()->is_admin == 1) {
                $events = Event::latest()->get();
                $tasks = Task::latest()->get();
            } else {
                $events = Event::where('assigned_to', Auth::id())
                    ->orWhere('assigned_to', '0') // Public
                    ->get();


                $tasks = Task::where('assigned_to', Auth::id())
                    ->orWhere('assigned_to', '0') //Public
                    ->orWhere('is_group', "1") 
                    ->where('assigned_to', Auth::user()->group->id)
                    ->get();
            }
            
            return response()->json($events->merge($tasks));
        }

        $users = User::all();
        $day = null;
        if ($request->has('day')) {
            $day = $request->all()['day'];
        }
        return view('schedule.index', ['users' => $users, 'day' => $day]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        
        $assignedTo = $request->all()['assigned_to'];
        $isGroup = $request->all()['is_group'] ?? null;
        // return ['Debug'];
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'assigned_to'  => 'required',
        ]);

        if ($validator->failed()) {
            //dd($request);
            //return redirect()->back();
            //Alert::toast('Error: ' . $validator, 'alert');
        }


        
        $requestArray = $request->all();
        $requestArray["assigned_by"] = Auth::id();

        // Has id means create event, else update event.
        if (empty($requestArray["id"])) {
            switch ($requestArray["scheduleType"]) {
                case 'task':
                    // Add 30 minutes to the start time.
                    $requestArray["end"] = Carbon::parse($requestArray["start"])->addMinutes(30)->format('Y-m-d H:i:s');
                    $task = Task::create($requestArray);
                    
                    if ($assignedTo == 0) {  // all members
                        $users = User::all();
                    } else if ($isGroup) {
                        $users = Group::find($assignedTo)->users;
                    } else {
                        $user = User::find($assignedTo);
                    }

                    if (!empty($user)) {
                        $this->triggerEvent($user, $task);
                    }
                    if (!empty($users)) {
                        foreach ($users as $user) {
                            $this->triggerEvent($user, $task);
                        }
                    }
                    break;

                default:
                    Event::create($requestArray);
            }


            if ($request->wantsJson()) {
                return response()->json(["Message" => "Created successfully"]);
            }
        } else {
            switch ($requestArray["scheduleType"]) {
                case 'task':
                    $task = Task::findOrFail($requestArray['id']);
                    $requestArray["end"] = Carbon::parse($requestArray["start"])->addMinutes(30)->format('Y-m-d H:i:s');
                    if (!empty($task)) {
                        $task->update($requestArray);
                        if ($request->wantsJson()) {
                            return response()->json(["Message" => "Updated successfully"]);
                        }
                    }
                    break;

                default:
                    $event = Event::findOrFail($requestArray['id']);
                    if (!empty($event)) {
                        $event->update($requestArray);
                        if ($request->wantsJson()) {
                            return response()->json(["Message" => "Updated successfully"]);
                        }
                    }
                    break;
            }
        }

        return redirect()->back();
    }

    /**
     * Trigger an event for related users when a task created.
     */
    function triggerEvent(User $user, Task $task)
    {
        $settings = User::find($user->id)->settings;
        if (empty($settings)) {
            $user->settings()->create();
            
        }
        if ($user->settings->new_schedule == 1) {
            event(
                new Schedule(
                    $user->id,
                    Auth::id(),
                    Carbon::parse($task['start'])->format('Y-m-d')
                )
            );
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        // return;
        $id = $request->all()["id"];
        $task = Task::findOrFail($id);
        switch ($request->all()["taskStatus"]) {
            case "completed":
                $task->is_completed = true;
                $task->request_time_off_id = 0;
                $task->confirm_time_off_id = 0;
                break;

            case "requestTimeOff":
                $task->request_time_off_id = Auth::id();
                break;

            case 'confirmTimeOff':
                $task->confirm_time_off_id = Auth::id();
                break;

            case 'rejectTimeOff':
                $task->request_time_off_id = 0;
                $task->confirm_time_off_id = 0;
        }
        $task->update();

        if ($request->ajax()) {
            return response()->json($task);
        }

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        
        // return;
        if ($request->wantsJson() || $request->ajax()) {
            switch ($request["scheduleType"]) {
                case 'task':

                    $task = Task::find($request->id);
                    
                    if (!empty($task)) {
                        $task->delete();
                        return response()->json($task);
                    }
                    break;
                default:
                    $event = Event::find($request->id);
                    
                    if (!empty($event)) {
                        $event->delete();
                        return response()->json($event);
                    }
            }

            return response()->json(["Message" => "Event not found"]);
        }
    }

}
