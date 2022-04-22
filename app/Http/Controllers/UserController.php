<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use \Yajra\DataTables\DataTables;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth:sanctum', ['except' => []]);
        $this->middleware('is_admin', ['except' => ['profile', 'update','uploadImage','settings','pending']]);
        $this->middleware('is_pending', ['except' => ['profile', 'update','uploadImage','settings', 'pending']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::all();
        if ($request->ajax()) {
            

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

        if($request->wantsJson()){
            return response()->json($users);
        }
        
        return view('user.index');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        if($request->wantsJson()){
            return response()->json($user);
        }
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

        if($request->wantsJson()){
            return response()->json(
                ["Message" => "Success"]
            );
        }

        Alert::toast('Profile Saved successfully', 'success');
        return redirect()->back(); //route('users.show', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {

        $messages = Message::where('receiver_id', $user->id)
                            ->orWhere('sender_id', $user->id)
                            ->delete();

        $user->settings()->delete();
        $user->delete();
        if($request->wantsJson()){
            return response()->json(["Message" => "Success"]);
        }
        Alert::toast('deleted ' . $user->first_name, 'success');

        return redirect()->route('users.index');
    }

    /**
     * Display profile page
     */
    public function profile(){

        return view('user.profile');
    }

    /**
     * Display setting page
     */
    public function settings(){

        return view('user.settings');
    }

    /**
     * Display pending page
     */
    public function pending()
    {
        return view('auth.pending');
    }

    /**
     * Upload user avatar
     */
    public function uploadImage(Request $request){
        
        $user = User::findOrFail(Auth::id());

        if($request->update == 'deleteImage'){
            
            $user->image_url = NULL;
            $user->update();

            return response()->json(['delete' => 'success']);
        }

        if ($request->hasFile('file')) {
            $fileNameWithExt = $request->file('file')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extention = $request->file('file')->getClientOriginalExtension();
            $nameToStore = $fileName . '_' . time() . '.' . $extention;

            $filePath = $request->file->storeAs('public/avatar',$nameToStore);

            //TODO: Change the sub folder. My wetra url ha wetra subfolder. it couase the mass of file url.
            $fileURL = '/wetra' . Storage::url($filePath);
            //dd($fileURL);

            $fileArray = $request->all();
            $fileArray["file_name"] = $fileName;
            $fileArray["file_extention"] = $extention;
            $fileArray["file_url"] = $fileURL;
            $fileArray["uploaded_by"] = Auth::id();

            

            $user->image_url = $fileURL;
            $user->update();
            

            return response()->json(['fileUrl' => $fileURL]);
            
        } else {
            
            return response()->json(['error' => 'File not found']);
        }
    }
}
