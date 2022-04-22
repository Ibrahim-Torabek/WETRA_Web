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

    /**
     * Return all groups
     */
    public function all(){
        return Group::all();
    }


    /**
     * Store a newly created group in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        Group::create($request->all());
        if($request->wantsJson()){
            return response()->json(["success" => "created"]);
        }
        return redirect()->back();
        
    }


    /**
     * Update the specified group in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        
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
        // Get all users blong to deleting forup
        $users = User::where('group_id', $group->id)->get();
        
        // Set all users belong to this group as 0 (Pending)
        foreach($users as $user){
            $user->group_id = 0;
            $user->save();
        }
        $group->delete();
        
        if($request->wantsJson()){
            return response()->json(["success" => "Deleted successfully"]);
        }

        return redirect()->back();
    }
}
