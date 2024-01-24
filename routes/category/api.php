<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:adminapi')->group(function(){
    Route::apiResource('category',CategoryController::class);
});
