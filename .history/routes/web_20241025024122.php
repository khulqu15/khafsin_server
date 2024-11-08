<?php

use App\Http\Controllers\ImuController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ImuController::class, 'home']);
