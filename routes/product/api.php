<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

Route::prefix('admin')->middleware(['auth:adminapi'])->group(function(){
    Route::apiResource('product',ProductController::class);
});