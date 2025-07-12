<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthControloler;

Route::controller(AuthControloler::class)->group(function(){
    Route::post('login', 'login');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthControloler::class, 'logout']);
});
