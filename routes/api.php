<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/checkout', [CheckoutController::class, 'checkoutPost']);
Route::get('/checkout', [CheckoutController::class, 'checkoutGet']);
