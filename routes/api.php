<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RestaurantController;
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
            Route::prefix('restaurants')->group(function (){
                Route::get('/all' , [RestaurantController::class , 'getAll']);
                Route::get('/show/{restaurant}' , [RestaurantController::class , 'show']);
                Route::post('/create' , [RestaurantController::class , 'createRes']);
                Route::post('/update/{restaurant}' , [RestaurantController::class , 'editRes']);
                Route::delete('/delete/{restaurant}' , [RestaurantController::class , 'deleteRes']);
                Route::post('/renewSubscription/{restaurant}' , [RestaurantController::class , 'renewSubscription']);
                Route::post('/updateLogoOrCover/{restaurant}' , [RestaurantController::class , 'updateLogoOrCover']);
                Route::patch('/resetPassword/{user}' , [RestaurantController::class , 'generateNewPassword']);
                Route::post('/addTranslations/{restaurant}' , [RestaurantController::class , 'addTranslations']);
            });
        });
        Route::middleware(['role:super_admin|admin'])->group(function (){
            Route::prefix('/categories')->group(function (){
                Route::get('/all' , [CategoryController::class , 'getAll']);
                Route::get('/show/{category}' , [CategoryController::class , 'show']);
                Route::post('/create' , [CategoryController::class , 'create']);
                Route::post('/update/{category}' , [CategoryController::class , 'update']);
                Route::delete('/delete/{category}', [CategoryController::class , 'delete']);
                Route::post('/createTranslations' , [CategoryController::class , 'createTranslations']);
            });
        });

    });
});
