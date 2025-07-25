<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthenticatedSessionController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\hodim\ProfileController;
use App\Http\Controllers\hodim\TecherHodimController;
use App\Http\Controllers\hodim\HodimController;
use App\Http\Controllers\hodim\BoshqaHodimController;
use App\Http\Controllers\hodim\TarbiyachiController;
use App\Http\Controllers\hodim\OshpazlarControllar;
use App\Http\Controllers\hodim\HodimDavomadController;
use App\Http\Controllers\hodim\VacancyController;
use App\Http\Controllers\setting\SettingController;
use App\Http\Controllers\child\ChildGroupController;
use App\Http\Controllers\child\CildController;
use App\Http\Controllers\child\ChilDebitController;
use App\Http\Controllers\child\ChildEndController;
use App\Http\Controllers\child\VacancyChildController;
use App\Http\Controllers\moliya\MoliyaController;
use App\Http\Controllers\moliya\KassaController;
use App\Http\Controllers\groups\GroupsController;
use App\Http\Controllers\groups\GroupDavomatController;
use App\Http\Controllers\groups\GroupsChildController;
use App\Http\Controllers\groups\GroupsDarslarController;
use App\Http\Controllers\chart\ChartController;
use App\Http\Controllers\report\ReportController;

// Login ko'rinishi
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name("login_story");
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::get('/', [DashboardController::class, 'home'])->name('dashboard')->middleware(['auth']);
Route::get('/dashboard', [DashboardController::class, 'home'])->name('dashboard')->middleware(['auth']);
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware(['auth']);
Route::post('/profile/password/update', [ProfileController::class, 'profile_password_update'])->name('profile_password_update')->middleware(['auth']);
Route::get('/drektor', [HodimController::class, 'index'])->name('hodim')->middleware(['auth']);
Route::get('/drektor_show/{id}', [HodimController::class, 'meneger_show'])->name('meneger_show')->middleware(['auth']);
Route::get('/drektor_show_paymart/{id}', [HodimController::class, 'meneger_show_paymart'])->name('meneger_show_paymart')->middleware(['auth']);
Route::post('/hodim_show/updates', [HodimController::class, 'hodim_show_update_post'])->name('hodim_show_update_post')->middleware(['auth']);
Route::post('/hodim_show/updates/status', [HodimController::class, 'hodim_show_update_post_status'])->name('hodim_show_update_post_status')->middleware(['auth']);
Route::post('/hodim_show/create/comment', [HodimController::class, 'hodim_showcreate_commentss'])->name('hodim_showcreate_commentss')->middleware(['auth']);
Route::post('/hodim_show/update/password', [HodimController::class, 'updatePassword'])->name('hodim_show_update_password')->middleware(['auth']);
Route::post('/hodim_show/create/paymart', [HodimController::class, 'hodim_create_paymarts'])->name('hodim_create_paymarts')->middleware(['auth']);

Route::get('/hodimlar', [BoshqaHodimController::class, 'index'])->name('hodim_boshqalar')->middleware(['auth']);
Route::get('/hodim_show/{id}', [BoshqaHodimController::class, 'show'])->name('hodim_boshqa_show')->middleware(['auth']);
Route::get('/hodim_show_tulov/{id}', [BoshqaHodimController::class, 'tulovlar'])->name('hodim_boshqa_show_tulovlar')->middleware(['auth']);
Route::post('/hodimlar/comments/create', [BoshqaHodimController::class, 'create_comments'])->name('hodim_boshqalar_create_comments')->middleware(['auth']);
Route::post('/hodimlar/update/status', [BoshqaHodimController::class, 'update_status'])->name('hodim_boshqalar_update_status')->middleware(['auth']);
Route::post('/hodimlar/tulov/ish\haqi', [BoshqaHodimController::class, 'paymart_post'])->name('hodim_boshqalar_paymart_post')->middleware(['auth']);

Route::get('/oshpazlar', [OshpazlarControllar::class, 'hodim_oshpazlar'])->name('hodim_oshpazlar')->middleware(['auth']);
Route::get('/oshpaz/{id}', [OshpazlarControllar::class, 'oshpaz_show'])->name('oshpaz_show')->middleware(['auth']);
Route::get('/oshpaz_pay/{id}', [OshpazlarControllar::class, 'oshpaz_paymart'])->name('oshpaz_paymart')->middleware(['auth']);

Route::get('/techer', [TecherHodimController::class, 'index'])->name('hodim_techer')->middleware(['auth']);
Route::get('/techer-show/{id}', [TecherHodimController::class, 'show'])->name('hodim_techer_show')->middleware(['auth']);
Route::get('/techer-tarix/{id}', [TecherHodimController::class, 'tarix'])->name('hodim_techer_tarix')->middleware(['auth']);
Route::get('/techer-paymart/{id}', [TecherHodimController::class, 'paymart'])->name('hodim_techer_paymart')->middleware(['auth']);
Route::post('/techer-update', [TecherHodimController::class, 'update'])->name('hodim_techer_update')->middleware(['auth']);
Route::post('/techer-create-dars', [TecherHodimController::class, 'create_dars'])->name('hodim_create_dars')->middleware(['auth']);

Route::get('/tarbiyachi', [TarbiyachiController::class, 'hodim_tarbiyachi'])->name('hodim_tarbiyachi')->middleware(['auth']);
Route::get('/tarbiyashi_show/{id}', [TarbiyachiController::class, 'show'])->name('hodim_tarbiyachi_show')->middleware(['auth']);
Route::get('/tarbiyashi_tarix/{id}', [TarbiyachiController::class, 'tarix'])->name('hodim_tarbiyachi_show_tarix')->middleware(['auth']);
Route::get('/tarbiyashi_paymart/{id}', [TarbiyachiController::class, 'paymart'])->name('hodim_tarbiyachi_show_paymart')->middleware(['auth']);
Route::post('/tarbiyashi_paymart/update', [TarbiyachiController::class, 'update'])->name('hodim_tarbiyachi_show_update')->middleware(['auth']);


Route::get('/hodim_vakancy', [VacancyController::class, 'hodim_vacancy'])->name('hodim_vacancy')->middleware(['auth']);
Route::get('/hodim_vakancy_show/{id}', [VacancyController::class, 'hodim_vacancy_show'])->name('hodim_vacancy_show')->middleware(['auth']);
Route::get('/hodim_vakancy_create', [VacancyController::class, 'hodim_vakancy_create'])->name('hodim_vacancy_create')->middleware(['auth']);
Route::post('/vacancy/story', [VacancyController::class, 'story'])->name('vacancy_story')->middleware(['auth']);
Route::post('/vacancy/comment', [VacancyController::class, 'story_comment'])->name('vacancy_story_comment')->middleware(['auth']);
Route::post('/vacancy/cancel', [VacancyController::class, 'story_cancel'])->name('vacancy_story_cancel')->middleware(['auth']);
Route::post('/vacancy/success', [VacancyController::class, 'story_success'])->name('vacancy_story_success')->middleware(['auth']);

Route::get('/davomad/meneger', [HodimDavomadController::class, 'meneger'])->name('hodim_davomad_meneger')->middleware(['auth']);
Route::post('/davomad/meneger/store', [HodimDavomadController::class, 'meneger_davomad_store'])->name('meneger_davomad_store')->middleware(['auth']);
Route::get('/davomad/tarbiyachi', [HodimDavomadController::class, 'tarbiyachi'])->name('hodim_davomad_tarbiyachi')->middleware(['auth']);
Route::get('/davomad/oshpaz', [HodimDavomadController::class, 'oshpaz'])->name('hodim_davomad_techer')->middleware(['auth']);
Route::get('/davomad/hodim', [HodimDavomadController::class, 'hodim'])->name('hodim_davomad_hodim')->middleware(['auth']);


Route::get('/setting', [SettingController::class, 'setting'])->name('setting')->middleware(['auth']);
Route::post('/setting/update', [SettingController::class, 'update'])->name('setting_update')->middleware(['auth']);
Route::post('/setting/exson/update', [SettingController::class, 'update_exson'])->name('setting_exson_update')->middleware(['auth']);
Route::post('/setting/day/create', [SettingController::class, 'create_day'])->name('setting_create_day')->middleware(['auth']);
Route::post('/setting/day/delete', [SettingController::class, 'delete_day'])->name('setting_delete_day')->middleware(['auth']);


Route::get('/child', [CildController::class, 'index'])->name('child')->middleware(['auth']);
Route::get('/child-show/{id}', [CildController::class, 'show'])->name('child_show')->middleware(['auth']);
Route::post('/child-update', [CildController::class, 'child_update'])->name('child_update')->middleware(['auth']);
Route::post('/child-create-eslatma', [CildController::class, 'child_new_eslatma'])->name('child_new_eslatma')->middleware(['auth']);
Route::post('/child-create-qarindosh', [CildController::class, 'child_new_qarindosh'])->name('child_new_qarindosh')->middleware(['auth']);
Route::post('/child-delete-qarindosh', [CildController::class, 'child_delete_qarindosh'])->name('child_delete_qarindosh')->middleware(['auth']);
Route::post('/child-create-paymart', [CildController::class, 'create_paymarts'])->name('create_paymarts')->middleware(['auth']);
Route::post('/child-create-update-group', [CildController::class, 'child_update_group'])->name('child_update_group')->middleware(['auth']);

Route::get('/child-show-group/{id}', [ChildGroupController::class, 'show_group'])->name('child_show_group')->middleware(['auth']);
Route::get('/child-show-davomad/{id}', [CildController::class, 'show_davomad'])->name('child_show_davomad')->middleware(['auth']);
Route::get('/child-show-paymart/{id}', [CildController::class, 'show_paymart'])->name('child_show_paymart')->middleware(['auth']);

Route::get('/child-end', [ChildEndController::class, 'index_end'])->name('child_end')->middleware(['auth']);

Route::get('/child-debit', [ChilDebitController::class, 'index_debit'])->name('child_debit')->middleware(['auth']);

Route::get('/childVakancy', [VacancyChildController::class, 'index'])->name('child_vakancy')->middleware(['auth']);
Route::get('/childVakancy_create', [VacancyChildController::class, 'index_create'])->name('child_vakancy_create')->middleware(['auth']);
Route::post('/childVacancy/store', [VacancyChildController::class, 'store'])->name('child_vakancy_store')->middleware(['auth']);
Route::get('/childVacancy_show/{id}', [VacancyChildController::class, 'show'])->name('child_vakancy_show')->middleware(['auth']);
Route::post('/childVacancy_show/pedding/post', [VacancyChildController::class, 'create_comment'])->name('child_vakancy_show_pedding_post')->middleware(['auth']);
Route::post('/childVacancy_show/cancel/post', [VacancyChildController::class, 'cancel'])->name('child_vakancy_show_cancel_post')->middleware(['auth']);
Route::post('/childVacancy_show/success/post', [VacancyChildController::class, 'success'])->name('child_vakancy_show_success_post')->middleware(['auth']);

Route::get('/moliya', [MoliyaController::class, 'index'])->name('moliya')->middleware(['auth']);
Route::post('/moliya/chiqim', [MoliyaController::class, 'store'])->name('moliya_chiqim')->middleware(['auth']);

Route::get('/kassa', [KassaController::class, 'index'])->name('kassa')->middleware(['auth']);
Route::post('/kassa/chiqim', [KassaController::class, 'kassa_chiqim'])->name('kassa_chiqim')->middleware(['auth']);
Route::post('/kassa/chiqim/delete', [KassaController::class, 'kassa_chiqim_delete'])->name('kassa_chiqim_delete')->middleware(['auth']);
Route::post('/kassa/chiqim/success', [KassaController::class, 'kassa_chiqim_success'])->name('kassa_chiqim_success')->middleware(['auth']);

Route::get('/groups', [GroupsController::class, 'index'])->name('groups')->middleware(['auth']);
Route::get('/groups-show/{id}', [GroupsController::class, 'groups_show'])->name('groups_show')->middleware(['auth']);
Route::get('/child-show-darslar/{id}', [GroupsDarslarController::class, 'index'])->name('child_show_darslar')->middleware(['auth']);
Route::post('/create-groups', [GroupsController::class, 'create_group'])->name('groups_create')->middleware(['auth']);
Route::post('/groups-update', [GroupsController::class, 'group_update'])->name('groups_updates')->middleware(['auth']);
Route::post('/groups-update-tarbiyachi', [GroupsController::class, 'groups_updates_tarbiyachi'])->name('groups_updates_tarbiyachi')->middleware(['auth']);
Route::post('/groups-update-yordamchi', [GroupsController::class, 'groups_updates_yordamchi'])->name('groups_updates_yordamchi')->middleware(['auth']);
Route::post('/groups-create-davomat', [GroupDavomatController::class, 'groups_create_davomat'])->name('groups_create_davomat')->middleware(['auth']);
Route::get('/groups-showdavomad/{id}', [GroupDavomatController::class, 'groups_show_davomad'])->name('groups_show_davomad')->middleware(['auth']);
Route::get('/groups-showchild/{id}', [GroupsChildController::class, 'groups_show_child'])->name('groups_show_child')->middleware(['auth']);
Route::get('/groups-showchild-update/{group_id}/{child_id}', [GroupsChildController::class, 'groups_show_child_update'])->name('groups_show_child_update')->middleware(['auth']);
Route::post('/groups-showchild-delete', [GroupsChildController::class, 'groups_show_child_delete'])->name('groups_show_child_delete')->middleware(['auth']);
Route::post('/groups-showchild-paymar-update', [GroupsChildController::class, 'groups_show_child_paymart_update'])->name('groups_show_child_paymart_update')->middleware(['auth']);

Route::get('/arxiv-groups', [GroupsController::class, 'arxiv_index'])->name('groups_arxiv')->middleware(['auth']);
Route::get('/new-groups', [GroupsController::class, 'new_index'])->name('groups_new')->middleware(['auth']);


Route::get('/report', [ReportController::class, 'index'])->name('report')->middleware(['auth']);
Route::get('/chart', [ChartController::class, 'index'])->name('chart')->middleware(['auth']);
