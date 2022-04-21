<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use PHPUnit\TextUI\XmlConfiguration\Group;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groups = Group::all();
        
        if($request->wantsJson())
            return $groups;
    }

    public function all(){
        return Group::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        Group::create($request->all());
        if($request->wantsJson()){
            return response()->json(["success" => "created"]);
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
    public function update(Request $request, Group $group)
    {
        //Log::debug($request);
        $group = $group->update($request->all());
        
        if($request->wantsJson()){
            if($group)
                return response()->json(["success" => "Group name updated successfully."]);
            else{
                return response()->json(["fail" => "Failed to update group name."]);
            }
        }
        //return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Group $group)
    {
        $users = User::where('group_id', $group->id)->get();
        Log::debug($users);
        foreach($users as $user){
            $user->group_id = 0;
            $user->save();
        }
        $result = $group->delete();
        
        if($request->wantsJson()){
            return response()->json(["success" => "Deleted successfully"]);
        }

        return redirect()->back();
    }
}
