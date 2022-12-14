<?php

use App\Http\Controllers\v1\AuthController;
use App\Http\Controllers\v1\RoleController;
use App\Http\Controllers\v1\UserController;
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

Route::prefix('v1')->group(function(){

    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    
    
    Route::middleware(['auth:sanctum'])->group(function(){

        Route::post('/me',[AuthController::class,'me']);
        Route::post('/logout',[AuthController::class,'logout']);

        Route::apiResource('/role',RoleController::class);
        Route::post('/assign-role',[RoleController::class, 'assign_role']);

        Route::apiResource('/user',UserController::class);
    });
});


