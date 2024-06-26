<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceRoomController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::middleware('auth:sanctum')->group( function (){
    Route::apiResource('/rol',RolController::class);
    Route::apiResource('/reservation',ReservationController::class);
    
    Route::apiResource('/service',ServiceController::class);
    Route::apiResource('/service_room',ServiceRoomController::class);
    Route::post('room/update/{id}',[RoomController::class,'update']);
    Route::post('service/update/{id}',[ServiceController::class,'update']);
});

Route::apiResource('/room',RoomController::class);
Route::apiResource('/user',UserController::class);


Route::post('/login',[AuthController::class,'login']);

//! token importante