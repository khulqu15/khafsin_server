<?php

use App\Http\Controllers\ImuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return redirect('/imu');
});
Route::resource('imu', ImuController::class)->names('imu-web');
Route::get('imus/export', [ImuController::class, 'export'])->name('imu-web.export');
Route::delete('imus/delete-all', [ImuController::class, 'deleteAll'])->name('imu-web.delete-all');
Route::delete('imus/delete-selected', [ImuController::class, 'deleteSelected'])->name('imu-web.delete-selected');

