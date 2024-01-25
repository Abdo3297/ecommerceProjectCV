<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Category\CategoryController;

Route::middleware('auth:adminapi')->group(function(){
    Route::apiResource('category',CategoryController::class);
});
