<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MilitarController;
use App\Http\Controllers\OperadorController;
use App\Http\Controllers\UnidadeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Rotas públicas
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/data', [DashboardController::class, 'getData'])->name('dashboard.data');


// Rotas de autenticação
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rotas protegidas (requerem autenticação)
Route::middleware('auth')->group(function () {
    Route::prefix('operador')->name('operador.')->group(function () {
        Route::get('/', [OperadorController::class, 'index'])->name('index');
        Route::post('/escolhas', [OperadorController::class, 'store'])->name('escolhas.store');
        Route::delete('/escolhas/{escolha}', [OperadorController::class, 'destroy'])->name('escolhas.destroy');
    });

    Route::resource('militares', MilitarController::class);
    Route::resource('unidades', UnidadeController::class);
});

// Rotas apenas para administradores
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class);
});
