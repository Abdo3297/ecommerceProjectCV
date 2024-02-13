<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Order\OrderController;

Route::prefix('user')->middleware('auth:userapi')->group(function(){
    Route::apiResource('order',OrderController::class);
});