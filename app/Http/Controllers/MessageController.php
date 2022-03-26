<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;


class MessageController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('auth:sanctum', ['except' => []]);
    }

    // Function that get all chated users for current user
    public function getChatedUsers(){
        $sent = Auth::user()->sentMessages->unique('receiver_id')->except(Auth::id());;
        $received = Auth::user()->receivedMessages->unique('sender_id')->except(Auth::id());;

        $allLines = $sent->merge($received)->sortBy('created_at');
        
        $chatedUsers = collect(new User);
        //dd($chatedUsers);
        foreach($allLines as $line){
            $user = $line->sender_id == Auth::id() ? User::find($line->receiver_id) : User::find($line->sender_id);
            if($user->id != Auth::id())
                $chatedUsers->push($user);
        }

        $chatedUsers = $chatedUsers->unique('email');
        //$chatedUsers->forget(Auth::user()->first_name);

        // if($requestAray->wantsJson()){
        //     return response([
        //         "chatedUsers" => $chatedUsers
        //     ]);
        // }
        return $chatedUsers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$chatedUsers = getChatedUsers();
        //dd($chatedUsers);
        return view('message.index');//, ['chatedUsers' => $chatedUsers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->except(Auth::id());;
        
        //dd($users);
        return view('message.start',['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requestAray
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestAray = $request->all();

        //dd($requestAray);
        $message = new Message();

        $message->line_text = $requestAray["chatText"];
        $message->sender_id = Auth::id();
        $message->receiver_id = $requestAray["receiver"];
        $message->is_read = false;
        $message->save();

        
        //return view('message.chat',['selectedUser' => $selectedUser]);
        if($request->wantsJson()){
            return response([
                "message" => "Chat message to be sent"
            ]);
        }
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        
        return view('message.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $requestAray
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $requestAray, Message $message)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }


    /**
     * List users to start a chat.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function start()
    {
        return view('message.start');
    }

    /**
     * List users to start a chat.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function chat(Request $requestAray)
    {

        //dd($requestAray);
        // return response([
        //     "requestAray$requestAray" => $requestAray
        // ]);

        // Get selected user's id from requestAray$requestAray collection
        $userId = $requestAray->all()["selectedUser"];
        //$userId = $userIds["selectedUser"];
        
        //dd($userId);

        // Find user by Id, and get the first element from the results set.
        $selectedUser = User::find($userId);

        // Get all chat lines for the current user
        // $chatLines1 = Message::where('sender_id', Auth::id())
        //     ->where('receiver_id', $userId)
        //     ->get();

        // Get all chat lines for the selected user
        // $chatLines2 = Message::where('sender_id', $userId)
        //     ->where('receiver_id', Auth::id())
        //     ->get();

        // Merge the two collections and sort by created data
        // $chatLines = $chatLines1->merge($chatLines2);
        // $chatLines = $chatLines->sortBy('created_at');
        //dd($chatLines);

        // Get all users that chatted with the current user 
        // This collection will display left side bar in chat page.

        // Get all chat lines current user sent to selected user
        $sent = Auth::user()->sentMessages->where('receiver_id',$userId);
        
        // Get all chat lines that current user received from the selected user
        $received = Auth::user()->receivedMessages->where('sender_id', $userId);

        // merge and sort by created date
        $allMessages = $sent->merge($received);
        $allMessages = $allMessages->sortBy('created_at');
        //dd($allMessages);

        $users1 = Message::find(1)->reciever;

        //dd($users1);

        if($requestAray->wantsJson()){
            return response([
                'chatLines' => $allMessages
            ], 401);
        } else {
            return view('message.chat',['selectedUser' => $selectedUser, 'chatLines' => $allMessages]);
        }
        
    }

    
}
