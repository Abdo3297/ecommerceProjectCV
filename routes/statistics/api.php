<?php

use App\Http\Controllers\Statistics\StatisticsController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->middleware(['auth:adminapi'])->group(function(){
    Route::get('showStatistics',StatisticsController::class);
});