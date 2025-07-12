<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthControloler;
use App\Http\Controllers\api\MoliyaController;

Route::controller(AuthControloler::class)->group(function(){
    Route::post('login', 'login');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthControloler::class, 'logout']);
    Route::post('/password/update', [AuthControloler::class, 'password_update']);
});
// Moliya
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/moliya', [MoliyaController::class, 'index']);
});
