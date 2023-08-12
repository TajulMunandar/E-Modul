<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\EssayController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PramateriController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardUserController;
use App\Http\Controllers\Dashboard\DashboardModulController;
use App\Http\Controllers\Dashboard\DashboardProdiController;
use App\Http\Controllers\Dashboard\DashboardQuizzController;
use App\Http\Controllers\Dashboard\DashboardMateriController;
use App\Http\Controllers\Dashboard\DashboardQuestionController;
use App\Http\Controllers\Dashboard\DashboardPenilaianController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\MainController;

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



Route::get('/', [MainController::class, 'index'])->name('main.index');

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});


Route::get('/profile', [ProfileController::class, 'index'])->name('modul-main.index');
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::put('/profile-image', [ProfileController::class, 'updateImage'])->name('profile.updateimage');
Route::post('/profile', [ProfileController::class, 'resetPassword'])->name('profile.reset');

Route::get('/modul', [ModulController::class, 'index'])->name('modul-main.index');

Route::get('/pramateri/{modul:slug}', [PramateriController::class, 'showPramateri'])->name('pramateri.show');

Route::get('/pramateri/{modul:slug}/pramateri', [PramateriController::class, 'showPramateri'])->name('pramateri-main.show');

Route::get('/pramateri/{modul:slug}/quiz', [PramateriController::class, 'showQuiz'])->name('pramateri-quiz.show')->middleware('auth');

Route::get('/materi-main/{materi:slug}', [PramateriController::class, 'showmateri'])->name('materi-main.show');
Route::post('/materi-main', [PramateriController::class, 'storeMateri'])->name('materi-main.store');

Route::post('/materi-main/coment/', [KomentarController::class, 'store'])->name('coment.store');
Route::put('/materi-main/coment/{id}', [KomentarController::class, 'update'])->name('coment.update');
Route::delete('/materi-main/coment/{id}', [KomentarController::class, 'destroy'])->name('coment.destroy');

Route::get('/quiz-main/{id}', [QuizController::class, 'showquiz'])->name('quiz-main.showquiz')->middleware('mahasiswa');
Route::resource('/quiz-main', QuizController::class)->except('showquiz')->middleware('mahasiswa');

Route::post('/quiz-main-essay', [EssayController::class, 'store'])->middleware('auth')->name('quiz-essay.store')->middleware('mahasiswa');

Route::prefix('/dashboard')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
    Route::resource('/prodi', DashboardProdiController::class)->middleware('auth');
    Route::resource('/modul', DashboardModulController::class)->middleware('auth');
    Route::resource('/materi', DashboardMateriController::class)->middleware('auth');
    Route::resource('/user', DashboardUserController::class)->middleware('admin');
    Route::post('/user/reset-password', [DashboardUserController::class, 'resetPasswordAdmin'])->name('user.reset')->middleware('admin');
    Route::middleware(['auth'])->group(function () {
        Route::prefix('/quizz')->group(function () {
            Route::resource('/choicee', DashboardQuizzController::class);
            Route::resource('/essayy', DashboardQuizzController::class);
            Route::resource('/question', DashboardQuestionController::class);
        });
    });
    Route::middleware(['auth'])->group(function () {
        Route::prefix('/penilaian')->group(function () {
            Route::get('/choice', [DashboardPenilaianController::class, 'index'])->name('choice.index');
            Route::get('/choice/{choice}', [DashboardPenilaianController::class, 'show'])->name('choice.show');
            Route::get('/essay', [DashboardPenilaianController::class, 'index'])->name('essay.index');
            Route::get('/essay/{essay}', [DashboardPenilaianController::class, 'show'])->name('essay.show');
            Route::put('/essay/{essay}', [DashboardPenilaianController::class, 'update'])->name('essay.update');
            Route::put('/essay/detail/{essay}', [DashboardPenilaianController::class, 'updateitem'])->name('essay.updateitem');
        });
    });
});
