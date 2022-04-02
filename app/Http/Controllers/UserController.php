<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

use \Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth:sanctum', ['except' => []]);
        $this->middleware('is_admin', ['except' => []]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all();

            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('group', function($user){
                    return $user->group["name"];
                })
                ->addColumn('action', function ($user) {
                    $btnDelete = '<form method="post" action="';
                    $btnDelete .= action([\App\Http\Controllers\UserController::class,'destroy'],  ['user' => $user->id]);
                    $btnDelete .= '">';
                    $btnDelete .= csrf_field();
                    $btnDelete .= method_field('DELETE');
                    $btnDelete .= '<input class="btn btn-danger btn-sm float-right" type="submit" name="submit" value="Delete" onclick="return confirm(\'Are you Sure you want to delete this user?\')">';
                    $btnDelete .= "</form>";

                    $btnEdit = '<a class="btn btn-secondary btn-sm mr-2 float-left" href="';
                    $btnEdit .= action([\App\Http\Controllers\UserController::class, 'edit'], ['user' => $user->id]);
                    $btnEdit .= '"> Edit </a>';

                    return $btnEdit . $btnDelete;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('user.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $groups = Group::all();
        return view('user.edit', ['user' => $user, 'groups' => $groups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //dd($request->all());
        $user->update($request->all());

        return redirect()->route('users.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        Alert::toast('deleted ' . $user->first_name, 'success');

        return redirect()->route('users.index');
    }

    // public function all(){
    //     // return response([
    //     //     "allUsers" => User::all()->except(auth()->user()->id),
    //     //     "currentUser" => auth()->user()->id,
    //     // ]);
    // }
}
