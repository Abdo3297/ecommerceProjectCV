<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:adminapi')->group(function(){
    Route::apiResource('product',ProductController::class);
});