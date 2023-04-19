<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| Loaded by the RouteServiceProvider and assigned to the "api" middleware group
|
| @see https://laravel.com/docs/10.x/routing
| @see https://laravel.com/docs/10.x/middleware
| @see https://laravel.com/docs/10.x/controllers#api-resource-routes
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
Route::get($uri, $callback);
Route::post($uri, $callback);
Route::put($uri, $callback);
Route::patch($uri, $callback);
Route::delete($uri, $callback);
Route::options($uri, $callback);
*/
