<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\CategoryController;

Route::prefix('admin')->middleware('auth:adminapi')->group(function(){
    Route::apiResource('category',CategoryController::class);
    Route::post('category/search',[CategoryController::class,'search']);
});
