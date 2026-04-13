<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LendingController;
use App\Models\Item;
use App\Models\Lending;

// --- ROUTE PUBLIK (Tanpa Login) ---
Route::get('/', function () { return view('welcome'); })->name('welcome');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// --- ROUTE TERPROTEKSI (Wajib Login) ---
Route::middleware(['auth'])->group(function () {

    // Dashboard dengan statistik Real-time
    Route::get('/dashboard', function () {
        $totalLendings = Lending::count();
        $totalStock = Item::sum('total');
        $totalRepair = Item::sum('repair');
        $totalLendingStock = Item::sum('lending_id');
        $availableItems = $totalStock - $totalRepair - $totalLendingStock;
        $totalItemTypes = Item::count();

        return view('dashboard', compact('totalLendings', 'availableItems', 'totalItemTypes', 'totalRepair'));
    })->name('dashboard');

    // Manajemen Items (Akses Umum)
    Route::resource('items', ItemController::class);
    Route::get('/items/export', [ItemController::class, 'export'])->name('items.export');

    // Manajemen Lending & Cetak Struk (Akses Umum)
    // Catatan: Route custom harus di atas Route Resource agar tidak stuck/bentrok
    Route::get('/lendings/{id}/confirm', [LendingController::class, 'confirm'])->name('lendings.confirm');
    Route::get('/lendings/export', [LendingController::class, 'export'])->name('lendings.export');
    Route::resource('lendings', LendingController::class);

    // Manajemen Profil User (Edit Sendiri)
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::patch('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.reset_password');

    // --- KHUSUS ADMIN ---
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('categories', CategoriesController::class);

        // Resource User Lengkap (Hanya Admin yang bisa lihat list, tambah, hapus)
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
    });

    // --- KHUSUS OPERATOR (Jika ada fitur tambahan nantinya) ---
    Route::middleware(['role:operator'])->group(function () {
        // Fitur khusus operator bisa ditaruh di sini
    });

});
