<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Loaded by the RouteServiceProvider and assigned to the "web" middleware group
|
| @see https://laravel.com/docs/10.x/routing
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});


/* No Controller */
Route::get('/hello_world', function () {
    return "Hello World!";
});

Route::view('/hello_blade', 'hello', ['name' => request('name','Blade')])->name('hello_blade');

//Route::permanentRedirect('/hello', '/hello_blade');
Route::redirect('/hello', '/hello_blade');

Route::redirect('/', '/hello_blade');


/* InfoController */
// Route::get('/info/date', [InfoController::class, 'get_date'])->name('info_date');
Route::controller(InfoController::class)->group(function () {
    Route::get('/info/request', 'get_request');
    Route::get('/info/date', 'get_date');
});


/* ProductController */
Route::post('/products/index_action', [ProductController::class, 'index_action']);
Route::resource('products', ProductController::class);


