<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

Route::apiResource('restaurants', RestaurantController::class);

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::post('register', 'AuthenticationController@register')->name('register');
    Route::post('login', 'AuthenticationController@login')->name('login');
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('restaurants', RestaurantController::class);
        Route::post('logout', 'AuthenticationController@logOut')->name('logout');
    });
});