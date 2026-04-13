<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LendingController;
use App\Exports\LendingsExport;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::patch('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset_password');
Route::get('/items/export', [ItemController::class, 'export'])->name('items.export');
Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
Route::get('/lendings/export', [LendingController::class, 'export'])->name('lendings.export');
Route::resource('categories', CategoriesController::class);
Route::resource('users', UserController::class);
Route::resource('items', ItemController::class);
Route::resource('lendings', LendingController::class);
