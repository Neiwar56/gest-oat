<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PersonneController;
use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/personnes/{personne}/documents', [DocumentController::class, 'create'])->name('documents.create');
    Route::post('/personnes/{personne}/documents', [DocumentController::class, 'store'])->name('documents.store');
});

Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->middleware('guest')
            ->name('login');

Route::post('login', [AuthenticatedSessionController::class, 'store'])
            ->middleware('guest');

Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->middleware('auth')
            ->name('logout');

// Inscription (Breeze)
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminController;
Route::get('register', [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->name('register');
Route::post('register', [RegisteredUserController::class, 'store'])
            ->middleware('guest');

Route::middleware(['auth'])->group(function () {
    Route::get('personnes', [PersonneController::class, 'index'])->name('personnes.index');
    Route::get('personnes/create', [PersonneController::class, 'create'])->name('personnes.create');
    Route::post('personnes', [PersonneController::class, 'store'])->name('personnes.store');
    Route::get('personnes/{personne}', [PersonneController::class, 'show'])->name('personnes.show');
    Route::get('personnes/{personne}/edit', [PersonneController::class, 'edit'])->name('personnes.edit');
    Route::put('personnes/{personne}', [PersonneController::class, 'update'])->name('personnes.update');
    Route::delete('personnes/{personne}', [PersonneController::class, 'destroy'])->name('personnes.destroy');
    Route::get('exports/personnes.csv', [PersonneController::class, 'exportCsv'])->name('personnes.export.csv');

    // Administrateurs (super admin seulement)
    Route::middleware('can:is-super-admin')->group(function () {
        Route::get('admins', [AdminController::class, 'index'])->name('admins.index');
        Route::get('admins/create', [AdminController::class, 'create'])->name('admins.create');
        Route::post('admins', [AdminController::class, 'store'])->name('admins.store');
        Route::get('admins/{admin}/edit', [AdminController::class, 'edit'])->name('admins.edit');
        Route::put('admins/{admin}', [AdminController::class, 'update'])->name('admins.update');
        Route::delete('admins/{admin}', [AdminController::class, 'destroy'])->name('admins.destroy');
    });
});



// require __DIR__.'/auth.php';
