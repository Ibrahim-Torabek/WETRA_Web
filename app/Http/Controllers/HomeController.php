<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Message;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        //$this->middleware('verified');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $publicFiles = File::where('shared_to', '0')
            ->orderBy('id', 'desc')
            ->take(2)
            ->get();

        $personalFiles = File::where('shared_to', Auth::id())
            ->orderBy('id', 'desc')
            ->take(2)
            ->get();



        $today = Carbon::now()->format('Y-m-d 00:00:00');
        $tomorrow = Carbon::now()->addDays(1)->format('Y-m-d 00:00:00');
        $dayTasks = Task::where('start', '>=', $today)
            ->where('end', '<', $tomorrow)
            ->orderBy('start','asc')
            ->get();

        
        $week = Carbon::now()->addDays(7)->format('Y-m-d 00:00:00');
        $weekTasks = Task::where('start', '>=', $tomorrow)
            ->where('end', '<', $week)
            ->orderBy('start','asc')
            ->get();

        $messages = Message::where('receiver_id', Auth::id())
            ->take(7)
            ->orderBy('created_at','desc')
            ->get();

        Log::debug(json_decode($messages));
        return view('home', [
            'publicFiles' => $publicFiles,
            'personalFiles' => $personalFiles,
            'dayTasks' => $dayTasks,
            'weekTasks' => $weekTasks,
            'messages' => $messages,
        ]);
    }
}
