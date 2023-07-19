<?php

use App\Http\Controllers\Dashboard\DashboardCategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardMateriController;
use App\Http\Controllers\Dashboard\DashboardModulController;
use App\Http\Controllers\Dashboard\DashboardUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('main.page.index');
});

Route::get('/modul', function () {
    return view('main.page.modul');
});

Route::prefix('/dashboard')->group( function (){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/category', DashboardCategoryController::class);
    Route::resource('/modul', DashboardModulController::class);
    Route::resource('/materi', DashboardMateriController::class);
    Route::resource('/user', DashboardUserController::class);
    Route::post('/user/reset-password', [DashboardUserController::class, 'resetPasswordAdmin'])->name('user.reset');
});

