<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

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

        if ($request) {
            //dd($request);
        }

        if ($request->ajax()) {
            $data = Event::whereDate('event_start_date', '>=', $request->start)
                ->whereDate('event_end_date', '<=', $request->end)
                ->get(['id', 'title', 'start', 'end']);

            dd($data);
            return response()->json($data);
        }

        $users = User::all();
        return view('schedule.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'assigned_to'  => 'required',
        ]);

        if ($validator->failed()) {
            dd($request);
            return redirect()->back();
        }


        //dd($request);
        $request = $request->all();
        $request["assigned_by"] = Auth::id();
        $request["description"] = "No Descripition";


        
        if (empty($request["id"])) {
            //dd($request);
            Event::create($request);
        } else {
            //dd($request);
            // Event::where('id',$request["id"])->update($request);
            $event = Event::findOrFail($request['id']);
            $event->update($request);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function allEvents()
    {
        $events = Event::latest()->get();
        return response()->json($events, 200);
    }
}
