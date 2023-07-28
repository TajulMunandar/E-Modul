<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\EssayController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ModulController;
use App\Http\Controllers\PramateriController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\DashboardUserController;
use App\Http\Controllers\Dashboard\DashboardModulController;
use App\Http\Controllers\Dashboard\DashboardQuizzController;
use App\Http\Controllers\Dashboard\DashboardMateriController;
use App\Http\Controllers\Dashboard\DashboardCategoryController;
use App\Http\Controllers\Dashboard\DashboardQuestionController;
use App\Http\Controllers\Dashboard\DashboardQuizzEssayController;
use App\Http\Controllers\Dashboard\DashboardQuizzChoiceController;

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

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login')->middleware('guest');
    Route::post('/login', 'authenticate');
    Route::post('/logout', 'logout');
});

Route::get('/modul', [ModulController::class, 'index'] )->name('modul-main.index');

Route::get('/pramateri/{modul:slug}', [PramateriController::class, 'showPramateri'])->name('pramateri.show');

Route::get('/pramateri/{modul:slug}/pramateri', [PramateriController::class, 'showPramateri'])->name('pramateri-main.show');

Route::get('/pramateri/{modul:slug}/quiz', [PramateriController::class, 'showQuiz'])->name('pramateri-quiz.show');

Route::get('/materi-main/{materi:slug}', [PramateriController::class, 'showmateri'])->name('materi-main.show');

Route::get('/quiz-main/{id}', [QuizController::class, 'showquiz'])->name('quiz-main.showquiz');
Route::resource('/quiz-main', QuizController::class)->middleware('auth')->except('showquiz');

Route::post('/quiz-main-essay', [EssayController::class, 'store'])->middleware('auth')->name('quiz-essay.store');

Route::prefix('/dashboard')->group( function (){
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
    Route::resource('/category', DashboardCategoryController::class)->middleware('auth');
    Route::resource('/modul', DashboardModulController::class)->middleware('auth');
    Route::resource('/materi', DashboardMateriController::class)->middleware('auth');
    Route::resource('/user', DashboardUserController::class)->middleware('auth');
    Route::post('/user/reset-password', [DashboardUserController::class, 'resetPasswordAdmin'])->name('user.reset')->middleware('auth');
    Route::prefix('/quizz')->group( function (){
        Route::resource('/choicee', DashboardQuizzController::class)->middleware('auth');
        Route::resource('/essayy', DashboardQuizzController::class)->middleware('auth');
        Route::resource('/question', DashboardQuestionController::class)->middleware('auth');
    });
});

