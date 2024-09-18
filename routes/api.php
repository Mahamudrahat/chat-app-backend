<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Broadcast;
use App\Http\Controllers\API\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/send-message', [MessageController::class, 'sendMessage']);
Route::post('/register', 'App\Http\Controllers\API\UserController@registerUser');
Route::post('/login', 'App\Http\Controllers\API\UserController@loginUser')->middleware('throttle:120,1');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->group(function(){
  Route::get('/all-user-info',[UserController::class,'index']);
});





// Register the broadcasting routes with the appropriate middleware
Route::middleware('auth:api')->post('/broadcasting/auth', function (Request $request) {
    return Broadcast::auth($request);
});
