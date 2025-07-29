<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RestaurantController;

Route::resource('restaurants', RestaurantController::class);
