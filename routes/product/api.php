<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\ProductController;

// Route::prefix('admin')->middleware('auth:adminapi,userapi')->group(function(){
//     Route::apiResource('product',ProductController::class);
//     Route::post('product/search',[ProductController::class,'search']);
// });
Route::middleware('auth:adminapi,userapi')->group(function(){
    Route::post('{userType}/product/search',[ProductController::class,'search'])->where('userType', 'admin|user');
});

Route::prefix('admin')->group(function(){
    Route::apiResource('product',ProductController::class)->middleware('auth:adminapi');
});

Route::prefix('user')->group(function(){
    Route::apiResource('product',ProductController::class)->middleware('auth:userapi');
});