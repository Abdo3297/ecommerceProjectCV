<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\Admin\LogoutController;
use App\Http\Controllers\Auth\Admin\SigninController;
use App\Http\Controllers\Auth\Admin\ProfileController;
use App\Http\Controllers\Auth\Admin\ResendOTPController;
use App\Http\Controllers\Auth\Admin\DeleteProfileController;
use App\Http\Controllers\Auth\Admin\ResetPasswordController;
use App\Http\Controllers\Auth\Admin\UpdateProfileController;
use App\Http\Controllers\Auth\Admin\ChangePasswordController;
use App\Http\Controllers\Auth\Admin\ForgetPasswordController;

Route::prefix('admin')->group(function () {
    Route::post('signin', SigninController::class);
    Route::post('forget_password', ForgetPasswordController::class);
    Route::post('reset_password', ResetPasswordController::class);
    Route::post('resend_otp', ResendOTPController::class);
});
Route::middleware('auth:adminapi')->prefix('admin')->group(function () {
    Route::get('get_profile', ProfileController::class);
    Route::post('logout', LogoutController::class);
    Route::delete('delete_profile', DeleteProfileController::class);
    Route::put('update_profile', UpdateProfileController::class);
    Route::post('change_password', ChangePasswordController::class);
});
