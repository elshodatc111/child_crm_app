<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthControloler;
use App\Http\Controllers\api\MoliyaController;
use App\Http\Controllers\api\ChildTashrifController;
use App\Http\Controllers\api\ChildController;
use App\Http\Controllers\api\KassaController;
use App\Http\Controllers\api\GroupsController;
use App\Http\Controllers\api\HodimDavomadController;
use App\Http\Controllers\api\HodimVacancyController;
use App\Http\Controllers\api\TecherController;

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
// Bolalar
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/childs', [ChildController::class, 'index']); // Aktiv bolalar
    Route::get('/childs/debet', [ChildController::class, 'debet']); // Qarzdor bolalar
    Route::get('/child/{id}', [ChildController::class, 'show']); // Bola haqida
    Route::get('/child/paymart/{id}', [ChildController::class, 'paymart']); // To'lovlar tarixi
    Route::get('/child/groups/{id}', [ChildController::class, 'groups']); // Guruhlar tarixi
    Route::get('/child/davomad/{id}', [ChildController::class, 'davomad']); // Davomadlar tarixi
    Route::post('/child/paymart/create', [ChildController::class, 'create_paymart']); // Aktiv bolalar
    Route::post('/child/qarindosh/create', [ChildController::class, 'create_qarindosh']); // Yangi qarindosh
    Route::post('/child/qarindosh/delete', [ChildController::class, 'create_qarindosh_delete']); // Yangi Comentariya
    Route::post('/child/comment/create', [ChildController::class, 'create_comment']); // Yangi Comentariya
});
// Kassa
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/kassa', [KassaController::class, 'index']);
    Route::post('/kassa/post', [KassaController::class, 'kassa_post']);
    Route::post('/kassa/delete', [KassaController::class, 'kassa_delete']); 
    Route::post('/kassa/success', [KassaController::class, 'kassa_success']); 
});
// Groups
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/groups', [GroupsController::class, 'index']);  // +++
    Route::get('/groups/show/{id}', [GroupsController::class, 'show']);   // +++
    Route::get('/groups/child/{id}', [GroupsController::class, 'show_child']);  // +++
    Route::get('/groups/davomad/{id}', [GroupsController::class, 'show_davomad']);
    Route::get('/groups/darslar/{id}', [GroupsController::class, 'show_darslar']);
    Route::post('/groups/create/davomad', [GroupsController::class, 'create_davomad']);
});

// Hodimlar
Route::middleware('auth:sanctum')->group(function () { // HodimVacancyController
    Route::get('/hodimlar', [HodimDavomadController::class, 'index']);  
    Route::post('/hodimlar/davomad', [HodimDavomadController::class, 'create_davomad']);
    Route::get('/vacancy', [HodimVacancyController::class, 'index']);  
    Route::get('/vacancy/show/{id}', [HodimVacancyController::class, 'show']);  
    Route::post('/vacancy/create/comment', [HodimVacancyController::class, 'create_comment']);  
    Route::post('/vacancy/cancel', [HodimVacancyController::class, 'vacancy_cancel']);  
    Route::post('/vacancy/success', [HodimVacancyController::class, 'vacancy_success']);  
    Route::post('/vacancy/create', [HodimVacancyController::class, 'create_vacancy']);  
});

Route::middleware('auth:sanctum')->group(function () { // HodimVacancyController
    Route::get('/techers', [TecherController::class, 'index']);  
    Route::get('/techer/show/{id}', [TecherController::class, 'show']);  
    Route::get('/techer/show/lessin/{id}', [TecherController::class, 'show_lessin']);  
    Route::post('/techer/create/comment', [TecherController::class, 'create_comment']);  
    Route::post('/techer/create/lessin', [TecherController::class, 'create_lessin']);  
});