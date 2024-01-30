<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

Route::prefix('admin')->middleware('auth:adminapi,userapi')->group(function(){
    Route::apiResource('product',ProductController::class);
    Route::post('product/search',[ProductController::class,'search']);
});