<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pay\PaypalController;

Route::get('payment',[PaypalController::class,'payment'])->name('payment');
Route::get('cancel',[PaypalController::class,'cancel'])->name('payment.cancel');
Route::get('payment/success',[PaypalController::class,'success'])->name('payment.success');