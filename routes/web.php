<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Auth::routes();


Route::get('users/profile', [App\Http\Controllers\UserController::class, 'profile']);
Route::post('users/upload_image', [App\Http\Controllers\UserController::class, 'uploadImage']);
Route::resource('users', App\Http\Controllers\UserController::class);


Route::resource('schedules', App\Http\Controllers\ScheduleController::class);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('messages/chat', [App\Http\Controllers\MessageController::class, 'chat']);
Route::resource('messages', App\Http\Controllers\MessageController::class);



//Route::get('schedules/deleteEvent/{id}', [App\Http\Controllers\ScheduleController::class, 'deleteEvent']);
// Route::post('schedules/action', [App\Http\Controllers\ScheduleController::class, 'action']);



Route::resource('files', App\Http\Controllers\FileController::class);

Route::resource('groups', App\Http\Controllers\GroupController::class);

Route::resource('settings', App\Http\Controllers\SettingController::class);



//Route::get('messages/chat', [App\Http\Controllers\MessageController::class, 'chat']);
//Route::get('/messages/start', [App\Http\Controllers\MessageController::class, 'start']);


