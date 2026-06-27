<?php

use App\Http\Controllers\DonoController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::resource('/usuario', UsuarioController::class)->middleware('auth');
// Route::resource('/loja', LojaController::class)->middleware('auth');

// Route::middleware('auth')->group(function () {
//     Route::get('/dono/home', [DonoController::class, 'index']);
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('admin/dashboard');

Route::resource('/usuario', UsuarioController::class);
Route::resource('/loja', LojaController::class);

// Route::middleware('auth')->group(function () {
    Route::get('/dono/home', [DonoController::class, 'index']);
// });

// Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
