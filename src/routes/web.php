<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\RolePermissionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth');

// Rutas del Panel Administrativo
Route::prefix('admin')->middleware(['auth', 'can:view-admin-dashboard'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    
    Route::get('/personas', [PersonaController::class, 'index'])->name('admin.personas.index');
    Route::get('/personas/create', [PersonaController::class, 'create'])->name('admin.personas.create');
    Route::post('/personas', [PersonaController::class, 'store'])->name('admin.personas.store');
    Route::get('/personas/{persona}/edit', [PersonaController::class, 'edit'])->name('admin.personas.edit');
    Route::put('/personas/{persona}', [PersonaController::class, 'update'])->name('admin.personas.update');
    Route::delete('/personas/{persona}', [PersonaController::class, 'destroy'])->name('admin.personas.destroy');
    
    Route::get('/roles', [RolePermissionController::class, 'index'])->name('admin.roles.index');
    Route::get('/roles/create', [RolePermissionController::class, 'create'])->name('admin.roles.create');
    Route::post('/roles', [RolePermissionController::class, 'store'])->name('admin.roles.store');
    Route::get('/roles/{role}/edit', [RolePermissionController::class, 'edit'])->name('admin.roles.edit');
    Route::put('/roles/{role}', [RolePermissionController::class, 'update'])->name('admin.roles.update');
    
    // Rutas futuras para otros módulos
    // Route::get('/oferta-academica', ...);
});

