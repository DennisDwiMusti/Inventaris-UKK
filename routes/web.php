<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController; // PAstikan ini di-import
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/items/export', [ItemController::class, 'export'])->name('items.export');
Route::resource('categories', CategoriesController::class);
Route::resource('users', UserController::class);
Route::resource('items', ItemController::class);
