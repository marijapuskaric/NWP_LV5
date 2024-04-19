<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

//admin rute
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/updateuserrole/{id}', [App\Http\Controllers\AdminController::class, 'editUserRole'])->name('editUserRole');
Route::post('/updateuserrole/{id}', [App\Http\Controllers\AdminController::class, 'updateUserRole'])->name('updateUserRole');
Route::get('/setstudytype/{id}', [App\Http\Controllers\AdminController::class, 'editStudyType'])->name('editStudyType');
Route::post('/setstudytype/{id}', [App\Http\Controllers\AdminController::class, 'setStudyType'])->name('setStudyType');

//nastavnik rute
Route::get('/nastavnik', [App\Http\Controllers\NastavnikController::class, 'index'])->name('nastavnik');
Route::post('/nastavnik', [App\Http\Controllers\NastavnikController::class, 'createNewTask'])->name('createNewTask');
Route::get('/prijave', [App\Http\Controllers\NastavnikController::class, 'showApplications'])->name('applications');
Route::post('/prijave/{studentId}_{taskId}', [App\Http\Controllers\NastavnikController::class, 'acceptStudent'])->name('acceptStudent');

//student rute
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home/apply/{id}', [App\Http\Controllers\HomeController::class, 'apply'])->name('applyForTask');
Route::post('/home/cancel/{id}', [App\Http\Controllers\HomeController::class, 'cancel'])->name('cancelTask');

//lokalizacija
Route::get('locale/{lang}', [App\Http\Controllers\LocaleController::class, 'setLocale']);