<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;

class ScheduleController extends Controller
{
    public function __construct()
    {

        $this->middleware('auth:sanctum', ['except' => []]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->ajax() || $request->wantsJson()) {
            if (Auth::user()->is_admin == 1) {
                $events = Event::latest()->get();
            } else {
                $events = Event::where('assigned_to', Auth::id())->orWhere('assigned_to', '0')->get();
            }
            //dd($data);
            return response()->json($events);
        }

        $users = User::all();
        return view('schedule.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()`
    // {
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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


        //dd($request);
        $requestArray = $request->all();
        $requestArray["assigned_by"] = Auth::id();
        $requestArray["description"] = "No Descripition";



        // Has id means create event, else update event.
        if (empty($requestArray["id"])) {
            //dd($request);
            //Alert::toast('Empty: ' . $validator->errors(), 'alert');
            Event::create($requestArray);
            if ($request->wantsJson()) {
                return response()->json(["Message" => "Created successfully"]);
            }
            // if ($request->ajax()){
            //     return response()-json(["Message" => "Created successfully"]);
            // }
        } else {
            //dd($request);
            // Event::where('id',$request["id"])->update($request);
            $event = Event::findOrFail($requestArray['id']);
            if (!empty($event)) {
                $event->update($requestArray);
                if ($request->wantsJson()) {
                    return response()->json(["Message" => "Updated successfully"]);
                }
            }
        }


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //return redirect()->back();
        
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->wantsJson()) {
            $event = Event::findOrFail($request['id']);
            $event->update($request->all());
            return response()->json($event);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->wantsJson() || $request->ajax()) {
            $event = Event::find($request->id);
            if (!empty($event)) {
                $event->delete();
                return response()->json($event);
            }
            return response()->json(["Message" => "Event not found"]);
        }
    }



    // public function deleteEvent($id)
    // {

    //     //dd(Event::findOrFail($id));
    //     Event::findOrFail($id)->delete();

    //     return redirect()->back();
    // }
}
