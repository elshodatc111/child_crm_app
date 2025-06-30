<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthenticatedSessionController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\hodim\ProfileController;
use App\Http\Controllers\hodim\TecherHodimController;
use App\Http\Controllers\hodim\HodimController;
use App\Http\Controllers\hodim\BoshqaHodimController;
use App\Http\Controllers\hodim\VacancyController;
use App\Http\Controllers\setting\SettingController;
use App\Http\Controllers\child\CildController;
use App\Http\Controllers\child\VacancyChildController;
use App\Http\Controllers\moliya\MoliyaController;
use App\Http\Controllers\moliya\KassaController;
use App\Http\Controllers\groups\GroupsController;

// Login ko'rinishi
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name("login_story");
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard')->middleware(['auth']);
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware(['auth']);
Route::get('/drektor', [HodimController::class, 'index'])->name('hodim')->middleware(['auth']);
Route::get('/tarbiyachi', [HodimController::class, 'hodim_tarbiyachi'])->name('hodim_tarbiyachi')->middleware(['auth']);
Route::get('/oshpazlar', [HodimController::class, 'hodim_oshpazlar'])->name('hodim_oshpazlar')->middleware(['auth']);
Route::get('/techer', [TecherHodimController::class, 'index'])->name('hodim_techer')->middleware(['auth']);
Route::get('/techer-show/{id}', [TecherHodimController::class, 'show'])->name('hodim_techer_show')->middleware(['auth']);

Route::get('/hodimlar', [BoshqaHodimController::class, 'index'])->name('hodim_boshqalar')->middleware(['auth']);
Route::get('/hodim_show/{id}', [BoshqaHodimController::class, 'show'])->name('hodim_boshqa_show')->middleware(['auth']);
Route::get('/hodim_show_tulov/{id}', [BoshqaHodimController::class, 'tulovlar'])->name('hodim_boshqa_show_tulovlar')->middleware(['auth']);

Route::get('/hodim_vakancy', [VacancyController::class, 'hodim_vacancy'])->name('hodim_vacancy')->middleware(['auth']);
Route::get('/hodim_vakancy_show/{id}', [VacancyController::class, 'hodim_vacancy_show'])->name('hodim_vacancy_show')->middleware(['auth']);
Route::get('/hodim_vakancy_create', [VacancyController::class, 'hodim_vakancy_create'])->name('hodim_vacancy_create')->middleware(['auth']);
Route::post('/vacancy/story', [VacancyController::class, 'story'])->name('vacancy_story')->middleware(['auth']);
Route::post('/vacancy/comment', [VacancyController::class, 'story_comment'])->name('vacancy_story_comment')->middleware(['auth']);
Route::post('/vacancy/cancel', [VacancyController::class, 'story_cancel'])->name('vacancy_story_cancel')->middleware(['auth']);
Route::post('/vacancy/success', [VacancyController::class, 'story_success'])->name('vacancy_story_success')->middleware(['auth']);


Route::get('/setting', [SettingController::class, 'setting'])->name('setting')->middleware(['auth']);
Route::post('/setting/update', [SettingController::class, 'update'])->name('setting_update')->middleware(['auth']);
Route::post('/setting/exson/update', [SettingController::class, 'update_exson'])->name('setting_exson_update')->middleware(['auth']);
Route::post('/setting/day/create', [SettingController::class, 'create_day'])->name('setting_create_day')->middleware(['auth']);
Route::post('/setting/day/delete', [SettingController::class, 'delete_day'])->name('setting_delete_day')->middleware(['auth']);


Route::get('/child', [CildController::class, 'index'])->name('child')->middleware(['auth']);
Route::get('/child-end', [CildController::class, 'index_end'])->name('child_end')->middleware(['auth']);
Route::get('/child-debit', [CildController::class, 'index_debit'])->name('child_debit')->middleware(['auth']);

Route::get('/childVakancy', [VacancyChildController::class, 'index'])->name('child_vakancy')->middleware(['auth']);
Route::post('/childVacancy/store', [VacancyChildController::class, 'store'])->name('child_vakancy_store')->middleware(['auth']);
Route::get('/childVacancy_show/{id}', [VacancyChildController::class, 'show'])->name('child_vakancy_show')->middleware(['auth']);
Route::post('/childVacancy_show/pedding/post', [VacancyChildController::class, 'create_comment'])->name('child_vakancy_show_pedding_post')->middleware(['auth']);
Route::post('/childVacancy_show/cancel/post', [VacancyChildController::class, 'cancel'])->name('child_vakancy_show_cancel_post')->middleware(['auth']);
Route::post('/childVacancy_show/success/post', [VacancyChildController::class, 'success'])->name('child_vakancy_show_success_post')->middleware(['auth']);

Route::get('/moliya', [MoliyaController::class, 'index'])->name('moliya')->middleware(['auth']);
Route::post('/moliya/chiqim', [MoliyaController::class, 'store'])->name('moliya_chiqim')->middleware(['auth']);

Route::get('/kassa', [KassaController::class, 'index'])->name('kassa')->middleware(['auth']);

Route::get('/groups', [GroupsController::class, 'index'])->name('groups')->middleware(['auth']);
Route::get('/groups-show/{id}', [GroupsController::class, 'groups_show'])->name('groups_show')->middleware(['auth']);
Route::get('/groups-showchild/{id}', [GroupsController::class, 'groups_show_child'])->name('groups_show_child')->middleware(['auth']);
Route::get('/groups-showdavomad/{id}', [GroupsController::class, 'groups_show_davomad'])->name('groups_show_davomad')->middleware(['auth']);
Route::get('/groups-showhistory/{id}', [GroupsController::class, 'groups_show_history'])->name('groups_show_history')->middleware(['auth']);
Route::post('/create-groups', [GroupsController::class, 'create_group'])->name('groups_create')->middleware(['auth']);
Route::post('/groups-update', [GroupsController::class, 'group_update'])->name('groups_updates')->middleware(['auth']);
Route::post('/groups-update-tarbiyachi', [GroupsController::class, 'groups_updates_tarbiyachi'])->name('groups_updates_tarbiyachi')->middleware(['auth']);
Route::post('/groups-update-yordamchi', [GroupsController::class, 'groups_updates_yordamchi'])->name('groups_updates_yordamchi')->middleware(['auth']);

Route::get('/arxiv-groups', [GroupsController::class, 'arxiv_index'])->name('groups_arxiv')->middleware(['auth']);
Route::get('/new-groups', [GroupsController::class, 'new_index'])->name('groups_new')->middleware(['auth']);
