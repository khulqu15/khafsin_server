<?php

use App\Http\Controllers\ImuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect('/imu');
});
Route::resource('imu', ImuController::class);
