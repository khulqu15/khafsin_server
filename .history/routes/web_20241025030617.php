<?php

use App\Http\Controllers\ImuController;
use Illuminate\Support\Facades\Route;

Route::resource('imu', ImuController::class);
