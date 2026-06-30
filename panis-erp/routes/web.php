<?php

use App\Http\Controllers\DonoController;
use App\Http\Controllers\LojaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VendaController;
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
    Route::get('/dono/home', [DonoController::class, 'index'])->name('dono/home');

    Route::get('/dono/funcionarios', [UsuarioController::class, 'index'])->name('dono/funcionarios');
    Route::get('/dono/funcionarios/create', [UsuarioController::class, 'create'])->name('dono/funcionario/create');
    Route::post('/dono/funcionarios/create', [UsuarioController::class, 'store'])->name('dono/funcionario/create');
    
    Route::get('/lojas', [LojaController::class, 'index'])->name('dono/lojas');
    Route::get('/loja/create', [LojaController::class, 'create'])->name('loja/create');
    Route::post('/loja/store', [LojaController::class, 'store'])->name('loja/store');

    Route::get('/vendas', [VendaController::class, 'index'])->name('vendas');
    Route::get('/vendas/create', [VendaController::class, 'create'])->name('vendas/create');
    Route::post('/vendas/store', [VendaController::class, 'store'])->name('vendas/store');

// });

// Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
