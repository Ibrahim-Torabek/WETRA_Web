<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/**
 * Controller for files.
 * If user logged in, open the file for user. 
 */
class StorageController extends Controller
{
    public function __construct()
    {
        
        $this->middleware('auth:sanctum', ['except' => []]);
        $this->middleware('is_pending');
        $this->middleware('verified');
    }


    public function index($path){
        
        return Storage::disk('upload')->response($path);
    }
}
