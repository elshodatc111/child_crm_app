<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthenticatedSessionController;

// Login ko'rinishi
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name("login_story");
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth']);
