<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);
Route::post('login', [AuthController::class, 'login']);

//Route::resource('message', UserController::class);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('messages/chat', [App\Http\Controllers\MessageController::class, 'chat']);
Route::post('messages/chatted_users', [App\Http\Controllers\MessageController::class, 'getChatedUsers']);
Route::post('messages/send', [App\Http\Controllers\MessageController::class, 'store']);

Route::post('users/all', [User::class, 'all']);

//Route::post('schedules/deleteEvent/{id}', App\Http\Controllers\ScheduleController::class);
Route::apiResource('schedules', App\Http\Controllers\ScheduleController::class);


//Route::apiResource('messages', App\Http\Controllers\MessageController::class);

// Route::group(['middleware' => ['auth:sanctum']], function(){
//     //Route::resource('messages', App\Http\Controllers\Api\MessageController::class);
// });

