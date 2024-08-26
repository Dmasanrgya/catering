<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
<<<<<<< HEAD
use App\Http\Controllers\OrderController;
=======
use App\Http\Controllers\CustomerController;
use App\Models\Customer;
>>>>>>> 211f47f9a7ff97b659abe2a9c0feb4467c4d3179
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::middleware(['auth'])->group(function () {

    Route::resource('menus', MenuController::class);
<<<<<<< HEAD
    Route::resource('orders', OrderController::class);
=======
    Route::resource('customers', CustomerController::class);
>>>>>>> 211f47f9a7ff97b659abe2a9c0feb4467c4d3179
});
