<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\PersonneController;
use App\Http\Controllers\DocumentController;

Route::get('/', function () {
    return view('welcome');
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

Route::resource('personnes', PersonneController::class);



// require __DIR__.'/auth.php';
