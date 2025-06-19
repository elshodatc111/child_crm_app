<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthenticatedSessionController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\hodim\ProfileController;
use App\Http\Controllers\hodim\HodimController;

// Login ko'rinishi
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name("login_story");
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard')->middleware(['auth']);
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware(['auth']);
Route::get('/hodim', [HodimController::class, 'index'])->name('hodim')->middleware(['auth']);

