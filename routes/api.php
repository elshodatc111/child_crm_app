<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthControloler;
use App\Http\Controllers\api\MoliyaController;
use App\Http\Controllers\api\ChildTashrifController;

// Login
Route::controller(AuthControloler::class)->group(function(){
    Route::post('login', 'login');
});
// Logout AND Update Password
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthControloler::class, 'logout']);
    Route::post('/password/update', [AuthControloler::class, 'password_update']);
});
// Moliya
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/moliya', [MoliyaController::class, 'index']);
    Route::post('/moliya/chiqim', [MoliyaController::class, 'chiqim']);
});
// Tashriflar
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tashrif', [ChildTashrifController::class, 'index']);
    Route::get('/tashrif/show/{id}', [ChildTashrifController::class, 'show']);
    Route::post('/tashrif/create', [ChildTashrifController::class, 'create']);
    Route::post('/tashrif/create/comment', [ChildTashrifController::class, 'create_comment']);
    Route::post('/tashrif/cancel', [ChildTashrifController::class, 'cancel']);
    Route::post('/tashrif/success', [ChildTashrifController::class, 'success']);
});
