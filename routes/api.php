<?php

use App\Http\Controllers\CheckoutController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/checkout', [CheckoutController::class, 'checkout']);
