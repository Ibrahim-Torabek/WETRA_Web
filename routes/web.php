<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('messages/chat', [App\Http\Controllers\MessageController::class, 'chat']);
Route::resource('messages', App\Http\Controllers\MessageController::class);


Route::get('schedules/allevents', [App\Http\Controllers\ScheduleController::class, 'allEvents']);
Route::get('schedules/deleteEvent/{id}', [App\Http\Controllers\ScheduleController::class, 'deleteEvent']);
Route::resource('schedules', App\Http\Controllers\ScheduleController::class);

//Route::get('messages/chat', [App\Http\Controllers\MessageController::class, 'chat']);
//Route::get('/messages/start', [App\Http\Controllers\MessageController::class, 'start']);


