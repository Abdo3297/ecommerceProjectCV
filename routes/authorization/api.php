<?php

use App\Http\Controllers\Authorization\Admin\MappingController;
use App\Http\Controllers\Authorization\Admin\PermissionController;
use App\Http\Controllers\Authorization\Admin\RoleController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:adminapi')->group(function(){
    Route::apiResource('permissions', PermissionController::class);
    Route::apiResource('roles', RoleController::class);
    Route::post('assignPermissionsToRole', [MappingController::class, 'assignPermissionsToRole']);
    Route::post('revokePermissionsFromRole', [MappingController::class, 'revokePermissionsFromRole']);
});