<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

Route::middleware(['auth:adminapi','auth:userapi'])->group(function(){
    Route::apiResource('product',ProductController::class);
});