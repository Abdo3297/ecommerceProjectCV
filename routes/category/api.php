<?php

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Category\CategoryController;

// Route::prefix('admin')->middleware('auth:adminapi,userapi')->group(function(){
//     Route::apiResource('category',CategoryController::class);
//     Route::post('category/search',[CategoryController::class,'search']);
// });

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\CategoryController;
Route::middleware('auth:adminapi,userapi')->group(function(){
    Route::post('{userType}/category/search',[CategoryController::class,'search'])->where('userType', 'admin|user');
});

Route::prefix('admin')->group(function(){
    Route::apiResource('category',CategoryController::class)->middleware('auth:adminapi');
});

Route::prefix('user')->group(function(){
    Route::apiResource('category',CategoryController::class)->middleware('auth:userapi');
});