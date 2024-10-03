<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->group(function (){
    Route::prefix('auth')->group(function (){
       Route::post('/login' , [AuthController::class , 'login']);
        Route::post('/logout' , [AuthController::class , 'logout'])->middleware(['auth:sanctum']);
    });
    Route::middleware(['auth:sanctum'])->group(function (){
        Route::middleware(['role:super_admin'])->group(function (){
            Route::prefix('account')->group(function (){
                Route::post('/createSuperAdmin' , [UserController::class , 'createSuperAdmin']);
            });
        });

//        Route::middleware(['role' => 'restaurant'])->group(function (){
//
//        });

    });
});
