<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::post('/login', [\App\Http\Controllers\api\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\api\AuthController::class, 'register']);
Route::middleware('auth:sanctum')->group(
    function () {
        Route::get('/info', [\App\Http\Controllers\api\AuthController::class, 'getUserInfo']);
        Route::post('/logout', [\App\Http\Controllers\api\AuthController::class, 'logout']);
        Route::get('/users', [\App\Http\Controllers\api\AuthController::class, 'index']);
        Route::delete('/users/delete', [\App\Http\Controllers\api\AuthController::class, 'destroy']);
        Route::delete('/users/store', [\App\Http\Controllers\api\AuthController::class, 'register']);
    }
);

//Route::middleware('auth:api')->group(function () {
//    Route::get('/info', [\App\Http\Controllers\api\AuthController::class, 'getUserInfo']);
//});
