<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class StorageController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth:sanctum', ['except' => []]);
        $this->middleware('is_pending');
        $this->middleware('verified');
    }
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function __invoke(Request $request, $path)
    // {
    //     Log::debug("Path:" . $path . $request);
    //     // abourt_if(
    //     //     ! Storage::disk('upload') ->exists($path),
    //     //     404,
    //     //     "The file doesn't exist. Check the path"
    //     // );

    //     // return Storage::disk('upload')->response($path);
    // }

    public function index($path){
        Log::debug($path);
        return Storage::disk('upload')->response($path);
    }
}
