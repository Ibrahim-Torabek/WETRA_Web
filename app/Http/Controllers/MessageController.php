<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use App\Events\Chat;
use App\Models\Group;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth:sanctum', ['except' => []]);
        $this->middleware('is_pending');
        $this->middleware('verified');
    }

    /**
     * Function that get all chated users for current user
     */
    public function getChatedUsers()
    {
        $sent = Auth::user()->sentMessages->unique('receiver_id')->except(Auth::id());;
        $received = Auth::user()->receivedMessages->unique('sender_id')->except(Auth::id());;

        $allLines = $sent->merge($received)->sortBy('created_at');

        $chatedUsers = collect(new User);

        //dd($chatedUsers);
        foreach ($allLines as $line) {
            $user = $line->sender_id == Auth::id() ? User::find($line->receiver_id) : User::find($line->sender_id);
            if (!empty($user)) {
                if ($user->id != Auth::id()){
                    $unreadMessage = Message::where('sender_id', $user->id)
                                        ->where('receiver_id', Auth::id())
                                        ->where('is_read', 0)
                                        ->orderBy('created_at', 'desc')
                                        ->first();
                    
                    $user['message'] = $unreadMessage['line_text'];
                    if(!empty($unreadMessage))
                        $user['un_read'] = 1;
                    $chatedUsers->push($user);
                }
            }
        }

        $chatedUsers = $chatedUsers->unique('email');

        return $chatedUsers;
    }

    /**
     * API Function that get all chated users for current user
     */
    public function getChatedUsersAPI()
    {
        $sent = Auth::user()->sentMessages->unique('receiver_id')->except(Auth::id());;
        $received = Auth::user()->receivedMessages->unique('sender_id')->except(Auth::id());;

        $allLines = $sent->merge($received)->sortBy('created_at');

        $chatedUsers = []; //collect(new User);
        //dd($chatedUsers);
        foreach ($allLines as $line) {
            $user = $line->sender_id == Auth::id() ? User::find($line->receiver_id) : User::find($line->sender_id);
            if (!empty($user)) {
                //if ($user->id != Auth::id())
                // $chatedUsers->push($user);
                if (!in_array($user, $chatedUsers))
                    array_push($chatedUsers, $user);
            }
        }

        return $chatedUsers;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $messages = Message::where('receiver_id', Auth::id())
            ->where('is_read', 0)
            ->orderBy('created_at','desc')
            ->get();
        return view('message.index',['messages' => $messages]); //, ['chatedUsers' => $chatedUsers]);
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
        return view('message.start', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        //return $request;
        $requestArray = $request->all();

        if ($request->has('group')) {
            $group = Group::find($requestArray["group"]);
            foreach ($group->users as $user) {
                //$user = User::find($user->id);
                $message = new Message();

                $message->line_text ="Group Message: " . $requestArray["chatText"];
                $message->sender_id = Auth::id();
                $message->receiver_id = $user->id;
                $message->is_read = false;
                $message->save();
                
                $settings = User::find($user->id)->settings;
                if(empty($settings)){
                    $user->settings()->create();  
                    
                }
                
                if($settings->new_message == 1){
                    
                    event(
                        new Chat(
                            $user->id,
                            Auth::id(),
                            $message->line_text
                        )
                    );
                }
            }
            return;
        } else {
            //dd($requestAray);
            $message = new Message();

            $message->line_text = $requestArray["chatText"];
            $message->sender_id = Auth::id();
            $message->receiver_id = $requestArray["receiver"];
            $message->is_read = false;
            $message->save();

            $receiver = User::find($requestArray["receiver"]);
            $settings = $receiver->settings;
            
            if(empty($settings)){
                $receiver->settings()->create();  
                
            } 
            
            if($settings->new_message == 1){
                event(
                    new Chat(
                        $requestArray["receiver"],
                        Auth::id(),
                        $requestArray["chatText"]
                    )
                );
            }

        }

        //return view('message.chat',['selectedUser' => $selectedUser]);
        if ($request->wantsJson()) {
            return response([
                "success" => true
            ]);
        }
        //

        return redirect()->back();
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
    public function chat(Request $request)
    {


        if (!empty($request->all()["selectedUser"])) {
            // Get selected user's id from requestAray$requestAray collection
            $userId = $request->all()["selectedUser"];


            // Find user by Id, and get the first element from the results set.
            $selectedUser = User::find($userId);

            // Get all chat lines current user sent to selected user
            $sent = Auth::user()->sentMessages->where('receiver_id', $userId);

            // Get all chat lines that current user received from the selected user
            $received = Auth::user()->receivedMessages->where('sender_id', $userId);
            foreach($received as $message){
                $message->is_read = 1;
                $message->save();
            }

            // merge and sort by created date
            $allMessages = $sent->merge($received);
            $allMessages = $allMessages->sortBy('created_at');


            if ($request->wantsJson()) {
                $temp = [];
                foreach ($allMessages as $message) {
                    //Log::debug($message->toArray());
                    array_push($temp, [
                        "id" => $message->id,
                        "line_text" => $message->line_text,
                        "sender_id" => $message->sender_id,
                        "receiver_id" => $message->receiver_id,
                        "image_url" => $message->image_url,
                        "is_read" => $message->is_read
                    ]);
                }
                

                return response()->json($temp);
            } else {

                return view('message.chat', ['selectedUser' => $selectedUser, 'chatLines' => $allMessages]);
            }
        }

        $groupId = $request->all()["selectedGroup"];
        $selectedGroup = Group::find($groupId);
        return view('message.chat', ['selectedGroup' => $selectedGroup]);
    }
}
