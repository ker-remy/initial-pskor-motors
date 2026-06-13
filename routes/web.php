<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SaleController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('cars', CarController::class);
Route::resource('customers', CustomerController::class);
Route::resource('staff', StaffController::class);
Route::resource('sales', SaleController::class);