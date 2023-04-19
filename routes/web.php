<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InfoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Loaded by the RouteServiceProvider and assigned to the "web" middleware group
|
| @see https://laravel.com/docs/10.x/routing
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello_world', function () {
    return "Hello World!";
});

Route::redirect('/hello', '/hello_world');
//Route::permanentRedirect('/hello', '/hello_world');

Route::view('/hello_blade', 'hello', ['name' => 'User'])->name('hello_blade');

// Route::get('/info/date', [InfoController::class, 'get_date'])->name('info_date');
Route::controller(InfoController::class)->group(function () {
    Route::get('/info/request', 'get_request');
    Route::get('/info/date', 'get_date');
});


