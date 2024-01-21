<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\User\ChangePasswordController;
use App\Http\Controllers\Auth\User\ResendOtpController;
use App\Http\Controllers\Auth\User\GithubController;
use App\Http\Controllers\Auth\User\GoogleController;
use App\Http\Controllers\Auth\User\LogoutController;
use App\Http\Controllers\Auth\User\SigninController;
use App\Http\Controllers\Auth\User\SignupController;
use App\Http\Controllers\Auth\User\ProfileController;
use App\Http\Controllers\Auth\User\DribbbleController;
use App\Http\Controllers\Auth\User\DeleteProfileController;
use App\Http\Controllers\Auth\User\FacebookController;
use App\Http\Controllers\Auth\User\ForgetPasswordController;
use App\Http\Controllers\Auth\User\ResetPasswordController;
use App\Http\Controllers\Auth\User\UpdateProfileController;

Route::prefix('user')->group(function(){
    Route::post('signup',SignupController::class);
    Route::post('signin',SigninController::class);
    Route::post('forget_password',ForgetPasswordController::class);
    Route::post('reset_password',ResetPasswordController::class);
    Route::post('resend_otp',ResendOtpController::class);
});
Route::middleware('auth:userapi')->prefix('user')->group(function(){
    Route::get('get_profile',ProfileController::class);
    Route::delete('delete_profile',DeleteProfileController::class);
    Route::put('update_profile',UpdateProfileController::class);
    Route::post('change_password',ChangePasswordController::class);
    Route::post('logout',LogoutController::class);
});

// google socialite login
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);
// facebook socialite login
Route::get('auth/facebook', [FacebookController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [FacebookController::class, 'handleFacebookCallback']);
// github socialite login
Route::get('auth/github', [GithubController::class, 'redirectToGithub']);
Route::get('auth/github/callback', [GithubController::class, 'handleGithubCallback']);
// dribbble socialite login
Route::get('auth/dribbble', [DribbbleController::class, 'redirectToDribbble']);
Route::get('auth/dribbble/callback', [DribbbleController::class, 'handleDribbbleCallback']);