<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomersController;

Route::get('/customers/login',[CustomersController::class, 'login'])->name('customers/login');
Route::post('/customers/login',[CustomersController::class, 'loginAction'])->name('customers/login');
Route::get('/customers/logout',[CustomersController::class, 'logout'])->name('customers/logout');
Route::get('/customers/account',[CustomersController::class, 'account'])->name('customers/account');
Route::get('/customers/product/cart/{p_id}',[CustomersController::class,'cartAction']);
Route::get('/customers/product/cart',[CustomersController::class,'cart'])->name('customers/product/cart');
Route::get('/customers/product/orders',[CustomersController::class,'checkout'])->name('customers/product/orders');
Route::get('/customers/delete/order/{id}',[CustomersController::class,'delete']);